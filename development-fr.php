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
   <div class="title">Problèmes</div>
   <div class="description">Que faire en cas de problème</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="changelog" href="changelog-fr.php">
   <div class="title">Changelog <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">Quoi de neuf?</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="contribute" href="contribute-fr.php">
   <div class="title">Guide du contributeur <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">Comment aider à développer SFML</div>
  </a>
 </div>

 <div class="link-box two-columns-left">
  <a class="style" href="style-fr.php">
   <div class="title">Guide du codeur <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">Comment structurer vos contributions</div>
  </a>
 </div>

 <div class="link-box two-columns-right">
  <a class="workflow" href="workflow-fr.php">
   <div class="title">Méthodologie Git <img src="../images/icons/flag-en.png" alt="EN"></div>
   <div class="description">Comment nous utilisons Git</div>
  </a>
 </div>

<?php
    require("footer-fr.php");
?>
