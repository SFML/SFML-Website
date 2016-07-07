<?php

    $title = "Spatialization: Sounds in 3D";
    $page = "audio-spatialization.php";

    require("header.php");

?>

<h1>Spatialization: Sounds in 3D</h1>

<?php h2('Introduction') ?>
<p>
    By default, sounds and music are played at full volume in each speaker; they are not <em>spatialized</em>.
</p>
<p>
    If a sound is emitted by an entity which is to the right of the screen, you would probably want to hear it from the right speaker. If a music is being
    played behind the player, you would want to hear it from the rear speakers of your Dolby 5.1 sound system.
</p>
<p>
    How can this be achieved?
</p>

<?php h2('Spatialized sounds are mono') ?>
<p class="important">
    A sound can be spatialized only if it has a single channel, i.e. if it's a mono sound.<br/>
    Spatialization is disabled for sounds with more channels, since they already explicitly decide how to use the speakers. This is very important to
    keep in mind.
</p>

<?php h2('The listener') ?>
<p>
    All the sounds and music in your audio environment will be heard by a single actor: the <em>listener</em>. What is output from your speakers is
    determined by what the listener hears.
</p>
<p>
    The class which defines the listener's properties is <?php class_link("Listener") ?>. Since the listener is unique in the environment, this class
    only contains static functions and is not meant to be instantiated.
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
    The "up" vector of the listener is set to (0, 1, 0) by default, in other words, the top of the listener's head is pointing towards +Y.
    You can change the "up" vector if you want. It is rarely necessary though.
</p>
<pre><code class="cpp">sf::Listener::setUpVector(1.f, 1.f, 0.f);
</code></pre>
<p>
    This corresponds to the listener tilting their head towards the right (+X).
</p>
<p>
    Finally, the listener can adjust the global volume of the scene:
</p>
<pre><code class="cpp">sf::Listener::setGlobalVolume(50.f);
</code></pre>
<p>
    The value of the volume is in the range [0 .. 100], so setting it to 50 reduces it to half of the original volume.
</p>
<p>
    Of course, all these properties can be read with the corresponding <code>get</code> functions.
</p>

<?php h2('Audio sources') ?>
<p>
    Every audio source provided by SFML (sounds, music, streams) defines the same properties for spatialization.
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
    (clicks), ambient music, etc.
</p>
<p>
    You can also set the factor by which audio sources will be attenuated depending on their distance to the listener.
</p>
<pre><code class="cpp">sound.setMinDistance(5.f);
sound.setAttenuation(10.f);
</code></pre>
<p>
    The <em>minimum distance</em> is the distance under which the sound will be heard at its maximum volume. As an example, louder sounds such as explosions
    should have a higher minimum distance to ensure that they will be heard from far away. Please note that a minimum distance of 0 (the sound is inside the
    head of the listener!) would lead to an incorrect spatialization and result in a non-attenuated sound. 0 is an invalid value, never use it.
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
