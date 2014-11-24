<?php

    $title = "Shapes";
    $page = "graphics-shapes.php";

    require("header.php");

?>

<h1>Shapes</h1>

<?php h2('Introduction') ?>
<p>
    SFML provides a set of classes that represent simple shape entities. Each type of shape is a separate class, but they all derive from the same base class so that
    they provide the same subset of common features. Each class then adds its own specificities: a radius property for the circle class, a size for the rectangle class,
    points for the polygon class, etc.
</p>

<?php h2('Common shape properties') ?>

<h3>Transformation (position, rotation, scale)</h3>
<p>
    These properties are common to all the SFML graphical classes, so they are explained in a separate tutorial:
    <a href="./graphics-transform.php" title="'Transforming entities' tutorial">Transforming entities</a>.
</p>

<h3>Color</h3>
<p>
    One of the most basic property of a shape is its color, that you can change with the <code>setFillColor</code> function.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);

// set the shape color to green
shape.setFillColor(sf::Color(100, 250, 50));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-color.png" alt="A colored shape"/>

<h3>Outline</h3>
<p>
    Shapes can have an outline. You can select the thickness and color of the outline with the <code>setOutlineThickness</code> and <code>setOutlineColor</code> functions.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);
shape.setFillColor(sf::Color(150, 50, 250));

// set a 10-pixel wide orange outline
shape.setOutlineThickness(10);
shape.setOutlineColor(sf::Color(250, 150, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-outline.png" alt="An outlined shape"/>
<p>
    By default, the outline expands outside the shape (if you have a circle with a radius of 10 and an outline thickness of 5, the total radius of the circle will be 15).
    You can make it expand towards the center of the shape instead, by giving a negative thickness.
</p>
<p>
    To disable the outline, set its thickness to 0. If you want the outline only, you can set the fill color to <code>sf::Color::Transparent</code>.
</p>

<h3>Texture</h3>
<p>
    Shapes can also be textured, like sprites. To specify which part of the texture must be mapped to the shape, you must use the <code>setTextureRect</code> function.
    It takes the texture rectangle to map to the bounding rectangle of the shape. This method doesn't offer maximum flexibility, but it is much easier to use than
    individually setting the texture coordinates of each point of the shape.
</p>
<pre><code class="cpp">sf::CircleShape shape(50);

// map a 100x100 textured rectangle to the shape
shape.setTexture(&amp;texture); // texture is a sf::Texture
shape.setTextureRect(sf::IntRect(10, 10, 100, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-texture.png" alt="A textured shape"/>
<p>
    Note that the outline is not textured.<br/>
    In case the shape has a fill color, the texture is modulated (multiplied) with it.<br/>
    To disable texturing, call <code>setTexture(NULL)</code>.
</p>

<?php h2('Drawing a shape') ?>
<p>
    Drawing a shape is as simple as drawing any other SFML entity:
</p>
<pre><code class="cpp">window.draw(shape);
</code></pre>

<?php h2('Built-in shape types') ?>

<h3>Rectangles</h3>
<p>
    To draw rectangles, you must use the <?php class_link('RectangleShape') ?> class. It has only one attribute: the size of the rectangle.
</p>
<pre><code class="cpp">// define a 120x50 rectangle
sf::RectangleShape rectangle(sf::Vector2f(120, 50));

// change the size to 100x100
rectangle.setSize(sf::Vector2f(100, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-rectangle.png" alt="A rectangle shape"/>

<h3>Circles</h3>
<p>
    Circles are represented by the <?php class_link('CircleShape') ?> class. It has two attributes: the radius and the number of sides. The number of sides is an optional
    attribute, it allows you to adjust the "quality" of the circle: circles have to be simulated by polygons with many sides (the graphics card is unable to draw a perfect
    circle directly), and this attribute defines how many sides your circle will have. If you draw small circles, you'll probably need only a few sides. If you draw big
    circles, or zoom on regular circles, you'll most likely need more sides.
</p>
<pre><code class="cpp">// define a circle with radius = 200
sf::CircleShape circle(200);

// change the radius to 40
circle.setRadius(40);

// change the number of sides (points) to 100
circle.setPointCount(100);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-circle.png" alt="A circle shape"/>

<h3>Regular polygons</h3>
<p>
    There's no dedicated class for regular polygons, in fact you can get a regular polygon of any number of sides with the <?php class_link('CircleShape') ?> class: indeed,
    since circles are simulated by polygons with many sides, you just have to play with the number of sides to get the desired polygons. A <?php class_link('CircleShape') ?>
    with 3 points is a triangle, with 4 points it's a square, etc.
</p>
<pre><code class="cpp">// define a triangle
sf::CircleShape triangle(80, 3);

// define a square
sf::CircleShape square(80, 4);

// define an octagon
sf::CircleShape octagon(80, 8);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-regular.png" alt="Regular polygons"/>

<h3>Convex shapes</h3>
<p>
    The <?php class_link('ConvexShape') ?> class is the ultimate shape class: it allows you to define any shape, as long as it stays convex. Indeed, SFML is unable to draw
    concave shapes; if you need to draw a concave shape, you'll have to split it into multiple convex polygons (if possible).
</p>
<p>
    To define a convex shape, you must first set the total number of points, and then define these points.
</p>
<pre><code class="cpp">// create an empty shape
sf::ConvexShape convex;

// resize it to 5 points
convex.setPointCount(5);

// define the points
convex.setPoint(0, sf::Vector2f(0, 0));
convex.setPoint(1, sf::Vector2f(150, 10));
convex.setPoint(2, sf::Vector2f(120, 90));
convex.setPoint(3, sf::Vector2f(30, 100));
convex.setPoint(4, sf::Vector2f(0, 50));
</code></pre>
<p class="important">
    It is very important to define the points of a convex shape either in clockwise or anticlockwise order. If you define them in a random order, the result will be
    undefined.
</p>
<img class="screenshot" src="./images/graphics-shape-convex.png" alt="A convex shape"/>
<p>
    Officially, <?php class_link('ConvexShape') ?> can only create convex shapes. But in fact, its requirements are a little more relaxed. In fact, the only technical
    constraint that your shape must follow, is that if you draw a line from its <em>center of gravity</em> to any of its point, you mustn't cross an edge. With this
    relaxed definition, you can for example draw stars.
</p>

<h3>Lines</h3>
<p>
    There's no shape class for lines. The reason is simple: if your line has a thickness, it is a rectangle; if it doesn't, it can be drawn with a line primitive.
</p>
<p>
    Line with thickness:
</p>
<pre><code class="cpp">sf::RectangleShape line(sf::Vector2f(150, 5));
line.rotate(45);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-rectangle.png" alt="A line shape drawn as a rectangle"/>
<p>
    Line without thickness:
</p>
<pre><code class="cpp">sf::Vertex line[] =
{
    sf::Vertex(sf::Vector2f(10, 10)),
    sf::Vertex(sf::Vector2f(150, 150))
};

window.draw(line, 2, sf::Lines);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-primitive.png" alt="A line shape drawn as a primitive"/>
<p>
    To learn more about vertices and primitives, you can read the
    <a href="./graphics-vertex-array.php" title="'Vertex arrays' tutorial">Vertex arrays</a> tutorial.
</p>

<?php h2('Custom shape types') ?>
<p>
    You can extend the set of shape classes with your own shape types. To do so, you must derive from <?php class_link('Shape') ?> and override two functions:
</p>
<ul>
    <li><code>getPointCount</code>: return the number of points of the shape</li>
    <li><code>getPoint</code>: return a point of the shape</li>
</ul>
<p>
    You must also call the <code>update()</code> protected function whenever the points of your shape change, so that the base class knows about it and can update
    its internal state.
</p>
<p>
    Here is a complete example of a custom shape class: EllipseShape.
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
        return 30; // fixed, but could be an attribute of the class if needed
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
<img class="screenshot" src="./images/graphics-shape-ellipse.png" alt="An ellipse shape"/>

<?php h2('Antialiased shapes') ?>
<p>
    There's no option to antialias a single shape. If you want to get antialiased shapes (ie. shapes with smooth edges), you must enable antialiasing globally when you
    create the window, with the corresponding attribute of the <?php struct_link('ContextSettings') ?> structure.
</p>
<pre><code class="cpp">sf::ContextSettings settings;
settings.antialiasingLevel = 8;

sf::RenderWindow window(sf::VideoMode(800, 600), "SFML shapes", sf::Style::Default, settings);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-antialiasing.png" alt="Aliased vs antialiased shape"/>
<p>
    Remember that antialiasing depends on the graphics card: it may either not support it, or have it forced to off in the driver settings.
</p>

<?php

    require("footer.php");

?>
