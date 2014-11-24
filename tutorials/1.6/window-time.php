<?php

    $title = "Handling time";
    $page = "window-time.php";

    require("header.php");
?>

<h1>Handling time</h1>

<?php h2('Introduction') ?>
<p>
    Time is usually not a big thing, but in a real-time application, it is important to handle it
    properly, as we will see in this new tutorial.
</p>

<?php h2('Measuring time') ?>
<p>
    In SFML, you measure time with <?php class_link("Clock")?> class. It defines two functions :
    <code>Reset()</code>, to restart the clock, and <code>GetElapsedTime()</code>,
    to get the time elapsed since the last call to <code>Reset()</code>. Time is defined in
    seconds, as all durations that you will find in SFML.<br/>
    As you can see, this class is far from being complicated.
</p>
<pre><code class="cpp">sf::Clock Clock;

while (App.IsOpened())
{
    // Process events...

    // Get elapsed time since last loop
    float Time = Clock.GetElapsedTime();
    Clock.Reset();

    // Display window...
}
</code></pre>
<p>
    Getting elapsed time can be very useful if you have to increment a variable at each loop (a position,
    an orientation, ...). If you don't take in account the time factor, your simulation won't produce the
    same results whether the application runs at 60 frames per seconds or at 1000 frames per seconds.
    For example, this piece of code will make movement dependant on framerate :
</p>
<pre><code class="cpp">const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed;
}
</code></pre>
<p>
    Whereas this one will ensure constant speed on every hardware :
</p>
<pre><code class="cpp">sf::Clock Clock;

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
</code></pre>
<p>
    Most of time, you will have to measure the time elapsed since last frame.
    <?php class_link("Window")?> provides a useful function for getting this time without having to
    manage a clock : <code>GetFrameTime()</code>. So we could rewrite our code like this :
</p>
<pre><code class="cpp">const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * App.GetFrameTime();
}
</code></pre>

<?php h2('Measuring framerate') ?>
<p>
    As framerate is the inverse of the duration of one frame, you can easily deduce it from elapsed time
    between frames :
</p>
<pre><code class="cpp">sf::Clock Clock;

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
</code></pre>
<p>
    If your framerate gets stuck around 60 fps don't worry : it just means that vertical synchronization
    (v-sync) is enabled. Basically, when v-sync is on, display will be synchronized with the monitor
    refresh rate. It means you won't be able to display more frames than the monitor can do. And this is
    a good thing, as it ensures your application won't run at incredible framerates like 2000 fps, and
    produce bad visual artifacts or unpredicted behaviors.
</p>
<p>
    However, you sometimes want to do some benchmark for optimizations, and you want maximum framerate.
    SFML allows you to disable vertical synchronization if you want, with the
    <code>UseVerticalSync</code> function :
</p>
<pre><code class="cpp">App.UseVerticalSync(false);
</code></pre>
<p>
    Note that vertical synchronization is disabled by default.
</p>
<p>
    You can also set the framerate to a fixed limit :
</p>
<pre><code class="cpp">App.SetFramerateLimit(60); // Limit to 60 frames per second
App.SetFramerateLimit(0);  // No limit
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Time handling has no more secret for you now, and you can start to write robust real-time applications. In
    the <a class="internal" href="./window-opengl.php" title="Next turorial : using OpenGL">next tutorial</a>,
    we'll play a bit with OpenGL, to finally get something to display in our window.<br/>
    However, if you're not interested in using OpenGL with SFML, you can jump directly to the next section
    about the <a class="internal" href="./graphics-window.php" title="Opening a rendering window">graphics package</a>.
</p>

<?php

    require("footer.php");

?>
