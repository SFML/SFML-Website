# Spatialisation : les sons en 3D

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#top "Haut de la page")

Par défaut, les sons et les musiques sont joués à plein volume dans chaque haut-parleur ; ils ne sont pas _spatialisés_.

Mais si un son est émis par une entité qui se trouve sur la droite de l'écran, vous aimeriez plutôt qu'il soit entendu depuis le haut-parleur de droite. Ou encore, si une musique est jouée derrière le joueur, vous aimeriez l'entendre depuis les haut-parleurs arrière de votre installation Dolby 5.1.

Alors... comment faire ?

## [Les sons spatialisés sont mono](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#les-sons-spatialisces-sont-mono)[](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#top "Haut de la page")

Un son ne peut être spatialisé que s'il ne possède qu'un canal, i.e. si c'est un son mono.  
La spatialisation est désactivée pour les sons qui possèdent plus de canaux, étant donné qu'ils donnent déjà explicitement leur utilisation des haut-parleurs. Il est très important de garder cela en tête.

## [L'écouteur](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#lcecouteur)[](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#top "Haut de la page")

Tous les sons et musiques de votre environnement audio seront entendus par un acteur unique : l'_écouteur_. Ce qui est restitué à travers vos haut-parleurs, c'est ce que l'écouteur entend.

La classe qui définit les propriétés de l'écouteur est [`sf::Listener`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Listener.php "sf::Listener documentation"). Comme l'écouteur est unique dans l'environnement, cette classe ne contient que des fonctions statiques et ne doit pas être instanciée.

Tout d'abord, vous pouvez modifier la position de l'écouteur dans la scène :

```
sf::Listener::setPosition(10.f, 0.f, 5.f);
```

Si votre monde est en 2D, vous pouvez utiliser la même valeur Y partout, typiquement 0.

En plus de sa position, vous pouvez définir l'orientation de l'écouteur :

```
sf::Listener::setDirection(1.f, 0.f, 0.f);
```

Ici, l'écouteur est orienté le long de l'axe +X. Cela signifie que, par exemple, un son émis au point (15, 0, 5) sera entendu par le haut-parleur de droite.

Il est important de noter que le vecteur "up" de l'écouteur est fixé à (0, 1, 0), en d'autres termes sa tête est orientée le long de l'axe +Y.

Enfin, l'écouteur permet d'ajuster le volume global de l'environnement audio :

```
sf::Listener::setGlobalVolume(50.f);
```

La valeur du volume est comprise entre 0 et 100, ainsi la mettre à 50 réduit le volume de moitié.

Toutes ces propriétés peuvent bien entendu être relues via les fonctions `get` correspondantes.

## [Les sources audio](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#les-sources-audio)[](https://www.sfml-dev.org/tutorials/2.6/audio-spatialization-fr.php#top "Haut de la page")

Toutes les sources audio fournies par SFML (sons, musiques, flux) définissent les mêmes propriétés pour la spatialisation.

La propriété principale est la position de la source audio.

```
sound.setPosition(2.f, 0.f, -5.f);
```

Cette position est absolue par défaut, mais elle peut devenir relative à l'écouteur si nécessaire.

```
sound.setRelativeToListener(true);
```

Cela peut être utile pour les sons émis par l'écouteur lui-même (comme un bruit de tir, ou de pas). Cela a également comme effet intéressant de désactiver la spatialisation si vous mettez la position de la source audio à (0, 0, 0). Les sons non-spatialisés peuvent se révéler utiles dans de nombreuses situations : sons d'interface graphique (clics), musiques ambiantes, etc.

Vous pouvez également définir la manière avec laquelle les sources audio seront attenuées selon leur distance par rapport à l'écouteur.

```
sound.setMinDistance(5.f);
sound.setAttenuation(10.f);
```

La _distance minimum_ est la distance en-deça de laquelle la son sera entendu à son volume maximal. Ainsi, par exemple, les sons très forts tels que les explosions auront typiquement une distance minimum élevée, afin d'être sûr qu'ils seront entendus de loin. Notez bien qu'une distance de 0 (le son se trouve dans la tête de l'écouteur !) conduirait à des valeurs incorrectes et produirait un son non-attenué. 0 est une valeur invalide, ne l'utilisez pas.

L'_attenuation_ est un facteur multiplicatif. Plus grande est l'atténuation, moins le son sera fort à mesure qu'il s'éloigne de l'écouteur. Afin d'obtenir un son non-attenué, vous pouvez utiliser 0. A l'inverse, utiliser une valeur élevée telle que 100 atténuera très fortement le son, si bien qu'il ne pourra être entendu que lorsque l'écouteur en est très proche.

Voici la formule exacte du calcul de l'atténuation, au cas où vous auriez besoin de calculer des valeurs précises :

```
MinDistance   est la distance minimum du son, affectée avec setMinDistance
Attenuation   est l'attenuation du son, affecté avec setAttenuation
Distance      est la distance entre le son et l'écouteur
Volume factor est le facteur calculé, entre 0 et 1, qui sera appliqué au volume du son

Volume factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
```