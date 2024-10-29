!!! warning

    This page refers to an in-development version of SFML and as such may not have been updated yet.<br>
    [Click here](https://www.sfml-dev.org/tutorials/latest/) to navigate to the version of the latest official release.

# Keyboard, mouse and joystick

## Introduction

This tutorial explains how to access global input devices: keyboard, mouse and joysticks.
This must not be confused with events.
Real-time input allows you to query the global state of keyboard, mouse and joysticks at any time ("_is this button currently pressed?_", "_where is the mouse currently?_") while events notify you when something happens ("_this button was pressed_", "_the mouse has moved_").

## Keyboard

The namespace that provides access to the keyboard state is [`sf::Keyboard`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Keyboard.php "sf::Keyboard documentation").
It contains two overloads of the same function, `isKeyPressed`, which checks the current state of a key (pressed or released).

This function directly reads the keyboard state, ignoring the focus state of your window.
This means that `isKeyPressed` may return true, even if your window is inactive.

```cpp
if (sf::Keyboard::isKeyPressed(sf::Keyboard::Key::Left))
{
    // left key is pressed: move our character
    character.move({-1.f, 0.f});
}
```

Key codes are defined in the `sf::Keyboard::Key` enum.

```cpp
if (sf::Keyboard::isKeyPressed(sf::Keyboard::Scan::Right))
{
    // right key is pressed: move our character
    character.move({1.f, 0.f});
}
```

Scancodes are defined in the `sf::Keyboard::Scancode` enum.

## Mouse

The namespace that provides access to the mouse state is [`sf::Mouse`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Mouse.php "sf::Mouse documentation").

You can check if buttons are pressed:

```cpp
if (sf::Mouse::isButtonPressed(sf::Mouse::Button::Left))
{
    // left mouse button is pressed: shoot
    gun.fire();
}
```

Mouse button codes are defined in the `sf::Mouse::Button` enum.
SFML supports up to 5 buttons: left, right, middle (wheel), and two additional buttons whatever they may be.

You can also get and set the current position of the mouse, either relative to the desktop or to a window:

```cpp
// get the global mouse position (relative to the desktop)
sf::Vector2i globalPosition = sf::Mouse::getPosition();

// get the local mouse position (relative to a window)
sf::Vector2i localPosition = sf::Mouse::getPosition(window); // window is a sf::Window
```

```cpp
// set the mouse position globally (relative to the desktop)
sf::Mouse::setPosition(sf::Vector2i(10, 50));

// set the mouse position locally (relative to a window)
sf::Mouse::setPosition(sf::Vector2i(10, 50), window); // window is a sf::Window
```

There is no function for reading the current state of the mouse wheel.
Since the wheel can only be moved relatively, it has no absolute state that can be queried.
By looking at a key you can tell whether it's pressed or released.
By looking at the mouse cursor you can tell where it is located on the screen.
However, looking at the mouse wheel doesn't tell you which "tick" it is on.
You can only be notified when it moves (`MouseWheelScrolled` event).

For more information on how to use events, see the [events tutorial](events.md).

## Joystick

The namespace that provides access to the joysticks' states is [`sf::Joystick`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Joystick.php "sf::Joystick documentation").

Joysticks are identified by their index (0 to 7, since SFML supports up to 8 joysticks).
Therefore, the first argument of every function of [`sf::Joystick`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Joystick.php "sf::Joystick documentation") is the index of the joystick that you want to query.

You can check whether a joystick is connected or not:

```cpp
if (sf::Joystick::isConnected(0))
{
    // joystick number 0 is connected
    ...
}
```

You can also get the capabilities of a connected joystick:

```cpp
// check how many buttons joystick number 0 has
unsigned int buttonCount = sf::Joystick::getButtonCount(0);

// check if joystick number 0 has a Z axis
bool hasZ = sf::Joystick::hasAxis(0, sf::Joystick::Axis::Z);
```

Joystick axes are defined in the `sf::Joystick::Axis` enum.
Since buttons have no special meaning, they are simply numbered from 0 to 31.

Finally, you can query the state of a joystick's axes and buttons as well:

```cpp
// is button 1 of joystick number 0 pressed?
if (sf::Joystick::isButtonPressed(0, 1))
{
    // yes: shoot!
    gun.fire();
}

// what's the current position of the X and Y axes of joystick number 0?
float x = sf::Joystick::getAxisPosition(0, sf::Joystick::Axis::X);
float y = sf::Joystick::getAxisPosition(0, sf::Joystick::Axis::Y);
character.move({x, y});
```

Joystick states are automatically updated when you check for events.
If you don't check for events, or need to query a joystick state (for example, checking which joysticks are connected) before starting your game loop, you'll have to manually call the `sf::Joystick::update()` function yourself to make sure that the joystick states are up to date.
