<?php

    $title = "SFML and Code::Blocks (MinGW)";
    $page = "start-cb.php";

    require("header.php");
?>

<h1>SFML and Code::Blocks (MinGW)</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML with the Code::Blocks EDI, and the GCC compiler
    (this is the default one). It will explain how to
    install SFML, setup your IDE, and compile a SFML program.<br/>
    Compiling SFML libraries is also explained, for more advanced users (although it's quite simple).
</p>

<?php h2('Installing SFML') ?>
<p>
    <strong>Important</strong>: this release of SFML was compiled with gcc 4.4, if your own version doesn't match and is incompatible,
    you'll have to recompile SFML.
</p>
<p>
    First, you must download the SFML development files. You can download the minimal package (libraries + headers), but
    it is recommended that you download the full SDK, which contains samples and documentation as well.<br/>
    These packages can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p>
    Once you have downloaded and extracted the files to your hard drive, you must make the SFML headers and library files
    available for Code::Blocks. There are two ways of doing it :
</p>

<h4>Copy the SFML development files to your Code::Blocks installation directory</h4>
<ul>
    <li>Copy SFML-x.y\include\SFML to the \include directory of your Code::Blocks installation
        (so that you obtain include\SFML)</li>
    <li>Copy the *.a files in SFML-x.y\lib to the \lib directory of your Code::Blocks installation</li>
</ul>

<h4>Leave the SFML files where you want, and setup Code::Blocks so that it can find them</h4>
<ul>
    <li>Go to the <em>Settings / Compiler and debugger</em> menu, then to <em>Global compiler settings / Search directories</em></li>
    <li>In <em>Compiler</em>, add SFML-x.y\include</li>
    <li>In <em>Linker</em>, add SFML-x.y\lib</li>
</ul>
<img class="screenshot" src="./images/start-cb-include-path.png" width="670" height="385" alt="Screenshot of the dialog box for setting up the include path" title="Screenshot of the dialog box for setting up the include path" />
<img class="screenshot" src="./images/start-cb-lib-path.png" width="670" height="385" alt="Screenshot of the dialog box for setting up the library path" title="Screenshot of the dialog box for setting up the library path" />

<?php h2('Compiling your first SFML program') ?>
<p>
    Create a new "Console application" project using the GCC compiler, and write a SFML program. For example, you can try the
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
    Open your project's build options, then go to the <em>Linker settings</em> tab. In <em>Other link options</em>,
    add the SFML libraries you are using, with the "-l" directive. Here we only use libsfml-system.a, so we
    add "-lsfml-system". For the Debug configuration, you can link with the debug versions of the libraries,
    which have the "-d" suffix ("-lsfml-system-d" in this case).<br/>
    This is for the dynamic version of the libraries, the one using the DLLs. If you want to link with the static
    version of the libraries, add the "-s" suffix : -lsfml-system-s, or -lsfml-system-s-d for the debug version.
</p>
<img class="screenshot" src="./images/start-cb-project-link.png" width="672" height="520" alt="Screenshot of the dialog box for setting up the project's libraries" title="Screenshot of the dialog box for setting up the project's libraries" />
<p>
    When linking to multiple SFML libraries, make sure you link them in the right order, as it's important for MinGW.
    The rule is the following : if library XXX depends on (uses) library YYY, put XXX first and then YYY. An exemple
    with SFML : sfml-graphics depends on sfml-window, and sfml-window depends an sfml-system. The link options would
    be as follows :
</p>
<pre><code class="cpp">-lsfml-graphics
-lsfml-window
-lsfml-system
</code></pre>
<p>
    Basically, every SFML library depends on sfml-system, and sfml-graphics also depends on sfml-window. That's it for
    dependencies.
</p>
<p>
    Your program should now compile, link and run fine. If you linked against the dynamic versions of the SFML libraries,
    donc forget to copy the corresponding DLLs (sfml-system.dll in this case) to your executable's directory, or
    to a directory contained in the PATH environment variable.
</p>
<p>
    <strong>Important</strong>: if you link against dynamic libraries, you also need to define the <strong>SFML_DYNAMIC</strong>
    macro in your project's settings. If you don't, you will get linker errors when compiling your application.
</p>
<img class="screenshot" src="./images/start-cb-project-dynamic.png" width="672" height="521" alt="Screenshot of the dialog box for linking with dynamic libraries" title="Screenshot of the dialog box for linking with dynamic libraries" />
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
    To compile SFML libraries and samples, you must first download and install the full SDK (or retrieve the files from the SVN
    repository).
</p>
<p>
    Go to SFML-x.y\build\codeblocks, and open the file SFML.workspace. Choose the configuration you want to build (Debug or Release,
    Static or DLL), and clic "build workspace". This should create the corresponding SFML library files in the lib directory, as well
    as the sample executables.
</p>
<p>
    If Qt and wxWidgets are not installed on your system, you may get compile errors with the corresponding
    samples ; just ignore them.
</p>
<p>
    Compiling SFML static libraries with MinGW requires an extra-step if you want to include the external libraries
    as well. If you don't do it, you will have to explicitly link with the external libraries used by SFML in each
    of your programs.<br/>
    Unfortunately Code::Blocks can't perform this step automatically, but a batch script named build.bat exists in
    SFML-x.y\build\codeblocks\batch-build. This script automatically compiles the SFML libraries for all configurations
    (debug/release static/dynamic) and performs the extra step required for static libraries. All you have to do
    before running it is to make your Code::Blocks executable (codeblocks.exe) available, i.e. add its path to the
    PATH environment variable.
</p>

<?php

    require("footer.php");

?>
