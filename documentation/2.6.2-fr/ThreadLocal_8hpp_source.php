<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'ThreadLocal.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
  <div class="headertitle"><div class="title">ThreadLocal.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_THREADLOCAL_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_THREADLOCAL_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/System/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/System/NonCopyable.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;cstdlib&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span>{</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span><span class="keyword">namespace </span>priv</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span>{</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span>    <span class="keyword">class </span>ThreadLocalImpl;</div>
<div class="line"><a id="l00041" name="l00041"></a><span class="lineno">   41</span>}</div>
<div class="line"><a id="l00042" name="l00042"></a><span class="lineno">   42</span> </div>
<div class="foldopen" id="foldopen00047" data-start="{" data-end="};">
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno"><a class="line" href="classsf_1_1ThreadLocal.php">   47</a></span><span class="keyword">class </span>SFML_SYSTEM_API <a class="code hl_class" href="classsf_1_1ThreadLocal.php">ThreadLocal</a> : <a class="code hl_class" href="classsf_1_1NonCopyable.php">NonCopyable</a></div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span>{</div>
<div class="line"><a id="l00049" name="l00049"></a><span class="lineno">   49</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00050" name="l00050"></a><span class="lineno">   50</span> </div>
<div class="line"><a id="l00057" name="l00057"></a><span class="lineno"><a class="line" href="classsf_1_1ThreadLocal.php#a44ea3c4be4eef118080275cbf4cf04cd">   57</a></span>    <a class="code hl_function" href="classsf_1_1ThreadLocal.php#a44ea3c4be4eef118080275cbf4cf04cd">ThreadLocal</a>(<span class="keywordtype">void</span>* value = NULL);</div>
<div class="line"><a id="l00058" name="l00058"></a><span class="lineno">   58</span> </div>
<div class="line"><a id="l00063" name="l00063"></a><span class="lineno"><a class="line" href="classsf_1_1ThreadLocal.php#acc612bddfd0f0507b1c5da8b3b8c75c2">   63</a></span>    <a class="code hl_function" href="classsf_1_1ThreadLocal.php#acc612bddfd0f0507b1c5da8b3b8c75c2">~ThreadLocal</a>();</div>
<div class="line"><a id="l00064" name="l00064"></a><span class="lineno">   64</span> </div>
<div class="line"><a id="l00071" name="l00071"></a><span class="lineno"><a class="line" href="classsf_1_1ThreadLocal.php#ab7e334c83d77644a8e67ee31c3230007">   71</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1ThreadLocal.php#ab7e334c83d77644a8e67ee31c3230007">setValue</a>(<span class="keywordtype">void</span>* value);</div>
<div class="line"><a id="l00072" name="l00072"></a><span class="lineno">   72</span> </div>
<div class="line"><a id="l00079" name="l00079"></a><span class="lineno"><a class="line" href="classsf_1_1ThreadLocal.php#a3273f1976f96a838e386937eae33fc21">   79</a></span>    <span class="keywordtype">void</span>* <a class="code hl_function" href="classsf_1_1ThreadLocal.php#a3273f1976f96a838e386937eae33fc21">getValue</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00080" name="l00080"></a><span class="lineno">   80</span> </div>
<div class="line"><a id="l00081" name="l00081"></a><span class="lineno">   81</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00082" name="l00082"></a><span class="lineno">   82</span> </div>
<div class="line"><a id="l00084" name="l00084"></a><span class="lineno">   84</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00086" name="l00086"></a><span class="lineno">   86</span>    priv::ThreadLocalImpl* m_impl; </div>
<div class="line"><a id="l00087" name="l00087"></a><span class="lineno">   87</span>};</div>
</div>
<div class="line"><a id="l00088" name="l00088"></a><span class="lineno">   88</span> </div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno">   89</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00090" name="l00090"></a><span class="lineno">   90</span> </div>
<div class="line"><a id="l00091" name="l00091"></a><span class="lineno">   91</span> </div>
<div class="line"><a id="l00092" name="l00092"></a><span class="lineno">   92</span><span class="preprocessor">#endif </span><span class="comment">// SFML_THREADLOCAL_HPP</span></div>
<div class="line"><a id="l00093" name="l00093"></a><span class="lineno">   93</span> </div>
<div class="line"><a id="l00094" name="l00094"></a><span class="lineno">   94</span> </div>
<div class="ttc" id="aclasssf_1_1NonCopyable_php"><div class="ttname"><a href="classsf_1_1NonCopyable.php">sf::NonCopyable</a></div><div class="ttdoc">Utility class that makes any derived class non-copyable.</div><div class="ttdef"><b>Definition</b> <a href="NonCopyable_8hpp_source.php#l00041">NonCopyable.hpp:42</a></div></div>
<div class="ttc" id="aclasssf_1_1ThreadLocal_php"><div class="ttname"><a href="classsf_1_1ThreadLocal.php">sf::ThreadLocal</a></div><div class="ttdoc">Defines variables with thread-local storage.</div><div class="ttdef"><b>Definition</b> <a href="#l00047">ThreadLocal.hpp:48</a></div></div>
<div class="ttc" id="aclasssf_1_1ThreadLocal_php_a3273f1976f96a838e386937eae33fc21"><div class="ttname"><a href="classsf_1_1ThreadLocal.php#a3273f1976f96a838e386937eae33fc21">sf::ThreadLocal::getValue</a></div><div class="ttdeci">void * getValue() const</div><div class="ttdoc">Retrieve the thread-specific value of the variable.</div></div>
<div class="ttc" id="aclasssf_1_1ThreadLocal_php_a44ea3c4be4eef118080275cbf4cf04cd"><div class="ttname"><a href="classsf_1_1ThreadLocal.php#a44ea3c4be4eef118080275cbf4cf04cd">sf::ThreadLocal::ThreadLocal</a></div><div class="ttdeci">ThreadLocal(void *value=NULL)</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1ThreadLocal_php_ab7e334c83d77644a8e67ee31c3230007"><div class="ttname"><a href="classsf_1_1ThreadLocal.php#ab7e334c83d77644a8e67ee31c3230007">sf::ThreadLocal::setValue</a></div><div class="ttdeci">void setValue(void *value)</div><div class="ttdoc">Set the thread-specific value of the variable.</div></div>
<div class="ttc" id="aclasssf_1_1ThreadLocal_php_acc612bddfd0f0507b1c5da8b3b8c75c2"><div class="ttname"><a href="classsf_1_1ThreadLocal.php#acc612bddfd0f0507b1c5da8b3b8c75c2">sf::ThreadLocal::~ThreadLocal</a></div><div class="ttdeci">~ThreadLocal()</div><div class="ttdoc">Destructor.</div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
