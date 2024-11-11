<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Image.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
  <div class="headertitle"><div class="title">Image.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_IMAGE_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_IMAGE_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Graphics/Color.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span><span class="preprocessor">#include &lt;string&gt;</span></div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span><span class="preprocessor">#include &lt;vector&gt;</span></div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span> </div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span> </div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span>{</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span><span class="keyword">class </span>InputStream;</div>
<div class="line"><a id="l00041" name="l00041"></a><span class="lineno">   41</span> </div>
<div class="foldopen" id="foldopen00046" data-start="{" data-end="};">
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php">   46</a></span><span class="keyword">class </span>SFML_GRAPHICS_API <a class="code hl_class" href="classsf_1_1Image.php">Image</a></div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span>{</div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00049" name="l00049"></a><span class="lineno">   49</span> </div>
<div class="line"><a id="l00056" name="l00056"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#abb4caf3cb167b613345ebe36fc883f12">   56</a></span>    <a class="code hl_function" href="classsf_1_1Image.php#abb4caf3cb167b613345ebe36fc883f12">Image</a>();</div>
<div class="line"><a id="l00057" name="l00057"></a><span class="lineno">   57</span> </div>
<div class="line"><a id="l00062" name="l00062"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a0ba22a38e6c96e3b37dd88198046de83">   62</a></span>    <a class="code hl_function" href="classsf_1_1Image.php#a0ba22a38e6c96e3b37dd88198046de83">~Image</a>();</div>
<div class="line"><a id="l00063" name="l00063"></a><span class="lineno">   63</span> </div>
<div class="line"><a id="l00072" name="l00072"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a2a67930e2fd9ad97cf004e918cf5832b">   72</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a2a67930e2fd9ad97cf004e918cf5832b">create</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; color = <a class="code hl_class" href="classsf_1_1Color.php">Color</a>(0, 0, 0));</div>
<div class="line"><a id="l00073" name="l00073"></a><span class="lineno">   73</span> </div>
<div class="line"><a id="l00087" name="l00087"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a1c2b960ea12bdbb29e80934ce5268ebf">   87</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a1c2b960ea12bdbb29e80934ce5268ebf">create</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height, <span class="keyword">const</span> Uint8* pixels);</div>
<div class="line"><a id="l00088" name="l00088"></a><span class="lineno">   88</span> </div>
<div class="line"><a id="l00104" name="l00104"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a9e4f2aa8e36d0cabde5ed5a4ef80290b">  104</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Image.php#a9e4f2aa8e36d0cabde5ed5a4ef80290b">loadFromFile</a>(<span class="keyword">const</span> std::string&amp; filename);</div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno">  105</span> </div>
<div class="line"><a id="l00122" name="l00122"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#aaa6c7afa5851a51cec6ab438faa7354c">  122</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Image.php#aaa6c7afa5851a51cec6ab438faa7354c">loadFromMemory</a>(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t size);</div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno">  123</span> </div>
<div class="line"><a id="l00139" name="l00139"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a21122ded0e8368bb06ed3b9acfbfb501">  139</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Image.php#a21122ded0e8368bb06ed3b9acfbfb501">loadFromStream</a>(<a class="code hl_class" href="classsf_1_1InputStream.php">InputStream</a>&amp; stream);</div>
<div class="line"><a id="l00140" name="l00140"></a><span class="lineno">  140</span> </div>
<div class="line"><a id="l00156" name="l00156"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a51537fb667f47cbe80395cfd7f9e72a4">  156</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Image.php#a51537fb667f47cbe80395cfd7f9e72a4">saveToFile</a>(<span class="keyword">const</span> std::string&amp; filename) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00157" name="l00157"></a><span class="lineno">  157</span> </div>
<div class="line"><a id="l00174" name="l00174"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#ae33432a31031ee501674efa9b6dc3f40">  174</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Image.php#ae33432a31031ee501674efa9b6dc3f40">saveToMemory</a>(std::vector&lt;sf::Uint8&gt;&amp; output, <span class="keyword">const</span> std::string&amp; format) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00175" name="l00175"></a><span class="lineno">  175</span> </div>
<div class="line"><a id="l00182" name="l00182"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a85409951b05369813069ed64393391ce">  182</a></span>    <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2u</a> <a class="code hl_function" href="classsf_1_1Image.php#a85409951b05369813069ed64393391ce">getSize</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00183" name="l00183"></a><span class="lineno">  183</span> </div>
<div class="line"><a id="l00195" name="l00195"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a22f13f8c242a6b38eb73cc176b37ae34">  195</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a22f13f8c242a6b38eb73cc176b37ae34">createMaskFromColor</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; color, Uint8 alpha = 0);</div>
<div class="line"><a id="l00196" name="l00196"></a><span class="lineno">  196</span> </div>
<div class="line"><a id="l00221" name="l00221"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#ab2fa337c956f85f93377dcb52153a45a">  221</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#ab2fa337c956f85f93377dcb52153a45a">copy</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Image.php">Image</a>&amp; source, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> destX, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> destY, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Rect.php">IntRect</a>&amp; sourceRect = <a class="code hl_class" href="classsf_1_1Rect.php">IntRect</a>(0, 0, 0, 0), <span class="keywordtype">bool</span> applyAlpha = <span class="keyword">false</span>);</div>
<div class="line"><a id="l00222" name="l00222"></a><span class="lineno">  222</span> </div>
<div class="line"><a id="l00237" name="l00237"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a9fd329b8cd7d4439e07fb5d3bb2d9744">  237</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a9fd329b8cd7d4439e07fb5d3bb2d9744">setPixel</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> x, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> y, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Color.php">Color</a>&amp; color);</div>
<div class="line"><a id="l00238" name="l00238"></a><span class="lineno">  238</span> </div>
<div class="line"><a id="l00254" name="l00254"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#acf278760458433b2c3626a6980388a95">  254</a></span>    <a class="code hl_class" href="classsf_1_1Color.php">Color</a> <a class="code hl_function" href="classsf_1_1Image.php#acf278760458433b2c3626a6980388a95">getPixel</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> x, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> y) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00255" name="l00255"></a><span class="lineno">  255</span> </div>
<div class="line"><a id="l00269" name="l00269"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a2f49e69b6c6257b19b4d911993075c40">  269</a></span>    <span class="keyword">const</span> Uint8* <a class="code hl_function" href="classsf_1_1Image.php#a2f49e69b6c6257b19b4d911993075c40">getPixelsPtr</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00270" name="l00270"></a><span class="lineno">  270</span> </div>
<div class="line"><a id="l00275" name="l00275"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a57168e7bc29190e08bbd6c9c19f4bb2c">  275</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a57168e7bc29190e08bbd6c9c19f4bb2c">flipHorizontally</a>();</div>
<div class="line"><a id="l00276" name="l00276"></a><span class="lineno">  276</span> </div>
<div class="line"><a id="l00281" name="l00281"></a><span class="lineno"><a class="line" href="classsf_1_1Image.php#a78a702a7e49d1de2dec9894da99d279c">  281</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Image.php#a78a702a7e49d1de2dec9894da99d279c">flipVertically</a>();</div>
<div class="line"><a id="l00282" name="l00282"></a><span class="lineno">  282</span> </div>
<div class="line"><a id="l00283" name="l00283"></a><span class="lineno">  283</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00284" name="l00284"></a><span class="lineno">  284</span> </div>
<div class="line"><a id="l00286" name="l00286"></a><span class="lineno">  286</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00288" name="l00288"></a><span class="lineno">  288</span>    <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2u</a>           m_size;   </div>
<div class="line"><a id="l00289" name="l00289"></a><span class="lineno">  289</span>    std::vector&lt;Uint8&gt; m_pixels; </div>
<div class="line"><a id="l00290" name="l00290"></a><span class="lineno">  290</span>};</div>
</div>
<div class="line"><a id="l00291" name="l00291"></a><span class="lineno">  291</span> </div>
<div class="line"><a id="l00292" name="l00292"></a><span class="lineno">  292</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00293" name="l00293"></a><span class="lineno">  293</span> </div>
<div class="line"><a id="l00294" name="l00294"></a><span class="lineno">  294</span> </div>
<div class="line"><a id="l00295" name="l00295"></a><span class="lineno">  295</span><span class="preprocessor">#endif </span><span class="comment">// SFML_IMAGE_HPP</span></div>
<div class="line"><a id="l00296" name="l00296"></a><span class="lineno">  296</span> </div>
<div class="line"><a id="l00297" name="l00297"></a><span class="lineno">  297</span> </div>
<div class="ttc" id="aclasssf_1_1Color_php"><div class="ttname"><a href="classsf_1_1Color.php">sf::Color</a></div><div class="ttdoc">Utility class for manipulating RGBA colors.</div><div class="ttdef"><b>Definition</b> <a href="Color_8hpp_source.php#l00040">Color.hpp:41</a></div></div>
<div class="ttc" id="aclasssf_1_1Image_php"><div class="ttname"><a href="classsf_1_1Image.php">sf::Image</a></div><div class="ttdoc">Class for loading, manipulating and saving images.</div><div class="ttdef"><b>Definition</b> <a href="#l00046">Image.hpp:47</a></div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a0ba22a38e6c96e3b37dd88198046de83"><div class="ttname"><a href="classsf_1_1Image.php#a0ba22a38e6c96e3b37dd88198046de83">sf::Image::~Image</a></div><div class="ttdeci">~Image()</div><div class="ttdoc">Destructor.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a1c2b960ea12bdbb29e80934ce5268ebf"><div class="ttname"><a href="classsf_1_1Image.php#a1c2b960ea12bdbb29e80934ce5268ebf">sf::Image::create</a></div><div class="ttdeci">void create(unsigned int width, unsigned int height, const Uint8 *pixels)</div><div class="ttdoc">Create the image from an array of pixels.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a21122ded0e8368bb06ed3b9acfbfb501"><div class="ttname"><a href="classsf_1_1Image.php#a21122ded0e8368bb06ed3b9acfbfb501">sf::Image::loadFromStream</a></div><div class="ttdeci">bool loadFromStream(InputStream &amp;stream)</div><div class="ttdoc">Load the image from a custom stream.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a22f13f8c242a6b38eb73cc176b37ae34"><div class="ttname"><a href="classsf_1_1Image.php#a22f13f8c242a6b38eb73cc176b37ae34">sf::Image::createMaskFromColor</a></div><div class="ttdeci">void createMaskFromColor(const Color &amp;color, Uint8 alpha=0)</div><div class="ttdoc">Create a transparency mask from a specified color-key.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a2a67930e2fd9ad97cf004e918cf5832b"><div class="ttname"><a href="classsf_1_1Image.php#a2a67930e2fd9ad97cf004e918cf5832b">sf::Image::create</a></div><div class="ttdeci">void create(unsigned int width, unsigned int height, const Color &amp;color=Color(0, 0, 0))</div><div class="ttdoc">Create the image and fill it with a unique color.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a2f49e69b6c6257b19b4d911993075c40"><div class="ttname"><a href="classsf_1_1Image.php#a2f49e69b6c6257b19b4d911993075c40">sf::Image::getPixelsPtr</a></div><div class="ttdeci">const Uint8 * getPixelsPtr() const</div><div class="ttdoc">Get a read-only pointer to the array of pixels.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a51537fb667f47cbe80395cfd7f9e72a4"><div class="ttname"><a href="classsf_1_1Image.php#a51537fb667f47cbe80395cfd7f9e72a4">sf::Image::saveToFile</a></div><div class="ttdeci">bool saveToFile(const std::string &amp;filename) const</div><div class="ttdoc">Save the image to a file on disk.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a57168e7bc29190e08bbd6c9c19f4bb2c"><div class="ttname"><a href="classsf_1_1Image.php#a57168e7bc29190e08bbd6c9c19f4bb2c">sf::Image::flipHorizontally</a></div><div class="ttdeci">void flipHorizontally()</div><div class="ttdoc">Flip the image horizontally (left &lt;-&gt; right)</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a78a702a7e49d1de2dec9894da99d279c"><div class="ttname"><a href="classsf_1_1Image.php#a78a702a7e49d1de2dec9894da99d279c">sf::Image::flipVertically</a></div><div class="ttdeci">void flipVertically()</div><div class="ttdoc">Flip the image vertically (top &lt;-&gt; bottom)</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a85409951b05369813069ed64393391ce"><div class="ttname"><a href="classsf_1_1Image.php#a85409951b05369813069ed64393391ce">sf::Image::getSize</a></div><div class="ttdeci">Vector2u getSize() const</div><div class="ttdoc">Return the size (width and height) of the image.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a9e4f2aa8e36d0cabde5ed5a4ef80290b"><div class="ttname"><a href="classsf_1_1Image.php#a9e4f2aa8e36d0cabde5ed5a4ef80290b">sf::Image::loadFromFile</a></div><div class="ttdeci">bool loadFromFile(const std::string &amp;filename)</div><div class="ttdoc">Load the image from a file on disk.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_a9fd329b8cd7d4439e07fb5d3bb2d9744"><div class="ttname"><a href="classsf_1_1Image.php#a9fd329b8cd7d4439e07fb5d3bb2d9744">sf::Image::setPixel</a></div><div class="ttdeci">void setPixel(unsigned int x, unsigned int y, const Color &amp;color)</div><div class="ttdoc">Change the color of a pixel.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_aaa6c7afa5851a51cec6ab438faa7354c"><div class="ttname"><a href="classsf_1_1Image.php#aaa6c7afa5851a51cec6ab438faa7354c">sf::Image::loadFromMemory</a></div><div class="ttdeci">bool loadFromMemory(const void *data, std::size_t size)</div><div class="ttdoc">Load the image from a file in memory.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_ab2fa337c956f85f93377dcb52153a45a"><div class="ttname"><a href="classsf_1_1Image.php#ab2fa337c956f85f93377dcb52153a45a">sf::Image::copy</a></div><div class="ttdeci">void copy(const Image &amp;source, unsigned int destX, unsigned int destY, const IntRect &amp;sourceRect=IntRect(0, 0, 0, 0), bool applyAlpha=false)</div><div class="ttdoc">Copy pixels from another image onto this one.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_abb4caf3cb167b613345ebe36fc883f12"><div class="ttname"><a href="classsf_1_1Image.php#abb4caf3cb167b613345ebe36fc883f12">sf::Image::Image</a></div><div class="ttdeci">Image()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_acf278760458433b2c3626a6980388a95"><div class="ttname"><a href="classsf_1_1Image.php#acf278760458433b2c3626a6980388a95">sf::Image::getPixel</a></div><div class="ttdeci">Color getPixel(unsigned int x, unsigned int y) const</div><div class="ttdoc">Get the color of a pixel.</div></div>
<div class="ttc" id="aclasssf_1_1Image_php_ae33432a31031ee501674efa9b6dc3f40"><div class="ttname"><a href="classsf_1_1Image.php#ae33432a31031ee501674efa9b6dc3f40">sf::Image::saveToMemory</a></div><div class="ttdeci">bool saveToMemory(std::vector&lt; sf::Uint8 &gt; &amp;output, const std::string &amp;format) const</div><div class="ttdoc">Save the image to a buffer in memory.</div></div>
<div class="ttc" id="aclasssf_1_1InputStream_php"><div class="ttname"><a href="classsf_1_1InputStream.php">sf::InputStream</a></div><div class="ttdoc">Abstract class for custom file input streams.</div><div class="ttdef"><b>Definition</b> <a href="InputStream_8hpp_source.php#l00041">InputStream.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1Rect_php"><div class="ttname"><a href="classsf_1_1Rect.php">sf::Rect&lt; int &gt;</a></div></div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; unsigned int &gt;</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>