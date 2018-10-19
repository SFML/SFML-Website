<?php

    $title = "Playing sounds and music";
    $page = "audio-sounds.php";

    require("header.php");

?>

<h1>Playing sounds and music</h1>

<?php h2('Sound or music?') ?>
<p>
    SFML provides two classes for playing audio: <?php class_link("Sound")?> and <?php class_link("Music")?>. They both provide more or less the same
    features, the main difference is how they work.
</p>
<p>
    <?php class_link("Sound")?> is a lightweight object that plays loaded audio data from a <?php class_link("SoundBuffer")?>. It should be used for small
    sounds that can fit in memory and should suffer no lag when they are played. Examples are gun shots, foot steps, etc.
</p>
<p>
    <?php class_link("Music")?> doesn't load all the audio data into memory, instead it streams it on the fly from the source file. It is typically used to
    play compressed music that lasts several minutes, and would otherwise take many seconds to load and eat hundreds of MB in memory.
</p>

<?php h2('Loading and playing a sound') ?>
<p>
    As mentioned above, the sound data is not stored directly in <?php class_link("Sound")?> but in a separate class named <?php class_link("SoundBuffer")?>.
    This class encapsulates the audio data, which is basically an array of 16-bit signed integers (called "audio samples"). A sample is the amplitude of
    the sound signal at a given point in time, and an array of samples therefore represents a full sound.
</p>

<p class="important">
    In fact, the <?php class_link("Sound")?>/<?php class_link("SoundBuffer")?> classes work the same way as
    <?php class_link("Sprite")?>/<?php class_link("Texture")?> from the graphics module. So if you understand how sprites and textures work together,
    you can apply the same concept to sounds and sound buffers.
</p>
<p>
    You can load a sound buffer from a file on disk with its <code>loadFromFile</code> function:
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;

int main()
{
    sf::SoundBuffer buffer;
    if (!buffer.loadFromFile("sound.wav"))
        return -1;

    ...

    return 0;
}
</code></pre>
<p>
    As with everything else, you can also load an audio file from memory (<code>loadFromMemory</code>) or from a
    <a class="internal" href="./system-stream.php" title="Input streams tutorial">custom input stream</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supports the audio file formats WAV, OGG/Vorbis and FLAC. Due to licensing issues MP3 is <strong>not</strong> supported.
</p>
<p>
    You can also load a sound buffer directly from an array of samples, in the case they originate from another source:
</p>
<pre><code class="cpp">std::vector&lt;sf::Int16&gt; samples = ...;
buffer.loadFromSamples(&amp;samples[0], samples.size(), 2, 44100);
</code></pre>
<p>
    Since <code>loadFromSamples</code> loads a raw array of samples rather than an audio file, it requires additional arguments in order to have a complete
    description of the sound. The first one (third argument) is the number of channels; 1 channel defines a mono sound, 2 channels define a stereo sound,
    etc. The second additional attribute (fourth argument) is the sample rate; it defines how many samples must be played per second in order to
    reconstruct the original sound.
</p>
<p>
    Now that the audio data is loaded, we can play it with a <?php class_link("Sound")?> instance.
</p>
<pre><code class="cpp">sf::SoundBuffer buffer;
// load something into the sound buffer...

sf::Sound sound;
sound.setBuffer(buffer);
sound.play();
</code></pre>
<p>
    The cool thing is that you can assign the same sound buffer to multiple sounds if you want. You can even play them together without any issues.
</p>
<p class="important">
    Sounds (and music) are played in a separate thread. This means that you are free to do whatever you want after calling <code>play()</code> (except destroying
    the sound or its data, of course), the sound will continue to play until it's finished or explicitly stopped.
</p>

<?php h2('Playing a music') ?>
<p>
    Unlike <?php class_link("Sound")?>, <?php class_link("Music")?> doesn't pre-load the audio data, instead it streams the data directly from the source. The
    initialization of music is thus more direct:
</p>
<pre><code class="cpp">sf::Music music;
if (!music.openFromFile("music.ogg"))
    return -1; // error
music.play();
</code></pre>
<p>
    It is important to note that, unlike all other SFML resources, the loading function is named <code>openFromFile</code> instead of <code>loadFromFile</code>.
    This is because the music is not really loaded, this function merely opens it. The data is only loaded later, when the music is played.
    It also helps to keep in mind that the audio file has to remain available as long as it is played.<br />
    The other loading functions of <?php class_link("Music")?> follow the same convention: <code>openFromMemory</code>, <code>openFromStream</code>.
</p>

<?php h2('What\'s next?') ?>
<p>
    Now that you are able to load and play a sound or music, let's see what you can do with it.
</p>
<p>
    To control playback, the following functions are available:
</p>
<ul>
    <li><code>play</code> starts or resumes playback</li>
    <li><code>pause</code> pauses playback</li>
    <li><code>stop</code> stops playback and rewind</li>
    <li><code>setPlayingOffset</code> changes the current playing position</li>
</ul>
<p>
    Example:
</p>
<pre><code class="cpp">// start playback
sound.play();

// advance to 2 seconds
sound.setPlayingOffset(sf::seconds(2.f));

// pause playback
sound.pause();

// resume playback
sound.play();

// stop playback and rewind
sound.stop();
</code></pre>
<p>
    The <code>getStatus</code> function returns the current status of a sound or music, you can use it to know whether it is stopped, playing or paused.
</p>
<p>
    Sound and music playback is also controlled by a few attributes which can be changed at any moment.
</p>
    The <em>pitch</em> is a factor that changes the perceived frequency of the sound: greater than 1 plays the sound at a higher pitch,
    less than 1 plays the sound at a lower pitch, and 1 leaves it unchanged. Changing the pitch has a side effect: it impacts the playing speed.
</p>
<pre><code class="cpp">sound.setPitch(1.2f);
</code></pre>
<p>
    The <em>volume</em> is... the volume. The value ranges from 0 (mute) to 100 (full volume). The default value is 100, which
    means that you can't make a sound louder than its initial volume.
</p>
<pre><code class="cpp">sound.setVolume(50.f);
</code></pre>
</p>
    The <em>loop</em> attribute controls whether the sound/music automatically loops or not. If it loops, it will restart playing from the beginning when it's finished,
    again and again until you explicitly call <code>stop</code>. If not set to loop, it will stop automatically when it's finished.
</p>
<pre><code class="cpp">sound.setLoop(true);
</code></pre>
<p>
    More attributes are available, but they are related to spatialization and are explained in the
    <a class="internal" href="./audio-spatialization.php" title="Spatialization tutorial">corresponding tutorial</a>.
</p>

<?php h2('Common mistakes') ?>

<h3>Destroyed sound buffer</h3>
<p>
    The most common mistake is to let a sound buffer go out of scope (and therefore be destroyed) while a sound still uses it.
</p>
<pre><code class="cpp">sf::Sound loadSound(std::string filename)
{
    sf::SoundBuffer buffer; // this buffer is local to the function, it will be destroyed...
    buffer.loadFromFile(filename);
    return sf::Sound(buffer);
} // ... here

sf::Sound sound = loadSound("s.wav");
sound.play(); // ERROR: the sound's buffer no longer exists, the behavior is undefined
</code></pre>
<p>
    Remember that a sound only keeps a <em>pointer</em> to the sound buffer that you give to it, it doesn't contain its own copy. You have to correctly
    manage the lifetime of your sound buffers so that they remain alive as long as they are used by sounds.
</p>

<h3>Too many sounds</h3>
<p>
    Another source of error is when you try to create a huge number of sounds. SFML internally has a limit; it can vary depending on the OS, but
    you should never exceed 256. This limit is the number of <?php class_link("Sound")?> and <?php class_link("Music")?> instances that can exist
    simultaneously. A good way to stay below the limit is to destroy (or recycle) unused sounds when they are no longer needed.
    This only applies if you have to manage a really large amount of sounds and music, of course.
</p>

<h3>Destroying the music source while it plays</h3>
<p>
    Remember that a music needs its source as long as it is played. A music file on your disk probably won't be
    deleted or moved while your application plays it, however things get more complicated when you play a music from a file in memory, or from a
    custom input stream:
</p>
<pre><code class="cpp">// we start with a music file in memory (imagine that we extracted it from a zip archive)
std::vector&lt;char&gt; fileData = ...;

// we play it
sf::Music music;
music.openFromMemory(&amp;fileData[0], fileData.size());
music.play();

// "ok, it seems that we don't need the source file any longer"
fileData.clear();

// ERROR: the music was still streaming the contents of fileData! The behavior is now undefined
</code></pre>

<h3>sf::Music is not copyable</h3>
<p>
    The final "mistake" is a reminder: the <?php class_link("Music")?> class is <em>not copyable</em>, so you won't be allowed to do that:
</p>
<pre><code class="cpp">sf::Music music;
sf::Music anotherMusic = music; // ERROR

void doSomething(sf::Music music)
{
    ...
}
sf::Music music;
doSomething(music); // ERROR (the function should take its argument by reference, not by value)
</code></pre>

<?php

    require("footer.php");

?>
