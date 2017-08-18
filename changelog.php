<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php',
        'Changelog' => 'changelog.php'
    );
    include('header.php');
?>

<h1>Changelog</h1>

<ul>
 <li><a href="#sfml-2.4.2">SFML 2.4.2</a></li>
 <li><a href="#sfml-2.4.1">SFML 2.4.1</a></li>
 <li><a href="#sfml-2.4.0">SFML 2.4.0</a></li>
 <li><a href="#sfml-2.3.2">SFML 2.3.2</a></li>
 <li><a href="#sfml-2.3.1">SFML 2.3.1</a></li>
 <li><a href="#sfml-2.3">SFML 2.3</a></li>
 <li><a href="#sfml-2.2">SFML 2.2</a></li>
 <li><a href="#sfml-2.1">SFML 2.1</a></li>
 <li><a href="#sfml-2.0">SFML 2.0</a></li>
 <li><a href="#sfml-1.6">SFML 1.6</a></li>
 <li><a href="#sfml-1.5">SFML 1.5</a></li>
 <li><a href="#sfml-1.4">SFML 1.4</a></li>
 <li><a href="#sfml-1.3">SFML 1.3</a></li>
 <li><a href="#sfml-1.2">SFML 1.2</a></li>
 <li><a href="#sfml-1.1">SFML 1.1</a></li>
</ul>

<h2 id="sfml-2.4.2"><a class="h2-link" href="#sfml-2.4.2">SFML 2.4.2</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<h3 id="2.4.2-system"><a class="h3-link" href="#2.4.2-system">System</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>[Windows] Removed thread affinity changes in sf::Clock (<a href="https://github.com/SFML/SFML/pull/1007">#1107</a>)</li>
</ul>

<h3 id="2.4.2-window"><a class="h3-link" href="#2.4.2-window">Window</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>Fixed bug where TransientContextLock would hang (<a href="https://github.com/SFML/SFML/issues/1165">#1165</a>, <a href="https://github.com/SFML/SFML/pull/1172">#1172</a>)</li>
  <li>[Linux] Fixed GLX extensions being loaded too late (<a href="https://github.com/SFML/SFML/pull/1183">#1183</a>)</li>
  <li>[Linux] Fix wrong types passed to XChangeProperty (<a href="https://github.com/SFML/SFML/issues/1168">#1168</a> <a href="https://github.com/SFML/SFML/pull/1171">#1171</a>)</li>
  <li>[Windows] Make context disabling via wglMakeCurrent more tolerant of broken drivers (<a href="https://github.com/SFML/SFML/pull/1186">#1186</a>)</li>
</ul>

<h3 id="2.4.2-graphics"><a class="h3-link" href="#2.4.2-graphics">Graphics</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>Optimized sf::Image::create and made it more exception safe (<a href="https://github.com/SFML/SFML/pull/1166">#1166</a>)</li>
</ul>

<h2 id="sfml-2.4.1"><a class="h2-link" href="#sfml-2.4.1">SFML 2.4.1</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<h3 id="2.4.1-general"><a class="h3-link" href="#2.4.1-general">General</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>[kFreeBSD] Define SFML_OS_FREEBSD when compiling for kFreeBSD (<a href="https://github.com/SFML/SFML/pull/1129">#1129</a>)</li>
  <li>[Windows] Added some simple messaging when trying to build under Cygwin (<a href="https://github.com/SFML/SFML/pull/1153">#1153</a>)</li>
</ul>

<h3 id="2.4.1-window"><a class="h3-link" href="#2.4.1-window">Window</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>Fixed stack overflow on GlContext creation with multiple threads (<a href="https://github.com/SFML/SFML/issues/989">#989</a>, <a href="https://github.com/SFML/SFML/pull/1002">#1002</a>)</li>
  <li>Adjusted mouse cursor grab documentation (<a href="https://github.com/SFML/SFML/pull/1133">#1133</a>)</li>
  <li>[iOS] Fixed orientation change not rescaling window size properly (<a href="https://github.com/SFML/SFML/issues/1049">#1049</a>, <a href="https://github.com/SFML/SFML/pull/1050">#1050</a>)</li>
  <li>[Linux] Fixed fullscreen issue (<a href="https://github.com/SFML/SFML/issues/921">#921</a>, <a href="https://github.com/SFML/SFML/pull/1138">#1138</a>)</li>
  <li>[Linux] Switched from XCB back to Xlib for windowing (<a href="https://github.com/SFML/SFML/pull/1138">#1138</a>)</li>
  <li>[Linux] Fixed window icon not showing up on some distros (<a href="https://github.com/SFML/SFML/issues/1087">#1087</a>, <a href="https://github.com/SFML/SFML/pull/1088">#1088</a>)</li>
  <li>[Linux] Fixed an issue where GNOME flags window unresponsive (<a href="https://github.com/SFML/SFML/issues/1089">#1089</a>, <a href="https://github.com/SFML/SFML/pull/1138">#1138</a>)</li>
  <li>[Linux] Fixed leak of XVisualInfo objects during GlxContext creation (<a href="https://github.com/SFML/SFML/pull/1135">#1135</a>)</li>
  <li>[Linux] Fixed possible hang when setting visibility if external window sources (<a href="https://github.com/SFML/SFML/pull/1136">#1136</a>)</li>
  <li>[OS X] Fixed inconsistency between doc and impl on OS X for the grab feature (<a href="https://github.com/SFML/SFML/pull/1133">#1133</a>, <a href="https://github.com/SFML/SFML/issues/1148">#1148</a>, <a href="https://github.com/SFML/SFML/pull/1150">#1150</a>)</li>
  <li>[Windows] Fixed context memory leaks (<a href="https://github.com/SFML/SFML/issues/1143">#1143</a>, <a href="https://github.com/SFML/SFML/pull/1002">#1002</a>)</li>
</ul>

<h3 id="2.4.1-graphics"><a class="h3-link" href="#2.4.1-graphics">Graphics</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>Adjusted uniform error message (<a href="https://github.com/SFML/SFML/pull/1131">#1131</a>)</li>
  <li>Clarify documentation on Rect::contains function bounds (<a href="https://github.com/SFML/SFML/pull/1151">#1151</a>)</li>
</ul>

<h3 id="2.4.1-network"><a class="h3-link" href="#2.4.1-network">Network</a></h3>
<h4>Bugfixes</h4>
<ul>
  <li>Fixed a typo in comment for sf::UdpSocket::unbind() (<a href="https://github.com/SFML/SFML/pull/1121">#1121</a>)</li>
</ul>

<h2 id="sfml-2.4.0"><a class="h2-link" href="#sfml-2.4.0">SFML 2.4.0</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<h3 id="2.4.0-general"><a class="h3-link" href="#2.4.0-general">General</a></h3>
<ul>
  <li>Added deprecation macro (<a href="https://github.com/SFML/SFML/pull/969">#969</a>)</li>
  <li>Fixed issues reported by Coverity Scan static analysis (<a href="https://github.com/SFML/SFML/pull/1064">#1064</a>)</li>
  <li>Fixed some initialization issues reported by Cppcheck (<a href="https://github.com/SFML/SFML/pull/1008">#1008</a>)</li>
  <li>Changed comment chars in FindSFML.cmake to # (<a href="https://github.com/SFML/SFML/pull/1090">#1090</a>)</li>
  <li>Fixed some typos (<a href="https://github.com/SFML/SFML/pull/1098">#1098</a>, <a href="https://github.com/SFML/SFML/pull/993">#993</a>, <a href="https://github.com/SFML/SFML/pull/1099">#1099</a>, <a href="https://github.com/SFML/SFML/pull/956">#956</a>, <a href="https://github.com/SFML/SFML/pull/963">#963</a>, <a href="https://github.com/SFML/SFML/pull/979">#979</a>)</li>
  <li>Updated/fixed string comparisons in Config.cmake (<a href="https://github.com/SFML/SFML/pull/1102">#1102</a>)</li>
  <li>Added the missing -s postfix for the RelWithDebInfo config (<a href="https://github.com/SFML/SFML/pull/1014">#1014</a>)</li>
  <li>[Android] Fixed current Android compilation issues (<a href="https://github.com/SFML/SFML/pull/1116">#1116</a>, <a href="https://github.com/SFML/SFML/pull/1111">#1111</a>, <a href="https://github.com/SFML/SFML/pull/1079">#1079</a>)</li>
  <li>[OS X] Update Xcode template material (<a href="https://github.com/SFML/SFML/pull/976">#976</a>, <a href="https://github.com/SFML/SFML/pull/968">#968</a>)</li>
  <li>[Windows] Added support for VS 2015 (<a href="https://github.com/SFML/SFML/pull/972">#972</a>)</li>
  <li>[Windows] Create and install PDB debug symbols alongside binaries (<a href="https://github.com/SFML/SFML/pull/1037">#1037</a>)</li>
</ul>

<h3 id="2.4.0-deprecated"><a class="h3-link" href="#2.4.0-deprecated">Deprecated API</a></h3>
<ul>
 <li>sf::RenderWindow::capture(): Use a sf::Texture and its sf::Texture::update(const Window&) function and copy its contents into an sf::Image instead.</li>
 <li>sf::Shader::setParameter(): Use setUniform() instead.</li>
 <li>sf::Text::getColor(): There is now fill and outline colors instead of a single global color. Use getFillColor() or getOutlineColor() instead.</li>
 <li>sf::Text::setColor(): There is now fill and outline colors instead of a single global color. Use setFillColor() or setOutlineColor() instead.</li>
 <li>sf::LinesStrip: Use LineStrip instead.</li>
 <li>sf::TrianglesFan: Use TriangleFan instead.</li>
 <li>sf::TrianglesStrip: Use TriangleStrip instead.</li>
</ul>

<h3 id="2.4.0-system"><a class="h3-link" href="#2.4.0-system">System</a></h3>
<h4>Features</h4>
<ul>
  <li>[Android] Added sf::getNativeActivity() (<a href="https://github.com/SFML/SFML/pull/1005">#1005</a>, <a href="https://github.com/SFML/SFML/pull/680">#680</a>)</li>
</ul>
<h4>Bugfixes</h4>
<ul>
  <li>Added missing <iterator> include in String.hpp (<a href="https://github.com/SFML/SFML/pull/1069">#1069</a>, <a href="https://github.com/SFML/SFML/pull/1068">#1068</a>)</li>
  <li>Fixed encoding of UTF-16 (<a href="https://github.com/SFML/SFML/pull/997">#997</a>)</li>
  <li>[Android] Fixed crash when trying to load a non-existing font file (<a href="https://github.com/SFML/SFML/pull/1058">#1058</a>)</li>
</ul>

<h3 id="2.4.0-window"><a class="h3-link" href="#2.4.0-window">Window</a></h3>
<h4>Features</h4>
<ul>
  <li>Added ability to grab cursor (<a href="https://github.com/SFML/SFML/pull/614">#614</a>, <a href="https://github.com/SFML/SFML/pull/394">#394</a>, <a href="https://github.com/SFML/SFML/pull/1107">#1107</a>)</li>
  <li>Added Multi-GPU preference (<a href="https://github.com/SFML/SFML/pull/869">#869</a>, <a href="https://github.com/SFML/SFML/pull/867">#867</a>)</li>
  <li>Added support for sRGB capable framebuffers (<a href="https://github.com/SFML/SFML/pull/981">#981</a>, <a href="https://github.com/SFML/SFML/pull/175">#175</a>)</li>
  <li>[Linux, Windows] Improved OpenGL context creation (<a href="https://github.com/SFML/SFML/pull/884">#884</a>)</li>
  <li>[Linux, Windows] Added support for pbuffers on Windows and Unix (<a href="https://github.com/SFML/SFML/pull/885">#885</a>, <a href="https://github.com/SFML/SFML/pull/434">#434</a>)</li>
</ul>
<h4>Bugfixes</h4>
<ul>
  <li>Updated platform-specific handle documentation (<a href="https://github.com/SFML/SFML/pull/961">#961</a>)</li>
  <li>[Android] Accept touch events from "multiple" devices (<a href="https://github.com/SFML/SFML/pull/954">#954</a>, <a href="https://github.com/SFML/SFML/pull/953">#953</a>)</li>
  <li>[Android] Copy the selected EGL context's settings to SFML (<a href="https://github.com/SFML/SFML/pull/1039">#1039</a>)</li>
  <li>[Linux] Fixed modifiers causing sf::Keyboard::Unknown being returned (<a href="https://github.com/SFML/SFML/pull/1022">#1022</a>, <a href="https://github.com/SFML/SFML/pull/1012">#1012</a>)</li>
  <li>[OS X] Improved memory management on OS X (<a href="https://github.com/SFML/SFML/pull/962">#962</a>, <a href="https://github.com/SFML/SFML/pull/790">#790</a>)</li>
  <li>[OS X] Fixed crash when resizing a window to a zero-height/width size (<a href="https://github.com/SFML/SFML/pull/986">#986</a>, <a href="https://github.com/SFML/SFML/pull/984">#984</a>)</li>
  <li>[OS X] Use the mouse button constant instead of 0 to avoid a compiler error on OSX (<a href="https://github.com/SFML/SFML/pull/1035">#1035</a>)</li>
  <li>[OS X] OS X improvement: warnings + bugfix + refactoring, the lot! (<a href="https://github.com/SFML/SFML/pull/1042">#1042</a>)</li>
</ul>

<h3 id="2.4.0-graphics"><a class="h3-link" href="#2.4.0-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
  <li>Added support for outlined text (<a href="https://github.com/SFML/SFML/pull/840">#840</a>)</li>
  <li>Add support for geometry shaders (<a href="https://github.com/SFML/SFML/pull/886">#886</a>, <a href="https://github.com/SFML/SFML/pull/428">#428</a>)</li>
  <li>Feature/blend mode reverse subtract (<a href="https://github.com/SFML/SFML/pull/945">#945</a>, <a href="https://github.com/SFML/SFML/pull/944">#944</a>)</li>
  <li>Implemented support for mipmap generation (<a href="https://github.com/SFML/SFML/pull/973">#973</a>, <a href="https://github.com/SFML/SFML/pull/498">#498</a>, <a href="https://github.com/SFML/SFML/pull/123">#123</a>)</li>
  <li>Added new API to set shader uniforms (<a href="https://github.com/SFML/SFML/pull/983">#983</a>, <a href="https://github.com/SFML/SFML/pull/538">#538</a>)</li>
  <li>Rewrite RenderWindow::capture (<a href="https://github.com/SFML/SFML/pull/1001">#1001</a>)</li>
</ul>
<h4>Bugfixes</h4>
<ul>
  <li>Exporting some Glsl utility functions due to linking issues (<a href="https://github.com/SFML/SFML/pull/1044">#1044</a>, <a href="https://github.com/SFML/SFML/pull/1046">#1046</a>)</li>
  <li>Fixed missing initialisation of Font::m_stroker (<a href="https://github.com/SFML/SFML/pull/1059">#1059</a>)</li>
  <li>Changed primitive types to be grammatically correct (<a href="https://github.com/SFML/SFML/pull/1095">#1095</a>, <a href="https://github.com/SFML/SFML/pull/939">#939</a>)</li>
</ul>

<h3 id="2.4.0-audio"><a class="h3-link" href="#2.4.0-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
  <li>Implemented stereo audio recording (<a href="https://github.com/SFML/SFML/pull/1010">#1010</a>)</li>
</ul>
<h4>Bugfixes</h4>
<ul>
  <li>Added an assignment operator to SoundSource (<a href="https://github.com/SFML/SFML/pull/864">#864</a>)</li>
  <li>[OS X] Updates OpenAL-soft for OS X to version 1.17.2 (<a href="https://github.com/SFML/SFML/pull/1057">#1057</a>, <a href="https://github.com/SFML/SFML/pull/900">#900</a>, <a href="https://github.com/SFML/SFML/pull/1000">#1000</a>)</li>
  <li>Fixed a bug where vorbis can't handle large buffers (<a href="https://github.com/SFML/SFML/pull/1067">#1067</a>)</li>
  <li>Added support for 24-bit .wav files (<a href="https://github.com/SFML/SFML/pull/958">#958</a>, <a href="https://github.com/SFML/SFML/pull/955">#955</a>)</li>
  <li>Fixed threading issue in sf::SoundRecorder (<a href="https://github.com/SFML/SFML/pull/1011">#1011</a>)</li>
  <li>Made WAV file reader no longer assume that data chunk goes till end of file to prevent reading trailing metadata as samples (<a href="https://github.com/SFML/SFML/pull/1018">#1018</a>)</li>
  <li>Fixed seeking in multi channel FLAC files (<a href="https://github.com/SFML/SFML/pull/1041">#1041</a>, <a href="https://github.com/SFML/SFML/pull/1040">#1040</a>)</li>
</ul>

<h3 id="2.4.0-network"><a class="h3-link" href="#2.4.0-network">Network</a></h3>
<h4>Features</h4>
<ul>
  <li>Added optional argument on which address to bind (socket). (<a href="https://github.com/SFML/SFML/pull/850">#850</a>, <a href="https://github.com/SFML/SFML/pull/678">#678</a>)</li>
</ul>
<h4>Bugfixes</h4>
<ul>
  <li>Fixed FTP directory listing blocking forever (<a href="https://github.com/SFML/SFML/pull/1086">#1086</a>, <a href="https://github.com/SFML/SFML/pull/1025">#1025</a>)</li>
</ul>


<h2 id="sfml-2.3.2"><a class="h2-link" href="#sfml-2.3.2">SFML 2.3.2</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<h3 id="2.3.2-general"><a class="h3-link" href="#2.3.2-general">General</a></h3>
<ul>
 <li>Fixed an issue where FindSFML.cmake couldn't find older versions of SFML (<a href="https://github.com/SFML/SFML/pull/903">#903</a>)</li>
 <li>Robust alCheck and glCheck macros (<a href="https://github.com/SFML/SFML/pull/917">#917</a>)</li>
 <li>Fixed FindSFML.cmake to use the uppercase FLAC name (<a href="https://github.com/SFML/SFML/pull/923">#923</a>)</li>
 <li>Added a CONTRIBUTING file so GitHub shows a message when creating a new issue (<a href="https://github.com/SFML/SFML/pull/932">#932</a>)</li>
</ul>

<h3 id="2.3.2-window"><a class="h3-link" href="#2.3.2-window">Window</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>[Linux] Fixed an issue where the keypad's key weren't being detected (<a href="https://github.com/SFML/SFML/pull/910">#910</a>)</li>
 <li>[Linux] Revert to Xlib event handling (<a href="https://github.com/SFML/SFML/pull/934">#934</a>)</li>
 <li>[Linux] Fixed XK_* inconsistency in InpuImpl.cpp (<a href="https://github.com/SFML/SFML/pull/947">#947</a>)</li>
 <li>[Linux] Fix _NET_WM_PING messages not being replied to properly (<a href="https://github.com/SFML/SFML/pull/947">#947</a>)</li>
</ul>

<h3 id="2.3.2-graphics"><a class="h3-link" href="#2.3.2-graphics">Graphics</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Fixed clear bug on RenderTextures (<a href="https://github.com/SFML/SFML/pull/915">#915</a>)</li>
 <li>Fixed image file extension detection (<a href="https://github.com/SFML/SFML/issues/929">#929</a>, <a href="https://github.com/SFML/SFML/pull/930">#930</a>, <a href="https://github.com/SFML/SFML/pull/931">#931</a>)</li>
 <li>Secure function against random data return (<a href="https://github.com/SFML/SFML/issues/935">#935</a>, <a href="https://github.com/SFML/SFML/pull/942">#942</a>)</li>
</ul>

<h2 id="sfml-2.3.1"><a class="h2-link" href="#sfml-2.3.1">SFML 2.3.1</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="2.3.1-window"><a class="h3-link" href="#2.3.1-window">Window</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>[Android] Make sure a window still exists before trying to access its dimensions (<a href="https://github.com/SFML/SFML/pull/854">#854</a>)</li>
 <li>[Android] Added Android API level checks (<a href="https://github.com/SFML/SFML/pull/856">#856</a>)</li>
 <li>[Android] Updated the JNI/event handling code (<a href="https://github.com/SFML/SFML/pull/906">#906</a>)</li>
 <li>[Linux] Resized events are only spawned when the window size actually changes (<a href="https://github.com/SFML/SFML/pull/878">#878</a>, <a href="https://github.com/SFML/SFML/issues/893">#893</a>)</li>
 <li>[Linux] Whitelisted X SHAPE events (<a href="https://github.com/SFML/SFML/issues/879">#879</a>, <a href="https://github.com/SFML/SFML/pull/883">#883</a>)</li>
 <li>[Linux] Remap Unix keyboard when user changes layout (<a href="https://github.com/SFML/SFML/issues/895">#895</a>, <a href="https://github.com/SFML/SFML/pull/897">#897</a>)</li>
 <li>[Linux] Fix undefined behavior in ewmhSupported() (<a href="https://github.com/SFML/SFML/issues/892">#892</a>, <a href="https://github.com/SFML/SFML/pull/901">#901</a>)</li>
</ul>

<h3 id="2.3.1-graphics"><a class="h3-link" href="#2.3.1-graphics">Graphics</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Added support for GL_EXT_texture_edge_clamp for systems that don't expose GL_SGIS_texture_edge_clamp (<a href="https://github.com/SFML/SFML/issues/880">#880</a>, <a href="https://github.com/SFML/SFML/pull/882">#882</a>)</li>
</ul>

<h3 id="2.3.1-audio"><a class="h3-link" href="#2.3.1-audio">Audio</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>[Android] Fixed audio files not loading (and possibly crashing) (<a href="https://github.com/SFML/SFML/issues/855">#855</a>, <a href="https://github.com/SFML/SFML/pull/887">#887</a>)</li>
</ul>

<h2 id="sfml-2.3"><a class="h2-link" href="#sfml-2.3">SFML 2.3</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="2.3-general"><a class="h3-link" href="#2.3-general">General</a></h3>
<ul>
 <li>Examples only link against sfml-main in release mode (<a href="https://github.com/SFML/SFML/issues/610">#610</a>, <a href="https://github.com/SFML/SFML/pull/766">#766</a>)</li>
 <li>Replaced unsigned int with std::size_t for array indices and sizes (<a href="https://github.com/SFML/SFML/pull/739">#739</a>)</li>
 <li>Fixed some issues with the Doxygen documentation (<a href="https://github.com/SFML/SFML/pull/750">#750</a>)</li>
 <li>Added support for EditorConfig (<a href="https://github.com/SFML/SFML/pull/751">#751</a>)</li>
 <li>Hide success message for CMake in quiet mode (<a href="https://github.com/SFML/SFML/pull/753">#753</a>)</li>
 <li>Improved documentation for statuses with sf::Ftp (<a href="https://github.com/SFML/SFML/pull/763">#763</a>)</li>
 <li>Moved stb_image into the extlibs directory (<a href="https://github.com/SFML/SFML/pull/795">#795</a>)</li>
 <li>Changed the SOVERSION to major.minor (<a href="https://github.com/SFML/SFML/pull/812">#812</a>)</li>
 <li>Fixed warnings about switch-statements (<a href="https://github.com/SFML/SFML/pull/863">#863</a>)</li>
 <li>Added missing includes in the general headers (<a href="https://github.com/SFML/SFML/pull/851">#851</a>)</li>
 <li>[Android] Updated toolchain file and dependencies (<a href="https://github.com/SFML/SFML/pull/791">#791</a>)</li>
 <li>[Linux] Fixed missing pthread dependency (<a href="https://github.com/SFML/SFML/pull/794">#794</a>)</li>
 <li>[OS X] Relaxed CMake installation rules regarding framework dependencies (<a href="https://github.com/SFML/SFML/pull/767">#767</a>)</li>
</ul>

<h3 id="2.3-deprecated"><a class="h3-link" href="#2.3-deprecated">Deprecated API</a></h3>
<ul>
 <li>sf::Event::MouseWheelEvent: This event is deprecated and potentially inaccurate. Use MouseWheelScrollEvent instead.</li>
</ul>

<h3 id="2.3-window"><a class="h3-link" href="#2.3-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Added new events for handling high-precision scrolling (<a href="https://github.com/SFML/SFML/issues/95">#95</a>, <a href="https://github.com/SFML/SFML/pull/810">#810</a>, <a href="https://github.com/SFML/SFML/pull/837">#837</a>)</li>
 <li>Switched from Xlib to XCB (<a href="https://github.com/SFML/SFML/issues/200">#200</a>, <a href="https://github.com/SFML/SFML/pull/319">#319</a>, <a href="https://github.com/SFML/SFML/pull/694">#694</a>, <a href="https://github.com/SFML/SFML/pull/780">#780</a>, <a href="https://github.com/SFML/SFML/pull/813">#813</a>, <a href="https://github.com/SFML/SFML/pull/825">#825</a>)</li>
 <li>Added support for OpenGL 3 core context creation (<a href="https://github.com/SFML/SFML/issues/654">#654</a>, <a href="https://github.com/SFML/SFML/pull/779">#779</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed glXSwapIntervalSGI being broken for some driver implementations (<a href="https://github.com/SFML/SFML/issues/727">#727</a>, <a href="https://github.com/SFML/SFML/pull/779">#779</a>)</li>
 <li>Fixed simultaneous context operations causing crashes on some AMD hardware (<a href="https://github.com/SFML/SFML/issues/778">#778</a>, <a href="https://github.com/SFML/SFML/pull/779">#779</a>)</li>
 <li>Fixed joystick identification (<a href="https://github.com/SFML/SFML/pull/809">#809</a>, <a href="https://github.com/SFML/SFML/pull/811">#811</a>)</li>
 <li>[iOS] Fixed various issues including stencil bits, device orientation and retina support (<a href="https://github.com/SFML/SFML/pull/748">#748</a>)</li>
 <li>[iOS] Fixed inconsistency between sf::Touch::getPosition and touch events (<a href="https://github.com/SFML/SFML/pull/875">#875</a>)</li>
 <li>[Linux] Fixed Alt+F4 not getting triggered in window mode (<a href="https://github.com/SFML/SFML/issues/274">#274</a>)</li>
 <li>[Linux] Fixed Unix joystick stuff (<a href="https://github.com/SFML/SFML/pull/838">#838</a>)</li>
 <li>[OS X] Fixed typo in JoystickImpl.cpp to prevent a crash (<a href="https://github.com/SFML/SFML/issues/762">#762</a>, <a href="https://github.com/SFML/SFML/pull/765">#765</a>)</li>
 <li>[OS X] Fixed an issue in InputImpl::getSFOpenGLViewFromSFMLWindow (<a href="https://github.com/SFML/SFML/issues/782">#782</a>, <a href="https://github.com/SFML/SFML/pull/792">#792</a>)</li>
</ul>

<h3 id="2.3-graphics"><a class="h3-link" href="#2.3-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Replaced GLEW with loader generated by glLoadGen (<a href="https://github.com/SFML/SFML/pull/779">#779</a>)</li>
 <li>Added a new constructor to sf::Color that takes an sf::Uint32 (<a href="https://github.com/SFML/SFML/pull/722">#722</a>)</li>
 <li>Updated stb_image to v2.02 (<a href="https://github.com/SFML/SFML/pull/777">#777</a>)</li>
 <li>Updated FreeType to v2.5.5 (<a href="https://github.com/SFML/SFML/issues/799">#799</a>, <a href="https://github.com/SFML/SFML/pull/804">#804</a>)</li>
 <li>Added checks for software OpenGL (<a href="https://github.com/SFML/SFML/pull/870">#870</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed GL_ARB_compatibility not being detected (<a href="https://github.com/SFML/SFML/pull/859">#859</a>)</li>
 <li>Fixed pixel format selection (<a href="https://github.com/SFML/SFML/pull/862">#862</a>)</li>
 <li>Bumped back the OpenGL version requirement to 1.1 (<a href="https://github.com/SFML/SFML/pull/858">#858</a>)</li>
</ul>

<h3 id="2.3-audio"><a class="h3-link" href="#2.3-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Dropped libsndfile and started using Vorbis, FLAC and OGG directly (<a href="https://github.com/SFML/SFML/issues/604">#604</a>, <a href="https://github.com/SFML/SFML/pull/757">#757</a>)</li>
 <li>Added a FLAC file to the sound example (<a href="https://github.com/SFML/SFML/pull/815">#815</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed access violation error in the destructor of sf::AudioDevice (<a href="https://github.com/SFML/SFML/issues/30">#30</a>, <a href="https://github.com/SFML/SFML/pull/602">#602</a>)</li>
 <li>[OS X] Fixed threading issue with sf::SoundStream and OpenAL (<a href="https://github.com/SFML/SFML/issues/541">#541</a>, <a href="https://github.com/SFML/SFML/pull/831">#831</a>)</li>
</ul>

<h3 id="2.3-network"><a class="h3-link" href="#2.3-network">Network</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Fixed sf::TcpSocket not handling partial sends properly (<a href="https://github.com/SFML/SFML/issues/749">#749</a>, <a href="https://github.com/SFML/SFML/pull/796">#796</a>)</li>
</ul>


<h2 id="sfml-2.2"><a class="h2-link" href="#sfml-2.2">SFML 2.2</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="2.2-general"><a class="h3-link" href="#2.2-general">General</a></h3>
<ul>
 <li>Support for iOS and Android platform (<a href="https://github.com/SFML/SFML/issues/410">#410</a>, <a href="https://github.com/SFML/SFML/issues/440">#440</a>)</li>
 <li>Various documentation corrections (<a href="https://github.com/SFML/SFML/issues/438">#438</a>, <a href="https://github.com/SFML/SFML/pull/496">#496</a>, <a href="https://github.com/SFML/SFML/pull/497">#497</a>, <a href="https://github.com/SFML/SFML/pull/714">#714</a>)</li>
 <li>Fixed support for compilers on Debian FreeBSD (<a href="https://github.com/SFML/SFML/pull/380">#380</a>, <a href="https://github.com/SFML/SFML/pull/578">#578</a>)</li>
 <li>Added support for Visual Studio 2013 and proper support for the TDM builds (<a href="https://github.com/SFML/SFML/pull/482">#482</a>)</li>
 <li>Fixed CMake problems related to FindSFML and cached variables (<a href="https://github.com/SFML/SFML/issues/637">#637</a>, <a href="https://github.com/SFML/SFML/pull/684">#684</a>)</li>
 <li>Switched and enforced <code>LF</code> line endings (<a href="https://github.com/SFML/SFML/pull/708">#708</a>, <a href="https://github.com/SFML/SFML/pull/712">#712</a>)</li>
 <li>Updated OpenAL to version 1.15.1 (<a href="https://github.com/SFML/SFML/commit/d07721075057c7eac33124ff406eb0f5d629258b">d077210</a>)</li>
 <li>Made compiler and OS variable names much clearer in CMake files (<a href="https://github.com/SFML/SFML/commit/9b0ed300b5ced8f9bd49be42089b2988c4007947">9b0ed30</a>)</li>
 <li>Re-enabled RPATH feature (<a href="https://github.com/SFML/SFML/commit/e157e7a7a84d9d840c590df355d2681d0936971e">e157e7a</a>)</li>
 <li>Slight adjustments to the examples (<a href="https://github.com/SFML/SFML/pull/737">#737</a>)</li>
 <li>[FreeBSD] Various configuration fixes (<a href="https://github.com/SFML/SFML/pull/577">#577</a>, <a href="https://github.com/SFML/SFML/pull/578">#578</a>)</li>
 <li>[Linux] Updated <code>FindSFML.cmake</code> to add UDev to SFML's dependencies (<a href="https://github.com/SFML/SFML/issues/728">#728</a>, <a href="https://github.com/SFML/SFML/pull/729">#729</a>, <a href="https://github.com/SFML/SFML/issues/734">#734</a>, <a href="https://github.com/SFML/SFML/pull/736">#736</a>)</li>
 <li>[OS X] Fixed incorrect symlink in freetype.framework (<a href="https://github.com/SFML/SFML/issues/519">#519</a>)</li>
 <li>[OS X] CMake module for correct dependencies (<a href="https://github.com/SFML/SFML/pull/548">#548</a>)</li>
 <li>[OS X] Fixed SFML target for Xcode (<a href="https://github.com/SFML/SFML/issues/595">#595</a>, <a href="https://github.com/SFML/SFML/issues/596">#596</a>)</li>
 <li>[OS X] Updated implementation, mainly reverting to non-ARC (<a href="https://github.com/SFML/SFML/issues/601">#601</a>)</li>
 <li>[OS X] Fixed memory leaks and dead store (<a href="https://github.com/SFML/SFML/issues/615">#615</a>)</li>
 <li>[OS X] Improved event handling and performance (<a href="https://github.com/SFML/SFML/issues/617">#617</a>)</li>
 <li>[OS X] Reduced memory usage (<a href="https://github.com/SFML/SFML/issues/672">#672</a>, <a href="https://github.com/SFML/SFML/issues/698">#698</a>)</li>
 <li>[OS X] OS X 10.10 support (<a href="https://github.com/SFML/SFML/issues/691">#691</a>, <a href="https://github.com/SFML/SFML/pull/699">#699</a>)</li>
 <li>[OS X] Improve flexibility of dependencies' locations (<a href="https://github.com/SFML/SFML/pull/713">#713</a>)</li>
 <li>[Windows] Removed the hack that copied external libraries into SFML static libraries (<a href="https://github.com/SFML/SFML/commit/dbf01a775b7545bf83fbee0e1464f3f323723187">dbf01a7</a>)</li>
</ul>

<h3 id="2.2-system"><a class="h3-link" href="#2.2-system">System</a></h3>
<h4>Features</h4>
<ul>
 <li>Added substring and replace functions to <code>sf::String</code> (<a href="https://github.com/SFML/SFML/issues/21">#21</a>, <a href="https://github.com/SFML/SFML/pull/355">#355</a>)</li>
 <li>Added <code>toUtfX</code> to <code>sf::String</code> (<a href="https://github.com/SFML/SFML/issues/501">#501</a>)</li>
 <li>Added <code>fromUtfX</code> functions to set the internal data to a string by converting from another string in a fixed encoding (<a href="https://github.com/SFML/SFML/issues/196">#196</a>)</li>
 <li>Added modulo operator for <code>sf::Time</code> (<a href="https://github.com/SFML/SFML/issues/429">#429</a>, <a href="https://github.com/SFML/SFML/pull/430">#430</a>)</li>
 <li>Added division operator for <code>sf::Time</code> (<a href="https://github.com/SFML/SFML/pull/453">#453</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Ensured a high resolution for <code>sf::sleep</code> (<a href="https://github.com/SFML/SFML/issues/439">#439</a>, <a href="https://github.com/SFML/SFML/pull/475">#475</a>)</li>
 <li>[Windows] Fixed stack unalignment by two internal functions (<a href="https://github.com/SFML/SFML/issues/412">#412</a>)</li>
</ul>

<h3 id="2.2-window"><a class="h3-link" href="#2.2-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Added window methods to request and to check focus (<a href="https://github.com/SFML/SFML/issues/518">#518</a>, <a href="https://github.com/SFML/SFML/pull/525">#525</a>, <a href="https://github.com/SFML/SFML/pull/613">#613</a>, <a href="https://github.com/SFML/SFML/pull/723">#723</a>, <a href="https://github.com/SFML/SFML/pull/735">#735</a>)</li>
 <li>Provide name, manufacturer ID and product ID via <code>sf::Joystick</code> (<a href="https://github.com/SFML/SFML/issues/152">#152</a>, <a href="https://github.com/SFML/SFML/pull/528">#528</a>)</li>
 <li>[FreeBSD] Joystick support (<a href="https://github.com/SFML/SFML/issues/477">#477</a>)</li>
 <li>[OS X] Improved integration with menus and dock actions (<a href="https://github.com/SFML/SFML/issues/11">#11</a>)</li>
 <li>[OS X] Support for OpenGL 3.2 (<a href="https://github.com/SFML/SFML/issues/84">#84</a>)</li>
 <li>[OS X] Improved fullscreen support (<a href="https://github.com/SFML/SFML/issues/343">#343</a>)</li>
 <li>[OS X] Added support for retina displays (<a href="https://github.com/SFML/SFML/issues/353">#353</a>, <a href="https://github.com/SFML/SFML/pull/388">#388</a>)</li>
 <li>[Windows] Removed support for Windows 9x (<a href="https://github.com/SFML/SFML/issues/469">#469</a>)</li>
 <li>[Windows] Fixed typo in Windows keyboard implementation (<a href="https://github.com/SFML/SFML/issues/516">#516</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li><code>sf::Window::create()</code> now also resets framerate limit (<a href="https://github.com/SFML/SFML/issues/371">#371</a>)</li>
 <li>Fixed OpenGL context leak (<a href="https://github.com/SFML/SFML/pull/635">#635</a>, <a href="https://github.com/SFML/SFML/pull/705">#705</a>)</li>
 <li>Fixed various joystick problems (memory leak, accelerometer detected, code refactoring) (<a href="https://github.com/SFML/SFML/issues/660">#660</a>, <a href="https://github.com/SFML/SFML/pull/686">#686</a>, <a href="https://github.com/SFML/SFML/issues/742">#742</a>, <a href="https://github.com/SFML/SFML/pull/743">#743</a>)</li>
 <li>Optimized <code>sf::Window::waitEvent</code> a bit, no sleep if events are available at first try (<a href="https://github.com/SFML/SFML/commit/ff555d6f851ddcc9815d34e294f7dbf44180ac90">ff555d6</a>)</li>
 <li>[Linux] Output error message when <code>XOpenDisplay()</code> fails (<a href="https://github.com/SFML/SFML/issues/508">#508</a>, <a href="https://github.com/SFML/SFML/pull/616">#616</a>)</li>
 <li>[Linux] Resize window with <code>setSize</code> when <code>sf::Style::Resize</code> is set (<a href="https://github.com/SFML/SFML/issues/466">#466</a>)</li>
 <li>[Linux] Fixed broken key repeat on window recreation (<a href="https://github.com/SFML/SFML/issues/564">#564</a>, <a href="https://github.com/SFML/SFML/pull/567">#567</a>)</li>
 <li>[OS X] Fixes <code>KeyReleased</code> not being fired in fullscreen mode (<a href="https://github.com/SFML/SFML/issues/465">#465</a>)</li>
 <li>[OS X] Fixed an issue where disconnecting the keyboard would cause a crash (<a href="https://github.com/SFML/SFML/issues/467">#467</a>)</li>
 <li>[OS X] Fixed unexpected resizing behavior (<a href="https://github.com/SFML/SFML/issues/468">#468</a>)</li>
 <li>[OS X] Improved resizing windows (<a href="https://github.com/SFML/SFML/issues/474">#474</a>)</li>
 <li>[OS X] Fixed memory leak with <code>sf::Window::create()</code> (<a href="https://github.com/SFML/SFML/issues/484">#484</a>)</li>
 <li>[OS X] Fixed menu shortcuts in fullscreen on OS X (<a href="https://github.com/SFML/SFML/issues/527">#527</a>)</li>
 <li>[OS X] Improved cursor hiding (<a href="https://github.com/SFML/SFML/pull/703">#703</a>)</li>
 <li>[OS X] Fixed right click not detected with trackpads (<a href="https://github.com/SFML/SFML/issues/716">#716</a>, <a href="https://github.com/SFML/SFML/pull/730">#730</a>)</li>
 <li>[Windows] Fixed joystick POV values (<a href="https://github.com/SFML/SFML/commit/ef1d29bf73c76bfbf06155228de2e7abf1d13c00">ef1d29b</a>)</li>
 <li>[Windows] Fixed Unicode inconsistency (<a href="https://github.com/SFML/SFML/pull/635">#635</a>)</li>
 <li>[Windows] Fixed Alt+F4 and mouse clicks issues (<a href="https://github.com/SFML/SFML/issues/437">#437</a>, <a href="https://github.com/SFML/SFML/pull/457">#457</a>)</li>
 <li>[Windows] Send <code>MouseButtonReleased</code> event when the mouse is outside of the window (<a href="https://github.com/SFML/SFML/issues/455">#455</a>, <a href="https://github.com/SFML/SFML/pull/457">#457</a>)</li>
 <li>[Windows] Fixed <code>sf::Joystick</code> wrong registery usage (<a href="https://github.com/SFML/SFML/issues/701">#701</a>, <a href="https://github.com/SFML/SFML/pull/702">#702</a>, <a href="https://github.com/SFML/SFML/pull/706">#706</a>)</li>
</ul>

<h3 id="2.2-graphics"><a class="h3-link" href="#2.2-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Provide more information about the loaded font in <code>sf::Font</code> (<a href="https://github.com/SFML/SFML/issues/164">#164</a>)</li>
 <li>Implemented a more flexible blending system (<a href="https://github.com/SFML/SFML/issues/298">#298</a>)</li>
 <li>Added strikethrough text style (<a href="https://github.com/SFML/SFML/issues/243">#243</a>, <a href="https://github.com/SFML/SFML/pull/362">#362</a>, <a href="https://github.com/SFML/SFML/pull/682">#682</a>)</li>
 <li>Slight optimization for <code>sf::Text::setString</code> (<a href="https://github.com/SFML/SFML/issues/413">#413</a>)</li>
 <li>Added subtraction operator for <code>sf::Color</code> (<a href="https://github.com/SFML/SFML/issues/114">#114</a>, <a href="https://github.com/SFML/SFML/pull/145">#145</a>)</li>
 <li>Optimized <code>sf::Image::flipVertically/flipHorizontally</code> (<a href="https://github.com/SFML/SFML/pull/555">#555</a>)</li>
 <li>Changed <code>sf::Font</code> measurements from <code>int</code> to <code>float</code> to allow better underline drawing (<a href="https://github.com/SFML/SFML/pull/693">#693</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Improved text quality for small and pixelated fonts (<a href="https://github.com/SFML/SFML/issues/228">#228</a>)</li>
 <li>Yet another fix for Intel GPUs with <code>sf::RenderTexture</code> (<a href="https://github.com/SFML/SFML/issues/418">#418</a>)</li>
 <li>Removed VTab since it cause issues and doesn't have a use nowadays (<a href="https://github.com/SFML/SFML/issues/442">#442</a>, <a href="https://github.com/SFML/SFML/pull/445">#445</a>, <a href="https://github.com/SFML/SFML/pull/460">#460</a>, <a href="https://github.com/SFML/SFML/pull/588">#588</a>)</li>
 <li>Fixed broken BDF and PCF font formats (<a href="https://github.com/SFML/SFML/issues/448">#448</a>)</li>
 <li>Fixed compilation issue with newer versions of GCC for <code>sf::Rect</code> (<a href="https://github.com/SFML/SFML/pull/458">#458</a>)</li>
 <li>Fixed <code>resetGLStates()</code> not explicitly setting the default polygon mode (<a href="https://github.com/SFML/SFML/issues/480">#480</a>)</li>
 <li>Fixed division-by-zero in <code>sf::RectangleShape</code> (<a href="https://github.com/SFML/SFML/issues/499">#499</a>)</li>
 <li>Fixed potential memory leak in <code>sf::Font</code> (<a href="https://github.com/SFML/SFML/pull/509">#509</a>)</li>
 <li>Updated glext and removed glxext (<a href="https://github.com/SFML/SFML/issues/511">#511</a>, <a href="https://github.com/SFML/SFML/pull/583">#583</a>)</li>
 <li>Make sure texture unit 0 is active when resetting <code>sf::RenderTarget</code> states (<a href="https://github.com/SFML/SFML/pull/523">#523</a>, <a href="https://github.com/SFML/SFML/pull/591">#591</a>)</li>
 <li>Fixed texture rect computation in fonts (<a href="https://github.com/SFML/SFML/pull/669">#669</a>)</li>
 <li>Improved rendering of underlined text (<a href="https://github.com/SFML/SFML/pull/593">#593</a>)</li>
 <li>Avoided repeated output of error messages (<a href="https://github.com/SFML/SFML/pull/566">#566</a>)</li>
 <li>Fixed text rendered with vertical offset on ascent and font size mismatch (<a href="https://github.com/SFML/SFML/pull/576">#576</a>)</li>
 <li>Fixed rounding problem for viewports (<a href="https://github.com/SFML/SFML/issues/598">#598</a>)</li>
 <li>Fixed <code>sf::Shader::isAvailable()</code> possibly breaking context management (<a href="https://github.com/SFML/SFML/issues/211">#211</a>, <a href="https://github.com/SFML/SFML/pull/603">#603</a>, <a href="https://github.com/SFML/SFML/issues/608">#608</a>, <a href="https://github.com/SFML/SFML/pull/609">#603</a>)</li>
 <li>Fixed <code>sf::Texture::getMaximumSize()</code> possibly breaking context management (<a href="https://github.com/SFML/SFML/pull/666">#666</a>)</li>
 <li>Fixed various <code>sf::Text</code> rendering issues (<a href="https://github.com/SFML/SFML/issues/692">#692</a>, <a href="https://github.com/SFML/SFML/pull/699">#699</a>)</li>
 <li>The texture matrix is now reset in <code>sf::Texture::bind(NULL)</code> (<a href="https://github.com/SFML/SFML/commit/7c4b058c9a9682bf356ef1fa2d6c81e15b15b179">7c4b058</a>)</li>
 <li>[Windows] Fixed DPI scaling causing strange window behavior (<a href="https://github.com/SFML/SFML/issues/679">#679</a>, <a href="https://github.com/SFML/SFML/pull/681">#681</a>, <a href="https://github.com/SFML/SFML/pull/688">#688</a>)</li>
</ul>

<h3 id="2.2-audio"><a class="h3-link" href="#2.2-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Added support for selecting the audio capture device (<a href="https://github.com/SFML/SFML/issues/220">#220</a>, <a href="https://github.com/SFML/SFML/pull/470">#470</a>)</li>
 <li>Make <code>sf::SoundRecorder</code> processing frequency configurable (<a href="https://github.com/SFML/SFML/issues/333">#333</a>)</li>
 <li>Added up vector to <code>sf::Listener</code> (<a href="https://github.com/SFML/SFML/issues/545">#545</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Prevented <code>sf::SoundStream::setPlayingOffset()</code> from restarting playing even when paused (<a href="https://github.com/SFML/SFML/issues/203">#203</a>, <a href="https://github.com/SFML/SFML/issues/203">#592</a>)</li>
 <li>Fixed <code>sf::SoundBuffer</code> contents not being able to be updated when still attached to sounds (<a href="https://github.com/SFML/SFML/issues/354">#354</a>, <a href="https://github.com/SFML/SFML/pull/367">367</a>, <a href="https://github.com/SFML/SFML/pull/390">#390</a>, <a href="https://github.com/SFML/SFML/pull/589">#589</a>)</li>
 <li>Catch audio format error and prevent division by zero (<a href="https://github.com/SFML/SFML/issues/529">#529</a>)</li>
 <li>Fixed sf::SoundBuffer returning wrong duration for sounds containing more than ~4.3 million samples (<a href="https://github.com/SFML/SFML/commit/2ff58edd9af5530afa0a58657c0908855c96ce21">2ff58ed</a>)</li>
 <li>Optimized <code>sf::Listener</code> with a cache (<a href="https://github.com/SFML/SFML/commit/d97e5244af0138aa5de6076ea13fb5ce1b6ed309">d97e524</a>)</li>
</ul>

<h3 id="2.2-network"><a class="h3-link" href="#2.2-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Added support for PUT and DELETE in <code>sf::Http</code> (<a href="https://github.com/SFML/SFML/issues/257">#257</a>, <a href="https://github.com/SFML/SFML/pull/312">#312</a>, <a href="https://github.com/SFML/SFML/pull/607">#607</a>)</li>
 <li>Added support for chunked HTTP transfers (<a href="https://github.com/SFML/SFML/issues/296">#296</a>, <a href="https://github.com/SFML/SFML/pull/337">#337</a>)</li>
 <li>Added support for 64-bit integers in <code>sf::Packet</code> (<a href="https://github.com/SFML/SFML/pull/710">#710</a>)</li>
 <li>Made <code>sf::Ftp::sendCommand()</code> public (<a href="https://github.com/SFML/SFML/commit/2c5cab5454658eb100b313ab031ed11ab73f311d">2c5cab5</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Checked socket descriptor limit (<a href="https://github.com/SFML/SFML/issues/153">#153</a>, <a href="https://github.com/SFML/SFML/pull/628">#628</a>, <a href="https://github.com/SFML/SFML/pull/683">#683</a>)</li>
 <li>Fixed <code>sf::TcpSocket::connect()</code>'s switching from blocking to non-blocking mode on immediate connection success (<a href="https://github.com/SFML/SFML/pull/221">#221</a>)</li>
 <li>Fixed FTP download and upload file sizes being limited by available RAM (<a href="https://github.com/SFML/SFML/issues/565">#565</a>, <a href="https://github.com/SFML/SFML/pull/590">#590</a>)</li>
 <li>Fixes C++11 compiler warnings for <code>sf::Uint8</code> (<a href="https://github.com/SFML/SFML/issues/731">#731</a>, <a href="https://github.com/SFML/SFML/pull/732">#732</a>)</li>
</ul>

<h2 id="sfml-2.1"><a class="h2-link" href="#sfml-2.1">SFML 2.1</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="2.1-general"><a class="h3-link" href="#2.1-general">General</a></h3>
<ul>
 <li>Updated the Window and OpenGL examples (got rid of GLU and immediate mode)</li>
</ul>

<h3 id="2.1-window"><a class="h3-link" href="#2.1-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Now using <code>inotify</code> on Linux to avoid constantly polling joystick connections (<a href="https://github.com/SFML/SFML/issues/96">#96</a>)</li>
 <li>Add keypad return, equal and period keys support for OS X</li>
 <li>Improved mouse events on OS X regarding fullscreen mode</li>
 <li>Improved mouse events on OS X (<a href="https://github.com/SFML/SFML/issues/213">#213</a>, <a href="https://github.com/SFML/SFML/issues/277">#277</a>)</li>
 <li>Improved reactivity of <code>setMousePosition</code> on OS X (<a href="https://github.com/SFML/SFML/issues/290">#290</a>)</li>
 <li>Added support for right control key on OS X</li>
 <li>Improved <code>TextEntered</code> for OS X (<a href="https://github.com/SFML/SFML/issues/377">#377</a>)</li>
 <li>Improved the performances of <code>Window::getSize()</code> (the size is now cached)</li>
 <li>Added the <code>WM_CLASS</code> property to SFML windows on Linux</li>
 <li>Fake resize events are no longer sent when the window is moved, on Linux</li>
 <li>Pressing ALT or F10 on Windows no longer steals the focus</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>MouseMove</code> event sometimes not generated when holding left button on Windows (<a href="https://github.com/SFML/SFML/issues/225">#225</a>)</li>
 <li>Fixed <code>ContextSettings</code> ignored when creating a 3.x/4.x OpenGL context on Linux (<a href="https://github.com/SFML/SFML/issues/258">#258</a>)</li>
 <li>Fixed <code>ContextSettings</code> ignored on Linux when creating a window (<a href="https://github.com/SFML/SFML/issues/35">#35</a>)</li>
 <li>Fixed windows bigger than the desktop not appearing on Windows (<a href="https://github.com/SFML/SFML/issues/215">#215</a>)</li>
 <li>Fixed <code>KeyRelease</code> events sometimes not reported on Linux (<a href="https://github.com/SFML/SFML/issues/404">#404</a>)</li>
 <li>Fixed mouse moved event on OS X when dragging the cursor (<a href="https://github.com/SFML/SFML/issues/277">#277</a>)</li>
 <li>Fixed <code>KeyRelease</code> event with CMD key pressed (<a href="https://github.com/SFML/SFML/issues/381">#381</a>)</li>
 <li>Fixed taskbar bugs on Windows (<a href="https://github.com/SFML/SFML/issues/328">#328</a>, <a href="https://github.com/SFML/SFML/issues/69">#69</a>)</li>
 <li>Fixed <code>Window::getPosition()</code> on Linux (<a href="https://github.com/SFML/SFML/issues/346">#346</a>)</li>
 <li>Unicode characters outside the BMP (> <code>0xFFFF</code>) are now correctly handled on Windows (<a href="https://github.com/SFML/SFML/issues/366">#366</a>)</li>
</ul>

<h3 id="2.1-graphics"><a class="h3-link" href="#2.1-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Checking errors in <code>RenderTarget::pushGLStates()</code> to avoid generating false error messages when user leaves unchecked OpenGL errors (<a href="https://github.com/SFML/SFML/issues/340">#340</a>)</li>
 <li>Optimized <code>Shader::setParameter</code> functions, by using a cache internally (<a href="https://github.com/SFML/SFML/issues/316">#316</a>, <a href="https://github.com/SFML/SFML/issues/358">#358</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed bounding rect of <code>sf::Text</code> ignoring whitespaces (<a href="https://github.com/SFML/SFML/issues/216">#216</a>)</li>
 <li>Solved graphics resources not updated or corrupted when loaded in a thread (<a href="https://github.com/SFML/SFML/issues/411">#411</a>)</li>
 <li>Fixed white pixel showing on first character of <code>sf::Text</code> (<a href="https://github.com/SFML/SFML/issues/414">#414</a>)</li>
 <li><code>sf::Rect::contains</code> and <code>sf::Rect::intersects</code> now handle rectangles with negative dimensions correctly (<a href="https://github.com/SFML/SFML/issues/219">#219</a>)</li>
 <li>Fixed <code>Shape::setTextureRect</code> not working when called before <code>setTexture</code></li>
</ul>

<h3 id="2.1-audio"><a class="h3-link" href="#2.1-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li><code>loadFromStream</code> functions now explicitly reset the stream (<code>seek(0)</code>) before starting to read (<a href="https://github.com/SFML/SFML/issues/349">#349</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Added a workaround for a bug in the OS X implementation of OpenAL (unsupported channel count no properly detected) (<a href="https://github.com/SFML/SFML/issues/201">#201</a>)</li>
 <li>Fixed <code>SoundBuffer::loadFromStream</code> reading past the end of the stream (<a href="https://github.com/SFML/SFML/issues/214">#214</a>)</li>
</ul>

<h3 id="2.1-network"><a class="h3-link" href="#2.1-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Replaced the deprecated <code>gethostbyname</code> with <code>getaddrinfo</code> (<a href="https://github.com/SFML/SFML/issues/47">#47</a>)</li>
 <li>Minor improvements to <code>sf::Packet</code> operators (now using <code>strlen</code> and <code>wcslen</code> instead of explicit loops) (<a href="https://github.com/SFML/SFML/issues/118">#118</a>)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed non-blocking connection with a <code>sf::TcpSocket</code> on Windows</li>
 <li>Fixed TCP packet data corruption in non-blocking mode (<a href="https://github.com/SFML/SFML/issues/402">#402</a>, <a href="https://github.com/SFML/SFML/issues/119">#119</a>)</li>
 <li>On Unix systems, a socket disconnection no longer stops the program with signal <code>SIGPIPE</code> (<a href="https://github.com/SFML/SFML/issues/72">#72</a>)</li>
</ul>

<h2 id="sfml-2.0"><a class="h2-link" href="#sfml-2.0">SFML 2.0</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>
<p>No changelog available. Everything changed.</p>

<h2 id="sfml-1.6"><a class="h2-link" href="#sfml-1.6">SFML 1.6</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.6-general"><a class="h3-link" href="#1.6-general">General</a></h3>
<ul>
 <li>SFML libraries are now be compiled with gcc 4.4.0 on Windows (MinGW)</li>
 <li>Updated the Qt sample</li>
 <li>Added a Cocoa sample</li>
 <li>Added support for 64 bits on Mac OS X 10.5 and greater</li>
</ul>

<h3 id="1.6-system"><a class="h3-link" href="#1.6-system">System</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Fixed the initial seed of <code>sf::Randomizer</code> which is always the same on some configurations</li>
</ul>

<h3 id="1.6-window"><a class="h3-link" href="#1.6-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Increased the number of supported joysticks to 4</li>
 <li>Added return to the desktop resolution when the SFML fullscreen application is not active, on Mac OS X</li>
 <li>Added support for importing Cocoa widgets (in addition to Cocoa windows), on Mac OS X</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed inconsistencies with the state of the left/right shift keys on Windows</li>
 <li>Fixed joystick axes being sometimes ignored</li>
 <li>Fixed <code>Event::TextEntered</code> ignoring the key repeat state</li>
 <li>Fixed <code>KeyEvent.Alt</code>/<code>Control</code>/<code>Shift</code> members not working, in SFML.Net</li>
 <li>Fixed a crash happening when closing an imported window, on Mac OS X</li>
 <li>Fixed a bad behaviour when switching to fullscreen mode, on Mac OS X</li>
 <li>Fixed bips produced when pressing function or escape keys, on Mac OS X</li>
 <li>Fixed a conflict between SFML and Cocoa that may create memory leaks, on Mac OS X</li>
 <li>Fixed possible conflict between the SFML objective-C classes and the user's ones (using a private prefix in SFML), on Mac OS X</li>
 <li>Fixed wrong mouse coordinates when importing a Cocoa widget, on Mac OS X</li>
</ul>

<h3 id="1.6-graphics"><a class="h3-link" href="#1.6-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Disabled implicit conversion from <code>sf::Image</code> to <code>sf::Sprite</code></li>
 <li>Made image loading thread-safe</li>
 <li>Improved accuracy of rendering</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed crash with the default font at global exit on Windows</li>
 <li>Fixed current OpenGL matrix mode not properly saved when <code>PreserveOpenGLStates</code> is activated</li>
 <li>Fixed a bug preventing image creation if no window was created, on Mac OS X</li>
</ul>

<h3 id="1.6-audio"><a class="h3-link" href="#1.6-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Copied <code>Attenuation</code> and <code>MinDistance</code> members in <code>sf::Sound</code>'s copy constructor</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed crash when destroying a <code>SoundBuffer</code> used by a <code>Sound</code></li>
 <li>Fixed tiny musics ignoring the "loop" flag</li>
 <li>Fixed musics sometimes being stuck after looping twice</li>
</ul>

<h3 id="1.6-network"><a class="h3-link" href="#1.6-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li><code>Http::Response::GetField</code> is now case insensitive</li>
 <li>Added <code>"Connection: close"</code> by default for <code>HTTP 1.1</code> requests</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed crashes in <code>Ftp::Download</code> and <code>Ftp::Upload</code> with empty files</li>
 <li>Fixed <code>SocketTCP::Connect</code> with timeout returning success when connection failed</li>
 <li>Fixed <code>POST</code> requests not working with <code>sf::Http</code></li>
</ul>

<h2 id="sfml-1.5"><a class="h2-link" href="#sfml-1.5">SFML 1.5</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.5-general"><a class="h3-link" href="#1.5-general">General</a></h3>
<ul>
 <li>Fixed the code to make SFML compile on FreeBSD</li>
 <li>Added the OpenAL framework to the SDK on Mac OS X</li>
 <li><code>libsndfile</code> is now linked dynamically on Mac OS X</li>
 <li>Added the XCode project files for CSFML</li>
 <li>Added Visual C++ project files for samples</li>
</ul>

<h3 id="1.5-system"><a class="h3-link" href="#1.5-system">System</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Fixed bug with <code>std::locale</code> on Mac OS X</li>
 <li>The working directory is now initialized properly at startup on Mac OS X</li>
</ul>

<h3 id="1.5-window"><a class="h3-link" href="#1.5-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Updated the Qt sample and tutorial to work with Qt 4.5</li>
 <li>Added missing <code>VideoMode</code> functions to SFML.Net</li>
 <li>Added support for creating a <code>sf::Window</code> from a Cocoa window on Mac OS X</li>
 <li>Added support for composed characters on Mac OS X</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed application frozen if a USB joystick was plugged, on Windows</li>
 <li>Fixed joysticks sometimes not working at all on Vista</li>
 <li>Properly detect supported depths for video modes on Linux</li>
 <li>Fixed undefined behaviour when creating two fullscreen windows</li>
 <li>Fixed <code>Window::SetSize</code> not resizing to the requested size, on Windows</li>
 <li>Fixed <code>KeyPressed</code> event sometimes returning a null key code on Windows</li>
 <li>Fixed <code>EnableKeyRepeat</code> not working anymore after a second window has been created on Linux</li>
 <li>Fixed bug when destroying / recreating a window on Mac OS X</li>
 <li>Desktop resolution is properly restored when hiding the application on Mac OS X</li>
 <li>Fixed accentuated characters not properly retrieved on Mac OS X</li>
</ul>

<h3 id="1.5-graphics"><a class="h3-link" href="#1.5-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Modified the blending mode <code>Blend::Add</code> to use source alpha</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed 1-pixel offset in <code>Sprite::GetPixel</code> when <code>FlipX</code> or <code>FlipY</code> is set</li>
 <li>Fixed undefined behaviour when rendering a sprite bound to an empty image</li>
 <li>Fixed <code>sf::Image::Copy</code> to apply transparency of the source image</li>
 <li>Fixed <code>RenderWindow.CurrentView</code> not initialized in SFML.Net</li>
 <li>Fixed <code>Sprite.SubRect</code> and <code>String2D.GetRect</code> crash in SFML.Net</li>
 <li>Fixed global colors not properly exported in CSFML</li>
</ul>

<h3 id="1.5-audio"><a class="h3-link" href="#1.5-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Added a function to disable sound spatialization</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>Listener</code> functions being private in SFML.Net</li>
 <li>Fixed memory leaks when playing ogg audio files</li>
 <li>Fixed OpenAL error on Mac OSX when calling <code>SoundStream::Stop</code></code></li>
 <li>Fixed multi-threading issues in <code>sf::Music</code></code></li>
 <li>Fixed <code>sf::SoundStream</code> (and <code>sf::Music</code>) not looping seamlessly</li>
</ul>

<h3 id="1.5-network"><a class="h3-link" href="#1.5-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Got rid of <code>whatismyip.org</code> as the default server for public IP retrieval</li>
 <li>Added a <code>timeout</code> parameter to <code>Http::SendRequest</code></li>
</ul>

<h2 id="sfml-1.4"><a class="h2-link" href="#sfml-1.4">SFML 1.4</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.4-general"><a class="h3-link" href="#1.4-general">General</a></h3>
<ul>
 <li>Added debug symbols to debug builds in Code::Blocks</li>
 <li>Added .Net binding</li>
 <li>Improved management of dependent resources</li>
 <li>Now using full unicode instead of <code>UCS-2</code> for all text-related events and strings</li>
 <li>Added minor version number to libraries names under Linux</li>
 <li>Added install path to Linux <code>makefile</code>s</li>
</ul>

<h3 id="1.4-system"><a class="h3-link" href="#1.4-system">System</a></h3>
<h4>Features</h4>
<ul>
 <li>Improved unicode support</li>
</ul>

<h3 id="1.4-window"><a class="h3-link" href="#1.4-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Now using signed integers for mouse coordinates to allow negative values</li>
 <li>Added cursor position in mouse events</li>
 <li>Added <code>sf::Window::SetIcon</code> function</li>
 <li>Added mouse enter / mouse leave window events</li>
 <li>Added <code>sf::Window::SetSize</code></li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>sf::Window::EnableKeyRepeat</code> under Linux</li>
 <li>Fixed X11 sample (broken rendering on the first window)</li>
</ul>

<h3 id="1.4-graphics"><a class="h3-link" href="#1.4-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Added functions to copy images onto other images</li>
 <li>Added an option to have <code>sf::Image</code> instances not storing their pixels in memory</li>
 <li>Made SFML classes completely thread-safe regarding OpenGL calls</li>
 <li>Added <code>sf::String::GetCharacterPos</code> to get visual position of a string's character</li>
 <li>Added functions to convert from and to <code>drawable</code>s' local coordinates</li>
 <li>Added more functions to access <code>sf::Font</code>'s contents</li>
 <li>Added more accessors for <code>sf::Shape</code> points' attributes</li>
 <li>Optimized font's textures</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>sf::Sprite::GetPixel</code> not taking flip x/y in account</li>
 <li>Fixed <code>sf::Matrix3</code> calculations</li>
</ul>

<h3 id="1.4-audio"><a class="h3-link" href="#1.4-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Added <code>GetLoop</code>, <code>SetLoop</code> and <code>GetPlayingPosition</code> to sounds streams</li>
 <li>Removed dependency to the Visual C++ CRT in OpenAL32.dll</li>
 <li>Added seeking function to <code>sf::Sound</code></li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>sf::SoundBufferRecorder</code> which couldn't be reused several times</li>
 <li>Fixed music clics under Linux</li>
</ul>

<h3 id="1.4-network"><a class="h3-link" href="#1.4-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Added a function to check end of packet</li>
 <li>Disabled Nagle's algorithm (buffering) in TCP sockets</li>
 <li>Added <code>HTTP</code> and <code>FTP</code> classes</li>
 <li>Added conversions from and to integer for IP address</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>sf::Packet::OnSend</code> called multiple times if packet was sent more than once</li>
 <li>Fixed inconsistent socket initialization</li>
 <li>Fixed crash when using empty strings with packets</li>
</ul>

<h2 id="sfml-1.3"><a class="h2-link" href="#sfml-1.3">SFML 1.3</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.3-general"><a class="h3-link" href="#1.3-general">General</a></h3>
<ul>
 <li>Added static build on Linux</li>
 <li>Fixed runtime errors with VC++ 2008 libraries</li>
</ul>

<h3 id="1.3-system"><a class="h3-link" href="#1.3-system">System</a></h3>
<h4>Features</h4>
<ul>
 <li>Added vector classes (<code>Vector2</code> and <code>Vector3</code>)</li>
</ul>

<h3 id="1.3-window"><a class="h3-link" href="#1.3-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Made event handling independent from display in <code>sf::Window</code></li>
 <li>Replaced <code>sf::Window::SetCurrent</code> with <code>sf::Window::SetActive(bool)</code></li>
 <li>Input states are now reseted in <code>sf::Input</code> when a window loses the focus</li>
 <li>Implemented the <code>TextEntered</code> event in Linux</li>
 <li>Added <code>sf::Window::Close</code> and <code>sf::Window::IsOpened</code></li>
 <li>Added some missing key codes to the <code>sf::Key::Code</code> enumeration</li>
 <li>Added the <code>sf::Style::None</code> window style, and replaced <code>sf::Style::NoStyle</code> with <code>sf::Style::Titlebar</code></li>
 <li>Added a function to enable / disable automatic key-repeat for <code>keypress</code> events</li>
 <li><code>sf::Window::SetCursorPosition</code> no longer generates a <code>MouseMoved</code> event</li>
 <li>Added more options when creating a window (to have more control on OpenGL context settings)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed bug when destroying a window and then creating a new one</li>
 <li>Fixed windows not closed after their <code>sf::Window</code> instance was destroyed (in Linux)</li>
 <li>Fixed a bug with joysticks in Windows</li>
</ul>

<h3 id="1.3-graphics"><a class="h3-link" href="#1.3-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Changed the <code>sf::Drawable</code> center of rotation to be the center of translation and scaling as well</li>
 <li>Improved the font interface / management (there's now a <code>sf::Font</code> class)</li>
 <li>Added styles to <code>sf::String</code> (bold / italic / underline)</li>
 <li>Added loading from memory for character fonts</li>
 <li>Added a class to draw simple shapes (<code>sf::Shape</code>)</li>
 <li><code>RenderWindow::Draw</code> can now be called in cascade to allow hierarchies of <code>Drawable</code> objects</li>
 <li>Improved <code>sf::View</code> to make it more convenient and flexible</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed <code>sf::RenderWindow::Capture</code> returning a flipped image and/or crashing</li>
 <li>Fixed viewport issue when using custom OpenGL calls</li>
 <li>Fixed bug with <code>sf::String</code> scale and size</li>
 <li>Fixed bug when checking the size of a new image</li>
 <li>Fixed a bug with background color when running more than one <code>RenderWindow</code> at the same time</li>
 <li>Fixed pixel accuracy with non-smoothed images</li>
 <li>Fixed PNG loading failing on 64 bits systems</li>
</ul>

<h3 id="1.3-audio"><a class="h3-link" href="#1.3-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>SFML is now using OpenAL-Soft as the OpenAL implementation, which is more stable on Linux</li>
 <li>Added <code>SetMinDistance</code> and <code>SetAttenuation</code> for <code>Sound</code> and <code>Music</code> classes</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed wrong duration with ogg sounds and other formats musics</li>
 <li>Fixed failure to save a sound buffer to a file</li>
</ul>

<h3 id="1.3-network"><a class="h3-link" href="#1.3-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Added handling of wide strings (<code>std::wstring</code>, <code>const wchar_t*</code>) to <code>sf::Packet</code></li>
 <li>Improved the interface of <code>sf::Selector</code> (<code>GetSocketsReady</code> is now replaced with <code>Wait</code> + <code>GetSocketReady</code>)</li>
 <li>Rewrote <code>sf::Selector</code> class to remove explicit dependency to <code>winsock</code> library on Windows</li>
 <li>Made insertions into packets faster</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed sockets sometimes receiving too much packet data</li>
 <li>Incomplete packets are now received properly in non-blocking mode</li>
</ul>

<h2 id="sfml-1.2"><a class="h2-link" href="#sfml-1.2">SFML 1.2</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.2-general"><a class="h3-link" href="#1.2-general">General</a></h3>
<ul>
 <li>Added a Python binding (PySFML)</li>
 <li>Added a C wrapper for SFML</li>
 <li>SFML libraries are now compatible with Win 95/98/Me</li>
 <li>Added Visual C++ 2008 project files and compiled binaries</li>
 <li>Added functions to load images and sounds from files in memory</li>
</ul>

<h3 id="1.2-window"><a class="h3-link" href="#1.2-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Removed the <code>KeyReleased</code> event auto-repeat in Linux</li>
 <li>Added more axis and buttons for joysticks</li>
 <li>Added handling of two more buttons for mouse</li>
 <li>Improved flexibility of window styles</li>
 <li>Added the <code>sf::Window::Show</code> function to show or hide a SFML window</li>
 <li>Added the <code>sf::Window::SetCursorPosition</code> function to warp the mouse cursor to a given position</li>
 <li>Added the control, shift and alt keys for the <code>KeyPressed</code> and <code>KeyReleased</code> events</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed windows not updating their size properly on Linux</li>
 <li>Fixed a crash with the mouse wheel in Linux</li>
 <li>Fixed GLU issues with MinGW</li>
 <li>Fixed a bug with events in Linux, <code>sf::Window</code> instances can now be re-created correctly</li>
</ul>

<h3 id="1.2-graphics"><a class="h3-link" href="#1.2-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Added checking of maximum texture size when creating a <code>sf::Image</code></li>
 <li>Improved text rendering, especially small characters</li>
 <li>Removed the looping error message when failed to load a font</li>
 <li>Removed <code>sf::Image::Update</code>, images are now updated automatically when needed</li>
 <li>Made color representations more consistent (all is RGBA, and no more <code>Uint32</code> manipulations)</li>
 <li>Added <code>SetBlendMode</code> function to <code>sf::Drawable</code> classes (can choose <code>Alpha</code>, <code>Add</code>, <code>Multiply</code> or <code>None</code>)</li>
 <li>Added <code>SetPosition</code>, <code>SetScaleX</code> and <code>SetScaleY</code> functions to <code>sf::Drawable</code> classes</li>
 <li>Added the ability to flip sprites on X and Y axis</li>
 <li>Added the ability to create flipped and/or mirrored views</li>
 <li>Got rid of DevIL and <code>zlib</code></li>
 <li>Improved the integration of OpenGL functions into SFML rendering</li>
 <li>FreeType is now linked statically in Windows (no more need for the DLL)</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed memory leaks in font loading</li>
</ul>

<h3 id="1.2-audio"><a class="h3-link" href="#1.2-audio">Audio</a></h3>
<h4>Features</h4>
<ul>
 <li>Added the <code>sf::Listener</code> class to control the audio listener properties</li>
 <li>Got rid of <code>libvorbis</code>, <code>libvorbisfile</code> and <code>libogg</code></li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed a bug with wrong OGG musics duration</li>
</ul>

<h3 id="1.2-network"><a class="h3-link" href="#1.2-network">Network</a></h3>
<h4>Features</h4>
<ul>
 <li>Added non-blocking mode for sockets</li>
 <li>Improved safety of data reading from packets</li>
 <li>Improved management of sockets state</li>
 <li>Added <code>Bind</code> and <code>Unbind</code> functions to UDP sockets</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed crash when sending an empty packet</li>
 <li>Fixed <code>sf::IPAddress::GetPublicAddress</code> which failed sometimes</li>
</ul>

<h2 id="sfml-1.1"><a class="h2-link" href="#sfml-1.1">SFML 1.1</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

<h3 id="1.1-general"><a class="h3-link" href="#1.1-general">General</a></h3>
<ul>
 <li>Added the Mac OSX port from Brad Leffler</li>
 <li>Added the Ruby binding from Sean O'Neil</li>
 <li>Added namespaces (now the SFML classes and functions are inside the <code>sf</code> namespace)</li>
 <li>Added a new sample (pong)</li>
 <li>Fixed CMake files, Linux Makefiles and Code::Blocks project files</li>
 <li>Removed an external dependency with GLEW in Linux</li>
</ul>

<h3 id="1.1-system"><a class="h3-link" href="#1.1-system">System</a></h3>
<h4>Features</h4>
<ul>
 <li>Added unicode support for String</li>
 <li>Added ability to get a <code>std::string</code> from a <code>String</code> object</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li><code>String</code> doesn't crash anymore in MinGW</li>
</ul>

<h3 id="1.1-window"><a class="h3-link" href="#1.1-window">Window</a></h3>
<h4>Features</h4>
<ul>
 <li>Added support for mouse wheel (<code>Event::MouseWheelMoved</code>)</li>
 <li>Added support for antialiasing</li>
 <li>Added <code>Window::SetPosition</code> and <code>RenderWindow::SetPosition</code></li>
 <li>Added <code>Window::SetFramerateLimit</code> and <code>RenderWindow::SetFramerateLimit</code></li>
 <li>Added a "<code>style</code>" parameter to replace the "<code>fullscreen</code>" one on window creation, to have more control over the window style</li>
 <li>Added the <code>Key::Pause</code> key</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li>Fixed the bad behaviors with the mouse cursor in Windows</li>
 <li>Fixed <code>SFML/Window.hpp</code> now includes <code>OpenGLCaps.hpp</code> and <code>glew.h</code></li>
 <li>Fixed the error loop when using the <code>Window</code> package in Linux</li>
 <li>Fixed bugs with window <code>style</code>s in some Linux systems</li>
</ul>

<h3 id="1.1-graphics"><a class="h3-link" href="#1.1-graphics">Graphics</a></h3>
<h4>Features</h4>
<ul>
 <li>Added more control over <code>drawables</code> size (added <code>Sprite::Resize</code> and made X and Y scales independent)</li>
 <li>Added <code>GetDepthBits</code> and <code>GetStencilBits</code> functions into <code>RenderWindow</code></li>
 <li>Added an optional target <code>alpha</code> value for <code>Image::CreateMaskFromColor</code></li>
 <li>Improved the <code>PostFX</code> sample (now displays an error message if post-effects are not supported)</li>
 <li>Added <code>+</code> and <code>*</code> operators to add and modulate <code>Color</code> instances</li>
</ul>

<h4>Bugfixes</h4>
<ul>
 <li><code>Image</code>s are no more flipped when saved to a file</li>
 <li><code>Sprite::GetPixel</code> now takes the scale and the overall color into account</li>
</ul>

<h3 id="1.1-audio"><a class="h3-link" href="#1.1-audio">Audio</a></h3>
<h4>Bugfixes</h4>
<ul>
 <li>Fixed crashes on audio samples exit</li>
</ul>

<?php
    require("footer.php");
?>
