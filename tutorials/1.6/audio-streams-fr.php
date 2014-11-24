<?php

    $title = "Utiliser les flux";
    $page = "audio-streams-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les flux</h1>

<?php h2('Introduction') ?>
<p>
    Parfois, il arrive que les données audio ne puissent pas être chargées intégralement en mémoire. Par exemple,
    un son peut être transmis par le réseau, ou lu à la volée à partir d'un fichier volumineux. Dans de tels cas, vous devez être
    capables de jouer le son tout en le chargeant au fur et à mesure, et toujours donner l'illusion que vous le
    jouez en un bloc. C'est ce que l'on appelle la lecture en flux, ou lecture en continu (<em>streaming</em>).
</p>
<p>
    La SFML fournit une classe de base pour implémenter la lecture en continu à partir de sources quelconques :
    <?php class_link("SoundStream")?>. Celle-ci gère tout, la seule tâche qu'il vous reste à effectuer est de fournir de nouvelles
    données audio lorsqu'elle en a besoin.
</p>

<?php h2('Utilisation de base') ?>
<p>
    <?php class_link("SoundStream")?>, tout comme <?php class_link("Sound")?> et <?php class_link("Music")?>, est toujours un son ; ainsi
    elle définit les accesseurs habituels pour le volume, le pitch, le taux d'échantillonnage, etc. Elle définit
    également les trois fonctions de contrôle : jouer (<code>Play</code>), mettre en pause (<code>Pause</code>)
    et stopper (<code>Stop</code>). Il y a par contre quelques fonctionnalités qu'un flux ne peut fournir par rapport
    à un son ou une musique : il ne peut pas vous donner la durée totale (qui n'est connue que lorsque le son
    a été entièrement joué), il ne peut pas boucler tout seul, et ne peut pas vous donner la position de lecture
    courante. Par contre, si votre source le permet, rien ne vous empêche d'ajouter ces fonctionnalités manquantes
    dans votre spécialisation de <?php class_link("SoundStream")?>.
</p>

<?php h2('Définir un flux personnalisé') ?>
<p>
    <?php class_link("SoundStream")?> est conçue pour être utilisée en tant que classe de base abstraite. Ainsi, pour créer
    vos propres flux, vous devez tout d'abord créer une classe dérivée :
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
    ...
};
</code></pre>
<p>
    Puis, pour personnaliser le comportement de votre flux, vous avez deux fonctions virtuelles à redéfinir :
</p>
<ul>
    <li><code>OnStart</code>, qui est appelée à chaque fois que le flux redémarre ; elle est optionnelle, ne la
    redéfinissez que si vous avez besoin d'effectuer des traitements spécifiques à l'initialisation</li>
    <li><code>OnGetData</code>, qui sera appelée à chaque fois que le flux aura besoin d'un nouveau bloc
    de données audio à lire</li>
</ul>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
    virtual bool OnStart()
    {
        // ...

        return true;
    }

    virtual bool OnGetData(Chunk&amp; Data)
    {
        // ...

        Data.Samples   = ...;
        Data.NbSamples = ...;

        return true;
    }
};
</code></pre>
<p>
    Ces deux fonction retournent un booléen, qui signifie "est-ce que tout est toujours ok ?". Ainsi si une erreur survient,
    ou s'il n'y a plus de données audio à jouer, vous pouvez renvoyer <code>false</code>. Renvoyer <code>false</code>
    stoppera immédiatement la lecture du flux.
</p>
<p>
    <code>OnGetData</code> vous donne une instance de <code>Chunk</code> à remplir, avec un pointeur vers les nouvelles
    données audio à jouer (<code>Data.Samples</code>) et le nombre d'échantillons à jouer (<code>Data.NbSamples</code>).
    Les échantillons audio, comme n'importe où dans le module audio de la SFML, doivent être des entiers 16 bits signés.
</p>
<p>
    Il reste une étape à réaliser avant que votre flux ne soit fonctionnel : vous devez lui fournir les paramètres
    du son, c'est-à-dire le nombre de canaux et le taux d'échantillonnage. Pour se faire, appelez simplement
    la fonction <code>Initialize</code> dès que vous connaissez ces paramètres.
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
public :

    void SomeInitFunction()
    {
        unsigned int ChannelsCount = ...;
        unsigned int SampleRate    = ...;

        Initialize(ChannelsCount, SampleRate);
    }
};
</code></pre>
<p>
    A partir du moment où la fonction <code>Initialize</code> a été appelée, le flux est prêt à être lu.
</p>
<p>
    Voici un exemple qui illustre l'utilisation de <?php class_link("SoundStream")?> : une classe personnalisée qui
    effectue une lecture en continu depuis un tampon sonore chargé à partir d'un fichier. Oui, c'est complétement inutile,
    mais cela vous donnera une vue plus claire de la classe <?php class_link("SoundStream")?>.
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
public :

    ////////////////////////////////////////////////////////////
    /// Constructeur
    ////////////////////////////////////////////////////////////
    MyCustomStream(std::size_t BufferSize) :
    myOffset    (0),
    myBufferSize(BufferSize)
    {

    }

    ////////////////////////////////////////////////////////////
    /// Charge les données audio à partir d'un fichier
    ////////////////////////////////////////////////////////////
    bool Open(const std::string&amp; Filename)
    {
        // Charge les données audio dans un tampon sonore
        sf::SoundBuffer SoundData;
        if (SoundData.LoadFromFile(Filename))
        {
            // Initialise le flux avec les paramètres du son
            Initialize(SoundData.GetChannelsCount(), SoundData.GetSampleRate());

            // Copie les échantillons audio dans notre tampon interne
            const sf::Int16* Data = SoundData.GetSamples();
            myBuffer.assign(Data, Data + SoundData.GetSamplesCount());

            return true;
        }

        return false;
    }

private :

    ////////////////////////////////////////////////////////////
    /// /see sfSoundStream::OnStart
    ////////////////////////////////////////////////////////////
    virtual bool OnStart()
    {
        // Remet à zéro la position de lecture
        myOffset = 0;

        return true;
    }

    ////////////////////////////////////////////////////////////
    /// /see sfSoundStream::OnGetData
    ////////////////////////////////////////////////////////////
    virtual bool OnGetData(sf::SoundStream::Chunk&amp; Data)
    {
        // Vérifie qu'il y a suffisamment de données à lire
        if (myOffset + myBufferSize >= myBuffer.size())
        {
            // Renvoyer false signifie que nous voulons stopper la lecture du flux
            return false;
        }

        // Remplit le bloc avec un pointeur vers les données audio et le nombre d'échantillons à lire
        Data.Samples   = &amp;myBuffer[myOffset];
        Data.NbSamples = myBufferSize;

        // Met à jour la position de lecture
        myOffset += myBufferSize;

        return true;
    }

    ////////////////////////////////////////////////////////////
    // Données membres
    ////////////////////////////////////////////////////////////
    std::vector&lt;sf::Int16&gt; myBuffer;     ///&lt; Tampon interne qui contient les données audio
    std::size_t            myOffset;     ///&lt; Position de lecture courante dans le tampon interne
    std::size_t            myBufferSize; ///&lt; Taille des données audio à envoyer
};
</code></pre>

<?php h2('Multi-threading') ?>
<p>
    Afin d'éviter de bloquer l'application, les flux audio utilisent un nouveau thread lorsque vous les jouez.
    Etant donné que <code>OnGetData</code> va être appelée à partir de ce nouveau thread, cela signifie que le
    code que vous allez y mettre sera exécuté en parallèle du thread principal. Il est important de garder ceci en tête,
    car vous pourriez avoir à gérer des problèmes de synchronisation si vous partagez des variables entre les deux
    threads.
</p>
<p>
    Imaginez que votre flux audio lise un son reçu depuis le réseau. Les échantillons audio vont être joués pendant
    que les suivants seront en train d'être reçus. Ainsi, le thread principal va remplir le tableau d'échantillons avec
    les données provenant du réseau, pendant que le thread secondaire va lire depuis le tableau d'échantillons
    pour alimenter le flux. Comme la lecture et l'écriture dans le tableau d'échantillons s'exécutent dans deux threads
    différents, elles peuvent arriver au même moment, ce qui conduirait à des comportements indéfinis.
    Dans ce cas précis, nous pouvons facilement protéger le tableau avec un mutex, et ainsi éviter les accès concurrents.<br/>
    Pour en savoir plus à propos des threads et des mutexs, vous pouvez jeter un oeil au
    <a class="internal" href="./system-threads-fr.php" title="Tutoriel sur les threads et mutexs">tutoriel correspondant</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    <?php class_link("SoundStream")?> fournit une interface simple pour réaliser des lectures en continu à partir de n'importe
    quelles sources. Gardez toujours en tête qu'un flux tournera dans un nouveau thread, et préoccupez-vous des problèmes
    de synchronisation.
</p>
<p>
    Le prochain tutoriel vous montrera comment
    <a class="internal" href="./audio-capture-fr.php" title="Aller au tutoriel suivant">réaliser des captures audio</a>.
</p>

<?php

    require("footer-fr.php");

?>
