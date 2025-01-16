<?php
/*
 * included by tutorial/<version>/header.php, which defines $version,
 * $full_version and $page.
 */

  $latest = '3.0'; /* no minor version for tutorials */
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

  $search_mapping = [
    '.php',
    'start-cmake',
    'start-vc',
    'start-cb',
    'start-linux',
    'start-osx',
    'compile-with-cmake',
    'system-time',
    'system-stream',
    'window-window',
    'window-events',
    'window-inputs',
    'window-opengl',
    'graphics-draw',
    'graphics-sprite',
    'graphics-text',
    'graphics-shape',
    'graphics-vertex-array',
    'graphics-transform',
    'graphics-shader',
    'graphics-view',
    'audio-sounds',
    'audio-recording',
    'audio-streams',
    'audio-spatialization',
    'network-socket',
    'network-packet',
    'network-http',
    'network-ftp'
  ];
  $replace_mapping = [
    '',
    'getting-started/cmake',
    'getting-started/visual-studio',
    'getting-started/code-blocks',
    'getting-started/linux',
    'getting-started/macos',
    'getting-started/build-from-source',
    'system/time',
    'system/stream',
    'window/window',
    'window/events',
    'window/inputs',
    'window/opengl',
    'graphics/draw',
    'graphics/sprite',
    'graphics/text',
    'graphics/shape',
    'graphics/vertex-array',
    'graphics/transform',
    'graphics/shader',
    'graphics/view',
    'audio/sounds',
    'audio/recording',
    'audio/streams',
    'audio/spatialization',
    'network/socket',
    'network/packet',
    'network/http',
    'network/ftp'
  ];

  $expected_page = str_replace($version, $latest, '/' . end($breadcrumbs));
  $expected_page = str_replace($search_mapping, $replace_mapping, $expected_page);
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . $expected_page . '/index.html'))
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
