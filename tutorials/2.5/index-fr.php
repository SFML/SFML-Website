<?php
    $page = 'index-fr.php';
    $title = '';
    require("header-fr.php");
?>

<h1>Tutoriels pour SFML <?php echo $version; ?> </h1>

<?php h2('Démarrer') ?>
<ul>
    <li><a href="./start-vc-fr.php" title="SFML et Visual Studio">SFML et Visual Studio</a></li>
    <li><a href="./start-cb-fr.php" title="SFML et Code::Blocks">SFML et Code::Blocks (MinGW)</a></li>
    <li><a href="./start-linux-fr.php" title="SFML et Linux">SFML et Linux</a></li>
    <li><a href="./start-osx-fr.php" title="SFML et XCode (macOS)">SFML et Xcode (macOS)</a></li>
    <li><a href="./compile-with-cmake-fr.php" title="Compiler SFML avec CMake">Compiler SFML avec CMake</a></li>
</ul>

<?php h2('Module système') ?>
<ul>
    <li><a href="./system-time-fr.php" title="Gérer le temps">Gérer le temps</a></li>
    <li><a href="./system-thread-fr.php" title="Les threads">Les threads</a></li>
    <li><a href="./system-stream-fr.php" title="Les flux de données">Les flux de données (<em>input streams</em>)</a></li>
</ul>

<?php h2('Module de fenêtrage') ?>
<ul>
    <li><a href="./window-window-fr.php" title="Ouvrir et gérer une fenêtre SFML">Ouvrir et gérer une fenêtre SFML</a></li>
    <li><a href="./window-events-fr.php" title="Les évènements">Les évènements expliqués</a></li>
    <li><a href="./window-inputs-fr.php" title="Les entrées temps-réel">Clavier, souris et joysticks</a></li>
    <li><a href="./window-opengl-fr.php" title="OpenGL">Utiliser OpenGL dans une fenêtre SFML</a></li>
</ul>

<?php h2('Module graphique') ?>
<ul>
    <li><a href="graphics-draw-fr.php" title="Dessiner avec SFML">Dessiner avec SFML</a></li>
    <li><a href="graphics-sprite-fr.php" title="Sprites et textures">Sprites et textures</a></li>
    <li><a href="graphics-text-fr.php" title="Texte et polices">Texte et polices</a></li>
    <li><a href="graphics-shape-fr.php" title="Dessiner des formes">Dessiner des formes</a></li>
    <li><a href="graphics-vertex-array-fr.php" title="Concevoir ses entités avec les tableaux de vertex">Concevoir ses entités avec les tableaux de vertex</a></li>
    <li><a href="graphics-transform-fr.php" title="Position, rotation, échelle : transformer des entités">Position, rotation, échelle : transformer des entités</a></li>
    <li><a href="graphics-shader-fr.php" title="Effets spéciaux avec les shaders">Effets spéciaux avec les shaders</a></li>
    <li><a href="graphics-view-fr.php" title="CContrôler la caméra 2D avec les vues">Contrôler la caméra 2D avec les vues</a></li>
</ul>

<?php h2('Module audio') ?>
<ul>
    <li><a href="./audio-sounds-fr.php" title="Jouer des sons et des musiques">Jouer des sons et des musiques</a></li>
    <li><a href="./audio-recording-fr.php" title="Effectuer des captures audio">Effectuer des captures audio</a></li>
    <li><a href="./audio-streams-fr.php" title="Flux audio personnalisés">Flux audio personnalisés</a></li>
    <li><a href="./audio-spatialization-fr.php" title="Spacialisation : les sons en 3D">Spacialisation : les sons en 3D</a></li>
</ul>

<?php h2('Module réseau') ?>
<ul>
    <li><a href="./network-socket-fr.php" title="Communiquer avec les sockets">Communiquer avec les sockets</a></li>
    <li><a href="./network-packet-fr.php" title="Utiliser et étendre les paquets">Utiliser et étendre les paquets</a></li>
    <li><a href="./network-http-fr.php" title="Requêtes web avec HTTP">Requêtes web avec HTTP</a></li>
    <li><a href="./network-ftp-fr.php" title="Transferts de fichiers avec FTP">Transferts de fichiers avec FTP</a></li>
</ul>

<?php

    require("footer-fr.php");

?>
