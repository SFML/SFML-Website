# Integrating to a wxWidgets interface

## Introduction

The best way to integrate some SFML graphics to a wxWidgets interface is to create a specialized type of control. In this tutorial, we'll define a `wxSFMLCanvas` class that will be a base class for creating your custom rendering controls.

## Creating a custom control

Let's have a look at what we need to define a wx/SFML control. To create a custom wxWidgets control, we must inherit from the base class `wxControl`. And, to allow our control to be a SFML view, we also inherit from [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation").

```cpp
#include <SFML/Graphics.hpp>
#include <wx/wx.h>

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
    // ...
};
```

What are we going to put into this class ? Well, nothing much in the public interface, as all the useful functions will be brought by both `wxControl` and [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"). In fact, from wxWidgets' point of view `wxSFMLCanvas` will be like any other control, and from SFML's point of view it will be like any other rendering window. That's the power of inheritance.

So, in the public interface we only need a standard constructor, which will take the usual parameters that define a wxWidgets control (parent, identifier, position, size, style), and a destructor which will be empty but needs to be virtual, as `wxSFMLCanvas` will be used as a base class.

Then, in the private part of our class, we'll need to define a few functions that will be bound to some useful events. We'll need to catch the idle event, which is the event that is triggered when there is no event to process, the paint event, and the erase-background event. The idle event will be useful for updating our control as often as possible ; the paint event will be called each time the control needs to be repainted, so we'll put our SFML rendering code in it. Finally, we won't put anything into the erase-background event, we override it just to prevent wxWidgets from drawing it, which would cause some flickering.

We also need to define one virtual function, to notify the derived class window updates.

Let's put this all together, and see what our class would look like :

```cpp
#include <SFML/Graphics.hpp>
#include <wx/wx.h>

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
public :

    wxSFMLCanvas(wxWindow* Parent = NULL, wxWindowID Id = -1, const wxPoint& Position = wxDefaultPosition,
                 const wxSize& Size = wxDefaultSize, long Style = 0);

    virtual ~wxSFMLCanvas();

private :

    DECLARE_EVENT_TABLE()

    virtual void OnUpdate();

    void OnIdle(wxIdleEvent&);

    void OnPaint(wxPaintEvent&);

    void OnEraseBackground(wxEraseEvent&);
};
```

Almost every function will be empty, we only need to explain three of them : `OnIdle`, `OnPaint` and the constructor. The latter will contain all the hardly-understandable-platform-specific part of the code, so we'll leave it for the end.

First, let's have a look at the `OnIdle` function :

```cpp
void wxSFMLCanvas::OnIdle(wxIdleEvent&)
{
    // Send a paint message when the control is idle, to ensure maximum framerate
    Refresh();
}
```

That was really easy, wasn't it ? The `Refresh` function is defined in `wxControl`, and will trigger a repaint event to update the control. By calling it in the idle event, we ensure maximum framerate for our SFML view.

The paint event is not much more complicated :

```cpp
void wxSFMLCanvas::OnPaint(wxPaintEvent&)
{
    // Prepare the control to be repainted
    wxPaintDC Dc(this);

    // Let the derived class do its specific stuff
    OnUpdate();

    // Display on screen
    Display();
}
```

The first thing we do in the paint function is to create a `wxPaintDC` object, and pass it a pointer to our control. Doing this will "lock" the graphic area of the control, and ensure we'll be able to draw into it. Forgetting to do it would result in weaird things.

Now, let's see how we link our wxWidgets control and a SFML render window. This part heavily depends on the underlying wxWidgets implementation, so don't focus too much on it.

```cpp
#ifdef __WXGTK__
    #include <gdk/gdkx.h>
    #include <gtk/gtk.h>
    #include <wx/gtk/win_gtk.h>
#endif

wxSFMLCanvas::wxSFMLCanvas(wxWindow* Parent, wxWindowID Id, const wxPoint& Position, const wxSize& Size, long Style) :
wxControl(Parent, Id, Position, Size, Style)
{
    #ifdef __WXGTK__

        // GTK implementation requires to go deeper to find the
        // low-level X11 identifier of the widget
        gtk_widget_realize(m_wxwindow);
        gtk_widget_set_double_buffered(m_wxwindow, false);
        GdkWindow* Win = GTK_PIZZA(m_wxwindow)->bin_window;
        XFlush(GDK_WINDOW_XDISPLAY(Win));
        sf::RenderWindow::Create(GDK_WINDOW_XWINDOW(Win));

    #else

        // Tested under Windows XP only (should work with X11
        // and other Windows versions - no idea about MacOS)
        sf::RenderWindow::Create(GetHandle());

    #endif
}
```

As you can see, the implementation which requires more attention is the GTK one. As GTK is not the lowest level, we need to go deeper to get the internal window handle. We also need to realize the widget (to make sure it is actually created), and disable the double-buffering provided by GTK, as we already have our own one.  
And yes, GTK_PIZZA is quite a weird name, I still don't understand it.

For other implementations (WXMSW, WXX11) directly giving the identifier returned by `GetHandle` will be enough.

## Creating the wxWidgets interface and using our custom control

Now that we have a generic SFML / wxWidgets component, let's specialize it to do something useful. Here we'll define a simple custom control that displays a sprite.

```cpp
class MyCanvas : public wxSFMLCanvas
{
public :

    MyCanvas(wxWindow*  Parent,
             wxWindowID Id,
             wxPoint&   Position,
             wxSize&    Size,
             long       Style = 0) :
    wxSFMLCanvas(Parent, Id, Position, Size, Style)
    {
        // Load an image and assign it to our sprite
        myImage.LoadFromFile("sprite.png");
        mySprite.SetImage(myImage);
    }

private :

    virtual void OnUpdate()
    {
        // Clear the view
        Clear(sf::Color(0, 128, 128));

        // Display the sprite in the view
        Draw(mySprite);
    }

    sf::Image  myImage;
    sf::Sprite mySprite;
};
```

Then we create the main window of the application, into which we'll create a SFML view with our custom component :

```cpp
class MyFrame : public wxFrame
{
public :

    MyFrame() :
    wxFrame(NULL, wxID_ANY, "SFML wxWidgets", wxDefaultPosition, wxSize(800, 600))
    {
        new MyCanvas(this, wxID_ANY, wxPoint(50, 50), wxSize(700, 500));
    }
};
```

And finally, the application class :

```cpp
class MyApplication : public wxApp
{
private :

    virtual bool OnInit()
    {
        // Create the main window
        MyFrame* MainFrame = new MyFrame;
        MainFrame->Show();

        return true;
    }
};

IMPLEMENT_APP(MyApplication);
```

## Conclusion

With this component, you can integrate SFML into your wxWidgets interfaces very easily. Feel free to use it and improve it !  
That was the last tutorial about SFML graphics package. You can now go and create your own graphics software, or you can jump to [another section](../index.md "Go back to tutorials index") to learn a new package.
