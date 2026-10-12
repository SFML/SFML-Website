# Utiliser FTP

## Introduction

FTP (*File Transfer Protocol*) est un protocole très utilisé pour transférer et accéder à des fichiers via internet, ou tout autre réseau. Il consiste en une architecture client-serveur qui est globalement très simple : le client envoie une commande au serveur, qui exécute celle-ci et renvoie une réponse au client pour l'informer du succès ou de l'échec de l'opération.

SFML fournit une classe simple qui implémente un client FTP ainsi que toutes les commandes qu'il peut envoyer à un serveur FTP : [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp.php "sf::Ftp documentation").

## Réponses FTP

Avant d'utiliser notre classe FTP, il faut expliquer le concept des réponses. Toute action FTP est en interne une commande qui est exécutée par le serveur, et qui retourne une réponse contenant un code d'état et un message. Ainsi, tout appel à une fonction de [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp.php "sf::Ftp documentation") retourne une telle réponse, représentée par la classe [`sf::Ftp::Response`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp_1_1Response.php "sf::Ftp::Response documentation"). Celle-ci est une simple encapsulation des réponses FTP, et contient le code d'état et le message renvoyés par le serveur.

```cpp
sf::Ftp Server;
sf::Ftp::Response Resp = Server.xxx(); // Voir ci-dessous...

sf::Ftp::Response::Status Status = Resp.GetStatus();
std::string Message = Resp.GetMessage();
```

Le code d'état et le message peuvent être utiles si vous souhaitez afficher des informations détaillées concernant ce qu'il se passe du côté du serveur, sinon ils peuvent simplement être ignorés. La seule chose importante est de vérifier si le code d'état représente un succès ou un échec de l'opération, ce qui peut être fait facilement avec la fonction `IsOk`.

```cpp
bool Success = Resp.IsOk();
```

Ainsi, toute commande FTP peut être vérifiée directement :

```cpp
if (Server.xxx().IsOk())
{
    // Succès
}
else
{
    // Echec
}
```

## Connection à un serveur FTP

La première étape est de se connecter à un serveur FTP.

```cpp
sf::Ftp Server;
if (Server.Connect("ftp.myserver.com").IsOk())
{
    // Ok, nous sommes connectés
}
```

L'adresse du serveur peut être n'importe quelle [`sf::IPAddress`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1IPAddress.php "sf::IPAddress documentation") valide : une URL, une adresse IP, un nom réseau, etc.

La fonction `Connect` peut accepter deux paramètres optionnels supplémentaires : un port réseau et une valeur de timeout.  
Le port par défaut utilisé par le protocole FTP est 21, mais certaines applications peuvent vouloir en utiliser un autre.  
Le timeout peut être utilisé pour s'assurer que l'application ne va pas geler trop longtemps si le serveur ne répond pas ; si vous n'en spécifiez pas, ce sera la valeur par défaut du système qui sera utilisée.

Voici un exemple utilisant le port 50 et une valeur de 3 secondes pour le timeout :

```cpp
if (Server.Connect("ftp.myserver.com", 50, 3).IsOk())
{
    // Ok, nous sommes connectés
}
```

Une fois connecté au serveur, vous devez vous identifier avec votre nom d'utilisateur et votre mot de passe.

```cpp
if (Server.Login("username", "password").IsOk())
{
    // Ok, nous sommes identifiés
}
```

Vous pouvez également vous connecter de manière anonyme si le serveur supporte cette option :

```cpp
if (Server.Login().IsOk())
{
    // Ok, nous sommes connectés en tant qu'utilisateur anonyme
}
```

Vous êtes désormais identifiés sur le serveur, voyons ce que vous allez pouvoir faire avec lui.

## Les commandes FTP

Parce que le protocole FTP a pour but la manipulation de fichiers, on peut le voir comme un système de fichiers distant. Ainsi, les commandes qu'il définit sont similaires à celles que vous pouvez trouver sur votre système d'exploitation favori : parcourir les répertoires, afficher leur contenu, copier des fichiers, etc.

Voici une liste des commandes FTP gérées par [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp.php "sf::Ftp documentation").

`GetWorkingDirectory` récupère le répertoire de travail courant. Elle retourne une réponse spécialisée, de type [`sf::Ftp::DirectoryResponse`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp_1_1DirectoryResponse.php "sf::Ftp::DirectoryResponse documentation"), qui contient le répertoire renvoyé par le serveur en plus des membres habituels.

```cpp
sf::Ftp::DirectoryResponse Resp = Server.GetWorkingDirectory();
if (Resp.IsOk())
{
    std::string Directory = Resp.GetDirectory();
}
```

`GetDirectoryListing` récupère le contenu du répertoire donné, relatif au répertoire de travail courant. Il renvoie une réponse spécialisée, de type [`sf::Ftp::ListingResponse`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp_1_1ListingResponse.php "sf::Ftp::ListingResponse documentation"), qui contient la liste des sous-fichiers et sous-répertoires renvoyée par le serveur en plus des membres habituels.

```cpp
sf::Ftp::ListingResponse Resp = Server.GetDirectoryListing("some_directory");
if (Resp.IsOk())
{
    for (std::size_t i = 0; i < Resp.GetCount(); ++i)
    {
        std::string Filename = Resp.GetFilename(i);
    }
}
```

`ChangeDirectory` spécifie un nouveau répertoire de travail, relatif à l'actuel répertoire de travail. Cela peut être un chemin composé, séparé par des slashs.

```cpp
Server.ChangeDirectory("some/directory");
```

`ParentDirectory` met le répertoire de travail au parent du répertoire actuel. C'est en fait équivalent à un appel à `ChangeDirectory("..")`.

```cpp
Server.ParentDirectory();
```

`MakeDirectory` crée un nouveau répertoire fils du répertoire courant.

```cpp
Server.MakeDirectory("new_dir");
```

`DeleteDirectory` supprime le répertoire passé en paramètre (relatif au répertoire de travail courant). Attention, cette manipulation est définitive !

```cpp
Server.DeleteDirectory("dir_to_remove");
```

`RenameFile` renomme un fichier.

```cpp
Server.RenameFile("file.txt", "new_name.txt");
```

`DeleteFile` supprime un fichier existant.

```cpp
Server.DeleteFile("file.txt");
```

`Download` transfère un fichier du serveur vers le client. Il existe trois modes de transfert : binaire (par défaut, adapté à tout fichier), Ascii (optimisé pour les fichiers text ASCII) et Ebcdic (optimisé pour les fichiers text EBCDIC).

```cpp
Server.Download("distant_file.txt", "dest_dir", sf::Ftp::Binary);
```

`Upload` transfère un fichier du client vers le serveur. Les modes de transferts sont les mêmes que pour la fonction `Download`.

```cpp
Server.Upload("local_file.txt", "dest_dir", sf::Ftp::Binary);
```

Note : les fonctions `Download` et `Upload` peuvent prendre un certain temps à terminer, selon la taille du fichier à transférer. Si vous ne voulez pas bloquer votre application, il peut être une bonne idée de les exécuter dans un thread.

`KeepAlive` est une fonction particulière qui ne fait rien. La plupart des serveurs FTP déconnectent les clients après plusieurs minutes d'inactivité ; cette fonction peut être appelée lorsque rien ne se passe, pour empêcher cette déconnexion automatique.

```cpp
Server.KeepAlive();
```

`Disconnect` déconnecte le client du serveur. Appeler cette fonction n'est pas obligatoire (mais recommandé) étant donné que ce sera de toute façon fait à la destruction des instances de [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Ftp.php "sf::Ftp documentation").

```cpp
Server.Disconnect();
```

## Conclusion

Ceci était le dernier tutoriel concernant le module réseau. Vous pouvez maintenant [passer à une autre section](../index.md "Retour au sommaire des tutoriels"), et apprendre à utiliser un nouveau module SFML.
