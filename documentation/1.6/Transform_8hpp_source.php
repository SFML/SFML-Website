<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
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
<li class="navelem"><a class="el" href="dir_83ae1a5e8455fc62607b4936b42116e9.php">sfml</a></li><li class="navelem"><a class="el" href="dir_79a044fa5ec8bbf4af7d440d8995a178.php">sfml</a></li><li class="navelem"><a class="el" href="dir_f3190241575fd2bd132a392ae6942f4a.php">include</a></li><li class="navelem"><a class="el" href="dir_692f376662c82a26cfe4cfa3aceebe24.php">SFML</a></li><li class="navelem"><a class="el" href="dir_aaa96c3797a59111c2945d0d638ce5cf.php">Graphics</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">Transform.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;</div>
<div class="line"><a name="l00002"></a><span class="lineno">    2</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2013 Laurent Gomila (laurent.gom@gmail.com)</span></div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_TRANSFORM_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_TRANSFORM_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;{</div>
<div class="line"><a name="l00042"></a><span class="lineno"><a class="code" href="classsf_1_1Transform.php">   42</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a></div>
<div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;{</div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;</div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>();</div>
<div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;</div>
<div class="line"><a name="l00068"></a><span class="lineno">   68</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>(<span class="keywordtype">float</span> a00, <span class="keywordtype">float</span> a01, <span class="keywordtype">float</span> a02,</div>
<div class="line"><a name="l00069"></a><span class="lineno">   69</span>&#160;              <span class="keywordtype">float</span> a10, <span class="keywordtype">float</span> a11, <span class="keywordtype">float</span> a12,</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;              <span class="keywordtype">float</span> a20, <span class="keywordtype">float</span> a21, <span class="keywordtype">float</span> a22);</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;</div>
<div class="line"><a name="l00087"></a><span class="lineno">   87</span>&#160;    <span class="keyword">const</span> <span class="keywordtype">float</span>* getMatrix() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00088"></a><span class="lineno">   88</span>&#160;</div>
<div class="line"><a name="l00098"></a><span class="lineno">   98</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a> getInverse() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00099"></a><span class="lineno">   99</span>&#160;</div>
<div class="line"><a name="l00109"></a><span class="lineno">  109</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a> transformPoint(<span class="keywordtype">float</span> x, <span class="keywordtype">float</span> y) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;</div>
<div class="line"><a name="l00119"></a><span class="lineno">  119</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a> transformPoint(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; point) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00120"></a><span class="lineno">  120</span>&#160;</div>
<div class="line"><a name="l00135"></a><span class="lineno">  135</span>&#160;    <a class="code" href="classsf_1_1Rect.php">FloatRect</a> transformRect(<span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">FloatRect</a>&amp; rectangle) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00136"></a><span class="lineno">  136</span>&#160;</div>
<div class="line"><a name="l00149"></a><span class="lineno">  149</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; combine(<span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; transform);</div>
<div class="line"><a name="l00150"></a><span class="lineno">  150</span>&#160;</div>
<div class="line"><a name="l00169"></a><span class="lineno">  169</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; translate(<span class="keywordtype">float</span> x, <span class="keywordtype">float</span> y);</div>
<div class="line"><a name="l00170"></a><span class="lineno">  170</span>&#160;</div>
<div class="line"><a name="l00188"></a><span class="lineno">  188</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; translate(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; offset);</div>
<div class="line"><a name="l00189"></a><span class="lineno">  189</span>&#160;</div>
<div class="line"><a name="l00207"></a><span class="lineno">  207</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; rotate(<span class="keywordtype">float</span> angle);</div>
<div class="line"><a name="l00208"></a><span class="lineno">  208</span>&#160;</div>
<div class="line"><a name="l00233"></a><span class="lineno">  233</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; rotate(<span class="keywordtype">float</span> angle, <span class="keywordtype">float</span> centerX, <span class="keywordtype">float</span> centerY);</div>
<div class="line"><a name="l00234"></a><span class="lineno">  234</span>&#160;</div>
<div class="line"><a name="l00258"></a><span class="lineno">  258</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; rotate(<span class="keywordtype">float</span> angle, <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; center);</div>
<div class="line"><a name="l00259"></a><span class="lineno">  259</span>&#160;</div>
<div class="line"><a name="l00278"></a><span class="lineno">  278</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; scale(<span class="keywordtype">float</span> scaleX, <span class="keywordtype">float</span> scaleY);</div>
<div class="line"><a name="l00279"></a><span class="lineno">  279</span>&#160;</div>
<div class="line"><a name="l00305"></a><span class="lineno">  305</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; scale(<span class="keywordtype">float</span> scaleX, <span class="keywordtype">float</span> scaleY, <span class="keywordtype">float</span> centerX, <span class="keywordtype">float</span> centerY);</div>
<div class="line"><a name="l00306"></a><span class="lineno">  306</span>&#160;</div>
<div class="line"><a name="l00324"></a><span class="lineno">  324</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; scale(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; factors);</div>
<div class="line"><a name="l00325"></a><span class="lineno">  325</span>&#160;</div>
<div class="line"><a name="l00349"></a><span class="lineno">  349</span>&#160;    <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; scale(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; factors, <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; center);</div>
<div class="line"><a name="l00350"></a><span class="lineno">  350</span>&#160;</div>
<div class="line"><a name="l00352"></a><span class="lineno">  352</span>&#160;    <span class="comment">// Static member data</span></div>
<div class="line"><a name="l00354"></a><span class="lineno"><a class="code" href="classsf_1_1Transform.php#aa4eb1eecbcb9979d76e2543b337fdb13">  354</a></span>&#160;<span class="comment"></span>    <span class="keyword">static</span> <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a> <a class="code" href="classsf_1_1Transform.php#aa4eb1eecbcb9979d76e2543b337fdb13" title="The identity transform (does nothing)">Identity</a>; </div>
<div class="line"><a name="l00355"></a><span class="lineno">  355</span>&#160;</div>
<div class="line"><a name="l00356"></a><span class="lineno">  356</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00357"></a><span class="lineno">  357</span>&#160;</div>
<div class="line"><a name="l00359"></a><span class="lineno">  359</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00361"></a><span class="lineno">  361</span>&#160;<span class="comment"></span>    <span class="keywordtype">float</span> m_matrix[16]; </div>
<div class="line"><a name="l00362"></a><span class="lineno">  362</span>&#160;};</div>
<div class="line"><a name="l00363"></a><span class="lineno">  363</span>&#160;</div>
<div class="line"><a name="l00376"></a><span class="lineno">  376</span>&#160;SFML_GRAPHICS_API <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a> operator *(<span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; left, <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; right);</div>
<div class="line"><a name="l00377"></a><span class="lineno">  377</span>&#160;</div>
<div class="line"><a name="l00390"></a><span class="lineno">  390</span>&#160;SFML_GRAPHICS_API <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; operator *=(<a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; left, <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; right);</div>
<div class="line"><a name="l00391"></a><span class="lineno">  391</span>&#160;</div>
<div class="line"><a name="l00404"></a><span class="lineno">  404</span>&#160;SFML_GRAPHICS_API <a class="code" href="classsf_1_1Vector2.php">Vector2f</a> operator *(<span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; left, <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; right);</div>
<div class="line"><a name="l00405"></a><span class="lineno">  405</span>&#160;</div>
<div class="line"><a name="l00406"></a><span class="lineno">  406</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00407"></a><span class="lineno">  407</span>&#160;</div>
<div class="line"><a name="l00408"></a><span class="lineno">  408</span>&#160;</div>
<div class="line"><a name="l00409"></a><span class="lineno">  409</span>&#160;<span class="preprocessor">#endif // SFML_TRANSFORM_HPP</span></div>
<div class="line"><a name="l00410"></a><span class="lineno">  410</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00411"></a><span class="lineno">  411</span>&#160;</div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
