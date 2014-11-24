<?php

    $title = "Dessiner des formes";
    $page = "graphics-shapes-fr.php";

    require("header-fr.php");

?>

<h1>Dessiner des formes</h1>

<?php h2('Introduction') ?>
<p>
    SFML fournit un ensemble de classes repr�sentant des formes simples. Chaque forme poss�de sa propre classe, mais toutes d�rivent de la m�me classe de base de sorte
    qu'elles partagent un ensemble de fonctionnalit�s communes. Chaque classe ajoute ensuite ses propres sp�cificit�s : un rayon pour la classe de cercles,
    une taille pour la classe de rectangles, des points pour la classe des polygones, etc.
</p>

<?php h2('Les propri�t�s communes des formes') ?>

<h3>Transformation (position, rotation, �chelle)</h3>
<p>
    Ces propri�t�s �tant communes � toutes les classes graphiques de SFML, elles sont d�taill�es dans un
    <a href="graphics-transform-fr.php" title="Tutoriel sur les transformations">tutoriel d�di�</a>.
</p>

<h3>Couleur</h3>
<p>
    L'une des propri�t�s les plus basiques d'une forme est sa couleur, que vous pouvez modifier via la fonction <code>setFillColor</code>.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);

// change la couleur de la forme pour du vert
shape.setFillColor(sf::Color(100, 250, 50));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-color.png" alt="Une forme color�e"/>

<h3>Contour</h3>
<p>
    Les formes peuvent avoir un contour. Vous pouvez choisir l'�paisseur et la couleur de celui-ci avec les fonctions <code>setOutlineThickness</code> et
    <code>setOutlineColor</code>.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);
shape.setFillColor(sf::Color(150, 50, 250));

// d�finit un contour orange de 10 pixels d'�paisseur
shape.setOutlineThickness(10);
shape.setOutlineColor(sf::Color(250, 150, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-outline.png" alt="Une forme avec contour"/>
<p>
    Par d�faut, le contour s'�tend � l'ext�rieur de la forme (si vous avez un cercle avec un rayon de 10 et un contour de 5, le rayon total du cercle sera 15). Vous pouvez
    le faire s'�tendre vers l'int�rieur si vous le souhaitez, en sp�cifiant une �paisseur n�gative.
</p>
<p>
    Pour d�sactiver le contour, mettez son �paisseur � 0. Si au contraire vous voulez voir uniquement le contour, vous pouvez mettre la couleur int�rieure
    (<code>setFillColor</code>) � <code>sf::Color::Transparent</code>.
</p>

<h3>Texture</h3>
<p>
    Les formes peuvent �galement �tre textur�es, comme les sprites. Pour indiquer quelle partie de la texture doit �tre coll�e sur la forme, vous devez utiliser la fonction
    <code>setTexture</code>. Celle-ci prend en param�tre le rectangle de la texture � coller sur le rectangle englobant de la forme. Cette m�thode offre une flexibilit�
    limit�e, mais elle est bien plus simple � utiliser que d'avoir � attribuer explicitement des coordonn�es de texture � chaque point de la forme.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);

// colle un rectangle textur� de 100x100 sur la forme
shape.setTexture(&amp;texture); // texture est un sf::Texture
shape.setTextureRect(sf::IntRect(10, 10, 100, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-texture.png" alt="Une forme textur�e"/>
<p>
    Notez que le contour n'est pas textur�.<br/>
    Au cas o� la forme a �galement une couleur, la texture est modul�e (multipli�e) avec elle.<br/>
    Pour d�sactiver le texturage, appelez <code>setTexture(NULL)</code>.
</p>

<?php h2('Dessiner une forme') ?>
<p>
    Dessiner une forme est aussi simple que de dessiner n'importe quelle autre entit� SFML :
</p>
<pre><code class="cpp">window.draw(shape);
</code></pre>

<?php h2('Les types de formes pr�d�finis') ?>

<h3>Rectangles</h3>
<p>
    Pour dessiner des rectangles, vous devez utiliser la classe <?php class_link('RectangleShape') ?>. Celle-ci ne poss�de qu'un attribut : la taille du rectangle.
</p>
<pre><code class="cpp">// d�finit un rectangle de 120x50
sf::RectangleShape rectangle(sf::Vector2f(120, 50));

// change sa taille en 100x100
rectangle.setSize(sf::Vector2f(100, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-rectangle.png" alt="Un rectangle"/>

<h3>Cercles</h3>
<p>
    Les cercles sont repr�sent�s par la classe <?php class_link('CircleShape') ?>. Elle poss�de deux attributs : le rayon et le nombre de c�t�s. Le nombre de c�t�s est
    un attribut optionnel, qui permet d'ajuster la "qualit�" du cercle : les cercles doivent en effet �tre simul�s par des polygones avec beaucoup de c�t�s (la carte graphique
    est incapable de dessiner des cercles parfaits directement), et cet attribut d�finit combien de c�t�s le cercle poss�de. Si vous dessinez de petits cercles, vous n'aurez
    probablement pas besoin de beaucoup de c�t�s. Si au contraire vous dessinez de gros cercles, ou bien zoomez sur des cercles, vous devrez utiliser plus de c�t�s si
    vous voulez que ceux-ci restent imperceptibles.
</p>
<pre><code class="cpp">// d�finit un cercle de rayon 200
sf::CircleShape circle(200);

// change le rayon � 40
circle.setRadius(40);

// change le nombre de points (c�t�s) du cercle
circle.setPointCount(100);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-circle.png" alt="Un cercle"/>

<h3>Polygones r�guliers</h3>
<p>
    Il n'y a pas de classe d�di�e pour les polygones r�guliers. En fait vous pouvez obtenir un polygone r�gulier de n'importe quel nombre de c�t�s avec la classe
    <?php class_link('CircleShape') ?> : en effet, puisque les cercles sont simul�s par des polygones avec beaucoup de c�t�s, vous avez juste � jouer sur le nombre de c�t�s
    pour obtenir le polygone voulu. Un <?php class_link('CircleShape') ?> avec 3 points est un triangle, avec 4 points c'est un carr�, etc.
</p>
<pre><code class="cpp">// d�finit un triangle
sf::CircleShape triangle(80, 3);

// d�finit un carr�
sf::CircleShape square(80, 4);

// d�finit un octogone
sf::CircleShape octagon(80, 8);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-regular.png" alt="Des polygones r�guliers"/>

<h3>Formes convexes</h3>
<p>
    La classe <?php class_link('ConvexShape') ?> est la classe de forme ultime : elle permet de d�finir une forme quelconque, pour peu qu'elle reste convexe. En effet, SFML
    ne peut pas dessiner de formes concaves ; si vous devez vraiment en dessiner, vous devrez la d�couper en plusieurs formes convexes (si possible).
</p>
<p>
    Pour cr�er une forme convexe, vous devez tout d'abord d�finir le nombre total de points, puis d�finir ceux-ci.
</p>
<pre><code class="cpp">// cr�e une forme vide
sf::ConvexShape convex;

// d�finit le nombre de points (5)
convex.setPointCount(5);

// d�finit les points
convex.setPoint(0, sf::Vector2f(0, 0));
convex.setPoint(1, sf::Vector2f(150, 10));
convex.setPoint(2, sf::Vector2f(120, 90));
convex.setPoint(3, sf::Vector2f(30, 100));
convex.setPoint(4, sf::Vector2f(0, 50));
</code></pre>
<p class="important">
    Il est tr�s important de d�finir les points d'une forme convexe dans le sens des aiguilles d'une montre (ou inverse). Si vous les d�finissez dans un ordre quelconque,
    le r�sultat sera ind�termin�.
</p>
<img class="screenshot" src="./images/graphics-shape-convex.png" alt="Une forme convexe"/>
<p>
    Officiellement, <?php class_link('ConvexShape') ?> peut seulement cr�er des formes convexes. Mais en r�alit� cette contrainte est l�g�rement exag�r�e. En fait,
    d'un point de vue strictement technique, la contrainte exacte que votre forme doit suivre est que si vous tracez un segment allant de son <em>centre de gravit�</em>
    � n'importe lequel de ses points, vous ne devez croiser aucun c�t�. Avec cette d�finition un peu plus flexible, vous pouvez par exemple dessiner des �toiles.
</p>

<h3>Lignes</h3>
<p>
    Il n'existe aucune classe pour les lignes. La raison est simple : si votre ligne poss�de une �paisseur alors c'est un rectangle ; sinon, elle peut �tre dessin�e avec une
    primitive de type ligne.
</p>
<p>
    Ligne avec �paisseur :
</p>
<pre><code class="cpp">sf::RectangleShape line(sf::Vector2f(150, 5));
line.rotate(45);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-rectangle.png" alt="Une ligne avec �paisseur"/>
<p>
    Ligne sans �paisseur :
</p>
<pre><code class="cpp">sf::Vertex line[] =
{
    sf::Vertex(sf::Vector2f(10, 10)),
    sf::Vertex(sf::Vector2f(150, 150))
};

window.draw(line, 2, sf::Lines);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-primitive.png" alt="Une ligne sans �paisseur"/>

<?php h2('Formes personnalis�es') ?>
<p>
    Vous pouvez �tendre l'ensemble des classes de formes avec vos propres types de formes. Pour ce faire, vous devez d�river de <?php class_link('Shape') ?> et red�finir
    deux fonctions :
</p>
<ul>
    <li><code>getPointCount</code>: renvoie le nombre de points de la forme</li>
    <li><code>getPoint</code>: renvoie un point de la forme</li>
</ul>
<p>
    Vous devez �galement appeler la fonction prot�g�e <code>update()</code> � chaque fois que les points de la forme changent, de sorte que la classe de base en soit inform�e
    et puisse recalculer ce dont elle a besoin.
</p>
<p>
    Voici un exemple complet de classe de forme personnalis�e : EllipseShape.
</p>
<pre><code class="cpp">class EllipseShape : public sf::Shape
{
public :

    explicit EllipseShape(const sf::Vector2f&amp; radius = sf::Vector2f(0, 0)) :
    m_radius(radius)
    {
        update();
    }

    void setRadius(const sf::Vector2f&amp; radius)
    {
        m_radius = radius;
        update();
    }

    const sf::Vector2f&amp; getRadius() const
    {
        return m_radius;
    }

    virtual unsigned int getPointCount() const
    {
        return 30; // fix�, mais �a pourrait tout aussi bien �tre un attribut de la classe
    }

    virtual sf::Vector2f getPoint(unsigned int index) const
    {
        static const float pi = 3.141592654f;

        float angle = index * 2 * pi / getPointCount() - pi / 2;
        float x = std::cos(angle) * m_radius.x;
        float y = std::sin(angle) * m_radius.y;

        return sf::Vector2f(m_radius.x + x, m_radius.y + y);
    }

private :

    sf::Vector2f m_radius;
};
</code></pre>
<img class="screenshot" src="./images/graphics-shape-ellipse.png" alt="Une ellipse"/>

<?php h2('Formes anticr�nel�es') ?>
<p>
    Il n'y a pas d'option pour activer l'anticr�nelage pour une forme en particulier. Si vous voulez des formes anticr�nel�es (ie. avec des bords liss�s), vous devez
    activer l'anticr�nelage de mani�re globale lorsque vous cr�ez la fen�tre, avec l'attribut correspondant de la structure <?php struct_link('ContextSettings') ?>.
</p>
<pre><code class="cpp">sf::ContextSettings settings;
settings.antialiasingLevel = 8;

sf::RenderWindow window(sf::VideoMode(800, 600), "SFML shapes", sf::Style::Default, settings);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-antialiasing.png" alt="Cr�nel� vs anticr�nel�"/>
<p>
    Souvenez-vous que l'anticr�nelage d�pend de la carte graphique : elle peut ne pas le supporter, ou forcer sa d�sactivation dans les param�tres du pilote graphique.
</p>

<?php

    require("footer-fr.php");

?>
