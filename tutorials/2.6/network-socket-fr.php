<?php

    $title = "Communiquer avec les sockets";
    $page = "network-socket-fr.php";

    require("header-fr.php");

?>

<h1>Communiquer avec les sockets</h1>

<?php h2('Les sockets') ?>
<p>
    Une socket est une porte entre votre application et le monde extérieur : à travers une socket, vous pouvez envoyer et recevoir des données. Ainsi, à peu près tout programme
    réseau aura affaire à des sockets, elles sont l'élément central de la communication réseau.
</p>
<p>
    Il existe plusieurs types de sockets, qui fournissent chacun des fonctionnalités spécifiques. SFML implémente les types les plus courants : les sockets TCP et les sockets
    UDP.
</p>

<?php h2('TCP vs UDP') ?>
<p>
    Il est important de savoir ce que peuvent faire les sockets TCP et UDP, et ce qu'elles ne peuvent pas faire, de manière à pouvoir choisir le type qui correspond aux
    besoins de votre application.
</p>
<p>
    La principale différence est que les sockets TCP sont connectées. Vous ne pouvez ni recevoir ni envoyer de données avant d'avoir explicitement connecté la socket à une
    autre socket, sur la machine distante. Une fois connectée, une socket TCP peut uniquement envoyer et recevoir vers/depuis la socket à laquelle elle est connectée. Vous
    aurez donc besoin d'une socket TCP pour chaque client dans votre application.<br/>
    Les sockets UDP par contre ne sont pas connectées, vous pouvez envoyer et recevoir vers/depuis n'importe qui à n'importe quel moment avec la même socket.
</p>
<p>
    Deuxième différence : TCP est plus fiable que UDP. TCP garantit que ce que vous envoyez est toujours reçu, sans perte ni corruption, et toujours dans le bon ordre. UDP
    effectue moins de vérifications, et fournit un niveau de robustesse moindre : ce que vous envoyez peut arriver dupliqué, désordonné, voire même être perdu et ne jamais
    atteindre l'ordinateur distant. Cependant, les données qui sont reçues sont toujours valides (elles ne peuvent pas être corrompues).<br/>
    UDP peut avoir l'air effrayant après une telle description, mais gardez en tête que <em>la plupart du temps</em>, les données arrivent à destination et dans le bon ordre.
</p>
<p>
    La troisième différence est une conséquence directe de la seconde : UDP est plus rapide et plus léger que TCP. Il a moins de contraintes, donc il utilise moins de
    ressources.
</p>
<p>
    La dernière différence concerne la manière dont sont transportées les données. TCP est un protocole en <em>flux</em> : il n'y a pas de limite de message, si vous envoyez
    "Hello" puis "SFML", la machine distante peut très bien recevoir "HelloSFML", "Hel" + "loSFML", ou bien encore "He" + "loS" + "FML". Le protocole est libre de
    rassembler et/ou découper les données comme bon lui semble.<br/>
    UDP est un protocole de <em>datagrammes</em>. Les datagrammes sont des paquets de données, qui ne peuvent pas se mélanger. Si vous recevez un datagramme UDP, alors
    vous êtes garantis d'avoir les données exactement telles qu'elles ont été envoyées, ni plus ni moins. Donc pour résumer, UDP n'offre aucune garantie sur l'arrivée des
    datagrammes, mais lorsqu'ils arrivent, leur contenu est forcément tel qu'il a été envoyé.
</p>
<p>
    Oh, et une dernière chose : puisqu'UDP n'est pas connecté, il permet de diffuser des messages à de multiples destinataires, voire même à un réseau tout entier. La
    communication 1-1 des sockets TCP ne le permet pas.
</p>

<?php h2('Connecter une socket TCP') ?>
<p>
    Comme vous pouvez le deviner, cette partie concerne uniquement les sockets TCP. Il y a deux facettes à une connexion : d'un côté, celui qui attend la connexion entrante
    (appelons-le le serveur), et de l'autre, celui qui initie la connexion (appelons-le le client).
</p>
<p>
    Côté client, les choses sont relativement simples : l'utilisateur doit just avoir un <?php class_link('TcpSocket') ?> et appeler sa fonction <code>connect</code>
    afin de déclencher la connexion.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::TcpSocket socket;
sf::Socket::Status status = socket.connect("192.168.0.5", 53000);
if (status != sf::Socket::Done)
{
    // erreur...
}
</code></pre>
<p>
    Le premier paramètre est l'adresse de l'hôte auquel se connecter. C'est un paramètre de type <?php class_link('IpAddress') ?>, qui peut représenter tout type d'adresse :
    une URL, une adresse IP, ou un nom d'hôte réseau. Vous pouvez jeter un oeil à la documentation pour plus de détails concernant cette classe.
</p>
<p>
    Le deuxième paramètre est le port auquel se connecter sur la machine distante. La connection ne pourra fonctionner que si le serveur est en train d'attendre une connexion
    sur ce port.
</p>
<p>
    Il y a un troisième paramètre, optionnel, qui est un timeout. S'il est renseigné, et que la connexion n'aboutit pas avant qu'il soit écoulé, la connexion échoue et
    la fonction renvoie une erreur. Si ce paramètre n'est pas renseigné, le timeout par défaut de l'OS est utilisé.
</p>
<p>
    Une fois connecté, vous pouvez récupérer l'adresse et le port de la machine distante si nécessaire, avec les fonctions <code>getRemoteAddress()</code> et
    <code>getRemotePort()</code>.
</p>
<p class="important">
    Toutes les fonctions des classes de sockets sont bloquantes par défaut. Cela signifie que votre programme (ou du moins le thread qui contient l'appel) sera bloqué
    jusqu'à ce que l'action correspondante se termine. C'est très important car certaines fonctions peuvent prendre un temps considérable : par exemple, se connecter à
    un hôte qui ne répond pas peut durer plusieurs secondes, ou encore, recevoir ne va pas rendre la main tant que quelque chose n'a pas effectivement été été reçu, etc.<br/>
    Vous pouvez modifier ce comportement et rendre toutes les fonctions non-bloquantes, avec la fonction <code>setBlocking</code> de la socket. Voyez plus bas pour plus
    de détails.
</p>
<p>
    Côté serveur, il y a un peu plus de choses à faire. Plusieurs sockets sont nécessaires : une qui écoute les connections entrantes, puis une pour chaque client connecté.
</p>
<p>
    Pour écouter les connexions, vous devez utiliser la classe spéciale <?php class_link('TcpListener') ?>. Son unique but est d'attendre des connexions sur un port donné,
    elle ne peut pas envoyer ou recevoir de données.
</p>
<pre><code class="cpp">sf::TcpListener listener;

// lie l'écouteur à un port
if (listener.listen(53000) != sf::Socket::Done)
{
    // erreur...
}

// accepte une nouvelle connexion
sf::TcpSocket client;
if (listener.accept(client) != sf::Socket::Done)
{
    // erreur...
}

// utilisez la socket "client" pour communiquer avec le client connecté,
// et continuez à attendre de nouvelles connexions avec l'écouteur
</code></pre>
<p>
    La fonction <code>accept</code> bloque jusqu'à ce qu'une connexion arrive (à moins que la socket ne soit passée en mode non-bloquant). Lorsque cela arrive, la fonction
    initialise la socket qu'elle a reçu en paramètre puis rend la main ; cette socket peut désormais être utilisée pour communiquer avec le client, et l'écouteur peut
    recommencer à attendre une nouvelle connexion.
</p>
<p>
    Après un appel réussi à <code>connect</code> (côté client) et <code>accept</code> (côté serveur), la communication est établie et les deux sockets sont prêtes à
    échanger des données.
</p>

<?php h2('Lier une socket UDP à un port') ?>
<p>
    Une socket UDP n'est pas connectée, mais vous devrez tout de même la lier à un port afin de pouvoir recevoir des données sur ce port. Une socket UDP ne peut en effet pas
    recevoir tout ce qui arrive sur tous les ports.
</p>
<pre><code class="cpp">sf::UdpSocket socket;

// lie la socket à un port
if (socket.bind(54000) != sf::Socket::Done)
{
    // erreur...
}
</code></pre>
<p>
    Après avoir lié la socket à un port, elle est prête a recevoir des données sur ce port. Si vous souhaitez que l'OS choisisse automatiquement un port libre, vous pouvez
    passer <code>sf::Socket::AnyPort</code>, puis récupérer le port choisi avec <code>socket.getLocalPort()</code>.
</p>
<p>
    Les sockets UDP qui envoient des données n'ont rien besoin de faire de particulier avant de pouvoir envoyer.
</p>

<?php h2('Envoyer et recevoir des données') ?>
<p>
    L'envoi et la réception de données est similaire pour les deux types de sockets. La seule différence est que UDP aura deux paramètres supplémentaires : l'adresse et le port
    de l'expéditeur / du destinataire. Il existe deux functions distinctes pour chacune de ces opérations : la fonction "bas-niveau", qui envoient/reçoivent un tableau
    brut d'octets, et la fonction plus haut-niveau, qui utilise la classe <?php class_link('Packet') ?>. Vous pouvez aller jeter un oeil au
    <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">tutoriel sur les paquets</a> pour plus de détails concernant cette classe ; ici nous
    ne détaillerons donc que les fonctions bas-niveau.
</p>
<p>
    Pour envoyer des données, vous devez appeler la fonction <code>send</code> avec un pointeur sur les données, et le nombre d'octets à envoyer.
</p>
<pre><code class="cpp">char data[100] = ...;

// socket TCP:
if (socket.send(data, 100) != sf::Socket::Done)
{
    // erreur...
}

// socket UDP:
sf::IpAddress recipient = "192.168.0.5";
unsigned short port = 54000;
if (socket.send(data, 100, recipient, port) != sf::Socket::Done)
{
    // erreur...
}
</code></pre>
<p>
    La fonction <code>send</code> prend les données sous forme d'un <code>void*</code>, vous pouvez donc passer l'adresse de n'importe quoi. Cependant, il est généralement
    déconseillé d'envoyer autre chose qu'un tableau d'octets, car les types natifs plus gros qu'1 octet peuvent ne pas être les mêmes d'une machine à l'autre : les types tels
    que int ou long peuvent avoir une taille différente, et/ou un boutisme (<em>endianness</em>) différent. Ainsi, ces types ne peuvent pas être échangés de manière fiable
    entre différents systèmes. Ce problème est expliqué (et résolu) dans le <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">tutoriel sur
    les paquets</a>.
</p>
<p>
    Avec UDP il est possible d'envoyer un message à tout un sous-réseau en un seul appel : pour cela vous pouvez utiliser l'adresse spéciale <code>sf::IpAddress::Broadcast</code>.
</p>
<p>
    Il y a autre chose à garder en tête avec UDP : étant donné que les données sont envoyées en datagrammes, et que la taille de ces datagrammes possède une limite,
    vous ne pouvez pas dépasser celle-ci. Chaque appel à <code>send</code> doit envoyer moins de <code>sf::UdpSocket::MaxDatagramSize</code> octets -- qui vaut un peu
    moins de 2^16 (65536) octets. 
</p>
<p>
    Pour recevoir des données, vous devez appeler la fonction <code>receive</code> :
</p>
<pre><code class="cpp">char data[100];
std::size_t received;

// socket TCP:
if (socket.receive(data, 100, received) != sf::Socket::Done)
{
    // erreur...
}
std::cout &lt;&lt; "Received " &lt;&lt; received &lt;&lt; " bytes" &lt;&lt; std::endl;

// socket UDP:
sf::IpAddress sender;
unsigned short port;
if (socket.receive(data, 100, received, sender, port) != sf::Socket::Done)
{
    // erreur...
}
std::cout &lt;&lt; "Received " &lt;&lt; received &lt;&lt; " bytes from " &lt;&lt; sender &lt;&lt; " on port " &lt;&lt; port &lt;&lt; std::endl;
</code></pre>
<p>
    Il est important de noter que, si la socket est en mode bloquant, <code>receive</code> va attendre jusqu'à ce que quelque chose ait été reçu, bloquant le thread
    qui l'a appelé (et donc potentiellement le programme tout entier).
</p>
<p>
    Les deux premiers paramètres sont le buffer dans lequel doivent être copiés les octets reçus, et sa taille maximum. Le troisième paramètre est une variable qui sera
    remplie avec le nombre d'octets ayant été reçus.<br/>
    Avec les sockets UDP, les deux derniers paramètres sont remplis avec l'adresse et le port de l'expéditeur ; ils peuvent être utilisés plus tard pour renvoyer une
    réponse.
</p>
<p>
    Ces fonctions sont assez bas niveau, et vous ne devriez les utiliser que si vous avez une bonne raison de le faire. Une approche plus flexible et robuste consiste à
    utiliser les <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">paquets</a>.
</p>

<?php h2('Bloquer sur un groupe de sockets') ?>
<p>
    Bloquer sur chaque socket peut rapidement devenir un problème, car à terme, vous aurez très certainement à gérer plus d'un client à la fois. Et vous ne voulez
    pas que la socket A bloque votre programme alors que la socket B vient de recevoir des données qui pourraient être traitées. Ce que vous aimeriez, c'est bloquer
    sur tout un groupe de sockets en même temps, c'est-à-dire attendre jusqu'à ce que <em>n'importe laquelle d'entre elles</em> ait reçu quelque chose. Ceci est possible
    avec les sélecteurs, représentés par la classe <?php class_link('SocketSelector') ?>.
</p>
<p>
    Un sélecteur peut surveiller tout type de socket : <?php class_link('TcpSocket') ?>, <?php class_link('UdpSocket') ?>, et <?php class_link('TcpListener') ?>. Pour ajouter
    une socket à un sélecteur, utilisez sa fonction <code>add</code> :
</p>
<pre><code class="cpp">sf::TcpSocket socket;

sf::SocketSelector selector;
selector.add(socket);
</code></pre>
<p class="important">
    Un sélecteur n'est pas un conteneur de sockets. Il ne fait que référencer (pointer vers) les sockets que vous lui ajoutez, il ne les stocke pas. Ainsi, vous ne devriez
    pas essayer d'accéder aux sockets que vous mettez dedans ; vous devriez plutôt avoir votre propre stockage de sockets à part (avec par exemple un <code>std::vector</code>
    ou un <code>std::list</code>).
</p>
<p>
    Une fois que vous avez rempli le sélecteur avec toutes les sockets que vous voulez surveiller, vous devez appeler sa fonction <code>wait</code>, afin d'attendre
    jusqu'à ce que l'une d'entre elles ait reçu quelque chose (ou bien ait déclenché une erreur). Vous pouvez aussi passer un timeout optionel, de sorte que la fonction
    échoue si aucune socket n'a rien reçu pendant un certain temps -- cela évite de rester bloqué indéfiniment si rien ne se passe.
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10.f)))
{
    // on a reçu quelque chose
}
else
{
    // temps écoulé, rien n'a été reçu...
}
</code></pre>
<p>
    Si la fonction <code>wait</code> renvoie <code>true</code>, cela signifie qu'une ou plusieurs socket(s) ont reçu quelque chose, et que vous pouvez appeler
    <code>receive</code> sur ces sockets : vous êtes assuré qu'elles ne bloqueront pas. Si la socket est un <?php class_link('TcpListener') ?>, cela signifie qu'une
    connexion entrante est en attente, et que vous pouvez appeler sa fonction <code>accept</code>.
</p>
<p>
    Etant donné que le sélecteur n'est pas un conteneur de sockets, il ne peut pas directement vous retourner les sockets qui sont prêtes à recevoir. Au lieu de cela,
    vous devez tester les candidates une par une avec la fonction <code>isReady</code> :
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10.f)))
{
    // pour chaque socket... &lt;-- pseudo-code, car je ne sais pas comment vous stockez vos sockets :)
    {
        if (selector.isReady(socket))
        {
            // cette socket est prête, on peut recevoir (ou accepter une connexion, si c'est un listener)
            socket.receive(...);
        }
    }
}
</code></pre>
<p>
    Vous pouvez jeter un oeil à la documentation de l'API de la classe <?php class_link('SocketSelector') ?> si vous voulez un exemple complet et fonctionnel de l'utilisation
    d'un sélecteur pour gérer les connections et messages de plusieurs clients.
</p>
<p>
    Petit bonus : le fait que <code>Selector::wait</code> sache gérer un timeout permet d'écrire très facilement une fonction de réception avec timeout, chose qui n'est
    pas directement disponible dans les classes de sockets.
</p>
<pre><code class="cpp">sf::Socket::Status receiveWithTimeout(sf::TcpSocket&amp; socket, sf::Packet&amp; packet, sf::Time timeout)
{
    sf::SocketSelector selector;
    selector.add(socket);
    if (selector.wait(timeout))
        return socket.receive(packet);
    else
        return sf::Socket::NotReady;
}
</code></pre>

<?php h2('Les sockets non-bloquantes') ?>
<p>
    Toutes les sockets sont bloquantes par défaut, mais vous pouvez changer ce comportement à tout moment avec la fonction <code>setBlocking</code>.
</p>
<pre><code class="cpp">sf::TcpSocket tcpSocket;
tcpSocket.setBlocking(false);

sf::TcpListener listenerSocket;
listenerSocket.setBlocking(false);

sf::UdpSocket udpSocket;
udpSocket.setBlocking(false);
</code></pre>
<p>
    Une fois qu'une socket est non-bloquante, ses fonctions rendent toujours la main immédiatement. Par exemple, <code>receive</code> va se terminer en renvoyant le code
    <code>sf::Socket::NotReady</code> s'il n'y a aucune donnée à recevoir. Ou encore, <code>accept</code> va terminer immédiatement, avec le même code de retour, s'il
    n'y a aucune connexion en attente.
</p>
<p>
    Les sockets non-bloquantes sont la solution la plus simple à mettre en oeuvre si vous avez déjà une boucle de jeu qui tourne régulièrement. Vous pouvez de cette manière
    vérifier si quoique ce soit est arrivé sur vos sockets à chaque itération de la boucle principale, sans bloquer l'exécution du programme.
</p>
<p class="important">
    Lorsque vous utilisez <code>sf::TcpSocket</code> en mode non-bloquant, rien ne garantit que les appels à <code>send</code> envoient la totalité des données que vous
    leur passez, qu'il s'agisse de données brutes ou bien de <code>sf::Packet</code>. A partir de SFML 2.3, lorsque vous envoyez des données brutes via une <code>sf::TcpSocket</code>
    non-bloquante, assurez-vous de toujours utiliser la surcharge <code>send(const void* data, std::size_t size, std::size_t&amp; sent)</code>, qui renvoie le nombre
    d'octets réellement envoyés via le paramètre <code>sent</code>. Que ce soit un <code>sf::Packet</code> ou des données brutes, si uniquement une partie des données
    a pu être envoyée lors de l'appel, le code de retour sera <code>sf::Socket::Partial</code> pour indiquer un envoi partiel. <em>Lorsque <code>sf::Socket::Partial</code>
    est renvoyé, vous devez gérer vous-même correctement le reste de l'envoi, sans quoi les données seront susceptibles d'être corrompues.</em> Lorsque vous envoyez
    des données brutes, vous devez essayer à nouveau d'envoyer les données à partir de l'octet auquel l'appel précédent à <code>send</code> s'est arrêté. Lorsque vous
    envoyez un <code>sf::Packet</code>, la position est sauvegardée directement dans celui-ci ; dans ce cas, vous devez juste réessayer d'envoyer <em>exactement
    le même paquet inchangé</em> encore et encore, jusqu'à ce qu'un autre code que <code>sf::Socket::Partial</code> soit renvoyé. Construire une nouvelle instance de
    <code>sf::Packet</code> et la remplir avec les mêmes données ne fonctionnera pas, cela doit impérativement être la même instance qui avait été précédemment envoyée.
</p>

<?php

    require("footer-fr.php");

?>
