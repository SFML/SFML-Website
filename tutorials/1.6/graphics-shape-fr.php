<?php

    $title = "Dessiner des formes simples";
    $page = "graphics-shape-fr.php";

    require("header-fr.php");
?>

<h1>Dessiner des formes simples</h1>

<?php h2('Introduction') ?>
<p>
    Ce nouveau tutoriel va vous apprendre à dessiner des formes 2D simples telles que des lignes, des rectangles,
    des cercles ou encore des polygones avec SFML.
</p>

<?php h2('Construire des formes quelconque') ?>
<p>
    Pour construire une forme persos avec SFML, vous devez utiliser la classe
    <?php class_link("Shape")?>.<br/>
    Une forme est basiquement un polygone convexe, dans lequel chaque point a sa propre position et couleur.
    Il est également possible d'ajouter une bordure automatique à une forme, chaque point pouvant avoir sa propre couleur
    de bordure.</br>
    Il est très important de définir les points d'une forme dans l'ordre (sens des aiguilles d'une montre ou inverse, peu importe),
    sans quoi la forme pourrait être mal-formée. Il est également important de garder la forme convexe, sinon elle
    pourrait ne pas être rendue correctement. Si vous devez afficher des formes concaves, essayez de les découper
    en plusieurs sous-formes convexes.
</p>
<p>
    Pour ajouter un point à une forme, utilisez la fonction <code>AddPoint</code> :
</p>
<pre><code class="cpp">sf::Shape Polygon;
Polygon.AddPoint(0, -50,  sf::Color(255, 0, 0),     sf::Color(0, 128, 128));
Polygon.AddPoint(50, 0,   sf::Color(255, 85, 85),   sf::Color(0, 128, 128));
Polygon.AddPoint(50, 50,  sf::Color(255, 170, 170), sf::Color(0, 128, 128));
Polygon.AddPoint(0, 100,  sf::Color(255, 255, 255), sf::Color(0, 128, 128));
Polygon.AddPoint(-50, 50, sf::Color(255, 170, 170), sf::Color(0, 128, 128));
Polygon.AddPoint(-50, 0,  sf::Color(255, 85, 85),   sf::Color(0, 128, 128));
</code></pre>
<p>
    Les paramètres sont les coordonnées X et Y du point, sa couleur et une couleur optionnelle pour la bordure.
    Notez que vous pouvez également passer un <?php class_link("Vector2f")?> plutôt que deux floats pour la position du point.
</p>
<p>
    Une fois ajoutés à la forme, les attributs des points (position, couleur et bordure) peuvent être récupérées
    ou changées individuellement à l'aide des accesseurs suivants :
</p>
<pre><code class="cpp">// Récupère les attributs du troisième point
sf::Vector2f Position     = Polygon.GetPointPosition(2);
sf::Color    Color        = Polygon.GetPointColor(2);
sf::Color    OutlineColor = Polygon.GetPointOutlineColor(2);

// Change les attributs du deuxième point
Polygon.SetPointPosition(1, sf::Vector2f(50, 100));
Polygon.SetPointColor(1, sf::Color::Black);
Polygon.SetPointOutlineColor(1, sf::Color(0, 128, 128));
</code></pre>
<p>
    Afin de contrôler l'épaisseur de la bordure de l'ensemble de la forme, vous pouvez utiliser la fonction <code>SetOutlineWidth</code> :
</p>
<pre><code class="cpp">// Définit une bordure d'épaisseur 10
Polygon.SetOutlineWidth(10);
</code></pre>
<p>
    Ok parfait, nous avons désormais une forme avec une bordure. Mais que faire si nous voulons juste afficher la bordure
    sans remplir la forme ? Ou supprimer cette bordure ? Il existe deux fonctions pour activer ou désactiver
    le remplissage et la bordure :
</p>
<pre><code class="cpp">// Désactive le remplissage de la forme
Polygon.EnableFill(false);

// Active l'affichage de sa bordure
Polygon.EnableOutline(true);
</code></pre>
<p>
    Comme tout objet affichable dans SFML, les formes héritent de toutes les fonctions habituelles pour définir leur
    position, rotation, facteur d'échelle, couleur et mode de blending.
</p>
<pre><code class="cpp">Polygon.SetColor(sf::Color(255, 255, 255, 200));
Polygon.Move(300, 300);
Polygon.Scale(3, 2);
Polygon.Rotate(45);
</code></pre>
<p>
    Enfin, afficher une forme se fait également de la même manière que tous les objets SFML :
</p>
<pre><code class="cpp">App.Draw(Polygon);
</code></pre>

<?php h2('Formes prédéfinies') ?>
<p>
    SFML fournit des fonctions statiques pour construire facilement des formes simples telles que des lignes,
    des rectangles et des cercles :
</p>
<pre><code class="cpp">sf::Shape Line   = sf::Shape::Line(X1, Y1, X2, Y2, Epaisseur, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Circle = sf::Shape::Circle(X, Y, Rayon, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Rect   = sf::Shape::Rectangle(X1, Y1, X2, Y2, Couleur, [Bordure], [CouleurBordure]);
</code></pre>
<p>
    Les valeurs pour l'épaisseur et la couleur de bordure sont optionnelles ; la bordure est désactivée par défaut.
</p>

<?php h2('Conclusion') ?>
<p>
    Avec cette nouvelle classe vous êtes maintenant en mesure de dessiner des rectangles, cercles et polygones
    quelconques facilement et sans avoir à utiliser une image et un sprite. Regardons maintenant quelque chose
    de plus excitant :
    <a class="internal" href="./graphics-views-fr.php" title="Aller au tutoriel suivant">les vues</a>.
</p>

<?php

    require("footer-fr.php");

?>
