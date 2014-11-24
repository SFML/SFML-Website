<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Event Class Reference'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Event.php">Event</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#nested-classes">Classes</a> &#124;
<a href="#pub-types">Public Types</a> &#124;
<a href="#pub-attribs">Public Attributes</a> &#124;
<a href="classsf_1_1Event-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">sf::Event Class Reference</div>  </div>
</div><!--header-->
<div class="contents">

<p><a class="el" href="classsf_1_1Event.php" title="Event defines a system event and its parameters.">Event</a> defines a system event and its parameters.  
 <a href="classsf_1_1Event.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Event_8hpp_source.php">Event.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="nested-classes"></a>
Classes</h2></td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1JoyButtonEvent.php">JoyButtonEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">Joystick buttons events parameters.  <a href="structsf_1_1Event_1_1JoyButtonEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1JoyMoveEvent.php">JoyMoveEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">Joystick axis move event parameters.  <a href="structsf_1_1Event_1_1JoyMoveEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1KeyEvent.php">KeyEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">Keyboard event parameters.  <a href="structsf_1_1Event_1_1KeyEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1MouseButtonEvent.php">MouseButtonEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight"><a class="el" href="namespacesf_1_1Mouse.php" title="Definition of button codes for mouse events.">Mouse</a> buttons events parameters.  <a href="structsf_1_1Event_1_1MouseButtonEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1MouseMoveEvent.php">MouseMoveEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight"><a class="el" href="namespacesf_1_1Mouse.php" title="Definition of button codes for mouse events.">Mouse</a> move event parameters.  <a href="structsf_1_1Event_1_1MouseMoveEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1MouseWheelEvent.php">MouseWheelEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight"><a class="el" href="namespacesf_1_1Mouse.php" title="Definition of button codes for mouse events.">Mouse</a> wheel events parameters.  <a href="structsf_1_1Event_1_1MouseWheelEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1SizeEvent.php">SizeEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">Size events parameters.  <a href="structsf_1_1Event_1_1SizeEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:"><td class="memItemLeft" align="right" valign="top">struct &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="structsf_1_1Event_1_1TextEvent.php">TextEvent</a></td></tr>
<tr class="memdesc:"><td class="mdescLeft">&#160;</td><td class="mdescRight">Text event parameters.  <a href="structsf_1_1Event_1_1TextEvent.php#details">More...</a><br/></td></tr>
<tr class="separator:"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-types"></a>
Public Types</h2></td></tr>
<tr class="memitem:af41fa9ed45c02449030699f671331d4a"><td class="memItemLeft" align="right" valign="top">enum &#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Event.php#af41fa9ed45c02449030699f671331d4a">EventType</a> { <br/>
&#160;&#160;<b>Closed</b>, 
<br/>
&#160;&#160;<b>Resized</b>, 
<br/>
&#160;&#160;<b>LostFocus</b>, 
<br/>
&#160;&#160;<b>GainedFocus</b>, 
<br/>
&#160;&#160;<b>TextEntered</b>, 
<br/>
&#160;&#160;<b>KeyPressed</b>, 
<br/>
&#160;&#160;<b>KeyReleased</b>, 
<br/>
&#160;&#160;<b>MouseWheelMoved</b>, 
<br/>
&#160;&#160;<b>MouseButtonPressed</b>, 
<br/>
&#160;&#160;<b>MouseButtonReleased</b>, 
<br/>
&#160;&#160;<b>MouseMoved</b>, 
<br/>
&#160;&#160;<b>MouseEntered</b>, 
<br/>
&#160;&#160;<b>MouseLeft</b>, 
<br/>
&#160;&#160;<b>JoyButtonPressed</b>, 
<br/>
&#160;&#160;<b>JoyButtonReleased</b>, 
<br/>
&#160;&#160;<b>JoyMoved</b>, 
<br/>
&#160;&#160;<b>Count</b>
<br/>
 }</td></tr>
<tr class="memdesc:af41fa9ed45c02449030699f671331d4a"><td class="mdescLeft">&#160;</td><td class="mdescRight">Enumeration of the different types of events.  <a href="classsf_1_1Event.php#af41fa9ed45c02449030699f671331d4a">More...</a><br/></td></tr>
<tr class="separator:af41fa9ed45c02449030699f671331d4a"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-attribs"></a>
Public Attributes</h2></td></tr>
<tr class="memitem:a90d5da29dd2f49d13dc10e7a402c0b65"><td class="memItemLeft" align="right" valign="top"><a class="el" href="classsf_1_1Event.php#af41fa9ed45c02449030699f671331d4a">EventType</a>&#160;</td><td class="memItemRight" valign="bottom"><a class="el" href="classsf_1_1Event.php#a90d5da29dd2f49d13dc10e7a402c0b65">Type</a></td></tr>
<tr class="memdesc:a90d5da29dd2f49d13dc10e7a402c0b65"><td class="mdescLeft">&#160;</td><td class="mdescRight">Type of the event.  <a href="#a90d5da29dd2f49d13dc10e7a402c0b65"></a><br/></td></tr>
<tr class="separator:a90d5da29dd2f49d13dc10e7a402c0b65"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac85e6edc63848641f444ddb19c39ac82"><td class="memItemLeft" ><a class="anchor" id="ac85e6edc63848641f444ddb19c39ac82"></a>
union {</td></tr>
<tr class="memitem:a88a1451153176fdbe4c9c23a5d1734b5"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1KeyEvent.php">KeyEvent</a>&#160;&#160;&#160;<b>Key</b></td></tr>
<tr class="separator:a88a1451153176fdbe4c9c23a5d1734b5"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:aecfcd582a70261fcf5f68512a0bd8a62"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1TextEvent.php">TextEvent</a>&#160;&#160;&#160;<b>Text</b></td></tr>
<tr class="separator:aecfcd582a70261fcf5f68512a0bd8a62"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a2ec4399d7c8f8d75aef0705b4d76a122"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1MouseMoveEvent.php">MouseMoveEvent</a>&#160;&#160;&#160;<b>MouseMove</b></td></tr>
<tr class="separator:a2ec4399d7c8f8d75aef0705b4d76a122"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a95f18831d8c2304fac2a82c1eced065f"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1MouseButtonEvent.php">MouseButtonEvent</a>&#160;&#160;&#160;<b>MouseButton</b></td></tr>
<tr class="separator:a95f18831d8c2304fac2a82c1eced065f"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a5108f7e3d1066168014ae3343c4852bb"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1MouseWheelEvent.php">MouseWheelEvent</a>&#160;&#160;&#160;<b>MouseWheel</b></td></tr>
<tr class="separator:a5108f7e3d1066168014ae3343c4852bb"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0a35d47440c5055fd534d0a7c1f91916"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1JoyMoveEvent.php">JoyMoveEvent</a>&#160;&#160;&#160;<b>JoyMove</b></td></tr>
<tr class="separator:a0a35d47440c5055fd534d0a7c1f91916"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a34ff8968b9493862dcf74d6c83381141"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1JoyButtonEvent.php">JoyButtonEvent</a>&#160;&#160;&#160;<b>JoyButton</b></td></tr>
<tr class="separator:a34ff8968b9493862dcf74d6c83381141"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a64a86be3bafb9e0dada8a1c7914aa490"><td class="memItemLeft" >&#160;&#160;&#160;<a class="el" href="structsf_1_1Event_1_1SizeEvent.php">SizeEvent</a>&#160;&#160;&#160;<b>Size</b></td></tr>
<tr class="separator:a64a86be3bafb9e0dada8a1c7914aa490"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac85e6edc63848641f444ddb19c39ac82"><td class="memItemLeft" valign="top">};&#160;</td><td class="memItemRight" valign="bottom"></td></tr>
<tr class="separator:ac85e6edc63848641f444ddb19c39ac82"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><p><a class="el" href="classsf_1_1Event.php" title="Event defines a system event and its parameters.">Event</a> defines a system event and its parameters. </p>

<p>Definition at line <a class="el" href="Event_8hpp_source.php#l00197">197</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>
</div><h2 class="groupheader">Member Enumeration Documentation</h2>
<a class="anchor" id="af41fa9ed45c02449030699f671331d4a"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname">enum <a class="el" href="classsf_1_1Event.php#af41fa9ed45c02449030699f671331d4a">sf::Event::EventType</a></td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Enumeration of the different types of events. </p>

<p>Definition at line <a class="el" href="Event_8hpp_source.php#l00278">278</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>

</div>
</div>
<h2 class="groupheader">Member Data Documentation</h2>
<a class="anchor" id="a90d5da29dd2f49d13dc10e7a402c0b65"></a>
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname"><a class="el" href="classsf_1_1Event.php#af41fa9ed45c02449030699f671331d4a">EventType</a> sf::Event::Type</td>
        </tr>
      </table>
</div><div class="memdoc">

<p>Type of the event. </p>

<p>Definition at line <a class="el" href="Event_8hpp_source.php#l00303">303</a> of file <a class="el" href="Event_8hpp_source.php">Event.hpp</a>.</p>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Event_8hpp_source.php">Event.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
