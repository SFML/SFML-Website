<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Http.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.10 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="pages.php"><span>Related&#160;Pages</span></a></li>
      <li><a href="modules.php"><span>Modules</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
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
<li class="navelem"><a class="el" href="dir_7107138a9ca528d5a30fb6c42d13b481.php">SFML</a></li><li class="navelem"><a class="el" href="dir_186e0dcb96ed2747fde77bc4d13d2016.php">include</a></li><li class="navelem"><a class="el" href="dir_8300c2a4f3c47520e59b1ed4cebc1d64.php">SFML</a></li><li class="navelem"><a class="el" href="dir_87ca8c5d0d8d239d6322f1e68c22e8c9.php">Network</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">Http.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2017 Laurent Gomila (laurent@sfml-dev.org)</span></div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_HTTP_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_HTTP_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Network/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Network/IpAddress.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Network/TcpSocket.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/System/NonCopyable.hpp&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;map&gt;</span></div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="preprocessor">#include &lt;string&gt;</span></div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;</div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;</div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;{</div>
<div class="line"><a name="l00046"></a><span class="lineno"><a class="line" href="classsf_1_1Http.php">   46</a></span>&#160;<span class="keyword">class </span>SFML_NETWORK_API <a class="code" href="classsf_1_1Http.php">Http</a> : <a class="code" href="classsf_1_1NonCopyable.php">NonCopyable</a></div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;{</div>
<div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;<span class="keyword">public</span>:</div>
<div class="line"><a name="l00049"></a><span class="lineno">   49</span>&#160;</div>
<div class="line"><a name="l00054"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php">   54</a></span>&#160;    <span class="keyword">class </span>SFML_NETWORK_API <a class="code" href="classsf_1_1Http_1_1Request.php">Request</a></div>
<div class="line"><a name="l00055"></a><span class="lineno">   55</span>&#160;    {</div>
<div class="line"><a name="l00056"></a><span class="lineno">   56</span>&#160;    <span class="keyword">public</span>:</div>
<div class="line"><a name="l00057"></a><span class="lineno">   57</span>&#160;</div>
<div class="line"><a name="l00062"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598">   62</a></span>&#160;        <span class="keyword">enum</span> <a class="code" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598">Method</a></div>
<div class="line"><a name="l00063"></a><span class="lineno">   63</span>&#160;        {</div>
<div class="line"><a name="l00064"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ab822baed393f3d0353621e5378b9fcb4">   64</a></span>&#160;            <a class="code" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ab822baed393f3d0353621e5378b9fcb4">Get</a>,   </div>
<div class="line"><a name="l00065"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ae8ec4048b9550f8d0747d4199603141a">   65</a></span>&#160;            <a class="code" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ae8ec4048b9550f8d0747d4199603141a">Post</a>,  </div>
<div class="line"><a name="l00066"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a4df23138be7ed60f47aba6548ba65e7b">   66</a></span>&#160;            <a class="code" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a4df23138be7ed60f47aba6548ba65e7b">Head</a>,  </div>
<div class="line"><a name="l00067"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a523b94f9af069c1f35061d32011e2495">   67</a></span>&#160;            <a class="code" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a523b94f9af069c1f35061d32011e2495">Put</a>,   </div>
<div class="line"><a name="l00068"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598abc9555b94c1b896185015ec3990999f9">   68</a></span>&#160;            Delete </div>
<div class="line"><a name="l00069"></a><span class="lineno">   69</span>&#160;        };</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;</div>
<div class="line"><a name="l00082"></a><span class="lineno">   82</span>&#160;        <a class="code" href="classsf_1_1Http_1_1Request.php">Request</a>(<span class="keyword">const</span> std::string&amp; uri = <span class="stringliteral">&quot;/&quot;</span>, Method method = Get, <span class="keyword">const</span> std::string&amp; body = <span class="stringliteral">&quot;&quot;</span>);</div>
<div class="line"><a name="l00083"></a><span class="lineno">   83</span>&#160;</div>
<div class="line"><a name="l00097"></a><span class="lineno">   97</span>&#160;        <span class="keywordtype">void</span> setField(<span class="keyword">const</span> std::string&amp; field, <span class="keyword">const</span> std::string&amp; value);</div>
<div class="line"><a name="l00098"></a><span class="lineno">   98</span>&#160;</div>
<div class="line"><a name="l00109"></a><span class="lineno">  109</span>&#160;        <span class="keywordtype">void</span> setMethod(Method method);</div>
<div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;</div>
<div class="line"><a name="l00121"></a><span class="lineno">  121</span>&#160;        <span class="keywordtype">void</span> setUri(<span class="keyword">const</span> std::string&amp; uri);</div>
<div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;</div>
<div class="line"><a name="l00132"></a><span class="lineno">  132</span>&#160;        <span class="keywordtype">void</span> setHttpVersion(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> major, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> minor);</div>
<div class="line"><a name="l00133"></a><span class="lineno">  133</span>&#160;</div>
<div class="line"><a name="l00144"></a><span class="lineno">  144</span>&#160;        <span class="keywordtype">void</span> setBody(<span class="keyword">const</span> std::string&amp; body);</div>
<div class="line"><a name="l00145"></a><span class="lineno">  145</span>&#160;</div>
<div class="line"><a name="l00146"></a><span class="lineno">  146</span>&#160;    <span class="keyword">private</span>:</div>
<div class="line"><a name="l00147"></a><span class="lineno">  147</span>&#160;</div>
<div class="line"><a name="l00148"></a><span class="lineno">  148</span>&#160;        <span class="keyword">friend</span> <span class="keyword">class </span><a class="code" href="classsf_1_1Http.php">Http</a>;</div>
<div class="line"><a name="l00149"></a><span class="lineno">  149</span>&#160;</div>
<div class="line"><a name="l00159"></a><span class="lineno">  159</span>&#160;        std::string prepare() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00160"></a><span class="lineno">  160</span>&#160;</div>
<div class="line"><a name="l00171"></a><span class="lineno">  171</span>&#160;        <span class="keywordtype">bool</span> hasField(<span class="keyword">const</span> std::string&amp; field) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00172"></a><span class="lineno">  172</span>&#160;</div>
<div class="line"><a name="l00174"></a><span class="lineno">  174</span>&#160;        <span class="comment">// Types</span></div>
<div class="line"><a name="l00176"></a><span class="lineno">  176</span>&#160;<span class="comment"></span>        <span class="keyword">typedef</span> std::map&lt;std::string, std::string&gt; FieldTable;</div>
<div class="line"><a name="l00177"></a><span class="lineno">  177</span>&#160;</div>
<div class="line"><a name="l00179"></a><span class="lineno">  179</span>&#160;        <span class="comment">// Member data</span></div>
<div class="line"><a name="l00181"></a><span class="lineno">  181</span>&#160;<span class="comment"></span>        FieldTable   m_fields;       </div>
<div class="line"><a name="l00182"></a><span class="lineno">  182</span>&#160;        Method       m_method;       </div>
<div class="line"><a name="l00183"></a><span class="lineno">  183</span>&#160;        std::string  m_uri;          </div>
<div class="line"><a name="l00184"></a><span class="lineno">  184</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> m_majorVersion; </div>
<div class="line"><a name="l00185"></a><span class="lineno">  185</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> m_minorVersion; </div>
<div class="line"><a name="l00186"></a><span class="lineno">  186</span>&#160;        std::string  m_body;         </div>
<div class="line"><a name="l00187"></a><span class="lineno">  187</span>&#160;    };</div>
<div class="line"><a name="l00188"></a><span class="lineno">  188</span>&#160;</div>
<div class="line"><a name="l00193"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php">  193</a></span>&#160;    <span class="keyword">class </span>SFML_NETWORK_API <a class="code" href="classsf_1_1Http_1_1Response.php">Response</a></div>
<div class="line"><a name="l00194"></a><span class="lineno">  194</span>&#160;    {</div>
<div class="line"><a name="l00195"></a><span class="lineno">  195</span>&#160;    <span class="keyword">public</span>:</div>
<div class="line"><a name="l00196"></a><span class="lineno">  196</span>&#160;</div>
<div class="line"><a name="l00201"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8">  201</a></span>&#160;        <span class="keyword">enum</span> <a class="code" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8">Status</a></div>
<div class="line"><a name="l00202"></a><span class="lineno">  202</span>&#160;        {</div>
<div class="line"><a name="l00203"></a><span class="lineno">  203</span>&#160;            <span class="comment">// 2xx: success</span></div>
<div class="line"><a name="l00204"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a0158f932254d3f09647dd1f64bd43832">  204</a></span>&#160;            Ok             = 200, </div>
<div class="line"><a name="l00205"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a0a6e8bafa9365a0ed10b8a9cbfd0649b">  205</a></span>&#160;            Created        = 201, </div>
<div class="line"><a name="l00206"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8ad328945457bd2f0d65107ba6b5ccd443">  206</a></span>&#160;            Accepted       = 202, </div>
<div class="line"><a name="l00207"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8aefde9e4abf5682dcd314d63143be42e0">  207</a></span>&#160;            NoContent      = 204, </div>
<div class="line"><a name="l00208"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a77327cc2a5e34cc64030b322e61d12a8">  208</a></span>&#160;            ResetContent   = 205, </div>
<div class="line"><a name="l00209"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a0cfae3ab0469b73dfddc54312a5e6a8a">  209</a></span>&#160;            PartialContent = 206, </div>
<div class="line"><a name="l00210"></a><span class="lineno">  210</span>&#160;</div>
<div class="line"><a name="l00211"></a><span class="lineno">  211</span>&#160;            <span class="comment">// 3xx: redirection</span></div>
<div class="line"><a name="l00212"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8add95cbd8fa27516821f763488557f96b">  212</a></span>&#160;            MultipleChoices  = 300, </div>
<div class="line"><a name="l00213"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a2f91651db3a09628faf68cbcefa0810a">  213</a></span>&#160;            MovedPermanently = 301, </div>
<div class="line"><a name="l00214"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a05c50d7b17c844e0b909e5802d5f1587">  214</a></span>&#160;            MovedTemporarily = 302, </div>
<div class="line"><a name="l00215"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a060ebc3af266e6bfe045b89e298e2545">  215</a></span>&#160;            NotModified      = 304, </div>
<div class="line"><a name="l00216"></a><span class="lineno">  216</span>&#160;</div>
<div class="line"><a name="l00217"></a><span class="lineno">  217</span>&#160;            <span class="comment">// 4xx: client error</span></div>
<div class="line"><a name="l00218"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a3f88a714cf5483ee22f9051e5a3c080a">  218</a></span>&#160;            BadRequest          = 400, </div>
<div class="line"><a name="l00219"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8ab7a79b7bff50fb1902c19eecbb4e2a2d">  219</a></span>&#160;            Unauthorized        = 401, </div>
<div class="line"><a name="l00220"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a64492842e823ebe12a85539b6b454986">  220</a></span>&#160;            Forbidden           = 403, </div>
<div class="line"><a name="l00221"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8affca8a8319a62d98bd3ef90ff5cfc030">  221</a></span>&#160;            NotFound            = 404, </div>
<div class="line"><a name="l00222"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a12533d00093b190e6d4c0076577e2239">  222</a></span>&#160;            RangeNotSatisfiable = 407, </div>
<div class="line"><a name="l00223"></a><span class="lineno">  223</span>&#160;</div>
<div class="line"><a name="l00224"></a><span class="lineno">  224</span>&#160;            <span class="comment">// 5xx: server error</span></div>
<div class="line"><a name="l00225"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8adae2b2a936414349d55b4ed8c583fed1">  225</a></span>&#160;            InternalServerError = 500, </div>
<div class="line"><a name="l00226"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a6920ba06d7e2bcf0b325da23ee95ef68">  226</a></span>&#160;            NotImplemented      = 501, </div>
<div class="line"><a name="l00227"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8aad0cbad4cdaf448beb763e86bc1f747c">  227</a></span>&#160;            BadGateway          = 502, </div>
<div class="line"><a name="l00228"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8ac4fffba9d5ad4c14171a1bbe4f6adf87">  228</a></span>&#160;            ServiceNotAvailable = 503, </div>
<div class="line"><a name="l00229"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a215935d823ab44694709a184a71353b0">  229</a></span>&#160;            GatewayTimeout      = 504, </div>
<div class="line"><a name="l00230"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8aeb32a1a087d5fcf1a42663eb40c3c305">  230</a></span>&#160;            VersionNotSupported = 505, </div>
<div class="line"><a name="l00231"></a><span class="lineno">  231</span>&#160;</div>
<div class="line"><a name="l00232"></a><span class="lineno">  232</span>&#160;            <span class="comment">// 10xx: SFML custom codes</span></div>
<div class="line"><a name="l00233"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a0af0090420e60bf54da4860749345c95">  233</a></span>&#160;            InvalidResponse  = 1000, </div>
<div class="line"><a name="l00234"></a><span class="lineno"><a class="line" href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8a7f307376f13bdc06b24fc274ecd2aa60">  234</a></span>&#160;            ConnectionFailed = 1001  </div>
<div class="line"><a name="l00235"></a><span class="lineno">  235</span>&#160;        };</div>
<div class="line"><a name="l00236"></a><span class="lineno">  236</span>&#160;</div>
<div class="line"><a name="l00243"></a><span class="lineno">  243</span>&#160;        <a class="code" href="classsf_1_1Http_1_1Response.php">Response</a>();</div>
<div class="line"><a name="l00244"></a><span class="lineno">  244</span>&#160;</div>
<div class="line"><a name="l00257"></a><span class="lineno">  257</span>&#160;        <span class="keyword">const</span> std::string&amp; getField(<span class="keyword">const</span> std::string&amp; field) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00258"></a><span class="lineno">  258</span>&#160;</div>
<div class="line"><a name="l00270"></a><span class="lineno">  270</span>&#160;        Status getStatus() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00271"></a><span class="lineno">  271</span>&#160;</div>
<div class="line"><a name="l00280"></a><span class="lineno">  280</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> getMajorHttpVersion() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00281"></a><span class="lineno">  281</span>&#160;</div>
<div class="line"><a name="l00290"></a><span class="lineno">  290</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> getMinorHttpVersion() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00291"></a><span class="lineno">  291</span>&#160;</div>
<div class="line"><a name="l00304"></a><span class="lineno">  304</span>&#160;        <span class="keyword">const</span> std::string&amp; getBody() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00305"></a><span class="lineno">  305</span>&#160;</div>
<div class="line"><a name="l00306"></a><span class="lineno">  306</span>&#160;    <span class="keyword">private</span>:</div>
<div class="line"><a name="l00307"></a><span class="lineno">  307</span>&#160;</div>
<div class="line"><a name="l00308"></a><span class="lineno">  308</span>&#160;        <span class="keyword">friend</span> <span class="keyword">class </span><a class="code" href="classsf_1_1Http.php">Http</a>;</div>
<div class="line"><a name="l00309"></a><span class="lineno">  309</span>&#160;</div>
<div class="line"><a name="l00319"></a><span class="lineno">  319</span>&#160;        <span class="keywordtype">void</span> parse(<span class="keyword">const</span> std::string&amp; data);</div>
<div class="line"><a name="l00320"></a><span class="lineno">  320</span>&#160;</div>
<div class="line"><a name="l00321"></a><span class="lineno">  321</span>&#160;</div>
<div class="line"><a name="l00331"></a><span class="lineno">  331</span>&#160;        <span class="keywordtype">void</span> parseFields(std::istream &amp;in);</div>
<div class="line"><a name="l00332"></a><span class="lineno">  332</span>&#160;</div>
<div class="line"><a name="l00334"></a><span class="lineno">  334</span>&#160;        <span class="comment">// Types</span></div>
<div class="line"><a name="l00336"></a><span class="lineno">  336</span>&#160;<span class="comment"></span>        <span class="keyword">typedef</span> std::map&lt;std::string, std::string&gt; FieldTable;</div>
<div class="line"><a name="l00337"></a><span class="lineno">  337</span>&#160;</div>
<div class="line"><a name="l00339"></a><span class="lineno">  339</span>&#160;        <span class="comment">// Member data</span></div>
<div class="line"><a name="l00341"></a><span class="lineno">  341</span>&#160;<span class="comment"></span>        FieldTable   m_fields;       </div>
<div class="line"><a name="l00342"></a><span class="lineno">  342</span>&#160;        Status       m_status;       </div>
<div class="line"><a name="l00343"></a><span class="lineno">  343</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> m_majorVersion; </div>
<div class="line"><a name="l00344"></a><span class="lineno">  344</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> m_minorVersion; </div>
<div class="line"><a name="l00345"></a><span class="lineno">  345</span>&#160;        std::string  m_body;         </div>
<div class="line"><a name="l00346"></a><span class="lineno">  346</span>&#160;    };</div>
<div class="line"><a name="l00347"></a><span class="lineno">  347</span>&#160;</div>
<div class="line"><a name="l00352"></a><span class="lineno">  352</span>&#160;    <a class="code" href="classsf_1_1Http.php">Http</a>();</div>
<div class="line"><a name="l00353"></a><span class="lineno">  353</span>&#160;</div>
<div class="line"><a name="l00368"></a><span class="lineno">  368</span>&#160;    <a class="code" href="classsf_1_1Http.php">Http</a>(<span class="keyword">const</span> std::string&amp; host, <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> port = 0);</div>
<div class="line"><a name="l00369"></a><span class="lineno">  369</span>&#160;</div>
<div class="line"><a name="l00385"></a><span class="lineno">  385</span>&#160;    <span class="keywordtype">void</span> setHost(<span class="keyword">const</span> std::string&amp; host, <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> port = 0);</div>
<div class="line"><a name="l00386"></a><span class="lineno">  386</span>&#160;</div>
<div class="line"><a name="l00405"></a><span class="lineno">  405</span>&#160;    Response sendRequest(<span class="keyword">const</span> Request&amp; request, <a class="code" href="classsf_1_1Time.php">Time</a> timeout = <a class="code" href="classsf_1_1Time.php#a8db127b632fa8da21550e7282af11fa0">Time::Zero</a>);</div>
<div class="line"><a name="l00406"></a><span class="lineno">  406</span>&#160;</div>
<div class="line"><a name="l00407"></a><span class="lineno">  407</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00408"></a><span class="lineno">  408</span>&#160;</div>
<div class="line"><a name="l00410"></a><span class="lineno">  410</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00412"></a><span class="lineno">  412</span>&#160;<span class="comment"></span>    <a class="code" href="classsf_1_1TcpSocket.php">TcpSocket</a>      m_connection; </div>
<div class="line"><a name="l00413"></a><span class="lineno">  413</span>&#160;    <a class="code" href="classsf_1_1IpAddress.php">IpAddress</a>      m_host;       </div>
<div class="line"><a name="l00414"></a><span class="lineno">  414</span>&#160;    std::string    m_hostName;   </div>
<div class="line"><a name="l00415"></a><span class="lineno">  415</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">short</span> m_port;       </div>
<div class="line"><a name="l00416"></a><span class="lineno">  416</span>&#160;};</div>
<div class="line"><a name="l00417"></a><span class="lineno">  417</span>&#160;</div>
<div class="line"><a name="l00418"></a><span class="lineno">  418</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00419"></a><span class="lineno">  419</span>&#160;</div>
<div class="line"><a name="l00420"></a><span class="lineno">  420</span>&#160;</div>
<div class="line"><a name="l00421"></a><span class="lineno">  421</span>&#160;<span class="preprocessor">#endif // SFML_HTTP_HPP</span></div>
<div class="line"><a name="l00422"></a><span class="lineno">  422</span>&#160;</div>
<div class="line"><a name="l00423"></a><span class="lineno">  423</span>&#160;</div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php">sf::Http::Request</a></div><div class="ttdoc">Define a HTTP request. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00054">Http.hpp:54</a></div></div>
<div class="ttc" id="classsf_1_1TcpSocket_php"><div class="ttname"><a href="classsf_1_1TcpSocket.php">sf::TcpSocket</a></div><div class="ttdoc">Specialized socket using the TCP protocol. </div><div class="ttdef"><b>Definition:</b> <a href="TcpSocket_8hpp_source.php#l00046">TcpSocket.hpp:46</a></div></div>
<div class="ttc" id="classsf_1_1IpAddress_php"><div class="ttname"><a href="classsf_1_1IpAddress.php">sf::IpAddress</a></div><div class="ttdoc">Encapsulate an IPv4 network address. </div><div class="ttdef"><b>Definition:</b> <a href="IpAddress_8hpp_source.php#l00044">IpAddress.hpp:44</a></div></div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="AlResource_8hpp_source.php#l00034">AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1Time_php"><div class="ttname"><a href="classsf_1_1Time.php">sf::Time</a></div><div class="ttdoc">Represents a time value. </div><div class="ttdef"><b>Definition:</b> <a href="Time_8hpp_source.php#l00040">Time.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1Time_php_a8db127b632fa8da21550e7282af11fa0"><div class="ttname"><a href="classsf_1_1Time.php#a8db127b632fa8da21550e7282af11fa0">sf::Time::Zero</a></div><div class="ttdeci">static const Time Zero</div><div class="ttdoc">Predefined "zero" time value. </div><div class="ttdef"><b>Definition:</b> <a href="Time_8hpp_source.php#l00085">Time.hpp:85</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php_a620f8bff6f43e1378f321bf53fbf5598"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598">sf::Http::Request::Method</a></div><div class="ttdeci">Method</div><div class="ttdoc">Enumerate the available HTTP methods for a request. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00062">Http.hpp:62</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Response_php_a663e071978e30fbbeb20ed045be874d8"><div class="ttname"><a href="classsf_1_1Http_1_1Response.php#a663e071978e30fbbeb20ed045be874d8">sf::Http::Response::Status</a></div><div class="ttdeci">Status</div><div class="ttdoc">Enumerate all the valid status codes for a response. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00201">Http.hpp:201</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php_a620f8bff6f43e1378f321bf53fbf5598ab822baed393f3d0353621e5378b9fcb4"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ab822baed393f3d0353621e5378b9fcb4">sf::Http::Request::Get</a></div><div class="ttdoc">Request in get mode, standard method to retrieve a page. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00064">Http.hpp:64</a></div></div>
<div class="ttc" id="classsf_1_1Http_php"><div class="ttname"><a href="classsf_1_1Http.php">sf::Http</a></div><div class="ttdoc">A HTTP client. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00046">Http.hpp:46</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Response_php"><div class="ttname"><a href="classsf_1_1Http_1_1Response.php">sf::Http::Response</a></div><div class="ttdoc">Define a HTTP response. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00193">Http.hpp:193</a></div></div>
<div class="ttc" id="classsf_1_1NonCopyable_php"><div class="ttname"><a href="classsf_1_1NonCopyable.php">sf::NonCopyable</a></div><div class="ttdoc">Utility class that makes any derived class non-copyable. </div><div class="ttdef"><b>Definition:</b> <a href="NonCopyable_8hpp_source.php#l00041">NonCopyable.hpp:41</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php_a620f8bff6f43e1378f321bf53fbf5598a4df23138be7ed60f47aba6548ba65e7b"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a4df23138be7ed60f47aba6548ba65e7b">sf::Http::Request::Head</a></div><div class="ttdoc">Request a page&#39;s header only. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00066">Http.hpp:66</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php_a620f8bff6f43e1378f321bf53fbf5598ae8ec4048b9550f8d0747d4199603141a"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598ae8ec4048b9550f8d0747d4199603141a">sf::Http::Request::Post</a></div><div class="ttdoc">Request in post mode, usually to send data to a page. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00065">Http.hpp:65</a></div></div>
<div class="ttc" id="classsf_1_1Http_1_1Request_php_a620f8bff6f43e1378f321bf53fbf5598a523b94f9af069c1f35061d32011e2495"><div class="ttname"><a href="classsf_1_1Http_1_1Request.php#a620f8bff6f43e1378f321bf53fbf5598a523b94f9af069c1f35061d32011e2495">sf::Http::Request::Put</a></div><div class="ttdoc">Request in put mode, useful for a REST API. </div><div class="ttdef"><b>Definition:</b> <a href="Http_8hpp_source.php#l00067">Http.hpp:67</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
