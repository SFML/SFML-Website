# Clavier, souris et joysticks

## Introduction

Ce tutoriel explique comment accéder aux entrées globales : clavier, souris et joysticks. Ces fonctionnalités ne sont en aucun cas à confondre avec les évènements : les entrées temps-réel vous permettent de vérifier l'état courant du clavier, de la souris et des joysticks à n'importe quel moment ("*est-ce que ce bouton est actuellement pressé ?*", "*où se trouve la souris ?*"), alors que les évènements vous préviennent lorsque quelque chose change ("*ce bouton a été pressé*", "*la souris a bougé*").

## Le clavier

La classe qui donne accès à l'état du clavier est [`sf::Keyboard`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Keyboard.php "sf::Keyboard documentation"). Elle contient une unique fonction, `isKeyPressed`, qui donne l'état courant d'une touche (appuyée ou relâchée). C'est une fonction statique, vous n'avez pas besoin d'instancier [`sf::Keyboard`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Keyboard.php "sf::Keyboard documentation") pour l'utiliser.

Cette fonction lit directement l'état du clavier, sans chercher à savoir si votre fenêtre a le focus ou non. Cela signifie que `isKeyPressed` peut renvoyer `true` même si votre fenêtre est inactive.

```cpp
if (sf::Keyboard::isKeyPressed(sf::Keyboard::Left))
{
    // la touche "flèche gauche" est enfoncée : on bouge le personnage
    character.move(1.f, 0.f);
}
```

Les codes de touches sont définis dans l'enum `sf::Keyboard::Key`.

!!! warning

    Certaines touches peuvent manquer, ou être interprétées de manière incorrecte selon votre OS et l'agencement de votre clavier. C'est un aspect qui fera l'objet d'améliorations dans une future version de SFML.

## La souris

La classe qui donne accès à l'état de la souris est [`sf::Mouse`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Mouse.php "sf::Mouse documentation"). Comme son copain [`sf::Keyboard`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Keyboard.php "sf::Keyboard documentation"), elle ne contient que des fonctions statiques et n'est pas censée être instanciée (SFML gère une souris unique pour le moment).

Vous pouvez vérifier si un bouton est pressé :

```cpp
if (sf::Mouse::isButtonPressed(sf::Mouse::Left))
{
    // le bouton gauche est enfoncé : on tire
    gun.fire();
}
```

Les codes de boutons sont définis dans l'enum `sf::Mouse::Button`. SFML supporte jusqu'à 5 boutons : gauche, droit, milieu (molette), plus deux autres boutons peu importe ce qu'ils représentent.

Vous pouvez aussi récupérer ou changer la position courante de la souris, relativement au bureau ou à une fenêtre particulière.

```cpp
// on lit la position globale de la souris (relativement au bureau)
sf::Vector2i globalPosition = sf::Mouse::getPosition();

// on lit la position locale de la souris (relativement à une fenêtre)
sf::Vector2i localPosition = sf::Mouse::getPosition(window); // window est un sf::Window
```

```cpp
// on change la position globale de la souris (relativement au bureau)
sf::Mouse::setPosition(sf::Vector2i(10, 50));

// on change la position locale de la souris (relativement à une fenêtre)
sf::Mouse::setPosition(sf::Vector2i(10, 50), window); // window est un sf::Window
```

Il n'y a pas de fonction pour récupérer l'état de la molette. En effet, celle-ci n'effectue que des mouvements relatifs et n'a pas d'état absolu. En regardant une touche du clavier on peut dire si elle est enfoncée ou relâchée ; en regardant le curseur de la souris on peut dire où il se trouve à l'écran ; mais en regardant la molette de la souris on ne peut pas savoir sur quel "cran" elle se trouve. On peut uniquement savoir quand elle bouge (évènement `MouseWheelScrolled`).

## Les joysticks

La classe qui donne accès à l'état des joysticks est [`sf::Joystick`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Joystick.php "sf::Joystick documentation"). Comme les autres classes de ce tutoriel, elle ne contient que des fonctions statiques.

Les joysticks sont identifiés par leur numéro (de 0 à 7, puisque SFML supporte jusqu'à 8 joysticks). Ainsi, le premier paramètre de toutes les fonctions de [`sf::Joystick`](https://www.sfml-dev.org/documentation/2.5.1-fr/classsf_1_1Joystick.php "sf::Joystick documentation") est le numéro du joystick dont vous voulez lire l'état.

Vous pouvez vérifier si un joystick est connecté ou non :

```cpp
if (sf::Joystick::isConnected(0))
{
    // le joystick numéro 0 est connecté
    ...
}
```

Vous pouvez aussi récupérer les capacités d'un joystick connecté :

```cpp
// combien de boutons le joystick numéro 0 a-t-il ?
unsigned int buttonCount = sf::Joystick::getButtonCount(0);

// est-ce que le joystick numéro 0 possède un axe Z ?
bool hasZ = sf::Joystick::hasAxis(0, sf::Joystick::Z);
```

Les axes de joysticks sont définis dans l'enum `sf::Joystick::Axis`. Etant donné qu'ils n'ont aucune signification particulière, les boutons sont quant à eux simplement numérotés de 0 à 31.

Enfin, vous pouvez bien entendu récupérer l'état des boutons et des axes d'un joystick :

```cpp
// est-ce que le bouton 1 du joystick numéro 0 est enfoncé ?
if (sf::Joystick::isButtonPressed(0, 1))
{
    // oui : on shoot !!
    gun.fire();
}

// quelle est la position actuelle des axes X et Y du joystick numéro 0 ?
float x = sf::Joystick::getAxisPosition(0, sf::Joystick::X);
float y = sf::Joystick::getAxisPosition(0, sf::Joystick::Y);
character.move(x, y);
```

!!! warning

    L'état des joysticks est automatiquement mis à jour par la boucle d'évènements. Si vous n'en avez pas, ou si vous voulez vérifier l'état d'un joystick (par exemple, voir quels joysticks sont connectés) avant de lancer votre boucle de jeu, vous devrez appeler la fonction `sf::Joystick::update()` afin d'être sûr que l'état des joysticks est à jour.
