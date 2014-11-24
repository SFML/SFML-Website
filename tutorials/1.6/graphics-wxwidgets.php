<?php

    $title = "Integrating to a wxWidgets interface";
    $page = "graphics-wxwidgets.php";

    require("header.php");
?>

<h1>Integrating to a wxWidgets interface</h1>

<?php h2('Introduction') ?>
<p>
    The best way to integrate some SFML graphics to a wxWidgets interface is to create a specialized type
    of control. In this tutorial, we'll define a <code>wxSFMLCanvas</code> class that will
    be a base class for creating your custom rendering controls.
</p>

<?php h2('Creating a custom control') ?>
<p>
    Let's have a look at what we need to define a wx/SFML control. To create a custom wxWidgets control, we must
    inherit from the base class <code>wxControl</code>. And, to allow our control to be a SFML view, we also inherit
    from <?php class_link("RenderWindow")?>.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;wx/wx.h&gt;

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
    // ...
};
</code></pre>
<p>
    What are we going to put into this class ? Well, nothing much in the public interface, as all the useful
    functions will be brought by both <code>wxControl</code> and <?php class_link("RenderWindow")?>. In fact, from wxWidgets'
    point of view <code>wxSFMLCanvas</code> will be like any other control, and from SFML's point of view it will be
    like any other rendering window. That's the power of inheritance.
</p>
<p>
    So, in the public interface we only need a standard constructor, which will take the usual parameters that
    define a wxWidgets control (parent, identifier, position, size, style), and a destructor which will be empty
    but needs to be virtual, as <code>wxSFMLCanvas</code> will be used as a base class.
</p>
<p>
    Then, in the private part of our class, we'll need to define a few functions that will be bound to some useful
    events. We'll need to catch the idle event, which is the event that is triggered when there is no event to
    process, the paint event, and the erase-background event. The idle event will be useful for updating our control as
    often as possible ; the paint event will be called each time the control needs to be repainted, so we'll put our
    SFML rendering code in it. Finally, we won't put anything into the erase-background event, we override it
    just to prevent wxWidgets from drawing it, which would cause some flickering.
</p>
<p>
    We also need to define one virtual function, to notify the derived class window updates.
</p>
<p>
    Let's put this all together, and see what our class would look like :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;wx/wx.h&gt;

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
public :

    wxSFMLCanvas(wxWindow* Parent = NULL, wxWindowID Id = -1, const wxPoint&amp; Position = wxDefaultPosition,
                 const wxSize&amp; Size = wxDefaultSize, long Style = 0);

    virtual ~wxSFMLCanvas();

private :

    DECLARE_EVENT_TABLE()

    virtual void OnUpdate();

    void OnIdle(wxIdleEvent&amp;);

    void OnPaint(wxPaintEvent&amp;);

    void OnEraseBackground(wxEraseEvent&amp;);
};
</code></pre>

<p>
    Almost every function will be empty, we only need to explain three of them : <code>OnIdle</code>, <code>OnPaint</code> and
    the constructor. The latter will contain all the hardly-understandable-platform-specific part of the
    code, so we'll leave it for the end.
</p>
<p>
    First, let's have a look at the <code>OnIdle</code> function :
</p>
<pre><code class="cpp">void wxSFMLCanvas::OnIdle(wxIdleEvent&amp;)
{
    // Send a paint message when the control is idle, to ensure maximum framerate
    Refresh();
}
</code></pre>
<p>
    That was really easy, wasn't it ? The <code>Refresh</code> function is defined in <code>wxControl</code>, and will
    trigger a repaint event to update the control. By calling it in the idle event, we ensure maximum framerate
    for our SFML view.
</p>
<p>
    The paint event is not much more complicated :
</p>
<pre><code class="cpp">void wxSFMLCanvas::OnPaint(wxPaintEvent&amp;)
{
    // Prepare the control to be repainted
    wxPaintDC Dc(this);

    // Let the derived class do its specific stuff
    OnUpdate();

    // Display on screen
    Display();
}
</code></pre>
<p>
    The first thing we do in the paint function is to create a <code>wxPaintDC</code> object, and pass it a pointer to
    our control. Doing this will "lock" the graphic area of the control, and ensure we'll be able to draw into it.
    Forgetting to do it would result in weaird things.
</p>
<p>
    Now, let's see how we link our wxWidgets control and a SFML render window. This part heavily depends on the underlying
    wxWidgets implementation, so don't focus too much on it.
</p>
<pre><code class="cpp">#ifdef __WXGTK__
    #include &lt;gdk/gdkx.h&gt;
    #include &lt;gtk/gtk.h&gt;
    #include &lt;wx/gtk/win_gtk.h&gt;
#endif

wxSFMLCanvas::wxSFMLCanvas(wxWindow* Parent, wxWindowID Id, const wxPoint&amp; Position, const wxSize&amp; Size, long Style) :
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
</code></pre>
<p>
    As you can see, the implementation which requires more attention is the GTK one. As GTK is not the lowest level,
    we need to go deeper to get the internal window handle. We also need to realize the widget (to make sure it is actually
    created), and disable the double-buffering provided by GTK, as we already have our own one.<br/>
    And yes, GTK_PIZZA is quite a weird name, I still don't understand it.
</p>
<p>
    For other implementations (WXMSW, WXX11) directly giving the identifier returned by <code>GetHandle</code>
    will be enough.
</p>

<?php h2('Creating the wxWidgets interface and using our custom control') ?>
<p>
    Now that we have a generic SFML / wxWidgets component, let's specialize it to do something
    useful. Here we'll define a simple custom control that displays a sprite.
</p>
<pre><code class="cpp">class MyCanvas : public wxSFMLCanvas
{
public :

    MyCanvas(wxWindow*  Parent,
             wxWindowID Id,
             wxPoint&amp;   Position,
             wxSize&amp;    Size,
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
</code></pre>
<p>
    Then we create the main window of the application, into which we'll create a SFML view with
    our custom component :
</p>
<pre><code class="cpp">class MyFrame : public wxFrame
{
public :

    MyFrame() :
    wxFrame(NULL, wxID_ANY, "SFML wxWidgets", wxDefaultPosition, wxSize(800, 600))
    {
        new MyCanvas(this, wxID_ANY, wxPoint(50, 50), wxSize(700, 500));
    }
};
</code></pre>
<p>
    And finally, the application class :
</p>
<pre><code class="cpp">class MyApplication : public wxApp
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
</code></pre>

<?php h2('Conclusion') ?>
<p>
    With this component, you can integrate SFML into your wxWidgets interfaces very easily.
    Feel free to use it and improve it !<br/>
    That was the last tutorial about SFML graphics package. You can now go and create your own
    graphics software, or you can jump to
    <a class="internal" href="./index.php" title="Go back to tutorials index">another section</a>
    to learn a new package.
</p>

<?php

    require("footer.php");

?>
