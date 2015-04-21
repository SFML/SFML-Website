<?php
    $breadcrumbs = array
    (
        'Learn' => 'learn.php'
    );
    include('header.php');
?>

<h1>Learn</h1>

<div class="link-box two-columns-left">
    <a class="style" href="tutorials/2.3">
        <div class="title">Tutorials</div>
        <div class="description">Learn how to use SFML</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="apidocs" href="documentation/2.3">
        <div class="title">API Documentation</div>
        <div class="description">Reference</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="faq" href="faq.php">
        <div class="title">FAQ</div>
        <div class="description">Frequently Asked Questions</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="license" href="license.php">
        <div class="title">License</div>
        <div class="description">zlib/png license</div>
    </a>
</div>


<h2 id="books"><a class="h2-link" href="#books">Books</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<div class="book">
    <a class="link" href="https://www.packtpub.com/game-development/sfml-game-development" title="SFML Game Development book web page"><img src="images/books/sfml-game-development.png" alt="SFML Game Development book cover" /></a>
    <div class="description">
        <p class="title">SFML Game Development</p>
        <a class="link" href="https://www.packtpub.com/game-development/sfml-game-development" title="SFML Game Development book web page">
            https://www.packtpub.com/game-development/sfml-game-development
        </a>
    </div>
</div>
<div class="book">
    <a class="link" href="https://www.packtpub.com/game-development/sfml-essentials" title="SFML Essentials book web page"><img src="images/books/sfml-essentials.png" alt="SFML Essentials book cover" /></a>
    <div class="description">
        <p class="title">SFML Essentials</p>
        <a class="link" href="https://www.packtpub.com/game-development/sfml-essentials" title="SFML Essentials book web page">
            https://www.packtpub.com/game-development/sfml-essentials
        </a>
    </div>
</div>

<h2 id="old-docs"><a class="h2-link" href="#old-docs">Documentation for older versions</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<ul>
    <li><strong>SFML 2.2:</strong> <a href="tutorials/2.2">Tutorials</a>, <a href="documentation/2.2">API documentation</a></li>
    <li><strong>SFML 2.1:</strong> <a href="tutorials/2.1">Tutorials</a>, <a href="documentation/2.1">API documentation</a></li>
    <li><strong>SFML 2.0:</strong> <a href="tutorials/2.0">Tutorials</a>, <a href="documentation/2.0">API documentation</a></li>
    <li><strong>SFML 1.6:</strong> <a href="tutorials/1.6">Tutorials</a>, <a href="documentation/1.6">API documentation</a></li>
</ul>

<?php
    require("footer.php");
?>
