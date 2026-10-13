# Playing a music

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/audio/sounds/).

## Introduction

You may ask, "what's the difference between a music and a sound ?". Well, a music is just a longer sound. But it makes a big difference in audio programming. The same difference that requires MP3 or OGG compression for your musics. As we've learnt in the previous tutorial, uncompressed sound data is made of samples, which are (in SFML) 16-bit signed integers. Take the standard sampling rate for CD quality (44100 samples per second), two channels, and you end up with 50 Mb in memory for no more than 5 minutes of music.

As a consequence, musics cannot be loaded in memory like sounds. That's why musics have their own class in SFML : [`sf::Music`](../../../documentation/1.6/classsf_1_1Music.html "sf::Music documentation").

## Using sf::Music

A music is never loaded completely in memory, it rather uses a smaller dynamic buffer which is updated regularly with sound data from the music file (yes, this is actually streaming -- more on this in the next tutorial).  
The internal buffer is defined to an appropriate size by default, but you can set it if you want (if your music has a very high sample rate, or if you have very few memory available) in the constructor :

```cpp
sf::Music Music1;        // By default, the internal buffer will hold 44100 samples
sf::Music Music2(96000); // The internal buffer will hold 96000 samples
```

To open the music file, you can use the `OpenFromFile` function :

```cpp
if (!Music.OpenFromFile("music.ogg"))
{
    // Error...
}
```

Or, if the sound file is already loaded in memory :

```cpp
if (!Music.OpenFromMemory(FilePtr, Size))
{
    // Error...
}
```

Don't forget to always check the returned value, which is `false` if the music couldn't be opened.

The call to `OpenFromFile` or `OpenFromMemory` actually doesn't start the music, only a call to `Play` does.

[`sf::Music`](../../../documentation/1.6/classsf_1_1Music.html "sf::Music documentation") differs from [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") in its behavior, but it still represents a sound. So it defines the same accessors as both [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") and [`sf::SoundBuffer`](../../../documentation/1.6/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation") :

```cpp
unsigned int      SampleRate    = Music.GetSampleRate();
unsigned int      ChannelsCount = Music.GetChannelsCount();
sf::Music::Status Status        = Music.GetStatus();
bool              Loop          = Music.GetLoop();
float             Pitch         = Music.GetPitch();
float             Volume        = Music.GetVolume();
float             Duration      = Music.GetDuration();
float             Offset        = Music.GetPlayingOffset();
```

Only the samples array cannot be accessed, because it is never loaded completely in memory (but you can still load it with a [`sf::SoundBuffer`](../../../documentation/1.6/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation") if you really need it).

Finally, you can still play / pause / stop a music :

```cpp
Music.Play();
Music.Pause();
Music.Stop();
```

## Conclusion

[`sf::Music`](../../../documentation/1.6/classsf_1_1Music.html "sf::Music documentation") doesn't differ much from [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation"). The key here is to make a difference between short punctual sounds (like footsteps or gun shots) and longer ones (background musics), and use the appropriate class in each case.

In the next tutorial, we'll learn how to [use audio streams](streams.md "Aller au tutoriel suivant") to play audio data from the network, from big files (this is actually what [`sf::Music`](../../../documentation/1.6/classsf_1_1Music.html "sf::Music documentation") does), or any source that cannot be loaded completely in memory.
