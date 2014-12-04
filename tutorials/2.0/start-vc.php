<?php

    $title = "SFML and Visual studio";
    $page = "start-vc.php";

    require("header.php");

?>

<h1>SFML and Visual studio</h1>

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
    You must download the package that matches your version of Visual C++. Indeed, a library compiled with VC++ 9 (Visual Studio 2008)
    won't be compatible with VC++ 10 (Visual Studio 2010) for example. If there's no SFML package compiled for your version of Visual C++, you will have to
    <a class="internal" href="./compile-with-cmake.php" title="How to compile SFML">build SFML yourself</a>.
</p>
<p>
    You can then unpack the SFML archive wherever you like. Copying headers and libraries to your installation of Visual Studio is not recommended, it's better
    to keep libraries in their own separate location, especially if you intend to use several versions of the same library, or several compilers.
</p>

<?php h2('Creating and configuring a SFML project') ?>
<p>
    The first thing to do is choose what kind of project to create: you must select "Win32 application". The wizard offers a few options to customize
    the project: select "Console application" if you need the console, or "Windows application" if you don't want it. Check the "Empty project" box if
    you don't want to be annoyed with auto-generated code.<br />
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
    Windows specific, and your code would therefore not compile on Linux or Mac OS X, SFML provides a way to keep a standard "main" entry point in this case:
    link your project to the sfml-main module ("sfml-main-d.lib" in Debug, "sfml-main.lib" in Release), the same way you linked sfml-graphics, sfml-window
    and sfml-system.
</p>
<p>
    Now compile the project, and if you linked to the dynamic version of SFML, don't forget to copy the SFML DLLs (they are in <em>&lt;sfml-install-path/bin&gt;</em>)
    to the directory where your compiled executable is. Run it, and if everything works you should see this:
</p>
<img class="screenshot" src="./images/start-vc-app.png" alt="Screenshot of the Hello SFML application" title="Screenshot of the Hello SFML application" />
<p>
    If you are using the sfml-audio module (regardless whether statically or dynamically), you must also copy the DLLs of the external libraries needed by it,
    which are libsndfile-1.dll and OpenAL32.dll.<br/>
    These files can be found in <em>&lt;sfml-install-path/bin&gt;</em> too.
</p>

<?php

    require("footer.php");

?>
