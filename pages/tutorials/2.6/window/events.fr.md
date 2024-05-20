# Les évènements expliqués

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Ce tutoriel fournit une liste détaillée des évènements des fenêtres. Il les décrit, et montre comment (et comment ne pas) les utiliser.

## [Le type sf::Event](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#le-type-sfevent)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Avant de s'intéresser aux évènements, il est important de comprendre ce qu'est le type [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation"), et comment l'utiliser correctement. [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation") est une _union_, ce qui signifie qu'un seul de ses membres est valide à tout moment (souvenez-vous de vos cours de C++ : tous les membres d'une union partagent le même espace mémoire). Le membre valide est celui qui correspond au type de l'évènement, par exemple `event.key` pour un évènement de type `KeyPressed`. Essayer de lire n'importe quel autre membre provoquera un comportement indéterminé (probablement des valeurs aléatoires ou invalides). Donc, n'essayez jamais d'utiliser un membre d'évènement qui ne correspond pas à son type.

Les instances de [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation") sont remplies par la fonction `pollEvent` (ou `waitEvent`) de la classe [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation"). Il n'y a que ces fonctions qui peuvent produire des évènements valides, toute tentative d'utiliser un [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation") sans qu'il provienne d'un appel valide à `pollEvent` (ou `waitEvent`) produira le même genre de comportement indéterminé qu'expliqué plus haut.

En clair, voici à quoi ressemble une boucle d'évènements typique :

```
sf::Event event;

// tant qu'il y a des évènements à traiter...
while (window.pollEvent(event))
{
    // on regarde le type de l'évènement...
    switch (event.type)
    {
        // fenêtre fermée
        case sf::Event::Closed:
            window.close();
            break;

        // touche pressée
        case sf::Event::KeyPressed:
            ...
            break;

        // on ne traite pas les autres types d'évènements
        default:
            break;
    }
}
```

Relisez bien les paragraphes ci-dessus et assurez-vous que ça reste bien gravé dans votre tête, l'union [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation") cause de trop nombreux problèmes aux programmeurs inattentifs.

Ok, maintenant nous pouvons voir quels évènements SFML supporte, ce qu'ils signifient et comment les utiliser comme il faut.

## [L'évènement Closed](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-closed)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L'évènement `sf::Event::Closed` est déclenché lorsque l'utilisateur veut fermer la fenêtre, par tous les moyens possibles fournis par l'OS (bouton "fermer", raccourci clavier, etc.). Cet évènement n'est qu'une demande de fermeture, la fenêtre n'est pas physiquement fermée.

Un code typique va simplement appeler `window.close()` en réaction à cet évènement, afin de réellement fermer la fenêtre. Mais parfois vous voudrez peut-être faire quelque chose avant, comme sauvegarder l'état actuel de l'application ou bien demander à l'utilisateur quoi faire. Si vous ne faites rien du tout, la fenêtre reste ouverte.

Il n'y a aucun membre associé à cet évènement dans l'union [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation").

```
if (event.type == sf::Event::Closed)
    window.close();
```

## [L'évènement Resized](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-resized)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L'évènement `sf::Event::Resized` est déclenché lorsque la fenêtre est redimensionnée, que ce soit par l'utilisateur ou bien programmatiquement avec `window.setSize`.

Vous pouvez utiliser cet évènement pour ajuster les propriétés de rendu : le viewport si vous utilisez OpenGL directement, ou la vue courante si vous utilisez sfml-graphics.

Le membre associé à cet évènement est `event.size`, il contient la nouvelle taille de la fenêtre.

```
if (event.type == sf::Event::Resized)
{
    std::cout << "new width: " << event.size.width << std::endl;
    std::cout << "new height: " << event.size.height << std::endl;
}
```

## [Les évènements LostFocus et GainedFocus](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-lostfocus-et-gainedfocus)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::LostFocus` et `sf::Event::GainedFocus` sont déclenchés lorsque la fenêtre gagne ou perd le focus, ce qui arrive lorsque l'utilisateur change de fenêtre active. Lorsque la fenêtre n'a pas le focus, elle ne reçoit plus d'évènement clavier.

Cet évènement peut être utilisé si vous voulez mettre en pause le jeu lorsque la fenêtre est inactive, par exemple.

Il n'y a aucun membre associé à ces évènements dans l'union [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation").

```
if (event.type == sf::Event::LostFocus)
    myGame.pause();

if (event.type == sf::Event::GainedFocus)
    myGame.resume();
```

## [L'évènement TextEntered](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-textentered)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L'évènement `sf::Event::TextEntered` est déclenché lorsqu'un caractère est entré. Il ne doit pas être confondu avec l'évènement `KeyPressed` : `TextEntered` interprète les entrées utilisateur et produit les caractères affichables correspondant. Par exemple, appuyer sur '^' puis 'e' sur un clavier français produira deux évènements `KeyPressed`, mais un seul évènement `TextEntered` contenant le caractère 'ê'. Et cela marche avec tous les moyens d'entrer des caractères fournis par l'OS, y compris les plus spécifiques ou les plus complexes.

Cet évènement est typiquement utilisé pour chopper les entrées utilisateur dans un champ de texte.

Le membre associé à cet évènement est `event.text`, il contient la valeur Unicode du caractère entré. Vous pouvez soit l'ajouter directement à un [`sf::String`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1String.php "sf::String documentation"), ou bien le convertir en `char` après vous être assuré qu'il est bien dans la plage ASCII (0 - 127).

```
if (event.type == sf::Event::TextEntered)
{
    if (event.text.unicode < 128)
        std::cout << "ASCII character typed: " << static_cast<char>(event.text.unicode) << std::endl;
}
```

Notez que, étant donné qu'ils font parti du standard Unicode, quelques caractères non-affichables tels que _backspace_ sont générés par cet évènement. Dans la plupart des cas vous devrez donc les filtrer.

Beaucoup de développeurs utilisent l'évènement `KeyPressed` pour traiter le texte entré par l'utilisateur, et s'embarquent dans des algorithmes chiadés qui essayent d'interpréter toutes les combinaisons possibles de touches qui peuvent produire des caractères valides. Ne faites surtout pas ça !

## [Les évènements KeyPressed et KeyReleased](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-keypressed-et-keyreleased)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::KeyPressed` et `sf::Event::KeyReleased` sont déclenchés lorsqu'une touche du clavier est pressée/relâchée.

Si une touche est maintenue, des évènements `KeyPressed` seront générés en continu, selon le délai par défaut de l'OS (ie. le même délai qui s'applique lorsque vous maintenez une lettre dans un éditeur de texte). Pour désactiver la répétition des évènements `KeyPressed`, vous pouvez appeler `window.setKeyRepeatEnabled(false)`. Par contre, de manière assez évidente, les évènements `KeyReleased` ne peuvent quant à eux pas être répétés.

Cet évènement est celui qu'il faut utiliser si vous voulez déclencher une action ponctuelle au moment où une touche est appuyée ou relâchée, comme faire sauter un personnage avec la touche espace, ou bien quitter quelque chose avec la touche échap.

Parfois, les gens essayent de réagir directement à l'évènement `KeyPressed` pour créer des mouvements continus. Or, cela ne produira pas des mouvements continus mais plutôt _saccadés_ : lorsque vous maintenez une touche vous n'obtenez en effet que quelques évènements (souvenez-vous du délai de répétition). Afin d'obtenir des mouvements fluides avec les évènements, vous devez utiliser un booléen mis à `true` lors de l'évènement `KeyPressed` et à `false` lors de l'évènement `KeyReleased` ; vous pouvez ensuite effectuer des déplacements (indépendamment des évènements) tant que le booléen est à `true`.  
L'autre solution (plus simple) pour produire des mouvements continus est d'utiliser les entrées temps réel avec [`sf::Keyboard`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Keyboard.php "sf::Keyboard documentation") (voir le [tutoriel dédié](https://www.sfml-dev.org/tutorials/2.6/window-inputs-fr.php "Tutoriel sur les entrées temps-réel")).

Le membre associé à ces évènements est `event.key`, il contient le scancode et le code de touche de la touche pressée/relâchée, ainsi que l'état des touches spéciales (alt, control, shift, system) au moment de l'appui.

Les scancodes sont des valeurs uniques pour chaque touche physique d'un clavier, quelle que soit la langue ou la disposition, tandis que les codes de touches représentent les touches en fonction de la disposition choisie par l'utilisateur. Par exemple, la touche Z se trouve dans la rangée inférieure à gauche de la touche X sur un clavier américain. En se référant au scancode pour Z, on peut identifier l'emplacement physique de cette touche sur n'importe quel clavier. Cependant, sur un clavier allemand, la même touche physique est étiquetée Y. Ainsi, l'utilisation du code de la touche Y peut conduire à des emplacements de touches physiques différents, en fonction de la disposition choisie.

Il est fortement recommandé d'utiliser des scancodes plutôt que des codes de touches si l'emplacement physique des touches est plus important que les valeurs des touches qui dépendent de la disposition du clavier, comme l'utilisation des touches WASD pour les déplacements.

```
if (event.type == sf::Event::KeyPressed)
{
    if (event.key.scancode == sf::Keyboard::Scan::Escape)
    {
        std::cout << "the escape key was pressed" << std::endl;
        std::cout << "scancode: " << event.key.scancode << std::endl;
        std::cout << "code: " << event.key.code << std::endl;
        std::cout << "control: " << event.key.control << std::endl;
        std::cout << "alt: " << event.key.alt << std::endl;
        std::cout << "shift: " << event.key.shift << std::endl;
        std::cout << "system: " << event.key.system << std::endl;
        std::cout << "description: " << sf::Keyboard::getDescription(event.key.scancode).toAnsiString() << std::endl;
        std::cout << "localize: " << sf::Keyboard::localize(event.key.scancode) << std::endl;
        std::cout << "delocalize: " << sf::Keyboard::delocalize(event.key.code) << std::endl;
    }
}
```

Attention : certaines touches ont un sens particulier pour l'OS, et produisent des résultats inattendus. Par exemple la touche F10 qui, sous Windows, "vole" le focus, ou bien encore la touche F12 qui démarre le debugger sous Visual Studio.

## [L'évènement MouseWheelMoved](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-mousewheelmoved)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L’évènement `sf::Event::MouseWheelMoved` est **déprécié** depuis SFML 2.3, utilisez l'évènement MouseWheelScrolled à la place.

## [L'évènement MouseWheelScrolled](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-mousewheelscrolled)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L’évènement `sf::Event::MouseWheelScrolled` est déclenché lorsque la molette souris défile vers le haut ou le bas, mais aussi latéralement si cette dernière le supporte.

Le membre associé à cet évènement est `event.mouseWheelScroll`, il contient le nombre de "ticks" duquel la molette a bougé, la position actuelle de la souris, ainsi que l'orientation du mouvement de la molette.

```
if (event.type == sf::Event::MouseWheelScrolled)
{
    if (event.mouseWheelScroll.wheel == sf::Mouse::VerticalWheel)
        std::cout << "wheel type: vertical" << std::endl;
    else if (event.mouseWheelScroll.wheel == sf::Mouse::HorizontalWheel)
        std::cout << "wheel type: horizontal" << std::endl;
    else
        std::cout << "wheel type: unknown" << std::endl;
    std::cout << "wheel movement: " << event.mouseWheelScroll.delta << std::endl;
    std::cout << "mouse x: " << event.mouseWheelScroll.x << std::endl;
    std::cout << "mouse y: " << event.mouseWheelScroll.y << std::endl;
}
```

## [Les évènements MouseButtonPressed et MouseButtonReleased](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-mousebuttonpressed-et-mousebuttonreleased)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::MouseButtonPressed` et `sf::Event::MouseButtonReleased` sont déclenchés lorsqu'un bouton souris est pressé/relâché.

SFML supporte 5 boutons souris : gauche, droit, milieu (molette), extra 1 et extra 2 (boutons supplémentaires sur les côtés).

Le membre associé à ces évènements est `event.mouseButton`, il contient le code du bouton pressé/relâché, ainsi que la position actuelle de la souris.

```
if (event.type == sf::Event::MouseButtonPressed)
{
    if (event.mouseButton.button == sf::Mouse::Right)
    {
        std::cout << "the right button was pressed" << std::endl;
        std::cout << "mouse x: " << event.mouseButton.x << std::endl;
        std::cout << "mouse y: " << event.mouseButton.y << std::endl;
    }
}
```

## [L'évènement MouseMoved](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-mousemoved)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L'évènement `sf::Event::MouseMoved` est déclenché lorsque la souris bouge dans la fenêtre.

Cet évènement est déclenché même si la fenêtre n'a pas le focus. Cependant, il est déclenché uniquement lorsque la souris se trouve dans la zone interne de la fenêtre, pas quand elle bouge au-dessus de la barre de titre ou des bordures.

Le membre associé à cet évènement est `event.mouseMove`, il contient la position actuelle de la souris relativement à la fenêtre.

```
if (event.type == sf::Event::MouseMoved)
{
    std::cout << "new mouse x: " << event.mouseMove.x << std::endl;
    std::cout << "new mouse y: " << event.mouseMove.y << std::endl;
}
```

## [Les évènements MouseEntered et MouseLeft](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-mouseentered-et-mouseleft)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::MouseEntered` et `sf::Event::MouseLeft` sont déclenchés lorsque la souris entre ou quitte la fenêtre.

Il n'y a pas de membre associé à ces évènements dans l'union [`sf::Event`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Event.php "sf::Event documentation").

```
if (event.type == sf::Event::MouseEntered)
    std::cout << "the mouse cursor has entered the window" << std::endl;

if (event.type == sf::Event::MouseLeft)
    std::cout << "the mouse cursor has left the window" << std::endl;
```

## [Les évènements JoystickButtonPressed et JoystickButtonReleased](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-joystickbuttonpressed-et-joystickbuttonreleased)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::JoystickButtonPressed` et `sf::Event::JoystickButtonReleased` sont déclenchés lorsqu'un bouton de joystick est pressé/relâché.

SFML supporte jusqu'à 8 joysticks et 32 boutons.

Le membre associé à ces évènements est `event.joystickButton`, il contient l'identificateur du joystick et le numéro du bouton pressé/relâché.

```
if (event.type == sf::Event::JoystickButtonPressed)
{
    std::cout << "joystick button pressed!" << std::endl;
    std::cout << "joystick id: " << event.joystickButton.joystickId << std::endl;
    std::cout << "button: " << event.joystickButton.button << std::endl;
}
```

## [L'évènement JoystickMoved](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#lcevcinement-joystickmoved)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

L'évènement `sf::Event::JoystickMoved` est déclenché lorsqu'un axe de joystick bouge.

Les axes de joysticks sont typiquement très sensibles, c'est pourquoi SFML utilise un seuil de détection pour éviter de polluer la boucle d'évènements avec des tonnes de `JoystickMoved`. Ce seuil peut être ajusté avec la fonction `Window::setJoystickThreshold`, au cas où vous voudriez recevoir plus ou moins de ces évènements.

SFML supporte 8 axes de joystick: X, Y, Z, R, U, V, POV X et POV Y. Ce à quoi ils correspondent sur votre joystick dépend de son driver.

Le membre associé à cet évènement est `event.joystickMove`, il contient l'identificateur du joystick, le nom de l'axe, et sa position actuelle (entre -100 et 100).

```
if (event.type == sf::Event::JoystickMoved)
{
    if (event.joystickMove.axis == sf::Joystick::X)
    {
        std::cout << "X axis moved!" << std::endl;
        std::cout << "joystick id: " << event.joystickMove.joystickId << std::endl;
        std::cout << "new position: " << event.joystickMove.position << std::endl;
    }
}
```

## [Les évènements JoystickConnected et JoystickDisconnected](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#les-cevcinements-joystickconnected-et-joystickdisconnected)[](https://www.sfml-dev.org/tutorials/2.6/window-events-fr.php#top "Haut de la page")

Les évènements `sf::Event::JoystickConnected` et `sf::Event::JoystickDisconnected` sont déclenchés lorsqu'un joystick est connecté/déconnecté.

Le membre associé à ces évènement est `event.joystickConnect`, il contient l'identificateur du joystick connecté/déconnecté.

```
if (event.type == sf::Event::JoystickConnected)
    std::cout << "joystick connected: " << event.joystickConnect.joystickId << std::endl;

if (event.type == sf::Event::JoystickDisconnected)
    std::cout << "joystick disconnected: " << event.joystickConnect.joystickId << std::endl;
```