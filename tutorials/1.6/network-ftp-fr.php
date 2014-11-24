<?php

    $title = "Utiliser FTP";
    $page = "network-ftp-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser FTP</h1>

<?php h2('Introduction') ?>
<p>
    FTP (<em>File Transfer Protocol</em>) est un protocole très utilisé pour transférer et accéder à des fichiers
    via internet, ou tout autre réseau. Il consiste en une architecture client-serveur qui est globalement très simple :
    le client envoie une commande au serveur, qui exécute celle-ci et renvoie une réponse au client pour l'informer
    du succès ou de l'échec de l'opération.
</p>
<p>
    SFML fournit une classe simple qui implémente un client FTP ainsi que toutes les commandes qu'il peut envoyer
    à un serveur FTP : <?php class_link("Ftp")?>.
</p>

<?php h2('Réponses FTP') ?>
<p>
    Avant d'utiliser notre classe FTP, il faut expliquer le concept des réponses. Toute action FTP est en interne
    une commande qui est exécutée par le serveur, et qui retourne une réponse contenant un code d'état et un message.
    Ainsi, tout appel à une fonction de <?php class_link("Ftp")?> retourne une telle réponse, représentée par la classe
    <?php class_link("Ftp::Response", "Ftp_1_1Response")?>. Celle-ci est une simple encapsulation des réponses FTP,
    et contient le code d'état et le message renvoyés par le serveur.
</p>
<pre><code class="cpp">sf::Ftp Server;
sf::Ftp::Response Resp = Server.xxx(); // Voir ci-dessous...

sf::Ftp::Response::Status Status = Resp.GetStatus();
std::string Message = Resp.GetMessage();
</code></pre>
<p>
    Le code d'état et le message peuvent être utiles si vous souhaitez afficher des informations détaillées concernant
    ce qu'il se passe du côté du serveur, sinon ils peuvent simplement être ignorés. La seule chose importante
    est de vérifier si le code d'état représente un succès ou un échec de l'opération, ce qui peut être fait
    facilement avec la fonction <code>IsOk</code>.
</p>
<pre><code class="cpp">bool Success = Resp.IsOk();
</code></pre>
<p>
    Ainsi, toute commande FTP peut être vérifiée directement :
</p>
<pre><code class="cpp">if (Server.xxx().IsOk())
{
    // Succès
}
else
{
    // Echec
}
</code></pre>

<?php h2('Connection à un serveur FTP') ?>
<p>
    La première étape est de se connecter à un serveur FTP.
</p>
<pre><code class="cpp">sf::Ftp Server;
if (Server.Connect("ftp.myserver.com").IsOk())
{
    // Ok, nous sommes connectés
}
</code></pre>
<p>
    L'adresse du serveur peut être n'importe quelle <?php class_link("IPAddress")?> valide : une URL, une adresse IP,
    un nom réseau, etc.
</p>
<p>
    La fonction <code>Connect</code> peut accepter deux paramètres optionnels supplémentaires : un port réseau et une
    valeur de timeout.<br/>
    Le port par défaut utilisé par le protocole FTP est 21, mais certaines applications peuvent vouloir en utiliser
    un autre.<br/>
    Le timeout  peut être utilisé pour s'assurer que l'application ne va pas geler trop longtemps si le serveur ne répond
    pas ; si vous n'en spécifiez pas, ce sera la valeur par défaut du système qui sera utilisée.
</p>
<p>
    Voici un exemple utilisant le port 50 et une valeur de 3 secondes pour le timeout :
</p>
<pre><code class="cpp">if (Server.Connect("ftp.myserver.com", 50, 3).IsOk())
{
    // Ok, nous sommes connectés
}
</code></pre>
<p>
    Une fois connecté au serveur, vous devez vous identifier avec votre nom d'utilisateur et votre mot de passe.
</p>
<pre><code class="cpp">if (Server.Login("username", "password").IsOk())
{
    // Ok, nous sommes identifiés
}
</code></pre>
<p>
    Vous pouvez également vous connecter de manière anonyme si le serveur supporte cette option :
</p>
<pre><code class="cpp">if (Server.Login().IsOk())
{
    // Ok, nous sommes connectés en tant qu'utilisateur anonyme
}
</code></pre>
<p>
    Vous êtes désormais identifiés sur le serveur, voyons ce que vous allez pouvoir faire avec lui.
</p>

<?php h2('Les commandes FTP') ?>
<p>
    Parce que le protocole FTP a pour but la manipulation de fichiers, on peut le voir comme un système de fichiers
    distant. Ainsi, les commandes qu'il définit sont similaires à celles que vous pouvez trouver sur votre système
    d'exploitation favori : parcourir les répertoires, afficher leur contenu, copier des fichiers, etc.
</p>
<p>
    Voici une liste des commandes FTP gérées par <?php class_link("Ftp")?>.
</p>
<p>
    <code>GetWorkingDirectory</code> récupère le répertoire de travail courant. Elle retourne une réponse spécialisée,
    de type <?php class_link("Ftp::DirectoryResponse", "Ftp_1_1DirectoryResponse")?>, qui contient le répertoire
    renvoyé par le serveur en plus des membres habituels.
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse Resp = Server.GetWorkingDirectory();
if (Resp.IsOk())
{
    std::string Directory = Resp.GetDirectory();
}
</code></pre>
<p>
    <code>GetDirectoryListing</code> récupère le contenu du répertoire donné, relatif au répertoire de travail courant.
    Il renvoie une réponse spécialisée, de type <?php class_link("Ftp::ListingResponse", "Ftp_1_1ListingResponse")?>, qui
    contient la liste des sous-fichiers et sous-répertoires renvoyée par le serveur en plus des membres habituels.
</p>
<pre><code class="cpp">sf::Ftp::ListingResponse Resp = Server.GetDirectoryListing("some_directory");
if (Resp.IsOk())
{
    for (std::size_t i = 0; i &lt; Resp.GetCount(); ++i)
    {
        std::string Filename = Resp.GetFilename(i);
    }
}
</code></pre>
<p>
    <code>ChangeDirectory</code> spécifie un nouveau répertoire de travail, relatif à l'actuel répertoire de
    travail. Cela peut être un chemin composé, séparé par des slashs.
</p>
<pre><code class="cpp">Server.ChangeDirectory("some/directory");
</code></pre>
<p>
    <code>ParentDirectory</code> met le répertoire de travail au parent du répertoire actuel. C'est en fait équivalent
    à un appel à <code>ChangeDirectory("..")</code>.

</p>
<pre><code class="cpp">Server.ParentDirectory();
</code></pre>
<p>
    <code>MakeDirectory</code> crée un nouveau répertoire fils du répertoire courant.
</p>
<pre><code class="cpp">Server.MakeDirectory("new_dir");
</code></pre>
<p>
    <code>DeleteDirectory</code> supprime le répertoire passé en paramètre (relatif au répertoire de travail courant).
    Attention, cette manipulation est définitive !
</p>
<pre><code class="cpp">Server.DeleteDirectory("dir_to_remove");
</code></pre>
<p>
    <code>RenameFile</code> renomme un fichier.
</p>
<pre><code class="cpp">Server.RenameFile("file.txt", "new_name.txt");
</code></pre>
<p>
    <code>DeleteFile</code> supprime un fichier existant.
</p>
<pre><code class="cpp">Server.DeleteFile("file.txt");
</code></pre>
<p>
    <code>Download</code> transfère un fichier du serveur vers le client. Il existe trois modes de transfert :
    binaire (par défaut, adapté à tout fichier), Ascii (optimisé pour les fichiers text ASCII) et
    Ebcdic (optimisé pour les fichiers text EBCDIC).
</p>
<pre><code class="cpp">Server.Download("distant_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    <code>Upload</code> transfère un fichier du client vers le serveur. Les modes de transferts sont les mêmes que
    pour la fonction <code>Download</code>.
</p>
<pre><code class="cpp">Server.Upload("local_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    Note : les fonctions <code>Download</code> et <code>Upload</code> peuvent prendre un certain temps à terminer,
    selon la taille du fichier à transférer. Si vous ne voulez pas bloquer votre application, il peut être une bonne idée
    de les exécuter dans un thread.
</p>
<p>
    <code>KeepAlive</code> est une fonction particulière qui ne fait rien. La plupart des serveurs FTP déconnectent
    les clients après plusieurs minutes d'inactivité ; cette fonction peut être appelée lorsque rien ne se passe, pour
    empêcher cette déconnexion automatique.
</p>
<pre><code class="cpp">Server.KeepAlive();
</code></pre>
<p>
    <code>Disconnect</code> déconnecte le client du serveur. Appeler cette fonction n'est pas obligatoire (mais recommandé)
    étant donné que ce sera de toute façon fait à la destruction des instances de <?php class_link("Ftp")?>.
</p>
<pre><code class="cpp">Server.Disconnect();
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Ceci était le dernier tutoriel concernant le module réseau. Vous pouvez maintenant
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">passer à une autre section</a>,
    et apprendre à utiliser un nouveau module SFML. 
</p>

<?php

    require("footer-fr.php");

?>
