<?php

    $title = "SFML and Code::Blocks (MinGW)";
    $page = "start-cb.php";

    require("header.php");

?>

<h1>SFML and Code::Blocks (MinGW)</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML with the Code::Blocks IDE, and the GCC compiler
    (this is the default one). It will explain how to configure your SFML projects.
</p>

<?php h2('Installing SFML') ?>
<p>
    First, you must download the SFML SDK from the <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p class="important">
    There are multiple variants of GCC for Windows, which are incompatible with each other (different exception management,
    threading model, etc.). Make sure that you pick up the right package according to the version that you use. If you don't know, check which of
    the libgcc_s_sjlj-1.dll or libgcc_s_dw2-1.dll file you have in your MinGW/bin folder. If you're using the version of MinGW shipped with Code::Blocks,
    you probably have a SJLJ version.
    <br />
    If you feel like your version of GCC can't work with the precompiled SFML libraries, don't hesitate to
    <a class="internal" href="./compile-with-cmake.php" title="How to compile SFML">recompile SFML</a>, it's not complicated.
</p>
<p>
    You can then unpack the SFML archive wherever you like. Copying headers and libraries to your installation of MinGW is not recommended, it's better
    to keep libraries in their own separate location, especially if you intend to use several versions of the same library, or several compilers.
</p>

<?php h2('Creating and configuring a SFML project') ?>
<p>
    The first thing to do is to choose what kind of project to create. Code::Blocks offers a wide variety of project types, one of them being
    "SFML project". <strong>Don't use it!</strong> It seems like it's just not working. Instead, create an Empty project. If you want to get rid of the
    console, in the project properties, "Build targets" tab, select "GUI application" in the combo box instead of "Console application".
</p>
<p>
    Now we need to tell the compiler where to find the SFML headers (.hpp files), and the linker where to find the SFML libraries (.a files).
</p>
<p>
    In the project's "Build options", "Search directories" tab, add:
</p>
<ul>
    <li>The path to the SFML headers (<em>&lt;sfml-install-path&gt;/include</em>) to the Compiler search directories</li>
    <li>The path to the SFML libraries (<em>&lt;sfml-install-path&gt;/lib</em>) to the Linker search directories</li>
</ul>
<p>
    These paths are the same in both Debug and Release configuration, so you can set them globally for your project.
</p>
<img class="screenshot" src="./images/start-cb-paths.png" alt="Screenshot of the dialog box for setting up the search paths" title="Screenshot of the dialog box for setting up the search paths" />
<p>
    The next step is to link your application to the SFML libraries (.a files) that your code will need. SFML is made of 5 modules (system, window, graphics,
    network and audio), and there's one library for each of them.<br />
    Libraries must be added in the project's properties, "Linker settings" tab, "Link libraries" list. Add all the SFML libraries that you need, for
    example "sfml-graphics", "sfml-window" and "sfml-system" (the "lib" prefix and the ".a" extension must be omitted).
</p>
<img class="screenshot" src="./images/start-cb-link-libs.png" alt="Screenshot of the dialog box for setting up the project's libraries" title="Screenshot of the dialog box for setting up the project's libraries" />
<p class="important">
    It is important to link to the libraries that match the configuration: "sfml-xxx-d" for Debug, and "sfml-xxx" for Release. A bad mix may result
    in crashes.
</p>
<p class="important">
    When linking to multiple SFML libraries, make sure that you link them in the right order, it is very important for GCC. The rule is that libraries
    that depend on other libraries must be put first in the list. Every SFML library depends on sfml-system, and sfml-graphics also depends on
    sfml-window. So, the correct order for these three libraries would be: sfml-graphics, sfml-window, sfml-system -- as shown in the screen capture
    above.
</p>
<p>
    The settings shown here will result in your application being linked to the dynamic version of SFML, the one that needs the DLL files.
    If you want to get rid of these DLLs and have SFML directly integrated to your executable, you must link to the static version. Static SFML
    libraries have the "-s" suffix: "sfml-xxx-s-d" for Debug, and "sfml-xxx-s" for Release.<br />
    In this case, you'll also need to define the SFML_STATIC macro in the preprocessor options of your project.
</p>
<img class="screenshot" src="./images/start-cb-static.png" alt="Screenshot of the dialog box for defining the SFML_STATIC macro" title="Screenshot of the dialog box for defining the SFML_STATIC macro" />
<p>
    If you don't know the differences between dynamic (also called shared) and static libraries, and don't know which one to use, you can ask Google,
    there are good articles/blogs/posts about them.
</p>
<p>
    Your project is ready, let's now write some code to make sure that it works. Add a "main.cpp" file to your project, with the following code inside:
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
    Compile it, and if you linked to the dynamic version of SFML, don't forget to copy the SFML DLLs (they are in <em>&lt;sfml-install-path/bin&gt;</em>)
    to the directory where your compiled executable is. Then run it, and if everything is ok you should see this:
</p>
<img class="screenshot" src="./images/start-cb-app.png" alt="Screenshot of the Hello SFML application" title="Screenshot of the Hello SFML application" />
<p>
    If you are using the sfml-audio module (either statically or dynamically), you must also copy the DLLs of the external libraries needed by it,
    which are libsndfile-1.dll and OpenAL32.dll.<br/>
    These files can be found in <em>&lt;sfml-install-path/bin&gt;</em> too.
</p>

<?php

    require("footer.php");

?>
