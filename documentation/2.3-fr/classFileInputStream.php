<?php
    $version = '2.3'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'FileInputStream Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.9.1 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li class="current"><a href="annotated.php"><span>Classes</span></a></li>
      <li><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="annotated.php"><span>Class&#160;List</span></a></li>
      <li><a href="classes.php"><span>Class&#160;Index</span></a></li>
      <li><a href="hierarchy.php"><span>Class&#160;Hierarchy</span></a></li>
      <li><a href="functions.php"><span>Class&#160;Members</span></a></li>
    </ul>
  </div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">FileInputStream Class Reference<div class="ingroups"><a class="el" href="group__system.php">System module</a></div></div>  </div>
</div><!--header-->
<div class="contents">

<p>This class is a specialization of InputStream that reads from a file on disk.  
 <a href="classFileInputStream.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="FileInputStream_8hpp_source.php">FileInputStream.hpp</a>&gt;</code></p>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>This class is a specialization of InputStream that reads from a file on disk. </p>
<p>It wraps a file in the common InputStream interface and therefore allows to use generic classes or functions that accept such a stream, with a file on disk as the data source.</p>
<p>In addition to the virtual functions inherited from InputStream, <a class="el" href="classFileInputStream.php" title="This class is a specialization of InputStream that reads from a file on disk. ">FileInputStream</a> adds a function to specify the file to open.</p>
<p>SFML resource classes can usually be loaded directly from a filename, so this class shouldn't be useful to you unless you create your own algorithms that operate on a InputStream.</p>
<p>Usage example: </p><div class="fragment"><div class="line"><span class="keywordtype">void</span> process(InputStream&amp; stream);</div>
<div class="line"></div>
<div class="line">FileStream stream;</div>
<div class="line"><span class="keywordflow">if</span> (stream.open(<span class="stringliteral">&quot;some_file.dat&quot;</span>))</div>
<div class="line">   process(stream);</div>
</div><!-- fragment --><p>InputStream, MemoryStream </p>
</div><hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="FileInputStream_8hpp_source.php">FileInputStream.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
