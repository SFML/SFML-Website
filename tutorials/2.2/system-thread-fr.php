<?php

    $title = "Les threads";
    $page = "system-thread-fr.php";

    require("header-fr.php");

?>

<h1>Les threads</h1>

<?php h2('Qu\'est-ce qu\'un thread ?') ?>
<p>
    La plupart d'entre vous savent d�j� ce qu'est un thread, mais voici toutefois une petite explication pour ceux qui abordent ce concept pour la
    toute premi�re fois.
</p>
<p>
    Un thread (que l'on pourrait traduire par "fil d'ex�cution") est, en gros, une s�quence d'instructions qui s'ex�cutent parall�lement aux autres threads.
    Chaque programme est constitu� d'au moins un thread : le thread principal, qui fait tourner votre fonction <code>main()</code>. Les programmes
    qui utilisent uniquement le thread principal sont <em>monothread�s</em>, si vous leur ajoutez un ou plusieurs threads alors ils deviennent
    <em>multithread�s</em>.
</p>
<p>
    Donc, pour r�sumer, les threads offrent un moyen de faire plusieurs choses en m�me temps. Cela peut �tre utile, par exemple, pour afficher une
    animation et r�agir aux actions de l'utilisateur pendant le chargement d'images ou de sons. Les threads sont aussi tr�s utilis�s en programmation
    r�seau, afin d'attendre que des donn�es soient re�ues tout en continuant � mettre � jour et afficher l'application.
</p>

<?php h2('Threads SFML ou std::thread ?') ?>
<p>
    Dans sa nouvelle version (2011), la biblioth�que standard du C++ fournit un ensemble de
    <a class="external" href="http://en.cppreference.com/w/cpp/thread" title="classes de threads C++11">classes pour les threads</a>. Au moment o� SFML a �t� �crite,
    le standard C++11 �tait loin de sortir et il n'y avait donc aucun moyen de cr�er des threads. Lorsque SFML 2.0 est sortie, la plupart des compilateurs
    ne supportaient toujours pas ce nouveau standard.
</p>
<p>
    Si vous travaillez avec des compilateurs qui supportent le nouveau standard et son en-t�te <code>&lt;thread&gt;</code>, vous pouvez l'utiliser et
    oublier les classes SFML -- ce sera bien mieux. Mais si vous travaillez avec un compilateur pre-2011, ou avez l'intention de distribuer votre
    code et voulez que celui-ci soit totalement portable, alors les classes de thread de SFML sont une bonne solution.
</p>

<?php h2('Cr�er un thread avec SFML') ?>
<p>
    Assez de blabla, voyons un peu de code. La classe qui permet de cr�er des threads avec SFML est <?php class_link("Thread") ?>, et voici � quoi elle
    ressemble en action :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

void func()
{
    // cette fonction d�marre lorsque thread.launch() est appel�

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm thread number one" &lt;&lt; std::endl;
}

int main()
{
    // cr�e un thread avec la fonction func() comme point d'entr�e
    sf::Thread thread(&amp;func);

    // ex�cute le thread
    thread.launch();

    // le thread principal continue � tourner...

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    return 0;
}
</code></pre>
<p>
    Dans ce code, <code>main</code> et <code>func</code> tournent toutes deux en parall�le, apr�s que <code>thread.launch()</code> a �t� appel�.
    Le r�sultat est que le texte des deux fonctions appara�t normalement m�lang� dans la console.
</p>
<img class="screenshot" src="./images/system-thread-mixed.png" alt="Capture d'�cran de la sortie du programme" title="Capture d'�cran de la sortie du programme" />
<p>
    Le point d'entr�e du thread, c'est-�-dire la fonction qui est appel�e dans le thread, doit �tre pass�e au constructeur de <?php class_link("Thread") ?>.
    <?php class_link("Thread") ?> essaye d'�tre flexible et d'accepter un large choix de types de points d'entr�e : functions membres ou non-membres,
    avec ou sans param�tres, foncteurs, etc. L'example ci-dessus illustre l'utilisation d'une fonction non-membre, voici quelques autres exemples.
</p>
<p>
    - Fonctions non-membre avec un param�tre :
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
    <?php class_link("Thread") ?> compatible avec beaucoup de types de fonctions qui ne sont pas directement support�es. Cette fonctionnalit� est
    particuli�rement int�ressante combin�e aux lambdas ou <code>std::bind</code>, pr�sents dans la nouvelle mouture 2011 du C++.
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
    Si vous voulez utiliser un <?php class_link("Thread") ?> dans une classe, n'oubliez pas qu'il n'a pas de constructeur par d�faut. Ainsi, vous devrez
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
    Si vous avez vraiment besoin de construire votre instance de <?php class_link("Thread") ?> <em>apr�s</em> la construction de l'objet parent, vous
    pouvez �galement retarder sa construction en l'allouant dynamiquement avec <code>new</code>.
</p>

<?php h2('D�marrer les threads') ?>
<p>
    Une fois que vous avez cr�� un <?php class_link("Thread") ?>, vous devez le d�marrer avec sa fonction <code>launch</code>.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);
thread.launch();
</code></pre>
<p>
    <code>launch</code> appelle dans un nouveau thread la fonction qui a �t� pass�e au constructeur, et rend la main imm�diatement de fa�on � ce que
    le thread appelant puisse continuer � tourner en parall�le.
</p>

<?php h2('Arr�ter les threads') ?>
<p>
    Un thread s'arr�te tout seul lorsque sa fonction se termine. Si vous voulez attendre qu'un thread se termine depuis un autre thread, vous
    pouvez appeler sa fonction <code>wait</code>.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);

// d�marre le thread
thread.launch();

...

// bloque l'ex�cution jusqu'� ce que le thread soit termin�
thread.wait();
</code></pre>
<p>
    La fonction <code>wait</code> est �galement implicitement appel�e par le destructeur de <?php class_link("Thread") ?>, de fa�on � ce qu'un thread
    ne puisse pas continuer � tourner (et �tre hors de contr�le) apr�s que l'instance de <?php class_link("Thread") ?> qui l'a cr�� ait �t� d�truite.
    Gardez bien cela en t�te lorsque vous g�rez vos threads (cf. la derni�re partie de ce tutoriel).
</p>

<?php h2('Mettre en pause les threads') ?>
<p>
    Il n'existe aucune fonction dans <?php class_link("Thread") ?> qui permette de mettre en pause un thread depuis un autre, la seule fa�on est de le faire
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
    <code>sf::sleep</code> prend un param�tre, qui est la dur�e de la pause. Cette dur�e peut �tre donn�e avec n'importe quelle unit�/pr�cision, comme
    expliqu� dans le <a class="internal" title="Tutorial sur le temps" href="./system-time-fr.php">tutoriel sur le temps</a>.<br />
    Notez que vous pouvez mettre en pause n'importe quel thread, m�me le thread principal.
</p>
<p>
    <code>sf::sleep</code> est la fa�on la plus efficace d'attendre dans un thread : tant que le thread "dort", il n'utilise pas le processeur.
    Les pauses bas�es sur de l'attente active, comme des boucles <code>while</code> vides, utiliseraient 100% du processeur juste pour... ne rien faire.
    Cependant, gardez en t�te que la dur�e d'attente est juste une indication, selon l'OS cela donnera un r�sultat plus ou moins pr�cis. Ne comptez donc
    pas sur cette fonction pour produire des timings hyper pr�cis.
</p>

<?php h2('Prot�ger les donn�es partag�es') ?>
<p>
    Tous les threads d'un programme partagent la m�me m�moire, ils peuvent acc�der � toutes les variables du programme. C'est tr�s pratique mais aussi
    dangereux : puisque tous les threads tournent en parall�le, cela signifie qu'une variable ou une fonction pourrait tr�s bien �tre utilis�e depuis
    plusieurs threads en m�me temps. Et si l'op�ration en question n'est pas <em>thread-safe</em>, le r�sultat sera ind�termin� (c'est-�-dire que
    cela pourrait planter ou corrompre des donn�es).
</p>
<p>
    Il existe plusieurs outils de programmation pour vous aider � prot�ger les variables partag�es et rendre votre code thread-safe, ils sont
    appel�s "primitives de synchronisation". Les plus communs sont les mutexs, les s�maphores, les conditions d'attente et les <em>spin locks</em>.
    Ils sont tous des variations du m�me concept : ils prot�gent  un morceau de code en autorisant leur acc�s uniquement � certains threads, tout
    en bloquant les autres.
<p>
    La primitive de synchronisation la plus basique (et la plus utilis�e) est le mutex. Mutex signifie "EXclusion MUTuelle" : il autorise un seul thread
    � la fois � acc�der aux morceaux de code qu'il entoure. Voyons voir comment un mutex pourrait remettre un peu d'ordre dans le premier exemple
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
    Ce code utilise une ressource partag�e (<code>std::cout</code>), et comme nous l'avons vu cela produit un r�sultat que nous souhaiterions �viter --
    tout est m�lang� dans la console. Pour nous assurer que les blocs de texte des deux threads sont correctement affich�es au lieu d'�tre m�lang�es
    al�atoirement, nous prot�geons les morceaux de code correspondant avec un mutex.
</p>
<p>
    Le premier thread � atteindre sa ligne <code>mutex.lock()</code> verrouille le mutex, acc�de directement au code qui suit et affiche son
    texte. Lorsque l'autre thread atteint sa ligne <code>mutex.lock()</code>, le mutex est d�j� verrouill� et le thread est donc mis en attente
    (de la m�me mani�re qu'avec un appel � <code>sf::sleep</code>, le thread qui dort n'utilise pas du tout le processeur). Lorsque le premier thread
    d�verrouille enfin le mutex, le second thread est r�veill� et est autoris� � son tour � verrouiller le mutex et � afficher ses lignes de texte.
    Les blocs de texte apparaissent donc s�quentiellement dans la console, plut�t que m�lang�s.
</p>
<img class="screenshot" src="./images/system-thread-ordered.png" alt="Capture d'�cran de la sortie du programme" title="Capture d'�cran de la sortie du programme" />
<p>
    Le mutex n'est pas la seule primitive que vous pouvez utiliser pour prot�ger vos variables partag�es, mais devrait �tre suffisant pour la plupart
    des cas. Cependant, si votre application fait des choses complexes avec les threads, et si vous avez le sentiment que ce n'est pas assez, n'h�sitez pas
    � regarder du c�t� des biblioth�ques d�di�es aux threads, offrant plus de fonctionnalit�s.
</p>

<?php h2('Prot�ger les mutexs') ?>
<p>
    Pas de panique : les mutexs sont d�j� thread-safe, il n'y a pas besoin de les prot�ger. Mais ils ne sont pas exception-safe ! Que se passe-t-il si
    une exception est lanc�e pendant qu'un mutex est verrouill� ? Il ne peut pas atteindre la ligne qui le d�verrouille, et reste verrouill� pour toujours.
    Et tous les threads qui essayeront ensuite de le verrouiller seront bloqu�s pour toujours � leur tour ; votre application toute enti�re pourrait
    se retrouver bloqu�e. Pas cool.
</p>
<p>
    Pour s'assurer que les mutexs sont toujours d�verrouill�s dans un environnement o� des exceptions peuvent �tre lanc�es, SFML fournit une classe
    RAII pour les encapsuler : <?php class_link("Lock") ?>. Elle verrouille le mutex dans son constructeur, et le d�verrouille dans son destructeur.
    Simple et efficace.
</p>
<pre><code class="cpp">sf::Mutex mutex;

void func()
{
    sf::Lock lock(mutex); // mutex.lock()

    functionThatMightThrowAnException(); // mutex.unlock() si cette fonction lance une exception

} // mutex.unlock()</code></pre>
<p>
    Notez que <?php class_link("Lock") ?> peut aussi se r�v�ler utile dans une fonction qui a plusieurs instructions <code>return</code>.
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
    Les gens qui �crivent ce genre de code s'attendent � ce que la fonction <code>startThread()</code> d�marre un thread qui va faire sa vie dans son
    coin et sera d�truit lorsque sa fonction se termine. Mais ce n'est pas ce qui se passe en r�alit� : la fonction thread�e semble bloquer le thread
    principal, comme si les threads ne fonctionnaient pas.
</p>
<p>
    La raison ? L'instance de <?php class_link("Thread") ?> est locale � la fonction <code>startThread()</code> et est donc imm�diatement d�truite, quand
    la fonction se termine. Le destructeur de <?php class_link("Thread") ?> est appel� automatiquement, et celui-ci appelle � son tour <code>wait()</code>
    comme nous l'avons vu pr�c�demment, et le r�sultat est que le thread principal bloque et attend que la fonction thread�e se termine au lieu de
    continuer � tourner en parall�le.
</p>
<p>
    Donc n'oubliez jamais ceci : vous devez g�rer vos instances de <?php class_link("Thread") ?> de mani�re � ce qu'elles vivent aussi longtemps que
    le thread et sa fonction tournent.
</p>

<?php

    require("footer-fr.php");

?>
