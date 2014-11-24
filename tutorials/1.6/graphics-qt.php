<?php

    $title = "Integrating to a Qt interface";
    $page = "graphics-qt.php";

    require("header.php");
?>

<h1>Integrating to a Qt interface</h1>

<?php h2('Introduction') ?>
<p>
    In this tutorial, we'll see how we can integrate a SFML view into a Qt interface. The typical way of adding a new
    feature to a Qt interface is to write a custom widget ; that's what we'll do here.
</p>

<?php h2('Creating the SFML custom widget') ?>
<p>
    To create a custom Qt widget, we need to inherit from the <code>QWidget</code> base class. And as we want our widget
    to be an SFML rendering window too, we'll inherit from <?php class_link("RenderWindow")?>.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;Qt/qwidget.h&gt;

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
    ...
};
</code></pre>
<p>
    Then, what will this class need to work ? First, it will need a standard constructor for defining the usual widget
    parameters : parent widget, position, size. We add a last parameter which is the duration of one frame (the inverse
    of the framerate) ; as Qt doesn't provide an idle event (which would be called each time the event queue is empty),
    we'll have to refresh the widget manually. The best way to do this is to launch a timer, and connect it to a
    function that refreshes the widget at the specified rate. The default value of 0 will make the timer trigger a refresh
    whenever there is no other event to process, which is exactly what an idle event would do.
</p>
<p>
    Then, we need to override the show event : this is a good place to initialize our SFML window. We can't do it in the
    constructor, because at this time the widget doesn't have its final position and size yet.<br/>
    We also override the paint event, to refresh the SFML view.
</p>
<p>
    We'll define two functions for the derived classes : <code>OnInit()</code>, which will be called as soon as
    the SFML view has been created, and <code>OnUpdate()</code>, which will be called before each refresh to let
    the derived class draw things into the widget.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;Qt/qwidget.h&gt;
#include &lt;Qt/qtimer.h&gt;

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
public :

    QSFMLCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size, unsigned int FrameTime = 0);

    virtual ~QSFMLCanvas();

private :

    virtual void OnInit();

    virtual void OnUpdate();

    virtual QPaintEngine* paintEngine() const;

    virtual void showEvent(QShowEvent*);

    virtual void paintEvent(QPaintEvent*);

    QTimer myTimer;
    bool   myInitialized;
};
</code></pre>
<p>
    Let's now have a look at the implementation.
</p>
<pre><code class="cpp">QSFMLCanvas::QSFMLCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size, unsigned int FrameTime) :
QWidget       (Parent),
myInitialized (false)
{
    // Setup some states to allow direct rendering into the widget
    setAttribute(Qt::WA_PaintOnScreen);
    setAttribute(Qt::WA_OpaquePaintEvent);
    setAttribute(Qt::WA_NoSystemBackground);

    // Set strong focus to enable keyboard events to be received
    setFocusPolicy(Qt::StrongFocus);

    // Setup the widget geometry
    move(Position);
    resize(Size);

    // Setup the timer
    myTimer.setInterval(FrameTime);
}
</code></pre>
<p>
    First, the constructor sets some attributes to allow direct rendering into the widget. <code>WA_PaintOnScreen</code>
    tells Qt that we will not use its painting functions, and paint directly into the widget.
    <code>WA_NoSystemBackground</code> and <code>WA_OpaquePaintEvent</code> prevent from drawing the widget's background,
    which could cause some flickering.<br/>
    We also set the <code>Qt::StrongFocus</code> policy, to enable keyboard events to be received by the widget.<br/>
    Then, we set the widget's position and size, and set the timer interval to the requested frame time.
</p>
<pre><code class="cpp">#ifdef Q_WS_X11
    #include &lt;Qt/qx11info_x11.h&gt;
    #include &lt;X11/Xlib.h&gt;
#endif

void QSFMLCanvas::showEvent(QShowEvent*)
{
    if (!myInitialized)
    {
        // Under X11, we need to flush the commands sent to the server to ensure that
        // SFML will get an updated view of the windows
        #ifdef Q_WS_X11
            XFlush(QX11Info::display());
        #endif

        // Create the SFML window with the widget handle
        Create(winId());

        // Let the derived class do its specific stuff
        OnInit();

        // Setup the timer to trigger a refresh at specified framerate
        connect(&amp;myTimer, SIGNAL(timeout()), this, SLOT(repaint()));
        myTimer.start();

        myInitialized = true;
    }
}
</code></pre>
<p>
    In the <code>showEvent</code> function, which is called when the widget is shown, we create the SFML window.
    This is done simply by calling the <code>Create</code> function with the internal identifier of the window, which
    is given by the <code>winId</code> function. Under X11 (Unix), we first need to put a system call to flush the
    message queue, to make sure SFML will see the window.<br/>
    Once the SFML window has been initialized, we can tell the derived class by calling the <code>OnInit</code>
    virtual function.<br/>
    Finally, we connect the timer with the <code>repaint</code> function, which will refresh the widget and trigger a
    paint event. And of course, we start it.
</p>
<pre><code class="cpp">QPaintEngine* QSFMLCanvas::paintEngine() const
{
    return 0;
}
</code></pre>
<p>
    We make the <code>paintEvent</code> function return a null paint engine. This functions works together with
    the <code>WA_PaintOnScreen</code> flag to tell Qt that we're not using any of its built-in paint engines.
</p>
<pre><code class="cpp">void QSFMLCanvas::paintEvent(QPaintEvent*)
{
    // Let the derived class do its specific stuff
    OnUpdate();

    // Display on screen
    Display();
}
</code></pre>
<p>
    The <code>paintEvent</code> function is quite straight-forward : we notify the derived class that a refresh is about
    to be performed, and we call <code>Display</code> to update the widget with our rendered frame.
</p>

<?php h2('Using our Qt-SFML widget') ?>
<p>
    The <code>QSFMLCanvas</code> we just wrote is not usable directly, it is meant to be derived. So, let's
    create a derived widget that will do some nice drawing :
</p>
<pre><code class="cpp">class MyCanvas : public QSFMLCanvas
{
public :

    MyCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size) :
    QSFMLCanvas(Parent, Position, Size)
    {

    }

private :

    void OnInit()
    {
        // Load the image
        myImage.LoadFromFile("datas/qt/sfml.png");

        // Setup the sprite
        mySprite.SetImage(myImage);
        mySprite.SetCenter(mySprite.GetSize() / 2.f);
    }

    void OnUpdate()
    {
        // Clear screen
        Clear(sf::Color(0, 128, 0));

        // Rotate the sprite
        mySprite.Rotate(GetFrameTime() * 100.f);

        // Draw it
        Draw(mySprite);
    }

    sf::Image  myImage;
    sf::Sprite mySprite;
};
</code></pre>
<p>
    Nothing very complicated here : we override <code>OnInit</code> to load and initialize our resources,
    and <code>OnUpdate</code> to draw them.
</p>
<p>
    We can now create a regular Qt window, and put an instance of our custom widget into it :
</p>
<pre><code class="cpp">int main(int argc, char **argv)
{
    QApplication App(argc, argv);

    // Create the main frame
    QFrame* MainFrame = new QFrame;
    MainFrame->setWindowTitle("Qt SFML");
    MainFrame->resize(400, 400);
    MainFrame->show();

    // Create a SFML view inside the main frame
    MyCanvas* SFMLView = new MyCanvas(MainFrame, QPoint(20, 20), QSize(360, 360));
    SFMLView->show();

    return App.exec();
}
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Integration of SFML into a Qt interface is easy with the custom widget we just wrote, feel free to use and improve
    it.<br/>
    If you want to see how SFML integrates into a
    <a class="internal" href="./graphics-wxwidgets.php" title="Go to the next tutorial">wxWidgets interface</a>,
    you can go to the next tutorial.
</p>

<?php

    require("footer.php");

?>
