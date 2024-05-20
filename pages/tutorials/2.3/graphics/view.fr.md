# Contrôler la caméra 2D avec les vues

## [Qu'est-ce qu'une vue ?](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#quest-ce-quune-vue)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

Dans un jeu, il n'est pas rare qu'un niveau soit bien plus grand que la fenêtre, et que tout ce que l'on voit ne soit qu'une petite partie de celui-ci. C'est notamment le cas pour les RPGs, les jeux de plateforme, et bien d'autres. Ce que les développeurs tendent à oublier est qu'ils définissent des entités dans un _monde 2D_, et non directement dans une fenêtre. La fenêtre n'est qu'une vue, elle montre une zone particulière de la scène. Vous pourriez tout aussi bien dessiner plusieurs vues du même monde 2D en parallèle, ou encore dessiner la scène dans une texture plutôt que dans une fenêtre ; le monde 2D quant à lui est toujours le même, ce qui change n'est que la manière dont il est vu.

Si la fenêtre ne montre qu'une petite partie du monde 2D, il vous faut un moyen de définir quelle partie de celui-ci est montrée dans la fenêtre. Vous pourriez également vouloir spécifier comment/où cette zone sera affichée dans la fenêtre. Et bien c'est très exactement à faire ces deux choses que servent les vues SFML.

Pour résumer, les vues sont les outils dont vous avez besoin si vous voulez faire défiler, tourner ou zoomer votre monde. Ils sont aussi l'élément clé dans la création d'écrans partagés ou de mini-cartes.

## [Définir ce que voit la vue](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#dcefinir-ce-que-voit-la-vue)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

La classe qui encapsule les vues SFML est [`sf::View`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1View.php "sf::View documentation"). Une vue peut être construite directement avec une définition de la zone à visionner :

```
// création d'une vue à partir de la zone rectangulaire du monde 2D à voir
sf::View view1(sf::FloatRect(200.f, 200.f, 300.f, 200.f));

// création d'une vue à partir de sa position centrale et de sa taille
sf::View view2(sf::Vector2f(350.f, 300.f), sf::Vector2f(300.f, 200.f));
```

Ces deux définitions sont équivalentes, elles montrent la même zone du monde 2D : un rectangle de 300x200 centré sur le point (350, 300).

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-initial.png "Une vue")

Si vous ne souhaitez pas définir la vue dès sa construction, ou si vous voulez la modifier plus tard, vous pouvez utiliser les fonctions suivantes, qui fonctionnent de manière équivalente aux constructeurs :

```
sf::View view1;
view1.reset(sf::FloatRect(200.f, 200.f, 300.f, 200.f));

sf::View view2;
view2.setCenter(sf::Vector2f(350.f, 300.f));
view2.setSize(sf::Vector2f(200.f, 200.f));
```

Une fois que votre vue est définie vous pouvez la transformer, afin de lui faire montrer une version décalée/tournée/redimensionnée de votre monde 2D.

### Déplacer (faire défiler) la vue

Contrairement aux entités dessinables telles que les sprites ou les formes, dont la position est définie par leur coin haut-gauche (et peut être redéfinie à n'importe quel autre point), les vues sont toujours manipulées via leur centre -- c'est plus pratique. C'est pourquoi la fonction qui change la position d'une vue se nomme `setCenter`, et non `setPosition`.

```
// déplacement de la vue en (200, 200)
view.setCenter(200.f, 200.f);

// décalage de la vue de (100, 100) (sa position finale est donc (300, 300))
view.move(100.f, 100.f);
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-translated.png "Une vue décalée")

### Orienter la vue

Pour tourner une vue, il faut utiliser la fonction `setRotation`.

```
// rotation de la vue à 20 degrés
view.setRotation(20.f);

// ajout de 5 degrés à la rotation courante de la vue (son orientation finale est donc de 25 degrés)
view.rotate(5.f);
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-rotated.png "Une vue orientée")

### Zoomer (redimensionner) une vue

Zoomer une vue revient à la redimensionner. La fonction à utiliser est donc `setSize`.

```
// redimensionnement de la vue en une zone de 1200x800 (on voit une zone plus grande, c'est donc un zoom arrière)
view.setSize(1200.f, 800.f);

// zoom de la vue relativement à sa taille courante (on applique un facteur 0.5, sa taille finale est donc 600x400)
view.zoom(0.5f);
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-scaled.png "Une vue redimensionnée")

## [Définir comment on voit la vue](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#dcefinir-comment-on-voit-la-vue)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

Maintenant que vous avez défini quelle partie du monde 2D doit être vue dans la fenêtre, définissons _où_ celle-ci sera affichée dans la fenêtre. Par défaut, une vue occupe la totalité de sa fenêtre. Si la vue a la même taille que la fenêtre, tout est donc rendu à l'identique. Mais si la vue est plus petite ou plus grande que la fenêtre, alors tout est redimensionné pour s'adapter à la taille de la fenêtre.

Ce comportement par défaut convient dans la plupart des situations, mais parfois il faut autre chose. Par exemple, pour partager l'écran dans un jeu multijoueur, vous pourriez utiliser deux vues occupant chacune une moitié de la fenêtre. Vous pourriez aussi implémenter une mini-carte, en dessinant le monde tout entier dans une vue qui est rendue dans un petit coin de la fenêtre. Cet espace, où le contenu de la vue est dessiné, est appelé le _viewport_.

Pour définir le viewport d'une vue, il faut appeler la fonction `setViewport`.

```
// définition d'un viewport centré, ayant la moitié de la taille de la fenêtre
view.setViewport(sf::FloatRect(0.25f, 0.25, 0.5f, 0.5f));
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-viewport.png "Un viewport")

Vous avez probablement remarqué quelque chose de très important : le viewport n'est pas défini en pixels, mais plutôt comme un ratio de la taille de la fenêtre. C'est beaucoup plus pratique : de cette manière vous n'avez pas à mettre à jour le viewport à chaque fois que la fenêtre est redimensionnée. C'est aussi plus intuitif : vous aurez très probablement besoin de définir vos viewports avec des fractions, et non des tailles fixes en pixels.

En jouant avec le viewport, il est très simple de définir un écran partagé pour les jeux multijoueur :

```
// joueur 1 (côté gauche de l'écran)
player1View.setViewport(sf::FloatRect(0.f, 0.f, 0.5f, 1.f));

// joueur 2 (côté droit de l'écran)
player2View.setViewport(sf::FloatRect(0.5f, 0.f, 0.5f, 1.f));
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-split-screen.png "Un écran partagé")

... ou une mini-carte :

```
// la vue de jeu (toute la fenêtre)
gameView.setViewport(sf::FloatRect(0.f, 0.f, 1.f, 1.f));

// la mini-carte (dans un coin en haut à droite)
minimapView.setViewport(sf::FloatRect(0.75f, 0.f, 0.25f, 0.25f));
```

![](https://www.sfml-dev.org/tutorials/2.6/images/graphics-view-minimap.png "Une mini-carte")

## [Utiliser une vue](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#utiliser-une-vue)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

Pour dessiner quelque chose via une vue, vous devez le dessiner après avoir appelé la fonction `setView` sur la cible dans laquelle vous dessinez ([`sf::RenderWindow`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderWindow.php "sf::RenderWindow documentation") ou [`sf::RenderTexture`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1RenderTexture.php "sf::RenderTexture documentation")).

```
// on crée une vue
sf::View view(sf::FloatRect(0.f, 0.f, 1000.f, 600.f));

// on l'active
window.setView(view);

// on dessine quelque chose dans cette vue
window.draw(some_sprite);

// vous voulez faire des tests de visibilité ? récupérez la vue courante
sf::View currentView = window.getView();
...
```

La vue reste active jusqu'à ce qu'une autre soit activée. Cela signifie qu'il y a toujours une vue qui définit ce qui apparaît dans la fenêtre, et où c'est dessiné. Si vous n'activez explicitement aucune vue, la fenêtre utilise sa propre vue par défaut, qui possède la même taille qu'elle. Vous pouvez récupérer la vue par défaut d'une fenêtre (au fait, quand je dis "fenêtre", j'englobe bien évidemment les textures de rendu) avec la fonction `getDefaultView`. Cela peut s'avérer utile si vous voulez vous en servir pour servir de base à la création d'une nouvelle vue, ou encore si vous voulez remettre la vue par défaut pour dessiner des entités fixes (comme une interface graphique) par dessus la scène.

```
// création d'une vue faisant la moitié de la vue par défaut
sf::View view = window.getDefaultView();
view.zoom(0.5f);
window.setView(view);

// réactivation de la vue par défaut
window.setView(window.getDefaultView());
```

Lorsque vous appelez `setView`, la fenêtre garde une _copie_ de la vue, pas un pointeur vers l'instance initiale. Ainsi, à chaque fois que vous modifiez votre vue, il faut rappeler `setView` afin d'appliquer les modifications. N'ayez pas peur de copier ou de créer des vues à la volée, ce sont des objets très légers (ils ne consistent qu'en quelques floats).

## [Afficher plus lorsque la fenêtre est redimensionnée](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#afficher-plus-lorsque-la-fencotre-est-redimensionncee)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

Puisque la vue par défaut ne change jamais plus après la création de la fenêtre, la zone affichée reste toujours la même. Ainsi lorsque la fenêtre est redimensionnée, tout est étiré ou compressé pour s'adapter à la nouvelle taille.

Et si, au lieu de ce comportement par défaut, vous vouliez montrer plus/moins de choses en fonction de la nouvelle taille de la fenêtre ? Tout ce que vous avez à faire est de synchroniser la taille de la vue sur celle de la fenêtre.

```
// la boucle d'évènements
sf::Event event;
while (window.pollEvent(event))
{
    ...

    // on attrape les évènements de redimensionnement
    if (event.type == sf::Event::Resized)
    {
        // on met à jour la vue, avec la nouvelle taille de la fenêtre
        sf::FloatRect visibleArea(0.f, 0.f, event.size.width, event.size.height);
        window.setView(sf::View(visibleArea));
    }
}
```

## [Conversions de coordonnées](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#conversions-de-coordonncees)[](https://www.sfml-dev.org/tutorials/2.6/graphics-view-fr.php#top "Haut de la page")

Lorsque vous utiliser une vue perso, ou bien lorsque vous redimensionnez la fenêtre sans appliquer le code ci-dessus, les pixels de la fenêtre se mettent à ne plus correspondre aux unités du monde 2D. Par exemple, cliquer sur le pixel (10, 50) peut toucher le point (26.5, -84) du monde. Vous devez alors utiliser une fonction de conversion pour faire passer vos coordonnées "pixel" en coordonnées "monde" : `mapPixelToCoords`.

```
// récupération de la position de la souris dans la fenêtre
sf::Vector2i pixelPos = sf::Mouse::getPosition(window);

// conversion en coordonnées "monde"
sf::Vector2f worldPos = window.mapPixelToCoords(pixelPos);
```

Par défaut, `mapPixelToCoords` utilise la vue courante. Si vous préférez convertir les coordonnées vers une autre vue que celle qui est active, vous pouvez en passer une comme paramètre additionnel à la fonction.

L'opération inverse, convertir des coordonnées "monde" en pixels, est également possible avec la fonction `mapCoordsToPixel`.