<?php

    $title = "Jouer une musique";
    $page = "audio-music-fr.php";

    require("header-fr.php");
?>

<h1>Jouer une musique</h1>

<?php h2('Introduction') ?>
<p>
    Vous vous demandez peut-être, "mais quelle est la différence entre une musique et un son ?". Et bien, une musique
    est simplement un son plus long. Mais cela fait une énorme différence en programmation audio. La même différence
    qui fait que vous devez compresser vos musiques en MP3 ou en OGG. Comme nous l'avons vu dans le tutoriel
    précédent, les données sonores non compressées sont composées d'échantillons, qui sont (dans la SFML) des entiers
    signés de 16 bits. Prenez le taux d'échantillonnage standard pour une qualité CD (44100 échantillons par seconde),
    deux canaux, et vous finissez avec 50 Mo en mémoire pour pas plus de 5 minutes de musique.
</p>
<p>
    En conséquence, les musiques ne peuvent pas être chargées en mémoire comme les sons. C'est pourquoi les musiques
    ont leur propre classe dans la SFML : <?php class_link("Music")?>.
</p>

<?php h2('Utiliser sf::Music') ?>
<p>
    Une musique n'est jamais chargée complétement en mémoire, à la place elle utilise un tampon dynamique
    plus petit qui est mis à jour régulièrement avec les données sonores provenant du fichier (oui, c'est en fait
    de la lecture en flux -- nous détaillerons ça dans le prochain tutoriel).<br/>
    Le tampon interne est défini à une taille appropriée par défaut, mais vous pouvez la définir vous même si vous
    le souhaitez (si votre musique a un taux d'échantillonnage très élevé, ou si vous avez très peu de mémoire à
    votre disposition) avec le constructeur :
</p>
<pre><code class="cpp">sf::Music Music1;        // Par défaut, le tampon interne contiendra 44100 échantillons
sf::Music Music2(96000); // Le tampon interne contiendra 96000 échantillons
</code></pre>
<p>
    Pour ouvrir une musique à partir d'un fichier, vous pouvez utiliser la fonction <code>OpenFromFile</code> :
</p>
<pre><code class="cpp">if (!Music.OpenFromFile("music.ogg"))
{
    // Erreur...
}
</code></pre>
<p>
    Ou, si le fichier est déjà chargé en mémoire :
</p>
<pre><code class="cpp">if (!Music.OpenFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    N'oubliez pas de toujours vérifier la valeur retournée, qui sera <code>false</code> si la musique n'a pas pu
    être ouverte.
</p>
<p>
    L'appel à <code>OpenFromFile</code> ou <code>OpenFromMemory</code> ne démarrera pas la musique, seul un appel à <code>Play</code> le fera.
</p>
<p>
    <?php class_link("Music")?> diffère de <?php class_link("Sound")?> dans son comportement, mais elle représente toujours un son.
    Ainsi, elle définit les mêmes accesseurs que <?php class_link("Sound")?> et <?php class_link("SoundBuffer")?> rassemblés :
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
    Seul le tableau d'échantillons ne peut pas être lu, car celui-ci n'est jamais chargé complétement en mémoire (mais
    vous pouvez toujours le charger avec un <?php class_link("SoundBuffer")?> si vous en avez vraiment besoin).
</p>
<p>
    Enfin, vous pouvez toujours jouer / mettre en pause / stopper une musique :
</p>
<pre><code class="cpp">Music.Play();
Music.Pause();
Music.Stop();
</code></pre>

<?php h2('Conclusion') ?>
<p>
    <?php class_link("Music")?> ne diffère pas beaucoup de <?php class_link("Sound")?>. La clé ici est de bien distinguer les sons
    courts ponctuels (des bruits de pas, des tirs d'armes, ...) des sons plus longs (les musiques de fond), et d'utiliser
    la classe appropriée dans chaque cas.

</p>
<p>
    Dans le prochain tutoriel nous apprendrons à
    <a class="internal" href="./audio-streams-fr.php" title="Aller au tutoriel suivant">utiliser les flux audio</a>
    pour jouer des sons provenant du réseau, de gros fichiers (ce que fait <?php class_link("Music")?>),
    ou de n'importe quelle source qui ne peut pas être chargée complétement en mémoire.
</p>

<?php

    require("footer-fr.php");

?>
