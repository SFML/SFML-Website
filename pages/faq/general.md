---
hide:
  - footer
---

# About SFML

## What is SFML? {: #whatis}

SFML is a simple to use and portable API written in C++.
You can think of it as an object oriented SDL.
SFML is made of modules in order to be as useful as possible for everyone.
You can use SFML as a minimalist window system in order to use OpenGL, or as a complete multimedia library full of features to build video games or multimedia softwares.

## On which platforms is SFML currently available? {: #platforms}

SFML is available on Windows (7 and newer), Linux and macOS, as well as on Android and iOS.
On Windows, SFML works on both 32-bit and 64-bit systems, on macOS both Intel and Apple Silicon (ARM64) Macs are supported.
The [download page](../download/index.md) lists the prebuilt packages for each platform.

## Which programming languages are supported by SFML? {: #languages}

SFML is implemented in C++.
That said, the SFML Team maintains bindings for [C](../download/csfml/index.md) and [.NET](../download/sfml.net/index.md), and the community has created [bindings](../download/bindings/index.md) for many other languages, such as Python, Rust, Go, Ruby, Java, D or Zig.

## What version of SFML should I use? {: #version}

Go for the latest SFML 3 version, because you'll get a stable release with the latest features and bugfixes.
SFML 3 requires a C++17 compiler.
Only stay on SFML 2.6 if you maintain an existing project that hasn't been migrated yet, older versions such as 1.6 are not maintained anymore, contain quite a few critical bugs and lack a lot of useful features.

## Will/does SFML support 3D? {: #3d}

No, and the SFML Team has decided to keep the library as a way to handle 2D graphics with ease and hardware acceleration, so in short there won't be support for 3D in the future either.
However you can use SFML to create the window and OpenGL context, and use raw OpenGL to implement 3D and have it alongside your 2D rendering in SFML without problems.

The previous statement is recommendable only if you have a minimal use for 3D, as it becomes very hard and tedious to manage full 3D functionality through graphics pipeline only.

## I want to propose a new feature! {: #request}

See our [Contribution Guidelines](../development/contribute.md#requesting-features).

## Is using SFML a good way to learn to program (in C++)? {: #learn}

In general, you can learn to program any way you want.
The question is: what is the most **effective** way to learn to program? The unanimous answer to this question is, don't start with SFML if you are trying to grasp the basic language features of C++.
SFML makes use of basic as well as advanced features of the C++ language.
You might be able to achieve something in your first hours of C++ and SFML but whether it is usable and maintainable is another question.
It is probable that you would have learned more and faster if you just stuck to the standard libraries C++ already provides.
This allows you to focus on learning the language and not the SFML API at the same time.
There are many good examples of text-based games made using just stdin and stdout.

Where you learn to program (in C++) from is also totally up to you.
However it is recommended to always take examples/tutorials available on the internet with a pinch of salt.
They might contain bad habits of the writer which are not apparent to a newcomer.
The safest way to learn to program is probably accompanied by a book written by a reputable author who is actively involved in the development of the language (see [this list](https://stackoverflow.com/questions/388242/the-definitive-c-book-guide-and-list)).
This ensures that they grasp the important aspects of the language and can teach you to program effectively as well.
Contrary to what many newcomers believe, C++ is still evolving and gets a new standard every three years since C++11.
Learning from an older book or internet source might therefore not teach you all the aspects of the language there are and worse teach you old practices, which are no longer recommended.
It is therefore recommended that you actively seek to learn about these new features on your own after you have grasped the basics.

If you are unsure when you might consider yourself ready for SFML, here is a checklist of language features that are highly recommended to know when using SFML.

Basics, required to program with SFML:

- Compiling, building
- Basic program structure (main(), header includes ...)
- Basic data types
- Composite data types
- Control structures (if, for, while ...)
- Basic functions, function signatures
- Function parameter passing
- Classes and general OOP
- STL - Standard Template Library
- Dynamic memory allocation, pointers
- Type casting
- Advanced OOP, inheritance, polymorphism
- Advanced program structure, header files, linking
- **Debugging techniques:** This is important to be able to help yourself when the situation arises.

Advanced concepts, not all required to program with SFML but good to know:

- Templates
- Operator overloading
- Namespaces
- Move semantics and other C++11 features
- Metaprogramming

Maintenance/productivity related skills, also not required but good to know:

- Profiling
- Optimization techniques, compiler optimization opportunities
- Coding conventions
- Refactoring techniques
- Code organization: abstraction, modularity, separation of responsibilities
- [Idioms](https://en.wikibooks.org/wiki/More_C%2B%2B_Idioms): RAII, Pimpl, Erase-Remove, Copy & Swap
- Advanced data structures and algorithms
- Library writing, API design
- Cross-platform build tools
- SCM such as git, SVN or Hg

Deeper understanding, good to know to understand what is happening "behind the scenes":

- Graphics pipeline, OpenGL
- Networking, TCP, UDP
- Audio knowledge, sample rate, attenuation, wave characteristics
- Operating system knowledge (not only for a single operating system)
- Computer hardware: CPU, instructions and pipelining, RAM, caching, paging
