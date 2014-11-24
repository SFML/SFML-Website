<?php

    $title = "Spatialization: sounds in 3D";
    $page = "audio-spatialization.php";

    require("header.php");

?>

<h1>Spatialization: sounds in 3D</h1>

<?php h2('Introduction') ?>
<p>
    By default, sounds and musics are played at full volume in each speaker; they are not <em>spatialized</em>.
</p>
<p>
    But if a sound is emitted by an entity which is on the right of the screen, you would like to hear it from the right speaker. Or if a music is being
    played behind the player, you would like to hear it from the rear speakers of your Dolby 5.1 sound system.
</p>
<p>
    So... how can this be achieved?
</p>

<?php h2('Spatialized sounds are mono') ?>
<p class="important">
    A sound can be spatialized only if it has a single channel, i.e. if it's a mono sound.<br/>
    Spatialization is disabled for sounds with more channels, since they already explicitly decide how to use the speakers. This is very important to
    keep in mind.
</p>

<?php h2('The listener') ?>
<p>
    All the sounds and musics of your audio environment will be heard by a single actor: the <em>listener</em>. What is restituted through your speakers is
    what the listener hears.
</p>
<p>
    The class which defines the listener's properties is <?php class_link("Listener") ?>. Since the listener is unique in the environment, this class contains
    only static functions and is not meant to be instantiated.
</p>
<p>
    First, you can set the listener's position in the scene:
</p>
<pre><code class="cpp">sf::Listener::setPosition(10.f, 0.f, 5.f);
</code></pre>
<p>
    If you have a 2D world you can just use the same Y value everywhere, usually 0.
</p>
<p>
    In addition to its position, you can define the listener's orientation:
</p>
<pre><code class="cpp">sf::Listener::setDirection(1.f, 0.f, 0.f);
</code></pre>
<p>
    Here, the listener is oriented along the +X axis. This means that, for example, a sound emitted at (15, 0, 5) will be heard from the right speaker.
</p>
<p>
    Note that the "up" vector of the listener is always set to (0, 1, 0), in other words his head is oriented towards +Y.
</p>
<p>
    Finally, the listener can adjust the global volume of the scene,:
</p>
<pre><code class="cpp">sf::Listener::setGlobalVolume(50.f);
</code></pre>
<p>
    The value of the volume is in the range [0 .. 100], so setting it to 50 reduces it to half.
</p>
<p>
    Of course, all these properties can be read with the corresponding <code>get</code> functions.
</p>

<?php h2('Audio sources') ?>
<p>
    Every audio source provided by SFML (sounds, musics, streams) defines the same properties for spatialization.
</p>
<p>
    The main property is the position of the audio source.
</p>
<pre><code class="cpp">sound.setPosition(2.f, 0.f, -5.f);
</code></pre>
<p>
    This position is absolute by default, but it can be relative to the listener if needed.
</p>
<pre><code class="cpp">sound.setRelativeToListener(true);
</code></pre>
<p>
    This can be useful for sounds emitted by the listener itself (like a gun shot, or foot steps). It also has the interesting side-effect of disabling
    spatialization if you set the position of the audio source to (0, 0, 0). Non-spatialized sounds can be required in various situations: GUI sounds
    (clicks), ambient musics, etc.
</p>
<p>
    You can also set the way audio sources will be attenuated according to their distance to the listener.
</p>
<pre><code class="cpp">sound.setMinDistance(5.f);
sound.setAttenuation(10.f);
</code></pre>
<p>
    The <em>minimum distance</em> is the distance under which the sound will be heard at its maximum volume. So, for example, louder sounds, like explosions,
    should have a higher minimum distance to ensure that they will be heard from far. Please note that a minimum distance of 0 (the sound is inside the
    head of the listener!) would lead to an incorrect value and result in a non-attenuated sound. 0 is an invalid value, never use it.
</p>
<p>
    The <em>attenuation</em> is a multiplicative factor. The greater the attenuation, the less it will be heard when the sound moves away from the
    listener. To get a non-attenuated sound, you can use 0. On the other hand, using a value like 100 will highly attenuate the sound, which means that
    it will be heard only if very close to the listener.
</p>
<p>
    Here is the exact attenuation formula, in case you need accurate values:
</p>

<pre><code class="none"><em>MinDistance</em>   is the sound's minimum distance, set with setMinDistance
<em>Attenuation</em>   is the sound's attenuation, set with setAttenuation
<em>Distance</em>      is the distance between the sound and the listener
<em>Volume factor</em> is the calculated factor, in range [0 .. 1], that will be applied to the sound's volume

Volume factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
</code></pre>

<?php

    require("footer.php");

?>
