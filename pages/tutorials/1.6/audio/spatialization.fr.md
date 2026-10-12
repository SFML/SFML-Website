# Jouer avec la spatialisation des sons

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/audio/spatialization/).

## Introduction

Jouer des sons et des musiques est sympa, mais pour que ceux-ci soient parfaitement intégrés à votre environnement 2D ou 3D, il peut être encore plus sympa d'ajouter un peu de spatialisation. Jettons un oeil à quelques fonctions SFML simples pour cela.

## L'écouteur

Peu importe le nombre de sons et de musiques que vous placez dans votre scène, ils seront tous entendus par un "acteur" unique : l'écouteur (*listener*). Ce que l'écouteur entendra, est ce qui sortira de vos hauts-parleurs.

SFML définit une interface pour modifier et récupérer les propriétés de l'écouteur : [`sf::Listener`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Listener.php "sf::Listener documentation"). Comme l'écouteur est unique dans la scène, cette classe ne contient que des fonctions statiques et n'a pas besoin d'être instanciée.

Pour commencer, vous pouvez modifier la position de l'écouteur dans la scène :

```cpp
sf::Listener::SetPosition(10.f, 0.f, 5.f);
```

Si vous manipulez un monde 2D vous pouvez simplement utiliser la même valeur Y partout, habituellement 0.  
Par défaut, l'écouteur est placé à l'origine du monde (point (0, 0, 0)).

Ensuite, vous pouvez modifier le point vers lequel l'écouteur regarde, afin de définir son orientation :

```cpp
sf::Listener::SetTarget(15.f, 0.f, 5.f);
```

Ici, notre écouteur regarde le long de l'axe +X. Cela signifie que, par exemple, un son provenant de (15, 0, 3) sera entendu par l'écouteur de droite.  
Par défaut, l'écouteur regarde le long de l'axe -Z (vecteur (0, 0, -1)).

Enfin, l'écouteur peut ajuster le volume global de la scène, ce qui serait équivalent à modifier le volume de toutes les sources sonores :

```cpp
sf::Listener::SetGlobalVolume(50.f);
```

La valeur du volume est une valeur dans l'intervalle [0, 100] ; ainsi, une valeur de 50 réduira le volume de moitié.

Notez que tous les paramètres de l'écouteur peuvent être récupérés via les fonctions GetXxx correspondantes.

## Sons et musiques dans votre scène

Il n'y a pas beaucoup plus à dire concernant les sons et les musiques. Vous pouvez changer leur position dans votre environnement 2D ou 3D :

```cpp
sf::Sound 3DSound;
3DSound.SetPosition(3.f, 2.f, 6.f);
```

Par défaut, la position est exprimée en coordonnées absolues. Il est toutefois possible de la rendre relative à la position de l'écouteur si nécessaire :

```cpp
3DSound.SetRelativeToListener(true);
```

Cela aura notamment comme effet de désactiver la spatialisation si la position est gardée à (0, 0, 0). Désactiver la spatialisation est particulièrement utile pour les sons qui ne font pas partie de la scène (sons d'interface graphique, etc.).

Et vous pouvez modifier la façon dont ils vont être attenués relativement à leur distance par rapport à l'écouteur :

```cpp
3DSound.SetMinDistance(5.f);
3DSound.SetAttenuation(10.f);
```

La distance minimum est la distance au-dessous de laquelle le son sera entendu à son volume maximum. Ainsi, les sons forts (par exemple une explosion) devraient avoir une distance minumum plus haute pour s'assurer qu'ils seront entendus de loin. Notez bien qu'une distance minimum de 0 (ie. le son est dans la tête de l'écouteur :) ) mènerait à une valeur incorrecte et resulterait en un son non-attenué ; n'utilisez jamais 0.  
La distance minimum par défaut est 1.

L'attenuation est un facteur multiplicatif. Plus l'attenuation est élevée, moins le son sera entendu lorsqu'il s'éloigne de l'écouteur.  
Pour obtenir un son non-attenué, vous pouvez utiliser 0. D'un autre côté, utiliser une valeur de l'ordre de 100 va grandement attenuer le son, c'est-à-dire qu'il ne sera audible que s'il est très proche de l'écouteur.  
L'attenuation par défaut est 1.

Voici la formule exacte d'attenuation, au cas où vous auriez besoin de valeurs précises :

```cpp
MinDistance est la distance minimum du son, affectée avec SetMinDistance
Attenuation est l'attenuation du son, affecté avec SetAttenuation
Distance    est la distance entre le son et l'écouteur

Factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
```

## Conclusion

Comme vous pouvez le voir, ajouter un degré de réalisme à vos environnements 2D ou 3D est facile grace à la spatialisation audio.  
Si vous pensez maintenant être prêt avec le module audio, vous pouvez à présent passer aux [tutoriels réseau](../network/sockets.md "Passer aux tutoriels réseau").
