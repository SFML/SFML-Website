<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Glsl.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
  <div class="headertitle"><div class="title">Glsl.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_GLSL_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_GLSL_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Graphics/Color.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span><span class="preprocessor">#include &lt;SFML/System/Vector3.hpp&gt;</span></div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span> </div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span>{</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span><span class="keyword">namespace </span>priv</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span>{</div>
<div class="line"><a id="l00041" name="l00041"></a><span class="lineno">   41</span>    <span class="comment">// Forward declarations</span></div>
<div class="line"><a id="l00042" name="l00042"></a><span class="lineno">   42</span>    <span class="keyword">template</span> &lt;std::<span class="keywordtype">size_t</span> Columns, std::<span class="keywordtype">size_t</span> Rows&gt;</div>
<div class="line"><a id="l00043" name="l00043"></a><span class="lineno">   43</span>    <span class="keyword">struct </span>Matrix;</div>
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno">   44</span> </div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span>    <span class="keyword">template</span> &lt;<span class="keyword">typename</span> T&gt;</div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span>    <span class="keyword">struct </span>Vector4;</div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span> </div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span><span class="preprocessor">#include &lt;SFML/Graphics/Glsl.inl&gt;</span></div>
<div class="line"><a id="l00049" name="l00049"></a><span class="lineno">   49</span> </div>
<div class="line"><a id="l00050" name="l00050"></a><span class="lineno">   50</span>} <span class="comment">// namespace priv</span></div>
<div class="line"><a id="l00051" name="l00051"></a><span class="lineno">   51</span> </div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno">   52</span> </div>
<div class="foldopen" id="foldopen00057" data-start="{" data-end="}">
<div class="line"><a id="l00057" name="l00057"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php">   57</a></span><span class="keyword">namespace </span>Glsl</div>
<div class="line"><a id="l00058" name="l00058"></a><span class="lineno">   58</span>{</div>
<div class="line"><a id="l00059" name="l00059"></a><span class="lineno">   59</span> </div>
<div class="line"><a id="l00064" name="l00064"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#adeed356d346d87634b4c197a530e4edf">   64</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2&lt;float&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#adeed356d346d87634b4c197a530e4edf">Vec2</a>;</div>
<div class="line"><a id="l00065" name="l00065"></a><span class="lineno">   65</span> </div>
<div class="line"><a id="l00070" name="l00070"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#aab803ee70c4b7bfcd63ec09e10408fd3">   70</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2&lt;int&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#aab803ee70c4b7bfcd63ec09e10408fd3">Ivec2</a>;</div>
<div class="line"><a id="l00071" name="l00071"></a><span class="lineno">   71</span> </div>
<div class="line"><a id="l00076" name="l00076"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a59d8cf909c3d71ebf3db057480b464da">   76</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2&lt;bool&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a59d8cf909c3d71ebf3db057480b464da">Bvec2</a>;</div>
<div class="line"><a id="l00077" name="l00077"></a><span class="lineno">   77</span> </div>
<div class="line"><a id="l00082" name="l00082"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a9bdd0463b7cb5316244a082007bd50f0">   82</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector3.php">Vector3&lt;float&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a9bdd0463b7cb5316244a082007bd50f0">Vec3</a>;</div>
<div class="line"><a id="l00083" name="l00083"></a><span class="lineno">   83</span> </div>
<div class="line"><a id="l00088" name="l00088"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a64f403dd0219e7f128ffddca641394df">   88</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector3.php">Vector3&lt;int&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a64f403dd0219e7f128ffddca641394df">Ivec3</a>;</div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno">   89</span> </div>
<div class="line"><a id="l00094" name="l00094"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a4166ffc506619b4912d576e6eba2c957">   94</a></span>    <span class="keyword">typedef</span> <a class="code hl_class" href="classsf_1_1Vector3.php">Vector3&lt;bool&gt;</a> <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a4166ffc506619b4912d576e6eba2c957">Bvec3</a>;</div>
<div class="line"><a id="l00095" name="l00095"></a><span class="lineno">   95</span> </div>
<div class="line"><a id="l00096" name="l00096"></a><span class="lineno">   96</span><span class="preprocessor">#ifdef SFML_DOXYGEN</span></div>
<div class="line"><a id="l00097" name="l00097"></a><span class="lineno">   97</span> </div>
<div class="line"><a id="l00110" name="l00110"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a7c67253548c58adb77cb14f847f18f83">  110</a></span>    <span class="keyword">typedef</span> implementation-defined <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a7c67253548c58adb77cb14f847f18f83">Vec4</a>;</div>
<div class="line"><a id="l00111" name="l00111"></a><span class="lineno">  111</span> </div>
<div class="line"><a id="l00124" name="l00124"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a778682c4f085d2daeb90c724791f3f68">  124</a></span>    <span class="keyword">typedef</span> implementation-defined <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a778682c4f085d2daeb90c724791f3f68">Ivec4</a>;</div>
<div class="line"><a id="l00125" name="l00125"></a><span class="lineno">  125</span> </div>
<div class="line"><a id="l00130" name="l00130"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a8b1f0ac369666c48a9eafc9d3f5618e6">  130</a></span>    <span class="keyword">typedef</span> implementation-defined <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a8b1f0ac369666c48a9eafc9d3f5618e6">Bvec4</a>;</div>
<div class="line"><a id="l00131" name="l00131"></a><span class="lineno">  131</span> </div>
<div class="line"><a id="l00155" name="l00155"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a9e984ebdc1cebc693a12f01a32b2d28d">  155</a></span>    <span class="keyword">typedef</span> implementation-defined <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a9e984ebdc1cebc693a12f01a32b2d28d">Mat3</a>;</div>
<div class="line"><a id="l00156" name="l00156"></a><span class="lineno">  156</span> </div>
<div class="line"><a id="l00181" name="l00181"></a><span class="lineno"><a class="line" href="namespacesf_1_1Glsl.php#a769de806596348a8e56ed6506c688271">  181</a></span>    <span class="keyword">typedef</span> implementation-defined <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a769de806596348a8e56ed6506c688271">Mat4</a>;</div>
<div class="line"><a id="l00182" name="l00182"></a><span class="lineno">  182</span> </div>
<div class="line"><a id="l00183" name="l00183"></a><span class="lineno">  183</span><span class="preprocessor">#else </span><span class="comment">// SFML_DOXYGEN</span></div>
<div class="line"><a id="l00184" name="l00184"></a><span class="lineno">  184</span> </div>
<div class="line"><a id="l00185" name="l00185"></a><span class="lineno">  185</span>    <span class="keyword">typedef</span> priv::Vector4&lt;float&gt; <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a7c67253548c58adb77cb14f847f18f83">Vec4</a>;</div>
<div class="line"><a id="l00186" name="l00186"></a><span class="lineno">  186</span>    <span class="keyword">typedef</span> priv::Vector4&lt;int&gt; <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a778682c4f085d2daeb90c724791f3f68">Ivec4</a>;</div>
<div class="line"><a id="l00187" name="l00187"></a><span class="lineno">  187</span>    <span class="keyword">typedef</span> priv::Vector4&lt;bool&gt; <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a8b1f0ac369666c48a9eafc9d3f5618e6">Bvec4</a>;</div>
<div class="line"><a id="l00188" name="l00188"></a><span class="lineno">  188</span>    <span class="keyword">typedef</span> priv::Matrix&lt;3, 3&gt; <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a9e984ebdc1cebc693a12f01a32b2d28d">Mat3</a>;</div>
<div class="line"><a id="l00189" name="l00189"></a><span class="lineno">  189</span>    <span class="keyword">typedef</span> priv::Matrix&lt;4, 4&gt; <a class="code hl_typedef" href="namespacesf_1_1Glsl.php#a769de806596348a8e56ed6506c688271">Mat4</a>;</div>
<div class="line"><a id="l00190" name="l00190"></a><span class="lineno">  190</span> </div>
<div class="line"><a id="l00191" name="l00191"></a><span class="lineno">  191</span><span class="preprocessor">#endif </span><span class="comment">// SFML_DOXYGEN</span></div>
<div class="line"><a id="l00192" name="l00192"></a><span class="lineno">  192</span> </div>
<div class="line"><a id="l00193" name="l00193"></a><span class="lineno">  193</span>} <span class="comment">// namespace Glsl</span></div>
</div>
<div class="line"><a id="l00194" name="l00194"></a><span class="lineno">  194</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00195" name="l00195"></a><span class="lineno">  195</span> </div>
<div class="line"><a id="l00196" name="l00196"></a><span class="lineno">  196</span><span class="preprocessor">#endif </span><span class="comment">// SFML_GLSL_HPP</span></div>
<div class="line"><a id="l00197" name="l00197"></a><span class="lineno">  197</span> </div>
<div class="line"><a id="l00198" name="l00198"></a><span class="lineno">  198</span> </div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2</a></div><div class="ttdoc">Utility template class for manipulating 2-dimensional vectors.</div><div class="ttdef"><b>Definition</b> <a href="Vector2_8hpp_source.php#l00037">Vector2.hpp:38</a></div></div>
<div class="ttc" id="aclasssf_1_1Vector3_php"><div class="ttname"><a href="classsf_1_1Vector3.php">sf::Vector3</a></div><div class="ttdoc">Utility template class for manipulating 3-dimensional vectors.</div><div class="ttdef"><b>Definition</b> <a href="Vector3_8hpp_source.php#l00037">Vector3.hpp:38</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a4166ffc506619b4912d576e6eba2c957"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a4166ffc506619b4912d576e6eba2c957">sf::Glsl::Bvec3</a></div><div class="ttdeci">Vector3&lt; bool &gt; Bvec3</div><div class="ttdoc">3D bool vector (bvec3 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00094">Glsl.hpp:94</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a59d8cf909c3d71ebf3db057480b464da"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a59d8cf909c3d71ebf3db057480b464da">sf::Glsl::Bvec2</a></div><div class="ttdeci">Vector2&lt; bool &gt; Bvec2</div><div class="ttdoc">2D bool vector (bvec2 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00076">Glsl.hpp:76</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a64f403dd0219e7f128ffddca641394df"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a64f403dd0219e7f128ffddca641394df">sf::Glsl::Ivec3</a></div><div class="ttdeci">Vector3&lt; int &gt; Ivec3</div><div class="ttdoc">3D int vector (ivec3 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00088">Glsl.hpp:88</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a769de806596348a8e56ed6506c688271"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a769de806596348a8e56ed6506c688271">sf::Glsl::Mat4</a></div><div class="ttdeci">implementation defined Mat4</div><div class="ttdoc">4x4 float matrix (mat4 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00181">Glsl.hpp:181</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a778682c4f085d2daeb90c724791f3f68"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a778682c4f085d2daeb90c724791f3f68">sf::Glsl::Ivec4</a></div><div class="ttdeci">implementation defined Ivec4</div><div class="ttdoc">4D int vector (ivec4 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00124">Glsl.hpp:124</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a7c67253548c58adb77cb14f847f18f83"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a7c67253548c58adb77cb14f847f18f83">sf::Glsl::Vec4</a></div><div class="ttdeci">implementation defined Vec4</div><div class="ttdoc">4D float vector (vec4 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00110">Glsl.hpp:110</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a8b1f0ac369666c48a9eafc9d3f5618e6"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a8b1f0ac369666c48a9eafc9d3f5618e6">sf::Glsl::Bvec4</a></div><div class="ttdeci">implementation defined Bvec4</div><div class="ttdoc">4D bool vector (bvec4 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00130">Glsl.hpp:130</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a9bdd0463b7cb5316244a082007bd50f0"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a9bdd0463b7cb5316244a082007bd50f0">sf::Glsl::Vec3</a></div><div class="ttdeci">Vector3&lt; float &gt; Vec3</div><div class="ttdoc">3D float vector (vec3 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00082">Glsl.hpp:82</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_a9e984ebdc1cebc693a12f01a32b2d28d"><div class="ttname"><a href="namespacesf_1_1Glsl.php#a9e984ebdc1cebc693a12f01a32b2d28d">sf::Glsl::Mat3</a></div><div class="ttdeci">implementation defined Mat3</div><div class="ttdoc">3x3 float matrix (mat3 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00155">Glsl.hpp:155</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_aab803ee70c4b7bfcd63ec09e10408fd3"><div class="ttname"><a href="namespacesf_1_1Glsl.php#aab803ee70c4b7bfcd63ec09e10408fd3">sf::Glsl::Ivec2</a></div><div class="ttdeci">Vector2&lt; int &gt; Ivec2</div><div class="ttdoc">2D int vector (ivec2 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00070">Glsl.hpp:70</a></div></div>
<div class="ttc" id="anamespacesf_1_1Glsl_php_adeed356d346d87634b4c197a530e4edf"><div class="ttname"><a href="namespacesf_1_1Glsl.php#adeed356d346d87634b4c197a530e4edf">sf::Glsl::Vec2</a></div><div class="ttdeci">Vector2&lt; float &gt; Vec2</div><div class="ttdoc">2D float vector (vec2 in GLSL)</div><div class="ttdef"><b>Definition</b> <a href="#l00064">Glsl.hpp:64</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
