# Utiliser OpenGL dans une fenêtre SFML

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Ce tutoriel ne parle pas d'OpenGL, mais plutôt de la manière d'utiliser SFML comme interface à OpenGL, ainsi que la façon de les mélanger.

Comme vous le savez très certainement, l'un des plus importants atouts d'OpenGL est sa portabilité. Mais OpenGL tout seul ne sera pas suffisant pour créer un programme complet : vous aurez également besoin d'une fenêtre, d'un contexte de rendu, des entrées utilisateur, etc. Et pour ça vous n'avez pas d'autre choix que d'écrire du code spécifique à l'OS. C'est là que le module sfml-window intervient ; voyons comment il vous permet de jouer avec OpenGL.

## [Inclure et lier OpenGL à votre application](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#inclure-et-lier-opengl-ce-votre-application)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Le nom des en-têtes OpenGL est malheureusement différent pour chaque OS. Pas de panique, SFML fournit un en-tête "abstrait" qui s'occupe d'inclure le bon fichier pour vous.

```
#include <SFML/OpenGL.hpp>
```

Cet en-tête inclut les fonctions OpenGL, et rien d'autre. Certains utilisateurs pensent à tort que SFML inclut automatiquement les en-têtes des extensions OpenGL parce qu'elle charge celles-ci en interne, mais ce n'est qu'un détail d'implémentation. Du point de vue de l'utilisateur, les extensions OpenGL doivent être gérées comme n'importe quelle autre bibliothèque.

Vous aurez ensuite besoin de lier votre programme à OpenGL. Contrairement à ce qu'elle fait avec les en-têtes, SFML ne peut pas fournir de moyen unifié de lier OpenGL. Ainsi, vous devrez savoir quelle bibliothèque lier selon l'OS que vous utilisez ("opengl32" sous Windows, "GL" sous Linux, etc.). Pareil pour GLU, au cas où vous l'utiliseriez également : "glu32" sous Windows, "GLU" sous Linux, etc.

Les fonctions OpenGL sont préfixées par "gl". Souvenez-vous en lorsque vous aurez de bêtes erreurs d'édition de liens, cela vous aidera à trouver quelle bibliothèque vous avez oublié de lier.

## [Créer une fenêtre OpenGL](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#crceer-une-fencotre-opengl)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Comme SFML est construite par dessus OpenGL, ses fenêtres sont déjà prêtes pour vos appels OpenGL, sans effort supplémentaire.

```
sf::Window window(sf::VideoMode(800, 600), "OpenGL");

// ça marche directement
glEnable(GL_TEXTURE_2D);
...
```

Si vous pensez que c'est _trop_ automatique, rassurez-vous : le constructeur de [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") accepte un paramètre supplémentaire qui vous permet de changer les options du contexte OpenGL de la fenêtre. Ce paramètre est une instance de la structure [`sf::ContextSettings`](https://www.sfml-dev.org/documentation/2.6.0-fr/structsf_1_1ContextSettings.php "sf::ContextSettings documentation"), qui définit les champs suivants :

- `depthBits` est le nombre de bits par pixel pour le _depth buffer_ (0 pour ne pas en créer)
- `stencilBits` est le nombre de bits par pixel pour le _stencil buffer_ (0 pour ne pas en créer)
- `antialiasingLevel` est le niveau d'anti-crénelage
- `majorVersion` et `minorVersion` définissent la version d'OpenGL demandée

```
sf::ContextSettings settings;
settings.depthBits = 24;
settings.stencilBits = 8;
settings.antialiasingLevel = 4;
settings.majorVersion = 3;
settings.minorVersion = 0;

sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, settings);
```

Si l'un (ou plusieurs) de ces paramètres n'est pas supporté par la carte graphique, SFML essaye de trouver la plus proche valeur qui soit valide. Par exemple, si un anti-crénelage x4 n'est pas supporté, SFML va essayer x2 puis en dernier recours se rabattre sur 0.  
Dans ce cas de figure, vous pouvez savoir ce que SFML a choisi avec la fonction `getSettings` :

```
sf::ContextSettings settings = window.getSettings();

std::cout << "depth bits:" << settings.depthBits << std::endl;
std::cout << "stencil bits:" << settings.stencilBits << std::endl;
std::cout << "antialiasing level:" << settings.antialiasingLevel << std::endl;
std::cout << "version:" << settings.majorVersion << "." << settings.minorVersion << std::endl;
```

Les versions d'OpenGL supérieures à 3.0 sont supportées par SFML (pour autant que ce soit géré par votre pilote graphique). Depuis SFML 2.3, vous pouvez sélectionner le profil des contextes 3.2+ ainsi que le flag de debug. Le flag de compatibilité ascendante (forward compatibility) n'est par contre pas supporté. Par défaut, SFML crée les contextes 3.2+ avec le profil de compatibilité, car son module graphique utilise encore certaines fonctions obsolètes d'OpenGL. Si vous avez l'intention d'utiliser le module graphique, assurez-vous de ne pas créer votre contexte avec le profil core, sans quoi le module ne fonctionnera pas correctement.

Sur OS X, SFML supporte la création de contextes 3.2+ uniquement avec le profil core. Si vous voulez utiliser le module graphique sur OS X, vous serez donc limité aux contextes 2.1.

## [Un programme OpenGL typique, à la sauce SFML](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#un-programme-opengl-typique-ce-la-sauce-sfml)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Voici à quoi pourrait ressembler un programme OpenGL complet avec SFML :

```
#include <SFML/Window.hpp>
#include <SFML/OpenGL.hpp>

int main()
{
    // crée la fenêtre
    sf::Window window(sf::VideoMode(800, 600), "OpenGL", sf::Style::Default, sf::ContextSettings(32));
    window.setVerticalSyncEnabled(true);

    // activation de la fenêtre
    window.setActive(true);

    // chargement des ressources, initialisation des états OpenGL, ...

    // la boucle principale
    bool running = true;
    while (running)
    {
        // gestion des évènements
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
            {
                // on stoppe le programme
                running = false;
            }
            else if (event.type == sf::Event::Resized)
            {
                // on ajuste le viewport lorsque la fenêtre est redimensionnée
                glViewport(0, 0, event.size.width, event.size.height);
            }
        }

        // effacement les tampons de couleur/profondeur
        glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

        // dessin...

        // termine la trame courante (en interne, échange les deux tampons de rendu)
        window.display();
    }

    // libération des ressources...

    return 0;
}
```

Ici nous n'utilisons pas `window.isOpen()` comme condition pour la boucle principale, car nous avons besoin que la fenêtre reste ouverte jusqu'à la fin du programme, de façon à garder un contexte OpenGL valide pour la dernière itération de la boucle ainsi que le code de libération des ressources à la fin.

N'hésitez pas à jeter un oeil aux exemples "OpenGL" et "Window" du SDK de SFML si vous avez des difficultés, ils sont plus complets et possèdent très probablement des réponses à vos questions.

## [Gestion des contextes OpenGL](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#gestion-des-contextes-opengl)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Chaque fenêtre créée dans SFML vient automatiquement avec un contexte OpenGL. Quand une fonction OpenGL est appelée, cette dernière va opérer sur le contexte actuellement actif. Il est donc requis qu'un contexte soit actif à chaque fois qu'une fonction OpenGL est invoquée. Si aucun contexte n'est activé à ce moment là, l'appel de fonction ne va pas produire les effets escomptés car il n'y a pas d'état sur lequel la fonction peut avoir un effet.

Pour faire en sorte d'activer le contexte d'une fenêtre, utilisez `window.setActive()` qui est l'équivalent de `window.setActive(true)`. Activer un contexte pendant qu'un autre est actif a pour effet d'implicitement désactiver celui qui est actuellement actif avant d'activer le nouveau contexte. Pour explicitement désactiver le contexte d'une fenêtre, utiliez `window.setActive(false)`. Comme expliqué plus loin, ceci est requis si le contexte est à activer sur un autre _thread_. Cependant, de manière générale il est recommandé de simplement désactiver un contexte à chaque fois que vous avez fini d'effectuer lot d'opérations OpenGL. En suivant ce conseil, chaque groupe de telles opérations peut être entouré entre des appels d'activation et de désactivation. Une classe d'utilitaire _RAII_ peut être conçue pour facilité cet effet.

```
// activation du contexte de la fenêtre
window.setActive(true);

// configuration des états OpenGL
// nettoyage des framebuffers
// affichage dans la fenêtre

// désactivation du contexte de la fenêtre
window.setActive(false);
```

Pour déboguer des problèmes avec OpenGL et SFML, la première étape est toujours de vérifier qu'un contexte est activé lorsqu'une fonction OpenGL est appelée. Ne partez pas du principe que SFML activera implicitement un contexte ou que SFML va préserver le contexte actif lorsque vous invoquez des fonctionnalités de la bibliothèque. La seule garantie est que le contexte actif sur le _thread_ courant ne changera pas entre les appels à `window.setActive(true)` et `window.setActive(false)` tant qu'aucun autre appel à la bibliothèque est fait entre deux. Dans tous les autres cas, il faut partir du principe que le contexte peut avoir changé. Il est donc requis d'explicitement réactiver le contexte pour s'assurer que le même contexte soit de nouveau actif. De plus, il est nécessaire que le bon contexte soit actif quand une fonction OpenGL est appelée car les contextes servent à représenter l'environnement d'exécution pour les opérations OpenGL ainsi que le _framebuffer_ de destination pour n'importe quelle commande de dessin. Il est à noter que, lorsqu'un contexte sans _framebuffer_ visible est actif, appeler une fonction de dessin OpenGL ne produira aucun rendu visible. De même, répartir des opérations OpenGL sur plusieurs contextes ne fera pas en sorte de propager les changement d'états sur les différents contextes. Ainsi, si une opération de dessin ultérieure nécessite certains états, elle ne produira pas les résultats escomptés.

Lorsque vous écrivez du code OpenGL, il est fortement recommandé de toujours vérifier si une erreur OpenGL a été produite après tout appel à une fonction OpenGL. Ceci peut être accomplis avec la fonction `glGetError()`. Vérifier la présence d'erreur après chaque invocation de fonction OpenGL vous aidera à cibler la source d'une possible erreur et ainsi rendre le débogage significativement plus efficace.

En fonction de la version et des capacités du contexte disponible, il est important de n'appeler que des fonctions qui soient compatibles avec ce contexte. Ne pas respecter cette règle produira souvent des erreurs comme `GL_INVALID_OPERATION` ou `GL_INVALID_ENUM`. Afin de déterminer la version et capacité d'un contexte ayant été créé avec une fenêtre ou séparément, `window.getSettings()` ou `context.getSettings()` peuvent respectivement être utilisés. Il se peut que les capacités et version d'un contexte diffèrent de celles demandées lors de la création du contexte, notamment quand l'implémentation d'OpenGL n'a pas été en mesure de répondre à toutes les exigences demandées. Aussi, il est recommandé de toujours vérifier si le contexte créé fournit bien les fonctionnalités requises pour exécuter le code OpenGL. Ceci peut être particulièrement déroutant lorsqu'on charge des extensions OpenGL dans un contexte, puis qu'on essaye de les utiliser dans un autre contexte moins apte, ou inversement.

## [Gérer plusieurs fenêtres OpenGL](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#gcerer-plusieurs-fencotres-opengl)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

La gestion de plusieurs fenêtres OpenGL n'est pas plus compliquée que la gestion d'une seule, il y a juste certaines choses à savoir.

Les appels OpenGL affectent le contexte actif (et donc la fenêtre active). Ainsi, si vous voulez dessiner sur deux fenêtres différentes au sein du même programme, il vous faudra choisir quelle fenêtre est active avant de dessiner quoique ce soit. Pour ce faire, vous devez utiliser la fonction `setActive` :

```
// activation de la première fenêtre
window1.setActive(true);

// dessin sur la première fenêtre...

// activation de la seconde fenêtre
window2.setActive(true);

// dessin sur la seconde fenêtre...
```

Un seul contexte (fenêtre) peut être actif dans chaque thread, vous n'avez donc pas besoin de désactiver la fenêtre active avant d'en activer une autre, c'est fait implicitement. C'est comme ça que fonctionne OpenGL.

Une autre chose à savoir est que tous les contextes OpenGL créés par SFML partagent leurs ressources. Cela signifie que vous pouvez créer une texture ou un vertex buffer avec n'importe quel contexte actif, et l'utiliser avec n'importe quel autre. Cela signifie aussi que vous n'aurez pas besoin de recharger toutes vos ressources OpenGL si vous recréez votre fenêtre.

## [OpenGL sans fenêtre](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#opengl-sans-fencotre)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Il est parfois nécessaire d'appeler des fonctions OpenGL alors qu'il n'y a aucune fenêtre, et donc aucun contexte OpenGL. Par exemple, lorsque vous chargez des textures depuis un thread, ou bien simplement avant que la première fenêtre ne soit créée. SFML vous permet de créer des contextes sans fenêtre avec la classe [`sf::Context`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Context.php "sf::Context documentation"). Tout ce que vous avez à faire est de l'instancier pour obtenir un contexte valide.

```
int main()
{
    sf::Context context;

    // chargement de ressources OpenGL...

    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    ...

    return 0;
}
```

## [Dessiner depuis un thread](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#dessiner-depuis-un-thread)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Une configuration typique pour un programme multi-threadé est de gérer la fenêtre et ses évènements depuis un thread (le principal), et le rendu depuis un autre. Si vous êtes dans ce cas de figure, il y a une règle importante à garder en tête : vous ne pouvez pas activer un contexte (une fenêtre) s'il est actif dans un autre thread. En pratique, cela signifie que vous devez désactiver votre fenêtre avant de lancer le thread de rendu.

```
void renderingThread(sf::Window* window)
{
    // activation du contexte de la fenêtre
    window->setActive(true);

    // la boucle de rendu
    while (window->isOpen())
    {
        // dessin...

        // fin de la trame -- ceci est une fonction de rendu (elle a besoin d'activer le contexte)
        window->display();
    }
}

int main()
{
    // création de la fenêtre (souvenez-vous: créer la fenêtre dans le thread principal est plus sûr, du fait des limitations de l'OS)
    sf::Window window(sf::VideoMode(800, 600), "OpenGL");

    // désactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de rendu
    sf::Thread thread(&renderingThread, &window);
    thread.launch();

    // la boucle d'évènements/logique/etc.
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
```

## [Utiliser SFML avec le module graphique de SFML](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#utiliser-sfml-avec-le-module-graphique-de-sfml)[](https://www.sfml-dev.org/tutorials/2.6/window-opengl-fr.php#top "Haut de la page")

Pour l'instant ce tutoriel a parlé de l'utilisation d'OpenGL avec sfml-window, ce qui est relativement simple étant donné que c'est le seul but de ce module. Mixer OpenGL avec le module graphique est un tout petit peu plus compliqué : sfml-graphics utilise aussi OpenGL, il faut donc prendre certaines précautions de sorte que les états OpenGL de l'utilisateur et ceux de SFML n'entrent pas en conflit.

Si vous ne connaissez pas encore le module graphique, tout ce que vous avez à savoir c'est que la classe [`sf::Window`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Window.php "sf::Window documentation") est remplacée par [`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation"), qui hérite de toutes ses fonctions et en ajoute quelques autres qui servent à dessiner des entités SFML.

Le seul moyen d'éviter les conflits entre SFML et vos propres états OpenGL, est de les sauvegarder/restaurer à chaque fois que vous passez d'OpenGL à SFML.

```
- dessin avec OpenGL

- sauvegarde des états OpenGL

- dessin avec SFML

- restauration des états OpenGL

- dessin avec OpenGL

...
```

La solution la plus simple est de laisser SFML le faire pour vous, avec les fonctions `pushGLStates`/`popGLStates` :

```
glDraw...

window.pushGLStates();

window.draw(...);

window.popGLStates();

glDraw...
```

Comme elle ne connaît rien de votre code OpenGL, SFML ne peut pas optimiser ces étapes et en conséquence elle sauvegarde/restaure absolument tous les états et matrices OpenGL. C'est négligeable pour des petits projets, mais cela peut se révéler trop lent sur des programmes conséquents qui requierent des performances maximales. Dans ce cas, vous pouvez gérer vous-même la sauvegarde et la restauration des états OpenGL, avec `glPushAttrib`/`glPopAttrib`, `glPushMatrix`/`glPopMatrix`, etc.  
Vous devrez cependant toujours restaurer les états de SFML avant dessiner avec elle, avec la fonction `resetGLStates`.

```
glDraw...

glPush...
window.resetGLStates();

window.draw(...);

glPop...

glDraw...
```

En gérant vous-même la sauvegarde des états OpenGL, vous pouvez vous occuper uniquement de ceux qui vous intéressent, et épargner quelques appels inutiles.