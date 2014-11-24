<?php

    $title = "Ouvrir une fen�tre";
    $page = "window-window-fr.php";

    require("header-fr.php");
?>

<h1>Ouvrir une fen�tre</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons apprendre � utiliser le module de fen�trage de la SFML afin d'obtenir
    un syst�me de fen�trage minimal, comme SDL ou GLUT permettent de le faire.
</p>

<?php h2('Pr�parer le code') ?>
<p>
    Premi�rement, vous devez inclure l'en-t�te n�cessaire � l'utilisation du module de fen�trage :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    Cet en-t�te est le seul n�cessaire, il se charge d'inclure tous les autres en-t�tes du module de fen�trage.
    C'est d'ailleurs le cas pour les autres modules : si vous voulez utiliser le module xxx, il vous
    suffit d'inclure l'en-t�te &lt;SFML/xxx.hpp&gt;.
</p>
<p>
    Il vous faut ensuite d�finir la c�l�bre fonction <code>main</code> :
</p>
<pre><code class="cpp">int main()
{
    // Notre code sera plac� ici
}
</code></pre>
<p>
    Ou bien, si vous voulez r�cup�rer les param�tres de la ligne de commande :
</p>
<pre><code class="cpp">int main(int argc, char** argv)
{
    // Notre code sera plac� ici
}
</code></pre>
<p>
    Sous Windows, vous avez peut-�tre cr�� un projet "Application Windows", particuli�rement si vous
    ne souhaitez pas voir appara�tre une console. Dans ce cas, plut�t que de remplacer
    <code>main</code> par <code>WinMain</code>, vous pouvez lier avec la
    biblioth�que statique SFML_Main et ainsi garder un point d'entr�e <code>main</code>
    portable et standard.
</p>

<?php h2('Cr�er la fen�tre') ?>
<p>
    L'�tape suivante est d'ouvrir une fen�tre. Les fen�tres SFML sont d�finies par la classe
    <?php class_link("Window")?>. Cette classe fournit plusieurs constructeurs utiles pour cr�er
    directement votre fen�tre. Celui qui nous int�resse ici est le suivant :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    Ici nous cr�ons une nouvelle variable nomm�e <code>App</code>, qui va repr�senter notre
    nouvelle fen�tre. Passons en revue les param�tres :
</p>
<ul>
    <li>Le premier param�tre est un <?php class_link("VideoMode")?>, qui repr�sente le
    mode vid�o choisi pour la fen�tre. Ici, il d�finit une taille de 800x600 pixels et une profondeur
    de 32 bits par pixel. Notez bien que la taille sp�cifi�e sera la taille interne de la fen�tre,
    sans compter donc la barre de titre et les bordures.</li>
    <li>Le second param�tre est le titre de la fen�tre, de type <code>std::string</code></li>
</ul>
</p>
<p>
    Si vous voulez cr�er votre fen�tre plus tard ou bien la recr�er avec des param�tres diff�rents, vous
    pouvez utiliser sa fonction <code>Create</code> :
</p>
<pre><code class="cpp">App.Create(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    Les constructeurs et les fonctions <code>Create</code> acceptent �galement deux param�tres additionnels optionels, le
    premier pour avoir plus de contr�le sur le style de la fen�tre, le second pour acc�der � des
    options graphiques plus avanc�es ; nous reviendrons sur ce dernier dans un prochain tutoriel, en tant que d�butant
    vous n'aurez pas � vous en soucier pour le moment.<br/>
    Le param�tre de style peut �tre une combinaison des options <code>sf::Style</code>, � savoir
    <code>None</code>, <code>Titlebar</code>, <code>Resize</code>, <code>Close</code> et <code>Fullscreen</code>. Le style par d�faut est
    <code>Resize | Close</code>.
</p>
<pre><code class="cpp">// Ceci cr�e une fen�tre plein-�cran
App.Create(sf::VideoMode(800, 600, 32), "SFML Window", sf::Style::Fullscreen);
</code></pre>

<?php h2('Les modes vid�o') ?>
<p>
    Dans l'exemple ci-dessus, nous ne nous pr�occupons pas du mode vid�o parce que notre application s'ex�cute
    en mode fen�tr� ; n'importe quelle taille fait l'affaire. Mais si nous voulions tourner en plein �cran,
    seuls quelques modes seraient disponibles. <?php class_link("VideoMode")?> fournit une interface
    pour r�cup�rer tous les modes vid�o support�s, avec les deux fonctions statiques
    <code>GetModesCount</code> et <code>GetMode</code> :
</p>
<pre><code class="cpp">unsigned int VideoModesCount = sf::VideoMode::GetModesCount();
for (unsigned int i = 0; i &lt; VideoModesCount; ++i)
{
    sf::VideoMode Mode = sf::VideoMode::GetMode(i);

    // Mode est un mode vid�o valide
}
</code></pre>
<p>
    Notez que les modes vid�o sont tri�s du plus haut au plus bas, ainsi
    <code>sf::VideoMode::GetMode(0)</code> renverra toujours le meilleur mode parmi ceux
    support�s.
</p>
<pre><code class="cpp">// Creation d'une fen�tre plein �cran avec le meilleur mode vid�o
App.Create(sf::VideoMode::GetMode(0), "SFML Window", sf::Style::Fullscreen);
</code></pre>
<p>
    Si vous r�cup�rez les modes vid�o avec le code ci-dessus alors ils seront bien entendu tous valides,
    mais il existe des cas o� l'on r�cup�re un mode vid�o par un autre moyen, � partir d'un fichier
    de configuration par exemple. Dans de tels cas, il est possible de v�rifier la validit� d'un mode
    � l'aide de sa fonction <code>IsValid()</code> :
</p>
<pre><code class="cpp">sf::VideoMode Mode = ReadModeFromConfigFile();
if (!Mode.IsValid())
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez �galement obtenir le mode vid�o du bureau, avec la fonction
    <code>GetDesktopMode</code> :
</p>
<pre><code class="cpp">sf::VideoMode DesktopMode = sf::VideoMode::GetDesktopMode();
</code></pre>

<?php h2('La boucle principale') ?>
<p>
    Une fois la fen�tre cr��e, nous pouvons entrer dans la boucle principale :
</p>
<pre><code class="cpp">bool Running = true;
while (Running)
{
    App.Display();
}

return EXIT_SUCCESS;
</code></pre>
<p>
    Pour terminer la boucle principale et quitter l'application, il suffira donc de passer la variable
    <code>Running</code> � <code>false</code>. Cela se fait typiquement
    lorsque la fen�tre est ferm�e, ou lorsque l'utilisateur appuie sur une touche sp�ciale comme echap ;
    nous verrons comment intercepter ces �v�nements dans le prochain tutoriel.
</p>
<p>
    Pour le moment, notre boucle principale ne fait qu'un appel � <code>App.Display()</code>.
    C'est en fait le seul appel n�cessaire pour afficher le contenu de notre fen�tre � l'�cran.
    L'appel � <code>Display</code> doit toujours �tre unique dans la boucle principale,
    et �tre la derni�re instruction, une fois que tout le reste a �t� mis � jour et affich�.<br/>
    A ce point du code, vous devriez voir n'importe quoi � l'�cran (peut-�tre un fond noir, peut-�tre pas)
    puisque nous n'affichons rien dans notre fen�tre.
</p>
<p>
    Comme vous pouvez le voir, il n'y a pas de code suppl�mentaire apr�s la boucle principale :
    notre fen�tre est correctement d�truite de mani�re automatique lorsque la fonction
    <code>main</code> se termine (le m�nage est effectu� dans le destructeur).<br/>
    Pour ceux qui n'utilisent jamais <code>EXIT_SUCCESS</code>, il s'agit juste d'une constante
    valant 0. Pour renvoyer une erreur vous pouvez utiliser sa soeur <code>EXIT_FAILURE</code>
    plut�t que -1.
</p>

<?php h2('Conclusion') ?>
<p>
    Et voil�, avec ce code vous avez un programme minimal mais complet qui ouvre une fen�tre SFML.
    Mais nous ne pouvons pas encore stopper le programme... Sautons donc au
    <a class="internal" href="./window-events-fr.php" title="Prochain tutoriel : g�rer les �v�nements">prochain tutoriel</a>,
    pour voir comment intercepter les �v�nements !
</p>

<?php

    require("footer-fr.php");

?>
