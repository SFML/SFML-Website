<?php

    $title = "Displaying a sprite";
    $page = "graphics-sprite.php";

    require("header.php");
?>

<h1>Displaying a sprite</h1>

<?php h2('Introduction') ?>
<p>
    Displaying sprites is maybe the most important part of a 2D API. Because, basically, everything is a sprite.
    Let's have a look at what they look like in SFML.
</p>

<?php h2('Loading an image') ?>
<p>
    Usually, sprites are loaded from files on hard drive. To load an image from a file with SFML you have
    to use the <?php class_link("Image")?> class and its <code>LoadFromFile</code> function :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromFile("sprite.tga"))
{
    // Error...
}
</code></pre>
<p>
    You can as well load a file already loaded in memory with the <code>LoadFromMemory</code> function :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromMemory(FilePtr, Size))
{
    // Error...
}
</code></pre>
<p>
    Images can also be created and filled with a color, or loaded from an array of pixels  :
</p>
<pre><code class="cpp">sf::Image Image1(200, 200, sf::Color(0, 255, 0));
sf::Image Image2(200, 200, PointerToPixelsInMemory);

// Or, if you want to do it after construction :

Image1.Create(200, 200, sf::Color(0, 255, 0));
Image2.LoadFromPixels(200, 200, PointerToPixelsInMemory);
</code></pre>
<p>
    Please note that when you load an image from memory, pixels must have a specific format, which
    is 32-bits RGBA.
</p>
<p>
    You can also access image pixels for reading and writing :
</p>
<pre><code class="cpp">sf::Color Color = Image.GetPixel(10, 20);
Image.SetPixel(20, 30, Color);
</code></pre>
<p>
    Be careful when manipulating images : they can be copied, but it's not a lightweight operation. So try to avoid it
    as possible (pass them by reference when you can).
</p>

<?php h2('Creating a sprite') ?>
<p>
    Ok, we can now create / load / modify an image. But this is not a sprite. In SFML, images and sprites
    are split into two classes. You can see images as an array of pixels in memory, and sprites as a way
    to display these arrays of pixels in a window. Having image manipulation not in the sprite interface
    has two main advantages :
</p>
<ul>
    <li>It allows you to use the same image for several sprites, without duplicate pixels in memory, and
    without having to write an image manager</li>
    <li>Sometimes you don't want to manipulate images as sprites. For example you may want to load
    images, apply them some effect and save them to files</li>
</ul>
<p>
    Let's go back to sprites. In SFML, a sprite is an instance of the <?php class_link("Sprite")?>
    class. This class inherits from <?php class_link("Drawable")?>,
    which is the base of every drawable thing (sprites, strings, post-effects, ...).
    <?php class_link("Drawable")?>
    defines a set of functions for setting / getting the visual appearance of the drawable object. Here is an example
    with a sprite, but these functions are common to every drawable object, so remember them.
</p>
<pre><code class="cpp">sf::Sprite Sprite;
Sprite.SetColor(sf::Color(0, 255, 255, 128));
Sprite.SetX(200.f);
Sprite.SetY(100.f);
Sprite.SetPosition(200.f, 100.f);
Sprite.SetRotation(30.f);
Sprite.SetCenter(0, 0);
Sprite.SetScaleX(2.f);
Sprite.SetScaleY(0.5f);
Sprite.SetScale(2.f, 0.5f);
Sprite.SetBlendMode(sf::Blend::Multiply);

Sprite.Move(10, 5);
Sprite.Rotate(90);
Sprite.Scale(1.5f, 1.5f);
</code></pre>
<p>
    Note that every function taking two floats as parameters, can also take a
    <?php class_link("Vector2f", "Vector2")?> instance. The GetXxx functions
    corresponding to SetXxx function taking a vector, also returns a <?php class_link("Vector2f", "Vector2")?>
    instance.
</p>
<p>
    The center of the object, defined by the function <code>SetCenter</code>, is defined relative to the
    left-top corner of the object and represents its center of translation, rotation and scaling. You can see it as
    the origin of the object, which will remain unchanged when you apply geometric transformations to it.
</p>
<p>
    Notice that the color has an alpha component of 128, meaning that our sprite will be a bit transparent.
    If you wonder why the sprite's position is expressed with floats whereas pixels are integers, this is to
    allow for more flexibility. When you move a sprite, this is not always of an integer amount of pixels, but
    rather a small value at each frame. This avoids you to have another variable just to store the sprite's
    position as floats. Another reason is that when using views, "scene" coordinates no more match screen
    pixels ; but let's keep this for next tutorial.
</p>
<p>
    Once you've applied all these transformations to your sprite, it may become difficult to get the resulting
    rectangle, or generally to get any local point's final position. That's why <?php class_link("Sprite")?>
    and all drawable classes define two conversion functions :
</p>
<pre><code class="cpp">// Convert a local point to global coordinates
sf::Vector2f Global = Sprite.TransformToGlobal(sf::Vector2f(10, 25));

// Convert a global point to local coordinates
sf::Vector2f Local = Sprite.TransformToLocal(sf::Vector2f(425, 120));
</code></pre>
<p>
    On top of that, <?php class_link("Sprite")?>
    provides more specific functions :
</p>
<pre><code class="cpp">// Change the source image (texture) of the sprite
sf::Image Image;
...
Sprite.SetImage(Image);

// Get the sprite's dimensions
float Width  = Sprite.GetSize().x;
float Height = Sprite.GetSize().y;

// Resize the sprite
Sprite.Resize(60, 100);

// Flip the sprite on X and Y axis
Sprite.FlipX(true);
Sprite.FlipY(true);

// Get the color of a given pixel inside the sprite
sf::Color Pixel = Sprite.GetPixel(10, 5);
</code></pre>
<p>
    We can then easily add some interaction with our sprite :
</p>
<pre><code class="cpp">// Get elapsed time
float ElapsedTime = App.GetFrameTime();

// Move the sprite
if (App.GetInput().IsKeyDown(sf::Key::Left))  Sprite.Move(-100 * ElapsedTime, 0);
if (App.GetInput().IsKeyDown(sf::Key::Right)) Sprite.Move( 100 * ElapsedTime, 0);
if (App.GetInput().IsKeyDown(sf::Key::Up))    Sprite.Move(0, -100 * ElapsedTime);
if (App.GetInput().IsKeyDown(sf::Key::Down))  Sprite.Move(0,  100 * ElapsedTime);

// Rotate the sprite
if (App.GetInput().IsKeyDown(sf::Key::Add))      Sprite.Rotate(-100 * ElapsedTime);
if (App.GetInput().IsKeyDown(sf::Key::Subtract)) Sprite.Rotate( 100 * ElapsedTime);
</code></pre>
<?php h2('Drawing a sprite') ?>
<p>
    Drawing a sprite in a render window is straight-forward :
</p>
<pre><code class="cpp">App.Draw(Sprite);
</code></pre>
<p>
    No extra parameter is needed, because the sprite already knows all about its visual (position, color, ...).
</p>
<p>
    If you want to draw only a sub-rectangle of the original image, you can change the
    <code>SubRect</code> parameter of the sprite :
</p>
<pre><code class="cpp">Sprite.SetSubRect(sf::IntRect(10, 10, 20, 20));
</code></pre>
<p>
    Here we will only display a sub-rectangle of the image, going from pixel (10, 10) to pixel (20, 20).
</p>
<p>
    <?php class_link("IntRect", "Rect")?> is just an utility class for manipulating rectangles. For
    rectangles with float coordinates, there is also the <?php class_link("FloatRect", "Rect")?> class
    (in fact they are both instances of the <?php class_link("Rect")?> template class).
</p>

<?php h2('Images and sprites management') ?>
<p>
    You have to be particularly careful when manipulating images. A <?php class_link("Image")?>
    instance is a resource which is slow to load, heavy to copy and uses a lot of memory.
</p>
<p>
    A lot of people, especially beginners, will just put an instance of
    <?php class_link("Image")?>
    wherever they have an instance of
    <?php class_link("Sprite")?>,
    because it may seem the simplest way to draw something. The fact is that it's generally a bad idea. The most obvious
    problem is when copying such objects (just putting them into an array generates copies) : the sprites will most likely
    appear white. The reason is that a sprite only points to an external image it doesn't own one, so when the image is
    copied the sprite has to be updated to point to the new copy of the image. This is quite easy to handle, you just
    have to define a copy constructor for such classes holding (or deriving from) a sprite and an image :
</p>
<pre><code class="cpp">class MyPicture
{
public :

    // This is the copy constructor
    MyPicture(const MyPicture& Copy) : Image(Copy.Image), Sprite(Copy.Sprite)
    {
        // This is the trick : we setup the sprite
        // to use our image, instead of the one of Copy
        Sprite.SetImage(Image);
    }

    // ... a lot of useful functions ...

private :

    sf::Image  Image;
    sf::Sprite Sprite;
};
</code></pre>
<p>
    But this is a particular case, and generally you will most likely share an image among several sprites. In fact, there
    shouldn't be more than one instance of <?php class_link("Image")?>
    per image file that you load (after all, why should we have the same array of pixels loaded several times in memory ?).
    That's why the concepts of sprites and images have been split in SFML : images are
    heavy and expensive, whereas sprites are lightweight, they are just a particular visual representation of an image.
</p>
<p>
    There are a lot of good designs which take care of image management. For example, if you have a class which instances
    will always use the same image, you can simply do this :
</p>
<pre><code class="cpp">class Missile
{
public :

    static bool Init(const std::string& ImageFile)
    {
        return Image.LoadFromFile(ImageFile);
    }

    Missile()
    {
        Sprite.SetImage(Image); // every sprite uses the same unique image
    }

private :

    static sf::Image Image; // shared by every instance

    sf::Sprite Sprite; // one per instance
};
</code></pre>
<p>
    In a more complex engine, images would be automatically handled by a manager. This is a more generic and
    easy way of handling resources. The idea is to make the manager store the images, associated to their filename
    (or whatever unique identifier), so that if the same image is requested several times, the same instance will actually
    always be returned by the manager.
</p>
<pre><code class="cpp">sf::Sprite Sprite;

// GetImage will always return the same image for the same filename
Sprite.SetImage(ImageManager.GetImage("data/missile.png"));
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Sprite is a basic concept in a 2D API, and as you've seen they are very easy to use in SFML. If you now want
    to know how to draw simple shapes with SFML, go to the next tutorial about
    <a class="internal" href="./graphics-shape.php" title="Jump to next tutorial">shapes</a>.
</p>

<?php

    require("footer.php");

?>
