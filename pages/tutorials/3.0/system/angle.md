# Handling Angles

## Angles in SFML

[`sf::Angle`](https://www.sfml-dev.org/todo/angle.php "sf::Angle documentation") represents an angle in a unit-agnostic manner so that you can reason about angles in terms of degrees or radians.
SFML defines angles as following the [right-hand rule](https://en.wikipedia.org/wiki/Right-hand_rule).
This means that if the X-axis points to the right in the window and the Y-axis points down, then a positive angle rotates clockwise.
All SFML classes that work with angles use `sf::Angle`

All `sf::Angle` functions are `constexpr`-enabled so anything shown here can be done at compile-time.

## Constructing angles

There are two factory functions for constructing an angle: `sf::degrees` and `sf::radians`.

```cpp
sf::Angle angle1 = sf::degrees(180);
sf::Angle angle2 = sf::radians(3.1415f);
```

These two functions construct approximately equal angles from either degrees or radians so that you don't have to think about units in your own code.
Feel free to use either function as you see fit.
`sf::Angle` will handle any necessary unit conversions internally.

## Manipulating angles

`sf::Angle` provides a collection of operators for arithmetic operations.
You can add, subtract, multiply, and divide angles.
There are also modulo, equality, inequality, and comparison operators.

```cpp
sf::Angle angle1 = sf::degrees(10);
angle1 *= 2.f; // 20 degrees
sf::Angle angle2 = angle1 + sf::radians(0.5f); // 48.6 degrees
angle2 = -angle2; // -48.6 degrees
angle2 /= 3.f; // 16.2 degrees

bool equal = (angle1 == angle2); // false
bool inequal = (angle1 != angle2); // true
```

`sf::Angle`s can exist outside range [-pi, pi) or [0, 2pi).
An angle may have a value of 720 degrees, for example.
If you would like to get a new angle wrapped to its equivalent value within a smaller range, there are two functions for doing so, `sf::Angle::wrapSigned` and `sf::Angle::wrapUnsigned`.
- `wrapSigned` will return a new angle wrapped to the range [-pi, pi).
- `wrapUnsigned` will return a new angle wrapped to the range [0, 2pi).

```cpp
sf::Angle angle1 = sf::degrees(540).wrapUnsigned(); // 180 degrees

sf::Angle angle2 = sf::radians(2 * 3.1415f).wrapSigned(); // 0 degrees
```

After transformation the angles will occupy the same location on the unit circle.

## User defined literals

C++ user-defined literals provide a convenient shorthand for writing angles.
These literals exist in the `sf::Literals` namespace.
Bring that namespace into the current scope to access them.

```cpp
using namespace sf::Literals;
sf::Angle angle1 = 45_deg; // 45 degrees
sf::Angle angle2 = angle1 + 3.1415_rad; // 225 degrees
```

## Accessing the underlying value

If you would like to format an angle as text or pass the value to a function like `std::sin`, there are two functions for accessing the angle as a raw `float`: `sf::Angle::asDegrees` and `sf::Angle::asRadians`.

```cpp
sf::Angle angle1 = sf::radians(2);
std::cout << angle1.asDegrees() << std::endl;

sf::Angle angle2 = sf::degrees(270);
std::cout << std::sin(angle2.asRadians()) << std::endl;
```
