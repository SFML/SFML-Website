# Adding post-effects

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/graphics/shader/).

## Introduction

With the evolution of graphics cards, shaders have become a common thing in graphics applications. They allow easy and full customization of vertex and pixel output. As the SFML graphics package mainly aims at 2D graphics, we'll focus on pixel shaders, and on what we call post-effects.

Post-effects are custom pixel effects that are applied to the whole screen, after you have rendered everything. Common post-effects are black-and-white, glow, HDRL (high dynamic range lighting), etc.

SFML defines a class to easily create and apply post-effects : [`sf::PostFX`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1PostFX.php "sf::PostFX documentation"). Let's see how to create a post-effect, and how to manipulate it in your program.

## Writing a post-effect

SFML post-effects rely on the GLSL fragment shaders syntax. In fact, SFML post-effects *are* fragment shaders, with a few minor changes to hide some complicated syntax. As 99% of the syntax is GLSL, I suggest you get a reference documentation before your start writing your own effects. Here are some good docs :

- [GLSL quick reference : the complete GLSL syntax in 2 pages](http://www.opengl.org/sdk/libs/OpenSceneGraph/glsl_quickref.pdf "Download GLSL quick reference")
- [GLSL definition on wikipedia : a basic approach and a lot of good links](http://en.wikipedia.org/wiki/GLSL "Read the definition of GLSL on Wikipedia")
- [LightHouse 3D GLSL tutorial : a nice tutorial to begin with GLSL](http://www.lighthouse3d.com/opengl/glsl/index.php?intro "Go to the LightHouse3D GLSL tutorial")
- [NeHe GLSL tutorial : another good tutorial](http://nehe.gamedev.net/data/articles/article.asp?article=21 "Go to the NeHe GLSL tutorial")

But don't worry, you can start writing nice effects with very simple syntax, as we'll see with the following example.

Let's write a simple example, to show you how an effect works. We'll build an effect that colorizes the screen, with a custom color that can be changed at runtime. The effect is named colorize.sfx, and the file can be downloaded at the end of this tutorial.

The first part of an effect is variable declarations. This is a sequence of variable types and names :

```cpp
texture framebuffer
vec3 color
```

Here, we define a texture named `framebuffer` and a vector3 (containing 3 components x y and z) named `color`. The valid variable types are the ones defined by GLSL, plus `texture`, which is just a shortcut for `uniform sampler2D`. All global variables are automatically made uniform, which means that their value can be modified by your C++ program.

Then, you can write the effect code, which will always be in a `effect { ... }` bloc.

```cpp
effect
{
    // Get the value of the current screen pixel
    vec4 pixel = framebuffer(_in);

    // Compute its gray level
    float gray = pixel.r * 0.39 + pixel.g * 0.50 + pixel.b * 0.11;

    // Finally write the output pixel using 50% of the source pixel and 50% of its colored version
    _out = vec4(gray * color, 1.0) * 0.5 + pixel * 0.5;
}
```

SFML defines two special variables : `_in` is the coordinates of the current pixel (gl_TexCoords[0]), and `_out` is the pixel value to output (gl_FragColor).

To access the pixels of a texture, the syntax is like a function call : the function is the texture name (here `framebuffer`) and the parameter is a `vec2` variable, which is the pixel coordinates in the range [0, 1] (here we use `_in`). The result is a `vec4` variable, which contains the red, green, blue and alpha components of the read pixel.

Once we have read the current screen pixel, we can apply some processing on it. First, we compute its gray level using the standard formula (39% red + 50% green + 11% blue). Then we can modulate it by the custom color, and output it to the `_out` variable.

That's all, you now have an SFML effect that will colorize your screen using a custom color. Let's now have a look at the C++ part, and how to use it.

## Loading and using a post-effect

Before loading any post-effect, you must make sure the system can run it. Old graphics cards don't support shaders, and trying to run a post-effect on them would result in a failure. SFML provides a function to quickly check if the system supports post-effects :

```cpp
if (sf::PostFX::CanUsePostFX() == false)
{
    // Post-effects are not supported...
}
```

If your system is ok to run post-effects, you can then load one with the `LoadFromFile` function :

```cpp
sf::PostFX Effect;
if (!Effect.LoadFromFile("colorize.sfx"))
{
    // Loading failed...
}
```

You can also load it directly from the code in memory with the `LoadFromMemory` function :

```cpp
sf::PostFX Effect;
std::string Code = "... a big code ...";
if (!Effect.LoadFromMemory(Code))
{
    // Loading failed...
}
```

These functions return `false` if anything failed during the loading. In this case, you get a detailed GLSL compile log in the standard error output.

Before starting the rendering loop, you should initialize the variables defined in your effect. Remember, here we have a texture called `framebuffer`, and a vector called `color`.

```cpp
Effect.SetTexture("framebuffer", NULL);
Effect.SetParameter("color", 1.f, 1.f, 1.f);
```

The `SetTexture` function is used to bind a texture. The first parameter is the texture name in the effect, the second one is a pointer to the texture, defined as a [`sf::Image`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Image.php "sf::Image documentation"). Passing `NULL` means you want to use the contents of the screen.

To set any other type of parameter, you can use the `SetParameter` set of functions. The first parameter is the parameter name in the effect, and then, depending on the parameter's type, you can pass 1, 2, 3 or 4 floats. Here we have a `vec3` variable, so we pass 3 values. Values for colors range from 0 to 1, so here we have defined a white color.

You can then use these functions at any time to set the parameters values. For example, if we want to make the color depend on the mouse position, we could write this piece of code into our rendering loop :

```cpp
// Get the mouse position in the range [0, 1]
float X = App.GetInput().GetMouseX() / static_cast<float>(App.GetWidth());
float Y = App.GetInput().GetMouseY() / static_cast<float>(App.GetHeight());

// Update the effect parameters
Effect.SetParameter("color", 0.5f, X, Y);
```

Finally, you apply the post-effect by drawing it, like any drawable object :

```cpp
App.Draw(Effect);
```

Note that the input of the effect will be the screen contents at the time you apply the effect. This means that every object drawn after the line above (and before the call to `App.Display()`) will not be affected by the effect. This allows you to exclude some objects from the post-effect, like a user interface of some text that would be displayed on top of the 2D scene.

## Conclusion

You can now write your own custom post-effects, and implement any funny effect that you can think of. Always keep a GLSL reference around, and don't forget to check the compile logs if your effects fail, as it's quite easy to introduce a stupid syntax error in an effect file.
