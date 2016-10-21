<?php
    $version = '2.4.1'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'RenderStates.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<div class="title">shared/include/SFML/Graphics/RenderStates.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div><div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2016 Laurent Gomila (laurent@sfml-dev.org)</span></div><div class="line"><a name="l00005"></a><span class="lineno">    5</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00006"></a><span class="lineno">    6</span>&#160;<span class="comment">// This software is provided &#39;as-is&#39;, without any express or implied warranty.</span></div><div class="line"><a name="l00007"></a><span class="lineno">    7</span>&#160;<span class="comment">// In no event will the authors be held liable for any damages arising from the use of this software.</span></div><div class="line"><a name="l00008"></a><span class="lineno">    8</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00009"></a><span class="lineno">    9</span>&#160;<span class="comment">// Permission is granted to anyone to use this software for any purpose,</span></div><div class="line"><a name="l00010"></a><span class="lineno">   10</span>&#160;<span class="comment">// including commercial applications, and to alter it and redistribute it freely,</span></div><div class="line"><a name="l00011"></a><span class="lineno">   11</span>&#160;<span class="comment">// subject to the following restrictions:</span></div><div class="line"><a name="l00012"></a><span class="lineno">   12</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00013"></a><span class="lineno">   13</span>&#160;<span class="comment">// 1. The origin of this software must not be misrepresented;</span></div><div class="line"><a name="l00014"></a><span class="lineno">   14</span>&#160;<span class="comment">//    you must not claim that you wrote the original software.</span></div><div class="line"><a name="l00015"></a><span class="lineno">   15</span>&#160;<span class="comment">//    If you use this software in a product, an acknowledgment</span></div><div class="line"><a name="l00016"></a><span class="lineno">   16</span>&#160;<span class="comment">//    in the product documentation would be appreciated but is not required.</span></div><div class="line"><a name="l00017"></a><span class="lineno">   17</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00018"></a><span class="lineno">   18</span>&#160;<span class="comment">// 2. Altered source versions must be plainly marked as such,</span></div><div class="line"><a name="l00019"></a><span class="lineno">   19</span>&#160;<span class="comment">//    and must not be misrepresented as being the original software.</span></div><div class="line"><a name="l00020"></a><span class="lineno">   20</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00021"></a><span class="lineno">   21</span>&#160;<span class="comment">// 3. This notice may not be removed or altered from any source distribution.</span></div><div class="line"><a name="l00022"></a><span class="lineno">   22</span>&#160;<span class="comment">//</span></div><div class="line"><a name="l00024"></a><span class="lineno">   24</span>&#160;<span class="comment"></span></div><div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_RENDERSTATES_HPP</span></div><div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor">#define SFML_RENDERSTATES_HPP</span></div><div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;</div><div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div><div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Graphics/Export.hpp&gt;</span></div><div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/BlendMode.hpp&gt;</span></div><div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Graphics/Transform.hpp&gt;</span></div><div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div><div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div><div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;<span class="keyword">namespace </span><a class="code" href="namespacesf.php">sf</a></div><div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;{</div><div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;<span class="keyword">class </span>Shader;</div><div class="line"><a name="l00039"></a><span class="lineno">   39</span>&#160;<span class="keyword">class </span>Texture;</div><div class="line"><a name="l00040"></a><span class="lineno">   40</span>&#160;</div><div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;<span class="keyword">class </span>SFML_GRAPHICS_API RenderStates</div><div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;{</div><div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;<span class="keyword">public</span>:</div><div class="line"><a name="l00048"></a><span class="lineno">   48</span>&#160;</div><div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;    RenderStates();</div><div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;</div><div class="line"><a name="l00069"></a><span class="lineno">   69</span>&#160;    RenderStates(<span class="keyword">const</span> BlendMode&amp; theBlendMode);</div><div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;</div><div class="line"><a name="l00077"></a><span class="lineno">   77</span>&#160;    RenderStates(<span class="keyword">const</span> Transform&amp; theTransform);</div><div class="line"><a name="l00078"></a><span class="lineno">   78</span>&#160;</div><div class="line"><a name="l00085"></a><span class="lineno">   85</span>&#160;    RenderStates(<span class="keyword">const</span> Texture* theTexture);</div><div class="line"><a name="l00086"></a><span class="lineno">   86</span>&#160;</div><div class="line"><a name="l00093"></a><span class="lineno">   93</span>&#160;    RenderStates(<span class="keyword">const</span> Shader* theShader);</div><div class="line"><a name="l00094"></a><span class="lineno">   94</span>&#160;</div><div class="line"><a name="l00104"></a><span class="lineno">  104</span>&#160;    RenderStates(<span class="keyword">const</span> BlendMode&amp; theBlendMode, <span class="keyword">const</span> Transform&amp; theTransform,</div><div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;                 <span class="keyword">const</span> Texture* theTexture, <span class="keyword">const</span> Shader* theShader);</div><div class="line"><a name="l00106"></a><span class="lineno">  106</span>&#160;</div><div class="line"><a name="l00108"></a><span class="lineno">  108</span>&#160;    <span class="comment">// Static member data</span></div><div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;<span class="comment"></span>    <span class="keyword">static</span> <span class="keyword">const</span> RenderStates <a class="code" href="group__window.php#gga7b9b5c2a2b381d2a42283d745874cb71aaf73ca9c9fa787f9da9c1d7527d42734">Default</a>; </div><div class="line"><a name="l00111"></a><span class="lineno">  111</span>&#160;</div><div class="line"><a name="l00113"></a><span class="lineno">  113</span>&#160;    <span class="comment">// Member data</span></div><div class="line"><a name="l00115"></a><span class="lineno">  115</span>&#160;<span class="comment"></span>    BlendMode      blendMode; </div><div class="line"><a name="l00116"></a><span class="lineno">  116</span>&#160;    Transform      transform; </div><div class="line"><a name="l00117"></a><span class="lineno">  117</span>&#160;    <span class="keyword">const</span> Texture* texture;   </div><div class="line"><a name="l00118"></a><span class="lineno">  118</span>&#160;    <span class="keyword">const</span> Shader*  shader;    </div><div class="line"><a name="l00119"></a><span class="lineno">  119</span>&#160;};</div><div class="line"><a name="l00120"></a><span class="lineno">  120</span>&#160;</div><div class="line"><a name="l00121"></a><span class="lineno">  121</span>&#160;} <span class="comment">// namespace sf</span></div><div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;</div><div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;</div><div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;<span class="preprocessor">#endif // SFML_RENDERSTATES_HPP</span></div><div class="line"><a name="l00125"></a><span class="lineno">  125</span>&#160;</div><div class="line"><a name="l00126"></a><span class="lineno">  126</span>&#160;</div><div class="ttc" id="namespacesf_php"><div class="ttname"><a href="namespacesf.php">sf</a></div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Audio_2AlResource_8hpp_source.php#l00034">include/SFML/Audio/AlResource.hpp:34</a></div></div>
<div class="ttc" id="group__window_php_gga7b9b5c2a2b381d2a42283d745874cb71aaf73ca9c9fa787f9da9c1d7527d42734"><div class="ttname"><a href="group__window.php#gga7b9b5c2a2b381d2a42283d745874cb71aaf73ca9c9fa787f9da9c1d7527d42734">sf::Style::Default</a></div><div class="ttdoc">Default window style. </div><div class="ttdef"><b>Definition:</b> <a href="include_2SFML_2Window_2WindowStyle_8hpp_source.php#l00046">include/SFML/Window/WindowStyle.hpp:46</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
