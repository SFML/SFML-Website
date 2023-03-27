<?php
/*
 * included by tutorial/<version>/header.php, which defines $version,
 * $full_version and $page.
 */

  $latest = '2.6'; /* no minor version for tutorials */
  $linklatest = '';

  $breadcrumbs = array(
    'Learn' => 'learn.php',
    "$version Tutorials" => "tutorials/$version"
  );

  if ($page != 'index.php') // add some crumbs
    $breadcrumbs[$title] = 'tutorials/' . $version . '/' . $page;

  function doc_link($type, $sfml_class, $doc_class)
  {
    global $version, $full_version;

    if (!isset($doc_class))
      $doc_class = $sfml_class;

    if ($version == '1.6')
    {
        echo '<a href="/documentation/1.6/classsf_1_1' . $doc_class . '.php" title="sf::' . $sfml_class . ' documentation"><code>sf::' . $sfml_class . '</code></a>';
    }
    else
    {
      $doc_class = str_replace("::", "_1_1", $doc_class);
      echo '<a href="/documentation/' . $full_version . '/' . $type . 'sf_1_1' . $doc_class . '.php" title="sf::' . $sfml_class . ' documentation"><code>sf::' . $sfml_class . '</code></a>';
    }
  }

  function class_link($sfml_class, $doc_class = null)
  {
    doc_link("class", $sfml_class, $doc_class);
  }

  function struct_link($sfml_struct, $doc_struct = null)
  {
    doc_link("struct", $sfml_struct, $doc_struct);
  }

  $expected_page = str_replace($version, $latest, '/' . end($breadcrumbs));
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . $expected_page))
      $redirect = $expected_page;
  else
      $redirect = '/tutorials/' . $latest;

  if($version != $latest)
  {
    $linklatest = '<p style="text-align:center"><a class="important" href="' . $redirect . '"><strong>Warning:</strong> this page refers to an old version of SFML. Click here to switch to the latest version.</a></p>';
  }

  require("../../header.php");
?>
<?php echo $linklatest; ?>
