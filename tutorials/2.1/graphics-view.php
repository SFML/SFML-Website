<?php

    $title = "Controlling the 2D camera with views";
    $page = "graphics-view.php";

    require("header.php");

?>

<h1>Controlling the 2D camera with views</h1>

<?php h2('What is a view?') ?>
<p>
    In a game, it is common that a level is bigger than the window, what you see is only a small part of it. This is the case for RPGs, platform games, and many more.
    What developers tend to forget is that they define entities <em>in a 2D world</em>, not directly in the window. The window is just a view, it shows a specific area
    of the whole world. You could perfectly draw several views of the same world in parallel, or draw the world to a texture rather than to a window; the world itself is
    still the same, what changes is just the way it is seen.
</p>
<p>
    Since the window only sees a small part of the entire 2D world, you need a way to specify which part of the world is shown in the window. Additionally, you may also
    want to define where/how this area will be shown in the window. These are the two main features of SFML views.
</p>
<p>
    To summarize, views are what you need if you want to scroll, rotate or zoom your world. They are also the key in creating split screens and mini-maps.
</p>

<?php h2('Defining what the view views') ?>
<p>
    The class which encapsulates views in SFML is <?php class_link('View') ?>. It can be constructed directly with a definition of the area to view:
</p>
<pre><code class="cpp">// create a view with the rectangular area of the 2D world to show
sf::View view1(sf::FloatRect(200, 200, 300, 200));

// create a view with its center and size
sf::View view2(sf::Vector2f(350, 300), sf::Vector2f(300, 200));
</code></pre>
<p>
    These two definitions are equivalent: both views will show the same area of the 2D world, a 300x200 rectangle centered on the point (350, 300).
</p>
<img class="screenshot" src="images/graphics-view-initial.png" title="A view" />
<p>
    If you don't want to define the view upon construction, or if you want to modify it later, you can use the equivalent setters:
</p>
<pre><code class="cpp">sf::View view1;
view1.reset(sf::FloatRect(200, 200, 300, 200));

sf::View view2;
view2.setCenter(sf::Vector2f(350, 300));
view2.setSize(sf::Vector2f(200, 200));
</code></pre>
<p>
    Once your view is defined you can transform it, to make it show a translated/rotated/scaled version of your 2D world.
</p>

<h3>Moving (scrolling) the view</h3>
<p>
    Unlike drawable entities such as sprites or shapes, whose position is defined by their top-left corner (and can be changed to any other point), views are
    always manipulated by their center -- this is more convenient. That's why the function to change the position of a view is named <code>setCenter</code>, and not
    <code>setPosition</code>.
</p>
<pre><code class="cpp">// move the view at point (200, 200)
view.setCenter(200, 200);

// move the view by an offset of (100, 100) (so its final position is (300, 300))
view.move(100, 100);
</code></pre>
<img class="screenshot" src="images/graphics-view-translated.png" title="A translated view" />

<h3>Rotating the view</h3>
<p>
    To rotate a view, use the <code>setRotation</code> function.
</p>
<pre><code class="cpp">// rotate the view at 20 degrees
view.setRotation(20);

// rotate the view by 5 degrees relatively to its current orientation (so its final orientation is 25 degrees)
view.rotate(5);
</code></pre>
<img class="screenshot" src="images/graphics-view-rotated.png" title="A rotated view" />

<h3>Zooming (scaling) the view</h3>
<p>
    Zooming (in or out) a view is equivalent to resizing it. So the function to use is <code>setSize</code>.
</p>
<pre><code class="cpp">// resize the view to show a 1200x800 area (we see a bigger area, so this is a zoom out)
view.setSize(1200, 800);

// zoom the view relatively to its current size (apply a factor 0.5, so its final size is 600x400)
view.zoom(0.5f);
</code></pre>
<img class="screenshot" src="images/graphics-view-scaled.png" title="A scaled view" />

<?php h2('Defining how the view is viewed') ?>
<p>
    Now that you've defined which part of the 2D world must be seen in the window, let's define <em>where</em> it is shown. By default, the viewed contents occupy
    the full window. If the view has the same size as the window, everything is rendered 1:1. If the view is smaller or bigger, then everything is scaled to fit in the
    window.
</p>
<p>
    This default behaviour is suitable in most situations, but it sometimes needs to be changed. For example, to split the screen in a multiplayer game, you may want to
    use two views which occupy only half of the window. You can also implement a minimap, by drawing your entire world to a view which is rendered in a small area in the
    corner of the window. The area where the contents of the view are shown is called the <em>viewport</em>.
</p>
<p>
    To define the viewport of a view, you must call the <code>setViewport</code> function.
</p>
<pre><code class="cpp">// define a centered viewport, with half the size of the window
view.setViewport(sf::FloatRect(0.25f, 0.25, 0.5f, 0.5f));
</code></pre>
<img class="screenshot" src="images/graphics-view-viewport.png" title="A viewport" />
<p>
    You probably noticed something very important: the viewport is not defined in pixels, but rather as a ratio of the window size. This is much more convenient: this way you
    don't have to track resize events to update the size of the viewport. It is also more intuitive: you will most likely need to define your viewport as a fraction of
    your window, not as a fixed-size rectangle.
</p>
<p>
    Using the viewport, it is straight-forward to split the screen for multiplayer games:
</p>
<pre><code class="cpp">// player 1 (left side of the screen)
player1View.setViewport(sf::FloatRect(0, 0, 0.5f, 1));

// player 2 (right side of the screen)
player2View.setViewport(sf::FloatRect(0.5f, 0, 0.5f, 1));
</code></pre>
<img class="screenshot" src="images/graphics-view-split-screen.png" title="A split screen" />

<p>
    ... or a mini-map:
</p>
<pre><code class="cpp">// the game view (full window)
gameView.setViewport(sf::FloatRect(0, 0, 1, 1));

// mini-map (upper-right corner)
minimapView.setViewport(sf::FloatRect(0.75f, 0, 0.25f, 0.25f));
</code></pre>
<img class="screenshot" src="images/graphics-view-minimap.png" title="A minimap" />

<?php h2('Using a view') ?>
<p>
    To draw something using a view, you must draw it after calling the <code>setView</code> function of the target where you're drawing
    (<?php class_link('RenderWindow') ?> or <?php class_link('RenderTexture') ?>).
</p>
<pre><code class="cpp">// let's define a view
sf::View view(sf::FloatRect(0, 0, 1000, 600));

// activate it
window.setView(view);

// draw something to that view
window.draw(some_sprite);

// want to do visibility checks? retrieve the view
sf::View currentView = window.getView();
...
</code></pre>
<p>
    The view remains active until you set another one. This means that there is always a view which defines what appears in the target, and where it is drawn.
    If you don't explicitly set any view, the render-target uses its own default view, which matches its size 1:1. You can get the default view of a render-target with the
    <code>getDefaultView</code> function. This can be useful if you want to define your own view based on it, or restore it to draw fixed entities (like a GUI) on top
    of your scene.
</p>
<pre><code class="cpp">// create a view half the size of the default view
sf::View view = window.getDefaultView();
view.zoom(0.5f);
window.setView(view);

// restore the default view
window.setView(window.getDefaultView());
</code></pre>
<p class="important">
    When you call <code>setView</code>, the render-target keeps a <em>copy</em> of the view, not a pointer to the original one. So whenever you update your view, you need
    to call <code>setView</code> again to apply the modifications.<br />
    Don't be afraid to copy views or to create them on the fly, they are lightweight objects (they just hold a few floats).
</p>

<?php h2('Showing more when the window is resized') ?>
<p>
    Since the default view never changes after the window is created, the viewed contents are always the same. So when the window is resized, everything is squeezed/stretched
    to the new size.
</p>
<p>
    If, instead of this default behaviour, you'd like to show more/less stuff according to the new size of the window, all you have to do is to synchronize the size of the
    view to the size of the window.
</p>
<pre><code class="cpp">// the event loop
sf::Event event;
while (window.pollEvent(event))
{
    ...

    // catch the resize events
    if (event.type == sf::Event::Resized)
    {
        // update the view to the new size of the window
        sf::FloatRect visibleArea(0, 0, event.size.width, event.size.height);
        window.setView(sf::View(visibleArea));
    }
}
</code></pre>

<?php h2('Coordinates conversions') ?>
<p>
    When you use a custom view, or when you resize the window without using the code above, pixels of the target no longer match units of the 2D world. For example,
    clicking on pixel (10, 50) may hit the point (26.5, -84) of your world. You must use a conversion function to map your pixel coordinates to world coordinates:
    <code>mapPixelToCoords</code>.
</p>
<pre><code class="cpp">// get the current mouse position in the window
sf::Vector2i pixelPos = sf::Mouse::getPosition(window);

// convert it to world coordinates
sf::Vector2f worldPos = window.mapPixelToCoords(pixelPos);
</code></pre>
<p>
    By default, <code>mapPixelToCoords</code> uses the current view. If you want to convert the coordinates using view which is not the active one, you can pass it as an
    additional argument to the function.
</p>
<p>
    The inverse, converting world coordinates to pixel coordinates, is also possible with the <code>mapCoordsToPixel</code> function.
</p>

<?php

    require("footer.php");

?>
