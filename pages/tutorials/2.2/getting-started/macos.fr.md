# SFML et Xcode (macOS)

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#top "Haut de la page")

Ceci est le premier tutoriel que vous devriez lire si vous utilisez SFML avec Xcode -- et de manière plus générale, si vous développez des applications pour macOS. Ce tutoriel vous montrera comment installer SFML, configurer votre EDI et compiler un programme SFML simple. Mais aussi, plus important, comment créer des applications qui soient prêtes à être utilisées "_out of the box_" pour l'utilisateur final.

Plusieurs liens sont donnés dans ce document. Ils sont là principalement pour les plus curieux d'entre vous ; vous n'avez pas besoin de les consulter pour suivre ce tutoriel.

### Les prérequis système

Tout ce dont vous avez besoin pour créer une application SFML est :

- un Mac Intel avec Catalina ou ultérieur (10.15+) ou un Mac Apple Silicon avec Big Sur ou ultérieur (11+)
- avec [Xcode](http://developer.apple.com/xcode/ "Télécharger Xcode") (les versions 4 et ultérieurs de l'EDI, qui est disponible sur l'_App Store_, sont supportées)
- avec clang et libc++ (fournis par Xcode).

Avec les versions récentes de Xcode vous devez aussi installer les Command Line Tools depuis Xcode > Preferences > Downloads > Components. Si vous ne trouvez pas les CLT dans Xcode, utilisez `xcode-select --install` dans un Terminal et suivez les instructions à l'écran.

### Les binaires : dylib contre framework

SFML est disponible en deux formats sous macOS. Vous avez les bibliothèques _dylib_ d'un côté, et les bundles _framework_ de l'autre.

- Dylib signifie "bibliothèque dynamique" ; ce format est similaire aux bibliothèques _.so_ sous Linux. Vous pourrez trouver plus de détails dans [ce document](https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/ "Consulter la documentation d'Apple sur les dylibs").
- Les frameworks sont fondamentalement similaires aux dylibs, excepté qu'ils peuvent intégrer des ressources externes. Voici [la documentation détaillée](https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html "Consulter la documentation d'Apple sur les frameworks").

Il y a une seule différence importante entre ces deux types de bibliothèques à garder en tête lorsque vous développez des applications SFML : si vous compilez SFML vous-même, vous pouvez créer les dylibs en version _release_ et _debug_. Par contre, les frameworks ne sont disponibles qu'en version _release_. Ceci ne sera toutefois pas un problème car quand vous distribuerez votre application aux utilisateurs finaux il est préférable d'utiliser la version _release_ de SFML. C'est pourquoi les binaires pour OS X disponibles sur [la page de téléchargements](https://www.sfml-dev.org/download-fr.php "Aller à la page des téléchargements") sont uniquement en version _release_.

### Les templates Xcode

SFML est livrée avec deux templates pour Xcode 4+ qui vous permettent de créer très rapidement et facilement de nouveaux projets d'applications. Ces templates peuvent créer des projets personnalisés : vous pouvez selectionner les modules dont votre application a besoin, choisir d'utiliser SFML en tant que dylib ou framework et décider entre créer un bundle d'application contenant toutes ses ressources (rendant l'installation de votre application aussi simple qu'un glisser-déposer) ou bien un binaire classique. Voyez plus bas pour plus de détails.

Soyez conscients que ces templates ne sont pas compatibles avec Xcode 3. Si vous utilisez toujours cette version de l'EDI et ne comptez pas le mettre à jour, vous pourrez toujours créer des applications SFML bien entendu, mais nous n'aborderons pas la manière de faire dans ce tutoriel. Veuillez vous rapporter à la documentation d'Apple concernant Xcode 3, et plus particulièrement regarder comment ajouter une bibliothèque à votre projet.

## [Installer SFML](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#installer-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#top "Haut de la page")

Tout d'abord, vous devez télécharger le SDK SFML qui se trouve sur la [page des téléchargements](https://www.sfml-dev.org/download-fr.php "Aller à la page des téléchargements"). Puis, pour commencer à développer des applications SFML, vous devez installer les composants suivants :

- **Les fichiers d'en-tête et les bibliothèques**  
    SFML est fournie en dylib ou en framework. Nous recommandons d'utiliser les frameworks mais les deux peuvent être installés sur un même système.
    - _frameworks_  
        Copiez le contenu de Frameworks dans /Library/Frameworks.
    - _dylib_  
        Copiez le contenu de lib dans /usr/local/lib et copiez le contenu de include dans /usr/local/include.
- **Les dépendances de SFML**  
    SFML requiert seulement quelques bibliothèques externes sous macOS. Copiez le contenu de extlibs dans /Library/Frameworks.
- **Les templates Xcode**  
    Ce composant est optionnel mais il est fortement recommandé de l'installer. Copiez le dossier SFML de templates dans ~/Library/Developer/Xcode/Templates (si besoin, créez d'abord l'arborescence de répertoires).

À noter que /Library peut être nommé /Bibliothèque si votre système est en français.

## [Créer un premier programme SFML](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#crceer-un-premier-programme-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-osx-fr.php#top "Haut de la page")

Nous fournissons deux templates pour Xcode. SFML CLT génère un projet pour une application terminal classique alors que SFML App crée un projet pour un bundle d'application. Nous allons utiliser ce dernier ici mais ils fonctionnent de manière relativement similaire.

Tout d'abord, choisissez File > New Project... puis sélectionnez SFML dans la colonne de gauche et double cliquez sur SFML App.

![Sélection du template Xcode](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-new-project.png "Sélection du template Xcode")

Maintenant vous pouvez remplire les champs requis comme dans cette capture d'écran ; puis pressez next.

![Formulaire du template Xcode](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-new-project-settings.png "Formulaire du template Xcode")

Votre nouveau projet est maintenant configuré pour créer un [bundle d'application ".app"](https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html "Consulter la documentation d'Apple sur les bundles d'application").

Maintenant que votre projet est prêt, voyons ce qu'il y a à l'intérieur :

![Contenu du nouveau projet](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-window.png "Contenu du nouveau projet")

Comme vous pouvez le voir, il y a déjà pas mal de fichiers dans le projet. Il y a trois catégories importantes :

1. **En-tête & fichiers sources :** le projet vient avec un exemple basique dans main.cpp et une fonction d'utilitaire : `std::string resourcePath(void);` dans ResourcePath.hpp et ResourcePath.mm. Le but de cette fonction, comme illustré dans l'exemple, est de fournir un moyen pratique d'accéder au répertoire Resources du bundle d'application.  
    Notez bien que cette fonction ne marche que sous macOS. Si vous prévoyez de porter votre application sur un autre OS, vous devrez faire une autre implémentation de cette fonction.
2. **Fichiers ressources :** les ressources de l'exemple de base sont mises dans ce répertoire et sont automatiquement copiées dans votre bundle d'application lorsque vous le compilez.  
    Pour ajouter de nouvelles ressources à votre projet, glissez-les simplement dans ce répertoire et assurez-vous qu'elles font partie de la cible de l'application, i.e. la case sous Target Membership dans la zone utilitaire (cmd+alt+1) doit être cochée.
3. **Produit :** c'est votre application. Cliquez simplement sur le bouton Run pour la tester.

Les autres fichier du projet ne sont pas très intéressants pour nous ici. Par contre, notez que les dépendances de SFML de votre projet sont ajoutées à votre bundle d'application, d'une manière similaire que les fichiers de ressources sont copiées, de sorte que l'application puisse s'exécuter directement sur un autre Mac sans aucune installation de SFML ou de ses dépendances.