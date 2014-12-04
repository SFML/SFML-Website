<?php

    $title = "Utiliser les sockets";
    $page = "network-sockets-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les sockets</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel vous allez apprendre les rudiments de la programmation réseau à l'aide des
    sockets, et vous serez capables d'échanger des données entre deux ordinateurs distants.
</p>

<?php h2('Qu\'est-ce qu\'un socket ?') ?>
<p>
    Pour les novices de la programmation réseau, les sockets sont la chose la plus importante à
    connaître. A peu près tout (à bas niveau) dépend des sockets. Un socket peut être vu comme un tuyau
    entre deux ordinateurs, et une fois qu'un tel tuyau a été établi, vous pouvez commencer à échanger
    des données.
</p>
<p>
    Il existe beaucoup de protocoles pour communiquer sur le réseau, et chaque protocole définit
    plusieurs types de sockets. Mais tout ce que vous avez à connaître est le protocole internet (IP),
    avec les sockets de type UDP et TCP ; c'est ce que presque tout programme réseau utilise, et cela
    constitue la base du module réseau de la SFML.
</p>
<p>
    Les sockets TCP et UDP sont assez différents, voici pourquoi :
</p>
<ul>
    <li>Les sockets TCP assurent que les données arriveront sans erreur et dans le même ordre que celui d'envoi</li>
    <li>Les sockets UDP n'offrent absolument aucune garantie de livraison ; les données peuvent être perdues, dupliquées, ou arriver dans un ordre différent</li>
    <li>Les sockets TCP doivent être connectés ; une fois connectés, les données à envoyer ou à recevoir auront un destinataire unique</li>
    <li>Les sockets UDP n'ont pas besoin d'être connectés ; vous devez fournir l'adresse du destinataire à chaque envoi ou réception</li>
</ul>
<p>
    Pour résumer, les sockets TCP sont plus sûrs mais plus lents. Il n'y a que très peu de cas qui nécessitent
    les sockets UDP : les applications temps-réel intensives telles que les jeux de shoot/rôle/stratégie, ou
    encore le <em>broadcasting</em> (envoi de données à tous les ordinateurs d'un sous-réseau).
</p>

<?php h2('Manipuler les adresses réseau') ?>
<p>
    Avant de commencer à utiliser les sockets, intéressons nous à une classe utilitaire du
    module réseau : <?php class_link("IPAddress")?>. Elle encapsule
    les adresses IP (v4) et fournit des fonctions très utiles pour l'initialisation, la comparaison, etc.
    Etant donné que la programmation réseau implique des communications avec des ordinateurs distants,
    vous aurez besoin de cette classe à chaque fois que vous voudrez vous connecter / envoyer / recevoir.
</p>
<p>
    Première chose à faire : inclure le fichier en-tête pour le module réseau. Comme d'habitude,
    il va inclure pour vous tous les en-têtes nécessaires à l'utilisation du module réseau.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
</code></pre>
<p>
    Vous pouvez initialiser une instance de <?php class_link("IPAddress")?> à partir de
    différentes sources :
</p>
<pre><code class="cpp">sf::IPAddress Address1;                  // Par défaut : adresse invalide
sf::IPAddress Address2("192.168.0.1");   // D'une représentation sous forme de chaîne
sf::IPAddress Address3("computer_name"); // D'un nom d'hôte
sf::IPAddress Address4(192, 168, 0, 1);  // De 4 octets
sf::IPAddress Address5 = sf::IPAddress::LocalHost; // 127.0.0.1 -- votre propre ordinateur
</code></pre>
<p>
    Vous pouvez également récupérer votre adresses IP, vue du réseau local ou d'internet :
</p>
<pre><code class="cpp">// Votre adresse dans le réseau local (du style 192.168.1.100 -- celle que vous voyez avec ipconfig)
sf::IPAddress Address6 = sf::IPAddress::GetLocalAddress();

// Votre adresse sur internet (du style 83.2.124.68 -- celle que vous voyez sur www.whatismyip.org)
sf::IPAddress Address7 = sf::IPAddress::GetPublicAddress();
</code></pre>
<p>
    Notez bien que <code>GetPublicAddress()</code> est très lente : le seul moyen d'obtenir une
    adresse publique est de la récupérer depuis l'extérieur (particulièrement lorsque vous êtes
    derrière un proxy ou un pare-feu), ainsi elle se connecte à un site externe (www.whatismyip.org)
    et examine la page web renvoyée pour en extraire l'adresse IP publique. Donc, utilisez-la avec
    parcimonie.
</p>
<p>
    Vous pouvez obtenir la représentation sous forme de chaîne (de type "xxx.xxx.xxx.xxx") d'une adresse
    avec sa fonction <code>ToString()</code> :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
std::string IP = Address.ToString();
</code></pre>
<p>
    Vous pouvez également vérifier la validité d'une adresse avec sa fonction
    <code>IsValid()</code> :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
if (Address.IsValid())
    // Ok, hôte trouvé
else
    // Adresse invalide
</code></pre>

<?php h2('Utiliser un socket UDP') ?>
<p>
    Les sockets UDP ne nécessitant pas de connexion, ils sont les plus faciles à utiliser. Aucune initialisation
    n'est nécessaire, tout ce que vous avez à faire c'est envoyer et recevoir des données. La seule étape nécessaire
    est de lier le socket à un port avant de pouvoir recevoir des données à travers celui-ci.
</p>
<p>
    Les sockets SFML permettent d'envoyer des données brutes, définies par un pointeur vers
    un tableau d'octets et sa taille.
</p>
<pre><code class="cpp">// Création du socket UDP
sf::SocketUDP Socket;

// Création du tableau d'octets à envoyer
char Buffer[] = "Hi guys !";

// Envoi des données à l'adresse "192.168.0.2" sur le port 4567
if (Socket.Send(Buffer, sizeof(Buffer), "192.168.0.2", 4567) != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<p>
    Ici, nous envoyons un tableau d'octets (contenant "Hi guys !") à l'ordinateur dont l'adresse IP est
    192.168.0.2 sur le port 4567. Le troisième paramètre est un <?php class_link("IPAddress")?>,
    vous pouvez donc tout aussi bien utiliser un nom d'hôte, une adresse de broadcast ou n'importe
    quel type d'adresse valide.<br/>
    Si vous ne voulez pas utiliser un port spécifique, vous pouvez simplement prendre n'importe quel
    numéro de port libre entre 1024 et 65535 (les ports inférieurs à 1024 sont réservés). Et bien sûr,
    assurez-vous que votre pare-feu ne bloque pas ce port !
</p>
<p>
    La fonction <code>Send</code>, tout comme les autres fonctions qui peuvent bloquer,
   renvoie un état de socket (voir <code>sf::Socket::Status</code>) qui peut être :
</p>
<ul>
    <li><code>sf::Socket::Done</code> : l'opération a été terminée avec succès</li>
    <li><code>sf::Socket::NotReady</code> : en mode non-bloquant uniquement, signifie que la socket n'est pas encore prête à compléter la tâche</li>
    <li><code>sf::Socket::Disconnected</code> : la socket a été déconnectée</li>
    <li><code>sf::Socket::Error</code> : une erreur inattendue est survenue</li>
</ul>
<p>
    La réception de données fonctionne exactement de la même manière, excepté que vous devez d'abord lier
    le socket au port que vous souhaitez écouter.
</p>
<pre><code class="cpp">// Création du socket UDP
sf::SocketUDP Socket;

// On le lit au port 4567
if (!Socket.Bind(4567))
{
    // Erreur...
}
</code></pre>
<p>
    Puis vous pouvez recevoir un tableau d'octets, sa taille ainsi que l'adresse et le port de l'expéditeur.
</p>
<pre><code class="cpp">char Buffer[128];
std::size_t Received;
sf::IPAddress Sender;
unsigned short Port;
if (Socket.Receive(Buffer, sizeof(Buffer), Received, Sender, Port) != sf::Socket::Done)
{
    // Error...
}

// On affiche l'adresse et le port de l'expéditeur
std::cout &lt;&lt; Sender &lt;&lt; ":" &lt;&lt; Port &lt;&lt; std::endl;

// On affiche le message reçu
std::cout &lt;&lt; Buffer &lt;&lt; std::endl; // "Hi guys !"
</code></pre>
<p>
    Notez bien que <code>Receive</code> est bloquante, ce qui signifie qu'elle ne
    rendra la main que lorsqu'elle aura reçu quelque chose si la socket est en mode bloquant (qui est le mode par défaut).
</p>

<p>
    Lorsque vous n'avez plus besoin du socket, vous devez le fermer (le destructeur ne le fera pas pour
    vous !) :
</p>
<pre><code class="cpp">Socket.Close();
</code></pre>

<?php h2('Utiliser un socket TCP') ?>
<p>
    Les sockets TCP doivent être connectés avant de pouvoir envoyer ou recevoir quoique ce soit. Voici
    comment ça marche :
</p>
<p>
    Premièrement, vous ouvrez un socket et vous le faites écouter le port choisi.
</p>
<pre><code class="cpp">sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Erreur...
}
</code></pre>
<p>
    Puis, vous pouvez attendre les connexions sur ce port.
</p>
<pre><code class="cpp">sf::IPAddress ClientAddress;
sf::SocketTCP Client;
if (Listener.Accept(Client, &amp;ClientAddress) != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<p>
    La fonction <code>Accept</code> va attendre jusqu'à ce qu'une connexion arrive,
    puis renvoyer un nouveau socket qui sera utilisé pour échanger les données avec l'ordinateur
    connecté. Si vous passez une instance de <?php class_link("IPAddress")?> à la fonction,
    celle-ci sera initialisée avec l'adresse du client (pratique pour savoir qui vient de se connecter).<br/>
    Si la socket est en mode non-bloquant, cette fonction rendra la main immédiatement si aucune connexion n'est en attente,
    et renverra le code <code>sf::Socket::NotReady</code>.
</p>
<p>
    Regardons maintenant comment ça se passe du côté du client. Tout ce que vous avez à faire est créer
    un socket puis le connecter au serveur sur le port que ce dernier écoute.
</p>
<pre><code class="cpp">sf::SocketTCP Client;
if (Client.Connect(4567, "192.168.0.2") != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<p>
    Maintenant, le client et le serveur sont prêts à communiquer. Les fonctions pour
    envoyer et recevoir des données sont les mêmes que pour les sockets UDP, excepté que vous n'avez plus
    besoin de spécifier le port et l'adresse du destinataire. Donc en gros, les seuls paramètres requis
    sont le tableau à envoyer / recevoir ainsi que sa taille.
</p>
<pre><code class="cpp">char Buffer[] = "Hi guys !";
if (Client.Send(Buffer, sizeof(Buffer)) != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<pre><code class="cpp">char Buffer[128];
std::size_t Received;
if (Client.Receive(Buffer, sizeof(Buffer), Received) != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>

<p>
    Pour les sockets TCP, les fonctions <code>Send</code> et <code>Receive</code> peuvent
    renvoyer <code>sf::Socket::Disconnected</code>, qui signifie que la connexion a été interrompue.
</p>
<p>
    Comme pour les sockets UDP, n'oubliez pas de fermer le socket lorsque vous avez fini.
</p>

<?php h2('Conclusion') ?>
<p>
    La SFML fournit un ensemble de classes bas niveau mais facile à utiliser pour échanger des
    données via le réseau. Mais n'oubliez pas que la programmation réseau n'est pas simple, et vous
    devrez utiliser des algorithmes et des structures de données efficaces pour construire des
    programmes robustes et rapides. Je vous recommande de lire quelques bons tutoriels concernant
    la programmation réseau (pas sur les sockets, mais plutôt les techniques et algorithmes généraux),
    particulièrement si vous débutez en programmation réseau.
</p>
<p>
    Dans le <a class="internal" href="./network-packets-fr.php" title="Prochain tutoriel">prochain tutoriel</a>,
    nous détaillerons une autre classe utilitaire qui permet de manipuler plus facilement les données
    à travers le réseau.
</p>

<?php

    require("footer-fr.php");

?>
