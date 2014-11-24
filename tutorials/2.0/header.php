<?php

    function doc_link($type, $sfml_class, $doc_class)
    {
        if (!isset($doc_class))
            $doc_class = $sfml_class;

        $doc_class = str_replace("::", "_1_1", $doc_class);
        echo '<a href="../../documentation/2.0/'. $type . 'sf_1_1' . $doc_class . '.php" title="sf::' . $sfml_class . ' documentation"><code>sf::' . $sfml_class . '</code></a>';
    }

    function class_link($sfml_class, $doc_class = null)
    {
        doc_link("class", $sfml_class, $doc_class);
    }

    function struct_link($sfml_struct, $doc_struct = null)
    {
        doc_link("struct", $sfml_struct, $doc_struct);
    }

    $breadcrumbs = array(
        'Resources' => 'resources.php',
        '2.0 tutorials' => 'tutorials/2.0',
        $title => 'tutorials/2.0/' . $page
    );

    require("../../header.php");
?>
