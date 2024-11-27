---
hide:
  - footer
---

# Window

## How do I make my window transparent? {: #transparent-window}

Unfortunately SFML can't help you with this. The style and representation of the application window within your window manager/desktop environment is specific to the environment you are currently in. Because of this SFML cannot provide a uniform interface for controlling the representation of your application window.

SFML does however provide `sf::Window::getSystemHandle()`. Using the handle you can do a bit of research and find out how to manipulate the window representation yourself using the functions of your window manager.

## What happened to getFrameTime()? {: #get-frame-time}

`getFrameTime()` was removed from SFML at the beginning of 2012. The reasoning for it can be found here: [https://en.sfml-dev.org/forums/index.php?topic=6831.0](https://en.sfml-dev.org/forums/index.php?topic=6831.0)

Users have to create an `sf::Clock` object now and keep time themselves. This has more advantages than disadvantages including:

- Correct time reporting (`getFrameTime()` reported the time spent **during the last frame**)
- More control over between which points in your code the time is to be measured
- More control over the precision required

## Why doesn't setFramerateLimit() always set the frame rate to the specified limit? {: #set-framerate-limit}

`setFramerateLimit()` is implemented using a call to `sf::sleep()` every frame. The intricacies of sf::sleep are explained [here](system.md#sleep).
