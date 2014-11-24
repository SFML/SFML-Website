<?php
    $breadcrumbs = array
    (
        'Resources' => 'resources.php'
    );
    include('header.php');
?>

<h1>Resources</h1>

<h2 id="tutorials">Tutorials</h2>
<p>
    The official tutorials are the starting point if you want to learn how to use SFML. They explain step by step the important concepts and classes of each module.
</p>
<a class="box" href="tutorials/2.1">
    <div class="title">SFML 2.1</div>
</a>
<a class="box" href="tutorials/2.0">
    <div class="title">SFML 2.0</div>
</a>
<a class="box" href="tutorials/1.6">
    <div class="title">SFML 1.6</div>
</a>

<h2 id="documentation">API documentation</h2>
<p>
    Here is the reference documentation of the SFML API. It contains a detailed description of every class and every function of SFML. It is generated directly from the
    source code, with <a href="http://www.stack.nl/~dimitri/doxygen/" title="Go to Doxygen website">Doxygen</a>.
</p>
<a class="box" href="documentation/2.1">
    <div class="title">SFML 2.1</div>
</a>
<a class="box" href="documentation/2.0">
    <div class="title">SFML 2.0</div>
</a>
<a class="box" href="documentation/1.6">
    <div class="title">SFML 1.6</div>
</a>

<h2 id="books">Books</h2>
<div class="book">
    <img src="images/books/sfml-game-development.jpg" alt="SFML Game Development book cover" />
    <div class="description">
        <p class="title">SFML Game Development</p>
        <a class="link" href="http://www.packtpub.com/sfml-game-development/book" title="SFML Game Development book web page">
            http://www.packtpub.com/sfml-game-development/book
        </a>
    </div>
</div>

<?php
    require("footer.php");
?>
