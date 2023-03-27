<?php

    $title = "Effectuer des captures audio";
    $page = "audio-recording-fr.php";

    require("header-fr.php");

?>

<h1>Effectuer des captures audio</h1>

<?php h2('Effectuer une capture dans un buffer') ?>
<p>
    Le destin le plus probable pour des données audio capturées, est d'être sauvegardées dans un buffer (<?php class_link("SoundBuffer") ?>) de sorte
    qu'elles puissent être jouées ou bien sauvegardées dans un fichier.
</p>
<p>
    Ce type de capture peut être effectué via l'interface très simple de la classe <?php class_link("SoundBufferRecorder") ?> :
</p>
<pre><code class="cpp">// tout d'abord on vérifie si la capture est supportée par le système
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
const sf::SoundBuffer&amp; buffer = recorder.getBuffer();
</code></pre>
<p>
    La fonction statique <code>SoundBufferRecorder::isAvailable</code> vérifie si la capture audio est supportée par le système. Si elle renvoie
    <code>false</code>, vous ne pourrez pas utiliser la classe <?php class_link("SoundBufferRecorder") ?>.
</p>
<p>
    Les fonctions <code>start</code> et <code>stop</code> sont assez explicites. La capture tourne dans son propre thread, ce qui signifie que vous
    pouvez faire tout ce qui vous chante entre le début et la fin de l'enregistrement. Après la fin de la capture, les données audio sont disponibles
    dans un buffer que vous pouvez récupérer avec la fonction <code>getBuffer</code>.
</p>
<p>
    Avec les données enregistrées, vous pouvez ensuite :
</p>
<ul>
    <li>Les sauvegarder dans un fichier
<pre><code class="cpp">buffer.saveToFile("my_record.ogg");
</code></pre>
    </li>
    <li>Les jouer directement
<pre><code class="cpp">sf::Sound sound(buffer);
sound.play();
</code></pre>
    </li>
    <li>
        Accéder aux données brutes et les analyser, transformer, etc.
<pre><code class="cpp">const sf::Int16* samples = buffer.getSamples();
std::size_t count = buffer.getSampleCount();
doSomething(samples, count);
</code></pre>
    </li>
</ul>
<p class="important">
    Si vous comptez utiliser les données capturées après que l'enregistreur a été détruit ou redémarré, n'oubliez pas de faire une <em>copie</em>
    du buffer.
</p>

<?php h2('Sélectionner le périphérique d\'entrée') ?>
<p>
    Si vous avez plusieurs périphériques d'entrées audio connectés à votre ordinateur (par exemple un microphone, une carte son externe ou
    encore une webcam dotée d'un micro), vous pouvez spécifier le périphérique utilisé pour l'enregistrement. Un périphérique d'entrée audio
    est identifié par son nom. <code>std::vector&lt;std::string&gt;</code> contenant le nom de tous les périphériques connectés est disponible
    via à la fonction statique <code>SoundBufferRecorder::getAvailableDevices()</code>. Vous pouvez sélectionner un périphérique de la liste
    pour l'enregistrement en passant le nom du périphérique désiré à la fonction membre <code>setDevice()</code>. Il est même possible de
    changer de périphérique à la volée (i.e. pendant l'enregistrement).
</p>
<p>
    Le nom du périphérique actuellement utilisé peut être obtenu en appelant <code>getDevice()</code>. Si vous ne choisissez pas de périphérique
    explicitement vous-même, celui par défaut sera utilisé. Son nom peut être obtenu grace à la fonction statique <code>SoundBufferRecorder::getDefaultDevice()</code>.
</p>
<p>
    Voici un petit exemple illustrant comment sélectionner un périphérique d'entrée audio :
</p>
<pre><code class="cpp">// récupération des noms des périphériques d'enregistrement
std::vector&lt;std::string&gt; availableDevices = sf::SoundRecorder::getAvailableDevices();

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
</code></pre>

<?php h2('Enregistrement personnalisé') ?>
<p>
    Si stocker les données enregistrées dans un buffer audio n'est pas ce que vous voulez, vous pouvez tout aussi bien écrire votre propre enregistreur.
    Cela vous permettra de traiter les données audio pendant qu'elles sont en train d'être capturées, (presque) directement dès qu'elles arrivent du
    périphérique d'enregistrement. De cette façon vous pouvez, par exemple, <em>streamer</em> les données capturées sur le réseau, en effectuer une
    analyse temps-réel, etc.
</p>
<p>
    Pour écrire votre propre enregistreur, vous devez hériter de la classe abstraite <?php class_link("SoundRecorder") ?>. En fait,
    <?php class_link("SoundBufferRecorder") ?> est juste une spécialisation de cette classe, directement intégrée à SFML.
</p>
<p>
    Vous n'avez qu'une fonction virtuelle à redéfinir dans votre classe dérivée : <code>onProcessSamples</code>. Elle est appelée à chaque fois qu'un
    nouveau lot d'échantillons audio ont été capturés, c'est donc là que vous devez implémenter votre traitement perso.
</p>
<p>
    Par défaut, les échantillons audio sont fournis à la fonction membre <code>onProcessSamples</code> toutes les 100 ms. Vous pouvez changer
    l'intervalle en utilisant la fonction membre <code>setProcessingInterval</code>. Vous souhaiterez probablement utiliser un intervalle plus
    petit si vous voulez manipuler les données enregistrées en temps réel, par exemple. Notez que ceci n'est qu'un indice et qu'il se peut que
    l'intervalle utilisé en pratique varie, donc ne vous y fiez pas pour implémenter un timing précis.
</p>
<p>
    Il existe deux autres fonctions virtuelles que vous pouvez redéfinir si vous le souhaitez : <code>onStart</code> et <code>onStop</code>. Elles sont
    appelées respectivement lorsque la capture démarre/est arrêtée. Elles peuvent être utiles pour les tâches d'initialisation et de nettoyage.
</p>
<p>
    Voici le squelette d'une classe dérivée complète :
</p>
<pre><code class="cpp">class MyRecorder : public sf::SoundRecorder
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
</code></pre>
<p>
    Les fonctions <code>isAvailable</code>/<code>start</code>/<code>stop</code> sont définies dans la classe de base, <?php class_link("SoundRecorder") ?>,
    et donc par conséquent dans toutes les classes dérivées. Cela signifie que vous pouvez utiliser n'importe quelle enregistreur exactement de la même
    manière que la classe <?php class_link("SoundBufferRecorder") ?> ci-dessus.
</p>
<pre><code class="cpp">if (!MyRecorder::isAvailable())
{
    // erreur...
}

MyRecorder recorder;
recorder.start();
...
recorder.stop();
</code></pre>

<?php h2('Attention aux threads') ?>
<p>
    Comme la capture est effectuée dans un thread, il est important de savoir ce qui se passe exactement, et où.
</p>
<p>
    <code>onStart</code> sera appelée directement par la fonction <code>start</code>, donc elle sera exécutée dans le thread qui l'a appelée. Par contre,
    <code>onProcessSample</code> et <code>onStop</code> seront toujours appelées depuis le thread de capture interne que SFML crée.
</p>
<p>
    Donc, si votre enregistreur utilise des données qui peuvent être accédées de manière <em>concurrente</em> (c'est-à-dire en même temps) à la fois par
    le thread appelant et par le thread d'enregistrement, il faudra les protéger (avec un mutex ou autre) afin d'éviter les accès concurrents, qui
    pourraient entraîner des comportements indéterminés -- données audio corrompues, crashs, etc.
</p>
<p>
    Si vous n'êtes pas suffisamment à l'aise avec les problèmes liés aux threads, vous pouvez faire un saut par le
    <a class="internal" href="./system-thread-fr.php" title="Tutoriel sur les threads">tutoriel correspondant</a>.
</p>

<?php

    require("footer-fr.php");

?>
