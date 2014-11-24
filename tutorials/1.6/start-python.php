<?php

    $title = "SFML and Python";
    $page = "start-python.php";

    require("header.php");
?>

<h1>SFML and Python</h1>

<?php h2('Introduction') ?>
<p>
    The purpose of this tutorial is to explain you how to compile / install / use the Python binding of SFML (which is called
    <strong>PySFML</strong>).
</p>

<?php h2('Installing PySFML binaries') ?>
<p>
    In order to use PySFML, you need to download and install the archive containing the development files for your OS
    (SFML-x.x-python-dev-xxx). It can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
    This archive contains the binaries of PySFML which can be used directly. You won't need anything else to use PySFML.
</p>
<p>
    Extract the archive, and copy the files to your installation of Python. If you don't know where it's located,
    by default it should be "C:\Python26" on Windows or "/usr/lib/python2.6" on Linux.
</p>
<p>
    Once the files are properly installed, you're ready to use PySFML.
</p>

<?php h2('Installing PySFML SDK') ?>
<p>
    Installing the PySFML SDK is optional, all you need to run PySFML are the development files.
    However, installing the full SDK is recommended especially if you're doing your first steps with PySFML.
</p>
<p>
    First you must download the PySFML SDK archive (SFML-x.x-python-sdk), which can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
    This archive contains the source code, documentation, samples and a setup file to build and install PySFML.
</p>
<p>
    You can then extract the SDK and enjoy the documentation and samples directly.
</p>
<p>
    If you want to build PySFML from the source code, you must have the SFML C++ headers and libraries in the
    SFML-x.x directory (as well as the "python" folder), and type the following command :
</p>
<pre><code class="no-highlight">python setup.py build
</code></pre>
<p>
    On Windows, this command will use Visual C++ 2003 by default. But you can compile with MinGW if you want,
    by adding the "-cmingw32" option :
</p>
<pre><code class="no-highlight">python setup.py build -cmingw32
</code></pre>
<p>
    Then you can install it with the following command:
</p>
<pre><code class="no-highlight">python setup.py install
</code></pre>
<p>
    On Linux you'll need the root access to install the files.
</p>
<pre><code class="no-highlight">sudo python setup.py install
</code></pre>

<?php h2('Writing your first PySFML program') ?>
<p>
    Unlike the C++ libraries, PySFML gathers all the SFML classes into a single module ("sf"). As Python supports
    native threading, and has its own networking classes, only some classes of the System, Window, Graphics and Audio
    modules are exposed in PySFML.
</p>
<p>
    Here is a very simple piece of SFML code that opens a window and displays some text :
</p>

<pre><code class="no-highlight"># Include the PySFML extension
from PySFML import sf

# Create the main window
window = sf.RenderWindow(sf.VideoMode(800, 600), "PySFML test")

# Create a graphical string to display
text = sf.String("Hello SFML")

# Start the game loop
running = True
while running:
    event = sf.Event()
    while window.GetEvent(event):
        if event.Type == sf.Event.Closed:
            running = False

    # Clear screen, draw the text, and update the window
    window.Clear()
    window.Draw(text)
    window.Display()
</code></pre>

<p>
    The PySFML documentation is included in the SDK archive. If you're using the SVN version, you can update
    the documentation by running the "gen_doc.py" script. You can also get the detailed description of a class by entering
    <code>help(sf.the_class)</code> in the interpreter. Moreover, all the classes are the same as the C++ version, so
    you can still use the full documentation and tutorials on the website.
</p>
<p>
    The "samples" directory of the SDK contains a few demos using PySFML, you can try them to make sure everything is working
    after compiling and/or installing.
</p>

<?php

    require("footer.php");

?>
