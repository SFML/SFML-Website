# Integrating to a Qt interface

!!! warning ""

    You're reading a tutorial for SFML 1.6, which doesn't exist anymore in the latest version. Check out the [latest tutorials](/tutorials/latest/).

## Introduction

In this tutorial, we'll see how we can integrate a SFML view into a Qt interface. The typical way of adding a new feature to a Qt interface is to write a custom widget ; that's what we'll do here.

## Creating the SFML custom widget

To create a custom Qt widget, we need to inherit from the `QWidget` base class. And as we want our widget to be an SFML rendering window too, we'll inherit from [`sf::RenderWindow`](../../../documentation/1.6/classsf_1_1RenderWindow.html "sf::RenderWindow documentation").

```cpp
#include <SFML/Graphics.hpp>
#include <Qt/qwidget.h>

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
    ...
};
```

Then, what will this class need to work ? First, it will need a standard constructor for defining the usual widget parameters : parent widget, position, size. We add a last parameter which is the duration of one frame (the inverse of the framerate) ; as Qt doesn't provide an idle event (which would be called each time the event queue is empty), we'll have to refresh the widget manually. The best way to do this is to launch a timer, and connect it to a function that refreshes the widget at the specified rate. The default value of 0 will make the timer trigger a refresh whenever there is no other event to process, which is exactly what an idle event would do.

Then, we need to override the show event : this is a good place to initialize our SFML window. We can't do it in the constructor, because at this time the widget doesn't have its final position and size yet.  
We also override the paint event, to refresh the SFML view.

We'll define two functions for the derived classes : `OnInit()`, which will be called as soon as the SFML view has been created, and `OnUpdate()`, which will be called before each refresh to let the derived class draw things into the widget.

```cpp
#include <SFML/Graphics.hpp>
#include <Qt/qwidget.h>
#include <Qt/qtimer.h>

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
public :

    QSFMLCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size, unsigned int FrameTime = 0);

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
```

Let's now have a look at the implementation.

```cpp
QSFMLCanvas::QSFMLCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size, unsigned int FrameTime) :
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
```

First, the constructor sets some attributes to allow direct rendering into the widget. `WA_PaintOnScreen` tells Qt that we will not use its painting functions, and paint directly into the widget. `WA_NoSystemBackground` and `WA_OpaquePaintEvent` prevent from drawing the widget's background, which could cause some flickering.  
We also set the `Qt::StrongFocus` policy, to enable keyboard events to be received by the widget.  
Then, we set the widget's position and size, and set the timer interval to the requested frame time.

```cpp
#ifdef Q_WS_X11
    #include <Qt/qx11info_x11.h>
    #include <X11/Xlib.h>
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
        connect(&myTimer, SIGNAL(timeout()), this, SLOT(repaint()));
        myTimer.start();

        myInitialized = true;
    }
}
```

In the `showEvent` function, which is called when the widget is shown, we create the SFML window. This is done simply by calling the `Create` function with the internal identifier of the window, which is given by the `winId` function. Under X11 (Unix), we first need to put a system call to flush the message queue, to make sure SFML will see the window.  
Once the SFML window has been initialized, we can tell the derived class by calling the `OnInit` virtual function.  
Finally, we connect the timer with the `repaint` function, which will refresh the widget and trigger a paint event. And of course, we start it.

```cpp
QPaintEngine* QSFMLCanvas::paintEngine() const
{
    return 0;
}
```

We make the `paintEvent` function return a null paint engine. This functions works together with the `WA_PaintOnScreen` flag to tell Qt that we're not using any of its built-in paint engines.

```cpp
void QSFMLCanvas::paintEvent(QPaintEvent*)
{
    // Let the derived class do its specific stuff
    OnUpdate();

    // Display on screen
    Display();
}
```

The `paintEvent` function is quite straight-forward : we notify the derived class that a refresh is about to be performed, and we call `Display` to update the widget with our rendered frame.

## Using our Qt-SFML widget

The `QSFMLCanvas` we just wrote is not usable directly, it is meant to be derived. So, let's create a derived widget that will do some nice drawing :

```cpp
class MyCanvas : public QSFMLCanvas
{
public :

    MyCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size) :
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
```

Nothing very complicated here : we override `OnInit` to load and initialize our resources, and `OnUpdate` to draw them.

We can now create a regular Qt window, and put an instance of our custom widget into it :

```cpp
int main(int argc, char **argv)
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
```

## Conclusion

Integration of SFML into a Qt interface is easy with the custom widget we just wrote, feel free to use and improve it.  
If you want to see how SFML integrates into a [wxWidgets interface](wxwidgets.md "Go to the next tutorial"), you can go to the next tutorial.
