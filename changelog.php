<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php',
        'Changelog' => 'changelog.php'
    );
    include('header.php');
?>
<div class="changelog">
 <h1><a name="sfml-2.2" href="#sfml-2.2">SFML 2.2</a></h1>

 <h2>Highlights</h2>
 <ul>
  <li>Experimental Android and iOS support.</li>
  <li>Improved blending mode system.</li>
  <li>Added a functions to get a window's focus state and request focus for it.</li>
 </ul>

 <h2>General</h2>
 <ul>
  <li>Support for iOS and Android platform (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/410">#410</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/440">#440</a>)</li>
  <li>Various documentation corrections (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/438">#438</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/496">#496</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/497">#497</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/714">#714</a>)</li>
  <li>Fixed support for compilers on Debian FreeBSD (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/380">#380</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/578">#578</a>)</li>
  <li>Added support for Visual Studio 2013 and proper support for the TDM builds (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/482">#482</a>)</li>
  <li>Fixed CMake problems related to FindSFML and cached variables (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/637">#637</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/684">#684</a>)</li>
  <li>Switched and enforced <code>LF</code> line endings (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/708">#708</a> &amp; <a target="_blank" href="
 https://github.com/LaurentGomila/SFML/pull/712">#712</a>)</li>
  <li>Updated OpenAL to version 1.15.1 (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/d07721075057c7eac33124ff406eb0f5d629258b">d077210</a>)</li>
  <li>Made compiler and OS variable names much clearer in CMake files (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/9b0ed300b5ced8f9bd49be42089b2988c4007947">9b0ed30</a>)</li>
  <li>Re-enabled RPATH feature (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/e157e7a7a84d9d840c590df355d2681d0936971e">e157e7a</a>)</li>
  <li>Slight adjustments to the examples (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/737">#737</a>)</li>
  <li>[FreeBSD] Various configuration fixes (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/577">#577</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/578">#578</a>)</li>
  <li>[Linux] Updated <code>FindSFML.cmake</code> to add UDev to SFML's dependencies (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/728">#728</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/729">#729</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/734">#734</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/736">#736</a>)</li>
  <li>[OS X] Fixed incorrect symlink in freetype.framework (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/519">#519</a>)</li>
  <li>[OS X] CMake module for correct dependencies (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/548">#548</a>)</li>
  <li>[OS X] Fixed SFML target for Xcode (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/595">#595</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/596">#596</a>)</li>
  <li>[OS X] Updated implementation, mainly reverting to non-ARC (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/601">#601</a>)</li>
  <li>[OS X] Fixed memory leaks and dead store (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/615">#615</a>)</li>
  <li>[OS X] Improved event handling and performance (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/617">#617</a>)</li>
  <li>[OS X] Reduced memory usage (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/672">#672</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/698">#698</a>)</li>
  <li>[OS X] OS X 10.10 support (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/691">#691</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/699">#699</a>)</li>
  <li>[OS X] Improve flexibility of dependencies' locations (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/713">#713</a>)</li>
  <li>[Windows] Removed the hack that copied external libraries into SFML static libraries (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/dbf01a775b7545bf83fbee0e1464f3f323723187">dbf01a7</a>)</li>
 </ul>

 <h2>System</h2>
 <h3>Features</h3>
 <ul>
  <li>Added substring and replace functions to <code>sf::String</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/21">#21</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/355">#355</a>)</li>
  <li>Added <code>toUtfX</code> to <code>sf::String</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/501">#501</a>)</li>
  <li>Added <code>fromUtfX</code> functions to set the internal data to a string by converting from another string in a fixed encoding (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/196">#196</a>)</li>
  <li>Added modulo operator for <code>sf::Time</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/429">#429</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/430">#430</a>)</li>
  <li>Added division operator for <code>sf::Time</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/453">#453</a>)</li>
 </ul>

 <h3>Bugfixes</h3>
 <ul>
  <li>Ensured a high resolution for <code>sf::sleep</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/439">#439</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/475">#475</a>)</li>
  <li>[Windows] Fixed stack unalignment by two internal functions (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/412">#412</a>)</li>
 </ul>

 <h2>Window</h2>
 <h3>Features</h3>
 <ul>
  <li>Added window methods to request and to check focus (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/518">#518</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/525">#525</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/613">#613</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/723">#723</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/735">#735</a>)</li>
  <li>Provide name, manufacturer ID and product ID via <code>sf::Joystick</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/152">#152</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/528">#528</a>)</li>
  <li>[FreeBDS] Joystick support (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/477">#477</a>)</li>
  <li>[OS X] Improved integration with menus and dock actions (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/11">#11</a>)</li>
  <li>[OS X] Support for OpenGL 3.2 (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/84">#84</a>)</li>
  <li>[OS X] Improved fullscreen support (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/343">#343</a>)</li>
  <li>[OS X] Added support for retina displays (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/353">#353</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/388">#388</a>)</li>
  <li>[Windows] Removed support for Windows 9x (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/469">#469</a>)</li>
  <li>[Windows] Fixed typo in Windows keyboard implementation (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/516">#516</a>)</li>
 </ul>

 <h3>Bugfixes</h3>
 <ul>
  <li><code>Window::create()</code> now also resets framerate limit (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/371">#371</a>)</li>
  <li>Fixed OpenGL context leak (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/635">#635</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/705">#705</a>)</li>
  <li>Fixed various joystick problems (memory leak, accelerometer detected, code refactoring) (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/660">#660</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/686">#686</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/742">#742</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/743">#743</a>)</li>
  <li>Optimized <code>sf::Window::waitEvent</code> a bit, no sleep if events are available at first try (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/ff555d6f851ddcc9815d34e294f7dbf44180ac90">ff555d6</a>)</li>
  <li>[Linux] Output error message when <code>XOpenDisplay()</code> fails (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/508">#508</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/616">#616</a>)</li>
  <li>[Linux] Resize window with <code>setSize</code> when <code>sf::Style::Resize</code> is set (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/466">#466</a>)</li>
  <li>[Linux] Fixed broken key repeat on window recreation (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/564">#564</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/567">#567</a>)</li>
  <li>[OS X] Fixes <code>KeyReleased</code> not being fired in fullscreen mode (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/465">#465</a>)</li>
  <li>[OS X] Fixed an issue where disconnecting the keyboard would cause a crash (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/467">#467</a>)</li>
  <li>[OS X] Fixed unexpected resizing behavior (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/468">#468</a>)</li>
  <li>[OS X] Improved resizing windows (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/474">#474</a>)</li>
  <li>[OS X] Fixed memory leak with <code>sf::Window::create()</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/484">#484</a>)</li>
  <li>[OS X] Fixed menu shortcuts in fullscreen on OS X (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/527">#527</a>)</li>
  <li>[OS X] Improved cursor hiding (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/703">#703</a>)</li>
  <li>[OS X] Fixed right click not detected with trackpads (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/716">#716</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/730">#730</a>)</li>
  <li>[Windows] Fixed joystick POV values (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/ef1d29bf73c76bfbf06155228de2e7abf1d13c00">ef1d29b</a>)</li>
  <li>[Windows] Fixed Unicode inconsistency (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/635">#635</a>)</li>
  <li>[Windows] Fixes Alt+F4 and mouse clicks issues (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/437">#437</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/457">#457</a>)</li>
  <li>[Windows] Send <code>MouseButtonReleased</code> event when the mouse is outside of the window (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/455">#455</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/457">#457</a>)</li>
  <li>[Windows] Fixed <code>sf::Joystick</code> wrong registery usage (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/701">#701</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/702">#702</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/706">#706</a>)</li>
 </ul>

 <h2>Graphics</h2>
 <h3>Features</h3>
 <ul>
  <li>Provide more information about the loaded font in <code>sf::Font</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/164">#164</a>)</li>
  <li>Implemented a more flexible blending system (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/298">#298</a>)</li>
  <li>Added strikethrough text style (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/243">#243</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/362">#362</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/682">#682</a>)</li>
  <li>Slight optimization for <code>sf::Text::setString</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/413">#413</a>)</li>
  <li>Added subtraction operator for <code>sf::Color</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/114">#114</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/145">#145</a>)</li>
  <li>Optimized <code>sf::Image::flipVertically/flipHorizontally</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/555">#555</a>)</li>
  <li>Changed <code>sf::Font</code> measurements from <code>int</code> to <code>float</code> to allow better underline drawing (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/693">#693</a>)</li>
 </ul>

 <h3>Bugfixes</h3>
 <ul>
  <li>Improved text quality for small and pixelated fonts (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/228">#228</a>)</li>
  <li>Yet another fix for Intel GPUs with <code>sf::RenderTexture</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/418">#418</a>)</li>
  <li>Removed VTab since it cause issues and doesn't have a use nowadays (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/442">#442</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/445">#445</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/460">#460</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/588">#588</a>)</li>
  <li>Fixed broken BDF and PCF font formats (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/448">#448</a>)</li>
  <li>Fixed compilation issue with newer versions of GCC for <code>sf::Rect</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/458">#458</a>)</li>
  <li>Fixed <code>resetGLStates()</code> not explicitly setting the default polygon mode (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/480">#480</a>)</li>
  <li>Fixed division-by-zero in <code>sf::RectangleShape</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/499">#499</a>)</li>
  <li>Fixed potential memory leak in <code>sf::Font</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/509">#509</a>)</li>
  <li>Updated glext and removed glxext (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/511">#511</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/583">#583</a>)</li>
  <li>Make sure texture unit 0 is active when resetting <code>sf::RenderTarget</code> states (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/523">#523</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/591">#591</a>)</li>
  <li>Fixed texture rect computation in fonts (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/669">#669</a>)</li>
  <li>Improved rendering of underlined text (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/593">#593</a>)</li>
  <li>Avoided repeated output of error messages (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/566">#566</a>)</li>
  <li>Fixed text rendered with vertical offset on ascent and font size mismatch (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/576">#576</a>)</li>
  <li>Fixed rounding problem for viewports (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/598">#598</a>)</li>
  <li>Fixed <code>sf::Shader::isAvailable()</code> possibly breaking context management (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/211">#211</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/603">#603</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/608">#608</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/609">#603</a>)</li>
  <li>Fixed <code>sf::Texture::getMaximumSize()</code> possibly breaking context management (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/666">#666</a>)</li>
  <li>Fixed various <code>sf::Text</code> rendering issues (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/692">#692</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/699">#699</a>)</li>
  <li>The texture matrix is now reset in <code>sf::Texture::bind(NULL)</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/7c4b058c9a9682bf356ef1fa2d6c81e15b15b179">7c4b058</a>)</li>
  <li>[Windows] Fixed DPI scaling causing strange window behavior (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/679">#679</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/681">#681</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/688">#688</a>)</li>
 </ul>

 <h2>Audio</h2>
 <h3>Features</h3>
 <ul>
  <li>Added support for selecting the audio capture device (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/220">#220</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/470">#470</a>)</li>
  <li>Make <code>sf::SoundRecorder</code> processing frequency configurable (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/333">#333</a>)</li>
  <li>Added up vector to <code>sf::Listener</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/545">#545</a>)</li>
 </ul>

 <h3>Bugfixes</h3>
 <ul>
  <li>Prevents <code>sf::SoundStream::setPlayingOffset()</code> from restarting playing even when paused (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/203">#203</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/203">#592</a>)</li>
  <li>Fixed <code>sf::SoundBuffer</code> contents not being able to be updated when still attached to sounds (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/354">#354</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/367">367</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/390">#390</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/589">#589</a>)</li>
  <li>Catch audio format error and prevent division by zero (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/529">#529</a>)</li>
  <li>Fixed sf::SoundBuffer returning wrong duration for sounds containing more than ~4.3 million samples (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/2ff58edd9af5530afa0a58657c0908855c96ce21">2ff58ed</a>)</li>
  <li>Optimized <code>sf::Listener</code> with a cache (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/d97e5244af0138aa5de6076ea13fb5ce1b6ed309">d97e524</a>)</li>
 </ul>

 <h2>Network</h2>
 <h3>Features</h3>
 <ul>
  <li>Added support for PUT and DELETE in <code>sf::Http</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/257">#257</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/312">#312</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/607">#607</a>)</li>
  <li>Added support for chunked HTTP transfers (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/296">#296</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/337">#337</a>)</li>
  <li>Added support for 64-bit integers in <code>sf::Packet</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/710">#710</a>)</li>
  <li>Made <code>sf::Ftp::sendCommand()</code> public (<a target="_blank" href="https://github.com/LaurentGomila/SFML/commit/2c5cab5454658eb100b313ab031ed11ab73f311d">2c5cab5</a>)</li>
 </ul>

 <h3>Bugfixes</h3>
 <ul>
  <li>Checked socket descriptor limit (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/153">#153</a>, <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/628">#628</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/683">#683</a>)</li>
  <li>Fixed <code>sf::TcpSocket::connect()</code>'s switching from blocking to non-blocking mode on immediate connection success (<a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/221">#221</a>)</li>
  <li>Fixed FTP download and upload file sizes being limited by available RAM (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/565">#565</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/590">#590</a>)</li>
  <li>Fixes C++11 compiler warnings for <code>sf::Uint8</code> (<a target="_blank" href="https://github.com/LaurentGomila/SFML/issues/731">#731</a> &amp; <a target="_blank" href="https://github.com/LaurentGomila/SFML/pull/732">#732</a>)</li>
 </ul>

 <h1><a name="sfml-2.1" href="#sfml-2.1">SFML 2.1</a></h1>
 <p>Please refer to the <a target="_blank" href="http://en.sfml-dev.org/forums/index.php?topic=76.msg86454#msg86454" title="Go to the release announcement">release announcement</a>.</p>

 <h1><a name="sfml-2.0" href="#sfml-2.0">SFML 2.0</a></h1>
 <p>Please refer to the <a target="_blank" href="http://en.sfml-dev.org/forums/index.php?topic=76.msg78424#msg78424" title="Go to the release announcement">release announcement</a>.</p>
</div>
