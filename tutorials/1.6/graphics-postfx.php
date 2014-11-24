<?php

    $title = "Adding post-effects";
    $page = "graphics-postfx.php";

    require("header.php");
?>

<h1>Adding post-effects</h1>

<?php h2('Introduction') ?>
<p>
    With the evolution of graphics cards, shaders have become a common thing in graphics applications. They allow easy
    and full customization of vertex and pixel output. As the SFML graphics package mainly aims at 2D graphics, we'll
    focus on pixel shaders, and on what we call post-effects.
</p>
<p>
    Post-effects are custom pixel effects that are applied to the whole screen, after you have rendered everything. Common
    post-effects are black-and-white, glow, HDRL (high dynamic range lighting), etc.
</p>
<p>
    SFML defines a class to easily create and apply post-effects : <?php class_link("PostFX")?>. Let's see how to create
    a post-effect, and how to manipulate it in your program.
</p>

<?php h2('Writing a post-effect') ?>
<p>
    SFML post-effects rely on the GLSL fragment shaders syntax. In fact, SFML post-effects <em>are</em> fragment shaders,
    with a few minor changes to hide some complicated syntax. As 99% of the syntax is GLSL, I suggest you get
    a reference documentation before your start writing your own effects. Here are some good docs :
</p>
<ul>
    <li><a class="external" href="http://www.opengl.org/sdk/libs/OpenSceneGraph/glsl_quickref.pdf" title="Download GLSL quick reference">GLSL quick reference : the complete GLSL syntax in 2 pages</a></li>
    <li><a class="external" href="http://en.wikipedia.org/wiki/GLSL" title="Read the definition of GLSL on Wikipedia">GLSL definition on wikipedia : a basic approach and a lot of good links</a></li>
    <li><a class="external" href="http://www.lighthouse3d.com/opengl/glsl/index.php?intro" title="Go to the LightHouse3D GLSL tutorial">LightHouse 3D GLSL tutorial : a nice tutorial to begin with GLSL</a></li>
    <li><a class="external" href="http://nehe.gamedev.net/data/articles/article.asp?article=21" title="Go to the NeHe GLSL tutorial">NeHe GLSL tutorial : another good tutorial</a></li>
</ul>
<p>
    But don't worry, you can start writing nice effects with very simple syntax, as we'll see with the following example.
</p>
<p>
    Let's write a simple example, to show you how an effect works. We'll build an effect that colorizes the screen,
    with a custom color that can be changed at runtime. The effect is named colorize.sfx, and the file can be downloaded
    at the end of this tutorial.
</p>
<p>
    The first part of an effect is variable declarations. This is a sequence of variable types and names :
</p>
<pre><code class="cpp">texture framebuffer
vec3 color
</code></pre>
<p>
    Here, we define a texture named <code>framebuffer</code> and a vector3 (containing 3 components x y and z)
    named <code>color</code>. The valid variable types are the ones defined by GLSL, plus <code>texture</code>, which
    is just a shortcut for <code>uniform sampler2D</code>. All global variables are automatically made uniform, which
    means that their value can be modified by your C++ program.
</p>
<p>
    Then, you can write the effect code, which will always be in a <code>effect { ... }</code> bloc.
</p>
<pre><code class="cpp">effect
{
    // Get the value of the current screen pixel
    vec4 pixel = framebuffer(_in);

    // Compute its gray level
    float gray = pixel.r * 0.39 + pixel.g * 0.50 + pixel.b * 0.11;

    // Finally write the output pixel using 50% of the source pixel and 50% of its colored version
    _out = vec4(gray * color, 1.0) * 0.5 + pixel * 0.5;
}
</code></pre>
<p>
    SFML defines two special variables : <code>_in</code> is the coordinates of the current pixel (gl_TexCoords[0]), and
    <code>_out</code> is the pixel value to output (gl_FragColor).
</p>
<p>
    To access the pixels of a texture, the syntax is like a function call : the function is the texture name (here
    <code>framebuffer</code>) and the parameter is a <code>vec2</code> variable, which is the pixel coordinates in
    the range [0, 1] (here we use <code>_in</code>). The result is a <code>vec4</code> variable, which contains the
    red, green, blue and alpha components of the read pixel.
</p>
<p>
    Once we have read the current screen pixel, we can apply some processing on it. First, we compute its gray level using
    the standard formula (39% red + 50% green + 11% blue). Then we can modulate it by the custom color, and output it
    to the <code>_out</code> variable.
</p>
<p>
    That's all, you now have an SFML effect that will colorize your screen using a custom color. Let's now have a look
    at the C++ part, and how to use it.
</p>

<?php h2('Loading and using a post-effect') ?>
<p>
    Before loading any post-effect, you must make sure the system can run it. Old graphics cards don't support shaders,
    and trying to run a post-effect on them would result in a failure. SFML provides a function to quickly check if the
    system supports post-effects :
</p>
<pre><code class="cpp">if (sf::PostFX::CanUsePostFX() == false)
{
    // Post-effects are not supported...
}
</code></pre>
<p>
    If your system is ok to run post-effects, you can then load one with the <code>LoadFromFile</code> function :

</p><pre><code class="cpp">sf::PostFX Effect;
if (!Effect.LoadFromFile("colorize.sfx"))
{
    // Loading failed...
}
</code></pre>
<p>
    You can also load it directly from the code in memory with the <code>LoadFromMemory</code> function :
</p>
<pre><code class="cpp">sf::PostFX Effect;
std::string Code = "... a big code ...";
if (!Effect.LoadFromMemory(Code))
{
    // Loading failed...
}
</code></pre>
<p>
    These functions return <code>false</code> if anything failed during the loading. In this case, you get a detailed
    GLSL compile log in the standard error output.
</p>
<p>
    Before starting the rendering loop, you should initialize the variables defined in your effect. Remember, here we have a
    texture called <code>framebuffer</code>, and a vector called <code>color</code>.
</p>
<pre><code class="cpp">Effect.SetTexture("framebuffer", NULL);
Effect.SetParameter("color", 1.f, 1.f, 1.f);
</code></pre>
<p>

    The <code>SetTexture</code> function is used to bind a texture. The first parameter is the texture name in the effect,
    the second one is a pointer to the texture, defined as a <?php class_link("Image")?>. Passing <code>NULL</code> means you want
    to use the contents of the screen.
</p>
<p>
    To set any other type of parameter, you can use the <code>SetParameter</code> set of functions. The first parameter
    is the parameter name in the effect, and then, depending on the parameter's type, you can pass 1, 2, 3 or 4
    floats. Here we have a <code>vec3</code> variable, so we pass 3 values. Values for colors range from 0 to 1, so
    here we have defined a white color.
</p>
<p>
    You can then use these functions at any time to set the parameters values. For example, if we want to make the color
    depend on the mouse position, we could write this piece of code into our rendering loop :
</p>
<pre><code class="cpp">// Get the mouse position in the range [0, 1]
float X = App.GetInput().GetMouseX() / static_cast&lt;float&gt;(App.GetWidth());
float Y = App.GetInput().GetMouseY() / static_cast&lt;float&gt;(App.GetHeight());

// Update the effect parameters
Effect.SetParameter("color", 0.5f, X, Y);
</code></pre>
<p>
    Finally, you apply the post-effect by drawing it, like any drawable object :
</p>
<pre><code class="cpp">App.Draw(Effect);
</code></pre>
<p>
    Note that the input of the effect will be the screen contents at the time you apply the effect. This means that
    every object drawn after the line above (and before the call to <code>App.Display()</code>) will not be affected
    by the effect. This allows you to exclude some objects from the post-effect, like a user interface of some text that
    would be displayed on top of the 2D scene.
</p>

<?php h2('Conclusion') ?>
<p>
    You can now write your own custom post-effects, and implement any funny effect that you can think of. Always keep
    a GLSL reference around, and don't forget to check the compile logs if your effects fail, as it's quite easy to
    introduce a stupid syntax error in an effect file.
</p>

<?php

    require("footer.php");

?>
