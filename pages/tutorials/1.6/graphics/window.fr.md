# Utiliser les fenêtres de rendu

## Introduction

Le module de fenêtrage fournit un système complet pour gérer les fenêtres et les évènements, et peut s'interfacer avec OpenGL. Mais que se passe-t-il si nous ne voulons pas utiliser OpenGL ? SFML fournit un module dédié à l'affichage de graphiques en 2D, le module graphique.

## Mise en place

Pour travailler avec le module graphique, vous devez inclure le bon en-tête :

```cpp
#include <SFML/Graphics.hpp>
```

SFML/Window.hpp n'est plus requis : il sera déjà inclus par le module graphique.

## La fenêtre de rendu

La fenêtre de base en SFML, [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation"), est suffisante pour obtenir une fenêtre et ses évènements, mais n'a aucune idée de la manière de dessiner quelque chose. En fait, il sera impossible de dessiner quoique ce soit du module graphique directement dans une [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation"). C'est pourquoi le module graphique fournit une classe de fenêtre offrant plus de fonctionnalités et effectuant plus de travail redondant à votre place : [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"). Comme [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") hérite de [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation"), elle contient déjà toutes les fonctionnalités de cette dernière et agit exactement de la même façon pour la création, la récupération des évènements, etc. Tout ce que fait [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") c'est ajouter des fonctionnalités pour afficher simplement des graphiques.

En fait, une application minimale utilisant le module graphique sera exactement la même qu'une application qui n'utilise que le module de fenêtrage, excepté le type de la fenêtre :

```cpp
int main()
{
    // Création de la fenêtre de rendu
    sf::RenderWindow App(sf::VideoMode(800, 600, 32), "SFML Graphics");

    // Exécution de la boucle principale
    while (App.IsOpened())
    {
        // Traitement des évènements
        sf::Event Event;
        while (App.GetEvent(Event))
        {
            // Fenêtre fermée : on quitte
            if (Event.Type == sf::Event::Closed)
                App.Close();
        }

        // Efface l'écran (remplissage avec du noir)
        App.Clear();

        // Affichage du contenu de la fenêtre à l'écran
        App.Display();
    }

    return EXIT_SUCCESS;
}
```

La seule différence est qu'ici nous avons ajouté un appel à `Clear`, de sorte que l'écran soit rempli en noir plutôt que de rester avec des pixel aléatoires.

Si vous souhaitez effacer l'écran avec une couleur différente, vous pouvez passer celle-ci en paramètre :

```cpp
App.Clear(sf::Color(200, 0, 0));
```

Le module graphique de SFML fournit une classe très utile pour manipuler les couleurs : [`sf::Color`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Color.php "sf::Color documentation"). Toutes les couleurs que vous croiserez dans la SFML seront des [`sf::Color`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Color.php "sf::Color documentation"), vous pouvez oublier les entiers 32-bits ou les tableaux de flottants.  
[`sf::Color`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Color.php "sf::Color documentation") contient basiquement quatre composantes 8-bits : `r` (rouge), `g` (vert), `b` (bleu), et `a` (alpha -- la transparence) ; leurs valeurs vont de 0 à 255.  
[`sf::Color`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Color.php "sf::Color documentation") fournit des fonctions, des opérateurs et des constructeurs utiles, celui qui nous intéresse ici est celui qui prend les 4 composantes en paramètre (la quatrième, alpha, a une valeur par défaut fixée à 255). Ainsi dans le code ci-dessus, nous construisons une instance de [`sf::Color`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Color.php "sf::Color documentation") avec une composante rouge à 200, et des composantes verte et bleue à 0. Donc... nous obtenons un fond rouge pour notre fenêtre.

Notez bien qu'effacer la fenêtre n'est pas nécessaire si ce que vous avez à afficher va recouvrir l'écran entièrement ; ne le faites que si vous avez des pixels qui resteraient non dessinés.

## Prendre des captures d'écran

Ce n'est probablement pas la chose la plus importante, mais cela peut s'avérer utile. [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") fournit une fonction pour sauvegarder son contenu dans une image : `Capture`. Vous pouvez ensuite sauvegarder l'image dans un fichier facilement à l'aide de la fonction `SaveToFile`, ou faire n'importe quoi d'autre.  
Donc, par exemple, nous pouvons prendre une capture de l'écran lorsque l'utilisateur appuie sur la touche F1 :

```cpp
if (Event.Key.Code == sf::Key::F1)
{
    sf::Image Screen = App.Capture();
    Screen.SaveToFile("screenshot.jpg");
}
```

Bien entendu, selon la position de cette ligne de code dans votre boucle principale, l'image capturée ne sera pas la même. Cela va enregistrer le contenu actuel de l'écran au moment de l'appel à `Capture`.

## Mixer avec OpenGL

Il est bien entendu toujours possible d'utiliser vos propres commandes OpenGL avec une [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"), comme vous le feriez avec [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation"). Vous pouvez même mixer des commandes de dessin de SFML avec votre code OpenGL. Cependant, SFML ne préserve pas les états OpenGL par défaut. Si SFML met le bazar dans vos états OpenGL et que vous voulez qu'il prenne soin de les sauver / réinitialiser / restaurer, vous devez appeler la fonction `PreserveOpenGLStates` :

```cpp
App.PreserveOpenGLStates(true);
```

Préserver les états OpenGL est très lourd au niveau du CPU et va degrader les performances, n'utilisez cette option que si vous en avez réellement besoin. Vous pouvez également penser à gérer cela avec votre propre code, cela sera nécessairement plus optimisé que le code générique de SFML qui sauvegarde tous les états, y compris ceux dont vous n'avez pas besoin.

## Conclusion

Il n'y a pas beaucoup plus à dire sur les fenêtres de rendu. Elles fonctionnent comme les fenêtres de base, en ajoutant quelques fonctionnalités pour faciliter le rendu 2D. Plus de ces fonctionnalités seront expliquées dans les prochains tutoriels, à commencer par [l'affichage de sprites](sprite.md "Aller au prochain tutoriel").
