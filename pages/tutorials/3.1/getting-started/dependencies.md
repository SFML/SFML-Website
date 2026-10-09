# SFML's Dependencies

## Introduction

SFML uses a number of third-party libraries, for example FreeType to load fonts or Vorbis to decode Ogg files.
This tutorial lists what each module depends on, which libraries come with SFML and which ones have to be provided by your system.

If you use the [CMake template](cmake.md) on Windows or macOS, or the prebuilt SFML packages, you don't have to install anything.
The information below matters when you build SFML on Linux, when you want to use the libraries installed on your system, or when you link SFML statically and have to link its dependencies yourself.

## Third-party libraries

These libraries are either built together with SFML or taken from your system, depending on the `SFML_USE_SYSTEM_DEPS` option (see [below](#using-system-dependencies-or-building-them-from-source)).

| Module   | Library                                                        | Used for                                                       |
| -------- | -------------------------------------------------------------- | -------------------------------------------------------------- |
| System   | -                                                              |                                                                |
| Window   | -                                                              |                                                                |
| Graphics | [FreeType](https://freetype.org/)                              | Loading and rendering fonts                                    |
| Graphics | [HarfBuzz](https://github.com/harfbuzz/harfbuzz)               | Text shaping                                                   |
| Graphics | [SheenBidi](https://github.com/Tehreer/SheenBidi)              | Bidirectional text, always built and included in sfml-graphics |
| Audio    | [FLAC](https://xiph.org/flac/)                                 | Reading and writing FLAC files                                 |
| Audio    | [Ogg and Vorbis](https://xiph.org/vorbis/)                     | Reading and writing Ogg/Vorbis files                           |
| Network  | [Mbed TLS](https://www.trustedfirmware.org/projects/mbed-tls/) | TLS for `sf::TcpSocket`, `sf::Http` and libssh2                |
| Network  | [libssh2](https://libssh2.org/)                                | `sf::Sftp`                                                     |

## Header-only libraries

SFML ships the following header-only libraries in its `extlibs/headers` directory.
They are always used, no matter how `SFML_USE_SYSTEM_DEPS` is set, and you never have to install or link them.

| Module                   | Library                                                          | Used for                                                         |
| ------------------------ | ---------------------------------------------------------------- | ---------------------------------------------------------------- |
| System                   | [cpp-unicodelib](https://github.com/yhirose/cpp-unicodelib)      | Unicode support in `sf::String`                                  |
| System, Window, Graphics | [glad](https://github.com/Dav1dde/glad)                          | Loading OpenGL, EGL, GLX and WGL functions                       |
| Window                   | [Vulkan headers](https://github.com/KhronosGroup/Vulkan-Headers) | `sf::Vulkan`                                                     |
| Window (MinGW)           | `dinput.h`                                                       | Joysticks, only used when the MinGW toolchain doesn't provide it |
| Graphics                 | [stb_image](https://github.com/nothings/stb)                     | Loading and saving images                                        |
| Graphics                 | [qoi](https://github.com/phoboslab/qoi)                          | Loading and saving QOI images                                    |
| Audio                    | [miniaudio](https://miniaud.io/)                                 | Playing and recording audio                                      |
| Audio                    | [dr_mp3](https://github.com/mackron/dr_libs)                     | Reading MP3 files                                                |
| Network (Windows)        | [wepoll](https://github.com/piscisaureus/wepoll)                 | `sf::SocketSelector`                                             |

## System libraries

On Windows and macOS, the system libraries SFML uses are part of the operating system and its SDK, so there's nothing to install.

If you link SFML statically on Windows, you have to link these Windows libraries yourself:

| Module   | Windows libraries               |
| -------- | ------------------------------- |
| System   | winmm                           |
| Window   | opengl32, winmm, gdi32          |
| Graphics | -                               |
| Audio    | -                               |
| Network  | ws2_32, crypt32, dnsapi, bcrypt |

The [Visual Studio](visual-studio.md) and [Code::Blocks](code-blocks.md) tutorials list them together with SFML's other dependencies.
With MinGW, both GCC and Clang, the order matters, so link them in the order shown in the Code::Blocks tutorial.

On Linux, the Window module needs the development files of OpenGL, X11, Xrandr, Xcursor, Xi and udev, no matter how `SFML_USE_SYSTEM_DEPS` is set.
When SFML is built with `SFML_USE_DRM` enabled, it uses DRM and GBM instead of X11, Xrandr, Xcursor and Xi.

For iOS and Android, the system libraries are handled by the toolchain, see the [iOS](ios.md) and [Android](android.md) tutorials.

## Debian and Ubuntu packages

On Linux, `SFML_USE_SYSTEM_DEPS` is enabled by default, so all the dependencies have to be installed with their development headers.
On Debian, Ubuntu and their derivatives, these are the packages you need:

| Module   | Packages                                                                                                                         |
| -------- | -------------------------------------------------------------------------------------------------------------------------------- |
| System   | -                                                                                                                                |
| Window   | `libx11-dev`, `libxrandr-dev`, `libxcursor-dev`, `libxi-dev`, `libudev-dev`, `libgl1-mesa-dev` (DRM: `libdrm-dev`, `libgbm-dev`) |
| Graphics | `libfreetype-dev`, `libharfbuzz-dev`                                                                                             |
| Audio    | `libflac-dev`, `libvorbis-dev`                                                                                                   |
| Network  | `libmbedtls-dev`, `libssh2-1-dev`                                                                                                |

Or all at once:

```
sudo apt update
sudo apt install \
    libx11-dev \
    libxrandr-dev \
    libxcursor-dev \
    libxi-dev \
    libudev-dev \
    libgl1-mesa-dev \
    libfreetype-dev \
    libharfbuzz-dev \
    libflac-dev \
    libvorbis-dev \
    libmbedtls-dev \
    libssh2-1-dev
```

If you disable `SFML_USE_SYSTEM_DEPS`, only the packages of the Window module are needed.
For other distributions, the package names differ, but you need the same libraries.

## Using system dependencies or building them from source

The `SFML_USE_SYSTEM_DEPS` CMake option decides where the third-party libraries come from:

- `ON`: SFML uses the libraries installed on your system and fails to configure if one of them is missing.
  This is the default on Linux and the BSDs.
- `OFF`: CMake downloads the sources of the libraries while configuring and builds them together with SFML.
  This is the default on Windows, macOS, iOS and Android.

You can set it when configuring SFML:

```
cmake -B build -DSFML_USE_SYSTEM_DEPS=OFF
```

Or, if you add SFML with `FetchContent` like the [CMake template](cmake.md), set it before `FetchContent_MakeAvailable(SFML)`:

```cmake
set(SFML_USE_SYSTEM_DEPS OFF)
FetchContent_MakeAvailable(SFML)
```

Building the dependencies from source makes your build independent of the versions your system provides, but needs an internet connection when configuring and takes longer to build.
Using the system libraries is what Linux distributions expect from packages, and keeps your build smaller and faster.

Keep in mind that the libraries built from source are static libraries.
If you link SFML statically, you have to link them yourself, as explained in the [Visual Studio](visual-studio.md) and [Code::Blocks](code-blocks.md) tutorials.
The CMake package that SFML installs takes care of this for you.
