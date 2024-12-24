---
hide:
  - footer
---

# Building and Using SFML

### How do I build SFML? {: #build}

Tutorials for each version of SFML can be found [here](https://www.sfml-dev.org/tutorials/).
The first part of these tutorials is aimed at getting started, which includes building SFML with CMake and your build tool of choice, as well as setting up your IDE (if you use one) for use with SFML.

### Are there any "nightly builds"? {: #nightly}

Our CI (continuous integration) system is building every commit on the master branch and saving the built binaries as artifacts, ready to be downloaded.
You can find them either by commit hash or branch name.

[Link to the artifacts](https://www.sfml-dev.org/artifacts/)

### How do I setup my development environment to work with SFML? {: #environment}

This is covered quite thoroughly in the tutorials section for some of the most popular IDEs.

Check out the Getting Started sections of the [/tutorials/](https://www.sfml-dev.org/learn.php).

### What and how do I link to use SFML? {: #link}

When you want to use SFML, you need to link to the library files that provide the functionality you make use of in your application.

SFML is divided into 5 modules:

- **System** _provided by sfml-system_
- **Window** _provided by sfml-window_
- **Graphics** _provided by sfml-graphics_
- **Audio** _provided by sfml-audio_
- **Network** _provided by sfml-network_

Be aware that the modules have interdependencies on each other.
For instance, if you plan on using the Graphics module, you will also have to link against the Window and System modules as well.

Dependencies:

- **System** does not depend on anything and can be used by itself.
- **Window** depends on **System**.
- **Graphics** depends on **Window** and **System**.
- **Audio** depends on **System**.
- **Network** depends on **System**.

As you can see you will always have to link against sfml-system, no matter what you do.

Be aware that some linkers are sensitive to the order in which you specify libraries to link against.

GCC (which implies MinGW as well) requires that the dependees (libraries that others depend on) are specified after the dependers (libraries that depend on others).

An example of a GCC command line linking all modules would be as follows:

```
g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-audio -lsfml-network -lsfml-system
```

This is explained as well in [this forum post](https://en.sfml-dev.org/forums/index.php?topic=8518.msg57257#msg57257).

In Code::Blocks for example you would have to make sure the dependees come after the dependers in the list of libraries to link against.

### How do I link SFML statically? {: #link-static}

In order to link SFML statically, you'll need to setup your build environment to link against the static libraries of SFML.
Static libraries are the ones with a `-s` suffix, for example `sfml-graphics-s`.
Next, you'll need to add `SFML_STATIC` to the preprocessor option and, as always, you'll need to make sure to link the debug libraries (`-d` suffix) in debug mode and the release libraries (no `-d` suffix) in release mode.

In the past, SFML included on Windows all its dependencies into the SFML libraries.
However, this was changed to eliminate multiple issues and get a commonly expected behavior ([full discussion](https://en.sfml-dev.org/forums/index.php?topic=9362.0)).
Now, SFML behaves the same on Linux as well as on Windows, which however means, that you need to link SFML's dependencies on your own when linking statically.
Since the dependencies aren't obvious to everyone, here's a listing:

**Windows**

- sfml-window
    - sfml-system
    - opengl32
    - winmm
    - gdi32
- sfml-graphics
    - sfml-system
    - sfml-window
    - opengl32
    - freetype
- sfml-audio
    - sfml-system
    - openal32
    - flac
    - vorbisenc
    - vorbisfile
    - vorbis
    - ogg
- sfml-network
    - sfml-system
    - ws2_32
- sfml-system
    - winmm

_Note:_ For Windows all dependencies can be found in the [extlibs](https://github.com/SFML/SFML/tree/master/extlibs) directory.

**Example**

Here's a diagram showing how the static linking should look like.

```
 sfml-window-s  sfml-system-s  opengl32  winmm  gdi32
         |         |            |         |      |
         | +-------+            |         |      |
         | | +------------------+         |      |
         | | | +--------------------------+      |
         | | | | +-------------------------------+
         | | | | |
         v v v v v
        example.exe
```
