<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::MemoryInputStream Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1MemoryInputStream.php">MemoryInputStream</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="classsf_1_1MemoryInputStream-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::MemoryInputStream Class Reference<div class="ingroups"><a class="el" href="group__system.php">System module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Implementation of input stream based on a memory chunk.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="MemoryInputStream_8hpp_source.php">SFML/System/MemoryInputStream.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::MemoryInputStream:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1MemoryInputStream.png" usemap="#sf::MemoryInputStream_map" alt=""/>
  <map id="sf::MemoryInputStream_map" name="sf::MemoryInputStream_map">
<area href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams." alt="sf::InputStream" shape="rect" coords="0,0,140,24"/>
  </map>
</div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-methods" name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:a2d78851a69a8956a79872be41bcdfe0e" id="r_a2d78851a69a8956a79872be41bcdfe0e"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a2d78851a69a8956a79872be41bcdfe0e">MemoryInputStream</a> ()</td></tr>
<tr class="memdesc:a2d78851a69a8956a79872be41bcdfe0e"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <br /></td></tr>
<tr class="separator:a2d78851a69a8956a79872be41bcdfe0e"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ad3cfb4f4f915f7803d6a0784e394ac19" id="r_ad3cfb4f4f915f7803d6a0784e394ac19"><td class="memItemLeft" align="right" valign="top">void&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ad3cfb4f4f915f7803d6a0784e394ac19">open</a> (const void *data, std::size_t sizeInBytes)</td></tr>
<tr class="memdesc:ad3cfb4f4f915f7803d6a0784e394ac19"><td class="mdescLeft">&#160;</td><td class="mdescRight">Open the stream from its data.  <br /></td></tr>
<tr class="separator:ad3cfb4f4f915f7803d6a0784e394ac19"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:adff5270c521819639154d42d76fd4c34" id="r_adff5270c521819639154d42d76fd4c34"><td class="memItemLeft" align="right" valign="top">virtual Int64&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#adff5270c521819639154d42d76fd4c34">read</a> (void *data, Int64 size)</td></tr>
<tr class="memdesc:adff5270c521819639154d42d76fd4c34"><td class="mdescLeft">&#160;</td><td class="mdescRight">Read data from the stream.  <br /></td></tr>
<tr class="separator:adff5270c521819639154d42d76fd4c34"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:aa2ac8fda2bdb4c95248ae90c71633034" id="r_aa2ac8fda2bdb4c95248ae90c71633034"><td class="memItemLeft" align="right" valign="top">virtual Int64&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#aa2ac8fda2bdb4c95248ae90c71633034">seek</a> (Int64 position)</td></tr>
<tr class="memdesc:aa2ac8fda2bdb4c95248ae90c71633034"><td class="mdescLeft">&#160;</td><td class="mdescRight">Change the current reading position.  <br /></td></tr>
<tr class="separator:aa2ac8fda2bdb4c95248ae90c71633034"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a7ad4bdf721f29de8f66421ff29e23ee4" id="r_a7ad4bdf721f29de8f66421ff29e23ee4"><td class="memItemLeft" align="right" valign="top">virtual Int64&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a7ad4bdf721f29de8f66421ff29e23ee4">tell</a> ()</td></tr>
<tr class="memdesc:a7ad4bdf721f29de8f66421ff29e23ee4"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the current reading position in the stream.  <br /></td></tr>
<tr class="separator:a7ad4bdf721f29de8f66421ff29e23ee4"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6ade3ca45de361ffa0a718595f0b6763" id="r_a6ade3ca45de361ffa0a718595f0b6763"><td class="memItemLeft" align="right" valign="top">virtual Int64&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a6ade3ca45de361ffa0a718595f0b6763">getSize</a> ()</td></tr>
<tr class="memdesc:a6ade3ca45de361ffa0a718595f0b6763"><td class="mdescLeft">&#160;</td><td class="mdescRight">Return the size of the stream.  <br /></td></tr>
<tr class="separator:a6ade3ca45de361ffa0a718595f0b6763"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Implementation of input stream based on a memory chunk. </p>
<p>This class is a specialization of <a class="el" href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams.">InputStream</a> that reads from data in memory.</p>
<p>It wraps a memory chunk in the common <a class="el" href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams.">InputStream</a> interface and therefore allows to use generic classes or functions that accept such a stream, with content already loaded in memory.</p>
<p>In addition to the virtual functions inherited from <a class="el" href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams.">InputStream</a>, <a class="el" href="classsf_1_1MemoryInputStream.php" title="Implementation of input stream based on a memory chunk.">MemoryInputStream</a> adds a function to specify the pointer and size of the data in memory.</p>
<p>SFML resource classes can usually be loaded directly from memory, so this class shouldn't be useful to you unless you create your own algorithms that operate on an <a class="el" href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams.">InputStream</a>.</p>
<p>Usage example: </p><div class="fragment"><div class="line"><span class="keywordtype">void</span> process(<a class="code hl_class" href="classsf_1_1InputStream.php">InputStream</a>&amp; stream);</div>
<div class="line"> </div>
<div class="line"><a class="code hl_class" href="classsf_1_1MemoryInputStream.php">MemoryInputStream</a> stream;</div>
<div class="line">stream.<a class="code hl_function" href="#ad3cfb4f4f915f7803d6a0784e394ac19">open</a>(thePtr, theSize);</div>
<div class="line">process(stream);</div>
<div class="ttc" id="aclasssf_1_1InputStream_php"><div class="ttname"><a href="classsf_1_1InputStream.php">sf::InputStream</a></div><div class="ttdoc">Abstract class for custom file input streams.</div><div class="ttdef"><b>Definition</b> <a href="InputStream_8hpp_source.php#l00041">InputStream.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php">sf::MemoryInputStream</a></div><div class="ttdoc">Implementation of input stream based on a memory chunk.</div><div class="ttdef"><b>Definition</b> <a href="MemoryInputStream_8hpp_source.php#l00043">MemoryInputStream.hpp:44</a></div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_ad3cfb4f4f915f7803d6a0784e394ac19"><div class="ttname"><a href="#ad3cfb4f4f915f7803d6a0784e394ac19">sf::MemoryInputStream::open</a></div><div class="ttdeci">void open(const void *data, std::size_t sizeInBytes)</div><div class="ttdoc">Open the stream from its data.</div></div>
</div><!-- fragment --><p><a class="el" href="classsf_1_1InputStream.php" title="Abstract class for custom file input streams.">InputStream</a>, <a class="el" href="classsf_1_1FileInputStream.php" title="Implementation of input stream based on a file.">FileInputStream</a> </p>

<p class="definition">Definition at line <a class="el" href="MemoryInputStream_8hpp_source.php#l00043">43</a> of file <a class="el" href="MemoryInputStream_8hpp_source.php">MemoryInputStream.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a id="a2d78851a69a8956a79872be41bcdfe0e" name="a2d78851a69a8956a79872be41bcdfe0e"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a2d78851a69a8956a79872be41bcdfe0e">&#9670;&#160;</a></span>MemoryInputStream()</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::MemoryInputStream::MemoryInputStream </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Default constructor. </p>

</div>
</div>
<h2 class="groupheader">Member Function Documentation</h2>
<a id="a6ade3ca45de361ffa0a718595f0b6763" name="a6ade3ca45de361ffa0a718595f0b6763"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a6ade3ca45de361ffa0a718595f0b6763">&#9670;&#160;</a></span>getSize()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">virtual Int64 sf::MemoryInputStream::getSize </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">virtual</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Return the size of the stream. </p>
<dl class="section return"><dt>Returns</dt><dd>The total number of bytes available in the stream, or -1 on error </dd></dl>

<p>Implements <a class="el" href="classsf_1_1InputStream.php#a311eaaaa65d636728e5153b574b72d5d">sf::InputStream</a>.</p>

</div>
</div>
<a id="ad3cfb4f4f915f7803d6a0784e394ac19" name="ad3cfb4f4f915f7803d6a0784e394ac19"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ad3cfb4f4f915f7803d6a0784e394ac19">&#9670;&#160;</a></span>open()</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">void sf::MemoryInputStream::open </td>
          <td>(</td>
          <td class="paramtype">const void *</td>          <td class="paramname"><span class="paramname"><em>data</em></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">std::size_t</td>          <td class="paramname"><span class="paramname"><em>sizeInBytes</em></span>&#160;)</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Open the stream from its data. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">data</td><td>Pointer to the data in memory </td></tr>
    <tr><td class="paramname">sizeInBytes</td><td>Size of the data, in bytes </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<a id="adff5270c521819639154d42d76fd4c34" name="adff5270c521819639154d42d76fd4c34"></a>
<h2 class="memtitle"><span class="permalink"><a href="#adff5270c521819639154d42d76fd4c34">&#9670;&#160;</a></span>read()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">virtual Int64 sf::MemoryInputStream::read </td>
          <td>(</td>
          <td class="paramtype">void *</td>          <td class="paramname"><span class="paramname"><em>data</em></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Int64</td>          <td class="paramname"><span class="paramname"><em>size</em></span>&#160;)</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">virtual</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Read data from the stream. </p>
<p>After reading, the stream's reading position must be advanced by the amount of bytes read.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">data</td><td>Buffer where to copy the read data </td></tr>
    <tr><td class="paramname">size</td><td>Desired number of bytes to read</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>The number of bytes actually read, or -1 on error </dd></dl>

<p>Implements <a class="el" href="classsf_1_1InputStream.php#a8dd89c74c1acb693203f50e750c6ae53">sf::InputStream</a>.</p>

</div>
</div>
<a id="aa2ac8fda2bdb4c95248ae90c71633034" name="aa2ac8fda2bdb4c95248ae90c71633034"></a>
<h2 class="memtitle"><span class="permalink"><a href="#aa2ac8fda2bdb4c95248ae90c71633034">&#9670;&#160;</a></span>seek()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">virtual Int64 sf::MemoryInputStream::seek </td>
          <td>(</td>
          <td class="paramtype">Int64</td>          <td class="paramname"><span class="paramname"><em>position</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">virtual</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Change the current reading position. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">position</td><td>The position to seek to, from the beginning</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>The position actually sought to, or -1 on error </dd></dl>

<p>Implements <a class="el" href="classsf_1_1InputStream.php#a76aba8e5d5cf9b1c5902d5e04f7864fc">sf::InputStream</a>.</p>

</div>
</div>
<a id="a7ad4bdf721f29de8f66421ff29e23ee4" name="a7ad4bdf721f29de8f66421ff29e23ee4"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a7ad4bdf721f29de8f66421ff29e23ee4">&#9670;&#160;</a></span>tell()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">virtual Int64 sf::MemoryInputStream::tell </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">virtual</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the current reading position in the stream. </p>
<dl class="section return"><dt>Returns</dt><dd>The current position, or -1 on error. </dd></dl>

<p>Implements <a class="el" href="classsf_1_1InputStream.php#a599515b9ccdbddb6fef5a98424fd559c">sf::InputStream</a>.</p>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="MemoryInputStream_8hpp_source.php">MemoryInputStream.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
