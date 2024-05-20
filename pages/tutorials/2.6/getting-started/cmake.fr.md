# SFML avec le modèle de projet CMake

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

Ce tutoriel fonctionnera sur n'importe quel système d'exploitation, avec n'importe quel environnement de développement intégré (IDE) et n'importe quel compilateur. Il expliquera comment créer un projet pouvant être utilisé avec n'importe quelle version, branche ou commit Git de SFML. Cette approche est unique en ce sens qu'elle élimine la possibilité d'erreurs de liaison et facilite autant que possible la mise à niveau de votre version de SFML à l'avenir. Elle inclut même un pipeline d'intégration continue (CI) pour vérifier automatiquement que votre projet continue de se compiler sur Windows, Linux et macOS.

## [Créez votre propre projet GitHub](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#crceez-votre-propre-projet-github)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

[https://github.com/SFML/cmake-sfml-project](https://github.com/SFML/cmake-sfml-project "Modèle de projet CMake SFML repository")

Le dépôt GitHub ci-dessus est ce que GitHub appelle un [modèle (template) de dépôt](https://docs.github.com/fr/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template "Documentation GitHub sur les modèles de dépôt"). Consultez la documentation de GitHub sur les modèles de dépôt pour créer votre propre projet GitHub à partir de ce modèle. Cette étape garantit que votre code est conservé en sécurité dans un emplacement distant, pour éviter toute perte accidentelle.

## [Personnalisez le projet CMake et les noms exécutables](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#personnalisez-le-projet-cmake-et-les-noms-excecutables)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

Par défaut, ce projet utilise des noms de remplacement pour le nom du projet et le nom exécutable. Ces noms peuvent être ce que vous voulez et n'ont pas besoin d'être identiques. Le nom du projet est défini dans l'appel à `project()` en haut de `CMakeLists.txt`.

Le nom exécutable est défini dans l'appel à `add_executable()`. Assurez-vous de remplacer toutes les occurrences de l'ancien nom exécutable. Le nom exécutable est utilisé plusieurs fois après la création de l'exécutable.

## [Ajoutez vos propres fichiers source](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#ajoutez-vos-propres-fichiers-source)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

Le seul fichier C++ dans le projet au départ est `src/main.cpp`. Vous pouvez renommer, supprimer ou ajouter des fichiers source selon les besoins de votre propre projet. Assurez-vous simplement que tous les fichiers `.cpp` sont inclus dans l'appel à `add_executable` pour éviter les erreurs de liaison (link).

## [Conditions requises](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#conditions-requises)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

Étant donné que ce modèle construit SFML à partir des sources, les utilisateurs de Linux devront d'abord installer les paquets système requis. Sur Ubuntu ou d'autres systèmes d'exploitation basés sur Debian, cela peut être fait avec les commandes ci-dessous. Un processus similaire sera nécessaire pour les distributions Linux non basées sur Debian, comme Fedora.

    `sudo apt update     sudo apt install \         libxrandr-dev \         libxcursor-dev \         libudev-dev \         libopenal-dev \         libflac-dev \         libvorbis-dev \         libgl1-mesa-dev \         libegl1-mesa-dev \         libdrm-dev \         libgbm-dev`
    

Le modèle CMake nécessite l'installation de CMake. Le gestionnaire de paquets de votre système est le meilleur moyen d'obtenir CMake. Il est également installé avec Visual Studio. Si, pour une raison quelconque, les options précédentes ne fonctionnent pas, vous pouvez utiliser [https://cmake.org/download/](https://cmake.org/download/ "Téléchargement de CMake") pour installer CMake sur votre système d'exploitation.

[Git](https://git-scm.com/ "Git SCM") est également nécessaire car CMake utilise Git pour cloner le dépôt SFML. Si vous avez cloné votre propre projet GitHub, vous avez déjà Git installé. Sans Git, CMake échouera de manière peu intuitive.

## [Configurez et construisez votre projet](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#configurez-et-construisez-votre-projet)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake-fr.php#top "Haut de la page")

Maintenant que vous avez apporté toutes les modifications souhaitées au script de construction, nous sommes prêts à construire ! CMake est de loin le système de construction C++ le plus populaire, de sorte que n'importe quel environnement de développement intégré (IDE) que vous utilisez prendra en charge les projets CMake. Ci-dessous, quelques liens vers la documentation pour la configuration de projets CMake avec quelques IDE populaires différents.

- [VS Code](https://code.visualstudio.com/docs/cpp/cmake-linux "Documentation du projet CMake pour VS Code")
- [Visual Studio](https://docs.microsoft.com/en-us/cpp/build/cmake-projects-in-visual-studio?view=msvc-170 "Documentation du projet CMake pour Visual Studio")
- [CLion](https://www.jetbrains.com/clion/features/cmake-support.html "Documentation du projet CMake pour CLion")
- [Qt Creator](https://doc.qt.io/qtcreator/creator-project-cmake.html "Documentation du projet CMake pour Qt Creator")

Si vous préférez construire ce projet depuis la ligne de commande au lieu de passer par votre IDE, c'est également facile à faire. Vous pouvez utiliser ces deux commandes shell pour effectuer une compilation de version.

    `cmake -B build -DCMAKE_BUILD_TYPE=Release     cmake --build build --config Release`