# Jouer un son

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/audio/sounds/).

## Introduction

Jouer un son est la tâche la plus facile du module audio de la SFML. Cependant, elle met en jeu deux entités : les données du son, et l'instance du son dans la scène. En fait c'est exactement le même principe que les images et les sprites du module graphique.

## Le tampon sonore

En programmation audio, les données d'un son sont définies par un tableau d'échantillons (*samples*). Un échantillon est une valeur numérique, habituellement un entier 16 bits signé, représentant l'amplitude du son à un instant donné. Le son est ensuite restitué en jouant ces échantillons à une fréquence élevée (les CD utilisent une fréquence de 44100 échantillons par seconde). Plus le taux d'échantillonnage sera élevé, meilleure sera la qualité du son. Un son est également défini par un nombre de canaux. Un son possédant un canal est un son mono, un son possédant deux canaux est un son stéréo. Des sons plus complexes peuvent utiliser jusqu'à 8 canaux, pour les formats dolby (4.1, 5.1, 7.1, etc.).

Avant d'utiliser une quelconque classe du module audio de la SFML, vous devez inclure son en-tête :

```cpp
#include <SFML/Audio.hpp>
```

Comme d'habitude, il va inclure tous les en-têtes des classes audio, tout comme les en-têtes des modules desquels il dépend.

Dans la SFML, la classe qui contient les échantillons sonores est [`sf::SoundBuffer`](../../../documentation/1.6/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation"). Vous pouvez le remplir à partir d'échantillons en mémoire :

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromSamples(Samples, 5000, 2, 44100))
{
    // Erreur...
}
```

Le premier paramètre est un pointeur vers le tableau d'échantillons en mémoire. Ses éléments doivent être des entiers signés de 16 bits. Le deuxième paramètre, ici 5000, est le nombre d'échantillons dans le tableau. Le troisième paramètre est le nombre de canaux (ici nous avons un son stéréo), et le quatrième est le taux d'échantillonnage.

Si quelque chose s'est mal passé, cette fonction renvoie `false`.

Plus utile : un tampon sonore peut être chargé à partir de (et sauvé dans) un fichier audio (les formats les plus communs sont supportés).

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromFile("sound.wav"))
{
    // Erreur...
}
```

Vous pouvez également charger un fichier son directement depuis la mémoire, avec un pointeur vers les données du fichier et sa taille en octets :

```cpp
sf::SoundBuffer Buffer;
if (!Buffer.LoadFromMemory(FilePtr, Size))
{
    // Erreur...
}
```

Le taux d'échantillonnage et le nombre de canaux sont chargés automatiquement depuis le fichier. Vous pouvez les récupérer en appelant les fonctions suivantes :

```cpp
unsigned int SampleRate = Buffer.GetSampleRate();
unsigned int Channels   = Buffer.GetChannelsCount();
```

Vous pouvez également récupérer la durée du son (en secondes), qui est simplement déduite du taux d'échantillonnage et du nombre d'échantillons :

```cpp
float Duration = Buffer.GetDuration();
```

Finalement, si vous devez appliquer un traitement particulier aux données audio, vous pouvez accéder au tableau d'échantillons directement :

```cpp
const sf::Int16* Samples = Buffer.GetSamples();
std::size_t Count = Buffer.GetSamplesCount();
```

Voilà tout ce que vous avez à savoir à propos des tampons sonores. La plupart du temps, vous n'aurez besoin que de la fonction `LoadFromFile` pour charger des sons depuis vos fichiers audio.

## L'instance du son

Une fois que vous avez chargé un tampon sonore, vous pouvez utiliser [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") pour le jouer. Une instance de [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") est un moyen de jouer un tampon sonore dans la "scène", avec des paramètres supplémentaires tels que le pitch, le volume, la position, ... Vous pouvez donc avoir plusieurs instances de [`sf::Sound`](../../../documentation/1.6/classsf_1_1Sound.html "sf::Sound documentation") jouant le même [`sf::SoundBuffer`](../../../documentation/1.6/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation") au même moment, avec différents paramètres.

Pour lier un tampon à un son, il suffit d'appeler sa fonction `SetBuffer` :

```cpp
sf::Sound Sound;
Sound.SetBuffer(Buffer); // Buffer est un sfSoundBuffer
```

Ensuite vous pouvez modifier ou récupérer les paramètres du son via ses accesseurs :

```cpp
Sound.SetLoop(true);
Sound.SetPitch(1.5f);
Sound.SetVolume(75.f);
```

```cpp
bool  Loop   = Sound.GetLoop();
float Pitch  = Sound.GetPitch();
float Volume = Sound.GetVolume();
```

`SetLoop` Indique si le son va jouer en boucle ou une seule fois.  
`SetPitch` change la fréquence fondamentale du son : plus haut est le pitch, plus aigü sera le son. La valeur par défaut est 1  
`SetVolume` modifie le volume du son. Le volume varie entre 0 et 100, 100 étant la valeur par défaut. Vous pouvez affecter un son supérieur à 100, mais le résultat n'est pas garanti et dépend de votre système.

Vous pouvez jouer / mettre en pause / stopper un son :

```cpp
Sound.Play();
Sound.Pause();
Sound.Play(); // Pour reprendre après un appel à Pause()
Sound.Stop();
```

Vous pouvez récupérer l'état du son :

```cpp
sf::Sound::Status Status = Sound.GetStatus();
```

Un son peut être `Playing` (en lecture), `Paused` (en pause) ou `Stopped` (stoppé).

Il est également possible de récupérer la position de lecture courante, en secondes :

```cpp
float Position = Sound.GetPlayingOffset();
```

Et comme d'habitude, aucune destruction n'est nécessaire : toutes les classes audio vont libérer leurs ressources automatiquement.

## Gestion des tampons et des sons

Vous devez être particulièrement prudent lorsque vous manipulez des tampons sonores. Une instance de [`sf::SoundBuffer`](../../../documentation/1.6/classsf_1_1SoundBuffer.html "sf::SoundBuffer documentation") est une ressource qui est lente à charger, lourde à copier et qui utilise beaucoup de mémoire.

Pour une bonne discussion à propos de la gestion des ressources, je vous renvoie au paragraphe **"Gestion des images et des sprites"** du [tutoriel sur les sprites](../graphics/sprite.md "Tutoriel sur les sprites"), en remplaçant simplement le mot "Image" par "Tampon" et "Sprite" par "Son".

## Conclusion

Maintenant que vous savez jouer des sons, regardons comment [jouer des musiques](music.md "Aller au tutoriel suivant").
