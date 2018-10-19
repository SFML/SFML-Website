<?php

    $title = "Keyboard, mouse and joystick";
    $page = "window-inputs.php";

    require("header.php");

?>

<h1>Keyboard, mouse and joystick</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial explains how to access global input devices: keyboard, mouse and joysticks. This must not be confused with events. Real-time input allows
    you to query the global state of keyboard, mouse and joysticks at any time ("<em>is this button currently pressed?</em>",
    "<em>where is the mouse currently?</em>") while events notify you when something happens ("<em>this button was pressed</em>", "<em>the mouse has moved</em>").
</p>

<?php h2('Keyboard') ?>
<p>
    The class that provides access to the keyboard state is <?php class_link("Keyboard") ?>. It only contains one function, <code>isKeyPressed</code>,
    which checks the current state of a key (pressed or released). It is a static function, so you don't need to instantiate <?php class_link("Keyboard") ?> to use it.
</p>
<p>
    This function directly reads the keyboard state, ignoring the focus state of your window. This means that <code>isKeyPressed</code> may return
    true even if your window is inactive.
</p>
<pre><code class="cpp">if (sf::Keyboard::isKeyPressed(sf::Keyboard::Left))
{
    // left key is pressed: move our character
    character.move(1.f, 0.f);
}
</code></pre>
<p>
    Key codes are defined in the <code>sf::Keyboard::Key</code> enum.
</p>
<p class="important">
    Depending on your operating system and keyboard layout, some key codes might be missing or interpreted incorrectly. This is something that will be improved in
    a future version of SFML.
</p>

<?php h2('Mouse') ?>
<p>
    The class that provides access to the mouse state is <?php class_link("Mouse") ?>. Like its friend <?php class_link("Keyboard") ?>,
    <?php class_link("Mouse") ?> only contains static functions and is not meant to be instantiated (SFML only handles a single mouse for the time being).
</p>
<p>
    You can check if buttons are pressed:
</p>
<pre><code class="cpp">if (sf::Mouse::isButtonPressed(sf::Mouse::Left))
{
    // left mouse button is pressed: shoot
    gun.fire();
}
</code></pre>
<p>
    Mouse button codes are defined in the <code>sf::Mouse::Button</code> enum. SFML supports up to 5 buttons: left, right, middle (wheel), and two
    additional buttons whatever they may be.
</p>
<p>
    You can also get and set the current position of the mouse, either relative to the desktop or to a window:
</p>
<pre><code class="cpp">// get the global mouse position (relative to the desktop)
sf::Vector2i globalPosition = sf::Mouse::getPosition();

// get the local mouse position (relative to a window)
sf::Vector2i localPosition = sf::Mouse::getPosition(window); // window is a sf::Window
</code></pre>
<pre><code class="cpp">// set the mouse position globally (relative to the desktop)
sf::Mouse::setPosition(sf::Vector2i(10, 50));

// set the mouse position locally (relative to a window)
sf::Mouse::setPosition(sf::Vector2i(10, 50), window); // window is a sf::Window
</code></pre>
<p>
    There is no function for reading the current state of the mouse wheel. Since the wheel can only be moved relatively, it has no absolute state that can be queried.
    By looking at a key you can tell whether it's pressed or released. By looking at the mouse cursor you can tell where it is located on the screen.
    However, looking at the mouse wheel doesn't tell you which "tick" it is on. You can only be notified when it moves (<code>MouseWheelScrolled</code> event).
</p>

<?php h2('Joystick') ?>
<p>
    The class that provides access to the joysticks' states is <?php class_link("Joystick") ?>. Like the other classes in this tutorial, it only contains static
    functions.
</p>
<p>
    Joysticks are identified by their index (0 to 7, since SFML supports up to 8 joysticks). Therefore, the first argument of every function of
    <?php class_link("Joystick") ?> is the index of the joystick that you want to query.
</p>
<p>
    You can check whether a joystick is connected or not:
</p>
<pre><code class="cpp">if (sf::Joystick::isConnected(0))
{
    // joystick number 0 is connected
    ...
}
</code></pre>
<p>
    You can also get the capabilities of a connected joystick:
</p>
<pre><code class="cpp">// check how many buttons joystick number 0 has
unsigned int buttonCount = sf::Joystick::getButtonCount(0);

// check if joystick number 0 has a Z axis
bool hasZ = sf::Joystick::hasAxis(0, sf::Joystick::Z);
</code></pre>
<p>
    Joystick axes are defined in the <code>sf::Joystick::Axis</code> enum. Since buttons have no special meaning, they are simply numbered from 0 to 31.
</p>
<p>
    Finally, you can query the state of a joystick's axes and buttons as well:
</p>
<pre><code class="cpp">// is button 1 of joystick number 0 pressed?
if (sf::Joystick::isButtonPressed(0, 1))
{
    // yes: shoot!
    gun.fire();
}

// what's the current position of the X and Y axes of joystick number 0?
float x = sf::Joystick::getAxisPosition(0, sf::Joystick::X);
float y = sf::Joystick::getAxisPosition(0, sf::Joystick::Y);
character.move(x, y);
</code></pre>
<p class="important">
    Joystick states are automatically updated when you check for events. If you don't check for events, or need to query a joystick state (for example, checking which
    joysticks are connected) before starting your game loop, you'll have to manually call the <code>sf::Joystick::update()</code> function yourself to make sure that the
    joystick states are up to date.
</p>

<?php

    require("footer.php");

?>
