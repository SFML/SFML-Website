<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Utf&lt; N &gt; Class Template Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.12.0 -->
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
var searchBox = new SearchBox("searchBox", "search/",'.php');
/* @license-end */
</script>
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
$(function() { codefold.init(0); });
/* @license-end */
</script>
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="topics.php"><span>Topics</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
      <li class="current"><a href="annotated.php"><span>Classes</span></a></li>
      <li><a href="files.php"><span>Files</span></a></li>
      <li>
        <div id="MSearchBox" class="MSearchBoxInactive">
        <span class="left">
          <span id="MSearchSelect"                onmouseover="return searchBox.OnSearchSelectShow()"                onmouseout="return searchBox.OnSearchSelectHide()">&#160;</span>
          <input type="text" id="MSearchField" value="" placeholder="Search" accesskey="S"
               onfocus="searchBox.OnSearchFieldFocus(true)" 
               onblur="searchBox.OnSearchFieldFocus(false)" 
               onkeyup="searchBox.OnSearchFieldChange(event)"/>
          </span><span class="right">
            <a id="MSearchClose" href="javascript:searchBox.CloseResultsWindow()"><img id="MSearchCloseImg" border="0" src="search/close.svg" alt=""/></a>
          </span>
        </div>
      </li>
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
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
$(function(){ initResizable(false); });
/* @license-end */
</script>
<!-- window showing the filter options -->
<div id="MSearchSelectWindow"
     onmouseover="return searchBox.OnSearchSelectShow()"
     onmouseout="return searchBox.OnSearchSelectHide()"
     onkeydown="return searchBox.OnSearchSelectKey(event)">
</div>

<!-- iframe showing the search results (closed by default) -->
<div id="MSearchResultsWindow">
<div id="MSearchResults">
<div class="SRPage">
<div id="SRIndex">
<div id="SRResults"></div>
<div class="SRStatus" id="Loading">Loading...</div>
<div class="SRStatus" id="Searching">Searching...</div>
<div class="SRStatus" id="NoMatches">No Matches</div>
</div>
</div>
</div>
</div>

<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Utf.php">Utf</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">sf::Utf&lt; N &gt; Class Template Reference<div class="ingroups"><a class="el" href="group__system.php">System module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Utility class providing generic functions for UTF conversions.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Utf_8hpp_source.php">SFML/System/Utf.hpp</a>&gt;</code></p>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><div class="compoundTemplParams">template&lt;unsigned int N&gt;<br />
class sf::Utf&lt; N &gt;</div><p>Utility class providing generic functions for UTF conversions. </p>
<p><a class="el" href="classsf_1_1Utf.php" title="Utility class providing generic functions for UTF conversions.">sf::Utf</a> is a low-level, generic interface for counting, iterating, encoding and decoding Unicode characters and strings. It is able to handle ANSI, wide, latin-1, UTF-8, UTF-16 and UTF-32 encodings.</p>
<p>sf::Utf&lt;X&gt; functions are all static, these classes are not meant to be instantiated. All the functions are template, so that you can use any character / string type for a given encoding.</p>
<p>It has 3 specializations: </p><ul>
<li><a class="el" href="classsf_1_1Utf_3_018_01_4.php" title="Specialization of the Utf template for UTF-8.">sf::Utf&lt;8&gt;</a> (typedef'd to sf::Utf8) </li>
<li><a class="el" href="classsf_1_1Utf_3_0116_01_4.php" title="Specialization of the Utf template for UTF-16.">sf::Utf&lt;16&gt;</a> (typedef'd to sf::Utf16) </li>
<li><a class="el" href="classsf_1_1Utf_3_0132_01_4.php" title="Specialization of the Utf template for UTF-32.">sf::Utf&lt;32&gt;</a> (typedef'd to sf::Utf32) </li>
</ul>

<p class="definition">Definition at line <a class="el" href="Utf_8hpp_source.php#l00041">41</a> of file <a class="el" href="Utf_8hpp_source.php">Utf.hpp</a>.</p>
</div><hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Utf_8hpp_source.php">Utf.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
