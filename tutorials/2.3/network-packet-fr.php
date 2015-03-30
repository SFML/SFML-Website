<?php

    $title = "Utiliser et étendre les paquets";
    $page = "network-packet-fr.php";

    require("header-fr.php");

?>

<h1>Utiliser et étendre les paquets</h1>

<?php h2('Les problèmes à résoudre') ?>
<p>
    Echanger des données sur un réseau peut être plus difficile qu'il n'y paraît. La raison : des machines différentes, avec des systèmes d'exploitation et des processeurs
    différents, sont mis en communication directe. Et des problèmes insoupçonnés peuvent apparaître lorsque vous voulez échanger des données de manière fiable entre
    ces machines.
</p>
<p>
    Le premier problème concerne l'endianness (<em>boutisme</em> en bon français, mais vous n'aboutirez nulle part en utilisant ce terme). L'endianness est l'ordre
    dans lequel un processeur interprète les octets des types primitifs qui utilisent plusieurs octets (nombres entiers et flottants). Il existe deux familles principales :
    les processeurs "big endian", qui stockent l'octet de poids fort en premier, et les processeurs "little endian", qui stockent l'octet de poids faible en premier. Il existe
    aussi d'autres types d'endianness, plus exotiques, mais vous ne les rencontrerez probablement jamais.<br/>
    Ainsi, le problème est évident : si vous échangez par le réseau une variable entre deux machines dont l'endianness est différent, elles ne verront pas la même valeur.
    Par exemple, l'entier 16 bits "42" en notation big endian sera 00000000 00101010, mais si vous lisez ces mêmes deux octets sur une machine little endian, ils seront
    interprétés comme le nombre "10752".
</p>
<p>
    Le deuxième problème concerne la taille des types primitifs. Le standard C++ ne fixe pas la taille de ces types (char, short, int, long, float, double), donc,
    encore une fois, il peut y avoir des différences entre les processeurs -- et il y en a. Par exemple, le type <code>long int</code> peut être un type 32 bits sur
    certaines plateformes, et 64 bits sur d'autres.
</p>
<p>
    Le troisième problème est spécifique à la manière dont le protocole TCP fonctionne. Parce qu'il ne préserve pas les limites des messages, et peut séparer ou combiner
    les données, les destinataires doivent reconstruire les messages reçus avant de les interpréter. Sinon des résultats imprévisibles peuvent apparaître, comme
    par exemple lire des variables incomplètes ou encore ignorer des octets utiles.
</p>
<p>
    Vous rencontrerez bien entendu bien d'autres problèmes avec la programmation réseau, mais ceux-ci sont les plus bas niveau, et tout le monde est susceptible d'y être
    confronté très rapidement. C'est pourquoi SFML fournit des outils simples pour les éviter.
</p>

<?php h2('Types primitifs à taille fixe') ?>
<p>
    Comme les types primitifs ne peuvent pas être échangés de manière fiable sur le réseau, la solution est simple : ne les utilisez pas. SFML fournit des types à taille
    fixe pour les transferts de données : <code>sf::Int8, sf::Uint16, sf::Int32</code>, etc. Ces types ne sont que des alias (typedefs) des types primitifs, mais ils
    correspondent toujours au type qui a la taille attendue selon la plateforme. Ainsi, ils peuvent (et doivent !) être utilisés lorsque vous voulez échanger des données
    de manière sûre entre deux ordinateurs.
</p>
<p>
    SFML ne fournit que des types <em>entiers</em> à taille fixe. Les types flottants devraient normalement avoir aussi leur équivalent à taille fixe, mais en pratique
    ce n'est pas nécessaire car sur toutes les plateformes (du moins celles avec lesquelles SFML est compatible), les types <code>float</code> et <code>double</code>
    ont toujours la même taille (respectivement 32 et 64 bits).
</p>

<?php h2('Les paquets') ?>
<p>
    Les deux autres problème (endianness et limites des messages) sont résolus en utilisant une classe particulière pour sérialiser vos données : <?php class_link('Packet') ?>.
    En bonus, elle fournit une interface bien plus sympathique que ce bon vieux tableau d'octets.
</p>
<p>
    Les paquets offrent une interface de programmation similaire à celle des flux standards : vous pouvez insérer des données avec l'opérateur &lt;&lt;, et les extraire
    avec l'opérateur &gt;&gt;.
</p>
<pre><code class="cpp">// côté envoi
sf::Uint16 x = 10;
std::string s = "hello";
double d = 0.6;

sf::Packet packet;
packet &lt;&lt; x &lt;&lt; s &lt;&lt; d;
</code></pre>
<pre><code class="cpp">// côté réception
sf::Uint16 x;
std::string s;
double d;

packet &gt;&gt; x &gt;&gt; s &gt;&gt; d;
</code></pre>
<p>
    Contrairement à l'écriture, la lecture depuis un paquet peut échouer si vous tentez d'extraire plus d'octets que ce que le paquet contient. Si une opération de lecture
    échoue, le paquet passe en état d'erreur. Pour vérifier l'état d'un paquet, vous pouvez le tester comme un booléen (toujours pareil qu'avec les flux standards) :
</p>
<pre><code class="cpp">if (packet &gt;&gt; x)
{
    // ok
}
else
{
    // erreur, échec de lecture de la variable 'x' depuis le paquet
}
</code></pre>
<p>
    Envoyer et recevoir des paquets est aussi facile que d'envoyer/recevoir un tableau d'octets : les sockets ont une surcharge de <code>send</code> et <code>receive</code>
    qui prennent directement un <?php class_link('Packet') ?> en paramètre.
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
    Les paquets résolvent le problème des limites de messages, ce qui signifie que lorsque vous envoyez un paquet sur une socket TCP, vous recevez exactement le même paquet
    de l'autre côté ; il ne peut pas contenir moins d'octets, ni des octets du paquet suivant. Cepepdant cette approche possède un inconvénient : afin de préserver les
    limites des messages, <?php class_link('Packet') ?> doit ajouter quelques octets à vos données, ce qui implique que vous ne pouvez les recevoir qu'avec un
    <?php class_link('Packet') ?> si vous voulez qu'elles soient décodées correctement après réception. En d'autres termes, vous ne pouvez pas envoyer un paquet SFML à
    un destinataire quelconque, il doit lui aussi utiliser un paquet SFML. Notez bien que cela ne s'applique qu'à TCP, UDP quant à lui n'a pas ce problème car les
    limites des messages sont déjà garanties par le protocole lui-même.
</p>

<?php h2('Etendre les paquets pour qu\'ils gèrent vos types persos') ?>
<p>
    Les paquets ont des surcharges de leurs opérateurs pour tous les types primitifs, ainsi que pour les types standards les plus utilisés, mais qu'en est-il de vos propres
    classes ? Tout comme avec les flux standards, vous pouvez rendre un type "compatible" avec <?php class_link('Packet') ?> en créant une surcharge des opérateurs
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
    Ces opérateurs renvoient une référence sur le paquet : cela permet de chaîner les appels.
</p>
<p>
    Maintenant que ces opérateurs sont définis, vous pouvez insérer/extraire un <code>Character</code> dans/depuis un paquet comme n'importe quel autre type primitif :
</p>
<pre><code class="cpp">Character bob;

packet &lt;&lt; bob;
packet &gt;&gt; bob;
</code></pre>

<?php h2('Les paquets personnalisés') ?>
<p>
    Les paquets offrent des fonctionnalités sympas par dessus vos données brutes, mais peut-on aller plus loin et ajouter vos propres fonctionnalités, comme par exemple
    compresser ou chiffrer automatiquement les données lors de l'envoi ? Cela peut être fait très facilement, en créant une classe dérivée de <?php class_link('Packet') ?>
    et en redéfinissant les fonctions suivantes :
</p>
<ul>
    <li><code>onSend</code>: appelée juste avant que la socket envoie les données</li>
    <li><code>onReceive</code>: appelée juste après que la socket a reçu les données</li>
</ul>
<p>
    Ces fonctions fournissent un accès direct aux données, de manière à ce que vous puissiez les transformer selon vos besoin.
</p>
<p>
    Voici un exemple (factice) de paquet qui effectue de la compression/décompression automatique :
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
    Un tel paquet peut être utilisé exactement comme <?php class_link('Packet') ?>. Et les surcharges d'opérateurs pour vos types persos s'appliquent toujours.
</p>
<pre><code class="cpp">ZipPacket packet;
packet &lt;&lt; x &lt;&lt; bob;
socket.send(packet);
</code></pre>

<?php

    require("footer-fr.php");

?>
