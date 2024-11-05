# Drawing 2D stuff

## Introduction

As you learned in the previous tutorials, SFML's window module provides an easy way to open an OpenGL window and handle its events, but it doesn't help when it comes to drawing something.
The only option which is left to you is to use the powerful, yet complex and low level OpenGL API.

Fortunately, SFML provides a graphics module which will help you draw 2D entities in a much simpler way than with OpenGL.

## The drawing window

To draw the entities provided by the graphics module, you must use a specialized window class: [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderWindow.php "sf::RenderWindow documentation").
This class is derived from [`sf::Window`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Window.php "sf::Window documentation"), and inherits all its functions.
Everything that you've learnt about [`sf::Window`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Window.php "sf::Window documentation") (creation, event handling, controlling the framerate, mixing with OpenGL, etc.) is applicable to [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") as well.

On top of that, [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") adds high-level functions to help you draw things easily.
In this tutorial we'll focus on two of these functions: `clear` and `draw`.
They are as simple as their name implies: `clear` clears the whole window with the chosen color, and `draw` draws whatever object you pass to it.

Here is what a typical main loop looks like with a render window:

```cpp
#include <SFML/Graphics.hpp>

int main()
{
    // create the window
    sf::RenderWindow window(sf::VideoMode({800, 600}), "My window");

    // run the program as long as the window is open
    while (window.isOpen())
    {
        // check all the window's events that were triggered since the last iteration of the loop
        while (const std::optional event = window.pollEvent())
        {
            // "close requested" event: we close the window
            if (event->is<sf::Event::Closed>())
                window.close();
        }

        // clear the window with black color
        window.clear(sf::Color::Black);

        // draw everything here...
        // window.draw(...);

        // end the current frame
        window.display();
    }
}
```

Calling `clear` before drawing anything is mandatory, otherwise the contents from previous frames will be present behind anything you draw.
The only exception is when you cover the entire window with what you draw such that every pixel is drawn to.
In this case you can avoid calling `clear` (although it won't have a noticeable impact on performance).

Calling `display` is also mandatory, it takes what was drawn since the last call to `display` and displays it on the window.
Indeed, things are not drawn directly to the window, but to a hidden buffer.
This buffer is then copied to the window when you call `display` -- this is called *double-buffering*.

This clear/draw/display cycle is the only good way to draw things.
Don't try other strategies, such as keeping pixels from the previous frame, "erasing" pixels, or drawing once and calling display multiple times.
You'll get strange results due to double-buffering.
 
Modern graphics hardware and APIs are *really* made for repeated clear/draw/display cycles where everything is completely refreshed at each iteration of the main loop.
Don't be scared to draw 1000 sprites 60 times per second.
You're far below the millions of triangles that your computer can handle.

## What can I draw now?

Now that you have a main loop which is ready to draw, let's see what, and how, you can actually draw there.

SFML provides four kinds of drawable entities: three of them are ready to be used (_sprites_, *text* and *shapes*), the last one is the building block that will help you create your own drawable entities (_vertex arrays_).

Although they share some common properties, each of these entities come with their own nuances and are therefore explained in dedicated tutorials:

- [Sprite tutorial](sprite.md "Learn how to create and draw sprites")
- [Text tutorial](text.md "Learn how to create and draw text")
- [Shape tutorial](shape.md "Learn how to create and draw shapes")
- [Vertex array tutorial](vertex-array.md "Learn how to create and draw vertex arrays")

## Off-screen drawing

SFML also provides a way to draw to a texture instead of directly to a window.
To do so, use a [`sf::RenderTexture`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderTexture.php "sf::RenderTexture documentation") instead of a [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderWindow.php "sf::RenderWindow documentation").
It has the same functions for drawing, inherited from their common base: [`sf::RenderTarget`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderTarget.php "sf::RenderTarget documentation").

```cpp
// create a 500x500 render-texture
sf::RenderTexture renderTexture({500, 500});

// drawing uses the same functions
renderTexture.clear();
renderTexture.draw(sprite); // or any other drawable
renderTexture.display();

// get the target texture (where the stuff has been drawn)
const sf::Texture& texture = renderTexture.getTexture();

// draw it to the window
sf::Sprite sprite(texture);
window.draw(sprite);
```

The `getTexture` function returns a read-only texture, which means that you can only use it, not modify it.
If you need to modify it before using it, you can copy it to your own [`sf::Texture`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Texture.php "sf::Texture documentation") instance and modify that instead.

[`sf::RenderTexture`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderTexture.php "sf::RenderTexture documentation") also has the same functions as [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") for handling views and OpenGL (see the corresponding tutorials for more details).

## Drawing from threads

SFML supports multi-threaded drawing, and you don't even have to do anything to make it work.
The only thing to remember is to deactivate a window before using it in another thread.
That's because a window (more precisely its OpenGL context) cannot be active in more than one thread at the same time.

```cpp
void renderingThread(sf::RenderWindow* window)
{
    // activate the window's context
    window->setActive(true);

    // the rendering loop
    while (window->isOpen())
    {
        // draw...

        // end the current frame
        window->display();
    }
}

int main()
{
    // create the window (remember: it's safer to create it in the main thread due to OS limitations)
    sf::RenderWindow window(sf::VideoMode({800, 600}), "OpenGL");

    // deactivate its OpenGL context
    window.setActive(false);

    // launch the rendering thread
    std::thread thread(&renderingThread, &window);

    // the event/logic/whatever loop
    while (window.isOpen())
    {
        ...
    }

    thread.join();
}
```

As you can see, you don't even need to bother with the activation of the window in the rendering thread, SFML does it automatically for you whenever it needs to be done.

Remember to always create the window and handle its events in the main thread for maximum portability.
This is explained in the [window tutorial](../window/window.md "Window tutorial").
