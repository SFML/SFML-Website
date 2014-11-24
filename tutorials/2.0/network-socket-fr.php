<?php

    $title = "Communiquer avec les sockets";
    $page = "network-socket-fr.php";

    require("header-fr.php");

?>

<h1>Communiquer avec les sockets</h1>

<?php h2('Les sockets') ?>
<p>
    Une socket est une porte entre votre application et le monde ext�rieur : � travers une socket, vous pouvez envoyer et recevoir des donn�es. Ainsi, � peu pr�s tout programme
    r�seau aura affaire � des sockets, elles sont l'�l�ment central de la communication r�seau.
</p>
<p>
    Il existe plusieurs types de sockets, qui fournissent chacun des fonctionnalit�s sp�cifiques. SFML impl�mente les types les plus courants : les sockets TCP et les sockets
    UDP.
</p>

<?php h2('TCP vs UDP') ?>
<p>
    Il est important de savoir ce que peuvent faire les sockets TCP et UDP, et ce qu'elles ne peuvent pas faire, de mani�re � pouvoir choisir le type qui correspond aux
    besoins de votre application.
</p>
<p>
    La principale diff�rence est que les sockets TCP sont connect�es. Vous ne pouvez ni recevoir ni envoyer de donn�es avant d'avoir explicitement connect� la socket � une
    autre socket, sur la machine distante. Une fois connect�e, une socket TCP peut uniquement envoyer et recevoir vers/depuis la socket � laquelle elle est connect�e. Vous
    aurez donc besoin d'une socket TCP pour chaque client dans votre application.<br/>
    Les sockets UDP par contre ne sont pas connect�es, vous pouvez envoyer et recevoir vers/depuis n'importe qui � n'importe quel moment avec la m�me socket.
</p>
<p>
    Deuxi�me diff�rence : TCP est plus fiable que UDP. TCP garantit que ce que vous envoyez est toujours re�u, sans perte ni corruption, et toujours dans le bon ordre. UDP
    effectue moins de v�rifications, et fournit un niveau de robustesse moindre : ce que vous envoyez peut arriver dupliqu�, d�sordonn�, voire m�me �tre perdu et ne jamais
    atteindre l'ordinateur distant. Cependant, les donn�es qui sont re�ues sont toujours valides (elles ne peuvent pas �tre corrompues).<br/>
    UDP peut avoir l'air effrayant apr�s une telle description, mais gardez en t�te que <em>la plupart du temps</em>, les donn�es arrivent � destination et dans le bon ordre.
</p>
<p>
    La troisi�me diff�rence est une cons�quence directe de la seconde : UDP est plus rapide et plus l�ger que TCP. Il a moins de contraintes, donc il utilise moins de
    ressources.
</p>
<p>
    La derni�re diff�rence concerne la mani�re dont sont transport�es les donn�es. TCP est un protocole en <em>flux</em> : il n'y a pas de limite de message, si vous envoyez
    "Hello" puis "SFML", la machine distante peut tr�s bien recevoir "HelloSFML", "Hel" + "loSFML", ou bien encore "He" + "loS" + "FML". Le protocole est libre de
    rassembler et/ou d�couper les donn�es comme bon lui semble.<br/>
    UDP est un protocole de <em>datagrammes</em>. Les datagrammes sont des paquets de donn�es, qui ne peuvent pas se m�langer. Si vous recevez un datagramme UDP, alors
    vous �tes garantis d'avoir les donn�es exactement telles qu'elles ont �t� envoy�es, ni plus ni moins. Donc pour r�sumer, UDP n'offre aucune garantie sur l'arriv�e des
    datagrammes, mais lorsqu'ils arrivent, leur contenu est forc�ment tel qu'il a �t� envoy�.
</p>
<p>
    Oh, et une derni�re chose : puisqu'UDP n'est pas connect�, il permet de diffuser des messages � de multiples destinataires, voire m�me � un r�seau tout entier. La
    communication 1-1 des sockets TCP ne le permet pas.
</p>

<?php h2('Connecter une socket TCP') ?>
<p>
    Comme vous pouvez le deviner, cette partie concerne uniquement les sockets TCP. Il y a deux facettes � une connexion : d'un c�t�, celui qui attend la connexion entrante
    (appelons-le le serveur), et de l'autre, celui qui initie la connexion (appelons-le le client).
</p>
<p>
    C�t� client, les choses sont relativement simples : l'utilisateur doit just avoir un <?php class_link('TcpSocket') ?> et appeler sa fonction <code>connect</code>
    afin de d�clencher la connexion.
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
    Le premier param�tre est l'adresse de l'h�te auquel se connecter. C'est un param�tre de type <?php class_link('IpAddress') ?>, qui peut repr�senter tout type d'adresse :
    une URL, une adresse IP, ou un nom d'h�te r�seau. Vous pouvez jeter un oeil � la documentation pour plus de d�tails concernant cette classe.
</p>
<p>
    Le deuxi�me param�tre est le port auquel se connecter sur la machine distante. La connection ne pourra fonctionner que si le serveur est en train d'attendre une connexion
    sur ce port.
</p>
<p>
    Il y a un troisi�me param�tre, optionnel, qui est un timeout. S'il est renseign�, et que la connexion n'aboutit pas avant qu'il soit �coul�, la connexion �choue et
    la fonction renvoie une erreur. Si ce param�tre n'est pas renseign�, le timeout par d�faut de l'OS est utilis�.
</p>
<p>
    Une fois connect�, vous pouvez r�cup�rer l'adresse et le port de la machine distante si n�cessaire, avec les fonctions <code>getRemoteAddress()</code> et
    <code>getRemotePort()</code>.
</p>
<p class="important">
    Toutes les fonctions des classes de sockets sont bloquantes par d�faut. Cela signifie que votre programme (ou du moins le thread qui contient l'appel) sera bloqu�
    jusqu'� ce que l'action correspondante se termine. C'est tr�s important car certaines fonctions peuvent prendre un temps consid�rable : par exemple, se connecter �
    un h�te qui ne r�pond pas peut durer plusieurs secondes, ou encore, recevoir ne va pas rendre la main tant que quelque chose n'a pas effectivement �t� �t� re�u, etc.<br/>
    Vous pouvez modifier ce comportement et rendre toutes les fonctions non-bloquantes, avec la fonction <code>setBlocking</code> de la socket. Voyez plus bas pour plus
    de d�tails.
</p>
<p>
    C�t� serveur, il y a un peu plus de choses � faire. Plusieurs sockets sont n�cessaires : une qui �coute les connections entrantes, puis une pour chaque client connect�.
</p>
<p>
    Pour �couter les connexions, vous devez utiliser la classe sp�ciale <?php class_link('TcpListener') ?>. Son unique but est d'attendre des connexions sur un port donn�,
    elle ne peut pas envoyer ou recevoir de donn�es.
</p>
<pre><code class="cpp">sf::TcpListener listener;

// lie l'�couteur � un port
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

// utilisez la socket "client" pour communiquer avec le client connect�,
// et continuez � attendre de nouvelles connexions avec l'�couteur
</code></pre>
<p>
    La fonction <code>accept</code> bloque jusqu'� ce qu'une connexion arrive (� moins que la socket ne soit pass�e en mode non-bloquant). Lorsque cela arrive, la fonction
    initialise la socket qu'elle a re�u en param�tre puis rend la main ; cette socket peut d�sormais �tre utilis�e pour communiquer avec le client, et l'�couteur peut
    recommencer � attendre une nouvelle connexion.
</p>
<p>
    Apr�s un appel r�ussi � <code>connect</code> (c�t� client) et <code>accept</code> (c�t� serveur), la communication est �tablie et les deux sockets sont pr�tes �
    �changer des donn�es.
</p>

<?php h2('Lier une socket UDP � un port') ?>
<p>
    Une socket UDP n'est pas connect�e, mais vous devrez tout de m�me la lier � un port afin de pouvoir recevoir des donn�es sur ce port. Une socket UDP ne peut en effet pas
    recevoir tout ce qui arrive sur tous les ports.
</p>
<pre><code class="cpp">sf::UdpSocket socket;

// lie la socket � un port
if (socket.bind(54000) != sf::Socket::Done)
{
    // erreur...
}
</code></pre>
<p>
    Apr�s avoir li� la socket � un port, elle est pr�te a recevoir des donn�es sur ce port. Si vous souhaitez que l'OS choisisse automatiquement un port libre, vous pouvez
    passer <code>sf::Socket::AnyPort</code>, puis r�cup�rer le port choisi avec <code>socket.getLocalPort()</code>.
</p>
<p>
    Les sockets UDP qui envoient des donn�es n'ont rien besoin de faire de particulier avant de pouvoir envoyer.
</p>

<?php h2('Envoyer et recevoir des donn�es') ?>
<p>
    L'envoi et la r�ception de donn�es est similaire pour les deux types de sockets. La seule diff�rence est que UDP aura deux param�tres suppl�mentaires : l'adresse et le port
    de l'exp�diteur / du destinataire. Il existe deux functions distinctes pour chacune de ces op�rations : la fonction "bas-niveau", qui envoient/re�oivent un tableau
    brut d'octets, et la fonction plus haut-niveau, qui utilise la classe <?php class_link('Packet') ?>. Vous pouvez aller jeter un oeil au
    <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">tutoriel sur les paquets</a> pour plus de d�tails concernant cette classe ; ici nous
    ne d�taillerons donc que les fonctions bas-niveau.
</p>
<p>
    Pour envoyer des donn�es, vous devez appeler la fonction <code>send</code> avec un pointeur sur les donn�es, et le nombre d'octets � envoyer.
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
    La fonction <code>send</code> prend les donn�es sous forme d'un <code>void*</code>, vous pouvez donc passer l'adresse de n'importe quoi. Cependant, il est g�n�ralement
    d�conseill� d'envoyer autre chose qu'un tableau d'octets, car les types natifs plus gros qu'1 octet peuvent ne pas �tre les m�mes d'une machine � l'autre : les types tels
    que int ou long peuvent avoir une taille diff�rente, et/ou un boutisme (<em>endianness</em>) diff�rent. Ainsi, ces types ne peuvent pas �tre �chang�s de mani�re fiable
    entre diff�rents syst�mes. Ce probl�me est expliqu� (et r�solu) dans le <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">tutoriel sur
    les paquets</a>.
</p>
<p>
    Avec UDP il est possible d'envoyer un message � tout un sous-r�seau en un seul appel : pour cela vous pouvez utiliser l'adresse sp�ciale <code>sf::IpAddress::Broadcast</code>.
</p>
<p>
    Il y a autre chose � garder en t�te avec UDP : �tant donn� que les donn�es sont envoy�es en datagrammes, et que la taille de ces datagrammes poss�de une limite,
    vous ne pouvez pas d�passer celle-ci. Chaque appel � <code>send</code> doit envoyer moins de <code>sf::UdpSocket::MaxDatagramSize</code> octets -- qui vaut un peu
    moins de 2^16 (65536) octets. 
</p>
<p>
    Pour recevoir des donn�es, vous devez appeler la fonction <code>receive</code> :
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
    Il est important de noter que, si la socket est en mode bloquant, <code>receive</code> va attendre jusqu'� ce que quelque chose ait �t� re�u, bloquant le thread
    qui l'a appel� (et donc potentiellement le programme tout entier).
</p>
<p>
    Les deux premiers param�tres sont le buffer dans lequel doivent �tre copi�s les octets re�us, et sa taille maximum. Le troisi�me param�tre est une variable qui sera
    remplie avec le nombre d'octets ayant �t� re�us.<br/>
    Avec les sockets UDP, les deux derniers param�tres sont remplis avec l'adresse et le port de l'exp�diteur ; ils peuvent �tre utilis�s plus tard pour renvoyer une
    r�ponse.
</p>
<p>
    Ces fonctions sont assez bas niveau, et vous ne devriez les utiliser que si vous avez une bonne raison de le faire. Une approche plus flexible et robuste consiste �
    utiliser les <a class="internal" href="./network-packet-fr.php" title="Tutoriel sur les paquets">paquets</a>.
</p>

<?php h2('Bloquer sur un groupe de sockets') ?>
<p>
    Bloquer sur chaque socket peut rapidement devenir un probl�me, car � terme, vous aurez tr�s certainement � g�rer plus d'un client � la fois. Et vous ne voulez
    pas que la socket A bloque votre programme alors que la socket B vient de recevoir des donn�es qui pourraient �tre trait�es. Ce que vous aimeriez, c'est bloquer
    sur tout un groupe de sockets en m�me temps, c'est-�-dire attendre jusqu'� ce que <em>n'importe laquelle d'entre elles</em> ait re�u quelque chose. Ceci est possible
    avec les s�lecteurs, repr�sent�s par la classe <?php class_link('SocketSelector') ?>.
</p>
<p>
    Un s�lecteur peut surveiller tout type de socket : <?php class_link('TcpSocket') ?>, <?php class_link('UdpSocket') ?>, et <?php class_link('TcpListener') ?>. Pour ajouter
    une socket � un s�lecteur, utilisez sa fonction <code>add</code> :
</p>
<pre><code class="cpp">sf::TcpSocket socket;

sf::SocketSelector selector;
selector.add(socket);
</code></pre>
<p class="important">
    Un s�lecteur n'est pas un conteneur de sockets. Il ne fait que r�f�rencer (pointer vers) les sockets que vous lui ajoutez, il ne les stocke pas. Ainsi, vous ne devriez
    pas essayer d'acc�der aux sockets que vous mettez dedans ; vous devriez plut�t avoir votre propre stockage de sockets � part (avec par exemple un <code>std::vector</code>
    ou un <code>std::list</code>).
</p>
<p>
    Une fois que vous avez rempli le s�lecteur avec toutes les sockets que vous voulez surveiller, vous devez appeler sa fonction <code>wait</code>, afin d'attendre
    jusqu'� ce que l'une d'entre elles ait re�u quelque chose (ou bien ait d�clench� une erreur). Vous pouvez aussi passer un timeout optionel, de sorte que la fonction
    �choue si aucune socket n'a rien re�u pendant un certain temps -- cela �vite de rester bloqu� ind�finiment si rien ne se passe.
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10)))
{
    // on a re�u quelque chose
}
else
{
    // temps �coul�, rien n'a �t� re�u...
}
</code></pre>
<p>
    Si la fonction <code>wait</code> renvoie <code>true</code>, cela signifie qu'une ou plusieurs socket(s) ont re�u quelque chose, et que vous pouvez appeler
    <code>receive</code> sur ces sockets : vous �tes assur� qu'elles ne bloqueront pas. Si la socket est un <?php class_link('TcpListener') ?>, cela signifie qu'une
    connexion entrante est en attente, et que vous pouvez appeler sa fonction <code>accept</code>.
</p>
<p>
    Etant donn� que le s�lecteur n'est pas un conteneur de sockets, il ne peut pas directement vous retourner les sockets qui sont pr�tes � recevoir. Au lieu de cela,
    vous devez tester les candidates une par une avec la fonction <code>isReady</code> :
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10)))
{
    // pour chaque socket... &lt;-- pseudo-code, car je ne sais pas comment vous stockez vos sockets :)
    {
        if (selector.isReady(socket))
        {
            // cette socket est pr�te, on peut recevoir (ou accepter une connexion, si c'est un listener)
            socket.receive(...);
        }
    }
}
</code></pre>
<p>
    Vous pouvez jeter un oeil � la documentation de l'API de la classe <?php class_link('SocketSelector') ?> si vous voulez un exemple complet et fonctionnel de l'utilisation
    d'un s�lecteur pour g�rer les connections et messages de plusieurs clients.
</p>
<p>
    Petit bonus : le fait que <code>Selector::wait</code> sache g�rer un timeout permet d'�crire tr�s facilement une fonction de r�ception avec timeout, chose qui n'est
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
    Toutes les sockets sont bloquantes par d�faut, mais vous pouvez changer ce comportement � tout moment avec la fonction <code>setBlocking</code>.
</p>
<pre><code class="cpp">sf::TcpSocket tcpSocket;
tcpSocket.setBlocking(false);

sf::TcpListener listenerSocket;
listenerSocket.setBlocking(false);

sf::UdpSocket udpSocket;
udpSocket.setBlocking(false);
</code></pre>
<p>
    Une fois qu'une socket est non-bloquante, ses fonctions rendent toujours la main imm�diatement. Par exemple, <code>receive</code> va se terminer en renvoyant le code
    <code>sf::Socket::NotReady</code> s'il n'y a aucune donn�e � recevoir. Ou encore, <code>accept</code> va terminer imm�diatement, avec le m�me code de retour, s'il
    n'y a aucune connexion en attente.
</p>
<p>
    Les sockets non-bloquantes sont la solution la plus simple � mettre en oeuvre si vous avez d�j� une boucle de jeu qui tourne r�guli�rement. Vous pouvez de cette mani�re
    v�rifier si quoique ce soit est arriv� sur vos sockets � chaque it�ration de la boucle principale, sans bloquer l'ex�cution du programme.
</p>

<?php

    require("footer-fr.php");

?>
