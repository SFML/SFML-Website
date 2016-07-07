<?php
    $latest = '2.4.0';
    $linklatest = '';
    $doxygen = true;
    $docpath = 'documentation/' . $version . '-fr/';
    $breadcrumbs = array
    (
        'Apprendre' => 'learn-fr.php',
        'Documentation ' . $version => 'documentation/' . $version . '-fr',
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );
    require('../../header-fr.php');

    if($version != $latest)
    {
        $linklatest = '<a class="important" href="../' . $latest . '-fr/' . str_replace('documentation/' . $version . '-fr/', '', $breadcrumbs[$pagetitle]) . '"><strong>Attention:</strong> cette page se réfère à une ancienne version de SFML. Cliquez ici pour passer à la dernière version.</a>';
    }
?>

<h1>Documentation de SFML <?php echo $version; ?></h1>
<?php echo $linklatest; ?>
