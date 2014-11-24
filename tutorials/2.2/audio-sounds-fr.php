<?php

    $title = "Jouer des sons et des musiques";
    $page = "audio-sounds-fr.php";

    require("header-fr.php");

?>

<h1>Jouer des sons et des musiques</h1>

<?php h2('Son ou musique') ?>
<p>
    SFML fournit deux classes pour jouer de l'audio : <?php class_link("Sound")?> et <?php class_link("Music")?>. Elles offrent toutes deux plus ou moins
    les m�mes fonctionnalit�s, la principale diff�rence est la mani�re dont elles fonctionnent.
</p>
<p>
    <?php class_link("Sound")?> est une classe l�g�re qui joue des donn�es audio charg�es au pr�alable dans un <?php class_link("SoundBuffer")?>. Il faut
    l'utiliser pour des sons relativement courts qui peuvent tenir sans probl�me en m�moire, et qui ne doivent souffrir d'aucun lag lorsqu'ils sont
    jou�s. Par exemple : des coups de feu, des bruits de pas, etc.
</p>
<p>
    <?php class_link("Music")?> ne charge pas toutes les donn�es audio en m�moire, � la place elle les lit en flux (elle les "<em>stream</em>") � la vol�e
    directement � partir du fichier d'origine. Cette classe est utilis�e typiquement pour jouer des musiques compress�es qui durent plusieurs
    minutes, et qui prendraient plusieurs secondes � charger et consommeraient des centaines de Mo en m�moire si elles �taient int�gralement
    pr�-charg�es.
</p>

<?php h2('Charger et jouer un son') ?>
<p>
    Comme vous l'avez vu ci-dessus, les donn�es du son ne sont pas stock�es directement dans <?php class_link("Sound")?> mais dans une classe � part
    nomm�e <?php class_link("SoundBuffer")?>. Cette classe encapsule les donn�es audio, qui ne sont ni plus ni moins qu'un tableau d'entiers 16 bits
    (ceux-ci �tant appel�s "�chantillons audio"). Un �chantillon repr�sente, en gros, l'amplitude du signal audio � un instant donn�, et un tableau
    d'�chantillons repr�sente donc un son complet.
</p>

<p class="important">
    En fait, les classes <?php class_link("Sound")?>/<?php class_link("SoundBuffer")?> fonctionnent exactement de la m�me mani�re que le couple
    <?php class_link("Sprite")?>/<?php class_link("Texture")?> du module graphique. Donc si vous comprenez comment les sprites et les textures
    travaillent main dans la main, vous pouvez appliquer le m�me concept aux sons et aux buffers.
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
    Comme d'habitude, plut�t qu'un fichier sur le disque vous pouvez �galement charger un fichier qui se trouve directement en m�moire
    (<code>loadFromMemory</code>) ou qui est accessible via un
    <a class="internal" href="./system-stream-fr.php" title="Tutoriel sur les flux de donn�es">flux de donn�es perso</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supporte les formats de fichier les plus courants. La liste compl�te est consultable dans la documentation de l'API.
</p>
<p>
    Vous pouvez aussi charger un buffer directement depuis un tableau d'�chantillons, au cas o� vous les auriez r�cup�r� depuis autre chose
    qu'un fichier :
</p>
<pre><code class="cpp">std::vector&lt;sf::Int16&gt; samples = ...;
buffer.loadFromSamples(&amp;samples[0], samples.size(), 2, 44100);
</code></pre>
<p>
    Etant donn� que <code>loadFromSamples</code> charge un tableau d'�chantillons bruts plut�t qu'un fichier audio, il faut lui passer quelques
    param�tres suppl�mentaires afin que la description du son soit compl�te. Le premier (troisi�me param�tre de la fonction) est le nombre de canaux :
    1 canal d�finit un son mono, 2 canaux d�finissent un son st�r�o, etc. Le second param�tre additionnel (quatri�me de la fonction) est le taux
    d'�chantillonnage; il d�finit combien d'�chantillons doivent �tre jou�s par seconde afin de restituer le son d'origine.
</p>
<p>
    Maintenant que les donn�es audio sont charg�es en m�moire, il ne reste plus qu'� les jouer avec une instance de <?php class_link("Sound")?>.
</p>
<pre><code class="cpp">sf::SoundBuffer buffer;
// on charge quelque chose dans le buffer...

sf::Sound sound;
sound.setBuffer(buffer);
sound.play();
</code></pre>
<p>
    Le truc cool, c'est que vous pouvez affecter le m�me buffer � plusieurs sons si vous le souhaitez. Vous pouvez m�me les jouer tous en m�me temps,
    aucun probl�me.
</p>
<p class="important">
    Les sons (et les musiques) sont jou�es dans un thread � part. Cela signifie que vous pouvez faire tout ce que vous voulez apr�s avoir appel�
    <code>play()</code> (sauf d�truire le son ou son buffer, bien entendu), le son va continuer de jouer jusqu'� ce qu'il se termine ou soit stopp�
    explicitement.
</p>

<?php h2('Jouer une musique') ?>
<p>
    Contrairement � <?php class_link("Sound")?>, <?php class_link("Music")?> ne pr�charge pas les donn�es audio, elle les lit � la demande directement
    depuis la source. L'initialisation d'une musique est donc plus directe :
</p>
<pre><code class="cpp">sf::Music music;
if (!music.openFromFile("music.ogg"))
    return -1; // erreur
music.play();
</code></pre>
<p>
    Il est important de noter que, contrairement aux autres classes de ressource de SFML, la fonction de chargement est nomm�e <code>openFromFile</code>
    et non <code>loadFromFile</code>. C'est parce que la musique n'est pas r�ellement charg�e, tout ce que fait cette fonction c'est ouvrir le fichier.
    Les donn�es ne sont lues que plus tard, lorsque la musique est jou�e. Cela aide aussi � garder en t�te que le fichier audio doit rester disponible
    aussi longtemps qu'il est jou�.<br />
    Les autres fonctions de chargement de <?php class_link("Music")?> suivent la m�me convention : <code>openFromMemory</code>,
    <code>openFromStream</code>.
</p>

<?php h2('Et ensuite ?') ?>
<p>
    Maintenant que vous �tes capables de charger et jouer un son ou une musique, voyons ce que vous pouvez en faire.
</p>
<p>
    Afin de contr�ler la lecture, les fonctions suivantes sont disponibles :
</p>
<ul>
    <li><code>play</code> d�marre ou reprend la lecture</li>
    <li><code>pause</code> met en pause la lecture</li>
    <li><code>stop</code> arr�te la lecture et revient au d�but</li>
    <li><code>setPlayingOffset</code> change la position actuelle de lecture</li>
</ul>
<p>
    Exemple :
</p>
<pre><code class="cpp">// on d�marre la lecture
sound.play();

// on avance de deux secondes
sound.setPlayingOffset(sf::seconds(2));

// on met en pause
sound.pause();

// on reprend la lecture
sound.play();

// on arr�te la lecture et on se replace au d�but
sound.stop();
</code></pre>
<p>
    La fonction <code>getStatus</code> renvoie l'�tat de lecture d'un son ou d'une musique, vous pouvez l'utiliser pour savoir si celui-ci est arr�t�,
    en cours de lecture ou en pause.
</p>
<p>
    Les sons et les musiques d�finissent �galement quelques propri�t�s qui peuvent �tre modifi�es � tout moment.
</p>
    Le <em>pitch</em> est un facteur qui modifie la fr�quence per�ue du son : plus que 1 rend le son plus aig�, moins que 1 rend le son plus grave,
    et 1 restitue le son d'origine. Attention, la modification du pitch a un effet de bord : cela change aussi la vitesse de lecture.
</p>
<pre><code class="cpp">sound.setPitch(1.2);
</code></pre>
<p>
    Le <em>volume</em> est... le volume. Sa valeur est comprise entre 0 (muet) et 100 (volume maximum). La valeur par d�faut est 100, ce qui signifie
    qu'il est impossible d'augmenter le volume d'un son au-del� de son volume d'origine.
</p>
<pre><code class="cpp">sound.setVolume(50);
</code></pre>
</p>
    La propri�t� <em>loop</em> d�termine si le son ou la musique boucle automatiquement ou non. S'il boucle, il recommencera � z�ro d�s qu'il se finira,
    encore et encore jusqu'� ce que vous appeliez explicitement <code>stop</code>. Sinon, il s'arr�tera automatiquement lorsqu'il est fini.
</p>
<pre><code class="cpp">sound.setLoop(true);
</code></pre>
<p>
    D'autres propri�t�s sont disponible, mais elles sont li�es � la spacialisation et sont expliqu�es dans le
    <a class="internal" href="./audio-spatialization-fr.php" title="Tutoriel sur la spacialisation">tutoriel correspondant</a>.
</p>

<?php h2('Erreur courantes') ?>

<h3>Buffer audio d�truit</h3>
<p>
    L'erreur la plus courante est de d�clarer un buffer dans une port�e r�duite (telle qu'une fonction) et le laisser mourir � la fin alors qu'un son
    l'utilise toujours.
</p>
<pre><code class="cpp">sf::Sound loadSound(std::string filename)
{
    sf::SoundBuffer buffer; // ce buffer est local � la fonction, il sera d�truit...
    buffer.loadFromFile(filename);
    return sf::Sound(buffer);
} // ... ici

sf::Sound sound = loadSound("s.wav");
sound.play(); // ERREUR : le buffer du son n'existe plus, le comportement est ind�termin�
</code></pre>
<p>
    Souvenez-vous qu'un son ne garde qu'un <em>pointeur</em> vers le buffer que vous lui affectez, il n'en fait pas de copie. Vous devez donc
    g�rer correctement la dur�e de vie de vos buffers, de fa�on � ce qu'ils restent en vie tant qu'ils sont utilis�s par des sons.
</p>

<h3>Trop de sons</h3>
<p>
    Une autre source d'erreur est d'essayer de cr�er un nombre important de sons. SFML poss�de une limite interne ; celle-ci peut varier en fonction
    de l'OS, mais vous ne devriez jamais aller au-del� de 256. Cette limite est le nombre d'instances de <?php class_link("Sound")?> et
    <?php class_link("Music")?> qui peuvent exister simultan�ment. Une bonne fa�on de ne jamais la d�passer est de d�truire (ou de recycler) les sons
    inutilis�s, plut�t que de les garder en vie pour rien. Ce paragraphe n'a d'importance que si vous devez vraiment g�rer un nombre important de sons et de
    musiques, bien entendu.
</p>

<h3>Source d'une musique d�truite avant qu'elle ne soit finie</h3>
<p>
    Souvenez-vous qu'une musique a besoin de sa source aussi longtemps qu'elle est jou�e, puisque qu'elle charge les donn�es au fur
    et � mesure de la lecture. Ok, un fichier audio sur votre disque a tr�s peu de chances d'�tre supprim� ou d�plac� alors que votre application est
    en train de le jouer. Cependant les choses se compliquent lorsque vous jouez une musique depuis un fichier en m�moire, ou lu depuis un flux
    d'entr�e perso :
</p>
<pre><code class="cpp">// on d�marre avec un fichier audio en m�moire (imaginez que l'on vient de l'extraire d'une archive zip)
std::vector&lt;char&gt; fileData = ...;

// on le joue
sf::Music music;
music.openFromMemory(&amp;fileData[0], fileData.size());
music.play();

// "ok, il semblerait que l'on puisse se passer du fichier maintenant"
fileData.clear();

// ERREUR: la musique �tait toujours en train de lire le contenu de fileData! le comportement est maintenant ind�termin�
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
doSomething(music); // ERREUR (la fonction devrait prendre son param�tre par r�f�rence, pas par copie)
</code></pre>

<?php

    require("footer-fr.php");

?>
