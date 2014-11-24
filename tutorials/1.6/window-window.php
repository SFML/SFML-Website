<?php

    $title = "Opening a window";
    $page = "window-window.php";

    require("header.php");
?>

<h1>Opening a window</h1>

<?php h2('Introduction') ?>
<p>
    In this tutorial, we will learn how to use SFML window package as a minimal windowing system, like
    SDL or GLUT.
</p>

<?php h2('Preparing the code') ?>
<p>
    First, you have to include the header needed for the window package :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    This header is the only one needed, as it includes all other headers contained in the window package.
    This is the case for other packages too : if you want to use package xxx, you just have to include
    &lt;SFML/xxx.hpp&gt; header file.
</p>
<p>
    Then, you have to define the well known <code>main</code> function :
</p>
<pre><code class="cpp">int main()
{
    // Our code will go here
}
</code></pre>
<p>
    Or, if you want to get command-line arguments :
</p>
<pre><code class="cpp">int main(int argc, char** argv)
{
    // Our code will go here
}
</code></pre>
<p>
    Under Windows operating systems, you may have created a "Windows Application" project, especially
    if don't want the console to show up. In such case, to avoid replacing <code>main</code>
    by <code>WinMain</code>, you can link with SFML_Main static library and keep a standard
    and portable <code>main</code> entry point.
</p>

<?php h2('Opening the window') ?>
<p>
    The next step is to open a window. Windows in SFML are defined by the <?php class_link("Window")?>
    class. This class provides some useful constructors to create directly our window. The interesting one
    here is the following :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    Here we create a new variable named <code>App</code>, that will represent our new window.
    Let's explain the parameters :
</p>
<ul>
    <li>The first parameter is a <?php class_link("VideoMode")?>, which represents the chosen video mode
    for the window. Here, size is 800x600 pixels, with a depth of 32 bits per pixel. Note that the
    specified size will be the internal area of the window, excluding the titlebar and the borders.</li>
    <li>The second parameter is the window title, of type <code>std::string</code></li>
</ul>
<p>
    If you want to create your window later, or recreate it with different parameters, you can use its
    <code>Create</code> function :
</p>
<pre><code class="cpp">App.Create(sf::VideoMode(800, 600, 32), "SFML Window");
</code></pre>
<p>
    The constructors and <code>Create</code> functions also accept two optional additionnal parameters : the first one
    to have more control over the window's style, and the second to set more advanced graphics options ; we'll come
    back to this one in another tutorial, beginners usually don't have to care about it.<br/>
    The style parameter can be a combination of the <code>sf::Style</code> flags, which are
    <code>None</code>, <code>Titlebar</code>, <code>Resize</code>, <code>Close</code> and <code>Fullscreen</code>. The default style is
    <code>Resize | Close</code>.
</p>
<pre><code class="cpp">// This creates a fullscreen window
App.Create(sf::VideoMode(800, 600, 32), "SFML Window", sf::Style::Fullscreen);
</code></pre>

<?php h2('Video modes') ?>
<p>
    In the example above, we don't care about the video mode because we run in windowed mode ; any
    size will be ok. But if we'd like to run in fullscreen mode, only a few modes would be allowed.
    <?php class_link("VideoMode")?> provides an interface for getting all supported video modes,
    with the two static functions <code>GetModesCount</code> and <code>GetMode</code> :
</p>
<pre><code class="cpp">unsigned int VideoModesCount = sf::VideoMode::GetModesCount();
for (unsigned int i = 0; i &lt; VideoModesCount; ++i)
{
    sf::VideoMode Mode = sf::VideoMode::GetMode(i);

    // Mode is a valid video mode
}
</code></pre>
<p>
    Note that video modes are ordered from highest to lowest, so that
    <code>sf::VideoMode::GetMode(0)</code> will always
    return the best video mode supported.
</p>
<pre><code class="cpp">// Creating a fullscreen window with the best video mode supported
App.Create(sf::VideoMode::GetMode(0), "SFML Window", sf::Style::Fullscreen);
</code></pre>
<p>
    If you get video modes with the code above then they will all be valid, but there are cases
    where you get a video mode from somewhere else, a configuration file for example. In such case, you
    can check the validity of a mode with its function <code>IsValid()</code> :
</p>
<pre><code class="cpp">sf::VideoMode Mode = ReadModeFromConfigFile();
if (!Mode.IsValid())
{
    // Error...
}
</code></pre>
<p>
    You can also get the current desktop video mode, with the <code>GetDesktopMode</code>
    function :
</p>
<pre><code class="cpp">sf::VideoMode DesktopMode = sf::VideoMode::GetDesktopMode();
</code></pre>

<?php h2('The main loop') ?>
<p>
    Once our window has been created, we can enter the main loop :
</p>
<pre><code class="cpp">bool Running = true;
while (Running)
{
    App.Display();
}

return EXIT_SUCCESS;
</code></pre>
<p>
    To end the main loop and then close the application, you just have to set the
    variable <code>Running</code> to <code>false</code>. Typically this
    is done when the window is closed, or when the user presses a special key like escape ; we'll see
    how to catch these events in the next tutorial.
</p>
<p>
    So far, our main loop only calls <code>App.Display()</code>. This is actually the only
    call needed to display the contents of our window to the screen. Call to <code>Display</code>
    should always happen once in the main loop, and be the last instruction, once everything else has
    been updated and drawn.<br/>
    At this point, you may see anything on the screen (maybe black color, maybe not) as we don't
    draw anything into our window.
</p>
<p>
    As you can see, there is no more code after the main loop : our window is correctly destroyed
    automatically when <code>main</code> function ends (clean-up is done in its destructor).<br/>
    For those who never use <code>EXIT_SUCCESS</code>, it is just a constant defined to 0.
    To return an error you can use its sister <code>EXIT_FAILURE</code> instead of -1.
</p>

<?php h2('Conclusion') ?>
<p>
    And that's it, with this code you have a complete minimal program that opens an SFML window.
    But we cannot stop our program yet... so let's jump to
    <a class="internal" href="./window-events.php" title="Next tutorial : handling events">the next tutorial</a>, to see how to catch events !
</p>

<?php

    require("footer.php");

?>
