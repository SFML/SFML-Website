<?php

    $title = "Dessiner avec SFML";
    $page = "graphics-draw-fr.php";

    require("header-fr.php");

?>

<h1>Dessiner avec SFML</h1>

<?php h2('Introduction') ?>
<p>
    Comme vous l'avez vu dans les tutoriels précédents, le module de fenêtrage de SFML fournit tout ce qu'il faut pour créer une fenêtre OpenGL et gérer ses
    évènements, mais n'est d'aucune aide pour dessiner quoique ce soit. La seule option qu'il vous offre est d'utiliser OpenGL, qui est certes très puissante mais tout
    aussi complexe.
</p>
<p>
    Heureusement, SFML fournit un module graphique avec plein d'entités 2D, beaucoup plus simples à manipuler qu'OpenGL.
</p>

<?php h2('La fenêtre de dessin') ?>
<p>
    Afin de dessiner les entités fournies par le module graphique, vous devez utiliser une classe de fenêtre spécialisée : <?php class_link("RenderWindow") ?>. Celle-ci
    dérive de <?php class_link("Window") ?> et hérite de toutes ses fonctions. Tout ce que vous avez appris à propos de <?php class_link("Window") ?> (création,
    gestion des évènements, contrôle du rafraîchissement, mélange avec OpenGL, etc.) est toujours valable avec <?php class_link("RenderWindow") ?>.
</p>
<p>
    Par dessus cela, <?php class_link("RenderWindow") ?> ajoute des fonctions de plus haut-niveau pour vous aider à dessiner plus facilement. Ce tutoriel se concentre
    sur deux de ces fonctions : <code>clear</code> et <code>draw</code>. Elles sont aussi simples que leur nom le suggère : <code>clear</code> efface la fenêtre toute entière
    avec la couleur choisie, et <code>draw</code> y dessine l'objet que vous lui passez en paramètre.
</p>
<p>
    Voici une boucle principale typique avec une fenêtre de dessin :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;

int main()
{
    // création de la fenêtre
    sf::RenderWindow window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme tant que la fenêtre n'a pas été fermée
    while (window.isOpen())
    {
        // on traite tous les évènements de la fenêtre qui ont été générés depuis la dernière itération de la boucle
        sf::Event event;
        while (window.pollEvent(event))
        {
            // fermeture de la fenêtre lorsque l'utilisateur le souhaite
            if (event.type == sf::Event::Closed)
                window.close();
        }

        // effacement de la fenêtre en noir
        window.clear(sf::Color::Black);

        // c'est ici qu'on dessine tout
        // window.draw(...);

        // fin de la frame courante, affichage de tout ce qu'on a dessiné
        window.display();
    }

    return 0;
}
</code></pre>
<p>
    Appeler <code>clear</code> avant de dessiner quoique ce soit est obligatoire, sinon vous pourriez vous retrouver avec des pixels aléatoires ou bien de la frame précédente.
    La seule exception est le cas où vous couvrez la totalité de la fenêtre avec ce que vous dessinez, de sorte que tous les pixels soient écrasés ; dans ce cas vous pouvez
    ne pas appeler <code>clear</code> (bien que cela ne fasse pas de grande différence au niveau des performances).
</p>
<p>
    Appeler <code>display</code> est tout aussi obligatoire, cela a pour effet d'afficher dans la fenêtre tout ce qui a été dessiné depuis l'appel précédent à
    <code>display</code>. En effet, les entités ne sont pas dessinées directement dans la fenêtre, mais plutôt dans une surface cachée. Cette surface est ensuite copiée
    vers la fenêtre lors de l'appel à <code>display</code> -- c'est ce qu'on appelle le <em>double buffering</em>.
</p>
<p class="important">
    Ce cycle clear/draw/display est la seule bonne manière de dessiner. N'essayez pas d'autres stratégies, telles que garder certains pixels de la frame précédente,
    "effacer" des pixels, ou bien encore dessiner une seule fois et appeler <code>display</code> plusieurs fois. Vous obtiendrez des résultats bizarres à cause du
    <em>double buffering</em>.<br/>
    Les puces et les APIs graphiques modernes sont <em>vraiment</em> faites pour des cycles clear/draw/display répétés, où tout est complètement
    rafraîchi à chaque itération de la boucle de dessin. Ne soyez pas effrayés de dessiner 1000 sprites 60 fois par seconde, vous êtes encore loin des millions de triangles
    que votre machine peut gérer.
</p>

<?php h2('Qu\'est-ce que je peux dessiner maintenant ?') ?>
<p>
    Maintenant que vous avez une boucle principale qui est prête à dessiner, voyons ce que vous pouvez y dessiner, et de quelle manière.
</p>
<p>
    SFML fournit quatre types d'entités dessinables : trois d'entre elles sont prêtes à l'emploi (<em>sprites</em>, <em>textes</em> et <em>formes</em>), la dernière
    est la brique de base qui vous aidera à créer vos propres entités dessinables (les <em>tableaux de vertex</em>).
</p>
<p>
    Bien que ces entités partagent pas mal d'attributs communs, elles ont chacune leurs spécificités et méritent leur propre tutoriel :
</p>
<ul>
    <li><a href="./graphics-sprite-fr.php" title="Apprenez à créer et dessiner des sprites">Tutoriel sur les sprites</a></li>
    <li><a href="./graphics-text-fr.php" title="Apprenez à créer et dessiner du texte">Tutoriel sur le texte</a></li>
    <li><a href="./graphics-shape-fr.php" title="Apprenez à créer et dessiner des formes">Tutoriel sur les formes</a></li>
    <li><a href="./graphics-vertex-array-fr.php" title="Apprenez à créer et dessiner des tableaux de vertex">Tutoriel sur les tableaux de vertex</a></li>
</ul>

<?php h2('Dessin hors-écran') ?>
<p>
    SFML fournit aussi un moyen de dessiner sur une texture plutôt que directement sur la fenêtre. Pour ce faire, il faut utiliser la classe <?php class_link("RenderTexture") ?>
    au lieu de <?php class_link("RenderWindow") ?>. Elle possède les mêmes fonctions de dessin, héritées de leur base commune <?php class_link("RenderTarget") ?>.
</p>
<pre><code class="cpp">// on crée une texture de dessin de 500x500
sf::RenderTexture renderTexture;
if (!renderTexture.create(500, 500))
{
    // erreur...
}

// pour dessiner, on utilise les mêmes fonctions
renderTexture.clear();
renderTexture.draw(sprite); // ou n'importe quel autre objet dessinable
renderTexture.display();

// on récupère la texture (sur laquelle on vient de dessiner)
const sf::Texture&amp; texture = renderTexture.getTexture();

// on la dessine dans la fenêtre
sf::Sprite sprite(texture);
window.draw(sprite);
</code></pre>
<p>
    La fonction <code>getTexture</code> renvoie une texture en lecture seule, ce qui signifie que vous ne pouvez que l'utiliser, pas la modifier. Si vous avez besoin
    de la manipuler avant de l'utiliser, vous pouvez la copier dans votre propre instance de <?php class_link("Texture") ?>.
</p>
<p>
    <?php class_link("RenderTexture") ?> déclare les mêmes fonctions que <?php class_link("RenderWindow") ?> pour gérer les vues et OpenGL (voir les tutoriels correspondant
    pour plus de détails). Si vous utilisez OpenGL pour dessiner sur une texture, vous pouvez activer un tampon de profondeur (<em>depth buffer</em>) en utilisant le troisième
    paramètre optionnel de la fonction <code>create</code>.
</p>
<pre><code class="cpp">renderTexture.create(500, 500, true); // activation du tampon de profondeur
</code></pre>

<?php h2('Dessiner depuis un thread') ?>
<p>
    SFML supporte le rendu multi-threadé, et vous n'avez même pas besoin de faire quoique ce soit pour que cela fonctionne. La seule chose à se rappeler est de désactiver
    une fenêtre avant de l'utiliser dans un autre thread ; une fenêtre (plus précisément son contexte OpenGL) ne peut en effet pas être active dans plusieurs threads en
    même temps.
</p>
<pre><code class="cpp">void renderingThread(sf::RenderWindow* window)
{
    // activation du contexte de la fenêtre
    window->setActive(true);
    
    // la boucle de rendu
    while (window->isOpen())
    {
        // dessin...

        // fin de la frame
        window->display();
    }
}

int main()
{
    // création de la fenêtre
    // (rappelez-vous : il est plus prudent de le faire dans le thread principal à cause des limitations de l'OS)
    sf::RenderWindow window(sf::VideoMode(800, 600), "OpenGL");

    // désactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de dessin
    sf::Thread thread(&amp;renderingThread, &amp;window);
    thread.launch();

    // la boucle d'évènements/logique/ce que vous voulez...
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
</code></pre>
<p>
    Comme vous pouvez le voir, vous n'avez même pas besoin d'activer la fenêtre dans le thread de dessin, SFML le fait automatiquement pour vous dès que nécessaire.
</p>
<p>
    Souvenez-vous : il faut toujours créer la fenêtre et gérer ses évènements dans le thread principal, pour un maximum de portabilité, comme expliqué dans le
    <a href="./window-window.php" title="Tutoriel sur les fenêtres">tutoriel sur les fenêtres</a>.
</p>

<?php

    require("footer-fr.php");

?>
