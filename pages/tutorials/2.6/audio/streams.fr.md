# Flux audio personnalisés

## [Un flux audio ? C'est quoi ça ?](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#un-flux-audio--cest-quoi-ca)[](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#top "Haut de la page")

Un flux (en anglais _stream_) audio est similaire à une musique (vous vous souvenez de la classe [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") ?). Il a pratiquement les mêmes fonctions et se comporte de la même manière. La seule différence est qu'un flux audio ne jouera pas un fichier audio : il va jouer une source audio perso que _vous_ vous chargerez de fournir. En d'autres termes, définir votre propre flux audio vous permet de jouer n'importe quoi d'autre qu'un fichier : un flux internet, une musique générée par votre programme, un format non supporté par SFML, etc.

En fait, la classe [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") est simplement un type particulier de flux audio, spécialisé dans la lecture de fichiers.

Comme nous parlons ici de _flux_, nous aurons affaire à des données audio qui ne peuvent pas être complètement chargées en mémoire, mais qui seront plutôt chargées au fur et à mesure qu'elles sont jouées. Si votre son peut être intégralement chargé et tenir en mémoire sans problème, alors oubliez les flux audio : chargez le simplement dans un [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") et utilisez un [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation") pour le jouer.

## [sf::SoundStream](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#sfsoundstream)[](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#top "Haut de la page")

Pour définir votre propre flux audio, vous devez hériter de la classe de base abstraite [`sf::SoundStream`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundStream.php "sf::SoundStream documentation"). Celle-ci possède deux fonctions virtuelles que vous devrez redéfinir : `onGetData` et `onSeek`.

```
class MyAudioStream : public sf::SoundStream
{
    virtual bool onGetData(Chunk& data);

    virtual void onSeek(sf::Time timeOffset);
};
```

`onGetData` est appelée par la classe de base à chaque fois qu'elle est à court d'échantillons audio et a donc besoin de nouvelles données à jouer. Vous devez lui fournir de nouveaux échantillons audio en remplissant le paramètre `data` :

```
bool MyAudioStream::onGetData(Chunk& data)
{
    data.samples = /* mettez ici un pointeur vers les nouvelles données audio */;
    data.sampleCount = /* mettez ici le nombre d'échantillons pointés */;
    return true;
}
```

Vous devez renvoyer `true` lorsque tout est ok, ou `false` s'il faut stopper le flux, soit parce qu'une erreur est survenue, soit parce qu'il n'y a tout simplement plus de données audio à jouer.

SFML crée une copie interne des échantillons audio dès que `onGetData` a fini, donc vous n'avez pas besoin de garder en mémoire les données que vous renvoyez, elles peuvent être effacées immédiatement après.

`onSeek` est exécutée lorsque la fonction publique `setPlayingOffset` est appelée. Son but est de changer la position de lecture courante dans la source de données. Le paramètre est une valeur de temps représentant la nouvelle position, relativement au début du son (et non à la position courante). Cette fonction est parfois impossible à implémenter, par rapport au type du flux ; dans ce cas laissez-la vide et indiquez aux utilisateurs de votre classe que changer la position de lecture n'est pas supporté.

Désormais votre classe est quasiment prête à fonctionner. La seule chose que [`sf::SoundStream`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundStream.php "sf::SoundStream documentation") doit encore savoir, est le nombre de canaux ainsi que le taux d'échantillonnage du flux, afin de pouvoir le restituer correctement. Pour transmettre ces paramètres à la classe de base, vous devez appeler la fonction protégée `initialize` dès que ceux-ci sont connus (donc très probablement lorsque le flux est chargé/initialisé).

```
// l'endroit où ceci est fait, dépend complètement de comment votre classe est conçue
unsigned int channelCount = ...;
unsigned int sampleRate = ...;
initialize(channelCount, sampleRate);
```

## [Attention aux threads](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#attention-aux-threads)[](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#top "Haut de la page")

Les flux audio étant toujours joués dans un thread, il est important de savoir ce qui se passe exactement, et où.

`onSeek` est appelée directement par la fonction `setPlayingOffset`, elle est donc toujours exécutée dans le thread qui a appelé cette dernière. Par contre, la fonction `onGetData` sera appelée regulièrement tant que le flux sera en train d'être joué, dans un autre thread créé par SFML. En conséquence, si votre flux utilise des données qui peuvent être accédées de manière _concurrente_ (c'est-à-dire en même temps) à la fois par le thread appelant et par le thread de lecture (celui créé par SFML), vous devez les protéger (avec un mutex ou autre) afin d'éviter les accès concurrents, qui pourraient causer des comportements indéterminés -- données audio corrompues, crashs, etc.

Si vous n'êtes pas suffisamment à l'aise avec les problèmes liés aux threads, vous pouvez faire un saut par le [tutoriel correspondant](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php "Tutoriel sur les threads").

## [Utilisation de votre flux audio](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#utilisation-de-votre-flux-audio)[](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#top "Haut de la page")

Maintenant que vous avez défini votre propre classe de flux audio, voyons comment l'utiliser. En fait, c'est très similaire à ce qui est expliqué dans le [tutoriel sur sf::Music](https://www.sfml-dev.org/tutorials/2.6/audio-sounds-fr.php "Tutoriel : jouer des sons et des musiques"). Vous pouvez contrôler la lecture avec les fonctions `play`, `pause`, `stop` et `setPlayingOffset`. Vous pouvez aussi jouer avec les propriétés du son, telles que le volume ou le pitch. Vous pouvez vous référer à la documentation de l'API ou aux autres tutoriels audio pour plus de détails.

## [Un example simple](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#un-example-simple)[](https://www.sfml-dev.org/tutorials/2.6/audio-streams-fr.php#top "Haut de la page")

Voici un exemple très simple de classe de flux audio, qui joue les données d'un buffer audio. Une telle classe est bien entendu complètement inutile, mais le but ici est de se focaliser sur la manière dont les données audio sont gérées par la classe, peu importe d'où elles viennent.

```
#include <SFML/Audio.hpp>
#include <vector>

// flux audio qui joue un buffer déjà chargé
class MyStream : public sf::SoundStream
{
public:

    void load(const sf::SoundBuffer& buffer)
    {
        // extraction des échantillons audio du buffer, vers notre propre conteneur
        m_samples.assign(buffer.getSamples(), buffer.getSamples() + buffer.getSampleCount());

        // remise à zéro de la position de lecture
        m_currentSample = 0;

        // initialisation de la classe de base
        initialize(buffer.getChannelCount(), buffer.getSampleRate());
    }

private:

    virtual bool onGetData(Chunk& data)
    {
        // nombre d'échantillons à renvoyer à chaque fois que cette fonction est appelée ;
        // dans une implémentation plus robuste, on utiliserait plutôt une durée fixe
        // plutôt qu'un nombre arbitraire d'échantillons
        const int samplesToStream = 50000;

        // affectation des prochains échantillons à jouer
        data.samples = &m_samples[m_currentSample];

        // a-t-on atteint la fin du son ?
        if (m_currentSample + samplesToStream <= m_samples.size())
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
        m_currentSample = static_cast<std::size_t>(timeOffset.asSeconds() * getSampleRate() * getChannelCount());
    }

    std::vector<sf::Int16> m_samples;
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
```