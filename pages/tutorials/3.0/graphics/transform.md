
# Position, rotation, scale: Transforming entities

## Transforming SFML entities

All SFML classes (sprites, text, shapes) use the same interface for transformations: [`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation").
This base class provides a simple API to move, rotate, and scale your entities.
It doesn't provide maximum flexibility, but instead defines an interface which is easy to understand and to use, and which covers 99% of all use cases -- for the remaining 1%, see the last chapters.

[`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation") (and all its derived classes) defines four properties: **position**, **rotation**, **scale** and **origin**.
They all have their respective getters and setters.
These transformation components are all independent of one another: If you want to change the orientation of the entity, you just have to set its rotation property.
You don't have to care about the current position and scale.

### Position

The position of the entity refers to its position in world coordinates, not screen coordinates.

```cpp
// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute position of the entity
entity.setPosition({10.f, 50.f});

// move the entity relatively to its current position
entity.move({5.f, 5.f});

// retrieve the absolute position of the entity
sf::Vector2f position = entity.getPosition(); // = (15, 55)
```

![A translated entity](https://www.sfml-dev.org/tutorials/2.6/images/graphics-transform-position.png)

By default, entities are positioned relative to their top-left corner.
We'll see how to change that with the 'origin' property later.

### Rotation

The rotation is the orientation of the entity in the 2D world clockwise from the origin (because the Y axis is pointing down in SFML).

```cpp
// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute rotation of the entity
entity.setRotation(sf::degrees(45);

// rotate the entity relatively to its current orientation
entity.rotate(sf::degrees(10));

// retrieve the absolute rotation of the entity
sf::Angle rotation = entity.getRotation(); // = 55 degrees
```

![A rotated entity](https://www.sfml-dev.org/tutorials/2.6/images/graphics-transform-rotation.png)

Note that SFML always returns an `sf::Angle` in range [0, 360) degrees or [0, 2 * pi) radian when you call `getRotation`.

As with the position, the rotation is performed around the top-left corner by default, but this can be changed by setting the origin.

### Scale

The scale factor allows the entity to be resized.
The default scale is 1.
Setting it to a value less than 1 makes the entity smaller, greater than 1 makes it bigger.
Negative scale values are also allowed, so that you can mirror the entity.

```cpp
// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute scale of the entity
entity.setScale({4.f, 1.6f});

// scale the entity relatively to its current scale
entity.scale({0.5f, 0.5f});

// retrieve the absolute scale of the entity
sf::Vector2f scale = entity.getScale(); // = (2.f, 0.8f)
```

![A scaled entity](https://www.sfml-dev.org/tutorials/2.6/images/graphics-transform-scale.png)

### Origin

The origin is the center point of the three other transformations.
The entity's position is the position of its origin, its rotation is performed around the origin, and the scale is applied relative to the origin as well.
By default, the origin is positioned at the top-left corner of the entity (point (0, 0)), but you can set it to the center of the entity, or any other corner of the entity for example.

To keep things simple, there's only a single origin for all three transformation components.
This means that you can't position an entity relative to its top-left corner while rotating it around its center for example.
If you need to do such things, have a look at the next chapters.

```cpp
// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the origin of the entity
entity.setOrigin({10.f, 20.f});

// retrieve the origin of the entity
sf::Vector2f origin = entity.getOrigin(); // = (10.f, 20.f)
```

Note that changing the origin also changes where the entity is drawn on screen, even though its position property hasn't changed.
If you don't understand why, read this tutorial one more time!

## Transforming your own classes

[`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation") is not only made for SFML classes, it can also be a base (or member) of your own classes.

```cpp
class MyGraphicalEntity : public sf::Transformable
{
    // ...
};

MyGraphicalEntity entity;
entity.setPosition({10.f, 30.f});
entity.setRotation(sf::degrees(110.f));
entity.setScale({0.5f, 0.2f});
```

To retrieve the final transform of the entity (commonly needed when drawing it), call the `getTransform` function.
This function returns a [`sf::Transform`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transform.php "sf::Transform documentation") object.
See below for an explanation about it, and how to use it to transform an SFML entity.

If you don't need/want the complete set of functions provided by the [`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation") interface, don't hesitate to simply use it as a member instead and provide your own functions on top of it.
It is not abstract, so it is possible to instantiate it instead of only being able to use it as a base class.

## Custom transforms

The [`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation") class is easy to use, but it is also limited.
Some users might need more flexibility.
They might need to specify a final transformation as a custom combination of individual transformations.
For these users, a lower-level class is available: [`sf::Transform`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transform.php "sf::Transform documentation").
It is nothing more than a 3x3 matrix, so it can represent any transformation in 2D space.

There are many ways to construct a [`sf::Transform`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transform.php "sf::Transform documentation"):

- by using the predefined functions for the most common transformations (translation, rotation, scale)
- by combining two transforms
- by specifying its 9 elements directly

Here are a few examples:

```cpp
// the identity transform (does nothing)
sf::Transform t1 = sf::Transform::Identity;

// a rotation transform
sf::Transform t2;
t2.rotate(sf::degrees(45.f));

// a custom matrix
sf::Transform t3(2.f, 0.f, 20.f,
                 0.f, 1.f, 50.f,
                 0.f, 0.f, 1.f);

// a combined transform
sf::Transform t4 = t1 * t2 * t3;
```

You can apply several predefined transformations to the same transform as well.
They will all be combined sequentially.
Note that transforming an object by combining multiple transformations is equivalent to applying each operation in reverse order.
The last operation (here `scale`) is applied first, and will be affected by operations above it in code (second would be `translate({-10.f, 50.f})`, for example).

```cpp
sf::Transform t;
t.translate({10.f, 100.f});
t.rotate(sf::degrees(90.f));
t.translate({-10.f, 50.f});
t.scale({0.5f, 0.75f});
```

Back to the point: How can a custom transform be applied to a graphical entity? Simple: Pass it to the draw function.

```cpp
window.draw(entity, transform);
```

... which is in fact a short-cut for:

```cpp
sf::RenderStates states;
states.transform = transform;
window.draw(entity, states);
```

If your entity is a [`sf::Transformable`](https://www.sfml-dev.org/documentation/3.0.0/classsf_1_1Transformable.php "sf::Transformable documentation") (sprite, text, shape), which contains its own internal transform, both the internal and the passed transform are combined to produce the final transform.

## Bounding boxes

After transforming entities and drawing them, you might want to perform some computations using them e.g. checking for collisions.

SFML entities can give you their bounding box.
The bounding box is the minimal rectangle that contains all points belonging to the entity with sides aligned to the X and Y axes.

![Bounding box of entities](https://www.sfml-dev.org/tutorials/2.6/images/graphics-transform-bounds.png)

The bounding box is very useful when implementing collision detection: Checks against a point or another axis-aligned rectangle can be done very quickly, and its area is close enough to that of the real entity to provide a good approximation.

```cpp
// get the bounding box of the entity
sf::FloatRect boundingBox = entity.getGlobalBounds();

// check collision with a point
sf::Vector2f point = ...;
if (boundingBox.contains(point))
{
    // collision!
}

// check collision with another box (like the bounding box of another entity)
sf::FloatRect otherBox = ...;
if (boundingBox.intersects(otherBox))
{
    // collision!
}
```

The function is named `getGlobalBounds` because it returns the bounding box of the entity in the global coordinate system, i.e. after all of its transformations (position, rotation, scale) have been applied.

There's another function that returns the bounding box of the entity in its *local* coordinate system (before its transformations are applied): `getLocalBounds`.
This function can be used to get the initial size of an entity, for example, or to perform more specific calculations.

## Object hierarchies (scene graph)

With the custom transforms seen previously, it becomes easy to implement a hierarchy of objects in which children are transformed relative to their parent.
All you have to do is pass the combined transform from parent to children when you draw them, all the way until you reach the final drawable entities (sprites, text, shapes, vertex arrays or your own drawables).

```cpp
// the abstract base class
class Node
{
public:
    // ... functions to transform the node

    // ... functions to manage the node's children

    void draw(sf::RenderTarget& target, const sf::Transform& parentTransform) const
    {
        // combine the parent transform with the node's one
        sf::Transform combinedTransform = parentTransform * m_transform;

        // let the node draw itself
        onDraw(target, combinedTransform);

        // draw its children
        for (auto& child : m_children)
            child->draw(target, combinedTransform);
    }

private:
    virtual void onDraw(sf::RenderTarget& target, const sf::Transform& transform) const = 0;

    sf::Transform      m_transform;
    std::vector<Node*> m_children;
};

// a simple derived class: a node that draws a sprite
class SpriteNode : public Node
{
public:
    // ... functions to define the sprite

private:
    void onDraw(sf::RenderTarget& target, const sf::Transform& transform) const override
    {
        target.draw(m_sprite, transform);
    }

    sf::Sprite m_sprite;
};
```
