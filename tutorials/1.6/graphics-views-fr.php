<?php

    $title = "Utiliser les vues";
    $page = "graphics-views-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les vues</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, vous allez apprendre à utiliser les vues 2D de SFML. Les vues sont comme des caméras 2D, qui
    permettent de se déplacer, zoomer ou faire défiler sans avoir à bouger ou redimensionner tous les objets de la scène.
</p>

<?php h2('Définir une nouvelle vue') ?>
<p>
    Les vues sont définies par la classe <?php class_link("View")?>, qui n'est basiquement qu'un rectangle 2D enrobé
    dans une interface style caméra.
</p>
<p>
    Une vue peut être créée soit à partir d'un centre et d'une demi-taille, soit directement à partir d'un rectangle
    englobant :
</p>
<pre><code class="cpp">sf::Vector2f Center(1000, 1000);
sf::Vector2f HalfSize(400, 300);
sf::View View1(Center, HalfSize);

// Ou

sf::View View2(sf::FloatRect(600, 700, 1400, 1300));
</code></pre>
<p>
    Tous ces paramètres peuvent être lus et modifiés à n'importe quel moment en utilisant les accesseurs prévus
    à cet effet :
</p>
<pre><code class="cpp">View.SetCenter(500, 300);
View.SetHalfSize(200, 100);

// Ou

View.SetFromRect(sf::FloatRect(300, 200, 700, 400));
</code></pre>
<pre><code class="cpp">sf::Vector2f  Center    = View.GetCenter();
sf::Vector2f  HalfSize  = View.GetHalfSize();
sf::FloatRect Rectangle = View.GetRect();
</code></pre>
<p>
    En plus de ça, il existe deux fonctions pratiques pour faire défiler (déplacer) ou zoomer (redimensionner) la vue :
</p>
<pre><code class="cpp">View.Move(10, -5); // Déplace la vue de (10, -5) unités
View.Zoom(0.5f);   // Zoome d'un facteur 1/2 (ie. dézoome pour rendre la vue 2x plus large)
</code></pre>
<p>
    Comme vous pouvez le voir il n'y a rien de compliqué ici, seulement quelques fonctions pour contrôler la position
    et la taille de la vue.
</p>

<?php h2('Utiliser une vue') ?>
<p>
    Afin d'utiliser une vue, vous devez appeler la fonction <code>SetView</code> de la classe
    <?php class_link("RenderWindow")?> :
</p>
<pre><code class="cpp">// Utilise notre vue perso
App.SetView(View);
</code></pre>
<p>
    Tout objet dessiné après l'appel à <code>SetView</code> (et avant le prochain) sera affecté par la vue.<br/>
    Une fois mise en place, la fenêtre garde un lien vers la vue courante ; ainsi vous pouvez mettre à jour celle-ci
    sans avoir à rappeler <code>SetView</code>, vos changements seront appliqués automatiquement.
</p>
<p>
    Chaque fenêtre de rendu possède une vue par défaut, toujours dimensionnée à la taille initiale de sa fenêtre.
    Vous pouvez accéder à cette vue, voire même la modifier, via la fonction <code>GetDefaultView</code> :
</p>
<pre><code class="cpp">sf::View& DefaultView = App.GetDefaultView();
</code></pre>
<p>
    La vue par défaut n'est pas mise à jour lorsque sa fenêtre est redimensionnée : en conséquence, ce qui est visible
    dans votre fenêtre ne sera jamais affecté par la taille de celle-ci (ie. vous ne verrez pas plus en agrandissant
    la fenêtre), ce qui est exactement ce qui se passe avec une caméra 3D classique.<br/>
    Ceci-dit, vous pouvez tout de même facilement mettre en place une vue qui garderait toujours les mêmes dimensions
    que sa fenêtre, en surveillant l'évènement <code>sf::Event::Resized</code> et en ajustant la vue en conséquence.
</p>
<p>
    Accéder à la vue par défaut peut également être utile pour revenir à la vue initiale. Par exemple, cela peut être
    pratique si vous souhaitez dessiner une interface utilisateur par dessus le jeu, cette première ne suivant
    habituellement pas la caméra.
</p>
<pre><code class="cpp">App.SetView(View);

// Afficher le jeu...

App.SetView(App.GetDefaultView());

// Afficher l'interface...
</code></pre>

<?php h2('Coordonnées fenêtre, coordonnées vue') ?>
<p>
    Lorsqu'une vue personnalisée est utilisée, ou lorsque votre fenêtre a été redimensionnée, n'oubliez pas que les
    coordonnées des objets ne correspondent plus avec les pixels de la fenêtre ; prenez donc garde à gérer correctement
    les différentes conversions nécessaires (par exemple, lorsque vous testez la position de la souris par rapport
    aux rectangles des sprites). Rappelez vous toujours que ce que vous voyez est le rectangle de la vue, pas celui de
    la fenêtre.
</p>
<p>
    Si vous souhaitez convertir des coordonnées fenêtre en coordonnées vue, probablement après un clic souris, vous
    pouvez utiliser la fonction <code>RenderWindow::ConvertCoords</code> :
</p>
<pre><code class="cpp">// Convertit la position du curseur en coordonnées vue
sf::Vector2f MousePos = App.ConvertCoords(App.GetInput().GetMouseX(), App.GetInput().GetMouseY());
</code></pre>
<p>
    Par défaut, cette fonction utilise la vue courante de la fenêtre pour effectuer la conversion. Cependant, vous
    pouvez utiliser n'importe quelle autre vue en passant son adresse en troisième paramètre (qui vaut donc
    <code>NULL</code> par défaut).
</p>

<?php h2('Conclusion') ?>
<p>
    Les vues 2D fournissent un moyen facile et pratique de gérer des effets tels que le défilement ou le zoom, avec
    aucun impact sur les performances. La seule chose à garder en tête lorsque vous utilisez les vues, est la possibilité
    d'avoir à effectuer des conversions si vous devez faire correspondre des pixels fenêtre à des coordonnées de votre
    scène.
</p>

<?php

    require("footer-fr.php");

?>
