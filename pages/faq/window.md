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
