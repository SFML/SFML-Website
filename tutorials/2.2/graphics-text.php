<?php

    $title = "Text and fonts";
    $page = "graphics-text.php";

    require("header.php");

?>

<h1>Text and fonts</h1>

<?php h2('Loading a font') ?>
<p>
    Before drawing text, you need a character font -- like in any other program that prints text. Fonts are encapsulated in the <?php class_link('Font') ?>
    class, which provides three main features: loading a font, getting glyphs (i.e. visual characters) from it, and reading its attributes. In a regular
    program, you'll only deal with the first feature, loading the font. So let's focus on this first.
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
    Note that SFML won't load your system fonts automatically, i.e. <code>font.loadFromFile("Courier New")</code> won't work. First because SFML requires
    <em>file names</em>, not font names, and secondly because SFML doesn't have a magic access to your system's font folder. So, if you want to load a
    font, you need to have the font file with your application, like other resources (images, sounds, ...).
</p>
<p class="important">
    The <code>loadFromFile</code> function sometimes fails with no obvious reason. First, check the error message printed by SFML in the standard
    output (check the console). If the message is <q>unable to open file</q>, make sure that the <em>working directory</em> (which is the directory
    any file path will be interpreted relatively to) is what you think it is:
    when you run the application from the explorer, the working directory is the executable folder, but when you launch your program from your IDE
    (Visual Studio, Code::Blocks, ...) the working directory is sometimes set to the <em>project</em> directory instead. This can generally be changed
    easily in the project settings.
</p>
<p>
    You can also load a font file from memory (<code>loadFromMemory</code>), or from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supports the most common font formats. The full list is available in the API documentation.
</p>
<p>
    That's all. Once your font is loaded, you can start drawing text.
</p>
<?php h2('Drawing text') ?>
<p>
    To draw text, you need to use the <?php class_link('Text') ?> class. It's very simple to use:
</p>
<pre><code class="cpp">sf::Text text;

// select the font
text.setFont(font); // font is a sf::Font

// set the string to display
text.setString("Hello world");

// set the character size
text.setCharacterSize(24); // in pixels, not points!

// set the color
text.setColor(sf::Color::Red);

// set the text style
text.setStyle(sf::Text::Bold | sf::Text::Underlined);

...

// inside the main loop, between window.clear() and window.display()
window.draw(text);
</code></pre>
<img class="screenshot" src="./images/graphics-text-draw.png" title="Drawing text" />
<p>
    Texts can also be transformed: they have a position, an orientation and a scale. The functions involved are the same as for the
    <?php class_link('Sprite') ?> class and other SFML entities, and are explained in the
    <a href="./graphics-transform.php" title="'Transforming entities' tutorial">Transforming entities</a> tutorial.
</p>

<?php h2('How to avoid problems with non-ASCII characters?') ?>
<p>
    Handling non-ASCII characters correctly (such as accented European, Arabic, or Chinese characters) can be tricky. It requires a good knowledge
    about the various encodings involved in the process of interpreting and drawing your text. To avoid bothering with these encodings, there's
    an easy solution: using <em>wide literal strings</em>.
</p>
<pre><code class="cpp">text.setString(L"יטאח");
</code></pre>
<p>
    Yep, this simple "L" prefix in front of the string makes it work, by telling the compiler to produce a wide string. Wide strings are a strange beast
    in C++: the standard doesn't say anything about their size (16 bits? 32 bits?), nor about the encoding that they use (UTF-16? UTF-32?). However
    we know that on most platforms, if not all, they'll produce Unicode strings, and SFML knows how to handle them correctly.
</p>
<p>
    Note that the C++11 standard supports new character types and prefixes to build UTF-8, UTF-16 and UTF-32 string literals, but SFML doesn't support
    them yet.
</p>
<p>
    It may seem obvious, but you also have to make sure that the font that you use contains the characters that you want to draw. Indeed, fonts
    don't define all the possible characters (there are more than 100000 in the Unicode standard!), and an Arabic font won't be able to display Japanese
    text, for example.
</p>

<?php h2('Making your own text class') ?>
<p>
    If <?php class_link('Text') ?> is too limited, or if you want to do something else with pre-rendered glyphs, <?php class_link('Font') ?> provides
    everything that you need.
</p>
<p>
    First, you can retrieve the texture which contains all the pre-rendered glyphs of a certain size:
</p>
<pre><code class="cpp">const sf::Texture&amp; texture = font.getTexture(characterSize);
</code></pre>
<p>
    Note that glyphs are added to the texture when they are requested. There are so many characters (remember, more than 100000) that they can't all
    be generated when you load the font. Instead, they are rendered on the fly when you call the <code>getGlyph</code> function (see below).
</p>
<p>
    To make something useful of the glyph texture, you must then get the texture coordinates of glyphs that are contained in it:
</p>
<pre><code class="cpp">sf::Glyph glyph = font.getGlyph(character, characterSize, bold);
</code></pre>
<p>
    <code>character</code> is the UTF-32 code of the glyph that you want to get. You must also specify the character size, and whether you want the bold
    or the regular version of the glyph.
</p>
<p>
    The <?php class_link('Glyph') ?> structure contains three members:
</p>
<ul>
    <li><code>textureRect</code> is the texture coordinates of the glyph within the texture</li>
    <li><code>bounds</code> is the bounding rectangle of the glyph, which helps to position it relatively to the base line of the text</li>
    <li><code>advance</code> is the horizontal offset to apply to get the start position of the next glyph in the text</li>
</ul>
<p>
    Finally, you can get some other metrics of the font, such as the line spacing or the kerning (always for a certain character size):
</p>
<pre><code class="cpp">int lineSpacing = font.getLineSpacing(characterSize);

int kerning = font.getKerning(character1, character2, characterSize);
</code></pre>

<?php

    require("footer.php");

?>
