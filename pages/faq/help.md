---
hide:
  - footer
---

# Getting Help

## Where can I ask questions? {: #questions}

First make sure you've read [the tutorials and the documentation](../learn/index.md), then check whether the question has already been asked before.
If after that you still have a question **regarding SFML**, ask on the [SFML forum](https://en.sfml-dev.org/forums/index.php#c3).

Additionally you can find people on the [official Discord or IRC server](../community/index.md).

Keep in mind that using SFML is not a very suitable way to [learn the bare basics of C++ programming](general.md#learn), and as such it is recommended that any questions regarding general C++ be asked in more adequate forums where people proficient in C++ can help you better.

## I found a bug! {: #grl-i-found-a-bug}

Most of the time any unexpected behavior is a result of misunderstanding how to use SFML.
Out of many bug reports only few of them turn out to be real bugs **which are caused by SFML itself and nothing else**.

If you are using the latest SFML version, try building the latest master revision available on [GitHub](https://github.com/SFML/SFML/).
There are many things that might have already been fixed between the release which is available on the site and the latest development version.

If the bug is still present in the latest master version, try to produce a [minimal compilable code example](#grl-minimal) that displays the bug and nothing else.
That way the developers and others can focus on why it is occurring.

If you can reproduce what you think is a bug, if you have another computer at your disposal, try to run it there as well.
If the bug does not occur there, try to reconfigure the corresponding hardware/software settings on the first PC.
A lot of strange behavior is a result of misconfigured/faulty software/drivers.

!!! Warning

    Trying to report a bug that is a result of the usage of beta drivers is not a good idea.
    The source of the problem does not lie within the responsibility of the SFML developers and as such they can't do much to fix it themselves.

When you are sure that the bug is a result of SFML internals and is platform independent, you can go ahead and post in the forum of the package in question, and don't forget to provide a precise description of your problem, the version of SFML you're using, your system configuration, and the compilable code, and if the situation requires, the logs of your compiler and/or linker.
Also make sure that the bug hasn't already been reported (use the [search function](https://en.sfml-dev.org/forums/index.php?action=search)), confirmed (look on the [issue tracker](https://github.com/SFML/SFML/issues?q=is%3Aopen)) or even resolved in the latest source (check also the [closed issues](https://github.com/SFML/SFML/issues?q=is%3Aclosed)).

## What is a minimal code? {: #grl-minimal}

A minimal code example is a snippet of source code that is compilable with very little effort.

This implies that:

- it consists of a single file (no extra .h, .hpp or .cpp files)
- there are no special compiler/linker options that need to be set
- the provided code is specific to the matter at hand and does not do more than it needs to

Such an example should never have to be longer than 40 lines of code (including the header include lines which of course have to be provided as well) unless it only happens in very specific cases.

An example of minimal code:

```cpp
#include <SFML/Graphics.hpp>

int main()
{
    sf::RenderWindow window(sf::VideoMode({640, 480}), "Bug");

    // Some bug specific code here...

    while (window.isOpen())
    {
        while (const std::optional event = window.pollEvent())
        {
            if (event->is<sf::Event::Closed>())
                window.close();
        }

        // ... and here.

        window.clear();
        window.display();
    }
}
```

See also [the rules](https://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368) for further details.

## And how can I easily obtain this minimal code? {: #grl-obtain-minimal}

Easy :

- Create a separate sandbox project with a single file consisting of a `main()` function
- Copy and paste your code into the body of the `main()` in such a way that it can compile
- One by one delete all lines which are not relevant to the actual problem and try to compile after every deletion to see if the problem still persists

Side note: This technique will often help you troubleshoot the problem on your own.
