<?php

    $title = "Ouvrir une fenêtre";
    $page = "window-window-fr.php";

    require("header-fr.php");
?>

<h1>Ouvrir une fenêtre</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons apprendre à utiliser le module de fenêtrage de la SFML afin d'obtenir
    un système de fenêtrage minimal, comme SDL ou GLUT permettent de le faire.
</p>

<?php h2('Préparer le code') ?>
<p>
    Premièrement, vous devez inclure l'en-tête nécessaire à l'utilisation du module de fenêtrage :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    Cet en-tête est le seul nécessaire, il se charge d'inclure tous les autres en-têtes du module de fenêtrage.
    C'est d'ailleurs le cas pour les autres modules : si vous voulez utiliser le module xxx, il vous
    suffit d'inclure l'en-tête &lt;SFML/xxx.hpp&gt;.
</p>
<p>
    Il vous faut ensuite définir la célèbre fonction <code>main</code> :
</p>
<pre><code class="cpp">int main()
{
    // Notre code sera placé ici
}
</code></pre>
<p>
    Ou bien, si vous voulez récupérer les paramètres de la ligne de commande :
</p>
<pre><code class="cpp">int main(int argc, char** argv)
{
    // Notre code sera placé ici
}
</code></pre>
<p>
    Sous Windows, vous avez peut-être créé un projet "Application Windows", particulièrement si vous
    ne souhaitez pas voir apparaître une console. Dans ce cas, plutôt que de remplacer
    <code>main</code> par <code>WinMain</code>, vous pouvez lier avec la
    bibliothèque statique SFML_Main et ainsi garder un point d'entrée <code>main</code>
    portable et standard.
</p>

<?php h2('Créer la fenêtre') ?>
<p>
    L'étape suivante est d'ouvrir une fenêtre. Les fenêtres SFML sont définies par la classe
    <?php class_link("Window")?>. Cette classe fournit plusieurs constructeurs utiles pour créer
    directement votre fenêtre. Celui qui nous intéresse ici est le suivant :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    Ici nous créons une nouvelle variable nommée <code>App</code>, qui va représenter notre
    nouvelle fenêtre. Passons en revue les paramètres :
</p>
<ul>
    <li>Le premier paramètre est un <?php class_link("VideoMode")?>, qui représente le
    mode vidéo choisi pour la fenêtre. Ici, il définit une taille de 800x600 pixels et une profondeur
    de 32 bits par pixel. Notez bien que la taille spécifiée sera la taille interne de la fenêtre,
    sans compter donc la barre de titre et les bordures.</li>
    <li>Le second paramètre est le titre de la fenêtre, de type <code>std::string</code></li>
</ul>
</p>
<p>
    Si vous voulez créer votre fenêtre plus tard ou bien la recréer avec des paramètres différents, vous
    pouvez utiliser sa fonction <code>Create</code> :
</p>
<pre><code class="cpp">App.Create(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    Les constructeurs et les fonctions <code>Create</code> acceptent également deux paramètres additionnels optionels, le
    premier pour avoir plus de contrôle sur le style de la fenêtre, le second pour accéder à des
    options graphiques plus avancées ; nous reviendrons sur ce dernier dans un prochain tutoriel, en tant que débutant
    vous n'aurez pas à vous en soucier pour le moment.<br/>
    Le paramètre de style peut être une combinaison des options <code>sf::Style</code>, à savoir
    <code>None</code>, <code>Titlebar</code>, <code>Resize</code>, <code>Close</code> et <code>Fullscreen</code>. Le style par défaut est
    <code>Resize | Close</code>.
</p>
<pre><code class="cpp">// Ceci crée une fenêtre plein-écran
App.Create(sf::VideoMode(800, 600, 32), "SFML Window", sf::Style::Fullscreen);
</code></pre>

<?php h2('Les modes vidéo') ?>
<p>
    Dans l'exemple ci-dessus, nous ne nous préoccupons pas du mode vidéo parce que notre application s'exécute
    en mode fenêtré ; n'importe quelle taille fait l'affaire. Mais si nous voulions tourner en plein écran,
    seuls quelques modes seraient disponibles. <?php class_link("VideoMode")?> fournit une interface
    pour récupérer tous les modes vidéo supportés, avec les deux fonctions statiques
    <code>GetModesCount</code> et <code>GetMode</code> :
</p>
<pre><code class="cpp">unsigned int VideoModesCount = sf::VideoMode::GetModesCount();
for (unsigned int i = 0; i &lt; VideoModesCount; ++i)
{
    sf::VideoMode Mode = sf::VideoMode::GetMode(i);

    // Mode est un mode vidéo valide
}
</code></pre>
<p>
    Notez que les modes vidéo sont triés du plus haut au plus bas, ainsi
    <code>sf::VideoMode::GetMode(0)</code> renverra toujours le meilleur mode parmi ceux
    supportés.
</p>
<pre><code class="cpp">// Creation d'une fenêtre plein écran avec le meilleur mode vidéo
App.Create(sf::VideoMode::GetMode(0), "SFML Window", sf::Style::Fullscreen);
</code></pre>
<p>
    Si vous récupérez les modes vidéo avec le code ci-dessus alors ils seront bien entendu tous valides,
    mais il existe des cas où l'on récupère un mode vidéo par un autre moyen, à partir d'un fichier
    de configuration par exemple. Dans de tels cas, il est possible de vérifier la validité d'un mode
    à l'aide de sa fonction <code>IsValid()</code> :
</p>
<pre><code class="cpp">sf::VideoMode Mode = ReadModeFromConfigFile();
if (!Mode.IsValid())
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez également obtenir le mode vidéo du bureau, avec la fonction
    <code>GetDesktopMode</code> :
</p>
<pre><code class="cpp">sf::VideoMode DesktopMode = sf::VideoMode::GetDesktopMode();
</code></pre>

<?php h2('La boucle principale') ?>
<p>
    Une fois la fenêtre créée, nous pouvons entrer dans la boucle principale :
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
    <code>Running</code> à <code>false</code>. Cela se fait typiquement
    lorsque la fenêtre est fermée, ou lorsque l'utilisateur appuie sur une touche spéciale comme echap ;
    nous verrons comment intercepter ces évènements dans le prochain tutoriel.
</p>
<p>
    Pour le moment, notre boucle principale ne fait qu'un appel à <code>App.Display()</code>.
    C'est en fait le seul appel nécessaire pour afficher le contenu de notre fenêtre à l'écran.
    L'appel à <code>Display</code> doit toujours être unique dans la boucle principale,
    et être la dernière instruction, une fois que tout le reste a été mis à jour et affiché.<br/>
    A ce point du code, vous devriez voir n'importe quoi à l'écran (peut-être un fond noir, peut-être pas)
    puisque nous n'affichons rien dans notre fenêtre.
</p>
<p>
    Comme vous pouvez le voir, il n'y a pas de code supplémentaire après la boucle principale :
    notre fenêtre est correctement détruite de manière automatique lorsque la fonction
    <code>main</code> se termine (le ménage est effectué dans le destructeur).<br/>
    Pour ceux qui n'utilisent jamais <code>EXIT_SUCCESS</code>, il s'agit juste d'une constante
    valant 0. Pour renvoyer une erreur vous pouvez utiliser sa soeur <code>EXIT_FAILURE</code>
    plutôt que -1.
</p>

<?php h2('Conclusion') ?>
<p>
    Et voilà, avec ce code vous avez un programme minimal mais complet qui ouvre une fenêtre SFML.
    Mais nous ne pouvons pas encore stopper le programme... Sautons donc au
    <a class="internal" href="./window-events-fr.php" title="Prochain tutoriel : gérer les évènements">prochain tutoriel</a>,
    pour voir comment intercepter les évènements !
</p>

<?php

    require("footer-fr.php");

?>
