<?php
    $page = 'index-fr.php';
    $title = '';
    require("header-fr.php");
?>

<h1>Tutoriels pour SFML <?php echo $version; ?></h1>

<?php h2('Démarrer') ?>
<ul>
    <li><a href="./start-vc-fr.php"     title="SFML et Visual Studio">SFML et Visual Studio</a></li>
    <li><a href="./start-cb-fr.php"     title="SFML et Code::Blocks">SFML et Code::Blocks (MinGW)</a></li>
    <li><a href="./start-linux-fr.php"  title="SFML et Linux">SFML et gcc (Linux)</a></li>
    <li><a href="./start-osx-fr.php"    title="SFML et Mac OS X">SFML et Xcode (Mac OS X)</a></li>
    <li><a href="./start-ruby-fr.php"   title="SFML et Ruby">SFML et Ruby</a></li>
    <li><a href="./start-python-fr.php" title="SFML et Python">SFML et Python</a></li>
</ul>

<?php h2('Module système') ?>
<ul>
    <li><a href="./system-threads-fr.php" title="Utiliser les threads et les mutexs">Utiliser les threads et les mutexs</a></li>
    <li><a href="./system-random-fr.php"  title="Générer des nombres aléatoires">Générer des nombres aléatoires</a></li>
</ul>

<?php h2('Module de fenêtrage') ?>
<ul>
    <li><a href="./window-window-fr.php" title="Ouvrir une fenêtre">Ouvrir une fenêtre</a></li>
    <li><a href="./window-events-fr.php" title="Gérer les évènements">Gérer les évènements</a></li>
    <li><a href="./window-time-fr.php"   title="Gérer le temps">Gérer le temps</a></li>
    <li><a href="./window-opengl-fr.php" title="Utiliser OpenGL">Utiliser OpenGL</a></li>
</ul>

<?php h2('Module graphique') ?>
<ul>
    <li><a href="./graphics-window-fr.php"    title="Utiliser les fenêtres de rendu">Utiliser les fenêtres de rendu</a></li>
    <li><a href="./graphics-sprite-fr.php"    title="Afficher un sprite">Afficher un sprite</a></li>
    <li><a href="./graphics-shape-fr.php"     title="Dessiner des formes simples">Dessiner des formes simples</a></li>
    <li><a href="./graphics-views-fr.php"     title="Utiliser les vues">Utiliser les vues</a></li>
    <li><a href="./graphics-fonts-fr.php"     title="Afficher du texte">Afficher du texte</a></li>
    <li><a href="./graphics-postfx-fr.php"    title="Ajouter des post-effects">Ajouter des post-effects</a></li>
    <li><a href="./graphics-win32-fr.php"     title="Intégrer à une interface Win32">Intégrer à une interface Win32</a></li>
    <li><a href="./graphics-x11-fr.php"       title="Intégrer à une interface X11">Intégrer à une interface X11</a></li>
    <li><a href="./graphics-qt-fr.php"        title="Intégrer à une interface Qt">Intégrer à une interface Qt</a></li>
    <li><a href="./graphics-wxwidgets-fr.php" title="Intégrer à une interface wxWidgets">Intégrer à une interface wxWidgets</a></li>
</ul>

<?php h2('Module audio') ?>
<ul>
    <li><a href="./audio-sound-fr.php"          title="Jouer un son">Jouer un son</a></li>
    <li><a href="./audio-music-fr.php"          title="Jouer une musique">Jouer une musique</a></li>
    <li><a href="./audio-streams-fr.php"        title="Utiliser les flux">Utiliser les flux</a></li>
    <li><a href="./audio-capture-fr.php"        title="Capturer des données audio">Capturer des données audio</a></li>
    <li><a href="./audio-spatialization-fr.php" title="Jouer avec la spatialisation des sons">Jouer avec la spatialisation des sons</a></li>
</ul>

<?php h2('Module réseau') ?>
<ul>
    <li><a href="./network-sockets-fr.php"  title="Utiliser les sockets">Utiliser les sockets</a></li>
    <li><a href="./network-packets-fr.php"  title="Utiliser et étendre les paquets">Utiliser et étendre les paquets</a></li>
    <li><a href="./network-selector-fr.php" title="Utiliser un sélecteur">Utiliser un sélecteur</a></li>
    <li><a href="./network-http-fr.php"     title="Utiliser HTTP">Utiliser HTTP</a></li>
    <li><a href="./network-ftp-fr.php"      title="Utiliser FTP">Utiliser FTP</a></li>
</ul>

<?php

    require("footer-fr.php");

?>
