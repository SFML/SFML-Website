<?php

    $title = "Drawing 2D stuff";
    $page = "graphics-draw.php";

    require("header.php");

?>

<h1>Drawing 2D stuff</h1>

<?php h2('Introduction') ?>
<p>
    As you learnt in the previous tutorials, SFML's window module provides an easy way to open an OpenGL window and handle its events, but it
    doesn't help when it comes to drawing something. The only option which is left to you is to use the powerful, yet complex and low level OpenGL API.
</p>
<p>
    Fortunately, SFML provides a graphics module which will help you draw 2D entities in a much simpler way than with OpenGL.
</p>

<?php h2('The drawing window') ?>
<p>
    To draw the entities provided by the graphics module, you must use a specialized window class: <?php class_link("RenderWindow") ?>. This class is derived
    from <?php class_link("Window") ?>, and inherits all its functions. Everything that you've learnt about <?php class_link("Window") ?> (creation, event handling,
    controlling the framerate, mixing with OpenGL, etc.) is applicable to <?php class_link("RenderWindow") ?> as well.
</p>
<p>
    On top of that, <?php class_link("RenderWindow") ?> adds high-level functions to help you draw things easily. In this tutorial we'll focus on two
    of these functions: <code>clear</code> and <code>draw</code>. They are as simple as their name implies: <code>clear</code> clears the whole window with
    the chosen color, and <code>draw</code> draws whatever object you pass to it.
</p>
<p>
    Here is what a typical main loop looks like with a render window:
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;

int main()
{
    // create the window
    sf::RenderWindow window(sf::VideoMode(800, 600), "My window");

    // run the program as long as the window is open
    while (window.isOpen())
    {
        // check all the window's events that were triggered since the last iteration of the loop
        sf::Event event;
        while (window.pollEvent(event))
        {
            // "close requested" event: we close the window
            if (event.type == sf::Event::Closed)
                window.close();
        }

        // clear the window with black color
        window.clear(sf::Color::Black);

        // draw everything here...
        // window.draw(...);

        // end the current frame
        window.display();
    }

    return 0;
}
</code></pre>
<p>
    Calling <code>clear</code> before drawing anything is mandatory, otherwise the contents from previous frames will be present behind anything you draw. The only exception is
    when you cover the entire window with what you draw, so that no pixel is not drawn to. In this case you can avoid calling <code>clear</code> (although
    it won't have a noticeable impact on performance).
</p>
<p>
    Calling <code>display</code> is also mandatory, it takes what was drawn since the last call to <code>display</code> and displays it on the window.
    Indeed, things are not drawn directly to the window, but to a hidden buffer. This buffer is then copied to the window when you call <code>display</code>
    -- this is called <em>double-buffering</em>.
</p>
<p class="important">
    This clear/draw/display cycle is the only good way to draw things. Don't try other strategies, such as keeping pixels from the previous frame,
    "erasing" pixels, or drawing once and calling display multiple times. You'll get strange results due to double-buffering.<br/>
    Modern graphics hardware and APIs are <em>really</em> made for repeated clear/draw/display cycles where everything is completely refreshed at each iteration of
    the main loop. Don't be scared to draw 1000 sprites 60 times per second, you're far below the millions of triangles that your computer can handle.
</p>

<?php h2('What can I draw now?') ?>
<p>
    Now that you have a main loop which is ready to draw, let's see what, and how, you can actually draw there.
</p>
<p>
    SFML provides four kinds of drawable entities: three of them are ready to be used (<em>sprites</em>, <em>text</em> and <em>shapes</em>), the last
    one is the building block that will help you create your own drawable entities (<em>vertex arrays</em>).
</p>
<p>
    Although they share some common properties, each of these entities come with their own nuances and are therefore explained in dedicated tutorials:
</p>
<ul>
    <li><a href="./graphics-sprite.php" title="Learn how to create and draw sprites">Sprite tutorial</a></li>
    <li><a href="./graphics-text.php" title="Learn how to create and draw text">Text tutorial</a></li>
    <li><a href="./graphics-shape.php" title="Learn how to create and draw shapes">Shape tutorial</a></li>
    <li><a href="./graphics-vertex-array.php" title="Learn how to create and draw vertex arrays">Vertex array tutorial</a></li>
</ul>

<?php h2('Off-screen drawing') ?>
<p>
    SFML also provides a way to draw to a texture instead of directly to a window. To do so, use a <?php class_link("RenderTexture") ?> instead of a
    <?php class_link("RenderWindow") ?>. It has the same functions for drawing, inherited from their common base: <?php class_link("RenderTarget") ?>.
</p>
<pre><code class="cpp">// create a 500x500 render-texture
sf::RenderTexture renderTexture;
if (!renderTexture.create(500, 500))
{
    // error...
}

// drawing uses the same functions
renderTexture.clear();
renderTexture.draw(sprite); // or any other drawable
renderTexture.display();

// get the target texture (where the stuff has been drawn)
const sf::Texture&amp; texture = renderTexture.getTexture();

// draw it to the window
sf::Sprite sprite(texture);
window.draw(sprite);
</code></pre>
<p>
    The <code>getTexture</code> function returns a read-only texture, which means that you can only use it, not modify it. If you need to modify it before using it,
    you can copy it to your own <?php class_link("Texture") ?> instance and modify that instead.
</p>
<p>
    <?php class_link("RenderTexture") ?> also has the same functions as <?php class_link("RenderWindow") ?> for handling views and OpenGL (see the corresponding tutorials
    for more details). If you use OpenGL to draw to the render-texture, you can request creation of a depth buffer by using the third optional argument of the <code>create</code>
    function.
</p>
<pre><code class="cpp">renderTexture.create(500, 500, true); // enable depth buffer
</code></pre>

<?php h2('Drawing from threads') ?>
<p>
    SFML supports multi-threaded drawing, and you don't even have to do anything to make it work. The only thing to remember is to deactivate a window before using it in
    another thread. That's because a window (more precisely its OpenGL context) cannot be active in more than one thread at the same time.
</p>
<pre><code class="cpp">void renderingThread(sf::RenderWindow* window)
{
    // activate the window's context
    window->setActive(true);

    // the rendering loop
    while (window->isOpen())
    {
        // draw...

        // end the current frame
        window->display();
    }
}

int main()
{
    // create the window (remember: it's safer to create it in the main thread due to OS limitations)
    sf::RenderWindow window(sf::VideoMode(800, 600), "OpenGL");

    // deactivate its OpenGL context
    window.setActive(false);

    // launch the rendering thread
    sf::Thread thread(&amp;renderingThread, &amp;window);
    thread.launch();

    // the event/logic/whatever loop
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
</code></pre>
<p>
    As you can see, you don't even need to bother with the activation of the window in the rendering thread, SFML does it automatically for you whenever it needs to be done.
</p>
<p>
    Remember to always create the window and handle its events in the main thread for maximum portability. This is explained in the
    <a href="./window-window.php" title="Window tutorial">window tutorial</a>.
</p>

<?php

    require("footer.php");

?>
