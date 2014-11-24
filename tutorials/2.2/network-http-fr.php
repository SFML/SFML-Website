<?php

    $title = "Requ�tes web avec HTTP";
    $page = "network-http-fr.php";

    require("header-fr.php");

?>

<h1>Requ�tes web avec HTTP</h1>

<?php h2('Introduction') ?>
<p>
    SFML fournit une classe de client HTTP simple, pour vous permettre de communiquer avec des serveurs web. "Simple" signifie qu'elle supporte uniquement les fonctionnalit�s
    les plus basiques de HTTP : les requ�tes POST, GET et HEAD, l'acc�s aux champs d'en-t�te, et la lecture/�criture du corps des pages.
</p>
<p>
    S'il vous faut des fonctionnalit�s plus complexes, comme par exemple le support de HTTP s�curis� (HTTPS), vous devriez plut�t chercher une biblioth�que compl�tement
    d�di�e � HTTP, comme libcurl ou cpp-netlib.
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
    Notez bien que le fait de renseigner l'h�te ne d�clenche pas de connection : une connection temporaire avec le serveur sera faite plus tard pour chaque requ�te.
</p>
<p>
    Il n'y a plus qu'une autre fonction � voir dans la classe <?php class_link("Http") ?>, et c'est la plus importante car elle envoie les requ�tes. Et... c'est en gros tout
    ce que contient cette classe.
</p>
<pre><code class="cpp">sf::Http::Request request;
// param�trage de la requ�te...
sf::Http::Response response = http.sendRequest(request);
</code></pre>

<?php h2('Les requ�tes') ?>
<p>
    Une requ�te HTTP, repr�sent�e par la classe <?php class_link("Http::Request") ?>, contient les information suivantes :
</p>
<ul>
    <li>La m�thode : POST (envoyer du contenu), GET (r�cup�rer une ressource), HEAD (r�cup�rer l'en-t�te d'une ressource, sans son corps)</li>
    <li>L'URI : l'adresse de la ressource (page, image, ...) � r�cup�rer/envoyer, relative � l'adresse de l'h�te</li>
    <li>La version HTTP (elle est � 1.0 par d�faut mais vous pouvez en choisir une diff�rente si vous utilisez des fonctionnalit�s sp�cifiques)</li>
    <li>L'en-t�te : une suite de champs d�finis par une cl� et une valeur</li>
    <li>Le corps de la page (utilis� uniquement avec la m�thode POST)</li>
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
    SFML d�finit automatiquement les champs d'en-t�te obligatoires, comme par exemple "Host" ou "Content-Length". Vous pouvez donc envoyer vos requ�tes sans vous soucier de
    cela, SFML fera toujours de son mieux pour les rendre valides.
</p>

<?php h2('Les r�ponses') ?>
<p>
    Si la classe <?php class_link("Http") ?> a pu se connecter � l'h�te et envoyer la requ�te, alors une r�ponse est renvoy�e par le serveur et retourn�e � l'utilisateur,
    encapsul�e dans une instance de <?php class_link("Http::Response") ?>. Les r�ponses contiennent les membres suivants :
</p>
<ul>
    <li>Un code de statut, qui indique pr�cis�ment comment le serveur a trait� la requ�te (ok, redirig�, non trouv�, etc.)</li>
    <li>La version HTTP du serveur</li>
    <li>L'en-t�te : une suite de champs d�finis par une cl� et une valeur</li>
    <li>Le corps de la r�ponse</li>
</ul>
<pre><code class="cpp">sf::Http::Response response = http.sendRequest(request);
std::cout &lt;&lt; "status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "HTTP version: " &lt;&lt; response.getMajorHttpVersion() &lt;&lt; "." &lt;&lt; response.getMinorHttpVersion() &lt;&lt; std::endl;
std::cout &lt;&lt; "Content-Type header:" &lt;&lt; response.getField("Content-Type") &lt;&lt; std::endl;
std::cout &lt;&lt; "body: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
</code></pre>
<p>
    Le code de statut peut �tre utilis� pour v�rifier si la requ�te a �t� trait�e avec succ�s ou non : les codes 2xx informent que tout s'est bien pass�, les codes 3xx
    informent d'une redirection, les codes 4xx repr�sentent des erreurs c�t� client, les codes 5xx sont des erreurs du serveur, et enfin les codes 10xx sont des erreurs
    sp�cifiques � SFML, qui ne font pas partie du standard HTTP.
</p>

<?php h2('Exemple : envoyer des scores � une base de donn�e en ligne') ?>
<p>
    Voici un petit exemple qui montre comment r�aliser une t�che assez courante : envoyer un score � une base de donn�e en ligne.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
#include &lt;sstream&gt;

void sendScore(int score, const std::string&amp; name)
{
    // pr�paration de la requ�te
    sf::Http::Request request("/send-score.php", sf::Http::Request::Post);

    // encodage des param�tres dans le corps de la requ�te
    std::ostringstream stream;
    stream &lt;&lt; "name=" &lt;&lt; name &lt;&lt; "&amp;score=" &lt;&lt; score;
    request.setBody(stream.str());

    // envoi de la requ�te au serveur
    sf::Http http("http://www.myserver.com/");
    sf::Http::Response response = http.sendRequest(request);

    // v�rification du statut
    if (response.getStatus() == sf::Http::Response::Ok)
    {
        // affichage de la r�ponse du serveur
        std::cout &lt;&lt; response.getBody() &lt;&lt; std::endl;
    }
    else
    {
        std::cout &lt;&lt; "request failed" &lt;&lt; std::endl;
    }
}
</code></pre>
<p>
    Bien entendu, ceci est une fa�on tr�s simple de g�rer des scores en ligne. Il n'y a aucune protection : n'importe qui pourrait envoyer un faux score facilement. Une
    approche plus robuste impliquerait certainement d'utiliser en param�tre suppl�mentaire un code de hachage, qui permettrait au serveur de s'assurer que le score
    provient bien du logiciel qui est cens� l'envoyer, plut�t que d'une requ�te d'un petit malin. Mais ceci d�passe le cadre de ce tutoriel.
</p>
<p>
    Et, enfin, voici une version tr�s simpliste de ce � quoi pourrait ressembler la page PHP c�t� serveur.
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
