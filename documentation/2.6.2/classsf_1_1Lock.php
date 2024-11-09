<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Lock Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Lock.php">Lock</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="classsf_1_1Lock-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::Lock Class Reference<div class="ingroups"><a class="el" href="group__system.php">System module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Automatic wrapper for locking and unlocking mutexes.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Lock_8hpp_source.php">SFML/System/Lock.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::Lock:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1Lock.png" usemap="#sf::Lock_map" alt=""/>
  <map id="sf::Lock_map" name="sf::Lock_map">
<area href="classsf_1_1NonCopyable.php" title="Utility class that makes any derived class non-copyable." alt="sf::NonCopyable" shape="rect" coords="0,0,105,24"/>
  </map>
</div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-methods" name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:a1a4c5d7a15da61103d85c9aa7f118920" id="r_a1a4c5d7a15da61103d85c9aa7f118920"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a1a4c5d7a15da61103d85c9aa7f118920">Lock</a> (<a class="el" href="classsf_1_1Mutex.php">Mutex</a> &amp;mutex)</td></tr>
<tr class="memdesc:a1a4c5d7a15da61103d85c9aa7f118920"><td class="mdescLeft">&#160;</td><td class="mdescRight">Construct the lock with a target mutex.  <br /></td></tr>
<tr class="separator:a1a4c5d7a15da61103d85c9aa7f118920"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a8168b36323a18ccf5b6bc531d964aec5" id="r_a8168b36323a18ccf5b6bc531d964aec5"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a8168b36323a18ccf5b6bc531d964aec5">~Lock</a> ()</td></tr>
<tr class="memdesc:a8168b36323a18ccf5b6bc531d964aec5"><td class="mdescLeft">&#160;</td><td class="mdescRight">Destructor.  <br /></td></tr>
<tr class="separator:a8168b36323a18ccf5b6bc531d964aec5"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Automatic wrapper for locking and unlocking mutexes. </p>
<p><a class="el" href="classsf_1_1Lock.php" title="Automatic wrapper for locking and unlocking mutexes.">sf::Lock</a> is a RAII wrapper for <a class="el" href="classsf_1_1Mutex.php" title="Blocks concurrent access to shared resources from multiple threads.">sf::Mutex</a>.</p>
<p>By unlocking it in its destructor, it ensures that the mutex will always be released when the current scope (most likely a function) ends. This is even more important when an exception or an early return statement can interrupt the execution flow of the function.</p>
<p>For maximum robustness, <a class="el" href="classsf_1_1Lock.php" title="Automatic wrapper for locking and unlocking mutexes.">sf::Lock</a> should always be used to lock/unlock a mutex.</p>
<p>Usage example: </p><div class="fragment"><div class="line"><a class="code hl_class" href="classsf_1_1Mutex.php">sf::Mutex</a> mutex;</div>
<div class="line"> </div>
<div class="line"><span class="keywordtype">void</span> function()</div>
<div class="line">{</div>
<div class="line">    <a class="code hl_class" href="classsf_1_1Lock.php">sf::Lock</a> lock(mutex); <span class="comment">// mutex is now locked</span></div>
<div class="line"> </div>
<div class="line">    functionThatMayThrowAnException(); <span class="comment">// mutex is unlocked if this function throws</span></div>
<div class="line"> </div>
<div class="line">    <span class="keywordflow">if</span> (someCondition)</div>
<div class="line">        <span class="keywordflow">return</span>; <span class="comment">// mutex is unlocked</span></div>
<div class="line"> </div>
<div class="line">} <span class="comment">// mutex is unlocked</span></div>
<div class="ttc" id="aclasssf_1_1Lock_php"><div class="ttname"><a href="classsf_1_1Lock.php">sf::Lock</a></div><div class="ttdoc">Automatic wrapper for locking and unlocking mutexes.</div><div class="ttdef"><b>Definition</b> <a href="Lock_8hpp_source.php#l00043">Lock.hpp:44</a></div></div>
<div class="ttc" id="aclasssf_1_1Mutex_php"><div class="ttname"><a href="classsf_1_1Mutex.php">sf::Mutex</a></div><div class="ttdoc">Blocks concurrent access to shared resources from multiple threads.</div><div class="ttdef"><b>Definition</b> <a href="Mutex_8hpp_source.php#l00047">Mutex.hpp:48</a></div></div>
</div><!-- fragment --><p>Because the mutex is not explicitly unlocked in the code, it may remain locked longer than needed. If the region of the code that needs to be protected by the mutex is not the entire function, a good practice is to create a smaller, inner scope so that the lock is limited to this part of the code.</p>
<div class="fragment"><div class="line"><a class="code hl_class" href="classsf_1_1Mutex.php">sf::Mutex</a> mutex;</div>
<div class="line"> </div>
<div class="line"><span class="keywordtype">void</span> function()</div>
<div class="line">{</div>
<div class="line">    {</div>
<div class="line">      <a class="code hl_class" href="classsf_1_1Lock.php">sf::Lock</a> lock(mutex);</div>
<div class="line">      codeThatRequiresProtection();</div>
<div class="line"> </div>
<div class="line">    } <span class="comment">// mutex is unlocked here</span></div>
<div class="line"> </div>
<div class="line">    codeThatDoesntCareAboutTheMutex();</div>
<div class="line">}</div>
</div><!-- fragment --><p>Having a mutex locked longer than required is a bad practice which can lead to bad performances. Don't forget that when a mutex is locked, other threads may be waiting doing nothing until it is released.</p>
<dl class="section see"><dt>See also</dt><dd><a class="el" href="classsf_1_1Mutex.php" title="Blocks concurrent access to shared resources from multiple threads.">sf::Mutex</a> </dd></dl>

<p class="definition">Definition at line <a class="el" href="Lock_8hpp_source.php#l00043">43</a> of file <a class="el" href="Lock_8hpp_source.php">Lock.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a id="a1a4c5d7a15da61103d85c9aa7f118920" name="a1a4c5d7a15da61103d85c9aa7f118920"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a1a4c5d7a15da61103d85c9aa7f118920">&#9670;&#160;</a></span>Lock()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">sf::Lock::Lock </td>
          <td>(</td>
          <td class="paramtype"><a class="el" href="classsf_1_1Mutex.php">Mutex</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>mutex</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">explicit</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Construct the lock with a target mutex. </p>
<p>The mutex passed to <a class="el" href="classsf_1_1Lock.php" title="Automatic wrapper for locking and unlocking mutexes.">sf::Lock</a> is automatically locked.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">mutex</td><td><a class="el" href="classsf_1_1Mutex.php" title="Blocks concurrent access to shared resources from multiple threads.">Mutex</a> to lock </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<a id="a8168b36323a18ccf5b6bc531d964aec5" name="a8168b36323a18ccf5b6bc531d964aec5"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a8168b36323a18ccf5b6bc531d964aec5">&#9670;&#160;</a></span>~Lock()</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::Lock::~Lock </td>
          <td>(</td>
          <td class="paramname"><span class="paramname"><em></em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Destructor. </p>
<p>The destructor of <a class="el" href="classsf_1_1Lock.php" title="Automatic wrapper for locking and unlocking mutexes.">sf::Lock</a> automatically unlocks its mutex. </p>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Lock_8hpp_source.php">Lock.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
