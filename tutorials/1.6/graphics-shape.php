<?php

    $title = "Drawing simple shapes";
    $page = "graphics-shape.php";

    require("header.php");
?>

<h1>Drawing simple shapes</h1>

<?php h2('Introduction') ?>
<p>
    This new tutorial will teach you how to draw simple 2D shapes, such as lines, rectangles, circles or polygons with SFML.
</p>

<?php h2('Building custom shapes') ?>
<p>
    To build a custom shape with SFML, you have to use the
    <?php class_link("Shape")?>
    class.<br/>
    A shape is basically a convex polygon, in which each point can have its own position and color. You can also
    add an automatic outline to a shape, each point having the ability to define its own color for the outline.<br/>
    It is important to define the points of a shape in order (clockwise or counter-clockwise), otherwise the
    shape may be ill-formed. It is also important to keep the shape convex, otherwise it won't be rendered properly.
    It you want to draw concave shapes, try to split them into several convex sub-shapes.
</p>
<p>
    To add a new point to a shape, use the <code>AddPoint</code> function :
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
    The parameters are the X and Y coordinates of the point, its color, and an optional color for outline.
    Note that you can also pass a <?php class_link("Vector2f")?> instead of two floats for the position of the point.
</p>
<p>
    Once added to the shape, the points' attributes (position, color and outline) can be read or written individually
    with these accessors :
</p>
<pre><code class="cpp">// Get the attributes of the third point
sf::Vector2f Position     = Polygon.GetPointPosition(2);
sf::Color    Color        = Polygon.GetPointColor(2);
sf::Color    OutlineColor = Polygon.GetPointOutlineColor(2);

// Set the attributes of the second point
Polygon.SetPointPosition(1, sf::Vector2f(50, 100));
Polygon.SetPointColor(1, sf::Color::Black);
Polygon.SetPointOutlineColor(1, sf::Color(0, 128, 128));
</code></pre>
<p>
    To control the outline width of the whole shape, use the <code>SetOutlineWidth</code> function :
</p>
<pre><code class="cpp">// Set an outline width of 10
Polygon.SetOutlineWidth(10);
</code></pre>
<p>
    Ok nice, we now have a shape with an outline. But what if we just want to draw its outline without filling it ?
    Or remove this outline ? There are two functions to enable or disable filling and drawing the outline :
</p>
<pre><code class="cpp">// Disable filling the shape
Polygon.EnableFill(false);

// Enable drawing its outline
Polygon.EnableOutline(true);
</code></pre>
<p>
    Like every drawable object in SFML, shape objects inherit the common functions to set their position, rotation,
    scale, color and blending mode.
</p>
<pre><code class="cpp">Polygon.SetColor(sf::Color(255, 255, 255, 200));
Polygon.Move(300, 300);
Polygon.Scale(3, 2);
Polygon.Rotate(45);
</code></pre>
<p>
    Finally, drawing a shape is also like any other drawable object in SFML :
</p>
<pre><code class="cpp">App.Draw(Polygon);
</code></pre>

<?php h2('Predefined shapes') ?>
<p>
    SFML provides helper static functions to create simple shapes such as lines, rectangles and circles :
</p>
<pre><code class="cpp">sf::Shape Line   = sf::Shape::Line(X1, Y1, X2, Y2, Thickness, Color, [Outline], [OutlineColor]);
sf::Shape Circle = sf::Shape::Circle(X, Y, Radius, Color, [Outline], [OutlineColor]);
sf::Shape Rect   = sf::Shape::Rectangle(X1, Y1, X2, Y2, Color, [Outline], [OutlineColor]);
</code></pre>
<p>
    The values for outline width and color are optional ; it's disabled by default.
</p>

<?php h2('Conclusion') ?>
<p>
    With this new class you'll now be able to draw simple rectangles, circles, or custom polygons without
    having to use an image and a sprite. Let's now have a look at something a bit more exciting :
    <a class="internal" href="./graphics-views.php" title="Jump to next tutorial">views</a>.
</p>

<?php

    require("footer.php");

?>
