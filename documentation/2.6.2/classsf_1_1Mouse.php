<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Mouse Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Mouse.php">Mouse</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="summary">
<a href="#pub-types">Public Types</a> &#124;
<a href="#pub-static-methods">Static Public Member Functions</a> &#124;
<a href="classsf_1_1Mouse-members.php">List of all members</a>  </div>
  <div class="headertitle"><div class="title">sf::Mouse Class Reference<div class="ingroups"><a class="el" href="group__window.php">Window module</a></div></div></div>
</div><!--header-->
<div class="contents">

<p>Give access to the real-time state of the mouse.  
 <a href="#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Mouse_8hpp_source.php">SFML/Window/Mouse.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-types" name="pub-types"></a>
Public Types</h2></td></tr>
<tr class="memitem:a4fb128be433f9aafe66bc0c605daaa90" id="r_a4fb128be433f9aafe66bc0c605daaa90"><td class="memItemLeft" align="right" valign="top">enum &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90">Button</a> { <br />
&#160;&#160;<a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8">Left</a>
, <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90af2cff24ab6c26daf079b11189f982fc4">Right</a>
, <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90a2c353189c4b11cf216d7caddafcc609d">Middle</a>
, <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7">XButton1</a>
, <br />
&#160;&#160;<a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a">XButton2</a>
, <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90a52a1d434289774240ddaa22496762402">ButtonCount</a>
<br />
 }</td></tr>
<tr class="memdesc:a4fb128be433f9aafe66bc0c605daaa90"><td class="mdescLeft">&#160;</td><td class="mdescRight"><a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">Mouse</a> buttons.  <a href="#a4fb128be433f9aafe66bc0c605daaa90">More...</a><br /></td></tr>
<tr class="separator:a4fb128be433f9aafe66bc0c605daaa90"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a60dd479a43f26f200e7957aa11803ff4" id="r_a60dd479a43f26f200e7957aa11803ff4"><td class="memItemLeft" align="right" valign="top">enum &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a60dd479a43f26f200e7957aa11803ff4">Wheel</a> { <a class="el" href="#a60dd479a43f26f200e7957aa11803ff4abd571de908d2b2c4b9f165f29c678496">VerticalWheel</a>
, <a class="el" href="#a60dd479a43f26f200e7957aa11803ff4a785768d5e33c77de9fdcfdd02219f4e2">HorizontalWheel</a>
 }</td></tr>
<tr class="memdesc:a60dd479a43f26f200e7957aa11803ff4"><td class="mdescLeft">&#160;</td><td class="mdescRight"><a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">Mouse</a> wheels.  <a href="#a60dd479a43f26f200e7957aa11803ff4">More...</a><br /></td></tr>
<tr class="separator:a60dd479a43f26f200e7957aa11803ff4"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a id="pub-static-methods" name="pub-static-methods"></a>
Static Public Member Functions</h2></td></tr>
<tr class="memitem:ab647159eb88e369a0332a9c5a7ba6687" id="r_ab647159eb88e369a0332a9c5a7ba6687"><td class="memItemLeft" align="right" valign="top">static bool&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ab647159eb88e369a0332a9c5a7ba6687">isButtonPressed</a> (<a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90">Button</a> button)</td></tr>
<tr class="memdesc:ab647159eb88e369a0332a9c5a7ba6687"><td class="mdescLeft">&#160;</td><td class="mdescRight">Check if a mouse button is pressed.  <br /></td></tr>
<tr class="separator:ab647159eb88e369a0332a9c5a7ba6687"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac368680f797b7f6e4f50b5b7928c1387" id="r_ac368680f797b7f6e4f50b5b7928c1387"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1Vector2.php">Vector2i</a>&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac368680f797b7f6e4f50b5b7928c1387">getPosition</a> ()</td></tr>
<tr class="memdesc:ac368680f797b7f6e4f50b5b7928c1387"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the current position of the mouse in desktop coordinates.  <br /></td></tr>
<tr class="separator:ac368680f797b7f6e4f50b5b7928c1387"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac9934f761e377da97993de5aab75006b" id="r_ac9934f761e377da97993de5aab75006b"><td class="memItemLeft" align="right" valign="top">static <a class="el" href="classsf_1_1Vector2.php">Vector2i</a>&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#ac9934f761e377da97993de5aab75006b">getPosition</a> (const <a class="el" href="classsf_1_1WindowBase.php">WindowBase</a> &amp;relativeTo)</td></tr>
<tr class="memdesc:ac9934f761e377da97993de5aab75006b"><td class="mdescLeft">&#160;</td><td class="mdescRight">Get the current position of the mouse in window coordinates.  <br /></td></tr>
<tr class="separator:ac9934f761e377da97993de5aab75006b"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a1222e16c583be9e3d176d86e0b7817d7" id="r_a1222e16c583be9e3d176d86e0b7817d7"><td class="memItemLeft" align="right" valign="top">static void&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a1222e16c583be9e3d176d86e0b7817d7">setPosition</a> (const <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> &amp;position)</td></tr>
<tr class="memdesc:a1222e16c583be9e3d176d86e0b7817d7"><td class="mdescLeft">&#160;</td><td class="mdescRight">Set the current position of the mouse in desktop coordinates.  <br /></td></tr>
<tr class="separator:a1222e16c583be9e3d176d86e0b7817d7"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a698c41e9bce6f30ceb4063c21f869fc5" id="r_a698c41e9bce6f30ceb4063c21f869fc5"><td class="memItemLeft" align="right" valign="top">static void&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="#a698c41e9bce6f30ceb4063c21f869fc5">setPosition</a> (const <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> &amp;position, const <a class="el" href="classsf_1_1WindowBase.php">WindowBase</a> &amp;relativeTo)</td></tr>
<tr class="memdesc:a698c41e9bce6f30ceb4063c21f869fc5"><td class="mdescLeft">&#160;</td><td class="mdescRight">Set the current position of the mouse in window coordinates.  <br /></td></tr>
<tr class="separator:a698c41e9bce6f30ceb4063c21f869fc5"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p>Give access to the real-time state of the mouse. </p>
<p><a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">sf::Mouse</a> provides an interface to the state of the mouse.</p>
<p>It only contains static functions (a single mouse is assumed), so it's not meant to be instantiated.</p>
<p>This class allows users to query the mouse state at any time and directly, without having to deal with a window and its events. Compared to the MouseMoved, MouseButtonPressed and MouseButtonReleased events, <a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">sf::Mouse</a> can retrieve the state of the cursor and the buttons at any time (you don't need to store and update a boolean on your side in order to know if a button is pressed or released), and you always get the real state of the mouse, even if it is moved, pressed or released when your window is out of focus and no event is triggered.</p>
<p>The setPosition and getPosition functions can be used to change or retrieve the current position of the mouse pointer. There are two versions: one that operates in global coordinates (relative to the desktop) and one that operates in window coordinates (relative to a specific window).</p>
<p>Usage example: </p><div class="fragment"><div class="line"><span class="keywordflow">if</span> (<a class="code hl_function" href="#ab647159eb88e369a0332a9c5a7ba6687">sf::Mouse::isButtonPressed</a>(<a class="code hl_enumvalue" href="#a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8">sf::Mouse::Left</a>))</div>
<div class="line">{</div>
<div class="line">    <span class="comment">// left click...</span></div>
<div class="line">}</div>
<div class="line"> </div>
<div class="line"><span class="comment">// get global mouse position</span></div>
<div class="line"><a class="code hl_class" href="classsf_1_1Vector2.php">sf::Vector2i</a> position = <a class="code hl_function" href="#ac368680f797b7f6e4f50b5b7928c1387">sf::Mouse::getPosition</a>();</div>
<div class="line"> </div>
<div class="line"><span class="comment">// set mouse position relative to a window</span></div>
<div class="line"><a class="code hl_function" href="#a1222e16c583be9e3d176d86e0b7817d7">sf::Mouse::setPosition</a>(<a class="code hl_class" href="classsf_1_1Vector2.php">sf::Vector2i</a>(100, 200), window);</div>
<div class="ttc" id="aclasssf_1_1Mouse_php_a1222e16c583be9e3d176d86e0b7817d7"><div class="ttname"><a href="#a1222e16c583be9e3d176d86e0b7817d7">sf::Mouse::setPosition</a></div><div class="ttdeci">static void setPosition(const Vector2i &amp;position)</div><div class="ttdoc">Set the current position of the mouse in desktop coordinates.</div></div>
<div class="ttc" id="aclasssf_1_1Mouse_php_a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8"><div class="ttname"><a href="#a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8">sf::Mouse::Left</a></div><div class="ttdeci">@ Left</div><div class="ttdoc">The left mouse button.</div><div class="ttdef"><b>Definition</b> <a href="Mouse_8hpp_source.php#l00053">Mouse.hpp:53</a></div></div>
<div class="ttc" id="aclasssf_1_1Mouse_php_ab647159eb88e369a0332a9c5a7ba6687"><div class="ttname"><a href="#ab647159eb88e369a0332a9c5a7ba6687">sf::Mouse::isButtonPressed</a></div><div class="ttdeci">static bool isButtonPressed(Button button)</div><div class="ttdoc">Check if a mouse button is pressed.</div></div>
<div class="ttc" id="aclasssf_1_1Mouse_php_ac368680f797b7f6e4f50b5b7928c1387"><div class="ttname"><a href="#ac368680f797b7f6e4f50b5b7928c1387">sf::Mouse::getPosition</a></div><div class="ttdeci">static Vector2i getPosition()</div><div class="ttdoc">Get the current position of the mouse in desktop coordinates.</div></div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2</a></div><div class="ttdoc">Utility template class for manipulating 2-dimensional vectors.</div><div class="ttdef"><b>Definition</b> <a href="Vector2_8hpp_source.php#l00037">Vector2.hpp:38</a></div></div>
</div><!-- fragment --><dl class="section see"><dt>See also</dt><dd><a class="el" href="classsf_1_1Joystick.php" title="Give access to the real-time state of the joysticks.">sf::Joystick</a>, <a class="el" href="classsf_1_1Keyboard.php" title="Give access to the real-time state of the keyboard.">sf::Keyboard</a>, <a class="el" href="classsf_1_1Touch.php" title="Give access to the real-time state of the touches.">sf::Touch</a> </dd></dl>

<p class="definition">Definition at line <a class="el" href="Mouse_8hpp_source.php#l00043">43</a> of file <a class="el" href="Mouse_8hpp_source.php">Mouse.hpp</a>.</p>
</div><h2 class="groupheader">Member Enumeration Documentation</h2>
<a id="a4fb128be433f9aafe66bc0c605daaa90" name="a4fb128be433f9aafe66bc0c605daaa90"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a4fb128be433f9aafe66bc0c605daaa90">&#9670;&#160;</a></span>Button</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">enum <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90">sf::Mouse::Button</a></td>
        </tr>
      </table>
</div><div class="memdoc">

<p><a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">Mouse</a> buttons. </p>
<table class="fieldtable">
<tr><th colspan="2">Enumerator</th></tr><tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8" name="a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8"></a>Left&#160;</td><td class="fielddoc"><p>The left mouse button. </p>
</td></tr>
<tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90af2cff24ab6c26daf079b11189f982fc4" name="a4fb128be433f9aafe66bc0c605daaa90af2cff24ab6c26daf079b11189f982fc4"></a>Right&#160;</td><td class="fielddoc"><p>The right mouse button. </p>
</td></tr>
<tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90a2c353189c4b11cf216d7caddafcc609d" name="a4fb128be433f9aafe66bc0c605daaa90a2c353189c4b11cf216d7caddafcc609d"></a>Middle&#160;</td><td class="fielddoc"><p>The middle (wheel) mouse button. </p>
</td></tr>
<tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7" name="a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7"></a>XButton1&#160;</td><td class="fielddoc"><p>The first extra mouse button. </p>
</td></tr>
<tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a" name="a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a"></a>XButton2&#160;</td><td class="fielddoc"><p>The second extra mouse button. </p>
</td></tr>
<tr><td class="fieldname"><a id="a4fb128be433f9aafe66bc0c605daaa90a52a1d434289774240ddaa22496762402" name="a4fb128be433f9aafe66bc0c605daaa90a52a1d434289774240ddaa22496762402"></a>ButtonCount&#160;</td><td class="fielddoc"><p>Keep last &ndash; the total number of mouse buttons. </p>
</td></tr>
</table>

<p class="definition">Definition at line <a class="el" href="Mouse_8hpp_source.php#l00051">51</a> of file <a class="el" href="Mouse_8hpp_source.php">Mouse.hpp</a>.</p>

</div>
</div>
<a id="a60dd479a43f26f200e7957aa11803ff4" name="a60dd479a43f26f200e7957aa11803ff4"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a60dd479a43f26f200e7957aa11803ff4">&#9670;&#160;</a></span>Wheel</h2>

<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">enum <a class="el" href="#a60dd479a43f26f200e7957aa11803ff4">sf::Mouse::Wheel</a></td>
        </tr>
      </table>
</div><div class="memdoc">

<p><a class="el" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">Mouse</a> wheels. </p>
<table class="fieldtable">
<tr><th colspan="2">Enumerator</th></tr><tr><td class="fieldname"><a id="a60dd479a43f26f200e7957aa11803ff4abd571de908d2b2c4b9f165f29c678496" name="a60dd479a43f26f200e7957aa11803ff4abd571de908d2b2c4b9f165f29c678496"></a>VerticalWheel&#160;</td><td class="fielddoc"><p>The vertical mouse wheel. </p>
</td></tr>
<tr><td class="fieldname"><a id="a60dd479a43f26f200e7957aa11803ff4a785768d5e33c77de9fdcfdd02219f4e2" name="a60dd479a43f26f200e7957aa11803ff4a785768d5e33c77de9fdcfdd02219f4e2"></a>HorizontalWheel&#160;</td><td class="fielddoc"><p>The horizontal mouse wheel. </p>
</td></tr>
</table>

<p class="definition">Definition at line <a class="el" href="Mouse_8hpp_source.php#l00066">66</a> of file <a class="el" href="Mouse_8hpp_source.php">Mouse.hpp</a>.</p>

</div>
</div>
<h2 class="groupheader">Member Function Documentation</h2>
<a id="ac368680f797b7f6e4f50b5b7928c1387" name="ac368680f797b7f6e4f50b5b7928c1387"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac368680f797b7f6e4f50b5b7928c1387">&#9670;&#160;</a></span>getPosition() <span class="overload">[1/2]</span></h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> sf::Mouse::getPosition </td>
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

<p>Get the current position of the mouse in desktop coordinates. </p>
<p>This function returns the global position of the mouse cursor on the desktop.</p>
<dl class="section return"><dt>Returns</dt><dd>Current position of the mouse </dd></dl>

</div>
</div>
<a id="ac9934f761e377da97993de5aab75006b" name="ac9934f761e377da97993de5aab75006b"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ac9934f761e377da97993de5aab75006b">&#9670;&#160;</a></span>getPosition() <span class="overload">[2/2]</span></h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> sf::Mouse::getPosition </td>
          <td>(</td>
          <td class="paramtype">const <a class="el" href="classsf_1_1WindowBase.php">WindowBase</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>relativeTo</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Get the current position of the mouse in window coordinates. </p>
<p>This function returns the current position of the mouse cursor, relative to the given window.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">relativeTo</td><td>Reference window</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Current position of the mouse </dd></dl>

</div>
</div>
<a id="ab647159eb88e369a0332a9c5a7ba6687" name="ab647159eb88e369a0332a9c5a7ba6687"></a>
<h2 class="memtitle"><span class="permalink"><a href="#ab647159eb88e369a0332a9c5a7ba6687">&#9670;&#160;</a></span>isButtonPressed()</h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static bool sf::Mouse::isButtonPressed </td>
          <td>(</td>
          <td class="paramtype"><a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90">Button</a></td>          <td class="paramname"><span class="paramname"><em>button</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Check if a mouse button is pressed. </p>
<dl class="section warning"><dt>Warning</dt><dd>Checking the state of buttons <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7" title="The first extra mouse button.">Mouse::XButton1</a> and <a class="el" href="#a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a" title="The second extra mouse button.">Mouse::XButton2</a> is not supported on Linux with X11.</dd></dl>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">button</td><td>Button to check</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>True if the button is pressed, false otherwise </dd></dl>

</div>
</div>
<a id="a1222e16c583be9e3d176d86e0b7817d7" name="a1222e16c583be9e3d176d86e0b7817d7"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a1222e16c583be9e3d176d86e0b7817d7">&#9670;&#160;</a></span>setPosition() <span class="overload">[1/2]</span></h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::Mouse::setPosition </td>
          <td>(</td>
          <td class="paramtype">const <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>position</em></span></td><td>)</td>
          <td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Set the current position of the mouse in desktop coordinates. </p>
<p>This function sets the global position of the mouse cursor on the desktop.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">position</td><td>New position of the mouse </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<a id="a698c41e9bce6f30ceb4063c21f869fc5" name="a698c41e9bce6f30ceb4063c21f869fc5"></a>
<h2 class="memtitle"><span class="permalink"><a href="#a698c41e9bce6f30ceb4063c21f869fc5">&#9670;&#160;</a></span>setPosition() <span class="overload">[2/2]</span></h2>

<div class="memitem">
<div class="memproto">
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static void sf::Mouse::setPosition </td>
          <td>(</td>
          <td class="paramtype">const <a class="el" href="classsf_1_1Vector2.php">Vector2i</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>position</em></span>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">const <a class="el" href="classsf_1_1WindowBase.php">WindowBase</a> &amp;</td>          <td class="paramname"><span class="paramname"><em>relativeTo</em></span>&#160;)</td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Set the current position of the mouse in window coordinates. </p>
<p>This function sets the current position of the mouse cursor, relative to the given window.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">position</td><td>New position of the mouse </td></tr>
    <tr><td class="paramname">relativeTo</td><td>Reference window </td></tr>
  </table>
  </dd>
</dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Mouse_8hpp_source.php">Mouse.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
