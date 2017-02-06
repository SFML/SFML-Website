<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Context Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Context.php">Context</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="#pub-static-methods">Static Public Member Functions</a> &#124;
<a href="#pri-static-methods">Static Private Member Functions</a> &#124;
<a href="classsf_1_1Context-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">sf::Context Class Reference<div class="ingroups"><a class="el" href="group__window.php">Window module</a></div></div>  </div>
</div><!--header-->
<div class="contents">

<p>Class holding a valid drawing context.  
 <a href="classsf_1_1Context.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Context_8hpp_source.php">Context.hpp</a>&gt;</code></p>
<div class="dynheader">
Inheritance diagram for sf::Context:</div>
<div class="dyncontent">
 <div class="center">
  <img src="classsf_1_1Context.png" usemap="#sf::Context_map" alt=""/>
  <map id="sf::Context_map" name="sf::Context_map">
<area href="classsf_1_1GlResource.php" title="Base class for classes that require an OpenGL context. " alt="sf::GlResource" shape="rect" coords="0,0,105,24"/>
<area href="classsf_1_1NonCopyable.php" title="Utility class that makes any derived class non-copyable. " alt="sf::NonCopyable" shape="rect" coords="115,0,220,24"/>
</map>
 </div></div>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:aba22797a790706ca2c5c04ee39f2b555"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#aba22797a790706ca2c5c04ee39f2b555">Context</a> ()</td></tr>
<tr class="memdesc:aba22797a790706ca2c5c04ee39f2b555"><td class="mdescLeft">&#160;</td><td class="mdescRight">Default constructor.  <a href="#aba22797a790706ca2c5c04ee39f2b555">More...</a><br /></td></tr>
<tr class="separator:aba22797a790706ca2c5c04ee39f2b555"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a805b1bbdb3e52b1fda7c9bf2cd6ca86b"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a805b1bbdb3e52b1fda7c9bf2cd6ca86b">~Context</a> ()</td></tr>
<tr class="memdesc:a805b1bbdb3e52b1fda7c9bf2cd6ca86b"><td class="mdescLeft">&#160;</td><td class="mdescRight">Destructor.  <a href="#a805b1bbdb3e52b1fda7c9bf2cd6ca86b">More...</a><br /></td></tr>
<tr class="separator:a805b1bbdb3e52b1fda7c9bf2cd6ca86b"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0806f915ea81ae1f4e8135a7a3696562"><td class="memItemLeft" align="right" valign="top">bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a0806f915ea81ae1f4e8135a7a3696562">setActive</a> (bool active)</td></tr>
<tr class="memdesc:a0806f915ea81ae1f4e8135a7a3696562"><td class="mdescLeft">&#160;</td><td class="mdescRight">Activate or deactivate explicitly the context.  <a href="#a0806f915ea81ae1f4e8135a7a3696562">More...</a><br /></td></tr>
<tr class="separator:a0806f915ea81ae1f4e8135a7a3696562"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a07e5f65a13e7ef6bbc267ed66a530766"><td class="memItemLeft" align="right" valign="top">const <a class="el" href="structsf_1_1ContextSettings.php">ContextSettings</a> &amp;&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a07e5f65a13e7ef6bbc267ed66a530766">getSettings</a> () const </td></tr>
<tr class="memdesc:a07e5f65a13e7ef6bbc267ed66a530766"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the settings of the context.  <a href="#a07e5f65a13e7ef6bbc267ed66a530766">More...</a><br /></td></tr>
<tr class="separator:a07e5f65a13e7ef6bbc267ed66a530766"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a2a9e3529e48919120e6b6fc10bad296c"><td class="memItemLeft" align="right" valign="top">&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a2a9e3529e48919120e6b6fc10bad296c">Context</a> (const <a class="el" href="structsf_1_1ContextSettings.php">ContextSettings</a> &amp;settings, unsigned int width, unsigned int height)</td></tr>
<tr class="memdesc:a2a9e3529e48919120e6b6fc10bad296c"><td class="mdescLeft">&#160;</td><td class="mdescRight">Construct a in-memory context.  <a href="#a2a9e3529e48919120e6b6fc10bad296c">More...</a><br /></td></tr>
<tr class="separator:a2a9e3529e48919120e6b6fc10bad296c"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-static-methods"></a>
Static Public Member Functions</h2></td></tr>
<tr class="memitem:a163c7f72c0c20133606657d895faa147"><td class="memItemLeft" align="right" valign="top">static bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a163c7f72c0c20133606657d895faa147">isExtensionAvailable</a> (const char *name)</td></tr>
<tr class="memdesc:a163c7f72c0c20133606657d895faa147"><td class="mdescLeft">&#160;</td><td class="mdescRight">Check whether a given OpenGL extension is available.  <a href="#a163c7f72c0c20133606657d895faa147">More...</a><br /></td></tr>
<tr class="separator:a163c7f72c0c20133606657d895faa147"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a998980d311effdf6223ce40d934c23c3"><td class="memItemLeft" align="right" valign="top">static GlFunctionPointer&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a998980d311effdf6223ce40d934c23c3">getFunction</a> (const char *name)</td></tr>
<tr class="memdesc:a998980d311effdf6223ce40d934c23c3"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the address of an OpenGL function.  <a href="#a998980d311effdf6223ce40d934c23c3">More...</a><br /></td></tr>
<tr class="separator:a998980d311effdf6223ce40d934c23c3"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a26ec3ddaf11a37c0630624037c4eea2d"><td class="memItemLeft" align="right" valign="top">static const <a class="el" href="classsf_1_1Context.php">Context</a> *&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Context.php#a26ec3ddaf11a37c0630624037c4eea2d">getActiveContext</a> ()</td></tr>
<tr class="memdesc:a26ec3ddaf11a37c0630624037c4eea2d"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the currently active context.  <a href="#a26ec3ddaf11a37c0630624037c4eea2d">More...</a><br /></td></tr>
<tr class="separator:a26ec3ddaf11a37c0630624037c4eea2d"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pri-static-methods"></a>
Static Private Member Functions</h2></td></tr>
<tr class="memitem:ae0efa7935241644608ca32ba47b22a33"><td class="memItemLeft" align="right" valign="top">static void&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1GlResource.php#ae0efa7935241644608ca32ba47b22a33">ensureGlContext</a> ()</td></tr>
<tr class="memdesc:ae0efa7935241644608ca32ba47b22a33"><td class="mdescLeft">&#160;</td><td class="mdescRight">Empty function for ABI compatibility, use acquireTransientContext instead.  <a href="#ae0efa7935241644608ca32ba47b22a33">More...</a><br /></td></tr>
<tr class="separator:ae0efa7935241644608ca32ba47b22a33"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Class holding a valid drawing context. </p>
<p>If you need to make OpenGL calls without having an active window (like in a thread), you can use an instance of this class to get a valid context.</p>
<p>Having a valid context is necessary for <em>every</em> OpenGL call.</p>
<p>Note that a context is only active in its current thread, if you create a new thread it will have no valid context by default.</p>
<p>To use a <a class="el" href="classsf_1_1Context.php" title="Class holding a valid drawing context. ">sf::Context</a> instance, just construct it and let it live as long as you need a valid context. No explicit activation is needed, all it has to do is to exist. Its destructor will take care of deactivating and freeing all the attached resources.</p>
<p>Usage example: </p><div class="fragment"><div class="line"><span class="keywordtype">void</span> threadFunction(<span class="keywordtype">void</span>*)</div>
<div class="line">{</div>
<div class="line">   <a class="code" href="classsf_1_1Context.php">sf::Context</a> context;</div>
<div class="line">   <span class="comment">// from now on, you have a valid context</span></div>
<div class="line"></div>
<div class="line">   <span class="comment">// you can make OpenGL calls</span></div>
<div class="line">   glClear(GL_DEPTH_BUFFER_BIT);</div>
<div class="line">}</div>
<div class="line"><span class="comment">// the context is automatically deactivated and destroyed</span></div>
<div class="line"><span class="comment">// by the sf::Context destructor</span></div>
</div><!-- fragment --> 
<p>Definition at line <a class="el" href="Context_8hpp_source.php#l00050">50</a> of file <a class="el" href="Context_8hpp_source.php">Context.hpp</a>.</p>
</div><h2 class="groupheader">Constructor &amp; Destructor Documentation</h2>
<a class="anchor" id="aba22797a790706ca2c5c04ee39f2b555"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::Context::Context </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Default constructor. </p>
<p>The constructor creates and activates the context </p>

</div>
</div>
<a class="anchor" id="a805b1bbdb3e52b1fda7c9bf2cd6ca86b"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::Context::~Context </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Destructor. </p>
<p>The destructor deactivates and destroys the context </p>

</div>
</div>
<a class="anchor" id="a2a9e3529e48919120e6b6fc10bad296c"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">sf::Context::Context </td>
          <td>(</td>
          <td class="paramtype">const <a class="el" href="structsf_1_1ContextSettings.php">ContextSettings</a> &amp;&#160;</td>
          <td class="paramname"><em>settings</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int&#160;</td>
          <td class="paramname"><em>width</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">unsigned int&#160;</td>
          <td class="paramname"><em>height</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Construct a in-memory context. </p>
<p>This constructor is for internal use, you don't need to bother with it.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">settings</td><td>Creation parameters </td></tr>
    <tr><td class="paramname">width</td><td>Back buffer width </td></tr>
    <tr><td class="paramname">height</td><td>Back buffer height </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<h2 class="groupheader">Member Function Documentation</h2>
<a class="anchor" id="a26ec3ddaf11a37c0630624037c4eea2d"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static const <a class="el" href="classsf_1_1Context.php">Context</a>* sf::Context::getActiveContext </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the currently active context. </p>
<dl class="section return"><dt>Returns</dt><dd>The currently active context or NULL if none is active </dd></dl>

</div>
</div>
<a class="anchor" id="a998980d311effdf6223ce40d934c23c3"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static GlFunctionPointer sf::Context::getFunction </td>
          <td>(</td>
          <td class="paramtype">const char *&#160;</td>
          <td class="paramname"><em>name</em></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the address of an OpenGL function. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">name</td><td>Name of the function to get the address of</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Address of the OpenGL function, 0 on failure </dd></dl>

</div>
</div>
<a class="anchor" id="a07e5f65a13e7ef6bbc267ed66a530766"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">const <a class="el" href="structsf_1_1ContextSettings.php">ContextSettings</a>&amp; sf::Context::getSettings </td>
          <td>(</td>
          <td class="paramname"></td><td>)</td>
          <td> const</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Get the settings of the context. </p>
<p>Note that these settings may be different than the ones passed to the constructor; they are indeed adjusted if the original settings are not directly supported by the system.</p>
<dl class="section return"><dt>Returns</dt><dd>Structure containing the settings </dd></dl>

</div>
</div>
<a class="anchor" id="a163c7f72c0c20133606657d895faa147"></a>
<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static bool sf::Context::isExtensionAvailable </td>
          <td>(</td>
          <td class="paramtype">const char *&#160;</td>
          <td class="paramname"><em>name</em></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Check whether a given OpenGL extension is available. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">name</td><td>Name of the extension to check for</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>True if available, false if unavailable </dd></dl>

</div>
</div>
<a class="anchor" id="a0806f915ea81ae1f4e8135a7a3696562"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">bool sf::Context::setActive </td>
          <td>(</td>
          <td class="paramtype">bool&#160;</td>
          <td class="paramname"><em>active</em></td><td>)</td>
          <td></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Activate or deactivate explicitly the context. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">active</td><td>True to activate, false to deactivate</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>True on success, false on failure </dd></dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Context_8hpp_source.php">Context.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
