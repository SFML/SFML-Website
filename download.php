<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php'
    );
    include('header.php');
?>

<h1>Download</h1>

<div class="link-box two-columns-left">
    <a class="download" href="download/sfml/2.2">
        <div class="title">SFML 2.2</div>
        <div class="description">Latest stable version</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="repository" href="https://github.com/LaurentGomila/SFML">
        <div class="title">Repository</div>
        <div class="description">Browse @ github.com</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="download-old" href="download/sfml/old-versions.php">
        <div class="title">Other versions</div>
        <div class="description">SFML 1.6 and older 2.x</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="bindings" href="download/bindings.php">
        <div class="title">Bindings</div>
        <div class="description">SFML in other languages</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="sources" href="https://github.com/LaurentGomila/SFML/archive/master.zip">
        <div class="title">Source code</div>
        <div class="description">Snapshot of current sources</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="goodies" href="download/goodies">
        <div class="title">Goodies</div>
        <div class="description">SFML logo and other cool stuff</div>
    </a>
</div>

<?php
    require("footer.php");
?>
