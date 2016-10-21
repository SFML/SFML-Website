<?php
    $version = '2.4.1'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Font.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_a2d5a90f1bdcb5808a62d5b0d5da2693.php">shared</a></li><li class="navelem"><a class="el" href="dir_43d543a298a049144b52f1b4453e3c7a.php">include</a></li><li class="navelem"><a class="el" href="dir_58a6f29869daa158b2acc7d96b6fe230.php">SFML</a></li><li class="navelem"><a class="el" href="dir_33aa9c32c91f6e372580815084672c3b.php">Graphics</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">shared/include/SFML/Graphics/Font.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div><div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2016 Laurent Gomila (laurent@sfml-dev.org)</span></div><div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div><div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div><div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div><div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div><div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">// subject to the following restrictions:</span></div><div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">// 1. The origin of this software must not be misrepresented;</span></div><div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">//    you must not claim that you wrote the original software.</span></div><div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">//    If you use this software in a product, an acknowledgment</span></div><div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">//    in the product documentation would be appreciated but is not required.</span></div><div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;<span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div><div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;<span class="comment">//    and must not be misrepresented as being the original software.</span></div><div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;<span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div><div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;<span class="comment"></span></div><div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_FONT_HPP</span></div><div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_FONT_HPP</span></div><div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div><div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div><div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div><div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Glyph.hpp&gt;</span></div><div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Texture.hpp&gt;</span></div><div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Rect.hpp&gt;</span></div><div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div><div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="preprocessor">#include &lt;SFML/System/String.hpp&gt;</span></div><div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="preprocessor">#include &lt;map&gt;</span></div><div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="preprocessor">#include &lt;string&gt;</span></div><div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="preprocessor">#include &lt;vector&gt;</span></div><div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;</div><div class="line"><a name="l00041"></a><span class="lineno">   41</span>&#160;</div><div class="line"><a name="l00042"></a><span class="lineno">   42</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div><div class="line"><a name="l00043"></a><span class="lineno">   43</span>&#160;{</div><div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;<span class="keyword">class </span>InputStream;</div><div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;</div><div class="line"><a name="l00050"></a><span class="lineno">   50</span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API Font</div><div class="line"><a name="l00051"></a><span class="lineno">   51</span>&#160;{</div><div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;<span class="keyword">public</span>:</div><div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;</div><div class="line"><a name="l00058"></a><span class="lineno">   58</span>&#160;    <span class="keyword">struct </span>Info</div><div class="line"><a name="l00059"></a><span class="lineno">   59</span>&#160;    {</div><div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;        std::string family; </div><div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;    };</div><div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;</div><div class="line"><a name="l00063"></a><span class="lineno">   63</span>&#160;<span class="keyword">public</span>:</div><div class="line"><a name="l00064"></a><span class="lineno">   64</span>&#160;</div><div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;    Font();</div><div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;</div><div class="line"><a name="l00079"></a><span class="lineno">   79</span>&#160;    Font(<span class="keyword">const</span> Font&amp; copy);</div><div class="line"><a name="l00080"></a><span class="lineno">   80</span>&#160;</div><div class="line"><a name="l00087"></a><span class="lineno">   87</span>&#160;    ~Font();</div><div class="line"><a name="l00088"></a><span class="lineno">   88</span>&#160;</div><div class="line"><a name="l00109"></a><span class="lineno">  109</span>&#160;    <span class="keywordtype">bool</span> loadFromFile(<span class="keyword">const</span> std::string&amp; filename);</div><div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;</div><div class="line"><a name="l00130"></a><span class="lineno">  130</span>&#160;    <span class="keywordtype">bool</span> loadFromMemory(<span class="keyword">const</span> <span class="keywordtype">void</span>* data, std::size_t sizeInBytes);</div><div class="line"><a name="l00131"></a><span class="lineno">  131</span>&#160;</div><div class="line"><a name="l00152"></a><span class="lineno">  152</span>&#160;    <span class="keywordtype">bool</span> loadFromStream(InputStream&amp; stream);</div><div class="line"><a name="l00153"></a><span class="lineno">  153</span>&#160;</div><div class="line"><a name="l00160"></a><span class="lineno">  160</span>&#160;    <span class="keyword">const</span> Info&amp; getInfo() <span class="keyword">const</span>;</div><div class="line"><a name="l00161"></a><span class="lineno">  161</span>&#160;</div><div class="line"><a name="l00180"></a><span class="lineno">  180</span>&#160;    <span class="keyword">const</span> Glyph&amp; getGlyph(Uint32 codePoint, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize, <span class="keywordtype">bool</span> bold, <span class="keywordtype">float</span> outlineThickness = 0) <span class="keyword">const</span>;</div><div class="line"><a name="l00181"></a><span class="lineno">  181</span>&#160;</div><div class="line"><a name="l00198"></a><span class="lineno">  198</span>&#160;    <span class="keywordtype">float</span> getKerning(Uint32 first, Uint32 second, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00199"></a><span class="lineno">  199</span>&#160;</div><div class="line"><a name="l00211"></a><span class="lineno">  211</span>&#160;    <span class="keywordtype">float</span> getLineSpacing(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00212"></a><span class="lineno">  212</span>&#160;</div><div class="line"><a name="l00226"></a><span class="lineno">  226</span>&#160;    <span class="keywordtype">float</span> getUnderlinePosition(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00227"></a><span class="lineno">  227</span>&#160;</div><div class="line"><a name="l00240"></a><span class="lineno">  240</span>&#160;    <span class="keywordtype">float</span> getUnderlineThickness(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00241"></a><span class="lineno">  241</span>&#160;</div><div class="line"><a name="l00254"></a><span class="lineno">  254</span>&#160;    <span class="keyword">const</span> Texture&amp; getTexture(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00255"></a><span class="lineno">  255</span>&#160;</div><div class="line"><a name="l00264"></a><span class="lineno">  264</span>&#160;    Font&amp; operator =(<span class="keyword">const</span> Font&amp; right);</div><div class="line"><a name="l00265"></a><span class="lineno">  265</span>&#160;</div><div class="line"><a name="l00266"></a><span class="lineno">  266</span>&#160;<span class="keyword">private</span>:</div><div class="line"><a name="l00267"></a><span class="lineno">  267</span>&#160;</div><div class="line"><a name="l00272"></a><span class="lineno">  272</span>&#160;    <span class="keyword">struct </span>Row</div><div class="line"><a name="l00273"></a><span class="lineno">  273</span>&#160;    {</div><div class="line"><a name="l00274"></a><span class="lineno">  274</span>&#160;        Row(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> rowTop, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> rowHeight) : width(0), top(rowTop), height(rowHeight) {}</div><div class="line"><a name="l00275"></a><span class="lineno">  275</span>&#160;</div><div class="line"><a name="l00276"></a><span class="lineno">  276</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width;  </div><div class="line"><a name="l00277"></a><span class="lineno">  277</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> top;    </div><div class="line"><a name="l00278"></a><span class="lineno">  278</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height; </div><div class="line"><a name="l00279"></a><span class="lineno">  279</span>&#160;    };</div><div class="line"><a name="l00280"></a><span class="lineno">  280</span>&#160;</div><div class="line"><a name="l00282"></a><span class="lineno">  282</span>&#160;    <span class="comment">// Types</span></div><div class="line"><a name="l00284"></a><span class="lineno">  284</span>&#160;<span class="comment"></span>    <span class="keyword">typedef</span> std::map&lt;Uint64, Glyph&gt; GlyphTable; </div><div class="line"><a name="l00285"></a><span class="lineno">  285</span>&#160;</div><div class="line"><a name="l00290"></a><span class="lineno">  290</span>&#160;    <span class="keyword">struct </span>Page</div><div class="line"><a name="l00291"></a><span class="lineno">  291</span>&#160;    {</div><div class="line"><a name="l00292"></a><span class="lineno">  292</span>&#160;        Page();</div><div class="line"><a name="l00293"></a><span class="lineno">  293</span>&#160;</div><div class="line"><a name="l00294"></a><span class="lineno">  294</span>&#160;        GlyphTable       glyphs;  </div><div class="line"><a name="l00295"></a><span class="lineno">  295</span>&#160;        Texture          texture; </div><div class="line"><a name="l00296"></a><span class="lineno">  296</span>&#160;        <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span>     nextRow; </div><div class="line"><a name="l00297"></a><span class="lineno">  297</span>&#160;        std::vector&lt;Row&gt; rows;    </div><div class="line"><a name="l00298"></a><span class="lineno">  298</span>&#160;    };</div><div class="line"><a name="l00299"></a><span class="lineno">  299</span>&#160;</div><div class="line"><a name="l00304"></a><span class="lineno">  304</span>&#160;    <span class="keywordtype">void</span> cleanup();</div><div class="line"><a name="l00305"></a><span class="lineno">  305</span>&#160;</div><div class="line"><a name="l00317"></a><span class="lineno">  317</span>&#160;    Glyph loadGlyph(Uint32 codePoint, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize, <span class="keywordtype">bool</span> bold, <span class="keywordtype">float</span> outlineThickness) <span class="keyword">const</span>;</div><div class="line"><a name="l00318"></a><span class="lineno">  318</span>&#160;</div><div class="line"><a name="l00329"></a><span class="lineno">  329</span>&#160;    IntRect findGlyphRect(Page&amp; page, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> width, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> height) <span class="keyword">const</span>;</div><div class="line"><a name="l00330"></a><span class="lineno">  330</span>&#160;</div><div class="line"><a name="l00339"></a><span class="lineno">  339</span>&#160;    <span class="keywordtype">bool</span> setCurrentSize(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> characterSize) <span class="keyword">const</span>;</div><div class="line"><a name="l00340"></a><span class="lineno">  340</span>&#160;</div><div class="line"><a name="l00342"></a><span class="lineno">  342</span>&#160;    <span class="comment">// Types</span></div><div class="line"><a name="l00344"></a><span class="lineno">  344</span>&#160;<span class="comment"></span>    <span class="keyword">typedef</span> std::map&lt;unsigned int, Page&gt; PageTable; </div><div class="line"><a name="l00345"></a><span class="lineno">  345</span>&#160;</div><div class="line"><a name="l00347"></a><span class="lineno">  347</span>&#160;    <span class="comment">// Member data</span></div><div class="line"><a name="l00349"></a><span class="lineno">  349</span>&#160;<span class="comment"></span>    <span class="keywordtype">void</span>*                      m_library;     </div><div class="line"><a name="l00350"></a><span class="lineno">  350</span>&#160;    <span class="keywordtype">void</span>*                      m_face;        </div><div class="line"><a name="l00351"></a><span class="lineno">  351</span>&#160;    <span class="keywordtype">void</span>*                      m_streamRec;   </div><div class="line"><a name="l00352"></a><span class="lineno">  352</span>&#160;    <span class="keywordtype">void</span>*                      m_stroker;     </div><div class="line"><a name="l00353"></a><span class="lineno">  353</span>&#160;    <span class="keywordtype">int</span>*                       m_refCount;    </div><div class="line"><a name="l00354"></a><span class="lineno">  354</span>&#160;    Info                       m_info;        </div><div class="line"><a name="l00355"></a><span class="lineno">  355</span>&#160;    <span class="keyword">mutable</span> PageTable          m_pages;       </div><div class="line"><a name="l00356"></a><span class="lineno">  356</span>&#160;    <span class="keyword">mutable</span> std::vector&lt;Uint8&gt; m_pixelBuffer; </div><div class="line"><a name="l00357"></a><span class="lineno">  357</span>&#160;<span class="preprocessor">    #ifdef SFML_SYSTEM_ANDROID</span></div><div class="line"><a name="l00358"></a><span class="lineno">  358</span>&#160;    <span class="keywordtype">void</span>*                      m_stream; </div><div class="line"><a name="l00359"></a><span class="lineno">  359</span>&#160;<span class="preprocessor">    #endif</span></div><div class="line"><a name="l00360"></a><span class="lineno">  360</span>&#160;};</div><div class="line"><a name="l00361"></a><span class="lineno">  361</span>&#160;</div><div class="line"><a name="l00362"></a><span class="lineno">  362</span>&#160;} <span class="comment">// namespace sf</span></div><div class="line"><a name="l00363"></a><span class="lineno">  363</span>&#160;</div><div class="line"><a name="l00364"></a><span class="lineno">  364</span>&#160;</div><div class="line"><a name="l00365"></a><span class="lineno">  365</span>&#160;<span class="preprocessor">#endif // SFML_FONT_HPP</span></div><div class="line"><a name="l00366"></a><span class="lineno">  366</span>&#160;</div><div class="line"><a name="l00367"></a><span class="lineno">  367</span>&#160;</div><div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Audio_2AlResource_8hpp_source.php#l00034">include/SFML/Audio/AlResource.hpp:34</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
