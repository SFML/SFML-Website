<?php
    $version = '2.4.1'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'SocketSelector.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.12 -->
<script type="text/javascript" src="menudata.js"></script>
<script type="text/javascript" src="menu.js"></script>
<script type="text/javascript">
$(function() {
  initMenu('',false,false,'search.php','Search');
});
</script>
<div id="main-nav"></div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_5c1116cdc74b8c7983261a15f16adc17.php">Network</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">include/SFML/Network/SocketSelector.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div><div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2016 Laurent Gomila (laurent@sfml-dev.org)</span></div><div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div><div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div><div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div><div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div><div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">// subject to the following restrictions:</span></div><div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">// 1. The origin of this software must not be misrepresented;</span></div><div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">//    you must not claim that you wrote the original software.</span></div><div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">//    If you use this software in a product, an acknowledgment</span></div><div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">//    in the product documentation would be appreciated but is not required.</span></div><div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;<span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div><div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;<span class="comment">//    and must not be misrepresented as being the original software.</span></div><div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;<span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div><div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;<span class="comment"></span></div><div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_SOCKETSELECTOR_HPP</span></div><div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_SOCKETSELECTOR_HPP</span></div><div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div><div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div><div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Network/Export.hpp&gt;</span></div><div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div><div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;</div><div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div><div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div><div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;{</div><div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="keyword">class </span>Socket;</div><div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;</div><div class="line"><a name="l00043"></a><span class="lineno"><a class="line" href="classsf_1_1SocketSelector.php">   43</a></span>&#160;<span class="keyword">class </span>SFML_NETWORK_API <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a></div><div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;{</div><div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;<span class="keyword">public</span>:</div><div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;</div><div class="line"><a name="l00051"></a><span class="lineno">   51</span>&#160;    <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>();</div><div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;</div><div class="line"><a name="l00059"></a><span class="lineno">   59</span>&#160;    <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>(<span class="keyword">const</span> <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; copy);</div><div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;</div><div class="line"><a name="l00065"></a><span class="lineno">   65</span>&#160;    ~<a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>();</div><div class="line"><a name="l00066"></a><span class="lineno">   66</span>&#160;</div><div class="line"><a name="l00080"></a><span class="lineno">   80</span>&#160;    <span class="keywordtype">void</span> add(<a class="code" href="classsf_1_1Socket.php">Socket</a>&amp; socket);</div><div class="line"><a name="l00081"></a><span class="lineno">   81</span>&#160;</div><div class="line"><a name="l00093"></a><span class="lineno">   93</span>&#160;    <span class="keywordtype">void</span> <span class="keyword">remove</span>(<a class="code" href="classsf_1_1Socket.php">Socket</a>&amp; socket);</div><div class="line"><a name="l00094"></a><span class="lineno">   94</span>&#160;</div><div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;    <span class="keywordtype">void</span> clear();</div><div class="line"><a name="l00106"></a><span class="lineno">  106</span>&#160;</div><div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;    <span class="keywordtype">bool</span> wait(<a class="code" href="classsf_1_1Time.php">Time</a> timeout = <a class="code" href="classsf_1_1Time.php#aa343e67f43a940e7b3b51aa10a495f2f">Time::Zero</a>);</div><div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;</div><div class="line"><a name="l00142"></a><span class="lineno">  142</span>&#160;    <span class="keywordtype">bool</span> isReady(<a class="code" href="classsf_1_1Socket.php">Socket</a>&amp; socket) <span class="keyword">const</span>;</div><div class="line"><a name="l00143"></a><span class="lineno">  143</span>&#160;</div><div class="line"><a name="l00152"></a><span class="lineno">  152</span>&#160;    <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; operator =(<span class="keyword">const</span> <a class="code" href="classsf_1_1SocketSelector.php">SocketSelector</a>&amp; right);</div><div class="line"><a name="l00153"></a><span class="lineno">  153</span>&#160;</div><div class="line"><a name="l00154"></a><span class="lineno">  154</span>&#160;<span class="keyword">private</span>:</div><div class="line"><a name="l00155"></a><span class="lineno">  155</span>&#160;</div><div class="line"><a name="l00156"></a><span class="lineno">  156</span>&#160;    <span class="keyword">struct </span>SocketSelectorImpl;</div><div class="line"><a name="l00157"></a><span class="lineno">  157</span>&#160;</div><div class="line"><a name="l00159"></a><span class="lineno">  159</span>&#160;    <span class="comment">// Member data</span></div><div class="line"><a name="l00161"></a><span class="lineno">  161</span>&#160;<span class="comment"></span>    SocketSelectorImpl* m_impl; </div><div class="line"><a name="l00162"></a><span class="lineno">  162</span>&#160;};</div><div class="line"><a name="l00163"></a><span class="lineno">  163</span>&#160;</div><div class="line"><a name="l00164"></a><span class="lineno">  164</span>&#160;} <span class="comment">// namespace sf</span></div><div class="line"><a name="l00165"></a><span class="lineno">  165</span>&#160;</div><div class="line"><a name="l00166"></a><span class="lineno">  166</span>&#160;</div><div class="line"><a name="l00167"></a><span class="lineno">  167</span>&#160;<span class="preprocessor">#endif // SFML_SOCKETSELECTOR_HPP</span></div><div class="line"><a name="l00168"></a><span class="lineno">  168</span>&#160;</div><div class="line"><a name="l00169"></a><span class="lineno">  169</span>&#160;</div><div class="ttc" id="classsf_1_1SocketSelector_php"><div class="ttname"><a href="classsf_1_1SocketSelector.php">sf::SocketSelector</a></div><div class="ttdoc">Multiplexer that allows to read from multiple sockets. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Network_2SocketSelector_8hpp_source.php#l00043">include/SFML/Network/SocketSelector.hpp:43</a></div></div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Audio_2AlResource_8hpp_source.php#l00034">include/SFML/Audio/AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1Time_php_aa343e67f43a940e7b3b51aa10a495f2f"><div class="ttname"><a href="classsf_1_1Time.php#aa343e67f43a940e7b3b51aa10a495f2f">sf::Time::Zero</a></div><div class="ttdeci">static const Time Zero</div><div class="ttdoc">Predefined &quot;zero&quot; time value. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2System_2Time_8hpp_source.php#l00085">include/SFML/System/Time.hpp:85</a></div></div>
<div class="ttc" id="classsf_1_1Time_php"><div class="ttname"><a href="classsf_1_1Time.php">sf::Time</a></div><div class="ttdoc">Represents a time value. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2System_2Time_8hpp_source.php#l00040">include/SFML/System/Time.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1Socket_php"><div class="ttname"><a href="classsf_1_1Socket.php">sf::Socket</a></div><div class="ttdoc">Base class for all the socket types. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Network_2Socket_8hpp_source.php#l00045">include/SFML/Network/Socket.hpp:45</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
