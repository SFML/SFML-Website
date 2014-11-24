<?php

    $title = "Adding special effects with shaders";
    $page = "graphics-shaders.php";

    require("header.php");

?>

<h1>Adding special effects with shaders</h1>

<?php h2('Introduction') ?>
<p>
    A shader is a small program that executes directly on the graphics card, and which allows the programmer to describe its drawing process in a more
    flexible and simple way than using the fixed set of states and operations provided by OpenGL. With this extra flexibility, shaders are used to write
    effects that would be complicated, if not impossible, to describe with regular OpenGL functions: per-pixel lighting, shadows, etc. Today's graphics
    cards and new versions of OpenGL are even totally based on shaders, and the fixed set of states and functions (which is called the "fixed pipeline")
    that you used to know is meant to disappear.
</p>
<p>
    Shaders are written in GLSL (<em>OpenGL Shading Language</em>), which is very similar to the C language.
</p>
<p>
    There are two types of shaders: vertex shaders and fragment (or pixel) shaders. Vertex shaders transform the geometry, while fragment shaders deal
    with pixels. Depending on what kind of effect you want to achieve, you can define only the vertex shader, the fragment shader, or define both.
</p>
<p>
    To understand what shaders do, and how to use them efficiently, it is important to know the basics of the rendering pipeline. You must also
    learn how to write GLSL programs, and find good tutorials and examples to get started. You can also have a look at the "Shader" example that
    comes with the SFML SDK.
</p>
<p>
    This tutorial will only focus on the SFML specific part: loading and applying your shaders -- not writing them.
</p>

<?php h2('Loading shaders') ?>
<p>
    In SFML, shaders are represented by the <?php class_link("Shader") ?> class. It handles both the vertex and fragment shader: a <?php class_link("Shader") ?>
    instance is a combination of both (or only one, if the other is not needed).
</p>
<p>
    Even if shaders have become common, there are still old graphics cards that don't support them. So the first thing to do in your program is to check if shaders
    are available:
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
    Shaders are just text files (like your C++ code), so their extension doesn't really matter, it can be anything you want. ".vert" and ".frag" are just
    conventions.
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
    Shaders can also be loaded directly from strings, with the <code>loadFromMemory</code> function. This can be useful if you want to embed the shader
    sources directly into your program.
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
    And, like all other SFML resources, shaders can be loaded from a
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
    Like any other program, a shader can have parameters so that it can behave differently from one execution to another. These parameters are declared as global variables in
    the shader, called <em>uniform</em> variables.
</p>
<pre><code class="glsl">uniform float myvar;

void main()
{
    // use myvar...
}
</code></pre>
<p>
    Uniform variables can be set by the C++ program, using the various overloads of the <code>setParameter</code> function of the <?php class_link("Shader") ?> class.
</p>
<pre><code class="cpp">shader.setParameter("myvar", 5.f);
</code></pre>
<p>
    The overloads of <code>setParameter</code> support all the types provided by SFML:
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
    error messages such as <q>Failed to find variable "xxx" in shader</q> when you call <code>setParameter</code> during your tests.
</p>

<?php h2('Minimal shaders') ?>
<p>
    You won't learn here how to write GLSL shaders, but you must at least know what input SFML sends to the shaders, and what it expects you to do with it.
</p>

<h3>Vertex shader</h3>
<p>
    SFML has a fixed format of vertex, which is described by the <?php class_link("Vertex") ?> structure. A SFML vertex has a 2D position, a color, and 2D texture coordinates.
    And this is exactly the input that you get in a vertex shader, in the <code>gl_Vertex</code>, <code>gl_MultiTexCoord0</code> and <code>gl_Color</code> predefined
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
    The position needs to be transformed by the model-view matrix, which contains the entity transform combined to the current view. The texture coordinates need to be
    transformed by the texture matrix (this matrix doesn't mean anything for you, this is just an implementation detail of SFML). And finally, the color just needs to be
    forwarded. Of course, you can ignore the texture coordinates or the color if you don't need them. <br />
    All these variables will then be interpolated per-pixel by the graphics card, and passed to the fragment shader.
</p>

<h3>Fragment shader</h3>
<p>
    The fragment shader is quite similar: it receives the texture coordinates and the color of the current pixel. There's no position anymore, at this point the graphics card
    has already computed the final position of the pixel. However if you deal with textured entities, you'll also need the current texture.
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
    The current texture is not automatic, you need to handle it like other regular variables, and set it explicitly from your C++ program. Since each entity can have a different
    texture, and worse, there might be no way for you to get it and pass it to the shader, SFML provides a special overload of the <code>setParameter</code> function that
    does this job for you.
</p>
<pre><code class="cpp">shader.setParameter("texture", sf::Shader::CurrentTexture);
</code></pre>
<p>
    This special parameter assigns the texture of the entity being drawn to the given shader variable. Everytime you draw a new entity, SFML updates the corresponding shader
    variable accordingly.
</p>
<p>
    If you want to see nice examples of shaders in action, you can have a look at the Shader example in the SFML SDK.
</p>

<?php h2('Using a sf::Shader with OpenGL code') ?>
<p>
    If you're using OpenGL rather than the graphics entities of SFML, you can still use <?php class_link("Shader") ?> as a wrapper around an OpenGL shader and make it
    interact with your OpenGL entities.
</p>
<p>
    To activate a <?php class_link("Shader") ?> for drawing (the equivalent of <code>glUseProgram</code>), you must call the <code>bind</code> static function:
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
