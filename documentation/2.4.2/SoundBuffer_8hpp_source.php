<?php
    $version = '2.4.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'SoundBuffer.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_7107138a9ca528d5a30fb6c42d13b481.php">SFML</a></li><li class="navelem"><a class="el" href="dir_186e0dcb96ed2747fde77bc4d13d2016.php">include</a></li><li class="navelem"><a class="el" href="dir_8300c2a4f3c47520e59b1ed4cebc1d64.php">SFML</a></li><li class="navelem"><a class="el" href="dir_985e7cc4f3a776db56f3b932018351f7.php">Audio</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">SoundBuffer.hpp</div>  </div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_SOUNDBUFFER_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_SOUNDBUFFER_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Audio/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Audio/AlResource.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;string&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;vector&gt;</span></div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;set&gt;</span></div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;</div>
<div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div>
<div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;{</div>
<div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;<span class="keyword">class </span>Sound;</div>
<div class="line"><a name="l00042"></a><span class="lineno">   42</span>&#160;<span class="keyword">class </span>InputSoundFile;</div>
<div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;<span class="keyword">class </span>InputStream;</div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;</div>
<div class="line"><a name="l00049"></a><span class="lineno"><a class="line" href="classsf_1_1SoundBuffer.php">   49</a></span>&#160;<span class="keyword">class </span>SFML_AUDIO_API <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a> : <a class="code" href="classsf_1_1AlResource.php">AlResource</a></div>
<div class="line"><a name="l00050"></a><span class="lineno">   50</span>&#160;{</div>
<div class="line"><a name="l00051"></a><span class="lineno">   51</span>&#160;<span class="keyword">public</span>:</div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;</div>
<div class="line"><a name="l00057"></a><span class="lineno">   57</span>&#160;    <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>();</div>
<div class="line"><a name="l00058"></a><span class="lineno">   58</span>&#160;</div>
<div class="line"><a name="l00065"></a><span class="lineno">   65</span>&#160;    <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>(<span class="keyword">const</span> <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>&amp; copy);</div>
<div class="line"><a name="l00066"></a><span class="lineno">   66</span>&#160;</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;    ~<a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>();</div>
<div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;</div>
<div class="line"><a name="l00086"></a><span class="lineno">   86</span>&#160;    <span class="keywordtype">bool</span> loadFromFile(<span class="keyword">const</span> std::string&amp; filename);</div>
<div class="line"><a name="l00087"></a><span class="lineno">   87</span>&#160;</div>
<div class="line"><a name="l00102"></a><span class="lineno">  102</span>&#160;    <span class="keywordtype">bool</span> loadFromMemory(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t sizeInBytes);</div>
<div class="line"><a name="l00103"></a><span class="lineno">  103</span>&#160;</div>
<div class="line"><a name="l00117"></a><span class="lineno">  117</span>&#160;    <span class="keywordtype">bool</span> loadFromStream(<a class="code" href="classsf_1_1InputStream.php">InputStream</a>&amp; stream);</div>
<div class="line"><a name="l00118"></a><span class="lineno">  118</span>&#160;</div>
<div class="line"><a name="l00135"></a><span class="lineno">  135</span>&#160;    <span class="keywordtype">bool</span> loadFromSamples(<span class="keyword">const</span> Int16* samples, Uint64 sampleCount, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> channelCount, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> sampleRate);</div>
<div class="line"><a name="l00136"></a><span class="lineno">  136</span>&#160;</div>
<div class="line"><a name="l00150"></a><span class="lineno">  150</span>&#160;    <span class="keywordtype">bool</span> saveToFile(<span class="keyword">const</span> std::string&amp; filename) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00151"></a><span class="lineno">  151</span>&#160;</div>
<div class="line"><a name="l00164"></a><span class="lineno">  164</span>&#160;    <span class="keyword">const</span> Int16* getSamples() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00165"></a><span class="lineno">  165</span>&#160;</div>
<div class="line"><a name="l00177"></a><span class="lineno">  177</span>&#160;    Uint64 getSampleCount() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00178"></a><span class="lineno">  178</span>&#160;</div>
<div class="line"><a name="l00191"></a><span class="lineno">  191</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> getSampleRate() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00192"></a><span class="lineno">  192</span>&#160;</div>
<div class="line"><a name="l00204"></a><span class="lineno">  204</span>&#160;    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> getChannelCount() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00205"></a><span class="lineno">  205</span>&#160;</div>
<div class="line"><a name="l00214"></a><span class="lineno">  214</span>&#160;    <a class="code" href="classsf_1_1Time.php">Time</a> getDuration() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00215"></a><span class="lineno">  215</span>&#160;</div>
<div class="line"><a name="l00224"></a><span class="lineno">  224</span>&#160;    <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>&amp; operator =(<span class="keyword">const</span> <a class="code" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>&amp; right);</div>
<div class="line"><a name="l00225"></a><span class="lineno">  225</span>&#160;</div>
<div class="line"><a name="l00226"></a><span class="lineno">  226</span>&#160;<span class="keyword">private</span>:</div>
<div class="line"><a name="l00227"></a><span class="lineno">  227</span>&#160;</div>
<div class="line"><a name="l00228"></a><span class="lineno">  228</span>&#160;    <span class="keyword">friend</span> <span class="keyword">class </span><a class="code" href="classsf_1_1Sound.php">Sound</a>;</div>
<div class="line"><a name="l00229"></a><span class="lineno">  229</span>&#160;</div>
<div class="line"><a name="l00238"></a><span class="lineno">  238</span>&#160;    <span class="keywordtype">bool</span> initialize(<a class="code" href="classsf_1_1InputSoundFile.php">InputSoundFile</a>&amp; file);</div>
<div class="line"><a name="l00239"></a><span class="lineno">  239</span>&#160;</div>
<div class="line"><a name="l00249"></a><span class="lineno">  249</span>&#160;    <span class="keywordtype">bool</span> update(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> channelCount, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> sampleRate);</div>
<div class="line"><a name="l00250"></a><span class="lineno">  250</span>&#160;</div>
<div class="line"><a name="l00257"></a><span class="lineno">  257</span>&#160;    <span class="keywordtype">void</span> attachSound(<a class="code" href="classsf_1_1Sound.php">Sound</a>* sound) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00258"></a><span class="lineno">  258</span>&#160;</div>
<div class="line"><a name="l00265"></a><span class="lineno">  265</span>&#160;    <span class="keywordtype">void</span> detachSound(<a class="code" href="classsf_1_1Sound.php">Sound</a>* sound) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00266"></a><span class="lineno">  266</span>&#160;</div>
<div class="line"><a name="l00268"></a><span class="lineno">  268</span>&#160;    <span class="comment">// Types</span></div>
<div class="line"><a name="l00270"></a><span class="lineno">  270</span>&#160;<span class="comment"></span>    <span class="keyword">typedef</span> std::set&lt;Sound*&gt; SoundList; </div>
<div class="line"><a name="l00271"></a><span class="lineno">  271</span>&#160;</div>
<div class="line"><a name="l00273"></a><span class="lineno">  273</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00275"></a><span class="lineno">  275</span>&#160;<span class="comment"></span>    <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span>       m_buffer;   </div>
<div class="line"><a name="l00276"></a><span class="lineno">  276</span>&#160;    std::vector&lt;Int16&gt; m_samples;  </div>
<div class="line"><a name="l00277"></a><span class="lineno">  277</span>&#160;    <a class="code" href="classsf_1_1Time.php">Time</a>               m_duration; </div>
<div class="line"><a name="l00278"></a><span class="lineno">  278</span>&#160;    <span class="keyword">mutable</span> SoundList  m_sounds;   </div>
<div class="line"><a name="l00279"></a><span class="lineno">  279</span>&#160;};</div>
<div class="line"><a name="l00280"></a><span class="lineno">  280</span>&#160;</div>
<div class="line"><a name="l00281"></a><span class="lineno">  281</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00282"></a><span class="lineno">  282</span>&#160;</div>
<div class="line"><a name="l00283"></a><span class="lineno">  283</span>&#160;</div>
<div class="line"><a name="l00284"></a><span class="lineno">  284</span>&#160;<span class="preprocessor">#endif // SFML_SOUNDBUFFER_HPP</span></div>
<div class="line"><a name="l00285"></a><span class="lineno">  285</span>&#160;</div>
<div class="line"><a name="l00286"></a><span class="lineno">  286</span>&#160;</div>
<div class="ttc" id="classsf_1_1InputStream_php"><div class="ttname"><a href="classsf_1_1InputStream.php">sf::InputStream</a></div><div class="ttdoc">Abstract class for custom file input streams. </div><div class="ttdef"><b>Definition:</b> <a href="InputStream_8hpp_source.php#l00041">InputStream.hpp:41</a></div></div>
<div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="AlResource_8hpp_source.php#l00034">AlResource.hpp:34</a></div></div>
<div class="ttc" id="classsf_1_1Time_php"><div class="ttname"><a href="classsf_1_1Time.php">sf::Time</a></div><div class="ttdoc">Represents a time value. </div><div class="ttdef"><b>Definition:</b> <a href="Time_8hpp_source.php#l00040">Time.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1AlResource_php"><div class="ttname"><a href="classsf_1_1AlResource.php">sf::AlResource</a></div><div class="ttdoc">Base class for classes that require an OpenAL context. </div><div class="ttdef"><b>Definition:</b> <a href="AlResource_8hpp_source.php#l00040">AlResource.hpp:40</a></div></div>
<div class="ttc" id="classsf_1_1SoundBuffer_php"><div class="ttname"><a href="classsf_1_1SoundBuffer.php">sf::SoundBuffer</a></div><div class="ttdoc">Storage for audio samples defining a sound. </div><div class="ttdef"><b>Definition:</b> <a href="SoundBuffer_8hpp_source.php#l00049">SoundBuffer.hpp:49</a></div></div>
<div class="ttc" id="classsf_1_1Sound_php"><div class="ttname"><a href="classsf_1_1Sound.php">sf::Sound</a></div><div class="ttdoc">Regular sound that can be played in the audio environment. </div><div class="ttdef"><b>Definition:</b> <a href="Sound_8hpp_source.php#l00045">Sound.hpp:45</a></div></div>
<div class="ttc" id="classsf_1_1InputSoundFile_php"><div class="ttname"><a href="classsf_1_1InputSoundFile.php">sf::InputSoundFile</a></div><div class="ttdoc">Provide read access to sound files. </div><div class="ttdef"><b>Definition:</b> <a href="InputSoundFile_8hpp_source.php#l00046">InputSoundFile.hpp:46</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer.php");
?>
