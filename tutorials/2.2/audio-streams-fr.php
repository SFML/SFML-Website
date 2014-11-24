<?php

    $title = "Flux audio personnalis�s";
    $page = "audio-streams-fr.php";

    require("header-fr.php");

?>

<h1>Flux audio personnalis�s</h1>

<?php h2('Un flux audio ? C\'est quoi �a ?') ?>
<p>
    Un flux (en anglais <em>stream</em>) audio est similaire � une musique (vous vous souvenez de la classe <?php class_link("Music") ?> ?). Il a
    pratiquement les m�mes fonctions et se comporte de la m�me mani�re. La seule diff�rence est qu'un flux audio ne jouera pas un fichier audio : il va
    jouer une source audio perso que <em>vous</em> vous chargerez de fournir. En d'autres termes, d�finir votre propre flux audio vous permet de jouer
    n'importe quoi d'autre qu'un fichier : un flux internet, une musique g�n�r�e par votre programme, un format non support� par SFML, etc.
</p>
<p>
    En fait, la classe <?php class_link("Music") ?> est simplement un type particulier de flux audio, sp�cialis� dans la lecture de fichiers.
</p>
<p>
    Comme nous parlons ici de <em>flux</em>, nous aurons affaire � des donn�es audio qui ne peuvent pas �tre compl�tement charg�es en m�moire, mais
    qui seront plut�t charg�es au fur et � mesure qu'elles sont jou�es. Si votre son peut �tre int�gralement charg� et tenir en m�moire sans
    probl�me, alors oubliez les flux audio : chargez le simplement dans un <?php class_link("SoundBuffer") ?> et utilisez un <?php class_link("Sound") ?>
    pour le jouer.
</p>

<?php h2('sf::SoundStream') ?>
<p>
    Pour d�finir votre propre flux audio, vous devez h�riter de la classe de base abstraite <?php class_link("SoundStream") ?>. Celle-ci poss�de deux
    fonctions virtuelles que vous devrez red�finir : <code>onGetData</code> et <code>onSeek</code>.
</p>
<pre><code class="cpp">class MyAudioStream : public sf::SoundStream
{
    virtual bool onGetData(Chunk&amp; data);

    virtual void onSeek(sf::Time timeOffset);
};
</code></pre>
<p>
    <code>onGetData</code> est appel�e par la classe de base � chaque fois qu'elle est � court d'�chantillons audio et a donc besoin de nouvelles
    donn�es � jouer. Vous devez lui fournir de nouveaux �chantillons audio en remplissant le param�tre <code>data</code> :
</p>
<pre><code class="cpp">bool MyAudioStream::onGetData(Chunk&amp; data)
{
    data.samples = /* mettez ici un pointeur vers les nouvelles donn�es audio */;
    data.sampleCount = /* mettez ici le nombre d'�chantillons point�s */;
    return true;
}
</code></pre>
<p>
    Vous devez renvoyer <code>true</code> lorsque tout est ok, ou <code>false</code> s'il faut stopper le flux, soit parce qu'une erreur est
    survenue, soit parce qu'il n'y a tout simplement plus de donn�es audio � jouer.
</p>
<p>
    SFML cr�e une copie interne des �chantillons audio d�s que <code>onGetData</code> a fini, donc vous n'avez pas besoin de garder en m�moire les
    donn�es que vous renvoyez, elles peuvent �tre effac�es imm�diatement apr�s.
</p>
<p>
    <code>onSeek</code> est ex�cut�e lorsque la fonction publique <code>setPlayingOffset</code> est appel�e. Son but est de changer la position de lecture
    courante dans la source de donn�es. Le param�tre est une valeur de temps repr�sentant la nouvelle position, relativement au d�but du son (et non �
    la position courante). Cette fonction est parfois impossible � impl�menter, par rapport au type du flux ; dans ce cas laissez-la vide et indiquez
    aux utilisateurs de votre classe que changer la position de lecture n'est pas support�.
</p>
<p>
    D�sormais votre classe est quasiment pr�te � fonctionner. La seule chose que <?php class_link("SoundStream") ?> doit encore savoir, est le nombre
    de canaux ainsi que le taux d'�chantillonnage du flux, afin de pouvoir le restituer correctement. Pour transmettre ces param�tres � la classe de
    base, vous devez appeler la fonction prot�g�e <code>initialize</code> d�s que ceux-ci sont connus (donc tr�s probablement lorsque le flux est
    charg�/initialis�).
</p>
<pre><code class="cpp">// l'endroit o� ceci est fait, d�pend compl�tement de comment votre classe est con�ue
unsigned int channelCount = ...;
unsigned int sampleRate = ...;
initialize(channelCount, sampleRate);
</code></pre>

<?php h2('Attention aux threads') ?>
<p>
    Les flux audio �tant toujours jou�s dans un thread, il est important de savoir ce qui se passe exactement, et o�.
</p>
<p>
    <code>onSeek</code> est appel�e directement par la fonction <code>setPlayingOffset</code>, elle est donc toujours ex�cut�e dans le thread qui
    a appel� cette derni�re. Par contre, la fonction <code>onGetData</code> sera appel�e reguli�rement tant que le flux sera en train d'�tre jou�,
    dans un autre thread cr�� par SFML. En cons�quence, si votre flux utilise des donn�es qui peuvent �tre acc�d�es de mani�re <em>concurrente</em>
    (c'est-�-dire en m�me temps) � la fois par le thread appelant et par le thread de lecture (celui cr�� par SFML), vous devez les prot�ger (avec un mutex
    ou autre) afin d'�viter les acc�s concurrents, qui pourraient causer des comportements ind�termin�s -- donn�es audio corrompues, crashs, etc.
</p>
<p>
    Si vous n'�tes pas suffisamment � l'aise avec les probl�mes li�s aux threads, vous pouvez faire un saut par le
    <a class="internal" href="./system-thread-fr.php" title="Tutoriel sur les threads">tutoriel correspondant</a>.
</p>

<?php h2('Utilisation de votre flux audio') ?>
<p>
    Maintenant que vous avez d�fini votre propre classe de flux audio, voyons comment l'utiliser. En fait, c'est tr�s similaire � ce qui est expliqu�
    dans le <a class="internal" href="./audio-sounds-fr.php" title="Tutoriel : jouer des sons et des musiques">tutoriel sur sf::Music</a>. Vous pouvez
    contr�ler la lecture avec les fonctions <code>play</code>, <code>pause</code>, <code>stop</code> et <code>setPlayingOffset</code>. Vous pouvez aussi
    jouer avec les propri�t�s du son, telles que le volume ou le pitch. Vous pouvez vous r�f�rer � la documentation de l'API ou aux autres tutoriels
    audio pour plus de d�tails.
</p>

<?php h2('Un example simple') ?>
<p>
    Voici un exemple tr�s simple de classe de flux audio, qui joue les donn�es d'un buffer audio. Une telle classe est bien entendu compl�tement
    inutile, mais le but ici est de se focaliser sur la mani�re dont les donn�es audio sont g�r�es par la classe, peu importe d'o� elles viennent.
</p>
<pre><code class="cpp">#include &lt;SFML/Audio.hpp&gt;
#include &lt;vector&gt;

// flux audio qui joue un buffer d�j� charg�
class MyStream : public sf::SoundStream
{
public:

    void load(const sf::SoundBuffer&amp; buffer)
    {
        // extraction des �chantillons audio du buffer, vers notre propre conteneur
        m_samples.assign(buffer.getSamples(), buffer.getSamples() + buffer.getSampleCount());

        // remise � z�ro de la position de lecture
        m_currentSample = 0;

        // initialisation de la classe de base
        initialize(buffer.getChannelCount(), buffer.getSampleRate());
    }

private:

    virtual bool onGetData(Chunk&amp; data)
    {
        // nombre d'�chantillons � renvoyer � chaque fois que cette fonction est appel�e ;
        // dans une impl�mentation plus robuste, on utiliserait plut�t une dur�e fixe
        // plut�t qu'un nombre arbitraire d'�chantillons
        const int samplesToStream = 50000;

        // affectation des prochains �chantillons � jouer
        data.samples = &amp;m_samples[m_currentSample];

        // a-t-on atteint la fin du son ?
        if (m_currentSample + samplesToStream &lt;= m_samples.size())
        {
            // fin non atteinte : on envoie les �chantillons et on continue
            data.sampleCount = samplesToStream;
            m_currentSample += samplesToStream;
            return true;
        }
        else
        {
            // fin atteinte : on envoie ce qu'il reste d'�chantillons et on stoppe la lecture
            data.sampleCount = m_samples.size() - m_currentSample;
            m_currentSample = m_samples.size();
            return false;
        }
    }

    virtual void onSeek(sf::Time timeOffset)
    {
        // calcul du num�ro d'�chantillon correspondant, en fonction du taux d'�chantillonnage et du nombre de canaux
        m_currentSample = static_cast&lt;std::size_t&gt;(timeOffset.asSeconds() * getSampleRate() * getChannelCount());
    }

    std::vector&lt;sf::Int16&gt; m_samples;
    std::size_t m_currentSample;
};

int main()
{
    // chargement d'un buffer audio � partir d'un fichier
    sf::SoundBuffer buffer;
    buffer.loadFromFile("sound.wav");

    // initialisation et lecture de notre flux
    MyStream stream;
    stream.load(buffer);
    stream.play();

    // on le laisse jouer jusqu'� la fin
    while (stream.getStatus() == MyStream::Playing)
        sf::sleep(sf::seconds(0.1f));

    return 0;
}
</code></pre>

<?php

    require("footer-fr.php");

?>
