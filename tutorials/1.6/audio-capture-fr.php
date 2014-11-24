<?php

    $title = "Capturer des données audio";
    $page = "audio-capture-fr.php";

    require("header-fr.php");
?>

<h1>Capturer des données audio</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel va vous montrer comment capturer facilement des données audio en provenance de votre microphone,
    et leur appliquer des traitements personnalisés, comme par exemple les sauver dans un tampon sonore, ou les
    envoyer directement sur le réseau.
</p>

<?php h2('Créer un enregistreur personnalisé') ?>
<p>
    La classe qui définit l'interface de capture dans la SFML est <?php class_link("SoundRecorder")?>.
    Etant donné qu'elle ne sait pas quoi faire des échantillons audio capturés (et elle n'a pas à le savoir),
    ce n'est qu'une classe de base pour votre propres enregistreurs persos. <?php class_link("SoundRecorder")?> vous
    fournit les échantillons enregistrés, tout ce que vous avez ensuite à faire est... ce que vous voulez : les envoyer
    via le réseau, les copier dans un tampon sonore, etc.
</p>
<p>
    Voici les fonctions à redéfinir dans un enregistreur dérivé de <?php class_link("SoundRecorder")?> :
</p>
<pre><code class="cpp">class MyCustomSoundRecorder : public sf::SoundRecorder
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
</code></pre>
<p>
    <code>OnStart</code> est appelée une fois à chaque nouvelle capture (appel à <code>Start</code>).
    Cette fonction est optionnelle, et ne fera rien si vous ne la redéfinissez pas. Si vous le faites, la valeur de retour
    est un booléen qui doit être <code>true</code> pour démarrer la capture, ou <code>false</code> pour l'annuler
    (par exemple après une erreur).
</p>
<p>
    <code>OnProcessSamples</code> est appelée à chaque fois que l'enregistreur a capturé suffisamment de données audio; donc
    régulièrement tout au long de l'enregistrement. Cette fonction est obligatoire (un enregistreur sans fonction pour
    traiter les données audio n'aurait aucun sens), vous devez donc la redéfinir dans vos enregistreurs persos. Tout comme
    <code>OnStart</code>, la valeur de retour signifie "est-ce qu'on peut continuer la capture ?".<br/>
    Le paramètre <code>Samples</code> est un pointeur vers le tableau des échantillons sonores capturés, et
    <code>SamplesCount</code> est le nombre d'échantillons dans ce tableau.

</p>
<p>
    <code>OnStop</code> est appelée à chaque fois que la capture en cours est arrêtée. De manière similaire à
    <code>OnStart</code>, elle est optionnelle et ne fera rien de particulier si vous ne la redéfinissez pas.
</p>

<?php h2('Utilisation') ?>
<p>
    L'interface de <?php class_link("SoundRecorder")?> est assez simple. Tout d'abord, vous devez vérifier que votre système
    supporte bien la capture audio. Cela peut être fait via la fonction statique <code>CanCapture</code> :
</p>
<pre><code class="cpp">if (!sf::SoundRecorder::CanCapture())
{
    // N'essayez même pas d'utiliser la capture audio...
}
</code></pre>
<p>
    Pour bien faire, vous devriez le vérifier avant chaque utilisation de <?php class_link("SoundRecorder")?>.
</p>
<p>
    Puis, pour démarrer la capture appelez <code>Start</code>, et pour la stopper appelez <code>Stop</code>.
</p>
<pre><code class="cpp">MyCustomSoundRecorder Recorder;

Recorder.Start(96000);

// On attend un peu...

Recorder.Stop();
</code></pre>
<p>
    Lorsque vous appelez <code>Start</code>, vous pouvez passer en paramètre le taux d'échantillonnage qui sera utilisé
    pour la capture. En l'absence de paramètre, c'est 44100 sera utilisé (qualité CD). Si vous avez besoin de récupérer
    ce taux d'échantillonnage plus tard, vous pouvez appeler la fonction <code>GetSampleRate</code>.
</p>
<pre><code class="cpp">unsigned int SampleRate = Recorder.GetSampleRate();
</code></pre>

<?php h2('Enregistrer des données dans un tampon sonore') ?>
<p>
    L'utilisation la plus fréquente est probablement de sauvegarder les données audio dans un tampon sonore,
    de manière à pouvoir les sauvegarder dans un fichier ou encore les lire immédiatement. La SFML possède une
    spécialisation de <?php class_link("SoundRecorder")?> prédéfinie pour cela : <?php class_link("SoundBufferRecorder")?>. Elle copie
    les échantillons audio capturés dans un <?php class_link("SoundBuffer")?>, que vous pouvez récupérer via la fonction
    <code>GetBuffer</code> :
</p>
<pre><code class="cpp">sf::SoundBufferRecorder Recorder;

Recorder.Start();

// On attend un peu...

Recorder.Stop();

sf::SoundBuffer Buffer = Recorder.GetBuffer();
</code></pre>

<?php h2('Multi-threading') ?>
<p>
    Pour les mêmes raisons que <?php class_link("SoundStream")?>, <?php class_link("SoundRecorder")?> exécute la capture dans un
    nouveau thread, ainsi le thread principal n'est pas bloqué. Ainsi, une fois de plus, vous devez faire attention
    aux éventuels problèmes de synchronisation qui peuvent survenir si vous partagez des données entre les deux
    threads.<br/>
    Pour des explications plus détaillées, vous pouvez jeter un oeil, si ce n'est déjà fait, au
    <a class="internal" href="./audio-streams-fr.php" title="Aller au tutoriel sur les flux">tutoriel sur les flux</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    Vous en avez fini avec les bases du module audio. Vous pouvez jouer des sons et des musiques, effectuer des lectures
    en continue à partir de n'importe quelle source, et enregistrer des sons à partir de votre microphone.<br/>
    Intéressons-nous mainternant à un sujet plus avancé :
    <a class="internal" href="./audio-spatialization-fr.php" title="Passer au tutoriel suivant">la spatialisation des sons</a>.
</p>

<?php

    require("footer-fr.php");

?>
