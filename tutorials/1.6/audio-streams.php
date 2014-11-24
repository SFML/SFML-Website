<?php

    $title = "Using streams";
    $page = "audio-streams.php";

    require("header.php");
?>

<h1>Using streams</h1>

<?php h2('Introduction') ?>
<p>
    Sometimes, audio data cannot be integrally loaded in memory. For example, the sound can be aquired from the network,
    or on the fly from a file that is too big. In such cases, you must be able to play the sound while you load it, and still give the
    illusion that you play it in one block. This is what is called "streaming".
</p>
<p>
    SFML provides a base class for implementing streaming from custom sources : <?php class_link("SoundStream")?>. It handles
    everything, the only task left to you is to provide it with new sound data when needed.
</p>

<?php h2('Basic usage') ?>
<p>
    <?php class_link("SoundStream")?>, like <?php class_link("Sound")?> and <?php class_link("Music")?>, is still a sound ; so it defines the
    usual accessors for the volume, the pitch, the sample rate, etc. It also defines the three control functions :
    play, pause and stop. There are just a few things that a stream cannot handle compared to a sound or a music :
    it cannot give you the duration (which cannot be known until the sound stops), it cannot loop, and you cannot
    get the current playing offset. But, if it can be added easily, you can add those missing features into your
    custom <?php class_link("SoundStream")?> class.
</p>

<?php h2('Defining a custom stream') ?>
<p>
    <?php class_link("SoundStream")?> is meant to be used as an abstract base class. So to create your own stream objects,
    you first have to create a child class :
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
    ...
};
</code></pre>
<p>
    Then, to customize the behavior of your stream, you have two virtual functions to override :
</p>
<ul>
    <li><code>OnStart</code>, which is called each time the stream restarts ; overriding it is optional, do it
    only if you have some specific stuff to do at initialization</li>
    <li><code>OnGetData</code>, which will be called each time the stream needs a new chunk of audio data to play</li>
</ul>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
    virtual bool OnStart()
    {
        // ...

        return true;
    }

    virtual bool OnGetData(Chunk&amp; Data)
    {
        // ...

        Data.Samples   = ...;
        Data.NbSamples = ...;

        return true;
    }
};
</code></pre>
<p>
    Both functions return a boolean, which means "is everything still ok ?". So if an error occures, or if there is no more
    data to play, you can return <code>false</code>. Returning <code>false</code> will immediately stop the stream.
</p>
<p>
    <code>OnGetData</code> gives you a <code>Chunk</code> instance to fill, with a pointer to the new audio data to play
    (<code>Data.Samples</code>) and the number of samples to play (<code>Data.NbSamples</code>). Audio samples, like
    anywhere in the SFML audio package, must be 16 bits signed integers.
</p>
<p>
    There is one more step to make your custom stream work : you must provide it with the sound parameters, ie. the
    number of channels and the sample rate. To do it, just call the <code>Initialize</code> function as soon as you know
    these parameters.
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
public :

    void SomeInitFunction()
    {
        unsigned int ChannelsCount = ...;
        unsigned int SampleRate    = ...;

        Initialize(ChannelsCount, SampleRate);
    }
};
</code></pre>
<p>
    As soon as <code>Initialize</code> has been called, your stream is ready to be played.
</p>
<p>
    Here is an example to illustrate the use of <?php class_link("SoundStream")?> : a custom class that streams audio data from
    a sound buffer loaded in memory. Yes, this is completely useless, but it will give you a clearer view of the
    <?php class_link("SoundStream")?> class.
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
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
    bool Open(const std::string&amp; Filename)
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
    virtual bool OnGetData(sf::SoundStream::Chunk&amp; Data)
    {
        // Check if there is enough data to stream
        if (myOffset + myBufferSize >= myBuffer.size())
        {
            // Returning false means that we want to stop playing the stream
            return false;
        }

        // Fill the stream chunk with a pointer to the audio data and the number of samples to stream
        Data.Samples   = &amp;myBuffer[myOffset];
        Data.NbSamples = myBufferSize;

        // Update the read offset
        myOffset += myBufferSize;

        return true;
    }

    ////////////////////////////////////////////////////////////
    // Member data
    ////////////////////////////////////////////////////////////
    std::vector&lt;sf::Int16&gt; myBuffer;     ///&lt; Internal buffer that holds audio samples
    std::size_t            myOffset;     ///&lt; Read offset in the sample array
    std::size_t            myBufferSize; ///&lt; Size of the audio data to stream
};
</code></pre>

<?php h2('Multi-threading') ?>
<p>
    To avoid blocking the application, audio streams use a secondary thread when you play them.
    As <code>OnGetData</code> will be called from this secondary thread, this means that the code you will put into it
    will be run in parallel of the main thread. It is important to keep this in mind, because you may have to
    take care of synchronization issues if you share data between both threads.
</p>
<p>
    Imagine that you stream audio from the network. Audio samples will be played while the next ones are received.
    So, the main thread will feed the sample array with audio data coming from the network, while the
    secondary thread will read from the sample array to feed the stream. As reading/writing from/to the sample
    array happen in two separate threads, they can occur at the same time, which can lead to undefined behaviors.
    In this case, we can easily protect the sample array with a mutex, and avoid concurrent access.<br/>
    To know more about threads and mutexes, you can have a look at the
    <a class="internal" href="./system-threads.php" title="Thread and mutex tutorial">corresponding tutorial</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    <?php class_link("SoundStream")?> provides a simple interface for streaming audio data from any source. Always keep in
    mind that it runs in a secondary thread, and take care of synchronization issues.
</p>
<p>
    The next tutorial will show you how to
    <a class="internal" href="./audio-capture.php" title="Go to the next tutorial">capture audio data</a>.
</p>

<?php

    require("footer.php");

?>
