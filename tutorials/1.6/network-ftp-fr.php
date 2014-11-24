<?php

    $title = "Utiliser FTP";
    $page = "network-ftp-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser FTP</h1>

<?php h2('Introduction') ?>
<p>
    FTP (<em>File Transfer Protocol</em>) est un protocole tr�s utilis� pour transf�rer et acc�der � des fichiers
    via internet, ou tout autre r�seau. Il consiste en une architecture client-serveur qui est globalement tr�s simple :
    le client envoie une commande au serveur, qui ex�cute celle-ci et renvoie une r�ponse au client pour l'informer
    du succ�s ou de l'�chec de l'op�ration.
</p>
<p>
    SFML fournit une classe simple qui impl�mente un client FTP ainsi que toutes les commandes qu'il peut envoyer
    � un serveur FTP : <?php class_link("Ftp")?>.
</p>

<?php h2('R�ponses FTP') ?>
<p>
    Avant d'utiliser notre classe FTP, il faut expliquer le concept des r�ponses. Toute action FTP est en interne
    une commande qui est ex�cut�e par le serveur, et qui retourne une r�ponse contenant un code d'�tat et un message.
    Ainsi, tout appel � une fonction de <?php class_link("Ftp")?> retourne une telle r�ponse, repr�sent�e par la classe
    <?php class_link("Ftp::Response", "Ftp_1_1Response")?>. Celle-ci est une simple encapsulation des r�ponses FTP,
    et contient le code d'�tat et le message renvoy�s par le serveur.
</p>
<pre><code class="cpp">sf::Ftp Server;
sf::Ftp::Response Resp = Server.xxx(); // Voir ci-dessous...

sf::Ftp::Response::Status Status = Resp.GetStatus();
std::string Message = Resp.GetMessage();
</code></pre>
<p>
    Le code d'�tat et le message peuvent �tre utiles si vous souhaitez afficher des informations d�taill�es concernant
    ce qu'il se passe du c�t� du serveur, sinon ils peuvent simplement �tre ignor�s. La seule chose importante
    est de v�rifier si le code d'�tat repr�sente un succ�s ou un �chec de l'op�ration, ce qui peut �tre fait
    facilement avec la fonction <code>IsOk</code>.
</p>
<pre><code class="cpp">bool Success = Resp.IsOk();
</code></pre>
<p>
    Ainsi, toute commande FTP peut �tre v�rifi�e directement :
</p>
<pre><code class="cpp">if (Server.xxx().IsOk())
{
    // Succ�s
}
else
{
    // Echec
}
</code></pre>

<?php h2('Connection � un serveur FTP') ?>
<p>
    La premi�re �tape est de se connecter � un serveur FTP.
</p>
<pre><code class="cpp">sf::Ftp Server;
if (Server.Connect("ftp.myserver.com").IsOk())
{
    // Ok, nous sommes connect�s
}
</code></pre>
<p>
    L'adresse du serveur peut �tre n'importe quelle <?php class_link("IPAddress")?> valide : une URL, une adresse IP,
    un nom r�seau, etc.
</p>
<p>
    La fonction <code>Connect</code> peut accepter deux param�tres optionnels suppl�mentaires : un port r�seau et une
    valeur de timeout.<br/>
    Le port par d�faut utilis� par le protocole FTP est 21, mais certaines applications peuvent vouloir en utiliser
    un autre.<br/>
    Le timeout  peut �tre utilis� pour s'assurer que l'application ne va pas geler trop longtemps si le serveur ne r�pond
    pas ; si vous n'en sp�cifiez pas, ce sera la valeur par d�faut du syst�me qui sera utilis�e.
</p>
<p>
    Voici un exemple utilisant le port 50 et une valeur de 3 secondes pour le timeout :
</p>
<pre><code class="cpp">if (Server.Connect("ftp.myserver.com", 50, 3).IsOk())
{
    // Ok, nous sommes connect�s
}
</code></pre>
<p>
    Une fois connect� au serveur, vous devez vous identifier avec votre nom d'utilisateur et votre mot de passe.
</p>
<pre><code class="cpp">if (Server.Login("username", "password").IsOk())
{
    // Ok, nous sommes identifi�s
}
</code></pre>
<p>
    Vous pouvez �galement vous connecter de mani�re anonyme si le serveur supporte cette option :
</p>
<pre><code class="cpp">if (Server.Login().IsOk())
{
    // Ok, nous sommes connect�s en tant qu'utilisateur anonyme
}
</code></pre>
<p>
    Vous �tes d�sormais identifi�s sur le serveur, voyons ce que vous allez pouvoir faire avec lui.
</p>

<?php h2('Les commandes FTP') ?>
<p>
    Parce que le protocole FTP a pour but la manipulation de fichiers, on peut le voir comme un syst�me de fichiers
    distant. Ainsi, les commandes qu'il d�finit sont similaires � celles que vous pouvez trouver sur votre syst�me
    d'exploitation favori : parcourir les r�pertoires, afficher leur contenu, copier des fichiers, etc.
</p>
<p>
    Voici une liste des commandes FTP g�r�es par <?php class_link("Ftp")?>.
</p>
<p>
    <code>GetWorkingDirectory</code> r�cup�re le r�pertoire de travail courant. Elle retourne une r�ponse sp�cialis�e,
    de type <?php class_link("Ftp::DirectoryResponse", "Ftp_1_1DirectoryResponse")?>, qui contient le r�pertoire
    renvoy� par le serveur en plus des membres habituels.
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse Resp = Server.GetWorkingDirectory();
if (Resp.IsOk())
{
    std::string Directory = Resp.GetDirectory();
}
</code></pre>
<p>
    <code>GetDirectoryListing</code> r�cup�re le contenu du r�pertoire donn�, relatif au r�pertoire de travail courant.
    Il renvoie une r�ponse sp�cialis�e, de type <?php class_link("Ftp::ListingResponse", "Ftp_1_1ListingResponse")?>, qui
    contient la liste des sous-fichiers et sous-r�pertoires renvoy�e par le serveur en plus des membres habituels.
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
    <code>ChangeDirectory</code> sp�cifie un nouveau r�pertoire de travail, relatif � l'actuel r�pertoire de
    travail. Cela peut �tre un chemin compos�, s�par� par des slashs.
</p>
<pre><code class="cpp">Server.ChangeDirectory("some/directory");
</code></pre>
<p>
    <code>ParentDirectory</code> met le r�pertoire de travail au parent du r�pertoire actuel. C'est en fait �quivalent
    � un appel � <code>ChangeDirectory("..")</code>.

</p>
<pre><code class="cpp">Server.ParentDirectory();
</code></pre>
<p>
    <code>MakeDirectory</code> cr�e un nouveau r�pertoire fils du r�pertoire courant.
</p>
<pre><code class="cpp">Server.MakeDirectory("new_dir");
</code></pre>
<p>
    <code>DeleteDirectory</code> supprime le r�pertoire pass� en param�tre (relatif au r�pertoire de travail courant).
    Attention, cette manipulation est d�finitive !
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
    <code>Download</code> transf�re un fichier du serveur vers le client. Il existe trois modes de transfert :
    binaire (par d�faut, adapt� � tout fichier), Ascii (optimis� pour les fichiers text ASCII) et
    Ebcdic (optimis� pour les fichiers text EBCDIC).
</p>
<pre><code class="cpp">Server.Download("distant_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    <code>Upload</code> transf�re un fichier du client vers le serveur. Les modes de transferts sont les m�mes que
    pour la fonction <code>Download</code>.
</p>
<pre><code class="cpp">Server.Upload("local_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    Note : les fonctions <code>Download</code> et <code>Upload</code> peuvent prendre un certain temps � terminer,
    selon la taille du fichier � transf�rer. Si vous ne voulez pas bloquer votre application, il peut �tre une bonne id�e
    de les ex�cuter dans un thread.
</p>
<p>
    <code>KeepAlive</code> est une fonction particuli�re qui ne fait rien. La plupart des serveurs FTP d�connectent
    les clients apr�s plusieurs minutes d'inactivit� ; cette fonction peut �tre appel�e lorsque rien ne se passe, pour
    emp�cher cette d�connexion automatique.
</p>
<pre><code class="cpp">Server.KeepAlive();
</code></pre>
<p>
    <code>Disconnect</code> d�connecte le client du serveur. Appeler cette fonction n'est pas obligatoire (mais recommand�)
    �tant donn� que ce sera de toute fa�on fait � la destruction des instances de <?php class_link("Ftp")?>.
</p>
<pre><code class="cpp">Server.Disconnect();
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Ceci �tait le dernier tutoriel concernant le module r�seau. Vous pouvez maintenant
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">passer � une autre section</a>,
    et apprendre � utiliser un nouveau module SFML. 
</p>

<?php

    require("footer-fr.php");

?>
