<?php

    $title = "Utiliser et étendre les paquets";
    $page = "network-packets-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser et étendre les paquets</h1>

<?php h2('Introduction') ?>
<p>
    L'échange de données par le réseau peut être plus compliqué qu'il n'y paraît. Tout peut sembler facile
    tant que vous testez votre application avec votre propre ordinateur en tant que client et serveur,
    mais lorsque vous commencez à transiter par internet et sur différentes plateformes, beaucoup
    de problèmes peuvent apparaître.
</p>
<p>
    Le premier est le boutisme (<em>endianess</em>). Le boutisme est l'ordre dans lequel une plateforme
    particulière va stocker les octets d'un type primitif. Il existe deux familles principales de
    plateformes : celles utilisant le grand-boutisme (<em>big-endian</em> -- stockent l'octet
    de poids fort en premier) et celles utilisant le petit-boutisme (<em>little-endian</em> --
    stockent l'octet de poids faible en premier). D'autres plateformes un peu plus exotiques peuvent
    être en <em>bi-endian</em> ou encore en <em>mixed-endian</em>, deux autres formes d'agencement
    d'octets.<br/>
    Pour en revenir aux échanges de données sur le réseau, imaginez que vous envoyez un entier codé
    sur 16 bits en <em>little-endian</em> (votre processeur est un Intel x86 par exemple), et que le
    serveur le reçoive et l'interpète en <em>big-endian</em> (son processeur est un PowerPC Apple
    par exemple) ; si vous envoyez 48 (00000000 00110000) le serveur va en fait voir 768 (00000011 00000000).
</p>
<p>
    Un autre problème est la taille des types primitifs. Différentes plateformes peuvent avoir différentes
    tailles pour un même type. Si la taille d'un <code>long int</code> est de 32 bits sur votre plateforme,
    peut-être qu'elle sera de 64 bits sur le serveur, et là encore, les données reçues seront
    faussement interprétées.
</p>
<p>
    Le troisième problème est plus lié au réseau. Les transferts de données via les protocoles TCP et UDP
    doivent suivre des règles définies par les niveau plus bas d'implémentation. En particulier,
    un morceau de données peut être découpé et reçu en plusieurs fois ; le recepteur doit trouver un moyen
    de recomposer le morceau et de renvoyer les données comme s'il les avait reçues en une fois.
</p>
<p>
    Ce sont les problèmes les plus communs impliqués dans la programmation réseau, mais il en a tout
    un tas d'autres à gérer si vous voulez construire des programmes robustes. Afin de vous aider avec
    ces tâches bas niveau, la SFML fournit une classe pour manipuler les données réseau via
    des paquets : <?php class_link("Packet")?>.
</p>

<?php h2('Types primitifs') ?>
<p>
    Comme nous venons de le voir, les types primitifs du C++ tels que <code>unsigned int</code>, <code>long</code>, etc.
    ont une taille indeterminée et qui peut varier d'une plateforme à une autre. En conséquence, il est inapproprié de
    les utiliser pour échanger des données via le réseau, il n'y a aucun contrôle sur la taille de ce qui est envoyé
    et reçu. Malheureusement, <?php class_link("Packet")?> ne peut résoudre ce problème automatiquement, il y a
    toujours un moment où vous devez fixer explicitement une taille pour les types primitifs que vous envoyez.
    Pour ce faire, la meilleure solution est d'utiliser les types à taille fixe de SFML :
    <code>sf::Int8</code>, <code>sf::Uint16</code>, <code>sf::Int32</code>, etc. Ces types sont garantis d'avoir la
    même taille sur n'importe quelle plateforme.
<p>
    Ceci est donc une chose à ne jamais oublier : utilisez toujours des types à taille fixe pour les structures que
    vous souhaitez envoyer via le réseau, soit directement soit via un transtypage juste avant l'envoi / après la réception.
</p>

<?php h2('Utilisation basique') ?>
<p>
    Tout comme les entrées / sorties standards, <?php class_link("Packet")?> permet d'insérer et
    d'extraire très facilement des données de tout type via les opérateurs &lt;&lt; et &gt;&gt;.
    Vous pouvez construire un paquet de données tout comme vous écririez ces données
    sur la console avec <code>std::cout</code>, <?php class_link("Packet")?> se chargera des problèmes
    de boutisme et d'autres détails pour vous.
</p>
<pre><code class="cpp">// Insertion

sf::Int8    x = 24;
std::string s = "hello";
float       f = 59864.265f;

sf::Packet ToSend;
ToSend &lt;&lt; x &lt;&lt; s &lt;&lt; f;
...
</code></pre>
<pre><code class="cpp">// Extraction

sf::Packet Received;
...
sf::Int8    x;
std::string s;
float       f;
Received &gt;&gt; x &gt;&gt; s &gt;&gt; f;
</code></pre>
<p>
    Contrairement à l'écriture, la lecture depuis un paquet peut échouer, notamment si l'on tente de lire plus d'octets
    que le paquet n'en contient. Dans un tel cas, la lecture échouera et le paquet sera mis dans un état invalide.
    Pour vérifier l'état d'un paquet il est possible de le tester directement (<code>if (Received)</code>) ou, encore
    mieux, de tester la lecture (<code>if (Received >> x >> y)</code>).
</p>
<pre><code class="cpp">Received &gt;&gt; x &gt;&gt; s &gt;&gt; f;
if (!Received)
{
    // Erreur... les données n'ont pas pu être lues
}

// Ou

if (!(Received &gt;&gt; x &gt;&gt; s &gt;&gt; f))
{
    // Erreur... les données n'ont pas pu être lues
}
</code></pre>

<p>
    L'envoi et la réception de paquets ne diffère pas de l'envoi et la réception de tableaux
    d'octets :
</p>
<pre><code class="cpp">// Avec les sockets TCP

Socket.Send(Packet);
Socket.Receive(Packet);
</code></pre>
<pre><code class="cpp">// Avec les sockets UDP

Socket.Send(Packet, Address, Port);
Socket.Receive(Packet, Address);
</code></pre>

<?php h2('Les paquets et les classes persos') ?>
<p>
    Tout comme avec les flux standards, il est possible d'étendre les paquets afin de leur permettre
    de manipuler vos classes persos. Pour permettre l'insertion et l'extraction d'instances d'une
    classe perso dans un <?php class_link("Packet")?>, définissez la bonne version des opérateurs
    &lt;&lt; et &gt;&gt; :
</p>
<pre><code class="cpp">struct Character
{
    sf::Uint8   Age;
    std::string Name;
    float       Height;
};

sf::Packet&amp; operator &lt;&lt;(sf::Packet&amp; Packet, const Character&amp; C)
{
    return Packet &lt;&lt; C.Age &lt;&lt; C.Name &lt;&lt; C.Height;
}

sf::Packet&amp; operator &gt;&gt;(sf::Packet&amp; Packet, Character&amp; C)
{
    return Packet &gt;&gt; C.Age &gt;&gt; C.Name &gt;&gt; C.Height;
}
</code></pre>
<p>
    Les deux opérateurs renvoient une référence vers le paquet : cela permet le chaînage des appels.
</p>
<p>
    A présent vous pouvez insérer et extraire des instances de votre classe comme n'importe quel
    type primitif :
</p>
<pre><code class="cpp">Character Bob;
sf::Packet Packet;

Packet &lt;&lt; Bob;
Packet &gt;&gt; Bob;
</code></pre>

<?php h2('Paquets personnalisés') ?>
<p>
    Afin de permettre encore plus de personnalisation, <?php class_link("Packet")?> est extensible. Cela signifie
    que vous pouvez construire vos propres classes de paquets, et personnaliser les données qui vont
    être envoyées et reçues. Pour se faire, <?php class_link("Packet")?> définit deux fonctions virtuelles :
</p>
<ul>
    <li><code>OnSend</code>, qui sera appelée pour récupérer les données à envoyer</li>
    <li><code>OnReceive</code>, qui sera appelée pour remplir le paquet avec les données reçues</li>
</ul>
<p>
    Ces fonctions permettent aux classes dérivées de modifier ce qui sera envoyé, ou ce qui sera lu
    après réception. Voici un exemple simple de paquet gérant le chiffrage des données :
</p>
<pre><code class="cpp">class EncryptedPacket : public sf::Packet
{
private :

    virtual const char* OnSend(std::size_t&amp; DataSize)
    {
        // On copie le contenu du paquet dans notre tableau intermédiaire
        myBuffer.assign(GetData(), GetData() + GetDataSize());

        // On chiffre les données (algorithme puissant : on ajoute 1 à chaque caractère !)
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i += 1;

        // On renvoie la taille des données à envoyer, et un pointeur vers le tableau qui les contient
        DataSize = myBuffer.size();
        return &amp;myBuffer[0];
    }

    virtual void OnReceive(const char* Data, std::size_t DataSize)
    {
        // On copie les données reçues dans notre tableau intermédiaire
        myBuffer.assign(Data, Data + DataSize);

        // On déchiffre les données avec notre algorithme trop puissant
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i -= 1;

        // Et enfin on remplit le paquet avec les données déchiffrées
        Append(&amp;myBuffer[0], myBuffer.size());
    }

    std::vector&lt;char&gt; myBuffer;
};
</code></pre>
<p>
    La fonction <code>GetData()</code> donne accès en lecture au tampon interne, ainsi vous
    pouvez l'utiliser si nécessaire. <code>GetDataSize()</code> donne le nombre d'octets dans
    ce tampon. Pour modifier ou ajouter des données spécifiques dans le tampon, vous pouvez utiliser la
    fonction <code>Clear()</code> (pour effacer le tampon interne), <code>Append()</code> (pour ajouter
    des données brutes), ou l'opérateur &lt;&lt;.
</p>
<p>
    Les paquets personnalisés peuvent se révéler utiles dans de nombreuses utilisations :
    chiffrement, compression, sommes de contrôle, filtrage de ce qui est reçu, ...
    Vous pouvez même fournir des paquets formattés utilisant une structure fixée, ou des paquets agissant comme des fabriques.
</p>

<?php h2('Conclusion') ?>
<p>
    La classe <?php class_link("Packet")?> gère beaucoup de problèmes réseau de bas niveau, et fournit un moyen
    facile de transférer des données avec les sockets. Je vous encourage à étendre les paquets
    à vos besoins, en surchargeant les opérateurs &lt;&lt; et &gt;&gt;, et en dérivant
    vos propres classes de paquets si nécessaire.
</p>
<p>
    Il est important de garder en tête que les paquets SFML utilisent leur propre
    boutisme et structure, vous ne pouvez donc pas les utiliser pour communiquer avec des serveurs
    qui ne les utilisent pas. Pour envoyer des données brutes, des requêtes HTTP / FTP, ou
    n'importe quoi d'autre n'utilisant pas la SFML, utilisez des tableaux d'octets plutôt que des paquets
    SFML.
</p>
<p>
    Vous êtes maintenant prêts à passer au dernier tutoriel, concernant
    <a class="internal" href="./network-selector-fr.php" title="Aller au tutoriel suivant">l'utilisation des sélecteurs</a>.
</p>

<?php

    require("footer-fr.php");

?>
