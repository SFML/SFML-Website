<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Event::TouchEvent Struct Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Event.php">Event</a></li><li class="navelem"><a class="el" href="structsf_1_1Event_1_1TouchEvent.php">TouchEvent</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-attribs">Public Attributes</a> &#124;
<a href="structsf_1_1Event_1_1TouchEvent-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::Event::TouchEvent Struct Reference</div></div>
</div><!--header-->
<div class="contents">

<p><a class="el" href="classsf_1_1Touch.php" title="Give access to the real-time state of the touches.">Touch</a> events parameters (TouchBegan, TouchMoved, TouchEnded)  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Event_8hpp_source.php">SFML/Window/Event.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-attribs" name="pub-attribs"></a>
Public Attributes</h2></td></tr>
<tr class="memitem:a9a79fe86bf9ac3c16ec7326f96feb61a" id="r_a9a79fe86bf9ac3c16ec7326f96feb61a"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a9a79fe86bf9ac3c16ec7326f96feb61a">finger</a></td></tr>
<tr class="memdesc:a9a79fe86bf9ac3c16ec7326f96feb61a"><td class="mdescLeft">&#160;</td><td class="mdescRight">Index of the finger in case of multi-touch events.  <br /></td></tr>
<tr class="separator:a9a79fe86bf9ac3c16ec7326f96feb61a"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a8993963790b850caa68b98d3cad2be45" id="r_a8993963790b850caa68b98d3cad2be45"><td class="memItemLeft" align="right" valign="top">int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a8993963790b850caa68b98d3cad2be45">x</a></td></tr>
<tr class="memdesc:a8993963790b850caa68b98d3cad2be45"><td class="mdescLeft">&#160;</td><td class="mdescRight">X position of the touch, relative to the left of the owner window.  <br /></td></tr>
<tr class="separator:a8993963790b850caa68b98d3cad2be45"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:add80639dc68bc37e3275744d501cdbe0" id="r_add80639dc68bc37e3275744d501cdbe0"><td class="memItemLeft" align="right" valign="top">int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#add80639dc68bc37e3275744d501cdbe0">y</a></td></tr>
<tr class="memdesc:add80639dc68bc37e3275744d501cdbe0"><td class="mdescLeft">&#160;</td><td class="mdescRight">Y position of the touch, relative to the top of the owner window.  <br /></td></tr>
<tr class="separator:add80639dc68bc37e3275744d501cdbe0"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p><a class="el" href="classsf_1_1Touch.php" title="Give access to the real-time state of the touches.">Touch</a> events parameters (TouchBegan, TouchMoved, TouchEnded) </p>

<p class="definition">Definition at line <a class="el" href="Event_8hpp_source.php#l00165">165</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>
</div><h2 class="groupheader">Member Data Documentation</h2>
<a id="a9a79fe86bf9ac3c16ec7326f96feb61a" name="a9a79fe86bf9ac3c16ec7326f96feb61a"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a9a79fe86bf9ac3c16ec7326f96feb61a">&#9670;&#160;</a></span>finger</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::Event::TouchEvent::finger</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Index of the finger in case of multi-touch events. </p>

<p class="definition">Definition at line <a class="el" href="Event_8hpp_source.php#l00167">167</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>

</div>
</div>
<a id="a8993963790b850caa68b98d3cad2be45" name="a8993963790b850caa68b98d3cad2be45"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a8993963790b850caa68b98d3cad2be45">&#9670;&#160;</a></span>x</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">int sf::Event::TouchEvent::x</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>X position of the touch, relative to the left of the owner window. </p>

<p class="definition">Definition at line <a class="el" href="Event_8hpp_source.php#l00168">168</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>

</div>
</div>
<a id="add80639dc68bc37e3275744d501cdbe0" name="add80639dc68bc37e3275744d501cdbe0"></a>
<h2 class="memtitle"><span class="permalink"><a href="#add80639dc68bc37e3275744d501cdbe0">&#9670;&#160;</a></span>y</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">int sf::Event::TouchEvent::y</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Y position of the touch, relative to the top of the owner window. </p>

<p class="definition">Definition at line <a class="el" href="Event_8hpp_source.php#l00169">169</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>

</div>
</div>
<hr/>The documentation for this struct was generated from the following file:<ul>
<li><a class="el" href="Event_8hpp_source.php">Event.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
