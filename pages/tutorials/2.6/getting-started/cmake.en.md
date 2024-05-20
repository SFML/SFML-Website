# SFML with the CMake Project Template

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

This tutorial will work on any OS, with any IDE, and with any compiler. It will explain how to build a project that can be used with any release, branch, or Git commit of SFML. This approach is unique in that it eliminates the possibility of linker errors and makes it as easy as possible to upgrade your SFML version in the future. It even includes a CI pipeline to automatically verify that your project continues to compile on Windows, Linux, and macOS.

## [Create Your Own GitHub Project](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#create-your-own-github-project)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

[https://github.com/SFML/cmake-sfml-project](https://github.com/SFML/cmake-sfml-project "CMake SFML Project Template Repository")

The GitHub repository above is what GitHub calls a [repository template](https://docs.github.com/en/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template "GitHub documentation about repository templates"). Check out GitHub's documentation on repository templates to make your own GitHub project out of this template. This step ensures your code is kept safe in a remote location, so you won't accidentally lose it.

## [Customize the CMake Project and Executable Names](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#customize-the-cmake-project-and-executable-names)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

Out of the box this project uses placeholder names for the project name and executable name. These names can be whatever you'd like and do not have to match. The project name is defined in the call to `project()` at the top of `CMakeLists.txt`.

The executable name is defined in the call to `add_executable()`. Be sure to replace all instances of that old executable name. The executable name is used a few more times after the executable is made.

## [Add Your Own Source Files](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#add-your-own-source-files)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

The only C++ file in the project to begin with is `src/main.cpp`. You may rename, remove, or add source files as needed for your own project. Just be sure that all `.cpp` files are included in the `add_executable` call to avoid linker errors.

## [Requirements](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#requirements)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

Because this template builds SFML from source, Linux users will need to install the required system packages first. On Ubuntu or other Debian-based OSes, that can be done with the commands below. A similar process will be required for non-Debian Linux distributions like Fedora.

```
sudo apt update sudo apt install \
     libxrandr-dev \
     libxcursor-dev \
     libudev-dev \
     libopenal-dev \
     libflac-dev \
     libvorbis-dev \ 
     libgl1-mesa-dev \
     libegl1-mesa-dev \
     libdrm-dev \
     libgbm-dev
```

The CMake template requires having CMake installed. Your system's package manager is the best way to get CMake. It also gets installed alongside Visual Studio. If for some reason the previous options will not work, you can use [https://cmake.org/download/](https://cmake.org/download/ "CMake download") to install CMake for your operating system.

[Git](https://git-scm.com/ "Git SCM") is also required since CMake uses Git to clone the SFML repository. If you cloned your own GitHub project then you will already have Git installed. Without Git, CMake will fail in an unintuitive way.

## [Configure and Build Your Project](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#configure-and-build-your-project)[](https://www.sfml-dev.org/tutorials/2.6/start-cmake.php#top "Top of the page")

Now that you've made any changes you wanted to the build script, we're ready to build! CMake is by far the most popular C++ build system so any IDE you may use will have support for CMake projects. Below are some links to the documentation for setting up CMake projects with a few different popular IDEs.

- [VS Code](https://code.visualstudio.com/docs/cpp/cmake-linux "VS Code CMake project documentation")
- [Visual Studio](https://docs.microsoft.com/en-us/cpp/build/cmake-projects-in-visual-studio?view=msvc-170 "Visual Studio CMake project documentation")
- [CLion](https://www.jetbrains.com/clion/features/cmake-support.html "CLion CMake project documentation")
- [Qt Creator](https://doc.qt.io/qtcreator/creator-project-cmake.html "Qt Creator CMake project documentation")

If you would rather build this project from the command line instead of via your IDE, that's easy to do as well. You can use these two shell commands to do a release build of the project.

```
cmake -B build -DCMAKE_BUILD_TYPE=Release cmake --build build --config Release
```