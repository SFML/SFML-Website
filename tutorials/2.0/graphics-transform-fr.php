<?php

    $title = "Position, rotation, �chelle : transformer des entit�s";
    $page = "graphics-transform-fr.php";

    require("header-fr.php");

?>

<h1>Position, rotation, �chelle : transformer des entit�s</h1>

<?php h2('Transformer des entit�s SFML') ?>
<p>
    Toutes les classes de SFML (sprites, texte, formes) utilisent la m�me interface pour les transformations : <?php class_link('Transformable') ?>. Cette classe de base
    d�finit une API simple pour positionner, tourner et redimensionner vos entit�s. Elle n'offre pas une flexibilit� maximale, mais d�finit plut�t une interface qui soit
    facile � comprendre et � utiliser, et qui couvre 99% des cas d'utilisation -- pour les 1% restant, voyez les derniers chapitres.
</p>
<p>
    <?php class_link('Transformable') ?> (et toutes ses classes d�riv�es) d�finit quatre propri�t�s : <strong>position</strong>, <strong>rotation</strong>,
    <strong>�chelle</strong> et <strong>origine</strong> ; elles ont toutes leur <em>getter</em> et leur <em>setter</em>. Ces composantes de transformation sont toutes
    ind�pendantes les unes des autres : si vous voulez modifier l'orientation de l'entit�, vous avez juste � changer sa propri�t� 'rotation' sans vous pr�occuper de
    la position ou de l'�chelle courante.
</p>
<h3>Position</h3>
<p>
    La position est la... position de l'entit� dans le monde 2D. Je ne pense pas que cela m�rite plus d'explications :)
</p>
<pre><code class="cpp">// 'entity' peut �tre un sf::Sprite, un sf::Text, un sf::Shape ou n'importe quelle autre classe transformable

// change la position absolue de l'entit�
entity.setPosition(10, 50);

// d�place l'entit� relativement � sa position actuelle
entity.move(5, 5);

// r�cup�re la position absolue de l'entit�
sf::Vector2f position = entity.getPosition(); // = (15, 55)
</code></pre>
<img class="screenshot" src="images/graphics-transform-position.png" alt="Une entit� positionn�e"/>
<p>
    Par d�faut, les entit�s sont positionn�es par rapport � leur coin haut-gauche ; nous verrons plus tard comment changer cela avec la propri�t� 'origine'.
</p>

<h3>Rotation</h3>
<p>
    La rotation est l'orientation de l'entit� dans le monde 2D. Elle est d�finie en <em>degr�s</em>, dans le sens des aiguilles d'une montre (car l'axe Y pointe vers le
    bas avec SFML).
</p>
<pre><code class="cpp">// 'entity' peut �tre un sf::Sprite, un sf::Text, un sf::Shape ou n'importe quelle autre classe transformable

// change la rotation absolue de l'entit�
entity.setRotation(45);

// tourne l'entit� relativement � son orientation actuelle
entity.rotate(10);

// r�cup�re la rotation absolue de l'entit�
float rotation = entity.getRotation(); // = 55
</code></pre>
<img class="screenshot" src="images/graphics-transform-rotation.png" alt="Une entit� tourn�e"/>
<p>
    Notez que SFML renvoie toujours un angle entre 0 et 360 lorsque vous appelez <code>getRotation</code>.
</p>
<p>
    De m�me que pour la position, la rotation s'effectue par d�faut autour du coin haut-gauche, mais cela peut �tre chang� avec l'origine.
</p>

<h3>Echelle</h3>
<p>
    Le facteur d'�chelle permet de redimensionner l'entit�. L'�chelle par d�faut est 1, plus que 1 agrandit l'entit�, moins que 1 la r�duit. Les facteurs d'�chelle
    n�gatifs sont autoris�s, ce qui permet de faire des sym�tries des entit�s.
</p>
<pre><code class="cpp">// 'entity' peut �tre un sf::Sprite, un sf::Text, un sf::Shape ou n'importe quelle autre classe transformable

// change l'�chelle absolue de l'entit�
entity.setScale(4.0f, 1.6f);

// redimensionne l'entit� relativement � son �chelle actuelle
entity.scale(0.5f, 0.5f);

// r�cup�re l'�chelle absolue de l'entit�
sf::Vector2f scale = entity.getScale(); // = (2, 0.8)
</code></pre>
<img class="screenshot" src="images/graphics-transform-scale.png" alt="Une entit� redimensionn�e"/>

<h3>Origine</h3>
<p>
    L'origine est le centre des trois autres transformations. La position est la position de l'origine, la rotation est effectu�e autour de l'origine, et l'�chelle
    est appliqu�e autour de l'origine �galement. Par d�faut, l'origine est le coin haut-gauche de l'entit� (son point (0, 0)), mais vous pouvez la modifier de sorte qu'elle
    soit le centre ou un autre coin, par exemple.
</p>
<p>
    Afin que l'API reste simple, il n'y a qu'une origine pour les trois composantes de transformation. Ce qui signifie que vous ne pouvez pas, par exemple, positionner une
    entit� relativement � son coin haut-gauche tout en la tournant autour de son centre. Si vous avez r�ellement besoin de faire ce genre de choses, jetez un oeil aux chapitres
    suivants.
</p>
<pre><code class="cpp">// 'entity' peut �tre un sf::Sprite, un sf::Text, un sf::Shape ou n'importe quelle autre classe transformable

// change l'origine de l'entit�
entity.setOrigin(10, 20);

// r�cup�re l'origine de l'entit�
sf::Vector2f origin = entity.getOrigin(); // = (10, 20)
</code></pre>
<p>
    Notez que le fait de changer l'origine modifie �galement la position de l'entit� � l'�cran, bien que sa propri�t� 'position' soit toujours la m�me. Si vous ne comprenez
    pas pourquoi, relisez ce tutoriel !
</p>

<?php h2('Transformez vos propres classes') ?>
<p>
    <?php class_link('Transformable') ?> n'est pas seulement faite pour les classes SFML, elle peut aussi servir de base (ou de membre) � vos propres classes.
</p>
<pre><code class="cpp">class MyGraphicalEntity : public sf::Transformable
{
    // ...
};

MyGraphicalEntity entity;
entity.setPosition(10, 30);
entity.setRotation(110);
entity.setScale(0.5f, 0.2f);
</code></pre>
<p>
    Pour utiliser la transformation finale de l'entit� (par exemple pour la dessiner), il faut appeler la fonction <code>getTransform</code>. Celle-ci renvoie un
    <?php class_link('Transform') ?> ; voyez le prochain chapitre pour plus d'explications concernant cette classe, et comment l'utiliser pour transformer une entit� SFML.
</p>
<p>
    Si vous n'avez pas besoin de la totalit� des fonctions fournies par <?php class_link('Transformable') ?>, ou bien n'en voulez pas pour fournir votre propre
    interface publique, n'h�sitez pas � l'utiliser en tant que membre, et � fournir vos propres fonctions par dessus les siennes. Elle n'est pas abstraite donc il n'y a aucun
    probl�me � l'instancier plut�t que de l'utiliser en tant que classe de base.
</p>

<?php h2('Les transformations quelconques') ?>
<p>
    La classe <?php class_link('Transformable') ?> est facile � utiliser, mais elle est �galement limit�e. Certains utilisateurs auront besoin de plus de flexibilit�, ils
    voudront d�finir une transformation finale comme �tant une combinaison quelconque de transformations de base. Pour cette cat�gorie d'utilisateurs, une classe de plus
    bas niveau est disponible : <?php class_link('Transform') ?>. Elle n'est rien de plus qu'une matrice 3x3 encapsul�e, elle peut donc repr�senter n'importe quelle
    transformation 2D.
</p>
<p>
    Il y a plusieurs fa�ons de construire un <?php class_link('Transform') ?> :
</p>
<ul>
    <li>en utilisant les fonctions pr�d�finies pour les transformations les plus communes (translation, rotation, �chelle)</li>
    <li>en combinant deux <?php class_link('Transform') ?></li>
    <li>en donnant ses 9 composantes directement</li>
</ul>
<p>
    Voici quelques exemples :
</p>
<pre><code class="cpp">// la transformation identit� (ne fait rien)
sf::Transform t1 = sf::Transform::Identity;

// une rotation
sf::Transform t2;
t2.rotate(45);

// une matrice 3x3
sf::Transform t3(2, 0, 20,
                 0, 1, 50,
                 0, 0, 1);

// une combinaison de transformations
sf::Transform t4 = t1 * t2 * t3;
</code></pre>
<p>
    Vous pouvez bien entendu appliquer plusieurs transformations de base au m�me <?php class_link('Transform') ?>, celles-ci seront toutes combin�es s�quentiellement :
</p>
<pre><code class="cpp">sf::Transform t;
t.translate(10, 100);
t.rotate(90);
t.translate(-10, 50);
t.scale(0.5f, 0.75f);
</code></pre>
<p>
    Mais revenons � nos moutons : comment une telle transformation peut-elle �tre appliqu�e � une entit� graphique ? C'est facile : passez-la � la fonction <code>draw</code>.
</p>
<pre><code class="cpp">window.draw(entity, transform);
</code></pre>
<p>
    ... ce qui est en fait un raccourci pour :
</p>
<pre><code class="cpp">sf::RenderStates states;
states.transform = transform;
window.draw(entity, states);
</code></pre>
<p>
    Si votre entit� est un <?php class_link('Transformable') ?> (sprite, texte, forme), avec sa propre transformation interne, alors les deux sont combin�es pour produire
    la transformation finale.
</p>

<?php h2('Bo�tes englobantes') ?>
<p>
    Apr�s avoir transform� et dessin� vos entit�s, vous voudrez certainement effectuer certains calculs avec elles, comme par exemple d�tecter les collisions.
</p>
<p>
    Les entit�s SFML peuvent vous donner leur bo�te englobante. La bo�te englobante est le rectangle minimal qui contient l'entit�, et dont les c�t�s sont align�s sur
    les axes X et Y.
</p>
<img class="screenshot" src="images/graphics-transform-bounds.png" alt="Bo�te englobante d'entit�s"/>
<p>
    La bo�te englobante est tr�s pratique pour impl�menter la d�tection de collisions : elle peut �tre rapidement test�e avec un point ou avec une autre bo�te englobante,
    et elle repr�sente une assez bonne approximation de l'entit� r�elle.
</p>
<pre><code class="cpp">// r�cup�ration de la bo�te englobante de l'entit�
sf::FloatRect boundingBox = entity.getGlobalBounds();

// test de collision avec un point
sf::Vector2f point = ...;
if (boundingBox.contains(point))
{
    // collision!
}

// test de collision avec un autre rectangle (comme par exemple la bo�te englobante d'une autre entit�)
sf::FloatRect otherBox = ...;
if (boundingBox.intersects(otherBox))
{
    // collision!
}
</code></pre>
<p>
    La fonction est nomm�e <code>getGlobalBounds</code> car elle renvoie la bo�te englobante de l'entit� dans le syst�me de coordonn�es global, c'est-�-dire avec toutes
    ses transformations (position, rotation, �chelle) appliqu�es.
</p>
<p>
    Il existe une autre fonction, qui renvoie la bo�te englobante de l'entit� dans son syst�me de coordonn�es <em>local</em> (sans les transformations) :
    <code>getLocalBounds</code>. Cette fonction peut �tre utilis�e pour r�cup�rer la taille initiale de l'entit�, par exemple, ou bien pour effectuer des calculs
    plus sp�cifiques.
</p>

<?php h2('Les hi�rarchies d\'objets (scenegraph)') ?>
<p>
    Avec les transformations persos vues pr�c�demment, il est maintenant facile d'impl�menter une hi�rarchie d'objets, o� les enfants sont transform�s relativement � leur
    parent. Tout ce que vous avez � faire est de passer la transformation combin�e du parent aux enfants lorsque vous les dessinez, jusqu'� ce que vous atteignez les
    entit�s dessinables finales (sprites, textes, formes, vertex arrays ou bien vos propres 'drawables').
</p>
<pre><code class="cpp">// la classe de base abstraite
class Node
{
public:

    // ... fonctions pour transformer le noeud

    // ... fonction pour g�rer les enfants du noeud

    void draw(sf::RenderTarget&amp; target, const sf::Transform&amp; parentTransform) const
    {
        // on combine la transformation du parent avec la transformation du noeud
        sf::Transform combinedTransform = parentTransform * m_transform;

        // on laisse le noeud se dessiner
        onDraw(target, combinedTransform)

        // on dessine ses enfants
        for (std::size_t i = 0; i &lt; m_children.size(); ++i)
            m_children[i]->draw(target, combinedTransform);
    }

private:

    virtual void onDraw(sf::RenderTarget&amp; target, const sf::Transform&amp; transform) const = 0;

    sf::Transform m_transform;
    std::vector&lt;Node*&gt; m_children;
};

// une classe d�riv�e simple : un noeud qui dessine un sprite
class SpriteNode : public Node
{
public:

    // .. fonctions pour param�trer le sprite

private:

    virtual void onDraw(sf::RenderTarget&amp; target, const sf::Transform&amp; transform) const
    {
        target.draw(m_sprite, transform);
    }

    sf::Sprite m_sprite;
};
</code></pre>

<?php

    require("footer-fr.php");

?>
