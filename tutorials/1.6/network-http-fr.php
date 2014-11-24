<?php

    $title = "Utiliser HTTP";
    $page = "network-http-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser HTTP</h1>

<?php h2('Introduction') ?>
<p>
    HTTP (<em>HyperText Transfer Protocol</em>) est le protocole utilisé pour transférer des fichiers sur internet :
    pages web, images, etc. Il consiste en une architecture client-serveur où le client envoie des requêtes, et le serveur
    renvoie des réponses contenant les ressources demandées par le client.

</p>
<p>
    SFML fournit une class qui implémente un client HTTP : <?php class_link("Http")?>.
</p>

<?php h2('Requêtes') ?>
<p>
    Une requête HTTP dans SFML est représentée par la classe <?php class_link("Http::Request", "Http_1_1Request")?>.
    Celle-ci contient cinq membres :
</p>
<ul>
    <li>Une méthode, qui est l'action à exécuter; elle peut être l'une des valeurs suivantes:
        <ul>
            <li><code>sf::Http::Request::Get</code>: récupère la ressource demandée (page, image, etc.)</li>
            <li><code>sf::Http::Request::Post</code>: envoie du contenu au serveur</li>
            <li><code>sf::Http::Request::Head</code>: récupére uniquement l'en-tête de la ressource demandée, sans son contenu</li>
        </ul>
    </li>
    <li>Une URI, qui est l'adresse de la ressource à récupérer sir la méthode est <code>Get</code> ou <code>Head</code>,
    ou la page à laquelle envoyer du contenu si la méthode est <code>Post</code>; cette URI est relative
    à l'adresse du serveur (voir plus bas)</li>
    <li>Un corps, qui est le contenu à envoyer si la méthode est <code>Post</code>; ce membre est ignoré si la méthode
    est <code>Get</code> ou <code>Head</code></li>
    <li>Une version HTTP, qui est utilisée par le serveur pour identifier quelle version du protocole le client utiliser;
    cette version est 1.0 si vous ne la spécifiez pas explicitement (ce qui fonctionnera dans la plupart des situations)</li>
    <li>Une liste de paires &lt;nom, valeur&gt;, qui sont des options à passer au serveur; certaines de ces options sont
    obligatoires (comme par exemple "Host", "From", ou "Content-Length") mais SFML s'occupe de les remplir correctement
    si vous ne le faites pas</li>
</ul>
<p>
    Chacun de ces cinq membres peut être modifié via les accesseurs de la classe
    <?php class_link("Http::Request", "Http_1_1Request")?>:
</p>
<pre><code class="cpp">sf::Http::Request Request;
Request.SetMethod(sf::Http::Request::Get);
Request.SetURI("/");
Request.SetBody("");
Request.SetHttpVersion(1, 0);
Request.SetField("From", "my_email@gmail.com");
</code></pre>
<p>
    Notez que tous ces membres ont une valeur par défaut correcte; SFML s'assure que vos requêtes sont toujours bien valides
    quoique vous fassiez, ainsi vous pouvez vous concentrer sur les paramètres importants (comme l'URI à récupérer)
    et laisser de côté les détails ennuyeux du protocole HTTP.<br/>
    Cette requête pourrait donc être simplifiée au morceau de code suivant :
</p>
<pre><code class="cpp">sf::Http::Request Request;
Request.SetURI("/");
</code></pre>

<?php h2('Réponses') ?>
<p>
    Après avoir envoyé une requête (ce que nous verrons dans le chapitre suivant), vous recevez une réponse du serveur.
    Cette réponse est représentée par la classe <?php class_link("Http::Response", "Http_1_1Response")?>.
</p>
<p>
    Une réponse consiste en quatre membres :
</p>
<ul>
    <li>Un code d'état qui informe quant au succès ou à l'échec de la requête</li>
    <li>Un corps, qui est le contenu de la ressource demandée; si cette ressource est une page web, le corps contient
    le code HTML de la page. Il peut aussi être vide ou contenir le code HTML d'une page d'erreur, si la requête a
    echoué</li>
    <li>Une version HTTP, qui est celle utilisée par le serveur</li>
    <li>Une liste de paires &lt;nom, valeur&gt;, qui représente diverses informations sur le serveur qui sont transmises
    au client</li>
</ul>
<p>
    Tous ces membres peuvent être lus via les accesseurs de la classe
    <?php class_link("Http::Response", "Http_1_1Response")?> :
</p>
<pre><code class="cpp">sf::Http::Response Response;
...
sf::Http::Response::Status Status = Response.GetStatus();
unsigned int Major = Response.GetMajorHttpVersion();
unsigned int Minor = Response.GetMinorHttpVersion();
std::string Body = Response.GetBody();
std::string Type = Response.GetField("Content-Type");
</code></pre>
<p>
    Les codes d'état sont décrits dans l'énumeration <code>sf::Http::Response::Status</code>. Il existe plusieurs
    codes de succès, mais le principal est <code>sf::Http::Response::Ok</code>.
</p>

<?php h2('Assembler tout ça') ?>
<p>
    Maintenant que vous savez écrire des requêtes et lire des réponses, il ne vous manque que deux choses : se connecter
    à un serveur HTTP, et envoyer les requêtes.
</p>
<p>
    La connection à un serveur est effectuée via la fonction <code>SetHost</code> :
</p>
<pre><code class="cpp">sf::Http Http;
Http.SetHost("www.whatismyip.org");
</code></pre>
<p>
    En fait, cette fonction ne fait rien d'autre que mémoriser le nom de l'hôte, la connexion ne s'effectue réellement
    qu'avant requête, puis est refermée juste après avoir reçu la réponse. C'est pourquoi cette fonction est nommée
    <code>SetHost</code> plutôt que <code>Connect</code>.
</p>
<p>
    Cette fonction peut accepter un paramètre additionnel : le port réseau à utiliser pour la connexion. Si vous
    ne le spécifiez pas explicitement, SFML utilisera simplement le port par défaut associé au protocole utilisé :
    80 pour HTTP, 443 pour HTTPS.
</p>
<p>
    Une fois le serveur défini, vous pouvez envoyer des requêtes avec la fonction <code>SendRequest</code> :
</p>
<pre><code class="cpp">sf::Http::Response Response = Http.SendRequest(Request);
</code></pre>
<p>
    Cette fonction prend en paramètre un <?php class_link("Http::Request", "Http_1_1Request")?>, et retourne
    une instance de <?php class_link("Http::Response", "Http_1_1Response")?>.
</p>
<p>
    C'est tout pour ce qui est de l'interface de la classe <?php class_link("Http")?>, seulement deux fonctions !
    Il n'y a même pas besoin de se déconnecter du serveur, étant donné que c'est fait automatiquement après chaque
    appel à <code>SendRequest</code>.
</p>

<?php h2('Conclusion') ?>
<p>
    La classe <?php class_link("Http")?> est un outil puissant pour manipuler le protocole HTTP, et accéder à des pages web
    ou à des fichiers via internet.<br/>
    Jetons maintenant un oeil à son frère, le
    <a class="internal" href="./network-ftp-fr.php" title="Aller au tutoriel suivant">protocole FTP</a>.

</p>

<?php

    require("footer-fr.php");

?>
