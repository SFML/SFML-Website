<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li><a href="annotated.php"><span>Classes</span></a></li>
      <li class="current"><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="files.php"><span>File&#160;List</span></a></li>
    </ul>
  </div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><a class="el" href="dir_83ae1a5e8455fc62607b4936b42116e9.php">sfml</a></li><li class="navelem"><a class="el" href="dir_79a044fa5ec8bbf4af7d440d8995a178.php">sfml</a></li><li class="navelem"><a class="el" href="dir_f3190241575fd2bd132a392ae6942f4a.php">include</a></li><li class="navelem"><a class="el" href="dir_692f376662c82a26cfe4cfa3aceebe24.php">SFML</a></li><li class="navelem"><a class="el" href="dir_b9ac88db2949395b3130dd4ffb1be4e1.php">Network</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">TcpSocket.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;</div>
<div class="line"><a name="l00002"></a><span class="lineno">    2</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2013 Laurent Gomila (laurent.gom@gmail.com)</span></div>
<div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div>
<div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div>
<div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div>
<div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div>
<div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">// subject to the following restrictions:</span></div>
<div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">// 1. The origin of this software must not be misrepresented;</span></div>
<div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">//    you must not claim that you wrote the original software.</span></div>
<div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">//    If you use this software in a product, an acknowledgment</span></div>
<div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">//    in the product documentation would be appreciated but is not required.</span></div>
<div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;<span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div>
<div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;<span class="comment">//    and must not be misrepresented as being the original software.</span></div>
<div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;<span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div>
<div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;<span class="comment"></span></div>
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_TCPSOCKET_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_TCPSOCKET_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Network/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Network/Socket.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;{</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="keyword">class </span>TcpListener;</div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="keyword">class </span>IpAddress;</div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;<span class="keyword">class </span>Packet;</div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;</div>
<div class="line"><a name="l00046"></a><span class="lineno"><a class="code" href="classsf_1_1TcpSocket.php">   46</a></span>&#160;<span class="keyword">class </span>SFML_NETWORK_API <a class="code" href="classsf_1_1TcpSocket.php" title="Specialized socket using the TCP protocol.">TcpSocket</a> : <span class="keyword">public</span> <a class="code" href="classsf_1_1Socket.php" title="Base class for all the socket types.">Socket</a></div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;{</div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;</div>
<div class="line"><a name="l00054"></a><span class="lineno">   54</span>&#160;    <a class="code" href="classsf_1_1TcpSocket.php" title="Specialized socket using the TCP protocol.">TcpSocket</a>();</div>
<div class="line"><a name="l00055"></a><span class="lineno">   55</span>&#160;</div>
<div class="line"><a name="l00066"></a><span class="lineno">   66</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> getLocalPort() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00067"></a><span class="lineno">   67</span>&#160;</div>
<div class="line"><a name="l00079"></a><span class="lineno">   79</span>&#160;    <a class="code" href="classsf_1_1IpAddress.php" title="Encapsulate an IPv4 network address.">IpAddress</a> getRemoteAddress() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00080"></a><span class="lineno">   80</span>&#160;</div>
<div class="line"><a name="l00092"></a><span class="lineno">   92</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> getRemotePort() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00093"></a><span class="lineno">   93</span>&#160;</div>
<div class="line"><a name="l00111"></a><span class="lineno">  111</span>&#160;    <a class="code" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc" title="Status codes that may be returned by socket functions.">Status</a> connect(<span class="keyword">const</span> <a class="code" href="classsf_1_1IpAddress.php" title="Encapsulate an IPv4 network address.">IpAddress</a>&amp; remoteAddress, <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> remotePort, <a class="code" href="classsf_1_1Time.php" title="Represents a time value.">Time</a> timeout = <a class="code" href="classsf_1_1Time.php#a8db127b632fa8da21550e7282af11fa0" title="Predefined &quot;zero&quot; time value.">Time::Zero</a>);</div>
<div class="line"><a name="l00112"></a><span class="lineno">  112</span>&#160;</div>
<div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;    <span class="keywordtype">void</span> disconnect();</div>
<div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;</div>
<div class="line"><a name="l00137"></a><span class="lineno">  137</span>&#160;    <a class="code" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc" title="Status codes that may be returned by socket functions.">Status</a> send(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t size);</div>
<div class="line"><a name="l00138"></a><span class="lineno">  138</span>&#160;</div>
<div class="line"><a name="l00155"></a><span class="lineno">  155</span>&#160;    <a class="code" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc" title="Status codes that may be returned by socket functions.">Status</a> receive(<span class="keywordtype">void</span>* data, std::size_t size, std::size_t&amp; received);</div>
<div class="line"><a name="l00156"></a><span class="lineno">  156</span>&#160;</div>
<div class="line"><a name="l00169"></a><span class="lineno">  169</span>&#160;    <a class="code" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc" title="Status codes that may be returned by socket functions.">Status</a> send(<a class="code" href="classsf_1_1Packet.php" title="Utility class to build blocks of data to transfer over the network.">Packet</a>&amp; packet);</div>
<div class="line"><a name="l00170"></a><span class="lineno">  170</span>&#160;</div>
<div class="line"><a name="l00185"></a><span class="lineno">  185</span>&#160;    <a class="code" href="classsf_1_1Socket.php#a51bf0fd51057b98a10fbb866246176dc" title="Status codes that may be returned by socket functions.">Status</a> receive(<a class="code" href="classsf_1_1Packet.php" title="Utility class to build blocks of data to transfer over the network.">Packet</a>&amp; packet);</div>
<div class="line"><a name="l00186"></a><span class="lineno">  186</span>&#160;</div>
<div class="line"><a name="l00187"></a><span class="lineno">  187</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00188"></a><span class="lineno">  188</span>&#160;</div>
<div class="line"><a name="l00189"></a><span class="lineno">  189</span>&#160;    <span class="keyword">friend</span> <span class="keyword">class </span><a class="code" href="classsf_1_1TcpListener.php" title="Socket that listens to new TCP connections.">TcpListener</a>;</div>
<div class="line"><a name="l00190"></a><span class="lineno">  190</span>&#160;</div>
<div class="line"><a name="l00195"></a><span class="lineno">  195</span>&#160;    <span class="keyword">struct </span>PendingPacket</div>
<div class="line"><a name="l00196"></a><span class="lineno">  196</span>&#160;    {</div>
<div class="line"><a name="l00197"></a><span class="lineno">  197</span>&#160;        PendingPacket();</div>
<div class="line"><a name="l00198"></a><span class="lineno">  198</span>&#160;</div>
<div class="line"><a name="l00199"></a><span class="lineno">  199</span>&#160;        Uint32            Size;         </div>
<div class="line"><a name="l00200"></a><span class="lineno">  200</span>&#160;        std::size_t       SizeReceived; </div>
<div class="line"><a name="l00201"></a><span class="lineno">  201</span>&#160;        std::vector&lt;char&gt; Data;         </div>
<div class="line"><a name="l00202"></a><span class="lineno">  202</span>&#160;    };</div>
<div class="line"><a name="l00203"></a><span class="lineno">  203</span>&#160;</div>
<div class="line"><a name="l00205"></a><span class="lineno">  205</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00207"></a><span class="lineno">  207</span>&#160;<span class="comment"></span>    PendingPacket m_pendingPacket; </div>
<div class="line"><a name="l00208"></a><span class="lineno">  208</span>&#160;};</div>
<div class="line"><a name="l00209"></a><span class="lineno">  209</span>&#160;</div>
<div class="line"><a name="l00210"></a><span class="lineno">  210</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00211"></a><span class="lineno">  211</span>&#160;</div>
<div class="line"><a name="l00212"></a><span class="lineno">  212</span>&#160;</div>
<div class="line"><a name="l00213"></a><span class="lineno">  213</span>&#160;<span class="preprocessor">#endif // SFML_TCPSOCKET_HPP</span></div>
<div class="line"><a name="l00214"></a><span class="lineno">  214</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00215"></a><span class="lineno">  215</span>&#160;</div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
