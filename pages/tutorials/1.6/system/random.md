# Generating random numbers

!!! warning ""

    You're reading a tutorial for SFML 1.6, which doesn't exist anymore in the latest version. Check out the [latest tutorials](/tutorials/latest/).

## Introduction

Generating pseudo-random numbers is not hard, especially with the `rand` and `srand` functions from the standard library. But you always end up writing helper functions, for getting a random number in a specific range, getting a float random number, etc. That's why SFML provides a helper class, [`sf::Randomizer`](../../../documentation/1.6/classsf_1_1Randomizer.html "sf::Randomizer documentation"), that defines some helper functions.

This document is more a reference than a real tutorial, all it does is showing you the [`sf::Randomizer`](../../../documentation/1.6/classsf_1_1Randomizer.html "sf::Randomizer documentation") functions.

## Setting the seed

The first thing almost every people do in a program using random numbers, is initializing the seed to make sure the generated sequence will be different from one run to the other. SFML does it automatically at program startup, so you don't have to worry about it.

However, if you want to use a specific seed (for replaying a known sequence), you can use the `SetSeed` function :

```cpp
unsigned int Seed = 10;
sf::Randomizer::SetSeed(Seed);
```

You can also get the current seed :

```cpp
unsigned int Seed = sf::Randomizer::GetSeed();
```

## Generating random numbers whithin specific ranges

[`sf::Randomizer`](../../../documentation/1.6/classsf_1_1Randomizer.html "sf::Randomizer documentation") provides two functions for generating random numbers in specific ranges.

The first one generates integers :

```cpp
// Get a random integer number between 0 and 100
int Random = sf::Randomizer::Random(0, 100);
```

And the second one generates floats :

```cpp
// Get a random float number between -1 and 1
float Random = sf::Randomizer::Random(-1.f, 1.f);
```

## Conclusion

That's all about random numbers. These few functions should be enough for your needs ; however if you need a more complete and complex random number library, you can have a look at [boost.random](http://www.boost.org/libs/random/ "boost.random webpage").

You can now go back to the [tutorials index](../index.md "Back to tutorials index"), or jump to the [tutorials about the windowing package](../window/window.md "Jump to the tutorials about the windowing package").
