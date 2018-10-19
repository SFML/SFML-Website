<?php

    $title = "Sprites and textures";
    $page = "graphics-sprite.php";

    require("header.php");

?>

<h1>Sprites and textures</h1>

<?php h2('Vocabulary') ?>
<p>
    Most (if not all) of you are already familiar with these two very common objects, so let's define them very briefly.
</p>
<p>
    A texture is an image. But we call it "texture" because it has a very specific role: being mapped to a 2D entity.
</p>
<p>
    A sprite is nothing more than a textured rectangle.
</p>
<img src="./images/graphics-sprites-definition.png" title="Rectangular entity + texture = sprite!" />
<p>
    Ok, that was short but if you really don't understand what sprites and textures are, then you'll find a much better description on Wikipedia.
</p>

<?php h2('Loading a texture') ?>
<p>
    Before creating any sprite, we need a valid texture. The class that encapsulates textures in SFML is, surprisingly, <?php class_link("Texture") ?>.
    Since the only role of a texture is to be loaded and mapped to graphical entities, almost all its functions are about loading and updating it.
</p>
<p>
    The most common way of loading a texture is from an image file on disk, which is done with the <code>loadFromFile</code> function.
</p>
<pre><code class="cpp">sf::Texture texture;
if (!texture.loadFromFile("image.png"))
{
    // error...
}
</code></pre>
<p class="important">
    The <code>loadFromFile</code> function can sometimes fail with no obvious reason. First, check the error message that SFML prints to the standard
    output (check the console). If the message is <q>unable to open file</q>, make sure that the <em>working directory</em> (which is the directory
    that any file path will be interpreted relative to) is what you think it is:
    When you run the application from your desktop environment, the working directory is the executable folder. However, when you launch your program from your IDE
    (Visual Studio, Code::Blocks, ...) the working directory might sometimes be set to the <em>project</em> directory instead. This can usually be changed
    quite easily in the project settings.
</p>
<p>
    You can also load an image file from memory (<code>loadFromMemory</code>), from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> (<code>loadFromStream</code>), or from an
    image that has already been loaded (<code>loadFromImage</code>). The latter loads the texture from an <?php class_link("Image") ?>, which is a utility class that
    helps store and manipulate image data (modify pixels, create transparency channel, etc.). The pixels of an <?php class_link("Image") ?> stay in system memory,
    which ensures that operations on them will be as fast as possible, in contrast to the pixels of a texture which reside in video memory and are
    therefore slow to retrieve or update but very fast to draw.
</p>
<p>
    SFML supports most common image file formats. The full list is available in the API documentation.
</p>
<p>
    All these loading functions have an optional argument, which can be used if you want to load a smaller part of the image.
</p>
<pre><code class="cpp">// load a 32x32 rectangle that starts at (10, 10)
if (!texture.loadFromFile("image.png", sf::IntRect(10, 10, 32, 32)))
{
    // error...
}
</code></pre>
<p>
    The <?php class_link("IntRect", "Rect") ?> class is a simple utility type that represents a rectangle. Its constructor takes the coordinates of the
    top-left corner, and the size of the rectangle.
</p>
<p>
    If you don't want to load a texture from an image, but instead want to update it directly from an array of pixels, you can create it empty and
    update it later:
</p>
<pre><code class="cpp">// create an empty 200x200 texture
if (!texture.create(200, 200))
{
    // error...
}
</code></pre>
<p>
    Note that the contents of the texture are undefined at this point.
</p>
<p>
    To update the pixels of an existing texture, you have to use the <code>update</code> function. It has overloads for many kinds of data sources:
</p>
<pre><code class="cpp">// update a texture from an array of pixels
sf::Uint8* pixels = new sf::Uint8[width * height * 4]; // * 4 because pixels have 4 components (RGBA)
...
texture.update(pixels);

// update a texture from a sf::Image
sf::Image image;
...
texture.update(image);

// update the texture from the current contents of the window
sf::RenderWindow window;
...
texture.update(window);
</code></pre>
<p>
    These examples all assume that the source is of the same size as the texture. If this is not the case, i.e. if you want to update only a part of the
    texture, you can specify the coordinates of the sub-rectangle that you want to update. You can refer to the documentation for further details.
</p>
<p>
    Additionally, a texture has two properties that change how it is rendered.
</p>
<p>
    The first property allows one to smooth the texture. Smoothing a texture makes pixel boundaries less visible (but the image a little more blurry), which can be
    desirable if it is up-scaled.
</p>
<pre><code class="cpp">texture.setSmooth(true);
</code></pre>
<img src="./images/graphics-sprites-smooth.png" title="Smooth vs not smooth" />
<p class="important">
    Since smoothing samples from adjacent pixels in the texture as well, it can lead to the unwanted side effect of factoring in pixels outside the selected texture area.
    This can happen when your sprite is located at non-integer coordinates.
</p>
<p>
    The second property allows a texture to be repeatedly tiled within a single sprite.
</p>
<pre><code class="cpp">texture.setRepeated(true);
</code></pre>
<img src="./images/graphics-sprites-repeated.png" title="Repeated vs not repeated" />
<p>
    This only works if your sprite is configured to show a rectangle which is larger than the texture, otherwise this property has no effect.
</p>

<?php h2('Ok, can I have my sprite now?') ?>
<p>
    Yes, you can now create your sprite.
</p>
<pre><code class="cpp">sf::Sprite sprite;
sprite.setTexture(texture);
</code></pre>
<p>
    ... and finally draw it.
</p>
<pre><code class="cpp">// inside the main loop, between window.clear() and window.display()
window.draw(sprite);
</code></pre>
<p>
    If you don't want your sprite to use the entire texture, you can set its texture rectangle.
</p>
<pre><code class="cpp">sprite.setTextureRect(sf::IntRect(10, 10, 32, 32));
</code></pre>
<p>
    You can also change the color of a sprite. The color that you set is modulated (multiplied) with the texture of the sprite. This can also
    be used to change the global transparency (alpha) of the sprite.
</p>
<pre><code class="cpp">sprite.setColor(sf::Color(0, 255, 0)); // green
sprite.setColor(sf::Color(255, 255, 255, 128)); // half transparent
</code></pre>
<p>
    These sprites all use the same texture, but have a different color:
</p>
<img src="./images/graphics-sprites-color.png" title="Coloring sprites" />
<p>
    Sprites can also be transformed: They have a position, an orientation and a scale.
</p>
<pre><code class="cpp">// position
sprite.setPosition(sf::Vector2f(10.f, 50.f)); // absolute position
sprite.move(sf::Vector2f(5.f, 10.f)); // offset relative to the current position

// rotation
sprite.setRotation(90.f); // absolute angle
sprite.rotate(15.f); // offset relative to the current angle

// scale
sprite.setScale(sf::Vector2f(0.5f, 2.f)); // absolute scale factor
sprite.scale(sf::Vector2f(1.5f, 3.f)); // factor relative to the current scale
</code></pre>
<p>
    By default, the origin for these three transformations is the top-left corner of the sprite. If you want to set the origin to a different point
    (for example the center of the sprite, or another corner), you can use the <code>setOrigin</code> function.
</p>
<pre><code class="cpp">sprite.setOrigin(sf::Vector2f(25.f, 25.f));
</code></pre>
<p>
    Since transformation functions are common to all SFML entities, they are explained in a separate tutorial: 
    <a href="./graphics-transform.php" title="'Transforming entities' tutorial">Transforming entities</a>.
</p>

<?php h2('The white square problem') ?>
<p>
    You successfully loaded a texture, constructed a sprite correctly, and... all you see on your screen now is a white square. What happened?
</p>
<p>
    This is a common mistake. When you set the texture of a sprite, all it does internally is store a <em>pointer</em> to the texture instance.
    Therefore, if the texture is destroyed or moves elsewhere in memory, the sprite ends up with an invalid texture pointer.
</p>
<p>
    This problem occurs when you write this kind of function:
</p>
<pre><code class="cpp">sf::Sprite loadSprite(std::string filename)
{
    sf::Texture texture;
    texture.loadFromFile(filename);

    return sf::Sprite(texture);
} // error: the texture is destroyed here
</code></pre>
<p>
    You must correctly manage the lifetime of your textures and make sure that they live as long as they are used by any sprite.
</p>

<?php h2('The importance of using as few textures as possible') ?>
<p>
    Using as few textures as possible is a good strategy, and the reason is simple: Changing the current texture is an expensive operation for the
    graphics card. Drawing many sprites that use the same texture will yield the best performance.
</p>
<p>
    Additionally, using a single texture allows you to group static geometry into a single entity (you can only use one texture per <code>draw</code> call), which will
    be much faster to draw than a set of many entities. Batching static geometry involves other classes and is therefore beyond the scope of this tutorial, for further details
    see the <a href="./graphics-vertex-array.php" title="Vertex array tutorial">vertex array</a> tutorial.
</p>
<p>
    Try to keep this in mind when you create your animation sheets or your tilesets: Use as little textures as possible.
</p>

<?php h2('Using sf::Texture with OpenGL code') ?>
<p>
    If you're using OpenGL rather than the graphics entities of SFML, you can still use <?php class_link("Texture") ?> as a wrapper around an OpenGL texture object and use it
    along with the rest of your OpenGL code.
</p>
<p>
    To bind a <?php class_link("Texture") ?> for drawing (basically <code>glBindTexture</code>), you call the <code>bind</code> static function:
</p>
<pre><code class="cpp">sf::Texture texture;
...

// bind the texture
sf::Texture::bind(&amp;texture);

// draw your textured OpenGL entity here...

// bind no texture
sf::Texture::bind(NULL);
</code></pre>

<?php

    require("footer.php");

?>
