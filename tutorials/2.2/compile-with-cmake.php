<?php

    $title = "Compiling SFML with CMake";
    $page = "compile-with-cmake.php";

    require("header.php");

?>

<h1>Compiling SFML with CMake</h1>

<?php h2('Introduction') ?>
<p>
    Well, ok, the title of this tutorial is not completely right. You will <em>not</em> compile SFML with CMake, because CMake is <em>not</em>
    a compiler. So... what is CMake?
</p>
<p>
    CMake is an open-source meta build system. Instead of building SFML, it builds what builds SFML: Visual studio solutions,
    Code::Blocks workspaces, Linux makefiles, XCode projects, ... in fact it can generate the makefiles or projects for the OS and compiler of
    your choice. It is similar to autoconf/automake or premake -- for those who are already familiar with these tools.
</p>
<p>
    CMake is widely used, by well-known projects such as Blender, Boost, KDE, or Ogre. You can read more about CMake on its
    <a class="external" title="CMake official website" href="http://www.cmake.org/">official website</a> or on the
    <a class="external" title="Wikipedia page of CMake" href="http://en.wikipedia.org/wiki/CMake">Wikipedia page</a>.
</p>
<p>
    So, as you've probably understood, this tutorial is made of two main sections: generating the build files with CMake, and then building SFML with
    your preferred compiler.
</p>
 
<?php h2('Installing dependencies') ?>
<p>
    SFML depends on a few other libraries, so before starting to compile you must have their development files installed.
</p>
<p>
    On Windows and Mac OS X, all the needed dependencies are provided directly with SFML, so you don't have to download/install anything.
    Compilation will work out of the box.
</p>
<p>
    On Linux however, nothing is provided and SFML relies on your own installation of the libraries it depends on. Here is a list of what you need
    to install before compiling SFML:
</p>
<ul>
    <li>pthread</li>
    <li>opengl</li>
    <li>xlib</li>
    <li>xrandr</li>
    <li>udev</li>
    <li>freetype</li>
    <li>glew</li>
    <li>jpeg</li>
    <li>sndfile</li>
    <li>openal</li>
</ul>
<p>
    The exact name of the packages depend on each distribution. And don't forget to install the <em>development</em> version of these packages.
</p>

<?php h2('Configuring your SFML build') ?>
<p>
    This step consists of creating the projects/makefiles that will finally compile SFML. Basically it consists of choosing <em>what</em> to build,
    <em>how</em> to build it and <em>where</em>. Plus a few other options so that you can create the perfect build that suits your needs -- we'll see
    that in detail later.
</p>
<p>
    The first thing to choose is where the projects/makefiles and object files (files resulting from the compilation process)
    will be created. You can generate them directly in the source tree (i.e. the SFML root directory), but it will then be polluted with a lot
    of garbage: a complete hierarchy of build files, object files, etc. The cleanest solution is to generate them in a completely separate folder
    so that you can keep your SFML directory clean. Using separate folders will also make it easier to have multiple different builds (static,
    dynamic, debug, release, ...).
</p>
<p>
    Now that you've chosen the build directory, there's one more thing to do before you can run CMake. When CMake configures your project, it tests
    the availability of the compiler (and checks its version as well). As a consequence, the compiler executable must be available when CMake is run.
    This is not a problem for Linux and Mac OS X users, since the compilers are installed in a standard path and are always globally available,
    but on Windows you may have to add the directory of your compiler in the PATH environment variable, so that CMake can find it automatically.
    This is especially important when you have several compilers installed, or multiple versions of the same compiler.
</p>
<p>
    On Windows, if you want to use GCC (MinGW), you can temporarily add the MinGW\bin directory to the PATH and then run CMake from the command shell:
</p>
<pre><code class="no-highlight">&gt; set PATH=%PATH%;your_mingw_folder\bin
&gt; cmake
</code></pre>
<p>
    With Visual C++, you can either run CMake from the "Visual Studio command prompt" available from the start menu, or call the vcvars32.bat file of
    your Visual Studio installation; it will setup the environment variables properly.
</p>
<pre><code class="no-highlight">&gt; your_visual_studio_folder\VC\bin\vcvars32.bat
&gt; cmake
</code></pre>
<p>
    Now you are ready to run CMake. In fact there are three different ways to run it:
</p>
<ul>
    <li><strong>cmake-gui</strong><br />
        This is a graphical interface that allows you to configure everything with buttons and text fields;
        this is probably the easiest solution for beginners and people who don't want to deal with the command line; it's also very convenient to
        see and edit the build options.
    </li>
    <li><strong>cmake -i</strong><br />
        This is the command line interactive invocation, you will be prompted to fill every build option explicitly;
        this is a good option to start with the command line, since you probably don't remember all the options that are available,
        and don't know which ones are relevant.
    </li>
    <li><strong>cmake</strong><br />
        This is the direct invocation, you must put all the options and their values directly.
    </li>
</ul>
<p>
    In this tutorial I will focus on cmake-gui, as this is most likely what beginners will use. I assume that people who use the command line
    can learn the syntax from the CMake manual. Except the screenshots and the "click there" stuff, all the explanations below still
    applies (options are the same).
</p>
<p>
    Here is what cmake-gui looks like:
</p>
<img class="screenshot" src="./images/cmake-gui-start.png" alt="Screenshot of the cmake-gui tool" title="Screenshot of the cmake-gui tool" />
<p>
    Here are the first steps to perform:
</p>
<ol>
    <li>Tell CMake where the source code of SFML is (this must be the root folder of the SFML hierarchy, where the first CMakeLists.txt file is).</li>
    <li>Choose where you want the projects/makefiles to be generated (if the directory doesn't exist, CMake will create it).</li>
    <li>Click the "Configure" button</li>
</ol>
<p>
    If this is the first time that you run CMake in this directory (or if you cleared the cache), cmake-gui will ask you to choose the generator.
    In other words, this is where you select your compiler/IDE.
</p>
<img class="screenshot" src="./images/cmake-choose-generator.png" alt="Screenshot of the generator selection dialog box" title="Screenshot of the generator selection dialog box" />
<p>
    For example, to generate a Visual Studio 10 solution, you must choose "Visual Studio 10".
    To generate makefiles usable with Visual C++, select "NMake makefiles". To create makefiles usable with MinGW (GCC), select "MinGW makefiles". It
    is generally easier to generate makefiles rather than IDE projects: you can then compile with a single command, or even gather multiple
    compilations in a single script. Since you will only compile, not edit source files, IDE projects are generally useless.<br>
    Moreover, the installation process (described later in this document) may not work with the "Xcode" generator; therefore it is highly
    recommended to use the "Makefile" generator on Mac OS X.
</p>
<p>
    Always keep the "Use default native compilers" option, you don't need to care about the three others.
</p>
<p>
    After selecting the generator, CMake will run a lot of tests to check various things of your compilation environment: compiler path, standard
    headers, SFML dependencies, etc. If everything is ok, it should finish with the "Configuring done" message. If something goes wrong, read the
    error(s) carefully. Maybe your compiler is not accessible (see above), or one external dependency is missing.
</p>
<img class="screenshot" src="./images/cmake-configure.png" alt="Screenshot of the cmake-gui window after configure" title="Screenshot of the cmake-gui window after configure" />
<p>
    After configuring is done, a lot of options appear in the central part of the window. CMake has many options, but most of them have the
    right default value. Many of them are not even meant to be changed, they are just there to show you what CMake automatically found.<br />
    Here are the few relevant options that you may have to care about when configuring your SFML build:
</p>
<table class="styled">
    <thead>
        <tr>
            <th>Variable</th>
            <th>Meaning</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>CMAKE_BUILD_TYPE</code></td>
            <td>
                This option selects the build type. Relevant values are "Debug" and "Release" (there are other types such as "RelWithDebInfo" or "MinSizeRel",
                but they are not really configured in the SFML makefiles). Note that if you generate a workspace for an IDE that supports multiple configurations,
                such as Visual Studio, this option is ignored and you automatically get all the available build types in it.
            </td>
        </tr>
        <tr class="two">
            <td><code>CMAKE_INSTALL_PREFIX</code></td>
            <td>
                This is the install path. By default, it is defined to the most natural path according to the OS ("/usr/local" for Linux and Mac OS X,
                "C:\Program Files" for Windows, etc.). Installing files after compiling is not mandatory, you can use the binaries directly from where
                they are compiled, but it may be a better solution to install them properly so that you don't have all the garbage files produced by
                the compilation.
            </td>
        </tr>
        <tr class="one">
            <td><code>CMAKE_INSTALL_FRAMEWORK_PREFIX<br/>(Mac OS X only)</code></td>
            <td>
                This is the install path for frameworks. By default, it is defined to the root library,
                i.e. /Library/Frameworks folder. As stated for CMAKE_INSTALL_PREFIX it is not mandatory to install files
                after compiling, but it is cleaner to install them.<br>
                This path is used to install on your system sndfile.framework (a required dependency not provided by Apple)
                and SFML as frameworks if BUILD_FRAMEWORKS is selected.
            </td>
        </tr>
        <tr class="two">
            <td><code>BUILD_SHARED_LIBS</code></td>
            <td>
                This boolean option controls whether you build the dynamic (shared) libraries of SFML, or the static ones. <br/>
                This option is not compatible with SFML_USE_STATIC_STD_LIBS, they are mutually exclusive.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_FRAMEWORKS<br/>(Mac OS X only)</code></td>
            <td>
                This boolean option controls whether you build SFML as
                <a class="external" title="go to Apple documentation about frameworks" href="http://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html">framework bundles</a>
                or as
                <a class="external" title="go to Apple documentation about dynamic library" href="http://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/000-Introduction/Introduction.html">dylib binaries</a>.
                Building frameworks requires BUILD_SHARED_LIBS to be selected.<br>
                It is recommended to use SFML as frameworks when releasing your applications to the public. However, 
                SFML cannot be built in debug as frameworks; use instead dylibs. 
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_BUILD_EXAMPLES</code></td>
            <td>
                This boolean option controls whether you build the SFML examples or not.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_DOC</code></td>
            <td>
                This boolean option controls whether you generate the SFML documentation or not. Note that the
                <a class="external" title="go to doxygen website" href="http://www.doxygen.org">doxygen</a> tool must be installed and accessible, otherwise
                enabling this option will produce an error.<br>
                On Mac OS X you can either install the classic-Unix doxygen binary into /usr/bin or any similar directory,
                or install Doxygen.app into any "Applications" folder, e.g. ~/Applications.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_USE_STATIC_STD_LIBS<br/>(Windows only)</code></td>
            <td>
                This boolean option selects the version of the standard C/C++ library which is linked to SFML. <br/>
                TRUE statically links the standard libraries, which means that SFML is self-contained and doesn't depend on the compiler's
                specific DLLs. <br/>
                FALSE (the default) dynamically links the standard libraries, which means that SFML depends on the compiler's DLLs
                (msvcrxx.dll/msvcpxx.dll for Visual C++, libgcc_s_xxx-1.dll/libstdc++-6.dll for GCC). Be careful, this setting must match your own projects
                settings, otherwise you may experience crashes. <br/>
                This option is not compatible with BUILD_SHARED_LIBS, they are mutually exclusive.
            </td>
        </tr>
        <tr class="one">
            <td><code>CMAKE_OSX_ARCHITECTURES<br/>(Mac OS X only)</code></td>
            <td>
                This setting specifies for which architectures SFML should be compiled. The recommended value is "i386;x86_64" to generate universal binaries for both
                32 and 64-bit systems.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_INSTALL_XCODE_TEMPLATES<br/>(Mac OS X only)</code></td>
            <td>
                This boolean option controls whether CMake will install the Xcode templates on your system or not.
                Please make sure that /Library/Developer/Xcode/Templates/SFML exists and is writable.
                More information about these templates is given in the "Getting started" tutorial for Mac OS X.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_INSTALL_PKGCONFIG_FILES<br/>(Linux shared libraries only)</code></td>
            <td>
                This boolean option controls whether CMake will install the pkg-config files on your system or not.
                pkg-config is a tool that provides a unified interface for querying installed libraries.
            </td>
        </tr>
    </tbody>
</table>
<p>
    After everything is configured, click the "Configure" button once again: the options background should become white, and the "Generate" button
    should become available. Click it to finally create the chosen makefiles/projects.
</p>
<img class="screenshot" src="./images/cmake-generate.png" alt="Screenshot of the cmake-gui window after generate" title="Screenshot of the cmake-gui window after generate" />
<p>
    CMake creates a cache for every project. Therefore, if you decide to come back later, you'll find your options back and you'll be able to
    change them, then reconfigure and generate the updated makefiles/projects.
</p>
 
<h3>C++11 and Mac OS X</h3>
<p>
    If you want to use C++11 features in your application on Mac OS X, you have to use clang (Apple's official compiler) and libc++. Moreover, you also need to build SFML with
    these tools to workaround any incompatibility between standard libraries and compilers.
</p>
<p>
    Here are the settings to use to build SFML with clang and libc++:
</p>
<ul>
    <li>Choose "Specify native compilers" rather than "Use default native compilers" when you select the generator</li>
    <li><code>CMAKE_CXX_COMPILER</code> set to /usr/bin/clang++ (see screenshot)</li>
    <li><code>CMAKE_C_COMPILER</code> set to /usr/bin/clang (see screenshot)</li>
    <li><code>CMAKE_CXX_FLAGS</code> and <code>CMAKE_C_FLAGS</code> set to "-stdlib=libc++"</li>
</ul>
<img class="screenshot" src="./images/cmake-osx-compilers.png" alt="Screenshot of the compiler configuration on OS X" title="Screenshot of the compiler configuration on OS X" />

<?php h2('Building SFML') ?>
<p>
    Let's start this new section with good news: you won't have to go through the configure step anymore, even if you update your working copy of
    SFML. CMake is smart, it adds a custom step to the generated makefiles/projects, that automatically regenerates the build files whenever
    something changes.
</p>
<p>
    You're now ready to compile SFML. Of course, how to do it depends on what makefiles/projects you've generated. If you created
    a project/solution/workspace, open it with your IDE and compile like any other project. I won't show you the details here,
    there are too many different IDEs and I assume that you know yours enough to do this simple task.
</p>
<p>
    If you generated a makefile, open a command shell and execute the make command corresponding to your environment. For example, run "nmake" if
    you generated a NMake (Visual C++) makefile, "mingw32-make" if you generated a MinGW (GCC) makefile, or simply "make" if you generated a Linux
    makefile.<br />
    Note: on Windows, the make program (nmake or mingw32-make) may not be accessible. If it's the case, don't forget to add it to your PATH
    environment variable; see the explanations at the beginning of the "Configuring your SFML build" section for more details.
</p>
<p>
    By default, everything will be compiled (all the SFML libraries, as well as all the examples if you enabled the SFML_BUILD_EXAMPLES option).
    If you want to compile only a single SFML library or example, you can select a different target. You can also choose to clean or install the compiled
    files, with the corresponding targets.<br />
    Here are all the targets that are available, depending on the configure options that you chose:
</p>
<table class="styled">
    <thead>
        <tr>
            <th>Target</th>
            <th>Meaning</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>all</code></td>
            <td>
                This is the default target, it is used if no target is explicitly specified. It builds all the targets that produce a binary
                (sfml libraries and examples).
            </td>
        </tr>
        <tr class="two">
            <td><code>sfml&#8209;system<br/>sfml&#8209;window<br/>sfml&#8209;network<br/>sfml&#8209;graphics<br/>sfml&#8209;audio<br/>sfml&#8209;main</code></td>
            <td>
                Builds the corresponding SFML library. The "sfml-main" target is available only on Windows systems.
            </td>
        </tr>
        <tr class="one">
            <td><code>cocoa<br/>ftp<br/>opengl<br/>pong<br/>shader<br/>sockets<br/>sound<br/>sound&#8209;capture<br/>voip<br/>window<br/>win32<br/>X11</code></td>
            <td>
                Builds the corresponding SFML example. These targets are available only if the <code>SFML_BUILD_EXAMPLES</code> option is enabled. Note that some of the
                targets are available only on a certain OS ("cocoa" is available on Mac OS X, "win32" on Windows, "X11" on Linux, etc.).
            </td>
        </tr>
        <tr class="two">
            <td><code>doc</code></td>
            <td>
                Generates the API documentation. This target is available only if the <code>SFML_BUILD_DOC</code> option is enabled.
            </td>
        </tr>
        <tr class="one">
            <td><code>clean</code></td>
            <td>
                Removes all the object files produced by a previous compilation. You generally don't need to invoke this target, except when you want
                to recompile SFML completely (some updates may mess up with object files already compiled, and cleaning everything is the only solution).
            </td>
        </tr>
        <tr class="two">
            <td><code>install</code></td>
            <td>
                Installs SFML to the path defined in the <code>CMAKE_INSTALL_PREFIX</code> and <code>CMAKE_INSTALL_FRAMEWORK_PREFIX</code> options. It copies the
                SFML libraries and headers, as well as examples and documentation if the <code>SFML_BUILD_EXAMPLES</code> and <code>SFML_BUILD_DOC</code> options are enabled.
                After installing, you get a clean distribution of SFML, just as if you had downloaded the SDK or installed it from the system repositories.
            </td>
        </tr>
    </tbody>
</table>
<p>
    If you use an IDE, a target is simply a project. To build a target, select the corresponding project and compile it (even "clean" or
    "install" must be compiled to be executed -- don't be confused by the fact that no source code is actually compiled).<br />
    If you use a makefile, pass the name of the target to the make command to build this target. Examples: "<code>nmake doc</code>", "<code>mingw32-make install</code>",
    "<code>make sfml-network</code>".
</p>
<p>
    Now you should have successfully compiled SFML. Congratulations!
</p>

<?php

    require("footer.php");

?>
