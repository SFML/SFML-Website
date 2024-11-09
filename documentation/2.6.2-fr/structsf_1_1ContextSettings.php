<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::ContextSettings Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="structsf_1_1ContextSettings.php">ContextSettings</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-types">Public Types</a> &#124;
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="#pub-attribs">Public Attributes</a> &#124;
<a href="structsf_1_1ContextSettings-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::ContextSettings Class Reference<div class="ingroups"><a class="el" href="group__window.php">Window module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Structure defining the settings of the OpenGL context attached to a window.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="ContextSettings_8hpp_source.php">SFML/Window/ContextSettings.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-types" name="pub-types"></a>
Public Types</h2></td></tr>
<tr class="memitem:af2e91e57e8d26c40afe2ec8efaa32a2c" id="r_af2e91e57e8d26c40afe2ec8efaa32a2c"><td class="memItemLeft" align="right" valign="top">enum &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2c">Attribute</a> { <a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2cabf868dcb751b909bf031484ed42a93bb">Default</a> = 0
, <a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2cacb581130734cbd87cbbc9438429f4a8b">Core</a> = 1 &lt;&lt; 0
, <a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2ca6043f67afb3d48918d5336474eabaafc">Debug</a> = 1 &lt;&lt; 2
 }</td></tr>
<tr class="memdesc:af2e91e57e8d26c40afe2ec8efaa32a2c"><td class="mdescLeft">&#160;</td><td class="mdescRight">Enumeration of the context attribute flags.  <a href="#af2e91e57e8d26c40afe2ec8efaa32a2c">More...</a><br /></td></tr>
<tr class="separator:af2e91e57e8d26c40afe2ec8efaa32a2c"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-methods" name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:ac56869ccbb6bf0df48b88880754e12b7" id="r_ac56869ccbb6bf0df48b88880754e12b7"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac56869ccbb6bf0df48b88880754e12b7">ContextSettings</a> (unsigned int depth=0, unsigned int stencil=0, unsigned int antialiasing=0, unsigned int major=1, unsigned int minor=1, unsigned int attributes=<a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2cabf868dcb751b909bf031484ed42a93bb">Default</a>, bool sRgb=false)</td></tr>
<tr class="memdesc:ac56869ccbb6bf0df48b88880754e12b7"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <br /></td></tr>
<tr class="separator:ac56869ccbb6bf0df48b88880754e12b7"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-attribs" name="pub-attribs"></a>
Public Attributes</h2></td></tr>
<tr class="memitem:a4809e22089c2af7276b8809b5aede7bb" id="r_a4809e22089c2af7276b8809b5aede7bb"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a4809e22089c2af7276b8809b5aede7bb">depthBits</a></td></tr>
<tr class="memdesc:a4809e22089c2af7276b8809b5aede7bb"><td class="mdescLeft">&#160;</td><td class="mdescRight">Bits of the depth buffer.  <br /></td></tr>
<tr class="separator:a4809e22089c2af7276b8809b5aede7bb"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac2e788c201ca20e84fd38a28071abd29" id="r_ac2e788c201ca20e84fd38a28071abd29"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac2e788c201ca20e84fd38a28071abd29">stencilBits</a></td></tr>
<tr class="memdesc:ac2e788c201ca20e84fd38a28071abd29"><td class="mdescLeft">&#160;</td><td class="mdescRight">Bits of the stencil buffer.  <br /></td></tr>
<tr class="separator:ac2e788c201ca20e84fd38a28071abd29"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac4a097be18994dba38d73f36b0418bdc" id="r_ac4a097be18994dba38d73f36b0418bdc"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac4a097be18994dba38d73f36b0418bdc">antialiasingLevel</a></td></tr>
<tr class="memdesc:ac4a097be18994dba38d73f36b0418bdc"><td class="mdescLeft">&#160;</td><td class="mdescRight">Level of antialiasing.  <br /></td></tr>
<tr class="separator:ac4a097be18994dba38d73f36b0418bdc"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a99a680d5c15a7e34c935654155dd5166" id="r_a99a680d5c15a7e34c935654155dd5166"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a99a680d5c15a7e34c935654155dd5166">majorVersion</a></td></tr>
<tr class="memdesc:a99a680d5c15a7e34c935654155dd5166"><td class="mdescLeft">&#160;</td><td class="mdescRight">Major number of the context version to create.  <br /></td></tr>
<tr class="separator:a99a680d5c15a7e34c935654155dd5166"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:aaeb0efe9d2658b840da93b30554b100f" id="r_aaeb0efe9d2658b840da93b30554b100f"><td class="memItemLeft" align="right" valign="top">unsigned int&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#aaeb0efe9d2658b840da93b30554b100f">minorVersion</a></td></tr>
<tr class="memdesc:aaeb0efe9d2658b840da93b30554b100f"><td class="mdescLeft">&#160;</td><td class="mdescRight">Minor number of the context version to create.  <br /></td></tr>
<tr class="separator:aaeb0efe9d2658b840da93b30554b100f"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0ef3fc53802bc0197d2739466915ada5" id="r_a0ef3fc53802bc0197d2739466915ada5"><td class="memItemLeft" align="right" valign="top">Uint32&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a0ef3fc53802bc0197d2739466915ada5">attributeFlags</a></td></tr>
<tr class="memdesc:a0ef3fc53802bc0197d2739466915ada5"><td class="mdescLeft">&#160;</td><td class="mdescRight">The attribute flags to create the context with.  <br /></td></tr>
<tr class="separator:a0ef3fc53802bc0197d2739466915ada5"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac93b041bfb6cbd36034997797708a0a3" id="r_ac93b041bfb6cbd36034997797708a0a3"><td class="memItemLeft" align="right" valign="top">bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac93b041bfb6cbd36034997797708a0a3">sRgbCapable</a></td></tr>
<tr class="memdesc:ac93b041bfb6cbd36034997797708a0a3"><td class="mdescLeft">&#160;</td><td class="mdescRight">Whether the context framebuffer is sRGB capable.  <br /></td></tr>
<tr class="separator:ac93b041bfb6cbd36034997797708a0a3"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Structure defining the settings of the OpenGL context attached to a window. </p>
<p><a class="el" href="structsf_1_1ContextSettings.php" title="Structure defining the settings of the OpenGL context attached to a window.">ContextSettings</a> allows to define several advanced settings of the OpenGL context attached to a window.</p>
<p>All these settings with the exception of the compatibility flag and anti-aliasing level have no impact on the regular SFML rendering (graphics module), so you may need to use this structure only if you're using SFML as a windowing system for custom OpenGL rendering.</p>
<p>The depthBits and stencilBits members define the number of bits per pixel requested for the (respectively) depth and stencil buffers.</p>
<p>antialiasingLevel represents the requested number of multisampling levels for anti-aliasing.</p>
<p>majorVersion and minorVersion define the version of the OpenGL context that you want. Only versions greater or equal to 3.0 are relevant; versions lesser than 3.0 are all handled the same way (i.e. you can use any version &lt; 3.0 if you don't want an OpenGL 3 context).</p>
<p>When requesting a context with a version greater or equal to 3.2, you have the option of specifying whether the context should follow the core or compatibility profile of all newer (&gt;= 3.2) OpenGL specifications. For versions 3.0 and 3.1 there is only the core profile. By default a compatibility context is created. You only need to specify the core flag if you want a core profile context to use with your own OpenGL rendering. <b>Warning: The graphics module will not function if you request a core profile context. Make sure the attributes are set to Default if you want to use the graphics module.</b></p>
<p>Setting the debug attribute flag will request a context with additional debugging features enabled. Depending on the system, this might be required for advanced OpenGL debugging. OpenGL debugging is disabled by default.</p>
<p><b>Special Note for OS X:</b> Apple only supports choosing between either a legacy context (OpenGL 2.1) or a core context (OpenGL version depends on the operating system version but is at least 3.2). Compatibility contexts are not supported. Further information is available on the <a href="https://developer.apple.com/opengl/capabilities/index.html">OpenGL Capabilities Tables</a> page. OS X also currently does not support debug contexts.</p>
<p>Please note that these values are only a hint. No failure will be reported if one or more of these values are not supported by the system; instead, SFML will try to find the closest valid match. You can then retrieve the settings that the window actually used to create its context, with <a class="el" href="classsf_1_1Window.php#a0605afbaceb02b098f9d731b7ab4203d" title="Get the settings of the OpenGL context of the window.">Window::getSettings()</a>. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00037">37</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>
</div><h2 class="groupheader">Member Enumeration Documentation</h2>
<a id="af2e91e57e8d26c40afe2ec8efaa32a2c" name="af2e91e57e8d26c40afe2ec8efaa32a2c"></a>
<h2 class="memtitle"><span class="permalink"><a href="#af2e91e57e8d26c40afe2ec8efaa32a2c">&#9670;&#160;</a></span>Attribute</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">enum <a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2c">sf::ContextSettings::Attribute</a></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Enumeration of the context attribute flags. </p>
<table class="fieldtable">
<tr><th colspan="2">Enumerator</th></tr><tr><td class="fieldname"><a id="af2e91e57e8d26c40afe2ec8efaa32a2cabf868dcb751b909bf031484ed42a93bb" name="af2e91e57e8d26c40afe2ec8efaa32a2cabf868dcb751b909bf031484ed42a93bb"></a>Default&#160;</td><td class="fielddoc"><p>Non-debug, compatibility context (this and the core attribute are mutually exclusive) </p>
</td></tr>
<tr><td class="fieldname"><a id="af2e91e57e8d26c40afe2ec8efaa32a2cacb581130734cbd87cbbc9438429f4a8b" name="af2e91e57e8d26c40afe2ec8efaa32a2cacb581130734cbd87cbbc9438429f4a8b"></a>Core&#160;</td><td class="fielddoc"><p>Core attribute. </p>
</td></tr>
<tr><td class="fieldname"><a id="af2e91e57e8d26c40afe2ec8efaa32a2ca6043f67afb3d48918d5336474eabaafc" name="af2e91e57e8d26c40afe2ec8efaa32a2ca6043f67afb3d48918d5336474eabaafc"></a>Debug&#160;</td><td class="fielddoc"><p>Debug attribute. </p>
</td></tr>
</table>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00043">43</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a id="ac56869ccbb6bf0df48b88880754e12b7" name="ac56869ccbb6bf0df48b88880754e12b7"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac56869ccbb6bf0df48b88880754e12b7">&#9670;&#160;</a></span>ContextSettings()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">sf::ContextSettings::ContextSettings </td>
          <td>(</td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>depth</em></span><span class="paramdefsep"> = </span><span class="paramdefval">0</span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>stencil</em></span><span class="paramdefsep"> = </span><span class="paramdefval">0</span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>antialiasing</em></span><span class="paramdefsep"> = </span><span class="paramdefval">0</span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>major</em></span><span class="paramdefsep"> = </span><span class="paramdefval">1</span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>minor</em></span><span class="paramdefsep"> = </span><span class="paramdefval">1</span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int</td>          <td class="paramname"><span class="paramname"><em>attributes</em></span><span class="paramdefsep"> = </span><span class="paramdefval"><a class="el" href="#af2e91e57e8d26c40afe2ec8efaa32a2cabf868dcb751b909bf031484ed42a93bb">Default</a></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">bool</td>          <td class="paramname"><span class="paramname"><em>sRgb</em></span><span class="paramdefsep"> = </span><span class="paramdefval">false</span>&#160;)</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">inline</span><span class="mlabel">explicit</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Default constructor. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">depth</td><td>Depth buffer bits </td></tr>
    <tr><td class="paramname">stencil</td><td>Stencil buffer bits </td></tr>
    <tr><td class="paramname">antialiasing</td><td>Antialiasing level </td></tr>
    <tr><td class="paramname">major</td><td>Major number of the context version </td></tr>
    <tr><td class="paramname">minor</td><td>Minor number of the context version </td></tr>
    <tr><td class="paramname">attributes</td><td>Attribute flags of the context </td></tr>
    <tr><td class="paramname">sRgb</td><td>sRGB capable framebuffer </td></tr>
  </table>
  </dd>
</dl>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00062">62</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<h2 class="groupheader">Member Data Documentation</h2>
<a id="ac4a097be18994dba38d73f36b0418bdc" name="ac4a097be18994dba38d73f36b0418bdc"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac4a097be18994dba38d73f36b0418bdc">&#9670;&#160;</a></span>antialiasingLevel</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::ContextSettings::antialiasingLevel</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Level of antialiasing. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00078">78</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="a0ef3fc53802bc0197d2739466915ada5" name="a0ef3fc53802bc0197d2739466915ada5"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a0ef3fc53802bc0197d2739466915ada5">&#9670;&#160;</a></span>attributeFlags</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">Uint32 sf::ContextSettings::attributeFlags</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>The attribute flags to create the context with. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00081">81</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="a4809e22089c2af7276b8809b5aede7bb" name="a4809e22089c2af7276b8809b5aede7bb"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a4809e22089c2af7276b8809b5aede7bb">&#9670;&#160;</a></span>depthBits</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::ContextSettings::depthBits</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Bits of the depth buffer. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00076">76</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="a99a680d5c15a7e34c935654155dd5166" name="a99a680d5c15a7e34c935654155dd5166"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a99a680d5c15a7e34c935654155dd5166">&#9670;&#160;</a></span>majorVersion</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::ContextSettings::majorVersion</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Major number of the context version to create. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00079">79</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="aaeb0efe9d2658b840da93b30554b100f" name="aaeb0efe9d2658b840da93b30554b100f"></a>
<h2 class="memtitle"><span class="permalink"><a href="#aaeb0efe9d2658b840da93b30554b100f">&#9670;&#160;</a></span>minorVersion</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::ContextSettings::minorVersion</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Minor number of the context version to create. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00080">80</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="ac93b041bfb6cbd36034997797708a0a3" name="ac93b041bfb6cbd36034997797708a0a3"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac93b041bfb6cbd36034997797708a0a3">&#9670;&#160;</a></span>sRgbCapable</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">bool sf::ContextSettings::sRgbCapable</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Whether the context framebuffer is sRGB capable. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00082">82</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<a id="ac2e788c201ca20e84fd38a28071abd29" name="ac2e788c201ca20e84fd38a28071abd29"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac2e788c201ca20e84fd38a28071abd29">&#9670;&#160;</a></span>stencilBits</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">unsigned int sf::ContextSettings::stencilBits</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Bits of the stencil buffer. </p>

<p class="definition">Definition at line <a class="el" href="ContextSettings_8hpp_source.php#l00077">77</a> of file <a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a>.</p>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="ContextSettings_8hpp_source.php">ContextSettings.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
