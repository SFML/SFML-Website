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
    FTP (<em>File Transfer Protocol</em>) est un protocole simple qui permet de manipuler des r�pertoires et des fichiers sur un serveur distant. Le protocole consiste
    en des commandes telles que "cr�er un r�pertoire", "supprimer un fichier", "t�l�charger un fichier", etc. Vous ne pouvez cependant pas envoyer de telles commandes �
    n'importe quel ordinateur distant : il faut qu'il y ait un serveur FTP qui tourne, qui sache comprendre et ex�cuter les commandes que les clients lui envoient.
</p>
<p>
    Alors, que pouvez-vous faire avec FTP, et � quoi peut-il servir dans votre programme ? En gros, avec FTP, vous pouvez acc�der � un syst�me de fichiers distant, ou bien
    m�me cr�er le v�tre. Cela peut �tre utile si vous voulez que votre jeu r�seau t�l�charge des ressources (cartes, images, ...) depuis un serveur, ou que votre programme
    se mette � jour automatiquement lorsqu'il est connect� � internet.
</p>
<p>
    Si vous souhaitez en savoir plus sur le protocole FTP, la
    <a class ="external" href="http://fr.wikipedia.org/wiki/File_Transfer_Protocol" title="FTP sur wikipedia">page wikipedia</a> est bien entendu beaucoup plus fournie
    que cette br�ve introduction.
</p>

<?php h2('La classe de client FTP') ?>
<p>
    La classe fournie par SFML est <?php class_link("Ftp") ?> (surprenant n'est-ce pas ?). Elle impl�mente un client, ce qui signifie qu'elle peut se connecter � un serveur FTP,
    lui envoyer des commandes et t�l�charger ou envoyer des fichiers.
</p>
<p>
    Chaque fonction de la classe <?php class_link("Ftp") ?> encapsule une commande FTP, et renvoie une r�ponse FTP standard. Une r�ponse FTP contient un code de statut
    (similaire aux codes de statut HTTP -- mais pas les m�mes), ainsi qu'un message qui informe l'utilisateur de ce qui s'est pass�. Les r�ponses FTP sont encapsul�es dans la
    classe <?php class_link("Ftp::Response") ?>.
</p>
<p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::Ftp ftp;
...
sf::Ftp::Response response = ftp.login(); // juste un exemple, �a pourrait �tre n'importe quelle fonction

std::cout &lt;&lt; "Response status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "Response message: " &lt;&lt; response.getMessage() &lt;&lt; std::endl;
</code></pre>
<p>
    Le code de la r�ponse peut �tre utilis� pour v�rifier si la commande a �t� trait�e avec succ�s ou bien a �chou� : les codes inf�rieurs � 400 sont ok, les autres
    repr�sentent une erreur. Vous pouvez utiliser la fonction <code>isOk()</code> comme raccourci pour tester un code de r�ponse.
</p>
<pre><code class="cpp">sf::Ftp::Response response = ftp.login();
if (response.isOk())
{
    // succ�s !
}
else
{
    // erreur...
}
</code></pre>
<p>
    Si vous vous fichez des d�tails de la r�ponse, vous pouvez proc�der de mani�re plus concise :
</p>
<pre><code class="cpp">if (ftp.login().isOk())
{
    // succ�s !
}
else
{
    // erreur...
}
</code></pre>
<p>
    Pour des raisons de lisibilit�, ces v�rifications ne seront pas syst�matiquement �crites dans les autres exemples de ce tutoriel. Mais n'oubliez pas de les �crire
    dans votre code !
</p>
<p>
    Bien, maintenant que vous comprenez comment la classe fonctionne, voyons un peu plus en d�tail ce qu'elle peut faire.
</p>

<?php h2('Se connecter � un serveur FTP') ?>
<p>
    La premi�re chose � faire est de se connecter � un serveur FTP.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org");
</code></pre>
<p>
    L'adresse du serveur peut �tre n'importe quelle <?php class_link("IpAddress") ?> valide : une URL, une adresse IP, un nom d'h�te r�seau, ...
</p>
<p>
    Le port standard pour le protocole FTP est le port 21. Cependant, si pour une raison particuli�re votre serveur utilise un port diff�rent, vous pouvez le donner avec
    un param�tre suppl�mentaire :
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 45000);
</code></pre>
<p>
    Vous pouvez �galement passer un troisi�me param�tre, qui est un temps d'attente maximal. De cette fa�on, vous pouvez �viter une attente infinie (ou du moins extr�mement
    longue) dans le cas o� le serveur ne r�pond pas.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 21, sf::seconds(5));
</code></pre>
<p>
    Une fois connect� au serveur, il faut vous authentifier :
</p>
<pre><code class="cpp">// authentification avec nom d'utilisateur et mot de passe
ftp.login("username", "password");

// ou anonymement, si le serveur l'autorise
ftp.login();
</code></pre>

<?php h2('Les commandes FTP') ?>
<p>
    Voici une br�ve description de chaque commande disponible dans la classe <?php class_link("Ftp") ?>. Souvenez-vous d'une chose : toutes ces commandes sont effectu�es
    relativement au <em>r�pertoire de travail</em>, exactement comme si vous ex�cutiez des commandes de fichier ou de r�pertoire dans une console de votre OS.
</p>
<p>
    R�cup�rer le r�pertoire de travail :
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse response = ftp.getWorkingDirectory();
if (response.isOk())
    std::cout &lt;&lt; "Current directory: " &lt;&lt; response.getDirectory() &lt;&lt; std::endl;
</code></pre>
<p>
    <?php class_link("Ftp::DirectoryResponse") ?> est une <?php class_link("Ftp::Response") ?> sp�cialis�e, qui contient en plus le r�pertoire demand�.
</p>
<p>
    Recup�rer la liste des r�pertoires et fichiers contenus dans le r�pertoire de travail :
</p>
<pre><code class="cpp">sf::Ftp::ListingResponse response = ftp.getDirectoryListing();
if (response.isOk())
{
    const std::vector&lt;std::string&gt;&amp; listing = response.getListing();
    for (std::vector&lt;std::string&gt;::const_iterator it = listing.begin(); it != listing.end(); ++it)
        std::cout &lt;&lt; "- " &lt;&lt; *it &lt;&lt; std::endl;
}

// vous pouvez aussi lister un sous-r�pertoire du r�pertoire de travail :
response = ftp.getDirectoryListing("subfolder");
</code></pre>
<p>
    <?php class_link("Ftp::ListingResponse") ?> est une <?php class_link("Ftp::Response") ?> sp�cialis�e, qui contient en plus la liste des r�pertoires/fichiers demand�s.
</p>
<p>
    Changer le r�pertoire de travail :
</p>
<pre><code class="cpp">ftp.changeDirectory("path/to/new_directory"); // le chemin donn� est relatif au r�pertoire de travail
</code></pre>
<p>
    Aller dans le r�pertoire parent du r�pertoire de travail :
</p>
<pre><code class="cpp">ftp.parentDirectory();
</code></pre>
<p>
    Cr�er un nouveau r�pertoire (sous le r�pertoire de travail) :
</p>
<pre><code class="cpp">ftp.createDirectory("name_of_new_directory");
</code></pre>
<p>
    Supprimer un r�pertoire :
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
    T�l�charger un fichier du serveur :
</p>
<pre><code class="cpp">ftp.download("remote_file_name.txt", "local/destination/path", sf::Ftp::Ascii);
</code></pre>
<p>
    Le dernier param�tre est le mode de transfert. Il peut �tre soit Ascii (pour les fichiers textes), Ebcdic (pour les fichiers textes, mais qui utilisent le jeu de
    caract�res EBCDIC -- quelqu'un utilise encore �a ?) ou Binary (pour les fichiers non-texte). Les modes Ascii et Ebcdic peuvent transformer le fichier (fins de lignes,
    encodage) pendant le transfert afin de coller � l'environnement du client. Le mode Binary quant � lui est un transfert direct d'octets.
</p>
<p>
    Envoyer un fichier au serveur :
</p>
<pre><code class="cpp">ftp.upload("local_file_name.pdf", "remote/destination/path", sf::Ftp::Binary);
</code></pre>
<p>
    Les serveurs FTP ferment habituellement les connections qui restent inactives pendant un moment. Si vous voulez �viter de vous faire d�connecter pendant que vous
    ne faites rien, vous pouvez envoyer une commande "vide" (qui ne fait rien) de temps en temps :
</p>
<pre><code class="cpp">ftp.keepAlive();
</code></pre>

<?php h2('Se d�connecter du serveur FTP') ?>
<p>
    Vous pouvez fermer la connection avec le serveur � tout moment avec la fonction <code>disconnect</code>.
</p>
<pre><code class="cpp">ftp.disconnect();
</code></pre>

<?php

    require("footer-fr.php");

?>
