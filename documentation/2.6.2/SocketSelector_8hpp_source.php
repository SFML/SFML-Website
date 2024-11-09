<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'SocketSelector.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_5c1116cdc74b8c7983261a15f16adc17.php">Network</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">SocketSelector.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_SOCKETSELECTOR_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_SOCKETSELECTOR_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Network/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span> </div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span>{</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span><span class="keyword">class </span>Socket;</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span> </div>
<div class="foldopen" id="foldopen00043" data-start="{" data-end="};">
<div class="line"><a id="l00043" name="l00043"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php">   43</a></span><span class="keyword">class </span>SFML_NETWORK_API <a class="code hl_class" href="classsf_1_1SocketSelector.php">SocketSelector</a></div>
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno">   44</span>{</div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span> </div>
<div class="line"><a id="l00051" name="l00051"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a741959c5158aeb1e4457cad47d90f76b">   51</a></span>    <a class="code hl_function" href="classsf_1_1SocketSelector.php#a741959c5158aeb1e4457cad47d90f76b">SocketSelector</a>();</div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno">   52</span> </div>
<div class="line"><a id="l00059" name="l00059"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a50b1b955eb7ecb2e7c2764f3f4722fbf">   59</a></span>    <a class="code hl_function" href="classsf_1_1SocketSelector.php#a50b1b955eb7ecb2e7c2764f3f4722fbf">SocketSelector</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; copy);</div>
<div class="line"><a id="l00060" name="l00060"></a><span class="lineno">   60</span> </div>
<div class="line"><a id="l00065" name="l00065"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a9069cd61208260b8ed9cf233afa1f73d">   65</a></span>    <a class="code hl_function" href="classsf_1_1SocketSelector.php#a9069cd61208260b8ed9cf233afa1f73d">~SocketSelector</a>();</div>
<div class="line"><a id="l00066" name="l00066"></a><span class="lineno">   66</span> </div>
<div class="line"><a id="l00080" name="l00080"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#ade952013232802ff7b9b33668f8d2096">   80</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1SocketSelector.php#ade952013232802ff7b9b33668f8d2096">add</a>(<a class="code hl_class" href="classsf_1_1Socket.php">Socket</a>&amp; socket);</div>
<div class="line"><a id="l00081" name="l00081"></a><span class="lineno">   81</span> </div>
<div class="line"><a id="l00093" name="l00093"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a98b6ab693a65b82caa375639232357c1">   93</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1SocketSelector.php#a98b6ab693a65b82caa375639232357c1">remove</a>(<a class="code hl_class" href="classsf_1_1Socket.php">Socket</a>&amp; socket);</div>
<div class="line"><a id="l00094" name="l00094"></a><span class="lineno">   94</span> </div>
<div class="line"><a id="l00105" name="l00105"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a76e650acb0199d4be91e90a493fbc91a">  105</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1SocketSelector.php#a76e650acb0199d4be91e90a493fbc91a">clear</a>();</div>
<div class="line"><a id="l00106" name="l00106"></a><span class="lineno">  106</span> </div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a9cfda5475f17925e65889394d70af702">  123</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1SocketSelector.php#a9cfda5475f17925e65889394d70af702">wait</a>(<a class="code hl_class" href="classsf_1_1Time.php">Time</a> timeout = Time::Zero);</div>
<div class="line"><a id="l00124" name="l00124"></a><span class="lineno">  124</span> </div>
<div class="line"><a id="l00142" name="l00142"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#a917a4bac708290a6782e6686fd3bf889">  142</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1SocketSelector.php#a917a4bac708290a6782e6686fd3bf889">isReady</a>(<a class="code hl_class" href="classsf_1_1Socket.php">Socket</a>&amp; socket) <span class="keyword">const</span>;</div>
<div class="line"><a id="l00143" name="l00143"></a><span class="lineno">  143</span> </div>
<div class="line"><a id="l00152" name="l00152"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php#af7247f1c8badd43932f3adcbc1fec7e8">  152</a></span>    <a class="code hl_class" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; operator =(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; right);</div>
<div class="line"><a id="l00153" name="l00153"></a><span class="lineno">  153</span> </div>
<div class="line"><a id="l00154" name="l00154"></a><span class="lineno">  154</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00155" name="l00155"></a><span class="lineno">  155</span> </div>
<div class="line"><a id="l00156" name="l00156"></a><span class="lineno">  156</span>    <span class="keyword">struct </span>SocketSelectorImpl;</div>
<div class="line"><a id="l00157" name="l00157"></a><span class="lineno">  157</span> </div>
<div class="line"><a id="l00159" name="l00159"></a><span class="lineno">  159</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00161" name="l00161"></a><span class="lineno">  161</span>    SocketSelectorImpl* m_impl; </div>
<div class="line"><a id="l00162" name="l00162"></a><span class="lineno">  162</span>};</div>
</div>
<div class="line"><a id="l00163" name="l00163"></a><span class="lineno">  163</span> </div>
<div class="line"><a id="l00164" name="l00164"></a><span class="lineno">  164</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00165" name="l00165"></a><span class="lineno">  165</span> </div>
<div class="line"><a id="l00166" name="l00166"></a><span class="lineno">  166</span> </div>
<div class="line"><a id="l00167" name="l00167"></a><span class="lineno">  167</span><span class="preprocessor">#endif </span><span class="comment">// SFML_SOCKETSELECTOR_HPP</span></div>
<div class="line"><a id="l00168" name="l00168"></a><span class="lineno">  168</span> </div>
<div class="line"><a id="l00169" name="l00169"></a><span class="lineno">  169</span> </div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php"><div class="ttname"><a href="classsf_1_1SocketSelector.php">sf::SocketSelector</a></div><div class="ttdoc">Multiplexer that allows to read from multiple sockets.</div><div class="ttdef"><b>Definition</b> <a href="#l00043">SocketSelector.hpp:44</a></div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a50b1b955eb7ecb2e7c2764f3f4722fbf"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a50b1b955eb7ecb2e7c2764f3f4722fbf">sf::SocketSelector::SocketSelector</a></div><div class="ttdeci">SocketSelector(const SocketSelector &amp;copy)</div><div class="ttdoc">Copy constructor.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a741959c5158aeb1e4457cad47d90f76b"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a741959c5158aeb1e4457cad47d90f76b">sf::SocketSelector::SocketSelector</a></div><div class="ttdeci">SocketSelector()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a76e650acb0199d4be91e90a493fbc91a"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a76e650acb0199d4be91e90a493fbc91a">sf::SocketSelector::clear</a></div><div class="ttdeci">void clear()</div><div class="ttdoc">Remove all the sockets stored in the selector.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a9069cd61208260b8ed9cf233afa1f73d"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a9069cd61208260b8ed9cf233afa1f73d">sf::SocketSelector::~SocketSelector</a></div><div class="ttdeci">~SocketSelector()</div><div class="ttdoc">Destructor.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a917a4bac708290a6782e6686fd3bf889"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a917a4bac708290a6782e6686fd3bf889">sf::SocketSelector::isReady</a></div><div class="ttdeci">bool isReady(Socket &amp;socket) const</div><div class="ttdoc">Test a socket to know if it is ready to receive data.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a98b6ab693a65b82caa375639232357c1"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a98b6ab693a65b82caa375639232357c1">sf::SocketSelector::remove</a></div><div class="ttdeci">void remove(Socket &amp;socket)</div><div class="ttdoc">Remove a socket from the selector.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_a9cfda5475f17925e65889394d70af702"><div class="ttname"><a href="classsf_1_1SocketSelector.php#a9cfda5475f17925e65889394d70af702">sf::SocketSelector::wait</a></div><div class="ttdeci">bool wait(Time timeout=Time::Zero)</div><div class="ttdoc">Wait until one or more sockets are ready to receive.</div></div>
<div class="ttc" id="aclasssf_1_1SocketSelector_php_ade952013232802ff7b9b33668f8d2096"><div class="ttname"><a href="classsf_1_1SocketSelector.php#ade952013232802ff7b9b33668f8d2096">sf::SocketSelector::add</a></div><div class="ttdeci">void add(Socket &amp;socket)</div><div class="ttdoc">Add a new socket to the selector.</div></div>
<div class="ttc" id="aclasssf_1_1Socket_php"><div class="ttname"><a href="classsf_1_1Socket.php">sf::Socket</a></div><div class="ttdoc">Base class for all the socket types.</div><div class="ttdef"><b>Definition</b> <a href="Socket_8hpp_source.php#l00045">Socket.hpp:46</a></div></div>
<div class="ttc" id="aclasssf_1_1Time_php"><div class="ttname"><a href="classsf_1_1Time.php">sf::Time</a></div><div class="ttdoc">Represents a time value.</div><div class="ttdef"><b>Definition</b> <a href="Time_8hpp_source.php#l00040">Time.hpp:41</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
