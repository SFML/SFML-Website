<?php

    $title = "Utiliser OpenGL";
    $page = "window-opengl-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser OpenGL</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel ne traite pas d'OpenGL en lui-même, mais seulement de la manière d'utiliser le
    module de fenêtrage pour s'interfacer avec OpenGL. Comme vous le savez sans doute, l'une des fonctionnalités
    les plus importantes d'OpenGL est la portabilité. Cependant, pour fonctionner OpenGL requiert que vous ayiez
    créé un contexte de rendu en premier lieu. Et les contextes de rendu sont tout sauf portables ;
    chaque système d'exploitation possède son propre moyen de les créer. C'est pourquoi les gens utilisent habituellement
    une bibliothèque portable afin d'obtenir un système de fenêtrage et d'évènements portable capable de faire tourner
    OpenGL quelque soit le système. Les bibliothèques les plus connues pour le faire sont SDL et GLUT, mais elles sont
    écrites en C et pas toujours pratiques à utiliser en C++, particulièrement si vous avez une approche orientée objet.
    Elles souffrent également de certains manques essentiels, comme être utilisables dans plusieurs fenêtres
    simultanées ou dans des interfaces existantes.
</p>

<?php h2('Initialisation') ?>
<p>
    Pour utiliser OpenGL, vous n'avez qu'à inclure Window.hpp : les en-têtes d'OpenGL et de GLU seront automatiquement
    inclus par celui-ci. Ceci afin que vous n'ayiez pas à utiliser des commandes préprocesseur, car les en-têtes OpenGL ont
    différents noms selon le système d'exploitation.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    Aucune étape supplémentaire n'est requise pour initialiser SFML lorsque vous voulez utiliser OpenGL.
    Nous pouvons donc créer une fenêtre comme nous l'avons vu auparavant :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL");
</code></pre>
<p>
    Si vous voulez plus de contrôle sur la création du contexte OpenGL, vous pouvez passer une structure additionnelle
    lors de la création de la fenêtre, qui contient des paramètres graphiques supplémentaires tels que le <em>Z-buffer</em>,
    le <em>stencil-buffer</em>, ou encore le niveau d'anti-crénelage. La structure à utiliser est
    <code>WindowSettings</code> :
</p>
<pre><code class="cpp">sf::WindowSettings Settings;
Settings.DepthBits         = 24; // Demande un Z-buffer 24 bits
Settings.StencilBits       = 8;  // Demande un stencil-buffer 8 bits
Settings.AntialiasingLevel = 2;  // Demande 2 niveaux d'anti-crénelage
sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL", sf::Style::Close, Settings);
</code></pre>
<p>
    Chaque membre de la structure <code>WindowSettings</code> a une valeur par défaut appropriée, vous pouvez donc
    ne spécifier que ceux qui vous intéressent. Selon la configuration matérielle, les options demandées peuvent ne pas
    être supportées. Dans ce cas, SFML choisira les paramètres valides les plus proches de ceux demandés. Pour savoir
    ce qui a été choisi, vous pouvez récupérer la configuration de la fenêtre après sa création :
</p>
<pre><code class="cpp">sf::WindowSettings Settings = App.GetSettings();
</code></pre>
<p>
    Une fois qu'une fenêtre est créée, nous avons un contexte de rendu valide. C'est donc le bon moment
    pour effectuer toutes nos initialisations spécifiques à OpenGL. Ici nous mettons en place une
    vue en perspective et nous activons le tampon de profondeur (<em>Z-Buffer</em>) :
</p>
<pre><code class="cpp">// Initialisation des valeurs d'effacement pour les tampons de couleur et de profondeur
glClearDepth(1.f);
glClearColor(0.f, 0.f, 0.f, 0.f);

// Activation de la lecture et de l'écriture dans le tampon de profondeur
glEnable(GL_DEPTH_TEST);
glDepthMask(GL_TRUE);

// Mise en place d'une projection perspective
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluPerspective(90.f, 1.f, 1.f, 500.f);
</code></pre>
<p>
    Tous les contextes sont partagés, c'est-à-dire que vous pouvez créer une texture pendant que FenetreA est active,
    et l'utiliser pour dessiner sur FenetreB.
</p>

<?php h2('Boucle principale - affichage d\'un cube') ?>
<p>
    La boucle principale démarre comme précédemment, avec la gestion des évènements :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Du code pour stopper l'application à la fermeture ou lorsque la touche echap est enfoncée
    }
</code></pre>
<p>
    Mais ici nous avons à gérer un évènements supplémentaire : <code>Resized</code>.
    Nous devons le gérer car lorsque la taille de la fenêtre change, il faut ajuster le viewport OpenGL
    afin qu'il corresponde à la nouvelle taille. Le viewport est la zone de la fenêtre dans laquelle
    la scène va être affichée, donc si vous ne l'ajustez pas lorsque la fenêtre est redimensionnée,
    votre scène sera dessinée dans un petit sous-rectangle de la fenêtre.
</p>
<pre><code class="cpp">if (Event.Type == sf::Event::Resized)
    glViewport(0, 0, Event.Size.Width, Event.Size.Height);
</code></pre>
<p>
    Vous pouvez maintenant commencer à afficher une nouvelle frame. Avant d'appeler une fonction OpenGL,
    vous devez vous assurer que c'est la bonne fenêtre qui est active. Ici nous ne nous en occupons pas
    car nous n'avons qu'une fenêtre, mais si vous devez en gérer plusieurs il faudra en tenir compte.
    Pour rendre une fenêtre active, vous pouvez appeler sa fonction <code>SetActive</code> :
</p>
<pre><code class="cpp">App.SetActive();
</code></pre>
<p>
    Puis, la première chose à faire est d'effacer les tampons de couleur et de profondeur afin
    d'effacer le contenu de la frame précédente :
</p>
<pre><code class="cpp">glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
</code></pre>
<p>
    Nous sommes maintenant prêt à afficher un cube. Tout d'abord, nous définissons sa position et son
    orientation. Nous allons faire évoluer l'orientation avec le temps écoulé, pour ajouter un peu
    de mouvement.
</p>
<pre><code class="cpp">glMatrixMode(GL_MODELVIEW);
glLoadIdentity();
glTranslatef(0.f, 0.f, -200.f);
glRotatef(Clock.GetElapsedTime() * 50, 1.f, 0.f, 0.f);
glRotatef(Clock.GetElapsedTime() * 30, 0.f, 1.f, 0.f);
glRotatef(Clock.GetElapsedTime() * 90, 0.f, 0.f, 1.f);
</code></pre>
<p>
    Puis nous dessinons le cube :
</p>
<pre><code class="cpp">glBegin(GL_QUADS);

    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f(-50.f,  50.f, -50.f);
    glVertex3f( 50.f,  50.f, -50.f);
    glVertex3f( 50.f, -50.f, -50.f);

    glVertex3f(-50.f, -50.f, 50.f);
    glVertex3f(-50.f,  50.f, 50.f);
    glVertex3f( 50.f,  50.f, 50.f);
    glVertex3f( 50.f, -50.f, 50.f);

    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f(-50.f,  50.f, -50.f);
    glVertex3f(-50.f,  50.f,  50.f);
    glVertex3f(-50.f, -50.f,  50.f);

    glVertex3f(50.f, -50.f, -50.f);
    glVertex3f(50.f,  50.f, -50.f);
    glVertex3f(50.f,  50.f,  50.f);
    glVertex3f(50.f, -50.f,  50.f);

    glVertex3f(-50.f, -50.f,  50.f);
    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f( 50.f, -50.f, -50.f);
    glVertex3f( 50.f, -50.f,  50.f);

    glVertex3f(-50.f, 50.f,  50.f);
    glVertex3f(-50.f, 50.f, -50.f);
    glVertex3f( 50.f, 50.f, -50.f);
    glVertex3f( 50.f, 50.f,  50.f);

glEnd();
</code></pre>
<p>
    Enfin, nous pouvons terminer notre boucle principale en affichant le rendu à l'écran :
</p>
<pre><code class="cpp">App.Display();
</code></pre>
<p>
    Et voilà, vous devriez avoir un cube blanc tournant sur un fond noir. Comme d'habitude, aucune
    destruction explicite n'est nécessaire après la fin de la boucle principale, tout est nettoyé correctement.
</p>

<?php h2('Conclusion') ?>
<p>
    Utiliser OpenGL avec la SFML est très facile, et ne nécessite aucune étape supplémentaire comparé à
    une utilisation classique de la SFML. Vous pouvez avoir un système de fenêtrage OpenGL robuste, portable
    et orienté objet avec seulement quelques lignes de code.
</p>
<p>
    Vous savez maintenant à peu près tout sur le module de fenêtrage de la SFML. Vous avez appris à installer
    l'API SFML, ouvrir une fenêtre, gérer correctement les entrées, les évènements et le temps, et à
    interfacer OpenGL. Vous pouvez maintenant sauter à
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">une autre section</a> pour apprendre à utiliser un nouveau module.
</p>

<?php

    require("footer-fr.php");

?>
