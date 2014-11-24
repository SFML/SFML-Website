<?php
    $doxygen = true;
    $breadcrumbs = array
    (
        'Learn' => 'learn.php',
        $version . ' documentation'  => 'documentation/' . $version,
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );
    require('../../header.php');
?>

<h1>Documentation of SFML <?php echo $version ?></h1>
