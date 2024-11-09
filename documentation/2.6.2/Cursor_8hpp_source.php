<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Cursor.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_9aeeb18f6197238fd33123535246e540.php">Window</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">Cursor.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_CURSOR_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_CURSOR_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Window/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/System/NonCopyable.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span>{</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span><span class="keyword">namespace </span>priv</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span>{</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span>    <span class="keyword">class </span>CursorImpl;</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span>}</div>
<div class="line"><a id="l00041" name="l00041"></a><span class="lineno">   41</span> </div>
<div class="foldopen" id="foldopen00046" data-start="{" data-end="};">
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php">   46</a></span><span class="keyword">class </span>SFML_WINDOW_API <a class="code hl_class" href="classsf_1_1Cursor.php">Cursor</a> : <a class="code hl_class" href="classsf_1_1NonCopyable.php">NonCopyable</a></div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span>{</div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00049" name="l00049"></a><span class="lineno">   49</span> </div>
<div class="foldopen" id="foldopen00086" data-start="{" data-end="};">
<div class="line"><a id="l00086" name="l00086"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930a">   86</a></span>    <span class="keyword">enum</span> <a class="code hl_enumeration" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930a">Type</a></div>
<div class="line"><a id="l00087" name="l00087"></a><span class="lineno">   87</span>    {</div>
<div class="line"><a id="l00088" name="l00088"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa8d9a9cd284dabb4246ab4f147ba779a3">   88</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa8d9a9cd284dabb4246ab4f147ba779a3">Arrow</a>,                  </div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa16c3acb967f2175434d6bbad7f1300bf">   89</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa16c3acb967f2175434d6bbad7f1300bf">ArrowWait</a>,              </div>
<div class="line"><a id="l00090" name="l00090"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aabeb51ea58e48e4477ab802d46ad2cbdd">   90</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aabeb51ea58e48e4477ab802d46ad2cbdd">Wait</a>,                   </div>
<div class="line"><a id="l00091" name="l00091"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa1a9979392de58ff11d5b4ab330e6393d">   91</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa1a9979392de58ff11d5b4ab330e6393d">Text</a>,                   </div>
<div class="line"><a id="l00092" name="l00092"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aae826935374aa0414723918ba79f13368">   92</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aae826935374aa0414723918ba79f13368">Hand</a>,                   </div>
<div class="line"><a id="l00093" name="l00093"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa0131508eaa8802dba34b8c9b41aec6e9">   93</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa0131508eaa8802dba34b8c9b41aec6e9">SizeHorizontal</a>,         </div>
<div class="line"><a id="l00094" name="l00094"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aab3cefa56d3a0fe9fe64680c7ec11eab5">   94</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aab3cefa56d3a0fe9fe64680c7ec11eab5">SizeVertical</a>,           </div>
<div class="line"><a id="l00095" name="l00095"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa934ddc380262a94358ccb5a4ab7bbe1c">   95</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa934ddc380262a94358ccb5a4ab7bbe1c">SizeTopLeftBottomRight</a>, </div>
<div class="line"><a id="l00096" name="l00096"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aac047cea5795b6074fbb4d6479452e8ef">   96</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aac047cea5795b6074fbb4d6479452e8ef">SizeBottomLeftTopRight</a>, </div>
<div class="line"><a id="l00097" name="l00097"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa4725e9d5f8117997732f8dcccce45be4">   97</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa4725e9d5f8117997732f8dcccce45be4">SizeLeft</a>,               </div>
<div class="line"><a id="l00098" name="l00098"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaebc3670bd27360a7de429daa07921a4d">   98</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaebc3670bd27360a7de429daa07921a4d">SizeRight</a>,              </div>
<div class="line"><a id="l00099" name="l00099"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa605e36bf335a0d801b4e7d67995a9e85">   99</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa605e36bf335a0d801b4e7d67995a9e85">SizeTop</a>,                </div>
<div class="line"><a id="l00100" name="l00100"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaafd57cfee8747f202db04a549057e185">  100</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaafd57cfee8747f202db04a549057e185">SizeBottom</a>,             </div>
<div class="line"><a id="l00101" name="l00101"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa2cc42c06dd701af7211f351333b629ca">  101</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa2cc42c06dd701af7211f351333b629ca">SizeTopLeft</a>,            </div>
<div class="line"><a id="l00102" name="l00102"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa581edf98abd0b4905329b516a45eeef8">  102</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa581edf98abd0b4905329b516a45eeef8">SizeBottomRight</a>,        </div>
<div class="line"><a id="l00103" name="l00103"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa62fb130f4aa6ecf39c8366e0de549cc2">  103</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa62fb130f4aa6ecf39c8366e0de549cc2">SizeBottomLeft</a>,         </div>
<div class="line"><a id="l00104" name="l00104"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa84d9478fdeef2f727f06f3fe5bdb1be6">  104</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa84d9478fdeef2f727f06f3fe5bdb1be6">SizeTopRight</a>,           </div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa256a64be04f0347e6a44cbf84e5410bd">  105</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa256a64be04f0347e6a44cbf84e5410bd">SizeAll</a>,                </div>
<div class="line"><a id="l00106" name="l00106"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf3b3213aad68863c7dec96587681fecd">  106</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf3b3213aad68863c7dec96587681fecd">Cross</a>,                  </div>
<div class="line"><a id="l00107" name="l00107"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf2c0ed3674b334ebf8365aee243186f5">  107</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf2c0ed3674b334ebf8365aee243186f5">Help</a>,                   </div>
<div class="line"><a id="l00108" name="l00108"></a><span class="lineno">  108</span>        NotAllowed              </div>
<div class="line"><a id="l00109" name="l00109"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aadb1ec726725dd81ec9906cbe06fec805">  109</a></span>    };</div>
</div>
<div class="line"><a id="l00110" name="l00110"></a><span class="lineno">  110</span> </div>
<div class="line"><a id="l00111" name="l00111"></a><span class="lineno">  111</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00112" name="l00112"></a><span class="lineno">  112</span> </div>
<div class="line"><a id="l00122" name="l00122"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#a6a36a0a5943b22b77b00cac839dd715c">  122</a></span>    <a class="code hl_function" href="classsf_1_1Cursor.php#a6a36a0a5943b22b77b00cac839dd715c">Cursor</a>();</div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno">  123</span> </div>
<div class="line"><a id="l00131" name="l00131"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#a777ba6a1d0d68f8eb9dc85976a5b9727">  131</a></span>    <a class="code hl_function" href="classsf_1_1Cursor.php#a777ba6a1d0d68f8eb9dc85976a5b9727">~Cursor</a>();</div>
<div class="line"><a id="l00132" name="l00132"></a><span class="lineno">  132</span> </div>
<div class="line"><a id="l00163" name="l00163"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ac24ecf82ac7d9ba6703389397f948b3a">  163</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Cursor.php#ac24ecf82ac7d9ba6703389397f948b3a">loadFromPixels</a>(<span class="keyword">const</span> Uint8* pixels, <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2u</a> size, <a class="code hl_class" href="classsf_1_1Vector2.php">Vector2u</a> hotspot);</div>
<div class="line"><a id="l00164" name="l00164"></a><span class="lineno">  164</span> </div>
<div class="line"><a id="l00179" name="l00179"></a><span class="lineno"><a class="line" href="classsf_1_1Cursor.php#ad41999c8633c2fbaa2364e379c1ab25b">  179</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Cursor.php#ad41999c8633c2fbaa2364e379c1ab25b">loadFromSystem</a>(<a class="code hl_enumeration" href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930a">Type</a> type);</div>
<div class="line"><a id="l00180" name="l00180"></a><span class="lineno">  180</span> </div>
<div class="line"><a id="l00181" name="l00181"></a><span class="lineno">  181</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00182" name="l00182"></a><span class="lineno">  182</span> </div>
<div class="line"><a id="l00183" name="l00183"></a><span class="lineno">  183</span>    <span class="keyword">friend</span> <span class="keyword">class </span><a class="code hl_class" href="classsf_1_1WindowBase.php">WindowBase</a>;</div>
<div class="line"><a id="l00184" name="l00184"></a><span class="lineno">  184</span> </div>
<div class="line"><a id="l00194" name="l00194"></a><span class="lineno">  194</span>    <span class="keyword">const</span> priv::CursorImpl&amp; getImpl() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00195" name="l00195"></a><span class="lineno">  195</span> </div>
<div class="line"><a id="l00196" name="l00196"></a><span class="lineno">  196</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00197" name="l00197"></a><span class="lineno">  197</span> </div>
<div class="line"><a id="l00199" name="l00199"></a><span class="lineno">  199</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00201" name="l00201"></a><span class="lineno">  201</span>    priv::CursorImpl* m_impl; </div>
<div class="line"><a id="l00202" name="l00202"></a><span class="lineno">  202</span>};</div>
</div>
<div class="line"><a id="l00203" name="l00203"></a><span class="lineno">  203</span> </div>
<div class="line"><a id="l00204" name="l00204"></a><span class="lineno">  204</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00205" name="l00205"></a><span class="lineno">  205</span> </div>
<div class="line"><a id="l00206" name="l00206"></a><span class="lineno">  206</span> </div>
<div class="line"><a id="l00207" name="l00207"></a><span class="lineno">  207</span><span class="preprocessor">#endif </span><span class="comment">// SFML_CURSOR_HPP</span></div>
<div class="line"><a id="l00208" name="l00208"></a><span class="lineno">  208</span> </div>
<div class="line"><a id="l00209" name="l00209"></a><span class="lineno">  209</span> </div>
<div class="ttc" id="aclasssf_1_1Cursor_php"><div class="ttname"><a href="classsf_1_1Cursor.php">sf::Cursor</a></div><div class="ttdoc">Cursor defines the appearance of a system cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00046">Cursor.hpp:47</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_a6a36a0a5943b22b77b00cac839dd715c"><div class="ttname"><a href="classsf_1_1Cursor.php#a6a36a0a5943b22b77b00cac839dd715c">sf::Cursor::Cursor</a></div><div class="ttdeci">Cursor()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_a777ba6a1d0d68f8eb9dc85976a5b9727"><div class="ttname"><a href="classsf_1_1Cursor.php#a777ba6a1d0d68f8eb9dc85976a5b9727">sf::Cursor::~Cursor</a></div><div class="ttdeci">~Cursor()</div><div class="ttdoc">Destructor.</div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930a"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930a">sf::Cursor::Type</a></div><div class="ttdeci">Type</div><div class="ttdoc">Enumeration of the native system cursor types.</div><div class="ttdef"><b>Definition</b> <a href="#l00086">Cursor.hpp:87</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa0131508eaa8802dba34b8c9b41aec6e9"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa0131508eaa8802dba34b8c9b41aec6e9">sf::Cursor::SizeHorizontal</a></div><div class="ttdeci">@ SizeHorizontal</div><div class="ttdoc">Horizontal double arrow cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00093">Cursor.hpp:93</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa16c3acb967f2175434d6bbad7f1300bf"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa16c3acb967f2175434d6bbad7f1300bf">sf::Cursor::ArrowWait</a></div><div class="ttdeci">@ ArrowWait</div><div class="ttdoc">Busy arrow cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00089">Cursor.hpp:89</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa1a9979392de58ff11d5b4ab330e6393d"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa1a9979392de58ff11d5b4ab330e6393d">sf::Cursor::Text</a></div><div class="ttdeci">@ Text</div><div class="ttdoc">I-beam, cursor when hovering over a field allowing text entry.</div><div class="ttdef"><b>Definition</b> <a href="#l00091">Cursor.hpp:91</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa256a64be04f0347e6a44cbf84e5410bd"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa256a64be04f0347e6a44cbf84e5410bd">sf::Cursor::SizeAll</a></div><div class="ttdeci">@ SizeAll</div><div class="ttdoc">Combination of SizeHorizontal and SizeVertical.</div><div class="ttdef"><b>Definition</b> <a href="#l00105">Cursor.hpp:105</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa2cc42c06dd701af7211f351333b629ca"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa2cc42c06dd701af7211f351333b629ca">sf::Cursor::SizeTopLeft</a></div><div class="ttdeci">@ SizeTopLeft</div><div class="ttdoc">Top-left arrow cursor on Linux, same as SizeTopLeftBottomRight on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00101">Cursor.hpp:101</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa4725e9d5f8117997732f8dcccce45be4"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa4725e9d5f8117997732f8dcccce45be4">sf::Cursor::SizeLeft</a></div><div class="ttdeci">@ SizeLeft</div><div class="ttdoc">Left arrow cursor on Linux, same as SizeHorizontal on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00097">Cursor.hpp:97</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa581edf98abd0b4905329b516a45eeef8"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa581edf98abd0b4905329b516a45eeef8">sf::Cursor::SizeBottomRight</a></div><div class="ttdeci">@ SizeBottomRight</div><div class="ttdoc">Bottom-right arrow cursor on Linux, same as SizeTopLeftBottomRight on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00102">Cursor.hpp:102</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa605e36bf335a0d801b4e7d67995a9e85"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa605e36bf335a0d801b4e7d67995a9e85">sf::Cursor::SizeTop</a></div><div class="ttdeci">@ SizeTop</div><div class="ttdoc">Up arrow cursor on Linux, same as SizeVertical on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00099">Cursor.hpp:99</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa62fb130f4aa6ecf39c8366e0de549cc2"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa62fb130f4aa6ecf39c8366e0de549cc2">sf::Cursor::SizeBottomLeft</a></div><div class="ttdeci">@ SizeBottomLeft</div><div class="ttdoc">Bottom-left arrow cursor on Linux, same as SizeBottomLeftTopRight on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00103">Cursor.hpp:103</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa84d9478fdeef2f727f06f3fe5bdb1be6"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa84d9478fdeef2f727f06f3fe5bdb1be6">sf::Cursor::SizeTopRight</a></div><div class="ttdeci">@ SizeTopRight</div><div class="ttdoc">Top-right arrow cursor on Linux, same as SizeBottomLeftTopRight on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00104">Cursor.hpp:104</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa8d9a9cd284dabb4246ab4f147ba779a3"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa8d9a9cd284dabb4246ab4f147ba779a3">sf::Cursor::Arrow</a></div><div class="ttdeci">@ Arrow</div><div class="ttdoc">Arrow cursor (default)</div><div class="ttdef"><b>Definition</b> <a href="#l00088">Cursor.hpp:88</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aa934ddc380262a94358ccb5a4ab7bbe1c"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aa934ddc380262a94358ccb5a4ab7bbe1c">sf::Cursor::SizeTopLeftBottomRight</a></div><div class="ttdeci">@ SizeTopLeftBottomRight</div><div class="ttdoc">Double arrow cursor going from top-left to bottom-right.</div><div class="ttdef"><b>Definition</b> <a href="#l00095">Cursor.hpp:95</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aaafd57cfee8747f202db04a549057e185"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaafd57cfee8747f202db04a549057e185">sf::Cursor::SizeBottom</a></div><div class="ttdeci">@ SizeBottom</div><div class="ttdoc">Down arrow cursor on Linux, same as SizeVertical on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00100">Cursor.hpp:100</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aab3cefa56d3a0fe9fe64680c7ec11eab5"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aab3cefa56d3a0fe9fe64680c7ec11eab5">sf::Cursor::SizeVertical</a></div><div class="ttdeci">@ SizeVertical</div><div class="ttdoc">Vertical double arrow cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00094">Cursor.hpp:94</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aabeb51ea58e48e4477ab802d46ad2cbdd"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aabeb51ea58e48e4477ab802d46ad2cbdd">sf::Cursor::Wait</a></div><div class="ttdeci">@ Wait</div><div class="ttdoc">Busy cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00090">Cursor.hpp:90</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aac047cea5795b6074fbb4d6479452e8ef"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aac047cea5795b6074fbb4d6479452e8ef">sf::Cursor::SizeBottomLeftTopRight</a></div><div class="ttdeci">@ SizeBottomLeftTopRight</div><div class="ttdoc">Double arrow cursor going from bottom-left to top-right.</div><div class="ttdef"><b>Definition</b> <a href="#l00096">Cursor.hpp:96</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aae826935374aa0414723918ba79f13368"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aae826935374aa0414723918ba79f13368">sf::Cursor::Hand</a></div><div class="ttdeci">@ Hand</div><div class="ttdoc">Pointing hand cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00092">Cursor.hpp:92</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aaebc3670bd27360a7de429daa07921a4d"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaebc3670bd27360a7de429daa07921a4d">sf::Cursor::SizeRight</a></div><div class="ttdeci">@ SizeRight</div><div class="ttdoc">Right arrow cursor on Linux, same as SizeHorizontal on other platforms.</div><div class="ttdef"><b>Definition</b> <a href="#l00098">Cursor.hpp:98</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aaf2c0ed3674b334ebf8365aee243186f5"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf2c0ed3674b334ebf8365aee243186f5">sf::Cursor::Help</a></div><div class="ttdeci">@ Help</div><div class="ttdoc">Help cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00107">Cursor.hpp:107</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ab9ab152aec1f8a4955e34ccae08f930aaf3b3213aad68863c7dec96587681fecd"><div class="ttname"><a href="classsf_1_1Cursor.php#ab9ab152aec1f8a4955e34ccae08f930aaf3b3213aad68863c7dec96587681fecd">sf::Cursor::Cross</a></div><div class="ttdeci">@ Cross</div><div class="ttdoc">Crosshair cursor.</div><div class="ttdef"><b>Definition</b> <a href="#l00106">Cursor.hpp:106</a></div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ac24ecf82ac7d9ba6703389397f948b3a"><div class="ttname"><a href="classsf_1_1Cursor.php#ac24ecf82ac7d9ba6703389397f948b3a">sf::Cursor::loadFromPixels</a></div><div class="ttdeci">bool loadFromPixels(const Uint8 *pixels, Vector2u size, Vector2u hotspot)</div><div class="ttdoc">Create a cursor with the provided image.</div></div>
<div class="ttc" id="aclasssf_1_1Cursor_php_ad41999c8633c2fbaa2364e379c1ab25b"><div class="ttname"><a href="classsf_1_1Cursor.php#ad41999c8633c2fbaa2364e379c1ab25b">sf::Cursor::loadFromSystem</a></div><div class="ttdeci">bool loadFromSystem(Type type)</div><div class="ttdoc">Create a native system cursor.</div></div>
<div class="ttc" id="aclasssf_1_1NonCopyable_php"><div class="ttname"><a href="classsf_1_1NonCopyable.php">sf::NonCopyable</a></div><div class="ttdoc">Utility class that makes any derived class non-copyable.</div><div class="ttdef"><b>Definition</b> <a href="NonCopyable_8hpp_source.php#l00041">NonCopyable.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1Vector2_php"><div class="ttname"><a href="classsf_1_1Vector2.php">sf::Vector2&lt; unsigned int &gt;</a></div></div>
<div class="ttc" id="aclasssf_1_1WindowBase_php"><div class="ttname"><a href="classsf_1_1WindowBase.php">sf::WindowBase</a></div><div class="ttdoc">Window that serves as a base for other windows.</div><div class="ttdef"><b>Definition</b> <a href="WindowBase_8hpp_source.php#l00056">WindowBase.hpp:57</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
