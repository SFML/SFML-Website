<?php
    $breadcrumbs = array
    (
        'Développement' => 'development-fr.php',
        'Issues' => 'issues-fr.php'
    );
    include('header-fr.php');
?>

<div class="issues">
 <h1>Issues</a></h1>
 <h2>You have no idea what causes your issue</h2>
 <ol>
  <li>Create a <a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368" target="_blank">minimal and complete code</a> which reproduces the issue.</li>
  <li>If while reducing your codebase the issue hasn't revealed itself to you:
   <ul>
    <li>Look at the <a href="faq.php" target="_blank">Frequently Asked Questions</a>.</li>
    <li>Check the <a href="tutorials/2.2/" target="_blank">official tutorials</a>, especially the red boxes.</li>
    <li><a href="http://en.sfml-dev.org/forums/index.php?action=search" target="_blank">Search the forum</a> for similar issues.</li>
    <li>If and only if nothing from above helps fixing your issue: Create a new thread on the forum by following the forum rules.</li>
   </ul>
  </li>
 </ol>
 
 <h2>You think you found a bug in SFML</h2>
 <ol>
  <li>Make sure the bug is not already known. Check <a href="https://github.com/LaurentGomila/SFML/issues?q=" target="_blank">the GitHub issues</a> and <a href="http://en.sfml-dev.org/forums/index.php?action=search" target="_blank">the forum</a>.</li>
  <li>Install the <a href="https://github.com/LaurentGomila/SFML" target="_blank">latest source</a> from GitHub and check if the bug has not already been fixed. See the <a href="tutorials/2.2/compile-with-cmake.php" target="_blank">official tutorial</a>.</li>
  <li>Open a new thread on the <a href="http://en.sfml-dev.org/forums/" target="_blank">forum</a> in the appropriate help board and give the following information:
   <ul>
    <li><a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368" target="_blank">Minimal complete code</a> that makes the bug appear.</li>
    <li>Instructions for reproducing the bug.</li>
    <li>Environment information (operating system, SFML version, compiler etc.).</li>
    <li>Screenshots/videos, if relevant, to show certain behavior.</li>
    <li>Anything else that helps identify the problem.</li>
   </ul>
  </li>
 </ol>
 <a class="box" href="http://en.sfml-dev.org/forums/index.php#c3"><div class="title" title="Go to the forum.">Bug Report</div></a>
 <a class="box" href="https://github.com/LaurentGomila/SFML/issues?q="><div class="title" title="Go to the issue tracker.">Issue Tracker</div></a>
</div>

<?php
    require("footer-fr.php");
?>
