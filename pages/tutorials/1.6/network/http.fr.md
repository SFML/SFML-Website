# Utiliser HTTP

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/network/http/).

## Introduction

HTTP (*HyperText Transfer Protocol*) est le protocole utilisé pour transférer des fichiers sur internet : pages web, images, etc. Il consiste en une architecture client-serveur où le client envoie des requêtes, et le serveur renvoie des réponses contenant les ressources demandées par le client.

SFML fournit une class qui implémente un client HTTP : [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation").

## Requêtes

Une requête HTTP dans SFML est représentée par la classe [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation"). Celle-ci contient cinq membres :

- Une méthode, qui est l'action à exécuter; elle peut être l'une des valeurs suivantes:
    - `sf::Http::Request::Get`: récupère la ressource demandée (page, image, etc.)
    - `sf::Http::Request::Post`: envoie du contenu au serveur
    - `sf::Http::Request::Head`: récupére uniquement l'en-tête de la ressource demandée, sans son contenu
- Une URI, qui est l'adresse de la ressource à récupérer sir la méthode est `Get` ou `Head`, ou la page à laquelle envoyer du contenu si la méthode est `Post`; cette URI est relative à l'adresse du serveur (voir plus bas)
- Un corps, qui est le contenu à envoyer si la méthode est `Post`; ce membre est ignoré si la méthode est `Get` ou `Head`
- Une version HTTP, qui est utilisée par le serveur pour identifier quelle version du protocole le client utiliser; cette version est 1.0 si vous ne la spécifiez pas explicitement (ce qui fonctionnera dans la plupart des situations)
- Une liste de paires &lt;nom, valeur>, qui sont des options à passer au serveur; certaines de ces options sont obligatoires (comme par exemple "Host", "From", ou "Content-Length") mais SFML s'occupe de les remplir correctement si vous ne le faites pas

Chacun de ces cinq membres peut être modifié via les accesseurs de la classe [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation"):

```cpp
sf::Http::Request Request;
Request.SetMethod(sf::Http::Request::Get);
Request.SetURI("/");
Request.SetBody("");
Request.SetHttpVersion(1, 0);
Request.SetField("From", "my_email@gmail.com");
```

Notez que tous ces membres ont une valeur par défaut correcte; SFML s'assure que vos requêtes sont toujours bien valides quoique vous fassiez, ainsi vous pouvez vous concentrer sur les paramètres importants (comme l'URI à récupérer) et laisser de côté les détails ennuyeux du protocole HTTP.  
Cette requête pourrait donc être simplifiée au morceau de code suivant :

```cpp
sf::Http::Request Request;
Request.SetURI("/");
```

## Réponses

Après avoir envoyé une requête (ce que nous verrons dans le chapitre suivant), vous recevez une réponse du serveur. Cette réponse est représentée par la classe [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation").

Une réponse consiste en quatre membres :

- Un code d'état qui informe quant au succès ou à l'échec de la requête
- Un corps, qui est le contenu de la ressource demandée; si cette ressource est une page web, le corps contient le code HTML de la page. Il peut aussi être vide ou contenir le code HTML d'une page d'erreur, si la requête a echoué
- Une version HTTP, qui est celle utilisée par le serveur
- Une liste de paires &lt;nom, valeur>, qui représente diverses informations sur le serveur qui sont transmises au client

Tous ces membres peuvent être lus via les accesseurs de la classe [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation") :

```cpp
sf::Http::Response Response;
...
sf::Http::Response::Status Status = Response.GetStatus();
unsigned int Major = Response.GetMajorHttpVersion();
unsigned int Minor = Response.GetMinorHttpVersion();
std::string Body = Response.GetBody();
std::string Type = Response.GetField("Content-Type");
```

Les codes d'état sont décrits dans l'énumeration `sf::Http::Response::Status`. Il existe plusieurs codes de succès, mais le principal est `sf::Http::Response::Ok`.

## Assembler tout ça

Maintenant que vous savez écrire des requêtes et lire des réponses, il ne vous manque que deux choses : se connecter à un serveur HTTP, et envoyer les requêtes.

La connection à un serveur est effectuée via la fonction `SetHost` :

```cpp
sf::Http Http;
Http.SetHost("www.whatismyip.org");
```

En fait, cette fonction ne fait rien d'autre que mémoriser le nom de l'hôte, la connexion ne s'effectue réellement qu'avant requête, puis est refermée juste après avoir reçu la réponse. C'est pourquoi cette fonction est nommée `SetHost` plutôt que `Connect`.

Cette fonction peut accepter un paramètre additionnel : le port réseau à utiliser pour la connexion. Si vous ne le spécifiez pas explicitement, SFML utilisera simplement le port par défaut associé au protocole utilisé : 80 pour HTTP, 443 pour HTTPS.

Une fois le serveur défini, vous pouvez envoyer des requêtes avec la fonction `SendRequest` :

```cpp
sf::Http::Response Response = Http.SendRequest(Request);
```

Cette fonction prend en paramètre un [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation"), et retourne une instance de [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation").

C'est tout pour ce qui est de l'interface de la classe [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation"), seulement deux fonctions ! Il n'y a même pas besoin de se déconnecter du serveur, étant donné que c'est fait automatiquement après chaque appel à `SendRequest`.

## Conclusion

La classe [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation") est un outil puissant pour manipuler le protocole HTTP, et accéder à des pages web ou à des fichiers via internet.  
Jetons maintenant un oeil à son frère, le [protocole FTP](ftp.md "Aller au tutoriel suivant").
