# User data streams

## Introduction

SFML has several resource classes: images, fonts, sounds, etc.
In most programs, these resources will be loaded from files with the help of their `{load|open}FromFile` function or corresponding constructor.
In a few other situations, resources will be packed directly into the executable or in a big data file and loaded from memory with `{load|open}FromMemory`.
These functions cover _almost_ all the possible use cases -- but not all.

Sometimes you want to load files from unusual places, such as a compressed/encrypted archive, or a remote network location for example.
For these special situations, SFML provides a third loading option: `loadFromStream` or `openFromStream`.
This function reads data using an abstract [`sf::InputStream`](../../../documentation/3.0.0/classsf_1_1InputStream.html "sf::InputStream documentation") interface, which allows you to provide your own implementation of a stream class that works with SFML.

In this tutorial you'll learn how to write and use your own derived input stream.

## And standard streams?

Like many other languages, C++ already has a class for input data streams: `std::istream`.
In fact it has two.
`std::istream` is only the front-end.
The abstract interface to the custom data is `std::streambuf`.

Unfortunately, these classes are not very user friendly and can become very complicated if you want to implement non-trivial stuff.
The [Boost.Iostreams](http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html "Boost.Iostreams") library tries to provide a simpler interface to standard streams, but Boost is a big dependency and SFML cannot depend on it.

That's why SFML provides its own stream interface which is hopefully a lot more _simple and fast_.

## InputStream

The [`sf::InputStream`](../../../documentation/3.0.0/classsf_1_1InputStream.html "sf::InputStream documentation") class declares four virtual functions:

```cpp
class InputStream
{
public:
    virtual ~InputStream() = default;

    virtual std::optional<std::size_t> read(void* data, std::size_t size) = 0;

    virtual std::optional<std::size_t> seek(std::size_t position) = 0;

    virtual std::optional<std::size_t> tell() = 0;

    virtual std::optional<std::size_t> getSize() = 0;
};
```

**read** must extract _size_ bytes of data from the stream, and copy them to the supplied _data_ address.
It returns the number of bytes read, or `std::nullopt` on error.

**seek** must change the current reading position in the stream.
Its _position_ argument is the absolute byte offset to jump to (so it is relative to the beginning of the data, not to the current position).
It returns the new position, or `std::nullopt` on error.

**tell** must return the current reading position (in bytes) in the stream, or `std::nullopt` on error.

**getSize** must return the total size (in bytes) of the data which is contained in the stream, or `std::nullopt` on error.

To create your own working stream, you must implement every one of these four functions according to their requirements.

## FileInputStream and MemoryInputStream

Two classes exist to provide streams for the internal audio management.
`sf::FileInputStream` provides the read-only data stream of a file, while `sf::MemoryInputStream` serves the read-only stream from memory.
Both are derived from `sf::InputStream` and can thus be used polymorphically.

## Using an InputStream

Using a custom stream class is straightforward: instantiate it, and pass it to the constructor of the object that you want to load.

```cpp
sf::FileInputStream stream("image.png");
sf::Texture texture(stream);
```

## Examples

If you need a demonstration that helps you focus on how the code works, and not get lost in implementation details, you could take a look at the implementation of `sf::FileInputStream` or `sf::MemoryInputStream`.

Don't forget to check the forum and wiki.
Chances are that another user already wrote a [`sf::InputStream`](../../../documentation/3.0.0/classsf_1_1InputStream.html "sf::InputStream documentation") class that suits your needs.
And if you write a new one and feel like it could be useful to other people as well, don't hesitate to share!

## Common mistakes

Some resource classes are not loaded completely after `openFromStream` has been called.
Instead, they continue to read from their data source as long as they are used.
This is the case for [`sf::Music`](../../../documentation/3.0.0/classsf_1_1Music.html "sf::Music documentation"), which streams audio samples as they are played, and for [`sf::Font`](../../../documentation/3.0.0/classsf_1_1Font.html "sf::Font documentation"), which loads glyphs on the fly depending on the text that is displayed.

As a consequence, the stream instance that you used to load a music or a font, as well as its data source, must remain alive as long as the resource uses it.
If it is destroyed while still being used, it results in undefined behavior (can be a crash, corrupt data, or nothing visible).

Another common mistake is to return whatever the internal functions return directly, but sometimes it doesn't match what SFML expects.
For example, in the `sf::FileInputStream` code, one might be tempted to write the `seek` function as follows:

```cpp
std::optional<std::size_t> FileInputStream::seek(std::size_t position)
{
    return std::fseek(m_file, position, SEEK_SET);
}
```

This code is wrong, because `std::fseek` returns zero on success, whereas SFML expects the new position to be returned.
