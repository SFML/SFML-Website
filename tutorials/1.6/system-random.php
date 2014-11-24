<?php

    $title = "Generating random numbers";
    $page = "system-random.php";

    require("header.php");
?>

<h1>Generating random numbers</h1>

<?php h2('Introduction') ?>
<p>
    Generating pseudo-random numbers is not hard, especially with the <code>rand</code> and <code>srand</code>
    functions from the standard library. But you always end up writing helper functions, for getting a random
    number in a specific range, getting a float random number, etc. That's why SFML provides a helper class,
    <?php class_link("Randomizer")?>, that defines some helper functions.
</p>
<p>
    This document is more a reference than a real tutorial,
    all it does is showing you the <?php class_link("Randomizer")?> functions.
</p>

<?php h2('Setting the seed') ?>
<p>
    The first thing almost every people do in a program using random numbers, is initializing the seed to make sure
    the generated sequence will be different from one run to the other. SFML does it automatically at program startup,
    so you don't have to worry about it.
</p>
<p>
    However, if you want to use a specific seed (for replaying a known sequence), you can use the <code>SetSeed</code>
    function :
</p>
<pre><code class="cpp">unsigned int Seed = 10;
sf::Randomizer::SetSeed(Seed);
</code></pre>
<p>
    You can also get the current seed :
</p>
<pre><code class="cpp">unsigned int Seed = sf::Randomizer::GetSeed();
</code></pre>

<?php h2('Generating random numbers whithin specific ranges') ?>
<p>
    <?php class_link("Randomizer")?> provides two functions for generating random numbers in specific ranges.
</p>
<p>
    The first one generates integers :
</p>
<pre><code class="cpp">// Get a random integer number between 0 and 100
int Random = sf::Randomizer::Random(0, 100);
</code></pre>
<p>
    And the second one generates floats :
</p>
<pre><code class="cpp">// Get a random float number between -1 and 1
float Random = sf::Randomizer::Random(-1.f, 1.f);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    That's all about random numbers. These few functions should be enough for your needs ; however if you need a
    more complete and complex random number library, you can have a look at
    <a class="external" href="http://www.boost.org/libs/random/" title="boost.random webpage">boost.random</a>.
</p>
<p>
    You can now go back to the
    <a class="internal" href="./index.php" title="Back to tutorials index">tutorials index</a>,
    or jump to the
    <a class="internal" href="./window-window.php" title="Jump to the tutorials about the windowing package">tutorials about the windowing package</a>.
</p>

<?php

    require("footer.php");

?>
