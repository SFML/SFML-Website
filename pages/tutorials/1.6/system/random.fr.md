# Générer des nombres aléatoires

## Introduction

Générer des nombres pseudo-aléatoires n'est pas difficile, particulièrement avec les fonctions `rand` et `srand` de la bibliothèque standard. Mais on finit toujours par écrire des fonctions intermédiaires, par exemple pour obtenir un nombre aléatoire dans un intervalle spécifique, ou encore pour générer des nombres décimaux. C'est pourquoi la SFML fournit une classe utilitaire, [`sf::Randomizer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Randomizer.php "sf::Randomizer documentation"), qui définit quelques fonctions pour vous aider.

Ce document est plus une référence qu'un réel tutoriel, tout ce qu'il vous montrera sont les fonctions de la classe [`sf::Randomizer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Randomizer.php "sf::Randomizer documentation").

## Changer la graine

La première chose qu'à peu près tout le monde fait dans un programme utilisant les nombres aléatoires, est d'initialiser la graine afin de s'assurer que la séquence générée sera bien différente d'une exécution à l'autre. La SFML le fait automatiquement au lancement du programme, ainsi vous n'avez pas à vous en préoccuper.

Cependant, si vous souhaitez utiliser une graine spécifique (pour rejouer une séquence connue), vous pouvez utiliser la fonction `SetSeed` :

```cpp
unsigned int Seed = 10;
sf::Randomizer::SetSeed(Seed);
```

Vous pouvez également récupérer la graine courante :

```cpp
unsigned int Seed = sf::Randomizer::GetSeed();
```

## Générer des nombres aléatoires dans des intervalles spécifiques

[`sf::Randomizer`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Randomizer.php "sf::Randomizer documentation") fournit deux fonctions pour générer des nombres aléatoires dans des intervalles donnés.

La première génère des nombres entiers :

```cpp
// Renvoie un nombre entier aléatoire entre 0 et 100
int Random = sf::Randomizer::Random(0, 100);
```

Et la seconde génère des flottants :

```cpp
// Renvoie un nombre réel aléatoire entre -1 et 1
float Random = sf::Randomizer::Random(-1.f, 1.f);
```

## Conclusion

C'est tout ce qu'il y a à dire concernant les nombres aléatoires. Ces quelques fonctions devraient être suffisantes pour vos besoins ; toutefois, si vous avez besoin d'une bibliothèque de nombres aléatoires plus complète et plus complexe, vous pouvez jeter un oeil à [boost.random](http://www.boost.org/libs/random/ "Page de boost.random").

Vous pouvez maintenant retourner au [sommaire des tutoriels](../index.md "Retour au sommaire des tutoriels"), ou passer aux [tutoriels du module de fenêtrage](../window/window.md "Passer aux tutoriels du module de fenêtrage").
