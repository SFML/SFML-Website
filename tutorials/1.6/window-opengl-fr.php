<?php

    $title = "Utiliser OpenGL";
    $page = "window-opengl-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser OpenGL</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel ne traite pas d'OpenGL en lui-m�me, mais seulement de la mani�re d'utiliser le
    module de fen�trage pour s'interfacer avec OpenGL. Comme vous le savez sans doute, l'une des fonctionnalit�s
    les plus importantes d'OpenGL est la portabilit�. Cependant, pour fonctionner OpenGL requiert que vous ayiez
    cr�� un contexte de rendu en premier lieu. Et les contextes de rendu sont tout sauf portables ;
    chaque syst�me d'exploitation poss�de son propre moyen de les cr�er. C'est pourquoi les gens utilisent habituellement
    une biblioth�que portable afin d'obtenir un syst�me de fen�trage et d'�v�nements portable capable de faire tourner
    OpenGL quelque soit le syst�me. Les biblioth�ques les plus connues pour le faire sont SDL et GLUT, mais elles sont
    �crites en C et pas toujours pratiques � utiliser en C++, particuli�rement si vous avez une approche orient�e objet.
    Elles souffrent �galement de certains manques essentiels, comme �tre utilisables dans plusieurs fen�tres
    simultan�es ou dans des interfaces existantes.
</p>

<?php h2('Initialisation') ?>
<p>
    Pour utiliser OpenGL, vous n'avez qu'� inclure Window.hpp : les en-t�tes d'OpenGL et de GLU seront automatiquement
    inclus par celui-ci. Ceci afin que vous n'ayiez pas � utiliser des commandes pr�processeur, car les en-t�tes OpenGL ont
    diff�rents noms selon le syst�me d'exploitation.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    Aucune �tape suppl�mentaire n'est requise pour initialiser SFML lorsque vous voulez utiliser OpenGL.
    Nous pouvons donc cr�er une fen�tre comme nous l'avons vu auparavant :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL");
</code></pre>
<p>
    Si vous voulez plus de contr�le sur la cr�ation du contexte OpenGL, vous pouvez passer une structure additionnelle
    lors de la cr�ation de la fen�tre, qui contient des param�tres graphiques suppl�mentaires tels que le <em>Z-buffer</em>,
    le <em>stencil-buffer</em>, ou encore le niveau d'anti-cr�nelage. La structure � utiliser est
    <code>WindowSettings</code> :
</p>
<pre><code class="cpp">sf::WindowSettings Settings;
Settings.DepthBits         = 24; // Demande un Z-buffer 24 bits
Settings.StencilBits       = 8;  // Demande un stencil-buffer 8 bits
Settings.AntialiasingLevel = 2;  // Demande 2 niveaux d'anti-cr�nelage
sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL", sf::Style::Close, Settings);
</code></pre>
<p>
    Chaque membre de la structure <code>WindowSettings</code> a une valeur par d�faut appropri�e, vous pouvez donc
    ne sp�cifier que ceux qui vous int�ressent. Selon la configuration mat�rielle, les options demand�es peuvent ne pas
    �tre support�es. Dans ce cas, SFML choisira les param�tres valides les plus proches de ceux demand�s. Pour savoir
    ce qui a �t� choisi, vous pouvez r�cup�rer la configuration de la fen�tre apr�s sa cr�ation :
</p>
<pre><code class="cpp">sf::WindowSettings Settings = App.GetSettings();
</code></pre>
<p>
    Une fois qu'une fen�tre est cr��e, nous avons un contexte de rendu valide. C'est donc le bon moment
    pour effectuer toutes nos initialisations sp�cifiques � OpenGL. Ici nous mettons en place une
    vue en perspective et nous activons le tampon de profondeur (<em>Z-Buffer</em>) :
</p>
<pre><code class="cpp">// Initialisation des valeurs d'effacement pour les tampons de couleur et de profondeur
glClearDepth(1.f);
glClearColor(0.f, 0.f, 0.f, 0.f);

// Activation de la lecture et de l'�criture dans le tampon de profondeur
glEnable(GL_DEPTH_TEST);
glDepthMask(GL_TRUE);

// Mise en place d'une projection perspective
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluPerspective(90.f, 1.f, 1.f, 500.f);
</code></pre>
<p>
    Tous les contextes sont partag�s, c'est-�-dire que vous pouvez cr�er une texture pendant que FenetreA est active,
    et l'utiliser pour dessiner sur FenetreB.
</p>

<?php h2('Boucle principale - affichage d\'un cube') ?>
<p>
    La boucle principale d�marre comme pr�c�demment, avec la gestion des �v�nements :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Du code pour stopper l'application � la fermeture ou lorsque la touche echap est enfonc�e
    }
</code></pre>
<p>
    Mais ici nous avons � g�rer un �v�nements suppl�mentaire : <code>Resized</code>.
    Nous devons le g�rer car lorsque la taille de la fen�tre change, il faut ajuster le viewport OpenGL
    afin qu'il corresponde � la nouvelle taille. Le viewport est la zone de la fen�tre dans laquelle
    la sc�ne va �tre affich�e, donc si vous ne l'ajustez pas lorsque la fen�tre est redimensionn�e,
    votre sc�ne sera dessin�e dans un petit sous-rectangle de la fen�tre.
</p>
<pre><code class="cpp">if (Event.Type == sf::Event::Resized)
    glViewport(0, 0, Event.Size.Width, Event.Size.Height);
</code></pre>
<p>
    Vous pouvez maintenant commencer � afficher une nouvelle frame. Avant d'appeler une fonction OpenGL,
    vous devez vous assurer que c'est la bonne fen�tre qui est active. Ici nous ne nous en occupons pas
    car nous n'avons qu'une fen�tre, mais si vous devez en g�rer plusieurs il faudra en tenir compte.
    Pour rendre une fen�tre active, vous pouvez appeler sa fonction <code>SetActive</code> :
</p>
<pre><code class="cpp">App.SetActive();
</code></pre>
<p>
    Puis, la premi�re chose � faire est d'effacer les tampons de couleur et de profondeur afin
    d'effacer le contenu de la frame pr�c�dente :
</p>
<pre><code class="cpp">glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
</code></pre>
<p>
    Nous sommes maintenant pr�t � afficher un cube. Tout d'abord, nous d�finissons sa position et son
    orientation. Nous allons faire �voluer l'orientation avec le temps �coul�, pour ajouter un peu
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
    Enfin, nous pouvons terminer notre boucle principale en affichant le rendu � l'�cran :
</p>
<pre><code class="cpp">App.Display();
</code></pre>
<p>
    Et voil�, vous devriez avoir un cube blanc tournant sur un fond noir. Comme d'habitude, aucune
    destruction explicite n'est n�cessaire apr�s la fin de la boucle principale, tout est nettoy� correctement.
</p>

<?php h2('Conclusion') ?>
<p>
    Utiliser OpenGL avec la SFML est tr�s facile, et ne n�cessite aucune �tape suppl�mentaire compar� �
    une utilisation classique de la SFML. Vous pouvez avoir un syst�me de fen�trage OpenGL robuste, portable
    et orient� objet avec seulement quelques lignes de code.
</p>
<p>
    Vous savez maintenant � peu pr�s tout sur le module de fen�trage de la SFML. Vous avez appris � installer
    l'API SFML, ouvrir une fen�tre, g�rer correctement les entr�es, les �v�nements et le temps, et �
    interfacer OpenGL. Vous pouvez maintenant sauter �
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">une autre section</a> pour apprendre � utiliser un nouveau module.
</p>

<?php

    require("footer-fr.php");

?>
