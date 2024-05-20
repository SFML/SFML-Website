# Ouvrir et gérer une fenêtre SFML

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Ce tutoriel explique uniquement comment ouvrir et gérer une fenêtre avec SFML. Dessiner des choses sort déjà du cadre du module sfml-window : c'est en effet géré par le module sfml-graphics. Cependant, la gestion de la fenêtre reste exactement la même, la lecture de ce tutoriel est donc indispensable dans tous les cas.

## [Ouvrir une fenêtre](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#ouvrir-une-fencotre)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Les fenêtre SFML sont définies par la classe [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation"). Une fenêtre peut être créée et ouverte directement dès sa construction :

```
#include <SFML/Window.hpp>

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
```

Le premier paramètre, le _mode vidéo_, définit la taille de la fenêtre (la taille interne, sans la barre de titre ni les bordures). Ici, nous créons une fenêtre de 800x600 pixels.  
La classe [`sf::VideoMode`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1VideoMode.php "sf::VideoMode documentation") a quelques fonctions statiques intéressantes pour récupérer la résolution du bureau, ou encore la liste des modes vidéo valides pour le mode plein écran. N'hésitez pas à consulter la documentation pour voir tout ce que vous pouvez en tirer.

Le deuxième paramètre est simplement le titre de la fenêtre.

Ce constructeur accepte un troisième paramètre optionnel : un style, qui permet de choisir quelles décorations et fonctionnalités vous voulez sur la fenêtre. Vous pouvez utiliser des combinaisons des styles suivants :

|   |   |
|---|---|
|`sf::Style::None`|Aucune décoration (utile pour les _splash screens_, par exemple) ; ce style ne peut pas être combiné avec les autres|
|`sf::Style::Titlebar`|La fenêtre possède une barre de titre|
|`sf::Style::Resize`|La fenêtre peut être redimensionnée et possède un bouton de maximisation|
|`sf::Style::Close`|La fenêtre possède une bouton de fermeture|
|`sf::Style::Fullscreen`|La fenêtre est créée en mode plein écran; ce style ne peut pas être combiné avec les autres, et requiert un mode vidéo valide|
|`sf::Style::Default`|Le style par défaut, qui est un raccourci pour `Titlebar \| Resize \| Close`|

Il existe également un quatrième paramètre optionnel, qui définit des options spécifiques à OpenGL ; cet aspect est détaillé dans le [tutoriel dédié](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php "Tutoriel OpenGL").

Si vous voulez créer la fenêtre _après_ la construction de l'instance de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation"), ou bien la re-créer avec des paramètres différents, vous pouvez plutôt utiliser la fonction `create` ; elle prend exactement les mêmes paramètres que le constructeur.

```
#include <SFML/Window.hpp>

int main()
{
    sf::Window window;
    window.create(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
```

## [Rendre la fenêtre un peu plus vivante](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#rendre-la-fencotre-un-peu-plus-vivante)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Si vous essayez d'exécuter le code ci-dessus avec rien à la place des "...", vous ne verrez pas grand chose se passer. Tout d'abord parce que le programme se termine instantanément. Ensuite, parce qu'il n'y a aucune gestion d'évènement -- donc même si vous ajoutiez une boucle infinie dans ce code, vous verriez une fenêtre "gelée", incapable d'être déplacée, redimensionnée, ou bien encore fermée.

Ajoutons donc un peu de code pour rendre ce programme plus intéressant :

```
#include <SFML/Window.hpp>

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme jusqu'à ce que la fenêtre soit fermée
    while (window.isOpen())
    {
        // on inspecte tous les évènements de la fenêtre qui ont été émis depuis la précédente itération
        sf::Event event;
        while (window.pollEvent(event))
        {
            // évènement "fermeture demandée" : on ferme la fenêtre
            if (event.type == sf::Event::Closed)
                window.close();
        }
    }

    return 0;
}
```

Le code ci-dessus ouvre une fenêtre, et se termine lorsque l'utilisateur la ferme. Voyons comment il fonctionne en détail.

Premièrement, nous avons ajouté une boucle qui nous assure que l'application va être rafraîchie/mise à jour jusqu'à ce que la fenêtre soit fermée. La plupart (sinon tous) les programmes SFML auront ce genre de boucle, souvent appelée _boucle principale_ ou _boucle de jeu_.

Ensuite, la première chose que nous faisons dans la boucle principale est de regarder si des évènements se sont produits. Notez bien que nous utilisons une boucle `while` de manière à inspecter tous les évènements, au cas où il y en aurait plusieurs en attente d'être traités. La fonction `pollEvent` renvoie `true` si un évènement était en attente, ou `false` s'il n'y en avait aucun.

A chaque fois que nous avons un évènement, nous devons vérifier son type (fenêtre fermée ? une touche appuyée ? le curseur a bougé ? un joystick est connecté ? ...), et réagir en conséquence si ce type d'évènement nous intéresse. Dans cet exemple, nous ne nous intéressons qu'à l'évènement `Event::Closed`, qui est émis lorsque l'utilisateur souhaite fermer la fenêtre. A ce moment, la fenêtre est toujours ouverte et nous devons la fermer explicitement avec la fonction `close`. Cela permet de faire autre chose avant que la fenêtre ne soit réellement fermée, comme par exemple sauvegarder l'état de l'application, ou afficher un message.

Une erreur que les gens font souvent est d'oublier de mettre une boucle d'évènements, car ils n'en ont pas besoin (ils utilisent les entrées temps réel à la place, typiquement). Mais sans gestion d'évènement la fenêtre ne sera pas réactive ; en effet, la boucle d'évènement a deux rôles : en plus de fournir les évènements à l'utilisateur, elle permet à la fenêtre de traiter ses évènements internes, ce qui est impératif a son bon fonctionnement.

Après que la fenêtre a été fermée, la boucle principale s'arrête et le programme se termine.

Vous avez probablement remarqué que nous n'avons pas encore parlé de _dessiner quelque chose_ dans cette fenêtre. Comme indiqué dans l'introduction, ce n'est pas le boulot du module sfml-window, et vous devrez aller voir directement les tutoriels du module sfml-graphics si vous voulez dessiner des choses intéressantes telles que des sprites, du texte ou des formes.

Pour dessiner, vous pouvez aussi utiliser OpenGL directement et complètement ignorer le module sfml-graphics. [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") crée en interne un contexte OpenGL, de sorte qu'elle est naturellement prête à recevoir vos propres appels OpenGL. Vous pourrez en savoir plus à ce sujet dans le [tutoriel correspondant](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php "Tutoriel OpenGL").

Bref, ne vous attendez pas à voir quelque chose d'intéressant dans cette fenêtre : vous verrez très certainement une couleur uniforme (noir ou blanc), ou bien le dernier contenu du programme OpenGL exécuté précédemment, ou... n'importe quoi d'autre.

## [Jouer avec la fenêtre](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#jouer-avec-la-fencotre)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Evidemment, SFML vous permet de jouer un peu avec vos fenêtres. Les opérations basiques de fenêtrage, telles que changer la taille, la position, le titre ou l'icône sont supportées, mais contrairement à d'autres bibliothèques plus spécialisées dans les interfaces graphiques (Qt, wxWidgets), SFML ne fournit pas de fonctionnalités avancées. Les fenêtres SFML ne sont qu'un support pour du dessin OpenGL ou SFML. L'accent est mis sur les fonctionnalités importantes ainsi que la simplicité d'utilisation.

```
// changement de la position de la fenêtre (relativement au bureau)
window.setPosition(sf::Vector2i(10, 50));

// changement de la taille de la fenêtre
window.setSize(sf::Vector2u(640, 480));

// changement du titre de la fenêtre
window.setTitle("SFML window");

// récupération de la taille de la fenêtre
sf::Vector2u size = window.getSize();
unsigned int width = size.x;
unsigned int height = size.y;

// détecte si la fenêtre est au premier plan
bool focus = window.hasFocus();

...
```

Vous pouvez consulter la documentation de l'API pour une liste complète des fonctions de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation").

Si vous avez réellement besoin de fonctionnalités plus avancées pour votre fenêtre, vous pouvez la créer (ou même une GUI complète) avec une autre bibliothèque, et intégrer SFML dedans. Pour ce faire, vous pouvez utiliser l'autre constructeur, ou fonction `create`, de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") qui prend en paramètre le handle natif (spécifique à l'OS) d'une fenêtre existante. Dans ce cas, SFML crée un contexte OpenGL dans la fenêtre et récupère tous ses évènements, sans perturber sa gestion initiale.

```
sf::WindowHandle handle = /* specifique à ce que vous faites et à la bibliothèque que vous utilisez */;
sf::Window window(handle);
```

Si vous voulez juste une fonctionnalité supplémentaire bien spécifique, vous pouvez aussi faire l'inverse : créer une fenêtre SFML normale, et récupérer son handle natif afin d'implémenter les fonctions que SFML ne supporte pas.

```
sf::Window window(sf::VideoMode(800, 600), "SFML window");
sf::WindowHandle handle = window.getSystemHandle();

// vous pouvez maintenant utiliser 'handle' avec les fonctions spécifiques à l'OS
```

L'intégration de SFML avec d'autres bibliothèques de GUI requiert un peu de travail et ne sera donc pas détaillée ici, mais vous pouvez vous référer aux tutoriels correspondant, aux exemples ou aux messages sur le forum.

## [Contrôler le framerate](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#contrcler-le-framerate)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Parfois, lorsque votre application tourne (trop) vite, cela peut produire des artefacts visuels tels que des déchirements (_tearing_). La raison est que la fréquence de rafraîchissement de votre application n'est pas synchronisée sur la fréquence verticale de l'écran, et en conséquence, le bas de la trame précédente apparaît avec le haut de la nouvelle trame.  
La solution à ce problème est d'activer la _synchronisation verticale_. Elle est gérée automatiquement par la carte graphique, et peut être activée ou désactivée facilement avec la fonction `setVerticalSyncEnabled` :

```
window.setVerticalSyncEnabled(true); // un appel suffit, après la création de la fenêtre
```

Après cet appel, votre application sera rafraîchie à la même fréquence que l'écran (donc grosso modo 60 fois par seconde).

Parfois `setVerticalSyncEnabled` n'a aucun effet : la plupart du temps c'est dû aux options du pilote graphique qui forcent la synchronisation verticale à "_off_". Si cela vous arrive, modifiez cette option à "_contrôlé par l'application_".

Dans d'autres situations, vous voudrez peut-être que votre application tourne à un framerate fixé plutôt qu'à la fréquence de rafraîchissement de l'écran. Cela peut être fait avec la fonction `setFramerateLimit` :

```
window.setFramerateLimit(30); // un appel suffit, après la création de la fenêtre
```

Contrairement à `setVerticalSyncEnabled`, cette fonctionnalité est implémentée par SFML, avec une combinaison de [`sf::Clock`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Clock.php "sf::Clock documentation") et de `sf::sleep`. Une conséquence importante de cela est qu'elle n'est pas fiable à 100%, en particulier pour des valeurs élevées : la résolution de `sf::sleep` dépend de l'OS, et peut être aussi faible que 10 ou 15 millisecondes. Ne comptez donc pas sur cette fonction pour implémenter des timings ultra-précis.

N'utilisez jamais `setVerticalSyncEnabled` et `setFramerateLimit` en même temps ! Elles intéragiraient mal et rendraient les choses encore pire.

## [Choses à savoir à propos des fenêtres](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#choses-ce-savoir-ce-propos-des-fencotres)[](https://www.sfml-dev.org/tutorials/2.6/window-window-fr.php#top "Haut de la page")

Voici une rapide liste de choses que pouvez faire ou ne pas faire avec les fenêtres SFML.

### Vous pouvez créer plusieurs fenêtres

SFML permet de créer plusieurs fenêtres, et de les gérer soit toutes dans le thread principal, soit chacune dans son propre thread (mais... attention aux autres limitations ci-dessous). Dans ce cas, n'oubliez pas d'adjoindre à chaque fenêtre sa boucle d'évènements.

### Les écrans multiples ne sont pas encore bien supportés

SFML ne gère pas explicitement les moniteurs multiples. En conséquence, vous ne pourrez pas choisir sur quel écran une fenêtre va apparaître, et vous ne pourrez pas non plus créer plus d'une fenêtre plein écran à la fois. Ceci devrait être amélioré dans une version future.

### Les évènements doivent être traités dans le thread de la fenêtre

C'est une limitation importante de la plupart des OS : la boucle d'évènements (plus précisément, la fonction `pollEvent` ou `waitEvent`) doit être appelée dans le thread qui a créé la fenêtre. Cela implique que si vous voulez créer un thread dédié à la gestion d'évènements, vous devrez vous assurer que la fenêtre est créée dans ce même thread. Si vous voulez vraiment séparer les choses en plusieurs threads, il est plutôt recommendé de garder le fenêtrage et les évènements dans le thread principal, et de bouger le reste (rendu, physique, logique, ...) dans des threads. Cette configuration a aussi l'avantage d'être compatible avec la limitation qui suit.

### Sous OS X, les fenêtres et les évènements doivent être gérés dans le thread principal

Ouaip, c'est exact. Max OS X ne sera pas d'accord si vous essayez de créer une fenêtre ou de gérer ses évènements dans un thread autre que le thread principal.

### Sous Windows, une fenêtre plus grande que le bureau ne réagira pas correctement

Pour une raison inconnue, Windows n'aime pas les fenêtres qui sont plus grandes que le bureau. Cela inclue les fenêtres créées avec `VideoMode::getDesktopMode()` : avec les décorations (bordures et barre de titre) en plus, vous finissez avec une fenêtre qui est très légèrement plus grande que le bureau.