# Communiquer avec les sockets

## [Les sockets](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#les-sockets)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Une socket est une porte entre votre application et le monde extérieur : à travers une socket, vous pouvez envoyer et recevoir des données. Ainsi, à peu près tout programme réseau aura affaire à des sockets, elles sont l'élément central de la communication réseau.

Il existe plusieurs types de sockets, qui fournissent chacun des fonctionnalités spécifiques. SFML implémente les types les plus courants : les sockets TCP et les sockets UDP.

## [TCP vs UDP](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#tcp-vs-udp)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Il est important de savoir ce que peuvent faire les sockets TCP et UDP, et ce qu'elles ne peuvent pas faire, de manière à pouvoir choisir le type qui correspond aux besoins de votre application.

La principale différence est que les sockets TCP sont connectées. Vous ne pouvez ni recevoir ni envoyer de données avant d'avoir explicitement connecté la socket à une autre socket, sur la machine distante. Une fois connectée, une socket TCP peut uniquement envoyer et recevoir vers/depuis la socket à laquelle elle est connectée. Vous aurez donc besoin d'une socket TCP pour chaque client dans votre application.  
Les sockets UDP par contre ne sont pas connectées, vous pouvez envoyer et recevoir vers/depuis n'importe qui à n'importe quel moment avec la même socket.

Deuxième différence : TCP est plus fiable que UDP. TCP garantit que ce que vous envoyez est toujours reçu, sans perte ni corruption, et toujours dans le bon ordre. UDP effectue moins de vérifications, et fournit un niveau de robustesse moindre : ce que vous envoyez peut arriver dupliqué, désordonné, voire même être perdu et ne jamais atteindre l'ordinateur distant. Cependant, les données qui sont reçues sont toujours valides (elles ne peuvent pas être corrompues).  
UDP peut avoir l'air effrayant après une telle description, mais gardez en tête que _la plupart du temps_, les données arrivent à destination et dans le bon ordre.

La troisième différence est une conséquence directe de la seconde : UDP est plus rapide et plus léger que TCP. Il a moins de contraintes, donc il utilise moins de ressources.

La dernière différence concerne la manière dont sont transportées les données. TCP est un protocole en _flux_ : il n'y a pas de limite de message, si vous envoyez "Hello" puis "SFML", la machine distante peut très bien recevoir "HelloSFML", "Hel" + "loSFML", ou bien encore "He" + "loS" + "FML". Le protocole est libre de rassembler et/ou découper les données comme bon lui semble.  
UDP est un protocole de _datagrammes_. Les datagrammes sont des paquets de données, qui ne peuvent pas se mélanger. Si vous recevez un datagramme UDP, alors vous êtes garantis d'avoir les données exactement telles qu'elles ont été envoyées, ni plus ni moins. Donc pour résumer, UDP n'offre aucune garantie sur l'arrivée des datagrammes, mais lorsqu'ils arrivent, leur contenu est forcément tel qu'il a été envoyé.

Oh, et une dernière chose : puisqu'UDP n'est pas connecté, il permet de diffuser des messages à de multiples destinataires, voire même à un réseau tout entier. La communication 1-1 des sockets TCP ne le permet pas.

## [Connecter une socket TCP](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#connecter-une-socket-tcp)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Comme vous pouvez le deviner, cette partie concerne uniquement les sockets TCP. Il y a deux facettes à une connexion : d'un côté, celui qui attend la connexion entrante (appelons-le le serveur), et de l'autre, celui qui initie la connexion (appelons-le le client).

Côté client, les choses sont relativement simples : l'utilisateur doit just avoir un [`sf::TcpSocket`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1TcpSocket.php "sf::TcpSocket documentation") et appeler sa fonction `connect` afin de déclencher la connexion.

```
#include <SFML/Network.hpp>

sf::TcpSocket socket;
sf::Socket::Status status = socket.connect("192.168.0.5", 53000);
if (status != sf::Socket::Done)
{
    // erreur...
}
```

Le premier paramètre est l'adresse de l'hôte auquel se connecter. C'est un paramètre de type [`sf::IpAddress`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1IpAddress.php "sf::IpAddress documentation"), qui peut représenter tout type d'adresse : une URL, une adresse IP, ou un nom d'hôte réseau. Vous pouvez jeter un oeil à la documentation pour plus de détails concernant cette classe.

Le deuxième paramètre est le port auquel se connecter sur la machine distante. La connection ne pourra fonctionner que si le serveur est en train d'attendre une connexion sur ce port.

Il y a un troisième paramètre, optionnel, qui est un timeout. S'il est renseigné, et que la connexion n'aboutit pas avant qu'il soit écoulé, la connexion échoue et la fonction renvoie une erreur. Si ce paramètre n'est pas renseigné, le timeout par défaut de l'OS est utilisé.

Une fois connecté, vous pouvez récupérer l'adresse et le port de la machine distante si nécessaire, avec les fonctions `getRemoteAddress()` et `getRemotePort()`.

Toutes les fonctions des classes de sockets sont bloquantes par défaut. Cela signifie que votre programme (ou du moins le thread qui contient l'appel) sera bloqué jusqu'à ce que l'action correspondante se termine. C'est très important car certaines fonctions peuvent prendre un temps considérable : par exemple, se connecter à un hôte qui ne répond pas peut durer plusieurs secondes, ou encore, recevoir ne va pas rendre la main tant que quelque chose n'a pas effectivement été été reçu, etc.  
Vous pouvez modifier ce comportement et rendre toutes les fonctions non-bloquantes, avec la fonction `setBlocking` de la socket. Voyez plus bas pour plus de détails.

Côté serveur, il y a un peu plus de choses à faire. Plusieurs sockets sont nécessaires : une qui écoute les connections entrantes, puis une pour chaque client connecté.

Pour écouter les connexions, vous devez utiliser la classe spéciale [`sf::TcpListener`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1TcpListener.php "sf::TcpListener documentation"). Son unique but est d'attendre des connexions sur un port donné, elle ne peut pas envoyer ou recevoir de données.

```
sf::TcpListener listener;

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
```

La fonction `accept` bloque jusqu'à ce qu'une connexion arrive (à moins que la socket ne soit passée en mode non-bloquant). Lorsque cela arrive, la fonction initialise la socket qu'elle a reçu en paramètre puis rend la main ; cette socket peut désormais être utilisée pour communiquer avec le client, et l'écouteur peut recommencer à attendre une nouvelle connexion.

Après un appel réussi à `connect` (côté client) et `accept` (côté serveur), la communication est établie et les deux sockets sont prêtes à échanger des données.

## [Lier une socket UDP à un port](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#lier-une-socket-udp-ce-un-port)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Une socket UDP n'est pas connectée, mais vous devrez tout de même la lier à un port afin de pouvoir recevoir des données sur ce port. Une socket UDP ne peut en effet pas recevoir tout ce qui arrive sur tous les ports.

```
sf::UdpSocket socket;

// lie la socket à un port
if (socket.bind(54000) != sf::Socket::Done)
{
    // erreur...
}
```

Après avoir lié la socket à un port, elle est prête a recevoir des données sur ce port. Si vous souhaitez que l'OS choisisse automatiquement un port libre, vous pouvez passer `sf::Socket::AnyPort`, puis récupérer le port choisi avec `socket.getLocalPort()`.

Les sockets UDP qui envoient des données n'ont rien besoin de faire de particulier avant de pouvoir envoyer.

## [Envoyer et recevoir des données](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#envoyer-et-recevoir-des-donncees)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

L'envoi et la réception de données est similaire pour les deux types de sockets. La seule différence est que UDP aura deux paramètres supplémentaires : l'adresse et le port de l'expéditeur / du destinataire. Il existe deux functions distinctes pour chacune de ces opérations : la fonction "bas-niveau", qui envoient/reçoivent un tableau brut d'octets, et la fonction plus haut-niveau, qui utilise la classe [`sf::Packet`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Packet.php "sf::Packet documentation"). Vous pouvez aller jeter un oeil au [tutoriel sur les paquets](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php "Tutoriel sur les paquets") pour plus de détails concernant cette classe ; ici nous ne détaillerons donc que les fonctions bas-niveau.

Pour envoyer des données, vous devez appeler la fonction `send` avec un pointeur sur les données, et le nombre d'octets à envoyer.

```
char data[100] = ...;

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
```

La fonction `send` prend les données sous forme d'un `void*`, vous pouvez donc passer l'adresse de n'importe quoi. Cependant, il est généralement déconseillé d'envoyer autre chose qu'un tableau d'octets, car les types natifs plus gros qu'1 octet peuvent ne pas être les mêmes d'une machine à l'autre : les types tels que int ou long peuvent avoir une taille différente, et/ou un boutisme (_endianness_) différent. Ainsi, ces types ne peuvent pas être échangés de manière fiable entre différents systèmes. Ce problème est expliqué (et résolu) dans le [tutoriel sur les paquets](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php "Tutoriel sur les paquets").

Avec UDP il est possible d'envoyer un message à tout un sous-réseau en un seul appel : pour cela vous pouvez utiliser l'adresse spéciale `sf::IpAddress::Broadcast`.

Il y a autre chose à garder en tête avec UDP : étant donné que les données sont envoyées en datagrammes, et que la taille de ces datagrammes possède une limite, vous ne pouvez pas dépasser celle-ci. Chaque appel à `send` doit envoyer moins de `sf::UdpSocket::MaxDatagramSize` octets -- qui vaut un peu moins de 2^16 (65536) octets.

Pour recevoir des données, vous devez appeler la fonction `receive` :

```
char data[100];
std::size_t received;

// socket TCP:
if (socket.receive(data, 100, received) != sf::Socket::Done)
{
    // erreur...
}
std::cout << "Received " << received << " bytes" << std::endl;

// socket UDP:
sf::IpAddress sender;
unsigned short port;
if (socket.receive(data, 100, received, sender, port) != sf::Socket::Done)
{
    // erreur...
}
std::cout << "Received " << received << " bytes from " << sender << " on port " << port << std::endl;
```

Il est important de noter que, si la socket est en mode bloquant, `receive` va attendre jusqu'à ce que quelque chose ait été reçu, bloquant le thread qui l'a appelé (et donc potentiellement le programme tout entier).

Les deux premiers paramètres sont le buffer dans lequel doivent être copiés les octets reçus, et sa taille maximum. Le troisième paramètre est une variable qui sera remplie avec le nombre d'octets ayant été reçus.  
Avec les sockets UDP, les deux derniers paramètres sont remplis avec l'adresse et le port de l'expéditeur ; ils peuvent être utilisés plus tard pour renvoyer une réponse.

Ces fonctions sont assez bas niveau, et vous ne devriez les utiliser que si vous avez une bonne raison de le faire. Une approche plus flexible et robuste consiste à utiliser les [paquets](https://www.sfml-dev.org/tutorials/2.6/network-packet-fr.php "Tutoriel sur les paquets").

## [Bloquer sur un groupe de sockets](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#bloquer-sur-un-groupe-de-sockets)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Bloquer sur chaque socket peut rapidement devenir un problème, car à terme, vous aurez très certainement à gérer plus d'un client à la fois. Et vous ne voulez pas que la socket A bloque votre programme alors que la socket B vient de recevoir des données qui pourraient être traitées. Ce que vous aimeriez, c'est bloquer sur tout un groupe de sockets en même temps, c'est-à-dire attendre jusqu'à ce que _n'importe laquelle d'entre elles_ ait reçu quelque chose. Ceci est possible avec les sélecteurs, représentés par la classe [`sf::SocketSelector`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SocketSelector.php "sf::SocketSelector documentation").

Un sélecteur peut surveiller tout type de socket : [`sf::TcpSocket`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1TcpSocket.php "sf::TcpSocket documentation"), [`sf::UdpSocket`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1UdpSocket.php "sf::UdpSocket documentation"), et [`sf::TcpListener`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1TcpListener.php "sf::TcpListener documentation"). Pour ajouter une socket à un sélecteur, utilisez sa fonction `add` :

```
sf::TcpSocket socket;

sf::SocketSelector selector;
selector.add(socket);
```

Un sélecteur n'est pas un conteneur de sockets. Il ne fait que référencer (pointer vers) les sockets que vous lui ajoutez, il ne les stocke pas. Ainsi, vous ne devriez pas essayer d'accéder aux sockets que vous mettez dedans ; vous devriez plutôt avoir votre propre stockage de sockets à part (avec par exemple un `std::vector` ou un `std::list`).

Une fois que vous avez rempli le sélecteur avec toutes les sockets que vous voulez surveiller, vous devez appeler sa fonction `wait`, afin d'attendre jusqu'à ce que l'une d'entre elles ait reçu quelque chose (ou bien ait déclenché une erreur). Vous pouvez aussi passer un timeout optionel, de sorte que la fonction échoue si aucune socket n'a rien reçu pendant un certain temps -- cela évite de rester bloqué indéfiniment si rien ne se passe.

```
if (selector.wait(sf::seconds(10.f)))
{
    // on a reçu quelque chose
}
else
{
    // temps écoulé, rien n'a été reçu...
}
```

Si la fonction `wait` renvoie `true`, cela signifie qu'une ou plusieurs socket(s) ont reçu quelque chose, et que vous pouvez appeler `receive` sur ces sockets : vous êtes assuré qu'elles ne bloqueront pas. Si la socket est un [`sf::TcpListener`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1TcpListener.php "sf::TcpListener documentation"), cela signifie qu'une connexion entrante est en attente, et que vous pouvez appeler sa fonction `accept`.

Etant donné que le sélecteur n'est pas un conteneur de sockets, il ne peut pas directement vous retourner les sockets qui sont prêtes à recevoir. Au lieu de cela, vous devez tester les candidates une par une avec la fonction `isReady` :

```
if (selector.wait(sf::seconds(10.f)))
{
    // pour chaque socket... <-- pseudo-code, car je ne sais pas comment vous stockez vos sockets :)
    {
        if (selector.isReady(socket))
        {
            // cette socket est prête, on peut recevoir (ou accepter une connexion, si c'est un listener)
            socket.receive(...);
        }
    }
}
```

Vous pouvez jeter un oeil à la documentation de l'API de la classe [`sf::SocketSelector`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SocketSelector.php "sf::SocketSelector documentation") si vous voulez un exemple complet et fonctionnel de l'utilisation d'un sélecteur pour gérer les connections et messages de plusieurs clients.

Petit bonus : le fait que `Selector::wait` sache gérer un timeout permet d'écrire très facilement une fonction de réception avec timeout, chose qui n'est pas directement disponible dans les classes de sockets.

```
sf::Socket::Status receiveWithTimeout(sf::TcpSocket& socket, sf::Packet& packet, sf::Time timeout)
{
    sf::SocketSelector selector;
    selector.add(socket);
    if (selector.wait(timeout))
        return socket.receive(packet);
    else
        return sf::Socket::NotReady;
}
```

## [Les sockets non-bloquantes](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#les-sockets-non-bloquantes)[](https://www.sfml-dev.org/tutorials/2.6/network-socket-fr.php#top "Haut de la page")

Toutes les sockets sont bloquantes par défaut, mais vous pouvez changer ce comportement à tout moment avec la fonction `setBlocking`.

```
sf::TcpSocket tcpSocket;
tcpSocket.setBlocking(false);

sf::TcpListener listenerSocket;
listenerSocket.setBlocking(false);

sf::UdpSocket udpSocket;
udpSocket.setBlocking(false);
```

Une fois qu'une socket est non-bloquante, ses fonctions rendent toujours la main immédiatement. Par exemple, `receive` va se terminer en renvoyant le code `sf::Socket::NotReady` s'il n'y a aucune donnée à recevoir. Ou encore, `accept` va terminer immédiatement, avec le même code de retour, s'il n'y a aucune connexion en attente.

Les sockets non-bloquantes sont la solution la plus simple à mettre en oeuvre si vous avez déjà une boucle de jeu qui tourne régulièrement. Vous pouvez de cette manière vérifier si quoique ce soit est arrivé sur vos sockets à chaque itération de la boucle principale, sans bloquer l'exécution du programme.

Lorsque vous utilisez `sf::TcpSocket` en mode non-bloquant, rien ne garantit que les appels à `send` envoient la totalité des données que vous leur passez, qu'il s'agisse de données brutes ou bien de `sf::Packet`. A partir de SFML 2.3, lorsque vous envoyez des données brutes via une `sf::TcpSocket` non-bloquante, assurez-vous de toujours utiliser la surcharge `send(const void* data, std::size_t size, std::size_t& sent)`, qui renvoie le nombre d'octets réellement envoyés via le paramètre `sent`. Que ce soit un `sf::Packet` ou des données brutes, si uniquement une partie des données a pu être envoyée lors de l'appel, le code de retour sera `sf::Socket::Partial` pour indiquer un envoi partiel. _Lorsque `sf::Socket::Partial` est renvoyé, vous devez gérer vous-même correctement le reste de l'envoi, sans quoi les données seront susceptibles d'être corrompues._ Lorsque vous envoyez des données brutes, vous devez essayer à nouveau d'envoyer les données à partir de l'octet auquel l'appel précédent à `send` s'est arrêté. Lorsque vous envoyez un `sf::Packet`, la position est sauvegardée directement dans celui-ci ; dans ce cas, vous devez juste réessayer d'envoyer _exactement le même paquet inchangé_ encore et encore, jusqu'à ce qu'un autre code que `sf::Socket::Partial` soit renvoyé. Construire une nouvelle instance de `sf::Packet` et la remplir avec les mêmes données ne fonctionnera pas, cela doit impérativement être la même instance qui avait été précédemment envoyée.