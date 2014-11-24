<?php
    $version = '2.0'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Transformable.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<div class="title">Transformable.hpp</div>  </div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_TRANSFORMABLE_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_TRANSFORMABLE_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;</div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;{</div>
<div class="line"><a name="l00041"></a><span class="lineno"><a class="code" href="classsf_1_1Transformable.php">   41</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1Transformable.php" title="Decomposed transform defined by a position, a rotation and a scale.">Transformable</a></div>
<div class="line"><a name="l00042"></a><span class="lineno">   42</span>&#160;{</div>
<div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;</div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;    <a class="code" href="classsf_1_1Transformable.php" title="Decomposed transform defined by a position, a rotation and a scale.">Transformable</a>();</div>
<div class="line"><a name="l00050"></a><span class="lineno">   50</span>&#160;</div>
<div class="line"><a name="l00055"></a><span class="lineno">   55</span>&#160;    <span class="keyword">virtual</span> ~<a class="code" href="classsf_1_1Transformable.php" title="Decomposed transform defined by a position, a rotation and a scale.">Transformable</a>();</div>
<div class="line"><a name="l00056"></a><span class="lineno">   56</span>&#160;</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;    <span class="keywordtype">void</span> setPosition(<span class="keywordtype">float</span> x, <span class="keywordtype">float</span> y);</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;</div>
<div class="line"><a name="l00084"></a><span class="lineno">   84</span>&#160;    <span class="keywordtype">void</span> setPosition(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; position);</div>
<div class="line"><a name="l00085"></a><span class="lineno">   85</span>&#160;</div>
<div class="line"><a name="l00098"></a><span class="lineno">   98</span>&#160;    <span class="keywordtype">void</span> setRotation(<span class="keywordtype">float</span> angle);</div>
<div class="line"><a name="l00099"></a><span class="lineno">   99</span>&#160;</div>
<div class="line"><a name="l00113"></a><span class="lineno">  113</span>&#160;    <span class="keywordtype">void</span> setScale(<span class="keywordtype">float</span> factorX, <span class="keywordtype">float</span> factorY);</div>
<div class="line"><a name="l00114"></a><span class="lineno">  114</span>&#160;</div>
<div class="line"><a name="l00127"></a><span class="lineno">  127</span>&#160;    <span class="keywordtype">void</span> setScale(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; factors);</div>
<div class="line"><a name="l00128"></a><span class="lineno">  128</span>&#160;</div>
<div class="line"><a name="l00145"></a><span class="lineno">  145</span>&#160;    <span class="keywordtype">void</span> setOrigin(<span class="keywordtype">float</span> x, <span class="keywordtype">float</span> y);</div>
<div class="line"><a name="l00146"></a><span class="lineno">  146</span>&#160;</div>
<div class="line"><a name="l00162"></a><span class="lineno">  162</span>&#160;    <span class="keywordtype">void</span> setOrigin(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; origin);</div>
<div class="line"><a name="l00163"></a><span class="lineno">  163</span>&#160;</div>
<div class="line"><a name="l00172"></a><span class="lineno">  172</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; getPosition() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00173"></a><span class="lineno">  173</span>&#160;</div>
<div class="line"><a name="l00184"></a><span class="lineno">  184</span>&#160;    <span class="keywordtype">float</span> getRotation() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00185"></a><span class="lineno">  185</span>&#160;</div>
<div class="line"><a name="l00194"></a><span class="lineno">  194</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; getScale() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00195"></a><span class="lineno">  195</span>&#160;</div>
<div class="line"><a name="l00204"></a><span class="lineno">  204</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; getOrigin() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00205"></a><span class="lineno">  205</span>&#160;</div>
<div class="line"><a name="l00223"></a><span class="lineno">  223</span>&#160;    <span class="keywordtype">void</span> move(<span class="keywordtype">float</span> offsetX, <span class="keywordtype">float</span> offsetY);</div>
<div class="line"><a name="l00224"></a><span class="lineno">  224</span>&#160;</div>
<div class="line"><a name="l00240"></a><span class="lineno">  240</span>&#160;    <span class="keywordtype">void</span> move(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; offset);</div>
<div class="line"><a name="l00241"></a><span class="lineno">  241</span>&#160;</div>
<div class="line"><a name="l00255"></a><span class="lineno">  255</span>&#160;    <span class="keywordtype">void</span> rotate(<span class="keywordtype">float</span> angle);</div>
<div class="line"><a name="l00256"></a><span class="lineno">  256</span>&#160;</div>
<div class="line"><a name="l00274"></a><span class="lineno">  274</span>&#160;    <span class="keywordtype">void</span> scale(<span class="keywordtype">float</span> factorX, <span class="keywordtype">float</span> factorY);</div>
<div class="line"><a name="l00275"></a><span class="lineno">  275</span>&#160;</div>
<div class="line"><a name="l00292"></a><span class="lineno">  292</span>&#160;    <span class="keywordtype">void</span> scale(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; factor);</div>
<div class="line"><a name="l00293"></a><span class="lineno">  293</span>&#160;</div>
<div class="line"><a name="l00302"></a><span class="lineno">  302</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; getTransform() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00303"></a><span class="lineno">  303</span>&#160;</div>
<div class="line"><a name="l00312"></a><span class="lineno">  312</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a>&amp; getInverseTransform() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00313"></a><span class="lineno">  313</span>&#160;</div>
<div class="line"><a name="l00314"></a><span class="lineno">  314</span>&#160;<span class="keyword">private</span> :</div>
<div class="line"><a name="l00315"></a><span class="lineno">  315</span>&#160;</div>
<div class="line"><a name="l00317"></a><span class="lineno">  317</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00319"></a><span class="lineno">  319</span>&#160;<span class="comment"></span>    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>          m_origin;                     </div>
<div class="line"><a name="l00320"></a><span class="lineno">  320</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>          m_position;                   </div>
<div class="line"><a name="l00321"></a><span class="lineno">  321</span>&#160;    <span class="keywordtype">float</span>             m_rotation;                   </div>
<div class="line"><a name="l00322"></a><span class="lineno">  322</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>          m_scale;                      </div>
<div class="line"><a name="l00323"></a><span class="lineno">  323</span>&#160;    <span class="keyword">mutable</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a> m_transform;                  </div>
<div class="line"><a name="l00324"></a><span class="lineno">  324</span>&#160;    <span class="keyword">mutable</span> <span class="keywordtype">bool</span>      m_transformNeedUpdate;        </div>
<div class="line"><a name="l00325"></a><span class="lineno">  325</span>&#160;    <span class="keyword">mutable</span> <a class="code" href="classsf_1_1Transform.php" title="Define a 3x3 transform matrix.">Transform</a> m_inverseTransform;           </div>
<div class="line"><a name="l00326"></a><span class="lineno">  326</span>&#160;    <span class="keyword">mutable</span> <span class="keywordtype">bool</span>      m_inverseTransformNeedUpdate; </div>
<div class="line"><a name="l00327"></a><span class="lineno">  327</span>&#160;};</div>
<div class="line"><a name="l00328"></a><span class="lineno">  328</span>&#160;</div>
<div class="line"><a name="l00329"></a><span class="lineno">  329</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00330"></a><span class="lineno">  330</span>&#160;</div>
<div class="line"><a name="l00331"></a><span class="lineno">  331</span>&#160;</div>
<div class="line"><a name="l00332"></a><span class="lineno">  332</span>&#160;<span class="preprocessor">#endif // SFML_TRANSFORMABLE_HPP</span></div>
<div class="line"><a name="l00333"></a><span class="lineno">  333</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00334"></a><span class="lineno">  334</span>&#160;</div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
