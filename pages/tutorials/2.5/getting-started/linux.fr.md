# SFML et Linux

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#top "Haut de la page")

Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML sous Linux. Il va vous expliquer comment installer SFML, et comment compiler des projets qui l'utilisent.

## [Installer SFML](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#installer-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#top "Haut de la page")

Différentes approches sont possibles pour installer SFML sous Linux :

- L'installer directement depuis les dépôts de votre distrib Linux
- La compiler directement à partir des sources
- Télécharger le SDK et copier les fichiers manuellement

L'option 1 est de loin celle à préférer ; si la version de SFML que vous souhaitez installer est disponible dans les dépôts officiels, alors installez-la simplement avec votre gestionnaire de paquets. Par exemple, sous Debian vous feriez :

```
sudo apt-get install libsfml-dev
```

L'option 2 nécessite plus de travail : vous devez installer les fichiers de développement de toutes les dépendances de SFML, installer CMake, et exécuter quelques commandes à la main. Mais le résultat sera un package parfait, qui prend en compte toutes les spécificités de votre système.  
Si vous allez dans cette direction, il y a un tutoriel dédié à [la compilation de SFML](https://www.sfml-dev.org/tutorials/2.6/compile-with-cmake-fr.php "Comment compiler SFML").

Enfin, l'option 3 est un bon compromis pour une installation rapide si SFML n'est pas disponible en tant que package officiel. Téléchargez le SDK depuis la [page des téléchargements](https://www.sfml-dev.org/download-fr.php "Aller à la page des téléchargements"), décompressez-le et copiez les fichiers vers votre endroit préféré : soit un chemin à part dans votre dossier personnel (comme _/home/moi/sfml_), ou bien un chemin standard (comme _/usr/local_).

Si vous avez déjà une ancienne version de SFML installée, assurez-vous qu'elle n'entre pas en conflit avec la nouvelle version !

## [Compiler un programme SFML](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#compiler-un-programme-sfml)[](https://www.sfml-dev.org/tutorials/2.6/start-linux-fr.php#top "Haut de la page")

Dans ce tutoriel nous n'allons pas parler des EDIs tels que Code::Blocks ou Eclipse. Nous détaillerons simplement les commandes requises pour compiler et lier un exécutable SFML, mais écrire un makefile complet ou configurer un projet dans un EDI sort du cadre de ce tutoriel -- il existe de meilleurs tutoriels spécifiques pour ces choses.  
Si vous utilisez Code::Blocks, vous pouvez aller jeter un oeil au [tutoriel pour Code::Blocks sous Windows](https://www.sfml-dev.org/tutorials/2.6/start-cb-fr.php "SFML et Code::Blocks") ; les instructions devraient être similaires, sauf que si vous avez installé SFML dans un chemin standard du système vous n'aurez pas à définir les chemins de recherche du compilateur et de l'éditeur de liens.

Pour commencer, créez un fichier source, nommé "main.cpp", contenant ce petit programme SFML :

```
#include <SFML/Graphics.hpp>

int main()
{
    sf::RenderWindow window(sf::VideoMode(200, 200), "SFML works!");
    sf::CircleShape shape(100.f);
    shape.setFillColor(sf::Color::Green);

    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }

        window.clear();
        window.draw(shape);
        window.display();
    }

    return 0;
}
```

Maintenant compilez-le :

```
g++ -c main.cpp
```

Si vous avez installé SFML dans un chemin non-standard, vous devez indiquer au compilateur où trouver les en-têtes SFML (les fichiers .hpp) :

```
g++ -c main.cpp -I<installation-de-sfml>/include
```

Ici, _<installation-de-sfml>_ est le répertoire dans lequel vous avez copié SFML, par exemple _/home/moi/sfml_.

Puis, vous devez lier le fichier compilé aux bibliothèques SFML afin de produire l'exécutable final. SFML est composée de 5 modules (système, fenêtrage, graphique, réseau et audio), et il y a une bibliothèque pour chacun.  
Pour lier une bibliothèque SFML, vous devez ajouter "-lsfml-xxx" à votre ligne de commande, par exemple "-lsfml-graphics" pour le module graphique (par rapport au nom du fichier correspondant, le préfixe "lib" et l'extension ".so" doivent être omis).

```
g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-system
```

Si vous avez installé SFML dans un chemin non-standard, vous devrez indiquer à l'éditeur de liens où trouver les bibliothèques SFML (fichiers .so) :

```
g++ main.o -o sfml-app -L<installation-de-sfml>/lib -lsfml-graphics -lsfml-window -lsfml-system
```

Nous sommes maintenant prêts à exécuter le programme compilé :

```
./sfml-app
```

Si SFML n'est pas installée dans un chemin standard, vous devrez d'abord dire au chargeur de bibliothèques où trouver les bibliothèques de SFML :

```
export LD_LIBRARY_PATH=<installation-de-sfml>/lib && ./sfml-app
```

Si tout s'est bien passé, vous devriez voir ceci dans une nouvelle fenêtre :

![Capture d'écran de l'application Hello SFML](https://www.sfml-dev.org/tutorials/2.6/images/start-linux-app.png "Capture d'écran de l'application Hello SFML")