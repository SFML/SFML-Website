<?php
    $version = '2.1'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'VertexArray.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
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
<div class="title">VertexArray.hpp</div>  </div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_VERTEXARRAY_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_VERTEXARRAY_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Vertex.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/PrimitiveType.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Drawable.hpp&gt;</span></div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;vector&gt;</span></div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;</div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;{</div>
<div class="line"><a name="l00045"></a><span class="lineno"><a class="code" href="classsf_1_1VertexArray.php">   45</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1VertexArray.php" title="Define a set of one or more 2D primitives.">VertexArray</a> : <span class="keyword">public</span> <a class="code" href="classsf_1_1Drawable.php" title="Abstract base class for objects that can be drawn to a render target.">Drawable</a></div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;{</div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;</div>
<div class="line"><a name="l00055"></a><span class="lineno">   55</span>&#160;    <a class="code" href="classsf_1_1VertexArray.php" title="Define a set of one or more 2D primitives.">VertexArray</a>();</div>
<div class="line"><a name="l00056"></a><span class="lineno">   56</span>&#160;</div>
<div class="line"><a name="l00064"></a><span class="lineno">   64</span>&#160;    <span class="keyword">explicit</span> <a class="code" href="classsf_1_1VertexArray.php" title="Define a set of one or more 2D primitives.">VertexArray</a>(<a class="code" href="group__graphics.php#ga5ee56ac1339984909610713096283b1b" title="Types of primitives that a sf::VertexArray can render.">PrimitiveType</a> type, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> vertexCount = 0);</div>
<div class="line"><a name="l00065"></a><span class="lineno">   65</span>&#160;</div>
<div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> getVertexCount() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00073"></a><span class="lineno">   73</span>&#160;</div>
<div class="line"><a name="l00088"></a><span class="lineno">   88</span>&#160;    <a class="code" href="classsf_1_1Vertex.php" title="Define a point with color and texture coordinates.">Vertex</a>&amp; operator [](<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> index);</div>
<div class="line"><a name="l00089"></a><span class="lineno">   89</span>&#160;</div>
<div class="line"><a name="l00104"></a><span class="lineno">  104</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1Vertex.php" title="Define a point with color and texture coordinates.">Vertex</a>&amp; operator [](<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> index) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;</div>
<div class="line"><a name="l00115"></a><span class="lineno">  115</span>&#160;    <span class="keywordtype">void</span> clear();</div>
<div class="line"><a name="l00116"></a><span class="lineno">  116</span>&#160;</div>
<div class="line"><a name="l00129"></a><span class="lineno">  129</span>&#160;    <span class="keywordtype">void</span> resize(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> vertexCount);</div>
<div class="line"><a name="l00130"></a><span class="lineno">  130</span>&#160;</div>
<div class="line"><a name="l00137"></a><span class="lineno">  137</span>&#160;    <span class="keywordtype">void</span> append(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vertex.php" title="Define a point with color and texture coordinates.">Vertex</a>&amp; vertex);</div>
<div class="line"><a name="l00138"></a><span class="lineno">  138</span>&#160;</div>
<div class="line"><a name="l00153"></a><span class="lineno">  153</span>&#160;    <span class="keywordtype">void</span> setPrimitiveType(<a class="code" href="group__graphics.php#ga5ee56ac1339984909610713096283b1b" title="Types of primitives that a sf::VertexArray can render.">PrimitiveType</a> type);</div>
<div class="line"><a name="l00154"></a><span class="lineno">  154</span>&#160;</div>
<div class="line"><a name="l00161"></a><span class="lineno">  161</span>&#160;    <a class="code" href="group__graphics.php#ga5ee56ac1339984909610713096283b1b" title="Types of primitives that a sf::VertexArray can render.">PrimitiveType</a> getPrimitiveType() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00162"></a><span class="lineno">  162</span>&#160;</div>
<div class="line"><a name="l00172"></a><span class="lineno">  172</span>&#160;    <a class="code" href="classsf_1_1Rect.php">FloatRect</a> getBounds() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00173"></a><span class="lineno">  173</span>&#160;</div>
<div class="line"><a name="l00174"></a><span class="lineno">  174</span>&#160;<span class="keyword">private</span> :</div>
<div class="line"><a name="l00175"></a><span class="lineno">  175</span>&#160;</div>
<div class="line"><a name="l00183"></a><span class="lineno">  183</span>&#160;    <span class="keyword">virtual</span> <span class="keywordtype">void</span> draw(<a class="code" href="classsf_1_1RenderTarget.php" title="Base class for all render targets (window, texture, ...)">RenderTarget</a>&amp; target, <a class="code" href="classsf_1_1RenderStates.php" title="Define the states used for drawing to a RenderTarget.">RenderStates</a> states) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00184"></a><span class="lineno">  184</span>&#160;</div>
<div class="line"><a name="l00185"></a><span class="lineno">  185</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00186"></a><span class="lineno">  186</span>&#160;</div>
<div class="line"><a name="l00188"></a><span class="lineno">  188</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00190"></a><span class="lineno">  190</span>&#160;<span class="comment"></span>    std::vector&lt;Vertex&gt; m_vertices;      </div>
<div class="line"><a name="l00191"></a><span class="lineno">  191</span>&#160;    <a class="code" href="group__graphics.php#ga5ee56ac1339984909610713096283b1b" title="Types of primitives that a sf::VertexArray can render.">PrimitiveType</a>       m_primitiveType; </div>
<div class="line"><a name="l00192"></a><span class="lineno">  192</span>&#160;};</div>
<div class="line"><a name="l00193"></a><span class="lineno">  193</span>&#160;</div>
<div class="line"><a name="l00194"></a><span class="lineno">  194</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00195"></a><span class="lineno">  195</span>&#160;</div>
<div class="line"><a name="l00196"></a><span class="lineno">  196</span>&#160;</div>
<div class="line"><a name="l00197"></a><span class="lineno">  197</span>&#160;<span class="preprocessor">#endif // SFML_VERTEXARRAY_HPP</span></div>
<div class="line"><a name="l00198"></a><span class="lineno">  198</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00199"></a><span class="lineno">  199</span>&#160;</div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
