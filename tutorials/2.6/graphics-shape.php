<?php

    $title = "Shapes";
    $page = "graphics-shapes.php";

    require("header.php");

?>

<h1>Shapes</h1>

<?php h2('Introduction') ?>
<p>
    SFML provides a set of classes that represent simple shape entities. Each type of shape is a separate class, but they all derive from the same base class so that
    they have access to the same subset of common features. Each class then adds its own specifics: a radius property for the circle class, a size for the rectangle class,
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
    One of the basic properties of a shape is its color. You can change with the <code>setFillColor</code> function.
</p>
<pre><code class="cpp">sf::CircleShape shape(50.f);

// set the shape color to green
shape.setFillColor(sf::Color(100, 250, 50));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-color.png" alt="A colored shape"/>

<h3>Outline</h3>
<p>
    Shapes can have an outline. You can set the thickness and color of the outline with the <code>setOutlineThickness</code> and <code>setOutlineColor</code> functions.
</p>
<pre><code class="cpp">sf::CircleShape shape(50.f);
shape.setFillColor(sf::Color(150, 50, 250));

// set a 10-pixel wide orange outline
shape.setOutlineThickness(10.f);
shape.setOutlineColor(sf::Color(250, 150, 100));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-outline.png" alt="An outlined shape"/>
<p>
    By default, the outline is extruded outwards from the shape (e.g. if you have a circle with a radius of 10 and an outline thickness of 5, the total radius of the circle will be 15).
    You can make it extrude towards the center of the shape instead, by setting a negative thickness.
</p>
<p>
    To disable the outline, set its thickness to 0. If you only want the outline, you can set the fill color to <code>sf::Color::Transparent</code>.
</p>

<h3>Texture</h3>
<p>
    Shapes can also be textured, just like sprites. To specify a part of the texture to be mapped to the shape, you must use the <code>setTextureRect</code> function.
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
    It is important to know that the texture is modulated (multiplied) with the shape's fill color. If its fill color is sf::Color::White, the texture will appear unmodified.<br/>
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
    To draw rectangles, you can use the <?php class_link('RectangleShape') ?> class. It has a single attribute: The size of the rectangle.
</p>
<pre><code class="cpp">// define a 120x50 rectangle
sf::RectangleShape rectangle(sf::Vector2f(120.f, 50.f));

// change the size to 100x100
rectangle.setSize(sf::Vector2f(100.f, 100.f));
</code></pre>
<img class="screenshot" src="./images/graphics-shape-rectangle.png" alt="A rectangle shape"/>

<h3>Circles</h3>
<p>
    Circles are represented by the <?php class_link('CircleShape') ?> class. It has two attributes: The radius and the number of sides. The number of sides is an optional
    attribute, it allows you to adjust the "quality" of the circle: Circles have to be approximated by polygons with many sides (the graphics card is unable to draw a perfect
    circle directly), and this attribute defines how many sides your circle approximation will have. If you draw small circles, you'll probably only need a few sides. If you draw big
    circles, or zoom on regular circles, you'll most likely need more sides.
</p>
<pre><code class="cpp">// define a circle with radius = 200
sf::CircleShape circle(200.f);

// change the radius to 40
circle.setRadius(40.f);

// change the number of sides (points) to 100
circle.setPointCount(100);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-circle.png" alt="A circle shape"/>

<h3>Regular polygons</h3>
<p>
    There's no dedicated class for regular polygons, in fact you can represent a regular polygon with any number of sides using the <?php class_link('CircleShape') ?> class:
    Since circles are approximated by polygons with many sides, you just have to play with the number of sides to get the desired polygons. A <?php class_link('CircleShape') ?>
    with 3 points is a triangle, with 4 points it's a square, etc.
</p>
<pre><code class="cpp">// define a triangle
sf::CircleShape triangle(80.f, 3);

// define a square
sf::CircleShape square(80.f, 4);

// define an octagon
sf::CircleShape octagon(80.f, 8);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-regular.png" alt="Regular polygons"/>

<h3>Convex shapes</h3>
<p>
    The <?php class_link('ConvexShape') ?> class is the ultimate shape class: It allows you to define any <em>convex</em> shape. SFML is unable to draw
    concave shapes. If you need to draw a concave shape, you'll have to split it into multiple convex polygons.
</p>
<p>
    To construct a convex shape, you must first set the number of points it should have and then define the points.
</p>
<pre><code class="cpp">// create an empty shape
sf::ConvexShape convex;

// resize it to 5 points
convex.setPointCount(5);

// define the points
convex.setPoint(0, sf::Vector2f(0.f, 0.f));
convex.setPoint(1, sf::Vector2f(150.f, 10.f));
convex.setPoint(2, sf::Vector2f(120.f, 90.f));
convex.setPoint(3, sf::Vector2f(30.f, 100.f));
convex.setPoint(4, sf::Vector2f(0.f, 50.f));
</code></pre>
<p class="important">
    The order in which you define the points is very important. They must <em>all</em> be defined either in clockwise or counter-clockwise order. If you
    define them in an inconsistent order, the shape will be constructed incorrectly.
</p>
<img class="screenshot" src="./images/graphics-shape-convex.png" alt="A convex shape"/>
<p>
    Although the name of <?php class_link('ConvexShape') ?> implies that it should only be used to represent convex shapes, its requirements are a little more relaxed.
    In fact, the only requirement that your shape must meet is that if you went ahead and drew lines from its <em>center of gravity</em> to all of its points, these lines
    must be drawn in the same order. You are not allowed to "jump behind a previous line". Internally, convex shapes are automatically constructed using
    <a href="http://en.wikipedia.org/wiki/Triangle_fan" title="Go to Wikipedia's article about triangle fans">triangle fans</a>, so if your shape is representable
    by a triangle fan, you can use <?php class_link('ConvexShape') ?>. With this relaxed definition, you can draw stars using <?php class_link('ConvexShape') ?> for example.
</p>

<h3>Lines</h3>
<p>
    There's no shape class for lines. The reason is simple: If your line has a thickness, it is a rectangle. If it doesn't, it can be drawn with a line primitive.
</p>
<p>
    Line with thickness:
</p>
<pre><code class="cpp">sf::RectangleShape line(sf::Vector2f(150.f, 5.f));
line.rotate(45.f);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-rectangle.png" alt="A line shape drawn as a rectangle"/>
<p>
    Line without thickness:
</p>
<pre><code class="cpp">sf::Vertex line[] =
{
    sf::Vertex(sf::Vector2f(10.f, 10.f)),
    sf::Vertex(sf::Vector2f(150.f, 150.f))
};

window.draw(line, 2, sf::Lines);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-line-primitive.png" alt="A line shape drawn as a primitive"/>
<p>
    To learn more about vertices and primitives, you can read the tutorial on
    <a href="./graphics-vertex-array.php" title="'Vertex arrays' tutorial">vertex arrays</a>.
</p>

<?php h2('Custom shape types') ?>
<p>
    You can extend the set of shape classes with your own shape types. To do so, you must derive from <?php class_link('Shape') ?> and override two functions:
</p>
<ul>
    <li><code>getPointCount</code>: return the number of points in the shape</li>
    <li><code>getPoint</code>: return a point of the shape</li>
</ul>
<p>
    You must also call the <code>update()</code> protected function whenever any point in your shape changes, so that the base class is informed and can update
    its internal geometry.
</p>
<p>
    Here is a complete example of a custom shape class: EllipseShape.
</p>
<pre><code class="cpp">class EllipseShape : public sf::Shape
{
public :

    explicit EllipseShape(const sf::Vector2f&amp; radius = sf::Vector2f(0.f, 0.f)) :
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

    virtual std::size_t getPointCount() const
    {
        return 30; // fixed, but could be an attribute of the class if needed
    }

    virtual sf::Vector2f getPoint(std::size_t index) const
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
    There's no option to anti-alias a single shape. To get anti-aliased shapes (i.e. shapes with smoothed edges), you have to enable anti-aliasing globally when you
    create the window, with the corresponding attribute of the <?php struct_link('ContextSettings') ?> structure.
</p>
<pre><code class="cpp">sf::ContextSettings settings;
settings.antialiasingLevel = 8;

sf::RenderWindow window(sf::VideoMode(800, 600), "SFML shapes", sf::Style::Default, settings);
</code></pre>
<img class="screenshot" src="./images/graphics-shape-antialiasing.png" alt="Aliased vs antialiased shape"/>
<p>
    Remember that anti-aliasing availability depends on the graphics card: It might not support it, or have it forced to disabled in the driver settings.
</p>

<?php

    require("footer.php");

?>
