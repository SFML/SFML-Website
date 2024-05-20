# Utiliser et étendre les paquets

## [Les problèmes à résoudre](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#les-problcimes-ce-rcesoudre)[](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#top "Haut de la page")

Echanger des données sur un réseau peut être plus difficile qu'il n'y paraît. La raison : des machines différentes, avec des systèmes d'exploitation et des processeurs différents, sont mis en communication directe. Et des problèmes insoupçonnés peuvent apparaître lorsque vous voulez échanger des données de manière fiable entre ces machines.

Le premier problème concerne l'endianness (_boutisme_ en bon français, mais vous n'aboutirez nulle part en utilisant ce terme). L'endianness est l'ordre dans lequel un processeur interprète les octets des types primitifs qui utilisent plusieurs octets (nombres entiers et flottants). Il existe deux familles principales : les processeurs "big endian", qui stockent l'octet de poids fort en premier, et les processeurs "little endian", qui stockent l'octet de poids faible en premier. Il existe aussi d'autres types d'endianness, plus exotiques, mais vous ne les rencontrerez probablement jamais.  
Ainsi, le problème est évident : si vous échangez par le réseau une variable entre deux machines dont l'endianness est différent, elles ne verront pas la même valeur. Par exemple, l'entier 16 bits "42" en notation big endian sera 00000000 00101010, mais si vous lisez ces mêmes deux octets sur une machine little endian, ils seront interprétés comme le nombre "10752".

Le deuxième problème concerne la taille des types primitifs. Le standard C++ ne fixe pas la taille de ces types (char, short, int, long, float, double), donc, encore une fois, il peut y avoir des différences entre les processeurs -- et il y en a. Par exemple, le type `long int` peut être un type 32 bits sur certaines plateformes, et 64 bits sur d'autres.

Le troisième problème est spécifique à la manière dont le protocole TCP fonctionne. Parce qu'il ne préserve pas les limites des messages, et peut séparer ou combiner les données, les destinataires doivent reconstruire les messages reçus avant de les interpréter. Sinon des résultats imprévisibles peuvent apparaître, comme par exemple lire des variables incomplètes ou encore ignorer des octets utiles.

Vous rencontrerez bien entendu bien d'autres problèmes avec la programmation réseau, mais ceux-ci sont les plus bas niveau, et tout le monde est susceptible d'y être confronté très rapidement. C'est pourquoi SFML fournit des outils simples pour les éviter.

## [Types primitifs à taille fixe](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#types-primitifs-ce-taille-fixe)[](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#top "Haut de la page")

Comme les types primitifs ne peuvent pas être échangés de manière fiable sur le réseau, la solution est simple : ne les utilisez pas. SFML fournit des types à taille fixe pour les transferts de données : `sf::Int8, sf::Uint16, sf::Int32`, etc. Ces types ne sont que des alias (typedefs) des types primitifs, mais ils correspondent toujours au type qui a la taille attendue selon la plateforme. Ainsi, ils peuvent (et doivent !) être utilisés lorsque vous voulez échanger des données de manière sûre entre deux ordinateurs.

SFML ne fournit que des types _entiers_ à taille fixe. Les types flottants devraient normalement avoir aussi leur équivalent à taille fixe, mais en pratique ce n'est pas nécessaire car sur toutes les plateformes (du moins celles avec lesquelles SFML est compatible), les types `float` et `double` ont toujours la même taille (respectivement 32 et 64 bits).

## [Les paquets](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#les-paquets)[](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#top "Haut de la page")

Les deux autres problème (endianness et limites des messages) sont résolus en utilisant une classe particulière pour sérialiser vos données : [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation"). En bonus, elle fournit une interface bien plus sympathique que ce bon vieux tableau d'octets.

Les paquets offrent une interface de programmation similaire à celle des flux standards : vous pouvez insérer des données avec l'opérateur <<, et les extraire avec l'opérateur >>.

```
// côté envoi
sf::Uint16 x = 10;
std::string s = "hello";
double d = 0.6;

sf::Packet packet;
packet << x << s << d;
```

```
// côté réception
sf::Uint16 x;
std::string s;
double d;

packet >> x >> s >> d;
```

Contrairement à l'écriture, la lecture depuis un paquet peut échouer si vous tentez d'extraire plus d'octets que ce que le paquet contient. Si une opération de lecture échoue, le paquet passe en état d'erreur. Pour vérifier l'état d'un paquet, vous pouvez le tester comme un booléen (toujours pareil qu'avec les flux standards) :

```
if (packet >> x)
{
    // ok
}
else
{
    // erreur, échec de lecture de la variable 'x' depuis le paquet
}
```

Envoyer et recevoir des paquets est aussi facile que d'envoyer/recevoir un tableau d'octets : les sockets ont une surcharge de `send` et `receive` qui prennent directement un [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation") en paramètre.

```
// avec une socket TCP
tcpSocket.send(packet);
tcpSocket.receive(packet);
```

```
// avec une socket UDP
udpSocket.send(packet, recipientAddress, recipientPort);
udpSocket.receive(packet, senderAddress, senderPort);
```

Les paquets résolvent le problème des limites de messages, ce qui signifie que lorsque vous envoyez un paquet sur une socket TCP, vous recevez exactement le même paquet de l'autre côté ; il ne peut pas contenir moins d'octets, ni des octets du paquet suivant. Cepepdant cette approche possède un inconvénient : afin de préserver les limites des messages, [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation") doit ajouter quelques octets à vos données, ce qui implique que vous ne pouvez les recevoir qu'avec un [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation") si vous voulez qu'elles soient décodées correctement après réception. En d'autres termes, vous ne pouvez pas envoyer un paquet SFML à un destinataire quelconque, il doit lui aussi utiliser un paquet SFML. Notez bien que cela ne s'applique qu'à TCP, UDP quant à lui n'a pas ce problème car les limites des messages sont déjà garanties par le protocole lui-même.

## [Etendre les paquets pour qu'ils gèrent vos types persos](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#etendre-les-paquets-pour-quils-gcirent-vos-types-persos)[](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#top "Haut de la page")

Les paquets ont des surcharges de leurs opérateurs pour tous les types primitifs, ainsi que pour les types standards les plus utilisés, mais qu'en est-il de vos propres classes ? Tout comme avec les flux standards, vous pouvez rendre un type "compatible" avec [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation") en créant une surcharge des opérateurs << et >>.

```
struct Character
{
    sf::Uint8 age;
    std::string name;
    float weight;
};

sf::Packet& operator <<(sf::Packet& packet, const Character& character)
{
    return packet << character.age << character.name << character.weight;
}

sf::Packet& operator >>(sf::Packet& packet, Character& character)
{
    return packet >> character.age >> character.name >> character.weight;
}
```

Ces opérateurs renvoient une référence sur le paquet : cela permet de chaîner les appels.

Maintenant que ces opérateurs sont définis, vous pouvez insérer/extraire un `Character` dans/depuis un paquet comme n'importe quel autre type primitif :

```
Character bob;

packet << bob;
packet >> bob;
```

## [Les paquets personnalisés](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#les-paquets-personnalisces)[](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php#top "Haut de la page")

Les paquets offrent des fonctionnalités sympas par dessus vos données brutes, mais peut-on aller plus loin et ajouter vos propres fonctionnalités, comme par exemple compresser ou chiffrer automatiquement les données lors de l'envoi ? Cela peut être fait très facilement, en créant une classe dérivée de [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation") et en redéfinissant les fonctions suivantes :

- `onSend`: appelée juste avant que la socket envoie les données
- `onReceive`: appelée juste après que la socket a reçu les données

Ces fonctions fournissent un accès direct aux données, de manière à ce que vous puissiez les transformer selon vos besoin.

Voici un exemple (factice) de paquet qui effectue de la compression/décompression automatique :

```
class ZipPacket : public sf::Packet
{
    virtual const void* onSend(std::size_t& size)
    {
        const void* srcData = getData();
        std::size_t srcSize = getDataSize();
        return compressTheData(srcData, srcSize, &size); // fonction factice, bien entendu :)
    }
    virtual void onReceive(const void* data, std::size_t size)
    {
        std::size_t dstSize;
        const void* dstData = uncompressTheData(data, size, &dstSize); // fonction factice, bien entendu :)
        append(dstData, dstSize);
    }
};
```

Un tel paquet peut être utilisé exactement comme [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation"). Et les surcharges d'opérateurs pour vos types persos s'appliquent toujours.

```
ZipPacket packet;
packet << x << bob;
socket.send(packet);
```