<?php

    $title = "Requêtes web avec HTTP";
    $page = "network-http-fr.php";

    require("header-fr.php");

?>

<h1>Requêtes web avec HTTP</h1>

<?php h2('Introduction') ?>
<p>
    SFML fournit une classe de client HTTP simple, pour vous permettre de communiquer avec des serveurs web. "Simple" signifie qu'elle supporte uniquement les fonctionnalités
    les plus basiques de HTTP : les requêtes POST, GET et HEAD, l'accès aux champs d'en-tête, et la lecture/écriture du corps des pages.
</p>
<p>
    S'il vous faut des fonctionnalités plus complexes, comme par exemple le support de HTTP sécurisé (HTTPS), vous devriez plutôt chercher une bibliothèque complètement
    dédiée à HTTP, comme libcurl ou cpp-netlib.
</p>
<p>
    Mais pour une interaction simple entre un programme et un serveur web, ce sera largement suffisant.
</p>

<?php h2('sf::Http') ?>
<p>
    Pour communiquer avec un serveur HTTP, il faut utiliser la classe <?php class_link("Http") ?>.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::Http http;
http.setHost("http://www.some-server.org/");

// ou bien
sf::Http http("http://www.some-server.org/");
</code></pre>
<p>
    Notez bien que le fait de renseigner l'hôte ne déclenche pas de connection : une connection temporaire avec le serveur sera faite plus tard pour chaque requête.
</p>
<p>
    Il n'y a plus qu'une autre fonction à voir dans la classe <?php class_link("Http") ?>, et c'est la plus importante car elle envoie les requêtes. Et... c'est en gros tout
    ce que contient cette classe.
</p>
<pre><code class="cpp">sf::Http::Request request;
// paramétrage de la requête...
sf::Http::Response response = http.sendRequest(request);
</code></pre>

<?php h2('Les requêtes') ?>
<p>
    Une requête HTTP, représentée par la classe <?php class_link("Http::Request") ?>, contient les information suivantes :
</p>
<ul>
    <li>La méthode : POST (envoyer du contenu), GET (récupérer une ressource), HEAD (récupérer l'en-tête d'une ressource, sans son corps)</li>
    <li>L'URI : l'adresse de la ressource (page, image, ...) à récupérer/envoyer, relative à l'adresse de l'hôte</li>
    <li>La version HTTP (elle est à 1.0 par défaut mais vous pouvez en choisir une différente si vous utilisez des fonctionnalités spécifiques)</li>
    <li>L'en-tête : une suite de champs définis par une clé et une valeur</li>
    <li>Le corps de la page (utilisé uniquement avec la méthode POST)</li>
</ul>
<pre><code class="cpp">sf::Http::Request request;
request.setMethod(sf::Http::Request::Post);
request.setUri("/page.html");
request.setHttpVersion(1, 1); // HTTP 1.1
request.setField("From", "me");
request.setField("Content-Type", "application/x-www-form-urlencoded");
request.setBody("para1=value1&amp;param2=value2");

sf::Http::Response response = http.sendRequest(request);
</code></pre>
<p>
    SFML définit automatiquement les champs d'en-tête obligatoires, comme par exemple "Host" ou "Content-Length". Vous pouvez donc envoyer vos requêtes sans vous soucier de
    cela, SFML fera toujours de son mieux pour les rendre valides.
</p>

<?php h2('Les réponses') ?>
<p>
    Si la classe <?php class_link("Http") ?> a pu se connecter à l'hôte et envoyer la requête, alors une réponse est renvoyée par le serveur et retournée à l'utilisateur,
    encapsulée dans une instance de <?php class_link("Http::Response") ?>. Les réponses contiennent les membres suivants :
</p>
<ul>
    <li>Un code de statut, qui indique précisément comment le serveur a traité la requête (ok, redirigé, non trouvé, etc.)</li>
    <li>La version HTTP du serveur</li>
    <li>L'en-tête : une suite de champs définis par une clé et une valeur</li>
    <li>Le corps de la réponse</li>
</ul>
<pre><code class="cpp">sf::Http::Response response = http.sendRequest(request);
std::cout &lt;&lt; "status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "HTTP version: " &lt;&lt; response.getMajorHttpVersion() &lt;&lt; "." &lt;&lt; response.getMinorHttpVersion() &lt;&lt; std::endl;
std::cout &lt;&lt; "Content-Type header:" &lt;&lt; response.getField("Content-Type") &lt;&lt; std::endl;
std::cout &lt;&lt; "body: " &lt;&lt; response.getBody() &lt;&lt; std::endl;
</code></pre>
<p>
    Le code de statut peut être utilisé pour vérifier si la requête a été traitée avec succès ou non : les codes 2xx informent que tout s'est bien passé, les codes 3xx
    informent d'une redirection, les codes 4xx représentent des erreurs côté client, les codes 5xx sont des erreurs du serveur, et enfin les codes 10xx sont des erreurs
    spécifiques à SFML, qui ne font pas partie du standard HTTP.
</p>

<?php h2('Exemple : envoyer des scores à une base de donnée en ligne') ?>
<p>
    Voici un petit exemple qui montre comment réaliser une tâche assez courante : envoyer un score à une base de donnée en ligne.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
#include &lt;sstream&gt;

void sendScore(int score, const std::string&amp; name)
{
    // préparation de la requête
    sf::Http::Request request("/send-score.php", sf::Http::Request::Post);

    // encodage des paramètres dans le corps de la requête
    std::ostringstream stream;
    stream &lt;&lt; "name=" &lt;&lt; name &lt;&lt; "&amp;score=" &lt;&lt; score;
    request.setBody(stream.str());

    // envoi de la requête au serveur
    sf::Http http("http://www.myserver.com/");
    sf::Http::Response response = http.sendRequest(request);

    // vérification du statut
    if (response.getStatus() == sf::Http::Response::Ok)
    {
        // affichage de la réponse du serveur
        std::cout &lt;&lt; response.getBody() &lt;&lt; std::endl;
    }
    else
    {
        std::cout &lt;&lt; "request failed" &lt;&lt; std::endl;
    }
}
</code></pre>
<p>
    Bien entendu, ceci est une façon très simple de gérer des scores en ligne. Il n'y a aucune protection : n'importe qui pourrait envoyer un faux score facilement. Une
    approche plus robuste impliquerait certainement d'utiliser en paramètre supplémentaire un code de hachage, qui permettrait au serveur de s'assurer que le score
    provient bien du logiciel qui est censé l'envoyer, plutôt que d'une requête d'un petit malin. Mais ceci dépasse le cadre de ce tutoriel.
</p>
<p>
    Et, enfin, voici une version très simpliste de ce à quoi pourrait ressembler la page PHP côté serveur.
</p>
<pre><code class="php">&lt;?php
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
?&gt;
</code></pre>

<?php

    require("footer-fr.php");

?>
