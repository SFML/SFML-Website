<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Shape.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.12.0 -->
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
var searchBox = new SearchBox("searchBox", "search/",'.php');
/* @license-end */
</script>
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
$(function() { codefold.init(0); });
/* @license-end */
</script>
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="topics.php"><span>Topics</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
      <li><a href="annotated.php"><span>Classes</span></a></li>
      <li class="current"><a href="files.php"><span>Files</span></a></li>
      <li>
        <div id="MSearchBox" class="MSearchBoxInactive">
        <span class="left">
          <span id="MSearchSelect"                onmouseover="return searchBox.OnSearchSelectShow()"                onmouseout="return searchBox.OnSearchSelectHide()">&#160;</span>
          <input type="text" id="MSearchField" value="" placeholder="Search" accesskey="S"
               onfocus="searchBox.OnSearchFieldFocus(true)" 
               onblur="searchBox.OnSearchFieldFocus(false)" 
               onkeyup="searchBox.OnSearchFieldChange(event)"/>
          </span><span class="right">
            <a id="MSearchClose" href="javascript:searchBox.CloseResultsWindow()"><img id="MSearchCloseImg" border="0" src="search/close.svg" alt=""/></a>
          </span>
        </div>
      </li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="files.php"><span>File&#160;List</span></a></li>
      <li><a href="globals.php"><span>File&#160;Members</span></a></li>
    </ul>
  </div>
<script type="text/javascript">
/* @license magnet:?xt=urn:btih:d3d9a9a6595521f9666a5e94cc830dab83b65699&amp;dn=expat.txt MIT */
$(function(){ initResizable(false); });
/* @license-end */
</script>
<!-- window showing the filter options -->
<div id="MSearchSelectWindow"
     onmouseover="return searchBox.OnSearchSelectShow()"
     onmouseout="return searchBox.OnSearchSelectHide()"
     onkeydown="return searchBox.OnSearchSelectKey(event)">
</div>

<!-- iframe showing the search results (closed by default) -->
<div id="MSearchResultsWindow">
<div id="MSearchResults">
<div class="SRPage">
<div id="SRIndex">
<div id="SRResults"></div>
<div class="SRStatus" id="Loading">Loading...</div>
<div class="SRStatus" id="Searching">Searching...</div>
<div class="SRStatus" id="NoMatches">No Matches</div>
</div>
</div>
</div>
</div>

<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_25140c63874fec7ab1624ad7e074f505.php">Graphics</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">Shape.hpp</div></div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a id="l00001" name="l00001"></a><span class="lineno">    1</span> </div>
<div class="line"><a id="l00002" name="l00002"></a><span class="lineno">    2</span><span class="comment">//</span></div>
<div class="line"><a id="l00003" name="l00003"></a><span class="lineno">    3</span><span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a id="l00004" name="l00004"></a><span class="lineno">    4</span><span class="comment">// Copyright (C) 2007-2023 Laurent Gomila (laurent@sfml-dev.org)</span></div>
<div class="line"><a id="l00005" name="l00005"></a><span class="lineno">    5</span><span class="comment">//</span></div>
<div class="line"><a id="l00006" name="l00006"></a><span class="lineno">    6</span><span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div>
<div class="line"><a id="l00007" name="l00007"></a><span class="lineno">    7</span><span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div>
<div class="line"><a id="l00008" name="l00008"></a><span class="lineno">    8</span><span class="comment">//</span></div>
<div class="line"><a id="l00009" name="l00009"></a><span class="lineno">    9</span><span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div>
<div class="line"><a id="l00010" name="l00010"></a><span class="lineno">   10</span><span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div>
<div class="line"><a id="l00011" name="l00011"></a><span class="lineno">   11</span><span class="comment">// subject to the following restrictions:</span></div>
<div class="line"><a id="l00012" name="l00012"></a><span class="lineno">   12</span><span class="comment">//</span></div>
<div class="line"><a id="l00013" name="l00013"></a><span class="lineno">   13</span><span class="comment">// 1. The origin of this software must not be misrepresented;</span></div>
<div class="line"><a id="l00014" name="l00014"></a><span class="lineno">   14</span><span class="comment">//    you must not claim that you wrote the original software.</span></div>
<div class="line"><a id="l00015" name="l00015"></a><span class="lineno">   15</span><span class="comment">//    If you use this software in a product, an acknowledgment</span></div>
<div class="line"><a id="l00016" name="l00016"></a><span class="lineno">   16</span><span class="comment">//    in the product documentation would be appreciated but is not required.</span></div>
<div class="line"><a id="l00017" name="l00017"></a><span class="lineno">   17</span><span class="comment">//</span></div>
<div class="line"><a id="l00018" name="l00018"></a><span class="lineno">   18</span><span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div>
<div class="line"><a id="l00019" name="l00019"></a><span class="lineno">   19</span><span class="comment">//    and must not be misrepresented as being the original software.</span></div>
<div class="line"><a id="l00020" name="l00020"></a><span class="lineno">   20</span><span class="comment">//</span></div>
<div class="line"><a id="l00021" name="l00021"></a><span class="lineno">   21</span><span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div>
<div class="line"><a id="l00022" name="l00022"></a><span class="lineno">   22</span><span class="comment">//</span></div>
<div class="line"><a id="l00024" name="l00024"></a><span class="lineno">   24</span> </div>
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_SHAPE_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_SHAPE_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Graphics/Drawable.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/Graphics/Transformable.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span><span class="preprocessor">#include &lt;SFML/Graphics/VertexArray.hpp&gt;</span></div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span><span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span> </div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span> </div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span>{</div>
<div class="foldopen" id="foldopen00044" data-start="{" data-end="};">
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php">   44</a></span><span class="keyword">class </span>SFML_GRAPHICS_API <a class="code hl_class" href="classsf_1_1Shape.php">Shape</a> : <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1Drawable.php">Drawable</a>, <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1Transformable.php">Transformable</a></div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span>{</div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span> </div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a2262aceb9df52d4275c19633592f19bf">   52</a></span>    <span class="keyword">virtual</span> <a class="code hl_function" href="classsf_1_1Shape.php#a2262aceb9df52d4275c19633592f19bf">~Shape</a>();</div>
<div class="line"><a id="l00053" name="l00053"></a><span class="lineno">   53</span> </div>
<div class="line"><a id="l00074" name="l00074"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#af8fb22bab1956325be5d62282711e3b6">   74</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#af8fb22bab1956325be5d62282711e3b6">setTexture</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* texture, <span class="keywordtype">bool</span> resetRect = <span class="keyword">false</span>);</div>
<div class="line"><a id="l00075" name="l00075"></a><span class="lineno">   75</span> </div>
<div class="line"><a id="l00088" name="l00088"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a2029cc820d1740d14ac794b82525e157">   88</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#a2029cc820d1740d14ac794b82525e157">setTextureRect</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Rect.php">IntRect</a>&amp; rect);</div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno">   89</span> </div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a3506f9b5d916fec14d583d16f23c2485">  105</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#a3506f9b5d916fec14d583d16f23c2485">setFillColor</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; color);</div>
<div class="line"><a id="l00106" name="l00106"></a><span class="lineno">  106</span> </div>
<div class="line"><a id="l00117" name="l00117"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a5978f41ee349ac3c52942996dcb184f7">  117</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#a5978f41ee349ac3c52942996dcb184f7">setOutlineColor</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; color);</div>
<div class="line"><a id="l00118" name="l00118"></a><span class="lineno">  118</span> </div>
<div class="line"><a id="l00132" name="l00132"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a5ad336ad74fc1f567fce3b7e44cf87dc">  132</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#a5ad336ad74fc1f567fce3b7e44cf87dc">setOutlineThickness</a>(<span class="keywordtype">float</span> thickness);</div>
<div class="line"><a id="l00133" name="l00133"></a><span class="lineno">  133</span> </div>
<div class="line"><a id="l00146" name="l00146"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#af4c345931cd651ffb8f7a177446e28f7">  146</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* <a class="code hl_function" href="classsf_1_1Shape.php#af4c345931cd651ffb8f7a177446e28f7">getTexture</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00147" name="l00147"></a><span class="lineno">  147</span> </div>
<div class="line"><a id="l00156" name="l00156"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#ad8adbb54823c8eff1830a938e164daa4">  156</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Rect.php">IntRect</a>&amp; <a class="code hl_function" href="classsf_1_1Shape.php#ad8adbb54823c8eff1830a938e164daa4">getTextureRect</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00157" name="l00157"></a><span class="lineno">  157</span> </div>
<div class="line"><a id="l00166" name="l00166"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#aa5da23e522d2dd11e3e7661c26164c78">  166</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; <a class="code hl_function" href="classsf_1_1Shape.php#aa5da23e522d2dd11e3e7661c26164c78">getFillColor</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00167" name="l00167"></a><span class="lineno">  167</span> </div>
<div class="line"><a id="l00176" name="l00176"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a4aa05b59851468e948ac9682b9c71abb">  176</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; <a class="code hl_function" href="classsf_1_1Shape.php#a4aa05b59851468e948ac9682b9c71abb">getOutlineColor</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00177" name="l00177"></a><span class="lineno">  177</span> </div>
<div class="line"><a id="l00186" name="l00186"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a1d4d5299c573a905e5833fc4dce783a7">  186</a></span>    <span class="keywordtype">float</span> <a class="code hl_function" href="classsf_1_1Shape.php#a1d4d5299c573a905e5833fc4dce783a7">getOutlineThickness</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00187" name="l00187"></a><span class="lineno">  187</span> </div>
<div class="line"><a id="l00196" name="l00196"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#af988dd61a29803fc04d02198e44b5643">  196</a></span>    <span class="keyword">virtual</span> std::size_t <a class="code hl_function" href="classsf_1_1Shape.php#af988dd61a29803fc04d02198e44b5643">getPointCount</a>() <span class="keyword">const</span> = 0;</div>
<div class="line"><a id="l00197" name="l00197"></a><span class="lineno">  197</span> </div>
<div class="line"><a id="l00213" name="l00213"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a40e5d83713eb9f0c999944cf96458085">  213</a></span>    <span class="keyword">virtual</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2f</a> <a class="code hl_function" href="classsf_1_1Shape.php#a40e5d83713eb9f0c999944cf96458085">getPoint</a>(std::size_t index) <span class="keyword">const</span> = 0;</div>
<div class="line"><a id="l00214" name="l00214"></a><span class="lineno">  214</span> </div>
<div class="line"><a id="l00227" name="l00227"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#ae3294bcdf8713d33a862242ecf706443">  227</a></span>    <a class="code hl_class" href="classsf_1_1Rect.php">FloatRect</a> <a class="code hl_function" href="classsf_1_1Shape.php#ae3294bcdf8713d33a862242ecf706443">getLocalBounds</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00228" name="l00228"></a><span class="lineno">  228</span> </div>
<div class="line"><a id="l00248" name="l00248"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#ac0e29425d908d5442060cc44790fe4da">  248</a></span>    <a class="code hl_class" href="classsf_1_1Rect.php">FloatRect</a> <a class="code hl_function" href="classsf_1_1Shape.php#ac0e29425d908d5442060cc44790fe4da">getGlobalBounds</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00249" name="l00249"></a><span class="lineno">  249</span> </div>
<div class="line"><a id="l00250" name="l00250"></a><span class="lineno">  250</span><span class="keyword">protected</span>:</div>
<div class="line"><a id="l00251" name="l00251"></a><span class="lineno">  251</span> </div>
<div class="line"><a id="l00256" name="l00256"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#a413a457f720835b9f5d8e97ca8b80960">  256</a></span>    <a class="code hl_function" href="classsf_1_1Shape.php#a413a457f720835b9f5d8e97ca8b80960">Shape</a>();</div>
<div class="line"><a id="l00257" name="l00257"></a><span class="lineno">  257</span> </div>
<div class="line"><a id="l00266" name="l00266"></a><span class="lineno"><a class="line" href="classsf_1_1Shape.php#adfb2bd966c8edbc5d6c92ebc375e4ac1">  266</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Shape.php#adfb2bd966c8edbc5d6c92ebc375e4ac1">update</a>();</div>
<div class="line"><a id="l00267" name="l00267"></a><span class="lineno">  267</span> </div>
<div class="line"><a id="l00268" name="l00268"></a><span class="lineno">  268</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00269" name="l00269"></a><span class="lineno">  269</span> </div>
<div class="line"><a id="l00277" name="l00277"></a><span class="lineno">  277</span>    <span class="keyword">virtual</span> <span class="keywordtype">void</span> draw(<a class="code hl_class" href="classsf_1_1RenderTarget.php">RenderTarget</a>&amp; target, <a class="code hl_class" href="classsf_1_1RenderStates.php">RenderStates</a> states) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00278" name="l00278"></a><span class="lineno">  278</span> </div>
<div class="line"><a id="l00283" name="l00283"></a><span class="lineno">  283</span>    <span class="keywordtype">void</span> updateFillColors();</div>
<div class="line"><a id="l00284" name="l00284"></a><span class="lineno">  284</span> </div>
<div class="line"><a id="l00289" name="l00289"></a><span class="lineno">  289</span>    <span class="keywordtype">void</span> updateTexCoords();</div>
<div class="line"><a id="l00290" name="l00290"></a><span class="lineno">  290</span> </div>
<div class="line"><a id="l00295" name="l00295"></a><span class="lineno">  295</span>    <span class="keywordtype">void</span> updateOutline();</div>
<div class="line"><a id="l00296" name="l00296"></a><span class="lineno">  296</span> </div>
<div class="line"><a id="l00301" name="l00301"></a><span class="lineno">  301</span>    <span class="keywordtype">void</span> updateOutlineColors();</div>
<div class="line"><a id="l00302" name="l00302"></a><span class="lineno">  302</span> </div>
<div class="line"><a id="l00303" name="l00303"></a><span class="lineno">  303</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00304" name="l00304"></a><span class="lineno">  304</span> </div>
<div class="line"><a id="l00306" name="l00306"></a><span class="lineno">  306</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00308" name="l00308"></a><span class="lineno">  308</span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* m_texture;          </div>
<div class="line"><a id="l00309" name="l00309"></a><span class="lineno">  309</span>    <a class="code hl_class" href="classsf_1_1Rect.php">IntRect</a>        m_textureRect;      </div>
<div class="line"><a id="l00310" name="l00310"></a><span class="lineno">  310</span>    <a class="code hl_class" href="classsf_1_1Color.php">Color</a>          m_fillColor;        </div>
<div class="line"><a id="l00311" name="l00311"></a><span class="lineno">  311</span>    <a class="code hl_class" href="classsf_1_1Color.php">Color</a>          m_outlineColor;     </div>
<div class="line"><a id="l00312" name="l00312"></a><span class="lineno">  312</span>    <span class="keywordtype">float</span>          m_outlineThickness; </div>
<div class="line"><a id="l00313" name="l00313"></a><span class="lineno">  313</span>    <a class="code hl_class" href="classsf_1_1VertexArray.php">VertexArray</a>    m_vertices;         </div>
<div class="line"><a id="l00314" name="l00314"></a><span class="lineno">  314</span>    <a class="code hl_class" href="classsf_1_1VertexArray.php">VertexArray</a>    m_outlineVertices;  </div>
<div class="line"><a id="l00315" name="l00315"></a><span class="lineno">  315</span>    <a class="code hl_class" href="classsf_1_1Rect.php">FloatRect</a>      m_insideBounds;     </div>
<div class="line"><a id="l00316" name="l00316"></a><span class="lineno">  316</span>    <a class="code hl_class" href="classsf_1_1Rect.php">FloatRect</a>      m_bounds;           </div>
<div class="line"><a id="l00317" name="l00317"></a><span class="lineno">  317</span>};</div>
</div>
<div class="line"><a id="l00318" name="l00318"></a><span class="lineno">  318</span> </div>
<div class="line"><a id="l00319" name="l00319"></a><span class="lineno">  319</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00320" name="l00320"></a><span class="lineno">  320</span> </div>
<div class="line"><a id="l00321" name="l00321"></a><span class="lineno">  321</span> </div>
<div class="line"><a id="l00322" name="l00322"></a><span class="lineno">  322</span><span class="preprocessor">#endif </span><span class="comment">// SFML_SHAPE_HPP</span></div>
<div class="line"><a id="l00323" name="l00323"></a><span class="lineno">  323</span> </div>
<div class="line"><a id="l00324" name="l00324"></a><span class="lineno">  324</span> </div>
<div class="ttc" id="aclasssf_1_1Color_php"><div class="ttname"><a href="classsf_1_1Color.php">sf::Color</a></div><div class="ttdoc">Utility class for manipulating RGBA colors.</div><div class="ttdef"><b>Definition</b> <a href="Color_8hpp_source.php#l00040">Color.hpp:41</a></div></div>
<div class="ttc" id="aclasssf_1_1Drawable_php"><div class="ttname"><a href="classsf_1_1Drawable.php">sf::Drawable</a></div><div class="ttdoc">Abstract base class for objects that can be drawn to a render target.</div><div class="ttdef"><b>Definition</b> <a href="Drawable_8hpp_source.php#l00044">Drawable.hpp:45</a></div></div>
<div class="ttc" id="aclasssf_1_1Rect_php"><div class="ttname"><a href="classsf_1_1Rect.php">sf::Rect&lt; int &gt;</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php"><div class="ttname"><a href="classsf_1_1RenderStates.php">sf::RenderStates</a></div><div class="ttdoc">Define the states used for drawing to a RenderTarget.</div><div class="ttdef"><b>Definition</b> <a href="RenderStates_8hpp_source.php#l00045">RenderStates.hpp:46</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderTarget_php"><div class="ttname"><a href="classsf_1_1RenderTarget.php">sf::RenderTarget</a></div><div class="ttdoc">Base class for all render targets (window, texture, ...)</div><div class="ttdef"><b>Definition</b> <a href="RenderTarget_8hpp_source.php#l00052">RenderTarget.hpp:53</a></div></div>
<div class="ttc" id="aclasssf_1_1Shape_php"><div class="ttname"><a href="classsf_1_1Shape.php">sf::Shape</a></div><div class="ttdoc">Base class for textured shapes with outline.</div><div class="ttdef"><b>Definition</b> <a href="#l00044">Shape.hpp:45</a></div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a1d4d5299c573a905e5833fc4dce783a7"><div class="ttname"><a href="classsf_1_1Shape.php#a1d4d5299c573a905e5833fc4dce783a7">sf::Shape::getOutlineThickness</a></div><div class="ttdeci">float getOutlineThickness() const</div><div class="ttdoc">Get the outline thickness of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a2029cc820d1740d14ac794b82525e157"><div class="ttname"><a href="classsf_1_1Shape.php#a2029cc820d1740d14ac794b82525e157">sf::Shape::setTextureRect</a></div><div class="ttdeci">void setTextureRect(const IntRect &amp;rect)</div><div class="ttdoc">Set the sub-rectangle of the texture that the shape will display.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a2262aceb9df52d4275c19633592f19bf"><div class="ttname"><a href="classsf_1_1Shape.php#a2262aceb9df52d4275c19633592f19bf">sf::Shape::~Shape</a></div><div class="ttdeci">virtual ~Shape()</div><div class="ttdoc">Virtual destructor.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a3506f9b5d916fec14d583d16f23c2485"><div class="ttname"><a href="classsf_1_1Shape.php#a3506f9b5d916fec14d583d16f23c2485">sf::Shape::setFillColor</a></div><div class="ttdeci">void setFillColor(const Color &amp;color)</div><div class="ttdoc">Set the fill color of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a40e5d83713eb9f0c999944cf96458085"><div class="ttname"><a href="classsf_1_1Shape.php#a40e5d83713eb9f0c999944cf96458085">sf::Shape::getPoint</a></div><div class="ttdeci">virtual Vector2f getPoint(std::size_t index) const =0</div><div class="ttdoc">Get a point of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a413a457f720835b9f5d8e97ca8b80960"><div class="ttname"><a href="classsf_1_1Shape.php#a413a457f720835b9f5d8e97ca8b80960">sf::Shape::Shape</a></div><div class="ttdeci">Shape()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a4aa05b59851468e948ac9682b9c71abb"><div class="ttname"><a href="classsf_1_1Shape.php#a4aa05b59851468e948ac9682b9c71abb">sf::Shape::getOutlineColor</a></div><div class="ttdeci">const Color &amp; getOutlineColor() const</div><div class="ttdoc">Get the outline color of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a5978f41ee349ac3c52942996dcb184f7"><div class="ttname"><a href="classsf_1_1Shape.php#a5978f41ee349ac3c52942996dcb184f7">sf::Shape::setOutlineColor</a></div><div class="ttdeci">void setOutlineColor(const Color &amp;color)</div><div class="ttdoc">Set the outline color of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_a5ad336ad74fc1f567fce3b7e44cf87dc"><div class="ttname"><a href="classsf_1_1Shape.php#a5ad336ad74fc1f567fce3b7e44cf87dc">sf::Shape::setOutlineThickness</a></div><div class="ttdeci">void setOutlineThickness(float thickness)</div><div class="ttdoc">Set the thickness of the shape's outline.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_aa5da23e522d2dd11e3e7661c26164c78"><div class="ttname"><a href="classsf_1_1Shape.php#aa5da23e522d2dd11e3e7661c26164c78">sf::Shape::getFillColor</a></div><div class="ttdeci">const Color &amp; getFillColor() const</div><div class="ttdoc">Get the fill color of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_ac0e29425d908d5442060cc44790fe4da"><div class="ttname"><a href="classsf_1_1Shape.php#ac0e29425d908d5442060cc44790fe4da">sf::Shape::getGlobalBounds</a></div><div class="ttdeci">FloatRect getGlobalBounds() const</div><div class="ttdoc">Get the global (non-minimal) bounding rectangle of the entity.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_ad8adbb54823c8eff1830a938e164daa4"><div class="ttname"><a href="classsf_1_1Shape.php#ad8adbb54823c8eff1830a938e164daa4">sf::Shape::getTextureRect</a></div><div class="ttdeci">const IntRect &amp; getTextureRect() const</div><div class="ttdoc">Get the sub-rectangle of the texture displayed by the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_adfb2bd966c8edbc5d6c92ebc375e4ac1"><div class="ttname"><a href="classsf_1_1Shape.php#adfb2bd966c8edbc5d6c92ebc375e4ac1">sf::Shape::update</a></div><div class="ttdeci">void update()</div><div class="ttdoc">Recompute the internal geometry of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_ae3294bcdf8713d33a862242ecf706443"><div class="ttname"><a href="classsf_1_1Shape.php#ae3294bcdf8713d33a862242ecf706443">sf::Shape::getLocalBounds</a></div><div class="ttdeci">FloatRect getLocalBounds() const</div><div class="ttdoc">Get the local bounding rectangle of the entity.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_af4c345931cd651ffb8f7a177446e28f7"><div class="ttname"><a href="classsf_1_1Shape.php#af4c345931cd651ffb8f7a177446e28f7">sf::Shape::getTexture</a></div><div class="ttdeci">const Texture * getTexture() const</div><div class="ttdoc">Get the source texture of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_af8fb22bab1956325be5d62282711e3b6"><div class="ttname"><a href="classsf_1_1Shape.php#af8fb22bab1956325be5d62282711e3b6">sf::Shape::setTexture</a></div><div class="ttdeci">void setTexture(const Texture *texture, bool resetRect=false)</div><div class="ttdoc">Change the source texture of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php_af988dd61a29803fc04d02198e44b5643"><div class="ttname"><a href="classsf_1_1Shape.php#af988dd61a29803fc04d02198e44b5643">sf::Shape::getPointCount</a></div><div class="ttdeci">virtual std::size_t getPointCount() const =0</div><div class="ttdoc">Get the total number of points of the shape.</div></div>
<div class="ttc" id="aclasssf_1_1Texture_php"><div class="ttname"><a href="classsf_1_1Texture.php">sf::Texture</a></div><div class="ttdoc">Image living on the graphics card that can be used for drawing.</div><div class="ttdef"><b>Definition</b> <a href="Texture_8hpp_source.php#l00048">Texture.hpp:49</a></div></div>
<div class="ttc" id="aclasssf_1_1Transformable_php"><div class="ttname"><a href="classsf_1_1Transformable.php">sf::Transformable</a></div><div class="ttdoc">Decomposed transform defined by a position, a rotation and a scale.</div><div class="ttdef"><b>Definition</b> <a href="Transformable_8hpp_source.php#l00041">Transformable.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; float &gt;</a></div></div>
<div class="ttc" id="aclasssf_1_1VertexArray_php"><div class="ttname"><a href="classsf_1_1VertexArray.php">sf::VertexArray</a></div><div class="ttdoc">Define a set of one or more 2D primitives.</div><div class="ttdef"><b>Definition</b> <a href="VertexArray_8hpp_source.php#l00045">VertexArray.hpp:46</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
