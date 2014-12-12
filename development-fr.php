<?php
    $breadcrumbs = array
    (
        'Développement' => 'development-fr.php'
    );
    include('header-fr.php');
?>

<div class="development">
 <h1>Développement</h1>

 <div class="link-box two-columns-left">
  <a class="repository" href="https://github.com/LaurentGomila/SFML">
   <div class="title">Dépôt</div>
   <div class="description">Parcourez-le @ github.com</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="issues" href="issues-fr.php">
   <div class="title">Issues</div>
   <div class="description">What to do if you have an issue</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="changelog" href="changelog-fr.php">
   <div class="title">Changelog <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">What has changed?</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="contribute" href="contribute-fr.php">
   <div class="title">Contribution Guidelines <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">How to help developing SFML</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="style" href="style-fr.php">
   <div class="title">Code Style Guide <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">How to format your contributions</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="workflow" href="workflow-fr.php">
   <div class="title">Git Workflow <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">How we utilize Git</div>
  </a>
 </div>

<?php
    require("footer-fr.php");
?>
