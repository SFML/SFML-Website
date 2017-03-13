<?php

    $title = "Adding special effects with shaders";
    $page = "graphics-shaders.php";

    require("header.php");

?>

<h1>Adding special effects with shaders</h1>

<?php h2('Introduction') ?>
<p>
    A shader is a small program that is executed on the graphics card. It provides the programmer with more control over the drawing process and in a more
    flexible and simple way than using the fixed set of states and operations provided by OpenGL. With this additional flexibility, shaders are used to create
    effects that would be too complicated, if not impossible, to describe with regular OpenGL functions: Per-pixel lighting, shadows, etc. Today's graphics
    cards and newer versions of OpenGL are already entirely shader-based, and the fixed set of states and functions (which is called the "fixed pipeline")
    that you might know of has been deprecated and will likely be removed in the future.
</p>
<p>
    Shaders are written in GLSL (<em>OpenGL Shading Language</em>), which is very similar to the C programming language.
</p>
<p>
    There are two types of shaders: vertex shaders and fragment (or pixel) shaders. Vertex shaders are run for each vertex, while fragment shaders are run
    for every generated fragment (pixel). Depending on what kind of effect you want to achieve, you can provide a vertex shader, a fragment shader, or both.
</p>
<p>
    To understand what shaders do and how to use them efficiently, it is important to understand the basics of the rendering pipeline. You must also
    learn how to write GLSL programs and find good tutorials and examples to get started. You can also have a look at the "Shader" example that
    comes with the SFML SDK.
</p>
<p>
    This tutorial will only focus on the SFML specific part: Loading and applying your shaders -- not writing them.
</p>

<?php h2('Loading shaders') ?>
<p>
    In SFML, shaders are represented by the <?php class_link("Shader") ?> class. It handles both the vertex and fragment shaders: A <?php class_link("Shader") ?>
    object is a combination of both (or only one, if the other is not provided).
</p>
<p>
    Even though shaders have become commonplace, there are still old graphics cards that might not support them. The first thing you should do in your program is check if shaders
    are available on the system:
</p>
<pre><code class="cpp">if (!sf::Shader::isAvailable())
{
    // shaders are not available...
}
</code></pre>
<p>
    Any attempt to use the <?php class_link("Shader") ?> class will fail if <code>sf::Shader::isAvailable()</code> returns <code>false</code>.
</p>
<p>
    The most common way of loading a shader is from a file on disk, which is done with the <code>loadFromFile</code> function.
</p>
<pre><code class="cpp">sf::Shader shader;

// load only the vertex shader
if (!shader.loadFromFile("vertex_shader.vert", sf::Shader::Vertex))
{
    // error...
}

// load only the fragment shader
if (!shader.loadFromFile("fragment_shader.frag", sf::Shader::Fragment))
{
    // error...
}

// load both shaders
if (!shader.loadFromFile("vertex_shader.vert", "fragment_shader.frag"))
{
    // error...
}
</code></pre>
<p>
    Shader source is contained in simple text files (like your C++ code). Their extension doesn't really matter, it can be anything you want, you can even omit it. ".vert" and ".frag" are just
    examples of possible extensions.
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
    Shaders can also be loaded directly from strings, with the <code>loadFromMemory</code> function. This can be useful if you want to embed the shader
    source directly into your program.
</p>
<pre><code class="cpp">const std::string vertexShader = \
    "void main()" \
    "{" \
    "    ..." \
    "}";

const std::string fragmentShader = \
    "void main()" \
    "{" \
    "    ..." \
    "}";

// load only the vertex shader
if (!shader.loadFromMemory(vertexShader, sf::Shader::Vertex))
{
    // error...
}

// load only the fragment shader
if (!shader.loadFromMemory(fragmentShader, sf::Shader::Fragment))
{
    // error...
}

// load both shaders
if (!shader.loadFromMemory(vertexShader, fragmentShader))
{
    // error...
}
</code></pre>
<p>
    And finally, like all other SFML resources, shaders can also be loaded from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> with the <code>loadFromStream</code> function.
</p>
<p>
    If loading fails, don't forget to check the standard error output (the console) to see a detailed report from the GLSL compiler.
</p>

<?php h2('Using a shader') ?>
<p>
    Using a shader is simple, just pass it as an additional argument to the <code>draw</code> function.
</p>
<pre><code class="cpp">window.draw(whatever, &amp;shader);
</code></pre>

<?php h2('Passing variables to a shader') ?>
<p>
    Like any other program, a shader can take parameters so that it is able to behave differently from one draw to another. These parameters are declared as global variables
    known as <em>uniforms</em> in the shader.
</p>
<pre><code class="glsl">uniform float myvar;

void main()
{
    // use myvar...
}
</code></pre>
<p>
    Uniforms can be set by the C++ program, using the various overloads of the <code>setUniform</code> function in the <?php class_link("Shader") ?> class.
</p>
<pre><code class="cpp">shader.setUniform("myvar", 5.f);
</code></pre>
<p>
    <code>setUniform</code>'s overloads support all the types provided by SFML:
</p>
<ul>
    <li><code>float</code> (GLSL type <code>float</code>)</li>
    <li><code>2 floats, sf::Vector2f</code> (GLSL type <code>vec2</code>)</li>
    <li><code>3 floats, sf::Vector3f</code> (GLSL type <code>vec3</code>)</li>
    <li><code>4 floats</code> (GLSL type <code>vec4</code>)</li>
    <li><code>sf::Color</code> (GLSL type <code>vec4</code>)</li>
    <li><code>sf::Transform</code> (GLSL type <code>mat4</code>)</li>
    <li><code>sf::Texture</code> (GLSL type <code>sampler2D</code>)</li>
</ul>
<p class="important">
    The GLSL compiler optimizes out unused variables (here, "unused" means "not involved in the calculation of the final vertex/pixel"). So don't be surprised if you get
    error messages such as <q>Failed to find variable "xxx" in shader</q> when you call <code>setUniform</code> during your tests.
</p>

<?php h2('Minimal shaders') ?>
<p>
    You won't learn how to write GLSL shaders here, but it is essential that you know what input SFML provides to the shaders and what it expects you to do with it.
</p>

<h3>Vertex shader</h3>
<p>
    SFML has a fixed vertex format which is described by the <?php class_link("Vertex") ?> structure. An SFML vertex contains a 2D position, a color, and 2D texture coordinates.
    This is the exact input that you will get in the vertex shader, stored in the built-in <code>gl_Vertex</code>, <code>gl_Color</code> and <code>gl_MultiTexCoord0</code>
    variables (you don't need to declare them).
</p>
<pre><code class="glsl">void main()
{
    // transform the vertex position
    gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;

    // transform the texture coordinates
    gl_TexCoord[0] = gl_TextureMatrix[0] * gl_MultiTexCoord0;

    // forward the vertex color
    gl_FrontColor = gl_Color;
}
</code></pre>
<p>
    The position usually needs to be transformed by the model-view and projection matrices, which contain the entity transform combined with the current view. The texture coordinates need to be
    transformed by the texture matrix (this matrix likely doesn't mean anything to you, it is just an SFML implementation detail). And finally, the color just needs to be
    forwarded. Of course, you can ignore the texture coordinates and/or the color if you don't make use of them. <br />
    All these variables will then be interpolated over the primitive by the graphics card, and passed to the fragment shader.
</p>

<h3>Fragment shader</h3>
<p>
    The fragment shader functions quite similarly: It receives the texture coordinates and the color of a generated fragment. There's no position any more, at this point the graphics card
    has already computed the final raster position of the fragment. However if you deal with textured entities, you'll also need the current texture.
</p>
<pre><code class="glsl">uniform sampler2D texture;

void main()
{
    // lookup the pixel in the texture
    vec4 pixel = texture2D(texture, gl_TexCoord[0].xy);

    // multiply it by the color
    gl_FragColor = gl_Color * pixel;
}
</code></pre>
<p>
    The current texture is not automatic, you need to treat it like you do the other input variables, and explicitly set it from your C++ program. Since each entity can have a different
    texture, and worse, there might be no way for you to get it and pass it to the shader, SFML provides a special overload of the <code>setUniform</code> function that
    does this job for you.
</p>
<pre><code class="cpp">shader.setUniform("texture", sf::Shader::CurrentTexture);
</code></pre>
<p>
    This special parameter automatically sets the texture of the entity being drawn to the shader variable with the given name. Every time you draw a new entity, SFML will update the shader
    texture variable accordingly.
</p>
<p>
    If you want to see nice examples of shaders in action, you can have a look at the Shader example in the SFML SDK.
</p>

<?php h2('Using a sf::Shader with OpenGL code') ?>
<p>
    If you're using OpenGL rather than the graphics entities of SFML, you can still use <?php class_link("Shader") ?> as a wrapper around an OpenGL program object and use it
    within your OpenGL code.
</p>
<p>
    To activate a <?php class_link("Shader") ?> for drawing (the equivalent of <code>glUseProgram</code>), you have to call the <code>bind</code> static function:
</p>
<pre><code class="cpp">sf::Shader shader;
...

// bind the shader
sf::Shader::bind(&amp;shader);

// draw your OpenGL entity here...

// bind no shader
sf::Shader::bind(NULL);
</code></pre>

<?php

    require("footer.php");

?>
