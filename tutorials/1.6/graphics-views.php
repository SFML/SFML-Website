<?php

    $title = "Using views";
    $page = "graphics-views.php";

    require("header.php");
?>

<h1>Using views</h1>

<?php h2('Introduction') ?>
<p>
    In this tutorial, you'll learn how to use SFML 2D views. Views are like 2D cameras, which allow you to
    move, zoom or scroll without having to move or resize the whole scene.
</p>

<?php h2('Defining a new view') ?>
<p>
    Views are defined by the <?php class_link("View")?> class, which is basically a 2D rectangle nicely wrapped in a
    camera-like interface.
</p>
<p>
    A view can be created either with a center point and a half-size, or directly from a bounding rectangle :
</p>
<pre><code class="cpp">sf::Vector2f Center(1000, 1000);
sf::Vector2f HalfSize(400, 300);
sf::View View1(Center, HalfSize);

// Or

sf::View View2(sf::FloatRect(600, 700, 1400, 1300));
</code></pre>
<p>
    All these parameters can be set and get at any time using the accessors :
</p>
<pre><code class="cpp">View.SetCenter(500, 300);
View.SetHalfSize(200, 100);

// Or

View.SetFromRect(sf::FloatRect(300, 200, 700, 400));
</code></pre>
<pre><code class="cpp">sf::Vector2f  Center    = View.GetCenter();
sf::Vector2f  HalfSize  = View.GetHalfSize();
sf::FloatRect Rectangle = View.GetRect();
</code></pre>
<p>
    There are also two helper functions to move or zoom (resize) the view :
</p>
<pre><code class="cpp">View.Move(10, -5); // Move the view of (10, -5) units
View.Zoom(0.5f);   // Zoom by a factor of 1/2 (ie. unzoom to make the view twice larger)
</code></pre>
<p>
    As you can see there's nothing complicated here, only a few functions to control the view's position and size.
</p>

<?php h2('Using a view') ?>
<p>
    To use a view, you need to call the <code>SetView</code> function of the <?php class_link("RenderWindow")?> class :
</p>
<pre><code class="cpp">// Use our custom view
App.SetView(View);
</code></pre>
<p>
    Any object drawn after the call to <code>SetView</code> (and before the next one) will be affected by the view.<br/>
    Once set, the render window keeps a link to the view so you can update it without calling <code>SetView</code> again,
    all your modifications will be automatically taken in account.
</p>
<p>
    Every render window has a default view, which always matches the initial size of the window. You can access this view,
    and even modify it if needed, with the <code>GetDefaultView</code> function :
</p>
<pre><code class="cpp">sf::View& DefaultView = App.GetDefaultView();
</code></pre>
<p>
    The default view is not updated when its window is resized : as a consequence, what's visible in your
    window will never be affected by its size (ie. you won't see more if you maximize the window), which is exactly
    what happens with a 3D camera.<br/>
    However, you can easily setup a view which always keeps the same dimension as the window, by catching the
    <code>sf::Event::Resized</code> event and updating the view accordingly.
</p>
<p>
    Accessing the default view is also convenient to go back to the initial view. For example, it can be
    useful if you want to draw a user interface on top of the game, which usually doesn't follow the camera.
</p>
<pre><code class="cpp">App.SetView(View);

// Draw the game...

App.SetView(App.GetDefaultView());

// Draw the interface...
</code></pre>

<?php h2('Window coordinates and view coordinates') ?>
<p>
    When a custom view is set, or when your window has been resized, don't forget that objects coordinates no longer match the window pixels, be careful to
    handle conversions if needed (for example, when you test the mouse position with the sprites' rectangles).
    Always remember that what you actually see is the view rectangle, not the window one.
</p>
<p>
    If you want to convert window coordinates to view coordinates, probably after a mouse clic, you can use the
    <code>RenderWindow::ConvertCoords</code> function :
</p>
<pre><code class="cpp">// Get the cursor position in view coordinates
sf::Vector2f MousePos = App.ConvertCoords(App.GetInput().GetMouseX(), App.GetInput().GetMouseY());
</code></pre>
<p>
    By default, this function uses the view currently set in the window to perform the conversion. However, you can use
    any other view by passing its address as the third parameter (which is <code>NULL</code> by default).</p>

<?php h2('Conclusion') ?>
<p>
    2D views provide an easy and convenient way to deal with effects such as scrolling and zooming, with no
    performances penalty. The only thing to take care of when using views, is the possible conversions that
    could be needed if you try to map pixels to coordinates.
</p>

<?php

    require("footer.php");

?>
