<?php

    $title = "User data streams";
    $page = "system-stream.php";

    require("header.php");

?>

<h1>User data streams</h1>

<?php h2('Introduction') ?>
<p>
    SFML has several resource classes: images, fonts, sounds, etc. In most programs, these resources will be loaded from files, with the help of their
    <code>loadFromFile</code> function. In a few other situations, resources will be packed directly into the executable or in a big data file, and
    loaded from memory with <code>loadFromMemory</code>. These functions cover <em>almost</em> all the possible use cases -- but not all.
</p>
<p>
    Sometimes you want to load files from unusual places, such as a compressed/encrypted archive, or a remote network place for example. For these
    special situations, SFML provides a third loading function: <code>loadFromStream</code>. This function reads data from an abstract
    <?php class_link("InputStream") ?> class, which allows you to define your own implementations.
</p>
<p>
    In this tutorial you'll learn how to write and use your own derived input stream.
</p>

<?php h2('And standard streams?') ?>
<p>
    Like many other languages, C++ already has a class for input data streams: <code>std::istream</code>. In fact it has two: <code>std::istream</code>
    is only the front-end, the abstract interface to the custom data is <code>std::streambuf</code>.
</p>
<p>
    Unfortunately, these classes are not very user friendly, and can even become very complicated if you want to implement more than trivial stuff.
    The <a class="external" href="http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html" title="Boost.Iostreams">Boost.Iostreams</a>
    library tries to provide a simpler interface to standard streams, but Boost is a big dependency and SFML cannot depend on it.
</p>
<p>
    That's why SFML provides its own stream interface, which is hopefully a lot more <em>simple and fast</em>.
</p>

<?php h2('InputStream') ?>
<p>
    The <?php class_link("InputStream") ?> class declares four virtual functions:
</p>
<pre><code class="cpp">class InputStream
{
public :

    virtual ~InputStream() {}

    virtual Int64 read(void* data, Int64 size) = 0;

    virtual Int64 seek(Int64 position) = 0;

    virtual Int64 tell() = 0;

    virtual Int64 getSize() = 0;
};</code></pre>
<p>
    <strong>read</strong> must extract <em>size</em> bytes of data from the stream, and copy them to the supplied <em>data</em> address; it returns
    the number of bytes read, or -1 on error.
</p>
<p>
    <strong>seek</strong> must change the current reading position in the stream; its <em>position</em> argument is the absolute byte offset to
    jump to (so it is relative to the beginning of the data, not to the current position); it returns the new position, or -1 on error.
</p>
<p>
    <strong>tell</strong> must return the current reading position (in bytes) in the stream, or -1 on error.
</p>
<p>
    <strong>getSize</strong> must return the total size (in bytes) of the data which is contained in the stream, or -1 on error.
</p>
<p>
    To create your own working stream, you must implement all these four functions according to their requirements.
</p>

<?php h2('An example') ?>
<p>
    Here is a complete and working implementation of a custom input stream. It's not very useful: we'll write a stream that reads data from a file,
    <code>FileStream</code>. But it is simple enough so that you can focus on how the code works, and not get lost in implementation details.
</p>
<p>
    First, let's see its declaration:
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;string&gt;
#include &lt;cstdio&gt;

class FileStream : public sf::InputStream
{
public :

    FileStream();

    ~FileStream();

    bool open(const std::string&amp; filename);

    virtual sf::Int64 read(void* data, sf::Int64 size);

    virtual sf::Int64 seek(sf::Int64 position);

    virtual sf::Int64 tell();

    virtual sf::Int64 getSize();

private :

    std::FILE* m_file;
};
</code></pre>
<p>
    In this example we'll use the good old C file API, so we have a <code>std::FILE*</code> member. We also add a default constructor, a destructor,
    and a function to open the file.
</p>
<p>
    Here is the implementation:
</p>
<pre><code class="cpp">FileStream::FileStream() :
m_file(NULL)
{
}

FileStream::~FileStream()
{
    if (m_file)
        std::fclose(m_file);
}

bool FileStream::open(const std::string&amp; filename)
{
    if (m_file)
        std::fclose(m_file);

    m_file = std::fopen(filename.c_str(), "rb");

    return m_file != NULL;
}

sf::Int64 FileStream::read(void* data, sf::Int64 size)
{
    if (m_file)
        return std::fread(data, 1, static_cast&lt;std::size_t&gt;(size), m_file);
    else
        return -1;
}

sf::Int64 FileStream::seek(sf::Int64 position)
{
    if (m_file)
    {
        std::fseek(m_file, static_cast&lt;std::size_t&gt;(position), SEEK_SET);
        return tell();
    }
    else
    {
        return -1;
    }
}

sf::Int64 FileStream::tell()
{
    if (m_file)
        return std::ftell(m_file);
    else
        return -1;
}

sf::Int64 FileStream::getSize()
{
    if (m_file)
    {
        sf::Int64 position = tell();
        std::fseek(m_file, 0, SEEK_END);
        sf::Int64 size = tell();
        seek(position);
        return size;
    }
    else
    {
        return -1;
    }
}</code></pre>
<p>
    Note that, as explained above, all functions return -1 on error.
</p>
<p>
    Don't forget to check the forum and wiki, chances are that another user already wrote a <?php class_link("InputStream") ?> class that matches your
    needs. And if you write a new one and feel like it could be useful outside your project, don't hesitate to share!
</p>

<?php h2('Using your stream') ?>
<p>
    Using a custom stream class is straight-forward: instanciate it, and pass it to the <code>loadFromStream</code> (or <code>openFromStream</code>)
    function of the object that you want to load.
</p>
<pre><code class="cpp">FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
</code></pre>

<?php h2('Common mistakes') ?>
<p>
    Some resource classes are not loaded completely after <code>loadFromStream</code> has been called. Instead, they continue to read from their
    data source as long as they are used. This is the case for <?php class_link("Music") ?>, which streams audio samples as they are played, and for
    <?php class_link("Font") ?>, which loads glyphs on the fly depending on the texts content.
</p>
<p>
    As a consequence, the stream instance that you used to load a music or a font, as well as its data source, must remain alive as long as the resource
    uses it. If it is destroyed while still being used, the behaviour is undefined (can be a crash, corrupt data, or nothing visible).
</p>
<p>
    Another common mistake is to return whatever the internal functions return directly, but sometimes it doesn't match what SFML expects.
    For example, in the FileStream example above, one might be tempted to write the <code>seek</code> function as follows:
</p>
<pre><code class="cpp">sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}</code></pre>
<p>
    This code is wrong, because <code>std::fseek</code> returns zero on success, whereas SFML expects the new position to be returned.
</p>

<?php

    require("footer.php");

?>
