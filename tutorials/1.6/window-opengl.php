<?php

    $title = "Using OpenGL";
    $page = "window-opengl.php";

    require("header.php");
?>

<h1>Using OpenGL</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is not about OpenGL, but only the way to use SFML window package to interface with OpenGL.
    As you know, one of the most important feature of OpenGL is portability. However, OpenGL requires
    you to create a rendering context first. And rendering context is all but portable ; each operating system
    as its own way to create it. That's why people usually use a portable library to get a portable
    windowing / event system that will be able to run OpenGL under every system. Most famous libraries for
    doing so are SDL and GLUT, but they are written in C and not always convenient to use in C++, especially
    if you have an object-oriented approach. They also lack essential features, like being usable
    in multiple windows or in existing interfaces.
</p>

<?php h2('Initialization') ?>
<p>
    To use OpenGL, you only have to include Window.hpp : the OpenGL and GLU headers will be automatically included by
    it. This is to prevent you from having to use preprocessor, as OpenGL headers have different names on each
    operating system.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
</code></pre>
<p>
    No extra step is requiered for SFML initialization when you want to use OpenGL. So let's create
    a window as we learnt before :
</p>
<pre><code class="cpp">sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL");
</code></pre>
<p>
    If you want more control on the OpenGL context creation, you can pass an additional structure when creating the window,
    which contains extra graphics settings like depth buffer, stencil buffer and antialiasing. The structure to use
    is <code>WindowSettings</code> :
</p>
<pre><code class="cpp">sf::WindowSettings Settings;
Settings.DepthBits         = 24; // Request a 24 bits depth buffer
Settings.StencilBits       = 8;  // Request a 8 bits stencil buffer
Settings.AntialiasingLevel = 2;  // Request 2 levels of antialiasing
sf::Window App(sf::VideoMode(800, 600, 32), "SFML OpenGL", sf::Style::Close, Settings);
</code></pre>
<p>
    Every member of the <code>WindowSettings</code> structure has a proper default value, so you can only specify
    the settings you care about. Depending on the hardware configuration, the requested settings may not all be available.
    In this case, SFML will choose the closest settings supported by the machine. To know what has actually been chosen,
    you can get the window configuration back :
</p>
<pre><code class="cpp">sf::WindowSettings Settings = App.GetSettings();
</code></pre>
<p>
    Once a window is created, we have a valid rendering context. So this is a good time for doing our
    OpenGL specific initializations. Here we setup a perspective view with Z-Buffer enabled :
</p>
<pre><code class="cpp">// Set color and depth clear value
glClearDepth(1.f);
glClearColor(0.f, 0.f, 0.f, 0.f);

// Enable Z-buffer read and write
glEnable(GL_DEPTH_TEST);
glDepthMask(GL_TRUE);

// Setup a perspective projection
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluPerspective(90.f, 1.f, 1.f, 500.f);
</code></pre>
<p>
    All OpenGL contexts are shared, this means that you can create a texture while WindowA is active, and
    use it to draw things in WindowB.
</p>

<?php h2('Main loop - drawing a cube') ?>
<p>
    Main loop starts as before, with event processing :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Some code for stopping application on close or when escape is pressed...
    }
</code></pre>
<p>
    But here we have to handle one more event : <code>Resized</code>. This is because when
    window size changes, we have to adjust the OpenGL viewport to match the new size. Viewport is the area
    of the window where the scene will be displayed, so if you don't adjust it to fit the new window size,
    your scene will display in a small sub-rectangle of the window.
</p>
<pre><code class="cpp">if (Event.Type == sf::Event::Resized)
    glViewport(0, 0, Event.Size.Width, Event.Size.Height);
</code></pre>
<p>
    You can now start rendering a new frame. Before calling any OpenGL command, you have to make sure
    that the proper window is active. Here we don't care because we have only one window, but if you handle
    multiple SFML windows you must take this in account. To make a window active, you can call
    its <code>SetActive</code> function :
</p>
<pre><code class="cpp">App.SetActive();
</code></pre>
<p>
    Then, the first thing to do is to clear the color and depth buffers to erase previous frame's content :
</p>
<pre><code class="cpp">glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
</code></pre>
<p>
    We are now ready to draw a cube. First, we define its position and orientation. Orientation will
    change according to the current time, to add a little bit of motion.
</p>
<pre><code class="cpp">glMatrixMode(GL_MODELVIEW);
glLoadIdentity();
glTranslatef(0.f, 0.f, -200.f);
glRotatef(Clock.GetElapsedTime() * 50, 1.f, 0.f, 0.f);
glRotatef(Clock.GetElapsedTime() * 30, 0.f, 1.f, 0.f);
glRotatef(Clock.GetElapsedTime() * 90, 0.f, 0.f, 1.f);
</code></pre>
<p>
    Then we draw the cube :
</p>
<pre><code class="cpp">glBegin(GL_QUADS);

    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f(-50.f,  50.f, -50.f);
    glVertex3f( 50.f,  50.f, -50.f);
    glVertex3f( 50.f, -50.f, -50.f);

    glVertex3f(-50.f, -50.f, 50.f);
    glVertex3f(-50.f,  50.f, 50.f);
    glVertex3f( 50.f,  50.f, 50.f);
    glVertex3f( 50.f, -50.f, 50.f);

    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f(-50.f,  50.f, -50.f);
    glVertex3f(-50.f,  50.f,  50.f);
    glVertex3f(-50.f, -50.f,  50.f);

    glVertex3f(50.f, -50.f, -50.f);
    glVertex3f(50.f,  50.f, -50.f);
    glVertex3f(50.f,  50.f,  50.f);
    glVertex3f(50.f, -50.f,  50.f);

    glVertex3f(-50.f, -50.f,  50.f);
    glVertex3f(-50.f, -50.f, -50.f);
    glVertex3f( 50.f, -50.f, -50.f);
    glVertex3f( 50.f, -50.f,  50.f);

    glVertex3f(-50.f, 50.f,  50.f);
    glVertex3f(-50.f, 50.f, -50.f);
    glVertex3f( 50.f, 50.f, -50.f);
    glVertex3f( 50.f, 50.f,  50.f);

glEnd();
</code></pre>
<p>
    Finally, we can end our main loop by displaying rendered frame on screen :
</p>
<pre><code class="cpp">App.Display();
</code></pre>
<p>
    And that's it, you should have a white rotating cube on a black background. As usual, no clean up
    is needed after main loop exits.
</p>

<?php h2('Conclusion') ?>
<p>
    Using OpenGL with SFML is straight-forward, and does not require extra step compared to regular SFML use.
    You can get a robust, portable and object-oriented OpenGL windowing system with only a few lines of
    code.
</p>
<p>
    You now know almost everything about the SFML window package. You have learned how to install SFML API,
    open a window, handle properly inputs, events and time, and interfacing with OpenGL. You can now
    jump to <a class="internal" href="./index.php" title="Go back to tutorials index">another section</a> to learn a new package.
</p>

<?php

    require("footer.php");

?>
