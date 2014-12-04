<?php

    $title = "Transferts de fichiers avec FTP";
    $page = "network-ftp-fr.php";

    require("header-fr.php");

?>

<h1>Transferts de fichiers avec FTP</h1>

<?php h2('FTP pour les nuls') ?>
<p>
    Si vous savez ce qu'est FTP, et que vous souhaitez juste savoir comment utiliser la classe FTP fournie par SFML, vous pouvez sauter ce chapitre.
</p>
<p>
    FTP (<em>File Transfer Protocol</em>) est un protocole simple qui permet de manipuler des répertoires et des fichiers sur un serveur distant. Le protocole consiste
    en des commandes telles que "créer un répertoire", "supprimer un fichier", "télécharger un fichier", etc. Vous ne pouvez cependant pas envoyer de telles commandes à
    n'importe quel ordinateur distant : il faut qu'il y ait un serveur FTP qui tourne, qui sache comprendre et exécuter les commandes que les clients lui envoient.
</p>
<p>
    Alors, que pouvez-vous faire avec FTP, et à quoi peut-il servir dans votre programme ? En gros, avec FTP, vous pouvez accéder à un système de fichiers distant, ou bien
    même créer le vôtre. Cela peut être utile si vous voulez que votre jeu réseau télécharge des ressources (cartes, images, ...) depuis un serveur, ou que votre programme
    se mette à jour automatiquement lorsqu'il est connecté à internet.
</p>
<p>
    Si vous souhaitez en savoir plus sur le protocole FTP, la
    <a class ="external" href="http://fr.wikipedia.org/wiki/File_Transfer_Protocol" title="FTP sur wikipedia">page Wikipedia</a> est bien entendu beaucoup plus fournie
    que cette brève introduction.
</p>

<?php h2('La classe de client FTP') ?>
<p>
    La classe fournie par SFML est <?php class_link("Ftp") ?> (surprenant n'est-ce pas ?). Elle implémente un client, ce qui signifie qu'elle peut se connecter à un serveur FTP,
    lui envoyer des commandes et télécharger ou envoyer des fichiers.
</p>
<p>
    Chaque fonction de la classe <?php class_link("Ftp") ?> encapsule une commande FTP, et renvoie une réponse FTP standard. Une réponse FTP contient un code de statut
    (similaire aux codes de statut HTTP -- mais pas les mêmes), ainsi qu'un message qui informe l'utilisateur de ce qui s'est passé. Les réponses FTP sont encapsulées dans la
    classe <?php class_link("Ftp::Response") ?>.
</p>
<p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::Ftp ftp;
...
sf::Ftp::Response response = ftp.login(); // juste un exemple, ça pourrait être n'importe quelle fonction

std::cout &lt;&lt; "Response status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "Response message: " &lt;&lt; response.getMessage() &lt;&lt; std::endl;
</code></pre>
<p>
    Le code de la réponse peut être utilisé pour vérifier si la commande a été traitée avec succès ou bien a échoué : les codes inférieurs à 400 sont ok, les autres
    représentent une erreur. Vous pouvez utiliser la fonction <code>isOk()</code> comme raccourci pour tester un code de réponse.
</p>
<pre><code class="cpp">sf::Ftp::Response response = ftp.login();
if (response.isOk())
{
    // succès !
}
else
{
    // erreur...
}
</code></pre>
<p>
    Si vous vous fichez des détails de la réponse, vous pouvez procéder de manière plus concise :
</p>
<pre><code class="cpp">if (ftp.login().isOk())
{
    // succès !
}
else
{
    // erreur...
}
</code></pre>
<p>
    Pour des raisons de lisibilité, ces vérifications ne seront pas systématiquement écrites dans les autres exemples de ce tutoriel. Mais n'oubliez pas de les écrire
    dans votre code !
</p>
<p>
    Bien, maintenant que vous comprenez comment la classe fonctionne, voyons un peu plus en détail ce qu'elle peut faire.
</p>

<?php h2('Se connecter à un serveur FTP') ?>
<p>
    La première chose à faire est de se connecter à un serveur FTP.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org");
</code></pre>
<p>
    L'adresse du serveur peut être n'importe quelle <?php class_link("IpAddress") ?> valide : une URL, une adresse IP, un nom d'hôte réseau, ...
</p>
<p>
    Le port standard pour le protocole FTP est le port 21. Cependant, si pour une raison particulière votre serveur utilise un port différent, vous pouvez le donner avec
    un paramètre supplémentaire :
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 45000);
</code></pre>
<p>
    Vous pouvez également passer un troisième paramètre, qui est un temps d'attente maximal. De cette façon, vous pouvez éviter une attente infinie (ou du moins extrêmement
    longue) dans le cas où le serveur ne répond pas.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 21, sf::seconds(5));
</code></pre>
<p>
    Une fois connecté au serveur, il faut vous authentifier :
</p>
<pre><code class="cpp">// authentification avec nom d'utilisateur et mot de passe
ftp.login("username", "password");

// ou anonymement, si le serveur l'autorise
ftp.login();
</code></pre>

<?php h2('Les commandes FTP') ?>
<p>
    Voici une brève description de chaque commande disponible dans la classe <?php class_link("Ftp") ?>. Souvenez-vous d'une chose : toutes ces commandes sont effectuées
    relativement au <em>répertoire de travail</em>, exactement comme si vous exécutiez des commandes de fichier ou de répertoire dans une console de votre OS.
</p>
<p>
    Récupérer le répertoire de travail :
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse response = ftp.getWorkingDirectory();
if (response.isOk())
    std::cout &lt;&lt; "Current directory: " &lt;&lt; response.getDirectory() &lt;&lt; std::endl;
</code></pre>
<p>
    <?php class_link("Ftp::DirectoryResponse") ?> est une <?php class_link("Ftp::Response") ?> spécialisée, qui contient en plus le répertoire demandé.
</p>
<p>
    Recupérer la liste des répertoires et fichiers contenus dans le répertoire de travail :
</p>
<pre><code class="cpp">sf::Ftp::ListingResponse response = ftp.getDirectoryListing();
if (response.isOk())
{
    const std::vector&lt;std::string&gt;&amp; listing = response.getListing();
    for (std::vector&lt;std::string&gt;::const_iterator it = listing.begin(); it != listing.end(); ++it)
        std::cout &lt;&lt; "- " &lt;&lt; *it &lt;&lt; std::endl;
}

// vous pouvez aussi lister un sous-répertoire du répertoire de travail :
response = ftp.getDirectoryListing("subfolder");
</code></pre>
<p>
    <?php class_link("Ftp::ListingResponse") ?> est une <?php class_link("Ftp::Response") ?> spécialisée, qui contient en plus la liste des répertoires/fichiers demandés.
</p>
<p>
    Changer le répertoire de travail :
</p>
<pre><code class="cpp">ftp.changeDirectory("path/to/new_directory"); // le chemin donné est relatif au répertoire de travail
</code></pre>
<p>
    Aller dans le répertoire parent du répertoire de travail :
</p>
<pre><code class="cpp">ftp.parentDirectory();
</code></pre>
<p>
    Créer un nouveau répertoire (sous le répertoire de travail) :
</p>
<pre><code class="cpp">ftp.createDirectory("name_of_new_directory");
</code></pre>
<p>
    Supprimer un répertoire :
</p>
<pre><code class="cpp">ftp.deleteDirectory("name_of_directory_to_delete");
</code></pre>
<p>
    Renommer un fichier :
</p>
<pre><code class="cpp">ftp.renameFile("old_name.txt", "new_name.txt");
</code></pre>
<p>
    Supprimer un fichier :
</p>
<pre><code class="cpp">ftp.deleteFile("file_name.txt");
</code></pre>
<p>
    Télécharger un fichier du serveur :
</p>
<pre><code class="cpp">ftp.download("remote_file_name.txt", "local/destination/path", sf::Ftp::Ascii);
</code></pre>
<p>
    Le dernier paramètre est le mode de transfert. Il peut être soit Ascii (pour les fichiers textes), Ebcdic (pour les fichiers textes, mais qui utilisent le jeu de
    caractères EBCDIC -- quelqu'un utilise encore ça ?) ou Binary (pour les fichiers non-texte). Les modes Ascii et Ebcdic peuvent transformer le fichier (fins de lignes,
    encodage) pendant le transfert afin de coller à l'environnement du client. Le mode Binary quant à lui est un transfert direct d'octets.
</p>
<p>
    Envoyer un fichier au serveur :
</p>
<pre><code class="cpp">ftp.upload("local_file_name.pdf", "remote/destination/path", sf::Ftp::Binary);
</code></pre>
<p>
    Les serveurs FTP ferment habituellement les connections qui restent inactives pendant un moment. Si vous voulez éviter de vous faire déconnecter pendant que vous
    ne faites rien, vous pouvez envoyer une commande "vide" (qui ne fait rien) de temps en temps :
</p>
<pre><code class="cpp">ftp.keepAlive();
</code></pre>

<?php h2('Se déconnecter du serveur FTP') ?>
<p>
    Vous pouvez fermer la connection avec le serveur à tout moment avec la fonction <code>disconnect</code>.
</p>
<pre><code class="cpp">ftp.disconnect();
</code></pre>

<?php

    require("footer-fr.php");

?>
