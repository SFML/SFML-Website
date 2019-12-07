<?php

    $title = "Position, rotation, scale: Transforming entities";
    $page = "graphics-transform.php";

    require("header.php");

?>

<h1>Position, rotation, scale: Transforming entities</h1>

<?php h2('Transforming SFML entities') ?>
<p>
    All SFML classes (sprites, text, shapes) use the same interface for transformations: <?php class_link('Transformable') ?>. This base class provides a simple API to move,
    rotate and scale your entities. It doesn't provide maximum flexibility, but instead defines an interface which is easy to understand and to use, and which covers 99%
    of all use cases -- for the remaining 1%, see the last chapters.
</p>
<p>
    <?php class_link('Transformable') ?> (and all its derived classes) defines four properties: <strong>position</strong>, <strong>rotation</strong>, <strong>scale</strong>
    and <strong>origin</strong>. They all have their respective getters and setters. These transformation components are all independent of one another: If you want to change the
    orientation of the entity, you just have to set its rotation property, you don't have to care about the current position and scale.
</p>
<h3>Position</h3>
<p>
    The position is the... position of the entity in the 2D world. I don't think it needs more explanation :).
</p>
<pre><code class="cpp">// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute position of the entity
entity.setPosition(10.f, 50.f);

// move the entity relatively to its current position
entity.move(5.f, 5.f);

// retrieve the absolute position of the entity
sf::Vector2f position = entity.getPosition(); // = (15, 55)
</code></pre>
<img class="screenshot" src="images/graphics-transform-position.png" alt="A translated entity"/>
<p>
    By default, entities are positioned relative to their top-left corner. We'll see how to change that with the 'origin' property later.
</p>

<h3>Rotation</h3>
<p>
    The rotation is the orientation of the entity in the 2D world. It is defined in <em>degrees</em>, in clockwise order (because the Y axis is pointing down in SFML).
</p>
<pre><code class="cpp">// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute rotation of the entity
entity.setRotation(45.f);

// rotate the entity relatively to its current orientation
entity.rotate(10.f);

// retrieve the absolute rotation of the entity
float rotation = entity.getRotation(); // = 55
</code></pre>
<img class="screenshot" src="images/graphics-transform-rotation.png" alt="A rotated entity"/>
<p>
    Note that SFML always returns an angle in range [0, 360) when you call <code>getRotation</code>.
</p>
<p>
    As with the position, the rotation is performed around the top-left corner by default, but this can be changed by setting the origin.
</p>

<h3>Scale</h3>
<p>
    The scale factor allows the entity to be resized. The default scale is 1. Setting it to a value less than 1 makes the entity smaller, greater than 1 makes it bigger. Negative scale values are also allowed,
    so that you can mirror the entity.
</p>
<pre><code class="cpp">// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the absolute scale of the entity
entity.setScale(4.f, 1.6f);

// scale the entity relatively to its current scale
entity.scale(0.5f, 0.5f);

// retrieve the absolute scale of the entity
sf::Vector2f scale = entity.getScale(); // = (2, 0.8)
</code></pre>
<img class="screenshot" src="images/graphics-transform-scale.png" alt="A scaled entity"/>

<h3>Origin</h3>
<p>
    The origin is the center point of the three other transformations. The entity's position is the position of its origin, its rotation is performed around the origin, and the scale is
    applied relative to the origin as well. By default, it is the top-left corner of the entity (point (0, 0)), but you can set it to the center of the entity, or any other corner of the entity
    for example.
</p>
<p>
    To keep things simple, there's only a single origin for all three transformation components. This means that you can't position an entity relative to its
    top-left corner while rotating it around its center for example. If you need to do such things, have a look at the next chapters.
</p>
<pre><code class="cpp">// 'entity' can be a sf::Sprite, a sf::Text, a sf::Shape or any other transformable class

// set the origin of the entity
entity.setOrigin(10.f, 20.f);

// retrieve the origin of the entity
sf::Vector2f origin = entity.getOrigin(); // = (10, 20)
</code></pre>
<p>
    Note that changing the origin also changes where the entity is drawn on screen, even though its position property hasn't changed. If you don't understand why,
    read this tutorial one more time!
</p>

<?php h2('Transforming your own classes') ?>
<p>
    <?php class_link('Transformable') ?> is not only made for SFML classes, it can also be a base (or member) of your own classes.
</p>
<pre><code class="cpp">class MyGraphicalEntity : public sf::Transformable
{
    // ...
};

MyGraphicalEntity entity;
entity.setPosition(10.f, 30.f);
entity.setRotation(110.f);
entity.setScale(0.5f, 0.2f);
</code></pre>
<p>
    To retrieve the final transform of the entity (commonly needed when drawing it), call the <code>getTransform</code> function. This function returns a
    <?php class_link('Transform') ?> object. See below for an explanation about it, and how to use it to transform an SFML entity.
</p>
<p>
    If you don't need/want the complete set of functions provided by the <?php class_link('Transformable') ?> interface, don't hesitate to simply use it as a member instead
    and provide your own functions on top of it. It is not abstract, so it is possible to instantiate it instead of only being able to use it as a base class.
</p>

<?php h2('Custom transforms') ?>
<p>
    The <?php class_link('Transformable') ?> class is easy to use, but it is also limited. Some users might need more flexibility. They might need to specify a final transformation as
    a custom combination of individual transformations. For these users, a lower-level class is available: <?php class_link('Transform') ?>. It is nothing more than
    a 3x3 matrix, so it can represent any transformation in 2D space.
</p>
<p>
    There are many ways to construct a <?php class_link('Transform') ?>:
</p>
<ul>
    <li>by using the predefined functions for the most common transformations (translation, rotation, scale)</li>
    <li>by combining two transforms</li>
    <li>by specifying its 9 elements directly</li>
</ul>
<p>
    Here are a few examples:
</p>
<pre><code class="cpp">// the identity transform (does nothing)
sf::Transform t1 = sf::Transform::Identity;

// a rotation transform
sf::Transform t2;
t2.rotate(45.f);

// a custom matrix
sf::Transform t3(2.f, 0.f, 20.f,
                 0.f, 1.f, 50.f,
                 0.f, 0.f, 1.f);

// a combined transform
sf::Transform t4 = t1 * t2 * t3;
</code></pre>
<p>
    You can apply several predefined transformations to the same transform as well. They will all be combined sequentially, in reverse order: the last operation (here <code>scale</code>) is applied first, and will be affected by operations above it in code (second would be <code>translate(-10.f, 50.f)</code>, for example).
</p>
<pre><code class="cpp">sf::Transform t;
t.translate(10.f, 100.f);
t.rotate(90.f);
t.translate(-10.f, 50.f);
t.scale(0.5f, 0.75f);
</code></pre>
<p>
    Back to the point: How can a custom transform be applied to a graphical entity? Simple: Pass it to the draw function.
</p>
<pre><code class="cpp">window.draw(entity, transform);
</code></pre>
<p>
    ... which is in fact a short-cut for:
</p>
<pre><code class="cpp">sf::RenderStates states;
states.transform = transform;
window.draw(entity, states);
</code></pre>
<p>
    If your entity is a <?php class_link('Transformable') ?> (sprite, text, shape), which contains its own internal transform, both the internal and the passed transform are combined to produce the final transform.
</p>

<?php h2('Bounding boxes') ?>
<p>
    After transforming entities and drawing them, you might want to perform some computations using them e.g. checking for collisions.
</p>
<p>
    SFML entities can give you their bounding box. The bounding box is the minimal rectangle that contains all points belonging to the entity, with sides aligned to the X and Y axes.
</p>
<img class="screenshot" src="images/graphics-transform-bounds.png" alt="Bounding box of entities"/>
<p>
    The bounding box is very useful when implementing collision detection: Checks against a point or another axis-aligned rectangle can be done very quickly, and its area is close enough
    to that of the real entity to provide a good approximation.
</p>
<pre><code class="cpp">// get the bounding box of the entity
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
</code></pre>
<p>
    The function is named <code>getGlobalBounds</code> because it returns the bounding box of the entity in the global coordinate system, i.e. after all of its
    transformations (position, rotation, scale) have been applied.
</p>
<p>
    There's another function that returns the bounding box of the entity in its <em>local</em> coordinate system (before its transformations are applied):
    <code>getLocalBounds</code>. This function can be used to get the initial size of an entity, for example, or to perform more specific calculations.
</p>

<?php h2('Object hierarchies (scene graph)') ?>
<p>
    With the custom transforms seen previously, it becomes easy to implement a hierarchy of objects in which children are transformed relative to their parent.
    All you have to do is pass the combined transform from parent to children when you draw them, all the way until you reach the final drawable entities (sprites, text, shapes,
    vertex arrays or your own drawables).
</p>
<pre><code class="cpp">// the abstract base class
class Node
{
public:

    // ... functions to transform the node

    // ... functions to manage the node's children

    void draw(sf::RenderTarget&amp; target, const sf::Transform&amp; parentTransform) const
    {
        // combine the parent transform with the node's one
        sf::Transform combinedTransform = parentTransform * m_transform;

        // let the node draw itself
        onDraw(target, combinedTransform);

        // draw its children
        for (std::size_t i = 0; i &lt; m_children.size(); ++i)
            m_children[i]->draw(target, combinedTransform);
    }

private:

    virtual void onDraw(sf::RenderTarget&amp; target, const sf::Transform&amp; transform) const = 0;

    sf::Transform m_transform;
    std::vector&lt;Node*&gt; m_children;
};

// a simple derived class: a node that draws a sprite
class SpriteNode : public Node
{
public:

    // .. functions to define the sprite

private:

    virtual void onDraw(sf::RenderTarget&amp; target, const sf::Transform&amp; transform) const
    {
        target.draw(m_sprite, transform);
    }

    sf::Sprite m_sprite;
};
</code></pre>

<?php

    require("footer.php");

?>
