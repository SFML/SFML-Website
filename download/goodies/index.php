<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'Goodies' => 'download/goodies'
    );
    include('../../header.php');
?>

<h1>Goodies</h1>

<h2>SFML logo</h2>
<p>
    The official SFML logo is in the public domain, you can do whatever you want with it.
</p>
<img class="screenshot"src="sfml-logo-small.png" title="SFML logo" />

<div class="link-box three-columns-left">
    <a class="download" href="sfml-logo-small.png">
        <div class="title">Small</div>
        <div class="description">PNG, 373x113 px</div>
    </a>
</div>

<div class="link-box three-columns-middle">
    <a class="download" href="sfml-logo-big.png">
        <div class="title">Big</div>
        <div class="description">PNG, 1001x304</div>
    </a>
</div>

<div class="link-box three-columns-right">
    <a class="download" href="sfml-logo.svg">
        <div class="title">Vector</div>
        <div class="description">SVG</div>
    </a>
</div>

<?php
    require("../../footer.php");
?>
