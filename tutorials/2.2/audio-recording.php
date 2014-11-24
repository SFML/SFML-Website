<?php

    $title = "Recording audio";
    $page = "audio-recording.php";

    require("header.php");

?>

<h1>Recording audio</h1>

<?php h2('Recording to a sound buffer') ?>
<p>
    The most common scenario for captured audio data is to be saved to a sound buffer (<?php class_link("SoundBuffer") ?>) so that it can either be played
    or saved to a file.
</p>
<p>
    This can be achieved with the very simple interface of the <?php class_link("SoundBufferRecorder") ?> class:
</p>
<pre><code class="cpp">// first check if an input audio device is available on the system
if (!SoundBufferRecorder::isAvailable())
{
    // error: audio capture is not available on this system
    ...
}

// create the recorder
SoundBufferRecorder recorder;

// start the capture
recorder.start();

// wait...

// stop the capture
recorder.stop();

// retrieve the buffer that contains the captured audio data
const sf::SoundBuffer&amp; buffer = recorder.getBuffer();
</code></pre>
<p>
    The <code>SoundBufferRecorder::isAvailable</code> static function checks if audio recording is supported by the system. It if returns <code>false</code>,
    you won't be able to use the <?php class_link("SoundBufferRecorder") ?> class at all.
</p>
<p>
    The <code>start</code> and <code>stop</code> functions are self-explanatory. The capture runs in its own thread, which means that you can do whatever
    you want between start and stop. After the end of the capture, the recorded audio data is available in a sound buffer that you can get with the
    <code>getBuffer</code> function.
</p>
<p>
    With the recorded data, you can then:
</p>
<ul>
    <li>Save it to a file
<pre><code class="cpp">buffer.saveToFile("my_record.ogg");
</code></pre>
    </li>
    <li>Play it directly
<pre><code class="cpp">sf::Sound sound(buffer);
sound.play();
</code></pre>
    </li>
    <li>
        Access the raw audio data and analyze it, transform it, or whatever
<pre><code class="cpp">const sf::Int16* samples = buffer.getSamples();
std::size_t count = buffer.getSampleCount();
doSomething(samples, count);    
</code></pre>
    </li>
</ul>
<p class="important">
    If you want to use the captured audio data after the recorder is destroyed or restarted, don't forget to make a <em>copy</em> of the buffer.
</p>

<?php h2('Custom recording') ?>
<p>
    If storing the captured data in a sound buffer is not what you want, you can write your own recorder. Doing so will allow you to process the
    audio data while it is captured, (almost) directly from the recording device. This way you can, for example, stream the captured audio to the
    network, perform a real-time analysis on it, etc.
</p>
<p>
    To write your own recorder, you must inherit from the <?php class_link("SoundRecorder") ?> abstract base class. In fact,
    <?php class_link("SoundBufferRecorder") ?> is just a built-in specialization of this class.
</p>
<p>
    You only have a single virtual function to override in your derived class: <code>onProcessSamples</code>. It is called everytime a new chunk
    of audio samples is captured, so this is where you implement your specific stuff.
</p>
<p class="important">
    Audio samples are provided to the <code>onProcessSamples</code> function every 100 ms. This is currently hard-coded into SFML and you can't change
    that (unless you modify SFML itself). This may change in the future.
</p>
<p>
    There are also two additional virtual functions that you can optionally override: <code>onStart</code> and <code>onStop</code>. They are
    called respectively when the capture starts/stops. They are useful for initialization/cleanup tasks.
</p>
<p>
    Here is the skeleton of a complete derived class:
</p>
<pre><code class="cpp">class MyRecorder : public sf::SoundRecorder
{
    virtual bool onStart() // optional
    {
        // initialize whatever has to be done before the capture starts
        ...

        // return true to start the capture, or false to cancel it
        return true;
    }

    virtual bool onProcessSamples(const Int16* samples, std::size_t sampleCount)
    {
        // do something useful with the new chunk of samples
        ...

        // return true to continue the capture, or false to stop it
        return true;
    }

    virtual void onStop() // optional
    {
        // clean up whatever has to be done after the capture is finished
        ...
    }
}
</code></pre>
<p>
    The <code>isAvailable</code>/<code>start</code>/<code>stop</code> functions are defined in the <?php class_link("SoundRecorder") ?> base, and thus
    inherited in every derived classes. This means that you can use any recorder class exactly the same way as the
    <?php class_link("SoundBufferRecorder") ?> class above.
</p>
<pre><code class="cpp">if (!MyRecorder::isAvailable())
{
    // error...
}

MyRecorder recorder;
recorder.start();
...
recorder.stop();
</code></pre>

<?php h2('Threading issues') ?>
<p>
    Since recording is done in a separate thread, it is important to know what happens exactly, and where.
</p>
<p>
    <code>onStart</code> will be called directly by the <code>start</code> function, so it is executed in the same thread that called it. However,
    <code>onProcessSample</code> and <code>onStop</code> will always be called from the internal recording thread that SFML creates.
</p>
<p>
    So, if your recorder uses data that may be accessed <em>concurrently</em> in both the caller thread and in the recording thread, you have to protect
    them (with a mutex or whatever) in order to avoid concurrent access, which may cause undefined behaviors -- corrupt data being recorded, crashes, etc.
</p>
<p>
    If you're not familiar enough with threading, you can first read the
    <a class="internal" href="./system-thread.php" title="Threading tutorial">corresponding tutorial</a>.
</p>

<?php

    require("footer.php");

?>
