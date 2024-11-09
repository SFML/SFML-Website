<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'RenderStates.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
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
  <div class="headertitle"><div class="title">RenderStates.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_RENDERSTATES_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_RENDERSTATES_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Graphics/BlendMode.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span>{</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span><span class="keyword">class </span>Shader;</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span><span class="keyword">class </span>Texture;</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span> </div>
<div class="foldopen" id="foldopen00045" data-start="{" data-end="};">
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php">   45</a></span><span class="keyword">class </span>SFML_GRAPHICS_API <a class="code hl_class" href="classsf_1_1RenderStates.php">RenderStates</a></div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span>{</div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span> </div>
<div class="line"><a id="l00061" name="l00061"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a885bf14070d0d5391f062f62b270b7d0">   61</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#a885bf14070d0d5391f062f62b270b7d0">RenderStates</a>();</div>
<div class="line"><a id="l00062" name="l00062"></a><span class="lineno">   62</span> </div>
<div class="line"><a id="l00069" name="l00069"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#acac8830a593c8a4523ac2fdf3cac8a01">   69</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#acac8830a593c8a4523ac2fdf3cac8a01">RenderStates</a>(<span class="keyword">const</span> <a class="code hl_class" href="structsf_1_1BlendMode.php">BlendMode</a>&amp; theBlendMode);</div>
<div class="line"><a id="l00070" name="l00070"></a><span class="lineno">   70</span> </div>
<div class="line"><a id="l00077" name="l00077"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a3e99cad6ab05971d40357949930ed890">   77</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#a3e99cad6ab05971d40357949930ed890">RenderStates</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Transform.php">Transform</a>&amp; theTransform);</div>
<div class="line"><a id="l00078" name="l00078"></a><span class="lineno">   78</span> </div>
<div class="line"><a id="l00085" name="l00085"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a8f4ca3be0e27dafea0c4ab8547439bb1">   85</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#a8f4ca3be0e27dafea0c4ab8547439bb1">RenderStates</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* theTexture);</div>
<div class="line"><a id="l00086" name="l00086"></a><span class="lineno">   86</span> </div>
<div class="line"><a id="l00093" name="l00093"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a39f94233f464739d8d8522f3aefe97d0">   93</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#a39f94233f464739d8d8522f3aefe97d0">RenderStates</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Shader.php">Shader</a>* theShader);</div>
<div class="line"><a id="l00094" name="l00094"></a><span class="lineno">   94</span> </div>
<div class="line"><a id="l00104" name="l00104"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#ab5eda13cd8c79c74eba3b1b0df817d67">  104</a></span>    <a class="code hl_function" href="classsf_1_1RenderStates.php#ab5eda13cd8c79c74eba3b1b0df817d67">RenderStates</a>(<span class="keyword">const</span> <a class="code hl_class" href="structsf_1_1BlendMode.php">BlendMode</a>&amp; theBlendMode, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Transform.php">Transform</a>&amp; theTransform,</div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno">  105</span>                 <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* theTexture, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Shader.php">Shader</a>* theShader);</div>
<div class="line"><a id="l00106" name="l00106"></a><span class="lineno">  106</span> </div>
<div class="line"><a id="l00108" name="l00108"></a><span class="lineno">  108</span>    <span class="comment">// Static member data</span></div>
<div class="line"><a id="l00110" name="l00110"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">  110</a></span>    <span class="keyword">static</span> <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1RenderStates.php">RenderStates</a> <a class="code hl_variable" href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">Default</a>; </div>
<div class="line"><a id="l00111" name="l00111"></a><span class="lineno">  111</span> </div>
<div class="line"><a id="l00113" name="l00113"></a><span class="lineno">  113</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00115" name="l00115"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#ad6ac87f1b5006dae7ebfee4b5d40f5a8">  115</a></span>    <a class="code hl_class" href="structsf_1_1BlendMode.php">BlendMode</a>      <a class="code hl_variable" href="classsf_1_1RenderStates.php#ad6ac87f1b5006dae7ebfee4b5d40f5a8">blendMode</a>; </div>
<div class="line"><a id="l00116" name="l00116"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a1f737981a0f2f0d4bb8dac866a8d1149">  116</a></span>    <a class="code hl_class" href="classsf_1_1Transform.php">Transform</a>      <a class="code hl_variable" href="classsf_1_1RenderStates.php#a1f737981a0f2f0d4bb8dac866a8d1149">transform</a>; </div>
<div class="line"><a id="l00117" name="l00117"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#a457fc5a41731889de9cf39cf9b3436c3">  117</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Texture.php">Texture</a>* <a class="code hl_variable" href="classsf_1_1RenderStates.php#a457fc5a41731889de9cf39cf9b3436c3">texture</a>;   </div>
<div class="line"><a id="l00118" name="l00118"></a><span class="lineno"><a class="line" href="classsf_1_1RenderStates.php#ad4f79ecdd0c60ed0d24fbe555b221bd8">  118</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Shader.php">Shader</a>*  <a class="code hl_variable" href="classsf_1_1RenderStates.php#ad4f79ecdd0c60ed0d24fbe555b221bd8">shader</a>;    </div>
<div class="line"><a id="l00119" name="l00119"></a><span class="lineno">  119</span>};</div>
</div>
<div class="line"><a id="l00120" name="l00120"></a><span class="lineno">  120</span> </div>
<div class="line"><a id="l00121" name="l00121"></a><span class="lineno">  121</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00122" name="l00122"></a><span class="lineno">  122</span> </div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno">  123</span> </div>
<div class="line"><a id="l00124" name="l00124"></a><span class="lineno">  124</span><span class="preprocessor">#endif </span><span class="comment">// SFML_RENDERSTATES_HPP</span></div>
<div class="line"><a id="l00125" name="l00125"></a><span class="lineno">  125</span> </div>
<div class="line"><a id="l00126" name="l00126"></a><span class="lineno">  126</span> </div>
<div class="ttc" id="aclasssf_1_1RenderStates_php"><div class="ttname"><a href="classsf_1_1RenderStates.php">sf::RenderStates</a></div><div class="ttdoc">Define the states used for drawing to a RenderTarget.</div><div class="ttdef"><b>Definition</b> <a href="#l00045">RenderStates.hpp:46</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a1f737981a0f2f0d4bb8dac866a8d1149"><div class="ttname"><a href="classsf_1_1RenderStates.php#a1f737981a0f2f0d4bb8dac866a8d1149">sf::RenderStates::transform</a></div><div class="ttdeci">Transform transform</div><div class="ttdoc">Transform.</div><div class="ttdef"><b>Definition</b> <a href="#l00116">RenderStates.hpp:116</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a39f94233f464739d8d8522f3aefe97d0"><div class="ttname"><a href="classsf_1_1RenderStates.php#a39f94233f464739d8d8522f3aefe97d0">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates(const Shader *theShader)</div><div class="ttdoc">Construct a default set of render states with a custom shader.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a3e99cad6ab05971d40357949930ed890"><div class="ttname"><a href="classsf_1_1RenderStates.php#a3e99cad6ab05971d40357949930ed890">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates(const Transform &amp;theTransform)</div><div class="ttdoc">Construct a default set of render states with a custom transform.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a457fc5a41731889de9cf39cf9b3436c3"><div class="ttname"><a href="classsf_1_1RenderStates.php#a457fc5a41731889de9cf39cf9b3436c3">sf::RenderStates::texture</a></div><div class="ttdeci">const Texture * texture</div><div class="ttdoc">Texture.</div><div class="ttdef"><b>Definition</b> <a href="#l00117">RenderStates.hpp:117</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a885bf14070d0d5391f062f62b270b7d0"><div class="ttname"><a href="classsf_1_1RenderStates.php#a885bf14070d0d5391f062f62b270b7d0">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_a8f4ca3be0e27dafea0c4ab8547439bb1"><div class="ttname"><a href="classsf_1_1RenderStates.php#a8f4ca3be0e27dafea0c4ab8547439bb1">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates(const Texture *theTexture)</div><div class="ttdoc">Construct a default set of render states with a custom texture.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_ab5eda13cd8c79c74eba3b1b0df817d67"><div class="ttname"><a href="classsf_1_1RenderStates.php#ab5eda13cd8c79c74eba3b1b0df817d67">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates(const BlendMode &amp;theBlendMode, const Transform &amp;theTransform, const Texture *theTexture, const Shader *theShader)</div><div class="ttdoc">Construct a set of render states with all its attributes.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_acac8830a593c8a4523ac2fdf3cac8a01"><div class="ttname"><a href="classsf_1_1RenderStates.php#acac8830a593c8a4523ac2fdf3cac8a01">sf::RenderStates::RenderStates</a></div><div class="ttdeci">RenderStates(const BlendMode &amp;theBlendMode)</div><div class="ttdoc">Construct a default set of render states with a custom blend mode.</div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_ad29672df29f19ce50c3021d95f2bb062"><div class="ttname"><a href="classsf_1_1RenderStates.php#ad29672df29f19ce50c3021d95f2bb062">sf::RenderStates::Default</a></div><div class="ttdeci">static const RenderStates Default</div><div class="ttdoc">Special instance holding the default render states.</div><div class="ttdef"><b>Definition</b> <a href="#l00110">RenderStates.hpp:110</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_ad4f79ecdd0c60ed0d24fbe555b221bd8"><div class="ttname"><a href="classsf_1_1RenderStates.php#ad4f79ecdd0c60ed0d24fbe555b221bd8">sf::RenderStates::shader</a></div><div class="ttdeci">const Shader * shader</div><div class="ttdoc">Shader.</div><div class="ttdef"><b>Definition</b> <a href="#l00118">RenderStates.hpp:118</a></div></div>
<div class="ttc" id="aclasssf_1_1RenderStates_php_ad6ac87f1b5006dae7ebfee4b5d40f5a8"><div class="ttname"><a href="classsf_1_1RenderStates.php#ad6ac87f1b5006dae7ebfee4b5d40f5a8">sf::RenderStates::blendMode</a></div><div class="ttdeci">BlendMode blendMode</div><div class="ttdoc">Blending mode.</div><div class="ttdef"><b>Definition</b> <a href="#l00115">RenderStates.hpp:115</a></div></div>
<div class="ttc" id="aclasssf_1_1Shader_php"><div class="ttname"><a href="classsf_1_1Shader.php">sf::Shader</a></div><div class="ttdoc">Shader class (vertex, geometry and fragment)</div><div class="ttdef"><b>Definition</b> <a href="Shader_8hpp_source.php#l00052">Shader.hpp:53</a></div></div>
<div class="ttc" id="aclasssf_1_1Texture_php"><div class="ttname"><a href="classsf_1_1Texture.php">sf::Texture</a></div><div class="ttdoc">Image living on the graphics card that can be used for drawing.</div><div class="ttdef"><b>Definition</b> <a href="Texture_8hpp_source.php#l00048">Texture.hpp:49</a></div></div>
<div class="ttc" id="aclasssf_1_1Transform_php"><div class="ttname"><a href="classsf_1_1Transform.php">sf::Transform</a></div><div class="ttdoc">Define a 3x3 transform matrix.</div><div class="ttdef"><b>Definition</b> <a href="Transform_8hpp_source.php#l00042">Transform.hpp:43</a></div></div>
<div class="ttc" id="astructsf_1_1BlendMode_php"><div class="ttname"><a href="structsf_1_1BlendMode.php">sf::BlendMode</a></div><div class="ttdoc">Blending modes for drawing.</div><div class="ttdef"><b>Definition</b> <a href="BlendMode_8hpp_source.php#l00041">BlendMode.hpp:42</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
