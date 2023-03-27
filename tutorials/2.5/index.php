<?php
    $page = 'index.php';
    $title = '';
    require("header.php");
?>

<h1>Tutorials for SFML <?php echo $version; ?></h1>

<?php h2('Getting started') ?>
<ul>
    <li><a href="start-vc.php" title="SFML and Visual Studio">SFML and Visual Studio</a></li>
    <li><a href="start-cb.php" title="SFML and Code::Blocks">SFML and Code::Blocks (MinGW)</a></li>
    <li><a href="start-linux.php" title="SFML and Linux">SFML and Linux</a></li>
    <li><a href="start-osx.php" title="SFML and macOS">SFML and Xcode (macOS)</a></li>
    <li><a href="compile-with-cmake.php" title="Compiling SFML with CMake">Compiling SFML with CMake</a></li>
</ul>

<?php h2('System module') ?>
<ul>
    <li><a href="system-time.php" title="Handling time">Handling time</a></li>
    <li><a href="system-thread.php" title="Threads">Threads</a></li>
    <li><a href="system-stream.php" title="User data streams">User data streams</a></li>
</ul>

<?php h2('Window module') ?>
<ul>
    <li><a href="window-window.php" title="Opening and managing an SFML window">Opening and managing an SFML window</a></li>
    <li><a href="window-events.php" title="Events">Events explained</a></li>
    <li><a href="window-inputs.php" title="Real-time inputs">Keyboard, mouse and joysticks</a></li>
    <li><a href="window-opengl.php" title="OpenGL">Using OpenGL in a SFML window</a></li>
</ul>

<?php h2('Graphics module') ?>
<ul>
    <li><a href="graphics-draw.php" title="Drawing 2D stuff">Drawing 2D stuff</a></li>
    <li><a href="graphics-sprite.php" title="Sprites and textures">Sprites and textures</a></li>
    <li><a href="graphics-text.php" title="Text and fonts">Text and fonts</a></li>
    <li><a href="graphics-shape.php" title="Shapes">Shapes</a></li>
    <li><a href="graphics-vertex-array.php" title="Designing your own entities with vertex arrays">Designing your own entities with vertex arrays</a></li>
    <li><a href="graphics-transform.php" title="Position, rotation, scale: transforming entities">Position, rotation, scale: transforming entities</a></li>
    <li><a href="graphics-shader.php" title="Adding special effects with shaders">Adding special effects with shaders</a></li>
    <li><a href="graphics-view.php" title="Controlling the 2D camera with views">Controlling the 2D camera with views</a></li>
</ul>

<?php h2('Audio module') ?>
<ul>
    <li><a href="audio-sounds.php" title="Playing sounds and music">Playing sounds and music</a></li>
    <li><a href="audio-recording.php" title="Recording audio">Recording audio</a></li>
    <li><a href="audio-streams.php" title="Custom audio streams">Custom audio streams</a></li>
    <li><a href="audio-spatialization.php" title="Spatialization">Spatialization: Sounds in 3D</a></li>
</ul>

<?php h2('Network module') ?>
<ul>
    <li><a href="network-socket.php" title="Communication using sockets">Communication using sockets</a></li>
    <li><a href="network-packet.php" title="Using and extending packets">Using and extending packets</a></li>
    <li><a href="network-http.php" title="Web requests with HTTP">Web requests with HTTP</a></li>
    <li><a href="network-ftp.php" title="File transfers with FTP">File transfers with FTP</a></li>
</ul>

<?php

    require("footer.php");

?>
