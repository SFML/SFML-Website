<?php
    $version = '2.6.2'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Sensor.hpp Source File'; // the $ title variable is automatically replaced by doxygen with the page title
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
<li class="navelem"><a class="el" href="dir_c9d62fd513ce19bab3d7ef8db833e3f1.php">SFML</a></li><li class="navelem"><a class="el" href="dir_66c4f0b3361ff6a900e01a4b3c9d5eb7.php">include</a></li><li class="navelem"><a class="el" href="dir_b640c2c295eeac6b731646a7ed21830e.php">SFML</a></li><li class="navelem"><a class="el" href="dir_9aeeb18f6197238fd33123535246e540.php">Window</a></li>  </ul>
</div>
</div><!-- top -->
<div id="doc-content">
<div class="header">
  <div class="headertitle"><div class="title">Sensor.hpp</div></div>
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
<div class="line"><a id="l00025" name="l00025"></a><span class="lineno">   25</span><span class="preprocessor">#ifndef SFML_SENSOR_HPP</span></div>
<div class="line"><a id="l00026" name="l00026"></a><span class="lineno">   26</span><span class="preprocessor">#define SFML_SENSOR_HPP</span></div>
<div class="line"><a id="l00027" name="l00027"></a><span class="lineno">   27</span> </div>
<div class="line"><a id="l00029" name="l00029"></a><span class="lineno">   29</span><span class="comment">// Headers</span></div>
<div class="line"><a id="l00031" name="l00031"></a><span class="lineno">   31</span><span class="preprocessor">#include &lt;SFML/Window/Export.hpp&gt;</span></div>
<div class="line"><a id="l00032" name="l00032"></a><span class="lineno">   32</span><span class="preprocessor">#include &lt;SFML/System/Vector3.hpp&gt;</span></div>
<div class="line"><a id="l00033" name="l00033"></a><span class="lineno">   33</span><span class="preprocessor">#include &lt;SFML/System/Time.hpp&gt;</span></div>
<div class="line"><a id="l00034" name="l00034"></a><span class="lineno">   34</span> </div>
<div class="line"><a id="l00035" name="l00035"></a><span class="lineno">   35</span> </div>
<div class="line"><a id="l00036" name="l00036"></a><span class="lineno">   36</span><span class="keyword">namespace </span>sf</div>
<div class="line"><a id="l00037" name="l00037"></a><span class="lineno">   37</span>{</div>
<div class="foldopen" id="foldopen00042" data-start="{" data-end="};">
<div class="line"><a id="l00042" name="l00042"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php">   42</a></span><span class="keyword">class </span>SFML_WINDOW_API <a class="code hl_class" href="classsf_1_1Sensor.php">Sensor</a></div>
<div class="line"><a id="l00043" name="l00043"></a><span class="lineno">   43</span>{</div>
<div class="line"><a id="l00044" name="l00044"></a><span class="lineno">   44</span><span class="keyword">public</span>:</div>
<div class="line"><a id="l00045" name="l00045"></a><span class="lineno">   45</span> </div>
<div class="foldopen" id="foldopen00050" data-start="{" data-end="};">
<div class="line"><a id="l00050" name="l00050"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">   50</a></span>    <span class="keyword">enum</span> <a class="code hl_enumeration" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">Type</a></div>
<div class="line"><a id="l00051" name="l00051"></a><span class="lineno">   51</span>    {</div>
<div class="line"><a id="l00052" name="l00052"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a11bc58199593e217de23641755ecc867">   52</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a11bc58199593e217de23641755ecc867">Accelerometer</a>,    </div>
<div class="line"><a id="l00053" name="l00053"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a1c43984aacd29b1fda5356883fb19656">   53</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a1c43984aacd29b1fda5356883fb19656">Gyroscope</a>,        </div>
<div class="line"><a id="l00054" name="l00054"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ae706bb678bde8d3c370e246ffde6a63d">   54</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ae706bb678bde8d3c370e246ffde6a63d">Magnetometer</a>,     </div>
<div class="line"><a id="l00055" name="l00055"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84afab4d098cc64e791a0c4a9ef6b32db92">   55</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84afab4d098cc64e791a0c4a9ef6b32db92">Gravity</a>,          </div>
<div class="line"><a id="l00056" name="l00056"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ad3a399e0025892b7c53e8767cebb9215">   56</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ad3a399e0025892b7c53e8767cebb9215">UserAcceleration</a>, </div>
<div class="line"><a id="l00057" name="l00057"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84aa428c5260446555de87c69b65f6edf00">   57</a></span>        <a class="code hl_enumvalue" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84aa428c5260446555de87c69b65f6edf00">Orientation</a>,      </div>
<div class="line"><a id="l00058" name="l00058"></a><span class="lineno">   58</span> </div>
<div class="line"><a id="l00059" name="l00059"></a><span class="lineno">   59</span>        Count             </div>
<div class="line"><a id="l00060" name="l00060"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84afcb4a80eb9e3f927c5837207a1b9eb29">   60</a></span>    };</div>
</div>
<div class="line"><a id="l00061" name="l00061"></a><span class="lineno">   61</span> </div>
<div class="line"><a id="l00070" name="l00070"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#a7b7a2570218221781233bd495323abf0">   70</a></span>    <span class="keyword">static</span> <span class="keywordtype">bool</span> <a class="code hl_function" href="classsf_1_1Sensor.php#a7b7a2570218221781233bd495323abf0">isAvailable</a>(<a class="code hl_enumeration" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">Type</a> sensor);</div>
<div class="line"><a id="l00071" name="l00071"></a><span class="lineno">   71</span> </div>
<div class="line"><a id="l00085" name="l00085"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#afb31c5697d2e0a5fec70d702ec1d6cd9">   85</a></span>    <span class="keyword">static</span> <span class="keywordtype">void</span> <a class="code hl_function" href="classsf_1_1Sensor.php#afb31c5697d2e0a5fec70d702ec1d6cd9">setEnabled</a>(<a class="code hl_enumeration" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">Type</a> sensor, <span class="keywordtype">bool</span> enabled);</div>
<div class="line"><a id="l00086" name="l00086"></a><span class="lineno">   86</span> </div>
<div class="line"><a id="l00095" name="l00095"></a><span class="lineno"><a class="line" href="classsf_1_1Sensor.php#ab9a2710f55ead2f7b4e1b0bead34457e">   95</a></span>    <span class="keyword">static</span> <a class="code hl_class" href="classsf_1_1Vector3.php">Vector3f</a> <a class="code hl_function" href="classsf_1_1Sensor.php#ab9a2710f55ead2f7b4e1b0bead34457e">getValue</a>(<a class="code hl_enumeration" href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">Type</a> sensor);</div>
<div class="line"><a id="l00096" name="l00096"></a><span class="lineno">   96</span>};</div>
</div>
<div class="line"><a id="l00097" name="l00097"></a><span class="lineno">   97</span> </div>
<div class="line"><a id="l00098" name="l00098"></a><span class="lineno">   98</span>} <span class="comment">// namespace sf</span></div>
<div class="line"><a id="l00099" name="l00099"></a><span class="lineno">   99</span> </div>
<div class="line"><a id="l00100" name="l00100"></a><span class="lineno">  100</span> </div>
<div class="line"><a id="l00101" name="l00101"></a><span class="lineno">  101</span><span class="preprocessor">#endif </span><span class="comment">// SFML_SENSOR_HPP</span></div>
<div class="line"><a id="l00102" name="l00102"></a><span class="lineno">  102</span> </div>
<div class="line"><a id="l00103" name="l00103"></a><span class="lineno">  103</span> </div>
<div class="ttc" id="aclasssf_1_1Sensor_php"><div class="ttname"><a href="classsf_1_1Sensor.php">sf::Sensor</a></div><div class="ttdoc">Give access to the real-time state of the sensors.</div><div class="ttdef"><b>Definition</b> <a href="#l00042">Sensor.hpp:43</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84">sf::Sensor::Type</a></div><div class="ttdeci">Type</div><div class="ttdoc">Sensor type.</div><div class="ttdef"><b>Definition</b> <a href="#l00050">Sensor.hpp:51</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84a11bc58199593e217de23641755ecc867"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a11bc58199593e217de23641755ecc867">sf::Sensor::Accelerometer</a></div><div class="ttdeci">@ Accelerometer</div><div class="ttdoc">Measures the raw acceleration (m/s^2)</div><div class="ttdef"><b>Definition</b> <a href="#l00052">Sensor.hpp:52</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84a1c43984aacd29b1fda5356883fb19656"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84a1c43984aacd29b1fda5356883fb19656">sf::Sensor::Gyroscope</a></div><div class="ttdeci">@ Gyroscope</div><div class="ttdoc">Measures the raw rotation rates (degrees/s)</div><div class="ttdef"><b>Definition</b> <a href="#l00053">Sensor.hpp:53</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84aa428c5260446555de87c69b65f6edf00"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84aa428c5260446555de87c69b65f6edf00">sf::Sensor::Orientation</a></div><div class="ttdeci">@ Orientation</div><div class="ttdoc">Measures the absolute 3D orientation (degrees)</div><div class="ttdef"><b>Definition</b> <a href="#l00057">Sensor.hpp:57</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84ad3a399e0025892b7c53e8767cebb9215"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ad3a399e0025892b7c53e8767cebb9215">sf::Sensor::UserAcceleration</a></div><div class="ttdeci">@ UserAcceleration</div><div class="ttdoc">Measures the direction and intensity of device acceleration, independent of the gravity (m/s^2)</div><div class="ttdef"><b>Definition</b> <a href="#l00056">Sensor.hpp:56</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84ae706bb678bde8d3c370e246ffde6a63d"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84ae706bb678bde8d3c370e246ffde6a63d">sf::Sensor::Magnetometer</a></div><div class="ttdeci">@ Magnetometer</div><div class="ttdoc">Measures the ambient magnetic field (micro-teslas)</div><div class="ttdef"><b>Definition</b> <a href="#l00054">Sensor.hpp:54</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a687375af3ab77b818fca73735bcaea84afab4d098cc64e791a0c4a9ef6b32db92"><div class="ttname"><a href="classsf_1_1Sensor.php#a687375af3ab77b818fca73735bcaea84afab4d098cc64e791a0c4a9ef6b32db92">sf::Sensor::Gravity</a></div><div class="ttdeci">@ Gravity</div><div class="ttdoc">Measures the direction and intensity of gravity, independent of device acceleration (m/s^2)</div><div class="ttdef"><b>Definition</b> <a href="#l00055">Sensor.hpp:55</a></div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_a7b7a2570218221781233bd495323abf0"><div class="ttname"><a href="classsf_1_1Sensor.php#a7b7a2570218221781233bd495323abf0">sf::Sensor::isAvailable</a></div><div class="ttdeci">static bool isAvailable(Type sensor)</div><div class="ttdoc">Check if a sensor is available on the underlying platform.</div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_ab9a2710f55ead2f7b4e1b0bead34457e"><div class="ttname"><a href="classsf_1_1Sensor.php#ab9a2710f55ead2f7b4e1b0bead34457e">sf::Sensor::getValue</a></div><div class="ttdeci">static Vector3f getValue(Type sensor)</div><div class="ttdoc">Get the current sensor value.</div></div>
<div class="ttc" id="aclasssf_1_1Sensor_php_afb31c5697d2e0a5fec70d702ec1d6cd9"><div class="ttname"><a href="classsf_1_1Sensor.php#afb31c5697d2e0a5fec70d702ec1d6cd9">sf::Sensor::setEnabled</a></div><div class="ttdeci">static void setEnabled(Type sensor, bool enabled)</div><div class="ttdoc">Enable or disable a sensor.</div></div>
<div class="ttc" id="aclasssf_1_1Vector3_php"><div class="ttname"><a href="classsf_1_1Vector3.php">sf::Vector3</a></div><div class="ttdoc">Utility template class for manipulating 3-dimensional vectors.</div><div class="ttdef"><b>Definition</b> <a href="Vector3_8hpp_source.php#l00037">Vector3.hpp:38</a></div></div>
</div><!-- fragment --></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
