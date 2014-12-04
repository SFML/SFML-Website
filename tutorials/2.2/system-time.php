<?php

    $title = "Handling time";
    $page = "system-time.php";

    require("header.php");

?>

<h1>Handling time</h1>

<?php h2('Time in SFML') ?>
<p>
    Unlike many other libraries where time is a uint32 number of milliseconds, or a float number of seconds, SFML doesn't impose any specific unit or
    type for time values. Instead it leaves this choice to the user through a flexible class: <?php class_link("Time") ?>. All SFML classes and functions
    that manipulate time values use this class.
</p>
<p>
    <?php class_link("Time") ?> represents a time period (in other words, the time that elapses between two events). It is <em>not</em> a date-time class which would represent the
    current year/month/day/hour/minute/second as a timestamp, it's just a value that represents a certain amount of time, and how to interpret it depends on the context
    where it is used.
</p>

<?php h2('Converting time') ?>
<p>
    A <?php class_link("Time") ?> value can be constructed from different source units: seconds, milliseconds and microseconds. There is a (non-member)
    function to turn each of them into a <?php class_link("Time") ?>:
</p>
<pre><code class="cpp">sf::Time t1 = sf::microseconds(10000);
sf::Time t2 = sf::milliseconds(10);
sf::Time t3 = sf::seconds(0.01f);
</code></pre>
<p>
    Note that these three times are all equal.
</p>
<p>
    Similarly, a <?php class_link("Time") ?> can be converted back to either seconds, milliseconds or microseconds:
</p>
<pre><code class="cpp">sf::Time time = ...;

sf::Int64 usec = time.asMicroseconds();
sf::Int32 msec = time.asMilliseconds();
float     sec  = time.asSeconds();
</code></pre>

<?php h2('Playing with time values') ?>
<p>
    <?php class_link("Time") ?> is just an amount of time, so it supports arithmetic operations such as addition, subtraction, comparison, etc.
    Times can also be negative.
</p>
<pre><code class="cpp">sf::Time t1 = ...;
sf::Time t2 = t1 * 2;
sf::Time t3 = t1 + t2;
sf::Time t4 = -t3;

bool b1 = (t1 == t2);
bool b2 = (t3 > t4);
</code></pre>

<?php h2('Measuring time') ?>
<p>
    Now that we've seen how to manipulate time values with SFML, let's see how to do something that almost every program needs: measuring the time elapsed.
</p>
<p>
    SFML has a very simple class for measuring time: <?php class_link("Clock") ?>. It only has two functions: <code>getElapsedTime</code>, to retrieve
    the time elapsed since the clock started, and <code>restart</code>, to restart the clock.
</p>
<pre><code class="cpp">sf::Clock clock; // starts the clock
...
sf::Time elapsed1 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed1.asSeconds() &lt;&lt; std::endl;
clock.restart();
...
sf::Time elapsed2 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed2.asSeconds() &lt;&lt; std::endl;
</code></pre>
<p>
    Note that <code>restart</code> also returns the elapsed time, so that you can avoid the slight gap that would exist if you had to call
    <code>getElapsedTime</code> explicitly before <code>restart</code>.<br />
    Here is an example that uses the time elapsed at each iteration of the game loop to update the game logic:
</p>
<pre><code class="cpp">sf::Clock clock;
while (window.isOpen())
{
    sf::Time elapsed = clock.restart();
    updateGame(elapsed);
    ...
}
</code></pre>

<?php

    require("footer.php");

?>
