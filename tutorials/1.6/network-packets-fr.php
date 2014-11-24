<?php

    $title = "Utiliser et �tendre les paquets";
    $page = "network-packets-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser et �tendre les paquets</h1>

<?php h2('Introduction') ?>
<p>
    L'�change de donn�es par le r�seau peut �tre plus compliqu� qu'il n'y para�t. Tout peut sembler facile
    tant que vous testez votre application avec votre propre ordinateur en tant que client et serveur,
    mais lorsque vous commencez � transiter par internet et sur diff�rentes plateformes, beaucoup
    de probl�mes peuvent appara�tre.
</p>
<p>
    Le premier est le boutisme (<em>endianess</em>). Le boutisme est l'ordre dans lequel une plateforme
    particuli�re va stocker les octets d'un type primitif. Il existe deux familles principales de
    plateformes : celles utilisant le grand-boutisme (<em>big-endian</em> -- stockent l'octet
    de poids fort en premier) et celles utilisant le petit-boutisme (<em>little-endian</em> --
    stockent l'octet de poids faible en premier). D'autres plateformes un peu plus exotiques peuvent
    �tre en <em>bi-endian</em> ou encore en <em>mixed-endian</em>, deux autres formes d'agencement
    d'octets.<br/>
    Pour en revenir aux �changes de donn�es sur le r�seau, imaginez que vous envoyez un entier cod�
    sur 16 bits en <em>little-endian</em> (votre processeur est un Intel x86 par exemple), et que le
    serveur le re�oive et l'interp�te en <em>big-endian</em> (son processeur est un PowerPC Apple
    par exemple) ; si vous envoyez 48 (00000000 00110000) le serveur va en fait voir 768 (00000011 00000000).
</p>
<p>
    Un autre probl�me est la taille des types primitifs. Diff�rentes plateformes peuvent avoir diff�rentes
    tailles pour un m�me type. Si la taille d'un <code>long int</code> est de 32 bits sur votre plateforme,
    peut-�tre qu'elle sera de 64 bits sur le serveur, et l� encore, les donn�es re�ues seront
    faussement interpr�t�es.
</p>
<p>
    Le troisi�me probl�me est plus li� au r�seau. Les transferts de donn�es via les protocoles TCP et UDP
    doivent suivre des r�gles d�finies par les niveau plus bas d'impl�mentation. En particulier,
    un morceau de donn�es peut �tre d�coup� et re�u en plusieurs fois ; le recepteur doit trouver un moyen
    de recomposer le morceau et de renvoyer les donn�es comme s'il les avait re�ues en une fois.
</p>
<p>
    Ce sont les probl�mes les plus communs impliqu�s dans la programmation r�seau, mais il en a tout
    un tas d'autres � g�rer si vous voulez construire des programmes robustes. Afin de vous aider avec
    ces t�ches bas niveau, la SFML fournit une classe pour manipuler les donn�es r�seau via
    des paquets : <?php class_link("Packet")?>.
</p>

<?php h2('Types primitifs') ?>
<p>
    Comme nous venons de le voir, les types primitifs du C++ tels que <code>unsigned int</code>, <code>long</code>, etc.
    ont une taille indetermin�e et qui peut varier d'une plateforme � une autre. En cons�quence, il est inappropri� de
    les utiliser pour �changer des donn�es via le r�seau, il n'y a aucun contr�le sur la taille de ce qui est envoy�
    et re�u. Malheureusement, <?php class_link("Packet")?> ne peut r�soudre ce probl�me automatiquement, il y a
    toujours un moment o� vous devez fixer explicitement une taille pour les types primitifs que vous envoyez.
    Pour ce faire, la meilleure solution est d'utiliser les types � taille fixe de SFML :
    <code>sf::Int8</code>, <code>sf::Uint16</code>, <code>sf::Int32</code>, etc. Ces types sont garantis d'avoir la
    m�me taille sur n'importe quelle plateforme.
<p>
    Ceci est donc une chose � ne jamais oublier : utilisez toujours des types � taille fixe pour les structures que
    vous souhaitez envoyer via le r�seau, soit directement soit via un transtypage juste avant l'envoi / apr�s la r�ception.
</p>

<?php h2('Utilisation basique') ?>
<p>
    Tout comme les entr�es / sorties standards, <?php class_link("Packet")?> permet d'ins�rer et
    d'extraire tr�s facilement des donn�es de tout type via les op�rateurs &lt;&lt; et &gt;&gt;.
    Vous pouvez construire un paquet de donn�es tout comme vous �cririez ces donn�es
    sur la console avec <code>std::cout</code>, <?php class_link("Packet")?> se chargera des probl�mes
    de boutisme et d'autres d�tails pour vous.
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
    Contrairement � l'�criture, la lecture depuis un paquet peut �chouer, notamment si l'on tente de lire plus d'octets
    que le paquet n'en contient. Dans un tel cas, la lecture �chouera et le paquet sera mis dans un �tat invalide.
    Pour v�rifier l'�tat d'un paquet il est possible de le tester directement (<code>if (Received)</code>) ou, encore
    mieux, de tester la lecture (<code>if (Received >> x >> y)</code>).
</p>
<pre><code class="cpp">Received &gt;&gt; x &gt;&gt; s &gt;&gt; f;
if (!Received)
{
    // Erreur... les donn�es n'ont pas pu �tre lues
}

// Ou

if (!(Received &gt;&gt; x &gt;&gt; s &gt;&gt; f))
{
    // Erreur... les donn�es n'ont pas pu �tre lues
}
</code></pre>

<p>
    L'envoi et la r�ception de paquets ne diff�re pas de l'envoi et la r�ception de tableaux
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
    Tout comme avec les flux standards, il est possible d'�tendre les paquets afin de leur permettre
    de manipuler vos classes persos. Pour permettre l'insertion et l'extraction d'instances d'une
    classe perso dans un <?php class_link("Packet")?>, d�finissez la bonne version des op�rateurs
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
    Les deux op�rateurs renvoient une r�f�rence vers le paquet : cela permet le cha�nage des appels.
</p>
<p>
    A pr�sent vous pouvez ins�rer et extraire des instances de votre classe comme n'importe quel
    type primitif :
</p>
<pre><code class="cpp">Character Bob;
sf::Packet Packet;

Packet &lt;&lt; Bob;
Packet &gt;&gt; Bob;
</code></pre>

<?php h2('Paquets personnalis�s') ?>
<p>
    Afin de permettre encore plus de personnalisation, <?php class_link("Packet")?> est extensible. Cela signifie
    que vous pouvez construire vos propres classes de paquets, et personnaliser les donn�es qui vont
    �tre envoy�es et re�ues. Pour se faire, <?php class_link("Packet")?> d�finit deux fonctions virtuelles :
</p>
<ul>
    <li><code>OnSend</code>, qui sera appel�e pour r�cup�rer les donn�es � envoyer</li>
    <li><code>OnReceive</code>, qui sera appel�e pour remplir le paquet avec les donn�es re�ues</li>
</ul>
<p>
    Ces fonctions permettent aux classes d�riv�es de modifier ce qui sera envoy�, ou ce qui sera lu
    apr�s r�ception. Voici un exemple simple de paquet g�rant le chiffrage des donn�es :
</p>
<pre><code class="cpp">class EncryptedPacket : public sf::Packet
{
private :

    virtual const char* OnSend(std::size_t&amp; DataSize)
    {
        // On copie le contenu du paquet dans notre tableau interm�diaire
        myBuffer.assign(GetData(), GetData() + GetDataSize());

        // On chiffre les donn�es (algorithme puissant : on ajoute 1 � chaque caract�re !)
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i += 1;

        // On renvoie la taille des donn�es � envoyer, et un pointeur vers le tableau qui les contient
        DataSize = myBuffer.size();
        return &amp;myBuffer[0];
    }

    virtual void OnReceive(const char* Data, std::size_t DataSize)
    {
        // On copie les donn�es re�ues dans notre tableau interm�diaire
        myBuffer.assign(Data, Data + DataSize);

        // On d�chiffre les donn�es avec notre algorithme trop puissant
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i -= 1;

        // Et enfin on remplit le paquet avec les donn�es d�chiffr�es
        Append(&amp;myBuffer[0], myBuffer.size());
    }

    std::vector&lt;char&gt; myBuffer;
};
</code></pre>
<p>
    La fonction <code>GetData()</code> donne acc�s en lecture au tampon interne, ainsi vous
    pouvez l'utiliser si n�cessaire. <code>GetDataSize()</code> donne le nombre d'octets dans
    ce tampon. Pour modifier ou ajouter des donn�es sp�cifiques dans le tampon, vous pouvez utiliser la
    fonction <code>Clear()</code> (pour effacer le tampon interne), <code>Append()</code> (pour ajouter
    des donn�es brutes), ou l'op�rateur &lt;&lt;.
</p>
<p>
    Les paquets personnalis�s peuvent se r�v�ler utiles dans de nombreuses utilisations :
    chiffrement, compression, sommes de contr�le, filtrage de ce qui est re�u, ...
    Vous pouvez m�me fournir des paquets formatt�s utilisant une structure fix�e, ou des paquets agissant comme des fabriques.
</p>

<?php h2('Conclusion') ?>
<p>
    La classe <?php class_link("Packet")?> g�re beaucoup de probl�mes r�seau de bas niveau, et fournit un moyen
    facile de transf�rer des donn�es avec les sockets. Je vous encourage � �tendre les paquets
    � vos besoins, en surchargeant les op�rateurs &lt;&lt; et &gt;&gt;, et en d�rivant
    vos propres classes de paquets si n�cessaire.
</p>
<p>
    Il est important de garder en t�te que les paquets SFML utilisent leur propre
    boutisme et structure, vous ne pouvez donc pas les utiliser pour communiquer avec des serveurs
    qui ne les utilisent pas. Pour envoyer des donn�es brutes, des requ�tes HTTP / FTP, ou
    n'importe quoi d'autre n'utilisant pas la SFML, utilisez des tableaux d'octets plut�t que des paquets
    SFML.
</p>
<p>
    Vous �tes maintenant pr�ts � passer au dernier tutoriel, concernant
    <a class="internal" href="./network-selector-fr.php" title="Aller au tutoriel suivant">l'utilisation des s�lecteurs</a>.
</p>

<?php

    require("footer-fr.php");

?>
