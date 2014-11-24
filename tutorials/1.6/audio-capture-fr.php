<?php

    $title = "Capturer des donn�es audio";
    $page = "audio-capture-fr.php";

    require("header-fr.php");
?>

<h1>Capturer des donn�es audio</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel va vous montrer comment capturer facilement des donn�es audio en provenance de votre microphone,
    et leur appliquer des traitements personnalis�s, comme par exemple les sauver dans un tampon sonore, ou les
    envoyer directement sur le r�seau.
</p>

<?php h2('Cr�er un enregistreur personnalis�') ?>
<p>
    La classe qui d�finit l'interface de capture dans la SFML est <?php class_link("SoundRecorder")?>.
    Etant donn� qu'elle ne sait pas quoi faire des �chantillons audio captur�s (et elle n'a pas � le savoir),
    ce n'est qu'une classe de base pour votre propres enregistreurs persos. <?php class_link("SoundRecorder")?> vous
    fournit les �chantillons enregistr�s, tout ce que vous avez ensuite � faire est... ce que vous voulez : les envoyer
    via le r�seau, les copier dans un tampon sonore, etc.
</p>
<p>
    Voici les fonctions � red�finir dans un enregistreur d�riv� de <?php class_link("SoundRecorder")?> :
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
    <code>OnStart</code> est appel�e une fois � chaque nouvelle capture (appel � <code>Start</code>).
    Cette fonction est optionnelle, et ne fera rien si vous ne la red�finissez pas. Si vous le faites, la valeur de retour
    est un bool�en qui doit �tre <code>true</code> pour d�marrer la capture, ou <code>false</code> pour l'annuler
    (par exemple apr�s une erreur).
</p>
<p>
    <code>OnProcessSamples</code> est appel�e � chaque fois que l'enregistreur a captur� suffisamment de donn�es audio; donc
    r�guli�rement tout au long de l'enregistrement. Cette fonction est obligatoire (un enregistreur sans fonction pour
    traiter les donn�es audio n'aurait aucun sens), vous devez donc la red�finir dans vos enregistreurs persos. Tout comme
    <code>OnStart</code>, la valeur de retour signifie "est-ce qu'on peut continuer la capture ?".<br/>
    Le param�tre <code>Samples</code> est un pointeur vers le tableau des �chantillons sonores captur�s, et
    <code>SamplesCount</code> est le nombre d'�chantillons dans ce tableau.

</p>
<p>
    <code>OnStop</code> est appel�e � chaque fois que la capture en cours est arr�t�e. De mani�re similaire �
    <code>OnStart</code>, elle est optionnelle et ne fera rien de particulier si vous ne la red�finissez pas.
</p>

<?php h2('Utilisation') ?>
<p>
    L'interface de <?php class_link("SoundRecorder")?> est assez simple. Tout d'abord, vous devez v�rifier que votre syst�me
    supporte bien la capture audio. Cela peut �tre fait via la fonction statique <code>CanCapture</code> :
</p>
<pre><code class="cpp">if (!sf::SoundRecorder::CanCapture())
{
    // N'essayez m�me pas d'utiliser la capture audio...
}
</code></pre>
<p>
    Pour bien faire, vous devriez le v�rifier avant chaque utilisation de <?php class_link("SoundRecorder")?>.
</p>
<p>
    Puis, pour d�marrer la capture appelez <code>Start</code>, et pour la stopper appelez <code>Stop</code>.
</p>
<pre><code class="cpp">MyCustomSoundRecorder Recorder;

Recorder.Start(96000);

// On attend un peu...

Recorder.Stop();
</code></pre>
<p>
    Lorsque vous appelez <code>Start</code>, vous pouvez passer en param�tre le taux d'�chantillonnage qui sera utilis�
    pour la capture. En l'absence de param�tre, c'est 44100 sera utilis� (qualit� CD). Si vous avez besoin de r�cup�rer
    ce taux d'�chantillonnage plus tard, vous pouvez appeler la fonction <code>GetSampleRate</code>.
</p>
<pre><code class="cpp">unsigned int SampleRate = Recorder.GetSampleRate();
</code></pre>

<?php h2('Enregistrer des donn�es dans un tampon sonore') ?>
<p>
    L'utilisation la plus fr�quente est probablement de sauvegarder les donn�es audio dans un tampon sonore,
    de mani�re � pouvoir les sauvegarder dans un fichier ou encore les lire imm�diatement. La SFML poss�de une
    sp�cialisation de <?php class_link("SoundRecorder")?> pr�d�finie pour cela : <?php class_link("SoundBufferRecorder")?>. Elle copie
    les �chantillons audio captur�s dans un <?php class_link("SoundBuffer")?>, que vous pouvez r�cup�rer via la fonction
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
    Pour les m�mes raisons que <?php class_link("SoundStream")?>, <?php class_link("SoundRecorder")?> ex�cute la capture dans un
    nouveau thread, ainsi le thread principal n'est pas bloqu�. Ainsi, une fois de plus, vous devez faire attention
    aux �ventuels probl�mes de synchronisation qui peuvent survenir si vous partagez des donn�es entre les deux
    threads.<br/>
    Pour des explications plus d�taill�es, vous pouvez jeter un oeil, si ce n'est d�j� fait, au
    <a class="internal" href="./audio-streams-fr.php" title="Aller au tutoriel sur les flux">tutoriel sur les flux</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    Vous en avez fini avec les bases du module audio. Vous pouvez jouer des sons et des musiques, effectuer des lectures
    en continue � partir de n'importe quelle source, et enregistrer des sons � partir de votre microphone.<br/>
    Int�ressons-nous mainternant � un sujet plus avanc� :
    <a class="internal" href="./audio-spatialization-fr.php" title="Passer au tutoriel suivant">la spatialisation des sons</a>.
</p>

<?php

    require("footer-fr.php");

?>
