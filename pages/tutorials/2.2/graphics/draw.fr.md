# Dessiner avec SFML

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#top "Haut de la page")

Comme vous l'avez vu dans les tutoriels précédents, le module de fenêtrage de SFML fournit tout ce qu'il faut pour créer une fenêtre OpenGL et gérer ses évènements, mais n'est d'aucune aide pour dessiner quoique ce soit. La seule option qu'il vous offre est d'utiliser OpenGL, qui est certes très puissante mais tout aussi complexe.

Heureusement, SFML fournit un module graphique avec plein d'entités 2D, beaucoup plus simples à manipuler qu'OpenGL.

## [La fenêtre de dessin](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#la-fencotre-de-dessin)[](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#top "Haut de la page")

Afin de dessiner les entités fournies par le module graphique, vous devez utiliser une classe de fenêtre spécialisée : [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"). Celle-ci dérive de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") et hérite de toutes ses fonctions. Tout ce que vous avez appris à propos de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") (création, gestion des évènements, contrôle du rafraîchissement, mélange avec OpenGL, etc.) est toujours valable avec [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation").

Par dessus cela, [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") ajoute des fonctions de plus haut-niveau pour vous aider à dessiner plus facilement. Ce tutoriel se concentre sur deux de ces fonctions : `clear` et `draw`. Elles sont aussi simples que leur nom le suggère : `clear` efface la fenêtre toute entière avec la couleur choisie, et `draw` y dessine l'objet que vous lui passez en paramètre.

Voici une boucle principale typique avec une fenêtre de dessin :

```
#include <SFML/Graphics.hpp>

int main()
{
    // création de la fenêtre
    sf::RenderWindow window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme tant que la fenêtre n'a pas été fermée
    while (window.isOpen())
    {
        // on traite tous les évènements de la fenêtre qui ont été générés depuis la dernière itération de la boucle
        sf::Event event;
        while (window.pollEvent(event))
        {
            // fermeture de la fenêtre lorsque l'utilisateur le souhaite
            if (event.type == sf::Event::Closed)
                window.close();
        }

        // effacement de la fenêtre en noir
        window.clear(sf::Color::Black);

        // c'est ici qu'on dessine tout
        // window.draw(...);

        // fin de la frame courante, affichage de tout ce qu'on a dessiné
        window.display();
    }

    return 0;
}
```

Appeler `clear` avant de dessiner quoique ce soit est obligatoire, sinon vous pourriez vous retrouver avec des pixels aléatoires ou bien de la frame précédente. La seule exception est le cas où vous couvrez la totalité de la fenêtre avec ce que vous dessinez, de sorte que tous les pixels soient écrasés ; dans ce cas vous pouvez ne pas appeler `clear` (bien que cela ne fasse pas de grande différence au niveau des performances).

Appeler `display` est tout aussi obligatoire, cela a pour effet d'afficher dans la fenêtre tout ce qui a été dessiné depuis l'appel précédent à `display`. En effet, les entités ne sont pas dessinées directement dans la fenêtre, mais plutôt dans une surface cachée. Cette surface est ensuite copiée vers la fenêtre lors de l'appel à `display` -- c'est ce qu'on appelle le _double buffering_.

Ce cycle clear/draw/display est la seule bonne manière de dessiner. N'essayez pas d'autres stratégies, telles que garder certains pixels de la frame précédente, "effacer" des pixels, ou bien encore dessiner une seule fois et appeler `display` plusieurs fois. Vous obtiendrez des résultats bizarres à cause du _double buffering_.  
Les puces et les APIs graphiques modernes sont _vraiment_ faites pour des cycles clear/draw/display répétés, où tout est complètement rafraîchi à chaque itération de la boucle de dessin. Ne soyez pas effrayés de dessiner 1000 sprites 60 fois par seconde, vous êtes encore loin des millions de triangles que votre machine peut gérer.

## [Qu'est-ce que je peux dessiner maintenant ?](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#quest-ce-que-je-peux-dessiner-maintenant)[](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#top "Haut de la page")

Maintenant que vous avez une boucle principale qui est prête à dessiner, voyons ce que vous pouvez y dessiner, et de quelle manière.

SFML fournit quatre types d'entités dessinables : trois d'entre elles sont prêtes à l'emploi (_sprites_, _textes_ et _formes_), la dernière est la brique de base qui vous aidera à créer vos propres entités dessinables (les _tableaux de vertex_).

Bien que ces entités partagent pas mal d'attributs communs, elles ont chacune leurs spécificités et méritent leur propre tutoriel :

- [Tutoriel sur les sprites](https://www.sfml-dev.org/tutorials/2.6/graphics-sprite-fr.php "Apprenez à créer et dessiner des sprites")
- [Tutoriel sur le texte](https://www.sfml-dev.org/tutorials/2.6/graphics-text-fr.php "Apprenez à créer et dessiner du texte")
- [Tutoriel sur les formes](https://www.sfml-dev.org/tutorials/2.6/graphics-shape-fr.php "Apprenez à créer et dessiner des formes")
- [Tutoriel sur les tableaux de vertex](https://www.sfml-dev.org/tutorials/2.6/graphics-vertex-array-fr.php "Apprenez à créer et dessiner des tableaux de vertex")

## [Dessin hors-écran](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#dessin-hors-cecran)[](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#top "Haut de la page")

SFML fournit aussi un moyen de dessiner sur une texture plutôt que directement sur la fenêtre. Pour ce faire, il faut utiliser la classe [`sf::RenderTexture`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderTexture.php "sf::RenderTexture documentation") au lieu de [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"). Elle possède les mêmes fonctions de dessin, héritées de leur base commune [`sf::RenderTarget`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderTarget.php "sf::RenderTarget documentation").

```
// on crée une texture de dessin de 500x500
sf::RenderTexture renderTexture;
if (!renderTexture.create(500, 500))
{
    // erreur...
}

// pour dessiner, on utilise les mêmes fonctions
renderTexture.clear();
renderTexture.draw(sprite); // ou n'importe quel autre objet dessinable
renderTexture.display();

// on récupère la texture (sur laquelle on vient de dessiner)
const sf::Texture& texture = renderTexture.getTexture();

// on la dessine dans la fenêtre
sf::Sprite sprite(texture);
window.draw(sprite);
```

La fonction `getTexture` renvoie une texture en lecture seule, ce qui signifie que vous ne pouvez que l'utiliser, pas la modifier. Si vous avez besoin de la manipuler avant de l'utiliser, vous pouvez la copier dans votre propre instance de [`sf::Texture`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Texture.php "sf::Texture documentation").

[`sf::RenderTexture`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderTexture.php "sf::RenderTexture documentation") déclare les mêmes fonctions que [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") pour gérer les vues et OpenGL (voir les tutoriels correspondant pour plus de détails). Si vous utilisez OpenGL pour dessiner sur une texture, vous pouvez activer un tampon de profondeur (_depth buffer_) en utilisant le troisième paramètre optionnel de la fonction `create`.

```
renderTexture.create(500, 500, true); // activation du tampon de profondeur
```

## [Dessiner depuis un thread](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#dessiner-depuis-un-thread)[](https://www.sfml-dev.org/tutorials/2.6/graphics-draw-fr.php#top "Haut de la page")

SFML supporte le rendu multi-threadé, et vous n'avez même pas besoin de faire quoique ce soit pour que cela fonctionne. La seule chose à se rappeler est de désactiver une fenêtre avant de l'utiliser dans un autre thread ; une fenêtre (plus précisément son contexte OpenGL) ne peut en effet pas être active dans plusieurs threads en même temps.

```
void renderingThread(sf::RenderWindow* window)
{
    // activation du contexte de la fenêtre
    window->setActive(true);
    
    // la boucle de rendu
    while (window->isOpen())
    {
        // dessin...

        // fin de la frame
        window->display();
    }
}

int main()
{
    // création de la fenêtre
    // (rappelez-vous : il est plus prudent de le faire dans le thread principal à cause des limitations de l'OS)
    sf::RenderWindow window(sf::VideoMode(800, 600), "OpenGL");

    // désactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de dessin
    sf::Thread thread(&renderingThread, &window);
    thread.launch();

    // la boucle d'évènements/logique/ce que vous voulez...
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
```

Comme vous pouvez le voir, vous n'avez même pas besoin d'activer la fenêtre dans le thread de dessin, SFML le fait automatiquement pour vous dès que nécessaire.

Souvenez-vous : il faut toujours créer la fenêtre et gérer ses évènements dans le thread principal, pour un maximum de portabilité, comme expliqué dans le [tutoriel sur les fenêtres](https://www.sfml-dev.org/tutorials/2.6/window-window.php "Tutoriel sur les fenêtres").