<?php
    $latest = '2.6.0';
    $linklatest = '';
    $doxygen = true;
    $docpath = 'documentation/' . $version . '/';
    $breadcrumbs = array
    (
        'Learn' => 'learn.php',
        $version . ' Documentation'  => 'documentation/' . $version,
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );

    $expected_page = str_replace($version, $latest, '/' . $breadcrumbs[$pagetitle]);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $expected_page))
        $redirect = $expected_page;
    else
        $redirect = '/documentation/' . $latest;

    if($version != $latest)
    {
        $linklatest = '<a class="important" href="' . $redirect . '"><strong>Warning:</strong> this page refers to an old version of SFML. Click here to switch to the latest version.</a>';
    }

    require('../../header.php');
?>

<h1>Documentation of SFML <?php echo $version; ?></h1>
<?php echo $linklatest; ?>
