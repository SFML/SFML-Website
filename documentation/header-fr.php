<?php
    $latest = '3.0.0';
    $linklatest = '';
    $doxygen = true;
    $docpath = 'documentation/' . $version . '-fr/';
    $breadcrumbs = array
    (
        'Apprendre' => 'learn-fr.php',
        'Documentation ' . $version => 'documentation/' . $version . '-fr',
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );

    $expected_page = str_replace($version, $latest, '/' . $breadcrumbs[$pagetitle]);
    $expected_page = str_replace('-fr', '', $expected_page);
    $expected_page = str_replace('.php', '.html', $expected_page);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $expected_page))
        $redirect = $expected_page;
    else
        $redirect = '/documentation/' . $latest;

    if($version != $latest)
    {
        $linklatest = '<a class="important" href="' . $redirect . '"><strong>Attention:</strong> cette page se réfère à une ancienne version de SFML. Cliquez ici pour passer à la dernière version.</a>';
    }

    require('../../header-fr.php');
?>

<h1>Documentation de SFML <?php echo $version; ?></h1>
<?php echo $linklatest; ?>
