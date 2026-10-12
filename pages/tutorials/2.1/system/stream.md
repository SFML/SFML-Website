# User data streams

!!! warning ""

    You're reading the tutorial for SFML 2.1. Check out the [latest version of this tutorial](/tutorials/latest/system/stream/).

## Introduction

SFML has several resource classes: images, fonts, sounds, etc. In most programs, these resources will be loaded from files, with the help of their `loadFromFile` function. In a few other situations, resources will be packed directly into the executable or in a big data file, and loaded from memory with `loadFromMemory`. These functions cover *almost* all the possible use cases -- but not all.

Sometimes you want to load files from unusual places, such as a compressed/encrypted archive, or a remote network location for example. For these special situations, SFML provides a third loading function: `loadFromStream`. This function reads data using an abstract [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.1/classsf_1_1InputStream.php "sf::InputStream documentation") interface, which allows you to provide your own implementation of a stream class that works with SFML.

In this tutorial you'll learn how to write and use your own derived input stream.

## And standard streams?

Like many other languages, C++ already has a class for input data streams: `std::istream`. In fact it has two: `std::istream` is only the front-end, the abstract interface to the custom data is `std::streambuf`.

Unfortunately, these classes are not very user friendly, and can become very complicated if you want to implement non-trivial stuff. The [Boost.Iostreams](http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html "Boost.Iostreams") library tries to provide a simpler interface to standard streams, but Boost is a big dependency and SFML cannot depend on it.

That's why SFML provides its own stream interface, which is hopefully a lot more *simple and fast*.

## InputStream

The [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.1/classsf_1_1InputStream.php "sf::InputStream documentation") class declares four virtual functions:

```cpp
class InputStream
{
public :

    virtual ~InputStream() {}

    virtual Int64 read(void* data, Int64 size) = 0;

    virtual Int64 seek(Int64 position) = 0;

    virtual Int64 tell() = 0;

    virtual Int64 getSize() = 0;
};
```

**read** must extract *size* bytes of data from the stream, and copy them to the supplied *data* address. It returns the number of bytes read, or -1 on error.

**seek** must change the current reading position in the stream. Its *position* argument is the absolute byte offset to jump to (so it is relative to the beginning of the data, not to the current position). It returns the new position, or -1 on error.

**tell** must return the current reading position (in bytes) in the stream, or -1 on error.

**getSize** must return the total size (in bytes) of the data which is contained in the stream, or -1 on error.

To create your own working stream, you must implement every one of these four functions according to their requirements.

## An example

Here is a complete and working implementation of a custom input stream. It's not very useful: It is simply a stream that reads data from a file, `FileStream`. It serves as a demonstration that helps you focus on how the code works, and not get lost in implementation details.

First, let's see its declaration:

```cpp
#include <SFML/System.hpp>
#include <string>
#include <cstdio>

class FileStream : public sf::InputStream
{
public :

    FileStream();

    ~FileStream();

    bool open(const std::string& filename);

    virtual sf::Int64 read(void* data, sf::Int64 size);

    virtual sf::Int64 seek(sf::Int64 position);

    virtual sf::Int64 tell();

    virtual sf::Int64 getSize();

private :

    std::FILE* m_file;
};
```

In this example we'll use the good old C file API, so we have a `std::FILE*` member. We also add a default constructor, a destructor, and a function to open the file.

Here is the implementation:

```cpp
FileStream::FileStream() :
m_file(NULL)
{
}

FileStream::~FileStream()
{
    if (m_file)
        std::fclose(m_file);
}

bool FileStream::open(const std::string& filename)
{
    if (m_file)
        std::fclose(m_file);

    m_file = std::fopen(filename.c_str(), "rb");

    return m_file != NULL;
}

sf::Int64 FileStream::read(void* data, sf::Int64 size)
{
    if (m_file)
        return std::fread(data, 1, static_cast<std::size_t>(size), m_file);
    else
        return -1;
}

sf::Int64 FileStream::seek(sf::Int64 position)
{
    if (m_file)
    {
        std::fseek(m_file, static_cast<std::size_t>(position), SEEK_SET);
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
}
```

Note that, as explained above, all functions return -1 on error.

Don't forget to check the forum and wiki. Chances are that another user already wrote a [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.1/classsf_1_1InputStream.php "sf::InputStream documentation") class that suits your needs. And if you write a new one and feel like it could be useful to other people as well, don't hesitate to share!

## Using your stream

Using a custom stream class is straight-forward: instanciate it, and pass it to the `loadFromStream` (or `openFromStream`) function of the object that you want to load.

```cpp
FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
```

## Common mistakes

Some resource classes are not loaded completely after `loadFromStream` has been called. Instead, they continue to read from their data source as long as they are used. This is the case for [`sf::Music`](https://www.sfml-dev.org/documentation/2.1/classsf_1_1Music.php "sf::Music documentation"), which streams audio samples as they are played, and for [`sf::Font`](https://www.sfml-dev.org/documentation/2.1/classsf_1_1Font.php "sf::Font documentation"), which loads glyphs on the fly depending on the text that is displayed.

As a consequence, the stream instance that you used to load a music or a font, as well as its data source, must remain alive as long as the resource uses it. If it is destroyed while still being used, the behaviour is undefined (can be a crash, corrupt data, or nothing visible).

Another common mistake is to return whatever the internal functions return directly, but sometimes it doesn't match what SFML expects. For example, in the FileStream example above, one might be tempted to write the `seek` function as follows:

```cpp
sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}
```

This code is wrong, because `std::fseek` returns zero on success, whereas SFML expects the new position to be returned.
