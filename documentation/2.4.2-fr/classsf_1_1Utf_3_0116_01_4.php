<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'sf::Utf&lt; 16 &gt; Class Template Reference'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php">Utf&lt; 16 &gt;</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="summary">
<a href="#pub-static-methods">Static Public Member Functions</a> &#124;
<a href="classsf_1_1Utf_3_0116_01_4-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">sf::Utf&lt; 16 &gt; Class Template Reference</div>  </div>
</div><!--header-->
<div class="contents">

<p>Specialization of the <a class="el" href="classsf_1_1Utf.php" title="Utility class providing generic functions for UTF conversions. ">Utf</a> template for UTF-16.  
 <a href="classsf_1_1Utf_3_0116_01_4.php#details">More...</a></p>

<p><code>#include &lt;<a class="el" href="Utf_8hpp_source.php">Utf.hpp</a>&gt;</code></p>
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-static-methods"></a>
Static Public Member Functions</h2></td></tr>
<tr class="memitem:a17be6fc08e51182e7ac8bf9269dfae37"><td class="memTemplParams" colspan="2">template&lt;typename In &gt; </td></tr>
<tr class="memitem:a17be6fc08e51182e7ac8bf9269dfae37"><td class="memTemplItemLeft" align="right" valign="top">static In&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a17be6fc08e51182e7ac8bf9269dfae37">decode</a> (In begin, In end, Uint32 &amp;output, Uint32 replacement=0)</td></tr>
<tr class="memdesc:a17be6fc08e51182e7ac8bf9269dfae37"><td class="mdescLeft">&#160;</td><td class="mdescRight">Decode a single UTF-16 character.  <a href="#a17be6fc08e51182e7ac8bf9269dfae37">More...</a><br /></td></tr>
<tr class="separator:a17be6fc08e51182e7ac8bf9269dfae37"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a516090c84ceec2cfde0a13b6148363bb"><td class="memTemplParams" colspan="2">template&lt;typename Out &gt; </td></tr>
<tr class="memitem:a516090c84ceec2cfde0a13b6148363bb"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a516090c84ceec2cfde0a13b6148363bb">encode</a> (Uint32 input, Out output, Uint16 replacement=0)</td></tr>
<tr class="memdesc:a516090c84ceec2cfde0a13b6148363bb"><td class="mdescLeft">&#160;</td><td class="mdescRight">Encode a single UTF-16 character.  <a href="#a516090c84ceec2cfde0a13b6148363bb">More...</a><br /></td></tr>
<tr class="separator:a516090c84ceec2cfde0a13b6148363bb"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab899108d77ce088eb001588e84d91525"><td class="memTemplParams" colspan="2">template&lt;typename In &gt; </td></tr>
<tr class="memitem:ab899108d77ce088eb001588e84d91525"><td class="memTemplItemLeft" align="right" valign="top">static In&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#ab899108d77ce088eb001588e84d91525">next</a> (In begin, In end)</td></tr>
<tr class="memdesc:ab899108d77ce088eb001588e84d91525"><td class="mdescLeft">&#160;</td><td class="mdescRight">Advance to the next UTF-16 character.  <a href="#ab899108d77ce088eb001588e84d91525">More...</a><br /></td></tr>
<tr class="separator:ab899108d77ce088eb001588e84d91525"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6df8d9be8211ffe1095b3b82eac83f6f"><td class="memTemplParams" colspan="2">template&lt;typename In &gt; </td></tr>
<tr class="memitem:a6df8d9be8211ffe1095b3b82eac83f6f"><td class="memTemplItemLeft" align="right" valign="top">static std::size_t&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a6df8d9be8211ffe1095b3b82eac83f6f">count</a> (In begin, In end)</td></tr>
<tr class="memdesc:a6df8d9be8211ffe1095b3b82eac83f6f"><td class="mdescLeft">&#160;</td><td class="mdescRight">Count the number of characters of a UTF-16 sequence.  <a href="#a6df8d9be8211ffe1095b3b82eac83f6f">More...</a><br /></td></tr>
<tr class="separator:a6df8d9be8211ffe1095b3b82eac83f6f"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a8a595dc1ea57ecf7aad944964913f0ff"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a8a595dc1ea57ecf7aad944964913f0ff"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a8a595dc1ea57ecf7aad944964913f0ff">fromAnsi</a> (In begin, In end, Out output, const std::locale &amp;locale=std::locale())</td></tr>
<tr class="memdesc:a8a595dc1ea57ecf7aad944964913f0ff"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert an ANSI characters range to UTF-16.  <a href="#a8a595dc1ea57ecf7aad944964913f0ff">More...</a><br /></td></tr>
<tr class="separator:a8a595dc1ea57ecf7aad944964913f0ff"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a263423929b6f8e4d3ad09b45ac5cb0a1"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a263423929b6f8e4d3ad09b45ac5cb0a1"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a263423929b6f8e4d3ad09b45ac5cb0a1">fromWide</a> (In begin, In end, Out output)</td></tr>
<tr class="memdesc:a263423929b6f8e4d3ad09b45ac5cb0a1"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert a wide characters range to UTF-16.  <a href="#a263423929b6f8e4d3ad09b45ac5cb0a1">More...</a><br /></td></tr>
<tr class="separator:a263423929b6f8e4d3ad09b45ac5cb0a1"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a52293df75893733fe6cf84b8a017cbf7"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a52293df75893733fe6cf84b8a017cbf7"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a52293df75893733fe6cf84b8a017cbf7">fromLatin1</a> (In begin, In end, Out output)</td></tr>
<tr class="memdesc:a52293df75893733fe6cf84b8a017cbf7"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert a latin-1 (ISO-5589-1) characters range to UTF-16.  <a href="#a52293df75893733fe6cf84b8a017cbf7">More...</a><br /></td></tr>
<tr class="separator:a52293df75893733fe6cf84b8a017cbf7"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6d2bfbdfe46364bd49bca28a410b18f7"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a6d2bfbdfe46364bd49bca28a410b18f7"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a6d2bfbdfe46364bd49bca28a410b18f7">toAnsi</a> (In begin, In end, Out output, char replacement=0, const std::locale &amp;locale=std::locale())</td></tr>
<tr class="memdesc:a6d2bfbdfe46364bd49bca28a410b18f7"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert an UTF-16 characters range to ANSI characters.  <a href="#a6d2bfbdfe46364bd49bca28a410b18f7">More...</a><br /></td></tr>
<tr class="separator:a6d2bfbdfe46364bd49bca28a410b18f7"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a42bace5988f7f20497cfdd6025c2d7f2"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a42bace5988f7f20497cfdd6025c2d7f2"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a42bace5988f7f20497cfdd6025c2d7f2">toWide</a> (In begin, In end, Out output, wchar_t replacement=0)</td></tr>
<tr class="memdesc:a42bace5988f7f20497cfdd6025c2d7f2"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert an UTF-16 characters range to wide characters.  <a href="#a42bace5988f7f20497cfdd6025c2d7f2">More...</a><br /></td></tr>
<tr class="separator:a42bace5988f7f20497cfdd6025c2d7f2"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ad0cc57ebf48fac584f4d5f3d30a20010"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:ad0cc57ebf48fac584f4d5f3d30a20010"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#ad0cc57ebf48fac584f4d5f3d30a20010">toLatin1</a> (In begin, In end, Out output, char replacement=0)</td></tr>
<tr class="memdesc:ad0cc57ebf48fac584f4d5f3d30a20010"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert an UTF-16 characters range to latin-1 (ISO-5589-1) characters.  <a href="#ad0cc57ebf48fac584f4d5f3d30a20010">More...</a><br /></td></tr>
<tr class="separator:ad0cc57ebf48fac584f4d5f3d30a20010"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:afdd2f31536ce3fba4dfb632dfdd6e4b7"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:afdd2f31536ce3fba4dfb632dfdd6e4b7"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#afdd2f31536ce3fba4dfb632dfdd6e4b7">toUtf8</a> (In begin, In end, Out output)</td></tr>
<tr class="memdesc:afdd2f31536ce3fba4dfb632dfdd6e4b7"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert a UTF-16 characters range to UTF-8.  <a href="#afdd2f31536ce3fba4dfb632dfdd6e4b7">More...</a><br /></td></tr>
<tr class="separator:afdd2f31536ce3fba4dfb632dfdd6e4b7"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0c9744c8f142360a8afebb24da134b34"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a0c9744c8f142360a8afebb24da134b34"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a0c9744c8f142360a8afebb24da134b34">toUtf16</a> (In begin, In end, Out output)</td></tr>
<tr class="memdesc:a0c9744c8f142360a8afebb24da134b34"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert a UTF-16 characters range to UTF-16.  <a href="#a0c9744c8f142360a8afebb24da134b34">More...</a><br /></td></tr>
<tr class="separator:a0c9744c8f142360a8afebb24da134b34"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a781174f776a3effb96c1ccd9a4513ab1"><td class="memTemplParams" colspan="2">template&lt;typename In , typename Out &gt; </td></tr>
<tr class="memitem:a781174f776a3effb96c1ccd9a4513ab1"><td class="memTemplItemLeft" align="right" valign="top">static Out&#160;</td><td class="memTemplItemRight" valign="bottom"><a class="el" href="classsf_1_1Utf_3_0116_01_4.php#a781174f776a3effb96c1ccd9a4513ab1">toUtf32</a> (In begin, In end, Out output)</td></tr>
<tr class="memdesc:a781174f776a3effb96c1ccd9a4513ab1"><td class="mdescLeft">&#160;</td><td class="mdescRight">Convert a UTF-16 characters range to UTF-32.  <a href="#a781174f776a3effb96c1ccd9a4513ab1">More...</a><br /></td></tr>
<tr class="separator:a781174f776a3effb96c1ccd9a4513ab1"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock"><h3>template&lt;&gt;<br />
class sf::Utf&lt; 16 &gt;</h3>

<p>Specialization of the <a class="el" href="classsf_1_1Utf.php" title="Utility class providing generic functions for UTF conversions. ">Utf</a> template for UTF-16. </p>

<p>Definition at line <a class="el" href="Utf_8hpp_source.php#l00255">255</a> of file <a class="el" href="Utf_8hpp_source.php">Utf.hpp</a>.</p>
</div><h2 class="groupheader">Member Function Documentation</h2>
<a class="anchor" id="a6df8d9be8211ffe1095b3b82eac83f6f"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static std::size_t <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::count </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Count the number of characters of a UTF-16 sequence. </p>
<p>This function is necessary for multi-elements encodings, as a single character may use more than 1 storage element, thus the total size can be different from (begin - end).</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator pointing to one past the last read element of the input sequence </dd></dl>

</div>
</div>
<a class="anchor" id="a17be6fc08e51182e7ac8bf9269dfae37"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static In <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::decode </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Uint32 &amp;&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Uint32&#160;</td>
          <td class="paramname"><em>replacement</em> = <code>0</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Decode a single UTF-16 character. </p>
<p>Decoding a character means finding its unique 32-bits code (called the codepoint) in the Unicode standard.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Codepoint of the decoded UTF-16 character </td></tr>
    <tr><td class="paramname">replacement</td><td>Replacement character to use in case the UTF-8 sequence is invalid</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator pointing to one past the last read element of the input sequence </dd></dl>

</div>
</div>
<a class="anchor" id="a516090c84ceec2cfde0a13b6148363bb"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::encode </td>
          <td>(</td>
          <td class="paramtype">Uint32&#160;</td>
          <td class="paramname"><em>input</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Uint16&#160;</td>
          <td class="paramname"><em>replacement</em> = <code>0</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Encode a single UTF-16 character. </p>
<p>Encoding a character means converting a unique 32-bits code (called the codepoint) in the target encoding, UTF-16.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">input</td><td>Codepoint to encode as UTF-16 </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence </td></tr>
    <tr><td class="paramname">replacement</td><td>Replacement for characters not convertible to UTF-16 (use 0 to skip them)</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a8a595dc1ea57ecf7aad944964913f0ff"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::fromAnsi </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">const std::locale &amp;&#160;</td>
          <td class="paramname"><em>locale</em> = <code>std::locale()</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert an ANSI characters range to UTF-16. </p>
<p>The current global locale will be used by default, unless you pass a custom one in the <em>locale</em> parameter.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence </td></tr>
    <tr><td class="paramname">locale</td><td>Locale to use for conversion</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a52293df75893733fe6cf84b8a017cbf7"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::fromLatin1 </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert a latin-1 (ISO-5589-1) characters range to UTF-16. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a263423929b6f8e4d3ad09b45ac5cb0a1"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::fromWide </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert a wide characters range to UTF-16. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="ab899108d77ce088eb001588e84d91525"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static In <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::next </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Advance to the next UTF-16 character. </p>
<p>This function is necessary for multi-elements encodings, as a single character may use more than 1 storage element.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator pointing to one past the last read element of the input sequence </dd></dl>

</div>
</div>
<a class="anchor" id="a6d2bfbdfe46364bd49bca28a410b18f7"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toAnsi </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">char&#160;</td>
          <td class="paramname"><em>replacement</em> = <code>0</code>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">const std::locale &amp;&#160;</td>
          <td class="paramname"><em>locale</em> = <code>std::locale()</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert an UTF-16 characters range to ANSI characters. </p>
<p>The current global locale will be used by default, unless you pass a custom one in the <em>locale</em> parameter.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence </td></tr>
    <tr><td class="paramname">replacement</td><td>Replacement for characters not convertible to ANSI (use 0 to skip them) </td></tr>
    <tr><td class="paramname">locale</td><td>Locale to use for conversion</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="ad0cc57ebf48fac584f4d5f3d30a20010"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toLatin1 </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">char&#160;</td>
          <td class="paramname"><em>replacement</em> = <code>0</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert an UTF-16 characters range to latin-1 (ISO-5589-1) characters. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence </td></tr>
    <tr><td class="paramname">replacement</td><td>Replacement for characters not convertible to wide (use 0 to skip them)</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a0c9744c8f142360a8afebb24da134b34"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toUtf16 </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert a UTF-16 characters range to UTF-16. </p>
<p>This functions does nothing more than a direct copy; it is defined only to provide the same interface as other specializations of the sf::Utf&lt;&gt; template, and allow generic code to be written on top of it.</p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a781174f776a3effb96c1ccd9a4513ab1"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toUtf32 </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert a UTF-16 characters range to UTF-32. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="afdd2f31536ce3fba4dfb632dfdd6e4b7"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toUtf8 </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert a UTF-16 characters range to UTF-8. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<a class="anchor" id="a42bace5988f7f20497cfdd6025c2d7f2"></a>
<div class="memitem">
<div class="memproto">
<div class="memtemplate">
template&lt;typename In , typename Out &gt; </div>
<table class="mlabels">
  <tr>
  <td class="mlabels-left">
      <table class="memname">
        <tr>
          <td class="memname">static Out <a class="el" href="classsf_1_1Utf.php">sf::Utf</a>&lt; 16 &gt;::toWide </td>
          <td>(</td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>begin</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">In&#160;</td>
          <td class="paramname"><em>end</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">Out&#160;</td>
          <td class="paramname"><em>output</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">wchar_t&#160;</td>
          <td class="paramname"><em>replacement</em> = <code>0</code>&#160;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td>
        </tr>
      </table>
  </td>
  <td class="mlabels-right">
<span class="mlabels"><span class="mlabel">static</span></span>  </td>
  </tr>
</table>
</div><div class="memdoc">

<p>Convert an UTF-16 characters range to wide characters. </p>
<dl class="params"><dt>Parameters</dt><dd>
  <table class="params">
    <tr><td class="paramname">begin</td><td>Iterator pointing to the beginning of the input sequence </td></tr>
    <tr><td class="paramname">end</td><td>Iterator pointing to the end of the input sequence </td></tr>
    <tr><td class="paramname">output</td><td>Iterator pointing to the beginning of the output sequence </td></tr>
    <tr><td class="paramname">replacement</td><td>Replacement for characters not convertible to wide (use 0 to skip them)</td></tr>
  </table>
  </dd>
</dl>
<dl class="section return"><dt>Returns</dt><dd>Iterator to the end of the output sequence which has been written </dd></dl>

</div>
</div>
<hr/>The documentation for this class was generated from the following file:<ul>
<li><a class="el" href="Utf_8hpp_source.php">Utf.hpp</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
