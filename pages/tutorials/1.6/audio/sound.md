# Playing a sound

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/audio/sounds/).

## Introduction

Playing a sound is the easiest task of the SFML audio package. However it involves two entities : the sound data, and the sound instance. In fact it acts exactly like images and sprites in the graphics package.

## The sound buffer

In audio programming, a sound data is defined by an array of samples. A sample is a numeric value, usually a 16-bit signed integer, representing the sound amplitude at a given time. The sound is then restituted by playing these samples at a high rate (CD use a rate of 44100 samples per second). The higher the sample rate, the better the sound quality. A sound is also defined by a number of channels. One channel is a mono sound, two channels is a stereo sound. More complex sounds can be composed of up to 8 channels, for dolby formats (4.1, 5.1, 7.1, etc.).

Before using any class of the SFML audio package, you have to include its header :

```cpp
#include <SFML/Audio.hpp>
```

As usual, it includes all the headers of the audio classes, as well as the headers of the other modules it needs.

In SFML, the class that holds audio samples is [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation"). You can fill it with samples in memory :

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromSamples(Samples, 5000, 2, 44100))
{
    // Error...
}
```

The first parameter is a pointer to the sample array in memory. Elements must be 16-bit signed integers. The second parameter, 5000, is the number of samples. The third one is the number of channels (here we have a stereo sound), and the last one is the sample rate.

If anything went wrong, this function returns `false`.

More useful : a sound buffer can be loaded from (and saved to) an audio file (the most common formats are supported).

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromFile("sound.wav"))
{
    // Error...
}
```

You can as well load a sound file directly from memory, with a pointer to the file and its size in bytes :

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromMemory(FilePtr, Size))
{
    // Error...
}
```

The sample rate and the number of channels are loaded automatically from the file. You can get them by calling these functions :

```cpp
unsigned int SampleRate = Buffer.GetSampleRate();
unsigned int Channels   = Buffer.GetChannelsCount();
```

You can also get the sound duration (in seconds), which is simply deduced from the sample rate and the sample count :

```cpp
float Duration = Buffer.GetDuration();
```

Finally, if you need to do some processing to the audio data, you can access the sample array directly :

```cpp
const sf::Int16* Samples = Buffer.GetSamples();
std::size_t Count = Buffer.GetSamplesCount();
```

That's all you need to know about sound buffers. Most of the time, you will only use the `LoadFromFile` function to load sounds from your audio files.

## The sound instance

Once you have loaded a sound buffer, you can use [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Sound.php "sf::Sound documentation") to play it. An [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Sound.php "sf::Sound documentation") instance is a way to play a sound buffer in the "scene", with additionnal settings like the pitch, the volume, the position, ... So you can have several [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Sound.php "sf::Sound documentation") instances that play the same [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") at the same time, with different parameters.

To bind a buffer to a sound, just call its `SetBuffer` function :

```cpp
sf::Sound Sound;
Sound.SetBuffer(Buffer); // Buffer is a sf::SoundBuffer
```

Then you can set or get the sound parameters with its accessors :

```cpp
Sound.SetLoop(true);
Sound.SetPitch(1.5f);
Sound.SetVolume(75.f);
```

```cpp
bool  Loop   = Sound.GetLoop();
float Pitch  = Sound.GetPitch();
float Volume = Sound.GetVolume();
```

`SetLoop` tells if the sound will play in loop or just once.  
`SetPitch` changes the fundamental frequency of the sound : the higher the pitch, the more acute the sound. 1 is the default value.  
`SetVolume` sets the volume of the sound. The volume ranges from 0 to 100, 100 is the default value. You can set it to a value higher than 100, but the effect is not guaranteed and depends on your system.

You can play / pause / stop a sound :

```cpp
Sound.Play();
Sound.Pause();
Sound.Play(); // To resume after a call to Pause()
Sound.Stop();
```

You can get the sound status :

```cpp
sf::Sound::Status Status = Sound.GetStatus();
```

A sound can be `Playing`, `Paused` or `Stopped`.

It is also possible to get the current playing position, in seconds :

```cpp
float Position = Sound.GetPlayingOffset();
```

As usual, no cleanup is needed : all audio classes will free their resources automatically.

## Sound buffers and sounds management

You have to be particularly careful when manipulating sound buffers. A [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") instance is a resource which is slow to load, heavy to copy and uses a lot of memory.

For a good discussion about resource management, I suggest you read the **"Images and sprites management"** part of the [sprites tutorial](../graphics/sprite.md "Sprites tutorial"), just replacing the word "Image" with "SoundBuffer" and "Sprite" with "Sound".

## Conclusion

Now that you can play sounds, let's have a look at how to [play musics](music.md "Go to the next tutorial").
