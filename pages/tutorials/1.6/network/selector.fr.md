# Utiliser un sélecteur

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/network/socket/).

## Introduction

Comme vous avez pu le voir dans le tutoriel précédent, certaines fonctions des sockets (`Accept`, `Receive`) sont bloquantes, ce qui signifie qu'elles vont stopper l'exécution du programme tout entier si elles sont utilisées. Cela signifie également que vous ne pourrez jamais attendre sur deux sockets en même temps. Une bonne solution est d'utiliser un thread : placez les appels bloquants dans un nouveau thread, et votre programme sera toujours capable de tourner pendant que les sockets sont en attente. Mais utiliser des threads n'est pas simple : cela requiert une bonne synchronisation, peut être difficile à déboguer, et peut dégrader les performances si vous utilisez beaucoup de threads.

L'autre solution est d'utiliser des sélecteurs. Les sélecteurs permettent de multiplexer un ensemble de sockets, sans avoir à faire tourner un autre thread. Ils sont toujours bloquants, mais rendront la main dès que l'un des sockets est prêt. Les sélecteurs peuvent aussi utiliser une valeur de *timeout*, pour éviter d'attendre indéfiniment.

## Gérer plusieurs clients

Il existe deux types de sélecteurs dans la SFML : [`sf::SelectorTCP`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Selector.php "sf::SelectorTCP documentation") (pour les sockets TCP) et [`sf::SelectorUDP`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Selector.php "sf::SelectorUDP documentation") (pour les sockets UDP). Cependant seul le type de socket diffère, les fonctions et le comportement sont exactement les mêmes pour les deux classes.

Donc, tentons d'utiliser un sélecteur TCP. Ici nous allons construire un serveur qui sera capable de gérer plusieurs clients à la fois, sans utiliser le moindre thread.

```cpp
#include <SFML/Network.hpp>

sf::SelectorTCP Selector;
```

Les sélecteurs se comportent comme des tableaux : vous pouvez ajouter (`Add`) et retirer (`Remove`) des sockets, ou encore les vider (`Clear`). Ici nous allons ajouter tous nos sockets, puisque nous voulons être notifiés à chaque fois qu'un client nous envoie un message.

Avant d'ajouter le moindre client dans le sélecteur, souvenez-vous qu'il faut utiliser un socket écouteur, qui attendra les connexions entrantes. Accepter une connexion étant bloquant, nous devrons aussi placer le socket écouteur dans le sélecteur.

```cpp
sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Erreur...
}

Selector.Add(Listener);
```

Puis vous pouvez commencer une boucle infinie qui va recevoir à la fois les connexions entrantes, et les messages en provenance des clients connectés.  
Pour récupérer les sockets prêts dans le sélecteur, il faut appeler sa fonction `Wait` suivie par `GetSocketReady` :

```cpp
while (true)
{
    unsigned int NbSockets = Selector.Wait();

    for (unsigned int i = 0; i < NbSockets; ++i)
    {
        sf::SocketTCP Socket = Selector.GetSocketReady(i);

        // Faire quelque chose avec Socket...
    }
}
```

`Wait` peut prendre un paramètre optionnel, qui est une durée de *timeout* (temps au bout duquel on stoppe l'attente si rien n'a été reçu) en secondes.

Notez bien qu'à chaque appel de `Wait`, le sélecteur va attendre jusqu'à ce qu'au moins un socket soit prêt. Donc si vous l'appelez deux fois en un tour de boucle, ne vous attendez pas à ce que la fonction rende la main instantanément, ou renvoie les mêmes sockets.

Regardons ce que nous allons placer dans la boucle ci-dessus. Visiblement, nous allons appeler `Receive` sur notre socket, étant donné qu'il est supposé être prêt à recevoir. Mais n'oubliez pas que notre socket écouteur se trouve également dans le sélecteur, et s'il est prêt alors il faudra accepter une connexion entrante plutôt que de recevoir un paquet. Et si un nouveau client se connecte, il faudra ajouter le nouveau socket au sélecteur.

```cpp
La boucle ci-dessus...
{
    // On récupère le socket
    sf::SocketTCP Socket = Selector.GetSocketReady(i);

    if (Socket == Listener)
    {
        // Si le socket écouteur est prêt, cela signifie que nous pouvons accepter une nouvelle connexion
        sf::IPAddress Address;
        sf::SocketTCP Client;
        Listener.Accept(Client, &Address);
        std::cout << "Client connected ! (" << Address << ")" << std::endl;

        // On l'ajoute au sélecteur
        Selector.Add(Client);
    }
    else
    {
        // Sinon, il s'agit d'un socket de client et nous pouvons lire les données qu'il nous envoie
        sf::Packet Packet;
        if (Socket.Receive(Packet) == sf::Socket::Done)
        {
            // On extrait le message et on l'affiche
            std::string Message;
            Packet >> Message;
            std::cout << "A client says : \"" << Message << "\"" << std::endl;
        }
        else
        {
            // Erreur : on ferait mieux de retirer le socket du sélecteur
            Selector.Remove(Socket);
        }
    }
}
```

Le code pour le client est très simple : il se connecte au serveur, récupère les saisies de l'utilisateur et les envoie au serveur. Tout est inclus dans le code source téléchargeable au bas de la page.

## Une fonction de réception avec &lt;em>timeout&lt;/em>

Etant donné que le sélecteur peut utiliser un *timeout*, et qu'il n'y a aucun problème à ne placer qu'un seul socket dedans, nous pouvons l'utiliser pour construire une fonction de réception qui prendra en paramètre supplémentaire un *timeout*, c'est-à-dire une durée au bout de laquelle on va annuler l'attente même si rien n'a été reçu. Cela peut être utile par exemple pour implémenter une fonction de *ping*, qui vérifie périodiquement si un client est toujours connecté.

```cpp
bool ReceiveWithTimeout(sf::SocketTCP Socket, sf::Packet& Packet, float Timeout = 0)
{
    sf::SelectorTCP Selector;
    Selector.Add(Socket);

    if (Selector.Wait(Timeout) > 0)
    {
        Socket.Receive(Packet);
        return true;
    }
    else
    {
        return false;
    }
}
```

## Conclusion

Les sélecteurs sont un outil puissant pour les applications multi-client, et sont bien souvent beaucoup plus pratiques que de faire tourner plusieurs threads. N'hésitez pas à les utiliser.
