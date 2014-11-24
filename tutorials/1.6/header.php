<?php

    function class_link($sfml_class, $doc_class = null)
    {
        if (!isset($doc_class))
            $doc_class = $sfml_class;

        echo '<a href="../../documentation/1.6/classsf_1_1' . $doc_class . '.php" title="sf::' . $sfml_class . ' documentation"><code>sf::' . $sfml_class . '</code></a>';
    }

    $breadcrumbs = array(
        'Learn' => 'learn.php',
        '1.6 tutorials' => 'tutorials/1.6',
        $title => 'tutorials/1.6/' . $page
    );

    require("../../header.php");
?>
