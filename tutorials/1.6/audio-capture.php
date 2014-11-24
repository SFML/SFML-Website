<?php
    $title = "Capturing audio data";
    $page = "audio-capture.php";

    require("header.php");
?>

<h1>Capturing audio data</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial will show how to easily capture audio data from your microphone, and apply custom processing to
    it like saving it to a sound buffer, or sending it through the network.
</p>

<?php h2('Creating a custom recorder') ?>
<p>
    The class that defines the capture interface in SFML is <?php class_link("SoundRecorder")?>.
    As it doesn't know what to do with the captured samples (and it doesn't have to), it is only a base class for
    your own custom recorder(s). <?php class_link("SoundRecorder")?> provides you with the captured audio samples, all
    you have to do is... whatever you want : send them through the network, copy them into a sound buffer, etc.
</p>
<p>
    Here are the functions to override by your derived recorder:
</p>
<pre><code class="cpp">class MyCustomSoundRecorder : public sf::SoundRecorder
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
</code></pre>
<p>
    <code>OnStart</code> is called once each time the capture starts (call to <code>Start</code>).
    It's optional, and won't do anything if you don't override it. If you override it, the return value must be
    <code>true</code> to start the capture, or <code>false</code> to abort it (e.g. after en error).
</p>
<p>
    <code>OnProcessSamples</code> is called each time the recorder has captured enough data, so, many
    times during the capture. This function is mandatory (a recorder without a function to process audio data wouldn't
    make sense), so you have to override it in your custom recorders. Like <code>OnStart</code>, the return value means
    "should we continue capturing data?".<br/>
    The <code>Samples</code> parameter is a pointer to the array of captured audio samples, and <code>SamplesCount</code>
    is the number of samples in this array.
</p>
<p>
    <code>OnStop</code> is called once each time the capture stops. Like <code>OnStart</code>, it's optional
    and won't do anything if you don't override it.
</p>

<?php h2('Usage') ?>
<p>
    The <?php class_link("SoundRecorder")?> interface is quite simple. First, you must check that your system supports audio
    capture. This can be done with the static function <code>CanCapture</code> :
</p>
<pre><code class="cpp">if (!sf::SoundRecorder::CanCapture())
{
    // Don't even try to capture audio...
}
</code></pre>
<p>
    This should be checked before any use of <?php class_link("SoundRecorder")?>.
</p>
<p>
    Then, to start the capture you call <code>Start</code>, and to stop it you call <code>Stop</code>.
</p>
<pre><code class="cpp">MyCustomSoundRecorder Recorder;

Recorder.Start(96000);

// Wait a while...

Recorder.Stop();
</code></pre>
<p>
    When you call <code>Start</code>, you can pass a custom sample rate that will be used for the capture. By default,
    44100 will be used (CD quality). If you need to get it back later, you can call the <code>GetSampleRate</code> function.
</p>
<pre><code class="cpp">unsigned int SampleRate = Recorder.GetSampleRate();
</code></pre>

<?php h2('Recording data into a sound buffer') ?>
<p>
    The most common use is probably to save audio data to a sound buffer, so that you can save it to a file
    or play it immediately. SFML has a built-in specialization of <?php class_link("SoundRecorder")?> for this :
    <?php class_link("SoundBufferRecorder")?>. It copies the captured audio samples to a <?php class_link("SoundBuffer")?>, that
    you can access through the <code>GetBuffer</code> function :
</p>
<pre><code class="cpp">sf::SoundBufferRecorder Recorder;

Recorder.Start();

// Wait a while...

Recorder.Stop();

sf::SoundBuffer Buffer = Recorder.GetBuffer();
</code></pre>

<?php h2('Multi-threading') ?>
<p>
    For the same reasons as <?php class_link("SoundStream")?>, <?php class_link("SoundRecorder")?> runs the capture in a new thread,
    so that the main thread is not blocked. So, once again, you have to take care of synchronization issues that can
    arise if you share data between both threads.<br/>
    For more detailed explanations, you can have a look at the
    <a class="internal" href="./audio-streams.php" title="Go to the streams tutorial">SoundStream tutorial</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    That's all for the basics of the audio package. You can play sounds and musics, stream audio from any source,
    and capture sounds from your microphone.<br/>
    Let's now explore a more advanced feature:
    <a class="internal" href="./audio-spatialization.php" title="Jump to the next tutorial">sound spatialization</a>.
</p>

<?php

    require("footer.php");

?>
