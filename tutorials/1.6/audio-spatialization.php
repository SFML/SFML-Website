<?php

    $title = "Playing with sound spatialization";
    $page = "audio-spatialization.php";

    require("header.php");
?>

<h1>Playing with sound spatialization</h1>

<?php h2('Introduction') ?>
<p>
    Playing sounds and musics is great, but for it to be perfectly integrated into your 2D or 3D environment,
    it's event better to add some spatialization. Let's have a look at some simple SFML functions for this.
</p>

<?php h2('The listener') ?>
<p>
    Whatever the number of sounds and musics you put in your scene, they all will be listened by a single "actor"
    in your scene : the listener. What the listener will hear, is what will be outputed to your speakers.
</p>
<p>
    SFML defines an interface for setting the listener's properties : <?php class_link("Listener")?>. As the listener is unique in the scene,
    this class contains only static functions and doesn't need to be instanciated.
</p>
<p>
    First, you can set the listener's position in the scene :
</p>
<pre><code class="cpp">sf::Listener::SetPosition(10.f, 0.f, 5.f);
</code></pre>
<p>
    If you have a 2D world you can just use the same Y value everywhere, usually 0.<br/>
    By default, the listener is located at the origin of the world (the point (0, 0, 0)).
</p>
<p>
    Then, you can define where the listener is looking at, to set its orientation :
</p>
<pre><code class="cpp">sf::Listener::SetTarget(15.f, 0.f, 5.f);
</code></pre>
<p>
    Here, our listener is looking along the +X axis. This means that, for example, a sound coming from (15, 0, 3) will be
    heard from the right speaker.<br/>
    By default, the listener is looking along the -Z axis (vector (0, 0, -1)).
</p>
<p>
    Finally, the listener can adjust the global volume of the scene, which would be equivalent to change the volume of all
    the audio sources :
</p>
<pre><code class="cpp">sf::Listener::SetGlobalVolume(50.f);
</code></pre>
<p>
    The value of the volume is in the range [0, 100] ; so setting it to 50 will reduce it to half.
</p>
<p>
    Note that all the listener's parameters can be read with the corresponding GetXxx functions.
</p>

<?php h2('Sounds and musics in your scene') ?>
<p>
    There's not much more to say about sounds and musics. You can set their position in your 2D or 3D environment :
</p>
<pre><code class="cpp">sf::Sound 3DSound;
3DSound.SetPosition(3.f, 2.f, 6.f);
</code></pre>
<p>
    By default, the position is in absolute coordinates. You can make it relative to the listener if necessary:
</p>
<pre><code class="cpp">3DSound.SetRelativeToListener(true);
</code></pre>
<p>
    This has the side-effect of disabling spacialization if the position is kept to (0, 0, 0). Disabling spacialization
    is especially useful for sounds that are not part of the scene (GUI sounds, etc.).
</p>
<p>
    You can also set the way they will be attenuated according to their distance to the listener :
</p>
<pre><code class="cpp">3DSound.SetMinDistance(5.f);
3DSound.SetAttenuation(10.f);
</code></pre>
<p>
    The minimum distance is the distance under which the sound will be heard at its maximum volume. So, louder sounds
    (like explosions) should have a higher minimum distance to ensure they will be heard from far. Please note that a minimum distance
    of 0 (ie. the sound is in the head of the listener :) ) would lead to an incorrect value and result
    in a non-attenuated sound ; never use 0.<br/>
    The default value for the minimum distance is 1.
</p>
<p>
    The attenuation is a multiplicative factor. The more the attenuation, the less it will be
    heard when the sound moves away from the listener.<br/>
    To get a non-attenuated sound, you can use 0. On the other hand, using a value like 100 will highly attenuate the
    sound, ie it wil be heard only if very close to the listener.<br/>
    The default value for attenuation is 1.
</p>
<p>
    Here is the exact attenuation formula, in case you need accurate values :
</p>
<pre><code class="cpp">    MinDistance is the sound minimum distance, set with SetMinDistance
    Attenuation is the sound attenuation, set with SetAttenuation
    Distance    is the distance between the sound and the listener

    Factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
</code></pre>

<?php h2('Conclusion') ?>
<p>
    As you can see, adding realism to your 2D or 3D environment is easy with audio spatialization.<br/>
    If you think you are ready with audio, you can now jump to the
    <a class="internal" href="./network-sockets.php" title="Go to the network tutorials">network tutorials</a>.
</p>

<?php

    require("footer.php");

?>
