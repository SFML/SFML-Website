<?php

    $title = "Ouvrir et gérer une fenêtre SFML";
    $page = "window-window-fr.php";

    require("header-fr.php");

?>

<h1>Ouvrir et gérer une fenêtre SFML</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel explique uniquement comment ouvrir et gérer une fenêtre avec SFML. Dessiner des choses sort déjà du cadre du module sfml-window : c'est
    en effet géré par le module sfml-graphics. Cependant, la gestion de la fenêtre reste exactement la même, la lecture de ce tutoriel est donc
    indispensable dans tous les cas.
</p>

<?php h2('Ouvrir une fenêtre') ?>
<p>
    Les fenêtre SFML sont définies par la classe <?php class_link("Window") ?>. Une fenêtre peut être créée et ouverte directement dès sa construction :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>
<p>
    Le premier paramètre, le <em>mode vidéo</em>, définit la taille de la fenêtre (la taille interne, sans la barre de titre ni les bordures). Ici,
    nous créons une fenêtre de 800x600 pixels.<br />
    La classe <?php class_link("VideoMode") ?> a quelques fonctions statiques intéressantes pour récupérer la résolution du bureau, ou encore la liste
    des modes vidéo valides pour le mode plein écran. N'hésitez pas à consulter la documentation pour voir tout ce que vous pouvez en tirer.
</p>
<p>
    Le deuxième paramètre est simplement le titre de la fenêtre.
</p>
<p>
    Ce constructeur accepte un troisième paramètre optionnel : un style, qui permet de choisir quelles décorations et fonctionnalités vous voulez
    sur la fenêtre. Vous pouvez utiliser des combinaisons des styles suivants :
</p>
<table class="styled">
    <tbody>
        <tr>
            <td><code>sf::Style::None</code></td>
            <td>Aucune décoration (utile pour les <em>splash screens</em>, par exemple) ; ce style ne peut pas être combiné avec les autres</td>
        </tr>
        <tr>
            <td><code>sf::Style::Titlebar</code></td>
            <td>La fenêtre possède une barre de titre</td>
        </tr>
        <tr>
            <td><code>sf::Style::Resize</code></td>
            <td>La fenêtre peut être redimensionnée et possède un bouton de maximisation</td>
        </tr>
        <tr>
            <td><code>sf::Style::Close</code></td>
            <td>La fenêtre possède une bouton de fermeture</td>
        </tr>
        <tr>
            <td><code>sf::Style::Fullscreen</code></td>
            <td>La fenêtre est créée en mode plein écran; ce style ne peut pas être combiné avec les autres, et requiert un mode vidéo valide</td>
        </tr>
        <tr>
            <td><code>sf::Style::Default</code></td>
            <td>Le style par défaut, qui est un raccourci pour <code>Titlebar | Resize | Close</code></td>
        </tr>
    </tbody>
</table>
<p>
    Il existe également un quatrième paramètre optionnel, qui définit des options spécifiques à OpenGL ; cet aspect est détaillé dans le
    <a class="internal" href="./window-opengl-fr.php" title="Tutoriel OpenGL">tutoriel dédié</a>.
</p>
<p>
    Si vous voulez créer la fenêtre <em>après</em> la construction de l'instance de <?php class_link("Window") ?>, ou bien la re-créer avec des
    paramètres différents, vous pouvez plutôt utiliser la fonction <code>create</code> ; elle prend exactement les mêmes paramètres que le constructeur.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window;
    window.create(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>

<?php h2('Rendre la fenêtre un peu plus vivante') ?>
<p>
    Si vous essayez d'exécuter le code ci-dessus avec rien à la place des "...", vous ne verrez pas grand chose se passer. Tout d'abord parce que le
    programme se termine instantanément. Ensuite, parce qu'il n'y a aucune gestion d'évènement -- donc même si vous ajoutiez une boucle infinie dans
    ce code, vous verriez une fenêtre "gelée", incapable d'être déplacée, redimensionnée, ou bien encore fermée.
</p>
<p>
    Ajoutons donc un peu de code pour rendre ce programme plus intéressant :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme jusqu'à ce que la fenêtre soit fermée
    while (window.isOpen())
    {
        // on inspecte tous les évènements de la fenêtre qui ont été émis depuis la précédente itération
        sf::Event event;
        while (window.pollEvent(event))
        {
            // évènement "fermeture demandée" : on ferme la fenêtre
            if (event.type == sf::Event::Closed)
                window.close();
        }
    }

    return 0;
}
</code></pre>
<p>
    Le code ci-dessus ouvre une fenêtre, et se termine lorsque l'utilisateur la ferme. Voyons comment il fonctionne en détail.
</p>
<p>
    Premièrement, nous avons ajouté une boucle qui nous assure que l'application va être rafraîchie/mise à jour jusqu'à ce que la fenêtre soit fermée.
    La plupart (sinon tous) les programmes SFML auront ce genre de boucle, souvent appelée <em>boucle principale</em> ou <em>boucle de jeu</em>.
</p>
<p>
    Ensuite, la première chose que nous faisons dans la boucle principale est de regarder si des évènements se sont produits. Notez bien que nous
    utilisons une boucle <code>while</code> de manière à inspecter tous les évènements, au cas où il y en aurait plusieurs en attente d'être traités.
    La fonction <code>pollEvent</code> renvoie <code>true</code> si un évènement était en attente, ou <code>false</code> s'il n'y en avait aucun.
</p>
<p>
    A chaque fois que nous avons un évènement, nous devons vérifier son type (fenêtre fermée ? une touche appuyée ? le curseur a bougé ? un joystick est
    connecté ? ...), et réagir en conséquence si ce type d'évènement nous intéresse. Dans cet exemple, nous ne nous intéressons qu'à l'évènement
    <code>Event::Closed</code>, qui est émis lorsque l'utilisateur souhaite fermer la fenêtre. A ce moment, la fenêtre est toujours ouverte et nous
    devons la fermer explicitement avec la fonction <code>close</code>. Cela permet de faire autre chose avant que la fenêtre ne soit réellement fermée,
    comme par exemple sauvegarder l'état de l'application, ou afficher un message.
</p>
<p class="important">
    Une erreur que les gens font souvent est d'oublier de mettre une boucle d'évènements, car ils n'en ont pas besoin (ils utilisent les entrées
    temps réel à la place, typiquement). Mais sans gestion d'évènement la fenêtre ne sera pas réactive ; en effet, la boucle d'évènement a deux rôles :
    en plus de fournir les évènements à l'utilisateur, elle permet à la fenêtre de traiter ses évènements internes, ce qui est impératif a son
    bon fonctionnement.
</p>
<p>
    Après que la fenêtre a été fermée, la boucle principale s'arrête et le programme se termine.
</p>
<p>
    Vous avez probablement remarqué que nous n'avons pas encore parlé de <em>dessiner quelque chose</em> dans cette fenêtre. Comme indiqué dans
    l'introduction, ce n'est pas le boulot du module sfml-window, et vous devrez aller voir directement les tutoriels du module sfml-graphics
    si vous voulez dessiner des choses intéressantes telles que des sprites, du texte ou des formes.
</p>
<p>
    Pour dessiner, vous pouvez aussi utiliser OpenGL directement et complètement ignorer le module sfml-graphics. <?php class_link("Window") ?>
    crée en interne un contexte OpenGL, de sorte qu'elle est naturellement prête à recevoir vos propres appels OpenGL. Vous pourrez en savoir plus
    à ce sujet dans le <a class="internal" href="./window-opengl-fr.php" title="Tutoriel OpenGL">tutoriel correspondant</a>.
</p>
<p>
    Bref, ne vous attendez pas à voir quelque chose d'intéressant dans cette fenêtre : vous verrez très certainement une couleur uniforme (noir ou blanc),
    ou bien le dernier contenu du programme OpenGL exécuté précédemment, ou... n'importe quoi d'autre.
</p>

<?php h2('Jouer avec la fenêtre') ?>
<p>
    Evidemment, SFML vous permet de jouer un peu avec vos fenêtres. Les opérations basiques de fenêtrage, telles que changer la taille, la position,
    le titre ou l'icône sont supportées, mais contrairement à d'autres bibliothèques plus spécialisées dans les interfaces graphiques (Qt, wxWidgets),
    SFML ne fournit pas de fonctionnalités avancées. Les fenêtres SFML ne sont qu'un support pour du dessin OpenGL ou SFML. L'accent est mis sur les
    fonctionnalités importantes ainsi que la simplicité d'utilisation.
</p>
<pre><code class="cpp">// changement de la position de la fenêtre (relativement au bureau)
window.setPosition(sf::Vector2i(10, 50));

// changement de la taille de la fenêtre
window.setSize(sf::Vector2u(640, 480));

// changement du titre de la fenêtre
window.setTitle("SFML window");

// récupération de la taille de la fenêtre
sf::Vector2u size = window.getSize();
unsigned int width = size.x;
unsigned int height = size.y;

// détecte si la fenêtre est au premier plan
bool focus = window.hasFocus();

...
</code></pre>
<p>
    Vous pouvez consulter la documentation de l'API pour une liste complète des fonctions de <?php class_link("Window") ?>.
</p>
<p>
    Si vous avez réellement besoin de fonctionnalités plus avancées pour votre fenêtre, vous pouvez la créer (ou même une GUI complète) avec une autre
    bibliothèque, et intégrer SFML dedans. Pour ce faire, vous pouvez utiliser l'autre constructeur, ou fonction <code>create</code>, de
    <?php class_link("Window") ?> qui prend en paramètre le handle natif (spécifique à l'OS) d'une fenêtre existante. Dans ce cas, SFML crée un
    contexte OpenGL dans la fenêtre et récupère tous ses évènements, sans perturber sa gestion initiale.
</p>
<pre><code class="cpp">sf::WindowHandle handle = /* specifique à ce que vous faites et à la bibliothèque que vous utilisez */;
sf::Window window(handle);
</code></pre>
<p>
    Si vous voulez juste une fonctionnalité supplémentaire bien spécifique, vous pouvez aussi faire l'inverse : créer une fenêtre SFML normale, et
    récupérer son handle natif afin d'implémenter les fonctions que SFML ne supporte pas.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "SFML window");
sf::WindowHandle handle = window.getSystemHandle();

// vous pouvez maintenant utiliser 'handle' avec les fonctions spécifiques à l'OS
</code></pre>
<p>
    L'intégration de SFML avec d'autres bibliothèques de GUI requiert un peu de travail et ne sera donc pas détaillée ici, mais vous pouvez vous
    référer aux tutoriels correspondant, aux exemples ou aux messages sur le forum.
</p>

<?php h2('Contrôler le framerate') ?>
<p>
    Parfois, lorsque votre application tourne (trop) vite, cela peut produire des artefacts visuels tels que des déchirements (<em>tearing</em>).
    La raison est que la fréquence de rafraîchissement de votre application n'est pas synchronisée sur la fréquence verticale de l'écran, et en
    conséquence, le bas de la trame précédente apparaît avec le haut de la nouvelle trame.<br />
    La solution à ce problème est d'activer la <em>synchronisation verticale</em>. Elle est gérée automatiquement par la carte graphique, et peut
    être activée ou désactivée facilement avec la fonction <code>setVerticalSyncEnabled</code> :
</p>
<pre><code class="cpp">window.setVerticalSyncEnabled(true); // un appel suffit, après la création de la fenêtre
</code></pre>
<p>
    Après cet appel, votre application sera rafraîchie à la même fréquence que l'écran (donc grosso modo 60 fois par seconde).
</p>
<p class="important">
    Parfois <code>setVerticalSyncEnabled</code> n'a aucun effet : la plupart du temps c'est dû aux options du pilote graphique qui forcent la
    synchronisation verticale à "<em>off</em>". Si cela vous arrive, modifiez cette option à "<em>contrôlé par l'application</em>".
</p>
<p>
    Dans d'autres situations, vous voudrez peut-être que votre application tourne à un framerate fixé plutôt qu'à la fréquence de rafraîchissement
    de l'écran. Cela peut être fait avec la fonction <code>setFramerateLimit</code> :
</p>
<pre><code class="cpp">window.setFramerateLimit(30); // un appel suffit, après la création de la fenêtre
</code></pre>
<p>
    Contrairement à <code>setVerticalSyncEnabled</code>, cette fonctionnalité est implémentée par SFML, avec une combinaison de <?php class_link("Clock") ?>
    et de <code>sf::sleep</code>. Une conséquence importante de cela est qu'elle n'est pas fiable à 100%, en particulier pour des valeurs élevées :
    la résolution de <code>sf::sleep</code> dépend de l'OS, et peut être aussi faible que 10 ou 15 millisecondes. Ne comptez donc pas sur cette fonction
    pour implémenter des timings ultra-précis.
</p>
<p class="important">
    N'utilisez jamais <code>setVerticalSyncEnabled</code> et <code>setFramerateLimit</code> en même temps ! Elles intéragiraient mal et rendraient les
    choses encore pire.
</p>

<?php h2('Choses à savoir à propos des fenêtres') ?>
<p>
    Voici une rapide liste de choses que pouvez faire ou ne pas faire avec les fenêtres SFML.
</p>

<h3>Vous pouvez créer plusieurs fenêtres</h3>
<p>
    SFML permet de créer plusieurs fenêtres, et de les gérer soit toutes dans le thread principal, soit chacune dans son propre thread (mais...
    attention aux autres limitations ci-dessous). Dans ce cas, n'oubliez pas d'adjoindre à chaque fenêtre sa boucle d'évènements.
</p>

<h3>Les écrans multiples ne sont pas encore bien supportés</h3>
<p>
    SFML ne gère pas explicitement les moniteurs multiples. En conséquence, vous ne pourrez pas choisir sur quel écran une fenêtre va apparaître, et
    vous ne pourrez pas non plus créer plus d'une fenêtre plein écran à la fois. Ceci devrait être amélioré dans une version future.
</p>

<h3>Les évènements doivent être traités dans le thread de la fenêtre</h3>
<p>
    C'est une limitation importante de la plupart des OS : la boucle d'évènements (plus précisément, la fonction <code>pollEvent</code> ou
    <code>waitEvent</code>) doit être appelée dans le thread qui a créé la fenêtre. Cela implique que si vous voulez créer un thread dédié à la
    gestion d'évènements, vous devrez vous assurer que la fenêtre est créée dans ce même thread. Si vous voulez vraiment séparer les choses en
    plusieurs threads, il est plutôt recommendé de garder le fenêtrage et les évènements dans le thread principal, et de bouger le reste (rendu,
    physique, logique, ...) dans des threads. Cette configuration a aussi l'avantage d'être compatible avec la limitation qui suit.
</p>

<h3>Sous OS X, les fenêtres et les évènements doivent être gérés dans le thread principal</h3>
<p>
    Ouaip, c'est exact. Max OS X ne sera pas d'accord si vous essayez de créer une fenêtre ou de gérer ses évènements dans un thread autre que le thread
    principal.
</p>

<h3>Sous Windows, une fenêtre plus grande que le bureau ne réagira pas correctement</h3>
<p>
    Pour une raison inconnue, Windows n'aime pas les fenêtres qui sont plus grandes que le bureau. Cela inclue les fenêtres créées avec
    <code>VideoMode::getDesktopMode()</code> : avec les décorations (bordures et barre de titre) en plus, vous finissez avec une fenêtre qui est très
    légèrement plus grande que le bureau.
</p>

<?php

    require("footer-fr.php");

?>
