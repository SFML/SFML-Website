# Recording audio

## Recording to a sound buffer

The most common use for captured audio data is for it to be saved to a sound buffer ([`sf::SoundBuffer`](../../../documentation/3.0.2/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation")) so that it can either be played or saved to a file.

This can be achieved with the very simple interface of the [`sf::SoundBufferRecorder`](../../../documentation/3.0.2/classsf_1_1SoundBufferRecorder.html "sf::SoundBufferRecorder documentation") class:

```cpp
// first check if an input audio device is available on the system
if (!sf::SoundBufferRecorder::isAvailable())
{
    // error: audio capture is not available on this system
    ...
}

// create the recorder
sf::SoundBufferRecorder recorder;

// start the capture
recorder.start();

// wait...

// stop the capture
recorder.stop();

// retrieve the buffer that contains the captured audio data
const sf::SoundBuffer& buffer = recorder.getBuffer();
```

The `SoundBufferRecorder::isAvailable` static function checks if audio recording is supported by the system.
It if returns `false`, you won't be able to use the [`sf::SoundBufferRecorder`](../../../documentation/3.0.2/classsf_1_1SoundBufferRecorder.html "sf::SoundBufferRecorder documentation") class at all.

The `start` and `stop` functions are self-explanatory.
The capture runs in its own thread, which means that you can do whatever you want between start and stop.
After the end of the capture, the recorded audio data is available in a sound buffer that you can get with the `getBuffer` function.

With the recorded data, you can then:

- Save it to a file
    
    ```cpp
    buffer.saveToFile("my_record.ogg");
    ```
    
- Play it directly
    
    ```cpp
    sf::Sound sound(buffer);
    sound.play();
    ```
    
- Access the raw audio data and analyze it, transform it, etc.
    
    ```cpp
    const std::int16_t* samples = buffer.getSamples();
    std::size_t count = buffer.getSampleCount();
    doSomething(samples, count);
    ```
    

If you want to use the captured audio data after the recorder is destroyed or restarted, don't forget to make a _copy_ of the buffer.

## Selecting the input device

If you have multiple sound input devices connected to your computer (for example a microphone, a sound interface (external soundcard) or a webcam microphone) you can specify the device that is used for recording.
A sound input device is identified by its name.
A `std::vector<std::string>` containing the names of all connected devices is available through the static `SoundBufferRecorder::getAvailableDevices()` function.
You can then select a device from the list for recording, by passing the chosen device name to the `setDevice()` method.
It is even possible to change the device on the fly (i.e. while recording).

The name of the currently used device can be obtained by calling `getDevice()`.
If you don't choose a device yourself, the default device will be used.
Its name can be obtained through the static `SoundBufferRecorder::getDefaultDevice()` function.

Here is a small example of how to set the input device:

```cpp
// get the available sound input device names
std::vector<std::string> availableDevices = sf::SoundRecorder::getAvailableDevices();

// choose a device
std::string inputDevice = availableDevices[0];

// create the recorder
sf::SoundBufferRecorder recorder;

// set the device
if (!recorder.setDevice(inputDevice))
{
    // error: device selection failed
    ...
}

// use recorder as usual
```

## Custom recording

If storing the captured data in a sound buffer is not what you want, you can write your own recorder.
Doing so will allow you to process the audio data while it is captured, (almost) directly from the recording device.
This way you can, for example, stream the captured audio over the network, perform real-time analysis on it, etc.

To write your own recorder, you must inherit from the [`sf::SoundRecorder`](../../../documentation/3.0.2/classsf_1_1SoundRecorder.html "sf::SoundRecorder documentation") abstract base class.
In fact, [`sf::SoundBufferRecorder`](../../../documentation/3.0.2/classsf_1_1SoundBufferRecorder.html "sf::SoundBufferRecorder documentation") is just a built-in specialization of this class.

You only have a single virtual function to override in your derived class: `onProcessSamples`.
It is called every time a new chunk of audio samples is captured, so this is where you implement your specific stuff.

By default Audio samples are provided to the `onProcessSamples` method every 100 ms.
You can change the interval by using the `setProcessingInterval` method.
You may want to use a smaller interval if you want to process the recorded data in real time, for example.
Note that this is only a hint and that the actual period may vary, so don't rely on it to implement precise timing.

There are also two additional virtual functions that you can optionally override: `onStart` and `onStop`.
They are called when the capture starts/stops respectively.
They are useful for initialization/cleanup tasks.

Here is the skeleton of a complete derived class:

```cpp
class MyRecorder : public sf::SoundRecorder
{
    bool onStart() override // optional
    {
        // initialize whatever has to be done before the capture starts
        ...

        // return true to start the capture, or false to cancel it
        return true;
    }

    bool onProcessSamples(const std::int16_t* samples, std::size_t sampleCount) override
    {
        // do something useful with the new chunk of samples
        ...

        // return true to continue the capture, or false to stop it
        return true;
    }

    void onStop() override // optional
    {
        // clean up whatever has to be done after the capture is finished
        ...
    }
};
```

The `isAvailable`/`start`/`stop` functions are defined in the [`sf::SoundRecorder`](../../../documentation/3.0.2/classsf_1_1SoundRecorder.html "sf::SoundRecorder documentation") base, and thus inherited in every derived classes.
This means that you can use any recorder class exactly the same way as the [`sf::SoundBufferRecorder`](../../../documentation/3.0.2/classsf_1_1SoundBufferRecorder.html "sf::SoundBufferRecorder documentation") class above.

```cpp
if (!MyRecorder::isAvailable())
{
    // error...
}

MyRecorder recorder;
recorder.start();
...
recorder.stop();
```

## Threading issues

Since recording is done in a separate thread, it is important to know what exactly happens, and where.

`onStart` will be called directly by the `start` function, so it is executed in the same thread that called it.
However, `onProcessSample` and `onStop` will always be called from the internal recording thread that SFML creates.

If your recorder uses data that may be accessed _concurrently_ in both the caller thread and in the recording thread, you have to protect it (with a mutex for example) in order to avoid concurrent access, which may cause undefined behavior -- corrupt data being recorded, crashes, etc.
