<?php

    $title = "Utiliser les threads et les mutexs";
    $page = "system-threads-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les threads et les mutexs</h1>

<?php h2('Introduction') ?>
<p>
    Tout d'abord, il faut dire que ce tutoriel, bien qu'�tant le premier, n'est pas le plus important.
    En fait vous pouvez tr�s bien commencer � apprendre et � utiliser la SFML sans thread ni mutex.
    Mais en tant que module de base pour tous les autres modules, il est important de savoir quelles
    fonctionnalit�s il peut offrir.
</p>

<?php h2('Qu\'est-ce qu\'un thread ?') ?>
<p>
    Avant d'entrer dans le vif du sujet, qu'est-ce qu'un thread ? Dans quel cas doit-on les utiliser ?
</p>
<p>
    Basiquement, un thread est un moyen d'ex�cuter un ensemble d'instructions ind�pendamment du
    thread principal (tout programme tourne dans un thread : il s'agit de programmes
    <em>monothreaded</em> ; lorsque vous ajoutez un ou plusieurs threads, il s'agit alors de programmes
    <em>multithreaded</em>). D�marrer un thread, c'est un peu comme ex�cuter un nouveau processus,
    except� que c'est beaucoup plus l�ger -- les threads sont aussi appel�s processus l�gers. Tous les
    threads partagent les donn�es de leur processus parent. Ainsi, vous pouvez avoir deux ou plusieurs
    ensembles d'instructions s'ex�cutant en parall�le au sein de votre programme.<br/>
    Ok, alors quand faut-il utiliser les threads ? En gros, lorsque vous devez ex�cuter quelque chose
    demandant beaucoup de temps (un calcul complexe, attente d'un �v�nement, ...) tout en �vitant de
    bloquer l'ex�cution du programme. Par exemple, vous pourriez vouloir afficher une interface graphique
    pendant que vous chargez les ressources de votre jeu (ce qui prend habituellement pas mal de temps),
    ainsi vous pouvez placer le code de chargement dans un thread s�par� du reste. Les threads sont
    �galement largement utilis�s dans la programmation r�seau, afin d'attendre que des donn�es
    soient r�ceptionn�es tout en continuant l'ex�cution du programme.
</p>
<p>
    Dans la SFML, les threads sont d�finis par la classe <?php class_link("Thread")?>. Il existe
    deux fa�ons de l'utiliser, selon vos besoins.
</p>

<?php h2('Utilisation de sf::Thread avec une fonction de rappel (callback)') ?>
<p>
    La premi�re mani�re d'utiliser <?php class_link("Thread")?> est de lui fournir une fonction
    � ex�cuter. Lorsque vous d�marrez le thread, cette fonction sera appel�e en tant que point d'entr�e
    du thread. Celui-ci prendra fin automatiquement lorsque la fonction se terminera.
</p>
<p>
    Voici un exemple simple :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

void ThreadFunction(void* UserData)
{
    // Afficher quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "Je suis le thread numero 1" &lt;&lt; std::endl;
}

int main()
{
    // Cr�ation d'un thread avec notre fonction
    sf::Thread Thread(&amp;ThreadFunction);

    // Lancement du thread !
    Thread.Launch();

    // Afficher quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "Je suis le thread principal" &lt;&lt; std::endl;

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    Lorsque <code>Thread.Launch()</code> est appel�, l'ex�cution est s�par�e en deux
    flots ind�pendants : pendant que <code>ThreadFunction()</code> s'ex�cute,
    <code>main()</code> est en train de se terminer. Ainsi le texte des deux threads sera
    affich� en m�me temps.
</p>
<p>
    Soyez vigilants : ici la fonction <code>main()</code> peut tr�s bien se terminer
    avant la fin de <code>ThreadFunction()</code>, terminant ainsi le programme alors que
    le thread est toujours actif. Cependant ce n'est pas le cas : le destructeur de
    <?php class_link("Thread")?> va attendre que le thread se termine, et ainsi s'assurer que
    le thread ne vivra pas plus longtemps que l'instance de <?php class_link("Thread")?> qui le
    poss�de.
</p>
<p>
    Si vous avez des donn�es � passer au thread, vous pouvez les passer au constructeur de
    <?php class_link("Thread")?> :
</p>
<pre><code class="cpp">MyClass Object;
sf::Thread Thread(&amp;ThreadFunction, &amp;Object);
</code></pre>
<p>
    Vous pouvez ensuite les r�cup�rer avec le param�tre <code>UserData</code> :
</p>
<pre><code class="cpp">void ThreadFunction(void* UserData)
{
    // Transtypage du param�tre en son type r�el
    MyClass* Object = static_cast&lt;MyClass*&gt;(UserData);
}
</code></pre>
<p>
    Attention, assurez-vous que les donn�es que vous passez ne seront pas d�truites avant que le thread
    en ait fini avec !
</p>

<?php h2('Utilisation de sf::Thread en tant que classe de base') ?>
<p>
    L'utilisation d'une fonction callback en tant que thread est simple, et peut �tre utile dans
    certains cas, mais ne se r�v�le pas tr�s flexible. En effet, que se passe-t-il si vous voulez
    utiliser un thread au sein d'une classe ? Ou si vous voulez partager plus de variables
    entre votre thread et le thread principal ?
</p>
<p>
    Afin de permettre plus de flexibilit�, <?php class_link("Thread")?> peut �galement �tre utilis�e
    en tant que classe de base. Au lieu de lui passer une fonction callback � la construction, vous
    pouvez en d�river et red�finir la fonction virtuelle <code>Run()</code>.
    Voici le m�me exemple que ci-dessus, �crit avec une classe d�riv�e au lieu de la fonction callback :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Afficher quelque chose...
        for (int i = 0; i &lt; 10; ++i)
            std::cout &lt;&lt; "Je suis le thread numero 2" &lt;&lt; std::endl;
    }
};

int main()
{
    // Cr�ation d'une instance de notre classe perso de thread
    MyThread Thread;

    // On lance le thread !
    Thread.Launch();

    // Afficher quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "Je suis le thread principal" &lt;&lt; std::endl;

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    Si utiliser un nouveau thread est une fonctionnalit� interne qui ne doit pas appara�tre dans
    l'interface publique de votre classe, vous pouvez utiliser l'h�ritage priv� :
</p>
<pre><code class="cpp">class MyClass : private sf::Thread
{
public :

    void DoSomething()
    {
        Launch();
    }

private :

    virtual void Run()
    {
        // Quelque chose...
    }
};
</code></pre>
<p>
    Ainsi, votre classe n'exposera pas inutilement les fonctions li�es � la manipulation de thread
    dans son interface publique.
</p>

<?php h2('Stopper un thread') ?>
<p>
    Comme nous l'avons d�j� mentionn�, un thread prend fin lorsque la fonction associ�e se termine.
    Mais comment faire pour terminer un thread � partir d'un autre thread, sans attendre que sa fonction
    prenne fin ?
</p>
<p>
    Il existe deux fa�ons de terminer un thread, mais une seule est r�ellement s�re. Regardons
    d'abord la mani�re brutale et non s�re de le faire :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;

void ThreadFunction(void* UserData)
{
    // Quelque chose...
}

int main()
{
    // Cr�ons un thread avec notre fonction
    sf::Thread Thread(&amp;ThreadFunction);

    // D�marrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper imm�diatement
    Thread.Terminate();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    En appelant <code>Terminate()</code>, le thread sera imm�diatemment stopp� sans
    aucune chance de terminer son ex�cution proprement. Cela s'av�re m�me pire, car selon votre
    syst�me d'exploitation, le thread peut m�me ne pas lib�rer les ressources qu'il d�tient.<br/>
    Voici ce que dit la MSDN � propos de la fonction <code>TerminateThread</code> pour
    Windows :
    <q>
        TerminateThread est une fonction dangereuse qui ne devrait �tre utilis�e que dans les cas
        les plus extr�mes.
    </q>
</p>
<p>
    Le seul moyen s�r de terminer un thread actif est de simplement attendre qu'il se finisse de
    lui-m�me. Pour attendre la fin d'un thread, vous pouvez utiliser sa fonction
    <code>Wait()</code> :
</p>
<pre><code class="cpp">Thread.Wait();
</code></pre>
<p>
    Ainsi, pour ordonner � un thread de se terminer, vous pouvez lui envoyer un �v�nement, utiliser
    une variable bool�ene, ou ce que vous voulez. Puis attendre qu'il se termine tout seul.
    Voici un exemple :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;

bool ThreadRunning;

void ThreadFunction(void* UserData)
{
    ThreadRunning = true;
    while (ThreadRunning)
    {
        // Quelque chose...
    }
}

int main()
{
    // Cr�ons un thread avec notre fonction
    sf::Thread Thread(&amp;ThreadFunction);

    // D�marrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper imm�diatement
    ThreadRunning = false;
    Thread.Wait();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    C'est plut�t simple, et beaucoup plus s�r que d'appeler <code>Terminate()</code>.
</p>

<?php h2('Endormir un thread') ?>
<p>
    Qu'il s'agisse du thread principal ou d'un thread que vous avez cr��, il vous est possible
    de le mettre en pause pour une dur�e donn�e gr�ce � la fonction <code>sf::Sleep</code> :
</p>
<pre><code class="cpp">sf::Sleep(0.1f);
</code></pre>
<p>
    Comme toute dur�e manipul�e par la SFML, le param�tre est un flottant d�finissant le temps de pause
    en secondes. Ici ce sera donc une pause de 100 ms.
</p>

<?php h2('Utiliser un mutex') ?>
<p>
    Ok, commen�ons par d�finir ce qu'est un mutex. Un mutex (<em>MUTual EXclusion</em>) est une
    primitive de synchronisation. Ce n'est pas la seule : il existe les s�maphores, les
    sections critiques, les conditions, etc. Mais la plus importante est le mutex. En gros, vous
    l'utilisez pour verrouiller un morceau de code sp�cifique qui ne doit pas �tre interrompu, pour
    emp�cher les autres threads d'y acc�der. Lorsqu'un mutex est verrouill�, tout autre thread tentant de
    le verrouiller � son tour sera mis en attente jusqu'� ce que le thread qui l'a verrouill� le premier le
    d�verrouille. Typiquement, les mutexs sont utilis�s pour contr�ler l'acc�s aux variables
    qui sont partag�es entre plusieurs threads.
</p>
<p>
    Si vous ex�cutez les exemples de code donn�s au d�but de ce tutoriel, vous verrez que le r�sultat
    n'est peut-�tre pas ce � quoi vous vous attendiez : les textes des threads sont compl�tement
    m�lang�s. Ceci est d� au fait que les threads acc�dent � la m�me ressource en m�me temps
    (ici la sortie standard). Pour �viter ceci, on peut utiliser un <?php class_link("Mutex")?> :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

sf::Mutex GlobalMutex; // Ce mutex servira � synchroniser nos threads

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
        // pendant que nous affichons sur la sortie standard
        GlobalMutex.Lock();

        // On affiche quelque chose...
        for (int i = 0; i &lt; 10; ++i)
            std::cout &lt;&lt; "Je suis le thread numero 2" &lt;&lt; std::endl;

        // On d�verrouille le mutex
        GlobalMutex.Unlock();
    }
};

int main()
{
    // Cr�ons une instance de notre classe perso
    MyThread Thread;

    // D�marrons le thread !
    Thread.Launch();

    // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
    // pendant que nous affichons sur la sortie standard
    GlobalMutex.Lock();

    // On affiche quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "Je suis le thread principal" &lt;&lt; std::endl;

    // On d�verrouille le mutex
    GlobalMutex.Unlock();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    Si vous vous demandez pourquoi nous n'utilisons pas de mutex pour acc�der � la variable
    <code>ThreadRunning</code> dans l'exemple plus haut (pour stopper un thread), voici
    les deux raisons :
</p>
<ul>
    <li>Ecrire / lire la valeur d'un bool�en est une op�ration atomique, ce qui signifie qu'elle
    ne peut pas �tre interrompue par un autre thread</li>
    <li>M�me si elle n'�tait pas atomique, cela ne serait pas bien grave puisque la seule cons�quence
    serait d'attendre le prochain tour de boucle pour avoir la bonne valeur du bool�en</li>
</ul>
<p>
    Soyez vigilants lorsque vous utilisez un mutex ou toute autre primitive de synchronisation :
    si vous ne les utilisez pas avec pr�caution, ils peuvent mener � des interblocages
    (<em>deadlocks</em> -- plusieurs threads verrouill�s qui attendent les uns sur les autres
    ind�finiment).
</p>
<p>
    Mais il reste un probl�me : que se passe-t-il si une exception est lev�e alors qu'un mutex est verrouill� ?
    Le thread n'aura aucun moyen de le d�verrouiller, ce qui causera probablement un interblocage et g�lera votre
    programme. Afin de g�rer ce probl�me correctement sans avoir � �crire des tonnes de code suppl�mentaire, la SFML
    fournit une classe <?php class_link("Lock")?>.
</p>
<p>
    Une version plus s�re du code ci-dessus serait donc la suivante :
</p>
<pre><code class="cpp">{
    // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
    // pendant que nous affichons sur la sortie standard
    sf::Lock Lock(GlobalMutex);

    // On affiche quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

}// Le mutex est d�verrouill� automatiquement lorsque l'objet sf::Lock est d�truit
</code></pre>
<p>
    Le mutex est d�verrouill� dans le destructeur de <?php class_link("Lock")?>, qui sera appel� m�me si une exception est lev�e.
</p>

<?php h2('Conclusion') ?>
<p>
    Les threads et les mutexs sont tr�s faciles � utiliser, mais soyez prudents : la programmation
    parall�le peut �tre beaucoup plus difficile qu'elle n'y para�t. Evitez les threads si vous n'en avez
    pas besoin, et essayez de partager aussi peu de variables que possibles entre plusieurs threads.
</p>
<p>
    Vous pouvez maintenant retourner au
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">sommaire des tutoriels</a>,
    ou passer aux
    <a class="internal" href="./window-window-fr.php" title="Passer aux tutoriels du module de fen�trage">tutoriels du module de fen�trage</a>.
</p>

<?php

    require("footer-fr.php");

?>
