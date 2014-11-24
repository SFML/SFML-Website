<?php
    $doxygen = true;
    $breadcrumbs = array
    (
        'Resources' => 'resources-fr.php',
        'Documentation ' . $version => 'documentation/' . $version . '-fr',
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );
    require('../../header-fr.php');
?>

<h1>Documentation de SFML <?php echo $version ?></h1>
