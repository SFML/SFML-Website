# Using render windows

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/graphics/draw/).

## Introduction

Window package provides a complete system for handling windows and events, an can interface with OpenGL. But what if we don't want to use OpenGL ? SFML provides a package dedicated to 2D graphics, the graphics package.

## Setup

To work with the graphics package, you have to include the correct header :

```cpp
#include <SFML/Graphics.hpp>
```

SFML/Window.hpp is no more explicitly requiered, as it is already included by the graphics package.

## The rendering window

SFML base window, [`sf::Window`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Window.php "sf::Window documentation"), is enough for getting a window and its events, but has no idea of how to draw something. In fact you won't be able to display anything from the graphics package into a [`sf::Window`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Window.php "sf::Window documentation"). That's why the graphics package provides a window class containing more features and doing more redundant stuff for you : [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"). As [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") inherits from [`sf::Window`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Window.php "sf::Window documentation"), it already contains all its features and acts exactly the same for creation, event handling, etc. All [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") does is adding features for easily displaying graphics.

In fact, a minimal application using graphics package would be exactly the same as if using the window package, except the type of the window :

```cpp
int main()
{
    // Create the main rendering window
    sf::RenderWindow App(sf::VideoMode(800, 600, 32), "SFML Graphics");

    // Start game loop
    while (App.IsOpened())
    {
        // Process events
        sf::Event Event;
        while (App.GetEvent(Event))
        {
            // Close window : exit
            if (Event.Type == sf::Event::Closed)
                App.Close();
        }

        // Clear the screen (fill it with black color)
        App.Clear();

        // Display window contents on screen
        App.Display();
    }

    return EXIT_SUCCESS;
}
```

The only difference here is that we've added a call to `Clear`, so that the screen gets filled with black instead of remaining with random pixels.

If you need to clear the screen with a different color, you can pass it as parameter :

```cpp
App.Clear(sf::Color(200, 0, 0));
```

SFML graphics package provides a useful class for manipulating colors : [`sf::Color`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Color.php "sf::Color documentation"). Every color you'll have to handle in SFML will be a [`sf::Color`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Color.php "sf::Color documentation"), you can forget 32-bits integers and float arrays.  
[`sf::Color`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Color.php "sf::Color documentation") basically contains four 8-bits components : `r` (red), `g` (green), `b` (blue), and `a` (alpha -- for transparency) ; their values range from 0 to 255.  
[`sf::Color`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Color.php "sf::Color documentation") provides some useful functions, operators and constructors, the one that interests us here is the one that takes the 4 components as parameters (the fourth one, alpha, has a default value of 255). So in the code above, we construct a [`sf::Color`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Color.php "sf::Color documentation") with red component to 200, and green and blue components to 0. So... we obtain a red background for our window.

Note that clearing the window is not actually needed if what you have to draw is going to cover the entire screen; do it only if you have some pixels which would remain undrawn.

## Taking screenshots

This is probably not the most important thing, but it's always useful. [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") provides a function to save its contents into an image : `Capture`. Then you can easily save the image to a file with the `SaveToFile` function, or do whatever else you want.  
So, for example, we can take a screenshot when the user presses the F1 key :

```cpp
if (Event.Key.Code == sf::Key::F1)
{
    sf::Image Screen = App.Capture();
    Screen.SaveToFile("screenshot.jpg");
}
```

Of course, depending on the position of this line of code in the main loop, the captured image won't be the same. It will capture the current contents of the screen at the time you call `Capture`.

## Mixing with OpenGL

It is of course still possible to use custom OpenGL commands with a [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"), as you would do with a [`sf::Window`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Window.php "sf::Window documentation"). You can even mix SFML drawing commands and your own OpenGL ones. However, SFML doesn't preserve OpenGL states by default. If SFML messes up with your OpenGL states and you want it to take care of saving / resetting / restoring them, you have to call the `PreserveOpenGLStates` function :

```cpp
App.PreserveOpenGLStates(true);
```

Preserving OpenGL states is very CPU consuming and will degrade performances, use it only if you really need it. Also consider using your own code to manage the states you need to preserve, as it will be more efficient than the generic SFML code which takes care of every state, even the ones you don't care about.

## Conclusion

There's not much more to say about render windows. They just act like base windows, adding some features to allow easy 2D rendering. More features will be explained in the next tutorials, begining with [sprite rendering](sprite.md "Go to next tutorial").
