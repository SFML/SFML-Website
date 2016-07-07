<?php
    $breadcrumbs = array
    (
        'Développement' => 'development-fr.php',
        'Problèmes' => 'issues-fr.php'
    );
    include('header-fr.php');
?>

<div class="issues">
 <h1>Problèmes</a></h1>
 <h2>Vous n'avez aucune idée de la cause de votre problème</h2>
 <ol>
  <li>Créez un <a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368">code minimal et complet <img src="../images/icons/flag-en.png" alt="EN"></a> qui reproduise le problème.</li>
  <li>Si en réduisant votre code le problème n'est toujours pas identifié :
   <ul>
    <li>Parcourez la <a href="faq-fr.php">Foire Aux Questions <img src="../images/icons/flag-en.png" alt="EN"></a>.</li>
    <li>Vérifiez les <a href="tutorials/2.2/index-fr.php">tutoriels officiels</a>, tout particulièrement les encadrés rouges.</li>
    <li><a href="http://fr.sfml-dev.org/forums/index.php?action=search">Cherchez sur le forum</a> des problèmes similaires.</li>
    <li>Si, et seulement si, les étapes ci-dessus ne vous ont pas permis de corriger votre problème : créez un nouveau fil de discussion sur le forum en suivant les règles de ce dernier.</li>
   </ul>
  </li>
 </ol>

 <h2>Vous pensez avoir trouvé un bug dans SFML</h2>
 <ol>
  <li>Vérifiez que le bug ne soit pas déjà connu en consultant <a href="https://github.com/SFML/SFML/issues?q=">GitHub</a>, <a href="http://fr.sfml-dev.org/forums/index.php?action=search">le forum</a> et si possible <a href="http://en.sfml-dev.org/forums/index.php?action=search">sa version anglophone</a> aussi.</li>
  <li>Installez les <a href="https://github.com/SFML/SFML">dernière sources</a> depuis GitHub et vérifiez que le problème ne soit pas déjà corrigé. Voir le <a href="tutorials/2.2/compile-with-cmake-fr.php">tutoriel officiel</a>.</li>
  <li>Ouvrez un nouveau fil de discussion sur le <a href="http://fr.sfml-dev.org/forums/">forum</a> dans la rubrique d'aide appropriée, et donnez les informations suivantes :
   <ul>
    <li><a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368">Un code minimal et complet</a> qui fait apparaître le bug.</li>
    <li>Des instructions pour reproduire le bug.</li>
    <li>Des informations sur votre environnement (système d'exploitation, version de SFML, compilateur, etc.).</li>
    <li>Des captures d'écran ou vidéos, si cela s'avère pertinent, pour montrer certains comportements.</li>
    <li>Toute autre information susceptible d'aider à identifier le problème.</li>
   </ul>
  </li>
 </ol>

 <div style="text-align:center">
  <a class="box" href="http://fr.sfml-dev.org/forums/index.php#c7"><div class="title" title="Aller au forum.">Rapport de bug</div></a>
  <a class="box" href="https://github.com/SFML/SFML/issues?q="><div class="title" title="Aller à la liste de tâches / bugs.">Liste de tâches et de bugs <img src="../images/icons/flag-en.png" alt="EN"></div></a>
 </div>
</div>

<?php
    require("footer-fr.php");
?>
