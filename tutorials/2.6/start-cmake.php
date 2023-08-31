<?php

$title = "SFML with the CMake Project Template";
$page = "start-cmake.php";

require("header.php");

?>

<h1>SFML with the CMake Project Template</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial will work on any OS, with any IDE, and with any compiler.
    It will explain, how to build a project, that can be used with any release, branch, or Git commit of SFML.
    This approach is unique, in that it eliminates the possibility of linker errors and makes it as easy as possible to upgrade your SFML version in the future.
    It even includes a CI pipeline to automatically verify, that your project continues to compile on Windows, Linux, and macOS.
</p>

<?php h2('Create Your Own GitHub Project') ?>
<p>
    <a class="external" title="CMake SFML Project Template Repository" href="https://github.com/SFML/cmake-sfml-project">https://github.com/SFML/cmake-sfml-project</a>
</p>
<p>
    The GitHub repository above is what GitHub calls a
    <a class="external" title="GitHub documentation about repository templates" href="https://docs.github.com/en/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template">repository template</a>.
    Check out GitHub's documentation on repository templates to make your own GitHub project out of this template.
    This step ensures your code is kept safe in a remote location, so you won't accidentally lose it.
</p>

<?php h2('Customize the CMake Project and Executable Names') ?>
<p>
    Out of the box this project uses placeholder names for the project name and executable name.
    These names can be whatever you'd like and do not have to match.
    The project name is defined in the call to <code>project()</code> at the top of <code>CMakeLists.txt</code>.
</p>
<p>
    The executable name is defined in the call to <code>add_executable()</code>.
    Be sure to replace all instances of that old executable name.
    The executable name is used a few more times after the executable is made.
</p>

<?php h2('Add Your Own Source Files') ?>
<p>
    The only C++ file in the project to begin with is <code>src/main.cpp</code>.
    You may rename, remove, or add source files as needed for your own project.
    Just be sure that all <code>.cpp</code> files are included in the <code>add_executable</code> call to avoid linker errors.
</p>

<?php h2('Requirements') ?>
<p>
    Because this template builds SFML from source, Linux users will need to install the required system packages first.
    On Ubuntu or other Debian-based OSes, that can be done with the commands below.
    A similar process will be required for non-Debian Linux distributions like Fedora.
</p>
<pre>
    <code class="no-highlight">sudo apt update
sudo apt install \
    libxrandr-dev \
    libxcursor-dev \
    libudev-dev \
    libopenal-dev \
    libflac-dev \
    libvorbis-dev \
    libgl1-mesa-dev \
    libegl1-mesa-dev \
    libdrm-dev \
    libgbm-dev</code>
</pre>
<p>
    The CMake template requires having CMake installed.
    Your system's package manager is the best way to get CMake.
    It also gets installed alongside Visual Studio.
    If for some reason the previous options will not work, you can use
    <a class="external" title="CMake download" href="https://cmake.org/download/">https://cmake.org/download/</a>
    to install CMake for your operating system.
</p>
<p>
    <a class="external" title="Git SCM" href="https://git-scm.com/">Git</a> is also required since CMake uses Git to clone the SFML repository.
    If you cloned your own GitHub project, then you will already have Git installed.
    Without Git, CMake will fail in an unintuitive way.
</p>

<?php h2('Configure and Build Your Project') ?>
<p>
    Now that you've made any changes you wanted to the build script, we're ready to build!
    CMake is by far the most popular C++ build system so any IDE you may use, will have support for CMake projects.
    Below are some links to the documentation for setting up CMake projects with a few different popular IDEs.
</p>
<ul>
    <li><a class="external" title="VS Code CMake project documentation" href="https://code.visualstudio.com/docs/cpp/cmake-linux">VS Code</a></li>
    <li><a class="external" title="Visual Studio CMake project documentation" href="https://docs.microsoft.com/en-us/cpp/build/cmake-projects-in-visual-studio?view=msvc-170">Visual Studio</a></li>
    <li><a class="external" title="CLion CMake project documentation" href="https://www.jetbrains.com/clion/features/cmake-support.html">CLion</a></li>
    <li><a class="external" title="Qt Creator CMake project documentation" href="https://doc.qt.io/qtcreator/creator-project-cmake.html">Qt Creator</a></li>
</ul>
<p>
    If you would rather build this project from the command line instead of via your IDE, that's easy to do as well.
    You can use these two shell commands to do a release build of the project.
</p>
<pre>
    <code class="no-highlight">cmake -B build -DCMAKE_BUILD_TYPE=Release
cmake --build build --config Release</code>
</pre>

<?php

require("footer.php");

?>