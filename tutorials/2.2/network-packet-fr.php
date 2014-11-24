<?php

    $title = "Utiliser et �tendre les paquets";
    $page = "network-packet-fr.php";

    require("header-fr.php");

?>

<h1>Utiliser et �tendre les paquets</h1>

<?php h2('Les probl�mes � r�soudre') ?>
<p>
    Echanger des donn�es sur un r�seau peut �tre plus difficile qu'il n'y para�t. La raison : des machines diff�rentes, avec des syst�mes d'exploitation et des processeurs
    diff�rents, sont mis en communication directe. Et des probl�mes insoup�onn�s peuvent appara�tre lorsque vous voulez �changer des donn�es de mani�re fiable entre
    ces machines.
</p>
<p>
    Le premier probl�me concerne l'endianness (<em>boutisme</em> en bon fran�ais, mais vous n'aboutirez nulle part en utilisant ce terme). L'endianness est l'ordre
    dans lequel un processeur interpr�te les octets des types primitifs qui utilisent plusieurs octets (nombres entiers et flottants). Il existe deux familles principales :
    les processeurs "big endian", qui stockent l'octet de poids fort en premier, et les processeurs "little endian", qui stockent l'octet de poids faible en premier. Il existe
    aussi d'autres types d'endianness, plus exotiques, mais vous ne les rencontrerez probablement jamais.<br/>
    Ainsi, le probl�me est �vident : si vous �changez par le r�seau une variable entre deux machines dont l'endianness est diff�rent, elles ne verront pas la m�me valeur.
    Par exemple, l'entier 16 bits "42" en notation big endian sera 00000000 00101010, mais si vous lisez ces m�mes deux octets sur une machine little endian, ils seront
    interpr�t�s comme le nombre "10752".
</p>
<p>
    Le deuxi�me probl�me concerne la taille des types primitifs. Le standard C++ ne fixe pas la taille de ces types (char, short, int, long, float, double), donc,
    encore une fois, il peut y avoir des diff�rences entre les processeurs -- et il y en a. Par exemple, le type <code>long int</code> peut �tre un type 32 bits sur
    certaines plateformes, et 64 bits sur d'autres.
</p>
<p>
    Le troisi�me probl�me est sp�cifique � la mani�re dont le protocole TCP fonctionne. Parce qu'il ne pr�serve pas les limites des messages, et peut s�parer ou combiner
    les donn�es, les destinataires doivent reconstruire les messages re�us avant de les interpr�ter. Sinon des r�sultats impr�visibles peuvent appara�tre, comme
    par exemple lire des variables incompl�tes ou encore ignorer des octets utiles.
</p>
<p>
    Vous rencontrerez bien entendu bien d'autres probl�mes avec la programmation r�seau, mais ceux-ci sont les plus bas niveau, et tout le monde est susceptible d'y �tre
    confront� tr�s rapidement. C'est pourquoi SFML fournit des outils simples pour les �viter.
</p>

<?php h2('Types primitifs � taille fixe') ?>
<p>
    Comme les types primitifs ne peuvent pas �tre �chang�s de mani�re fiable sur le r�seau, la solution est simple : ne les utilisez pas. SFML fournit des types � taille
    fixe pour les transferts de donn�es : <code>sf::Int8, sf::Uint16, sf::Int32</code>, etc. Ces types ne sont que des alias (typedefs) des types primitifs, mais ils
    correspondent toujours au type qui a la taille attendue selon la plateforme. Ainsi, ils peuvent (et doivent !) �tre utilis�s lorsque vous voulez �changer des donn�es
    de mani�re s�re entre deux ordinateurs.
</p>
<p>
    SFML ne fournit que des types <em>entiers</em> � taille fixe. Les types flottants devraient normalement avoir aussi leur �quivalent � taille fixe, mais en pratique
    ce n'est pas n�cessaire car sur toutes les plateformes (du moins celles avec lesquelles SFML est compatible), les types <code>float</code> et <code>double</code>
    ont toujours la m�me taille (respectivement 32 et 64 bits).
</p>

<?php h2('Les paquets') ?>
<p>
    Les deux autres probl�me (endianness et limites des messages) sont r�solus en utilisant une classe particuli�re pour s�rialiser vos donn�es : <?php class_link('Packet') ?>.
    En bonus, elle fournit une interface bien plus sympathique que ce bon vieux tableau d'octets.
</p>
<p>
    Les paquets offrent une interface de programmation similaire � celle des flux standards : vous pouvez ins�rer des donn�es avec l'op�rateur &lt;&lt;, et les extraire
    avec l'op�rateur &gt;&gt;.
</p>
<pre><code class="cpp">// c�t� envoi
sf::Uint16 x = 10;
std::string s = "hello";
double d = 0.6;

sf::Packet packet;
packet &lt;&lt; x &lt;&lt; s &lt;&lt; d;
</code></pre>
<pre><code class="cpp">// c�t� r�ception
sf::Uint16 x;
std::string s;
double d;

packet &gt;&gt; x &gt;&gt; s &gt;&gt; d;
</code></pre>
<p>
    Contrairement � l'�criture, la lecture depuis un paquet peut �chouer si vous tentez d'extraire plus d'octets que ce que le paquet contient. Si une op�ration de lecture
    �choue, le paquet passe en �tat d'erreur. Pour v�rifier l'�tat d'un paquet, vous pouvez le tester comme un bool�en (toujours pareil qu'avec les flux standards) :
</p>
<pre><code class="cpp">if (packet &gt;&gt; x)
{
    // ok
}
else
{
    // erreur, �chec de lecture de la variable 'x' depuis le paquet
}
</code></pre>
<p>
    Envoyer et recevoir des paquets est aussi facile que d'envoyer/recevoir un tableau d'octets : les sockets ont une surcharge de <code>send</code> et <code>receive</code>
    qui prennent directement un <?php class_link('Packet') ?> en param�tre.
</p>
<pre><code class="cpp">// avec une socket TCP
tcpSocket.send(packet);
tcpSocket.receive(packet);
</code></pre>
<pre><code class="cpp">// avec une socket UDP
udpSocket.send(packet, recipientAddress, recipientPort);
udpSocket.receive(packet, senderAddress, senderPort);
</code></pre>
<p>
    Les paquets r�solvent le probl�me des limites de messages, ce qui signifie que lorsque vous envoyez un paquet sur une socket TCP, vous recevez exactement le m�me paquet
    de l'autre c�t� ; il ne peut pas contenir moins d'octets, ni des octets du paquet suivant. Cepepdant cette approche poss�de un inconv�nient : afin de pr�server les
    limites des messages, <?php class_link('Packet') ?> doit ajouter quelques octets � vos donn�es, ce qui implique que vous ne pouvez les recevoir qu'avec un
    <?php class_link('Packet') ?> si vous voulez qu'elles soient d�cod�es correctement apr�s r�ception. En d'autres termes, vous ne pouvez pas envoyer un paquet SFML �
    un destinataire quelconque, il doit lui aussi utiliser un paquet SFML. Notez bien que cela ne s'applique qu'� TCP, UDP quant � lui n'a pas ce probl�me car les
    limites des messages sont d�j� garanties par le protocole lui-m�me.
</p>

<?php h2('Etendre les paquets pour qu\'ils g�rent vos types persos') ?>
<p>
    Les paquets ont des surcharges de leurs op�rateurs pour tous les types primitifs, ainsi que pour les types standards les plus utilis�s, mais qu'en est-il de vos propres
    classes ? Tout comme avec les flux standards, vous pouvez rendre un type "compatible" avec <?php class_link('Packet') ?> en cr�ant une surcharge des op�rateurs
    &lt;&lt; et &gt;&gt;.
</p>
<pre><code class="cpp">struct Character
{
    sf::Uint8 age;
    std::string name;
    float weight;
};

sf::Packet&amp; operator &lt;&lt;(sf::Packet&amp; packet, const Character&amp; character)
{
    return packet &lt;&lt; character.age &lt;&lt; character.name &lt;&lt; character.weight;
}

sf::Packet&amp; operator &gt;&gt;(sf::Packet&amp; packet, Character&amp; character)
{
    return packet &gt;&gt; character.age &gt;&gt; character.name &gt;&gt; character.weight;
}
</code></pre>
<p>
    Ces op�rateurs renvoient une r�f�rence sur le paquet : cela permet de cha�ner les appels.
</p>
<p>
    Maintenant que ces op�rateurs sont d�finis, vous pouvez ins�rer/extraire un <code>Character</code> dans/depuis un paquet comme n'importe quel autre type primitif :
</p>
<pre><code class="cpp">Character bob;

packet &lt;&lt; bob;
packet &gt;&gt; bob;
</code></pre>

<?php h2('Les paquets personnalis�s') ?>
<p>
    Les paquets offrent des fonctionnalit�s sympas par dessus vos donn�es brutes, mais peut-on aller plus loin et ajouter vos propres fonctionnalit�s, comme par exemple
    compresser ou chiffrer automatiquement les donn�es lors de l'envoi ? Cela peut �tre fait tr�s facilement, en cr�ant une classe d�riv�e de <?php class_link('Packet') ?>
    et en red�finissant les fonctions suivantes :
</p>
<ul>
    <li><code>onSend</code>: appel�e juste avant que la socket envoie les donn�es</li>
    <li><code>onReceive</code>: appel�e juste apr�s que la socket a re�u les donn�es</li>
</ul>
<p>
    Ces fonctions fournissent un acc�s direct aux donn�es, de mani�re � ce que vous puissiez les transformer selon vos besoin.
</p>
<p>
    Voici un exemple (factice) de paquet qui effectue de la compression/d�compression automatique :
</p>
<pre><code class="cpp">class ZipPacket : public sf::Packet
{
    virtual const void* onSend(std::size_t&amp; size)
    {
        const void* srcData = getData();
        std::size_t srcSize = getDataSize();
        return compressTheData(srcData, srcSize, &amp;size); // fonction factice, bien entendu :)
    }
    virtual void onReceive(const void* data, std::size_t size)
    {
        std::size_t dstSize;
        const void* dstData = uncompressTheData(data, size, &amp;dstSize); // fonction factice, bien entendu :)
        append(dstData, dstSize);
    }
};
</code></pre>
<p>
    Un tel paquet peut �tre utilis� exactement comme <?php class_link('Packet') ?>. Et les surcharges d'op�rateurs pour vos types persos s'appliquent toujours.
</p>
<pre><code class="cpp">ZipPacket packet;
packet &lt;&lt; x &lt;&lt; bob;
socket.send(packet);
</code></pre>

<?php

    require("footer-fr.php");

?>
