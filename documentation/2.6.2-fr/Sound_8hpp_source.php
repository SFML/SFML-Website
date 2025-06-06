<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Sound.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_d40d7bd09aef4492c34dbfa99aea32ef.php">Audio</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">Sound.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_SOUND_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_SOUND_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Audio/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/Audio/SoundSource.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span><span class="preprocessor">#include &lt;cstdlib&gt;</span></div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span> </div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00038" name="l00038"></a><span class="lineno">   38</span>{</div>
<div class="line"><a id="l00039" name="l00039"></a><span class="lineno">   39</span><span class="keyword">class </span>SoundBuffer;</div>
<div class="line"><a id="l00040" name="l00040"></a><span class="lineno">   40</span> </div>
<div class="foldopen" id="foldopen00045" data-start="{" data-end="};">
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php">   45</a></span><span class="keyword">class </span>SFML_AUDIO_API <a class="code hl_class" href="classsf_1_1Sound.php">Sound</a> : <span class="keyword">public</span> <a class="code hl_class" href="classsf_1_1SoundSource.php">SoundSource</a></div>
<div class="line"><a id="l00046" name="l00046"></a><span class="lineno">   46</span>{</div>
<div class="line"><a id="l00047" name="l00047"></a><span class="lineno">   47</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00048" name="l00048"></a><span class="lineno">   48</span> </div>
<div class="line"><a id="l00053" name="l00053"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a36ab74beaaa953d9879c933ddd246282">   53</a></span>    <a class="code hl_function" href="classsf_1_1Sound.php#a36ab74beaaa953d9879c933ddd246282">Sound</a>();</div>
<div class="line"><a id="l00054" name="l00054"></a><span class="lineno">   54</span> </div>
<div class="line"><a id="l00061" name="l00061"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a3b1cfc19a856d4ff8c079ee41bb78e69">   61</a></span>    <span class="keyword">explicit</span> <a class="code hl_function" href="classsf_1_1Sound.php#a3b1cfc19a856d4ff8c079ee41bb78e69">Sound</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>&amp; buffer);</div>
<div class="line"><a id="l00062" name="l00062"></a><span class="lineno">   62</span> </div>
<div class="line"><a id="l00069" name="l00069"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#ae05eeed6377932694d86b3011be366c0">   69</a></span>    <a class="code hl_function" href="classsf_1_1Sound.php#ae05eeed6377932694d86b3011be366c0">Sound</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Sound.php">Sound</a>&amp; copy);</div>
<div class="line"><a id="l00070" name="l00070"></a><span class="lineno">   70</span> </div>
<div class="line"><a id="l00075" name="l00075"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#ad0792c35310eba2dffd8489c80fad076">   75</a></span>    <a class="code hl_function" href="classsf_1_1Sound.php#ad0792c35310eba2dffd8489c80fad076">~Sound</a>();</div>
<div class="line"><a id="l00076" name="l00076"></a><span class="lineno">   76</span> </div>
<div class="line"><a id="l00089" name="l00089"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a2953ffe632536e72e696fd880ced2532">   89</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#a2953ffe632536e72e696fd880ced2532">play</a>();</div>
<div class="line"><a id="l00090" name="l00090"></a><span class="lineno">   90</span> </div>
<div class="line"><a id="l00100" name="l00100"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a5eeb25815bfa8cdc4a6cc000b7b19ad5">  100</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#a5eeb25815bfa8cdc4a6cc000b7b19ad5">pause</a>();</div>
<div class="line"><a id="l00101" name="l00101"></a><span class="lineno">  101</span> </div>
<div class="line"><a id="l00112" name="l00112"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#aa9c91c34f7c6d344d5ee9b997511f754">  112</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#aa9c91c34f7c6d344d5ee9b997511f754">stop</a>();</div>
<div class="line"><a id="l00113" name="l00113"></a><span class="lineno">  113</span> </div>
<div class="line"><a id="l00126" name="l00126"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a8b395e9713d0efa48a18628c8ec1972e">  126</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#a8b395e9713d0efa48a18628c8ec1972e">setBuffer</a>(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>&amp; buffer);</div>
<div class="line"><a id="l00127" name="l00127"></a><span class="lineno">  127</span> </div>
<div class="line"><a id="l00141" name="l00141"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#af23ab4f78f975bbabac031102321612b">  141</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#af23ab4f78f975bbabac031102321612b">setLoop</a>(<span class="keywordtype">bool</span> loop);</div>
<div class="line"><a id="l00142" name="l00142"></a><span class="lineno">  142</span> </div>
<div class="line"><a id="l00156" name="l00156"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#ab905677846558042022dd6ab15cddff0">  156</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#ab905677846558042022dd6ab15cddff0">setPlayingOffset</a>(<a class="code hl_class" href="classsf_1_1Time.php">Time</a> timeOffset);</div>
<div class="line"><a id="l00157" name="l00157"></a><span class="lineno">  157</span> </div>
<div class="line"><a id="l00164" name="l00164"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a7c0f6033856909eeefa2e6696db96ef2">  164</a></span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>* <a class="code hl_function" href="classsf_1_1Sound.php#a7c0f6033856909eeefa2e6696db96ef2">getBuffer</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00165" name="l00165"></a><span class="lineno">  165</span> </div>
<div class="line"><a id="l00174" name="l00174"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a054da07266ce8f39229495146e3041eb">  174</a></span>    <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Sound.php#a054da07266ce8f39229495146e3041eb">getLoop</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00175" name="l00175"></a><span class="lineno">  175</span> </div>
<div class="line"><a id="l00184" name="l00184"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a559bc3aea581107bcb380fdbe523aa08">  184</a></span>    <a class="code hl_class" href="classsf_1_1Time.php">Time</a> <a class="code hl_function" href="classsf_1_1Sound.php#a559bc3aea581107bcb380fdbe523aa08">getPlayingOffset</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00185" name="l00185"></a><span class="lineno">  185</span> </div>
<div class="line"><a id="l00192" name="l00192"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a406fc363594a7718a53ebef49a870f51">  192</a></span>    <a class="code hl_enumeration" href="classsf_1_1SoundSource.php#ac43af72c98c077500b239bc75b812f03">Status</a> <a class="code hl_function" href="classsf_1_1Sound.php#a406fc363594a7718a53ebef49a870f51">getStatus</a>() <span class="keyword">const</span>;</div>
<div class="line"><a id="l00193" name="l00193"></a><span class="lineno">  193</span> </div>
<div class="line"><a id="l00202" name="l00202"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#a8eee9197359bfdf20d399544a894af8b">  202</a></span>    <a class="code hl_class" href="classsf_1_1Sound.php">Sound</a>&amp; operator =(<span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1Sound.php">Sound</a>&amp; right);</div>
<div class="line"><a id="l00203" name="l00203"></a><span class="lineno">  203</span> </div>
<div class="line"><a id="l00213" name="l00213"></a><span class="lineno"><a class="line" href="classsf_1_1Sound.php#acb7289d45e06fb76b8292ac84beb82a7">  213</a></span>    <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sound.php#acb7289d45e06fb76b8292ac84beb82a7">resetBuffer</a>();</div>
<div class="line"><a id="l00214" name="l00214"></a><span class="lineno">  214</span> </div>
<div class="line"><a id="l00215" name="l00215"></a><span class="lineno">  215</span><span class="keyword">private</span>:</div>
<div class="line"><a id="l00216" name="l00216"></a><span class="lineno">  216</span> </div>
<div class="line"><a id="l00218" name="l00218"></a><span class="lineno">  218</span>    <span class="comment">// Member data</span></div>
<div class="line"><a id="l00220" name="l00220"></a><span class="lineno">  220</span>    <span class="keyword">const</span> <a class="code hl_class" href="classsf_1_1SoundBuffer.php">SoundBuffer</a>* m_buffer; </div>
<div class="line"><a id="l00221" name="l00221"></a><span class="lineno">  221</span>};</div>
</div>
<div class="line"><a id="l00222" name="l00222"></a><span class="lineno">  222</span> </div>
<div class="line"><a id="l00223" name="l00223"></a><span class="lineno">  223</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00224" name="l00224"></a><span class="lineno">  224</span> </div>
<div class="line"><a id="l00225" name="l00225"></a><span class="lineno">  225</span> </div>
<div class="line"><a id="l00226" name="l00226"></a><span class="lineno">  226</span><span class="preprocessor">#endif </span><span class="comment">// SFML_SOUND_HPP</span></div>
<div class="line"><a id="l00227" name="l00227"></a><span class="lineno">  227</span> </div>
<div class="line"><a id="l00228" name="l00228"></a><span class="lineno">  228</span> </div>
<div class="ttc" id="aclasssf_1_1SoundBuffer_php"><div class="ttname"><a href="classsf_1_1SoundBuffer.php">sf::SoundBuffer</a></div><div class="ttdoc">Storage for audio samples defining a sound.</div><div class="ttdef"><b>Definition</b> <a href="SoundBuffer_8hpp_source.php#l00049">SoundBuffer.hpp:50</a></div></div>
<div class="ttc" id="aclasssf_1_1SoundSource_php"><div class="ttname"><a href="classsf_1_1SoundSource.php">sf::SoundSource</a></div><div class="ttdoc">Base class defining a sound's properties.</div><div class="ttdef"><b>Definition</b> <a href="SoundSource_8hpp_source.php#l00042">SoundSource.hpp:43</a></div></div>
<div class="ttc" id="aclasssf_1_1SoundSource_php_ac43af72c98c077500b239bc75b812f03"><div class="ttname"><a href="classsf_1_1SoundSource.php#ac43af72c98c077500b239bc75b812f03">sf::SoundSource::Status</a></div><div class="ttdeci">Status</div><div class="ttdoc">Enumeration of the sound source states.</div><div class="ttdef"><b>Definition</b> <a href="SoundSource_8hpp_source.php#l00050">SoundSource.hpp:51</a></div></div>
<div class="ttc" id="aclasssf_1_1Sound_php"><div class="ttname"><a href="classsf_1_1Sound.php">sf::Sound</a></div><div class="ttdoc">Regular sound that can be played in the audio environment.</div><div class="ttdef"><b>Definition</b> <a href="#l00045">Sound.hpp:46</a></div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a054da07266ce8f39229495146e3041eb"><div class="ttname"><a href="classsf_1_1Sound.php#a054da07266ce8f39229495146e3041eb">sf::Sound::getLoop</a></div><div class="ttdeci">bool getLoop() const</div><div class="ttdoc">Tell whether or not the sound is in loop mode.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a2953ffe632536e72e696fd880ced2532"><div class="ttname"><a href="classsf_1_1Sound.php#a2953ffe632536e72e696fd880ced2532">sf::Sound::play</a></div><div class="ttdeci">void play()</div><div class="ttdoc">Start or resume playing the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a36ab74beaaa953d9879c933ddd246282"><div class="ttname"><a href="classsf_1_1Sound.php#a36ab74beaaa953d9879c933ddd246282">sf::Sound::Sound</a></div><div class="ttdeci">Sound()</div><div class="ttdoc">Default constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a3b1cfc19a856d4ff8c079ee41bb78e69"><div class="ttname"><a href="classsf_1_1Sound.php#a3b1cfc19a856d4ff8c079ee41bb78e69">sf::Sound::Sound</a></div><div class="ttdeci">Sound(const SoundBuffer &amp;buffer)</div><div class="ttdoc">Construct the sound with a buffer.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a406fc363594a7718a53ebef49a870f51"><div class="ttname"><a href="classsf_1_1Sound.php#a406fc363594a7718a53ebef49a870f51">sf::Sound::getStatus</a></div><div class="ttdeci">Status getStatus() const</div><div class="ttdoc">Get the current status of the sound (stopped, paused, playing)</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a559bc3aea581107bcb380fdbe523aa08"><div class="ttname"><a href="classsf_1_1Sound.php#a559bc3aea581107bcb380fdbe523aa08">sf::Sound::getPlayingOffset</a></div><div class="ttdeci">Time getPlayingOffset() const</div><div class="ttdoc">Get the current playing position of the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a5eeb25815bfa8cdc4a6cc000b7b19ad5"><div class="ttname"><a href="classsf_1_1Sound.php#a5eeb25815bfa8cdc4a6cc000b7b19ad5">sf::Sound::pause</a></div><div class="ttdeci">void pause()</div><div class="ttdoc">Pause the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a7c0f6033856909eeefa2e6696db96ef2"><div class="ttname"><a href="classsf_1_1Sound.php#a7c0f6033856909eeefa2e6696db96ef2">sf::Sound::getBuffer</a></div><div class="ttdeci">const SoundBuffer * getBuffer() const</div><div class="ttdoc">Get the audio buffer attached to the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_a8b395e9713d0efa48a18628c8ec1972e"><div class="ttname"><a href="classsf_1_1Sound.php#a8b395e9713d0efa48a18628c8ec1972e">sf::Sound::setBuffer</a></div><div class="ttdeci">void setBuffer(const SoundBuffer &amp;buffer)</div><div class="ttdoc">Set the source buffer containing the audio data to play.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_aa9c91c34f7c6d344d5ee9b997511f754"><div class="ttname"><a href="classsf_1_1Sound.php#aa9c91c34f7c6d344d5ee9b997511f754">sf::Sound::stop</a></div><div class="ttdeci">void stop()</div><div class="ttdoc">stop playing the sound</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_ab905677846558042022dd6ab15cddff0"><div class="ttname"><a href="classsf_1_1Sound.php#ab905677846558042022dd6ab15cddff0">sf::Sound::setPlayingOffset</a></div><div class="ttdeci">void setPlayingOffset(Time timeOffset)</div><div class="ttdoc">Change the current playing position of the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_acb7289d45e06fb76b8292ac84beb82a7"><div class="ttname"><a href="classsf_1_1Sound.php#acb7289d45e06fb76b8292ac84beb82a7">sf::Sound::resetBuffer</a></div><div class="ttdeci">void resetBuffer()</div><div class="ttdoc">Reset the internal buffer of the sound.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_ad0792c35310eba2dffd8489c80fad076"><div class="ttname"><a href="classsf_1_1Sound.php#ad0792c35310eba2dffd8489c80fad076">sf::Sound::~Sound</a></div><div class="ttdeci">~Sound()</div><div class="ttdoc">Destructor.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_ae05eeed6377932694d86b3011be366c0"><div class="ttname"><a href="classsf_1_1Sound.php#ae05eeed6377932694d86b3011be366c0">sf::Sound::Sound</a></div><div class="ttdeci">Sound(const Sound &amp;copy)</div><div class="ttdoc">Copy constructor.</div></div>
<div class="ttc" id="aclasssf_1_1Sound_php_af23ab4f78f975bbabac031102321612b"><div class="ttname"><a href="classsf_1_1Sound.php#af23ab4f78f975bbabac031102321612b">sf::Sound::setLoop</a></div><div class="ttdeci">void setLoop(bool loop)</div><div class="ttdoc">Set whether or not the sound should loop after reaching the end.</div></div>
<div class="ttc" id="aclasssf_1_1Time_php"><div class="ttname"><a href="classsf_1_1Time.php">sf::Time</a></div><div class="ttdoc">Represents a time value.</div><div class="ttdef"><b>Definition</b> <a href="Time_8hpp_source.php#l00040">Time.hpp:41</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
