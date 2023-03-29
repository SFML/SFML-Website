<?php
    // Define access functions for the website's most common directories
    function root() {return '//' . $_SERVER['SERVER_NAME'];}
    function home() {return root() . '/index-fr.php';}
    function page($name) {return root() . '/' . $name;}
    function image($name) {return root() . '/images/' . $name;}
    function style($name) {return root() . '/styles/' . $name;}
    function script($name) {return root() . '/scripts/' . $name;}

    // Build the page title
    $keys = array_keys($breadcrumbs);
    if (empty($keys))
    {
        $page_title = 'SFML';
    }
    else
    {
        $last = end($keys);
        reset($keys);

        $page_title = $last . ' (SFML';
        for ($i = 0; $i < count($keys) - 1; $i++)
            $page_title .= ' / ' . $keys[$i];
        $page_title .= ')';
    }

    // Build the translated URL of the current page
    if (!isset($doxygen))
        $translated_page = str_replace("-fr.php", ".php", $_SERVER['SCRIPT_NAME']);
    else
        $translated_page = str_replace("documentation/" . $version . "-fr", "documentation/" . $version, $_SERVER['SCRIPT_NAME']);

    function h2($title)
    {
        $id = trim(str_replace(' ', '-', preg_replace('/[^a-z0-9 -]+/', '', strtr(strtolower($title), 'àéèêëîïôöùûüç', 'aeeeeiioouuuc'))), '-');
        echo '<h2 id="' . $id . '"><a class="h2-link" href="#' . $id . '">' . $title . '<a class="back-to-top" href="#top" title="Haut de la page"></a></h2>';
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $page_title ?></title>
        <meta http-equiv="Content-Type" content="text/html"/>
        <meta charset="utf-8"/>
        <link rel="icon" type="image/ico" href="<?php echo image('favicon.ico') ?>"/>
        <link rel='stylesheet' type='text/css' href="//fonts.googleapis.com/css?family=Ubuntu:400,700,400italic"/>
        <link rel="stylesheet" type="text/css" href="<?php echo style('style.css') ?>?2017-09-15-0000" title="default" media="screen,print"/>
        <link rel="stylesheet" type="text/css" href="<?php echo script('highlight/styles/github.css') ?>"/>
        <?php if (isset($doxygen))
        {
            echo '<link rel="stylesheet" type="text/css" href="' . root() . '/' . $docpath . 'doxygen.css" title="default" media="screen,print" />
                 <script type="text/javascript" src="jquery.js"></script>
                 <script type="text/javascript" src="dynsections.js"></script>
                 <link rel="stylesheet" type="text/css" href="search/search.css" />
                 <link rel="stylesheet" type="text/css" href="' . root() . '/' . $docpath . 'searchOverrides.css" />
                 <script type="text/javascript" src="search/searchdata.js"></script>
                 <script type="text/javascript" src="search/search.js"></script>
                 <script type="text/javascript">
                 /* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
                   $(document).ready(function() { init_search(); });
                 /* @license-end */
                 </script>';
        } ?>
<!--[if (gte IE 9)|!(IE)]>
<!-->
        <script type="text/javascript" src="<?php echo script('highlight/highlight.pack.js') ?>"></script>
        <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
<!--<![endif]-->
    </head>
    <body id="top">
        <?php include_once("analytics.php") ?>
        <div id="page">
            <div id="banner-container">
                <div id="banner">
                    <a href="<?php echo home(); ?>"><img id="logo" src="<?php echo image('logo.png') ?>" alt="SFML logo"/></a>
                    <ul id="menu">
                        <li><a href="<?php echo page('learn-fr.php') ?>">Apprendre</a></li>
                        <li><a href="<?php echo page('download-fr.php') ?>">Télécharger</a></li>
                        <li><a href="<?php echo page('community-fr.php') ?>">Communauté</a></li>
                        <li><a href="<?php echo page('development-fr.php') ?>">Développement</a></li>
                    </ul>
                </div>
            </div>
            <div id="navigation-container">
                <div id="navigation">
                    <ul id="breadcrumbs">
                    <?php
                        echo '<li><a href="' . home() . '">Accueil</a></li>';
                        foreach ($breadcrumbs as $name => $link)
                            echo '<li>&raquo;<a href="' . root() . '/' . $link . '">' . $name .'</a></li>';
                    ?>
                    </ul>
                    <ul id="buttons">
                        <li><a id="language-en" href="<?php echo $translated_page ?>" title="Website in english">English</a></li>
                        <li><a id="donate" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=VH4J3GW5GUXR4&lc=FR" title="Faire un don">Faire un don</a></li>
                    </ul>
                </div>
            </div>
            <div id="content" <?php if (isset($doxygen)) echo 'class="doxygen"' ?>>
