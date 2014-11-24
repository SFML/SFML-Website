<?php

    $title = "Utiliser HTTP";
    $page = "network-http-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser HTTP</h1>

<?php h2('Introduction') ?>
<p>
    HTTP (<em>HyperText Transfer Protocol</em>) est le protocole utilis� pour transf�rer des fichiers sur internet :
    pages web, images, etc. Il consiste en une architecture client-serveur o� le client envoie des requ�tes, et le serveur
    renvoie des r�ponses contenant les ressources demand�es par le client.

</p>
<p>
    SFML fournit une class qui impl�mente un client HTTP : <?php class_link("Http")?>.
</p>

<?php h2('Requ�tes') ?>
<p>
    Une requ�te HTTP dans SFML est repr�sent�e par la classe <?php class_link("Http::Request", "Http_1_1Request")?>.
    Celle-ci contient cinq membres :
</p>
<ul>
    <li>Une m�thode, qui est l'action � ex�cuter; elle peut �tre l'une des valeurs suivantes:
        <ul>
            <li><code>sf::Http::Request::Get</code>: r�cup�re la ressource demand�e (page, image, etc.)</li>
            <li><code>sf::Http::Request::Post</code>: envoie du contenu au serveur</li>
            <li><code>sf::Http::Request::Head</code>: r�cup�re uniquement l'en-t�te de la ressource demand�e, sans son contenu</li>
        </ul>
    </li>
    <li>Une URI, qui est l'adresse de la ressource � r�cup�rer sir la m�thode est <code>Get</code> ou <code>Head</code>,
    ou la page � laquelle envoyer du contenu si la m�thode est <code>Post</code>; cette URI est relative
    � l'adresse du serveur (voir plus bas)</li>
    <li>Un corps, qui est le contenu � envoyer si la m�thode est <code>Post</code>; ce membre est ignor� si la m�thode
    est <code>Get</code> ou <code>Head</code></li>
    <li>Une version HTTP, qui est utilis�e par le serveur pour identifier quelle version du protocole le client utiliser;
    cette version est 1.0 si vous ne la sp�cifiez pas explicitement (ce qui fonctionnera dans la plupart des situations)</li>
    <li>Une liste de paires &lt;nom, valeur&gt;, qui sont des options � passer au serveur; certaines de ces options sont
    obligatoires (comme par exemple "Host", "From", ou "Content-Length") mais SFML s'occupe de les remplir correctement
    si vous ne le faites pas</li>
</ul>
<p>
    Chacun de ces cinq membres peut �tre modifi� via les accesseurs de la classe
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
    Notez que tous ces membres ont une valeur par d�faut correcte; SFML s'assure que vos requ�tes sont toujours bien valides
    quoique vous fassiez, ainsi vous pouvez vous concentrer sur les param�tres importants (comme l'URI � r�cup�rer)
    et laisser de c�t� les d�tails ennuyeux du protocole HTTP.<br/>
    Cette requ�te pourrait donc �tre simplifi�e au morceau de code suivant :
</p>
<pre><code class="cpp">sf::Http::Request Request;
Request.SetURI("/");
</code></pre>

<?php h2('R�ponses') ?>
<p>
    Apr�s avoir envoy� une requ�te (ce que nous verrons dans le chapitre suivant), vous recevez une r�ponse du serveur.
    Cette r�ponse est repr�sent�e par la classe <?php class_link("Http::Response", "Http_1_1Response")?>.
</p>
<p>
    Une r�ponse consiste en quatre membres :
</p>
<ul>
    <li>Un code d'�tat qui informe quant au succ�s ou � l'�chec de la requ�te</li>
    <li>Un corps, qui est le contenu de la ressource demand�e; si cette ressource est une page web, le corps contient
    le code HTML de la page. Il peut aussi �tre vide ou contenir le code HTML d'une page d'erreur, si la requ�te a
    echou�</li>
    <li>Une version HTTP, qui est celle utilis�e par le serveur</li>
    <li>Une liste de paires &lt;nom, valeur&gt;, qui repr�sente diverses informations sur le serveur qui sont transmises
    au client</li>
</ul>
<p>
    Tous ces membres peuvent �tre lus via les accesseurs de la classe
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
    Les codes d'�tat sont d�crits dans l'�numeration <code>sf::Http::Response::Status</code>. Il existe plusieurs
    codes de succ�s, mais le principal est <code>sf::Http::Response::Ok</code>.
</p>

<?php h2('Assembler tout �a') ?>
<p>
    Maintenant que vous savez �crire des requ�tes et lire des r�ponses, il ne vous manque que deux choses : se connecter
    � un serveur HTTP, et envoyer les requ�tes.
</p>
<p>
    La connection � un serveur est effectu�e via la fonction <code>SetHost</code> :
</p>
<pre><code class="cpp">sf::Http Http;
Http.SetHost("www.whatismyip.org");
</code></pre>
<p>
    En fait, cette fonction ne fait rien d'autre que m�moriser le nom de l'h�te, la connexion ne s'effectue r�ellement
    qu'avant requ�te, puis est referm�e juste apr�s avoir re�u la r�ponse. C'est pourquoi cette fonction est nomm�e
    <code>SetHost</code> plut�t que <code>Connect</code>.
</p>
<p>
    Cette fonction peut accepter un param�tre additionnel : le port r�seau � utiliser pour la connexion. Si vous
    ne le sp�cifiez pas explicitement, SFML utilisera simplement le port par d�faut associ� au protocole utilis� :
    80 pour HTTP, 443 pour HTTPS.
</p>
<p>
    Une fois le serveur d�fini, vous pouvez envoyer des requ�tes avec la fonction <code>SendRequest</code> :
</p>
<pre><code class="cpp">sf::Http::Response Response = Http.SendRequest(Request);
</code></pre>
<p>
    Cette fonction prend en param�tre un <?php class_link("Http::Request", "Http_1_1Request")?>, et retourne
    une instance de <?php class_link("Http::Response", "Http_1_1Response")?>.
</p>
<p>
    C'est tout pour ce qui est de l'interface de la classe <?php class_link("Http")?>, seulement deux fonctions !
    Il n'y a m�me pas besoin de se d�connecter du serveur, �tant donn� que c'est fait automatiquement apr�s chaque
    appel � <code>SendRequest</code>.
</p>

<?php h2('Conclusion') ?>
<p>
    La classe <?php class_link("Http")?> est un outil puissant pour manipuler le protocole HTTP, et acc�der � des pages web
    ou � des fichiers via internet.<br/>
    Jetons maintenant un oeil � son fr�re, le
    <a class="internal" href="./network-ftp-fr.php" title="Aller au tutoriel suivant">protocole FTP</a>.

</p>

<?php

    require("footer-fr.php");

?>
