<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'ConvexShape.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
  <div class="headertitle"><div class="title">ConvexShape.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_CONVEXSHAPE_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_CONVEXSHAPE_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Graphics/Shape.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;vector&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span>{</div>
<div class="foldopen" id="foldopen00042" data-start="{" data-end="};">
<div class="line"><a id="l00042" name="l00042"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php">   42</a></span><span class="keyword">class </span>SFML_GRAPHICS_API <a class="code hl_class" href="classsf_1_1ConvexShape.php">ConvexShape</a> : <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1Shape.php">Shape</a></div>
<div class="line"><a id="l00043" name="l00043"></a><span class="lineno">   43</span>{</div>
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno">   44</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span> </div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php#af9981b8909569b381b3fccf32fc69856">   52</a></span>    <span class="keyword">explicit</span> <a class="code hl_function" href="classsf_1_1ConvexShape.php#af9981b8909569b381b3fccf32fc69856">ConvexShape</a>(std::size_t pointCount = 0);</div>
<div class="line"><a id="l00053" name="l00053"></a><span class="lineno">   53</span> </div>
<div class="line"><a id="l00064" name="l00064"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php#a56e6e79ade6dd651cc1a0e39cb68deae">   64</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1ConvexShape.php#a56e6e79ade6dd651cc1a0e39cb68deae">setPointCount</a>(std::size_t count);</div>
<div class="line"><a id="l00065" name="l00065"></a><span class="lineno">   65</span> </div>
<div class="line"><a id="l00074" name="l00074"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php#a0c54b8d48fe4e13414f6e667dbfc22a3">   74</a></span>    <span class="keyword">virtual</span> std::size_t <a class="code hl_function" href="classsf_1_1ConvexShape.php#a0c54b8d48fe4e13414f6e667dbfc22a3">getPointCount</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00075" name="l00075"></a><span class="lineno">   75</span> </div>
<div class="line"><a id="l00091" name="l00091"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php#a5929e0ab0ba5ca1f102b40c234a8e92d">   91</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1ConvexShape.php#a5929e0ab0ba5ca1f102b40c234a8e92d">setPoint</a>(std::size_t index, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2f</a>&amp; point);</div>
<div class="line"><a id="l00092" name="l00092"></a><span class="lineno">   92</span> </div>
<div class="line"><a id="l00108" name="l00108"></a><span class="lineno"><a class="line" href="classsf_1_1ConvexShape.php#a72a97bc426d8daf4d682a20fcb7f3fe7">  108</a></span>    <span class="keyword">virtual</span> <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2f</a> <a class="code hl_function" href="classsf_1_1ConvexShape.php#a72a97bc426d8daf4d682a20fcb7f3fe7">getPoint</a>(std::size_t index) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00109" name="l00109"></a><span class="lineno">  109</span> </div>
<div class="line"><a id="l00110" name="l00110"></a><span class="lineno">  110</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00111" name="l00111"></a><span class="lineno">  111</span> </div>
<div class="line"><a id="l00113" name="l00113"></a><span class="lineno">  113</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00115" name="l00115"></a><span class="lineno">  115</span>    std::vector&lt;Vector2f&gt; m_points; </div>
<div class="line"><a id="l00116" name="l00116"></a><span class="lineno">  116</span>};</div>
</div>
<div class="line"><a id="l00117" name="l00117"></a><span class="lineno">  117</span> </div>
<div class="line"><a id="l00118" name="l00118"></a><span class="lineno">  118</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00119" name="l00119"></a><span class="lineno">  119</span> </div>
<div class="line"><a id="l00120" name="l00120"></a><span class="lineno">  120</span> </div>
<div class="line"><a id="l00121" name="l00121"></a><span class="lineno">  121</span><span class="preprocessor">#endif </span><span class="comment">// SFML_CONVEXSHAPE_HPP</span></div>
<div class="line"><a id="l00122" name="l00122"></a><span class="lineno">  122</span> </div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno">  123</span> </div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php"><div class="ttname"><a href="classsf_1_1ConvexShape.php">sf::ConvexShape</a></div><div class="ttdoc">Specialized shape representing a convex polygon.</div><div class="ttdef"><b>Definition</b> <a href="#l00042">ConvexShape.hpp:43</a></div></div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php_a0c54b8d48fe4e13414f6e667dbfc22a3"><div class="ttname"><a href="classsf_1_1ConvexShape.php#a0c54b8d48fe4e13414f6e667dbfc22a3">sf::ConvexShape::getPointCount</a></div><div class="ttdeci">virtual std::size_t getPointCount() const</div><div class="ttdoc">Get the number of points of the polygon.</div></div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php_a56e6e79ade6dd651cc1a0e39cb68deae"><div class="ttname"><a href="classsf_1_1ConvexShape.php#a56e6e79ade6dd651cc1a0e39cb68deae">sf::ConvexShape::setPointCount</a></div><div class="ttdeci">void setPointCount(std::size_t count)</div><div class="ttdoc">Set the number of points of the polygon.</div></div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php_a5929e0ab0ba5ca1f102b40c234a8e92d"><div class="ttname"><a href="classsf_1_1ConvexShape.php#a5929e0ab0ba5ca1f102b40c234a8e92d">sf::ConvexShape::setPoint</a></div><div class="ttdeci">void setPoint(std::size_t index, const Vector2f &amp;point)</div><div class="ttdoc">Set the position of a point.</div></div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php_a72a97bc426d8daf4d682a20fcb7f3fe7"><div class="ttname"><a href="classsf_1_1ConvexShape.php#a72a97bc426d8daf4d682a20fcb7f3fe7">sf::ConvexShape::getPoint</a></div><div class="ttdeci">virtual Vector2f getPoint(std::size_t index) const</div><div class="ttdoc">Get the position of a point.</div></div>
<div class="ttc" id="aclasssf_1_1ConvexShape_php_af9981b8909569b381b3fccf32fc69856"><div class="ttname"><a href="classsf_1_1ConvexShape.php#af9981b8909569b381b3fccf32fc69856">sf::ConvexShape::ConvexShape</a></div><div class="ttdeci">ConvexShape(std::size_t pointCount=0)</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Shape_php"><div class="ttname"><a href="classsf_1_1Shape.php">sf::Shape</a></div><div class="ttdoc">Base class for textured shapes with outline.</div><div class="ttdef"><b>Definition</b> <a href="Shape_8hpp_source.php#l00044">Shape.hpp:45</a></div></div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; float &gt;</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
