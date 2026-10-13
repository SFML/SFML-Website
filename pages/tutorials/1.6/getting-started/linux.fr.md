# SFML et gcc (Linux)

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/getting-started/linux/).

## Introduction

Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML sous Linux avec le compilateur GCC. Il va vous expliquer comment installer SFML, paramétrer votre compilateur, et compiler un programme SFML.  
La compilation des bibliothèques SFML sera également expliquée, pour les utilisateurs avancés (bien que ce soit relativement simple).

## Installer SFML

Premièrement, vous devez télécharger les fichiers de développement SFML. Il est recommandé de télécharger le SDK complet, qui contient le code source et les binaires, ainsi que les exemples et la documentation.  
Cette archive peut être trouvée sur la [page des téléchargements](../../../download/index.md "Aller sur la page des téléchargements").

Une fois que vous avez téléchargé et extrait les fichiers sur votre disque dur, vous devez installer les en-têtes et bibliothèques SFML à l'endroit approprié. Pour ce faire, allez dans le répertoire SFML-x.y et tapez "sudo make install".

## Compiler votre premier programme SFML

Créez un nouveau fichier texte, et écrivez un programme SFML. Par exemple, vous pouvez essayer la classe [`sf::Clock`](../../../documentation/1.6/classsf_1_1Clock.html "sf::Clock documentation") du module système :

```cpp
#include <SFML/System.hpp>
#include <iostream>

int main()
{
    sf::Clock Clock;
    while (Clock.GetElapsedTime() < 5.f)
    {
        std::cout << Clock.GetElapsedTime() << std::endl;
        sf::Sleep(0.5f);
    }

    return 0;
}
```

N'oubliez pas que toutes les classes et fonctions SFML se trouvent dans l'espace de nommage `sf`.

Puis compilez ceci comme n'importe quel programme C++, et liez avec les bibiothèques SFML que vous utilisez avec la directive "-l" :

```
g++ -c clock.cpp
g++ -o clock clock.o -lsfml-system
```

Lorsque vous liez avec plusieurs bibliothèques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est important pour gcc. La règle est la suivante : si la bibliothèque XXX dépend de (utilise) la bibliothèque YYY, spécifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics dépend de sfml-window, qui lui-même dépend de sfml-system. La ligne de commande d'édition de lien serait donc la suivante :

```
g++ -o ... -lsfml-graphics -lsfml-window -lsfml-system
```

En gros, toute bibliothèque SFML dépend de sfml-system, et sfml-graphics dépend en plus de sfml-window. Voilà pour ce qui est des dépendances.

Si vous utilisez les modules Graphics ou Audio, vous devez d'abord installer les bibliothèques externes utilisées par chaque module.  
Le module Graphics requiert freetype.  
Le module Audio requiert libsndfile et openal.  
Toutes ces bibiothèques peuvent être installées en utilisant le gestionnaire de paquets standard de votre distribution, ou téléchargées depuis leurs sites officiels.  
Si vous rencontrez des problèmes avec votre version d'OpenAL (ce qui arrive souvent étant donné que l'implémentation Linux est peu stable), vous pouvez la remplacer par [l'implémentation OpenAL-Soft](http://kcat.strangesoft.net/openal.html "Site officiel d'OpenAL-Soft"). Les binaires sont complétement compatibles, vous n'aurez donc pas à recompiler SFML ni vos programmes l'utilisant.

## Compiler SFML (pour les utilisateurs avancés)

Si les bibliothèques précompilées de SFML n'existent pas pour votre système, vous pouvez les compiler assez facilement. Dans de tels cas, aucun test n'a été effectué et nous vous encourageons donc à rapporter tout échec ou succès rencontré durant le processus de compilation. Si vous réussissez à compiler SFML pour une nouvelle plateforme, nous vous invitons à contacter l'équipe de développement afin que nous puissions partager les fichiers avec la communauté.

Vous devez tout d'abord installer les paquets de développement des bibliothèques externes utilisées par SFML. Voici la liste complète :

- build-essential
- mesa-common-dev
- libx11-dev
- libxrandr-dev
- libgl1-mesa-dev
- libglu1-mesa-dev
- libfreetype6-dev
- libopenal-dev
- libsndfile1-dev

Vous pouvez également les obtenir automatiquement si SFML se trouve dans les dépôts de paquets de votre distribution, avec la commande suivante :

```
apt-get build-dep libsfml
```

Puis, pour compiler les bibliothèques et exemples de SFML, vous devez télécharger et installer le SDK complet. Allez dans le répertoire SFML-x.y, et entrez les commandes suivantes :

```
make                # compile les bibliothèques SFML
sudo make install   # installe les bibliothèques compilées
make sfml-samples   # compile les exemples SFML
```

Note : si Qt et/ou wxWidgets ne sont pas installés sur votre système, vous obtiendrez certainement des erreurs lors de la compilation des exemples correspondant ; ignorez-les simplement.

Les options suivantes sont disponibles pour personnaliser la construction des bibliothèques :

- **DESTDIR=xxx** : installe SFML dans le répertoire xxx au lieu de celui par défaut (qui est /usr/lib)
- **DEBUGBUILD=yes/no** : construit les bibliothèques de débogage ou optimisées ("no" par défaut - optimisées)
- **STATIC=yes/no** :construit les bibliothèques statiques ou dynamiques ("no" par défaut - dynamiques)
