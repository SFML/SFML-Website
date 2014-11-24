<?php
    $breadcrumbs = array
    (
        'Ressources' => 'resources-fr.php'
    );
    include('header-fr.php');
?>

<h1>Resources</h1>

<h2 id="tutoriels">Tutoriels</h2>
<p>
    Les tutoriels officiels sont le point de départ si vous souhaitez apprendre à utiliser SFML. Ils expliquent pas à pas les classes et concepts importants de chaque module.
</p>
<a class="box" href="tutorials/2.1/index-fr.php">
    <div class="title">SFML 2.1</div>
</a>
<a class="box" href="tutorials/2.0/index-fr.php">
    <div class="title">SFML 2.0</div>
</a>
<a class="box" href="tutorials/1.6/index-fr.php">
    <div class="title">SFML 1.6</div>
</a>

<h2 id="documentation">Documentation de l'API</h2>
<p>
    Voici la documentation de référence de l'API SFML. Elle contient une description détaillée de chaque classe et fonction de SFML. Elle est générée directement à
    partir du code source, avec <a href="http://www.stack.nl/~dimitri/doxygen/" title="Aller sur le site web de Doxygen">Doxygen</a> -- elle est donc uniquement
    disponible en anglais.
</p>
<a class="box" href="documentation/2.1-fr">
    <div class="title">SFML 2.1</div>
</a>
<a class="box" href="documentation/2.0-fr">
    <div class="title">SFML 2.0</div>
</a>
<a class="box" href="documentation/1.6-fr">
    <div class="title">SFML 1.6</div>
</a>

<h2 id="livres">Livres</h2>
<div class="book">
    <img src="images/books/sfml-game-development.jpg" alt="Couverture du livre SFML Game Development" />
    <div class="description">
        <p class="title">SFML Game Development</p>
        <a class="link" href="http://www.packtpub.com/sfml-game-development/book" title="Page web du livre SFML Game Development">
            http://www.packtpub.com/sfml-game-development/book
        </a>
    </div>
</div>

<?php
    require("footer-fr.php");
?>
