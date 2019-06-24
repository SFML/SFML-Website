<?php

    $title = "SFML and Visual Studio";
    $page = "start-vc.php";

    require("header.php");

?>

<h1>SFML and Visual Studio</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML with the Visual Studio IDE (Visual C++ compiler). It will explain how
    to configure your SFML projects.
</p>

<?php h2('Installing SFML') ?>
<p>
    First, you must download the SFML SDK from the <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p class="important">
    You must download the package that matches your version of Visual C++. Indeed, a library compiled with VC++ 10 (Visual Studio 2010)
    won't be compatible with VC++ 12 (Visual Studio 2013) for example. If there's no SFML package compiled for your version of Visual C++, you will have to
    <a class="internal" href="./compile-with-cmake.php" title="How to compile SFML">build SFML yourself</a>.
</p>
<p>
    You can then unpack the SFML archive wherever you like. Copying headers and libraries to your installation of Visual Studio is not recommended, it's better
    to keep libraries in their own separate location, especially if you intend to use several versions of the same library, or several compilers.
</p>

<?php h2('Creating and configuring a SFML project') ?>
<p>
    The first thing to do is choose what kind of project to create. It is recommended to select "Empty Project". 
    The dialog window offers a few other options to customize the project: select "Console application" or "Windows 
    application" only if you know how to use pre-compiled headers.<br />
    For the purpose of this tutorial, you should create a main.cpp file and add it to the project, so that we have access to the C++ settings
    (otherwise Visual Studio doesn't know which language you're going to use for this project). We'll explain what to put inside later.
</p>
<p>
    Now we need to tell the compiler where to find the SFML headers (.hpp files), and the linker where to find the SFML libraries (.lib files).
</p>
<p>
    In the project's properties, add:
</p>
<ul>
    <li>The path to the SFML headers (<em>&lt;sfml-install-path&gt;/include</em>) to C/C++ &raquo; General &raquo; Additional Include Directories</li>
    <li>The path to the SFML libraries (<em>&lt;sfml-install-path&gt;/lib</em>) to Linker &raquo; General &raquo; Additional Library Directories</li>
</ul>
<p>
    These paths are the same in both Debug and Release configuration, so you can set them globally for your project ("All configurations").
</p>
<img class="screenshot" src="./images/start-vc-paths.png" alt="Screenshot of the dialog box for setting up the search paths" title="Screenshot of the dialog box for setting up the search paths" />
<p>
    The next step is to link your application to the SFML libraries (.lib files) that your code will need. SFML is made of 5 modules (system, window, graphics,
    network and audio), and there's one library for each of them.<br />
    Libraries must be added in the project's properties, in Linker &raquo; Input &raquo; Additional Dependencies. Add all the SFML libraries that you
    need, for example "sfml-graphics.lib", "sfml-window.lib" and "sfml-system.lib".
</p>
<img class="screenshot" src="./images/start-vc-link-libs.png" alt="Screenshot of the dialog box for setting up the project's libraries" title="Screenshot of the dialog box for setting up the project's libraries" />
<p class="important">
    It is important to link to the libraries that match the configuration: "sfml-xxx-d.lib" for Debug, and "sfml-xxx.lib" for Release. A bad mix may
    result in crashes.
</p>
<p>
    The settings shown here will result in your application being linked to the dynamic version of SFML, the one that needs the DLL files.
    If you want to get rid of these DLLs and have SFML directly integrated into your executable, you must link to the static version. Static SFML
    libraries have the "-s" suffix: "sfml-xxx-s-d.lib" for Debug, and "sfml-xxx-s.lib" for Release.<br />
    In this case, you'll also need to define the SFML_STATIC macro in the preprocessor options of your project.
</p>
<img class="screenshot" src="./images/start-vc-static.png" alt="Screenshot of the dialog box for defining the SFML_STATIC macro" title="Screenshot of the dialog box for defining the SFML_STATIC macro" />
<p class="important">
    Starting from SFML 2.2, when static linking, you will have to link all of SFML's dependencies to your project as well. This means that if you are linking
    sfml-window-s.lib or sfml-window-s-d.lib for example, you will also have to link opengl32.lib, winmm.lib and gdi32.lib. Some of these dependency libraries
    might already be listed under "Inherited values", but adding them again yourself shouldn't cause any problems.
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
            <td><code>sfml-graphics-s.lib</code></td>
            <td><ul>
                <li>sfml-window-s.lib</li>
                <li>sfml-system-s.lib</li>
                <li>opengl32.lib</li>
                <li>freetype.lib</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-window-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>opengl32.lib</li>
                <li>winmm.lib</li>
                <li>gdi32.lib</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-audio-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>openal32.lib</li>
                <li>flac.lib</li>
                <li>vorbisenc.lib</li>
                <li>vorbisfile.lib</li>
                <li>vorbis.lib</li>
                <li>ogg.lib</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-network-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>ws2_32.lib</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-system-s.lib</code></td>
            <td><ul>
                <li>winmm.lib</li>
            </ul></td>
        </tr>
    </tbody>
</table>
<p>
    You might have noticed from the table that SFML modules can also depend on one another, e.g. sfml-graphics-s.lib depends both on sfml-window-s.lib and sfml-system-s.lib.
    If you static link to an SFML library, make sure to link to the dependencies of the library in question, as well as the dependencies of the dependencies
    and so on. If anything along the dependency chain is missing, you <em>will</em> get linker errors.
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
    Your project is ready, let's write some code now to make sure that it works. Put the following code inside the main.cpp file:
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
    If you chose to create a "Windows application" project, the entry point of your code has to be set to "WinMain" instead of "main". Since it's
    Windows specific, and your code would therefore not compile on Linux or macOS, SFML provides a way to keep a standard "main" entry point in this case:
    link your project to the sfml-main module ("sfml-main-d.lib" in Debug, "sfml-main.lib" in Release), the same way you linked sfml-graphics, sfml-window
    and sfml-system.
</p>
<p>
    Now compile the project, and if you linked to the dynamic version of SFML, don't forget to copy the SFML DLLs (they are in <em>&lt;sfml-install-path/bin&gt;</em>)
    to the directory where your compiled executable is. Run it, and if everything works you should see this:
</p>
<img class="screenshot" src="./images/start-vc-app.png" alt="Screenshot of the Hello SFML application" title="Screenshot of the Hello SFML application" />
<p>
    If you are using the sfml-audio module (regardless whether statically or dynamically), you must also copy the DLL of the external library needed by it,
    which is OpenAL32.dll.<br/>
    These files can be found in <em>&lt;sfml-install-path/bin&gt;</em> too.
</p>

<?php

    require("footer.php");

?>
