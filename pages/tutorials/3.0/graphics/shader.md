# Adding special effects with shaders

## Introduction

A shader is a small program that is executed on the graphics card.
It provides the programmer with more control over the drawing process and in a more flexible and simple way than using the fixed set of states and operations provided by OpenGL.
With this additional flexibility, shaders are used to create effects that would be too complicated, if not impossible, to describe with regular OpenGL functions: Per-pixel lighting, shadows, etc.
Today's graphics cards and newer versions of OpenGL are already entirely shader-based, and the fixed set of states and functions (which is called the "fixed pipeline") that you might know of has been deprecated and will likely be removed in the future.

Shaders are written in GLSL (_OpenGL Shading Language_), which is very similar to the C programming language.

There are two types of shaders: vertex shaders and fragment (or pixel) shaders.
Vertex shaders are run for each vertex, while fragment shaders are run for every generated fragment (pixel).
Depending on what kind of effect you want to achieve, you can provide a vertex shader, a fragment shader, or both.

To understand what shaders do and how to use them efficiently, it is important to understand the basics of the rendering pipeline.
You must also learn how to write GLSL programs and find good tutorials and examples to get started.
You can also have a look at the "Shader" example that comes with the SFML SDK.

This tutorial will only focus on the SFML specific part: Loading and applying your shaders -- not writing them.

## Loading shaders

In SFML, shaders are represented by the [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") class.
It handles both the vertex and fragment shaders: A [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") object is a combination of both (or only one, if the other is not provided).
 
Even though shaders have become commonplace, there are still old graphics cards that might not support them.
The first thing you shoulddo in your program is check if shaders are available on the system:

```cpp
if (!sf::Shader::isAvailable())
{
    // shaders are not available...
}
```

Any attempt to use the [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") class will fail if `sf::Shader::isAvailable()` returns `false`.

The most common way of loading a shader is from a file on disk, which is done with the `loadFromFile` function or the corresponding constructors.

```cpp
sf::Shader shader;

// load only the vertex shader
if (!shader.loadFromFile("vertex_shader.vert", sf::Shader::Type::Vertex))
{
    // error...
}

// load only the fragment shader
if (!shader.loadFromFile("fragment_shader.frag", sf::Shader::Type::Fragment))
{
    // error...
}

// load both shaders
if (!shader.loadFromFile("vertex_shader.vert", "fragment_shader.frag"))
{
    // error...
}
```

Shader source is contained in simple text files (like your C++ code).
Their extension doesn't really matter.
It can be anything you want.
You can even omit it.
".vert" and ".frag" are just examples of possible extensions.

The `loadFromFile` function can sometimes fail with no obvious reason.
First, check the error message that SFML prints to the standard output (check the console).
If the message is unable to open file, make sure that the *working directory* (which is the directory that any file path will be interpreted relative to) is what you think it is: When you run the application from your desktop environment, the working directory is the executable folder.
However, when you launch your program from your IDE (Visual Studio, Code::Blocks, ...) the working directory might sometimes be set to the *project* directory instead.
This can usually be changed quite easily in the project settings.

Shaders can also be loaded directly from strings, with the `loadFromMemory` function or the corresponding constructors.
This can be useful if you want to embed the shader source directly into your program.

```cpp
constexpr std::string_view vertexShader = R"(
void main()
{
    ... 
}
)";

constexpr std::string_view fragmentShader = R"(
void main()
{
    ... 
}
)";

// load only the vertex shader
if (!shader.loadFromMemory(vertexShader, sf::Shader::Type::Vertex))
{
    // error...
}

// load only the fragment shader
if (!shader.loadFromMemory(fragmentShader, sf::Shader::Type::Fragment))
{
    // error...
}

// load both shaders
if (!shader.loadFromMemory(vertexShader, fragmentShader))
{
    // error...
}
```

And finally, like all other SFML resources, shaders can also be loaded from a [custom input stream](../system/stream.md "Input streams tutorial") with the `loadFromStream` function or the corresponding constructors.

If loading fails, don't forget to check the standard error output (the console) to see a detailed report from the GLSL compiler.

## Using a shader

Using a shader is simple.
Just pass it as an additional argument to the `draw` function.

```cpp
window.draw(whatever, &shader);
```

## Passing variables to a shader

Like any other program, a shader can take parameters so that it is able to behave differently from one draw to another.
These parameters are declared as global variables known as *uniforms* in the shader.

```glsl
uniform float myvar;

void main()
{
    // use myvar...
}
```

Uniforms can be set by the C++ program using the various overloads of the `setUniform` function in the [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") class.

```cpp
shader.setUniform("myvar", 5.f);
```

`setUniform`'s overloads support all the types provided by SFML:

- `float` (GLSL type `float`)
- `2 floats, sf::Vector2f` (GLSL type `vec2`)
- `3 floats, sf::Vector3f` (GLSL type `vec3`)
- `4 floats` (GLSL type `vec4`)
- `sf::Color` (GLSL type `vec4`)
- `sf::Transform` (GLSL type `mat4`)
- `sf::Texture` (GLSL type `sampler2D`)

The GLSL compiler optimizes out unused variables (here, "unused" means "not involved in the calculation of the final vertex/pixel").
So don't be surprised if you get error messages such as Failed to find variable "xxx" in shader when you call `setUniform` during your tests.

## Minimal shaders

You won't learn how to write GLSL shaders here, but it is essential that you know what input SFML provides to the shaders and what it expects you to do with it.

### Vertex shader

SFML has a fixed vertex format which is described by the [`sf::Vertex`](../../../documentation/3.0.1/structsf_1_1Vertex.html "sf::Vertex documentation") structure.
An SFML vertex contains a 2D position, a color, and 2D texture coordinates.
This is the exact input that you will get in the vertex shader, stored in the built-in `gl_Vertex`, `gl_Color` and `gl_MultiTexCoord0` variables (you don't need to declare them).

```glsl
void main()
{
    // transform the vertex position
    gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;

    // transform the texture coordinates
    gl_TexCoord[0] = gl_TextureMatrix[0] * gl_MultiTexCoord0;

    // forward the vertex color
    gl_FrontColor = gl_Color;
}
```

The position usually needs to be transformed by the model-view and projection matrices, which contain the entity transform combined with the current view.
The texture coordinates need to be transformed by the texture matrix (this matrix likely doesn't mean anything to you, it is just an SFML implementation detail).
And finally, the color just needs to be forwarded.
Of course, you can ignore the texture coordinates and/or the color if you don't make use of them.

All these variables will then be interpolated over the primitive by the graphics card, and passed to the fragment shader.

### Fragment shader

The fragment shader functions quite similarly: It receives the texture coordinates and the color of a generated fragment.
There's no position any more, at this point the graphics card has already computed the final raster position of the fragment.
However if you deal with textured entities, you'll also need the current texture.

```glsl
uniform sampler2D texture;

void main()
{
    // lookup the pixel in the texture
    vec4 pixel = texture2D(texture, gl_TexCoord[0].xy);

    // multiply it by the color
    gl_FragColor = gl_Color * pixel;
}
```

The current texture is not automatic.
You need to treat it like you do the other input variables, and explicitly set it from your C++ program.
Since each entity can have a different texture, and worse, there might be no way for you to get it and pass it to the shader, SFML provides a special overload of the `setUniform` function that does this job for you.

```cpp
shader.setUniform("texture", sf::Shader::CurrentTexture);
```

This special parameter automatically sets the texture of the entity being drawn to the shader variable with the given name.
Every time you draw a new entity, SFML will update the shader texture variable accordingly.

If you want to see nice examples of shaders in action, you can have a look at the Shader example in the SFML SDK.

## Using a sf::Shader with OpenGL code

If you're using OpenGL rather than the graphics entities of SFML, you can still use [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") as a wrapper around an OpenGL program object and use it within your OpenGL code.

To activate a [`sf::Shader`](../../../documentation/3.0.1/classsf_1_1Shader.html "sf::Shader documentation") for drawing (the equivalent of `glUseProgram`), you have to call the `bind` static function:

```cpp
sf::Shader shader;
...

// bind the shader
sf::Shader::bind(&shader);

// draw your OpenGL entity here...

// bind no shader
sf::Shader::bind(nullptr);
```
