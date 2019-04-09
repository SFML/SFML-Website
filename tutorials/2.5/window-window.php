<?php

    $title = "Opening and managing a SFML window";
    $page = "window-window.php";

    require("header.php");

?>

<h1>Opening and managing a SFML window</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial only explains how to open and manage a window. Drawing stuff is beyond the scope of the sfml-window module: it is handled by the
    sfml-graphics module. However, the window management remains exactly the same so reading this tutorial is important in any case.
</p>

<?php h2('Opening a window') ?>
<p>
    Windows in SFML are defined by the <?php class_link("Window") ?> class. A window can be created and opened directly upon construction:
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>
<p>
    The first argument, the <em>video mode</em>, defines the size of the window (the inner size, without the title bar and borders). Here, we create
    a window with a size of 800x600 pixels.<br />
    The <?php class_link("VideoMode") ?> class has some interesting static functions to get the desktop resolution, or the list of valid video modes for
    fullscreen mode. Don't hesitate to have a look at its documentation.
</p>
<p>
    The second argument is simply the title of the window.
</p>
<p>
    This constructor accepts a third optional argument: a style, which allows you to choose which decorations and features you want. You can use any
    combination of the following styles:
</p>
<table class="styled">
    <tbody>
        <tr>
            <td><code>sf::Style::None</code></td>
            <td>No decoration at all (useful for splash screens, for example); this style cannot be combined with others</td>
        </tr>
        <tr>
            <td><code>sf::Style::Titlebar</code></td>
            <td>The window has a titlebar</td>
        </tr>
        <tr>
            <td><code>sf::Style::Resize</code></td>
            <td>The window can be resized and has a maximize button</td>
        </tr>
        <tr>
            <td><code>sf::Style::Close</code></td>
            <td>The window has a close button</td>
        </tr>
        <tr>
            <td><code>sf::Style::Fullscreen</code></td>
            <td>The window is shown in fullscreen mode; this style cannot be combined with others, and requires a valid video mode</td>
        </tr>
        <tr>
            <td><code>sf::Style::Default</code></td>
            <td>The default style, which is a shortcut for <code>Titlebar | Resize | Close</code></td>
        </tr>
        <tr>
    </tbody>
</table>
<p>
    There's also a fourth optional argument, which defines OpenGL specific options which are explained in the
    <a class="internal" href="./window-opengl.php" title="OpenGL tutorial">dedicated OpenGL tutorial</a>.
</p>
<p>
    If you want to create the window <em>after</em> the construction of the <?php class_link("Window") ?> instance, or re-create it with a different
    video mode or title, you can use the <code>create</code> function instead. It takes the exact same arguments as the constructor.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window;
    window.create(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>

<?php h2('Bringing the window to life') ?>
<p>
    If you try to execute the code above with nothing in place of the "...", you will hardly see something. First, because the program ends immediately.
    Second, because there's no event handling -- so even if you added an endless loop to this code, you would see a dead window, unable to be moved,
    resized, or closed.
</p>
<p>
    Let's add some code to make this program a bit more interesting:
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

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
    }

    return 0;
}
</code></pre>
<p>
    The above code will open a window, and terminate when the user closes it. Let's see how it works in detail.
</p>
<p>
    First, we added a loop that ensures that the application will be refreshed/updated until the window is closed. Most (if not all) SFML programs
    will have this kind of loop, sometimes called the <em>main loop</em> or <em>game loop</em>.
</p>
<p>
    Then, the first thing that we want to do inside our game loop is check for any events that occurred. Note that we use a <code>while</code> loop so that
    all pending events are processed in case there were several. The <code>pollEvent</code> function returns true if an event was pending, or false
    if there was none.
</p>
<p>
    Whenever we get an event, we must check its type (window closed? key pressed? mouse moved? joystick connected? ...), and react accordingly
    if we are interested in it. In this case, we only care about the <code>Event::Closed</code> event, which is triggered when the user wants to close
    the window. At this point, the window is still open and we have to close it explicitly with the <code>close</code> function. This enables you to do
    something before the window is closed, such as saving the current state of the application, or displaying a message.
</p>
<p class="important">
    A mistake that people often make is to forget the event loop, simply because they don't yet care about handling events (they use real-time inputs instead).
    Without an event loop, the window will become unresponsive. It is important to note that the event loop has two roles: in addition to providing events to the user,
    it gives the window a chance to process its internal events too, which is required so that it can react to move or resize user actions.
</p>
<p>
    After the window has been closed, the main loop exits and the program terminates.
</p>
<p>
    At this point, you probably noticed that we haven't talked about <em>drawing something</em> to the window yet. As stated in the introduction,
    this is not the job of the sfml-window module, and you'll have to jump to the sfml-graphics tutorials if you want to draw things such as
    sprites, text or shapes.
</p>
<p>
    To draw stuff, you can also use OpenGL directly and totally ignore the sfml-graphics module. <?php class_link("Window") ?> internally creates an
    OpenGL context and is ready to accept your OpenGL calls. You can learn more about that in the
    <a class="internal" href="./window-opengl.php" title="OpenGL tutorial">corresponding tutorial</a>.
</p>
<p>
    Don't expect to see something interesting in this window: you may see a uniform color (black or white), or the last contents of the previous
    application that used OpenGL, or... something else.
</p>

<?php h2('Playing with the window') ?>
<p>
    Of course, SFML allows you to play with your windows a bit. Basic window operations such as changing the size, position, title or
    icon are supported, but unlike dedicated GUI libraries (Qt, wxWidgets), SFML doesn't provide advanced features. SFML windows are only meant to provide
    an environment for OpenGL or SFML drawing.
</p>
<pre><code class="cpp">// change the position of the window (relatively to the desktop)
window.setPosition(sf::Vector2i(10, 50));

// change the size of the window
window.setSize(sf::Vector2u(640, 480));

// change the title of the window
window.setTitle("SFML window");

// get the size of the window
sf::Vector2u size = window.getSize();
unsigned int width = size.x;
unsigned int height = size.y;

// check whether the window has the focus
bool focus = window.hasFocus();

...
</code></pre>
<p>
    You can refer to the API documentation for a complete list of <?php class_link("Window") ?>'s functions.
</p>
<p>
    In case you really need advanced features for your window, you can create one (or even a full GUI) with another library, and embed SFML into it.
    To do so, you can use the other constructor, or <code>create</code> function, of <?php class_link("Window") ?> which takes the OS-specific
    handle of an existing window. In this case, SFML will create a drawing context inside the given window and catch all its events without interfering with
    the parent window management.
</p>
<pre><code class="cpp">sf::WindowHandle handle = /* specific to what you're doing and the library you're using */;
sf::Window window(handle);
</code></pre>
<p>
    If you just want an additional, very specific feature, you can also do it the other way round: create an SFML window and get its OS-specific handle
    to implement things that SFML itself doesn't support.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "SFML window");
sf::WindowHandle handle = window.getSystemHandle();

// you can now use the handle with OS specific functions
</code></pre>
<p>
    Integrating SFML with other libraries requires some work and won't be described here, but you can refer to the dedicated tutorials, examples or
    forum posts.
</p>

<?php h2('Controlling the framerate') ?>
<p>
    Sometimes, when your application runs fast, you may notice visual artifacts such as tearing. The reason is that your application's refresh rate
    is not synchronized with the vertical frequency of the monitor, and as a result, the bottom of the previous frame is mixed with the
    top of the next one.<br />
    The solution to this problem is to activate <em>vertical synchronization</em>. It is automatically handled by the graphics card, and can easily be
    switched on and off with the <code>setVerticalSyncEnabled</code> function:
</p>
<pre><code class="cpp">window.setVerticalSyncEnabled(true); // call it once, after creating the window
</code></pre>
<p>
    After this call, your application will run at the same frequency as the monitor's refresh rate.
</p>
<p class="important">
    Sometimes <code>setVerticalSyncEnabled</code> will have no effect: this is most likely because vertical synchronization is forced to "off" in your
    graphics driver's settings. It should be set to "controlled by application" instead.
</p>
<p>
    In other situations, you may also want your application to run at a given framerate, instead of the monitor's frequency. This can be done by calling
    <code>setFramerateLimit</code>:
</p>
<pre><code class="cpp">window.setFramerateLimit(60); // call it once, after creating the window
</code></pre>
<p>
    Unlike <code>setVerticalSyncEnabled</code>, this feature is implemented by SFML itself, using a combination of <?php class_link("Clock") ?>
    and <code>sf::sleep</code>. An important consequence is that it is not 100% reliable, especially for high framerates: <code>sf::sleep</code>'s
    resolution depends on the underlying operating system and hardware, and can be as high as 10 or 15 milliseconds. Don't rely on this feature to implement precise timing.
</p>
<p class="important">
    Never use both <code>setVerticalSyncEnabled</code> and <code>setFramerateLimit</code> at the same time! They would badly mix and make things worse.
</p>

<?php h2('Things to know about windows') ?>
<p>
    Here is a brief list of what you can and cannot do with SFML windows.
</p>

<h3>You can create multiple windows</h3>
<p>
    SFML allows you to create multiple windows, and to handle them either all in the main thread, or each one in its own thread (but... see below).
    In this case, don't forget to have an event loop for each window.
</p>

<h3>Multiple monitors are not correctly supported yet</h3>
<p>
    SFML doesn't explicitly manage multiple monitors. As a consequence, you won't be able to choose which monitor a window appears on, and you won't be able
    to create more than one fullscreen window. This should be improved in a future version.
</p>

<h3>Events must be polled in the window's thread</h3>
<p>
    This is an important limitation of most operating systems: the event loop (more precisely, the <code>pollEvent</code> or <code>waitEvent</code> function)
    must be called in the same thread that created the window. This means that if you want to create a dedicated thread for event handling, you'll
    have to make sure that the window is created in this thread too. If you really want to split things between threads, it is more convenient to keep
    event handling in the main thread and move the rest (rendering, physics, logic, ...) to a separate thread instead. This configuration will also
    be compatible with the other limitation described below.
</p>

<h3>On macOS, windows and events must be managed in the main thread</h3>
<p>
    Yep, that's true; macOS just won't agree if you try to create a window or handle events in a thread other than the main one.
</p>

<h3>On Windows, a window which is bigger than the desktop will not behave correctly</h3>
<p>
    For some reason, Windows doesn't like windows that are bigger than the desktop. This includes windows created with
    <code>VideoMode::getDesktopMode()</code>: with the window decorations (borders and titlebar) added, you end up with a window which is slightly
    bigger than the desktop.
</p>

<?php

    require("footer.php");

?>
