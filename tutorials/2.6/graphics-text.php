<?php

    $title = "Text and fonts";
    $page = "graphics-text.php";

    require("header.php");

?>

<h1>Text and fonts</h1>

<?php h2('Loading a font') ?>
<p>
    Before drawing any text, you need to have an available font, just like any other program that prints text. Fonts are encapsulated in the <?php class_link('Font') ?>
    class, which provides three main features: loading a font, getting glyphs (i.e. visual characters) from it, and reading its attributes. In a typical
    program, you'll only have to make use of the first feature, loading the font, so let's focus on that first.
</p>
<p>
    The most common way of loading a font is from a file on disk, which is done with the <code>loadFromFile</code> function.
</p>
<pre><code class="cpp">sf::Font font;
if (!font.loadFromFile("arial.ttf"))
{
    // error...
}
</code></pre>
<p>
    Note that SFML won't load your system fonts automatically, i.e. <code>font.loadFromFile("Courier New")</code> won't work. Firstly, because SFML requires
    <em>file names</em>, not font names, and secondly because SFML doesn't have magical access to your system's font folder. If you want to load a
    font, you will need to include the font file with your application, just like every other resource (images, sounds, ...).
</p>
<p class="important">
    The <code>loadFromFile</code> function can sometimes fail with no obvious reason. First, check the error message that SFML prints to the standard
    output (check the console). If the message is <q>unable to open file</q>, make sure that the <em>working directory</em> (which is the directory
    that any file path will be interpreted relative to) is what you think it is:
    When you run the application from your desktop environment, the working directory is the executable folder. However, when you launch your program from your IDE
    (Visual Studio, Code::Blocks, ...) the working directory might sometimes be set to the <em>project</em> directory instead. This can usually be changed
    quite easily in the project settings.
</p>
<p>
    You can also load a font file from memory (<code>loadFromMemory</code>), or from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supports most common font formats. The full list is available in the API documentation.
</p>
<p>
    That's all you need to do. Once your font is loaded, you can start drawing text.
</p>
<?php h2('Drawing text') ?>
<p>
    To draw text, you will be using the <?php class_link('Text') ?> class. It's very simple to use:
</p>
<pre><code class="cpp">sf::Text text;

// select the font
text.setFont(font); // font is a sf::Font

// set the string to display
text.setString("Hello world");

// set the character size
text.setCharacterSize(24); // in pixels, not points!

// set the color
text.setFillColor(sf::Color::Red);

// set the text style
text.setStyle(sf::Text::Bold | sf::Text::Underlined);

...

// inside the main loop, between window.clear() and window.display()
window.draw(text);
</code></pre>
<img class="screenshot" src="./images/graphics-text-draw.png" title="Drawing text" />
<p>
    Text can also be transformed: They have a position, an orientation and a scale. The functions involved are the same as for the
    <?php class_link('Sprite') ?> class and other SFML entities. They are explained in the
    <a href="./graphics-transform.php" title="'Transforming entities' tutorial">Transforming entities</a> tutorial.
</p>

<?php h2('How to avoid problems with non-ASCII characters?') ?>
<p>
    Handling non-ASCII characters (such as accented European, Arabic, or Chinese characters) correctly can be tricky. It requires a good understanding
    of the various encodings involved in the process of interpreting and drawing your text. To avoid having to bother with these encodings, there's
    a simple solution: Use <em>wide literal strings</em>.
</p>
<pre><code class="cpp">text.setString(L"יטאח");
</code></pre>
<p>
    It is this simple "L" prefix in front of the string that makes it work by telling the compiler to produce a wide string. Wide strings are a strange beast
    in C++: the standard doesn't say anything about their size (16-bit? 32-bit?), nor about the encoding that they use (UTF-16? UTF-32?). However
    we know that on most platforms, if not all, they'll produce Unicode strings, and SFML knows how to handle them correctly.
</p>
<p>
    Note that the C++11 standard supports new character types and prefixes to build UTF-8, UTF-16 and UTF-32 string literals, but SFML doesn't support
    them yet.
</p>
<p>
    It may seem obvious, but you also have to make sure that the font that you use contains the characters that you want to draw. Indeed, fonts
    don't contain glyphs for all possible characters (there are more than 100000 in the Unicode standard!), and an Arabic font won't be able to display Japanese
    text, for example.
</p>

<?php h2('Making your own text class') ?>
<p>
    If <?php class_link('Text') ?> is too limited, or if you want to do something else with pre-rendered glyphs, <?php class_link('Font') ?> provides
    everything that you need.
</p>
<p>
    You can retrieve the texture which contains all the pre-rendered glyphs of a certain size:
</p>
<pre><code class="cpp">const sf::Texture&amp; texture = font.getTexture(characterSize);
</code></pre>
<p>
    It is important to note that glyphs are added to the texture when they are requested. There are so many characters (remember, more than 100000) that they can't all
    be generated when you load the font. Instead, they are rendered on the fly when you call the <code>getGlyph</code> function (see below).
</p>
<p>
    To do something meaningful with the font texture, you must get the texture coordinates of glyphs that are contained in it:
</p>
<pre><code class="cpp">sf::Glyph glyph = font.getGlyph(character, characterSize, bold);
</code></pre>
<p>
    <code>character</code> is the UTF-32 code of the character whose glyph that you want to get. You must also specify the character size, and whether you want the bold
    or the regular version of the glyph.
</p>
<p>
    The <?php class_link('Glyph') ?> structure contains three members:
</p>
<ul>
    <li><code>textureRect</code> contains the texture coordinates of the glyph within the texture</li>
    <li><code>bounds</code> contains the bounding rectangle of the glyph, which helps position it relative to the baseline of the text</li>
    <li><code>advance</code> is the horizontal offset to apply to get the starting position of the next glyph in the text</li>
</ul>
<p>
    You can also get some of the font's other metrics, such as the kerning between two characters or the line spacing (always for a certain character size):
</p>
<pre><code class="cpp">int lineSpacing = font.getLineSpacing(characterSize);

int kerning = font.getKerning(character1, character2, characterSize);
</code></pre>

<?php

    require("footer.php");

?>
