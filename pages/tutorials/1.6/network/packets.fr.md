# Utiliser et étendre les paquets

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/network/packet/).

## Introduction

L'échange de données par le réseau peut être plus compliqué qu'il n'y paraît. Tout peut sembler facile tant que vous testez votre application avec votre propre ordinateur en tant que client et serveur, mais lorsque vous commencez à transiter par internet et sur différentes plateformes, beaucoup de problèmes peuvent apparaître.

Le premier est le boutisme (*endianess*). Le boutisme est l'ordre dans lequel une plateforme particulière va stocker les octets d'un type primitif. Il existe deux familles principales de plateformes : celles utilisant le grand-boutisme (*big-endian* -- stockent l'octet de poids fort en premier) et celles utilisant le petit-boutisme (*little-endian* -- stockent l'octet de poids faible en premier). D'autres plateformes un peu plus exotiques peuvent être en *bi-endian* ou encore en *mixed-endian*, deux autres formes d'agencement d'octets.  
Pour en revenir aux échanges de données sur le réseau, imaginez que vous envoyez un entier codé sur 16 bits en *little-endian* (votre processeur est un Intel x86 par exemple), et que le serveur le reçoive et l'interpète en *big-endian* (son processeur est un PowerPC Apple par exemple) ; si vous envoyez 48 (00000000 00110000) le serveur va en fait voir 768 (00000011 00000000).

Un autre problème est la taille des types primitifs. Différentes plateformes peuvent avoir différentes tailles pour un même type. Si la taille d'un `long int` est de 32 bits sur votre plateforme, peut-être qu'elle sera de 64 bits sur le serveur, et là encore, les données reçues seront faussement interprétées.

Le troisième problème est plus lié au réseau. Les transferts de données via les protocoles TCP et UDP doivent suivre des règles définies par les niveau plus bas d'implémentation. En particulier, un morceau de données peut être découpé et reçu en plusieurs fois ; le recepteur doit trouver un moyen de recomposer le morceau et de renvoyer les données comme s'il les avait reçues en une fois.

Ce sont les problèmes les plus communs impliqués dans la programmation réseau, mais il en a tout un tas d'autres à gérer si vous voulez construire des programmes robustes. Afin de vous aider avec ces tâches bas niveau, la SFML fournit une classe pour manipuler les données réseau via des paquets : [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation").

## Types primitifs

Comme nous venons de le voir, les types primitifs du C++ tels que `unsigned int`, `long`, etc. ont une taille indeterminée et qui peut varier d'une plateforme à une autre. En conséquence, il est inapproprié de les utiliser pour échanger des données via le réseau, il n'y a aucun contrôle sur la taille de ce qui est envoyé et reçu. Malheureusement, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") ne peut résoudre ce problème automatiquement, il y a toujours un moment où vous devez fixer explicitement une taille pour les types primitifs que vous envoyez. Pour ce faire, la meilleure solution est d'utiliser les types à taille fixe de SFML : `sf::Int8`, `sf::Uint16`, `sf::Int32`, etc. Ces types sont garantis d'avoir la même taille sur n'importe quelle plateforme.

Ceci est donc une chose à ne jamais oublier : utilisez toujours des types à taille fixe pour les structures que vous souhaitez envoyer via le réseau, soit directement soit via un transtypage juste avant l'envoi / après la réception.

## Utilisation basique

Tout comme les entrées / sorties standards, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") permet d'insérer et d'extraire très facilement des données de tout type via les opérateurs << et >>. Vous pouvez construire un paquet de données tout comme vous écririez ces données sur la console avec `std::cout`, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") se chargera des problèmes de boutisme et d'autres détails pour vous.

```cpp
// Insertion

sf::Int8    x = 24;
std::string s = "hello";
float       f = 59864.265f;

sf::Packet ToSend;
ToSend << x << s << f;
...
```

```cpp
// Extraction

sf::Packet Received;
...
sf::Int8    x;
std::string s;
float       f;
Received >> x >> s >> f;
```

Contrairement à l'écriture, la lecture depuis un paquet peut échouer, notamment si l'on tente de lire plus d'octets que le paquet n'en contient. Dans un tel cas, la lecture échouera et le paquet sera mis dans un état invalide. Pour vérifier l'état d'un paquet il est possible de le tester directement (`if (Received)`) ou, encore mieux, de tester la lecture (`if (Received >> x >> y)`).

```cpp
Received >> x >> s >> f;
if (!Received)
{
    // Erreur... les données n'ont pas pu être lues
}

// Ou

if (!(Received >> x >> s >> f))
{
    // Erreur... les données n'ont pas pu être lues
}
```

L'envoi et la réception de paquets ne diffère pas de l'envoi et la réception de tableaux d'octets :

```cpp
// Avec les sockets TCP

Socket.Send(Packet);
Socket.Receive(Packet);
```

```cpp
// Avec les sockets UDP

Socket.Send(Packet, Address, Port);
Socket.Receive(Packet, Address);
```

## Les paquets et les classes persos

Tout comme avec les flux standards, il est possible d'étendre les paquets afin de leur permettre de manipuler vos classes persos. Pour permettre l'insertion et l'extraction d'instances d'une classe perso dans un [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation"), définissez la bonne version des opérateurs << et >> :

```cpp
struct Character
{
    sf::Uint8   Age;
    std::string Name;
    float       Height;
};

sf::Packet& operator <<(sf::Packet& Packet, const Character& C)
{
    return Packet << C.Age << C.Name << C.Height;
}

sf::Packet& operator >>(sf::Packet& Packet, Character& C)
{
    return Packet >> C.Age >> C.Name >> C.Height;
}
```

Les deux opérateurs renvoient une référence vers le paquet : cela permet le chaînage des appels.

A présent vous pouvez insérer et extraire des instances de votre classe comme n'importe quel type primitif :

```cpp
Character Bob;
sf::Packet Packet;

Packet << Bob;
Packet >> Bob;
```

## Paquets personnalisés

Afin de permettre encore plus de personnalisation, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") est extensible. Cela signifie que vous pouvez construire vos propres classes de paquets, et personnaliser les données qui vont être envoyées et reçues. Pour se faire, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") définit deux fonctions virtuelles :

- `OnSend`, qui sera appelée pour récupérer les données à envoyer
- `OnReceive`, qui sera appelée pour remplir le paquet avec les données reçues

Ces fonctions permettent aux classes dérivées de modifier ce qui sera envoyé, ou ce qui sera lu après réception. Voici un exemple simple de paquet gérant le chiffrage des données :

```cpp
class EncryptedPacket : public sf::Packet
{
private :

    virtual const char* OnSend(std::size_t& DataSize)
    {
        // On copie le contenu du paquet dans notre tableau intermédiaire
        myBuffer.assign(GetData(), GetData() + GetDataSize());

        // On chiffre les données (algorithme puissant : on ajoute 1 à chaque caractère !)
        for (std::vector<char>::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i += 1;

        // On renvoie la taille des données à envoyer, et un pointeur vers le tableau qui les contient
        DataSize = myBuffer.size();
        return &myBuffer[0];
    }

    virtual void OnReceive(const char* Data, std::size_t DataSize)
    {
        // On copie les données reçues dans notre tableau intermédiaire
        myBuffer.assign(Data, Data + DataSize);

        // On déchiffre les données avec notre algorithme trop puissant
        for (std::vector<char>::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i -= 1;

        // Et enfin on remplit le paquet avec les données déchiffrées
        Append(&myBuffer[0], myBuffer.size());
    }

    std::vector<char> myBuffer;
};
```

La fonction `GetData()` donne accès en lecture au tampon interne, ainsi vous pouvez l'utiliser si nécessaire. `GetDataSize()` donne le nombre d'octets dans ce tampon. Pour modifier ou ajouter des données spécifiques dans le tampon, vous pouvez utiliser la fonction `Clear()` (pour effacer le tampon interne), `Append()` (pour ajouter des données brutes), ou l'opérateur <<.

Les paquets personnalisés peuvent se révéler utiles dans de nombreuses utilisations : chiffrement, compression, sommes de contrôle, filtrage de ce qui est reçu, ... Vous pouvez même fournir des paquets formattés utilisant une structure fixée, ou des paquets agissant comme des fabriques.

## Conclusion

La classe [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Packet.php "sf::Packet documentation") gère beaucoup de problèmes réseau de bas niveau, et fournit un moyen facile de transférer des données avec les sockets. Je vous encourage à étendre les paquets à vos besoins, en surchargeant les opérateurs << et >>, et en dérivant vos propres classes de paquets si nécessaire.

Il est important de garder en tête que les paquets SFML utilisent leur propre boutisme et structure, vous ne pouvez donc pas les utiliser pour communiquer avec des serveurs qui ne les utilisent pas. Pour envoyer des données brutes, des requêtes HTTP / FTP, ou n'importe quoi d'autre n'utilisant pas la SFML, utilisez des tableaux d'octets plutôt que des paquets SFML.

Vous êtes maintenant prêts à passer au dernier tutoriel, concernant [l'utilisation des sélecteurs](selector.md "Aller au tutoriel suivant").
