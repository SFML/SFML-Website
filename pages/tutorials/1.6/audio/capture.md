# Capturing audio data

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/audio/recording/).

## Introduction

This tutorial will show how to easily capture audio data from your microphone, and apply custom processing to it like saving it to a sound buffer, or sending it through the network.

## Creating a custom recorder

The class that defines the capture interface in SFML is [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation"). As it doesn't know what to do with the captured samples (and it doesn't have to), it is only a base class for your own custom recorder(s). [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") provides you with the captured audio samples, all you have to do is... whatever you want : send them through the network, copy them into a sound buffer, etc.

Here are the functions to override by your derived recorder:

```cpp
class MyCustomSoundRecorder : public sf::SoundRecorder
{
    virtual bool OnStart()
    {
        ...

        return true;
    }

    virtual bool OnProcessSamples(const sf::Int16* Samples, std::size_t SamplesCount)
    {
        ...

        return true;
    }

    virtual void OnStop()
    {
        ...
    }
};
```

`OnStart` is called once each time the capture starts (call to `Start`). It's optional, and won't do anything if you don't override it. If you override it, the return value must be `true` to start the capture, or `false` to abort it (e.g. after en error).

`OnProcessSamples` is called each time the recorder has captured enough data, so, many times during the capture. This function is mandatory (a recorder without a function to process audio data wouldn't make sense), so you have to override it in your custom recorders. Like `OnStart`, the return value means "should we continue capturing data?".  
The `Samples` parameter is a pointer to the array of captured audio samples, and `SamplesCount` is the number of samples in this array.

`OnStop` is called once each time the capture stops. Like `OnStart`, it's optional and won't do anything if you don't override it.

## Usage

The [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") interface is quite simple. First, you must check that your system supports audio capture. This can be done with the static function `CanCapture` :

```cpp
if (!sf::SoundRecorder::CanCapture())
{
    // Don't even try to capture audio...
}
```

This should be checked before any use of [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation").

Then, to start the capture you call `Start`, and to stop it you call `Stop`.

```cpp
MyCustomSoundRecorder Recorder;

Recorder.Start(96000);

// Wait a while...

Recorder.Stop();
```

When you call `Start`, you can pass a custom sample rate that will be used for the capture. By default, 44100 will be used (CD quality). If you need to get it back later, you can call the `GetSampleRate` function.

```cpp
unsigned int SampleRate = Recorder.GetSampleRate();
```

## Recording data into a sound buffer

The most common use is probably to save audio data to a sound buffer, so that you can save it to a file or play it immediately. SFML has a built-in specialization of [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") for this : [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation"). It copies the captured audio samples to a [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation"), that you can access through the `GetBuffer` function :

```cpp
sf::SoundBufferRecorder Recorder;

Recorder.Start();

// Wait a while...

Recorder.Stop();

sf::SoundBuffer Buffer = Recorder.GetBuffer();
```

## Multi-threading

For the same reasons as [`sf::SoundStream`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundStream.php "sf::SoundStream documentation"), [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") runs the capture in a new thread, so that the main thread is not blocked. So, once again, you have to take care of synchronization issues that can arise if you share data between both threads.  
For more detailed explanations, you can have a look at the [SoundStream tutorial](streams.md "Go to the streams tutorial").

## Conclusion

That's all for the basics of the audio package. You can play sounds and musics, stream audio from any source, and capture sounds from your microphone.  
Let's now explore a more advanced feature: [sound spatialization](spatialization.md "Jump to the next tutorial").
