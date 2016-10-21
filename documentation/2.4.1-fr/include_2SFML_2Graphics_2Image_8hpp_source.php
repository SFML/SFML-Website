<?php
    $version = '2.4.1'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Image.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_25140c63874fec7ab1624ad7e074f505.php">Graphics</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">include/SFML/Graphics/Image.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2016 Laurent Gomila (laurent@sfml-dev.org)</span></div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_IMAGE_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_IMAGE_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Color.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;string&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;vector&gt;</span></div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;{</div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;<span class="keyword">class </span>InputStream;</div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;</div>
<div class="line"><a name="l00046"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php">   46</a></span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API <a class="code" href="classsf_1_1Image.php">Image</a></div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;{</div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;<span class="keyword">public</span>:</div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;</div>
<div class="line"><a name="l00056"></a><span class="lineno">   56</span>&#160;    <a class="code" href="classsf_1_1Image.php">Image</a>();</div>
<div class="line"><a name="l00057"></a><span class="lineno">   57</span>&#160;</div>
<div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;    ~<a class="code" href="classsf_1_1Image.php">Image</a>();</div>
<div class="line"><a name="l00063"></a><span class="lineno">   63</span>&#160;</div>
<div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;    <span class="keywordtype">void</span> create(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height, <span class="keyword">const</span> <a class="code" href="classsf_1_1Color.php">Color</a>&amp; color = <a class="code" href="classsf_1_1Color.php">Color</a>(0, 0, 0));</div>
<div class="line"><a name="l00073"></a><span class="lineno">   73</span>&#160;</div>
<div class="line"><a name="l00087"></a><span class="lineno">   87</span>&#160;    <span class="keywordtype">void</span> create(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height, <span class="keyword">const</span> Uint8* pixels);</div>
<div class="line"><a name="l00088"></a><span class="lineno">   88</span>&#160;</div>
<div class="line"><a name="l00104"></a><span class="lineno">  104</span>&#160;    <span class="keywordtype">bool</span> loadFromFile(<span class="keyword">const</span> std::string&amp; filename);</div>
<div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;</div>
<div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;    <span class="keywordtype">bool</span> loadFromMemory(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t size);</div>
<div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;</div>
<div class="line"><a name="l00139"></a><span class="lineno">  139</span>&#160;    <span class="keywordtype">bool</span> loadFromStream(<a class="code" href="classsf_1_1InputStream.php">InputStream</a>&amp; stream);</div>
<div class="line"><a name="l00140"></a><span class="lineno">  140</span>&#160;</div>
<div class="line"><a name="l00156"></a><span class="lineno">  156</span>&#160;    <span class="keywordtype">bool</span> saveToFile(<span class="keyword">const</span> std::string&amp; filename) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00157"></a><span class="lineno">  157</span>&#160;</div>
<div class="line"><a name="l00164"></a><span class="lineno">  164</span>&#160;    <a class="code" href="classsf_1_1Vector2.php">Vector2u</a> getSize() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00165"></a><span class="lineno">  165</span>&#160;</div>
<div class="line"><a name="l00177"></a><span class="lineno">  177</span>&#160;    <span class="keywordtype">void</span> createMaskFromColor(<span class="keyword">const</span> <a class="code" href="classsf_1_1Color.php">Color</a>&amp; color, Uint8 alpha = 0);</div>
<div class="line"><a name="l00178"></a><span class="lineno">  178</span>&#160;</div>
<div class="line"><a name="l00199"></a><span class="lineno">  199</span>&#160;    <span class="keywordtype">void</span> copy(<span class="keyword">const</span> <a class="code" href="classsf_1_1Image.php">Image</a>&amp; source, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> destX, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> destY, <span class="keyword">const</span> <a class="code" href="classsf_1_1Rect.php">IntRect</a>&amp; sourceRect = <a class="code" href="classsf_1_1Rect.php">IntRect</a>(0, 0, 0, 0), <span class="keywordtype">bool</span> applyAlpha = <span class="keyword">false</span>);</div>
<div class="line"><a name="l00200"></a><span class="lineno">  200</span>&#160;</div>
<div class="line"><a name="l00215"></a><span class="lineno">  215</span>&#160;    <span class="keywordtype">void</span> setPixel(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> x, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> y, <span class="keyword">const</span> <a class="code" href="classsf_1_1Color.php">Color</a>&amp; color);</div>
<div class="line"><a name="l00216"></a><span class="lineno">  216</span>&#160;</div>
<div class="line"><a name="l00232"></a><span class="lineno">  232</span>&#160;    <a class="code" href="classsf_1_1Color.php">Color</a> getPixel(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> x, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> y) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00233"></a><span class="lineno">  233</span>&#160;</div>
<div class="line"><a name="l00247"></a><span class="lineno">  247</span>&#160;    <span class="keyword">const</span> Uint8* getPixelsPtr() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00248"></a><span class="lineno">  248</span>&#160;</div>
<div class="line"><a name="l00253"></a><span class="lineno">  253</span>&#160;    <span class="keywordtype">void</span> flipHorizontally();</div>
<div class="line"><a name="l00254"></a><span class="lineno">  254</span>&#160;</div>
<div class="line"><a name="l00259"></a><span class="lineno">  259</span>&#160;    <span class="keywordtype">void</span> flipVertically();</div>
<div class="line"><a name="l00260"></a><span class="lineno">  260</span>&#160;</div>
<div class="line"><a name="l00261"></a><span class="lineno">  261</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00262"></a><span class="lineno">  262</span>&#160;</div>
<div class="line"><a name="l00264"></a><span class="lineno">  264</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00266"></a><span class="lineno">  266</span>&#160;<span class="comment"></span>    <a class="code" href="classsf_1_1Vector2.php">Vector2u</a>           m_size;   </div>
<div class="line"><a name="l00267"></a><span class="lineno">  267</span>&#160;    std::vector&lt;Uint8&gt; m_pixels; </div>
<div class="line"><a name="l00268"></a><span class="lineno">  268</span>&#160;<span class="preprocessor">    #ifdef SFML_SYSTEM_ANDROID</span></div>
<div class="line"><a name="l00269"></a><span class="lineno">  269</span>&#160;    <span class="keywordtype">void</span>*              m_stream; </div>
<div class="line"><a name="l00270"></a><span class="lineno">  270</span>&#160;<span class="preprocessor">    #endif</span></div>
<div class="line"><a name="l00271"></a><span class="lineno">  271</span>&#160;};</div>
<div class="line"><a name="l00272"></a><span class="lineno">  272</span>&#160;</div>
<div class="line"><a name="l00273"></a><span class="lineno">  273</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00274"></a><span class="lineno">  274</span>&#160;</div>
<div class="line"><a name="l00275"></a><span class="lineno">  275</span>&#160;</div>
<div class="line"><a name="l00276"></a><span class="lineno">  276</span>&#160;<span class="preprocessor">#endif // SFML_IMAGE_HPP</span></div>
<div class="line"><a name="l00277"></a><span class="lineno">  277</span>&#160;</div>
<div class="line"><a name="l00278"></a><span class="lineno">  278</span>&#160;</div>
<div class="ttc" id="classsf_1_1Color_php"><div class="ttname"><a href="classsf_1_1Color.php">sf::Color</a></div><div class="ttdoc">Utility class for manipulating RGBA colors. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Graphics_2Color_8hpp_source.php#l00040">include/SFML/Graphics/Color.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1InputStream_php"><div class="ttname"><a href="classsf_1_1InputStream.php">sf::InputStream</a></div><div class="ttdoc">Abstract class for custom file input streams. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2System_2InputStream_8hpp_source.php#l00041">include/SFML/System/InputStream.hpp:41</a></div></div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Audio_2AlResource_8hpp_source.php#l00034">include/SFML/Audio/AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1Rect_php"><div class="ttname"><a href="classsf_1_1Rect.php">sf::Rect&lt; int &gt;</a></div></div>
<div class="ttc" id="classsf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; unsigned int &gt;</a></div></div>
<div class="ttc" id="classsf_1_1Image_php"><div class="ttname"><a href="classsf_1_1Image.php">sf::Image</a></div><div class="ttdoc">Class for loading, manipulating and saving images. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Graphics_2Image_8hpp_source.php#l00046">include/SFML/Graphics/Image.hpp:46</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
