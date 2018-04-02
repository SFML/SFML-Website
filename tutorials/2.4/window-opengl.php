<?php

    $title = "Using OpenGL in a SFML window";
    $page = "window-opengl.php";

    require("header.php");

?>

<h1>Using OpenGL in a SFML window</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is not about OpenGL itself, but rather how to use SFML as an environment for OpenGL, and how to mix them together.
</p>
<p>
    As you know, one of the most important features of OpenGL is portability. But OpenGL alone won't be enough to create complete programs: you need
    a window, a rendering context, user input, etc. You would have no choice but to write OS-specific code to handle this stuff on your own.
    That's where the sfml-window module comes into play. Let's see how it allows you to play with OpenGL.
</p>

<?php h2('Including and linking OpenGL to your application') ?>
<p>
    OpenGL headers are not the same on every OS. Therefore, SFML provides an "abstract" header that takes care of including the right file for you.
</p>
<pre><code class="cpp">#include &lt;SFML/OpenGL.hpp&gt;
</code></pre>
<p>
    This header includes OpenGL functions, and nothing else. People sometimes think that SFML automatically includes OpenGL extension headers because SFML loads
    extensions itself, but it's an implementation detail. From the user's point of view, OpenGL extension loading must be handled like any other external library.
</p>
<p>
    You will then need to link your program to the OpenGL library. Unlike what it does with the headers, SFML can't provide a unified way of linking
    OpenGL. Therefore, you need to know which library to link to according to what operating system you're using ("opengl32" on Windows, "GL" on Linux, etc.).
</p>
<p class="important">
    OpenGL functions start with the "gl" prefix. Remember this when you get linker errors, it will help you find which library you forgot to link.
</p>

<?php h2('Creating an OpenGL window') ?>
<p>
    Since SFML is based on OpenGL, its windows are ready for OpenGL calls without any extra effort.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "OpenGL");

// it works out of the box
glEnable(GL_TEXTURE_2D);
...
</code></pre>
<p>
    In case you think it is <em>too</em> automatic, <?php class_link("Window") ?>'s constructor has an extra argument that allows you to change the settings
    of the underlying OpenGL context. This argument is an instance of the <?php struct_link("ContextSettings") ?> structure, it provides access to the following
    settings:
</p>
<ul>
    <li><code>depthBits</code> is the number of bits per pixel to use for the depth buffer (0 to disable it)</li>
    <li><code>stencilBits</code> is the number of bits per pixel to use for the stencil buffer (0 to disable it)</li>
    <li><code>antialiasingLevel</code> is the multisampling level</li>
    <li><code>majorVersion</code> and <code>minorVersion</code> comprise the requested version of OpenGL</li>
</ul>
<pre><code class="cpp">sf::ContextSettings settings;
settings.depthBits = 24;
settings.stencilBits = 8;
settings.antialiasingLevel = 4;
settings.majorVersion = 3;
settings.minorVersion = 0;

sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, settings);
</code></pre>
<p>
    If any of these settings is not supported by the graphics card, SFML tries to find the closest valid match. For example, if 4x anti-aliasing
    is too high, it tries 2x and then falls back to 0.<br />
    In any case, you can check what settings SFML actually used with the <code>getSettings</code> function:
</p>
<pre><code class="cpp">sf::ContextSettings settings = window.getSettings();

std::cout &lt;&lt; "depth bits:" &lt;&lt; settings.depthBits &lt;&lt; std::endl;
std::cout &lt;&lt; "stencil bits:" &lt;&lt; settings.stencilBits &lt;&lt; std::endl;
std::cout &lt;&lt; "antialiasing level:" &lt;&lt; settings.antialiasingLevel &lt;&lt; std::endl;
std::cout &lt;&lt; "version:" &lt;&lt; settings.majorVersion &lt;&lt; "." &lt;&lt; settings.minorVersion &lt;&lt; std::endl;
</code></pre>
<p class="important">
    OpenGL versions above 3.0 are supported by SFML (as long as your graphics driver can handle them). Support for selecting the profile of 3.2+
    contexts and whether the context debug flag is set was added in SFML 2.3. The forward compatibility flag is not supported. By default, SFML
    creates 3.2+ contexts using the compatibility profile because the graphics module makes use of legacy OpenGL functionality. If you intend on
    using the graphics module, make sure to create your context without the core profile setting or the graphics module will not function correctly.
    On OS X, SFML supports creating OpenGL 3.2+ contexts using the core profile only. If you want to use the graphics module on OS X, you are limited
    to using a legacy context which implies OpenGL version 2.1.
</p>

<?php h2('A typical OpenGL-with-SFML program') ?>
<p>
    Here is what a complete OpenGL program would look like with SFML:
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;
#include &lt;SFML/OpenGL.hpp&gt;

int main()
{
    // create the window
    sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, sf::ContextSettings(32));
    window.setVerticalSyncEnabled(true);

    // activate the window
    window.setActive(true);

    // load resources, initialize the OpenGL states, ...

    // run the main loop
    bool running = true;
    while (running)
    {
        // handle events
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
            {
                // end the program
                running = false;
            }
            else if (event.type == sf::Event::Resized)
            {
                // adjust the viewport when the window is resized
                glViewport(0, 0, event.size.width, event.size.height);
            }
        }

        // clear the buffers
        glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

        // draw...

        // end the current frame (internally swaps the front and back buffers)
        window.display();
    }

    // release resources...

    return 0;
}
</code></pre>
<p>
    Here we don't use <code>window.isOpen()</code> as the condition of the main loop, because we need the window to remain open until the program ends,
    so that we still have a valid OpenGL context for the last iteration of the loop and the cleanup code.
</p>
<p>
    Don't hesitate to have a look at the "OpenGL" and "Window" examples in the SFML SDK if you have further problems, they are more complete and
    most likely contain solutions to your problems.
</p>

<?php h2('Managing OpenGL contexts') ?>
<p>
    Every window created in SFML automatically comes with an OpenGL context. When calling any OpenGL functions, they operate on the currently active
    context. It is thus required that a context be active any time OpenGL functions are called. If a context is not active when an OpenGL function is
    called, the function call will not result in the desired effects since there is no state for it to have an effect on.
</p>
<p>
    In order to activate a window's context, use <code>window.setActive()</code> which is the same as <code>window.setActive(true)</code>. Activating
    a context while another is currently active will result in the currently active one being implicitly deactivated before the new one is activated.
    In order to explicitly deactivate a window's context, use <code>window.setActive(false)</code>. This is required if the context is to be activated
    on another thread as explained later on. Generally however, it is recommended to simply deactivate the context every time you are done with a batch
    of OpenGL operations. Following this advice, each batch of operations would be visibly wrapped between activation and deactivation calls. A RAII
    helper class can be written for this purpose.
</p>
<pre><code class="cpp">// activate the window's context
window.setActive(true);

// set up OpenGL states
// clear framebuffers
// draw to the window

// deactivate the window's context
window.setActive(false);
</code></pre>
<p class="important">
    When debugging issues with OpenGL in SFML, the first step is always to make sure a context is active when OpenGL functions are called. Do not
    assume that SFML will implicitly activate a context or that SFML will preserve the currently active context when calling into the library. The
    only guarantee provided is that the context active on the current thread will not change between calls to <code>window.setActive(true)</code> and
    <code>window.setActive(false)</code> as long as no other calls are made into the library in between. In all other cases, it has to be assumed that
    the current context might have changed, so explicitly reactivating the previously active context is required to guarantee the previously active
    context is once again active. Also ensure that the right context is active when an OpenGL function is called. The active context not only provides an
    execution environment for OpenGL operations, it also designates the destination framebuffer of any draw commands. Calling OpenGL draw functions while
    a context without a visible framebuffer is active will result in those draw commands not producing any visible output. Splitting OpenGL operations
    among multiple contexts will also result in the state changes being spread across the contexts. If any subsequent draw operation assumes that certain
    states are set, it will not produce the correct results in this case.
</p>
<p class="important">
    A highly recommended practice when writing OpenGL code is to always check if any OpenGL errors were produced after every OpenGL function call. This is
    done via the <code>glGetError()</code> function. Checking for errors after every function call will help to narrow down where a possible error might have
    occurred and improve debugging efficiency significantly.
</p>
<p>
    Depending on the version and capabilities of the context available, care has to be taken to only call functions that are actually valid within the
    current context. Doing otherwise will often result in the <code>GL_INVALID_OPERATION</code> or <code>GL_INVALID_ENUM</code> errors being generated.
    To query the actual version and capabilities of a context created with a window or separately, use <code>window.getSettings()</code> or
    <code>context.getSettings()</code> respectively. Be aware that these settings might differ from the settings passed during creation of the context
    if the OpenGL implementation was not able to meet all the requirements. It is recommended to always check if the context created actually provides
    the functionality required by the OpenGL code to be executed. This can become confusing when loading OpenGL extensions in a more capable context
    and trying to use them in a less capable context or vice versa.
</p>

<?php h2('Managing multiple OpenGL windows') ?>
<p>
    Managing multiple OpenGL windows is not more complicated than managing one, there are just a few things to keep in mind.
</p>
<p>
    OpenGL calls are made on the active context (thus the active window). Therefore if you want to draw to two different windows within the same
    program, you have to select which window is active before drawing something. This can be done with the <code>setActive</code> function:
</p>
<pre><code class="cpp">// activate the first window
window1.setActive(true);

// draw to the first window...

// activate the second window
window2.setActive(true);

// draw to the second window...
</code></pre>
<p>
    Only one context (window) can be active in a thread, so you don't need to deactivate a window before activating another one, it is deactivated
    automatically. This is how OpenGL works.
</p>
<p>
    Another thing to know is that all the OpenGL contexts created by SFML share their resources. This means that you can create a texture or vertex
    buffer with any context active, and use it with any other. This also means that you don't have to reload all your OpenGL resources when you recreate
    your window. Only shareable OpenGL resources can be shared among contexts. An example of an unshareable resource is a vertex array object.
</p>

<?php h2('OpenGL without a window') ?>
<p>
    Sometimes it might be necessary to call OpenGL functions without an active window, and thus no OpenGL context. For example, when you load textures from
    a separate thread, or before the first window is created. SFML allows you to create window-less contexts with the <?php class_link("Context") ?>
    class. All you have to do is instantiate it to get a valid context.
</p>
<pre><code class="cpp">int main()
{
    sf::Context context;

    // load OpenGL resources...

    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    ...

    return 0;
}
</code></pre>

<?php h2('Rendering from threads') ?>
<p>
    A typical configuration for a multi-threaded program is to handle the window and its events in one thread (the main one), and rendering in another one.
    If you do so, there's an important rule to keep in mind: you can't activate a context (window) if it's active in another thread. This means that
    you have to deactivate your window before launching the rendering thread.
</p>
<pre><code class="cpp">void renderingThread(sf::Window* window)
{
    // activate the window's context
    window->setActive(true);

    // the rendering loop
    while (window->isOpen())
    {
        // draw...

        // end the current frame -- this is a rendering function (it requires the context to be active)
        window->display();
    }
}

int main()
{
    // create the window (remember: it's safer to create it in the main thread due to OS limitations)
    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

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

<?php h2('Using OpenGL together with the graphics module') ?>
<p>
   This tutorial was about mixing OpenGL with sfml-window, which is fairly easy since it's the only purpose of this module. Mixing with the graphics
   module is a little more complicated: sfml-graphics uses OpenGL too, so extra care must be taken so that SFML and user states don't
   conflict with each other.
</p>
<p>
    If you don't know the graphics module yet, all you have to know is that the <?php class_link("Window") ?> class is replaced with
    <?php class_link("RenderWindow") ?>, which inherits all its functions and adds features to draw SFML specific entities.
</p>
<p>
    The only way to avoid conflicts between SFML and your own OpenGL states, is to save/restore them every time you switch from OpenGL to SFML.
</p>
<pre><code class="cpp">- draw with OpenGL

- save OpenGL states

- draw with SFML

- restore OpenGL states

- draw with OpenGL

...
</code></pre>
<p>
    The easiest solution is to let SFML do it for you, with the <code>pushGLStates</code>/<code>popGLStates</code> functions :
</p>
<pre><code class="cpp">glDraw...

window.pushGLStates();

window.draw(...);

window.popGLStates();

glDraw...
</code></pre>
<p>
    Since it has no knowledge about your OpenGL code, SFML can't optimize these steps and as a result it saves/restores all available OpenGL states and matrices.
    This may be acceptable for small projects, but it might also be too slow for bigger programs that require maximum performance. In this case, you can handle saving and
    restoring the OpenGL states yourself, with <code>glPushAttrib</code>/<code>glPopAttrib</code>, <code>glPushMatrix</code>/<code>glPopMatrix</code>,
    etc.<br />
    If you do this, you'll still need to restore SFML's own states before drawing. This is done with the <code>resetGLStates</code> function.
</p>
<pre><code class="cpp">glDraw...

glPush...
window.resetGLStates();

window.draw(...);

glPop...

glDraw...
</code></pre>
<p>
    By saving and restoring OpenGL states yourself, you can manage only the ones that you really need which leads to reducing the number of unnecessary driver calls.
</p>

<?php

    require("footer.php");

?>
