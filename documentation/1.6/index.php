<?php
    $version = '1.6'; // the $ projectnumber variable is automatically replaced by doxygen with the version number
    $pagetitle = 'Main Page'; // the $ title variable is automatically replaced by doxygen with the page title
    include('../header.php');
?>
<!-- Generated by Doxygen 1.8.2 -->
  <div id="navrow1" class="tabs">
    <ul class="tablist">
      <li class="current"><a href="index.php"><span>Main&#160;Page</span></a></li>
      <li><a href="namespaces.php"><span>Namespaces</span></a></li>
      <li><a href="annotated.php"><span>Classes</span></a></li>
      <li><a href="files.php"><span>Files</span></a></li>
    </ul>
  </div>
</div><!-- top -->
<div class="header">
  <div class="headertitle">
<div class="title">SFML Documentation</div>  </div>
</div><!--header-->
<div class="contents">
<div class="textblock"><h1><a class="anchor" id="welcome"></a>
Welcome</h1>
<p>Welcome to the official SFML documentation. Here you will find a detailed view of all the SFML <a href="./annotated.htm">classes</a>, as well as source <a href="./files.htm">files</a>. <br/>
 If you are looking for tutorials, you can visit the official website at <a href="http://www.sfml-dev.org/tutorials/">www.sfml-dev.org</a>.</p>
<h1><a class="anchor" id="example"></a>
Short example</h1>
<p>Here is a short example, to show you how simple it is to use SFML :</p>
<div class="fragment"><div class="line"><span class="preprocessor">#include &lt;SFML/Audio.hpp&gt;</span></div>
<div class="line"><span class="preprocessor">#include &lt;SFML/Graphics.hpp&gt;</span></div>
<div class="line"></div>
<div class="line"><span class="keywordtype">int</span> main()</div>
<div class="line">{</div>
<div class="line">    <span class="comment">// Create the main window</span></div>
<div class="line">    <a class="code" href="classsf_1_1RenderWindow.php" title="Simple wrapper for sf::Window that allows easy 2D rendering.">sf::RenderWindow</a> App(<a class="code" href="classsf_1_1VideoMode.php" title="VideoMode defines a video mode (width, height, bpp, frequency) and provides static functions for gett...">sf::VideoMode</a>(800, 600), <span class="stringliteral">&quot;SFML window&quot;</span>);</div>
<div class="line"></div>
<div class="line">    <span class="comment">// Load a sprite to display</span></div>
<div class="line">    <a class="code" href="classsf_1_1Image.php" title="Image is the low-level class for loading and manipulating images.">sf::Image</a> Image;</div>
<div class="line">    <span class="keywordflow">if</span> (!Image.<a class="code" href="classsf_1_1Image.php#a7cf6316aa5d022e0bdd95f1e79c9f50b" title="Load the image from a file.">LoadFromFile</a>(<span class="stringliteral">&quot;cute_image.jpg&quot;</span>))</div>
<div class="line">        <span class="keywordflow">return</span> EXIT_FAILURE;</div>
<div class="line">    <a class="code" href="classsf_1_1Sprite.php" title="Sprite defines a sprite : texture, transformations, color, and draw on screen.">sf::Sprite</a> Sprite(Image);</div>
<div class="line"></div>
<div class="line">    <span class="comment">// Create a graphical string to display</span></div>
<div class="line">    <a class="code" href="classsf_1_1Font.php" title="Font is the low-level class for loading and manipulating character fonts.">sf::Font</a> Arial;</div>
<div class="line">    <span class="keywordflow">if</span> (!Arial.<a class="code" href="classsf_1_1Font.php#ac1f0de973bdb9485b5f0bf4aacb717e5" title="Load the font from a file.">LoadFromFile</a>(<span class="stringliteral">&quot;arial.ttf&quot;</span>))</div>
<div class="line">        <span class="keywordflow">return</span> EXIT_FAILURE;</div>
<div class="line">    <a class="code" href="classsf_1_1String.php" title="String defines a graphical 2D text, that can be drawn on screen.">sf::String</a> Text(<span class="stringliteral">&quot;Hello SFML&quot;</span>, Arial, 50);</div>
<div class="line"></div>
<div class="line">    <span class="comment">// Load a music to play</span></div>
<div class="line">    <a class="code" href="classsf_1_1Music.php" title="Music defines a big sound played using streaming, so usually what we call a music :)...">sf::Music</a> Music;</div>
<div class="line">    <span class="keywordflow">if</span> (!Music.<a class="code" href="classsf_1_1Music.php#a26986766bc5674a87da1bcb10bef59db" title="Open a music file (doesn&#39;t play it – call Play() for that)">OpenFromFile</a>(<span class="stringliteral">&quot;nice_music.ogg&quot;</span>))</div>
<div class="line">        <span class="keywordflow">return</span> EXIT_FAILURE;</div>
<div class="line"></div>
<div class="line">    <span class="comment">// Play the music</span></div>
<div class="line">    Music.<a class="code" href="classsf_1_1SoundStream.php#a4d8437ef9a952fe3798bd239ff20d9bf" title="Start playing the audio stream.">Play</a>();</div>
<div class="line"></div>
<div class="line">    <span class="comment">// Start the game loop</span></div>
<div class="line">    <span class="keywordflow">while</span> (App.IsOpened())</div>
<div class="line">    {</div>
<div class="line">        <span class="comment">// Process events</span></div>
<div class="line">        <a class="code" href="classsf_1_1Event.php" title="Event defines a system event and its parameters.">sf::Event</a> Event;</div>
<div class="line">        <span class="keywordflow">while</span> (App.GetEvent(Event))</div>
<div class="line">        {</div>
<div class="line">            <span class="comment">// Close window : exit</span></div>
<div class="line">            <span class="keywordflow">if</span> (Event.<a class="code" href="classsf_1_1Event.php#a90d5da29dd2f49d13dc10e7a402c0b65" title="Type of the event.">Type</a> == sf::Event::Closed)</div>
<div class="line">                App.Close();</div>
<div class="line">        }</div>
<div class="line"></div>
<div class="line">        <span class="comment">// Clear screen</span></div>
<div class="line">        App.Clear();</div>
<div class="line"></div>
<div class="line">        <span class="comment">// Draw the sprite</span></div>
<div class="line">        App.Draw(Sprite);</div>
<div class="line"></div>
<div class="line">        <span class="comment">// Draw the string</span></div>
<div class="line">        App.Draw(Text);</div>
<div class="line"></div>
<div class="line">        <span class="comment">// Update the window</span></div>
<div class="line">        App.Display();</div>
<div class="line">    }</div>
<div class="line"></div>
<div class="line">    <span class="keywordflow">return</span> EXIT_SUCCESS;</div>
<div class="line">}</div>
</div><!-- fragment --> </div></div><!-- contents -->
<?php
    require("../footer.php");
?>
