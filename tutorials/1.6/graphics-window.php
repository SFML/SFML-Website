<?php

    $title = "Using render windows";
    $page = "graphics-window.php";

    require("header.php");
?>

<h1>Using render windows</h1>

<?php h2('Introduction') ?>
<p>
    Window package provides a complete system for handling windows and events, an can interface with OpenGL.
    But what if we don't want to use OpenGL ? SFML provides a package dedicated to 2D graphics, the
    graphics package.
</p>

<?php h2('Setup') ?>
<p>
    To work with the graphics package, you have to include the correct header :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
</code></pre>
<p>
    SFML/Window.hpp is no more explicitly requiered, as it is already included by the graphics package.
</p>

<?php h2('The rendering window') ?>
<p>
    SFML base window, <?php class_link("Window")?>, is enough for getting a window and its events,
    but has no idea of how to draw something. In fact you won't be able to display anything from the
    graphics package into a <?php class_link("Window")?>. That's why the graphics package provides a
    window class containing more features and doing more redundant stuff for you :
    <?php class_link("RenderWindow")?>. As <?php class_link("RenderWindow")?> inherits from
    <?php class_link("Window")?>, it already contains all its features and acts exactly the same
    for creation, event handling, etc. All <?php class_link("RenderWindow")?> does is adding features
    for easily displaying graphics.
</p>
<p>
    In fact, a minimal application using graphics package would be exactly the same as if using the window
    package, except the type of the window :
</p>
<pre><code class="cpp">int main()
{
    // Create the main rendering window
    sf::RenderWindow App(sf::VideoMode(800, 600, 32), "SFML Graphics");
    
    // Start game loop
    while (App.IsOpened())
    {
        // Process events
        sf::Event Event;
        while (App.GetEvent(Event))
        {
            // Close window : exit
            if (Event.Type == sf::Event::Closed)
                App.Close();
        }

        // Clear the screen (fill it with black color)
        App.Clear();

        // Display window contents on screen
        App.Display();
    }

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    The only difference here is that we've added a call to <code>Clear</code>, so that the screen gets filled
    with black instead of remaining with random pixels.
</p>
<p>
    If you need to clear the screen with a different color, you can pass it as parameter :
</p>
<pre><code class="cpp">App.Clear(sf::Color(200, 0, 0));
</code></pre>
<p>
    SFML graphics package provides a useful class for manipulating colors : <?php class_link("Color")?>.
    Every color you'll have to handle in SFML will be a <?php class_link("Color")?>,
    you can forget 32-bits integers and float arrays.<br/>
    <?php class_link("Color")?> basically contains four 8-bits components :
    <code>r</code> (red), <code>g</code> (green), <code>b</code> (blue),
    and <code>a</code> (alpha -- for transparency) ; their values range from 0 to 255.<br/>
    <?php class_link("Color")?> provides some useful functions, operators and constructors, the one that
    interests us here is the one that takes the 4 components as parameters (the fourth one, alpha, has a
    default value of 255). So in the code above, we construct a <?php class_link("Color")?> with red component to 200,
    and green and blue components to 0. So... we obtain a red background for our window.
</p>
<p>
    Note that clearing the window is not actually needed if what you have to draw is going to cover the entire
    screen; do it only if you have some pixels which would remain undrawn.
</p>

<?php h2('Taking screenshots') ?>
<p>
    This is probably not the most important thing, but it's always useful. <?php class_link("RenderWindow")?>
    provides a function to save its contents into an image : <code>Capture</code>. Then you can easily save the image
    to a file with the <code>SaveToFile</code> function, or do whatever else you want.<br/>
    So, for example, we can take a screenshot when the user presses the F1 key :
</p>
<pre><code class="cpp">if (Event.Key.Code == sf::Key::F1)
{
    sf::Image Screen = App.Capture();
    Screen.SaveToFile("screenshot.jpg");
}
</code></pre>
<p>
    Of course, depending on the position of this line of code in the main loop, the captured image won't be the same.
    It will capture the current contents of the screen at the time you call <code>Capture</code>.
</p>

<?php h2('Mixing with OpenGL') ?>
<p>
    It is of course still possible to use custom OpenGL commands with a
    <?php class_link("RenderWindow")?>, as you would do with a <?php class_link("Window")?>.
    You can even mix SFML drawing commands and your own OpenGL ones. However, SFML doesn't preserve OpenGL states
    by default. If SFML messes up with your OpenGL states and you want it to take care of
    saving / resetting / restoring them, you have to call the <code>PreserveOpenGLStates</code> function :
</p>
<pre><code class="cpp">App.PreserveOpenGLStates(true);
</code></pre>
<p>
    Preserving OpenGL states is very CPU consuming and will degrade performances, use it only if you really need it. Also
    consider using your own code to manage the states you need to preserve, as it will be more efficient than
    the generic SFML code which takes care of every state, even the ones you don't care about.
</p>

<?php h2('Conclusion') ?>
<p>
    There's not much more to say about render windows. They just act like base windows, adding some
    features to allow easy 2D rendering. More features will be explained in the next tutorials, begining with
    <a class="internal" href="./graphics-sprite.php" title="Go to next tutorial">sprite rendering</a>.
</p>

<?php

    require("footer.php");

?>
