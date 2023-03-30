<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php'
    );
    include('header.php');
?>

<h1>Download</h1>

<div class="link-box two-columns-left">
    <a class="download" href="download/sfml/2.6.0">
        <div class="title">SFML 2.6.0</div>
        <div class="description">Latest stable version</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="download-old" href="https://artifacts.sfml-dev.org/by-branch/master/">
        <div class="title">Snapshots</div>
        <div class="description">In development versions</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="bindings" href="download/bindings.php">
        <div class="title">Bindings</div>
        <div class="description">SFML in other languages</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="repository" href="https://github.com/SFML/SFML">
        <div class="title">Git repository</div>
        <div class="description">GitHub.com</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="goodies" href="download/goodies">
        <div class="title">Goodies</div>
        <div class="description">Logos</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="download-old" href="download/sfml/old-versions.php">
        <div class="title">Older versions</div>
        <div class="description">SFML 1.6 and 2.x</div>
    </a>
</div>

<?php
    require("footer.php");
?>
