<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'View.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.10 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
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
<li class="navelem"><a class="el" href="dir_7107138a9ca528d5a30fb6c42d13b481.php">SFML</a></li><li class="navelem"><a class="el" href="dir_186e0dcb96ed2747fde77bc4d13d2016.php">include</a></li><li class="navelem"><a class="el" href="dir_8300c2a4f3c47520e59b1ed4cebc1d64.php">SFML</a></li><li class="navelem"><a class="el" href="dir_c35206ee16f5142ebcf86ff0b09d4086.php">Graphics</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">View.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2017 Laurent Gomila (laurent@sfml-dev.org)</span></div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_VIEW_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_VIEW_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;{</div>
<div class="line"><a name="l00043"></a><span class="lineno"><a class="line" href="classsf_1_1View.php">   43</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1View.php">View</a></div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;{</div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;<span class="keyword">public</span>:</div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;</div>
<div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;    <a class="code" href="classsf_1_1View.php">View</a>();</div>
<div class="line"><a name="l00054"></a><span class="lineno">   54</span>&#160;</div>
<div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;    <span class="keyword">explicit</span> <a class="code" href="classsf_1_1View.php">View</a>(<span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">FloatRect</a>&amp; rectangle);</div>
<div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;    <a class="code" href="classsf_1_1View.php">View</a>(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; center, <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; size);</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;</div>
<div class="line"><a name="l00081"></a><span class="lineno">   81</span>&#160;    <span class="keywordtype">void</span> setCenter(<span class="keywordtype">float</span> x, <span class="keywordtype">float</span> y);</div>
<div class="line"><a name="l00082"></a><span class="lineno">   82</span>&#160;</div>
<div class="line"><a name="l00091"></a><span class="lineno">   91</span>&#160;    <span class="keywordtype">void</span> setCenter(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; center);</div>
<div class="line"><a name="l00092"></a><span class="lineno">   92</span>&#160;</div>
<div class="line"><a name="l00102"></a><span class="lineno">  102</span>&#160;    <span class="keywordtype">void</span> setSize(<span class="keywordtype">float</span> width, <span class="keywordtype">float</span> height);</div>
<div class="line"><a name="l00103"></a><span class="lineno">  103</span>&#160;</div>
<div class="line"><a name="l00112"></a><span class="lineno">  112</span>&#160;    <span class="keywordtype">void</span> setSize(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; size);</div>
<div class="line"><a name="l00113"></a><span class="lineno">  113</span>&#160;</div>
<div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;    <span class="keywordtype">void</span> setRotation(<span class="keywordtype">float</span> angle);</div>
<div class="line"><a name="l00125"></a><span class="lineno">  125</span>&#160;</div>
<div class="line"><a name="l00141"></a><span class="lineno">  141</span>&#160;    <span class="keywordtype">void</span> setViewport(<span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">FloatRect</a>&amp; viewport);</div>
<div class="line"><a name="l00142"></a><span class="lineno">  142</span>&#160;</div>
<div class="line"><a name="l00153"></a><span class="lineno">  153</span>&#160;    <span class="keywordtype">void</span> reset(<span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">FloatRect</a>&amp; rectangle);</div>
<div class="line"><a name="l00154"></a><span class="lineno">  154</span>&#160;</div>
<div class="line"><a name="l00163"></a><span class="lineno">  163</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; getCenter() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00164"></a><span class="lineno">  164</span>&#160;</div>
<div class="line"><a name="l00173"></a><span class="lineno">  173</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; getSize() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00174"></a><span class="lineno">  174</span>&#160;</div>
<div class="line"><a name="l00183"></a><span class="lineno">  183</span>&#160;    <span class="keywordtype">float</span> getRotation() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00184"></a><span class="lineno">  184</span>&#160;</div>
<div class="line"><a name="l00193"></a><span class="lineno">  193</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">FloatRect</a>&amp; getViewport() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00194"></a><span class="lineno">  194</span>&#160;</div>
<div class="line"><a name="l00204"></a><span class="lineno">  204</span>&#160;    <span class="keywordtype">void</span> move(<span class="keywordtype">float</span> offsetX, <span class="keywordtype">float</span> offsetY);</div>
<div class="line"><a name="l00205"></a><span class="lineno">  205</span>&#160;</div>
<div class="line"><a name="l00214"></a><span class="lineno">  214</span>&#160;    <span class="keywordtype">void</span> move(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; offset);</div>
<div class="line"><a name="l00215"></a><span class="lineno">  215</span>&#160;</div>
<div class="line"><a name="l00224"></a><span class="lineno">  224</span>&#160;    <span class="keywordtype">void</span> rotate(<span class="keywordtype">float</span> angle);</div>
<div class="line"><a name="l00225"></a><span class="lineno">  225</span>&#160;</div>
<div class="line"><a name="l00241"></a><span class="lineno">  241</span>&#160;    <span class="keywordtype">void</span> zoom(<span class="keywordtype">float</span> factor);</div>
<div class="line"><a name="l00242"></a><span class="lineno">  242</span>&#160;</div>
<div class="line"><a name="l00253"></a><span class="lineno">  253</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php">Transform</a>&amp; getTransform() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00254"></a><span class="lineno">  254</span>&#160;</div>
<div class="line"><a name="l00265"></a><span class="lineno">  265</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php">Transform</a>&amp; getInverseTransform() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00266"></a><span class="lineno">  266</span>&#160;</div>
<div class="line"><a name="l00267"></a><span class="lineno">  267</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00268"></a><span class="lineno">  268</span>&#160;</div>
<div class="line"><a name="l00270"></a><span class="lineno">  270</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00272"></a><span class="lineno">  272</span>&#160;<span class="comment"></span>    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>          m_center;              </div>
<div class="line"><a name="l00273"></a><span class="lineno">  273</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>          m_size;                </div>
<div class="line"><a name="l00274"></a><span class="lineno">  274</span>&#160;    <span class="keywordtype">float</span>             m_rotation;            </div>
<div class="line"><a name="l00275"></a><span class="lineno">  275</span>&#160;    <a class="code" href="classsf_1_1Rect.php">FloatRect</a>         m_viewport;            </div>
<div class="line"><a name="l00276"></a><span class="lineno">  276</span>&#160;    <span class="keyword">mutable</span> <a class="code" href="classsf_1_1Transform.php">Transform</a> m_transform;           </div>
<div class="line"><a name="l00277"></a><span class="lineno">  277</span>&#160;    <span class="keyword">mutable</span> <a class="code" href="classsf_1_1Transform.php">Transform</a> m_inverseTransform;    </div>
<div class="line"><a name="l00278"></a><span class="lineno">  278</span>&#160;    <span class="keyword">mutable</span> <span class="keywordtype">bool</span>      m_transformUpdated;    </div>
<div class="line"><a name="l00279"></a><span class="lineno">  279</span>&#160;    <span class="keyword">mutable</span> <span class="keywordtype">bool</span>      m_invTransformUpdated; </div>
<div class="line"><a name="l00280"></a><span class="lineno">  280</span>&#160;};</div>
<div class="line"><a name="l00281"></a><span class="lineno">  281</span>&#160;</div>
<div class="line"><a name="l00282"></a><span class="lineno">  282</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00283"></a><span class="lineno">  283</span>&#160;</div>
<div class="line"><a name="l00284"></a><span class="lineno">  284</span>&#160;</div>
<div class="line"><a name="l00285"></a><span class="lineno">  285</span>&#160;<span class="preprocessor">#endif // SFML_VIEW_HPP</span></div>
<div class="line"><a name="l00286"></a><span class="lineno">  286</span>&#160;</div>
<div class="line"><a name="l00287"></a><span class="lineno">  287</span>&#160;</div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="AlResource_8hpp_source.php#l00034">AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1Transform_php"><div class="ttname"><a href="classsf_1_1Transform.php">sf::Transform</a></div><div class="ttdoc">Define a 3x3 transform matrix. </div><div class="ttdef"><b>Definition:</b> <a href="Transform_8hpp_source.php#l00042">Transform.hpp:42</a></div></div>
<div class="ttc" id="classsf_1_1Rect_php"><div class="ttname"><a href="classsf_1_1Rect.php">sf::Rect&lt; float &gt;</a></div></div>
<div class="ttc" id="classsf_1_1View_php"><div class="ttname"><a href="classsf_1_1View.php">sf::View</a></div><div class="ttdoc">2D camera that defines what region is shown on screen </div><div class="ttdef"><b>Definition:</b> <a href="View_8hpp_source.php#l00043">View.hpp:43</a></div></div>
<div class="ttc" id="classsf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; float &gt;</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
