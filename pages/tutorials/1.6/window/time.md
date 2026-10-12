# Handling time

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/system/time/).

## Introduction

Time is usually not a big thing, but in a real-time application, it is important to handle it properly, as we will see in this new tutorial.

## Measuring time

In SFML, you measure time with [`sf::Clock`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Clock.php "sf::Clock documentation") class. It defines two functions : `Reset()`, to restart the clock, and `GetElapsedTime()`, to get the time elapsed since the last call to `Reset()`. Time is defined in seconds, as all durations that you will find in SFML.  
As you can see, this class is far from being complicated.

```cpp
sf::Clock Clock;

while (App.IsOpened())
{
    // Process events...

    // Get elapsed time since last loop
    float Time = Clock.GetElapsedTime();
    Clock.Reset();

    // Display window...
}
```

Getting elapsed time can be very useful if you have to increment a variable at each loop (a position, an orientation, ...). If you don't take in account the time factor, your simulation won't produce the same results whether the application runs at 60 frames per seconds or at 1000 frames per seconds. For example, this piece of code will make movement dependant on framerate :

```cpp
const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed;
}
```

Whereas this one will ensure constant speed on every hardware :

```cpp
sf::Clock Clock;

const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    float ElapsedTime = Clock.GetElapsedTime();
    Clock.Reset();

    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * ElapsedTime;
}
```

Most of time, you will have to measure the time elapsed since last frame. [`sf::Window`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Window.php "sf::Window documentation") provides a useful function for getting this time without having to manage a clock : `GetFrameTime()`. So we could rewrite our code like this :

```cpp
const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * App.GetFrameTime();
}
```

## Measuring framerate

As framerate is the inverse of the duration of one frame, you can easily deduce it from elapsed time between frames :

```cpp
sf::Clock Clock;

while (App.IsOpened())
{
    float Framerate = 1.f / Clock.GetElapsedTime();
    Clock.Reset();
}

// Or :

while (App.IsOpened())
{
    float Framerate = 1.f / App.GetFrameTime();
}
```

If your framerate gets stuck around 60 fps don't worry : it just means that vertical synchronization (v-sync) is enabled. Basically, when v-sync is on, display will be synchronized with the monitor refresh rate. It means you won't be able to display more frames than the monitor can do. And this is a good thing, as it ensures your application won't run at incredible framerates like 2000 fps, and produce bad visual artifacts or unpredicted behaviors.

However, you sometimes want to do some benchmark for optimizations, and you want maximum framerate. SFML allows you to disable vertical synchronization if you want, with the `UseVerticalSync` function :

```cpp
App.UseVerticalSync(false);
```

Note that vertical synchronization is disabled by default.

You can also set the framerate to a fixed limit :

```cpp
App.SetFramerateLimit(60); // Limit to 60 frames per second
App.SetFramerateLimit(0);  // No limit
```

## Conclusion

Time handling has no more secret for you now, and you can start to write robust real-time applications. In the [next tutorial](opengl.md "Next turorial : using OpenGL"), we'll play a bit with OpenGL, to finally get something to display in our window.  
However, if you're not interested in using OpenGL with SFML, you can jump directly to the next section about the [graphics package](../graphics/window.md "Opening a rendering window").
