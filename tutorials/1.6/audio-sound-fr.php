<?php

    $title = "Jouer un son";
    $page = "audio-sound-fr.php";

    require("header-fr.php");
?>

<h1>Jouer un son</h1>

<?php h2('Introduction') ?>
<p>
    Jouer un son est la tâche la plus facile du module audio de la SFML. Cependant, elle met en jeu deux entités :
    les données du son, et l'instance du son dans la scène. En fait c'est exactement le même principe que les
    images et les sprites du module graphique.
</p>

<?php h2('Le tampon sonore') ?>
<p>
    En programmation audio, les données d'un son sont définies par un tableau d'échantillons (<em>samples</em>). Un
    échantillon est une valeur numérique, habituellement un entier 16 bits signé, représentant l'amplitude du son à un
    instant donné. Le son est ensuite restitué en jouant ces échantillons à une fréquence élevée (les CD utilisent une
    fréquence de 44100 échantillons par seconde). Plus le taux d'échantillonnage sera élevé, meilleure sera la
    qualité du son. Un son est également défini par un nombre de canaux. Un son possédant un canal est un son mono,
    un son possédant deux canaux est un son stéréo. Des sons plus complexes peuvent utiliser jusqu'à 8 canaux,
    pour les formats dolby (4.1, 5.1, 7.1, etc.).
</p>
<p>
    Avant d'utiliser une quelconque classe du module audio de la SFML, vous devez inclure son en-tête :
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
</code></pre>
<p>
    Comme d'habitude, il va inclure tous les en-têtes des classes audio, tout comme les en-têtes des modules desquels
    il dépend.
</p>
<p>
    Dans la SFML, la classe qui contient les échantillons sonores est <?php class_link("SoundBuffer")?>. Vous pouvez le remplir
    à partir d'échantillons en mémoire :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromSamples(Samples, 5000, 2, 44100))
{
    // Erreur...
}
</code></pre>
<p>
    Le premier paramètre est un pointeur vers le tableau d'échantillons en mémoire. Ses éléments doivent être des
    entiers signés de 16 bits. Le deuxième paramètre, ici 5000, est le nombre d'échantillons dans le tableau. Le
    troisième paramètre est le nombre de canaux (ici nous avons un son stéréo), et le quatrième est le taux
    d'échantillonnage.
</p>
<p>
    Si quelque chose s'est mal passé, cette fonction renvoie <code>false</code>.
</p>
<p>
    Plus utile : un tampon sonore peut être chargé à partir de (et sauvé dans) un fichier audio (les formats les
    plus communs sont supportés).
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromFile("sound.wav"))
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez également charger un fichier son directement depuis la mémoire, avec un pointeur vers
    les données du fichier et sa taille en octets :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    Le taux d'échantillonnage et le nombre de canaux sont chargés automatiquement depuis le fichier. Vous pouvez
    les récupérer en appelant les fonctions suivantes :
</p>
<pre><code class="cpp">unsigned int SampleRate = Buffer.GetSampleRate();
unsigned int Channels   = Buffer.GetChannelsCount();
</code></pre>
<p>
    Vous pouvez également récupérer la durée du son (en secondes), qui est simplement déduite du taux d'échantillonnage
    et du nombre d'échantillons :
</p>
<pre><code class="cpp">float Duration = Buffer.GetDuration();
</code></pre>
<p>
    Finalement, si vous devez appliquer un traitement particulier aux données audio, vous pouvez accéder
    au tableau d'échantillons directement :
</p>
<pre><code class="cpp">const sf::Int16* Samples = Buffer.GetSamples();
std::size_t Count = Buffer.GetSamplesCount();
</code></pre>
<p>
    Voilà tout ce que vous avez à savoir à propos des tampons sonores. La plupart du temps, vous n'aurez besoin que
    de la fonction <code>LoadFromFile</code> pour charger des sons depuis vos fichiers audio.
</p>
<?php h2('L\'instance du son') ?>
<p>
    Une fois que vous avez chargé un tampon sonore, vous pouvez utiliser <?php class_link("Sound")?> pour le jouer.
    Une instance de <?php class_link("Sound")?> est un moyen de jouer un tampon sonore dans la "scène", avec des paramètres
    supplémentaires tels que le pitch, le volume, la position, ... Vous pouvez donc avoir plusieurs instances de
    <?php class_link("Sound")?> jouant le même <?php class_link("SoundBuffer")?> au même moment, avec différents paramètres.
</p>
<p>
    Pour lier un tampon à un son, il suffit d'appeler sa fonction <code>SetBuffer</code> :
</p>
<pre><code class="cpp">sf::Sound Sound;
Sound.SetBuffer(Buffer); // Buffer est un sfSoundBuffer
</code></pre>
<p>
    Ensuite vous pouvez modifier ou récupérer les paramètres du son via ses accesseurs :
</p>
<pre><code class="cpp">Sound.SetLoop(true);
Sound.SetPitch(1.5f);
Sound.SetVolume(75.f);
</code></pre>
<pre><code class="cpp">bool  Loop   = Sound.GetLoop();
float Pitch  = Sound.GetPitch();
float Volume = Sound.GetVolume();
</code></pre>
<p>
    <code>SetLoop</code> Indique si le son va jouer en boucle ou une seule fois.<br/>
    <code>SetPitch</code> change la fréquence fondamentale du son : plus haut est le pitch, plus aigü sera le son.
    La valeur par défaut est 1<br/>
    <code>SetVolume</code> modifie le volume du son. Le volume varie entre 0 et 100, 100 étant la valeur par défaut.
    Vous pouvez affecter un son supérieur à 100, mais le résultat n'est pas garanti et dépend de votre système.<br/>
</p>
<p>
    Vous pouvez jouer / mettre en pause / stopper un son :
</p>
<pre><code class="cpp">Sound.Play();
Sound.Pause();
Sound.Play(); // Pour reprendre après un appel à Pause()
Sound.Stop();
</code></pre>
<p>
    Vous pouvez récupérer l'état du son :
</p>
<pre><code class="cpp">sf::Sound::Status Status = Sound.GetStatus();
</code></pre>
<p>
    Un son peut être <code>Playing</code> (en lecture), <code>Paused</code> (en pause) ou <code>Stopped</code> (stoppé).
</p>
<p>
    Il est également possible de récupérer la position de lecture courante, en secondes :
</p>
<pre><code class="cpp">float Position = Sound.GetPlayingOffset();
</code></pre>
<p>
    Et comme d'habitude, aucune destruction n'est nécessaire : toutes les classes audio vont libérer leurs ressources
    automatiquement.
</p>

<?php h2('Gestion des tampons et des sons') ?>
<p>
    Vous devez être particulièrement prudent lorsque vous manipulez des tampons sonores. Une instance de
    <?php class_link("SoundBuffer")?>
    est une ressource qui est lente à charger, lourde à copier et qui utilise beaucoup de mémoire.
</p>
<p>
    Pour une bonne discussion à propos de la gestion des ressources, je vous renvoie au paragraphe
    <strong>"Gestion des images et des sprites"</strong> du
    <a class="internal" href="./graphics-sprite-fr.php" title="Tutoriel sur les sprites">tutoriel sur les sprites</a>,
    en remplaçant simplement le mot "Image" par "Tampon" et "Sprite" par "Son".
</p>

<?php h2('Conclusion') ?>
<p>
    Maintenant que vous savez jouer des sons, regardons comment
    <a class="internal" href="./audio-music-fr.php" title="Aller au tutoriel suivant">jouer des musiques</a>.
</p>

<?php

    require("footer-fr.php");

?>
