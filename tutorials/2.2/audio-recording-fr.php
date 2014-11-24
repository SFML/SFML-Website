<?php

    $title = "Effectuer des captures audio";
    $page = "audio-recording-fr.php";

    require("header-fr.php");

?>

<h1>Effectuer des captures audio</h1>

<?php h2('Effectuer une capture dans un buffer') ?>
<p>
    Le destin le plus probable pour des donn�es audio captur�es, est d'�tre sauvegard�es dans un buffer (<?php class_link("SoundBuffer") ?>) de sorte
    qu'elles puissent �tre jou�es ou bien sauvegard�es dans un fichier.
</p>
<p>
    Ce type de capture peut �tre effectu� via l'interface tr�s simple de la classe <?php class_link("SoundBufferRecorder") ?> :
</p>
<pre><code class="cpp">// tout d'abord on v�rifie si la capture est support�e par le syst�me
if (!SoundBufferRecorder::isAvailable())
{
    // erreur : la capture audio n'est pas support�e
    ...
}

// cr�ation de l'enregistreur
SoundBufferRecorder recorder;

// d�marrage de l'enregistrement
recorder.start();

// on attend...

// fin de l'enregistrement
recorder.stop();

// r�cup�ration du buffer qui contient les donn�es audio enregistr�es
const sf::SoundBuffer&amp; buffer = recorder.getBuffer();
</code></pre>
<p>
    La fonction statique <code>SoundBufferRecorder::isAvailable</code> v�rifie si la capture audio est support�e par le syst�me. Si elle renvoie
    <code>false</code>, vous ne pourrez pas utiliser la classe <?php class_link("SoundBufferRecorder") ?>.
</p>
<p>
    Les fonctions <code>start</code> et <code>stop</code> sont assez explicites. La capture tourne dans son propre thread, ce qui signifie que vous
    pouvez faire tout ce qui vous chante entre le d�but et la fin de l'enregistrement. Apr�s la fin de la capture, les donn�es audio sont disponibles
    dans un buffer que vous pouvez r�cup�rer avec la fonction <code>getBuffer</code>.
</p>
<p>
    Avec les donn�es enregistr�es, vous pouvez ensuite :
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
        Acc�der aux donn�es brutes et les analyser, transformer, etc.
<pre><code class="cpp">const sf::Int16* samples = buffer.getSamples();
std::size_t count = buffer.getSampleCount();
doSomething(samples, count);    
</code></pre>
    </li>
</ul>
<p class="important">
    Si vous comptez utiliser les donn�es captur�es apr�s que l'enregistreur a �t� d�truit ou red�marr�, n'oubliez pas de faire une <em>copie</em>
    du buffer.
</p>

<?php h2('Enregistrement personnalis�') ?>
<p>
    Si stocker les donn�es enregistr�es dans un buffer audio n'est pas ce que vous voulez, vous pouvez tout aussi bien �crire votre propre enregistreur.
    Cela vous permettra de traiter les donn�es audio pendant qu'elles sont en train d'�tre captur�es, (presque) directement d�s qu'elles arrivent du
    p�riph�rique d'enregistrement. De cette fa�on vous pouvez, par exemple, <em>streamer</em> les donn�es captur�es sur le r�seau, en effectuer une
    analyse temps-r�el, etc.
</p>
<p>
    Pour �crire votre propre enregistreur, vous devez h�riter de la classe abstraite <?php class_link("SoundRecorder") ?>. En fait,
    <?php class_link("SoundBufferRecorder") ?> est juste une sp�cialisation de cette classe, directement int�gr�e � SFML.
</p>
<p>
    Vous n'avez qu'une fonction virtuelle � red�finir dans votre classe d�riv�e : <code>onProcessSamples</code>. Elle est appel�e � chaque fois qu'un
    nouveau lot d'�chantillons audio ont �t� captur�s, c'est donc l� que vous devez impl�menter votre traitement perso.
</p>
<p class="important">
    Des �chantillons audio sont pass�s � la fonction <code>onProcessSamples</code> toutes les 100 ms. Cette valeur est fix�e dans le code de SFML et
    vous ne pouvez pas la changer (� moins de modifier SFML directement). Ceci sera probablement am�lior� dans une prochaine version.
</p>
<p>
    Il existe deux autres fonctions virtuelles que vous pouvez red�finir si vous le souhaitez : <code>onStart</code> et <code>onStop</code>. Elles sont
    appel�es respectivement lorsque la capture d�marre/est arr�t�e. Elles peuvent �tre utiles pour les t�ches d'initialisation et de nettoyage.
</p>
<p>
    Voici le squelette d'une classe d�riv�e compl�te :
</p>
<pre><code class="cpp">class MyRecorder : public sf::SoundRecorder
{
    virtual bool onStart() // optionnelle
    {
        // initialisez ce qui doit l'�tre avant que la capture d�marre
        ...

        // renvoyez true pour d�marrer la capture, ou false pour l'annuler
        return true;
    }

    virtual bool onProcessSamples(const Int16* samples, std::size_t sampleCount)
    {
        // faites ce que vous voulez des �chantillons audio
        ...

        // renvoyez true pour continuer la capture, ou false pour la stopper
        return true;
    }

    virtual void onStop() // optionnelle
    {
        // nettoyez ce qui doit l'�tre apr�s la fin de la capture
        ...
    }
}
</code></pre>
<p>
    Les fonctions <code>isAvailable</code>/<code>start</code>/<code>stop</code> sont d�finies dans la classe de base, <?php class_link("SoundRecorder") ?>,
    et donc par cons�quent dans toutes les classes d�riv�es. Cela signifie que vous pouvez utiliser n'importe quelle enregistreur exactement de la m�me
    mani�re que la classe <?php class_link("SoundBufferRecorder") ?> ci-dessus.
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
    Comme la capture est effectu�e dans un thread, il est important de savoir ce qui se passe exactement, et o�.
</p>
<p>
    <code>onStart</code> sera appel�e directement par la fonction <code>start</code>, donc elle sera ex�cut�e dans le thread qui l'a appel�e. Par contre,
    <code>onProcessSample</code> et <code>onStop</code> seront toujours appel�es depuis le thread de capture interne que SFML cr�e.
</p>
<p>
    Donc, si votre enregistreur utilise des donn�es qui peuvent �tre acc�d�es de mani�re <em>concurrente</em> (c'est-�-dire en m�me temps) � la fois par
    le thread appelant et par le thread d'enregistrement, il faudra les prot�ger (avec un mutex ou autre) afin d'�viter les acc�s concurrents, qui
    pourraient entra�ner des comportements ind�termin�s -- donn�es audio corrompues, crashs, etc.
</p>
<p>
    Si vous n'�tes pas suffisamment � l'aise avec les probl�mes li�s aux threads, vous pouvez faire un saut par le
    <a class="internal" href="./system-thread-fr.php" title="Tutoriel sur les threads">tutoriel correspondant</a>.
</p>

<?php

    require("footer-fr.php");

?>
