<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::GlResource::TransientContextLock Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1GlResource.php">GlResource</a></li><li class="navelem"><a class="el" href="classsf_1_1GlResource_1_1TransientContextLock.php">TransientContextLock</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="classsf_1_1GlResource_1_1TransientContextLock-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::GlResource::TransientContextLock Class Reference</div></div>
</div><!--header-->
<div class="contents">

<p>RAII helper class to temporarily lock an available context for use.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="GlResource_8hpp_source.php">SFML/Window/GlResource.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::GlResource::TransientContextLock:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1GlResource_1_1TransientContextLock.png" usemap="#sf::GlResource::TransientContextLock_map" alt=""/>
  <map id="sf::GlResource::TransientContextLock_map" name="sf::GlResource::TransientContextLock_map">
<area href="classsf_1_1NonCopyable.php" title="Utility class that makes any derived class non-copyable." alt="sf::NonCopyable" shape="rect" coords="0,0,221,24"/>
  </map>
</div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-methods" name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:a6434ee8f0380c300b361be038f37123a" id="r_a6434ee8f0380c300b361be038f37123a"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a6434ee8f0380c300b361be038f37123a">TransientContextLock</a> ()</td></tr>
<tr class="memdesc:a6434ee8f0380c300b361be038f37123a"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <br /></td></tr>
<tr class="separator:a6434ee8f0380c300b361be038f37123a"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a169285281b252ac8d54523b0fcc4b814" id="r_a169285281b252ac8d54523b0fcc4b814"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a169285281b252ac8d54523b0fcc4b814">~TransientContextLock</a> ()</td></tr>
<tr class="memdesc:a169285281b252ac8d54523b0fcc4b814"><td class="mdescLeft">&#160;</td><td class="mdescRight">Destructor.  <br /></td></tr>
<tr class="separator:a169285281b252ac8d54523b0fcc4b814"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>RAII helper class to temporarily lock an available context for use. </p>

<p class="definition">Definition at line <a class="el" href="GlResource_8hpp_source.php#l00079">79</a> of file <a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a id="a6434ee8f0380c300b361be038f37123a" name="a6434ee8f0380c300b361be038f37123a"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a6434ee8f0380c300b361be038f37123a">&#9670;&#160;</a></span>TransientContextLock()</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::TransientContextLock::TransientContextLock </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Default constructor. </p>

</div>
</div>
<a id="a169285281b252ac8d54523b0fcc4b814" name="a169285281b252ac8d54523b0fcc4b814"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a169285281b252ac8d54523b0fcc4b814">&#9670;&#160;</a></span>~TransientContextLock()</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::TransientContextLock::~TransientContextLock </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Destructor. </p>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
