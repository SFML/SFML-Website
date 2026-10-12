# Utiliser les threads et les mutexs

## Introduction

Tout d'abord, il faut dire que ce tutoriel, bien qu'étant le premier, n'est pas le plus important. En fait vous pouvez très bien commencer à apprendre et à utiliser la SFML sans thread ni mutex. Mais en tant que module de base pour tous les autres modules, il est important de savoir quelles fonctionnalités il peut offrir.

## Qu'est-ce qu'un thread ?

Avant d'entrer dans le vif du sujet, qu'est-ce qu'un thread ? Dans quel cas doit-on les utiliser ?

Basiquement, un thread est un moyen d'exécuter un ensemble d'instructions indépendamment du thread principal (tout programme tourne dans un thread : il s'agit de programmes *monothreaded* ; lorsque vous ajoutez un ou plusieurs threads, il s'agit alors de programmes *multithreaded*). Démarrer un thread, c'est un peu comme exécuter un nouveau processus, excepté que c'est beaucoup plus léger -- les threads sont aussi appelés processus légers. Tous les threads partagent les données de leur processus parent. Ainsi, vous pouvez avoir deux ou plusieurs ensembles d'instructions s'exécutant en parallèle au sein de votre programme.  
Ok, alors quand faut-il utiliser les threads ? En gros, lorsque vous devez exécuter quelque chose demandant beaucoup de temps (un calcul complexe, attente d'un évènement, ...) tout en évitant de bloquer l'exécution du programme. Par exemple, vous pourriez vouloir afficher une interface graphique pendant que vous chargez les ressources de votre jeu (ce qui prend habituellement pas mal de temps), ainsi vous pouvez placer le code de chargement dans un thread séparé du reste. Les threads sont également largement utilisés dans la programmation réseau, afin d'attendre que des données soient réceptionnées tout en continuant l'exécution du programme.

Dans la SFML, les threads sont définis par la classe [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation"). Il existe deux façons de l'utiliser, selon vos besoins.

## Utilisation de sf::Thread avec une fonction de rappel (callback)

La première manière d'utiliser [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation") est de lui fournir une fonction à exécuter. Lorsque vous démarrez le thread, cette fonction sera appelée en tant que point d'entrée du thread. Celui-ci prendra fin automatiquement lorsque la fonction se terminera.

Voici un exemple simple :

```cpp
#include <SFML/System.hpp>
#include <iostream>

void ThreadFunction(void* UserData)
{
    // Afficher quelque chose...
    for (int i = 0; i < 10; ++i)
        std::cout << "Je suis le thread numero 1" << std::endl;
}

int main()
{
    // Création d'un thread avec notre fonction
    sf::Thread Thread(&ThreadFunction);

    // Lancement du thread !
    Thread.Launch();

    // Afficher quelque chose...
    for (int i = 0; i < 10; ++i)
        std::cout << "Je suis le thread principal" << std::endl;

    return EXIT_SUCCESS;
}
```

Lorsque `Thread.Launch()` est appelé, l'exécution est séparée en deux flots indépendants : pendant que `ThreadFunction()` s'exécute, `main()` est en train de se terminer. Ainsi le texte des deux threads sera affiché en même temps.

Soyez vigilants : ici la fonction `main()` peut très bien se terminer avant la fin de `ThreadFunction()`, terminant ainsi le programme alors que le thread est toujours actif. Cependant ce n'est pas le cas : le destructeur de [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation") va attendre que le thread se termine, et ainsi s'assurer que le thread ne vivra pas plus longtemps que l'instance de [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation") qui le possède.

Si vous avez des données à passer au thread, vous pouvez les passer au constructeur de [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation") :

```cpp
MyClass Object;
sf::Thread Thread(&ThreadFunction, &Object);
```

Vous pouvez ensuite les récupérer avec le paramètre `UserData` :

```cpp
void ThreadFunction(void* UserData)
{
    // Transtypage du paramètre en son type réel
    MyClass* Object = static_cast<MyClass*>(UserData);
}
```

Attention, assurez-vous que les données que vous passez ne seront pas détruites avant que le thread en ait fini avec !

## Utilisation de sf::Thread en tant que classe de base

L'utilisation d'une fonction callback en tant que thread est simple, et peut être utile dans certains cas, mais ne se révèle pas très flexible. En effet, que se passe-t-il si vous voulez utiliser un thread au sein d'une classe ? Ou si vous voulez partager plus de variables entre votre thread et le thread principal ?

Afin de permettre plus de flexibilité, [`sf::Thread`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Thread.php "sf::Thread documentation") peut également être utilisée en tant que classe de base. Au lieu de lui passer une fonction callback à la construction, vous pouvez en dériver et redéfinir la fonction virtuelle `Run()`. Voici le même exemple que ci-dessus, écrit avec une classe dérivée au lieu de la fonction callback :

```cpp
#include <SFML/System.hpp>
#include <iostream>

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Afficher quelque chose...
        for (int i = 0; i < 10; ++i)
            std::cout << "Je suis le thread numero 2" << std::endl;
    }
};

int main()
{
    // Création d'une instance de notre classe perso de thread
    MyThread Thread;

    // On lance le thread !
    Thread.Launch();

    // Afficher quelque chose...
    for (int i = 0; i < 10; ++i)
        std::cout << "Je suis le thread principal" << std::endl;

    return EXIT_SUCCESS;
}
```

Si utiliser un nouveau thread est une fonctionnalité interne qui ne doit pas apparaître dans l'interface publique de votre classe, vous pouvez utiliser l'héritage privé :

```cpp
class MyClass : private sf::Thread
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
```

Ainsi, votre classe n'exposera pas inutilement les fonctions liées à la manipulation de thread dans son interface publique.

## Stopper un thread

Comme nous l'avons déjà mentionné, un thread prend fin lorsque la fonction associée se termine. Mais comment faire pour terminer un thread à partir d'un autre thread, sans attendre que sa fonction prenne fin ?

Il existe deux façons de terminer un thread, mais une seule est réellement sûre. Regardons d'abord la manière brutale et non sûre de le faire :

```cpp
#include <SFML/System.hpp>

void ThreadFunction(void* UserData)
{
    // Quelque chose...
}

int main()
{
    // Créons un thread avec notre fonction
    sf::Thread Thread(&ThreadFunction);

    // Démarrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper immédiatement
    Thread.Terminate();

    return EXIT_SUCCESS;
}
```

En appelant `Terminate()`, le thread sera immédiatemment stoppé sans aucune chance de terminer son exécution proprement. Cela s'avère même pire, car selon votre système d'exploitation, le thread peut même ne pas libérer les ressources qu'il détient.  
Voici ce que dit la MSDN à propos de la fonction `TerminateThread` pour Windows : " TerminateThread est une fonction dangereuse qui ne devrait être utilisée que dans les cas les plus extrêmes. "

Le seul moyen sûr de terminer un thread actif est de simplement attendre qu'il se finisse de lui-même. Pour attendre la fin d'un thread, vous pouvez utiliser sa fonction `Wait()` :

```cpp
Thread.Wait();
```

Ainsi, pour ordonner à un thread de se terminer, vous pouvez lui envoyer un évènement, utiliser une variable booléene, ou ce que vous voulez. Puis attendre qu'il se termine tout seul. Voici un exemple :

```cpp
#include <SFML/System.hpp>

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
    sf::Thread Thread(&ThreadFunction);

    // Démarrons le !
    Thread.Launch();

    // Pour une raison X, nous voulons le stopper immédiatement
    ThreadRunning = false;
    Thread.Wait();

    return EXIT_SUCCESS;
}
```

C'est plutôt simple, et beaucoup plus sûr que d'appeler `Terminate()`.

## Endormir un thread

Qu'il s'agisse du thread principal ou d'un thread que vous avez créé, il vous est possible de le mettre en pause pour une durée donnée grâce à la fonction `sf::Sleep` :

```cpp
sf::Sleep(0.1f);
```

Comme toute durée manipulée par la SFML, le paramètre est un flottant définissant le temps de pause en secondes. Ici ce sera donc une pause de 100 ms.

## Utiliser un mutex

Ok, commençons par définir ce qu'est un mutex. Un mutex (*MUTual EXclusion*) est une primitive de synchronisation. Ce n'est pas la seule : il existe les sémaphores, les sections critiques, les conditions, etc. Mais la plus importante est le mutex. En gros, vous l'utilisez pour verrouiller un morceau de code spécifique qui ne doit pas être interrompu, pour empêcher les autres threads d'y accéder. Lorsqu'un mutex est verrouillé, tout autre thread tentant de le verrouiller à son tour sera mis en attente jusqu'à ce que le thread qui l'a verrouillé le premier le déverrouille. Typiquement, les mutexs sont utilisés pour contrôler l'accès aux variables qui sont partagées entre plusieurs threads.

Si vous exécutez les exemples de code donnés au début de ce tutoriel, vous verrez que le résultat n'est peut-être pas ce à quoi vous vous attendiez : les textes des threads sont complétement mélangés. Ceci est dû au fait que les threads accèdent à la même ressource en même temps (ici la sortie standard). Pour éviter ceci, on peut utiliser un [`sf::Mutex`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Mutex.php "sf::Mutex documentation") :

```cpp
#include <SFML/System.hpp>
#include <iostream>

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
        for (int i = 0; i < 10; ++i)
            std::cout << "Je suis le thread numero 2" << std::endl;

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
    for (int i = 0; i < 10; ++i)
        std::cout << "Je suis le thread principal" << std::endl;

    // On déverrouille le mutex
    GlobalMutex.Unlock();

    return EXIT_SUCCESS;
}
```

Si vous vous demandez pourquoi nous n'utilisons pas de mutex pour accéder à la variable `ThreadRunning` dans l'exemple plus haut (pour stopper un thread), voici les deux raisons :

- Ecrire / lire la valeur d'un booléen est une opération atomique, ce qui signifie qu'elle ne peut pas être interrompue par un autre thread
- Même si elle n'était pas atomique, cela ne serait pas bien grave puisque la seule conséquence serait d'attendre le prochain tour de boucle pour avoir la bonne valeur du booléen

Soyez vigilants lorsque vous utilisez un mutex ou toute autre primitive de synchronisation : si vous ne les utilisez pas avec précaution, ils peuvent mener à des interblocages (*deadlocks* -- plusieurs threads verrouillés qui attendent les uns sur les autres indéfiniment).

Mais il reste un problème : que se passe-t-il si une exception est levée alors qu'un mutex est verrouillé ? Le thread n'aura aucun moyen de le déverrouiller, ce qui causera probablement un interblocage et gèlera votre programme. Afin de gérer ce problème correctement sans avoir à écrire des tonnes de code supplémentaire, la SFML fournit une classe [`sf::Lock`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Lock.php "sf::Lock documentation").

Une version plus sûre du code ci-dessus serait donc la suivante :

```cpp
{
    // On verrouille le mutex, pour s'assurer qu'aucun autre thread ne nous interrompera
    // pendant que nous affichons sur la sortie standard
    sf::Lock Lock(GlobalMutex);

    // On affiche quelque chose...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

}// Le mutex est déverrouillé automatiquement lorsque l'objet sf::Lock est détruit
```

Le mutex est déverrouillé dans le destructeur de [`sf::Lock`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Lock.php "sf::Lock documentation"), qui sera appelé même si une exception est levée.

## Conclusion

Les threads et les mutexs sont très faciles à utiliser, mais soyez prudents : la programmation parallèle peut être beaucoup plus difficile qu'elle n'y paraît. Evitez les threads si vous n'en avez pas besoin, et essayez de partager aussi peu de variables que possibles entre plusieurs threads.

Vous pouvez maintenant retourner au [sommaire des tutoriels](../index.md "Retour au sommaire des tutoriels"), ou passer aux [tutoriels du module de fenêtrage](../window/window.md "Passer aux tutoriels du module de fenêtrage").
