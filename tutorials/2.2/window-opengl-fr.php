<?php

    $title = "Utiliser OpenGL dans une fen�tre SFML";
    $page = "window-opengl-fr.php";

    require("header-fr.php");

?>

<h1>Utiliser OpenGL dans une fen�tre SFML</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel ne parle pas d'OpenGL, mais plut�t de la mani�re d'utiliser SFML comme interface � OpenGL, ainsi que la fa�on de les m�langer.
</p>
<p>
    Comme vous le savez tr�s certainement, l'un des plus importants atouts d'OpenGL est sa portabilit�. Mais OpenGL tout seul ne sera pas suffisant
    pour cr�er un programme complet : vous aurez �galement besoin d'une fen�tre, d'un contexte de rendu, des entr�es utilisateur, etc. Et pour �a vous
    n'avez pas d'autre choix que d'�crire du code sp�cifique � l'OS. C'est l� que le module sfml-window intervient ; voyons comment il vous permet
    de jouer avec OpenGL.
</p>

<?php h2('Inclure et lier OpenGL � votre application') ?>
<p>
    Le nom des en-t�tes OpenGL est malheureusement diff�rent pour chaque OS. Pas de panique, SFML fournit un en-t�te "abstrait" qui s'occupe d'inclure
    le bon fichier pour vous.
</p>
<pre><code class="cpp">#include &lt;SFML/OpenGL.hpp&gt;
</code></pre>
<p>
    Cet en-t�te inclut les fonctions OpenGL et GLU, et rien d'autre. Certains utilisateurs pensent � tort que SFML inclut automatiquement GLEW (une
    biblioth�que qui g�re les extensions OpenGL) parce qu'elle l'utilise en interne, mais ce n'est qu'un d�tail d'impl�mentation. Du point de vue de
    l'utilisateur, GLEW doit �tre g�r�e comme n'importe quelle autre biblioth�que.
</p>
<p>
    Vous aurez ensuite besoin de lier votre programme � OpenGL. Contrairement � ce qu'elle fait avec les en-t�tes, SFML ne peut pas fournir de
    moyen unifi� de lier OpenGL. Ainsi, vous devrez savoir quelle biblioth�que lier selon l'OS que vous utilisez ("opengl" sous Windows, "GL" sous
    Linux, etc.). Pareil pour GLU, au cas o� vous l'utiliseriez �galement : "glu32" sous Windows, "GLU" sous Linux, etc.
</p>
<p class="important">
    Les fonctions OpenGL sont pr�fix�es par "gl", les fonctions GLU par "glu". Souvenez-vous en lorsque vous aurez de b�tes erreurs d'�dition de liens,
    cela vous aidera � trouver quelle biblioth�que vous avez oubli� de lier.
</p>

<?php h2('Cr�er une fen�tre OpenGL') ?>
<p>
    Comme SFML est construite par dessus OpenGL, ses fen�tres sont d�j� pr�tes pour vos appels OpenGL, sans effort suppl�mentaire.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "OpenGL");

// �a marche directement
glEnable(GL_TEXTURE_2D);
...
</code></pre>
<p>
    Si vous pensez que c'est <em>trop</em> automatique, rassurez-vous : le constructeur de <?php class_link("Window") ?> accepte un param�tre
    suppl�mentaire qui vous permet de changer les options du contexte OpenGL de la fen�tre. Ce param�tre est une instance de la structure
    <?php struct_link("ContextSettings") ?>, qui d�finit les champs suivants :
</p>
<ul>
    <li><code>depthBits</code> est le nombre de bits par pixel pour le <em>depth buffer</em> (0 pour ne pas en cr�er)</li>
    <li><code>stencilBits</code> est le nombre de bits par pixel pour le <em>stencil buffer</em> (0 pour ne pas en cr�er)</li>
    <li><code>antialiasingLevel</code> est le niveau d'anti-cr�nelage</li>
    <li><code>majorVersion</code> et <code>minorVersion</code> d�finissent la version d'OpenGL demand�e</li>
</ul>
<pre><code class="cpp">sf::ContextSettings settings;
settings.depthBits = 24;
settings.stencilBits = 8;
settings.antialiasingLevel = 4;
settings.majorVersion = 3;
settings.minorVersion = 0;

sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, settings);
</code></pre>
<p>
    Si l'un (ou plusieurs) de ces param�tres n'est pas support� par la carte graphique, SFML essaye de trouver la plus proche valeur qui soit valide.
    Par exemple, si un anti-cr�nelage x4 n'est pas support�, SFML va essayer x2 puis en dernier recours se rabattre sur 0.<br />
    Dans ce cas de figure, vous pouvez savoir ce que SFML a choisi avec la fonction <code>getSettings</code> :
</p>
<pre><code class="cpp">sf::ContextSettings settings = window.getSettings();

std::cout &lt;&lt; "depth bits:" &lt;&lt; settings.depthBits &lt;&lt; std::endl;
std::cout &lt;&lt; "stencil bits:" &lt;&lt; settings.stencilBits &lt;&lt; std::endl;
std::cout &lt;&lt; "antialiasing level:" &lt;&lt; settings.antialiasingLevel &lt;&lt; std::endl;
std::cout &lt;&lt; "version:" &lt;&lt; settings.majorVersion &lt;&lt; "." &lt;&lt; settings.minorVersion &lt;&lt; std::endl;
</code></pre>
<p class="important">
    Les versions d'OpenGL sup�rieures � 3.0 sont support�es par SFML (pour autant que votre driver graphique puisse suivre), mais vous ne pouvez pas
    jouer avec les <em>flags</em> pour le moment. Cela signifie que vous ne pourrez pas cr�er de contexte <em>debug</em> ou <em>forward compatible</em> ;
    en fait SFML cr�e automatiquement des contextes poss�dant le flag de compatibilit�, car elle utilise encore quelques fonctions qui sont marqu�es
    "obsol�tes" dans les derni�res versions d'OpenGL. Cela devrait �tre am�lior� prochainement, de sorte que les flags de contexte puissent �tre
    choisis par l'utilisateur.
</p>

<p class="important">
    Sous OS X, SFML supporte les OpenGL 3.2 contextes avec un <em>core profile</em>.
    Cependant, gardez � l'esprit que ces contextes ne sont pas compatibles avec le module graphique de SFML.
    Si vous souhaitez l'utiliser vous devez continuer d'utiliser la version par d�faut qui est 2.1.
</p>

<?php h2('Un programme OpenGL typique, � la sauce SFML') ?>
<p>
    Voici � quoi pourrait ressembler un programme OpenGL complet avec SFML :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
#include &lt;SFML/OpenGL.hpp&gt;

int main()
{
    // cr�e la fen�tre
    sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, sf::ContextSettings(32));
    window.setVerticalSyncEnabled(true);

    // chargement des ressources, initialisation des �tats OpenGL, ...

    // la boucle principale
    bool running = true;
    while (running)
    {
        // gestion des �v�nements
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
            {
                // on stoppe le programme
                running = false;
            }
            else if (event.type == sf::Event::Resized)
            {
                // on ajuste le viewport lorsque la fen�tre est redimensionn�e
                glViewport(0, 0, event.size.width, event.size.height);
            }
        }

        // effacement les tampons de couleur/profondeur
        glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

        // dessin...

        // termine la trame courante (en interne, �change les deux tampons de rendu)
        window.display();
    }

    // lib�ration des ressources...

    return 0;
}
</code></pre>
<p>
    Ici nous n'utilisons pas <code>window.isOpen()</code> comme condition pour la boucle principale, car nous avons besoin que la fen�tre reste ouverte
    jusqu'� la fin du programme, de fa�on � garder un contexte OpenGL valide pour la derni�re it�ration de la boucle ainsi que le code de lib�ration
    des ressources � la fin.
</p>
<p>
    N'h�sitez pas � jeter un oeil aux exemples "OpenGL" et "Window" du SDK de SFML si vous avez des difficult�s, ils sont plus complets et poss�dent
    tr�s probablement des r�ponses � vos questions.
</p>

<?php h2('G�rer plusieurs fen�tres OpenGL') ?>
<p>
    La gestion de plusieurs fen�tres OpenGL n'est pas plus compliqu�e que la gestion d'une seule, il y a juste certaines choses � savoir.
</p>
<p>
    Les appels OpenGL affectent le contexte actif (et donc la fen�tre active). Ainsi, si vous voulez dessiner sur deux fen�tres diff�rentes au sein
    du m�me programme, il vous faudra choisir quelle fen�tre est active avant de dessiner quoique ce soit. Pour ce faire, vous devez utiliser la
    fonction <code>setActive</code> :
</p>
<pre><code class="cpp">// activation de la premi�re fen�tre
window1.setActive(true);

// dessin sur la premi�re fen�tre...

// activation de la seconde fen�tre
window2.setActive(true);

// dessin sur la seconde fen�tre...
</code></pre>
<p>
    Un seul contexte (fen�tre) peut �tre actif dans chaque thread, vous n'avez donc pas besoin de d�sactiver la fen�tre active avant d'en activer une
    autre, c'est fait implicitement. C'est comme �a que fonctionne OpenGL.
</p>
<p>
    Une autre chose � savoir est que tous les contextes OpenGL cr��s par SFML partagent leurs ressources. Cela signifie que vous pouvez cr�er une
    texture ou un vertex buffer avec n'importe quel contexte actif, et l'utiliser avec n'importe quel autre. Cela signifie aussi que vous n'aurez pas
    besoin de recharger toutes vos ressources OpenGL si vous recr�ez votre fen�tre.
</p>

<?php h2('OpenGL sans fen�tre') ?>
<p>
    Il est parfois n�cessaire d'appeler des fonctions OpenGL alors qu'il n'y a aucune fen�tre, et donc aucun contexte OpenGL. Par exemple, lorsque
    vous chargez des textures depuis un thread, ou bien simplement avant que la premi�re fen�tre ne soit cr��e. SFML vous permet de cr�er des contextes
    sans fen�tre avec la classe <?php class_link("Context") ?>. Tout ce que vous avez � faire est de l'instancier pour obtenir un contexte valide.
</p>
<pre><code class="cpp">int main()
{
    sf::Context context;

    // chargement de ressources OpenGL...

    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    ...

    return 0;
}
</code></pre>

<?php h2('Dessiner depuis un thread') ?>
<p>
    Une configuration typique pour un programme multi-thread� est de g�rer la fen�tre et ses �v�nements depuis un thread (le principal), et le rendu
    depuis un autre. Si vous �tes dans ce cas de figure, il y a une r�gle importante � garder en t�te : vous ne pouvez pas activer un contexte (une
    fen�tre) s'il est actif dans un autre thread. En pratique, cela signifie que vous devez d�sactiver votre fen�tre avant de lancer le thread de rendu.
</p>
<pre><code class="cpp">void renderingThread(sf::Window* window)
{
    // activation du contexte de la fen�tre
    window->setActive(true);

    // la boucle de rendu
    while (window->isOpen())
    {
        // dessin...

        // fin de la trame -- ceci est une fonction de rendu (elle a besoin d'activer le contexte)
        window->display();
    }
}

int main()
{
    // cr�ation de la fen�tre (souvenez-vous: cr�er la fen�tre dans le thread principal est plus s�r, du fait des limitations de l'OS)
    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    // d�sactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de rendu
    sf::Thread thread(&amp;renderingThread, &amp;window);
    thread.Launch();

    // la boucle d'�v�nements/logique/etc.
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
</code></pre>

<?php h2('Utiliser SFML avec le module graphique de SFML') ?>
<p>
    Pour l'instant ce tutoriel a parl� de l'utilisation d'OpenGL avec sfml-window, ce qui est relativement simple �tant donn� que c'est le seul but
    de ce module. Mixer OpenGL avec le module graphique est un tout petit peu plus compliqu� : sfml-graphics utilise aussi OpenGL, il faut donc
    prendre certaines pr�cautions de sorte que les �tats OpenGL de l'utilisateur et ceux de SFML n'entrent pas en conflit.
</p>
<p>
    Si vous ne connaissez pas encore le module graphique, tout ce que vous avez � savoir c'est que la classe <?php class_link("Window") ?> est
    remplac�e par <?php class_link("RenderWindow") ?>, qui h�rite de toutes ses fonctions et en ajoute quelques autres qui servent � dessiner des
    entit�s SFML.
</p>
<p>
    Le seul moyen d'�viter les conflits entre SFML et vos propres �tats OpenGL, est de les sauvegarder/restaurer � chaque fois que vous passez d'OpenGL
    � SFML.
</p>
<pre><code class="cpp">- dessin avec OpenGL

- sauvegarde des �tats OpenGL

- dessin avec SFML

- restauration des �tats OpenGL

- dessin avec OpenGL

...
</code></pre>
<p>
    La solution la plus simple est de laisser SFML le faire pour vous, avec les fonctions <code>pushGLStates</code>/<code>popGLStates</code> :
</p>
<pre><code class="cpp">glDraw...

window.pushGLStates();

window.draw(...);

window.popGLStates();

glDraw...
</code></pre>
<p>
    Comme elle ne conna�t rien de votre code OpenGL, SFML ne peut pas optimiser ces �tapes et en cons�quence elle sauvegarde/restaure absolument tous
    les �tats et matrices OpenGL. C'est n�gligeable pour des petits projets, mais cela peut se r�v�ler trop lent sur des programmes cons�quents qui
    requierent des performances maximales. Dans ce cas, vous pouvez g�rer vous-m�me la sauvegarde et la restauration des �tats OpenGL, avec
    <code>glPushAttrib</code>/<code>glPopAttrib</code>, <code>glPushMatrix</code>/<code>glPopMatrix</code>, etc.<br />
    Vous devrez cependant toujours restaurer les �tats de SFML avant dessiner avec elle, avec la fonction <code>resetGLStates</code>.
</p>
<pre><code class="cpp">glDraw...

glPush...
window.resetGLStates();

window.draw(...);

glPop...

glDraw...
</code></pre>
<p>
    En g�rant vous-m�me la sauvegarde des �tats OpenGL, vous pouvez vous occuper uniquement de ceux qui vous int�ressent, et �pargner quelques appels
    inutiles.
</p>

<?php

    require("footer-fr.php");

?>
