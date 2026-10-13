# Displaying text

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/graphics/text/).

## Introduction

In this tutorial, we will cover text rendering with the [`sf::Font`](../../../documentation/1.6/classsf_1_1Font.html "sf::Font documentation") and [`sf::String`](../../../documentation/1.6/classsf_1_1String.html "sf::String documentation") classes.

## Loading a font

Before rendering text, you need a character font to write it. A font in SFML is defined by the [`sf::Font`](../../../documentation/1.6/classsf_1_1Font.html "sf::Font documentation") class. As there's usually not much to do with fonts except loading and using them, this class actually only defines two important functions, `LoadFromFile` and `LoadFromMemory`.

```cpp
sf::Font MyFont;

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
```

As you can see, both of them will return `true` on successfull loading, and `false` if any error occured.

You can also pass two additionnal parameters to these functions : the character size, and the charset to generate. Higher character size means a better quality, but be careful as it will also increase the video memory usage. The default size is 30.

Passing your own character set may be needed if you want to use non-ASCII characters; in this case, just pass the complete list of characters that you're going to use. You can pass any type / encoding of string, including Unicode strings, which means you can as well use european accentuated characters, chinese or arabic characters.  
The default character set is defined as the printable ISO-8859-1 range of characters. ISO-8859-1 contains the ASCII range, plus most of the european accentuated characters; and it actually defines the first 256 characters of the Unicode standard. This default character set should be enough for a regular usage (english or french, for example).

Here is an example usage of font loading, with the character size and character set explicitely given :

```cpp
sf::Font   MyFont;
sf::Uint32 MyCharset[] = {0x4E16, 0x754C, 0x60A8, 0x597D, 0x0}; // a set of unicode chinese characters
if (!MyFont.LoadFromFile("arial.ttf", 50, MyCharset))
{
    // Error...
}
```

[`sf::Font`](../../../documentation/1.6/classsf_1_1Font.html "sf::Font documentation") can load several types of font files, from standard TTF to X11 PCF. You can refer to the [FreeType projects's features](http://www.freetype.org/freetype2/index.html#features "FreeType's features page") to get the complete list (it's the library used internally by SFML).

[`sf::Font`](../../../documentation/1.6/classsf_1_1Font.html "sf::Font documentation") also gives access to the rendered glyphs (a glyph is a visual character), but you won't need to use these functions unless you're doing very specific stuff.

## Creating a string

To create a string that you can draw on screen, you basically need to create an instance of [`sf::String`](../../../documentation/1.6/classsf_1_1String.html "sf::String documentation"). Such an instance has three parameters : the text to display, the font used, and the character size.  
Please note that [`sf::String`](../../../documentation/1.6/classsf_1_1String.html "sf::String documentation") is not a string class in the sense of `std::string`, *ie* it doesn't provide any function related to string manipulation, like *find*, *append*, *substring*, etc. It focuses only on the graphics part, and leave the string manipulation to `std::string` (or whatever class you prefer).

So, here is how you would define a string containing the text "Hello", using the font "arial.ttf", and with a characters size of 50 :

```cpp
// Load the font from a file
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
```

You can also use wide characters strings, if you want to put a unicode text :

```cpp
Text.SetText(L"Voilà");
```

Any other SFML string type is automatically accepted as well.

Here is a hint : if you want the best visual quality, try to load your font with a character size at least as high as the size of your text. If not, the characters will be stretched and be slightly blured. Same goes for very small texts : use a font with small characters size, otherwise the characters will be scaled down too much and may degrade the visual quality.

Note that you can actually use a string without loading any font : SFML provides a default built-in one, which is Arial with a character size of 30.

```cpp
Text.SetFont(sf::Font::GetDefaultFont());
```

Strings can also use different styles : regular (the default), or any combination of bold, italic and underlined.

```cpp
sf::String Text = "I like donuts";
Text.SetStyle(sf::String::Bold | sf::String::Italic | sf::String::Underlined);
Text.SetStyle(sf::String::Regular);
```

## Displaying a string

[`sf::String`](../../../documentation/1.6/classsf_1_1String.html "sf::String documentation") is a standard drawable class, meaning that it inherits from [`sf::Drawable`](../../../documentation/1.6/classsf_1_1Drawable.html "sf::Drawable documentation") and gets all its attributes and functions, just like [`sf::Sprite`](../../../documentation/1.6/classsf_1_1Sprite.html "sf::Sprite documentation").  
So you can change the string's position, scale, orientation, color, etc. :

```cpp
Text.SetColor(sf::Color(128, 128, 0));
Text.SetRotation(90.f);
Text.SetScale(2.f, 2.f);
Text.Move(100.f, 200.f);
```

Then, to display it on a given window, you just use the `Draw` function :

```cpp
sf::RenderWindow Window;
...
Window.Draw(Text);
```

## What about single character's positions?

In case you need to deal with a string's characters individually, like for displaying a cursor after the n-th character of whatever, [`sf::String`](../../../documentation/1.6/classsf_1_1String.html "sf::String documentation") provides a utility function to get the position of any character in the string.

```cpp
sf::Vector2f Position = Text.GetCharacterPos(4);
```

The returned position is defined in local coordinates, so you'll need to call `TransformToGlobal` to get the actual global position.

## Fonts and strings management

You have to be particularly careful when manipulating fonts. A [`sf::Font`](../../../documentation/1.6/classsf_1_1Font.html "sf::Font documentation") instance is a resource which is slow to load, heavy to copy and uses a lot of memory.

For a good discussion about resource management, I suggest you read the **"Images and sprites management"** part of the [sprites tutorial](sprite.md "Sprites tutorial"), just replacing the word "Image" with "Font" and "Sprite" with "String".

## Conclusion

That's about SFML strings. You can now display text with various fonts, styles and sizes, plus all the graphical features of the SFML drawable objects.  
You can now go to the next tutorial, which will show you how to add real-time [post-effects](postfx.md "Go to the next tutorial") to your graphics.
