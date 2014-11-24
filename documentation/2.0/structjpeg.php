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
<a href="#pub-attribs">Public Attributes</a> &#124;
<a href="structjpeg-members.php">List of all members</a>  </div>
  <div class="headertitle">
<div class="title">jpeg Struct Reference</div>  </div>
</div><!--header-->
<div class="contents">
<table class="memberdecls">
<tr class="heading"><td colspan="2"><h2 class="groupheader"><a name="pub-attribs"></a>
Public Attributes</h2></td></tr>
<tr class="memitem:aa1dac6b3ea069114abf0b4021aa3a67e"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="aa1dac6b3ea069114abf0b4021aa3a67e"></a>
<a class="el" href="structstbi.php">stbi</a> *&#160;</td><td class="memItemRight" valign="bottom"><b>s</b></td></tr>
<tr class="separator:aa1dac6b3ea069114abf0b4021aa3a67e"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:aae44f91bafcc73fa70544573458abe33"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="aae44f91bafcc73fa70544573458abe33"></a>
<a class="el" href="structhuffman.php">huffman</a>&#160;</td><td class="memItemRight" valign="bottom"><b>huff_dc</b> [4]</td></tr>
<tr class="separator:aae44f91bafcc73fa70544573458abe33"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6fab0b2d90425db5d609edbde8bddd92"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a6fab0b2d90425db5d609edbde8bddd92"></a>
<a class="el" href="structhuffman.php">huffman</a>&#160;</td><td class="memItemRight" valign="bottom"><b>huff_ac</b> [4]</td></tr>
<tr class="separator:a6fab0b2d90425db5d609edbde8bddd92"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:aae820981dde2c49bc05b6e1298143d21"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="aae820981dde2c49bc05b6e1298143d21"></a>
uint8&#160;</td><td class="memItemRight" valign="bottom"><b>dequant</b> [4][64]</td></tr>
<tr class="separator:aae820981dde2c49bc05b6e1298143d21"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:af4ed1173241e83f1482a276a178ce9e5"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="af4ed1173241e83f1482a276a178ce9e5"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_h_max</b></td></tr>
<tr class="separator:af4ed1173241e83f1482a276a178ce9e5"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a50690c7d415968f864f4f1c10b85082d"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a50690c7d415968f864f4f1c10b85082d"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_v_max</b></td></tr>
<tr class="separator:a50690c7d415968f864f4f1c10b85082d"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a8a7f2486617a69e9b88c9a161560c8a5"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a8a7f2486617a69e9b88c9a161560c8a5"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_mcu_x</b></td></tr>
<tr class="separator:a8a7f2486617a69e9b88c9a161560c8a5"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:afa9d2c991eff0959c0c8b65ab186243b"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="afa9d2c991eff0959c0c8b65ab186243b"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_mcu_y</b></td></tr>
<tr class="separator:afa9d2c991eff0959c0c8b65ab186243b"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a32f06fea63ec2c976092760b21abad72"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a32f06fea63ec2c976092760b21abad72"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_mcu_w</b></td></tr>
<tr class="separator:a32f06fea63ec2c976092760b21abad72"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6e013436253bcf1e5808a1774b96cc38"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a6e013436253bcf1e5808a1774b96cc38"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>img_mcu_h</b></td></tr>
<tr class="separator:a6e013436253bcf1e5808a1774b96cc38"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab0cb08dfdb09195810ddb87ea43c519a"><td class="memItemLeft" ><a class="anchor" id="ab0cb08dfdb09195810ddb87ea43c519a"></a>
struct {</td></tr>
<tr class="memitem:ae549f1c7cc8fdc2c5c0b3cd2ef335800"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>id</b></td></tr>
<tr class="separator:ae549f1c7cc8fdc2c5c0b3cd2ef335800"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a18e4e9048ee22e0ef555944762c6dc7c"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>h</b></td></tr>
<tr class="separator:a18e4e9048ee22e0ef555944762c6dc7c"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a4fcae70b851c65c629879418bc2386fe"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>v</b></td></tr>
<tr class="separator:a4fcae70b851c65c629879418bc2386fe"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac167f1033b3a7ee8939c818dd88cd0ec"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>tq</b></td></tr>
<tr class="separator:ac167f1033b3a7ee8939c818dd88cd0ec"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ad5a96a89a5de9015748a62cf7f5c6efd"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>hd</b></td></tr>
<tr class="separator:ad5a96a89a5de9015748a62cf7f5c6efd"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a7cc1f74c3f3e9ed4e8a71aa691e30ec0"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>ha</b></td></tr>
<tr class="separator:a7cc1f74c3f3e9ed4e8a71aa691e30ec0"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab7fc729e963c07a84be94c02e6fb45cf"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>dc_pred</b></td></tr>
<tr class="separator:ab7fc729e963c07a84be94c02e6fb45cf"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a668b509069685728e8b76a111719c013"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>x</b></td></tr>
<tr class="separator:a668b509069685728e8b76a111719c013"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a3f67c96f484c3b12370e688e99a9dc1f"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>y</b></td></tr>
<tr class="separator:a3f67c96f484c3b12370e688e99a9dc1f"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a597b9458094092c0a4687cf3decd13c4"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>w2</b></td></tr>
<tr class="separator:a597b9458094092c0a4687cf3decd13c4"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6e60a4ce5e6d753772491bf0f3a308fe"><td class="memItemLeft" >&#160;&#160;&#160;int&#160;&#160;&#160;<b>h2</b></td></tr>
<tr class="separator:a6e60a4ce5e6d753772491bf0f3a308fe"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a0b77d7d4e997de66b97a16217e157205"><td class="memItemLeft" >&#160;&#160;&#160;uint8 *&#160;&#160;&#160;<b>data</b></td></tr>
<tr class="separator:a0b77d7d4e997de66b97a16217e157205"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:acb866b85e8e0d415f6ddbd101f5bbb00"><td class="memItemLeft" >&#160;&#160;&#160;void *&#160;&#160;&#160;<b>raw_data</b></td></tr>
<tr class="separator:acb866b85e8e0d415f6ddbd101f5bbb00"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a5a4248f45ca688bcc73dbac8c082576c"><td class="memItemLeft" >&#160;&#160;&#160;uint8 *&#160;&#160;&#160;<b>linebuf</b></td></tr>
<tr class="separator:a5a4248f45ca688bcc73dbac8c082576c"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab0cb08dfdb09195810ddb87ea43c519a"><td class="memItemLeft" valign="top">}&#160;</td><td class="memItemRight" valign="bottom"><b>img_comp</b> [4]</td></tr>
<tr class="separator:ab0cb08dfdb09195810ddb87ea43c519a"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:abfc7f6a333ba3517e669e3e58113bbca"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="abfc7f6a333ba3517e669e3e58113bbca"></a>
uint32&#160;</td><td class="memItemRight" valign="bottom"><b>code_buffer</b></td></tr>
<tr class="separator:abfc7f6a333ba3517e669e3e58113bbca"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6d1b20b5d9d253006fde4e4dd8ab8c04"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a6d1b20b5d9d253006fde4e4dd8ab8c04"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>code_bits</b></td></tr>
<tr class="separator:a6d1b20b5d9d253006fde4e4dd8ab8c04"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a9a5cd40790fd432795fb19477c921f8c"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a9a5cd40790fd432795fb19477c921f8c"></a>
unsigned char&#160;</td><td class="memItemRight" valign="bottom"><b>marker</b></td></tr>
<tr class="separator:a9a5cd40790fd432795fb19477c921f8c"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a2d114f4d52f50d8d85f43b2a3f161cec"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a2d114f4d52f50d8d85f43b2a3f161cec"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>nomore</b></td></tr>
<tr class="separator:a2d114f4d52f50d8d85f43b2a3f161cec"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:adca2f04da72e50086c77c7070731a679"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="adca2f04da72e50086c77c7070731a679"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>scan_n</b></td></tr>
<tr class="separator:adca2f04da72e50086c77c7070731a679"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ac0f5240fc472e75239328f51a50f45b6"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="ac0f5240fc472e75239328f51a50f45b6"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>order</b> [4]</td></tr>
<tr class="separator:ac0f5240fc472e75239328f51a50f45b6"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:ab13af34259b1f1c6cf8f35411a77e39e"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="ab13af34259b1f1c6cf8f35411a77e39e"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>restart_interval</b></td></tr>
<tr class="separator:ab13af34259b1f1c6cf8f35411a77e39e"><td class="memSeparator" colspan="2">&#160;</td></tr>
<tr class="memitem:a6b4a8a352872847d84ea5ef1a4bc245e"><td class="memItemLeft" align="right" valign="top"><a class="anchor" id="a6b4a8a352872847d84ea5ef1a4bc245e"></a>
int&#160;</td><td class="memItemRight" valign="bottom"><b>todo</b></td></tr>
<tr class="separator:a6b4a8a352872847d84ea5ef1a4bc245e"><td class="memSeparator" colspan="2">&#160;</td></tr>
</table>
<a name="details" id="details"></a><h2 class="groupheader">Detailed Description</h2>
<div class="textblock">
<p>Definition at line <a class="el" href="stb__image_8h_source.php#l00964">964</a> of file <a class="el" href="stb__image_8h_source.php">stb_image.h</a>.</p>
</div><hr/>The documentation for this struct was generated from the following file:<ul>
<li><a class="el" href="stb__image_8h_source.php">stb_image.h</a></li>
</ul>
</div><!-- contents -->
<?php
    require("../footer.php");
?>
