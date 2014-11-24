<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Input.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
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
<li class="navelem"><a class="el" href="dir_83ae1a5e8455fc62607b4936b42116e9.php">sfml</a></li><li class="navelem"><a class="el" href="dir_79a044fa5ec8bbf4af7d440d8995a178.php">sfml</a></li><li class="navelem"><a class="el" href="dir_f3190241575fd2bd132a392ae6942f4a.php">include</a></li><li class="navelem"><a class="el" href="dir_692f376662c82a26cfe4cfa3aceebe24.php">SFML</a></li><li class="navelem"><a class="el" href="dir_91aff02cfffdbbdd31d48df547831556.php">Window</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">Input.hpp</div>  </div>
</div><!--header-->
<div class="contents">
<div class="fragment"><div class="line"><a name="l00001"></a><span class="lineno">    1</span>&#160;</div>
<div class="line"><a name="l00002"></a><span class="lineno">    2</span>&#160;<span class="comment">//</span></div>
<div class="line"><a name="l00003"></a><span class="lineno">    3</span>&#160;<span class="comment">// SFML - Simple and Fast Multimedia Library</span></div>
<div class="line"><a name="l00004"></a><span class="lineno">    4</span>&#160;<span class="comment">// Copyright (C) 2007-2009 Laurent Gomila (laurent.gom@gmail.com)</span></div>
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
<div class="line"><a name="l00025"></a><span class="lineno">   25</span>&#160;<span class="preprocessor">#ifndef SFML_INPUT_HPP</span></div>
<div class="line"><a name="l00026"></a><span class="lineno">   26</span>&#160;<span class="preprocessor"></span><span class="preprocessor">#define SFML_INPUT_HPP</span></div>
<div class="line"><a name="l00027"></a><span class="lineno">   27</span>&#160;<span class="preprocessor"></span></div>
<div class="line"><a name="l00029"></a><span class="lineno">   29</span>&#160;<span class="comment">// Headers</span></div>
<div class="line"><a name="l00031"></a><span class="lineno">   31</span>&#160;<span class="comment"></span><span class="preprocessor">#include &lt;SFML/Config.hpp&gt;</span></div>
<div class="line"><a name="l00032"></a><span class="lineno">   32</span>&#160;<span class="preprocessor">#include &lt;SFML/System/NonCopyable.hpp&gt;</span></div>
<div class="line"><a name="l00033"></a><span class="lineno">   33</span>&#160;<span class="preprocessor">#include &lt;SFML/Window/Event.hpp&gt;</span></div>
<div class="line"><a name="l00034"></a><span class="lineno">   34</span>&#160;<span class="preprocessor">#include &lt;SFML/Window/WindowListener.hpp&gt;</span></div>
<div class="line"><a name="l00035"></a><span class="lineno">   35</span>&#160;</div>
<div class="line"><a name="l00036"></a><span class="lineno">   36</span>&#160;</div>
<div class="line"><a name="l00037"></a><span class="lineno">   37</span>&#160;<span class="keyword">namespace </span>sf</div>
<div class="line"><a name="l00038"></a><span class="lineno">   38</span>&#160;{</div>
<div class="line"><a name="l00044"></a><span class="lineno"><a class="code" href="classsf_1_1Input.php">   44</a></span>&#160;<span class="keyword">class </span>SFML_API <a class="code" href="classsf_1_1Input.php" title="Input handles real-time input from keyboard and mouse.">Input</a> : <span class="keyword">public</span> <a class="code" href="classsf_1_1WindowListener.php" title="Base class for classes that want to receive events from a window (for internal use only)...">WindowListener</a>, <a class="code" href="structsf_1_1NonCopyable.php" title="Utility base class to easily declare non-copyable classes.">NonCopyable</a></div>
<div class="line"><a name="l00045"></a><span class="lineno">   45</span>&#160;{</div>
<div class="line"><a name="l00046"></a><span class="lineno">   46</span>&#160;<span class="keyword">public</span> :</div>
<div class="line"><a name="l00047"></a><span class="lineno">   47</span>&#160;</div>
<div class="line"><a name="l00052"></a><span class="lineno">   52</span>&#160;    <a class="code" href="classsf_1_1Input.php" title="Input handles real-time input from keyboard and mouse.">Input</a>();</div>
<div class="line"><a name="l00053"></a><span class="lineno">   53</span>&#160;</div>
<div class="line"><a name="l00062"></a><span class="lineno">   62</span>&#160;    <span class="keywordtype">bool</span> IsKeyDown(<a class="code" href="namespacesf_1_1Key.php#ad32ed01d3448273340bd25af5cdd9c81">Key::Code</a> KeyCode) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00063"></a><span class="lineno">   63</span>&#160;</div>
<div class="line"><a name="l00072"></a><span class="lineno">   72</span>&#160;    <span class="keywordtype">bool</span> IsMouseButtonDown(Mouse::Button Button) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00073"></a><span class="lineno">   73</span>&#160;</div>
<div class="line"><a name="l00083"></a><span class="lineno">   83</span>&#160;    <span class="keywordtype">bool</span> IsJoystickButtonDown(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> JoyId, <span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> Button) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00084"></a><span class="lineno">   84</span>&#160;</div>
<div class="line"><a name="l00091"></a><span class="lineno">   91</span>&#160;    <span class="keywordtype">int</span> GetMouseX() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00092"></a><span class="lineno">   92</span>&#160;</div>
<div class="line"><a name="l00099"></a><span class="lineno">   99</span>&#160;    <span class="keywordtype">int</span> GetMouseY() <span class="keyword">const</span>;</div>
<div class="line"><a name="l00100"></a><span class="lineno">  100</span>&#160;</div>
<div class="line"><a name="l00110"></a><span class="lineno">  110</span>&#160;    <span class="keywordtype">float</span> GetJoystickAxis(<span class="keywordtype">unsigned</span> <span class="keywordtype">int</span> JoyId, Joy::Axis Axis) <span class="keyword">const</span>;</div>
<div class="line"><a name="l00111"></a><span class="lineno">  111</span>&#160;</div>
<div class="line"><a name="l00112"></a><span class="lineno">  112</span>&#160;<span class="keyword">private</span> :</div>
<div class="line"><a name="l00113"></a><span class="lineno">  113</span>&#160;</div>
<div class="line"><a name="l00118"></a><span class="lineno">  118</span>&#160;    <span class="keyword">virtual</span> <span class="keywordtype">void</span> OnEvent(<span class="keyword">const</span> <a class="code" href="classsf_1_1Event.php" title="Event defines a system event and its parameters.">Event</a>&amp; EventReceived);</div>
<div class="line"><a name="l00119"></a><span class="lineno">  119</span>&#160;</div>
<div class="line"><a name="l00124"></a><span class="lineno">  124</span>&#160;    <span class="keywordtype">void</span> ResetStates();</div>
<div class="line"><a name="l00125"></a><span class="lineno">  125</span>&#160;</div>
<div class="line"><a name="l00127"></a><span class="lineno">  127</span>&#160;    <span class="comment">// Member data</span></div>
<div class="line"><a name="l00129"></a><span class="lineno">  129</span>&#160;<span class="comment"></span>    <span class="keywordtype">bool</span>  myKeys[Key::Count];                              </div>
<div class="line"><a name="l00130"></a><span class="lineno">  130</span>&#160;    <span class="keywordtype">bool</span>  myMouseButtons[Mouse::ButtonCount];              </div>
<div class="line"><a name="l00131"></a><span class="lineno">  131</span>&#160;    <span class="keywordtype">int</span>   myMouseX;                                        </div>
<div class="line"><a name="l00132"></a><span class="lineno">  132</span>&#160;    <span class="keywordtype">int</span>   myMouseY;                                        </div>
<div class="line"><a name="l00133"></a><span class="lineno">  133</span>&#160;    <span class="keywordtype">bool</span>  myJoystickButtons[<a class="code" href="namespacesf_1_1Joy.php#abb37a72f42b3ef9841fcf8270d0ac881a668554c121c39f79eceb15f8b6631a9f" title="Total number of supported joysticks.">Joy::Count</a>][<a class="code" href="namespacesf_1_1Joy.php#abb37a72f42b3ef9841fcf8270d0ac881aa555e27e351d2052df5f4b7b6e6953bf" title="Total number of supported joystick buttons.">Joy::ButtonCount</a>]; </div>
<div class="line"><a name="l00134"></a><span class="lineno">  134</span>&#160;    <span class="keywordtype">float</span> myJoystickAxis[<a class="code" href="namespacesf_1_1Joy.php#abb37a72f42b3ef9841fcf8270d0ac881a668554c121c39f79eceb15f8b6631a9f" title="Total number of supported joysticks.">Joy::Count</a>][Joy::AxisCount];      </div>
<div class="line"><a name="l00135"></a><span class="lineno">  135</span>&#160;};</div>
<div class="line"><a name="l00136"></a><span class="lineno">  136</span>&#160;</div>
<div class="line"><a name="l00137"></a><span class="lineno">  137</span>&#160;} <span class="comment">// namespace sf</span></div>
<div class="line"><a name="l00138"></a><span class="lineno">  138</span>&#160;</div>
<div class="line"><a name="l00139"></a><span class="lineno">  139</span>&#160;</div>
<div class="line"><a name="l00140"></a><span class="lineno">  140</span>&#160;<span class="preprocessor">#endif // SFML_INPUT_HPP</span></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
