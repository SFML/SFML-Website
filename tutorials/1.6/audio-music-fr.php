<?php

    $title = "Jouer une musique";
    $page = "audio-music-fr.php";

    require("header-fr.php");
?>

<h1>Jouer une musique</h1>

<?php h2('Introduction') ?>
<p>
    Vous vous demandez peut-�tre, "mais quelle est la diff�rence entre une musique et un son ?". Et bien, une musique
    est simplement un son plus long. Mais cela fait une �norme diff�rence en programmation audio. La m�me diff�rence
    qui fait que vous devez compresser vos musiques en MP3 ou en OGG. Comme nous l'avons vu dans le tutoriel
    pr�c�dent, les donn�es sonores non compress�es sont compos�es d'�chantillons, qui sont (dans la SFML) des entiers
    sign�s de 16 bits. Prenez le taux d'�chantillonnage standard pour une qualit� CD (44100 �chantillons par seconde),
    deux canaux, et vous finissez avec 50 Mo en m�moire pour pas plus de 5 minutes de musique.
</p>
<p>
    En cons�quence, les musiques ne peuvent pas �tre charg�es en m�moire comme les sons. C'est pourquoi les musiques
    ont leur propre classe dans la SFML : <?php class_link("Music")?>.
</p>

<?php h2('Utiliser sf::Music') ?>
<p>
    Une musique n'est jamais charg�e compl�tement en m�moire, � la place elle utilise un tampon dynamique
    plus petit qui est mis � jour r�guli�rement avec les donn�es sonores provenant du fichier (oui, c'est en fait
    de la lecture en flux -- nous d�taillerons �a dans le prochain tutoriel).<br/>
    Le tampon interne est d�fini � une taille appropri�e par d�faut, mais vous pouvez la d�finir vous m�me si vous
    le souhaitez (si votre musique a un taux d'�chantillonnage tr�s �lev�, ou si vous avez tr�s peu de m�moire �
    votre disposition) avec le constructeur :
</p>
<pre><code class="cpp">sf::Music Music1;        // Par d�faut, le tampon interne contiendra 44100 �chantillons
sf::Music Music2(96000); // Le tampon interne contiendra 96000 �chantillons
</code></pre>
<p>
    Pour ouvrir une musique � partir d'un fichier, vous pouvez utiliser la fonction <code>OpenFromFile</code> :
</p>
<pre><code class="cpp">if (!Music.OpenFromFile("music.ogg"))
{
    // Erreur...
}
</code></pre>
<p>
    Ou, si le fichier est d�j� charg� en m�moire :
</p>
<pre><code class="cpp">if (!Music.OpenFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    N'oubliez pas de toujours v�rifier la valeur retourn�e, qui sera <code>false</code> si la musique n'a pas pu
    �tre ouverte.
</p>
<p>
    L'appel � <code>OpenFromFile</code> ou <code>OpenFromMemory</code> ne d�marrera pas la musique, seul un appel � <code>Play</code> le fera.
</p>
<p>
    <?php class_link("Music")?> diff�re de <?php class_link("Sound")?> dans son comportement, mais elle repr�sente toujours un son.
    Ainsi, elle d�finit les m�mes accesseurs que <?php class_link("Sound")?> et <?php class_link("SoundBuffer")?> rassembl�s :
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
    Seul le tableau d'�chantillons ne peut pas �tre lu, car celui-ci n'est jamais charg� compl�tement en m�moire (mais
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
    <?php class_link("Music")?> ne diff�re pas beaucoup de <?php class_link("Sound")?>. La cl� ici est de bien distinguer les sons
    courts ponctuels (des bruits de pas, des tirs d'armes, ...) des sons plus longs (les musiques de fond), et d'utiliser
    la classe appropri�e dans chaque cas.

</p>
<p>
    Dans le prochain tutoriel nous apprendrons �
    <a class="internal" href="./audio-streams-fr.php" title="Aller au tutoriel suivant">utiliser les flux audio</a>
    pour jouer des sons provenant du r�seau, de gros fichiers (ce que fait <?php class_link("Music")?>),
    ou de n'importe quelle source qui ne peut pas �tre charg�e compl�tement en m�moire.
</p>

<?php

    require("footer-fr.php");

?>
