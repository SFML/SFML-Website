# Utiliser les vues

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/graphics/view/).

## Introduction

Dans ce tutoriel, vous allez apprendre à utiliser les vues 2D de SFML. Les vues sont comme des caméras 2D, qui permettent de se déplacer, zoomer ou faire défiler sans avoir à bouger ou redimensionner tous les objets de la scène.

## Définir une nouvelle vue

Les vues sont définies par la classe [`sf::View`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1View.php "sf::View documentation"), qui n'est basiquement qu'un rectangle 2D enrobé dans une interface style caméra.

Une vue peut être créée soit à partir d'un centre et d'une demi-taille, soit directement à partir d'un rectangle englobant :

```cpp
sf::Vector2f Center(1000, 1000);
sf::Vector2f HalfSize(400, 300);
sf::View View1(Center, HalfSize);

// Ou

sf::View View2(sf::FloatRect(600, 700, 1400, 1300));
```

Tous ces paramètres peuvent être lus et modifiés à n'importe quel moment en utilisant les accesseurs prévus à cet effet :

```cpp
View.SetCenter(500, 300);
View.SetHalfSize(200, 100);

// Ou

View.SetFromRect(sf::FloatRect(300, 200, 700, 400));
```

```cpp
sf::Vector2f  Center    = View.GetCenter();
sf::Vector2f  HalfSize  = View.GetHalfSize();
sf::FloatRect Rectangle = View.GetRect();
```

En plus de ça, il existe deux fonctions pratiques pour faire défiler (déplacer) ou zoomer (redimensionner) la vue :

```cpp
View.Move(10, -5); // Déplace la vue de (10, -5) unités
View.Zoom(0.5f);   // Zoome d'un facteur 1/2 (ie. dézoome pour rendre la vue 2x plus large)
```

Comme vous pouvez le voir il n'y a rien de compliqué ici, seulement quelques fonctions pour contrôler la position et la taille de la vue.

## Utiliser une vue

Afin d'utiliser une vue, vous devez appeler la fonction `SetView` de la classe [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") :

```cpp
// Utilise notre vue perso
App.SetView(View);
```

Tout objet dessiné après l'appel à `SetView` (et avant le prochain) sera affecté par la vue.  
Une fois mise en place, la fenêtre garde un lien vers la vue courante ; ainsi vous pouvez mettre à jour celle-ci sans avoir à rappeler `SetView`, vos changements seront appliqués automatiquement.

Chaque fenêtre de rendu possède une vue par défaut, toujours dimensionnée à la taille initiale de sa fenêtre. Vous pouvez accéder à cette vue, voire même la modifier, via la fonction `GetDefaultView` :

```cpp
sf::View& DefaultView = App.GetDefaultView();
```

La vue par défaut n'est pas mise à jour lorsque sa fenêtre est redimensionnée : en conséquence, ce qui est visible dans votre fenêtre ne sera jamais affecté par la taille de celle-ci (ie. vous ne verrez pas plus en agrandissant la fenêtre), ce qui est exactement ce qui se passe avec une caméra 3D classique.  
Ceci-dit, vous pouvez tout de même facilement mettre en place une vue qui garderait toujours les mêmes dimensions que sa fenêtre, en surveillant l'évènement `sf::Event::Resized` et en ajustant la vue en conséquence.

Accéder à la vue par défaut peut également être utile pour revenir à la vue initiale. Par exemple, cela peut être pratique si vous souhaitez dessiner une interface utilisateur par dessus le jeu, cette première ne suivant habituellement pas la caméra.

```cpp
App.SetView(View);

// Afficher le jeu...

App.SetView(App.GetDefaultView());

// Afficher l'interface...
```

## Coordonnées fenêtre, coordonnées vue

Lorsqu'une vue personnalisée est utilisée, ou lorsque votre fenêtre a été redimensionnée, n'oubliez pas que les coordonnées des objets ne correspondent plus avec les pixels de la fenêtre ; prenez donc garde à gérer correctement les différentes conversions nécessaires (par exemple, lorsque vous testez la position de la souris par rapport aux rectangles des sprites). Rappelez vous toujours que ce que vous voyez est le rectangle de la vue, pas celui de la fenêtre.

Si vous souhaitez convertir des coordonnées fenêtre en coordonnées vue, probablement après un clic souris, vous pouvez utiliser la fonction `RenderWindow::ConvertCoords` :

```cpp
// Convertit la position du curseur en coordonnées vue
sf::Vector2f MousePos = App.ConvertCoords(App.GetInput().GetMouseX(), App.GetInput().GetMouseY());
```

Par défaut, cette fonction utilise la vue courante de la fenêtre pour effectuer la conversion. Cependant, vous pouvez utiliser n'importe quelle autre vue en passant son adresse en troisième paramètre (qui vaut donc `NULL` par défaut).

## Conclusion

Les vues 2D fournissent un moyen facile et pratique de gérer des effets tels que le défilement ou le zoom, avec aucun impact sur les performances. La seule chose à garder en tête lorsque vous utilisez les vues, est la possibilité d'avoir à effectuer des conversions si vous devez faire correspondre des pixels fenêtre à des coordonnées de votre scène.
