<?php

    $title = "Flux audio personnalisés";
    $page = "audio-streams-fr.php";

    require("header-fr.php");

?>

<h1>Flux audio personnalisés</h1>

<?php h2('Un flux audio ? C\'est quoi ça ?') ?>
<p>
    Un flux (en anglais <em>stream</em>) audio est similaire à une musique (vous vous souvenez de la classe <?php class_link("Music") ?> ?). Il a
    pratiquement les mêmes fonctions et se comporte de la même manière. La seule différence est qu'un flux audio ne jouera pas un fichier audio : il va
    jouer une source audio perso que <em>vous</em> vous chargerez de fournir. En d'autres termes, définir votre propre flux audio vous permet de jouer
    n'importe quoi d'autre qu'un fichier : un flux internet, une musique générée par votre programme, un format non supporté par SFML, etc.
</p>
<p>
    En fait, la classe <?php class_link("Music") ?> est simplement un type particulier de flux audio, spécialisé dans la lecture de fichiers.
</p>
<p>
    Comme nous parlons ici de <em>flux</em>, nous aurons affaire à des données audio qui ne peuvent pas être complètement chargées en mémoire, mais
    qui seront plutôt chargées au fur et à mesure qu'elles sont jouées. Si votre son peut être intégralement chargé et tenir en mémoire sans
    problème, alors oubliez les flux audio : chargez le simplement dans un <?php class_link("SoundBuffer") ?> et utilisez un <?php class_link("Sound") ?>
    pour le jouer.
</p>

<?php h2('sf::SoundStream') ?>
<p>
    Pour définir votre propre flux audio, vous devez hériter de la classe de base abstraite <?php class_link("SoundStream") ?>. Celle-ci possède deux
    fonctions virtuelles que vous devrez redéfinir : <code>onGetData</code> et <code>onSeek</code>.
</p>
<pre><code class="cpp">class MyAudioStream : public sf::SoundStream
{
    virtual bool onGetData(Chunk&amp; data);

    virtual void onSeek(sf::Time timeOffset);
};
</code></pre>
<p>
    <code>onGetData</code> est appelée par la classe de base à chaque fois qu'elle est à court d'échantillons audio et a donc besoin de nouvelles
    données à jouer. Vous devez lui fournir de nouveaux échantillons audio en remplissant le paramètre <code>data</code> :
</p>
<pre><code class="cpp">bool MyAudioStream::onGetData(Chunk&amp; data)
{
    data.samples = /* mettez ici un pointeur vers les nouvelles données audio */;
    data.sampleCount = /* mettez ici le nombre d'échantillons pointés */;
    return true;
}
</code></pre>
<p>
    Vous devez renvoyer <code>true</code> lorsque tout est ok, ou <code>false</code> s'il faut stopper le flux, soit parce qu'une erreur est
    survenue, soit parce qu'il n'y a tout simplement plus de données audio à jouer.
</p>
<p>
    SFML crée une copie interne des échantillons audio dès que <code>onGetData</code> a fini, donc vous n'avez pas besoin de garder en mémoire les
    données que vous renvoyez, elles peuvent être effacées immédiatement après.
</p>
<p>
    <code>onSeek</code> est exécutée lorsque la fonction publique <code>setPlayingOffset</code> est appelée. Son but est de changer la position de lecture
    courante dans la source de données. Le paramètre est une valeur de temps représentant la nouvelle position, relativement au début du son (et non à
    la position courante). Cette fonction est parfois impossible à implémenter, par rapport au type du flux ; dans ce cas laissez-la vide et indiquez
    aux utilisateurs de votre classe que changer la position de lecture n'est pas supporté.
</p>
<p>
    Désormais votre classe est quasiment prête à fonctionner. La seule chose que <?php class_link("SoundStream") ?> doit encore savoir, est le nombre
    de canaux ainsi que le taux d'échantillonnage du flux, afin de pouvoir le restituer correctement. Pour transmettre ces paramètres à la classe de
    base, vous devez appeler la fonction protégée <code>initialize</code> dès que ceux-ci sont connus (donc très probablement lorsque le flux est
    chargé/initialisé).
</p>
<pre><code class="cpp">// l'endroit où ceci est fait, dépend complètement de comment votre classe est conçue
unsigned int channelCount = ...;
unsigned int sampleRate = ...;
initialize(channelCount, sampleRate);
</code></pre>

<?php h2('Attention aux threads') ?>
<p>
    Les flux audio étant toujours joués dans un thread, il est important de savoir ce qui se passe exactement, et où.
</p>
<p>
    <code>onSeek</code> est appelée directement par la fonction <code>setPlayingOffset</code>, elle est donc toujours exécutée dans le thread qui
    a appelé cette dernière. Par contre, la fonction <code>onGetData</code> sera appelée regulièrement tant que le flux sera en train d'être joué,
    dans un autre thread créé par SFML. En conséquence, si votre flux utilise des données qui peuvent être accédées de manière <em>concurrente</em>
    (c'est-à-dire en même temps) à la fois par le thread appelant et par le thread de lecture (celui créé par SFML), vous devez les protéger (avec un mutex
    ou autre) afin d'éviter les accès concurrents, qui pourraient causer des comportements indéterminés -- données audio corrompues, crashs, etc.
</p>
<p>
    Si vous n'êtes pas suffisamment à l'aise avec les problèmes liés aux threads, vous pouvez faire un saut par le
    <a class="internal" href="./system-thread-fr.php" title="Tutoriel sur les threads">tutoriel correspondant</a>.
</p>

<?php h2('Utilisation de votre flux audio') ?>
<p>
    Maintenant que vous avez défini votre propre classe de flux audio, voyons comment l'utiliser. En fait, c'est très similaire à ce qui est expliqué
    dans le <a class="internal" href="./audio-sounds-fr.php" title="Tutoriel : jouer des sons et des musiques">tutoriel sur sf::Music</a>. Vous pouvez
    contrôler la lecture avec les fonctions <code>play</code>, <code>pause</code>, <code>stop</code> et <code>setPlayingOffset</code>. Vous pouvez aussi
    jouer avec les propriétés du son, telles que le volume ou le pitch. Vous pouvez vous référer à la documentation de l'API ou aux autres tutoriels
    audio pour plus de détails.
</p>

<?php h2('Un example simple') ?>
<p>
    Voici un exemple très simple de classe de flux audio, qui joue les données d'un buffer audio. Une telle classe est bien entendu complètement
    inutile, mais le but ici est de se focaliser sur la manière dont les données audio sont gérées par la classe, peu importe d'où elles viennent.
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
#include &lt;vector&gt;

// flux audio qui joue un buffer déjà chargé
class MyStream : public sf::SoundStream
{
public:

    void load(const sf::SoundBuffer&amp; buffer)
    {
        // extraction des échantillons audio du buffer, vers notre propre conteneur
        m_samples.assign(buffer.getSamples(), buffer.getSamples() + buffer.getSampleCount());

        // remise à zéro de la position de lecture
        m_currentSample = 0;

        // initialisation de la classe de base
        initialize(buffer.getChannelCount(), buffer.getSampleRate());
    }

private:

    virtual bool onGetData(Chunk&amp; data)
    {
        // nombre d'échantillons à renvoyer à chaque fois que cette fonction est appelée ;
        // dans une implémentation plus robuste, on utiliserait plutôt une durée fixe
        // plutôt qu'un nombre arbitraire d'échantillons
        const int samplesToStream = 50000;

        // affectation des prochains échantillons à jouer
        data.samples = &amp;m_samples[m_currentSample];

        // a-t-on atteint la fin du son ?
        if (m_currentSample + samplesToStream &lt;= m_samples.size())
        {
            // fin non atteinte : on envoie les échantillons et on continue
            data.sampleCount = samplesToStream;
            m_currentSample += samplesToStream;
            return true;
        }
        else
        {
            // fin atteinte : on envoie ce qu'il reste d'échantillons et on stoppe la lecture
            data.sampleCount = m_samples.size() - m_currentSample;
            m_currentSample = m_samples.size();
            return false;
        }
    }

    virtual void onSeek(sf::Time timeOffset)
    {
        // calcul du numéro d'échantillon correspondant, en fonction du taux d'échantillonnage et du nombre de canaux
        m_currentSample = static_cast&lt;std::size_t&gt;(timeOffset.asSeconds() * getSampleRate() * getChannelCount());
    }

    std::vector&lt;sf::Int16&gt; m_samples;
    std::size_t m_currentSample;
};

int main()
{
    // chargement d'un buffer audio à partir d'un fichier
    sf::SoundBuffer buffer;
    buffer.loadFromFile("sound.wav");

    // initialisation et lecture de notre flux
    MyStream stream;
    stream.load(buffer);
    stream.play();

    // on le laisse jouer jusqu'à la fin
    while (stream.getStatus() == MyStream::Playing)
        sf::sleep(sf::seconds(0.1f));

    return 0;
}
</code></pre>

<?php

    require("footer-fr.php");

?>
