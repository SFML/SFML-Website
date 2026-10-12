# Capturer des données audio

## Introduction

Ce tutoriel va vous montrer comment capturer facilement des données audio en provenance de votre microphone, et leur appliquer des traitements personnalisés, comme par exemple les sauver dans un tampon sonore, ou les envoyer directement sur le réseau.

## Créer un enregistreur personnalisé

La classe qui définit l'interface de capture dans la SFML est [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation"). Etant donné qu'elle ne sait pas quoi faire des échantillons audio capturés (et elle n'a pas à le savoir), ce n'est qu'une classe de base pour votre propres enregistreurs persos. [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") vous fournit les échantillons enregistrés, tout ce que vous avez ensuite à faire est... ce que vous voulez : les envoyer via le réseau, les copier dans un tampon sonore, etc.

Voici les fonctions à redéfinir dans un enregistreur dérivé de [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") :

```cpp
class MyCustomSoundRecorder : public sf::SoundRecorder
{
    virtual bool OnStart()
    {
        ...

        return true;
    }

    virtual bool OnProcessSamples(const sf::Int16* Samples, std::size_t SamplesCount)
    {
        ...

        return true;
    }

    virtual void OnStop()
    {
        ...
    }
};
```

`OnStart` est appelée une fois à chaque nouvelle capture (appel à `Start`). Cette fonction est optionnelle, et ne fera rien si vous ne la redéfinissez pas. Si vous le faites, la valeur de retour est un booléen qui doit être `true` pour démarrer la capture, ou `false` pour l'annuler (par exemple après une erreur).

`OnProcessSamples` est appelée à chaque fois que l'enregistreur a capturé suffisamment de données audio; donc régulièrement tout au long de l'enregistrement. Cette fonction est obligatoire (un enregistreur sans fonction pour traiter les données audio n'aurait aucun sens), vous devez donc la redéfinir dans vos enregistreurs persos. Tout comme `OnStart`, la valeur de retour signifie "est-ce qu'on peut continuer la capture ?".  
Le paramètre `Samples` est un pointeur vers le tableau des échantillons sonores capturés, et `SamplesCount` est le nombre d'échantillons dans ce tableau.

`OnStop` est appelée à chaque fois que la capture en cours est arrêtée. De manière similaire à `OnStart`, elle est optionnelle et ne fera rien de particulier si vous ne la redéfinissez pas.

## Utilisation

L'interface de [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") est assez simple. Tout d'abord, vous devez vérifier que votre système supporte bien la capture audio. Cela peut être fait via la fonction statique `CanCapture` :

```cpp
if (!sf::SoundRecorder::CanCapture())
{
    // N'essayez même pas d'utiliser la capture audio...
}
```

Pour bien faire, vous devriez le vérifier avant chaque utilisation de [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation").

Puis, pour démarrer la capture appelez `Start`, et pour la stopper appelez `Stop`.

```cpp
MyCustomSoundRecorder Recorder;

Recorder.Start(96000);

// On attend un peu...

Recorder.Stop();
```

Lorsque vous appelez `Start`, vous pouvez passer en paramètre le taux d'échantillonnage qui sera utilisé pour la capture. En l'absence de paramètre, c'est 44100 sera utilisé (qualité CD). Si vous avez besoin de récupérer ce taux d'échantillonnage plus tard, vous pouvez appeler la fonction `GetSampleRate`.

```cpp
unsigned int SampleRate = Recorder.GetSampleRate();
```

## Enregistrer des données dans un tampon sonore

L'utilisation la plus fréquente est probablement de sauvegarder les données audio dans un tampon sonore, de manière à pouvoir les sauvegarder dans un fichier ou encore les lire immédiatement. La SFML possède une spécialisation de [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") prédéfinie pour cela : [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation"). Elle copie les échantillons audio capturés dans un [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation"), que vous pouvez récupérer via la fonction `GetBuffer` :

```cpp
sf::SoundBufferRecorder Recorder;

Recorder.Start();

// On attend un peu...

Recorder.Stop();

sf::SoundBuffer Buffer = Recorder.GetBuffer();
```

## Multi-threading

Pour les mêmes raisons que [`sf::SoundStream`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundStream.php "sf::SoundStream documentation"), [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation") exécute la capture dans un nouveau thread, ainsi le thread principal n'est pas bloqué. Ainsi, une fois de plus, vous devez faire attention aux éventuels problèmes de synchronisation qui peuvent survenir si vous partagez des données entre les deux threads.  
Pour des explications plus détaillées, vous pouvez jeter un oeil, si ce n'est déjà fait, au [tutoriel sur les flux](streams.md "Aller au tutoriel sur les flux").

## Conclusion

Vous en avez fini avec les bases du module audio. Vous pouvez jouer des sons et des musiques, effectuer des lectures en continue à partir de n'importe quelle source, et enregistrer des sons à partir de votre microphone.  
Intéressons-nous mainternant à un sujet plus avancé : [la spatialisation des sons](spatialization.md "Passer au tutoriel suivant").
