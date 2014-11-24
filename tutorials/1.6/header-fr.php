<?php

    function class_link($sfml_class, $doc_class = null)
    {
        if (!isset($doc_class))
            $doc_class = $sfml_class;

        echo '<a href="../../documentation/1.6/classsf_1_1' . $doc_class . '.php" title="documentation de sf::' . $sfml_class . '"><code>sf::' . $sfml_class . '</code></a>';
    }

    $breadcrumbs = array(
        'Apprendre' => 'learn-fr.php',
        'Tutoriels 1.6' => 'tutorials/1.6/index-fr.php',
        $title => 'tutorials/1.6/' . $page
    );

    require("../../header-fr.php");
?>
