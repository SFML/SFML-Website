<?php

    $title = "SFML and Linux";
    $page = "start-linux.php";

    require("header.php");

?>

<h1>SFML and Linux</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML on Linux. It will explain how to install SFML, and compile projects that use it.
</p>

<?php h2('Installing SFML') ?>
<p>
    There are different approaches to the installation of SFML on Linux:
</p>
<ul>
    <li>Install it directly from your distribution's package repository</li>
    <li>Get the source code, build it and install it</li>
    <li>Download the precompiled SDK and manually copy the files</li>
</ul>
<p>
    Option 1 is the preferred one; if the version of SFML that you want to install is available in the official repository, then install it using your
    package manager. For example, on Debian you would do:
</p>
<pre><code class="no-highlight">sudo apt-get install libsfml-dev</code></pre>
<p>
    Option 2 requires more work: you need to ensure all of SFML's dependencies including their development headers are available, make sure CMake is installed, and manually
    execute some commands. This will result in a package which is tailored to your system.<br />
    If you want to go this way, there's a dedicated tutorial on
    <a class="internal" href="./compile-with-cmake.php" title="How to compile SFML">building SFML yourself</a>.
</p>
<p>
    Finally, option 3 is a good choice for quick installation if SFML is not available as an official package. Download the SDK
    from the <a class="internal" href="../../download.php" title="Go to the download page">download page</a>, unpack it and copy the files to your
    preferred location: either a separate path in your personal folder (like <em>/home/me/sfml</em>), or a standard path (like <em>/usr/local</em>).
</p>
<p>
    If you already had an older version of SFML installed, make sure that it won't conflict with the new version!
</p>

<?php h2('Compiling a SFML program') ?>
<p>
    In this tutorial we're not going to talk about IDEs such as Code::Blocks or Eclipse. We'll focus on the commands required to compile and link an
    SFML executable. Writing a complete makefile or configuring a project in an IDE is beyond the scope of this tutorial -- there are better dedicated
    tutorials for this.<br />
    If you're using Code::Blocks, you may refer to the
    <a class="internal" href="./start-cb.php" title="SFML and Code::Blocks">Code::Blocks tutorial for Windows</a>; many things should be similar.
    You won't have to set the compiler and linker search paths if you installed SFML to one of your system's standard paths.
</p>
<p>
    First, create a source file. For this tutorial we'll name it "main.cpp". Put the following code inside the main.cpp file:
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;

int main()
{
    sf::RenderWindow window(sf::VideoMode(200, 200), "SFML works!");
    sf::CircleShape shape(100.f);
    shape.setFillColor(sf::Color::Green);

    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }

        window.clear();
        window.draw(shape);
        window.display();
    }

    return 0;
}
</code></pre>
<p>
    Now let's compile it:
</p>
<pre><code class="no-highlight">g++ -c main.cpp</code></pre>
<p>
    In case you installed SFML to a non-standard path, you'll need to tell the compiler where to find the SFML headers (.hpp files):
</p>
<pre><code class="no-highlight">g++ -c main.cpp -I<em>&lt;sfml-install-path&gt;</em>/include</code></pre>
<p>
    Here, <em>&lt;sfml-install-path&gt;</em> is the directory where you copied SFML, for example <em>/home/me/sfml</em>.
</p>
<p>
    You must then link the compiled file to the SFML libraries in order to get the final executable. SFML is made of 5 modules (system, window, graphics,
    network and audio), and there's one library for each of them.<br />
    To link an SFML library, you must add "-lsfml-xxx" to your command line, for example "-lsfml-graphics" for the graphics module
    (the "lib" prefix and the ".so" extension of the library file name must be omitted).
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    If you installed SFML to a non-standard path, you'll need to tell the linker where to find the SFML libraries (.so files):
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -L<em>&lt;sfml-install-path&gt;</em>/lib -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    We are now ready to execute the compiled program:
</p>
<pre><code class="no-highlight">./sfml-app</code></pre>
<p>
    If SFML is not installed in a standard path, you need to tell the dynamic linker where to find the SFML libraries first by specifying LD_LIBRARY_PATH:
</p>
<pre><code class="no-highlight">export LD_LIBRARY_PATH=<em>&lt;sfml-install-path&gt;</em>/lib &amp;&amp; ./sfml-app</code></pre>
<p>
    If everything works, you should see this in a new window:
</p>
<img class="screenshot" src="./images/start-linux-app.png" alt="Screenshot of the Hello SFML application" title="Screenshot of the Hello SFML application" />

<?php

    require("footer.php");

?>
