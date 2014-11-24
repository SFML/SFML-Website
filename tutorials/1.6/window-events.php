<?php

    $title = "Handling events";
    $page = "window-events.php";

    require("header.php");
?>

<h1>Handling events</h1>

<?php h2('Introduction') ?>
<p>
    In the previous tutorial, we learned how to open a window but we had no way to stop the application.
    Here, we'll learn how to catch window events and handle them properly.
</p>

<?php h2('Getting events') ?>
<p>
    Basically, there are two ways of receiving events in a windowing system :
</p>
<ul>
    <li>You can ask the window for waiting events at each loop ; this is called "polling"</li>
    <li>You can give to the window a pointer to a function and then wait for the window
    to call it when it receives an event ; this is called, hum... "using callback functions"</li>
</ul>
<p>
    SFML uses a polling system for getting events. That is, you must ask events to the window at each loop.
    The function to use is <code>GetEvent</code>, which fills an instance of
    <?php class_link("Event")?> and returns <code>true</code> if there was an event
    waiting, or returns <code>false</code> if events stack was empty.
</p>
<pre><code class="cpp">// Remember that App is an instance of sf::Window

sf::Event Event;
if (App.GetEvent(Event))
{
    // Process event
}
</code></pre>
<p>
    But there can be more than one event to get at each frame (events are stored in a stack at each frame,
    and getting an event pops the top of this stack), and if you only get one, events may accumulate and
    never get processed.<br/>
    The proper way to get all waiting events at each frame is to loop until we have all of them :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Process event
}
</code></pre>
<p>
    "Hey, but wait a minute... where should I put this piece of code, by the way ?".<br/>
    As events should be processed at each frame, you should put event handling on top of the main
    loop :
</p>
<pre><code class="cpp">while (Running)
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Process event
    }

    App.Display();
}
</code></pre>

<?php h2('Processing events') ?>
<p>
    The first thing to do when you get an event is to check its type, in its <code>Type</code> member.
    SFML defines the following types of events, all in the scope of the <?php class_link("Event")?>
    structure :
</p>
<ul>
    <li><code>Closed</code></li>
    <li><code>Resized</code></li>
    <li><code>LostFocus</code></li>
    <li><code>GainedFocus</code></li>
    <li><code>TextEntered</code></li>
    <li><code>KeyPressed</code></li>
    <li><code>KeyReleased</code></li>
    <li><code>MouseWheelMoved</code></li>
    <li><code>MouseButtonPressed</code></li>
    <li><code>MouseButtonReleased</code></li>
    <li><code>MouseMoved</code></li>
    <li><code>MouseEntered</code></li>
    <li><code>MouseLeft</code></li>
    <li><code>JoyButtonPressed</code></li>
    <li><code>JoyButtonReleased</code></li>
    <li><code>JoyMoved</code></li>
</ul>
<p>
    Depending on the type of event, the event instance will be filled with different parameters :
</p>
<ul>
    <li>Size events (<code>Resized</code>)
        <ul>
            <li><code>Event.Size.Width</code> contains the new window width, in pixels</li>
            <li><code>Event.Size.Height</code> contains the new window height, in pixels</li>
        </ul>
    </li>
    <li>Text events (<code>TextEntered</code>)
        <ul>
            <li><code>Event.Text.Unicode</code> contains the UTF-32 code of the character that has been entered</li>
        </ul>
    </li>
    <li>Key events (<code>KeyPressed, KeyReleased</code>)
        <ul>
            <li><code>Event.Key.Code</code> contains the code of the key that was pressed / released</li>
            <li><code>Event.Key.Alt</code>  tells whether or not Alt key is pressed</li>
            <li><code>Event.Key.Control</code> tells whether or not Control key is pressed</li>
            <li><code>Event.Key.Shift</code> tells whether or not Shift key is pressed</li>
        </ul>
    </li>
    <li>Mouse buttons events (<code>MouseButtonPressed, MouseButtonReleased</code>)
        <ul>
            <li><code>Event.MouseButton.Button</code> contains the buttons that is pressed / released</li>
            <li><code>Event.MouseButton.X</code> contains the current X position of the mouse cursor, in local coordinates</li>
            <li><code>Event.MouseButton.Y</code> contains the current Y position of the mouse cursor, in local coordinates</li>
        </ul>
    </li>
    <li>Mouse move events (<code>MouseMoved</code>)
        <ul>
            <li><code>Event.MouseMove.X</code> contains the new X position of the mouse cursor, in local coordinates</li>
            <li><code>Event.MouseMove.Y</code> contains the new Y position of the mouse cursor, in local coordinates</li>
        </ul>
    </li>
    <li>Mouse wheel events (<code>MouseWheelMoved</code>)
        <ul>
            <li><code>Event.MouseWheel.Delta</code> contains the mouse wheel move (positive if forward, negative if backward)</li>
        </ul>
    </li>
    <li>Joystick buttons events (<code>JoyButtonPressed, JoyButtonReleased</code>)
        <ul>
            <li><code>Event.JoyButton.JoystickId</code> contains the index of the joystick (can be 0 or 1)</li>
            <li><code>Event.JoyButton.Button</code> contains the index of the button that is pressed / released, in the range [0, 15]</li>
        </ul>
    </li>
    <li>Joystick move events (<code>JoyMoved</code>)
        <ul>
            <li><code>Event.JoyMove.JoystickId</code> contains the index of the joystick (can be 0 or 1)</li>
            <li><code>Event.JoyMove.Axis</code> contains the moved axis</li>
            <li><code>Event.JoyMove.Position</code> contains the current position on the axis, in the range [-100, 100] (except POV which is in [0, 360])</li>
        </ul>
    </li>
</ul>
<p>
    Key codes are specific to SFML. Every keyboard key is associated to a constant, defined in Events.hpp.
    For example, key F5 is defined by the <code>sf::Key::F5</code> constant.
    For characters and numbers, the constant match the ASCII code, this means that both
    <code>'a'</code> and <code>sf::Key::A</code> map to the 'A' key.
</p>
<p>
    The mouse buttons codes follow the same rule. Five constants are defined :
    <code>sf::Mouse::Left</code>, <code>sf::Mouse::Right</code>, <code>sf::Mouse::Middle</code> (the wheel button),
    <code>sf::Mouse::XButton1</code> and <code>sf::Mouse::XButton2</code>.
</p>
<p>
    Finally, joystick axes are defined as follows : <code>sf::Joy::AxisX</code>, <code>sf::Joy::AxisY</code>,
    <code>sf::Joy::AxisZ</code>, <code>sf::Joy::AxisR</code>, <code>sf::Joy::AxisU</code>, <code>sf::Joy::AxisV</code>,
    and <code>sf::Joy::AxisPOV</code>.
</p>
<p>
    So... let's go back to our application, and add some code to handle events. We will add something to stop
    the application when the user closes the window, or when he presses the escape key :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Window closed
    if (Event.Type == sf::Event::Closed)
        Running = false;

    // Escape key pressed
    if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
        Running = false;
}
</code></pre>

<?php h2('Closing a window') ?>
<p>
    If you have played around a bit with SFML windows, you have probably noticed that clicking the close box will
    generate a <code>Closed</code> event, but won't destroy the window. This is to allow users to add custom code before doing it
    (asking for save, etc.), or cancel it. To actually close a window, you must either destroy the
    <?php class_link("Window")?>
    instance or call its <code>Close()</code> function.<br/>
    To know if a window is opened (ie. has been created), you can call the <code>IsOpened()</code> function.
</p>
<p>
    Now, our main loop can look much better :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Window closed
        if (Event.Type == sf::Event::Closed)
            App.Close();

        // Escape key pressed
        if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
            App.Close();
    }
}
</code></pre>

<?php h2('Getting real-time inputs') ?>
<p>
    This event system is good enough for reacting to events like window closing, or a single key press.
    But if you want to handle, for example, the continous motion of a character when you press an arrow key,
    then you will soon see that there is a problem : there will be a delay between each movement, the delay
    defined by the operating system when you keep on pressing a key.
</p>
<p>
    A better strategy for this is to set a boolean variable to <code>true</code> when the
    key is pressed, and clear it when the key is released. Then at each loop, if the boolean is set, you
    move your character. However it can become annoying to use extra variables for this, especially when
    you have a lot of them. That's why SFML provides easy access to real-time input, with the
    <?php class_link("Input")?> class.
</p>
<p>
    <?php class_link("Input")?> instances cannot live by themselves, they must be attached to a window.
    In fact, each <?php class_link("Window")?> manages its own <?php class_link("Input")?> instance,
    and you just have to get it when you want. Getting a reference to the input associated to a window
    is done by the function <code>GetInput</code> :
</p>
<pre><code class="cpp">const sf::Input&amp; Input = App.GetInput();
</code></pre>
<p>
    Then, you can use the <?php class_link("Input")?>
    instance to get mouse, keyboard and joysticks state at any time :
</p>
<pre><code class="cpp">bool         LeftKeyDown     = Input.IsKeyDown(sf::Key::Left);
bool         RightButtonDown = Input.IsMouseButtonDown(sf::Mouse::Right);
bool         Joy0Button1Down = Input.IsJoystickButtonDown(0, 1);
unsigned int MouseX          = Input.GetMouseX();
unsigned int MouseY          = Input.GetMouseY();
float        Joystick1X      = Input.GetJoystickAxis(1, sf::Joy::AxisX);
float        Joystick1Y      = Input.GetJoystickAxis(1, sf::Joy::AxisY);
float        Joystick1POV    = Input.GetJoystickAxis(1, sf::Joy::AxisPOV);
</code></pre>
<?php h2('Conclusion') ?>
<p>
    In this tutorial you have learned how to handle windows inputs, and how to get real-time keyboard and
    mouse state. But to build a real-time application, you need to handle properly something else : time.
    So let's have a look at a quick tutorial about
    <a class="internal" href="./window-time.php" title="Next turorial : time handling">time handling</a>
    with SFML !
</p>

<?php

    require("footer.php");

?>
