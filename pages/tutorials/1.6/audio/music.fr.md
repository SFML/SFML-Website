# Jouer une musique

## Introduction

Vous vous demandez peut-être, "mais quelle est la différence entre une musique et un son ?". Et bien, une musique est simplement un son plus long. Mais cela fait une énorme différence en programmation audio. La même différence qui fait que vous devez compresser vos musiques en MP3 ou en OGG. Comme nous l'avons vu dans le tutoriel précédent, les données sonores non compressées sont composées d'échantillons, qui sont (dans la SFML) des entiers signés de 16 bits. Prenez le taux d'échantillonnage standard pour une qualité CD (44100 échantillons par seconde), deux canaux, et vous finissez avec 50 Mo en mémoire pour pas plus de 5 minutes de musique.

En conséquence, les musiques ne peuvent pas être chargées en mémoire comme les sons. C'est pourquoi les musiques ont leur propre classe dans la SFML : [`sf::Music`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Music.php "sf::Music documentation").

## Utiliser sf::Music

Une musique n'est jamais chargée complétement en mémoire, à la place elle utilise un tampon dynamique plus petit qui est mis à jour régulièrement avec les données sonores provenant du fichier (oui, c'est en fait de la lecture en flux -- nous détaillerons ça dans le prochain tutoriel).  
Le tampon interne est défini à une taille appropriée par défaut, mais vous pouvez la définir vous même si vous le souhaitez (si votre musique a un taux d'échantillonnage très élevé, ou si vous avez très peu de mémoire à votre disposition) avec le constructeur :

```cpp
sf::Music Music1;        // Par défaut, le tampon interne contiendra 44100 échantillons
sf::Music Music2(96000); // Le tampon interne contiendra 96000 échantillons
```

Pour ouvrir une musique à partir d'un fichier, vous pouvez utiliser la fonction `OpenFromFile` :

```cpp
if (!Music.OpenFromFile("music.ogg"))
{
    // Erreur...
}
```

Ou, si le fichier est déjà chargé en mémoire :

```cpp
if (!Music.OpenFromMemory(FilePtr, Size))
{
    // Erreur...
}
```

N'oubliez pas de toujours vérifier la valeur retournée, qui sera `false` si la musique n'a pas pu être ouverte.

L'appel à `OpenFromFile` ou `OpenFromMemory` ne démarrera pas la musique, seul un appel à `Play` le fera.

[`sf::Music`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Music.php "sf::Music documentation") diffère de [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Sound.php "sf::Sound documentation") dans son comportement, mais elle représente toujours un son. Ainsi, elle définit les mêmes accesseurs que [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Sound.php "sf::Sound documentation") et [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") rassemblés :

```cpp
unsigned int      SampleRate    = Music.GetSampleRate();
unsigned int      ChannelsCount = Music.GetChannelsCount();
sf::Music::Status Status        = Music.GetStatus();
bool              Loop          = Music.GetLoop();
float             Pitch         = Music.GetPitch();
float             Volume        = Music.GetVolume();
float             Duration      = Music.GetDuration();
float             Offset        = Music.GetPlayingOffset();
```

Seul le tableau d'échantillons ne peut pas être lu, car celui-ci n'est jamais chargé complétement en mémoire (mais vous pouvez toujours le charger avec un [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") si vous en avez vraiment besoin).

Enfin, vous pouvez toujours jouer / mettre en pause / stopper une musique :

```cpp
Music.Play();
Music.Pause();
Music.Stop();
```

## Conclusion

[`sf::Music`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Music.php "sf::Music documentation") ne diffère pas beaucoup de [`sf::Sound`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Sound.php "sf::Sound documentation"). La clé ici est de bien distinguer les sons courts ponctuels (des bruits de pas, des tirs d'armes, ...) des sons plus longs (les musiques de fond), et d'utiliser la classe appropriée dans chaque cas.

Dans le prochain tutoriel nous apprendrons à [utiliser les flux audio](streams.md "Aller au tutoriel suivant") pour jouer des sons provenant du réseau, de gros fichiers (ce que fait [`sf::Music`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Music.php "sf::Music documentation")), ou de n'importe quelle source qui ne peut pas être chargée complétement en mémoire.
