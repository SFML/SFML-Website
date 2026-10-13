# Using streams

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/audio/streams/).

## Introduction

Sometimes, audio data cannot be integrally loaded in memory. For example, the sound can be aquired from the network, or on the fly from a file that is too big. In such cases, you must be able to play the sound while you load it, and still give the illusion that you play it in one block. This is what is called "streaming".

SFML provides a base class for implementing streaming from custom sources : [`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation"). It handles everything, the only task left to you is to provide it with new sound data when needed.

## Basic usage

[`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation"), like [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") and [`sf::Music`](../../../documentation/1.6/classsf_1_1Music.html "sf::Music documentation"), is still a sound ; so it defines the usual accessors for the volume, the pitch, the sample rate, etc. It also defines the three control functions : play, pause and stop. There are just a few things that a stream cannot handle compared to a sound or a music : it cannot give you the duration (which cannot be known until the sound stops), it cannot loop, and you cannot get the current playing offset. But, if it can be added easily, you can add those missing features into your custom [`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation") class.

## Defining a custom stream

[`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation") is meant to be used as an abstract base class. So to create your own stream objects, you first have to create a child class :

```cpp
class MyCustomStream : public sf::SoundStream
{
    ...
};
```

Then, to customize the behavior of your stream, you have two virtual functions to override :

- `OnStart`, which is called each time the stream restarts ; overriding it is optional, do it only if you have some specific stuff to do at initialization
- `OnGetData`, which will be called each time the stream needs a new chunk of audio data to play

```cpp
class MyCustomStream : public sf::SoundStream
{
    virtual bool OnStart()
    {
        // ...

        return true;
    }

    virtual bool OnGetData(Chunk& Data)
    {
        // ...

        Data.Samples   = ...;
        Data.NbSamples = ...;

        return true;
    }
};
```

Both functions return a boolean, which means "is everything still ok ?". So if an error occures, or if there is no more data to play, you can return `false`. Returning `false` will immediately stop the stream.

`OnGetData` gives you a `Chunk` instance to fill, with a pointer to the new audio data to play (`Data.Samples`) and the number of samples to play (`Data.NbSamples`). Audio samples, like anywhere in the SFML audio package, must be 16-bit signed integers.

There is one more step to make your custom stream work : you must provide it with the sound parameters, ie. the number of channels and the sample rate. To do it, just call the `Initialize` function as soon as you know these parameters.

```cpp
class MyCustomStream : public sf::SoundStream
{
public :

    void SomeInitFunction()
    {
        unsigned int ChannelsCount = ...;
        unsigned int SampleRate    = ...;

        Initialize(ChannelsCount, SampleRate);
    }
};
```

As soon as `Initialize` has been called, your stream is ready to be played.

Here is an example to illustrate the use of [`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation") : a custom class that streams audio data from a sound buffer loaded in memory. Yes, this is completely useless, but it will give you a clearer view of the [`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation") class.

```cpp
class MyCustomStream : public sf::SoundStream
{
public :

    ////////////////////////////////////////////////////////////
    /// Constructor
    ////////////////////////////////////////////////////////////
    MyCustomStream(std::size_t BufferSize) :
    myOffset    (0),
    myBufferSize(BufferSize)
    {

    }

    ////////////////////////////////////////////////////////////
    /// Load sound data from a file
    ////////////////////////////////////////////////////////////
    bool Open(const std::string& Filename)
    {
        // Load the sound data into a sound buffer
        sf::SoundBuffer SoundData;
        if (SoundData.LoadFromFile(Filename))
        {
            // Initialize the stream with the sound parameters
            Initialize(SoundData.GetChannelsCount(), SoundData.GetSampleRate());

            // Copy the audio samples into our internal array
            const sf::Int16* Data = SoundData.GetSamples();
            myBuffer.assign(Data, Data + SoundData.GetSamplesCount());

            return true;
        }

        return false;
    }

private :

    ////////////////////////////////////////////////////////////
    /// /see sfSoundStream::OnStart
    ////////////////////////////////////////////////////////////
    virtual bool OnStart()
    {
        // Reset the read offset
        myOffset = 0;

        return true;
    }

    ////////////////////////////////////////////////////////////
    /// /see sfSoundStream::OnGetData
    ////////////////////////////////////////////////////////////
    virtual bool OnGetData(sf::SoundStream::Chunk& Data)
    {
        // Check if there is enough data to stream
        if (myOffset + myBufferSize >= myBuffer.size())
        {
            // Returning false means that we want to stop playing the stream
            return false;
        }

        // Fill the stream chunk with a pointer to the audio data and the number of samples to stream
        Data.Samples   = &myBuffer[myOffset];
        Data.NbSamples = myBufferSize;

        // Update the read offset
        myOffset += myBufferSize;

        return true;
    }

    ////////////////////////////////////////////////////////////
    // Member data
    ////////////////////////////////////////////////////////////
    std::vector<sf::Int16> myBuffer;     ///< Internal buffer that holds audio samples
    std::size_t            myOffset;     ///< Read offset in the sample array
    std::size_t            myBufferSize; ///< Size of the audio data to stream
};
```

## Multi-threading

To avoid blocking the application, audio streams use a secondary thread when you play them. As `OnGetData` will be called from this secondary thread, this means that the code you will put into it will be run in parallel of the main thread. It is important to keep this in mind, because you may have to take care of synchronization issues if you share data between both threads.

Imagine that you stream audio from the network. Audio samples will be played while the next ones are received. So, the main thread will feed the sample array with audio data coming from the network, while the secondary thread will read from the sample array to feed the stream. As reading/writing from/to the sample array happen in two separate threads, they can occur at the same time, which can lead to undefined behaviors. In this case, we can easily protect the sample array with a mutex, and avoid concurrent access.  
To know more about threads and mutexes, you can have a look at the [corresponding tutorial](../system/threads.md "Thread and mutex tutorial").

## Conclusion

[`sf::SoundStream`](../../../documentation/1.6/classsf_1_1SoundStream.html "sf::SoundStream documentation") provides a simple interface for streaming audio data from any source. Always keep in mind that it runs in a secondary thread, and take care of synchronization issues.

The next tutorial will show you how to [capture audio data](capture.md "Go to the next tutorial").
