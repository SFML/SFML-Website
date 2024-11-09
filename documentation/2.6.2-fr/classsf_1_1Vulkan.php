<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Vulkan Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Vulkan.php">Vulkan</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-static-methods">Static Public Member Functions</a> &#124;
<a href="classsf_1_1Vulkan-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::Vulkan Class Reference<div class="ingroups"><a class="el" href="group__window.php">Window module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p><a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> helper functions.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Vulkan_8hpp_source.php">SFML/Window/Vulkan.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-static-methods" name="pub-static-methods"></a>
Static Public Member Functions</h2></td></tr>
<tr class="memitem:a88ddd65cc8732316e3066541084c32a0" id="r_a88ddd65cc8732316e3066541084c32a0"><td class="memItemLeft" align="right" valign="top">static bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a88ddd65cc8732316e3066541084c32a0">isAvailable</a> (bool requireGraphics=true)</td></tr>
<tr class="memdesc:a88ddd65cc8732316e3066541084c32a0"><td class="mdescLeft">&#160;</td><td class="mdescRight">Tell whether or not the system supports <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a>.  <br /></td></tr>
<tr class="separator:a88ddd65cc8732316e3066541084c32a0"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:af5b575941e5976af33c6447046e7fefe" id="r_af5b575941e5976af33c6447046e7fefe"><td class="memItemLeft" align="right" valign="top">static VulkanFunctionPointer&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#af5b575941e5976af33c6447046e7fefe">getFunction</a> (const char *name)</td></tr>
<tr class="memdesc:af5b575941e5976af33c6447046e7fefe"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the address of a <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> function.  <br /></td></tr>
<tr class="separator:af5b575941e5976af33c6447046e7fefe"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a295895b452031cf58fadbf3205db6149" id="r_a295895b452031cf58fadbf3205db6149"><td class="memItemLeft" align="right" valign="top">static const std::vector&lt; const char * &gt; &amp;&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a295895b452031cf58fadbf3205db6149">getGraphicsRequiredInstanceExtensions</a> ()</td></tr>
<tr class="memdesc:a295895b452031cf58fadbf3205db6149"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> instance extensions required for graphics.  <br /></td></tr>
<tr class="separator:a295895b452031cf58fadbf3205db6149"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p><a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> helper functions. </p>

<p class="definition">Definition at line <a class="el" href="Vulkan_8hpp_source.php#l00062">62</a> of file <a class="el" href="Vulkan_8hpp_source.php">Vulkan.hpp</a>.</p>
</div><h2 class="groupheader">Member Function Documentation</h2>
<a id="af5b575941e5976af33c6447046e7fefe" name="af5b575941e5976af33c6447046e7fefe"></a>
<h2 class="memtitle"><span class="permalink"><a href="#af5b575941e5976af33c6447046e7fefe">&#9670;&#160;</a></span>getFunction()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static VulkanFunctionPointer sf::Vulkan::getFunction </td>
          <td>(</td>
          <td class="paramtype">const char *</td>          <td class="paramname"><span class="paramname"><em>name</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the address of a <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> function. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">name</td><td>Name of the function to get the address of</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Address of the <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> function, 0 on failure </dd></dl>

</div>
</div>
<a id="a295895b452031cf58fadbf3205db6149" name="a295895b452031cf58fadbf3205db6149"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a295895b452031cf58fadbf3205db6149">&#9670;&#160;</a></span>getGraphicsRequiredInstanceExtensions()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static const std::vector&lt; const char * &gt; &amp; sf::Vulkan::getGraphicsRequiredInstanceExtensions </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> instance extensions required for graphics. </p>
<dl class="section return"><dt>Returns</dt><dd><a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> instance extensions required for graphics </dd></dl>

</div>
</div>
<a id="a88ddd65cc8732316e3066541084c32a0" name="a88ddd65cc8732316e3066541084c32a0"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a88ddd65cc8732316e3066541084c32a0">&#9670;&#160;</a></span>isAvailable()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static bool sf::Vulkan::isAvailable </td>
          <td>(</td>
          <td class="paramtype">bool</td>          <td class="paramname"><span class="paramname"><em>requireGraphics</em></span><span class="paramdefsep"> = </span><span class="paramdefval">true</span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Tell whether or not the system supports <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a>. </p>
<p>This function should always be called before using the <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> features. If it returns false, then any attempt to use <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> will fail.</p>
<p>If only compute is required, set <em>requireGraphics</em> to false to skip checking for the extensions necessary for graphics rendering.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">requireGraphics</td><td></td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>True if <a class="el" href="classsf_1_1Vulkan.php" title="Vulkan helper functions.">Vulkan</a> is supported, false otherwise </dd></dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Vulkan_8hpp_source.php">Vulkan.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
