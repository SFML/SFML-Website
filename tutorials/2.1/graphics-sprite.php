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
    Ok, that was short but if you really don't understand what sprites and textures are, then you'll find a much better description on wikipedia.
</p>

<?php h2('Loading a texture') ?>
<p>
    So, before creating any sprite, we need a valid texture. The class that encapsulates textures in SFML is, surprisingly, <?php class_link("Texture") ?>.
    Since the (only) role of a texture is to be loaded and mapped to graphical entities, almost all its functions are about loading and updating it.
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
    The <code>loadFromFile</code> function sometimes fails with no obvious reason. First, check the error message printed by SFML in the standard
    output (check the console). If the message is <q>unable to open file</q>, make sure that the <em>working directory</em> (which is the directory
    any file path will be interpreted relatively to) is what you think it is:
    when you run the application from the explorer, the working directory is the executable folder, but when you launch your program from your IDE
    (Visual Studio, Code::Blocks, ...) the working directory is sometimes set to the <em>project</em> directory instead. This can generally be changed
    easily in the project settings.
</p>
<p>
    You can also load an image file from memory (<code>loadFromMemory</code>), from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> (<code>loadFromStream</code>), or from an
    already loaded image (<code>loadFromImage</code>). The latter loads the texture from a <?php class_link("Image") ?>, which is a utility class that
    helps to manipulate images (modify pixels, create transparency channel, etc.). The pixels of a <?php class_link("Image") ?> stay in system memory,
    which ensures that operations on them will be as fast as possible, as opposed to the pixels of a texture which reside in video memory and are
    therefore slow to retrieve or update -- but very fast to draw.
</p>
<p>
    SFML supports the most common file formats. The full list is available in the API documentation.
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
    left-top corner, and the size of the rectangle.
</p>
<p>
    If you don't want to load a texture from an image, but rather want to update it directly from an array of pixels, you can create it empty and
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
    To update the pixels of an existing texture, you must use the <code>update</code> function. It has overloads for many sources:
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
    These examples all assume that the source has the same size as the texture. If this is not the case, i.e. if you want to update only a part of the
    texture, then you can specify the coordinates of the sub-rectangle that you want to update. You can refer to the documentation for more details.
</p>
<p>
    Additionally, a texture has two properties that change how it is rendered.
</p>
<p>
    The first property allows one to smooth the texture. Smoothing a texture makes its pixels less visible (but a little more blurry), which can be
    important if it is scaled.
</p>
<pre><code class="cpp">texture.setSmooth(true);
</code></pre>
<img src="./images/graphics-sprites-smooth.png" title="Smooth vs not smooth" />
<p class="important">
    Since smoothing interpolates adjacent pixels in the texture, it can have the unwanted side effect of showing pixels outside the selected texture area.
    This can happen when your sprite is located at non-integer coordinates.
</p>
<p>
    The second property allows one to repeat a texture within a single sprite.
</p>
<pre><code class="cpp">texture.setRepeated(true);
</code></pre>
<img src="./images/graphics-sprites-repeated.png" title="Repeated vs not repeated" />
<p>
    This works only if your sprite is configured to show a rectangle which is bigger than the texture. Otherwise this property has no effect.
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
    If you don't want your sprite to show the full texture, you can set its texture rectangle.
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
    Sprites can also be transformed: they have a position, an orientation and a scale.
</p>
<pre><code class="cpp">// position
sprite.setPosition(sf::Vector2f(10, 50)); // absolute position
sprite.move(sf::Vector2f(5, 10)); // offset relative to the current position

// rotation
sprite.setRotation(90); // absolute angle
sprite.rotate(15); // offset relative to the current angle

// scale
sprite.setScale(sf::Vector2f(0.5f, 2.f)); // absolute scale factor
sprite.scale(sf::Vector2f(1.5f, 3.f)); // factor relative to the current scale
</code></pre>
<p>
    By default, the origin for these three transformations is the top-left corner of the sprite. If you want to set the origin to a different point
    (for example the center of the sprite, or another corner), you can use the <code>setOrigin</code> function.
</p>
<pre><code class="cpp">sprite.setOrigin(sf::Vector2f(25, 25));
</code></pre>
<p>
    Since transformation functions are common to all SFML entities, they are explained in a separate tutorial: 
    <a href="./graphics-transform.php" title="'Transforming entities' tutorial">Transforming entities</a>.
</p>

<?php h2('The white square problem') ?>
<p>
    You successfully loaded a texture, correctly defined a sprite, and... all you see on screen now is a white square. What happened?
</p>
<p>
    This is a common mistake. When you set the texture of a sprite, all it does internally is to keep a <em>pointer</em> to the texture instance.
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
    You must correctly manage the lifetime of your textures, so that they live as long as they are used by sprites.
</p>

<?php h2('The importance of using as few textures as possible') ?>
<p>
    Using as few textures as possible is a good strategy, and the reason is simple: changing the current texture is an expensive operation for the
    graphics card. Drawing many sprites that use the same texture will give you the best performances.
</p>
<p>
    Additionally, using a single texture allows you to group static geometry into a single entity (you can only use one texture per <code>draw</code> call), which will
    be much faster to draw than a set of many entities. Batching static geometry involves other classes and is therefore beyond the scope of this tutorial, for more details
    see the <a href="./graphics-vertex-array.php" title="Vertex array tutorial">vertex array</a> tutorial.
</p>
<p>
    So, keep this in mind when you create your animation sheets or your tilesets: use a single texture if possible.
</p>

<?php h2('Using sf::Texture with OpenGL code') ?>
<p>
    If you're using OpenGL rather than the graphics entities of SFML, you can still use <?php class_link("Texture") ?> as a wrapper around an OpenGL texture and make it
    interact with your OpenGL entities.
</p>
<p>
    To activate a <?php class_link("Texture") ?> for drawing (the equivalent of <code>glBindTexture</code>), you must call the <code>bind</code> static function:
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
