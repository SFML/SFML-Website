<?php

    $title = "Integrating to a X11 interface";
    $page = "graphics-x11.php";

    require("header.php");
?>

<h1>Integrating to a X11 interface</h1>

<?php h2('Introduction') ?>
<p>
    In this new tutorial, we'll have a look at how SFML integrates into a X11 interface. If you are not
    familiar to Xlib programming you can first read a tutorial about it, as we won't explain it in
    this tutorial, only the way to put SFML into X11 windows.
</p>

<?php h2('X11 window creation') ?>
<p>
    First, we have to create a X11 interface. We'll create a main window, and one subwindow into which
    we'll display SFML graphics. The following piece of code is just regular X11 code, no SFML specific
    code is involved yet :
</p>
<pre><code class="cpp">// Open a connection with the X server
Display* Disp = XOpenDisplay(NULL);
if (!Disp)
    return EXIT_FAILURE;

// Get the default screen
int Screen = DefaultScreen(Disp);

// Let's create the main window
XSetWindowAttributes Attributes;
Attributes.background_pixel = BlackPixel(Disp, Screen);
Attributes.event_mask       = KeyPressMask;
Window Win = XCreateWindow(Disp, RootWindow(Disp, Screen),
                           0, 0, 650, 330, 0,
                           DefaultDepth(Disp, Screen),
                           InputOutput,
                           DefaultVisual(Disp, Screen),
                           CWBackPixel | CWEventMask, &amp;Attributes);
if (!Win)
    return EXIT_FAILURE;

// Set the window's name
XStoreName(Disp, Win, "SFML Window");

// Let's create the window which will serve as a container for our SFML view
Window View = XCreateWindow(Disp, Win,
                            10, 10, 310, 310, 0,
                            DefaultDepth(Disp, Screen),
                            InputOutput,
                            DefaultVisual(Disp, Screen),
                            0, NULL);

// Show our windows
XMapWindow(Disp, Win);
XMapWindow(Disp, View);
XFlush(Disp);
</code></pre>

<?php h2('Defining a SFML view') ?>
<p>
    Once all interface components are created, we can define our SFML view. To do so, we just construct
    a <?php class_link("RenderWindows")?> instance with the subwindow identifier :
</p>
<pre><code class="cpp">sf::RenderWindow SFMLView(View);

// Or, if you want to do it after construction :

SFMLView.Create(View);
</code></pre>
<p>
    And that's it, you have one SFML rendering window that will display SFML graphics into the specified
    interface window.
</p>

<?php h2('The main loop') ?>
<p>
    The event loop is a regular X11 loop :
</p>
<pre><code class="cpp">bool IsRunning = true;
while (IsRunning)
{
    while (XPending(Disp))
    {
        // Process the next pending event
        XEvent Event;
        XNextEvent(Disp, &amp;Event);
        switch (Event.type)
        {
            case KeyPress :
                IsRunning = false;
                break;
        }
    }

    // Our SFML rendering code goes here :
    // ...
}
</code></pre>
<p>
    Then we can insert our SFML code :
</p>
<pre><code class="cpp">// Clear the view
SFMLView.Clear();

// Draw a sprite
SFMLView.Draw(Sprite);

// Display the view on screen
SFMLView.Display();
</code></pre>
<p>
    Don't forget to clean up X11 resources before exiting the application :
</p>
<pre><code class="cpp">// Close the display
XCloseDisplay(Disp);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Integrating SFML into a X11 interface is not complicated, and if you are used to X11
    programming it won't require more effort than any other SFML application.<br/>
    Let's now have a look at integration into
    <a class="internal" href="./graphics-wxwidgets.php" title="Go to next tutorial">wxWidgets interfaces</a>.
</p>

<?php

    require("footer.php");

?>
