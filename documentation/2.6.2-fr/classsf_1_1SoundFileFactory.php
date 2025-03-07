<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::SoundFileFactory Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1SoundFileFactory.php">SoundFileFactory</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-static-methods">Static Public Member Functions</a> &#124;
<a href="classsf_1_1SoundFileFactory-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::SoundFileFactory Class Reference<div class="ingroups"><a class="el" href="group__audio.php">Audio module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Manages and instantiates sound file readers and writers.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="SoundFileFactory_8hpp_source.php">SFML/Audio/SoundFileFactory.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-static-methods" name="pub-static-methods"></a>
Static Public Member Functions</h2></td></tr>
<tr class="memitem:aeee396bfdbb6ac24c57e5c73c30ec105" id="r_aeee396bfdbb6ac24c57e5c73c30ec105"><td class="memTemplParams" colspan="2">template&lt;typename T &gt; </td></tr>
<tr class="memitem:aeee396bfdbb6ac24c57e5c73c30ec105"><td class="memTemplItemLeft" align="right" valign="top">static void&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="#aeee396bfdbb6ac24c57e5c73c30ec105">registerReader</a> ()</td></tr>
<tr class="memdesc:aeee396bfdbb6ac24c57e5c73c30ec105"><td class="mdescLeft">&#160;</td><td class="mdescRight">Register a new reader.  <br /></td></tr>
<tr class="separator:aeee396bfdbb6ac24c57e5c73c30ec105"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac42f01faf678d1f410e1ce8a18e4cebb" id="r_ac42f01faf678d1f410e1ce8a18e4cebb"><td class="memTemplParams" colspan="2">template&lt;typename T &gt; </td></tr>
<tr class="memitem:ac42f01faf678d1f410e1ce8a18e4cebb"><td class="memTemplItemLeft" align="right" valign="top">static void&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="#ac42f01faf678d1f410e1ce8a18e4cebb">unregisterReader</a> ()</td></tr>
<tr class="memdesc:ac42f01faf678d1f410e1ce8a18e4cebb"><td class="mdescLeft">&#160;</td><td class="mdescRight">Unregister a reader.  <br /></td></tr>
<tr class="separator:ac42f01faf678d1f410e1ce8a18e4cebb"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:abb6e082ea3fedf22c8648113d1be5755" id="r_abb6e082ea3fedf22c8648113d1be5755"><td class="memTemplParams" colspan="2">template&lt;typename T &gt; </td></tr>
<tr class="memitem:abb6e082ea3fedf22c8648113d1be5755"><td class="memTemplItemLeft" align="right" valign="top">static void&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="#abb6e082ea3fedf22c8648113d1be5755">registerWriter</a> ()</td></tr>
<tr class="memdesc:abb6e082ea3fedf22c8648113d1be5755"><td class="mdescLeft">&#160;</td><td class="mdescRight">Register a new writer.  <br /></td></tr>
<tr class="separator:abb6e082ea3fedf22c8648113d1be5755"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a1bd8ebd264a5ec33962a9f7a8ca21a60" id="r_a1bd8ebd264a5ec33962a9f7a8ca21a60"><td class="memTemplParams" colspan="2">template&lt;typename T &gt; </td></tr>
<tr class="memitem:a1bd8ebd264a5ec33962a9f7a8ca21a60"><td class="memTemplItemLeft" align="right" valign="top">static void&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="#a1bd8ebd264a5ec33962a9f7a8ca21a60">unregisterWriter</a> ()</td></tr>
<tr class="memdesc:a1bd8ebd264a5ec33962a9f7a8ca21a60"><td class="mdescLeft">&#160;</td><td class="mdescRight">Unregister a writer.  <br /></td></tr>
<tr class="separator:a1bd8ebd264a5ec33962a9f7a8ca21a60"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ae68185540db5e2a451d626be45036fe0" id="r_ae68185540db5e2a451d626be45036fe0"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> *&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ae68185540db5e2a451d626be45036fe0">createReaderFromFilename</a> (const std::string &amp;filename)</td></tr>
<tr class="memdesc:ae68185540db5e2a451d626be45036fe0"><td class="mdescLeft">&#160;</td><td class="mdescRight">Instantiate the right reader for the given file on disk.  <br /></td></tr>
<tr class="separator:ae68185540db5e2a451d626be45036fe0"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a2384ed647b08c5b2bbf43566d5d7b5fd" id="r_a2384ed647b08c5b2bbf43566d5d7b5fd"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> *&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a2384ed647b08c5b2bbf43566d5d7b5fd">createReaderFromMemory</a> (const void *data, std::size_t sizeInBytes)</td></tr>
<tr class="memdesc:a2384ed647b08c5b2bbf43566d5d7b5fd"><td class="mdescLeft">&#160;</td><td class="mdescRight">Instantiate the right codec for the given file in memory.  <br /></td></tr>
<tr class="separator:a2384ed647b08c5b2bbf43566d5d7b5fd"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:af64ce454cde415ebd3ca5442801d87d8" id="r_af64ce454cde415ebd3ca5442801d87d8"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> *&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#af64ce454cde415ebd3ca5442801d87d8">createReaderFromStream</a> (<a class="el" href="classsf_1_1InputStream.php">InputStream</a> &amp;stream)</td></tr>
<tr class="memdesc:af64ce454cde415ebd3ca5442801d87d8"><td class="mdescLeft">&#160;</td><td class="mdescRight">Instantiate the right codec for the given file in stream.  <br /></td></tr>
<tr class="separator:af64ce454cde415ebd3ca5442801d87d8"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a2bc9da55d78be2c41a273bbbea4c0978" id="r_a2bc9da55d78be2c41a273bbbea4c0978"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1SoundFileWriter.php">SoundFileWriter</a> *&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a2bc9da55d78be2c41a273bbbea4c0978">createWriterFromFilename</a> (const std::string &amp;filename)</td></tr>
<tr class="memdesc:a2bc9da55d78be2c41a273bbbea4c0978"><td class="mdescLeft">&#160;</td><td class="mdescRight">Instantiate the right writer for the given file on disk.  <br /></td></tr>
<tr class="separator:a2bc9da55d78be2c41a273bbbea4c0978"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Manages and instantiates sound file readers and writers. </p>
<p>This class is where all the sound file readers and writers are registered.</p>
<p>You should normally only need to use its registration and unregistration functions; readers/writers creation and manipulation are wrapped into the higher-level classes <a class="el" href="classsf_1_1InputSoundFile.php" title="Provide read access to sound files.">sf::InputSoundFile</a> and <a class="el" href="classsf_1_1OutputSoundFile.php" title="Provide write access to sound files.">sf::OutputSoundFile</a>.</p>
<p>To register a new reader (writer) use the <a class="el" href="#aeee396bfdbb6ac24c57e5c73c30ec105" title="Register a new reader.">sf::SoundFileFactory::registerReader</a> (registerWriter) static function. You don't have to call the unregisterReader (unregisterWriter) function, unless you want to unregister a format before your application ends (typically, when a plugin is unloaded).</p>
<p>Usage example: </p><div class="fragment"><div class="line"><a class="code hl_function" href="#aeee396bfdbb6ac24c57e5c73c30ec105">sf::SoundFileFactory::registerReader&lt;MySoundFileReader&gt;</a>();</div>
<div class="line"><a class="code hl_function" href="#abb6e082ea3fedf22c8648113d1be5755">sf::SoundFileFactory::registerWriter&lt;MySoundFileWriter&gt;</a>();</div>
<div class="ttc" id="aclasssf_1_1SoundFileFactory_php_abb6e082ea3fedf22c8648113d1be5755"><div class="ttname"><a href="#abb6e082ea3fedf22c8648113d1be5755">sf::SoundFileFactory::registerWriter</a></div><div class="ttdeci">static void registerWriter()</div><div class="ttdoc">Register a new writer.</div></div>
<div class="ttc" id="aclasssf_1_1SoundFileFactory_php_aeee396bfdbb6ac24c57e5c73c30ec105"><div class="ttname"><a href="#aeee396bfdbb6ac24c57e5c73c30ec105">sf::SoundFileFactory::registerReader</a></div><div class="ttdeci">static void registerReader()</div><div class="ttdoc">Register a new reader.</div></div>
</div><!-- fragment --><dl class="section see"><dt>See also</dt><dd><a class="el" href="classsf_1_1InputSoundFile.php" title="Provide read access to sound files.">sf::InputSoundFile</a>, <a class="el" href="classsf_1_1OutputSoundFile.php" title="Provide write access to sound files.">sf::OutputSoundFile</a>, <a class="el" href="classsf_1_1SoundFileReader.php" title="Abstract base class for sound file decoding.">sf::SoundFileReader</a>, <a class="el" href="classsf_1_1SoundFileWriter.php" title="Abstract base class for sound file encoding.">sf::SoundFileWriter</a> </dd></dl>

<p class="definition">Definition at line <a class="el" href="SoundFileFactory_8hpp_source.php#l00046">46</a> of file <a class="el" href="SoundFileFactory_8hpp_source.php">SoundFileFactory.hpp</a>.</p>
</div><h2 class="groupheader">Member Function Documentation</h2>
<a id="ae68185540db5e2a451d626be45036fe0" name="ae68185540db5e2a451d626be45036fe0"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ae68185540db5e2a451d626be45036fe0">&#9670;&#160;</a></span>createReaderFromFilename()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> * sf::SoundFileFactory::createReaderFromFilename </td>
          <td>(</td>
          <td class="paramtype">const std::string &amp;</td>          <td class="paramname"><span class="paramname"><em>filename</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Instantiate the right reader for the given file on disk. </p>
<p>It's up to the caller to release the returned reader</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">filename</td><td>Path of the sound file</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>A new sound file reader that can read the given file, or null if no reader can handle it</dd></dl>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#a2384ed647b08c5b2bbf43566d5d7b5fd" title="Instantiate the right codec for the given file in memory.">createReaderFromMemory</a>, <a class="el" href="#af64ce454cde415ebd3ca5442801d87d8" title="Instantiate the right codec for the given file in stream.">createReaderFromStream</a> </dd></dl>

</div>
</div>
<a id="a2384ed647b08c5b2bbf43566d5d7b5fd" name="a2384ed647b08c5b2bbf43566d5d7b5fd"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a2384ed647b08c5b2bbf43566d5d7b5fd">&#9670;&#160;</a></span>createReaderFromMemory()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> * sf::SoundFileFactory::createReaderFromMemory </td>
          <td>(</td>
          <td class="paramtype">const void *</td>          <td class="paramname"><span class="paramname"><em>data</em></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">std::size_t</td>          <td class="paramname"><span class="paramname"><em>sizeInBytes</em></span>&#160;)</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Instantiate the right codec for the given file in memory. </p>
<p>It's up to the caller to release the returned reader</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">data</td><td>Pointer to the file data in memory </td></tr>
    <tr><td class="paramname">sizeInBytes</td><td>Total size of the file data, in bytes</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>A new sound file codec that can read the given file, or null if no codec can handle it</dd></dl>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#ae68185540db5e2a451d626be45036fe0" title="Instantiate the right reader for the given file on disk.">createReaderFromFilename</a>, <a class="el" href="#af64ce454cde415ebd3ca5442801d87d8" title="Instantiate the right codec for the given file in stream.">createReaderFromStream</a> </dd></dl>

</div>
</div>
<a id="af64ce454cde415ebd3ca5442801d87d8" name="af64ce454cde415ebd3ca5442801d87d8"></a>
<h2 class="memtitle"><span class="permalink"><a href="#af64ce454cde415ebd3ca5442801d87d8">&#9670;&#160;</a></span>createReaderFromStream()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1SoundFileReader.php">SoundFileReader</a> * sf::SoundFileFactory::createReaderFromStream </td>
          <td>(</td>
          <td class="paramtype"><a class="el" href="classsf_1_1InputStream.php">InputStream</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>stream</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Instantiate the right codec for the given file in stream. </p>
<p>It's up to the caller to release the returned reader</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">stream</td><td>Source stream to read from</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>A new sound file codec that can read the given file, or null if no codec can handle it</dd></dl>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#ae68185540db5e2a451d626be45036fe0" title="Instantiate the right reader for the given file on disk.">createReaderFromFilename</a>, <a class="el" href="#a2384ed647b08c5b2bbf43566d5d7b5fd" title="Instantiate the right codec for the given file in memory.">createReaderFromMemory</a> </dd></dl>

</div>
</div>
<a id="a2bc9da55d78be2c41a273bbbea4c0978" name="a2bc9da55d78be2c41a273bbbea4c0978"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a2bc9da55d78be2c41a273bbbea4c0978">&#9670;&#160;</a></span>createWriterFromFilename()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1SoundFileWriter.php">SoundFileWriter</a> * sf::SoundFileFactory::createWriterFromFilename </td>
          <td>(</td>
          <td class="paramtype">const std::string &amp;</td>          <td class="paramname"><span class="paramname"><em>filename</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Instantiate the right writer for the given file on disk. </p>
<p>It's up to the caller to release the returned writer</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">filename</td><td>Path of the sound file</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>A new sound file writer that can write given file, or null if no writer can handle it </dd></dl>

</div>
</div>
<a id="aeee396bfdbb6ac24c57e5c73c30ec105" name="aeee396bfdbb6ac24c57e5c73c30ec105"></a>
<h2 class="memtitle"><span class="permalink"><a href="#aeee396bfdbb6ac24c57e5c73c30ec105">&#9670;&#160;</a></span>registerReader()</h2>

<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename T &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::SoundFileFactory::registerReader </td>
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

<p>Register a new reader. </p>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#ac42f01faf678d1f410e1ce8a18e4cebb" title="Unregister a reader.">unregisterReader</a> </dd></dl>

</div>
</div>
<a id="abb6e082ea3fedf22c8648113d1be5755" name="abb6e082ea3fedf22c8648113d1be5755"></a>
<h2 class="memtitle"><span class="permalink"><a href="#abb6e082ea3fedf22c8648113d1be5755">&#9670;&#160;</a></span>registerWriter()</h2>

<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename T &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::SoundFileFactory::registerWriter </td>
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

<p>Register a new writer. </p>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#a1bd8ebd264a5ec33962a9f7a8ca21a60" title="Unregister a writer.">unregisterWriter</a> </dd></dl>

</div>
</div>
<a id="ac42f01faf678d1f410e1ce8a18e4cebb" name="ac42f01faf678d1f410e1ce8a18e4cebb"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac42f01faf678d1f410e1ce8a18e4cebb">&#9670;&#160;</a></span>unregisterReader()</h2>

<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename T &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::SoundFileFactory::unregisterReader </td>
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

<p>Unregister a reader. </p>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#aeee396bfdbb6ac24c57e5c73c30ec105" title="Register a new reader.">registerReader</a> </dd></dl>

</div>
</div>
<a id="a1bd8ebd264a5ec33962a9f7a8ca21a60" name="a1bd8ebd264a5ec33962a9f7a8ca21a60"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a1bd8ebd264a5ec33962a9f7a8ca21a60">&#9670;&#160;</a></span>unregisterWriter()</h2>

<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename T &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::SoundFileFactory::unregisterWriter </td>
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

<p>Unregister a writer. </p>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="#abb6e082ea3fedf22c8648113d1be5755" title="Register a new writer.">registerWriter</a> </dd></dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="SoundFileFactory_8hpp_source.php">SoundFileFactory.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
