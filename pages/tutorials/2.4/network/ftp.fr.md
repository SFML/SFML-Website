# Transferts de fichiers avec FTP

## [FTP pour les nuls](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#ftp-pour-les-nuls)[](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#top "Haut de la page")

Si vous savez ce qu'est FTP, et que vous souhaitez juste savoir comment utiliser la classe FTP fournie par SFML, vous pouvez sauter ce chapitre.

FTP (_File Transfer Protocol_) est un protocole simple qui permet de manipuler des répertoires et des fichiers sur un serveur distant. Le protocole consiste en des commandes telles que "créer un répertoire", "supprimer un fichier", "télécharger un fichier", etc. Vous ne pouvez cependant pas envoyer de telles commandes à n'importe quel ordinateur distant : il faut qu'il y ait un serveur FTP qui tourne, qui sache comprendre et exécuter les commandes que les clients lui envoient.

Alors, que pouvez-vous faire avec FTP, et à quoi peut-il servir dans votre programme ? En gros, avec FTP, vous pouvez accéder à un système de fichiers distant, ou bien même créer le vôtre. Cela peut être utile si vous voulez que votre jeu réseau télécharge des ressources (cartes, images, ...) depuis un serveur, ou que votre programme se mette à jour automatiquement lorsqu'il est connecté à internet.

Si vous souhaitez en savoir plus sur le protocole FTP, la [page Wikipedia](http://fr.wikipedia.org/wiki/File_Transfer_Protocol "FTP sur wikipedia") est bien entendu beaucoup plus fournie que cette brève introduction.

## [La classe de client FTP](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#la-classe-de-client-ftp)[](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#top "Haut de la page")

La classe fournie par SFML est [`sf::Ftp`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp.php "sf::Ftp documentation") (surprenant n'est-ce pas ?). Elle implémente un client, ce qui signifie qu'elle peut se connecter à un serveur FTP, lui envoyer des commandes et télécharger ou envoyer des fichiers.

Chaque fonction de la classe [`sf::Ftp`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp.php "sf::Ftp documentation") encapsule une commande FTP, et renvoie une réponse FTP standard. Une réponse FTP contient un code de statut (similaire aux codes de statut HTTP -- mais pas les mêmes), ainsi qu'un message qui informe l'utilisateur de ce qui s'est passé. Les réponses FTP sont encapsulées dans la classe [`sf::Ftp::Response`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp_1_1Response.php "sf::Ftp::Response documentation").

```
#include <SFML/Network.hpp>

sf::Ftp ftp;
...
sf::Ftp::Response response = ftp.login(); // juste un exemple, ça pourrait être n'importe quelle fonction

std::cout << "Response status: " << response.getStatus() << std::endl;
std::cout << "Response message: " << response.getMessage() << std::endl;
```

Le code de la réponse peut être utilisé pour vérifier si la commande a été traitée avec succès ou bien a échoué : les codes inférieurs à 400 sont ok, les autres représentent une erreur. Vous pouvez utiliser la fonction `isOk()` comme raccourci pour tester un code de réponse.

```
sf::Ftp::Response response = ftp.login();
if (response.isOk())
{
    // succès !
}
else
{
    // erreur...
}
```

Si vous vous fichez des détails de la réponse, vous pouvez procéder de manière plus concise :

```
if (ftp.login().isOk())
{
    // succès !
}
else
{
    // erreur...
}
```

Pour des raisons de lisibilité, ces vérifications ne seront pas systématiquement écrites dans les autres exemples de ce tutoriel. Mais n'oubliez pas de les écrire dans votre code !

Bien, maintenant que vous comprenez comment la classe fonctionne, voyons un peu plus en détail ce qu'elle peut faire.

## [Se connecter à un serveur FTP](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#se-connecter-ce-un-serveur-ftp)[](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#top "Haut de la page")

La première chose à faire est de se connecter à un serveur FTP.

```
sf::Ftp ftp;
ftp.connect("ftp.myserver.org");
```

L'adresse du serveur peut être n'importe quelle [`sf::IpAddress`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1IpAddress.php "sf::IpAddress documentation") valide : une URL, une adresse IP, un nom d'hôte réseau, ...

Le port standard pour le protocole FTP est le port 21. Cependant, si pour une raison particulière votre serveur utilise un port différent, vous pouvez le donner avec un paramètre supplémentaire :

```
sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 45000);
```

Vous pouvez également passer un troisième paramètre, qui est un temps d'attente maximal. De cette façon, vous pouvez éviter une attente infinie (ou du moins extrêmement longue) dans le cas où le serveur ne répond pas.

```
sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 21, sf::seconds(5));
```

Une fois connecté au serveur, il faut vous authentifier :

```
// authentification avec nom d'utilisateur et mot de passe
ftp.login("username", "password");

// ou anonymement, si le serveur l'autorise
ftp.login();
```

## [Les commandes FTP](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#les-commandes-ftp)[](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#top "Haut de la page")

Voici une brève description de chaque commande disponible dans la classe [`sf::Ftp`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp.php "sf::Ftp documentation"). Souvenez-vous d'une chose : toutes ces commandes sont effectuées relativement au _répertoire de travail_, exactement comme si vous exécutiez des commandes de fichier ou de répertoire dans une console de votre OS.

Récupérer le répertoire de travail :

```
sf::Ftp::DirectoryResponse response = ftp.getWorkingDirectory();
if (response.isOk())
    std::cout << "Current directory: " << response.getDirectory() << std::endl;
```

[`sf::Ftp::DirectoryResponse`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp_1_1DirectoryResponse.php "sf::Ftp::DirectoryResponse documentation") est une [`sf::Ftp::Response`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp_1_1Response.php "sf::Ftp::Response documentation") spécialisée, qui contient en plus le répertoire demandé.

Recupérer la liste des répertoires et fichiers contenus dans le répertoire de travail :

```
sf::Ftp::ListingResponse response = ftp.getDirectoryListing();
if (response.isOk())
{
    const std::vector<std::string>& listing = response.getListing();
    for (std::vector<std::string>::const_iterator it = listing.begin(); it != listing.end(); ++it)
        std::cout << "- " << *it << std::endl;
}

// vous pouvez aussi lister un sous-répertoire du répertoire de travail :
response = ftp.getDirectoryListing("subfolder");
```

[`sf::Ftp::ListingResponse`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp_1_1ListingResponse.php "sf::Ftp::ListingResponse documentation") est une [`sf::Ftp::Response`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Ftp_1_1Response.php "sf::Ftp::Response documentation") spécialisée, qui contient en plus la liste des répertoires/fichiers demandés.

Changer le répertoire de travail :

```
ftp.changeDirectory("path/to/new_directory"); // le chemin donné est relatif au répertoire de travail
```

Aller dans le répertoire parent du répertoire de travail :

```
ftp.parentDirectory();
```

Créer un nouveau répertoire (sous le répertoire de travail) :

```
ftp.createDirectory("name_of_new_directory");
```

Supprimer un répertoire :

```
ftp.deleteDirectory("name_of_directory_to_delete");
```

Renommer un fichier :

```
ftp.renameFile("old_name.txt", "new_name.txt");
```

Supprimer un fichier :

```
ftp.deleteFile("file_name.txt");
```

Télécharger un fichier du serveur :

```
ftp.download("remote_file_name.txt", "local/destination/path", sf::Ftp::Ascii);
```

Le dernier paramètre est le mode de transfert. Il peut être soit Ascii (pour les fichiers textes), Ebcdic (pour les fichiers textes, mais qui utilisent le jeu de caractères EBCDIC -- quelqu'un utilise encore ça ?) ou Binary (pour les fichiers non-texte). Les modes Ascii et Ebcdic peuvent transformer le fichier (fins de lignes, encodage) pendant le transfert afin de coller à l'environnement du client. Le mode Binary quant à lui est un transfert direct d'octets.

Envoyer un fichier au serveur :

```
ftp.upload("local_file_name.pdf", "remote/destination/path", sf::Ftp::Binary);
```

Les serveurs FTP ferment habituellement les connections qui restent inactives pendant un moment. Si vous voulez éviter de vous faire déconnecter pendant que vous ne faites rien, vous pouvez envoyer une commande "vide" (qui ne fait rien) de temps en temps :

```
ftp.keepAlive();
```

## [Se déconnecter du serveur FTP](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#se-dceconnecter-du-serveur-ftp)[](https://www.sfml-dev.org/tutorials/2.6/network-ftp-fr.php#top "Haut de la page")

Vous pouvez fermer la connection avec le serveur à tout moment avec la fonction `disconnect`.

```
ftp.disconnect();
```