---
hide:
  - footer
---

# General

### What is SFML? {: #whatis}

SFML is a simple to use and portable API written in C++.
You can think of it as an object oriented SDL.
SFML is made of modules in order to be as useful as possible for everyone.
You can use SFML as a minimalist window system in order to use OpenGL, or as a complete multimedia library full of features to build video games or multimedia softwares.

### On which platforms is SFML currently available? {: #platforms}

The latest version of SFML is currently available and fully functional on Windows (10, 8, 7, Vista, XP), Linux and macOS.
SFML works on both 32 and 64 bit systems.
If older Windows versions need to be supported, it should be possible to use SFML 2.0 instead (see [the commit](https://github.com/SFML/SFML/commit/cd68d662043c2305990d1b6b559b0138bd77af14) for removal of Windows 9x and similar).
Since SFML 2.2, there has also been experimental support for iOS and Android, which have taken great shape over the years and should be working quite stable.

### Which programming languages are supported by SFML? {: #languages}

SFML is implemented in C++.
That said, several [bindings](../download/bindings.md) have been created for other languages that allow SFML to be used from C, C#, C++/CLI, D, Ruby, OCaml, Java, Python and VB.NET.

### What dependencies does SFML have? {: #dependencies}

SFML depends on a few other libraries, so before starting to compile you must have their development files installed.

On Windows and macOS, all the needed dependencies are provided directly with SFML, so you don't have to download/install anything.
Compilation will work out of the box.

On Linux however, nothing is provided and SFML relies on your own installation of the libraries it depends on.
Here is a list of what you need to install before compiling SFML:

- pthread
- opengl
- xlib
- xi
- udev
- xrandr
- xcursor
- freetype
- flac
- vorbis

The exact name of the packages depend on each distribution.
And don't forget to install the development version of these packages.

SFML has also internal dependencies: Audio and Window depend on System, while Graphics depends on System and Window.
In order to use the Graphics module, you must link with Graphics, Window, and System (the order of linkage matters with GCC).

### What version of SFML should I use? {: #version}

Go for the latest SFML version, because you'll get a stable release with the latest features and bugfixes.
As such it will save you a lot of headaches because other versions such as 1.6 are not maintained anymore, contain quite a few critical bugs and lack a lot of useful features.

### Is there a complete list with all the changes from SFML 2.x to SFML 3.0? {: #changes-3-0}

See the [official migration guide](../tutorials/3.0/getting-started/migrate.md) to get your code base updated to SFML 3.

### Is there a complete list with all the changes from SFML 1.6 to SFML 2.x? {: #changes}

This non-exhaustive list can be used as a starting point: [SFML Forum](https://en.sfml-dev.org/forums/index.php?topic=5343.0)  
It however does not contain all changes made between 1.6 and 2.0.
It was written more than a year ago and since then a few major changes have been made including:

- Rewrite of the graphics API
- New `sf::Time` API
- Removal of the default built-in Arial font
- Replaced `getWidth()` and `getHeight()` with `getSize()`
- Naming convention change (further details and rationale [here](https://en.sfml-dev.org/forums/index.php?topic=6709.0))

### Will/does SFML support 3D? {: #3d}

No, and the SFML Team has decided to keep the library as a way to handle 2D graphics with ease and hardware acceleration, so in short there won't be support for 3D in the future either.
However you can use libraries such as Irrlicht with SFML as a window creator.
You could also use raw OpenGL to implement 3D and have it alongside your 2D rendering in SFML without problems.

The previous statement is recommendable only if you have a minimal use for 3D, as it becomes very hard and tedious to manage full 3D functionality through graphics pipeline only.

### I want to propose a new feature! {: #request}

See our [Contribution Guidelines](../development/contribute.md#requesting-features).

### Is using SFML a good way to learn to program (in C++)? {: #learn}

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
Contrary to what many newcomers believe, C++ is still evolving and has done so even more over the last years with the standardization of C++11, C++14 and C++17.
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

### Where can I ask questions? {: #questions}

First make sure you've read [the tutorials and the documentation](../learn/index.md), then check whether the question has already been asked before.
If after that you still have a question **regarding SFML**, ask on the [SFML forum](https://en.sfml-dev.org/forums/index.php#c3).

Additionally you can find people on the [official Discord or IRC server](../community/index.md).

Keep in mind that using SFML is not a very suitable way to [learn the bare basics of C++ programming](#learn), and as such it is recommended that any questions regarding general C++ be asked in more adequate forums where people proficient in C++ can help you better.