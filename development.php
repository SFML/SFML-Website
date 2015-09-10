<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php'
    );
    include('header.php');
?>

<div class="development">
 <h1>Development</h1>

 <?php include(dirname(__FILE__) . '/progressbar-osx.php'); ?>

 <div class="link-box two-columns-left">
  <a class="repository" href="https://github.com/SFML/SFML">
   <div class="title">Repository</div>
   <div class="description">Browse @ github.com</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="issues" href="issues.php">
   <div class="title">Issues</div>
   <div class="description">What to do if you have an issue</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="changelog" href="changelog.php">
   <div class="title">Changelog</div>
   <div class="description">What has changed?</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="contribute" href="contribute.php">
   <div class="title">Contribution Guidelines</div>
   <div class="description">How to help developing SFML</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="style" href="style.php">
   <div class="title">Code Style Guide</div>
   <div class="description">How to format your contributions</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="workflow" href="workflow.php">
   <div class="title">Git Workflow</div>
   <div class="description">How we utilize Git</div>
  </a>
 </div>
</div>
 
<?php
    require("footer.php");
?>
