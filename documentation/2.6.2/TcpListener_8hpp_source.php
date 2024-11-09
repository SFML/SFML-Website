<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'TcpListener.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
  <div class="headertitle"><div class="title">TcpListener.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_TCPLISTENER_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_TCPLISTENER_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Network/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Network/Socket.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/Network/IpAddress.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span>{</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span><span class="keyword">class </span>TcpSocket;</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span> </div>
<div class="foldopen" id="foldopen00044" data-start="{" data-end="};">
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php">   44</a></span><span class="keyword">class </span>SFML_NETWORK_API <a class="code hl_class" href="classsf_1_1TcpListener.php">TcpListener</a> : <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1Socket.php">Socket</a></div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span>{</div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span> </div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php#a59a1db5b6f4711a3e57390da2f8d9630">   52</a></span>    <a class="code hl_function" href="classsf_1_1TcpListener.php#a59a1db5b6f4711a3e57390da2f8d9630">TcpListener</a>();</div>
<div class="line"><a id="l00053" name="l00053"></a><span class="lineno">   53</span> </div>
<div class="line"><a id="l00065" name="l00065"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php#a784b9a9c59d4cdbae1795e90b8015780">   65</a></span>    <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> <a class="code hl_function" href="classsf_1_1TcpListener.php#a784b9a9c59d4cdbae1795e90b8015780">getLocalPort</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00066" name="l00066"></a><span class="lineno">   66</span> </div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php#a9504758ea3570e62cb20b209c11776a1">   89</a></span>    <a class="code hl_enumeration" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc">Status</a> <a class="code hl_function" href="classsf_1_1TcpListener.php#a9504758ea3570e62cb20b209c11776a1">listen</a>(<span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> port, <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1IpAddress.php">IpAddress</a>&amp; address = IpAddress::Any);</div>
<div class="line"><a id="l00090" name="l00090"></a><span class="lineno">   90</span> </div>
<div class="line"><a id="l00100" name="l00100"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php#a3a00a850506bd0f9f48867a0fe59556b">  100</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1TcpListener.php#a3a00a850506bd0f9f48867a0fe59556b">close</a>();</div>
<div class="line"><a id="l00101" name="l00101"></a><span class="lineno">  101</span> </div>
<div class="line"><a id="l00115" name="l00115"></a><span class="lineno"><a class="line" href="classsf_1_1TcpListener.php#ae2c83ce5a64d50b68180c46bef0a7346">  115</a></span>    <a class="code hl_enumeration" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc">Status</a> <a class="code hl_function" href="classsf_1_1TcpListener.php#ae2c83ce5a64d50b68180c46bef0a7346">accept</a>(<a class="code hl_class" href="classsf_1_1TcpSocket.php">TcpSocket</a>&amp; socket);</div>
<div class="line"><a id="l00116" name="l00116"></a><span class="lineno">  116</span>};</div>
</div>
<div class="line"><a id="l00117" name="l00117"></a><span class="lineno">  117</span> </div>
<div class="line"><a id="l00118" name="l00118"></a><span class="lineno">  118</span> </div>
<div class="line"><a id="l00119" name="l00119"></a><span class="lineno">  119</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00120" name="l00120"></a><span class="lineno">  120</span> </div>
<div class="line"><a id="l00121" name="l00121"></a><span class="lineno">  121</span> </div>
<div class="line"><a id="l00122" name="l00122"></a><span class="lineno">  122</span><span class="preprocessor">#endif </span><span class="comment">// SFML_TCPLISTENER_HPP</span></div>
<div class="line"><a id="l00123" name="l00123"></a><span class="lineno">  123</span> </div>
<div class="line"><a id="l00124" name="l00124"></a><span class="lineno">  124</span> </div>
<div class="ttc" id="aclasssf_1_1IpAddress_php"><div class="ttname"><a href="classsf_1_1IpAddress.php">sf::IpAddress</a></div><div class="ttdoc">Encapsulate an IPv4 network address.</div><div class="ttdef"><b>Definition</b> <a href="IpAddress_8hpp_source.php#l00044">IpAddress.hpp:45</a></div></div>
<div class="ttc" id="aclasssf_1_1Socket_php"><div class="ttname"><a href="classsf_1_1Socket.php">sf::Socket</a></div><div class="ttdoc">Base class for all the socket types.</div><div class="ttdef"><b>Definition</b> <a href="Socket_8hpp_source.php#l00045">Socket.hpp:46</a></div></div>
<div class="ttc" id="aclasssf_1_1Socket_php_a51bf0fd51057b98a10fbb866246176dc"><div class="ttname"><a href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc">sf::Socket::Status</a></div><div class="ttdeci">Status</div><div class="ttdoc">Status codes that may be returned by socket functions.</div><div class="ttdef"><b>Definition</b> <a href="Socket_8hpp_source.php#l00053">Socket.hpp:54</a></div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php"><div class="ttname"><a href="classsf_1_1TcpListener.php">sf::TcpListener</a></div><div class="ttdoc">Socket that listens to new TCP connections.</div><div class="ttdef"><b>Definition</b> <a href="#l00044">TcpListener.hpp:45</a></div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php_a3a00a850506bd0f9f48867a0fe59556b"><div class="ttname"><a href="classsf_1_1TcpListener.php#a3a00a850506bd0f9f48867a0fe59556b">sf::TcpListener::close</a></div><div class="ttdeci">void close()</div><div class="ttdoc">Stop listening and close the socket.</div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php_a59a1db5b6f4711a3e57390da2f8d9630"><div class="ttname"><a href="classsf_1_1TcpListener.php#a59a1db5b6f4711a3e57390da2f8d9630">sf::TcpListener::TcpListener</a></div><div class="ttdeci">TcpListener()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php_a784b9a9c59d4cdbae1795e90b8015780"><div class="ttname"><a href="classsf_1_1TcpListener.php#a784b9a9c59d4cdbae1795e90b8015780">sf::TcpListener::getLocalPort</a></div><div class="ttdeci">unsigned short getLocalPort() const</div><div class="ttdoc">Get the port to which the socket is bound locally.</div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php_a9504758ea3570e62cb20b209c11776a1"><div class="ttname"><a href="classsf_1_1TcpListener.php#a9504758ea3570e62cb20b209c11776a1">sf::TcpListener::listen</a></div><div class="ttdeci">Status listen(unsigned short port, const IpAddress &amp;address=IpAddress::Any)</div><div class="ttdoc">Start listening for incoming connection attempts.</div></div>
<div class="ttc" id="aclasssf_1_1TcpListener_php_ae2c83ce5a64d50b68180c46bef0a7346"><div class="ttname"><a href="classsf_1_1TcpListener.php#ae2c83ce5a64d50b68180c46bef0a7346">sf::TcpListener::accept</a></div><div class="ttdeci">Status accept(TcpSocket &amp;socket)</div><div class="ttdoc">Accept a new connection.</div></div>
<div class="ttc" id="aclasssf_1_1TcpSocket_php"><div class="ttname"><a href="classsf_1_1TcpSocket.php">sf::TcpSocket</a></div><div class="ttdoc">Specialized socket using the TCP protocol.</div><div class="ttdef"><b>Definition</b> <a href="TcpSocket_8hpp_source.php#l00046">TcpSocket.hpp:47</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
