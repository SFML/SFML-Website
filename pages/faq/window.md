---
hide:
  - footer
---

# Window

## How do I make my window transparent? {: #transparent-window}

Unfortunately SFML can't help you with this.
The style and representation of the application window within your window manager/desktop environment is specific to the environment you are currently in.
Because of this SFML cannot provide a uniform interface for controlling the representation of your application window.

SFML does however provide `sf::Window::getNativeHandle()`.
Using the handle you can do a bit of research and find out how to manipulate the window representation yourself using the functions of your window manager.

## Can I use OpenGL together with SFML? {: #opengl}

Yes.
SFML creates an OpenGL context for every window, and you can request a specific version and other attributes through `sf::ContextSettings` when creating the window.
For functions beyond OpenGL 1.1, use a loader such as [glad](https://github.com/Dav1dde/glad) or `sf::Context::getFunction()`.

If you mix your own OpenGL calls with the graphics module, wrap them with `pushGLStates()` and `popGLStates()` or call `resetGLStates()`, so that the two don't interfere with each other.
Keep in mind that the graphics module makes use of legacy OpenGL functionality, so it doesn't work with a core profile context.

See the [OpenGL tutorial](../tutorials/3.1/window/opengl.md) for the details.

## Can I draw from another thread? {: #threads-opengl}

Yes, but an OpenGL context can only be active in one thread at a time.
Deactivate the window with `setActive(false)` in the thread that created it, before activating it with `setActive(true)` in the rendering thread.
Events still have to be processed in the thread that created the window.

See [Rendering from threads](../tutorials/3.1/window/opengl.md#rendering-from-threads) for an example, and keep in mind, that threads rarely make rendering faster, see [My program keeps crashing when I use threads!](system.md#threads-crash).

## How does SFML handle high DPI displays? {: #high-dpi}

On Windows, SFML marks your application as DPI aware, so Windows doesn't scale it.
Window sizes and positions are in physical pixels, which means that a window of 800x600 pixels looks smaller on a display with 150% scaling.
If you want your content to have the same physical size everywhere, you have to scale it yourself.

On macOS, SFML doesn't use the full resolution of Retina displays.
Sizes are in points and the system scales the content up, which can look a bit blurry.
