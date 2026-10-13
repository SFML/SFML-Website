# Gérer les évènements

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/window/events/).

## Introduction

Dans le tutoriel précédent, nous avons appris à ouvrir une fenêtre mais nous n'avions aucun moyen de stopper l'application. Ici, nous allons apprendre à intercepter les évènements d'une fenêtre et à les gérer correctement.

## Récupérer les évènements

Typiquement, il existe deux façons de récupérer les évènements dans un système de fenêtrage :

- Vous pouvez demander à la fenêtre de vous donner les évènements en attente à chaque boucle ; c'est ce qu'on appelle le *polling*
- Vous pouvez transmettre à la fenêtre un pointeur de fonction, et attendre que la fenêtre appelle votre fonction lorsqu'elle génère un évènement ; c'est ce qu'on appelle les fonctions de rappel ("callbacks")

SFML utilise un système de *polling* pour récupérer les évènements. Ainsi, vous devez récupérer les évènements en attente à chaque boucle. La fonction à utiliser est `GetEvent`, qui remplira une instance de [`sf::Event`](../../../documentation/1.6/classsf_1_1Event.html "sf::Event documentation") et renverra `true` s'il y avait un évènement en attente, ou renverra `false` si la pile d'évènements était vide.

```cpp
// Rappelez-vous que App est une instance de sf::Window

sf::Event Event;
if (App.GetEvent(Event))
{
    // Traitement de l'évènement
}
```

Mais il peut y avoir plus d'un évènement en attente à chaque boucle (les évènements sont stockés dans une pile à chaque boucle, et récupérer un évènement retire le premier élément de cette pile), et si vous n'en récupérez qu'un, les évènements peuvent s'accumuler et ne jamais être traités.  
La façon de faire correcte pour récupérer tous les évènements à chaque boucle, est de boucler jusqu'à ce qu'il n'y en n'ait plus en attente :

```cpp
sf::Event Event;
while (App.GetEvent(Event))
{
    // Traitement de l'évènement
}
```

"Eh, mais attendez une minute... où est-ce que je dois placer ce morceau de code, au fait ?".  
Comme les évènements doivent être traités à chaque tour de boucle, il est conseillé de placer la gestion des évènements au début de la boucle principale :

```cpp
while (Running)
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Traitement de l'évènement
    }

    App.Display();
}
```

## Traitement des évènements

La première chose à faire lorsque vous recevez un évènement est d'interroger son type, stocké dans sa variable membre `Type`. SFML définit les types d'évènements suivant, tous dans la portée de la structure [`sf::Event`](../../../documentation/1.6/classsf_1_1Event.html "sf::Event documentation") :

- `Closed`
- `Resized`
- `LostFocus`
- `GainedFocus`
- `TextEntered`
- `KeyPressed`
- `KeyReleased`
- `MouseWheelMoved`
- `MouseButtonPressed`
- `MouseButtonReleased`
- `MouseMoved`
- `MouseEntered`
- `MouseLeft`
- `JoyButtonPressed`
- `JoyButtonReleased`
- `JoyMoved`

Selon le type d'évènement, l'instance d'évènement sera remplie avec différents paramètres :

- Evènements de taille (`Resized`)
    - `Event.Size.Width` contient la nouvelle largeur de la fenêtre, en pixels
    - `Event.Size.Height` contient la nouvelle hauteur de la fenêtre, en pixels
- Evènements texte (`TextEntered`)
    - `Event.Text.Unicode` contient le code UTF-32 du caractère qui vient d'être entré
- Evènements clavier (`KeyPressed, KeyReleased`)
    - `Event.Key.Code` contient le code de la touche qui a été appuyée / relâchée
    - `Event.Key.Alt` indique si la touche Alt est enfoncée ou non
    - `Event.Key.Control` indique si la touche Control est enfoncée ou non
    - `Event.Key.Shift` indique si la touche Shift est enfoncée ou non
- Evènements boutons souris (`MouseButtonPressed, MouseButtonReleased`)
    - `Event.MouseButton.Button` contient le bouton qui a été appuyé / relâché
    - `Event.MouseButton.X` contient la position X actuelle de la souris
    - `Event.MouseButton.Y` contient la position Y actuelle de la souris
- Evènements mouvement souris (`MouseMoved`)
    - `Event.MouseMove.X` contient la nouvelle position X de la souris
    - `Event.MouseMove.Y` contient la nouvelle position Y de la souris
- Evènements molette souris (`MouseWheelMoved`)
    - `Event.MouseWheel.Delta` contient la valeur du déplacement de la molette (positif si en avant, négatif si en arrière)
- Evènements boutons joystick (`JoyButtonPressed, JoyButtonReleased`)
    - `Event.JoyButton.JoystickId` contient l'identificateur du joystick concerné (0 ou 1)
    - `Event.JoyButton.Button` contient l'indice du bouton qui a été appuyé / relâché, entre 0 et 15
- Evènements mouvement joystick (`JoyMoved`)
    - `Event.JoyMove.JoystickId` contient l'identificateur du joystick concerné (0 ou 1)
    - `Event.JoyMove.Axis` contient l'axe sur lequel s'est produit le mouvement
    - `Event.JoyMove.Position` contient la position actuelle du joystick sur l'axe, entre -100 et 100 (sauf pour le POV, qui est entre 0 et 360)

Les codes de touches sont spécifiques à SFML. Chaque touche est associée à une constante, définie dans Events.hpp. Par exemple, la touche F5 est définie par la constante `sf::Key::F5`. Pour les lettres et les chiffres la constante associée correspond au code ASCII, ce qui signifie que `'a'` et `sf::Key::A` correspondent tous deux à la touche 'A'.

Les codes des boutons de la souris suivent la même règle. Cinq constantes sont définies : `sf::Mouse::Left`, `sf::Mouse::Right`, `sf::Mouse::Middle` (le bouton de la molette), `sf::Mouse::XButton1`, et `sf::Mouse::XButton2`.

Enfin, les axes des joysticks sont définis de la manière suivante : `sf::Joy::AxisX`, `sf::Joy::AxisY`, `sf::Joy::AxisZ`, `sf::Joy::AxisR`, `sf::Joy::AxisU`, `sf::Joy::AxisV`, et `sf::Joy::AxisPOV`.

Donc... revenons à notre application, et ajoutons un peu de code pour gérer les évènements. Nous allons ajouter quelque chose pour arrêter l'application lorsque l'utilisateur ferme la fenêtre, ou lorsqu'il appuie sur echap :

```cpp
sf::Event Event;
while (App.GetEvent(Event))
{
    // Fenêtre fermée
    if (Event.Type == sf::Event::Closed)
        Running = false;

    // Touche 'echap' appuyée
    if ((Event.Type == sf::Event::KeyPressed) && (Event.Key.Code == sf::Key::Escape))
        Running = false;
}
```

## Fermer une fenêtre

Si vous avez joué un peu avec les fenêtres SFML, vous avez probablement remarqué que cliquer sur le bouton de fermeture générait un évènement `Closed`, mais ne détruisait pas la fenêtre. C'est pour laisser l'occasion à l'utilisateur d'ajouter des traitements avant la femeture (demander de sauvegarder), ou bien carrément d'annuler celle-ci. Pour fermer effectivement une fenêtre, vous devrez soit détruire l'instance de [`sf::Window`](../../../documentation/1.6/classsf_1_1Window.html "sf::Window documentation"), soit appeler sa fonction `Close()`.  
Pour savoir si une fenêtre est ouverte (ie. a été créée), vous pouvez appeler la fonction `IsOpened()`.

Maintenant, notre boucle principale a l'air vachement plus sympa :

```cpp
while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Fenêtre fermée
        if (Event.Type == sf::Event::Closed)
            App.Close();

        // Touche 'echap' appuyée
        if ((Event.Type == sf::Event::KeyPressed) && (Event.Key.Code == sf::Key::Escape))
            App.Close();
    }
}
```

## Récupérer les entrées temps-réel

Ce système d'évènements est suffisant pour réagir à des évènements comme la fermeture de fenêtre, ou une pression simple sur une touche. Mais si vous voulez gérer, par exemple, le mouvement continu d'un personnage lorsque vous maintenez une flèche enfoncée, alors vous allez vite vous rendre compte qu'il y a un problème : un délai sera introduit entre chaque mouvement, le délai défini par le système d'exploitation lorsque vous maintenez une touche enfoncée.

Une meilleure stratégie pour cela est de marquer une variable booléene à `true` lorsque la touche est enfoncée, et la remettre à zéro lorsque la touche est relâchée. Puis à chaque tour de boucle, si le booléen est marqué, vous déplacez votre personnage. Cependant l'usage de variables supplémentaires pour ça peut devenir fastidieux, particulièrement lorsque vous en avez beaucoup. C'est pourquoi SFML fournit un accès facilité aux entrées temps-réel, avec la classe [`sf::Input`](../../../documentation/1.6/classsf_1_1Input.html "sf::Input documentation").

Les instances de [`sf::Input`](../../../documentation/1.6/classsf_1_1Input.html "sf::Input documentation") ne peuvent pas vivre seules, elles doivent être attachées à une fenêtre. En fait, chaque [`sf::Window`](../../../documentation/1.6/classsf_1_1Window.html "sf::Window documentation") gère sa propre instance de [`sf::Input`](../../../documentation/1.6/classsf_1_1Input.html "sf::Input documentation"), que vous n'avez plus qu'à récupérer lorsque vous le souhaitez. Obtenir une référence vers l'entrée associée à une fenêtre s'effectue par la fonction `GetInput` :

```cpp
const sf::Input& Input = App.GetInput();
```

Ensuite, vous pouvez utiliser l'instance de [`sf::Input`](../../../documentation/1.6/classsf_1_1Input.html "sf::Input documentation") pour récupérer l'état du clavier, de la souris et des joysticks à n'importe quel moment :

```cpp
bool         LeftKeyDown     = Input.IsKeyDown(sf::Key::Left);
bool         RightButtonDown = Input.IsMouseButtonDown(sf::Mouse::Right);
bool         Joy0Button1Down = Input.IsJoystickButtonDown(0, 1);
unsigned int MouseX          = Input.GetMouseX();
unsigned int MouseY          = Input.GetMouseY();
float        Joystick1X      = Input.GetJoystickAxis(1, sf::Joy::AxisX);
float        Joystick1Y      = Input.GetJoystickAxis(1, sf::Joy::AxisY);
float        Joystick1POV    = Input.GetJoystickAxis(1, sf::Joy::AxisPOV);
```

## Conclusion

Dans ce tutoriel vous avez appris à gérer les entrées, et à obtenir l'état du clavier et de la souris en temps réel. Mais pour construire une application temps-réel, vous devez gérer correctement un autre aspect : le temps. Allons donc jeter un oeil à un rapide tutoriel concernant la [gestion du temps](time.md "Prochain tutoriel : gestion du temps") avec SFML !
