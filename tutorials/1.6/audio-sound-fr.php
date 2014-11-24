<?php

    $title = "Jouer un son";
    $page = "audio-sound-fr.php";

    require("header-fr.php");
?>

<h1>Jouer un son</h1>

<?php h2('Introduction') ?>
<p>
    Jouer un son est la t�che la plus facile du module audio de la SFML. Cependant, elle met en jeu deux entit�s :
    les donn�es du son, et l'instance du son dans la sc�ne. En fait c'est exactement le m�me principe que les
    images et les sprites du module graphique.
</p>

<?php h2('Le tampon sonore') ?>
<p>
    En programmation audio, les donn�es d'un son sont d�finies par un tableau d'�chantillons (<em>samples</em>). Un
    �chantillon est une valeur num�rique, habituellement un entier 16 bits sign�, repr�sentant l'amplitude du son � un
    instant donn�. Le son est ensuite restitu� en jouant ces �chantillons � une fr�quence �lev�e (les CD utilisent une
    fr�quence de 44100 �chantillons par seconde). Plus le taux d'�chantillonnage sera �lev�, meilleure sera la
    qualit� du son. Un son est �galement d�fini par un nombre de canaux. Un son poss�dant un canal est un son mono,
    un son poss�dant deux canaux est un son st�r�o. Des sons plus complexes peuvent utiliser jusqu'� 8 canaux,
    pour les formats dolby (4.1, 5.1, 7.1, etc.).
</p>
<p>
    Avant d'utiliser une quelconque classe du module audio de la SFML, vous devez inclure son en-t�te :
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
</code></pre>
<p>
    Comme d'habitude, il va inclure tous les en-t�tes des classes audio, tout comme les en-t�tes des modules desquels
    il d�pend.
</p>
<p>
    Dans la SFML, la classe qui contient les �chantillons sonores est <?php class_link("SoundBuffer")?>. Vous pouvez le remplir
    � partir d'�chantillons en m�moire :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromSamples(Samples, 5000, 2, 44100))
{
    // Erreur...
}
</code></pre>
<p>
    Le premier param�tre est un pointeur vers le tableau d'�chantillons en m�moire. Ses �l�ments doivent �tre des
    entiers sign�s de 16 bits. Le deuxi�me param�tre, ici 5000, est le nombre d'�chantillons dans le tableau. Le
    troisi�me param�tre est le nombre de canaux (ici nous avons un son st�r�o), et le quatri�me est le taux
    d'�chantillonnage.
</p>
<p>
    Si quelque chose s'est mal pass�, cette fonction renvoie <code>false</code>.
</p>
<p>
    Plus utile : un tampon sonore peut �tre charg� � partir de (et sauv� dans) un fichier audio (les formats les
    plus communs sont support�s).
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromFile("sound.wav"))
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez �galement charger un fichier son directement depuis la m�moire, avec un pointeur vers
    les donn�es du fichier et sa taille en octets :
</p>
<pre><code class="cpp">sf::SoundBuffer Buffer;
if (!Buffer.LoadFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    Le taux d'�chantillonnage et le nombre de canaux sont charg�s automatiquement depuis le fichier. Vous pouvez
    les r�cup�rer en appelant les fonctions suivantes :
</p>
<pre><code class="cpp">unsigned int SampleRate = Buffer.GetSampleRate();
unsigned int Channels   = Buffer.GetChannelsCount();
</code></pre>
<p>
    Vous pouvez �galement r�cup�rer la dur�e du son (en secondes), qui est simplement d�duite du taux d'�chantillonnage
    et du nombre d'�chantillons :
</p>
<pre><code class="cpp">float Duration = Buffer.GetDuration();
</code></pre>
<p>
    Finalement, si vous devez appliquer un traitement particulier aux donn�es audio, vous pouvez acc�der
    au tableau d'�chantillons directement :
</p>
<pre><code class="cpp">const sf::Int16* Samples = Buffer.GetSamples();
std::size_t Count = Buffer.GetSamplesCount();
</code></pre>
<p>
    Voil� tout ce que vous avez � savoir � propos des tampons sonores. La plupart du temps, vous n'aurez besoin que
    de la fonction <code>LoadFromFile</code> pour charger des sons depuis vos fichiers audio.
</p>
<?php h2('L\'instance du son') ?>
<p>
    Une fois que vous avez charg� un tampon sonore, vous pouvez utiliser <?php class_link("Sound")?> pour le jouer.
    Une instance de <?php class_link("Sound")?> est un moyen de jouer un tampon sonore dans la "sc�ne", avec des param�tres
    suppl�mentaires tels que le pitch, le volume, la position, ... Vous pouvez donc avoir plusieurs instances de
    <?php class_link("Sound")?> jouant le m�me <?php class_link("SoundBuffer")?> au m�me moment, avec diff�rents param�tres.
</p>
<p>
    Pour lier un tampon � un son, il suffit d'appeler sa fonction <code>SetBuffer</code> :
</p>
<pre><code class="cpp">sf::Sound Sound;
Sound.SetBuffer(Buffer); // Buffer est un sfSoundBuffer
</code></pre>
<p>
    Ensuite vous pouvez modifier ou r�cup�rer les param�tres du son via ses accesseurs :
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
    <code>SetPitch</code> change la fr�quence fondamentale du son : plus haut est le pitch, plus aig� sera le son.
    La valeur par d�faut est 1<br/>
    <code>SetVolume</code> modifie le volume du son. Le volume varie entre 0 et 100, 100 �tant la valeur par d�faut.
    Vous pouvez affecter un son sup�rieur � 100, mais le r�sultat n'est pas garanti et d�pend de votre syst�me.<br/>
</p>
<p>
    Vous pouvez jouer / mettre en pause / stopper un son :
</p>
<pre><code class="cpp">Sound.Play();
Sound.Pause();
Sound.Play(); // Pour reprendre apr�s un appel � Pause()
Sound.Stop();
</code></pre>
<p>
    Vous pouvez r�cup�rer l'�tat du son :
</p>
<pre><code class="cpp">sf::Sound::Status Status = Sound.GetStatus();
</code></pre>
<p>
    Un son peut �tre <code>Playing</code> (en lecture), <code>Paused</code> (en pause) ou <code>Stopped</code> (stopp�).
</p>
<p>
    Il est �galement possible de r�cup�rer la position de lecture courante, en secondes :
</p>
<pre><code class="cpp">float Position = Sound.GetPlayingOffset();
</code></pre>
<p>
    Et comme d'habitude, aucune destruction n'est n�cessaire : toutes les classes audio vont lib�rer leurs ressources
    automatiquement.
</p>

<?php h2('Gestion des tampons et des sons') ?>
<p>
    Vous devez �tre particuli�rement prudent lorsque vous manipulez des tampons sonores. Une instance de
    <?php class_link("SoundBuffer")?>
    est une ressource qui est lente � charger, lourde � copier et qui utilise beaucoup de m�moire.
</p>
<p>
    Pour une bonne discussion � propos de la gestion des ressources, je vous renvoie au paragraphe
    <strong>"Gestion des images et des sprites"</strong> du
    <a class="internal" href="./graphics-sprite-fr.php" title="Tutoriel sur les sprites">tutoriel sur les sprites</a>,
    en rempla�ant simplement le mot "Image" par "Tampon" et "Sprite" par "Son".
</p>

<?php h2('Conclusion') ?>
<p>
    Maintenant que vous savez jouer des sons, regardons comment
    <a class="internal" href="./audio-music-fr.php" title="Aller au tutoriel suivant">jouer des musiques</a>.
</p>

<?php

    require("footer-fr.php");

?>
