<?php

    $title = "SFML and Visual Studio";
    $page = "start-vc.php";

    require("header.php");
?>

<h1>SFML and Visual Studio</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML with the Visual C++ compiler. It will explain how to
    install SFML, setup your IDE, and compile a SFML program.<br/>
    Compiling SFML libraries is also explained, for more advanced users (although it's quite simple).
</p>
<p>
    SFML is maintained using VC++ 2008 Professional, but the following explanations are valid for other versions
    such as express editions, VC++ 2010, VC++ 2005, VC++ 2003 or even VC++ 6.
</p>

<?php h2('Installing SFML') ?>
<p>
    First, you must download the SFML development files. You can download the minimal package (libraries + headers), but
    it is recommended that you download the full SDK, which contains the samples and documentation as well.<br />
    These packages can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p>
    Once you have downloaded and extracted the files to your hard drive, you have to make the SFML headers and library files
    available to Visual C++. There are two ways of doing it:
</p>

<h4>Copy the SFML development files to your Visual Studio installation directory</h4>
<ul>
    <li>Copy SFML-x.y\include\SFML to the VC\include directory of your Visual Studio installation
        (so that you obtain VC\include\SFML)</li>
    <li>Copy the *.lib files in SFML-x.y\lib to the VC\lib directory of your Visual Studio installation</li>
</ul>

<h4>Leave the SFML files where you want, and setup Visual Studio so that it can find them</h4>
<ul>
    <li>Go to the <em>Tools / Options</em> menu, then to <em>Projects and Solutions / VC++ Directories</em></li>
    <li>In <em>Include files</em>, add SFML-x.y\include</li>
    <li>In <em>Library files</em>, add SFML-x.y\lib</li>
</ul>
<img class="screenshot" src="./images/start-vc-include-path.png" width="643" height="381" alt="Screenshot of the dialog box for setting up the include path" title="Screenshot of the dialog box for setting up the include path" />
<img class="screenshot" src="./images/start-vc-lib-path.png" width="643" height="381" alt="Screenshot of the dialog box for setting up the library path" title="Screenshot of the dialog box for setting up the library path" />

<?php h2('Compiling your first SFML program') ?>
<p>
    Create a new "Win32 console application" project, and write a SFML program. For example, you can try the
    <?php class_link("Clock")?> class of the System package :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

int main()
{
    sf::Clock Clock;
    while (Clock.GetElapsedTime() &lt; 5.f)
    {
        std::cout &lt;&lt; Clock.GetElapsedTime() &lt;&lt; std::endl;
        sf::Sleep(0.5f);
    }

    return 0;
}
</code></pre>
<p>
    Don't forget that all SFML classes and functions are in the <code>sf</code> namespace.
</p>
<p>
    Open your project's options, then go to the <em>Linker / Input</em> item. In the <em>Additional dependencies</em> row,
    add the SFML libraries you are using. Here we only use sfml-system.lib.<br />
    This is for the dynamic version of the libraries, the one using the DLLs. If you want to link with the static
    version of the libraries, add the "-s" suffix : sfml-system-s.lib, or sfml-system-s-d.lib for the debug version.
</p>
<p>
    <strong>Important</strong>: for the Debug configuration, you have to link with the debug versions of the libraries,
    which have the "-d" suffix (sfml-system-d.lib in this case). If you don't, you may get undefined behaviours and crashes.
</p>
<img class="screenshot" src="./images/start-vc-project-link.png" width="749" height="521" alt="Screenshot of the dialog box for setting up the project's libraries" title="Screenshot of the dialog box for setting up the project's libraries" />
<p>
    Your program should now compile, link and run fine. If you linked against the dynamic versions of the SFML libraries,
    donc forget to copy the corresponding DLLs (sfml-system.dll in this case) to your executable's directory, or
    to a directory contained in the PATH environment variable.
</p>
<p>
    <strong>Important</strong>:  if you link against the dynamic libraries, you have to define the <strong>SFML_DYNAMIC</strong>
    macro in your project's settings. If you don't, you'll get linker errors when compiling your application.
</p>
<img class="screenshot" src="./images/start-vc-project-dynamic.png" width="749" height="521" alt="Screenshot of the dialog box for linking with dynamic libraries" title="Screenshot of the dialog box for linking with dynamic libraries" />
<p>
    If you are using the Audio package, you must also copy the DLLs of the external libraries needed by it, which
    are libsndfile-1.dll, and OpenAL32.dll.<br/>
    These files can be found in the extlibs\bin directory of the package that you downloaded (SDK or development files).
</p>

<?php h2('Compiling SFML') ?>
<p>
    If the precompiled SFML libraries don't exist for your system, or if you want to use the latest sources from SVN,
    you can compile SFML quite easily. In such case,
    no test have been made so you are encouraged to report any failure or success encountered during your compile process.
    If you succeed compiling SFML for a new platform, please contact the development team so that we can share the files
    with the community.
</p>
<p>
    To compile SFML libraries and samples, you must first download and install the full SDK (or get the files from the SVN repository).
</p>
<p>
    Go to SFML-x.y\build\vc2005 (or SFML-x.y\build\vc2008 if you're using VC++ 2008), and open the file SFML.sln. Choose the
    configuration you want to build (Debug or Release, Static or DLL), and clic "build". This should create the corresponding
    SFML libraries in the lib directory, as well as the samples executables.
</p>
<p>
    If Qt and wxWidgets are not installed on your system, you may get compile errors with the corresponding
    samples ; just ignore them.
</p>

<?php

    require("footer.php");

?>
