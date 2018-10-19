<?php

    $title = "Jouer des sons et des musiques";
    $page = "audio-sounds-fr.php";

    require("header-fr.php");

?>

<h1>Jouer des sons et des musiques</h1>

<?php h2('Son ou musique') ?>
<p>
    SFML fournit deux classes pour jouer de l'audio : <?php class_link("Sound")?> et <?php class_link("Music")?>. Elles offrent toutes deux plus ou moins
    les mêmes fonctionnalités, la principale différence est la manière dont elles fonctionnent.
</p>
<p>
    <?php class_link("Sound")?> est une classe légère qui joue des données audio chargées au préalable dans un <?php class_link("SoundBuffer")?>. Il faut
    l'utiliser pour des sons relativement courts qui peuvent tenir sans problème en mémoire, et qui ne doivent souffrir d'aucun lag lorsqu'ils sont
    joués. Par exemple : des coups de feu, des bruits de pas, etc.
</p>
<p>
    <?php class_link("Music")?> ne charge pas toutes les données audio en mémoire, à la place elle les lit en flux (elle les "<em>stream</em>") à la volée
    directement à partir du fichier d'origine. Cette classe est utilisée typiquement pour jouer des musiques compressées qui durent plusieurs
    minutes, et qui prendraient plusieurs secondes à charger et consommeraient des centaines de Mo en mémoire si elles étaient intégralement
    pré-chargées.
</p>

<?php h2('Charger et jouer un son') ?>
<p>
    Comme vous l'avez vu ci-dessus, les données du son ne sont pas stockées directement dans <?php class_link("Sound")?> mais dans une classe à part
    nommée <?php class_link("SoundBuffer")?>. Cette classe encapsule les données audio, qui ne sont ni plus ni moins qu'un tableau d'entiers 16 bits
    (ceux-ci étant appelés "échantillons audio"). Un échantillon représente, en gros, l'amplitude du signal audio à un instant donné, et un tableau
    d'échantillons représente donc un son complet.
</p>

<p class="important">
    En fait, les classes <?php class_link("Sound")?>/<?php class_link("SoundBuffer")?> fonctionnent exactement de la même manière que le couple
    <?php class_link("Sprite")?>/<?php class_link("Texture")?> du module graphique. Donc si vous comprenez comment les sprites et les textures
    travaillent main dans la main, vous pouvez appliquer le même concept aux sons et aux buffers.
</p>
<p>
    Vous pouvez charger un <?php class_link("SoundBuffer")?> depuis un fichier avec sa fonction <code>loadFromFile</code> :
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;

int main()
{
    sf::SoundBuffer buffer;
    if (!buffer.loadFromFile("sound.wav"))
        return -1;

    ...

    return 0;
}
</code></pre>
<p>
    Comme d'habitude, plutôt qu'un fichier sur le disque vous pouvez également charger un fichier qui se trouve directement en mémoire
    (<code>loadFromMemory</code>) ou qui est accessible via un
    <a class="internal" href="./system-stream-fr.php" title="Tutoriel sur les flux de données">flux de données perso</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supporte les formats WAV, OGG/Vorbis et FLAC. En raison de l'octroi de licences, le format MP3 n'est <strong>pas</strong> supporté.
</p>
<p>
    Vous pouvez aussi charger un buffer directement depuis un tableau d'échantillons, au cas où vous les auriez récupéré depuis autre chose
    qu'un fichier :
</p>
<pre><code class="cpp">std::vector&lt;sf::Int16&gt; samples = ...;
buffer.loadFromSamples(&amp;samples[0], samples.size(), 2, 44100);
</code></pre>
<p>
    Etant donné que <code>loadFromSamples</code> charge un tableau d'échantillons bruts plutôt qu'un fichier audio, il faut lui passer quelques
    paramètres supplémentaires afin que la description du son soit complète. Le premier (troisième paramètre de la fonction) est le nombre de canaux :
    1 canal définit un son mono, 2 canaux définissent un son stéréo, etc. Le second paramètre additionnel (quatrième de la fonction) est le taux
    d'échantillonnage; il définit combien d'échantillons doivent être joués par seconde afin de restituer le son d'origine.
</p>
<p>
    Maintenant que les données audio sont chargées en mémoire, il ne reste plus qu'à les jouer avec une instance de <?php class_link("Sound")?>.
</p>
<pre><code class="cpp">sf::SoundBuffer buffer;
// on charge quelque chose dans le buffer...

sf::Sound sound;
sound.setBuffer(buffer);
sound.play();
</code></pre>
<p>
    Le truc cool, c'est que vous pouvez affecter le même buffer à plusieurs sons si vous le souhaitez. Vous pouvez même les jouer tous en même temps,
    aucun problème.
</p>
<p class="important">
    Les sons (et les musiques) sont jouées dans un thread à part. Cela signifie que vous pouvez faire tout ce que vous voulez après avoir appelé
    <code>play()</code> (sauf détruire le son ou son buffer, bien entendu), le son va continuer de jouer jusqu'à ce qu'il se termine ou soit stoppé
    explicitement.
</p>

<?php h2('Jouer une musique') ?>
<p>
    Contrairement à <?php class_link("Sound")?>, <?php class_link("Music")?> ne précharge pas les données audio, elle les lit à la demande directement
    depuis la source. L'initialisation d'une musique est donc plus directe :
</p>
<pre><code class="cpp">sf::Music music;
if (!music.openFromFile("music.ogg"))
    return -1; // erreur
music.play();
</code></pre>
<p>
    Il est important de noter que, contrairement aux autres classes de ressource de SFML, la fonction de chargement est nommée <code>openFromFile</code>
    et non <code>loadFromFile</code>. C'est parce que la musique n'est pas réellement chargée, tout ce que fait cette fonction c'est ouvrir le fichier.
    Les données ne sont lues que plus tard, lorsque la musique est jouée. Cela aide aussi à garder en tête que le fichier audio doit rester disponible
    aussi longtemps qu'il est joué.<br />
    Les autres fonctions de chargement de <?php class_link("Music")?> suivent la même convention : <code>openFromMemory</code>,
    <code>openFromStream</code>.
</p>

<?php h2('Et ensuite ?') ?>
<p>
    Maintenant que vous êtes capables de charger et jouer un son ou une musique, voyons ce que vous pouvez en faire.
</p>
<p>
    Afin de contrôler la lecture, les fonctions suivantes sont disponibles :
</p>
<ul>
    <li><code>play</code> démarre ou reprend la lecture</li>
    <li><code>pause</code> met en pause la lecture</li>
    <li><code>stop</code> arrête la lecture et revient au début</li>
    <li><code>setPlayingOffset</code> change la position actuelle de lecture</li>
</ul>
<p>
    Exemple :
</p>
<pre><code class="cpp">// on démarre la lecture
sound.play();

// on avance de deux secondes
sound.setPlayingOffset(sf::seconds(2.f));

// on met en pause
sound.pause();

// on reprend la lecture
sound.play();

// on arrête la lecture et on se replace au début
sound.stop();
</code></pre>
<p>
    La fonction <code>getStatus</code> renvoie l'état de lecture d'un son ou d'une musique, vous pouvez l'utiliser pour savoir si celui-ci est arrêté,
    en cours de lecture ou en pause.
</p>
<p>
    Les sons et les musiques définissent également quelques propriétés qui peuvent être modifiées à tout moment.
</p>
    Le <em>pitch</em> est un facteur qui modifie la fréquence perçue du son : plus que 1 rend le son plus aigü, moins que 1 rend le son plus grave,
    et 1 restitue le son d'origine. Attention, la modification du pitch a un effet de bord : cela change aussi la vitesse de lecture.
</p>
<pre><code class="cpp">sound.setPitch(1.2f);
</code></pre>
<p>
    Le <em>volume</em> est... le volume. Sa valeur est comprise entre 0 (muet) et 100 (volume maximum). La valeur par défaut est 100, ce qui signifie
    qu'il est impossible d'augmenter le volume d'un son au-delà de son volume d'origine.
</p>
<pre><code class="cpp">sound.setVolume(50.f);
</code></pre>
</p>
    La propriété <em>loop</em> détermine si le son ou la musique boucle automatiquement ou non. S'il boucle, il recommencera à zéro dès qu'il se finira,
    encore et encore jusqu'à ce que vous appeliez explicitement <code>stop</code>. Sinon, il s'arrêtera automatiquement lorsqu'il est fini.
</p>
<pre><code class="cpp">sound.setLoop(true);
</code></pre>
<p>
    D'autres propriétés sont disponible, mais elles sont liées à la spacialisation et sont expliquées dans le
    <a class="internal" href="./audio-spatialization-fr.php" title="Tutoriel sur la spacialisation">tutoriel correspondant</a>.
</p>

<?php h2('Erreur courantes') ?>

<h3>Buffer audio détruit</h3>
<p>
    L'erreur la plus courante est de déclarer un buffer dans une portée réduite (telle qu'une fonction) et le laisser mourir à la fin alors qu'un son
    l'utilise toujours.
</p>
<pre><code class="cpp">sf::Sound loadSound(std::string filename)
{
    sf::SoundBuffer buffer; // ce buffer est local à la fonction, il sera détruit...
    buffer.loadFromFile(filename);
    return sf::Sound(buffer);
} // ... ici

sf::Sound sound = loadSound("s.wav");
sound.play(); // ERREUR : le buffer du son n'existe plus, le comportement est indéterminé
</code></pre>
<p>
    Souvenez-vous qu'un son ne garde qu'un <em>pointeur</em> vers le buffer que vous lui affectez, il n'en fait pas de copie. Vous devez donc
    gérer correctement la durée de vie de vos buffers, de façon à ce qu'ils restent en vie tant qu'ils sont utilisés par des sons.
</p>

<h3>Trop de sons</h3>
<p>
    Une autre source d'erreur est d'essayer de créer un nombre important de sons. SFML possède une limite interne ; celle-ci peut varier en fonction
    de l'OS, mais vous ne devriez jamais aller au-delà de 256. Cette limite est le nombre d'instances de <?php class_link("Sound")?> et
    <?php class_link("Music")?> qui peuvent exister simultanément. Une bonne façon de ne jamais la dépasser est de détruire (ou de recycler) les sons
    inutilisés, plutôt que de les garder en vie pour rien. Ce paragraphe n'a d'importance que si vous devez vraiment gérer un nombre important de sons et de
    musiques, bien entendu.
</p>

<h3>Source d'une musique détruite avant qu'elle ne soit finie</h3>
<p>
    Souvenez-vous qu'une musique a besoin de sa source aussi longtemps qu'elle est jouée, puisque qu'elle charge les données au fur
    et à mesure de la lecture. Ok, un fichier audio sur votre disque a très peu de chances d'être supprimé ou déplacé alors que votre application est
    en train de le jouer. Cependant les choses se compliquent lorsque vous jouez une musique depuis un fichier en mémoire, ou lu depuis un flux
    d'entrée perso :
</p>
<pre><code class="cpp">// on démarre avec un fichier audio en mémoire (imaginez que l'on vient de l'extraire d'une archive zip)
std::vector&lt;char&gt; fileData = ...;

// on le joue
sf::Music music;
music.openFromMemory(&amp;fileData[0], fileData.size());
music.play();

// "ok, il semblerait que l'on puisse se passer du fichier maintenant"
fileData.clear();

// ERREUR: la musique était toujours en train de lire le contenu de fileData! le comportement est maintenant indéterminé
</code></pre>

<h3>sf::Music n'est pas copiable</h3>
<p>
    Et pour terminer, un petit rappel : la classe <?php class_link("Music")?> n'est <em>pas copiable</em>, donc le compilateur ne vous laissera pas
    faire ceci :
</p>
<pre><code class="cpp">sf::Music music;
sf::Music anotherMusic = music; // ERREUR

void doSomething(sf::Music music)
{
    ...
}
sf::Music music;
doSomething(music); // ERREUR (la fonction devrait prendre son paramètre par référence, pas par copie)
</code></pre>

<?php

    require("footer-fr.php");

?>
