<?php

    $title = "Utiliser les flux";
    $page = "audio-streams-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les flux</h1>

<?php h2('Introduction') ?>
<p>
    Parfois, il arrive que les donn�es audio ne puissent pas �tre charg�es int�gralement en m�moire. Par exemple,
    un son peut �tre transmis par le r�seau, ou lu � la vol�e � partir d'un fichier volumineux. Dans de tels cas, vous devez �tre
    capables de jouer le son tout en le chargeant au fur et � mesure, et toujours donner l'illusion que vous le
    jouez en un bloc. C'est ce que l'on appelle la lecture en flux, ou lecture en continu (<em>streaming</em>).
</p>
<p>
    La SFML fournit une classe de base pour impl�menter la lecture en continu � partir de sources quelconques :
    <?php class_link("SoundStream")?>. Celle-ci g�re tout, la seule t�che qu'il vous reste � effectuer est de fournir de nouvelles
    donn�es audio lorsqu'elle en a besoin.
</p>

<?php h2('Utilisation de base') ?>
<p>
    <?php class_link("SoundStream")?>, tout comme <?php class_link("Sound")?> et <?php class_link("Music")?>, est toujours un son ; ainsi
    elle d�finit les accesseurs habituels pour le volume, le pitch, le taux d'�chantillonnage, etc. Elle d�finit
    �galement les trois fonctions de contr�le : jouer (<code>Play</code>), mettre en pause (<code>Pause</code>)
    et stopper (<code>Stop</code>). Il y a par contre quelques fonctionnalit�s qu'un flux ne peut fournir par rapport
    � un son ou une musique : il ne peut pas vous donner la dur�e totale (qui n'est connue que lorsque le son
    a �t� enti�rement jou�), il ne peut pas boucler tout seul, et ne peut pas vous donner la position de lecture
    courante. Par contre, si votre source le permet, rien ne vous emp�che d'ajouter ces fonctionnalit�s manquantes
    dans votre sp�cialisation de <?php class_link("SoundStream")?>.
</p>

<?php h2('D�finir un flux personnalis�') ?>
<p>
    <?php class_link("SoundStream")?> est con�ue pour �tre utilis�e en tant que classe de base abstraite. Ainsi, pour cr�er
    vos propres flux, vous devez tout d'abord cr�er une classe d�riv�e :
</p>
<pre><code class="cpp">class MyCustomStream : public sf::SoundStream
{
    ...
};
</code></pre>
<p>
    Puis, pour personnaliser le comportement de votre flux, vous avez deux fonctions virtuelles � red�finir :
</p>
<ul>
    <li><code>OnStart</code>, qui est appel�e � chaque fois que le flux red�marre ; elle est optionnelle, ne la
    red�finissez que si vous avez besoin d'effectuer des traitements sp�cifiques � l'initialisation</li>
    <li><code>OnGetData</code>, qui sera appel�e � chaque fois que le flux aura besoin d'un nouveau bloc
    de donn�es audio � lire</li>
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
    Ces deux fonction retournent un bool�en, qui signifie "est-ce que tout est toujours ok ?". Ainsi si une erreur survient,
    ou s'il n'y a plus de donn�es audio � jouer, vous pouvez renvoyer <code>false</code>. Renvoyer <code>false</code>
    stoppera imm�diatement la lecture du flux.
</p>
<p>
    <code>OnGetData</code> vous donne une instance de <code>Chunk</code> � remplir, avec un pointeur vers les nouvelles
    donn�es audio � jouer (<code>Data.Samples</code>) et le nombre d'�chantillons � jouer (<code>Data.NbSamples</code>).
    Les �chantillons audio, comme n'importe o� dans le module audio de la SFML, doivent �tre des entiers 16 bits sign�s.
</p>
<p>
    Il reste une �tape � r�aliser avant que votre flux ne soit fonctionnel : vous devez lui fournir les param�tres
    du son, c'est-�-dire le nombre de canaux et le taux d'�chantillonnage. Pour se faire, appelez simplement
    la fonction <code>Initialize</code> d�s que vous connaissez ces param�tres.
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
    A partir du moment o� la fonction <code>Initialize</code> a �t� appel�e, le flux est pr�t � �tre lu.
</p>
<p>
    Voici un exemple qui illustre l'utilisation de <?php class_link("SoundStream")?> : une classe personnalis�e qui
    effectue une lecture en continu depuis un tampon sonore charg� � partir d'un fichier. Oui, c'est compl�tement inutile,
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
    /// Charge les donn�es audio � partir d'un fichier
    ////////////////////////////////////////////////////////////
    bool Open(const std::string&amp; Filename)
    {
        // Charge les donn�es audio dans un tampon sonore
        sf::SoundBuffer SoundData;
        if (SoundData.LoadFromFile(Filename))
        {
            // Initialise le flux avec les param�tres du son
            Initialize(SoundData.GetChannelsCount(), SoundData.GetSampleRate());

            // Copie les �chantillons audio dans notre tampon interne
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
        // Remet � z�ro la position de lecture
        myOffset = 0;

        return true;
    }

    ////////////////////////////////////////////////////////////
    /// /see sfSoundStream::OnGetData
    ////////////////////////////////////////////////////////////
    virtual bool OnGetData(sf::SoundStream::Chunk&amp; Data)
    {
        // V�rifie qu'il y a suffisamment de donn�es � lire
        if (myOffset + myBufferSize >= myBuffer.size())
        {
            // Renvoyer false signifie que nous voulons stopper la lecture du flux
            return false;
        }

        // Remplit le bloc avec un pointeur vers les donn�es audio et le nombre d'�chantillons � lire
        Data.Samples   = &amp;myBuffer[myOffset];
        Data.NbSamples = myBufferSize;

        // Met � jour la position de lecture
        myOffset += myBufferSize;

        return true;
    }

    ////////////////////////////////////////////////////////////
    // Donn�es membres
    ////////////////////////////////////////////////////////////
    std::vector&lt;sf::Int16&gt; myBuffer;     ///&lt; Tampon interne qui contient les donn�es audio
    std::size_t            myOffset;     ///&lt; Position de lecture courante dans le tampon interne
    std::size_t            myBufferSize; ///&lt; Taille des donn�es audio � envoyer
};
</code></pre>

<?php h2('Multi-threading') ?>
<p>
    Afin d'�viter de bloquer l'application, les flux audio utilisent un nouveau thread lorsque vous les jouez.
    Etant donn� que <code>OnGetData</code> va �tre appel�e � partir de ce nouveau thread, cela signifie que le
    code que vous allez y mettre sera ex�cut� en parall�le du thread principal. Il est important de garder ceci en t�te,
    car vous pourriez avoir � g�rer des probl�mes de synchronisation si vous partagez des variables entre les deux
    threads.
</p>
<p>
    Imaginez que votre flux audio lise un son re�u depuis le r�seau. Les �chantillons audio vont �tre jou�s pendant
    que les suivants seront en train d'�tre re�us. Ainsi, le thread principal va remplir le tableau d'�chantillons avec
    les donn�es provenant du r�seau, pendant que le thread secondaire va lire depuis le tableau d'�chantillons
    pour alimenter le flux. Comme la lecture et l'�criture dans le tableau d'�chantillons s'ex�cutent dans deux threads
    diff�rents, elles peuvent arriver au m�me moment, ce qui conduirait � des comportements ind�finis.
    Dans ce cas pr�cis, nous pouvons facilement prot�ger le tableau avec un mutex, et ainsi �viter les acc�s concurrents.<br/>
    Pour en savoir plus � propos des threads et des mutexs, vous pouvez jeter un oeil au
    <a class="internal" href="./system-threads-fr.php" title="Tutoriel sur les threads et mutexs">tutoriel correspondant</a>.
</p>

<?php h2('Conclusion') ?>
<p>
    <?php class_link("SoundStream")?> fournit une interface simple pour r�aliser des lectures en continu � partir de n'importe
    quelles sources. Gardez toujours en t�te qu'un flux tournera dans un nouveau thread, et pr�occupez-vous des probl�mes
    de synchronisation.
</p>
<p>
    Le prochain tutoriel vous montrera comment
    <a class="internal" href="./audio-capture-fr.php" title="Aller au tutoriel suivant">r�aliser des captures audio</a>.
</p>

<?php

    require("footer-fr.php");

?>
