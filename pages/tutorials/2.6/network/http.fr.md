# Requêtes web avec HTTP

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#top "Haut de la page")

SFML fournit une classe de client HTTP simple, pour vous permettre de communiquer avec des serveurs web. "Simple" signifie qu'elle supporte uniquement les fonctionnalités les plus basiques de HTTP : les requêtes POST, GET et HEAD, l'accès aux champs d'en-tête, et la lecture/écriture du corps des pages.

S'il vous faut des fonctionnalités plus complexes, comme par exemple le support de HTTP sécurisé (HTTPS), vous devriez plutôt chercher une bibliothèque complètement dédiée à HTTP, comme libcurl ou cpp-netlib.

Mais pour une interaction simple entre un programme et un serveur web, ce sera largement suffisant.

## [sf::Http](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#sfhttp)[](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#top "Haut de la page")

Pour communiquer avec un serveur HTTP, il faut utiliser la classe [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Http.php "sf::Http documentation").

```
#include <SFML/Network.hpp>

sf::Http http;
http.setHost("http://www.some-server.org/");

// ou bien
sf::Http http("http://www.some-server.org/");
```

Notez bien que le fait de renseigner l'hôte ne déclenche pas de connection : une connection temporaire avec le serveur sera faite plus tard pour chaque requête.

Il n'y a plus qu'une autre fonction à voir dans la classe [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Http.php "sf::Http documentation"), et c'est la plus importante car elle envoie les requêtes. Et... c'est en gros tout ce que contient cette classe.

```
sf::Http::Request request;
// paramétrage de la requête...
sf::Http::Response response = http.sendRequest(request);
```

## [Les requêtes](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#les-requcotes)[](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#top "Haut de la page")

Une requête HTTP, représentée par la classe [`sf::Http::Request`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Http_1_1Request.php "sf::Http::Request documentation"), contient les information suivantes :

- La méthode : POST (envoyer du contenu), GET (récupérer une ressource), HEAD (récupérer l'en-tête d'une ressource, sans son corps)
- L'URI : l'adresse de la ressource (page, image, ...) à récupérer/envoyer, relative à l'adresse de l'hôte
- La version HTTP (elle est à 1.0 par défaut mais vous pouvez en choisir une différente si vous utilisez des fonctionnalités spécifiques)
- L'en-tête : une suite de champs définis par une clé et une valeur
- Le corps de la page (utilisé uniquement avec la méthode POST)

```
sf::Http::Request request;
request.setMethod(sf::Http::Request::Post);
request.setUri("/page.html");
request.setHttpVersion(1, 1); // HTTP 1.1
request.setField("From", "me");
request.setField("Content-Type", "application/x-www-form-urlencoded");
request.setBody("para1=value1&param2=value2");

sf::Http::Response response = http.sendRequest(request);
```

SFML définit automatiquement les champs d'en-tête obligatoires, comme par exemple "Host" ou "Content-Length". Vous pouvez donc envoyer vos requêtes sans vous soucier de cela, SFML fera toujours de son mieux pour les rendre valides.

## [Les réponses](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#les-rceponses)[](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#top "Haut de la page")

Si la classe [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Http.php "sf::Http documentation") a pu se connecter à l'hôte et envoyer la requête, alors une réponse est renvoyée par le serveur et retournée à l'utilisateur, encapsulée dans une instance de [`sf::Http::Response`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Http_1_1Response.php "sf::Http::Response documentation"). Les réponses contiennent les membres suivants :

- Un code de statut, qui indique précisément comment le serveur a traité la requête (ok, redirigé, non trouvé, etc.)
- La version HTTP du serveur
- L'en-tête : une suite de champs définis par une clé et une valeur
- Le corps de la réponse

```
sf::Http::Response response = http.sendRequest(request);
std::cout << "status: " << response.getStatus() << std::endl;
std::cout << "HTTP version: " << response.getMajorHttpVersion() << "." << response.getMinorHttpVersion() << std::endl;
std::cout << "Content-Type header:" << response.getField("Content-Type") << std::endl;
std::cout << "body: " << response.getBody() << std::endl;
```

Le code de statut peut être utilisé pour vérifier si la requête a été traitée avec succès ou non : les codes 2xx informent que tout s'est bien passé, les codes 3xx informent d'une redirection, les codes 4xx représentent des erreurs côté client, les codes 5xx sont des erreurs du serveur, et enfin les codes 10xx sont des erreurs spécifiques à SFML, qui ne font pas partie du standard HTTP.

## [Exemple : envoyer des scores à une base de donnée en ligne](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#exemple--envoyer-des-scores-ce-une-base-de-donncee-en-ligne)[](https://www.sfml-dev.org/tutorials/2.6/network-http-fr.php#top "Haut de la page")

Voici un petit exemple qui montre comment réaliser une tâche assez courante : envoyer un score à une base de donnée en ligne.

```
#include <SFML/Network.hpp>
#include <sstream>

void sendScore(int score, const std::string& name)
{
    // préparation de la requête
    sf::Http::Request request("/send-score.php", sf::Http::Request::Post);

    // encodage des paramètres dans le corps de la requête
    std::ostringstream stream;
    stream << "name=" << name << "&score=" << score;
    request.setBody(stream.str());

    // envoi de la requête au serveur
    sf::Http http("http://www.myserver.com/");
    sf::Http::Response response = http.sendRequest(request);

    // vérification du statut
    if (response.getStatus() == sf::Http::Response::Ok)
    {
        // affichage de la réponse du serveur
        std::cout << response.getBody() << std::endl;
    }
    else
    {
        std::cout << "request failed" << std::endl;
    }
}
```

Bien entendu, ceci est une façon très simple de gérer des scores en ligne. Il n'y a aucune protection : n'importe qui pourrait envoyer un faux score facilement. Une approche plus robuste impliquerait certainement d'utiliser en paramètre supplémentaire un code de hachage, qui permettrait au serveur de s'assurer que le score provient bien du logiciel qui est censé l'envoyer, plutôt que d'une requête d'un petit malin. Mais ceci dépasse le cadre de ce tutoriel.

Et, enfin, voici une version très simpliste de ce à quoi pourrait ressembler la page PHP côté serveur.

```
<?php
    $name = $_POST['name'];
    $score = $_POST['score'];
    
    if (write_to_database($name, $score)) // peu importe... ce n'est pas un tutoriel de PHP :)
    {
        echo "name and score added!";
    }
    else
    {
        echo "failed to write name and score to database...";
    }
?>
```