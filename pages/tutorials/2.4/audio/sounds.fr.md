# Jouer des sons et des musiques

## Son ou musique

SFML fournit deux classes pour jouer de l'audio : [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation") et [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation"). Elles offrent toutes deux plus ou moins les mêmes fonctionnalités, la principale différence est la manière dont elles fonctionnent.

[`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation") est une classe légère qui joue des données audio chargées au préalable dans un [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation"). Il faut l'utiliser pour des sons relativement courts qui peuvent tenir sans problème en mémoire, et qui ne doivent souffrir d'aucun lag lorsqu'ils sont joués. Par exemple : des coups de feu, des bruits de pas, etc.

[`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") ne charge pas toutes les données audio en mémoire, à la place elle les lit en flux (elle les "_stream_") à la volée directement à partir du fichier d'origine. Cette classe est utilisée typiquement pour jouer des musiques compressées qui durent plusieurs minutes, et qui prendraient plusieurs secondes à charger et consommeraient des centaines de Mo en mémoire si elles étaient intégralement pré-chargées.

## [Charger et jouer un son](https://www.sfml-dev.org/tutorials/2.6/audio-sounds-fr.php#charger-et-jouer-un-son)[](https://www.sfml-dev.org/tutorials/2.6/audio-sounds-fr.php#top "Haut de la page")

Comme vous l'avez vu ci-dessus, les données du son ne sont pas stockées directement dans [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation") mais dans une classe à part nommée [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation"). Cette classe encapsule les données audio, qui ne sont ni plus ni moins qu'un tableau d'entiers 16 bits (ceux-ci étant appelés "échantillons audio"). Un échantillon représente, en gros, l'amplitude du signal audio à un instant donné, et un tableau d'échantillons représente donc un son complet.

En fait, les classes [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation")/[`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") fonctionnent exactement de la même manière que le couple [`sf::Sprite`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sprite.php "sf::Sprite documentation")/[`sf::Texture`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Texture.php "sf::Texture documentation") du module graphique. Donc si vous comprenez comment les sprites et les textures travaillent main dans la main, vous pouvez appliquer le même concept aux sons et aux buffers.

Vous pouvez charger un [`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation") depuis un fichier avec sa fonction `loadFromFile` :

```
#include <SFML/Audio.hpp>

int main()
{
    sf::SoundBuffer buffer;
    if (!buffer.loadFromFile("sound.wav"))
        return -1;

    ...

    return 0;
}
```

Comme d'habitude, plutôt qu'un fichier sur le disque vous pouvez également charger un fichier qui se trouve directement en mémoire (`loadFromMemory`) ou qui est accessible via un [flux de données perso](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php "Tutoriel sur les flux de données") (`loadFromStream`).

SFML supporte les formats WAV, OGG/Vorbis et FLAC. Le format MP3 est pris en charge pour le décodage mais pas pour l'encodage.

Vous pouvez aussi charger un buffer directement depuis un tableau d'échantillons, au cas où vous les auriez récupéré depuis autre chose qu'un fichier :

```
std::vector<sf::Int16> samples = ...;
buffer.loadFromSamples(&samples[0], samples.size(), 2, 44100);
```

Etant donné que `loadFromSamples` charge un tableau d'échantillons bruts plutôt qu'un fichier audio, il faut lui passer quelques paramètres supplémentaires afin que la description du son soit complète. Le premier (troisième paramètre de la fonction) est le nombre de canaux : 1 canal définit un son mono, 2 canaux définissent un son stéréo, etc. Le second paramètre additionnel (quatrième de la fonction) est le taux d'échantillonnage; il définit combien d'échantillons doivent être joués par seconde afin de restituer le son d'origine.

Maintenant que les données audio sont chargées en mémoire, il ne reste plus qu'à les jouer avec une instance de [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation").

```
sf::SoundBuffer buffer;
// on charge quelque chose dans le buffer...

sf::Sound sound;
sound.setBuffer(buffer);
sound.play();
```

Le truc cool, c'est que vous pouvez affecter le même buffer à plusieurs sons si vous le souhaitez. Vous pouvez même les jouer tous en même temps, aucun problème.

Les sons (et les musiques) sont jouées dans un thread à part. Cela signifie que vous pouvez faire tout ce que vous voulez après avoir appelé `play()` (sauf détruire le son ou son buffer, bien entendu), le son va continuer de jouer jusqu'à ce qu'il se termine ou soit stoppé explicitement.

## Jouer une musique

Contrairement à [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation"), [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") ne précharge pas les données audio, elle les lit à la demande directement depuis la source. L'initialisation d'une musique est donc plus directe :

```
sf::Music music;
if (!music.openFromFile("music.ogg"))
    return -1; // erreur
music.play();
```

Il est important de noter que, contrairement aux autres classes de ressource de SFML, la fonction de chargement est nommée `openFromFile` et non `loadFromFile`. C'est parce que la musique n'est pas réellement chargée, tout ce que fait cette fonction c'est ouvrir le fichier. Les données ne sont lues que plus tard, lorsque la musique est jouée. Cela aide aussi à garder en tête que le fichier audio doit rester disponible aussi longtemps qu'il est joué.  
Les autres fonctions de chargement de [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") suivent la même convention : `openFromMemory`, `openFromStream`.

## Et ensuite ?

Maintenant que vous êtes capables de charger et jouer un son ou une musique, voyons ce que vous pouvez en faire.

Afin de contrôler la lecture, les fonctions suivantes sont disponibles :

- `play` démarre ou reprend la lecture
- `pause` met en pause la lecture
- `stop` arrête la lecture et revient au début
- `setPlayingOffset` change la position actuelle de lecture

Exemple :

```
// on démarre la lecture
sound.play();

// on avance de deux secondes
sound.setPlayingOffset(sf::seconds(2.f));

// on met en pause
sound.pause();

// on reprend la lecture
sound.play();

// on arrête la lecture et on se replace au début
sound.stop();
```

La fonction `getStatus` renvoie l'état de lecture d'un son ou d'une musique, vous pouvez l'utiliser pour savoir si celui-ci est arrêté, en cours de lecture ou en pause.

Les sons et les musiques définissent également quelques propriétés qui peuvent être modifiées à tout moment.

Le _pitch_ est un facteur qui modifie la fréquence perçue du son : plus que 1 rend le son plus aigü, moins que 1 rend le son plus grave, et 1 restitue le son d'origine. Attention, la modification du pitch a un effet de bord : cela change aussi la vitesse de lecture.

```
sound.setPitch(1.2f);
```

Le _volume_ est... le volume. Sa valeur est comprise entre 0 (muet) et 100 (volume maximum). La valeur par défaut est 100, ce qui signifie qu'il est impossible d'augmenter le volume d'un son au-delà de son volume d'origine.

```
sound.setVolume(50.f);
```

La propriété _loop_ détermine si le son ou la musique boucle automatiquement ou non. S'il boucle, il recommencera à zéro dès qu'il se finira, encore et encore jusqu'à ce que vous appeliez explicitement `stop`. Sinon, il s'arrêtera automatiquement lorsqu'il est fini.

```
sound.setLoop(true);
```

D'autres propriétés sont disponible, mais elles sont liées à la spacialisation et sont expliquées dans le [tutoriel correspondant](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php "Tutoriel sur la spacialisation").

## Erreur courantes

### Buffer audio détruit

L'erreur la plus courante est de déclarer un buffer dans une portée réduite (telle qu'une fonction) et le laisser mourir à la fin alors qu'un son l'utilise toujours.

```
sf::Sound loadSound(std::string filename)
{
    sf::SoundBuffer buffer; // ce buffer est local à la fonction, il sera détruit...
    buffer.loadFromFile(filename);
    return sf::Sound(buffer);
} // ... ici

sf::Sound sound = loadSound("s.wav");
sound.play(); // ERREUR : le buffer du son n'existe plus, le comportement est indéterminé
```

Souvenez-vous qu'un son ne garde qu'un _pointeur_ vers le buffer que vous lui affectez, il n'en fait pas de copie. Vous devez donc gérer correctement la durée de vie de vos buffers, de façon à ce qu'ils restent en vie tant qu'ils sont utilisés par des sons.

### Trop de sons

Une autre source d'erreur est d'essayer de créer un nombre important de sons. SFML possède une limite interne ; celle-ci peut varier en fonction de l'OS, mais vous ne devriez jamais aller au-delà de 256. Cette limite est le nombre d'instances de [`sf::Sound`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Sound.php "sf::Sound documentation") et [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") qui peuvent exister simultanément. Une bonne façon de ne jamais la dépasser est de détruire (ou de recycler) les sons inutilisés, plutôt que de les garder en vie pour rien. Ce paragraphe n'a d'importance que si vous devez vraiment gérer un nombre important de sons et de musiques, bien entendu.

### Source d'une musique détruite avant qu'elle ne soit finie

Souvenez-vous qu'une musique a besoin de sa source aussi longtemps qu'elle est jouée, puisque qu'elle charge les données au fur et à mesure de la lecture. Ok, un fichier audio sur votre disque a très peu de chances d'être supprimé ou déplacé alors que votre application est en train de le jouer. Cependant les choses se compliquent lorsque vous jouez une musique depuis un fichier en mémoire, ou lu depuis un flux d'entrée perso :

```
// on démarre avec un fichier audio en mémoire (imaginez que l'on vient de l'extraire d'une archive zip)
std::vector<char> fileData = ...;

// on le joue
sf::Music music;
music.openFromMemory(&fileData[0], fileData.size());
music.play();

// "ok, il semblerait que l'on puisse se passer du fichier maintenant"
fileData.clear();

// ERREUR: la musique était toujours en train de lire le contenu de fileData! le comportement est maintenant indéterminé
```

### sf::Music n'est pas copiable

Et pour terminer, un petit rappel : la classe [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation") n'est _pas copiable_, donc le compilateur ne vous laissera pas faire ceci :

```
sf::Music music;
sf::Music anotherMusic = music; // ERREUR

void doSomething(sf::Music music)
{
    ...
}
sf::Music music;
doSomething(music); // ERREUR (la fonction devrait prendre son paramètre par référence, pas par copie)
```