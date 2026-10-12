# SFML and gcc (Linux)

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/getting-started/linux/).

## Introduction

This tutorial is the first one you should read if you're using SFML under Linux with the GCC compiler. It will explain how to install SFML, setup your compiler, and compile a SFML program.  
Compiling SFML libraries is also explained, for more advanced users (although it's quite simple).

## Installing SFML

First, you must download the SFML development files. It is recommended that you download the full SDK, which contains source code and binaries, as well as samples and documentation.  
The package can be found on the [download page](../../../download/index.md "Go to the download page").

Once you have downloaded and extracted the files to your hard drive, you must install the SFML headers and library files to the appropriate location. To do so, you just have to go to the SFML-x.y directory and type "sudo make install".

## Compiling your first SFML program

Create a new text file, and write a SFML program. For example, you can try the [`sf::Clock`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Clock.php "sf::Clock documentation") class of the System package :

```cpp
#include <SFML/System.hpp>
#include <iostream>

int main()
{
    sf::Clock Clock;
    while (Clock.GetElapsedTime() < 5.f)
    {
        std::cout << Clock.GetElapsedTime() << std::endl;
        sf::Sleep(0.5f);
    }

    return 0;
}
```

Don't forget that all SFML classes and functions are in the `sf` namespace.

Then compile it like any C++ program, and link to the SFML libraries you are using with the "-l" directive :

```
g++ -c clock.cpp
g++ -o clock clock.o -lsfml-system
```

When linking to multiple SFML libraries, make sure you link them in the right order, as it's important for gcc. The rule is the following : if library XXX depends on (uses) library YYY, put XXX first and then YYY. An exemple with SFML : sfml-graphics depends on sfml-window, and sfml-window depends on sfml-system. The link command line would be as follows :

```
g++ -o ... -lsfml-graphics -lsfml-window -lsfml-system
```

Basically, every SFML library depends on sfml-system, and sfml-graphics also depends on sfml-window. That's it for dependencies.

If you are using the Graphics or Audio packages, you must first install the external libraries needed by each package.  
Graphics requires freetype.  
Audio requires libsndfile and openal.  
These libraries can be installed using the standard package manager of your system, or downloaded from their official website.  
If you have troubles using the default OpenAL library (which is often the case as the Linux implementation is not stable), you can replace it with the [OpenAL-Soft implementation](http://kcat.strangesoft.net/openal.html "OpenAL-Soft homepage"). The binaries are fully compatible, so you won't need to recompile SFML nor your programs using it.

## Compiling SFML (for advanced users)

If the precompiled SFML libraries don't exist for your system, you can compile them quite easily. In such case, no test have been made so you are encouraged to report any failure or success encountered during your compile process. If you succeed compiling SFML for a new platform, please contact the development team so that we can share the files with the community.

First, you need to install the development packages of the external libraries used by SFML. Here is the complete list:

- build-essential
- mesa-common-dev
- libx11-dev
- libxrandr-dev
- libgl1-mesa-dev
- libglu1-mesa-dev
- libfreetype6-dev
- libopenal-dev
- libsndfile1-dev

You can also get them automatically if SFML is in your distribution's packages repository, with the following command:

```
apt-get build-dep libsfml
```

Then, to actually compile the SFML libraries and samples, you must download and install the full SDK. Go to the SFML-x.y directory, and type the following commands:

```
make                # builds the SFML libraries
sudo make install   # installs the compiled libraries
make sfml-samples   # compiles the SFML examples
```

Note: if Qt and wxWidgets are not installed on your system, you may get compile errors with the corresponding samples; just ignore them.

The following options are available to customize the build :

- **DESTDIR=xxx** : installs SFML to xxx path instead of the default one (which is /usr/lib)
- **DEBUGBUILD=yes/no** : builds debug or optimized SFML libraries (default is no - optimized)
- **STATIC=yes/no** : builds static or dynamic SFML libraries (default is no - dynamic)
