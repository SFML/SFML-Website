<?php

    $title = "Utiliser les sockets";
    $page = "network-sockets-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les sockets</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel vous allez apprendre les rudiments de la programmation r�seau � l'aide des
    sockets, et vous serez capables d'�changer des donn�es entre deux ordinateurs distants.
</p>

<?php h2('Qu\'est-ce qu\'un socket ?') ?>
<p>
    Pour les novices de la programmation r�seau, les sockets sont la chose la plus importante �
    conna�tre. A peu pr�s tout (� bas niveau) d�pend des sockets. Un socket peut �tre vu comme un tuyau
    entre deux ordinateurs, et une fois qu'un tel tuyau a �t� �tabli, vous pouvez commencer � �changer
    des donn�es.
</p>
<p>
    Il existe beaucoup de protocoles pour communiquer sur le r�seau, et chaque protocole d�finit
    plusieurs types de sockets. Mais tout ce que vous avez � conna�tre est le protocole internet (IP),
    avec les sockets de type UDP et TCP ; c'est ce que presque tout programme r�seau utilise, et cela
    constitue la base du module r�seau de la SFML.
</p>
<p>
    Les sockets TCP et UDP sont assez diff�rents, voici pourquoi :
</p>
<ul>
    <li>Les sockets TCP assurent que les donn�es arriveront sans erreur et dans le m�me ordre que celui d'envoi</li>
    <li>Les sockets UDP n'offrent absolument aucune garantie de livraison ; les donn�es peuvent �tre perdues, dupliqu�es, ou arriver dans un ordre diff�rent</li>
    <li>Les sockets TCP doivent �tre connect�s ; une fois connect�s, les donn�es � envoyer ou � recevoir auront un destinataire unique</li>
    <li>Les sockets UDP n'ont pas besoin d'�tre connect�s ; vous devez fournir l'adresse du destinataire � chaque envoi ou r�ception</li>
</ul>
<p>
    Pour r�sumer, les sockets TCP sont plus s�rs mais plus lents. Il n'y a que tr�s peu de cas qui n�cessitent
    les sockets UDP : les applications temps-r�el intensives telles que les jeux de shoot/r�le/strat�gie, ou
    encore le <em>broadcasting</em> (envoi de donn�es � tous les ordinateurs d'un sous-r�seau).
</p>

<?php h2('Manipuler les adresses r�seau') ?>
<p>
    Avant de commencer � utiliser les sockets, int�ressons nous � une classe utilitaire du
    module r�seau : <?php class_link("IPAddress")?>. Elle encapsule
    les adresses IP (v4) et fournit des fonctions tr�s utiles pour l'initialisation, la comparaison, etc.
    Etant donn� que la programmation r�seau implique des communications avec des ordinateurs distants,
    vous aurez besoin de cette classe � chaque fois que vous voudrez vous connecter / envoyer / recevoir.
</p>
<p>
    Premi�re chose � faire : inclure le fichier en-t�te pour le module r�seau. Comme d'habitude,
    il va inclure pour vous tous les en-t�tes n�cessaires � l'utilisation du module r�seau.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
</code></pre>
<p>
    Vous pouvez initialiser une instance de <?php class_link("IPAddress")?> � partir de
    diff�rentes sources :
</p>
<pre><code class="cpp">sf::IPAddress Address1;                  // Par d�faut : adresse invalide
sf::IPAddress Address2("192.168.0.1");   // D'une repr�sentation sous forme de cha�ne
sf::IPAddress Address3("computer_name"); // D'un nom d'h�te
sf::IPAddress Address4(192, 168, 0, 1);  // De 4 octets
sf::IPAddress Address5 = sf::IPAddress::LocalHost; // 127.0.0.1 -- votre propre ordinateur
</code></pre>
<p>
    Vous pouvez �galement r�cup�rer votre adresses IP, vue du r�seau local ou d'internet :
</p>
<pre><code class="cpp">// Votre adresse dans le r�seau local (du style 192.168.1.100 -- celle que vous voyez avec ipconfig)
sf::IPAddress Address6 = sf::IPAddress::GetLocalAddress();

// Votre adresse sur internet (du style 83.2.124.68 -- celle que vous voyez sur www.whatismyip.org)
sf::IPAddress Address7 = sf::IPAddress::GetPublicAddress();
</code></pre>
<p>
    Notez bien que <code>GetPublicAddress()</code> est tr�s lente : le seul moyen d'obtenir une
    adresse publique est de la r�cup�rer depuis l'ext�rieur (particuli�rement lorsque vous �tes
    derri�re un proxy ou un pare-feu), ainsi elle se connecte � un site externe (www.whatismyip.org)
    et examine la page web renvoy�e pour en extraire l'adresse IP publique. Donc, utilisez-la avec
    parcimonie.
</p>
<p>
    Vous pouvez obtenir la repr�sentation sous forme de cha�ne (de type "xxx.xxx.xxx.xxx") d'une adresse
    avec sa fonction <code>ToString()</code> :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
std::string IP = Address.ToString();
</code></pre>
<p>
    Vous pouvez �galement v�rifier la validit� d'une adresse avec sa fonction
    <code>IsValid()</code> :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
if (Address.IsValid())
    // Ok, h�te trouv�
else
    // Adresse invalide
</code></pre>

<?php h2('Utiliser un socket UDP') ?>
<p>
    Les sockets UDP ne n�cessitant pas de connexion, ils sont les plus faciles � utiliser. Aucune initialisation
    n'est n�cessaire, tout ce que vous avez � faire c'est envoyer et recevoir des donn�es. La seule �tape n�cessaire
    est de lier le socket � un port avant de pouvoir recevoir des donn�es � travers celui-ci.
</p>
<p>
    Les sockets SFML permettent d'envoyer des donn�es brutes, d�finies par un pointeur vers
    un tableau d'octets et sa taille.
</p>
<pre><code class="cpp">// Cr�ation du socket UDP
sf::SocketUDP Socket;

// Cr�ation du tableau d'octets � envoyer
char Buffer[] = "Hi guys !";

// Envoi des donn�es � l'adresse "192.168.0.2" sur le port 4567
if (Socket.Send(Buffer, sizeof(Buffer), "192.168.0.2", 4567) != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<p>
    Ici, nous envoyons un tableau d'octets (contenant "Hi guys !") � l'ordinateur dont l'adresse IP est
    192.168.0.2 sur le port 4567. Le troisi�me param�tre est un <?php class_link("IPAddress")?>,
    vous pouvez donc tout aussi bien utiliser un nom d'h�te, une adresse de broadcast ou n'importe
    quel type d'adresse valide.<br/>
    Si vous ne voulez pas utiliser un port sp�cifique, vous pouvez simplement prendre n'importe quel
    num�ro de port libre entre 1024 et 65535 (les ports inf�rieurs � 1024 sont r�serv�s). Et bien s�r,
    assurez-vous que votre pare-feu ne bloque pas ce port !
</p>
<p>
    La fonction <code>Send</code>, tout comme les autres fonctions qui peuvent bloquer,
   renvoie un �tat de socket (voir <code>sf::Socket::Status</code>) qui peut �tre :
</p>
<ul>
    <li><code>sf::Socket::Done</code> : l'op�ration a �t� termin�e avec succ�s</li>
    <li><code>sf::Socket::NotReady</code> : en mode non-bloquant uniquement, signifie que la socket n'est pas encore pr�te � compl�ter la t�che</li>
    <li><code>sf::Socket::Disconnected</code> : la socket a �t� d�connect�e</li>
    <li><code>sf::Socket::Error</code> : une erreur inattendue est survenue</li>
</ul>
<p>
    La r�ception de donn�es fonctionne exactement de la m�me mani�re, except� que vous devez d'abord lier
    le socket au port que vous souhaitez �couter.
</p>
<pre><code class="cpp">// Cr�ation du socket UDP
sf::SocketUDP Socket;

// On le lit au port 4567
if (!Socket.Bind(4567))
{
    // Erreur...
}
</code></pre>
<p>
    Puis vous pouvez recevoir un tableau d'octets, sa taille ainsi que l'adresse et le port de l'exp�diteur.
</p>
<pre><code class="cpp">char Buffer[128];
std::size_t Received;
sf::IPAddress Sender;
unsigned short Port;
if (Socket.Receive(Buffer, sizeof(Buffer), Received, Sender, Port) != sf::Socket::Done)
{
    // Error...
}

// On affiche l'adresse et le port de l'exp�diteur
std::cout &lt;&lt; Sender &lt;&lt; ":" &lt;&lt; Port &lt;&lt; std::endl;

// On affiche le message re�u
std::cout &lt;&lt; Buffer &lt;&lt; std::endl; // "Hi guys !"
</code></pre>
<p>
    Notez bien que <code>Receive</code> est bloquante, ce qui signifie qu'elle ne
    rendra la main que lorsqu'elle aura re�u quelque chose si la socket est en mode bloquant (qui est le mode par d�faut).
</p>

<p>
    Lorsque vous n'avez plus besoin du socket, vous devez le fermer (le destructeur ne le fera pas pour
    vous !) :
</p>
<pre><code class="cpp">Socket.Close();
</code></pre>

<?php h2('Utiliser un socket TCP') ?>
<p>
    Les sockets TCP doivent �tre connect�s avant de pouvoir envoyer ou recevoir quoique ce soit. Voici
    comment �a marche :
</p>
<p>
    Premi�rement, vous ouvrez un socket et vous le faites �couter le port choisi.
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
    La fonction <code>Accept</code> va attendre jusqu'� ce qu'une connexion arrive,
    puis renvoyer un nouveau socket qui sera utilis� pour �changer les donn�es avec l'ordinateur
    connect�. Si vous passez une instance de <?php class_link("IPAddress")?> � la fonction,
    celle-ci sera initialis�e avec l'adresse du client (pratique pour savoir qui vient de se connecter).<br/>
    Si la socket est en mode non-bloquant, cette fonction rendra la main imm�diatement si aucune connexion n'est en attente,
    et renverra le code <code>sf::Socket::NotReady</code>.
</p>
<p>
    Regardons maintenant comment �a se passe du c�t� du client. Tout ce que vous avez � faire est cr�er
    un socket puis le connecter au serveur sur le port que ce dernier �coute.
</p>
<pre><code class="cpp">sf::SocketTCP Client;
if (Client.Connect(4567, "192.168.0.2") != sf::Socket::Done)
{
    // Erreur...
}
</code></pre>
<p>
    Maintenant, le client et le serveur sont pr�ts � communiquer. Les fonctions pour
    envoyer et recevoir des donn�es sont les m�mes que pour les sockets UDP, except� que vous n'avez plus
    besoin de sp�cifier le port et l'adresse du destinataire. Donc en gros, les seuls param�tres requis
    sont le tableau � envoyer / recevoir ainsi que sa taille.
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
    renvoyer <code>sf::Socket::Disconnected</code>, qui signifie que la connexion a �t� interrompue.
</p>
<p>
    Comme pour les sockets UDP, n'oubliez pas de fermer le socket lorsque vous avez fini.
</p>

<?php h2('Conclusion') ?>
<p>
    La SFML fournit un ensemble de classes bas niveau mais facile � utiliser pour �changer des
    donn�es via le r�seau. Mais n'oubliez pas que la programmation r�seau n'est pas simple, et vous
    devrez utiliser des algorithmes et des structures de donn�es efficaces pour construire des
    programmes robustes et rapides. Je vous recommande de lire quelques bons tutoriels concernant
    la programmation r�seau (pas sur les sockets, mais plut�t les techniques et algorithmes g�n�raux),
    particuli�rement si vous d�butez en programmation r�seau.
</p>
<p>
    Dans le <a class="internal" href="./network-packets-fr.php" title="Prochain tutoriel">prochain tutoriel</a>,
    nous d�taillerons une autre classe utilitaire qui permet de manipuler plus facilement les donn�es
    � travers le r�seau.
</p>

<?php

    require("footer-fr.php");

?>
