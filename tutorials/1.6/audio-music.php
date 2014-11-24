<?php

    $title = "Playing a music";
    $page = "audio-music.php";

    require("header.php");
?>

<h1>Playing a music</h1>

<?php h2('Introduction') ?>
<p>
    You may ask, "what's the difference between a music and a sound ?". Well, a music is just a longer sound. But it makes
    a big difference in audio programming. The same difference that requires MP3 or OGG compression for your musics.
    As we've learnt in the previous tutorial, uncompressed sound data is made of samples, which are (in SFML) 16 bits signed
    integers. Take the standard sampling rate for CD quality (44100 samples per second), two channels, and you end up
    with 50 Mb in memory for no more than 5 minutes of music.
</p>
<p>
    As a consequence, musics cannot be loaded in memory like sounds. That's why musics have their own class in SFML :
    <?php class_link("Music")?>.
</p>

<?php h2('Using sf::Music') ?>
<p>
    A music is never loaded completely in memory, it rather uses a smaller dynamic buffer which is updated regularly with
    sound data from the music file (yes, this is actually streaming -- more on this in the next tutorial).<br/>
    The internal buffer is defined to an appropriate size by default, but you can set it if you want (if your music
    has a very high sample rate, or if you have very few memory available) in the constructor :
</p>
<pre><code class="cpp">sf::Music Music1;        // By default, the internal buffer will hold 44100 samples
sf::Music Music2(96000); // The internal buffer will hold 96000 samples
</code></pre>
<p>
    To open the music file, you can use the <code>OpenFromFile</code> function :
</p>
<pre><code class="cpp">if (!Music.OpenFromFile("music.ogg"))
{
    // Error...
}
</code></pre>
<p>
    Or, if the sound file is already loaded in memory :
</p>
<pre><code class="cpp">if (!Music.OpenFromMemory(FilePtr, Size))
{
    // Error...
}
</code></pre>
<p>
    Don't forget to always check the returned value, which is <code>false</code> if the music couldn't be opened.
</p>
<p>
    The call to <code>OpenFromFile</code> or <code>OpenFromMemory</code> actually doesn't start the music, only a call to <code>Play</code> does.
</p>
<p>
    <?php class_link("Music")?> differs from <?php class_link("Sound")?> in its behavior, but it still represents a sound. So it defines
    the same accessors as both <?php class_link("Sound")?> and <?php class_link("SoundBuffer")?> :
</p>
<pre><code class="cpp">unsigned int      SampleRate    = Music.GetSampleRate();
unsigned int      ChannelsCount = Music.GetChannelsCount();
sf::Music::Status Status        = Music.GetStatus();
bool              Loop          = Music.GetLoop();
float             Pitch         = Music.GetPitch();
float             Volume        = Music.GetVolume();
float             Duration      = Music.GetDuration();
float             Offset        = Music.GetPlayingOffset();
</code></pre>
<p>
    Only the samples array cannot be accessed, because it is never loaded completely in memory (but you can still load it
    with a <?php class_link("SoundBuffer")?> if you really need it).
</p>
<p>
    Finally, you can still play / pause / stop a music :
</p>
<pre><code class="cpp">Music.Play();
Music.Pause();
Music.Stop();
</code></pre>

<?php h2('Conclusion') ?>
<p>
    <?php class_link("Music")?> doesn't differ much from <?php class_link("Sound")?>. The key here is to make a difference between
    short punctual sounds (like footsteps or gun shots) and longer ones (background musics), and use the appropriate
    class in each case.
</p>
<p>
    In the next tutorial, we'll learn how to
    <a class="internal" href="./audio-streams.php" title="Aller au tutoriel suivant">use audio streams</a>
    to play audio data from the network, from big files (this is actually what <?php class_link("Music")?> does),
    or any source that cannot be loaded completely in memory.
</p>

<?php

    require("footer.php");

?>
