<?php

    $title = "SFML and gcc (Linux)";
    $page = "start-linux.php";

    require("header.php");
?>

<h1>SFML and gcc (Linux)</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML under Linux with the GCC compiler. It will explain
    how to install SFML, setup your compiler, and compile a SFML program.<br/>
    Compiling SFML libraries is also explained, for more advanced users (although it's quite simple).
</p>

<?php h2('Installing SFML') ?>
<p>
    First, you must download the SFML development files. It is recommended that you download the full SDK, which
    contains source code and binaries, as well as samples and documentation.<br/>
    The package can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p>
    Once you have downloaded and extracted the files to your hard drive, you must install the SFML headers and library files
    to the appropriate location. To do so, you just have to go to the SFML-x.y directory and type "sudo make install".
</p>

<?php h2('Compiling your first SFML program') ?>
<p>
    Create a new text file, and write a SFML program. For example, you can try the
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
    Then compile it like any C++ program, and link to the SFML libraries you are using with the "-l" directive :
</p>
<pre><code class="no-highlight">g++ -c clock.cpp
g++ -o clock clock.o -lsfml-system
</code></pre>
<p>
    When linking to multiple SFML libraries, make sure you link them in the right order, as it's important for gcc.
    The rule is the following : if library XXX depends on (uses) library YYY, put XXX first and then YYY. An exemple
    with SFML : sfml-graphics depends on sfml-window, and sfml-window depends on sfml-system. The link command line would
    be as follows :
</p>
<pre><code class="no-highlight">g++ -o ... -lsfml-graphics -lsfml-window -lsfml-system
</code></pre>
<p>
    Basically, every SFML library depends on sfml-system, and sfml-graphics also depends on sfml-window. That's it for
    dependencies.
</p>
<p>
    If you are using the Graphics or Audio packages, you must first install the external libraries needed by
    each package.<br/>
    Graphics requires freetype.<br/>
    Audio requires libsndfile and openal.<br/>
    These libraries can be installed using the standard package manager of your system, or downloaded from their
    official website.<br/>
    If you have troubles using the default OpenAL library (which is often the case as the Linux implementation is
    not stable), you can replace it with the
    <a class="external" href="http://kcat.strangesoft.net/openal.html" title="OpenAL-Soft homepage">OpenAL-Soft implementation</a>.
    The binaries are fully compatible, so you won't need to recompile SFML nor your programs using it.
</p>

<?php h2('Compiling SFML (for advanced users)') ?>
<p>
    If the precompiled SFML libraries don't exist for your system, you can compile them quite easily. In such case,
    no test have been made so you are encouraged to report any failure or success encountered during your compile process.
    If you succeed compiling SFML for a new platform, please contact the development team so that we can share the files
    with the community.
</p>
<p>
    First, you need to install the development packages of the external libraries used by SFML. Here is the complete list:
</p>
<ul>
    <li>build-essential</li>
    <li>mesa-common-dev</li>
    <li>libx11-dev</li>
    <li>libxrandr-dev</li>
    <li>libgl1-mesa-dev</li>
    <li>libglu1-mesa-dev</li>
    <li>libfreetype6-dev</li>
    <li>libopenal-dev</li>
    <li>libsndfile1-dev</li>
</ul>
<p>
    You can also get them automatically if SFML is in your distribution's packages repository, with the following command:
</p>
<pre><code class="no-highlight">apt-get build-dep libsfml
</code></pre>
<p>
    Then, to actually compile the SFML libraries and samples, you must download and install the full SDK.
    Go to the SFML-x.y directory, and type the following commands:
</p>
<pre><code class="no-highlight">make                # builds the SFML libraries
sudo make install   # installs the compiled libraries
make sfml-samples   # compiles the SFML examples
</code></pre>
<p>
    Note: if Qt and wxWidgets are not installed on your system, you may get compile errors with the corresponding
    samples; just ignore them.
</p>
<p>
    The following options are available to customize the build :
</p>
<ul>
    <li><strong>DESTDIR=xxx</strong> : installs SFML to xxx path instead of the default one (which is /usr/lib)</li>
    <li><strong>DEBUGBUILD=yes/no</strong> : builds debug or optimized SFML libraries (default is no - optimized)</li>
    <li><strong>STATIC=yes/no</strong> : builds static or dynamic SFML libraries (default is no - dynamic)</li>
</ul>

<?php

    require("footer.php");

?>
