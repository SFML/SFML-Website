<?php
    $breadcrumbs = array
    (
        'Développement' => 'development-fr.php'
    );
    include('header-fr.php');
?>

<h1>Développement</h1>

<div class="link-box two-columns-left">
    <a class="repository" href="https://github.com/LaurentGomila/SFML">
        <div class="title">Dépôt</div>
        <div class="description">Parcourez-le @ github.com</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="issues" href="issues.php">
        <div class="title">Issues</div>
        <div class="description">What to do if you have an issue</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="contribute" href="contribute.php">
        <div class="title">Contribution Guidelines</div>
        <div class="description">How to help developing SFML</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="workflow" href="workflow.php">
        <div class="title">Our Workflow</div>
        <div class="description">How we utilize Git</div>
    </a>
</div>

<div class="link-box two-columns-left">
    <a class="style" href="style.php">
        <div class="title">Code Style Guide</div>
        <div class="description">How to format your contributions</div>
    </a>
</div>

<div class="link-box two-columns-right">
    <a class="license" href="license.php">
        <div class="title">License</div>
        <div class="description">SFML's license</div>
    </a>
</div>

<?php
    require("footer.php");
?>
