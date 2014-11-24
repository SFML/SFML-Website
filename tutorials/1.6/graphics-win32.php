<?php

    $title = "Integrating to a Win32 interface";
    $page = "graphics-win32.php";

    require("header.php");
?>

<h1>Integrating to a Win32 interface</h1>

<?php h2('Introduction') ?>
<p>
    In this new tutorial, we'll have a look at how SFML integrates into a Win32 interface. If you are not
    familiar to Win32 interfaces you can first read a tutorial about it, as we won't explain Win32 programming in
    this tutorial, only the way to put SFML into Win32 controls.
</p>

<?php h2('Win32 window creation') ?>
<p>
    First, we have to create a Win32 interface. We'll create a main window, and two views into which
    we'll display SFML graphics. The following piece of code is just regular Win32 code, no SFML specific
    code is involved yet :
</p>
<pre><code class="cpp">// Define a class for our main window
WNDCLASS WindowClass;
WindowClass.style         = 0;
WindowClass.lpfnWndProc   = &amp;OnEvent;
WindowClass.cbClsExtra    = 0;
WindowClass.cbWndExtra    = 0;
WindowClass.hInstance     = Instance;
WindowClass.hIcon         = NULL;
WindowClass.hCursor       = 0;
WindowClass.hbrBackground = reinterpret_cast&lt;HBRUSH&gt;(COLOR_BACKGROUND);
WindowClass.lpszMenuName  = NULL;
WindowClass.lpszClassName = "SFML App";
RegisterClass(&amp;WindowClass);

// Let's create the main window
HWND Window = CreateWindow("SFML App", "SFML Win32", WS_SYSMENU | WS_VISIBLE, 0, 0, 800, 600, NULL, NULL, Instance, NULL);

// Let's create two SFML views
DWORD Style = WS_CHILD | WS_VISIBLE | WS_CLIPSIBLINGS;
HWND  View1 = CreateWindow("STATIC", NULL, Style, 50,  100, 300, 400, Window, NULL, Instance, NULL);
HWND  View2 = CreateWindow("STATIC", NULL, Style, 400, 100, 300, 400, Window, NULL, Instance, NULL);
</code></pre>
<p>
    We keep the callback event function as its simplest form :
</p>
<pre><code class="cpp">LRESULT CALLBACK OnEvent(HWND Handle, UINT Message, WPARAM WParam, LPARAM LParam)
{
    switch (Message)
    {
        // Quit when we close the main window
        case WM_CLOSE :
        {
            PostQuitMessage(0);
            return 0;
        }
    }
    
    return DefWindowProc(Handle, Message, WParam, LParam);
}
</code></pre>

<?php h2('Defining SFML views') ?>
<p>
    Once all interface components are created, we can define our SFML views. To do so, we just construct
    our <?php class_link("RenderWindow")?> instances with the controls handles :
</p>
<pre><code class="cpp">sf::RenderWindow SFMLView1(View1);
sf::RenderWindow SFMLView2(View2);

// Or, if you want to do it after construction :

SFMLView1.Create(View1);
SFMLView2.Create(View2);
</code></pre>
<p>
    And that's it, you have two SFML rendering windows that will display SFML graphics into the specified
    interface controls.
</p>

<?php h2('The main loop') ?>
<p>
    The main loop is a regular Win32 loop :
</p>
<pre><code class="cpp">MSG Message;
Message.message = ~WM_QUIT;
while (Message.message != WM_QUIT)
{
    if (PeekMessage(&amp;Message, NULL, 0, 0, PM_REMOVE))
    {
        // If a message was waiting in the message queue, process it
        TranslateMessage(&amp;Message);
        DispatchMessage(&amp;Message);
    }
    else
    {
        // SFML rendering code goes here
    }
}
</code></pre>
<p>
    Then we can insert our SFML code :
</p>
<pre><code class="cpp">// Clear views
SFMLView1.Clear();
SFMLView2.Clear();

// Draw sprite 1 on view 1
SFMLView1.Draw(Sprite1);

// Draw sprite 2 on view 2
SFMLView2.Draw(Sprite2);

// Display each view on screen
SFMLView1.Display();
SFMLView2.Display();
</code></pre>
<p>
    Don't forget to clean up Win32 resources before exiting the application :
</p>
<pre><code class="cpp">// Destroy the main window
DestroyWindow(Window);

// Don't forget to unregister the window class
UnregisterClass("SFML App", Instance);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Integrating SFML into a Win32 interface is not complicated, and if you are used to Win32
    programming it won't require more effort than any other SFML application.<br/>
    Let's see now if SFML is as good to integrate into
    <a class="internal" href="./graphics-x11.php" title="Go to next tutorial">X11 (Unix) interfaces</a>.
</p>

<?php

    require("footer.php");

?>
