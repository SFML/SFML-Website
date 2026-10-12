# Ouvrir une fenêtre

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/window/window/).

## Introduction

Dans ce tutoriel, nous allons apprendre à utiliser le module de fenêtrage de la SFML afin d'obtenir un système de fenêtrage minimal, comme SDL ou GLUT permettent de le faire.

## Préparer le code

Premièrement, vous devez inclure l'en-tête nécessaire à l'utilisation du module de fenêtrage :

```cpp
#include <SFML/Window.hpp>
```

Cet en-tête est le seul nécessaire, il se charge d'inclure tous les autres en-têtes du module de fenêtrage. C'est d'ailleurs le cas pour les autres modules : si vous voulez utiliser le module xxx, il vous suffit d'inclure l'en-tête &lt;SFML/xxx.hpp>.

Il vous faut ensuite définir la célèbre fonction `main` :

```cpp
int main()
{
    // Notre code sera placé ici
}
```

Ou bien, si vous voulez récupérer les paramètres de la ligne de commande :

```cpp
int main(int argc, char** argv)
{
    // Notre code sera placé ici
}
```

Sous Windows, vous avez peut-être créé un projet "Application Windows", particulièrement si vous ne souhaitez pas voir apparaître une console. Dans ce cas, plutôt que de remplacer `main` par `WinMain`, vous pouvez lier avec la bibliothèque statique SFML_Main et ainsi garder un point d'entrée `main` portable et standard.

## Créer la fenêtre

L'étape suivante est d'ouvrir une fenêtre. Les fenêtres SFML sont définies par la classe [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation"). Cette classe fournit plusieurs constructeurs utiles pour créer directement votre fenêtre. Celui qui nous intéresse ici est le suivant :

```cpp
sf::Window App(sf::VideoMode(800, 600, 32), "SFML Window");
```

Ici nous créons une nouvelle variable nommée `App`, qui va représenter notre nouvelle fenêtre. Passons en revue les paramètres :

- Le premier paramètre est un [`sf::VideoMode`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1VideoMode.php "sf::VideoMode documentation"), qui représente le mode vidéo choisi pour la fenêtre. Ici, il définit une taille de 800x600 pixels et une profondeur de 32 bits par pixel. Notez bien que la taille spécifiée sera la taille interne de la fenêtre, sans compter donc la barre de titre et les bordures.
- Le second paramètre est le titre de la fenêtre, de type `std::string`

Si vous voulez créer votre fenêtre plus tard ou bien la recréer avec des paramètres différents, vous pouvez utiliser sa fonction `Create` :

```cpp
App.Create(sf::VideoMode(800, 600, 32), "SFML Window");
```

Les constructeurs et les fonctions `Create` acceptent également deux paramètres additionnels optionels, le premier pour avoir plus de contrôle sur le style de la fenêtre, le second pour accéder à des options graphiques plus avancées ; nous reviendrons sur ce dernier dans un prochain tutoriel, en tant que débutant vous n'aurez pas à vous en soucier pour le moment.  
Le paramètre de style peut être une combinaison des options `sf::Style`, à savoir `None`, `Titlebar`, `Resize`, `Close` et `Fullscreen`. Le style par défaut est `Resize | Close`.

```cpp
// Ceci crée une fenêtre plein-écran
App.Create(sf::VideoMode(800, 600, 32), "SFML Window", sf::Style::Fullscreen);
```

## Les modes vidéo

Dans l'exemple ci-dessus, nous ne nous préoccupons pas du mode vidéo parce que notre application s'exécute en mode fenêtré ; n'importe quelle taille fait l'affaire. Mais si nous voulions tourner en plein écran, seuls quelques modes seraient disponibles. [`sf::VideoMode`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1VideoMode.php "sf::VideoMode documentation") fournit une interface pour récupérer tous les modes vidéo supportés, avec les deux fonctions statiques `GetModesCount` et `GetMode` :

```cpp
unsigned int VideoModesCount = sf::VideoMode::GetModesCount();
for (unsigned int i = 0; i < VideoModesCount; ++i)
{
    sf::VideoMode Mode = sf::VideoMode::GetMode(i);

    // Mode est un mode vidéo valide
}
```

Notez que les modes vidéo sont triés du plus haut au plus bas, ainsi `sf::VideoMode::GetMode(0)` renverra toujours le meilleur mode parmi ceux supportés.

```cpp
// Creation d'une fenêtre plein écran avec le meilleur mode vidéo
App.Create(sf::VideoMode::GetMode(0), "SFML Window", sf::Style::Fullscreen);
```

Si vous récupérez les modes vidéo avec le code ci-dessus alors ils seront bien entendu tous valides, mais il existe des cas où l'on récupère un mode vidéo par un autre moyen, à partir d'un fichier de configuration par exemple. Dans de tels cas, il est possible de vérifier la validité d'un mode à l'aide de sa fonction `IsValid()` :

```cpp
sf::VideoMode Mode = ReadModeFromConfigFile();
if (!Mode.IsValid())
{
    // Erreur...
}
```

Vous pouvez également obtenir le mode vidéo du bureau, avec la fonction `GetDesktopMode` :

```cpp
sf::VideoMode DesktopMode = sf::VideoMode::GetDesktopMode();
```

## La boucle principale

Une fois la fenêtre créée, nous pouvons entrer dans la boucle principale :

```cpp
bool Running = true;
while (Running)
{
    App.Display();
}

return EXIT_SUCCESS;
```

Pour terminer la boucle principale et quitter l'application, il suffira donc de passer la variable `Running` à `false`. Cela se fait typiquement lorsque la fenêtre est fermée, ou lorsque l'utilisateur appuie sur une touche spéciale comme echap ; nous verrons comment intercepter ces évènements dans le prochain tutoriel.

Pour le moment, notre boucle principale ne fait qu'un appel à `App.Display()`. C'est en fait le seul appel nécessaire pour afficher le contenu de notre fenêtre à l'écran. L'appel à `Display` doit toujours être unique dans la boucle principale, et être la dernière instruction, une fois que tout le reste a été mis à jour et affiché.  
A ce point du code, vous devriez voir n'importe quoi à l'écran (peut-être un fond noir, peut-être pas) puisque nous n'affichons rien dans notre fenêtre.

Comme vous pouvez le voir, il n'y a pas de code supplémentaire après la boucle principale : notre fenêtre est correctement détruite de manière automatique lorsque la fonction `main` se termine (le ménage est effectué dans le destructeur).  
Pour ceux qui n'utilisent jamais `EXIT_SUCCESS`, il s'agit juste d'une constante valant 0. Pour renvoyer une erreur vous pouvez utiliser sa soeur `EXIT_FAILURE` plutôt que -1.

## Conclusion

Et voilà, avec ce code vous avez un programme minimal mais complet qui ouvre une fenêtre SFML. Mais nous ne pouvons pas encore stopper le programme... Sautons donc au [prochain tutoriel](events.md "Prochain tutoriel : gérer les évènements"), pour voir comment intercepter les évènements !
