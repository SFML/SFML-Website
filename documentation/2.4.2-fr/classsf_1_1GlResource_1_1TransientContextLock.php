<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::GlResource::TransientContextLock Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.10 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
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
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1GlResource.php">GlResource</a></li><li class="navelem"><a class="el" href="classsf_1_1GlResource_1_1TransientContextLock.php">TransientContextLock</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="classsf_1_1GlResource_1_1TransientContextLock-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">sf::GlResource::TransientContextLock Class Reference</div>  </div>
</div><!--header-->
<div class="contents">

<p>RAII helper class to temporarily lock an available context for use.  
 <a href="classsf_1_1GlResource_1_1TransientContextLock.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::GlResource::TransientContextLock:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1GlResource_1_1TransientContextLock.png" usemap="#sf::GlResource::TransientContextLock_map" alt=""/>
  <map id="sf::GlResource::TransientContextLock_map" name="sf::GlResource::TransientContextLock_map">
<area href="classsf_1_1NonCopyable.php" title="Utility class that makes any derived class non-copyable. " alt="sf::NonCopyable" shape="rect" coords="0,0,221,24"/>
</map>
 </div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:a6434ee8f0380c300b361be038f37123a"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1GlResource_1_1TransientContextLock.php#a6434ee8f0380c300b361be038f37123a">TransientContextLock</a> ()</td></tr>
<tr class="memdesc:a6434ee8f0380c300b361be038f37123a"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <a href="#a6434ee8f0380c300b361be038f37123a">More...</a><br /></td></tr>
<tr class="separator:a6434ee8f0380c300b361be038f37123a"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a169285281b252ac8d54523b0fcc4b814"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1GlResource_1_1TransientContextLock.php#a169285281b252ac8d54523b0fcc4b814">~TransientContextLock</a> ()</td></tr>
<tr class="memdesc:a169285281b252ac8d54523b0fcc4b814"><td class="mdescLeft">&#160;</td><td class="mdescRight">Destructor.  <a href="#a169285281b252ac8d54523b0fcc4b814">More...</a><br /></td></tr>
<tr class="separator:a169285281b252ac8d54523b0fcc4b814"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>RAII helper class to temporarily lock an available context for use. </p>

<p>Definition at line <a class="el" href="GlResource_8hpp_source.php#l00070">70</a> of file <a class="el" href="GlResource_8hpp_source.php">GlResource.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a class="anchor" id="a6434ee8f0380c300b361be038f37123a"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::TransientContextLock::TransientContextLock </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Default constructor. </p>

</div>
</div>
<a class="anchor" id="a169285281b252ac8d54523b0fcc4b814"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::GlResource::TransientContextLock::~TransientContextLock </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
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
