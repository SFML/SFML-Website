# SFML et Code::Blocks

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/getting-started/code-blocks/).

## Introduction

Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Code::Blocks et le compilateur GCC (c'est celui par défaut). Il va vous expliquer comme installer SFML, paramétrer votre EDI, et compiler un programme SFML.  
La compilation des bibliothèques SFML est également expliquée, pour les utilisateurs plus expérimentés (bien que ce soit relativement simple).

## Installer SFML

**Important**: cette release de SFML a été compilée avec gcc 4.4, si votre propre version ne correspond pas et est incompatible, vous devrez recompiler SFML.

Premièrement, vous devez télécharger les fichiers de développement de SFML. Vous pouvez télécharger l'archive minimale (bibliothèques + en-têtes), mais il est recommandé de télécharger le SDK complet, qui contient en plus les exemples et la documentation.  
Ces archives peuvent être trouvées sur la [page de téléchargements](../../../download/index.md "Aller à la page de téléchargements").

Une fois que vous avez téléchargé et extrait les fichiers sur votre disque dur, vous devez faire en sorte que Code::Blocks connaisse les fichiers en-têtes et bibliothèques de SFML. Il y a deux façons de le faire :

#### Copier les fichiers de développement SFML directement dans le répertoire d'installation de Code::Blocks

- Copiez SFML-x.y\include\SFML vers le répertoire \include de votre installation de Code::Blocks (de manière à obtenir \include\SFML)
- Copiez les fichiers *.a de SFML-x.y\lib vers le répertoire \lib de votre installation de Code::Blocks

#### Laisser les fichiers SFML où vous voulez, et paramétrer Code::Blocks pour qu'il les trouve

- Allez dans le menu *Settings / Compiler and debugger*, puis dans *Global compiler settings / Search directories*
- Dans *Compiler*, ajoutez SFML-x.y\include
- Dans *Linker*, ajoutez SFML-x.y\lib

![Capture d'écran de la boîte de dialog pour paramétrer le chemin des en-têtes](cb-include-path.png)

![Capture d'écran de la boîte de dialog pour paramétrer le chemin des bibliothèques](cb-lib-path.png)

## Compiler votre premier programme SFML

Créez un nouveau projet "Console application" utilisant le compilateur GCC, et écrivez un programme SFML. Par exemple, vous pouvez essayer la classe [`sf::Clock`](../../../documentation/1.6/classsf_1_1Clock.html "sf::Clock documentation") du module système :

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

Ouvrez les options de votre projet, puis allez dans l'onglet *Linker settings*. Dans *Other link options*, ajoutez les bibliothèques SFML que vous utilisez avec la directive "-l". Ici nous n'utilisons que libsfml-system.a, donc nous ajoutons "-lsfml-system". Pour la configuration Debug, vous pouvez lier avec les versions de débogage des bibliothèques, qui sont suffixées par "-d" ("-lsfml-system-d" dans ce cas).  
Ca c'est pour les bibliothèques dynamiques, celles qui nécessiteront les DLLs correspondantes. Si vous souhaitez plutôt lier avec les versions statiques des bibliothèques SFML, vous pouvez utiliser le préfixe "-s" : -lsfml-system-s, ou -lsfml-system-s-d pour la version debug.

![Capture d'écran de la boîte de dialogue pour paramétrer les bibliothèques du projet](cb-project-link.png)

Lorsque vous liez avec plusieurs bibliothèques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est important pour MinGW. La règle est la suivante : si la bibliothèque XXX dépend de (utilise) la bibliothèque YYY, spécifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics dépend de sfml-window, qui lui-même dépend de sfml-system. Les options d'édition de lien seraient donc les suivantes :

```cpp
-lsfml-graphics
-lsfml-window
-lsfml-system
```

En gros, toute bibliothèque SFML dépend de sfml-system, et sfml-graphics dépend en plus de sfml-window. Voilà pour ce qui est des dépendances.

Votre programme devrait maintenant compiler, lier et s'exécuter sans problème. Si vous avez lié avec la version dynamique des bibliothèques SFML, n'oubliez pas de copier les DLLs correspondantes (sfml-system.dll dans ce cas) dans le répertoire de votre exécutable, ou dans un répertoire contenu dans la variable d'environnement PATH.

**Important** : si vous utilisez les bibliothèques dynamiques, vous devez également définir la macro **SFML_DYNAMIC** dans les options de votre projet. Si vous ne le faites pas, vous aurez des erreurs d'édition de liens lors de la compilation de votre application.

![Capture d'écran de la boîte de dialogue pour lier avec les bibliothèques dynamiques](cb-project-dynamic.png)

Si vous utilisez le module Audio, vous devez également copier les DLLs des bibliothèques externes qu'il utilise, qui sont libsndfile-1.dll et OpenAL32.dll.  
Ces fichiers peuvent être trouvés dans le répertoire extlibs\bin de l'archive que vous avez téléchargée (SDK ou fichiers de développement).

## Compiler SFML

Si les bibliothèques précompilées de SFML n'existent pas pour votre système, ou si vous souhaitez utiliser les dernières sources via SVN, vous pouvez compiler SFML assez facilement. Dans de tels cas, aucun test n'a été effectué et nous vous encourageons donc à rapporter tout échec ou succès rencontré durant le processus de compilation. Si vous réussissez à compiler SFML pour une nouvelle plateforme, nous vous invitons à contacter l'équipe de développement afin que nous puissions partager les fichiers avec la communauté.

Pour compiler les bibliothèques SFML et les exemples, vous devez tout d'abord télécharger et installer le SDK complet (ou récupérer les fichiers sur le dépôt SVN).

Allez dans le répertoire SFML-x.y\build\codeblocks, et ouvrez le fichier SFML.workspace. Choisissez la configuration que vous souhaitez construire (Debug ou Release, Static ou DLL), et cliquez sur "build workspace". Cela devrait créer les bibliothèques SFML correspondantes dans le répertoire lib, ainsi que les exécutables des exemples.

Si Qt et wxWidgets ne sont pas installés sur votre système, vous devriez avoir des erreurs de compilation avec les exemples correspondants ; ignorez les simplement.

Compiler les bibliothèques SFML statiques avec MinGW requiert une étape supplémentaire si vous voulez également y inclure les bibliothèques externes. Si vous ne le faites pas, vous aurez à lier explicitement vos programmes SFML à toutes les bibliothèques externes qu'elle utilise.  
Malheureusement Code::Blocks ne sait pas exécuter cette étape automatiquement, mais il existe pour cela un script batch nommé build.bat dans SFML-x.y\build\codeblocks\batch-build. Ce script compile automatiquement toutes les configurations des bibliothèques SFML (debug/release statique/dynamique) and exécute l'étape supplémentaire nécessaire aux bibliothèques statiques. Tout ce que vous avez à faire avant de l'exécuter est de rendre votre exécutable Code::Blocks (codeblocks.exe) accessible, c'est-à-dire mettre son chemin dans la variable d'environnement PATH.
