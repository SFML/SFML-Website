# Opening a window

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/window/window/).

## Introduction

In this tutorial, we will learn how to use SFML window package as a minimal windowing system, like SDL or GLUT.

## Preparing the code

First, you have to include the header needed for the window package :

```cpp
#include <SFML/Window.hpp>
```

This header is the only one needed, as it includes all other headers contained in the window package. This is the case for other packages too : if you want to use package xxx, you just have to include &lt;SFML/xxx.hpp> header file.

Then, you have to define the well known `main` function :

```cpp
int main()
{
    // Our code will go here
}
```

Or, if you want to get command-line arguments :

```cpp
int main(int argc, char** argv)
{
    // Our code will go here
}
```

Under Windows operating systems, you may have created a "Windows Application" project, especially if don't want the console to show up. In such case, to avoid replacing `main` by `WinMain`, you can link with SFML_Main static library and keep a standard and portable `main` entry point.

## Opening the window

The next step is to open a window. Windows in SFML are defined by the [`sf::Window`](../../../documentation/1.6/classsf_1_1Window.html "sf::Window documentation") class. This class provides some useful constructors to create directly our window. The interesting one here is the following :

```cpp
sf::Window App(sf::VideoMode(800, 600, 32), "SFML Window");
```

Here we create a new variable named `App`, that will represent our new window. Let's explain the parameters :

- The first parameter is a [`sf::VideoMode`](../../../documentation/1.6/classsf_1_1VideoMode.html "sf::VideoMode documentation"), which represents the chosen video mode for the window. Here, size is 800x600 pixels, with a depth of 32 bits per pixel. Note that the specified size will be the internal area of the window, excluding the titlebar and the borders.
- The second parameter is the window title, of type `std::string`

If you want to create your window later, or recreate it with different parameters, you can use its `Create` function :

```cpp
App.Create(sf::VideoMode(800, 600, 32), "SFML Window");
```

The constructors and `Create` functions also accept two optional additionnal parameters : the first one to have more control over the window's style, and the second to set more advanced graphics options ; we'll come back to this one in another tutorial, beginners usually don't have to care about it.  
The style parameter can be a combination of the `sf::Style` flags, which are `None`, `Titlebar`, `Resize`, `Close` and `Fullscreen`. The default style is `Resize | Close`.

```cpp
// This creates a fullscreen window
App.Create(sf::VideoMode(800, 600, 32), "SFML Window", sf::Style::Fullscreen);
```

## Video modes

In the example above, we don't care about the video mode because we run in windowed mode ; any size will be ok. But if we'd like to run in fullscreen mode, only a few modes would be allowed. [`sf::VideoMode`](../../../documentation/1.6/classsf_1_1VideoMode.html "sf::VideoMode documentation") provides an interface for getting all supported video modes, with the two static functions `GetModesCount` and `GetMode` :

```cpp
unsigned int VideoModesCount = sf::VideoMode::GetModesCount();
for (unsigned int i = 0; i < VideoModesCount; ++i)
{
    sf::VideoMode Mode = sf::VideoMode::GetMode(i);

    // Mode is a valid video mode
}
```

Note that video modes are ordered from highest to lowest, so that `sf::VideoMode::GetMode(0)` will always return the best video mode supported.

```cpp
// Creating a fullscreen window with the best video mode supported
App.Create(sf::VideoMode::GetMode(0), "SFML Window", sf::Style::Fullscreen);
```

If you get video modes with the code above then they will all be valid, but there are cases where you get a video mode from somewhere else, a configuration file for example. In such case, you can check the validity of a mode with its function `IsValid()` :

```cpp
sf::VideoMode Mode = ReadModeFromConfigFile();
if (!Mode.IsValid())
{
    // Error...
}
```

You can also get the current desktop video mode, with the `GetDesktopMode` function :

```cpp
sf::VideoMode DesktopMode = sf::VideoMode::GetDesktopMode();
```

## The main loop

Once our window has been created, we can enter the main loop :

```cpp
bool Running = true;
while (Running)
{
    App.Display();
}

return EXIT_SUCCESS;
```

To end the main loop and then close the application, you just have to set the variable `Running` to `false`. Typically this is done when the window is closed, or when the user presses a special key like escape ; we'll see how to catch these events in the next tutorial.

So far, our main loop only calls `App.Display()`. This is actually the only call needed to display the contents of our window to the screen. Call to `Display` should always happen once in the main loop, and be the last instruction, once everything else has been updated and drawn.  
At this point, you may see anything on the screen (maybe black color, maybe not) as we don't draw anything into our window.

As you can see, there is no more code after the main loop : our window is correctly destroyed automatically when `main` function ends (clean-up is done in its destructor).  
For those who never use `EXIT_SUCCESS`, it is just a constant defined to 0. To return an error you can use its sister `EXIT_FAILURE` instead of -1.

## Conclusion

And that's it, with this code you have a complete minimal program that opens an SFML window. But we cannot stop our program yet... so let's jump to [the next tutorial](events.md "Next tutorial : handling events"), to see how to catch events !
