# Dessiner des formes simples

## Introduction

Ce nouveau tutoriel va vous apprendre à dessiner des formes 2D simples telles que des lignes, des rectangles, des cercles ou encore des polygones avec SFML.

## Construire des formes quelconque

Pour construire une forme persos avec SFML, vous devez utiliser la classe [`sf::Shape`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Shape.php "sf::Shape documentation").  
Une forme est basiquement un polygone convexe, dans lequel chaque point a sa propre position et couleur. Il est également possible d'ajouter une bordure automatique à une forme, chaque point pouvant avoir sa propre couleur de bordure. Il est très important de définir les points d'une forme dans l'ordre (sens des aiguilles d'une montre ou inverse, peu importe), sans quoi la forme pourrait être mal-formée. Il est également important de garder la forme convexe, sinon elle pourrait ne pas être rendue correctement. Si vous devez afficher des formes concaves, essayez de les découper en plusieurs sous-formes convexes.

Pour ajouter un point à une forme, utilisez la fonction `AddPoint` :

```cpp
sf::Shape Polygon;
Polygon.AddPoint(0, -50,  sf::Color(255, 0, 0),     sf::Color(0, 128, 128));
Polygon.AddPoint(50, 0,   sf::Color(255, 85, 85),   sf::Color(0, 128, 128));
Polygon.AddPoint(50, 50,  sf::Color(255, 170, 170), sf::Color(0, 128, 128));
Polygon.AddPoint(0, 100,  sf::Color(255, 255, 255), sf::Color(0, 128, 128));
Polygon.AddPoint(-50, 50, sf::Color(255, 170, 170), sf::Color(0, 128, 128));
Polygon.AddPoint(-50, 0,  sf::Color(255, 85, 85),   sf::Color(0, 128, 128));
```

Les paramètres sont les coordonnées X et Y du point, sa couleur et une couleur optionnelle pour la bordure. Notez que vous pouvez également passer un [`sf::Vector2f`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Vector2.php "sf::Vector2f documentation") plutôt que deux floats pour la position du point.

Une fois ajoutés à la forme, les attributs des points (position, couleur et bordure) peuvent être récupérées ou changées individuellement à l'aide des accesseurs suivants :

```cpp
// Récupère les attributs du troisième point
sf::Vector2f Position     = Polygon.GetPointPosition(2);
sf::Color    Color        = Polygon.GetPointColor(2);
sf::Color    OutlineColor = Polygon.GetPointOutlineColor(2);

// Change les attributs du deuxième point
Polygon.SetPointPosition(1, sf::Vector2f(50, 100));
Polygon.SetPointColor(1, sf::Color::Black);
Polygon.SetPointOutlineColor(1, sf::Color(0, 128, 128));
```

Afin de contrôler l'épaisseur de la bordure de l'ensemble de la forme, vous pouvez utiliser la fonction `SetOutlineWidth` :

```cpp
// Définit une bordure d'épaisseur 10
Polygon.SetOutlineWidth(10);
```

Ok parfait, nous avons désormais une forme avec une bordure. Mais que faire si nous voulons juste afficher la bordure sans remplir la forme ? Ou supprimer cette bordure ? Il existe deux fonctions pour activer ou désactiver le remplissage et la bordure :

```cpp
// Désactive le remplissage de la forme
Polygon.EnableFill(false);

// Active l'affichage de sa bordure
Polygon.EnableOutline(true);
```

Comme tout objet affichable dans SFML, les formes héritent de toutes les fonctions habituelles pour définir leur position, rotation, facteur d'échelle, couleur et mode de blending.

```cpp
Polygon.SetColor(sf::Color(255, 255, 255, 200));
Polygon.Move(300, 300);
Polygon.Scale(3, 2);
Polygon.Rotate(45);
```

Enfin, afficher une forme se fait également de la même manière que tous les objets SFML :

```cpp
App.Draw(Polygon);
```

## Formes prédéfinies

SFML fournit des fonctions statiques pour construire facilement des formes simples telles que des lignes, des rectangles et des cercles :

```cpp
sf::Shape Line   = sf::Shape::Line(X1, Y1, X2, Y2, Epaisseur, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Circle = sf::Shape::Circle(X, Y, Rayon, Couleur, [Bordure], [CouleurBordure]);
sf::Shape Rect   = sf::Shape::Rectangle(X1, Y1, X2, Y2, Couleur, [Bordure], [CouleurBordure]);
```

Les valeurs pour l'épaisseur et la couleur de bordure sont optionnelles ; la bordure est désactivée par défaut.

## Conclusion

Avec cette nouvelle classe vous êtes maintenant en mesure de dessiner des rectangles, cercles et polygones quelconques facilement et sans avoir à utiliser une image et un sprite. Regardons maintenant quelque chose de plus excitant : [les vues](views.md "Aller au tutoriel suivant").
