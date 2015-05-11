<?php

    $title = "Utiliser OpenGL dans une fenêtre SFML";
    $page = "window-opengl-fr.php";

    require("header-fr.php");

?>

<h1>Utiliser OpenGL dans une fenêtre SFML</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel ne parle pas d'OpenGL, mais plutôt de la manière d'utiliser SFML comme interface à OpenGL, ainsi que la façon de les mélanger.
</p>
<p>
    Comme vous le savez très certainement, l'un des plus importants atouts d'OpenGL est sa portabilité. Mais OpenGL tout seul ne sera pas suffisant
    pour créer un programme complet : vous aurez également besoin d'une fenêtre, d'un contexte de rendu, des entrées utilisateur, etc. Et pour ça vous
    n'avez pas d'autre choix que d'écrire du code spécifique à l'OS. C'est là que le module sfml-window intervient ; voyons comment il vous permet
    de jouer avec OpenGL.
</p>

<?php h2('Inclure et lier OpenGL à votre application') ?>
<p>
    Le nom des en-têtes OpenGL est malheureusement différent pour chaque OS. Pas de panique, SFML fournit un en-tête "abstrait" qui s'occupe d'inclure
    le bon fichier pour vous.
</p>
<pre><code class="cpp">#include &lt;SFML/OpenGL.hpp&gt;
</code></pre>
<p>
    Cet en-tête inclut les fonctions OpenGL, et rien d'autre. Certains utilisateurs pensent à tort que SFML inclut automatiquement les en-têtes des extensions OpenGL parce qu'elle charge celles-ci en interne, mais ce n'est qu'un détail d'implémentation. Du point de vue de l'utilisateur, les extensions OpenGL doivent être gérées comme n'importe quelle autre bibliothèque.
</p>
<p>
    Vous aurez ensuite besoin de lier votre programme à OpenGL. Contrairement à ce qu'elle fait avec les en-têtes, SFML ne peut pas fournir de
    moyen unifié de lier OpenGL. Ainsi, vous devrez savoir quelle bibliothèque lier selon l'OS que vous utilisez ("opengl" sous Windows, "GL" sous
    Linux, etc.). Pareil pour GLU, au cas où vous l'utiliseriez également : "glu32" sous Windows, "GLU" sous Linux, etc.
</p>
<p class="important">
    Les fonctions OpenGL sont préfixées par "gl". Souvenez-vous en lorsque vous aurez de bêtes erreurs d'édition de liens, cela vous aidera à trouver quelle bibliothèque vous avez oublié de lier.
</p>

<?php h2('Créer une fenêtre OpenGL') ?>
<p>
    Comme SFML est construite par dessus OpenGL, ses fenêtres sont déjà prêtes pour vos appels OpenGL, sans effort supplémentaire.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "OpenGL");

// ça marche directement
glEnable(GL_TEXTURE_2D);
...
</code></pre>
<p>
    Si vous pensez que c'est <em>trop</em> automatique, rassurez-vous : le constructeur de <?php class_link("Window") ?> accepte un paramètre
    supplémentaire qui vous permet de changer les options du contexte OpenGL de la fenêtre. Ce paramètre est une instance de la structure
    <?php struct_link("ContextSettings") ?>, qui définit les champs suivants :
</p>
<ul>
    <li><code>depthBits</code> est le nombre de bits par pixel pour le <em>depth buffer</em> (0 pour ne pas en créer)</li>
    <li><code>stencilBits</code> est le nombre de bits par pixel pour le <em>stencil buffer</em> (0 pour ne pas en créer)</li>
    <li><code>antialiasingLevel</code> est le niveau d'anti-crénelage</li>
    <li><code>majorVersion</code> et <code>minorVersion</code> définissent la version d'OpenGL demandée</li>
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
    Si l'un (ou plusieurs) de ces paramètres n'est pas supporté par la carte graphique, SFML essaye de trouver la plus proche valeur qui soit valide.
    Par exemple, si un anti-crénelage x4 n'est pas supporté, SFML va essayer x2 puis en dernier recours se rabattre sur 0.<br />
    Dans ce cas de figure, vous pouvez savoir ce que SFML a choisi avec la fonction <code>getSettings</code> :
</p>
<pre><code class="cpp">sf::ContextSettings settings = window.getSettings();

std::cout &lt;&lt; "depth bits:" &lt;&lt; settings.depthBits &lt;&lt; std::endl;
std::cout &lt;&lt; "stencil bits:" &lt;&lt; settings.stencilBits &lt;&lt; std::endl;
std::cout &lt;&lt; "antialiasing level:" &lt;&lt; settings.antialiasingLevel &lt;&lt; std::endl;
std::cout &lt;&lt; "version:" &lt;&lt; settings.majorVersion &lt;&lt; "." &lt;&lt; settings.minorVersion &lt;&lt; std::endl;
</code></pre>
<p class="important">
    Les versions d'OpenGL supérieures à 3.0 sont supportées par SFML (pour autant que ce soit géré par votre pilote graphique). Depuis SFML 2.3, vous pouvez sélectionner le profil des contextes 3.2+ ainsi que le flag de debug. Le flag de compatibilité ascendante (forward compatibility) n'est par contre pas supporté. Par défaut, SFML crée les contextes 3.2+ avec le profil de compatibilité, car son module graphique utilise encore certaines fonctions obsolètes d'OpenGL. Si vous avez l'intention d'utiliser le module graphique, assurez-vous de ne pas créer votre contexte avec le profil core, sans quoi le module ne fonctionnera pas correctement.
</p>

<p class="important">
    Sur OS X, SFML supporte la création de contextes 3.2+ uniquement avec le profil core. Si vous voulez utiliser le module graphique sur OS X, vous serez donc limité aux contextes 2.1.
</p>

<?php h2('Un programme OpenGL typique, à la sauce SFML') ?>
<p>
    Voici à quoi pourrait ressembler un programme OpenGL complet avec SFML :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
#include &lt;SFML/OpenGL.hpp&gt;

int main()
{
    // crée la fenêtre
    sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, sf::ContextSettings(32));
    window.setVerticalSyncEnabled(true);

    // chargement des ressources, initialisation des états OpenGL, ...

    // la boucle principale
    bool running = true;
    while (running)
    {
        // gestion des évènements
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
                // on ajuste le viewport lorsque la fenêtre est redimensionnée
                glViewport(0, 0, event.size.width, event.size.height);
            }
        }

        // effacement les tampons de couleur/profondeur
        glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

        // dessin...

        // termine la trame courante (en interne, échange les deux tampons de rendu)
        window.display();
    }

    // libération des ressources...

    return 0;
}
</code></pre>
<p>
    Ici nous n'utilisons pas <code>window.isOpen()</code> comme condition pour la boucle principale, car nous avons besoin que la fenêtre reste ouverte
    jusqu'à la fin du programme, de façon à garder un contexte OpenGL valide pour la dernière itération de la boucle ainsi que le code de libération
    des ressources à la fin.
</p>
<p>
    N'hésitez pas à jeter un oeil aux exemples "OpenGL" et "Window" du SDK de SFML si vous avez des difficultés, ils sont plus complets et possèdent
    très probablement des réponses à vos questions.
</p>

<?php h2('Gérer plusieurs fenêtres OpenGL') ?>
<p>
    La gestion de plusieurs fenêtres OpenGL n'est pas plus compliquée que la gestion d'une seule, il y a juste certaines choses à savoir.
</p>
<p>
    Les appels OpenGL affectent le contexte actif (et donc la fenêtre active). Ainsi, si vous voulez dessiner sur deux fenêtres différentes au sein
    du même programme, il vous faudra choisir quelle fenêtre est active avant de dessiner quoique ce soit. Pour ce faire, vous devez utiliser la
    fonction <code>setActive</code> :
</p>
<pre><code class="cpp">// activation de la première fenêtre
window1.setActive(true);

// dessin sur la première fenêtre...

// activation de la seconde fenêtre
window2.setActive(true);

// dessin sur la seconde fenêtre...
</code></pre>
<p>
    Un seul contexte (fenêtre) peut être actif dans chaque thread, vous n'avez donc pas besoin de désactiver la fenêtre active avant d'en activer une
    autre, c'est fait implicitement. C'est comme ça que fonctionne OpenGL.
</p>
<p>
    Une autre chose à savoir est que tous les contextes OpenGL créés par SFML partagent leurs ressources. Cela signifie que vous pouvez créer une
    texture ou un vertex buffer avec n'importe quel contexte actif, et l'utiliser avec n'importe quel autre. Cela signifie aussi que vous n'aurez pas
    besoin de recharger toutes vos ressources OpenGL si vous recréez votre fenêtre.
</p>

<?php h2('OpenGL sans fenêtre') ?>
<p>
    Il est parfois nécessaire d'appeler des fonctions OpenGL alors qu'il n'y a aucune fenêtre, et donc aucun contexte OpenGL. Par exemple, lorsque
    vous chargez des textures depuis un thread, ou bien simplement avant que la première fenêtre ne soit créée. SFML vous permet de créer des contextes
    sans fenêtre avec la classe <?php class_link("Context") ?>. Tout ce que vous avez à faire est de l'instancier pour obtenir un contexte valide.
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
    Une configuration typique pour un programme multi-threadé est de gérer la fenêtre et ses évènements depuis un thread (le principal), et le rendu
    depuis un autre. Si vous êtes dans ce cas de figure, il y a une règle importante à garder en tête : vous ne pouvez pas activer un contexte (une
    fenêtre) s'il est actif dans un autre thread. En pratique, cela signifie que vous devez désactiver votre fenêtre avant de lancer le thread de rendu.
</p>
<pre><code class="cpp">void renderingThread(sf::Window* window)
{
    // activation du contexte de la fenêtre
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
    // création de la fenêtre (souvenez-vous: créer la fenêtre dans le thread principal est plus sûr, du fait des limitations de l'OS)
    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    // désactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de rendu
    sf::Thread thread(&amp;renderingThread, &amp;window);
    thread.Launch();

    // la boucle d'évènements/logique/etc.
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
</code></pre>

<?php h2('Utiliser SFML avec le module graphique de SFML') ?>
<p>
    Pour l'instant ce tutoriel a parlé de l'utilisation d'OpenGL avec sfml-window, ce qui est relativement simple étant donné que c'est le seul but
    de ce module. Mixer OpenGL avec le module graphique est un tout petit peu plus compliqué : sfml-graphics utilise aussi OpenGL, il faut donc
    prendre certaines précautions de sorte que les états OpenGL de l'utilisateur et ceux de SFML n'entrent pas en conflit.
</p>
<p>
    Si vous ne connaissez pas encore le module graphique, tout ce que vous avez à savoir c'est que la classe <?php class_link("Window") ?> est
    remplacée par <?php class_link("RenderWindow") ?>, qui hérite de toutes ses fonctions et en ajoute quelques autres qui servent à dessiner des
    entités SFML.
</p>
<p>
    Le seul moyen d'éviter les conflits entre SFML et vos propres états OpenGL, est de les sauvegarder/restaurer à chaque fois que vous passez d'OpenGL
    à SFML.
</p>
<pre><code class="cpp">- dessin avec OpenGL

- sauvegarde des états OpenGL

- dessin avec SFML

- restauration des états OpenGL

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
    Comme elle ne connaît rien de votre code OpenGL, SFML ne peut pas optimiser ces étapes et en conséquence elle sauvegarde/restaure absolument tous
    les états et matrices OpenGL. C'est négligeable pour des petits projets, mais cela peut se révéler trop lent sur des programmes conséquents qui
    requierent des performances maximales. Dans ce cas, vous pouvez gérer vous-même la sauvegarde et la restauration des états OpenGL, avec
    <code>glPushAttrib</code>/<code>glPopAttrib</code>, <code>glPushMatrix</code>/<code>glPopMatrix</code>, etc.<br />
    Vous devrez cependant toujours restaurer les états de SFML avant dessiner avec elle, avec la fonction <code>resetGLStates</code>.
</p>
<pre><code class="cpp">glDraw...

glPush...
window.resetGLStates();

window.draw(...);

glPop...

glDraw...
</code></pre>
<p>
    En gérant vous-même la sauvegarde des états OpenGL, vous pouvez vous occuper uniquement de ceux qui vous intéressent, et épargner quelques appels
    inutiles.
</p>

<?php

    require("footer-fr.php");

?>
