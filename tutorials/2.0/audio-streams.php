<?php

    $title = "Custom audio streams";
    $page = "audio-streams.php";

    require("header.php");

?>

<h1>Custom audio streams</h1>

<?php h2('Audio stream? What\'s that?') ?>
<p>
    An audio stream is similar to music (remember the <?php class_link("Music") ?> class?). It has almost the same functions and behaves the same.
    The only difference is that an audio stream doesn't play an audio file: Instead, it plays a custom audio source that <em>you</em> directly provide.
    In other words, defining your own audio stream allows you to play from more than just a file: A sound streamed over the network, music generated
    by your program, an audio format that SFML doesn't support, etc.
</p>
<p>
    In fact, the <?php class_link("Music") ?> class is just a specialized audio stream that gets its audio samples from a file.
</p>
<p>
    Since we're talking about <em>streaming</em>, we'll deal with audio data that cannot be loaded entirely in memory, and will instead be loaded in
    small chunks while it is being played. If your sound can be loaded completely and can fit in memory, then audio streams won't help you: Just load
    the audio data into a <?php class_link("SoundBuffer") ?> and use a regular <?php class_link("Sound") ?> to play it.
</p>

<?php h2('sf::SoundStream') ?>
<p>
    In order to define your own audio stream, you need to inherit from the <?php class_link("SoundStream") ?> abstract base class. There are two
    virtual functions to override in your derived class: <code>onGetData</code> and <code>onSeek</code>.
</p>
<pre><code class="cpp">class MyAudioStream : public sf::SoundStream
{
    virtual bool onGetData(Chunk&amp; data);

    virtual void onSeek(sf::Time timeOffset);
};
</code></pre>
<p>
    <code>onGetData</code> is called by the base class whenever it runs out of audio samples and needs more of them. You must provide new audio samples
    by filling the <code>data</code> argument:
</p>
<pre><code class="cpp">bool MyAudioStream::onGetData(Chunk&amp; data)
{
    data.samples = /* put the pointer to the new audio samples */;
    data.sampleCount = /* put the number of audio samples available in the new chunk */;
    return true;
}
</code></pre>
<p>
    You must return <code>true</code> when everything is all right, or <code>false</code> if playback must be stopped, either because an error has occurred or because
    there's simply no more audio data to play.
</p>
<p>
    SFML makes an internal copy of the audio samples as soon as <code>onGetData</code> returns, so you don't have to keep the original data alive if you
    don't want to.
</p>
<p>
    The <code>onSeek</code> function is called when the <code>setPlayingOffset</code> public function is called. Its purpose is to change the current
    playing position in the source data. The parameter is a time value representing the new position, from the beginning of the sound (<em>not</em> from
    the current position). This function is sometimes impossible to implement. In those cases leave it empty, and tell the users of your class that
    changing the playing position is not supported.
</p>
<p>
    Now your class is almost ready to work. The only thing that <?php class_link("SoundStream") ?> needs to know now is the channel count and sample rate
    of your stream, so that it can be played as expected. To let the base class know about these parameters, you must call the <code>initialize</code>
    protected function as soon as they are known in your stream class (which is most likely when the stream is loaded/initialized).
</p>
<pre><code class="cpp">// where this is done totally depends on how your stream class is designed
unsigned int channelCount = ...;
unsigned int sampleRate = ...;
initialize(channelCount, sampleRate);
</code></pre>

<?php h2('Threading issues') ?>
<p>
    Audio streams are always played in a separate thread, therefore it is important to know what happens exactly, and where.
</p>
<p>
    <code>onSeek</code> is called directly by the <code>setPlayingOffset</code> function, so it is always executed in the caller thread. However, the
    <code>onGetData</code> function will be called repeatedly as long as the stream is being played, in a separate thread created by SFML.
    If your stream uses data that may be accessed <em>concurrently</em> in both the caller thread and in the playing thread, you have to protect
    it (with a mutex for example) in order to avoid concurrent access, which may cause undefined behavior -- corrupt data being played, crashes, etc.
</p>
<p>
    If you're not familiar enough with threading, you can refer to the
    <a class="internal" href="./system-thread.php" title="Threading tutorial">corresponding tutorial</a> for more information.
</p>

<?php h2('Using your audio stream') ?>
<p>
    Now that you have defined your own audio stream class, let's see how to use it. In fact, things are very similar to what's shown in the
    <a class="internal" href="./audio-sounds.php" title="Playing sounds and musics">tutorial about sf::Music</a>. You can control playback with the
    <code>play</code>, <code>pause</code>, <code>stop</code> and <code>setPlayingOffset</code> functions. You can also play with the sound's properties,
    such as the volume or the pitch. You can refer to the API documentation or to the other audio tutorials for more details.
</p>

<?php h2('A simple example') ?>
<p>
    Here is a very simple example of a custom audio stream class which plays the data of a sound buffer. Such a class might seem totally useless,
    but the point here is to focus on how the data is streamed by the class, regardless of where it comes from.
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
#include &lt;vector&gt;

// custom audio stream that plays a loaded buffer
class MyStream : public sf::SoundStream
{
public:

    void load(const sf::SoundBuffer&amp; buffer)
    {
        // extract the audio samples from the sound buffer to our own container
        m_samples.assign(buffer.getSamples(), buffer.getSamples() + buffer.getSampleCount());

        // reset the current playing position 
        m_currentSample = 0;

        // initialize the base class
        initialize(buffer.getChannelCount(), buffer.getSampleRate());
    }

private:

    virtual bool onGetData(Chunk&amp; data)
    {
        // number of samples to stream every time the function is called;
        // in a more robust implementation, it should be a fixed
        // amount of time rather than an arbitrary number of samples
        const int samplesToStream = 50000;

        // set the pointer to the next audio samples to be played
        data.samples = &amp;m_samples[m_currentSample];

        // have we reached the end of the sound?
        if (m_currentSample + samplesToStream &lt;= m_samples.size())
        {
            // end not reached: stream the samples and continue
            data.sampleCount = samplesToStream;
            m_currentSample += samplesToStream;
            return true;
        }
        else
        {
            // end of stream reached: stream the remaining samples and stop playback
            data.sampleCount = m_samples.size() - m_currentSample;
            m_currentSample = m_samples.size();
            return false;
        }
    }

    virtual void onSeek(sf::Time timeOffset)
    {
        // compute the corresponding sample index according to the sample rate and channel count
        m_currentSample = static_cast&lt;std::size_t&gt;(timeOffset.asSeconds() * getSampleRate() * getChannelCount());
    }

    std::vector&lt;sf::Int16&gt; m_samples;
    std::size_t m_currentSample;
};

int main()
{
    // load an audio buffer from a sound file
    sf::SoundBuffer buffer;
    buffer.loadFromFile("sound.wav");

    // initialize and play our custom stream
    MyStream stream;
    stream.load(buffer);
    stream.play();

    // let it play until it is finished
    while (stream.getStatus() == MyStream::Playing)
        sf::sleep(sf::seconds(0.1f));

    return 0;
}
</code></pre>

<?php

    require("footer.php");

?>
