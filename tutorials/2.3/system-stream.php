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
    Sometimes you want to load files from unusual places, such as a compressed/encrypted archive, or a remote network location for example. For these
    special situations, SFML provides a third loading function: <code>loadFromStream</code>. This function reads data using an abstract
    <?php class_link("InputStream") ?> interface, which allows you to provide your own implementation of a stream class that works with SFML.
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
    Unfortunately, these classes are not very user friendly, and can become very complicated if you want to implement non-trivial stuff.
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
    <strong>read</strong> must extract <em>size</em> bytes of data from the stream, and copy them to the supplied <em>data</em> address. It returns
    the number of bytes read, or -1 on error.
</p>
<p>
    <strong>seek</strong> must change the current reading position in the stream. Its <em>position</em> argument is the absolute byte offset to
    jump to (so it is relative to the beginning of the data, not to the current position). It returns the new position, or -1 on error.
</p>
<p>
    <strong>tell</strong> must return the current reading position (in bytes) in the stream, or -1 on error.
</p>
<p>
    <strong>getSize</strong> must return the total size (in bytes) of the data which is contained in the stream, or -1 on error.
</p>
<p>
    To create your own working stream, you must implement every one of these four functions according to their requirements.
</p>

<?php h2('FileInputStream and MemoryInputStream') ?>
<p>
    Starting with SFML 2.3 two new classes have been created to provide streams for the new internal audio management. <code>sf::FileInputStream</code>
    provides the read-only data stream of a file, while <code>sf::MemoryInputStream</code> serves the read-only stream from memory. Both are derived
    from <code>sf::InputStream</code> and can thus be used polymorphic.
</p>

<?php h2('Using an InputStream') ?>
<p>
    Using a custom stream class is straight-forward: instantiate it, and pass it to the <code>loadFromStream</code> (or <code>openFromStream</code>)
    function of the object that you want to load.
</p>
<pre><code class="cpp">sf::FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
</code></pre>

<?php h2('Examples') ?>
<p>
    If you need a demonstration that helps you focus on how the code works, and not get lost in implementation details, you could take a look at the
    implementation of <code>sf::FileInputStream</code> or <code>sf::MemoryInputStream</code>.
</p>
<p>
    Don't forget to check the forum and wiki. Chances are that another user already wrote a <?php class_link("InputStream") ?> class that suits your
    needs. And if you write a new one and feel like it could be useful to other people as well, don't hesitate to share!
</p>

<?php h2('Common mistakes') ?>
<p>
    Some resource classes are not loaded completely after <code>loadFromStream</code> has been called. Instead, they continue to read from their
    data source as long as they are used. This is the case for <?php class_link("Music") ?>, which streams audio samples as they are played, and for
    <?php class_link("Font") ?>, which loads glyphs on the fly depending on the text that is displayed.
</p>
<p>
    As a consequence, the stream instance that you used to load a music or a font, as well as its data source, must remain alive as long as the resource
    uses it. If it is destroyed while still being used, it results in undefined behavior (can be a crash, corrupt data, or nothing visible).
</p>
<p>
    Another common mistake is to return whatever the internal functions return directly, but sometimes it doesn't match what SFML expects.
    For example, in the <code>sf::FileInputStream</code> code, one might be tempted to write the <code>seek</code> function as follows:
</p>
<pre><code class="cpp">sf::Int64 FileInputStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}</code></pre>
<p>
    This code is wrong, because <code>std::fseek</code> returns zero on success, whereas SFML expects the new position to be returned.
</p>

<?php

    require("footer.php");

?>
