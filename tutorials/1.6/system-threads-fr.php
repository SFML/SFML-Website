<?php

    $title = "Utiliser les threads et les mutexs";
    $page = "system-threads-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les threads et les mutexs</h1>

<?php h2('Introduction') ?>
<p>
    Tout d'abord, il faut dire que ce tutoriel, bien qu'étant le premier, n'est pas le plus important.
    En fait vous pouvez très bien commencer à apprendre et à utiliser la SFML sans thread ni mutex.
    Mais en tant que module de base pour tous les autres modules, il est important de savoir quelles
    fonctionnalités il peut offrir.
</p>

<?php h2('Qu\'est-ce qu\'un thread ?') ?>
<p>
    Avant d'entrer dans le vif du sujet, qu'est-ce qu'un thread ? Dans quel cas doit-on les utiliser ?
</p>
<p>
    Basiquement, un thread est un moyen d'exécuter un ensemble d'instructions indépendamment du
    thread principal (tout programme tourne dans un thread : il s'agit de programmes
    <em>monothreaded</em> ; lorsque vous ajoutez un ou plusieurs threads, il s'agit alors de programmes
    <em>multithreaded</em>). Démarrer un thread, c'est un peu comme exécuter un nouveau processus,
    excepté que c'est beaucoup plus léger -- les threads sont aussi appelés processus légers. Tous les
    threads partagent les données de leur processus parent. Ainsi, vous pouvez avoir deux ou plusieurs
    ensembles d'instructions s'exécutant en parallèle au sein de votre programme.<br/>
    Ok, alors quand faut-il utiliser les threads ? En gros, lorsque vous devez exécuter quelque chose
    demandant beaucoup de temps (un calcul complexe, attente d'un évènement, ...) tout en évitant de
    bloquer l'exécution du programme. Par exemple, vous pourriez vouloir afficher une interface graphique
    pendant que vous chargez les ressources de votre jeu (ce qui prend habituellement pas mal de temps),
    ainsi vous pouvez placer le code de chargement dans un thread séparé du reste. Les threads sont
    également largement utilisés dans la programmation réseau, afin d'attendre que des données
    soient réceptionnées tout en continuant l'exécution du programme.
</p>
<p>
    Dans la SFML, les threads sont définis par la classe <?php class_link("Thread")?>. Il existe
    deux façons de l'utiliser, selon vos besoins.
</p>

<?php h2('Utilisation de sf::Thread avec une fonction de rappel (callback)') ?>
<p>
    La première manière d'utiliser <?php class_link("Thread")?> est de lui fournir une fonction
    à exécuter. Lorsque vous démarrez le thread, cette fonction sera appelée en tant que point d'entrée
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
    // Création d'un thread avec notre fonction
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
    Lorsque <code>Thread.Launch()</code> est appelé, l'exécution est séparée en deux
    flots indépendants : pendant que <code>ThreadFunction()</code> s'exécute,
    <code>main()</code> est en train de se terminer. Ainsi le texte des deux threads sera
    affiché en même temps.
</p>
<p>
    Soyez vigilants : ici la fonction <code>main()</code> peut très bien se terminer
    avant la fin de <code>ThreadFunction()</code>, terminant ainsi le programme alors que
    le thread est toujours actif. Cependant ce n'est pas le cas : le destructeur de
    <?php class_link("Thread")?> va attendre que le thread se termine, et ainsi s'assurer que
    le thread ne vivra pas plus longtemps que l'instance de <?php class_link("Thread")?> qui le
    possède.
</p>
<p>
    Si vous avez des données à passer au thread, vous pouvez les passer au constructeur de
    <?php class_link("Thread")?> :
</p>
<pre><code class="cpp">MyClass Object;
sf::Thread Thread(&amp;ThreadFunction, &amp;Object);
</code></pre>
<p>
    Vous pouvez ensuite les récupérer avec le paramètre <code>UserData</code> :
</p>
<pre><code class="cpp">void ThreadFunction(void* UserData)
{
    // Transtypage du paramètre en son type réel
    MyClass* Object = static_cast&lt;MyClass*&gt;(UserData);
}
</code></pre>
<p>
    Attention, assurez-vous que les données que vous passez ne seront pas détruites avant que le thread
    en ait fini avec !
</p>

<?php h2('Utilisation de sf::Thread en tant que classe de base') ?>
<p>
    L'utilisation d'une fonction callback en tant que thread est simple, et peut être utile dans
    certains cas, mais ne se révèle pas très flexible. En effet, que se passe-t-il si vous voulez
    utiliser un thread au sein d'une classe ? Ou si vous voulez partager plus de variables
    entre votre thread et le thread principal ?
</p>
<p>
    Afin de permettre plus de flexibilité, <?php class_link("Thread")?> peut également être utilisée
    en tant que classe de base. Au lieu de lui passer une fonction callback à la construction, vous
    pouvez en dériver et redéfinir la fonction virtuelle <code>Run()</code>.
    Voici le même exemple que ci-dessus, écrit avec une classe dérivée au lieu de la fonction callback :
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
    // Création d'une instance de notre classe perso de thread
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
    Si utiliser un nouveau thread est une fonctionnalité interne qui ne doit pas apparaître dans
    l'interface publique de votre classe, vous pouvez utiliser l'héritage privé :
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
    Ainsi, votre classe n'exposera pas inutilement les fonctions liées à la manipulation de thread
    dans son interface publique.
</p>

<?php h2('Stopper un thread') ?>
<p>
    Comme nous l'avons déjà mentionné, un thread prend fin lorsque la fonction associée se termine.
    Mais comment faire pour terminer un thread à partir d'un autre thread, sans attendre que sa fonction
    prenne fin ?
</p>
<p>
    Il existe deux façons de terminer un thread, mais une seule est réellement sûre. Regardons
    d'abord la manière brutale et non sûre de le faire :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;

void ThreadFunction(void* UserData)
{
    // Quelque chose...
}

int main()
{
    // Créons un thread avec notre fonction
    sf::Thread Thread(&amp;ThreadFunction);

    // Démarrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper immédiatement
    Thread.Terminate();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    En appelant <code>Terminate()</code>, le thread sera immédiatemment stoppé sans
    aucune chance de terminer son exécution proprement. Cela s'avère même pire, car selon votre
    système d'exploitation, le thread peut même ne pas libérer les ressources qu'il détient.<br/>
    Voici ce que dit la MSDN à propos de la fonction <code>TerminateThread</code> pour
    Windows :
    <q>
        TerminateThread est une fonction dangereuse qui ne devrait être utilisée que dans les cas
        les plus extrêmes.
    </q>
</p>
<p>
    Le seul moyen sûr de terminer un thread actif est de simplement attendre qu'il se finisse de
    lui-même. Pour attendre la fin d'un thread, vous pouvez utiliser sa fonction
    <code>Wait()</code> :
</p>
<pre><code class="cpp">Thread.Wait();
</code></pre>
<p>
    Ainsi, pour ordonner à un thread de se terminer, vous pouvez lui envoyer un évènement, utiliser
    une variable booléene, ou ce que vous voulez. Puis attendre qu'il se termine tout seul.
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
    // Créons un thread avec notre fonction
    sf::Thread Thread(&amp;ThreadFunction);

    // Démarrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper immédiatement
    ThreadRunning = false;
    Thread.Wait();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    C'est plutôt simple, et beaucoup plus sûr que d'appeler <code>Terminate()</code>.
</p>

<?php h2('Endormir un thread') ?>
<p>
    Qu'il s'agisse du thread principal ou d'un thread que vous avez créé, il vous est possible
    de le mettre en pause pour une durée donnée grâce à la fonction <code>sf::Sleep</code> :
</p>
<pre><code class="cpp">sf::Sleep(0.1f);
</code></pre>
<p>
    Comme toute durée manipulée par la SFML, le paramètre est un flottant définissant le temps de pause
    en secondes. Ici ce sera donc une pause de 100 ms.
</p>

<?php h2('Utiliser un mutex') ?>
<p>
    Ok, commençons par définir ce qu'est un mutex. Un mutex (<em>MUTual EXclusion</em>) est une
    primitive de synchronisation. Ce n'est pas la seule : il existe les sémaphores, les
    sections critiques, les conditions, etc. Mais la plus importante est le mutex. En gros, vous
    l'utilisez pour verrouiller un morceau de code spécifique qui ne doit pas être interrompu, pour
    empêcher les autres threads d'y accéder. Lorsqu'un mutex est verrouillé, tout autre thread tentant de
    le verrouiller à son tour sera mis en attente jusqu'à ce que le thread qui l'a verrouillé le premier le
    déverrouille. Typiquement, les mutexs sont utilisés pour contrôler l'accès aux variables
    qui sont partagées entre plusieurs threads.
</p>
<p>
    Si vous exécutez les exemples de code donnés au début de ce tutoriel, vous verrez que le résultat
    n'est peut-être pas ce à quoi vous vous attendiez : les textes des threads sont complétement
    mélangés. Ceci est dû au fait que les threads accèdent à la même ressource en même temps
    (ici la sortie standard). Pour éviter ceci, on peut utiliser un <?php class_link("Mutex")?> :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

sf::Mutex GlobalMutex; // Ce mutex servira à synchroniser nos threads

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

        // On déverrouille le mutex
        GlobalMutex.Unlock();
    }
};

int main()
{
    // Créons une instance de notre classe perso
    MyThread Thread;

    // Démarrons le thread !
    Thread.Launch();

    // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
    // pendant que nous affichons sur la sortie standard
    GlobalMutex.Lock();

    // On affiche quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "Je suis le thread principal" &lt;&lt; std::endl;

    // On déverrouille le mutex
    GlobalMutex.Unlock();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    Si vous vous demandez pourquoi nous n'utilisons pas de mutex pour accéder à la variable
    <code>ThreadRunning</code> dans l'exemple plus haut (pour stopper un thread), voici
    les deux raisons :
</p>
<ul>
    <li>Ecrire / lire la valeur d'un booléen est une opération atomique, ce qui signifie qu'elle
    ne peut pas être interrompue par un autre thread</li>
    <li>Même si elle n'était pas atomique, cela ne serait pas bien grave puisque la seule conséquence
    serait d'attendre le prochain tour de boucle pour avoir la bonne valeur du booléen</li>
</ul>
<p>
    Soyez vigilants lorsque vous utilisez un mutex ou toute autre primitive de synchronisation :
    si vous ne les utilisez pas avec précaution, ils peuvent mener à des interblocages
    (<em>deadlocks</em> -- plusieurs threads verrouillés qui attendent les uns sur les autres
    indéfiniment).
</p>
<p>
    Mais il reste un problème : que se passe-t-il si une exception est levée alors qu'un mutex est verrouillé ?
    Le thread n'aura aucun moyen de le déverrouiller, ce qui causera probablement un interblocage et gèlera votre
    programme. Afin de gérer ce problème correctement sans avoir à écrire des tonnes de code supplémentaire, la SFML
    fournit une classe <?php class_link("Lock")?>.
</p>
<p>
    Une version plus sûre du code ci-dessus serait donc la suivante :
</p>
<pre><code class="cpp">{
    // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
    // pendant que nous affichons sur la sortie standard
    sf::Lock Lock(GlobalMutex);

    // On affiche quelque chose...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

}// Le mutex est déverrouillé automatiquement lorsque l'objet sf::Lock est détruit
</code></pre>
<p>
    Le mutex est déverrouillé dans le destructeur de <?php class_link("Lock")?>, qui sera appelé même si une exception est levée.
</p>

<?php h2('Conclusion') ?>
<p>
    Les threads et les mutexs sont très faciles à utiliser, mais soyez prudents : la programmation
    parallèle peut être beaucoup plus difficile qu'elle n'y paraît. Evitez les threads si vous n'en avez
    pas besoin, et essayez de partager aussi peu de variables que possibles entre plusieurs threads.
</p>
<p>
    Vous pouvez maintenant retourner au
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">sommaire des tutoriels</a>,
    ou passer aux
    <a class="internal" href="./window-window-fr.php" title="Passer aux tutoriels du module de fenêtrage">tutoriels du module de fenêtrage</a>.
</p>

<?php

    require("footer-fr.php");

?>
