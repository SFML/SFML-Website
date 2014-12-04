<?php

    $title = "Les threads";
    $page = "system-thread-fr.php";

    require("header-fr.php");

?>

<h1>Les threads</h1>

<?php h2('Qu\'est-ce qu\'un thread ?') ?>
<p>
    La plupart d'entre vous savent déjà ce qu'est un thread, mais voici toutefois une petite explication pour ceux qui abordent ce concept pour la
    toute première fois.
</p>
<p>
    Un thread (que l'on pourrait traduire par "fil d'exécution") est, en gros, une séquence d'instructions qui s'exécutent parallèlement aux autres threads.
    Chaque programme est constitué d'au moins un thread : le thread principal, qui fait tourner votre fonction <code>main()</code>. Les programmes
    qui utilisent uniquement le thread principal sont <em>monothreadés</em>, si vous leur ajoutez un ou plusieurs threads alors ils deviennent
    <em>multithreadés</em>.
</p>
<p>
    Donc, pour résumer, les threads offrent un moyen de faire plusieurs choses en même temps. Cela peut être utile, par exemple, pour afficher une
    animation et réagir aux actions de l'utilisateur pendant le chargement d'images ou de sons. Les threads sont aussi très utilisés en programmation
    réseau, afin d'attendre que des données soient reçues tout en continuant à mettre à jour et afficher l'application.
</p>

<?php h2('Threads SFML ou std::thread ?') ?>
<p>
    Dans sa nouvelle version (2011), la bibliothèque standard du C++ fournit un ensemble de
    <a class="external" href="http://en.cppreference.com/w/cpp/thread" title="classes de threads C++11">classes pour les threads</a>. Au moment où SFML a été écrite,
    le standard C++11 était loin de sortir et il n'y avait donc aucun moyen de créer des threads. Lorsque SFML 2.0 est sortie, la plupart des compilateurs
    ne supportaient toujours pas ce nouveau standard.
</p>
<p>
    Si vous travaillez avec des compilateurs qui supportent le nouveau standard et son en-tête <code>&lt;thread&gt;</code>, vous pouvez l'utiliser et
    oublier les classes SFML -- ce sera bien mieux. Mais si vous travaillez avec un compilateur pre-2011, ou avez l'intention de distribuer votre
    code et voulez que celui-ci soit totalement portable, alors les classes de thread de SFML sont une bonne solution.
</p>

<?php h2('Créer un thread avec SFML') ?>
<p>
    Assez de blabla, voyons un peu de code. La classe qui permet de créer des threads avec SFML est <?php class_link("Thread") ?>, et voici à quoi elle
    ressemble en action :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

void func()
{
    // cette fonction démarre lorsque thread.launch() est appelé

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm thread number one" &lt;&lt; std::endl;
}

int main()
{
    // crée un thread avec la fonction func() comme point d'entrée
    sf::Thread thread(&amp;func);

    // exécute le thread
    thread.launch();

    // le thread principal continue à tourner...

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    return 0;
}
</code></pre>
<p>
    Dans ce code, <code>main</code> et <code>func</code> tournent toutes deux en parallèle, après que <code>thread.launch()</code> a été appelé.
    Le résultat est que le texte des deux fonctions apparaît normalement mélangé dans la console.
</p>
<img class="screenshot" src="./images/system-thread-mixed.png" alt="Capture d'écran de la sortie du programme" title="Capture d'écran de la sortie du programme" />
<p>
    Le point d'entrée du thread, c'est-à-dire la fonction qui est appelée dans le thread, doit être passée au constructeur de <?php class_link("Thread") ?>.
    <?php class_link("Thread") ?> essaye d'être flexible et d'accepter un large choix de types de points d'entrée : functions membres ou non-membres,
    avec ou sans paramètres, foncteurs, etc. L'example ci-dessus illustre l'utilisation d'une fonction non-membre, voici quelques autres exemples.
</p>
<p>
    - Fonctions non-membre avec un paramètre :
</p>
<pre><code class="cpp">void func(int x)
{
}

sf::Thread thread(&amp;func, 5);
</code></pre>
<p>
    - Fonction membre :
</p>
<pre><code class="cpp">class MyClass
{
public:

    void func()
    {
    }
};

MyClass object;
sf::Thread thread(&amp;MyClass::func, &amp;object);
</code></pre>
<p>
    - Foncteur (objet-fonction) :
</p>
<pre><code class="cpp">struct MyFunctor
{
    void operator()()
    {
    }
};

sf::Thread thread(MyFunctor());
</code></pre>
<p>
    Le dernier exemple, qui utilise les foncteurs, est le plus puissant car il peut accepter n'importe quel type de foncteur et rend ainsi
    <?php class_link("Thread") ?> compatible avec beaucoup de types de fonctions qui ne sont pas directement supportées. Cette fonctionnalité est
    particulièrement intéressante combinée aux lambdas ou <code>std::bind</code>, présents dans la nouvelle mouture 2011 du C++.
</p>
<pre><code class="cpp">// avec les lambdas
sf::Thread thread([](){
    std::cout &lt;&lt; "I am in thread!" &lt;&lt; std::endl;
});
</code></pre>

<pre><code class="cpp">// avec std::bind
void func(std::string, int, double)
{
}

sf::Thread thread(std::bind(&amp;func, "hello", 24, 0.5));
</code></pre>
<p>
    Si vous voulez utiliser un <?php class_link("Thread") ?> dans une classe, n'oubliez pas qu'il n'a pas de constructeur par défaut. Ainsi, vous devrez
    l'initialiser directement dans la <em>liste d'initialisation</em> du constructeur de la classe parent :
</p>
<pre><code class="cpp">class ClassWithThread
{
public:

    ClassWithThread()
    : m_thread(&amp;ClassWithThread::f, this)
    {
    }

private:

    void f()
    {
        ...
    }

    sf::Thread m_thread;
};
</code></pre>
<p>
    Si vous avez vraiment besoin de construire votre instance de <?php class_link("Thread") ?> <em>après</em> la construction de l'objet parent, vous
    pouvez également retarder sa construction en l'allouant dynamiquement avec <code>new</code>.
</p>

<?php h2('Démarrer les threads') ?>
<p>
    Une fois que vous avez créé un <?php class_link("Thread") ?>, vous devez le démarrer avec sa fonction <code>launch</code>.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);
thread.launch();
</code></pre>
<p>
    <code>launch</code> appelle dans un nouveau thread la fonction qui a été passée au constructeur, et rend la main immédiatement de façon à ce que
    le thread appelant puisse continuer à tourner en parallèle.
</p>

<?php h2('Arrêter les threads') ?>
<p>
    Un thread s'arrête tout seul lorsque sa fonction se termine. Si vous voulez attendre qu'un thread se termine depuis un autre thread, vous
    pouvez appeler sa fonction <code>wait</code>.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);

// démarre le thread
thread.launch();

...

// bloque l'exécution jusqu'à ce que le thread soit terminé
thread.wait();
</code></pre>
<p>
    La fonction <code>wait</code> est également implicitement appelée par le destructeur de <?php class_link("Thread") ?>, de façon à ce qu'un thread
    ne puisse pas continuer à tourner (et être hors de contrôle) après que l'instance de <?php class_link("Thread") ?> qui l'a créé ait été détruite.
    Gardez bien cela en tête lorsque vous gérez vos threads (cf. la dernière partie de ce tutoriel).
</p>

<?php h2('Mettre en pause les threads') ?>
<p>
    Il n'existe aucune fonction dans <?php class_link("Thread") ?> qui permette de mettre en pause un thread depuis un autre, la seule façon est de le faire
    directement depuis le code qui tourne dans le thread. En d'autres termes, on ne peut mettre en pause que le thread courant. Pour ce faire,
    vous pouvez appeler la fonction <code>sf::sleep</code> :
</p>
<pre><code class="cpp">void func()
{
    ...
    sf::sleep(sf::milliseconds(10));
    ...
}</code></pre>
<p>
    <code>sf::sleep</code> prend un paramètre, qui est la durée de la pause. Cette durée peut être donnée avec n'importe quelle unité/précision, comme
    expliqué dans le <a class="internal" title="Tutorial sur le temps" href="./system-time-fr.php">tutoriel sur le temps</a>.<br />
    Notez que vous pouvez mettre en pause n'importe quel thread, même le thread principal.
</p>
<p>
    <code>sf::sleep</code> est la façon la plus efficace d'attendre dans un thread : tant que le thread "dort", il n'utilise pas le processeur.
    Les pauses basées sur de l'attente active, comme des boucles <code>while</code> vides, utiliseraient 100% du processeur juste pour... ne rien faire.
    Cependant, gardez en tête que la durée d'attente est juste une indication, selon l'OS cela donnera un résultat plus ou moins précis. Ne comptez donc
    pas sur cette fonction pour produire des timings hyper précis.
</p>

<?php h2('Protéger les données partagées') ?>
<p>
    Tous les threads d'un programme partagent la même mémoire, ils peuvent accéder à toutes les variables du programme. C'est très pratique mais aussi
    dangereux : puisque tous les threads tournent en parallèle, cela signifie qu'une variable ou une fonction pourrait très bien être utilisée depuis
    plusieurs threads en même temps. Et si l'opération en question n'est pas <em>thread-safe</em>, le résultat sera indéterminé (c'est-à-dire que
    cela pourrait planter ou corrompre des données).
</p>
<p>
    Il existe plusieurs outils de programmation pour vous aider à protéger les variables partagées et rendre votre code thread-safe, ils sont
    appelés "primitives de synchronisation". Les plus communs sont les mutexs, les sémaphores, les conditions d'attente et les <em>spin locks</em>.
    Ils sont tous des variations du même concept : ils protègent  un morceau de code en autorisant leur accès uniquement à certains threads, tout
    en bloquant les autres.
<p>
    La primitive de synchronisation la plus basique (et la plus utilisée) est le mutex. Mutex signifie "EXclusion MUTuelle" : il autorise un seul thread
    à la fois à accéder aux morceaux de code qu'il entoure. Voyons voir comment un mutex pourrait remettre un peu d'ordre dans le premier exemple
    que nous avons vu :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

sf::Mutex mutex;

void func()
{
    mutex.lock();

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm thread number one" &lt;&lt; std::endl;

    mutex.unlock();
}

int main()
{
    sf::Thread thread(&amp;func);
    thread.launch();

    mutex.lock();

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    mutex.unlock();

    return 0;
}
</code></pre>
<p>
    Ce code utilise une ressource partagée (<code>std::cout</code>), et comme nous l'avons vu cela produit un résultat que nous souhaiterions éviter --
    tout est mélangé dans la console. Pour nous assurer que les blocs de texte des deux threads sont correctement affichées au lieu d'être mélangées
    aléatoirement, nous protégeons les morceaux de code correspondant avec un mutex.
</p>
<p>
    Le premier thread à atteindre sa ligne <code>mutex.lock()</code> verrouille le mutex, accède directement au code qui suit et affiche son
    texte. Lorsque l'autre thread atteint sa ligne <code>mutex.lock()</code>, le mutex est déjà verrouillé et le thread est donc mis en attente
    (de la même manière qu'avec un appel à <code>sf::sleep</code>, le thread qui dort n'utilise pas du tout le processeur). Lorsque le premier thread
    déverrouille enfin le mutex, le second thread est réveillé et est autorisé à son tour à verrouiller le mutex et à afficher ses lignes de texte.
    Les blocs de texte apparaissent donc séquentiellement dans la console, plutôt que mélangés.
</p>
<img class="screenshot" src="./images/system-thread-ordered.png" alt="Capture d'écran de la sortie du programme" title="Capture d'écran de la sortie du programme" />
<p>
    Le mutex n'est pas la seule primitive que vous pouvez utiliser pour protéger vos variables partagées, mais devrait être suffisant pour la plupart
    des cas. Cependant, si votre application fait des choses complexes avec les threads, et si vous avez le sentiment que ce n'est pas assez, n'hésitez pas
    à regarder du côté des bibliothèques dédiées aux threads, offrant plus de fonctionnalités.
</p>

<?php h2('Protéger les mutexs') ?>
<p>
    Pas de panique : les mutexs sont déjà thread-safe, il n'y a pas besoin de les protéger. Mais ils ne sont pas exception-safe ! Que se passe-t-il si
    une exception est lancée pendant qu'un mutex est verrouillé ? Il ne peut pas atteindre la ligne qui le déverrouille, et reste verrouillé pour toujours.
    Et tous les threads qui essayeront ensuite de le verrouiller seront bloqués pour toujours à leur tour ; votre application toute entière pourrait
    se retrouver bloquée. Pas cool.
</p>
<p>
    Pour s'assurer que les mutexs sont toujours déverrouillés dans un environnement où des exceptions peuvent être lancées, SFML fournit une classe
    RAII pour les encapsuler : <?php class_link("Lock") ?>. Elle verrouille le mutex dans son constructeur, et le déverrouille dans son destructeur.
    Simple et efficace.
</p>
<pre><code class="cpp">sf::Mutex mutex;

void func()
{
    sf::Lock lock(mutex); // mutex.lock()

    functionThatMightThrowAnException(); // mutex.unlock() si cette fonction lance une exception

} // mutex.unlock()</code></pre>
<p>
    Notez que <?php class_link("Lock") ?> peut aussi se révéler utile dans une fonction qui a plusieurs instructions <code>return</code>.
</p>
<pre><code class="cpp">sf::Mutex mutex;

bool func()
{
    sf::Lock lock(mutex); // mutex.lock()

    if (!image1.loadFromFile("..."))
        return false; // mutex.unlock()

    if (!image2.loadFromFile("..."))
        return false; // mutex.unlock()

    if (!image3.loadFromFile("..."))
        return false; // mutex.unlock()

    return true;
} // mutex.unlock()</code></pre>

<?php h2('Erreurs classiques') ?>
<p>
    Il y a une chose que les programmeurs oublient souvent : un thread ne peut pas vivre sans son instance de <?php class_link("Thread") ?>. <br />
    On voit souvent ce genre de code sur les forums :
</p>
<pre><code class="cpp">void startThread()
{
    sf::Thread thread(&amp;funcToRunInThread);
    thread.launch();
}

int main()
{
    startThread();
    // ...
    return 0;
}
</code></pre>
<p>
    Les gens qui écrivent ce genre de code s'attendent à ce que la fonction <code>startThread()</code> démarre un thread qui va faire sa vie dans son
    coin et sera détruit lorsque sa fonction se termine. Mais ce n'est pas ce qui se passe en réalité : la fonction threadée semble bloquer le thread
    principal, comme si les threads ne fonctionnaient pas.
</p>
<p>
    La raison ? L'instance de <?php class_link("Thread") ?> est locale à la fonction <code>startThread()</code> et est donc immédiatement détruite, quand
    la fonction se termine. Le destructeur de <?php class_link("Thread") ?> est appelé automatiquement, et celui-ci appelle à son tour <code>wait()</code>
    comme nous l'avons vu précédemment, et le résultat est que le thread principal bloque et attend que la fonction threadée se termine au lieu de
    continuer à tourner en parallèle.
</p>
<p>
    Donc n'oubliez jamais ceci : vous devez gérer vos instances de <?php class_link("Thread") ?> de manière à ce qu'elles vivent aussi longtemps que
    le thread et sa fonction tournent.
</p>

<?php

    require("footer-fr.php");

?>
