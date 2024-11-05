# Handling time

## Time in SFML

Unlike many other libraries where time is a uint32 number of milliseconds or a float number of seconds, SFML doesn't impose any specific unit or type for time values.
Instead it leaves this choice to the user through a flexible class: [`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation").
All SFML classes and functions that manipulate time values use this class.

[`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation") represents a time period (in other words, the time that elapses between two events).
It is _not_ a date-time class which would represent the current year/month/day/hour/minute/second as a timestamp.
It's just a value that represents a certain amount of time, and how to interpret it depends on the context where it is used.

## Converting time

A [`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation") value can be constructed from different source units: seconds, milliseconds and microseconds.
There is a free function to turn each of them into a [`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation"):

```cpp
sf::Time t1 = sf::microseconds(10000);
sf::Time t2 = sf::milliseconds(10);
sf::Time t3 = sf::seconds(0.01f);
```

Note that these three times are all equal.

Similarly, a [`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation") can be converted back to either seconds, milliseconds or microseconds:

```cpp
sf::Time time = ...;

std::int64_t usec = time.asMicroseconds();
std::int32_t msec = time.asMilliseconds();
float        sec  = time.asSeconds();
```

Conversions with the C++ standard library's `std::chrono::duration` are supported in two ways.

1. An implicit constructor which accepts any `std::chrono::duration` specialization.
1. An implicit conversion operator to any `std::chrono::duration` specialization.

```cpp
sf::Time time = std::chrono::milliseconds(100); // (1) Implicitly constructs from std::chrono::milliseconds
std::this_thread::sleep_for(time); // (2) Implicitly converts to std::chrono::nanoseconds
```

These two conversions allow for seamless interoperation with interfaces that use the `<chrono>` header.

## Playing with time values

[`sf::Time`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Time.php "sf::Time documentation") is just an amount of time, so it supports arithmetic operations such as addition, subtraction, comparison, etc.
Times can also be negative.

```cpp
sf::Time t1 = ...;
sf::Time t2 = t1 * 2;
sf::Time t3 = t1 + t2;
sf::Time t4 = -t3;

bool b1 = (t1 == t2);
bool b2 = (t3 > t4);
```

`sf::Time` is fully `constexpr`-enabled so all of these operations can be performed in a compile-time context.

## Measuring time

Now that we've seen how to manipulate time values with SFML, let's see how to do something that almost every program needs: measuring the time elapsed.

SFML has a very simple class for measuring time: [`sf::Clock`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Clock.php "sf::Clock documentation").
It provides a variety of functions for manipulating and querying the elapsed time.

```cpp
sf::Clock clock; // starts the clock
...
sf::Time elapsed1 = clock.getElapsedTime();
std::cout << elapsed1.asSeconds() << std::endl;
clock.restart();
...
sf::Time elapsed2 = clock.getElapsedTime();
std::cout << elapsed2.asSeconds() << std::endl;
...
clock.stop(); // stops the clock
std::cout << std::boolalpha << clock.isRunning() << std::endl;
clock.reset(); // resets elapsed time to zero
...
clock.start(); // starts the clock
sf::Time elapsed3 = clock.getElapsedTime();
std::cout << elapsed3.asSeconds() << std::endl;
```

Note that `restart` also returns the elapsed time, so that you can avoid the slight gap that would exist if you had to call `getElapsedTime` explicitly before `restart`.

Here is an example that uses the time elapsed at each iteration of the game loop to update the game logic:

```cpp
sf::Clock clock;
while (window.isOpen())
{
    sf::Time elapsed = clock.restart();
    updateGame(elapsed);
    ...
}
```
