<?php
    $version = '2.0'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
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
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#pub-methods">Public Member Functions</a> &#124;
<a href="#pub-attribs">Public Attributes</a> &#124;
<a href="structjpeg__source__mgr-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">jpeg_source_mgr Struct Reference</div>  </div>
</div><!--header-->
<div class="contents">
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-methods"></a>
Public Member Functions</h2></td></tr>
<tr class="memitem:af8fda02c19c9dc4e505daabb77c3ad81"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="af8fda02c19c9dc4e505daabb77c3ad81"></a>
&#160;</td><td class="memItemRight" valign="bottom"><b>JMETHOD</b> (void, init_source,(<a class="el" href="structjpeg__decompress__struct.php">j_decompress_ptr</a> cinfo))</td></tr>
<tr class="separator:af8fda02c19c9dc4e505daabb77c3ad81"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab4a579b1f50108e2de73c7c0c1bbb9fd"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="ab4a579b1f50108e2de73c7c0c1bbb9fd"></a>
&#160;</td><td class="memItemRight" valign="bottom"><b>JMETHOD</b> (boolean, fill_input_buffer,(<a class="el" href="structjpeg__decompress__struct.php">j_decompress_ptr</a> cinfo))</td></tr>
<tr class="separator:ab4a579b1f50108e2de73c7c0c1bbb9fd"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a3e29df8ddadb0c15e54b69b5a7a10305"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a3e29df8ddadb0c15e54b69b5a7a10305"></a>
&#160;</td><td class="memItemRight" valign="bottom"><b>JMETHOD</b> (void, skip_input_data,(<a class="el" href="structjpeg__decompress__struct.php">j_decompress_ptr</a> cinfo, long num_bytes))</td></tr>
<tr class="separator:a3e29df8ddadb0c15e54b69b5a7a10305"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a60a35ccd1fb8d954f34c0cdbf29ac010"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a60a35ccd1fb8d954f34c0cdbf29ac010"></a>
&#160;</td><td class="memItemRight" valign="bottom"><b>JMETHOD</b> (boolean, resync_to_restart,(<a class="el" href="structjpeg__decompress__struct.php">j_decompress_ptr</a> cinfo, int desired))</td></tr>
<tr class="separator:a60a35ccd1fb8d954f34c0cdbf29ac010"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6c0683ce1166b9ee659b2d3aa1efb1c2"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a6c0683ce1166b9ee659b2d3aa1efb1c2"></a>
&#160;</td><td class="memItemRight" valign="bottom"><b>JMETHOD</b> (void, term_source,(<a class="el" href="structjpeg__decompress__struct.php">j_decompress_ptr</a> cinfo))</td></tr>
<tr class="separator:a6c0683ce1166b9ee659b2d3aa1efb1c2"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table><table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-attribs"></a>
Public Attributes</h2></td></tr>
<tr class="memitem:aad884e7f4ba7496ab0f56c942c7585c1"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="aad884e7f4ba7496ab0f56c942c7585c1"></a>
const JOCTET *&#160;</td><td class="memItemRight" valign="bottom"><b>next_input_byte</b></td></tr>
<tr class="separator:aad884e7f4ba7496ab0f56c942c7585c1"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a8ecb72557c1c9666d77fffea074282a4"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a8ecb72557c1c9666d77fffea074282a4"></a>
size_t&#160;</td><td class="memItemRight" valign="bottom"><b>bytes_in_buffer</b></td></tr>
<tr class="separator:a8ecb72557c1c9666d77fffea074282a4"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock">
<p>Definition at line <a class="el" href="jpeglib_8h_source.php#l00764">764</a> of file <a class="el" href="jpeglib_8h_source.php">jpeglib.h</a>.</p>
</div><hr/>The documentation for this struct was generated from the following file:<ul>
<li><a class="el" href="jpeglib_8h_source.php">jpeglib.h</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
