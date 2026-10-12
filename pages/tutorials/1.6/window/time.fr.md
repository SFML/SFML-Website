# Gérer le temps

## Introduction

Le temps n'est habituellement pas un gros sujet en soi, mais dans une application temps réel, il est important de le gérer correctement, comme nous allons le voir dans ce nouveau tutoriel.

## Mesurer le temps

Dans la SFML, vous mesurez le temps avec la classe [`sf::Clock`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Clock.php "sf::Clock documentation"). Elle définit deux fonctions : `Reset()`, pour remettre à zéro l'horloge, et `GetElapsedTime()`, pour récupérer le temps écoulé depuis le dernier appel à `Reset()`. Le temps est défini en secondes, comme toutes les durées que vous trouverez dans la SFML.  
Comme vous le voyez, cette classe est loin d'être compliquée.

```cpp
sf::Clock Clock;

while (App.IsOpened())
{
    // Traitement des évènements

    // Récupération du temps écoulé depuis le dernier tour de boucle
    float Time = Clock.GetElapsedTime();
    Clock.Reset();

    // Affichage de la fenêtre
}
```

Récupérer le temps écoulé peut être très utile si vous avez à incrémenter une variable à chaque tour de boucle (une position, une orientation, ...). Si vous ne tenez pas compte du facteur temps, votre simulation ne produira pas les mêmes résultats selon que l'application tourne à 60 images par seconde ou à 1000 images par second. Par exemple, ce bout de code va produire un mouvement dépendant du taux de rafraîchissement :

```cpp
const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed;
}
```

Alors que celui-ci va assurer une vitesse constante quelque soit le matériel :

```cpp
sf::Clock Clock;

const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    float ElapsedTime = Clock.GetElapsedTime();
    Clock.Reset();

    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * ElapsedTime;
}
```

La plupart du temps, vous aurez à mesurer le temps écoulé depuis le dernier rafraîchissement. La classe [`sf::Window`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Window.php "sf::Window documentation") fournit une fonction utile pour récupérer ce temps sans avoir à gérer une horloge : `GetFrameTime()`. Ainsi nous pourrions ré-écrire notre code de la manière suivante :

```cpp
const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * App.GetFrameTime();
}
```

## Mesurer le taux de rafraîchissement (framerate)

Le framerate étant l'inverse de la durée d'un rafraîchissement, vous pouvez facilement le déduire du temps écoulé entre deux rafraîchissements :

```cpp
sf::Clock Clock;

while (App.IsOpened())
{
    float Framerate = 1.f / Clock.GetElapsedTime();
    Clock.Reset();
}

// Ou bien :

while (App.IsOpened())
{
    float Framerate = 1.f / App.GetFrameTime();
}
```

Si votre framerate se retrouve bloqué autour de 60 images par seconde ne vous inquiétez pas : cela signifie simplement que la synchronisation verticale (*v-sync*) est activée. Basiquement, lorsque la synchronisation verticale est activée, l'affichage sera synchronisé avec le taux de rafraîchissement du moniteur. Cela signifie que vous ne pourrez jamais afficher plus d'images que l'écran ne le peut. Et c'est une bonne chose, étant donné que cela va empêcher votre application de tourner à des vitesses incroyables comme 2000 images par seconde, et produire des artefacts visuels ou des comportements inatendus.

Cependant, vous voudriez parfois effectuer des tests pour faire des optimisations, et vous voudriez un taux de rafraîchissement maximum. SFML vous autorise à désactiver la synchronisation verticale si vous le voulez, avec la fonction `UseVerticalSync` :

```cpp
App.UseVerticalSync(false);
```

Notez que la synchronisation verticale est désactivée par défaut.

Vous pouvez également fixer le taux de rafraîchissement à une fréquence donnée :

```cpp
App.SetFramerateLimit(60); // Limite à 60 images par seconde
App.SetFramerateLimit(0);  // Limite désactivée
```

## Conclusion

La gestion du temps n'a plus de secret pour vous, et vous êtes prêt à écrire des applications temps réel robustes. Dans le [prochain tutoriel](opengl.md "Prochain tutoriel : utiliset OpenGL"), nous allons jouer un peu avec OpenGL, pour finalement avoir quelque chose à afficher dans notre fenêtre.  
Cependant, si vous n'êtes pas intéressé par l'utilisation d'OpenGL avec la SFML, vous pouvez immédiatement sauter à la section suivante concernant le [module graphique](../graphics/window.md "Ouvrir une fenêtre de rendu").
