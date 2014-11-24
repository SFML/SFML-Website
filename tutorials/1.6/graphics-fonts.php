<?php

    $title = "Displaying text";
    $page = "graphics-fonts.php";

    require("header.php");
?>

<h1>Displaying text</h1>

<?php h2('Introduction') ?>
<p>
    In this tutorial, we will cover text rendering with the <?php class_link("Font")?> and <?php class_link("String")?>
    classes.
</p>

<?php h2('Loading a font') ?>
<p>
    Before rendering text, you need a character font to write it. A font in SFML is defined by the
    <?php class_link("Font")?>
    class. As there's usually not much to do with fonts except loading and using them, this class actually
    only defines two important functions, <code>LoadFromFile</code> and <code>LoadFromMemory</code>.
</p>
<pre><code class="cpp">sf::Font MyFont;

// Load from a font file on disk
if (!MyFont.LoadFromFile("arial.ttf"))
{
    // Error...
}

// Load from a font file in memory
if (!MyFont.LoadFromMemory(PointerToFileData, SizeOfFileData))
{
    // Error...
}
</code></pre>
<p>
    As you can see, both of them will return <code>true</code> on successfull loading, and <code>false</code> if any
    error occured.
</p>
<p>
    You can also pass two additionnal parameters to these functions : the character size, and the charset to generate.
    Higher character size means a better quality, but be careful as it will also increase the video memory usage. The
    default size is 30.
</p>
<p>
    Passing your own character set may be needed if you want to use non-ASCII characters; in this case, just pass
    the complete list of characters that you're going to use. You can pass any type / encoding of string, including
    Unicode strings, which means you can as well use european accentuated characters, chinese or arabic characters.<br/>
    The default character set is defined as the printable ISO-8859-1 range of characters. ISO-8859-1 contains
    the ASCII range, plus most of the european accentuated characters; and it actually defines the first 256 characters
    of the Unicode standard. This default character set should be enough for a regular usage (english or french, for example).
</p>
<p>
    Here is an example usage of font loading, with the character size and character set explicitely given :
</p>
<pre><code class="cpp">sf::Font   MyFont;
sf::Uint32 MyCharset[] = {0x4E16, 0x754C, 0x60A8, 0x597D, 0x0}; // a set of unicode chinese characters
if (!MyFont.LoadFromFile("arial.ttf", 50, MyCharset))
{
    // Error...
}
</code></pre>
<p>
    <?php class_link("Font")?>
    can load several types of font files, from standard TTF to X11 PCF. You can refer to the
    <a class="external" href="http://www.freetype.org/freetype2/index.html#features" title="FreeType's features page">FreeType projects's features</a>
    to get the complete list (it's the library used internally by SFML).
</p>
<p>
    <?php class_link("Font")?> also gives access to the rendered glyphs (a glyph is a visual character), but you won't need
    to use these functions unless you're doing very specific stuff.
</p>

<?php h2('Creating a string') ?>
<p>
    To create a string that you can draw on screen, you basically need to create an instance of <?php class_link("String")?>.
    Such an instance has three parameters : the text to display, the font used, and the character size.<br/>
    Please note that <?php class_link("String")?> is
    not a string class in the sense of <code>std::string</code>, <em>ie</em> it doesn't provide any function related
    to string manipulation, like <em>find</em>, <em>append</em>, <em>substring</em>, etc. It focuses only on the graphics
    part, and leave the string manipulation to <code>std::string</code> (or whatever class you prefer).
</p>
<p>
    So, here is how you would define a string containing the text "Hello", using the font "arial.ttf", and with
    a characters size of 50 :
</p>
<pre><code class="cpp">// Load the font from a file
sf::Font MyFont;
if (!MyFont.LoadFromFile("arial.ttf", 50))
{
    // Error...
}

sf::String Text("Hello", MyFont, 50);

// Or, if you want to do it after the construction :

sf::String Text;
Text.SetText("Hello");
Text.SetFont(MyFont);
Text.SetSize(50);
</code></pre>
<p>
    You can also use wide characters strings, if you want to put a unicode text :
</p>
<pre><code class="cpp">Text.SetText(L"Voilà");
</code></pre>
<p>
    Any other SFML string type is automatically accepted as well.
</p>
<p>
    Here is a hint : if you want the best visual quality, try to load your font with a character size at least as high as
    the size of your text. If not, the characters will be stretched and be slightly blured. Same goes for very small texts :
    use a font with small characters size, otherwise the characters will be scaled down too much and
    may degrade the visual quality.
</p>
<p>
    Note that you can actually use a string without loading any font : SFML provides a default built-in one, which is
    Arial with a character size of 30.
</p>
<pre><code class="cpp">Text.SetFont(sf::Font::GetDefaultFont());
</code></pre>
<p>
    Strings can also use different styles : regular (the default), or any combination of bold, italic and underlined.
</p>
<pre><code class="cpp">sf::String Text = "I like donuts";
Text.SetStyle(sf::String::Bold | sf::String::Italic | sf::String::Underlined);
Text.SetStyle(sf::String::Regular);
</code></pre>

<?php h2('Displaying a string') ?>
<p>
    <?php class_link("String")?> is a standard drawable class, meaning that it inherits from <?php class_link("Drawable")?> and gets
    all its attributes and functions, just like <?php class_link("Sprite")?>.<br/>
    So you can change the string's position, scale, orientation, color, etc. :
</p>
<pre><code class="cpp">Text.SetColor(sf::Color(128, 128, 0));
Text.SetRotation(90.f);
Text.SetScale(2.f, 2.f);
Text.Move(100.f, 200.f);
</code></pre>
<p>
    Then, to display it on a given window, you just use the <code>Draw</code> function :
</p>
<pre><code class="cpp">sf::RenderWindow Window;
...
Window.Draw(Text);
</code></pre>

<?php h2('What about single character\'s positions?') ?>
<p>
    In case you need to deal with a string's characters individually, like for displaying a cursor after the n-th character
    of whatever, <?php class_link("String")?> provides a utility function to get the position of any character in the string.
</p>
<pre><code class="cpp">sf::Vector2f Position = Text.GetCharacterPos(4);
</code></pre>
<p>
    The returned position is defined in local coordinates, so you'll need to call <code>TransformToGlobal</code> to
    get the actual global position.
</p>

<?php h2('Fonts and strings management') ?>
<p>
    You have to be particularly careful when manipulating fonts. A <?php class_link("Font")?>
    instance is a resource which is slow to load, heavy to copy and uses a lot of memory.
</p>
<p>
    For a good discussion about resource management, I suggest you read the <strong>"Images and sprites management"</strong>
    part of the <a class="internal" href="./graphics-sprite.php" title="Sprites tutorial">sprites tutorial</a>, just
    replacing the word "Image" with "Font" and "Sprite" with "String".
</p>

<?php h2('Conclusion') ?>
<p>
    That's about SFML strings. You can now display text with various fonts, styles and sizes, plus all the graphical features of the SFML
    drawable objects.<br/>
    You can now go to the next tutorial, which will show you how to add real-time
    <a class="internal" href="./graphics-postfx.php" title="Go to the next tutorial">post-effects</a> to your graphics.
</p>

<?php

    require("footer.php");

?>
