<?php
    $latest = '2.4.1';
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
        $expected_page = str_replace($version, $latest, '/' . $breadcrumbs[$pagetitle]);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $expected_page))
            $redirect = $expected_page;
        else
            $redirect = '/documentation/' . $latest . '-fr';

        $linklatest = '<a class="important" href="' . $redirect . '"><strong>Attention:</strong> cette page se réfère à une ancienne version de SFML. Cliquez ici pour passer à la dernière version.</a>';
    }
?>

<h1>Documentation de SFML <?php echo $version; ?></h1>
<?php echo $linklatest; ?>
