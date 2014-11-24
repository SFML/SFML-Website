<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'WindowSettings.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
      <li><a href="annotated.php"><span>Classes</span></a></li>
      <li class="current"><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="files.php"><span>File&#160;List</span></a></li>
    </ul>
  </div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><a class="el" href="dir_83ae1a5e8455fc62607b4936b42116e9.php">sfml</a></li><li class="navelem"><a class="el" href="dir_79a044fa5ec8bbf4af7d440d8995a178.php">sfml</a></li><li class="navelem"><a class="el" href="dir_f3190241575fd2bd132a392ae6942f4a.php">include</a></li><li class="navelem"><a class="el" href="dir_692f376662c82a26cfe4cfa3aceebe24.php">SFML</a></li><li class="navelem"><a class="el" href="dir_91aff02cfffdbbdd31d48df547831556.php">Window</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">WindowSettings.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;</div>
<div class="line"><a name="l00002"></a><span class="lineno">    2</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2009 Laurent Gomila (laurent.gom@gmail.com)</span></div>
<div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div>
<div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div>
<div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div>
<div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div>
<div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">// subject to the following restrictions:</span></div>
<div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">// 1. The origin of this software must not be misrepresented;</span></div>
<div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">//    you must not claim that you wrote the original software.</span></div>
<div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">//    If you use this software in a product, an acknowledgment</span></div>
<div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">//    in the product documentation would be appreciated but is not required.</span></div>
<div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;<span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div>
<div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;<span class="comment">//    and must not be misrepresented as being the original software.</span></div>
<div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;<span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div>
<div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;<span class="comment"></span></div>
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_WINDOWSETTINGS_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_WINDOWSETTINGS_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00028"></a><span class="lineno">   28</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00030"></a><span class="lineno">   30</span>&#160;{</div>
<div class="line"><a name="l00034"></a><span class="lineno"><a class="code" href="structsf_1_1WindowSettings.php">   34</a></span>&#160;<span class="keyword">struct </span><a class="code" href="structsf_1_1WindowSettings.php" title="Structure defining the creation settings of windows.">WindowSettings</a></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;{</div>
<div class="line"><a name="l00044"></a><span class="lineno"><a class="code" href="structsf_1_1WindowSettings.php#a9a0d11aad458247ff27833594d4b94fb">   44</a></span>&#160;    <span class="keyword">explicit</span> <a class="code" href="structsf_1_1WindowSettings.php#a9a0d11aad458247ff27833594d4b94fb" title="Default constructor.">WindowSettings</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> Depth = 24, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> Stencil = 8, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> Antialiasing = 0) :</div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;    <a class="code" href="structsf_1_1WindowSettings.php#a40027650d83937ec6b6e62b640cfc5c6" title="Bits of the depth buffer.">DepthBits</a>        (Depth),</div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;    <a class="code" href="structsf_1_1WindowSettings.php#accbb7b24418ab8266bec31444f6fba08" title="Bits of the stencil buffer.">StencilBits</a>      (Stencil),</div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;    <a class="code" href="structsf_1_1WindowSettings.php#a188763b40746310b6897a8e6b1a3375f" title="Level of antialiasing.">AntialiasingLevel</a>(Antialiasing)</div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;    {</div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;    }</div>
<div class="line"><a name="l00050"></a><span class="lineno">   50</span>&#160;</div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00054"></a><span class="lineno"><a class="code" href="structsf_1_1WindowSettings.php#a40027650d83937ec6b6e62b640cfc5c6">   54</a></span>&#160;<span class="comment"></span>    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> <a class="code" href="structsf_1_1WindowSettings.php#a40027650d83937ec6b6e62b640cfc5c6" title="Bits of the depth buffer.">DepthBits</a>;         </div>
<div class="line"><a name="l00055"></a><span class="lineno"><a class="code" href="structsf_1_1WindowSettings.php#accbb7b24418ab8266bec31444f6fba08">   55</a></span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> <a class="code" href="structsf_1_1WindowSettings.php#accbb7b24418ab8266bec31444f6fba08" title="Bits of the stencil buffer.">StencilBits</a>;       </div>
<div class="line"><a name="l00056"></a><span class="lineno"><a class="code" href="structsf_1_1WindowSettings.php#a188763b40746310b6897a8e6b1a3375f">   56</a></span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> <a class="code" href="structsf_1_1WindowSettings.php#a188763b40746310b6897a8e6b1a3375f" title="Level of antialiasing.">AntialiasingLevel</a>; </div>
<div class="line"><a name="l00057"></a><span class="lineno">   57</span>&#160;};</div>
<div class="line"><a name="l00058"></a><span class="lineno">   58</span>&#160;</div>
<div class="line"><a name="l00059"></a><span class="lineno">   59</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;</div>
<div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;</div>
<div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;<span class="preprocessor">#endif // SFML_WINDOWSETTINGS_HPP</span></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
