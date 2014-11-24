<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Member List'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header-fr.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
      <li class="current"><a href="annotated.php"><span>Classes</span></a></li>
      <li><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
  <div id="navrow2" class="tabs2">
    <ul class="tablist">
      <li><a href="annotated.php"><span>Class&#160;List</span></a></li>
      <li><a href="classes.php"><span>Class&#160;Index</span></a></li>
      <li><a href="hierarchy.php"><span>Class&#160;Hierarchy</span></a></li>
      <li><a href="functions.php"><span>Class&#160;Members</span></a></li>
    </ul>
  </div>
<div id="nav-path" class="navpath">
  <ul>
<li class="navelem"><b>sf</b></li><li class="navelem"><a class="el" href="classsf_1_1Image.php">Image</a></li>  </ul>
</div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">sf::Image Member List</div>  </div>
</div><!--header-->
<div class="contents">

<p>This is the complete list of members for <a class="el" href="classsf_1_1Image.php">sf::Image</a>, including all inherited members.</p>
<table class="directory">
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a74bda6dc927849ff25f8fce5143918e7">Bind</a>() const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a408c40c8675363adfa96a8b9a9576bc2">Copy</a>(const Image &amp;Source, unsigned int DestX, unsigned int DestY, const IntRect &amp;SourceRect=IntRect(0, 0, 0, 0), bool ApplyAlpha=false)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a96597746f70ce1925ec82d2df8ae6974">CopyScreen</a>(RenderWindow &amp;Window, const IntRect &amp;SourceRect=IntRect(0, 0, 0, 0))</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a4e2ce8821e8de36462604bbf99f39cde">Create</a>(unsigned int Width, unsigned int Height, Color Col=Color(0, 0, 0, 255))</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#ae9a15fe9a4750295845b5ae081c2ec50">CreateMaskFromColor</a>(Color ColorKey, Uint8 Alpha=0)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#af2131512b6290fd96fd10c539723fe89">GetHeight</a>() const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a531abcad64f50158ebe66975066ef5bd">GetPixel</a>(unsigned int X, unsigned int Y) const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#ad1594ab4251d6fc833a48dd242918631">GetPixelsPtr</a>() const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a066704507bcaabe27db17170bf02bd56">GetTexCoords</a>(const IntRect &amp;Rect) const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a1d7f3465e212f9fe2527bd4c8fc43fc4">GetValidTextureSize</a>(unsigned int Size)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"><span class="mlabel">static</span></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a896f09a4eb769b5b866b6dde9c1a25e7">GetWidth</a>() const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#abb4caf3cb167b613345ebe36fc883f12">Image</a>()</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#aa38cae7c1c704aa0175b9e73645cb210">Image</a>(const Image &amp;Copy)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a2a4c0ec448863784f83e9931d25dada2">Image</a>(unsigned int Width, unsigned int Height, const Color &amp;Col=Color(0, 0, 0, 255))</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a7092ba80cc19c053bf356e98a4743acb">Image</a>(unsigned int Width, unsigned int Height, const Uint8 *Data)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#ad175b4c9110549c5df324ba61c580ce3">IsSmooth</a>() const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a7cf6316aa5d022e0bdd95f1e79c9f50b">LoadFromFile</a>(const std::string &amp;Filename)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a72565ffabe12dfb2602e209c2e6f0486">LoadFromMemory</a>(const char *Data, std::size_t SizeInBytes)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a67d65c552c9bcba989a061e9c5b5d10c">LoadFromPixels</a>(unsigned int Width, unsigned int Height, const Uint8 *Data)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a0b9380f1babc21df2787f543e1ae1ab6">operator=</a>(const Image &amp;Other)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Resource.php#a772badbe4813a5b459f588698ac7ad60">Resource&lt; Image &gt;::operator=</a>(const Resource&lt; Image &gt; &amp;Other)</td><td class="entry"><a class="el" href="classsf_1_1Resource.php">sf::Resource&lt; Image &gt;</a></td><td class="entry"><span class="mlabel">protected</span></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Resource.php#aa044d32edfcd9b6aebd50d03658e8130">Resource</a>()</td><td class="entry"><a class="el" href="classsf_1_1Resource.php">sf::Resource&lt; Image &gt;</a></td><td class="entry"><span class="mlabel">protected</span></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Resource.php#a59a0a5ddb77f7fe059bd32dee5f792d0">Resource</a>(const Resource&lt; Image &gt; &amp;Copy)</td><td class="entry"><a class="el" href="classsf_1_1Resource.php">sf::Resource&lt; Image &gt;</a></td><td class="entry"><span class="mlabel">protected</span></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#a50eed54ef8e9f3aeef5bb7f19144aa08">SaveToFile</a>(const std::string &amp;Filename) const </td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a623f2379b30307b4ee4eb08d517d9584">SetPixel</a>(unsigned int X, unsigned int Y, const Color &amp;Col)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Image.php#ad167422fd331cd069674391fb16e8452">SetSmooth</a>(bool Smooth)</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr class="even"><td class="entry"><a class="el" href="classsf_1_1Image.php#a0ba22a38e6c96e3b37dd88198046de83">~Image</a>()</td><td class="entry"><a class="el" href="classsf_1_1Image.php">sf::Image</a></td><td class="entry"></td></tr>
  <tr><td class="entry"><a class="el" href="classsf_1_1Resource.php#a0e83e83339851d7b3246939bde3fc1ac">~Resource</a>()</td><td class="entry"><a class="el" href="classsf_1_1Resource.php">sf::Resource&lt; Image &gt;</a></td><td class="entry"><span class="mlabel">protected</span></td></tr>
</table></div><!-- contents -->
<?php
    require("../footer-fr.php");
?>
