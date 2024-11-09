<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::GlResource Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1GlResource.php">GlResource</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#nested-classes">Classes</a> &#124;
<a href="#pro-methods">Protected Member Functions</a> &#124;
<a href="#pro-static-methods">Static Protected Member Functions</a> &#124;
<a href="classsf_1_1GlResource-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::GlResource Class Reference<div class="ingroups"><a class="el" href="group__window.php">Window module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Base class for classes that require an OpenGL context.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="GlResource_8hpp_source.php">SFML/Window/GlResource.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::GlResource:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1GlResource.png" usemap="#sf::GlResource_map" alt=""/>
  <map id="sf::GlResource_map" name="sf::GlResource_map">
<area href="classsf_1_1Context.php" title="Class holding a valid drawing context." alt="sf::Context" shape="rect" coords="0,56,113,80"/>
<area href="classsf_1_1Shader.php" title="Shader class (vertex, geometry and fragment)" alt="sf::Shader" shape="rect" coords="123,56,236,80"/>
<area href="classsf_1_1Texture.php" title="Image living on the graphics card that can be used for drawing." alt="sf::Texture" shape="rect" coords="246,56,359,80"/>
<area href="classsf_1_1VertexBuffer.php" title="Vertex buffer storage for one or more 2D primitives." alt="sf::VertexBuffer" shape="rect" coords="369,56,482,80"/>
<area href="classsf_1_1Window.php" title="Window that serves as a target for OpenGL rendering." alt="sf::Window" shape="rect" coords="492,56,605,80"/>
<area href="classsf_1_1RenderWindow.php" title="Window that can serve as a target for 2D drawing." alt="sf::RenderWindow" shape="rect" coords="492,112,605,136"/>
  </map>
</div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="nested-classes" name="nested-classes"></a>
Classes</h2></td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">class &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1GlResource_1_1TransientContextLock.php">TransientContextLock</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">RAII helper class to temporarily lock an available context for use.  <a href="classsf_1_1GlResource_1_1TransientContextLock.php#details">More...</a><br /></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pro-methods" name="pro-methods"></a>
Protected Member Functions</h2></td></tr>
<tr class="memitem:ad8fb7a0674f0f77e530dacc2a3b0dc6a" id="r_ad8fb7a0674f0f77e530dacc2a3b0dc6a"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ad8fb7a0674f0f77e530dacc2a3b0dc6a">GlResource</a> ()</td></tr>
<tr class="memdesc:ad8fb7a0674f0f77e530dacc2a3b0dc6a"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <br /></td></tr>
<tr class="separator:ad8fb7a0674f0f77e530dacc2a3b0dc6a"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab99035b67052331d1e8cf67abd93de98" id="r_ab99035b67052331d1e8cf67abd93de98"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ab99035b67052331d1e8cf67abd93de98">~GlResource</a> ()</td></tr>
<tr class="memdesc:ab99035b67052331d1e8cf67abd93de98"><td class="mdescLeft">&#160;</td><td class="mdescRight">Destructor.  <br /></td></tr>
<tr class="separator:ab99035b67052331d1e8cf67abd93de98"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pro-static-methods" name="pro-static-methods"></a>
Static Protected Member Functions</h2></td></tr>
<tr class="memitem:ab171bdaf5eb36789da14b30a846db471" id="r_ab171bdaf5eb36789da14b30a846db471"><td class="memItemLeft" align="right" valign="top">static void&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ab171bdaf5eb36789da14b30a846db471">registerContextDestroyCallback</a> (ContextDestroyCallback callback, void *arg)</td></tr>
<tr class="memdesc:ab171bdaf5eb36789da14b30a846db471"><td class="mdescLeft">&#160;</td><td class="mdescRight">Register a function to be called when a context is destroyed.  <br /></td></tr>
<tr class="separator:ab171bdaf5eb36789da14b30a846db471"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Base class for classes that require an OpenGL context. </p>
<p>This class is for internal use only, it must be the base of every class that requires a valid OpenGL context in order to work. </p>

<p class="definition">Definition at line <a class="el" href="GlResource_8hpp_source.php#l00046">46</a> of file <a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a id="ad8fb7a0674f0f77e530dacc2a3b0dc6a" name="ad8fb7a0674f0f77e530dacc2a3b0dc6a"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ad8fb7a0674f0f77e530dacc2a3b0dc6a">&#9670;&#160;</a></span>GlResource()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::GlResource </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">protected</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Default constructor. </p>

</div>
</div>
<a id="ab99035b67052331d1e8cf67abd93de98" name="ab99035b67052331d1e8cf67abd93de98"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ab99035b67052331d1e8cf67abd93de98">&#9670;&#160;</a></span>~GlResource()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::~GlResource </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">protected</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Destructor. </p>

</div>
</div>
<h2 class="groupheader">Member Function Documentation</h2>
<a id="ab171bdaf5eb36789da14b30a846db471" name="ab171bdaf5eb36789da14b30a846db471"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ab171bdaf5eb36789da14b30a846db471">&#9670;&#160;</a></span>registerContextDestroyCallback()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::GlResource::registerContextDestroyCallback </td>
          <td>(</td>
          <td class="paramtype">ContextDestroyCallback</td>          <td class="paramname"><span class="paramname"><em>callback</em></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">void *</td>          <td class="paramname"><span class="paramname"><em>arg</em></span>&#160;)</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span><span class="mlabel">protected</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Register a function to be called when a context is destroyed. </p>
<p>This is used for internal purposes in order to properly clean up OpenGL resources that cannot be shared between contexts.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">callback</td><td>Function to be called when a context is destroyed </td></tr>
    <tr><td class="paramname">arg</td><td>Argument to pass when calling the function </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
