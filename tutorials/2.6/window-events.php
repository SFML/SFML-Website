<?php

    $title = "Events explained";
    $page = "window-events.php";

    require("header.php");

?>

<h1>Events explained</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is a detailed list of window events. It describes them, and shows how to (and how not to) use them.
</p>

<?php h2('The sf::Event type') ?>
<p>
    Before dealing with events, it is important to understand what the <?php class_link("Event") ?> type is, and how to correctly use it.
    <?php class_link("Event") ?> is a <em>union</em>, which means that only one of its members is valid at a time (remember your C++ lesson: all the
    members of a union share the same memory space). The valid member is the one that matches the event type, for example <code>event.key</code> for a
    <code>KeyPressed</code> event. Trying to read any other member will result in an undefined behavior (most likely: random or invalid values).
    It is important to never try to use an event member that doesn't match its type.
</p>
<p>
    <?php class_link("Event") ?> instances are filled by the <code>pollEvent</code> (or <code>waitEvent</code>) function of the <?php class_link("Window") ?>
    class. Only these two functions can produce valid events, any attempt to use an <?php class_link("Event") ?> which was not returned by successful call to
    <code>pollEvent</code> (or <code>waitEvent</code>) will result in the same undefined behavior that was mentioned above.
</p>
<p>
    To be clear, here is what a typical event loop looks like:
</p>
<pre><code class="cpp">sf::Event event;

// while there are pending events...
while (window.pollEvent(event))
{
    // check the type of the event...
    switch (event.type)
    {
        // window closed
        case sf::Event::Closed:
            window.close();
            break;

        // key pressed
        case sf::Event::KeyPressed:
            ...
            break;

        // we don't process other types of events
        default:
            break;
    }
}</code></pre>
<p class="important">
    Read the above paragraph once again and make sure that you fully understand it, the <?php class_link("Event") ?> union is the cause of many problems for
    inexperienced programmers.
</p>
<p>
    Alright, now we can see what events SFML supports, what they mean and how to use them properly.
</p>

<?php h2('The Closed event') ?>
<p>
    The <code>sf::Event::Closed</code> event is triggered when the user wants to close the window, through any of the possible methods the window manager provides
    ("close" button, keyboard shortcut, etc.). This event only represents a close request, the window is not yet closed when the event is received.
</p>
<p>
    Typical code will just call <code>window.close()</code> in reaction to this event, to actually close the window. However, you may also want to do
    something else first, like saving the current application state or asking the user what to do. If you don't do anything, the window remains open.
</p>
<p>
    There's no member associated with this event in the <?php class_link("Event") ?> union.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Closed)
    window.close();
</code></pre>

<?php h2('The Resized event') ?>
<p>
    The <code>sf::Event::Resized</code> event is triggered when the window is resized, either through user action or programmatically by calling
    <code>window.setSize</code>.
</p>
<p>
    You can use this event to adjust the rendering settings: the viewport if you use OpenGL directly, or the current view if you use sfml-graphics.
</p>
<p>
    The member associated with this event is <code>event.size</code>, it contains the new size of the window.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Resized)
{
    std::cout &lt;&lt; "new width: " &lt;&lt; event.size.width &lt;&lt; std::endl;
    std::cout &lt;&lt; "new height: " &lt;&lt; event.size.height &lt;&lt; std::endl;
}</code></pre>

<?php h2('The LostFocus and GainedFocus events') ?>
<p>
    The <code>sf::Event::LostFocus</code> and <code>sf::Event::GainedFocus</code> events are triggered when the window loses/gains focus, which
    happens when the user switches the currently active window. When the window is out of focus, it doesn't receive keyboard events.
</p>
<p>
    This event can be used e.g. if you want to pause your game when the window is inactive.
</p>
<p>
    There's no member associated with these events in the <?php class_link("Event") ?> union.
</p>
<pre><code class="cpp">if (event.type == sf::Event::LostFocus)
    myGame.pause();

if (event.type == sf::Event::GainedFocus)
    myGame.resume();
</code></pre>

<?php h2('The TextEntered event') ?>
<p>
    The <code>sf::Event::TextEntered</code> event is triggered when a character is typed. This must not be confused with the <code>KeyPressed</code>
    event: <code>TextEntered</code> interprets the user input and produces the appropriate printable character. For example, pressing '^' then 'e'
    on a French keyboard will produce two <code>KeyPressed</code> events, but a single <code>TextEntered</code> event containing the 'ê' character.
    It works with all the input methods provided by the operating system, even the most specific or complex ones.
</p>
<p>
    This event is typically used to catch user input in a text field.
</p>
<p>
    The member associated with this event is <code>event.text</code>, it contains the Unicode value of the entered character. You can either put it
    directly in a <?php class_link("String") ?>, or cast it to a <code>char</code> after making sure that it is in the ASCII range (0 - 127).
</p>
<pre><code class="cpp">if (event.type == sf::Event::TextEntered)
{
    if (event.text.unicode &lt; 128)
        std::cout &lt;&lt; "ASCII character typed: " &lt;&lt; static_cast&lt;char&gt;(event.text.unicode) &lt;&lt; std::endl;
}</code></pre>
<p>
    Note that, since they are part of the Unicode standard, some non-printable characters such as <em>backspace</em> are generated by this event.
    In most cases you'll need to filter them out.
</p>
<p class="important">
    Many programmers use the <code>KeyPressed</code> event to get user input, and start to implement crazy algorithms that try to interpret all
    the possible key combinations to produce correct characters. Don't do that!
</p>

<?php h2('The KeyPressed and KeyReleased events') ?>
<p>
    The <code>sf::Event::KeyPressed</code> and <code>sf::Event::KeyReleased</code> events are triggered when a keyboard key is pressed/released.
</p>
<p>
    If a key is held, multiple <code>KeyPressed</code> events will be generated, at the default operating system delay (ie. the same delay that applies when you hold
    a letter in a text editor). To disable repeated <code>KeyPressed</code> events, you can call <code>window.setKeyRepeatEnabled(false)</code>.
    On the flip side, it is obvious that <code>KeyReleased</code> events can never be repeated.
</p>
<p>
    This event is the one to use if you want to trigger an action exactly once when a key is pressed or released, like making a character jump with
    space, or exiting something with escape.
</p>
<p class="important">
    Sometimes, people try to react to <code>KeyPressed</code> events directly to implement smooth movement. Doing so will <em>not</em> produce the expected effect,
    because when you hold a key you only get a few events (remember, the repeat delay). To achieve smooth movement with events, you must use a boolean that you set
    on <code>KeyPressed</code> and clear on <code>KeyReleased</code>; you can then move (independently of events) as long as the boolean is set.<br />
    The other (easier) solution to produce smooth movement is to use real-time keyboard input with <?php class_link("Keyboard") ?> (see the
    <a class="internal" href="./window-inputs.php" title="Real-time inputs tutorial">dedicated tutorial</a>).
</p>
<p>
    The member associated with these events is <code>event.key</code>, it contains the code of the pressed/released key, as well as the current state of
    the modifier keys (alt, control, shift, system).
</p>
<pre><code class="cpp">if (event.type == sf::Event::KeyPressed)
{
    if (event.key.code == sf::Keyboard::Escape)
    {
        std::cout &lt;&lt; "the escape key was pressed" &lt;&lt; std::endl;
        std::cout &lt;&lt; "control:" &lt;&lt; event.key.control &lt;&lt; std::endl;
        std::cout &lt;&lt; "alt:" &lt;&lt; event.key.alt &lt;&lt; std::endl;
        std::cout &lt;&lt; "shift:" &lt;&lt; event.key.shift &lt;&lt; std::endl;
        std::cout &lt;&lt; "system:" &lt;&lt; event.key.system &lt;&lt; std::endl;
    }
}</code></pre>
<p>
    Note that some keys have a special meaning for the operating system, and will lead to unexpected behavior. An example is the F10 key on Windows, which "steals"
    the focus, or the F12 key which starts the debugger when using Visual Studio. This will probably be solved in a future version of SFML.
</p>

<?php h2('The MouseWheelMoved event') ?>
<p>
    The <code>sf::Event::MouseWheelMoved</code> event is <strong>deprecated</strong> since SFML 2.3, use the MouseWheelScrolled event instead.
</p>

<?php h2('The MouseWheelScrolled event') ?>
<p>
    The <code>sf::Event::MouseWheelScrolled</code> event is triggered when a mouse wheel moves up or down, but also laterally if the mouse supports it.
</p>
<p>
    The member associated with this event is <code>event.mouseWheelScroll</code>, it contains the number of ticks the wheel has moved, what the orientation of the
    wheel is and the current position of the mouse cursor.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseWheelScrolled)
{
    if (event.mouseWheelScroll.wheel == sf::Mouse::VerticalWheel)
        std::cout &lt;&lt; "wheel type: vertical" &lt;&lt; std::endl;
    else if (event.mouseWheelScroll.wheel == sf::Mouse::HorizontalWheel)
        std::cout &lt;&lt; "wheel type: horizontal" &lt;&lt; std::endl;
    else
        std::cout &lt;&lt; "wheel type: unknown" &lt;&lt; std::endl;
    std::cout &lt;&lt; "wheel movement: " &lt;&lt; event.mouseWheelScroll.delta &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse x: " &lt;&lt; event.mouseWheelScroll.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse y: " &lt;&lt; event.mouseWheelScroll.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('The MouseButtonPressed and MouseButtonReleased events') ?>
<p>
    The <code>sf::Event::MouseButtonPressed</code> and <code>sf::Event::MouseButtonReleased</code> events are triggered when a mouse button
    is pressed/released.
</p>
<p>
    SFML supports 5 mouse buttons: left, right, middle (wheel), extra #1 and extra #2 (side buttons).
</p>
<p>
    The member associated with these events is <code>event.mouseButton</code>, it contains the code of the pressed/released button, as well as the current
    position of the mouse cursor.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseButtonPressed)
{
    if (event.mouseButton.button == sf::Mouse::Right)
    {
        std::cout &lt;&lt; "the right button was pressed" &lt;&lt; std::endl;
        std::cout &lt;&lt; "mouse x: " &lt;&lt; event.mouseButton.x &lt;&lt; std::endl;
        std::cout &lt;&lt; "mouse y: " &lt;&lt; event.mouseButton.y &lt;&lt; std::endl;
    }
}</code></pre>

<?php h2('The MouseMoved event') ?>
<p>
    The <code>sf::Event::MouseMoved</code> event is triggered when the mouse moves within the window.
</p>
<p>
    This event is triggered even if the window isn't focused. However, it is triggered only when the mouse moves within the inner area of the
    window, not when it moves over the title bar or borders.
</p>
<p>
    The member associated with this event is <code>event.mouseMove</code>, it contains the current position of the mouse cursor relative to the window.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseMoved)
{
    std::cout &lt;&lt; "new mouse x: " &lt;&lt; event.mouseMove.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "new mouse y: " &lt;&lt; event.mouseMove.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('The MouseEntered and MouseLeft event') ?>
<p>
    The <code>sf::Event::MouseEntered</code> and <code>sf::Event::MouseLeft</code> events are triggered when the mouse cursor enters/leaves the window.
</p>
<p>
    There's no member associated with these events in the <?php class_link("Event") ?> union.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseEntered)
    std::cout &lt;&lt; "the mouse cursor has entered the window" &lt;&lt; std::endl;

if (event.type == sf::Event::MouseLeft)
    std::cout &lt;&lt; "the mouse cursor has left the window" &lt;&lt; std::endl;
</code></pre>

<?php h2('The JoystickButtonPressed and JoystickButtonReleased events') ?>
<p>
    The <code>sf::Event::JoystickButtonPressed</code> and <code>sf::Event::JoystickButtonReleased</code> events are triggered when a joystick button
    is pressed/released.
</p>
<p>
    SFML supports up to 8 joysticks and 32 buttons.
</p>
<p>
    The member associated with these events is <code>event.joystickButton</code>, it contains the identifier of the joystick and the index of the
    pressed/released button.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickButtonPressed)
{
    std::cout &lt;&lt; "joystick button pressed!" &lt;&lt; std::endl;
    std::cout &lt;&lt; "joystick id: " &lt;&lt; event.joystickButton.joystickId &lt;&lt; std::endl;
    std::cout &lt;&lt; "button: " &lt;&lt; event.joystickButton.button &lt;&lt; std::endl;
}</code></pre>

<?php h2('The JoystickMoved event') ?>
<p>
    The <code>sf::Event::JoystickMoved</code> event is triggered when a joystick axis moves.
<p>
<p>
    Joystick axes are typically very sensitive, that's why SFML uses a detection threshold to avoid spamming your event loop with tons of
    <code>JoystickMoved</code> events. This threshold can be changed with the <code>Window::setJoystickThreshold</code> function, in case you want to
    receive more or less joystick move events.
</p>
<p>
    SFML supports 8 joystick axes: X, Y, Z, R, U, V, POV X and POV Y. How they map to your joystick depends on its driver.
</p>
<p>
    The member associated with this event is <code>event.joystickMove</code>, it contains the identifier of the joystick, the name of the axis, and its
    current position (in the range [-100, 100]).
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickMoved)
{
    if (event.joystickMove.axis == sf::Joystick::X)
    {
        std::cout &lt;&lt; "X axis moved!" &lt;&lt; std::endl;
        std::cout &lt;&lt; "joystick id: " &lt;&lt; event.joystickMove.joystickId &lt;&lt; std::endl;
        std::cout &lt;&lt; "new position: " &lt;&lt; event.joystickMove.position &lt;&lt; std::endl;
    }
}</code></pre>

<?php h2('The JoystickConnected and JoystickDisconnected events') ?>
<p>
    The <code>sf::Event::JoystickConnected</code> and <code>sf::Event::JoystickDisconnected</code> events are triggered when a joystick is
    connected/disconnected.
</p>
<p>
    The member associated with this event is <code>event.joystickConnect</code>, it contains the identifier of the connected/disconnected joystick.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickConnected)
    std::cout &lt;&lt; "joystick connected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;

if (event.type == sf::Event::JoystickDisconnected)
    std::cout &lt;&lt; "joystick disconnected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;
</code></pre>

<?php

    require("footer.php");

?>
