<?php
    $latest = '2.3.2';
    $linklatest = '';
    $doxygen = true;
    $docpath = 'documentation/' . $version . '/';
    $breadcrumbs = array
    (
        'Learn' => 'learn.php',
        $version . ' Documentation'  => 'documentation/' . $version,
        $pagetitle => substr($_SERVER['REQUEST_URI'], 1) // remove the starting '/'
    );
    require('../../header.php');
    
    if($version != $latest)
    {
        $linklatest = '<a class="important" href="../' . $latest . '/' . str_replace('documentation/' . $version . '/', '', $breadcrumbs[$pagetitle]) . '"><strong>Warning:</strong> this page refers to an old version of SFML. Click here to switch to the latest version.</a>';
    }
?>

<h1>Documentation of SFML <?php echo $version; ?></h1>
<?php echo $linklatest; ?>
