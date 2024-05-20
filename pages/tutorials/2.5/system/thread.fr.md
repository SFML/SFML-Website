# Les threads

## [Qu'est-ce qu'un thread ?](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#quest-ce-quun-thread)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

La plupart d'entre vous savent déjà ce qu'est un thread, mais voici toutefois une petite explication pour ceux qui abordent ce concept pour la toute première fois.

Un thread (que l'on pourrait traduire par "fil d'exécution") est, en gros, une séquence d'instructions qui s'exécutent parallèlement aux autres threads. Chaque programme est constitué d'au moins un thread : le thread principal, qui fait tourner votre fonction `main()`. Les programmes qui utilisent uniquement le thread principal sont _monothreadés_, si vous leur ajoutez un ou plusieurs threads alors ils deviennent _multithreadés_.

Donc, pour résumer, les threads offrent un moyen de faire plusieurs choses en même temps. Cela peut être utile, par exemple, pour afficher une animation et réagir aux actions de l'utilisateur pendant le chargement d'images ou de sons. Les threads sont aussi très utilisés en programmation réseau, afin d'attendre que des données soient reçues tout en continuant à mettre à jour et afficher l'application.

## [Threads SFML ou std::thread ?](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#threads-sfml-ou-stdthread)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Dans sa nouvelle version (2011), la bibliothèque standard du C++ fournit un ensemble de [classes pour les threads](http://en.cppreference.com/w/cpp/thread "classes de threads C++11"). Au moment où SFML a été écrite, le standard C++11 était loin de sortir et il n'y avait donc aucun moyen de créer des threads. Lorsque SFML 2.0 est sortie, la plupart des compilateurs ne supportaient toujours pas ce nouveau standard.

Si vous travaillez avec des compilateurs qui supportent le nouveau standard et son en-tête `<thread>`, vous pouvez l'utiliser et oublier les classes SFML -- ce sera bien mieux. Mais si vous travaillez avec un compilateur pre-2011, ou avez l'intention de distribuer votre code et voulez que celui-ci soit totalement portable, alors les classes de thread de SFML sont une bonne solution.

## [Créer un thread avec SFML](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#crceer-un-thread-avec-sfml)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Assez de blabla, voyons un peu de code. La classe qui permet de créer des threads avec SFML est [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation"), et voici à quoi elle ressemble en action :

```
#include <SFML/System.hpp>
#include <iostream>

void func()
{
    // cette fonction démarre lorsque thread.launch() est appelé

    for (int i = 0; i < 10; ++i)
        std::cout << "I'm thread number one" << std::endl;
}

int main()
{
    // crée un thread avec la fonction func() comme point d'entrée
    sf::Thread thread(&func);

    // exécute le thread
    thread.launch();

    // le thread principal continue à tourner...

    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

    return 0;
}
```

Dans ce code, `main` et `func` tournent toutes deux en parallèle, après que `thread.launch()` a été appelé. Le résultat est que le texte des deux fonctions apparaît normalement mélangé dans la console.

![Capture d'écran de la sortie du programme](https://www.sfml-dev.org/tutorials/2.6/images/system-thread-mixed.png "Capture d'écran de la sortie du programme")

Le point d'entrée du thread, c'est-à-dire la fonction qui est appelée dans le thread, doit être passée au constructeur de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation"). [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") essaye d'être flexible et d'accepter un large choix de types de points d'entrée : functions membres ou non-membres, avec ou sans paramètres, foncteurs, etc. L'example ci-dessus illustre l'utilisation d'une fonction non-membre, voici quelques autres exemples.

- Fonctions non-membre avec un paramètre :

```
void func(int x)
{
}

sf::Thread thread(&func, 5);
```

- Fonction membre :

```
class MyClass
{
public:

    void func()
    {
    }
};

MyClass object;
sf::Thread thread(&MyClass::func, &object);
```

- Foncteur (objet-fonction) :

```
struct MyFunctor
{
    void operator()()
    {
    }
};

sf::Thread thread(MyFunctor());
```

Le dernier exemple, qui utilise les foncteurs, est le plus puissant car il peut accepter n'importe quel type de foncteur et rend ainsi [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") compatible avec beaucoup de types de fonctions qui ne sont pas directement supportées. Cette fonctionnalité est particulièrement intéressante combinée aux lambdas ou `std::bind`, présents dans la nouvelle mouture 2011 du C++.

```
// avec les lambdas
sf::Thread thread([](){
    std::cout << "I am in thread!" << std::endl;
});
```

```
// avec std::bind
void func(std::string, int, double)
{
}

sf::Thread thread(std::bind(&func, "hello", 24, 0.5));
```

Si vous voulez utiliser un [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") dans une classe, n'oubliez pas qu'il n'a pas de constructeur par défaut. Ainsi, vous devrez l'initialiser directement dans la _liste d'initialisation_ du constructeur de la classe parent :

```
class ClassWithThread
{
public:

    ClassWithThread()
    : m_thread(&ClassWithThread::f, this)
    {
    }

private:

    void f()
    {
        ...
    }

    sf::Thread m_thread;
};
```

Si vous avez vraiment besoin de construire votre instance de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") _après_ la construction de l'objet parent, vous pouvez également retarder sa construction en l'allouant dynamiquement avec `new`.

## [Démarrer les threads](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#dcemarrer-les-threads)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Une fois que vous avez créé un [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation"), vous devez le démarrer avec sa fonction `launch`.

```
sf::Thread thread(&func);
thread.launch();
```

`launch` appelle dans un nouveau thread la fonction qui a été passée au constructeur, et rend la main immédiatement de façon à ce que le thread appelant puisse continuer à tourner en parallèle.

## [Arrêter les threads](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#arrcoter-les-threads)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Un thread s'arrête tout seul lorsque sa fonction se termine. Si vous voulez attendre qu'un thread se termine depuis un autre thread, vous pouvez appeler sa fonction `wait`.

```
sf::Thread thread(&func);

// démarre le thread
thread.launch();

...

// bloque l'exécution jusqu'à ce que le thread soit terminé
thread.wait();
```

La fonction `wait` est également implicitement appelée par le destructeur de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation"), de façon à ce qu'un thread ne puisse pas continuer à tourner (et être hors de contrôle) après que l'instance de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") qui l'a créé ait été détruite. Gardez bien cela en tête lorsque vous gérez vos threads (cf. la dernière partie de ce tutoriel).

## [Mettre en pause les threads](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#mettre-en-pause-les-threads)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Il n'existe aucune fonction dans [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") qui permette de mettre en pause un thread depuis un autre, la seule façon est de le faire directement depuis le code qui tourne dans le thread. En d'autres termes, on ne peut mettre en pause que le thread courant. Pour ce faire, vous pouvez appeler la fonction `sf::sleep` :

```
void func()
{
    ...
    sf::sleep(sf::milliseconds(10));
    ...
}
```

`sf::sleep` prend un paramètre, qui est la durée de la pause. Cette durée peut être donnée avec n'importe quelle unité/précision, comme expliqué dans le [tutoriel sur le temps](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php "Tutorial sur le temps").  
Notez que vous pouvez mettre en pause n'importe quel thread, même le thread principal.

`sf::sleep` est la façon la plus efficace d'attendre dans un thread : tant que le thread "dort", il n'utilise pas le processeur. Les pauses basées sur de l'attente active, comme des boucles `while` vides, utiliseraient 100% du processeur juste pour... ne rien faire. Cependant, gardez en tête que la durée d'attente est juste une indication, selon l'OS cela donnera un résultat plus ou moins précis. Ne comptez donc pas sur cette fonction pour produire des timings hyper précis.

## [Protéger les données partagées](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#protceger-les-donncees-partagcees)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Tous les threads d'un programme partagent la même mémoire, ils peuvent accéder à toutes les variables du programme. C'est très pratique mais aussi dangereux : puisque tous les threads tournent en parallèle, cela signifie qu'une variable ou une fonction pourrait très bien être utilisée depuis plusieurs threads en même temps. Et si l'opération en question n'est pas _thread-safe_, le résultat sera indéterminé (c'est-à-dire que cela pourrait planter ou corrompre des données).

Il existe plusieurs outils de programmation pour vous aider à protéger les variables partagées et rendre votre code thread-safe, ils sont appelés "primitives de synchronisation". Les plus communs sont les mutexs, les sémaphores, les conditions d'attente et les _spin locks_. Ils sont tous des variations du même concept : ils protègent un morceau de code en autorisant leur accès uniquement à certains threads, tout en bloquant les autres.

La primitive de synchronisation la plus basique (et la plus utilisée) est le mutex. Mutex signifie "EXclusion MUTuelle" : il autorise un seul thread à la fois à accéder aux morceaux de code qu'il entoure. Voyons voir comment un mutex pourrait remettre un peu d'ordre dans le premier exemple que nous avons vu :

```
#include <SFML/System.hpp>
#include <iostream>

sf::Mutex mutex;

void func()
{
    mutex.lock();

    for (int i = 0; i < 10; ++i)
        std::cout << "I'm thread number one" << std::endl;

    mutex.unlock();
}

int main()
{
    sf::Thread thread(&func);
    thread.launch();

    mutex.lock();

    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

    mutex.unlock();

    return 0;
}
```

Ce code utilise une ressource partagée (`std::cout`), et comme nous l'avons vu cela produit un résultat que nous souhaiterions éviter -- tout est mélangé dans la console. Pour nous assurer que les blocs de texte des deux threads sont correctement affichées au lieu d'être mélangées aléatoirement, nous protégeons les morceaux de code correspondant avec un mutex.

Le premier thread à atteindre sa ligne `mutex.lock()` verrouille le mutex, accède directement au code qui suit et affiche son texte. Lorsque l'autre thread atteint sa ligne `mutex.lock()`, le mutex est déjà verrouillé et le thread est donc mis en attente (de la même manière qu'avec un appel à `sf::sleep`, le thread qui dort n'utilise pas du tout le processeur). Lorsque le premier thread déverrouille enfin le mutex, le second thread est réveillé et est autorisé à son tour à verrouiller le mutex et à afficher ses lignes de texte. Les blocs de texte apparaissent donc séquentiellement dans la console, plutôt que mélangés.

![Capture d'écran de la sortie du programme](https://www.sfml-dev.org/tutorials/2.6/images/system-thread-ordered.png "Capture d'écran de la sortie du programme")

Le mutex n'est pas la seule primitive que vous pouvez utiliser pour protéger vos variables partagées, mais devrait être suffisant pour la plupart des cas. Cependant, si votre application fait des choses complexes avec les threads, et si vous avez le sentiment que ce n'est pas assez, n'hésitez pas à regarder du côté des bibliothèques dédiées aux threads, offrant plus de fonctionnalités.

## [Protéger les mutexs](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#protceger-les-mutexs)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Pas de panique : les mutexs sont déjà thread-safe, il n'y a pas besoin de les protéger. Mais ils ne sont pas exception-safe ! Que se passe-t-il si une exception est lancée pendant qu'un mutex est verrouillé ? Il ne peut pas atteindre la ligne qui le déverrouille, et reste verrouillé pour toujours. Et tous les threads qui essayeront ensuite de le verrouiller seront bloqués pour toujours à leur tour ; votre application toute entière pourrait se retrouver bloquée. Pas cool.

Pour s'assurer que les mutexs sont toujours déverrouillés dans un environnement où des exceptions peuvent être lancées, SFML fournit une classe RAII pour les encapsuler : [`sf::Lock`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Lock.php "sf::Lock documentation"). Elle verrouille le mutex dans son constructeur, et le déverrouille dans son destructeur. Simple et efficace.

```
sf::Mutex mutex;

void func()
{
    sf::Lock lock(mutex); // mutex.lock()

    functionThatMightThrowAnException(); // mutex.unlock() si cette fonction lance une exception

} // mutex.unlock()
```

Notez que [`sf::Lock`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Lock.php "sf::Lock documentation") peut aussi se révéler utile dans une fonction qui a plusieurs instructions `return`.

```
sf::Mutex mutex;

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
} // mutex.unlock()
```

## [Erreurs classiques](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#erreurs-classiques)[](https://www.sfml-dev.org/tutorials/2.6/system-thread-fr.php#top "Haut de la page")

Il y a une chose que les programmeurs oublient souvent : un thread ne peut pas vivre sans son instance de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation").  
On voit souvent ce genre de code sur les forums :

```
void startThread()
{
    sf::Thread thread(&funcToRunInThread);
    thread.launch();
}

int main()
{
    startThread();
    // ...
    return 0;
}
```

Les gens qui écrivent ce genre de code s'attendent à ce que la fonction `startThread()` démarre un thread qui va faire sa vie dans son coin et sera détruit lorsque sa fonction se termine. Mais ce n'est pas ce qui se passe en réalité : la fonction threadée semble bloquer le thread principal, comme si les threads ne fonctionnaient pas.

La raison ? L'instance de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") est locale à la fonction `startThread()` et est donc immédiatement détruite, quand la fonction se termine. Le destructeur de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") est appelé automatiquement, et celui-ci appelle à son tour `wait()` comme nous l'avons vu précédemment, et le résultat est que le thread principal bloque et attend que la fonction threadée se termine au lieu de continuer à tourner en parallèle.

Donc n'oubliez jamais ceci : vous devez gérer vos instances de [`sf::Thread`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Thread.php "sf::Thread documentation") de manière à ce qu'elles vivent aussi longtemps que le thread et sa fonction tournent.