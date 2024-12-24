---
hide:
  - footer
---

# Graphics

## What image formats does SFML support? {: #image-formats}

SFML can load the following file formats: bmp, dds, jpg, png, tga, psd  
But keep in mind that not all variants of each format are supported.

Also see the official [documentation](https://www.sfml-dev.org/documentation/latest/classsf_1_1Image.php#a9e4f2aa8e36d0cabde5ed5a4ef80290b).

## Why do I get a white/black rectangle instead of my texture? {: #white-rect}

This is due to a premature destruction of the `sf::Texture`.
An `sf::Sprite` only holds a reference to the `sf::Texture` bound to it.
You have to keep the `sf::Texture` "alive" as long as the sprite uses it.
It can also be that you never bound a texture to the sprite, hence you need to call `setTexture()` with the initial texture it is to use.

When your texture is relocated from one memory location to another you have to inform your sprite of this using its `setTexture()` function as well or better yet by managing your textures in a way that won't

## What is the difference between sf::Image and sf::Texture? {: #image-texture}

In essence, there is no difference between the two data structures.
The main question you have to ask yourself is not what the difference is, but where the data is stored.

In the case of `sf::Image`, the image data is stored in client-side memory, meaning in your system RAM.
In there it is just an array of bytes (4 per pixel) that make up the image you can see on your screen.

In the case of `sf::Texture`, it is also image data, however this data resides in server-side memory, meaning in your graphics RAM next to your GPU.
This memory is managed completely by OpenGL and the `sf::Texture` is merely a handle to that block of memory in graphics RAM.
There are many forms of storage of textures but SFML uses the same layout for `sf::Texture` as it does for `sf::Image` namely quad-byte RGBA.

You can convert freely between sf::Image and sf::Texture, however just keep in mind that the bus bandwidth is limited and doing this too often means you are transferring a lot of data between graphics RAM and system RAM leading to a slowdown of all graphics related operations.

## My FPS count drops when drawing a lot of sprites {: #sprites}

This may happen due to many reasons, some may depend on the code and circumstances, but a possible bottleneck is the amount of draw calls.
When using a lot of `sf::Sprites` you need to make an equal amount of draw calls to make them show.

As each draw call changes the render target, it can become slow to modify it in n-amount of loops and calls when it would be most efficient to do it in just one.
The reason SFML doesn't work like this is, that it would limit what you can do with `sf::Sprite` and would force the usage of a single texture in cases where this might not be desirable or even possible due to GPU limitations.

In order to raise FPS in this circumstance there is no choice other than using bare `sf::Vertex`/`sf::VertexArray` or finding another way to achieve the same effect.
These on their own however won't be magical and a wrapper will most likely help do the desired render in a nice looking notation.

In the [SFML Wiki Source Codes](https://github.com/SFML/SFML/wiki/Sources) section you can find some classes used for fast rendering in some cases such as Tile-Map renderers or containers for transformable sprites that use the same texture.

## Should I use VSync, window.setFramerateLimit or something else? {: #vsync-framelimit}

It really depends on what you are trying to achieve.
In a broader sense, both enabling vertical synchronization and limiting the framerate achieve the same results, however, the devil is in the details.

Originally, with cathode-ray tube (CRT) displays, an electron beam would be diverted by magnetic fields both in horizontal and vertical directions.
You can think of the beam as a sort of "pen" drawing onto each pixel of your screen each and every frame.
Naturally, it takes time for the beam to travel from the starting position to the ending position of each frame, and this is what dictates the maximum refresh rate the display will support.
The electrical fields merely divert the beam, but if there was only a single beam, you would only see a single color on your screen.
In order to get the full color palette, 3 beams are used, one for each color channel.
The intensity of each beam hitting a pixel of the screen leads to different intensities in each color channel and is controlled by the data that the display is sent by the graphics card.

In an ideal scenario, the monitor would be sent a new set of data exactly once every refresh, right before the beams start traveling.
This would mean that the GPU is synchronized with the monitor, as it delays updating the framebuffer until the beams are at the starting position.
If the framebuffer would be changed while the beams are mid-way through the screen, you would see half of the old image and half of the new one.
This is known as **tearing** and is the primary purpose why vertical synchronization was necessary and still exists today.
In the future however, it will become less and less of an issue and at some point, vertical synchronization will no longer be necessary and support probably removed from newer hardware.

VSync is typically implemented as a blocking call in the buffer swap in the driver, which is the only reason why it is viable and mistakenly used instead of the framerate limiter.
The driver simply isn't allowed to discard frames in order to synchronize, so if the application produces them too fast, it will have to be throttled through blocking.
If the application doesn't produce frames fast enough, the driver will have no choice but to duplicate them, possibly leading to strange results.
In most implementations, the driver will block in the buffer swap using a busy wait loop in order to get the precise timing required to satisfy the hardware constraints.
For this exact reason, **it might even be counter-productive to use VSync to save CPU power**.

With that out of the way, you might understand why you need VSync now.
It is to solve a _hardware limitation_.
Using it to limit your applications framerate in order to e.g.
make your computations more predictable or to save CPU power is simply misusing it.
For these use cases, the CPU framerate limiter exists, which yields the CPU time slice to other threads/processes or even truly puts the CPU to sleep if there is no work to be done.
Another caveat is that different systems have different hardware, and might end up having different refresh rates leading to different framerates if you rely on VSync to limit your framerate.
If your aim was to make your simulation more predictable across different systems, this is another reason why VSync doesn't help you.
**You should really only use VSync when you know you will have tearing problems and the framerate limiter for every other case.** In _very very advanced_ scenarios, people might even have to use both simultaneously, but those use cases are beyond the scope of this FAQ.

## Should I use one sprite or x sprites to draw x textures? {: #xsprite}

Generally, the less objects you have to draw, the faster your application will run.
This is almost always true.
If you can, you should try to group things that are always drawn together and draw them using a single sprite.
This will save you a lot of additional processing time.

What you should not do is only use a single `sf::Sprite` and keep binding different `sf::Textures` to it.
Although you are only using a single `sf::Sprite`, you are still creating as many draw calls as if you would have an `sf::Sprite` for each `sf::Texture`.
The overhead of rebinding an `sf::Texture` to the `sf::Sprite` many times during a frame will noticeably affect your performance.

You can also try to perform rudimentary culling.
Culling consists of not drawing things that you know cannot be seen anyway because they are entirely covered by something else.
If this can be done in your application and you prevent a lot of unneeded draw calls, you will gain performance.

## What is the difference between LocalBounds and GlobalBounds? {: #bounds}

To understand this, you will first need to understand the difference between the local and global coordinate systems.

To make this easier to understand, consider you went for a walk in the woods.
A friend calls you and and asks what you are doing.
When you tell them you are walking through the woods, they suggest they join you so that you both can talk a bit as well.
Obviously, a question that will eventually be asked is: "Where are you currently and where are you heading?" If you reply with: "I'm walking upstream along the river." They might tell you that they still have no idea where that is, since this woods is very large and there are multiple rivers that you could be walking along.
You understand and instead tell them your current GPS coordinates and your current heading using a compass.

What you initially told them is your position relative to the local coordinate system of the section of the woods you are in.
In this section of the woods, there is only a single river and thus telling anyone else in the same section of the woods you are walking upstream is sufficient to let them know where you are.
If you are outside of the woods, you have no choice but to use the global coordinate system, in this case, the WGS (GPS) coordinate system and heading.

In SFML, drawable object coordinate systems follow the same principle.
They can return their bounds both in their own local coordinate system as well as in the global coordinate system.
The global coordinate system is typically the coordinate system of the render target that ends up drawing the object.

Keeping this in mind, the local bounds of an object is always made up of a rectangle positioned at (0,0) _in the object's coordinate system_ and with a sufficient width and height to completely contain the object within it.

Another important thing to remember is: **In SFML, the bounds of an object are always expressed as an axis-aligned bounding box (AABB).** This is true even after rotating an object.

The global bounds of an object is simply the local bounds rectangle transformed by the object's stored transformation.
If the object itself is not positioned at (0,0) in the global coordinate system, its position offset will be the global bounding rectangle's position.
Now for the tricky part: **Rotation**.
If you want to understand how the width and height of the global bounds of a rotated object are computed, you have to imagine the local bounding rectangle as 4 points.
These 4 points are rotated by the stored rotation in the object's transform.
The final position of those points are then used to compute the new AABB that will contain all 4 of those rotated points.
If the object is not rotated in multiples of right-angles, following what was just explained, the global bounds of the object will almost always be larger than the local bounds of the object.
If this is hard to imagine, you can try drawing a rectangle on a sheet of paper, rotating it and drawing the new AABB around it after it is rotated.

## My FPS is very low when running my application {: #low-fps}

First thing is first, check that the FPS value isn't constantly hovering around _certain_ special values (60, 75, 80, 144, etc.).
If it does hover around those values no matter what you do, it is very likely that it is being artificially limited _somewhere_.
Double check that there are no such limitations before proceeding to the next steps.

A mistake that many people make when they talk about low FPS in their application is to assume that it is caused by their graphics.
It _might_ be the case, but it is not always the case.
Often, the application does _much_ more CPU work than real graphics work, and the application is CPU-bound as opposed to GPU-bound.
A rough way to estimate whether your application is CPU-bound is to monitor your application's CPU usage.
If it is close to 100% utilization, chances are high that it is CPU-bound.
In these cases, reducing the CPU load per frame will lead to shorter times per frame and accordingly more frames per given time period.

Once you have a feeling that your application is CPU-bound, the best tool to find the _hotspots_ (places where the CPU spends the most time) in your application is a performance profiler.
Any decent profiler will make it easy to find hotspots.
From there, you can try to optimize your code in terms of CPU (not GPU).

If however, you notice that your application is not CPU-bound and still have a low FPS value, you need to start assessing how you are drawing things.
SFML makes use of OpenGL to render.
A not so insignificant portion of the time spent drawing with OpenGL is spent in the driver and in the communication with the graphics hardware.
Naturally, if the driver has "less to do" and "has to communicate less" with the hardware, you will get better graphics performance.
This is the reason why one of the first optimizations is to consider batching multiple smaller objects into larger ones to be drawn at the same time.
SFML doesn't help you at all with this.
You will have to evaluate what the best course of action is and devise an optimized solution using the tools that SFML provides you.
A general rule of thumb when it comes to optimizing in this respect is: **The less `.draw()` calls you have each frame, the faster it will run.**

For more advanced optimization techniques, you can search the forum, or open a thread with the information you have gathered from the previous steps.

## RenderTextures don't work on my computer! {: #broken-rendertexture}

First of all, as with everything else sfml-graphics related, check if you have drivers installed that expose the hardware functionality that SFML uses.
If you have a system that came with pre-installed drivers, that still doesn't mean that they were bug-free or even supported everything that the hardware would be capable of.
There is never an excuse not to at least check for updated drivers and try to install them.
This might not always be possible, but for the majority of cases (and almost all the time for desktop computers) it is possible.

Once you are sure that your drivers are up-to-date, check if your graphics hardware supports OpenGL Framebuffer Objects (GL_EXT_framebuffer_object extension).
If you are sure it does and RenderTextures still don't work, open a thread on the forum with the information you have gathered and almost all the time, you will be assisted promptly.

If your graphics hardware doesn't support OpenGL Framebuffer objects, fear not, because SFML has a fallback implementation which uses an auxiliary context's framebuffer to render to.
The performance ranges from marginally slower than the native implementation to much slower e.g. in software renderers.

If the second variant doesn't work for you either, and you know that your hardware is somewhat capable, open a thread on the forum with the information you have gathered and a solution will be worked out most of the time.

## My animations/movements aren't smooth or exhibit stuttering! {: #smooth-animation}

The most common cause of this is because you are directly or indirectly relying on your application running at a fixed frame rate.
Frame rates cannot be reliably locked to a certain value without a lot of effort and knowledge of lower level operating system aspects.
The reasons for this are given [here](window.md#set-framerate-limit) and [here](system.md#sleep).
Using vertical synchronization is out of the question because this might result in different frame rates on different systems.

Suppose you have a simple loop as such:

```cpp
while (window.isOpen())
{
    // Event handling

    // Update sprite position
    sprite.move({1.f, 0.f});

    // Draw everything
    window.clear();
    window.draw(sprite);
    window.display();
}
```

This loop simply moves the sprite by 1 unit (be it raster position, pixel etc.) in the positive direction along the x-axis every frame and displays it.

The problem with this loop is that the change in position is made using a **fixed amount per frame**.
This means that the more frames pass, the more the sprite will move.
Assuming that the same number of frames pass in the same amount of time, this leads to the sprite moving at a constant velocity (keeping the same speed).
However, remembering what was said above, we cannot assume this to be the case.
**Frame rates will always vary**, and hence if the sprite moved a constant amount every frame, its apparent speed is based entirely on the frame rate of the system running the application.
The faster a frame completes, the more frames will pass in a given amount of time and the more the sprite will move in a given amount of time, hence the faster the apparent movement.

The solution to this problem is simply to make the movement of the sprite independent of the frame rate.

To implement this solution, one has to consider the **speed or velocity** of the sprite.
Speed is conventionally measured in m/s or km/h.
In any case, it is distance traveled divided by elapsed time.
What we have with the problematic implementation is a velocity specified in terms of pixels/frame and (considering a pixel as a distance in this simplification) a frame is not a unit of time.

The first step would be to specify the speed of the sprite, e.g.
100 pixels per second.

The next step would be to translate that speed into movement every frame.
We know that speed is distance traveled divided by time elapsed, so using simple mathematics we can translate 100 pixels per second and an elapsed time back into a distance traveled.

distance traveled = speed * elapsed time

This is considered as a simplification of integration in scientific contexts.

We have our speed, but how do we get the amount of time elapsed? Simple, with an `sf::Clock`.
If you don't know how to use an `sf::Clock`, it is suggested you refer to the [SFML tutorials and documentation](https://www.sfml-dev.org/learn.php).

The first step of each new frame would be to determine how much time has passed since the same line of code was executed during the previous frame.
This gives us a fairly accurate estimation of the true elapsed time which is more than enough for our intents.
Using this time, we simply multiply with the speed of the sprite to get the value by which it moved during the frame.

In code this would look like this:

```cpp
// Our speed in pixels per second
float speed = 100.f;

// Our clock to time frames
sf::Clock clock;

while (window.isOpen())
{
    // Event handling

    // Get elapsed time
    float delta = clock.restart().asSeconds();

    // Update sprite position
    sprite.move({speed * delta, 0.f});

    // Draw everything
    window.clear();
    window.draw(sprite);
    window.display();
}
```

This code will move the sprite at 100 pixels per second regardless of frame rate.

One thing to remember is that the physical units (pixels, meters, seconds, kilograms, etc.) you use in your code should be consistent.
This means that if you use pixels per second in your speed definitions, you should use the elapsed time in seconds as well.
If you don't match these up, you will get effects much more prominent or subtle than what you might expect, resulting in things disappearing out of sight because they move really fast as an example.

This is just one way out of many to deal with this issue.
It was presented here because it is the simplest to implement and explain in this FAQ.
