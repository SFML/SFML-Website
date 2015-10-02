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
    <li>Download the precompiled SDK and manually copy the files</li>
    <li>Get the source code, build it and install it</li>
</ul>
<p>
    Option 1 is the preferred one; if the version of SFML that you want to install is available in the official repository, then install it using your
    package manager. For example, on Debian you would do:
</p>
<pre><code class="no-highlight">sudo apt-get install libsfml-dev</code></pre>
<p>
    Option 3 requires more work: you need to ensure all of SFML's dependencies including their development headers are available, make sure CMake is installed, and manually
    execute some commands. This will result in a package which is tailored to your system.<br />
    If you want to go this way, there's a dedicated tutorial on
    <a class="internal" href="./compile-with-cmake.php" title="How to compile SFML">building SFML yourself</a>.
</p>
<p>
    Finally, option 2 is a good choice for quick installation if SFML is not available as an official package. Download the SDK
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
<p class="important">
    It is important to link to the libraries that match the configuration: "sfml-xxx-d" for Debug, and "sfml-xxx" for Release. A bad mix may result
    in crashes.
</p>
<p>
    If you installed SFML to a non-standard path, you'll need to tell the linker where to find the SFML libraries (.so files):
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -L<em>&lt;sfml-install-path&gt;</em>/lib -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p class="important">
    When linking to multiple SFML libraries, make sure that you link them in the right order, it is very important for GCC. The rule is that libraries
    that depend on other libraries must be put first in the list. Every SFML library depends on sfml-system, and sfml-graphics also depends on
    sfml-window. So, the correct order for these three libraries would be: sfml-graphics, sfml-window, sfml-system -- as used in the command lines
    above.
</p>
<p>
    The settings shown here will result in your application being linked to the dynamic version of SFML, the one that makes use of shared object files.
    If you don't want to rely on these shared object files and have SFML directly integrated into your executable, you must link to the static version.
    Static SFML libraries have the "-s" suffix: "sfml-xxx-s-d" for Debug, and "sfml-xxx-s" for Release.<br />
    In this case, you'll also need to define the SFML_STATIC macro in the preprocessor options of your project.
</p>
<p class="important">
    Starting from SFML 2.2, when static linking, you will have to link all of SFML's dependencies to your project as well. This means that if you are linking
    sfml-window-s or sfml-window-s-d for example, you will also have to link GL, xcb, xcb-image, xcb-randr, X11-xcb, X11, Xext and udev. These dependency libraries
    come as part of development packages you can install using your distribution's package manager.
</p>
<p>
    Here are the dependencies of each module, append the -d as described above if you want to link the SFML debug libraries:
</p>
<table class="styled expanded">
    <thead>
        <tr>
            <th class="expand-left">Module</th>
            <th class="expand-right">Dependencies</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>sfml-graphics-s</code></td>
            <td><ul>
                <li>sfml-window-s</li>
                <li>sfml-system-s</li>
                <li>GL</li>
                <li>freetype</li>
                <li>jpeg</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-window-s</code></td>
            <td><ul>
                <li>sfml-system-s</li>
                <li>GL</li>
                <li>xcb</li>
                <li>xcb-image</li>
                <li>xcb-randr</li>
                <li>X11-xcb</li>
                <li>X11</li>
                <li>Xext</li>
                <li>udev</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-audio-s</code></td>
            <td><ul>
                <li>sfml-system-s</li>
                <li>openal</li>
                <li>FLAC</li>
                <li>vorbisenc</li>
                <li>vorbisfile</li>
                <li>vorbis</li>
                <li>ogg</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-network-s</code></td>
            <td><ul>
                <li>sfml-system-s</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-system-s</code></td>
            <td><ul>
                <li>pthread</li>
                <li>rt</li>
            </ul></td>
        </tr>
    </tbody>
</table>
<p>
    You might have noticed from the table that SFML modules can also depend on one another, e.g. sfml-graphics-s depends both on sfml-window-s and sfml-system-s.
    If you static link to an SFML library, make sure to link to the dependencies of the library in question, as well as the dependencies of the dependencies
    and so on. If anything along the dependency chain is missing, you <em>will</em> get linker errors.
</p>
<p class="important">
    Additionally, because GCC is typically used on Linux, the linking order <em>does</em> matter. This means that libraries that depend on other libraries have to
    be added to the library list <em>before</em> the libraries they depend on. If you don't follow this rule, you <em>will</em> get linker errors.
</p>
<p>
    If you are slightly confused, don't worry, it is perfectly normal for beginners to be overwhelmed by all this information regarding static linking. If something
    doesn't work for you the first time around, you can simply keep trying always bearing in mind what has been said above. If you still can't get static linking to
    work, you can check the <a class="internal" href="../../faq.php#build-link-static" title="Go to the FAQ page">FAQ</a> and the
    <a href="http://en.sfml-dev.org/forums/index.php?board=4.0" title="Go to the general help forum">forum</a> for threads about static linking.
</p>
<p>
    If you don't know the differences between dynamic (also called shared) and static libraries, and don't know which one to use, you can search for more information on the internet.
    There are many good articles/blogs/posts about them.
</p>
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
