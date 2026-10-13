# Using views

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/graphics/view/).

## Introduction

In this tutorial, you'll learn how to use SFML 2D views. Views are like 2D cameras, which allow you to move, zoom or scroll without having to move or resize the whole scene.

## Defining a new view

Views are defined by the [`sf::View`](../../../documentation/1.6/classsf_1_1View.html "sf::View documentation") class, which is basically a 2D rectangle nicely wrapped in a camera-like interface.

A view can be created either with a center point and a half-size, or directly from a bounding rectangle :

```cpp
sf::Vector2f Center(1000, 1000);
sf::Vector2f HalfSize(400, 300);
sf::View View1(Center, HalfSize);

// Or

sf::View View2(sf::FloatRect(600, 700, 1400, 1300));
```

All these parameters can be set and get at any time using the accessors :

```cpp
View.SetCenter(500, 300);
View.SetHalfSize(200, 100);

// Or

View.SetFromRect(sf::FloatRect(300, 200, 700, 400));
```

```cpp
sf::Vector2f  Center    = View.GetCenter();
sf::Vector2f  HalfSize  = View.GetHalfSize();
sf::FloatRect Rectangle = View.GetRect();
```

There are also two helper functions to move or zoom (resize) the view :

```cpp
View.Move(10, -5); // Move the view of (10, -5) units
View.Zoom(0.5f);   // Zoom by a factor of 1/2 (ie. unzoom to make the view twice larger)
```

As you can see there's nothing complicated here, only a few functions to control the view's position and size.

## Using a view

To use a view, you need to call the `SetView` function of the [`sf::RenderWindow`](../../../documentation/1.6/classsf_1_1RenderWindow.html "sf::RenderWindow documentation") class :

```cpp
// Use our custom view
App.SetView(View);
```

Any object drawn after the call to `SetView` (and before the next one) will be affected by the view.  
Once set, the render window keeps a link to the view so you can update it without calling `SetView` again, all your modifications will be automatically taken in account.

Every render window has a default view, which always matches the initial size of the window. You can access this view, and even modify it if needed, with the `GetDefaultView` function :

```cpp
sf::View& DefaultView = App.GetDefaultView();
```

The default view is not updated when its window is resized : as a consequence, what's visible in your window will never be affected by its size (ie. you won't see more if you maximize the window), which is exactly what happens with a 3D camera.  
However, you can easily setup a view which always keeps the same dimension as the window, by catching the `sf::Event::Resized` event and updating the view accordingly.

Accessing the default view is also convenient to go back to the initial view. For example, it can be useful if you want to draw a user interface on top of the game, which usually doesn't follow the camera.

```cpp
App.SetView(View);

// Draw the game...

App.SetView(App.GetDefaultView());

// Draw the interface...
```

## Window coordinates and view coordinates

When a custom view is set, or when your window has been resized, don't forget that objects coordinates no longer match the window pixels, be careful to handle conversions if needed (for example, when you test the mouse position with the sprites' rectangles). Always remember that what you actually see is the view rectangle, not the window one.

If you want to convert window coordinates to view coordinates, probably after a mouse clic, you can use the `RenderWindow::ConvertCoords` function :

```cpp
// Get the cursor position in view coordinates
sf::Vector2f MousePos = App.ConvertCoords(App.GetInput().GetMouseX(), App.GetInput().GetMouseY());
```

By default, this function uses the view currently set in the window to perform the conversion. However, you can use any other view by passing its address as the third parameter (which is `NULL` by default).

## Conclusion

2D views provide an easy and convenient way to deal with effects such as scrolling and zooming, with no performances penalty. The only thing to take care of when using views, is the possible conversions that could be needed if you try to map pixels to coordinates.
