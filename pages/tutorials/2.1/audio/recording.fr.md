# Effectuer des captures audio

## Effectuer une capture dans un buffer

Le destin le plus probable pour des données audio capturées, est d'être sauvegardées dans un buffer ([`sf::SoundBuffer`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBuffer.php "sf::SoundBuffer documentation")) de sorte qu'elles puissent être jouées ou bien sauvegardées dans un fichier.

Ce type de capture peut être effectué via l'interface très simple de la classe [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation") :

```
// tout d'abord on vérifie si la capture est supportée par le système
if (!sf::SoundBufferRecorder::isAvailable())
{
    // erreur : la capture audio n'est pas supportée
    ...
}

// création de l'enregistreur
sf::SoundBufferRecorder recorder;

// démarrage de l'enregistrement
recorder.start();

// on attend...

// fin de l'enregistrement
recorder.stop();

// récupération du buffer qui contient les données audio enregistrées
const sf::SoundBuffer& buffer = recorder.getBuffer();
```

La fonction statique `SoundBufferRecorder::isAvailable` vérifie si la capture audio est supportée par le système. Si elle renvoie `false`, vous ne pourrez pas utiliser la classe [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation").

Les fonctions `start` et `stop` sont assez explicites. La capture tourne dans son propre thread, ce qui signifie que vous pouvez faire tout ce qui vous chante entre le début et la fin de l'enregistrement. Après la fin de la capture, les données audio sont disponibles dans un buffer que vous pouvez récupérer avec la fonction `getBuffer`.

Avec les données enregistrées, vous pouvez ensuite :

- Les sauvegarder dans un fichier
    
    ```
    buffer.saveToFile("my_record.ogg");
    ```
    
- Les jouer directement
    
    ```
    sf::Sound sound(buffer);
    sound.play();
    ```
    
- Accéder aux données brutes et les analyser, transformer, etc.
    
    ```
    const sf::Int16* samples = buffer.getSamples();
    std::size_t count = buffer.getSampleCount();
    doSomething(samples, count);
    ```
    

Si vous comptez utiliser les données capturées après que l'enregistreur a été détruit ou redémarré, n'oubliez pas de faire une _copie_ du buffer.

## Sélectionner le périphérique d'entrée

Si vous avez plusieurs périphériques d'entrées audio connectés à votre ordinateur (par exemple un microphone, une carte son externe ou encore une webcam dotée d'un micro), vous pouvez spécifier le périphérique utilisé pour l'enregistrement. Un périphérique d'entrée audio est identifié par son nom. `std::vector<std::string>` contenant le nom de tous les périphériques connectés est disponible via à la fonction statique `SoundBufferRecorder::getAvailableDevices()`. Vous pouvez sélectionner un périphérique de la liste pour l'enregistrement en passant le nom du périphérique désiré à la fonction membre `setDevice()`. Il est même possible de changer de périphérique à la volée (i.e. pendant l'enregistrement).

Le nom du périphérique actuellement utilisé peut être obtenu en appelant `getDevice()`. Si vous ne choisissez pas de périphérique explicitement vous-même, celui par défaut sera utilisé. Son nom peut être obtenu grace à la fonction statique `SoundBufferRecorder::getDefaultDevice()`.

Voici un petit exemple illustrant comment sélectionner un périphérique d'entrée audio :

```
// récupération des noms des périphériques d'enregistrement
std::vector<std::string> availableDevices = sf::SoundRecorder::getAvailableDevices();

// choix d'un périphérique
std::string inputDevice = availableDevices[0];

// création d'un enregistreur
sf::SoundBufferRecorder recorder;

// sélection du périphérique
if (!recorder.setDevice(inputDevice))
{
    // erreur : échec de sélection du périphérique
    ...
}

// utilisation habituelle de l'enregistreur
```

## Enregistrement personnalisé

Si stocker les données enregistrées dans un buffer audio n'est pas ce que vous voulez, vous pouvez tout aussi bien écrire votre propre enregistreur. Cela vous permettra de traiter les données audio pendant qu'elles sont en train d'être capturées, (presque) directement dès qu'elles arrivent du périphérique d'enregistrement. De cette façon vous pouvez, par exemple, _streamer_ les données capturées sur le réseau, en effectuer une analyse temps-réel, etc.

Pour écrire votre propre enregistreur, vous devez hériter de la classe abstraite [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation"). En fait, [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation") est juste une spécialisation de cette classe, directement intégrée à SFML.

Vous n'avez qu'une fonction virtuelle à redéfinir dans votre classe dérivée : `onProcessSamples`. Elle est appelée à chaque fois qu'un nouveau lot d'échantillons audio ont été capturés, c'est donc là que vous devez implémenter votre traitement perso.

Par défaut, les échantillons audio sont fournis à la fonction membre `onProcessSamples` toutes les 100 ms. Vous pouvez changer l'intervalle en utilisant la fonction membre `setProcessingInterval`. Vous souhaiterez probablement utiliser un intervalle plus petit si vous voulez manipuler les données enregistrées en temps réel, par exemple. Notez que ceci n'est qu'un indice et qu'il se peut que l'intervalle utilisé en pratique varie, donc ne vous y fiez pas pour implémenter un timing précis.

Il existe deux autres fonctions virtuelles que vous pouvez redéfinir si vous le souhaitez : `onStart` et `onStop`. Elles sont appelées respectivement lorsque la capture démarre/est arrêtée. Elles peuvent être utiles pour les tâches d'initialisation et de nettoyage.

Voici le squelette d'une classe dérivée complète :

```
class MyRecorder : public sf::SoundRecorder
{
    virtual bool onStart() // optionnelle
    {
        // initialisez ce qui doit l'être avant que la capture démarre
        ...

        // renvoyez true pour démarrer la capture, ou false pour l'annuler
        return true;
    }

    virtual bool onProcessSamples(const sf::Int16* samples, std::size_t sampleCount)
    {
        // faites ce que vous voulez des échantillons audio
        ...

        // renvoyez true pour continuer la capture, ou false pour la stopper
        return true;
    }

    virtual void onStop() // optionnelle
    {
        // nettoyez ce qui doit l'être après la fin de la capture
        ...
    }
}
```

Les fonctions `isAvailable`/`start`/`stop` sont définies dans la classe de base, [`sf::SoundRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundRecorder.php "sf::SoundRecorder documentation"), et donc par conséquent dans toutes les classes dérivées. Cela signifie que vous pouvez utiliser n'importe quelle enregistreur exactement de la même manière que la classe [`sf::SoundBufferRecorder`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1SoundBufferRecorder.php "sf::SoundBufferRecorder documentation") ci-dessus.

```
if (!MyRecorder::isAvailable())
{
    // erreur...
}

MyRecorder recorder;
recorder.start();
...
recorder.stop();
```

## Attention aux threads

Comme la capture est effectuée dans un thread, il est important de savoir ce qui se passe exactement, et où.

`onStart` sera appelée directement par la fonction `start`, donc elle sera exécutée dans le thread qui l'a appelée. Par contre, `onProcessSample` et `onStop` seront toujours appelées depuis le thread de capture interne que SFML crée.

Donc, si votre enregistreur utilise des données qui peuvent être accédées de manière _concurrente_ (c'est-à-dire en même temps) à la fois par le thread appelant et par le thread d'enregistrement, il faudra les protéger (avec un mutex ou autre) afin d'éviter les accès concurrents, qui pourraient entraîner des comportements indéterminés -- données audio corrompues, crashs, etc.

Si vous n'êtes pas suffisamment à l'aise avec les problèmes liés aux threads, vous pouvez faire un saut par le [tutoriel correspondant](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php "Tutoriel sur les threads").