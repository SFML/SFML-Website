<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php',
        'Issues' => 'issues.php'
    );
    include('header.php');
?>

<div class="issues">
 <h1>Issues</a></h1>
 <h2>You have no idea what causes your issue</h2>
 <ol>
  <li>Create a <a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368" target="_blank">minimal and complete code example</a> which reproduces the issue.</li>
  <li>If while reducing your codebase the issue hasn't revealed itself to you:
   <ul>
    <li>Have a look at the <a href="faq.php" target="_blank">Frequently Asked Questions</a>.</li>
    <li>Go through the <a href="tutorials/2.2/" target="_blank">official tutorials</a> again, and make sure to read and understand the text in red boxes.</li>
    <li><a href="http://en.sfml-dev.org/forums/index.php?action=search" target="_blank">Search the forum</a> for similar issues.</li>
    <li>If and only if none of the above has helped you to resolve your issue: Create a new thread on the forum and make sure to follow the <a href="http://en.sfml-dev.org/forums/index.php?topic=5559.0" target="_blank">forum rules</a>.</li>
   </ul>
  </li>
 </ol>

 <h2>You think you found a bug in SFML</h2>
 <ol>
  <li>Make sure it is really a bug and not a misunderstanding of what SFML is supposed to do. Check the <a href="documentation/2.2/" target="_blank">documentation</a> again to be sure.</li>
  <li>Make sure the bug has not already been reported. Check <a href="https://github.com/LaurentGomila/SFML/issues?q=" target="_blank">the GitHub issues</a> and <a href="http://en.sfml-dev.org/forums/index.php?action=search" target="_blank">the forum</a>.</li>
  <li>Use the <a href="https://github.com/LaurentGomila/SFML" target="_blank">latest revision</a> from GitHub and check if the bug has not already been fixed. Refer to the <a href="tutorials/2.2/compile-with-cmake.php" target="_blank">official tutorial</a> for information on how to build SFML yourself.</li>
  <li>Open a new thread on the <a href="http://en.sfml-dev.org/forums/" target="_blank">forum</a> in the appropriate help board and give the following information:
   <ul>
    <li><a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368" target="_blank">A minimal and complete code example</a> that reproduces the bug as you are experiencing it.</li>
    <li>Instructions for reproducing the bug if it isn't obvious when running the example.</li>
    <li>Environment information (operating system, SFML version, compiler, etc.).</li>
    <li>Screenshots and/or videos, if necessary, to demonstrate certain behavior.</li>
    <li>Anything else that helps to identify the problem.</li>
   </ul>
  </li>
 </ol>
 <a class="box" href="http://en.sfml-dev.org/forums/index.php#c3"><div class="title" title="Go to the forum.">Bug Report</div></a>
 <a class="box" href="https://github.com/LaurentGomila/SFML/issues?q="><div class="title" title="Go to the issue tracker.">Issue Tracker</div></a>
</div>

<?php
    require("footer.php");
?>
