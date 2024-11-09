<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'MemoryInputStream.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_dd2e492ad64d241b969bca3fa8d4cd6d.php">System</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">MemoryInputStream.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_MEMORYINPUTSTREAM_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_MEMORYINPUTSTREAM_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Config.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/System/InputStream.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/System/Export.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span><span class="preprocessor">#include &lt;cstdlib&gt;</span></div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span> </div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span>{</div>
<div class="foldopen" id="foldopen00043" data-start="{" data-end="};">
<div class="line"><a id="l00043" name="l00043"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php">   43</a></span><span class="keyword">class </span>SFML_SYSTEM_API <a class="code hl_class" href="classsf_1_1MemoryInputStream.php">MemoryInputStream</a> : <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1InputStream.php">InputStream</a></div>
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno">   44</span>{</div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span> </div>
<div class="line"><a id="l00051" name="l00051"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#a2d78851a69a8956a79872be41bcdfe0e">   51</a></span>    <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#a2d78851a69a8956a79872be41bcdfe0e">MemoryInputStream</a>();</div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno">   52</span> </div>
<div class="line"><a id="l00060" name="l00060"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#ad3cfb4f4f915f7803d6a0784e394ac19">   60</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#ad3cfb4f4f915f7803d6a0784e394ac19">open</a>(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t sizeInBytes);</div>
<div class="line"><a id="l00061" name="l00061"></a><span class="lineno">   61</span> </div>
<div class="line"><a id="l00074" name="l00074"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#adff5270c521819639154d42d76fd4c34">   74</a></span>    <span class="keyword">virtual</span> Int64 <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#adff5270c521819639154d42d76fd4c34">read</a>(<span class="keywordtype">void</span>* data, Int64 size);</div>
<div class="line"><a id="l00075" name="l00075"></a><span class="lineno">   75</span> </div>
<div class="line"><a id="l00084" name="l00084"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#aa2ac8fda2bdb4c95248ae90c71633034">   84</a></span>    <span class="keyword">virtual</span> Int64 <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#aa2ac8fda2bdb4c95248ae90c71633034">seek</a>(Int64 position);</div>
<div class="line"><a id="l00085" name="l00085"></a><span class="lineno">   85</span> </div>
<div class="line"><a id="l00092" name="l00092"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#a7ad4bdf721f29de8f66421ff29e23ee4">   92</a></span>    <span class="keyword">virtual</span> Int64 <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#a7ad4bdf721f29de8f66421ff29e23ee4">tell</a>();</div>
<div class="line"><a id="l00093" name="l00093"></a><span class="lineno">   93</span> </div>
<div class="line"><a id="l00100" name="l00100"></a><span class="lineno"><a class="line" href="classsf_1_1MemoryInputStream.php#a6ade3ca45de361ffa0a718595f0b6763">  100</a></span>    <span class="keyword">virtual</span> Int64 <a class="code hl_function" href="classsf_1_1MemoryInputStream.php#a6ade3ca45de361ffa0a718595f0b6763">getSize</a>();</div>
<div class="line"><a id="l00101" name="l00101"></a><span class="lineno">  101</span> </div>
<div class="line"><a id="l00102" name="l00102"></a><span class="lineno">  102</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00103" name="l00103"></a><span class="lineno">  103</span> </div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno">  105</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00107" name="l00107"></a><span class="lineno">  107</span>    <span class="keyword">const</span> <span class="keywordtype">char</span>* m_data;   </div>
<div class="line"><a id="l00108" name="l00108"></a><span class="lineno">  108</span>    Int64       m_size;   </div>
<div class="line"><a id="l00109" name="l00109"></a><span class="lineno">  109</span>    Int64       m_offset; </div>
<div class="line"><a id="l00110" name="l00110"></a><span class="lineno">  110</span>};</div>
</div>
<div class="line"><a id="l00111" name="l00111"></a><span class="lineno">  111</span> </div>
<div class="line"><a id="l00112" name="l00112"></a><span class="lineno">  112</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00113" name="l00113"></a><span class="lineno">  113</span> </div>
<div class="line"><a id="l00114" name="l00114"></a><span class="lineno">  114</span> </div>
<div class="line"><a id="l00115" name="l00115"></a><span class="lineno">  115</span><span class="preprocessor">#endif </span><span class="comment">// SFML_MEMORYINPUTSTREAM_HPP</span></div>
<div class="line"><a id="l00116" name="l00116"></a><span class="lineno">  116</span> </div>
<div class="line"><a id="l00117" name="l00117"></a><span class="lineno">  117</span> </div>
<div class="ttc" id="aclasssf_1_1InputStream_php"><div class="ttname"><a href="classsf_1_1InputStream.php">sf::InputStream</a></div><div class="ttdoc">Abstract class for custom file input streams.</div><div class="ttdef"><b>Definition</b> <a href="InputStream_8hpp_source.php#l00041">InputStream.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php">sf::MemoryInputStream</a></div><div class="ttdoc">Implementation of input stream based on a memory chunk.</div><div class="ttdef"><b>Definition</b> <a href="#l00043">MemoryInputStream.hpp:44</a></div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_a2d78851a69a8956a79872be41bcdfe0e"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#a2d78851a69a8956a79872be41bcdfe0e">sf::MemoryInputStream::MemoryInputStream</a></div><div class="ttdeci">MemoryInputStream()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_a6ade3ca45de361ffa0a718595f0b6763"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#a6ade3ca45de361ffa0a718595f0b6763">sf::MemoryInputStream::getSize</a></div><div class="ttdeci">virtual Int64 getSize()</div><div class="ttdoc">Return the size of the stream.</div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_a7ad4bdf721f29de8f66421ff29e23ee4"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#a7ad4bdf721f29de8f66421ff29e23ee4">sf::MemoryInputStream::tell</a></div><div class="ttdeci">virtual Int64 tell()</div><div class="ttdoc">Get the current reading position in the stream.</div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_aa2ac8fda2bdb4c95248ae90c71633034"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#aa2ac8fda2bdb4c95248ae90c71633034">sf::MemoryInputStream::seek</a></div><div class="ttdeci">virtual Int64 seek(Int64 position)</div><div class="ttdoc">Change the current reading position.</div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_ad3cfb4f4f915f7803d6a0784e394ac19"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#ad3cfb4f4f915f7803d6a0784e394ac19">sf::MemoryInputStream::open</a></div><div class="ttdeci">void open(const void *data, std::size_t sizeInBytes)</div><div class="ttdoc">Open the stream from its data.</div></div>
<div class="ttc" id="aclasssf_1_1MemoryInputStream_php_adff5270c521819639154d42d76fd4c34"><div class="ttname"><a href="classsf_1_1MemoryInputStream.php#adff5270c521819639154d42d76fd4c34">sf::MemoryInputStream::read</a></div><div class="ttdeci">virtual Int64 read(void *data, Int64 size)</div><div class="ttdoc">Read data from the stream.</div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
