# Gérer le temps

## [Le temps dans SFML](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#le-temps-dans-sfml)[](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#top "Haut de la page")

Contrairement à de nombreuses autres bibliothèques qui définissent le temps comme étant des millisecondes en uint32, ou des secondes en float, SFML n'impose aucune unité et aucun type pour les variables de temps. Au lieu de cela, SFML laisse ce choix à l'utilisateur à travers une classe flexible : [`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation"). Toutes les classes et fonctions SFML qui manipulent du temps utilisent cette classe.

[`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation") encapsule une valeur de temps (en d'autres termes, un laps de temps). Ce n'est _pas_ une classe de date, qui représenterait l'année/mois/jour/heure/minute/seconde courante, c'est juste une valeur qui représente une certaine quantité de temps, et la manière de l'interpréter dépend de son contexte d'utilisation.

## [Conversion de temps](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#conversion-de-temps)[](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#top "Haut de la page")

Une variable de type [`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation") peut être construite à partir de différentes unités : secondes, millisecondes et microsecondes. Il existe dans SFML une fonction (non-membre) pour convertir chacune d'elles en [`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation") :

```
sf::Time t1 = sf::microseconds(10000);
sf::Time t2 = sf::milliseconds(10);
sf::Time t3 = sf::seconds(0.01f);
```

Notez que ces trois variables sont toutes égales.

De la même manière, une variable [`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation") peut être convertie en secondes, en millisecondes ou en microsecondes :

```
sf::Time time = ...;

sf::Int64 usec = time.asMicroseconds();
sf::Int32 msec = time.asMilliseconds();
float     sec  = time.asSeconds();
```

## [Jouer avec les valeurs de temps](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#jouer-avec-les-valeurs-de-temps)[](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#top "Haut de la page")

La classe [`sf::Time`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Time.php "sf::Time documentation") représentant simplement une quantité de temps, elle supporte les opérations arithmétiques telles que l'addition, la soustraction, les comparaisons, etc. Les temps peuvent aussi être négatifs.

```
sf::Time t1 = ...;
sf::Time t2 = t1 * 2;
sf::Time t3 = t1 + t2;
sf::Time t4 = -t3;

bool b1 = (t1 == t2);
bool b2 = (t3 > t4);
```

## [Mesurer le temps](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#mesurer-le-temps)[](https://www.sfml-dev.org/tutorials/2.6/system-time-fr.php#top "Haut de la page")

Maintenant que nous avons vu comment manipuler les variables de temps avec SFML, voyons comment faire quelque chose dont à peu près tous les programmes ont besoin : mesurer le temps écoulé.

SFML a une classe très simple pour mesurer le temps : [`sf::Clock`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Clock.php "sf::Clock documentation"). Elle ne possède que deux fonctions : `getElapsedTime`, pour récupérer le temps écoulé depuis son démarrage, et `restart`, pour la redémarrer.

```
sf::Clock clock; // démarre le chrono
...
sf::Time elapsed1 = clock.getElapsedTime();
std::cout << elapsed1.asSeconds() << std::endl;
clock.restart();
...
sf::Time elapsed2 = clock.getElapsedTime();
std::cout << elapsed2.asSeconds() << std::endl;
```

Notez que `restart` renvoie également le temps écoulé, de façon à éviter le tout petit écart de temps qui existerait si vous aviez à appeler `getElapsedTime` explicitement avant `restart`.  
Voici un exemple qui utilise le temps écoulé à chaque itération de la boucle principale pour mettre à jour la logique du jeu :

```
sf::Clock clock;
while (window.isOpen())
{
    sf::Time elapsed = clock.restart();
    updateGame(elapsed);
    ...
}
```