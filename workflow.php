<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php',
        'Git Workflow' => 'workflow.php'
    );
    include('header.php');
?>

<h1>Git Workflow</h1>
<p>This document provides an overview of the Git workflow that is being used by the SFML team. If you are not a team member and want to contribute code, refer to the <a href="contribute.php" title="Go to the contribution guidelines">Contribution Guidelines</a> instead.</p>

<h2 id="general"><a class="h2-link" href="#general">General Workflow</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<ul>
 <li>Branch <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a> is used for active development.</li>
 <li>Create a branch <code>feature/name</code> or <code>bugfix/name</code> for every new feature or bugfix respectively, where <code>name</code> is a descriptive name using the <code>under_scores</code> convention.</li>
 <li>Create a pull request for every branch that you want merged into <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a>.</li>
 <li>Reviewed and tested pull requests will be merged into <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a>.</li>
 <li>Releases receive a <a href="https://github.com/SFML/SFML/tags">tag</a> in form of the version number (x.y.z).</li>
</ul>

<h2 id="backporting"><a class="h2-link" href="#backporting">Backporting</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<p>Critical bugs are fixed in <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a> and pushed out as a bugfix release with an increased patch version number. Starting from SFML 3, these modifications must be applied to the latest minor version of the previous major version as well.</p>
<p>The workflow is as follows:</p>
<ul>
 <li>Fix bug in master (see <a href="#general">General Workflow</a>).</li>
 <li>Branch off of the older release and cherry-pick the bugfix commits, using the <code>-x</code> flag to include a "(cherry-picked from...)" message.</li>
 <li>Create a tag with an increased patch version number.</li>
</ul>

<h2 id="examples"><a class="h2-link" href="#examples">Examples</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<h3>Feature</h3>
<ol>
 <li>Develop feature.</li>
 <li>Clean up commits (squash and rebase onto <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a> if necessary).</li>
 <li>Push to <code>feature/airplane</code>.</li>
 <li>Create pull request.</li>
 <li>Let others review and test it.</li>
 <li>If okay it will be merged into <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a>.</li>
 <li>Delete <code>feature/airplane</code>.</li>
</ol>

<h3>Bugfix</h3>
<ol>
 <li>Develop bugfix.</li>
 <li>Clean up commits (squash and rebase onto <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a> if necessary).</li>
 <li>Push to <code>bugfix/window_shrinking</code>.</li>
 <li>Create pull request.</li>
 <li>Let others review and test it.</li>
 <li>If okay it will be merged into <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a>.</li>
 <li>Delete <code>bugfix/window_shrinking</code>.</li>
 <li>If this is a critical bug which leads to a bugfix release, backport the commit(s) (see <a href="#backporting">Backporting</a>).
Let's say we have versions 2.x.0 (latest release of SFML 2) and 3.1.1, where the latter is a bugfix release. The changes in 3.1.1 are then backported to 2.x.1.</li>
</ol>

<h3>Release</h3>
<ol>
 <li>Test current <a href="https://github.com/SFML/SFML/tree/master"><code>master</code></a> code on all supported platforms.</li>
 <li>Clean up if necessary.</li>
 <li>Tag last commit with new version number.</li>
 <li>Release.</li>
 <li>Happiness!</li>
</ol>

<?php
    require("footer.php");
?>
