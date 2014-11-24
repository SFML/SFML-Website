<?php
    $version = '2.0'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Mouse.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_83ae1a5e8455fc62607b4936b42116e9.php">sfml</a></li><li class="navelem"><a class="el" href="dir_79a044fa5ec8bbf4af7d440d8995a178.php">sfml</a></li><li class="navelem"><a class="el" href="dir_f3190241575fd2bd132a392ae6942f4a.php">include</a></li><li class="navelem"><a class="el" href="dir_692f376662c82a26cfe4cfa3aceebe24.php">SFML</a></li><li class="navelem"><a class="el" href="dir_91aff02cfffdbbdd31d48df547831556.php">Window</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">Mouse.hpp</div>  </div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_MOUSE_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_MOUSE_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Window/Export.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/System/Vector2.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;</div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;</div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;{</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="keyword">class </span>Window;</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;</div>
<div class="line"><a name="l00043"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php">   43</a></span>&#160;<span class="keyword">class </span>SFML_WINDOW_API <a class="code" href="classsf_1_1Mouse.php" title="Give access to the real-time state of the mouse.">Mouse</a></div>
<div class="line"><a name="l00044"></a><span class="lineno">   44</span>&#160;{</div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;</div>
<div class="line"><a name="l00051"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90">   51</a></span>&#160;    <span class="keyword">enum</span> <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90" title="Mouse buttons.">Button</a></div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;    {</div>
<div class="line"><a name="l00053"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8">   53</a></span>&#160;        <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a8bb4856e1ec7f6b6a8605effdfc0eee8" title="The left mouse button.">Left</a>,       </div>
<div class="line"><a name="l00054"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90af2cff24ab6c26daf079b11189f982fc4">   54</a></span>&#160;        <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90af2cff24ab6c26daf079b11189f982fc4" title="The right mouse button.">Right</a>,      </div>
<div class="line"><a name="l00055"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a2c353189c4b11cf216d7caddafcc609d">   55</a></span>&#160;        <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a2c353189c4b11cf216d7caddafcc609d" title="The middle (wheel) mouse button.">Middle</a>,     </div>
<div class="line"><a name="l00056"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7">   56</a></span>&#160;        <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90aecc7f3ce9ad6a60b9b0027876446b8d7" title="The first extra mouse button.">XButton1</a>,   </div>
<div class="line"><a name="l00057"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a">   57</a></span>&#160;        <a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a03fa056fd0dd9d629c205d91a8ef1b5a" title="The second extra mouse button.">XButton2</a>,   </div>
<div class="line"><a name="l00058"></a><span class="lineno">   58</span>&#160;</div>
<div class="line"><a name="l00059"></a><span class="lineno"><a class="code" href="classsf_1_1Mouse.php#a4fb128be433f9aafe66bc0c605daaa90a52a1d434289774240ddaa22496762402">   59</a></span>&#160;        ButtonCount </div>
<div class="line"><a name="l00060"></a><span class="lineno">   60</span>&#160;    };</div>
<div class="line"><a name="l00061"></a><span class="lineno">   61</span>&#160;</div>
<div class="line"><a name="l00070"></a><span class="lineno">   70</span>&#160;    <span class="keyword">static</span> <span class="keywordtype">bool</span> isButtonPressed(Button button);</div>
<div class="line"><a name="l00071"></a><span class="lineno">   71</span>&#160;</div>
<div class="line"><a name="l00081"></a><span class="lineno">   81</span>&#160;    <span class="keyword">static</span> <a class="code" href="classsf_1_1Vector2.php" title="Utility template class for manipulating 2-dimensional vectors.">Vector2i</a> getPosition();</div>
<div class="line"><a name="l00082"></a><span class="lineno">   82</span>&#160;</div>
<div class="line"><a name="l00094"></a><span class="lineno">   94</span>&#160;    <span class="keyword">static</span> <a class="code" href="classsf_1_1Vector2.php" title="Utility template class for manipulating 2-dimensional vectors.">Vector2i</a> getPosition(<span class="keyword">const</span> <a class="code" href="classsf_1_1Window.php" title="Window that serves as a target for OpenGL rendering.">Window</a>&amp; relativeTo);</div>
<div class="line"><a name="l00095"></a><span class="lineno">   95</span>&#160;</div>
<div class="line"><a name="l00105"></a><span class="lineno">  105</span>&#160;    <span class="keyword">static</span> <span class="keywordtype">void</span> setPosition(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php" title="Utility template class for manipulating 2-dimensional vectors.">Vector2i</a>&amp; position);</div>
<div class="line"><a name="l00106"></a><span class="lineno">  106</span>&#160;</div>
<div class="line"><a name="l00117"></a><span class="lineno">  117</span>&#160;    <span class="keyword">static</span> <span class="keywordtype">void</span> setPosition(<span class="keyword">const</span> <a class="code" href="classsf_1_1Vector2.php" title="Utility template class for manipulating 2-dimensional vectors.">Vector2i</a>&amp; position, <span class="keyword">const</span> <a class="code" href="classsf_1_1Window.php" title="Window that serves as a target for OpenGL rendering.">Window</a>&amp; relativeTo);</div>
<div class="line"><a name="l00118"></a><span class="lineno">  118</span>&#160;};</div>
<div class="line"><a name="l00119"></a><span class="lineno">  119</span>&#160;</div>
<div class="line"><a name="l00120"></a><span class="lineno">  120</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00121"></a><span class="lineno">  121</span>&#160;</div>
<div class="line"><a name="l00122"></a><span class="lineno">  122</span>&#160;</div>
<div class="line"><a name="l00123"></a><span class="lineno">  123</span>&#160;<span class="preprocessor">#endif // SFML_MOUSE_HPP</span></div>
<div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00125"></a><span class="lineno">  125</span>&#160;</div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
