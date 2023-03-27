<?php
    $page = 'index.php';
    $title = '';
    require("header.php");
?>

<h1>Tutorials for SFML <?php echo $version; ?></h1>

<?php h2('Getting started') ?>
<ul>
    <li><a href="./start-vc.php"     title="SFML and Visual Studio">SFML and Visual Studio</a></li>
    <li><a href="./start-cb.php"     title="SFML and Code::Blocks">SFML and Code::Blocks (MinGW)</a></li>
    <li><a href="./start-linux.php"  title="SFML and Linux">SFML and gcc (Linux)</a></li>
    <li><a href="./start-osx.php"    title="SFML and Mac OS X">SFML and Xcode (Mac OS X)</a></li>
    <li><a href="./start-ruby.php"   title="SFML and Ruby">SFML and Ruby</a></li>
    <li><a href="./start-python.php" title="SFML and Python">SFML and Python</a></li>
</ul>

<?php h2('System module') ?>
<ul>
    <li><a href="./system-threads.php" title="Using threads and mutexes">Using threads and mutexes</a></li>
    <li><a href="./system-random.php"  title="Generating random numbers">Generating random numbers</a></li>
</ul>

<?php h2('Window module') ?>
<ul>
    <li><a href="./window-window.php"  title="Opening a window">Opening a window</a></li>
    <li><a href="./window-events.php"  title="Handling events">Handling events</a></li>
    <li><a href="./window-time.php"    title="Handling time">Handling time</a></li>
    <li><a href="./window-opengl.php"  title="Using OpenGL">Using OpenGL</a></li>
</ul>

<?php h2('Graphics module') ?>
<ul>
    <li><a href="./graphics-window.php"    title="Using rendering windows">Using rendering windows</a></li>
    <li><a href="./graphics-sprite.php"    title="Displaying a sprite">Displaying a sprite</a></li>
    <li><a href="./graphics-shape.php"     title="Drawing simple shapes">Drawing simple shapes</a></li>
    <li><a href="./graphics-views.php"     title="Using views">Using views</a></li>
    <li><a href="./graphics-fonts.php"     title="Displaying text">Displaying text</a></li>
    <li><a href="./graphics-postfx.php"    title="Adding post-effects">Adding post-effects</a></li>
    <li><a href="./graphics-win32.php"     title="Integrating to a Win32 interface">Integrating to a Win32 interface</a></li>
    <li><a href="./graphics-x11.php"       title="Integrating to a X11 interface">Integrating to a X11 interface</a></li>
    <li><a href="./graphics-qt.php"        title="Integrating to a Qt interface">Integrating to a Qt interface</a></li>
    <li><a href="./graphics-wxwidgets.php" title="Integrating to a wxWidgets interface">Integrating to a wxWidgets interface</a></li>
</ul>

<?php h2('Audio module') ?>
<ul>
    <li><a href="./audio-sound.php"          title="Playing a sound">Playing a sound</a></li>
    <li><a href="./audio-music.php"          title="Playing a music">Playing a music</a></li>
    <li><a href="./audio-streams.php"        title="Using streams">Using streams</a></li>
    <li><a href="./audio-capture.php"        title="Capturing audio data">Capturing audio data</a></li>
    <li><a href="./audio-spatialization.php" title="Playing with sound spatialization">Playing with sound spatialization</a></li>
</ul>

<?php h2('Network module') ?>
<ul>
    <li><a href="./network-sockets.php"  title="Using sockets">Using sockets</a></li>
    <li><a href="./network-packets.php"  title="Using and extending packets">Using and extending packets</a></li>
    <li><a href="./network-selector.php" title="Using a selector">Using a selector</a></li>
    <li><a href="./network-http.php"     title="Using HTTP">Using HTTP</a></li>
    <li><a href="./network-ftp.php"      title="Using FTP">Using FTP</a></li>
</ul>

<?php

    require("footer.php");

?>
