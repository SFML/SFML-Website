<?php

    $title = "Playing a sound";
    $page = "audio-sound.php";

    require("header.php");
?>

<h1>Playing a sound</h1>

<?php h2('Introduction') ?>
<p>
    Playing a sound is the easiest task of the SFML audio package. However it involves two entities : the sound data,
    and the sound instance. In fact it acts exactly like images and sprites in the graphics package.
</p>

<?php h2('The sound buffer') ?>
<p>
    In audio programming, a sound data is defined by an array of samples. A sample is a numeric value, usually a 16 bits
    signed integer, representing the sound amplitude at a given time. The sound is then restituted by playing these samples
    at a high rate (CD use a rate of 44100 samples per second). The higher the sample rate, the better the sound quality.
    A sound is also defined by a number of channels. One channel is a mono sound, two channels is a stereo sound.
    More complex sounds can be composed of up to 8 channels, for dolby formats (4.1, 5.1, 7.1, etc.).
</p>
<p>
    Before using any class of the SFML audio package, you have to include its header :
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
</code></pre>
<p>
    As usual, it includes all the headers of the audio classes, as well as the headers of the other modules it needs.
</p>
<p>
    In SFML, the class that holds audio samples is <?php class_link("SoundBuffer")?>. You can fill it with samples in memory :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromSamples(Samples, 5000, 2, 44100))
{
    // Error...
}
</code></pre>
<p>
    The first parameter is a pointer to the sample array in memory. Elements must be 16 bits signed integers. The second
    parameter, 5000, is the number of samples. The third one is the number of channels (here we have a stereo sound), and
    the last one is the sample rate.
</p>
<p>
    If anything went wrong, this function returns <code>false</code>.
</p>
<p>
    More useful : a sound buffer can be loaded from (and saved to) an audio file (the most common formats are supported).
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromFile("sound.wav"))
{
    // Error...
}
</code></pre>
<p>
    You can as well load a sound file directly from memory, with a pointer to the file and its size in bytes :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromMemory(FilePtr, Size))
{
    // Error...
}
</code></pre>
<p>
    The sample rate and the number of channels are loaded automatically from the file. You can get them by
    calling these functions :
</p>
<pre><code class="cpp">unsigned int SampleRate = Buffer.GetSampleRate();
unsigned int Channels   = Buffer.GetChannelsCount();
</code></pre>
<p>
    You can also get the sound duration (in seconds), which is simply deduced from the sample rate and the sample count :
</p>
<pre><code class="cpp">float Duration = Buffer.GetDuration();
</code></pre>
<p>
    Finally, if you need to do some processing to the audio data, you can access the sample array directly :
</p>
<pre><code class="cpp">const sf::Int16* Samples = Buffer.GetSamples();
std::size_t Count = Buffer.GetSamplesCount();
</code></pre>
<p>
    That's all you need to know about sound buffers. Most of the time, you will only use the <code>LoadFromFile</code>
    function to load sounds from your audio files.
</p>
<?php h2('The sound instance') ?>
<p>
    Once you have loaded a sound buffer, you can use <?php class_link("Sound")?> to play it. An <?php class_link("Sound")?> instance is
    a way to play a sound buffer in the "scene", with additionnal settings like the pitch, the volume, the position, ...
    So you can have several <?php class_link("Sound")?> instances that play the same <?php class_link("SoundBuffer")?> at the same
    time, with different parameters.
</p>
<p>
    To bind a buffer to a sound, just call its <code>SetBuffer</code> function :
</p>
<pre><code class="cpp">sf::Sound Sound;
Sound.SetBuffer(Buffer); // Buffer is a sf::SoundBuffer
</code></pre>
<p>
    Then you can set or get the sound parameters with its accessors :
</p>
<pre><code class="cpp">Sound.SetLoop(true);
Sound.SetPitch(1.5f);
Sound.SetVolume(75.f);
</code></pre>
<pre><code class="cpp">bool  Loop   = Sound.GetLoop();
float Pitch  = Sound.GetPitch();
float Volume = Sound.GetVolume();
</code></pre>
<p>
    <code>SetLoop</code> tells if the sound will play in loop or just once.<br/>
    <code>SetPitch</code> changes the fundamental frequency of the sound : the higher the pitch, the more acute the sound.
    1 is the default value.<br/>
    <code>SetVolume</code> sets the volume of the sound. The volume ranges from 0 to 100, 100 is the default value.
    You can set it to a value higher than 100, but the effect is not guaranteed and depends on your system.<br/>
</p>
<p>
    You can play / pause / stop a sound :
</p>
<pre><code class="cpp">Sound.Play();
Sound.Pause();
Sound.Play(); // To resume after a call to Pause()
Sound.Stop();
</code></pre>
<p>
    You can get the sound status :
</p>
<pre><code class="cpp">sf::Sound::Status Status = Sound.GetStatus();
</code></pre>
<p>
    A sound can be <code>Playing</code>, <code>Paused</code> or <code>Stopped</code>.
</p>
<p>
    It is also possible to get the current playing position, in seconds :
</p>
<pre><code class="cpp">float Position = Sound.GetPlayingOffset();
</code></pre>
<p>
    As usual, no cleanup is needed : all audio classes will free their resources automatically.
</p>

<?php h2('Sound buffers and sounds management') ?>
<p>
    You have to be particularly careful when manipulating sound buffers. A <?php class_link("SoundBuffer")?>
    instance is a resource which is slow to load, heavy to copy and uses a lot of memory.
</p>
<p>
    For a good discussion about resource management, I suggest you read the <strong>"Images and sprites management"</strong>
    part of the <a class="internal" href="./graphics-sprite.php" title="Sprites tutorial">sprites tutorial</a>, just
    replacing the word "Image" with "SoundBuffer" and "Sprite" with "Sound".
</p>

<?php h2('Conclusion') ?>
<p>
    Now that you can play sounds, let's have a look at how to
    <a class="internal" href="./audio-music.php" title="Go to the next tutorial">play musics</a>.
</p>

<?php

    require("footer.php");

?>
