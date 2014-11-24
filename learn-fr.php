<?php
    $breadcrumbs = array
    (
        'Apprendre' => 'learn-fr.php'
    );
    include('header-fr.php');
?>

<h1>Apprendre</h1>

<h2 id="tutoriels">Tutoriels</h2>
<p>
    Les tutoriels officiels sont le point de départ si vous souhaitez apprendre à utiliser SFML. Ils expliquent pas à pas les classes et concepts importants de chaque module.
</p>
<a class="box" href="tutorials/2.2/index-fr.php">
    <div class="title">SFML 2.2</div>
</a>
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
<a class="box" href="documentation/2.2-fr">
    <div class="title">SFML 2.2</div>
</a>
<a class="box" href="documentation/2.1-fr">
    <div class="title">SFML 2.1</div>
</a>
<a class="box" href="documentation/2.0-fr">
    <div class="title">SFML 2.0</div>
</a>
<a class="box" href="documentation/1.6-fr">
    <div class="title">SFML 1.6</div>
</a>

<h2 id="tutorials">FAQ <small>(Frequently Asked Questions)</small></h2>
<p>
    The tutorials and documentation above covers a lot of ground regarding common mistakes and problems, but before you post on the forum make sure to read through the official FAQ.
    Here you should find an answer to about anything related to SFML.
</p>
<a class="box" href="faq.php">
    <div class="title">Official SFML FAQ</div>
</a>

<h2 id="tutorials">License</h2>
<p>
    SFML is licensed under the terms and condition of the zlib license. Read the full license text <a href="license.php">here</a>.
</p>

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
