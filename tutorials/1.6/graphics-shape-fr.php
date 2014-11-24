<?php

    $title = "Dessiner des formes simples";
    $page = "graphics-shape-fr.php";

    require("header-fr.php");
?>

<h1>Dessiner des formes simples</h1>

<?php h2('Introduction') ?>
<p>
    Ce nouveau tutoriel va vous apprendre � dessiner des formes 2D simples telles que des lignes, des rectangles,
    des cercles ou encore des polygones avec SFML.
</p>

<?php h2('Construire des formes quelconque') ?>
<p>
    Pour construire une forme persos avec SFML, vous devez utiliser la classe
    <?php class_link("Shape")?>.<br/>
    Une forme est basiquement un polygone convexe, dans lequel chaque point a sa propre position et couleur.
    Il est �galement possible d'ajouter une bordure automatique � une forme, chaque point pouvant avoir sa propre couleur
    de bordure.</br>
    Il est tr�s important de d�finir les points d'une forme dans l'ordre (sens des aiguilles d'une montre ou inverse, peu importe),
    sans quoi la forme pourrait �tre mal-form�e. Il est �galement important de garder la forme convexe, sinon elle
    pourrait ne pas �tre rendue correctement. Si vous devez afficher des formes concaves, essayez de les d�couper
    en plusieurs sous-formes convexes.
</p>
<p>
    Pour ajouter un point � une forme, utilisez la fonction <code>AddPoint</code> :
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
    Les param�tres sont les coordonn�es X et Y du point, sa couleur et une couleur optionnelle pour la bordure.
    Notez que vous pouvez �galement passer un <?php class_link("Vector2f")?> plut�t que deux floats pour la position du point.
</p>
<p>
    Une fois ajout�s � la forme, les attributs des points (position, couleur et bordure) peuvent �tre r�cup�r�es
    ou chang�es individuellement � l'aide des accesseurs suivants :
</p>
<pre><code class="cpp">// R�cup�re les attributs du troisi�me point
sf::Vector2f Position     = Polygon.GetPointPosition(2);
sf::Color    Color        = Polygon.GetPointColor(2);
sf::Color    OutlineColor = Polygon.GetPointOutlineColor(2);

// Change les attributs du deuxi�me point
Polygon.SetPointPosition(1, sf::Vector2f(50, 100));
Polygon.SetPointColor(1, sf::Color::Black);
Polygon.SetPointOutlineColor(1, sf::Color(0, 128, 128));
</code></pre>
<p>
    Afin de contr�ler l'�paisseur de la bordure de l'ensemble de la forme, vous pouvez utiliser la fonction <code>SetOutlineWidth</code> :
</p>
<pre><code class="cpp">// D�finit une bordure d'�paisseur 10
Polygon.SetOutlineWidth(10);
</code></pre>
<p>
    Ok parfait, nous avons d�sormais une forme avec une bordure. Mais que faire si nous voulons juste afficher la bordure
    sans remplir la forme ? Ou supprimer cette bordure ? Il existe deux fonctions pour activer ou d�sactiver
    le remplissage et la bordure :
</p>
<pre><code class="cpp">// D�sactive le remplissage de la forme
Polygon.EnableFill(false);

// Active l'affichage de sa bordure
Polygon.EnableOutline(true);
</code></pre>
<p>
    Comme tout objet affichable dans SFML, les formes h�ritent de toutes les fonctions habituelles pour d�finir leur
    position, rotation, facteur d'�chelle, couleur et mode de blending.
</p>
<pre><code class="cpp">Polygon.SetColor(sf::Color(255, 255, 255, 200));
Polygon.Move(300, 300);
Polygon.Scale(3, 2);
Polygon.Rotate(45);
</code></pre>
<p>
    Enfin, afficher une forme se fait �galement de la m�me mani�re que tous les objets SFML :
</p>
<pre><code class="cpp">App.Draw(Polygon);
</code></pre>

<?php h2('Formes pr�d�finies') ?>
<p>
    SFML fournit des fonctions statiques pour construire facilement des formes simples telles que des lignes,
    des rectangles et des cercles :
</p>
<pre><code class="cpp">sf::Shape Line   = sf::Shape::Line(X1, Y1, X2, Y2, Epaisseur, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Circle = sf::Shape::Circle(X, Y, Rayon, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Rect   = sf::Shape::Rectangle(X1, Y1, X2, Y2, Couleur, [Bordure], [CouleurBordure]);
</code></pre>
<p>
    Les valeurs pour l'�paisseur et la couleur de bordure sont optionnelles ; la bordure est d�sactiv�e par d�faut.
</p>

<?php h2('Conclusion') ?>
<p>
    Avec cette nouvelle classe vous �tes maintenant en mesure de dessiner des rectangles, cercles et polygones
    quelconques facilement et sans avoir � utiliser une image et un sprite. Regardons maintenant quelque chose
    de plus excitant :
    <a class="internal" href="./graphics-views-fr.php" title="Aller au tutoriel suivant">les vues</a>.
</p>

<?php

    require("footer-fr.php");

?>
