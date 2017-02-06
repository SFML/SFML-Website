<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'RenderTarget.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<div class="title">RenderTarget.hpp</div>  </div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_RENDERTARGET_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_RENDERTARGET_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Color.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/View.hpp&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/BlendMode.hpp&gt;</span></div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/RenderStates.hpp&gt;</span></div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/PrimitiveType.hpp&gt;</span></div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Vertex.hpp&gt;</span></div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;<span class="preprocessor">#include &lt;SFML/System/NonCopyable.hpp&gt;</span></div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;</div>
<div class="line"><a name="l00042"></a><span class="lineno">   42</span>&#160;</div>
<div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;{</div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;<span class="keyword">class </span>Drawable;</div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;</div>
<div class="line"><a name="l00051"></a><span class="lineno"><a class="line" href="classsf_1_1RenderTarget.php">   51</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1RenderTarget.php">RenderTarget</a> : <a class="code" href="classsf_1_1NonCopyable.php">NonCopyable</a></div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;{</div>
<div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;<span class="keyword">public</span>:</div>
<div class="line"><a name="l00054"></a><span class="lineno">   54</span>&#160;</div>
<div class="line"><a name="l00059"></a><span class="lineno">   59</span>&#160;    <span class="keyword">virtual</span> ~<a class="code" href="classsf_1_1RenderTarget.php">RenderTarget</a>();</div>
<div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;    <span class="keywordtype">void</span> clear(<span class="keyword">const</span> <a class="code" href="classsf_1_1Color.php">Color</a>&amp; color = <a class="code" href="classsf_1_1Color.php">Color</a>(0, 0, 0, 255));</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;</div>
<div class="line"><a name="l00091"></a><span class="lineno">   91</span>&#160;    <span class="keywordtype">void</span> setView(<span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; view);</div>
<div class="line"><a name="l00092"></a><span class="lineno">   92</span>&#160;</div>
<div class="line"><a name="l00101"></a><span class="lineno">  101</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; getView() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00102"></a><span class="lineno">  102</span>&#160;</div>
<div class="line"><a name="l00114"></a><span class="lineno">  114</span>&#160;    <span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; getDefaultView() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00115"></a><span class="lineno">  115</span>&#160;</div>
<div class="line"><a name="l00129"></a><span class="lineno">  129</span>&#160;    <a class="code" href="classsf_1_1Rect.php">IntRect</a> getViewport(<span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; view) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00130"></a><span class="lineno">  130</span>&#160;</div>
<div class="line"><a name="l00149"></a><span class="lineno">  149</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a> mapPixelToCoords(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2i</a>&amp; point) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00150"></a><span class="lineno">  150</span>&#160;</div>
<div class="line"><a name="l00180"></a><span class="lineno">  180</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2f</a> mapPixelToCoords(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2i</a>&amp; point, <span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; view) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00181"></a><span class="lineno">  181</span>&#160;</div>
<div class="line"><a name="l00200"></a><span class="lineno">  200</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2i</a> mapCoordsToPixel(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; point) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00201"></a><span class="lineno">  201</span>&#160;</div>
<div class="line"><a name="l00227"></a><span class="lineno">  227</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2i</a> mapCoordsToPixel(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php">Vector2f</a>&amp; point, <span class="keyword">const</span> <a class="code" href="classsf_1_1View.php">View</a>&amp; view) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00228"></a><span class="lineno">  228</span>&#160;</div>
<div class="line"><a name="l00236"></a><span class="lineno">  236</span>&#160;    <span class="keywordtype">void</span> draw(<span class="keyword">const</span> <a class="code" href="classsf_1_1Drawable.php">Drawable</a>&amp; drawable, <span class="keyword">const</span> <a class="code" href="classsf_1_1RenderStates.php">RenderStates</a>&amp; states = <a class="code" href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">RenderStates::Default</a>);</div>
<div class="line"><a name="l00237"></a><span class="lineno">  237</span>&#160;</div>
<div class="line"><a name="l00247"></a><span class="lineno">  247</span>&#160;    <span class="keywordtype">void</span> draw(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vertex.php">Vertex</a>* vertices, std::size_t vertexCount,</div>
<div class="line"><a name="l00248"></a><span class="lineno">  248</span>&#160;              <a class="code" href="group__graphics.php#ga5ee56ac1339984909610713096283b1b">PrimitiveType</a> type, <span class="keyword">const</span> <a class="code" href="classsf_1_1RenderStates.php">RenderStates</a>&amp; states = <a class="code" href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">RenderStates::Default</a>);</div>
<div class="line"><a name="l00249"></a><span class="lineno">  249</span>&#160;</div>
<div class="line"><a name="l00256"></a><span class="lineno">  256</span>&#160;    <span class="keyword">virtual</span> <a class="code" href="classsf_1_1Vector2.php">Vector2u</a> getSize() <span class="keyword">const</span> = 0;</div>
<div class="line"><a name="l00257"></a><span class="lineno">  257</span>&#160;</div>
<div class="line"><a name="l00290"></a><span class="lineno">  290</span>&#160;    <span class="keywordtype">void</span> pushGLStates();</div>
<div class="line"><a name="l00291"></a><span class="lineno">  291</span>&#160;</div>
<div class="line"><a name="l00301"></a><span class="lineno">  301</span>&#160;    <span class="keywordtype">void</span> popGLStates();</div>
<div class="line"><a name="l00302"></a><span class="lineno">  302</span>&#160;</div>
<div class="line"><a name="l00324"></a><span class="lineno">  324</span>&#160;    <span class="keywordtype">void</span> resetGLStates();</div>
<div class="line"><a name="l00325"></a><span class="lineno">  325</span>&#160;</div>
<div class="line"><a name="l00326"></a><span class="lineno">  326</span>&#160;<span class="keyword">protected</span>:</div>
<div class="line"><a name="l00327"></a><span class="lineno">  327</span>&#160;</div>
<div class="line"><a name="l00332"></a><span class="lineno">  332</span>&#160;    <a class="code" href="classsf_1_1RenderTarget.php">RenderTarget</a>();</div>
<div class="line"><a name="l00333"></a><span class="lineno">  333</span>&#160;</div>
<div class="line"><a name="l00341"></a><span class="lineno">  341</span>&#160;    <span class="keywordtype">void</span> initialize();</div>
<div class="line"><a name="l00342"></a><span class="lineno">  342</span>&#160;</div>
<div class="line"><a name="l00343"></a><span class="lineno">  343</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00344"></a><span class="lineno">  344</span>&#160;</div>
<div class="line"><a name="l00349"></a><span class="lineno">  349</span>&#160;    <span class="keywordtype">void</span> applyCurrentView();</div>
<div class="line"><a name="l00350"></a><span class="lineno">  350</span>&#160;</div>
<div class="line"><a name="l00357"></a><span class="lineno">  357</span>&#160;    <span class="keywordtype">void</span> applyBlendMode(<span class="keyword">const</span> <a class="code" href="structsf_1_1BlendMode.php">BlendMode</a>&amp; mode);</div>
<div class="line"><a name="l00358"></a><span class="lineno">  358</span>&#160;</div>
<div class="line"><a name="l00365"></a><span class="lineno">  365</span>&#160;    <span class="keywordtype">void</span> applyTransform(<span class="keyword">const</span> <a class="code" href="classsf_1_1Transform.php">Transform</a>&amp; transform);</div>
<div class="line"><a name="l00366"></a><span class="lineno">  366</span>&#160;</div>
<div class="line"><a name="l00373"></a><span class="lineno">  373</span>&#160;    <span class="keywordtype">void</span> applyTexture(<span class="keyword">const</span> <a class="code" href="classsf_1_1Texture.php">Texture</a>* texture);</div>
<div class="line"><a name="l00374"></a><span class="lineno">  374</span>&#160;</div>
<div class="line"><a name="l00381"></a><span class="lineno">  381</span>&#160;    <span class="keywordtype">void</span> applyShader(<span class="keyword">const</span> <a class="code" href="classsf_1_1Shader.php">Shader</a>* shader);</div>
<div class="line"><a name="l00382"></a><span class="lineno">  382</span>&#160;</div>
<div class="line"><a name="l00395"></a><span class="lineno">  395</span>&#160;    <span class="keyword">virtual</span> <span class="keywordtype">bool</span> activate(<span class="keywordtype">bool</span> active) = 0;</div>
<div class="line"><a name="l00396"></a><span class="lineno">  396</span>&#160;</div>
<div class="line"><a name="l00401"></a><span class="lineno">  401</span>&#160;    <span class="keyword">struct </span>StatesCache</div>
<div class="line"><a name="l00402"></a><span class="lineno">  402</span>&#160;    {</div>
<div class="line"><a name="l00403"></a><span class="lineno">  403</span>&#160;        <span class="keyword">enum</span> {VertexCacheSize = 4};</div>
<div class="line"><a name="l00404"></a><span class="lineno">  404</span>&#160;</div>
<div class="line"><a name="l00405"></a><span class="lineno">  405</span>&#160;        <span class="keywordtype">bool</span>      glStatesSet;    </div>
<div class="line"><a name="l00406"></a><span class="lineno">  406</span>&#160;        <span class="keywordtype">bool</span>      viewChanged;    </div>
<div class="line"><a name="l00407"></a><span class="lineno">  407</span>&#160;        <a class="code" href="structsf_1_1BlendMode.php">BlendMode</a> lastBlendMode;  </div>
<div class="line"><a name="l00408"></a><span class="lineno">  408</span>&#160;        Uint64    lastTextureId;  </div>
<div class="line"><a name="l00409"></a><span class="lineno">  409</span>&#160;        <span class="keywordtype">bool</span>      useVertexCache; </div>
<div class="line"><a name="l00410"></a><span class="lineno">  410</span>&#160;        <a class="code" href="classsf_1_1Vertex.php">Vertex</a>    vertexCache[VertexCacheSize]; </div>
<div class="line"><a name="l00411"></a><span class="lineno">  411</span>&#160;    };</div>
<div class="line"><a name="l00412"></a><span class="lineno">  412</span>&#160;</div>
<div class="line"><a name="l00414"></a><span class="lineno">  414</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00416"></a><span class="lineno">  416</span>&#160;<span class="comment"></span>    <a class="code" href="classsf_1_1View.php">View</a>        m_defaultView; </div>
<div class="line"><a name="l00417"></a><span class="lineno">  417</span>&#160;    <a class="code" href="classsf_1_1View.php">View</a>        m_view;        </div>
<div class="line"><a name="l00418"></a><span class="lineno">  418</span>&#160;    StatesCache m_cache;       </div>
<div class="line"><a name="l00419"></a><span class="lineno">  419</span>&#160;};</div>
<div class="line"><a name="l00420"></a><span class="lineno">  420</span>&#160;</div>
<div class="line"><a name="l00421"></a><span class="lineno">  421</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00422"></a><span class="lineno">  422</span>&#160;</div>
<div class="line"><a name="l00423"></a><span class="lineno">  423</span>&#160;</div>
<div class="line"><a name="l00424"></a><span class="lineno">  424</span>&#160;<span class="preprocessor">#endif // SFML_RENDERTARGET_HPP</span></div>
<div class="line"><a name="l00425"></a><span class="lineno">  425</span>&#160;</div>
<div class="line"><a name="l00426"></a><span class="lineno">  426</span>&#160;</div>
<div class="ttc" id="group__graphics_php_ga5ee56ac1339984909610713096283b1b"><div class="ttname"><a href="group__graphics.php#ga5ee56ac1339984909610713096283b1b">sf::PrimitiveType</a></div><div class="ttdeci">PrimitiveType</div><div class="ttdoc">Types of primitives that a sf::VertexArray can render. </div><div class="ttdef"><b>Definition:</b> <a href="PrimitiveType_8hpp_source.php#l00039">PrimitiveType.hpp:39</a></div></div>
<div class="ttc" id="classsf_1_1Color_php"><div class="ttname"><a href="classsf_1_1Color.php">sf::Color</a></div><div class="ttdoc">Utility class for manipulating RGBA colors. </div><div class="ttdef"><b>Definition:</b> <a href="Color_8hpp_source.php#l00040">Color.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1Vertex_php"><div class="ttname"><a href="classsf_1_1Vertex.php">sf::Vertex</a></div><div class="ttdoc">Define a point with color and texture coordinates. </div><div class="ttdef"><b>Definition:</b> <a href="Vertex_8hpp_source.php#l00042">Vertex.hpp:42</a></div></div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="AlResource_8hpp_source.php#l00034">AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1RenderStates_php"><div class="ttname"><a href="classsf_1_1RenderStates.php">sf::RenderStates</a></div><div class="ttdoc">Define the states used for drawing to a RenderTarget. </div><div class="ttdef"><b>Definition:</b> <a href="RenderStates_8hpp_source.php#l00045">RenderStates.hpp:45</a></div></div>
<div class="ttc" id="classsf_1_1RenderStates_php_ad29672df29f19ce50c3021d95f2bb062"><div class="ttname"><a href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">sf::RenderStates::Default</a></div><div class="ttdeci">static const RenderStates Default</div><div class="ttdoc">Special instance holding the default render states. </div><div class="ttdef"><b>Definition:</b> <a href="RenderStates_8hpp_source.php#l00110">RenderStates.hpp:110</a></div></div>
<div class="ttc" id="classsf_1_1Drawable_php"><div class="ttname"><a href="classsf_1_1Drawable.php">sf::Drawable</a></div><div class="ttdoc">Abstract base class for objects that can be drawn to a render target. </div><div class="ttdef"><b>Definition:</b> <a href="Drawable_8hpp_source.php#l00044">Drawable.hpp:44</a></div></div>
<div class="ttc" id="classsf_1_1Transform_php"><div class="ttname"><a href="classsf_1_1Transform.php">sf::Transform</a></div><div class="ttdoc">Define a 3x3 transform matrix. </div><div class="ttdef"><b>Definition:</b> <a href="Transform_8hpp_source.php#l00042">Transform.hpp:42</a></div></div>
<div class="ttc" id="classsf_1_1Rect_php"><div class="ttname"><a href="classsf_1_1Rect.php">sf::Rect&lt; int &gt;</a></div></div>
<div class="ttc" id="classsf_1_1Texture_php"><div class="ttname"><a href="classsf_1_1Texture.php">sf::Texture</a></div><div class="ttdoc">Image living on the graphics card that can be used for drawing. </div><div class="ttdef"><b>Definition:</b> <a href="Texture_8hpp_source.php#l00047">Texture.hpp:47</a></div></div>
<div class="ttc" id="structsf_1_1BlendMode_php"><div class="ttname"><a href="structsf_1_1BlendMode.php">sf::BlendMode</a></div><div class="ttdoc">Blending modes for drawing. </div><div class="ttdef"><b>Definition:</b> <a href="BlendMode_8hpp_source.php#l00041">BlendMode.hpp:41</a></div></div>
<div class="ttc" id="classsf_1_1Shader_php"><div class="ttname"><a href="classsf_1_1Shader.php">sf::Shader</a></div><div class="ttdoc">Shader class (vertex, geometry and fragment) </div><div class="ttdef"><b>Definition:</b> <a href="Shader_8hpp_source.php#l00052">Shader.hpp:52</a></div></div>
<div class="ttc" id="classsf_1_1View_php"><div class="ttname"><a href="classsf_1_1View.php">sf::View</a></div><div class="ttdoc">2D camera that defines what region is shown on screen </div><div class="ttdef"><b>Definition:</b> <a href="View_8hpp_source.php#l00043">View.hpp:43</a></div></div>
<div class="ttc" id="classsf_1_1NonCopyable_php"><div class="ttname"><a href="classsf_1_1NonCopyable.php">sf::NonCopyable</a></div><div class="ttdoc">Utility class that makes any derived class non-copyable. </div><div class="ttdef"><b>Definition:</b> <a href="NonCopyable_8hpp_source.php#l00041">NonCopyable.hpp:41</a></div></div>
<div class="ttc" id="classsf_1_1RenderTarget_php"><div class="ttname"><a href="classsf_1_1RenderTarget.php">sf::RenderTarget</a></div><div class="ttdoc">Base class for all render targets (window, texture, ...) </div><div class="ttdef"><b>Definition:</b> <a href="RenderTarget_8hpp_source.php#l00051">RenderTarget.hpp:51</a></div></div>
<div class="ttc" id="classsf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; float &gt;</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
