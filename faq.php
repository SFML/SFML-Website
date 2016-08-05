<?php
    $breadcrumbs = array
    (
        'Learn' => 'learn.php',
        'Frequently Asked Questions' => 'faq.php'
    );
    include('header.php');
?>

<div class="faq">
 <h1><a href="#frequently-asked-questions-faq">Frequently Asked Questions (FAQ)</a></h1>

 <p><strong><a href="#general">General</a></strong></p>
 <ul>
  <li><a href="#grl-whatis">What is SFML?</a></li>
  <li><a href="#grl-platforms">On which platforms is SFML currently available?</a></li>
  <li><a href="#grl-languages">Which programming languages are supported by SFML?</a></li>
  <li><a href="#grl-dependencies">What dependencies does SFML have?</a></li>
  <li><a href="#grl-version">What version of SFML should I use?</a></li>
  <li><a href="#grl-changes">Is there a complete list with all the changes from SFML 1.6 to SFML 2.x?</a></li>
  <li><a href="#grl-3d">Will/does SFML support 3D?</a></li>
  <li><a href="#grl-reqeust">I want to propose a new feature!</a></li>
  <li><a href="#grl-learn">Is using SFML a good way to learn to program (in C++)?</a></li>
  <li><a href="#grl-questions">Where can I ask questions?</a></li>
 </ul>

 <p><strong><a href="#build-use">Building and Using SFML</a></strong></p>
 <ul>
  <li><a href="#build-build">How do I build SFML?</a></li>
  <li><a href="#build-nightly">Are there any nightly builds?</a></li>
  <li><a href="#build-environment">How do I setup my development environment to work with SFML?</a></li>
  <li><a href="#build-link">What and how do I link to use SFML?</a></li>
  <li><a href="#build-link-static">How do I link SFML statically?</a></li>
 </ul>

 <p><strong><a href="#graphics">SFML Graphics</a></strong></p>
 <ul>
  <li><a href="#graphics-image-formats">What image formats does SFML support?</a></li>
  <li><a href="#graphics-white-rect">Why do I get a white/black rectangle instead of my texture?</a></li>
  <li><a href="#graphics-image-texture">What is the difference between sf::Image and sf::Texture?</a></li>
  <li><a href="#graphics-sprites">My FPS count drops when drawing a lot of sprites.</a></li>
  <li><a href="#graphics-vsync-framelimit">Should I use VSync, window.setFramerateLimit or something else?</a></li>
  <li><a href="#graphics-xsprite">Should I use one sprite or x sprites to draw x textures?</a></li>
  <li><a href="#graphics-bounds">What is the difference between LocalBounds and GlobalBounds?</a></li>
  <li><a href="#graphics-low-fps">My FPS is very low when running my application.</a></li>
  <li><a href="#graphics-broken-rendertexture">RenderTextures don't work on my computer!</a></li>
  <li><a href="#graphics-smooth-animation">My animations/movements aren't smooth or exhibit stuttering!</a></li>
 </ul>

 <p><strong><a href="#audio">SFML Audio</a></strong></p>
 <ul>
  <li><a href="#audio-formats">What audio formats does SFML support?</a></li>
  <li><a href="#audio-sound-problem">Why can't I hear any sound?</a></li>
 </ul>

 <p><strong><a href="#networking">SFML Networking</a></strong></p>
 <ul>
  <li><a href="#network-create-network-app">How do I create &lt;insert popular application type here&gt;?</a></li>
  <li><a href="#network-tcp-vs-udp">Should I use TCP or UDP sockets?</a></li>
  <li><a href="#network-blocking-non-blocking-selectors">Should I use blocking or non-blocking sockets? And how do selectors work?</a></li>
  <li><a href="#network-internet-network">I can't connect to the other computer over the internet!</a></li>
 </ul>

 <p><strong><a href="#window">SFML Window</a></strong></p>
 <ul>
  <li><a href="#window-transparent-window">How do I make my window transparent?</a></li>
  <li><a href="#window-get-frame-time">What happened to getFrameTime()?</a></li>
  <li><a href="#window-set-framerate-limit">Why doesn't setFramerateLimit() always set the frame rate to the specified limit?</a></li>
 </ul>

 <p><strong><a href="#system">SFML System</a></strong></p>
 <ul>
  <li><a href="#system-unicode">Does SFML support Unicode?</a></li>
  <li><a href="#system-string-convert">How do I convert from sf::String to &lt;type&gt; and vice-versa?</a></li>
  <li><a href="#system-threads-crash">My program keeps crashing when I use threads!</a></li>
  <li><a href="#system-mutex">How do I use sf::Mutex?</a></li>
  <li><a href="#system-thread-container">Why can't I store my sf::Thread in an STL container?</a></li>
  <li><a href="#system-sleep">Why doesn't sf::sleep sleep for the amount of time I want it to?</a></li>
 </ul>

 <p><strong><a href="#programming">Programming in General</a></strong></p>
 <ul>
  <li><a href="#prog-raii">What is RAII and why does it rock?</a></li>
  <li><a href="#prog-mmm">Why shouldn't I manually manage my memory?</a></li>
  <li><a href="#prog-smart">What are smart pointers?</a></li>
  <li><a href="#prog-global">Why shouldn't I use global variables?</a></li>
  <li><a href="#prog-insteadof-global">What should I use then instead of global variables?</a></li>
  <li><a href="#prog-singleton">Why is the singleton pattern not a good one?</a></li>
 </ul>

 <p><strong><a href="#trouble">Troubleshooting</a></strong></p>
 <ul>
  <li>
   <a href="#tr-grl">General</a>
   <ul>
    <li><a href="#tr-grl-trouble">I'm having trouble using SFML.</a></li>
    <li><a href="#tr-grl-verbose-ide">How do I make my IDE output verbose build information?</a></li>
    <li><a href="#tr-grl-undefined-ref">I keep getting "undefined reference to &lt;some strange thing that looks like an SFML function&gt;"!</a></li>
    <li><a href="#tr-grl-64bit">Why can't I use SFML as a 64-bit library on my 64-bit system?</a></li>
    <li><a href="#tr-grl-crash">My computer crashes when I run my SFML program!</a></li>
    <li><a href="#tr-grl-i-found-a-bug">I found a bug!</a></li>
    <li><a href="#tr-grl-minimal">What is minimal code?</a></li>
    <li><a href="#tr-grl-obtain-minimal">And how can I easily obtain this minimal code?</a></li>
   </ul>
  </li>
  <li>
   <a href="#tr-cb">Code::Blocks</a>
   <ul>
    <li><a href="#tr-cb-linker">I'm getting linker errors.</a></li>
   </ul>
  </li>
  <li>
   <a href="#tr-vs">Visual Studio</a>
   <ul>
    <li><a href="#tr-vs-crash">My project crashes randomly, but I don't get any compiler or linker errors.</a></li>
    <li><a href="#tr-vs-arch">I keep getting <code>fatal error LNK1112: module machine type 'XYZ' conflicts with target machine type 'ZYX'</code>. Help!</a></li>
   </ul>
  </li>
  <li>
   <a href="#tr-win">Windows</a>
   <ul>
    <li><a href="#tr-win-console">Why does a console attach itself to my project?</a></li>
   </ul>
  </li>
  <li>
   <a href="#tr-lnx">Linux</a>
   <ul>
    <li><a href="#tr-lnx-compile">(Debian) I can't compile the source code.</a></li>
    <li><a href="#tr-lnx-titlebar">There is no titlebar visible and/or artifacts from windows are visible.</a></li>
   </ul>
  </li>
 </ul>

 <p><strong><a href="#licensing">Licensing</a></strong></p>
 <ul>
  <li><a href="#lic-license">What license does SFML have?</a></li>
  <li><a href="#lic-commercial">Can I use SFML in commercial applications?</a></li>
  <li><a href="#lic-static">Can I link SFML statically?</a></li>
  <li><a href="#lic-examples">Can I use the code from the example directory?</a></li>
  <li><a href="#lic-pay">Do I have to pay any license fees or royalties?</a></li>
 </ul>

 <p><strong><a href="https://github.com/SFML/SFML/wiki/Community-FAQ#libraries">Libraries for SFML</a> (Community FAQ)</strong></p>

 <p><strong><a href="https://github.com/SFML/SFML/wiki/Community-FAQ#misc">Miscellaneous</a> (Community FAQ)</strong></p>

 <h2 id="general"><a class="h2-link" href="#general">General</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="grl-whatis"><a class="h3-link" href="#grl-whatis">What is SFML?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML is a simple to use and portable API written in C++. You can think of it as an object oriented SDL. SFML is made of modules in order to be as useful as possible for everyone. You can use SFML as a minimalist window system in order to use OpenGL, or as a complete multimedia library full of features to build video games or multimedia softwares.</p>
 <!--p>You can find a more specific presentation of its features on <a href="features.php">this page</a>.</p//-->

 <h3 id="grl-platforms"><a class="h3-link" href="#grl-platforms">On which platforms is SFML currently available?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML 2.3 is currently available and fully functional on Windows (8, 7, Vista, XP), Linux and Mac OS X. SFML works on both 32 and 64 bit systems. If older Windows versions need to be supported, it should be possible to use SFML 2.0 instead (see <a href="https://github.com/SFML/SFML/commit/cd68d662043c2305990d1b6b559b0138bd77af14">the commit</a> for removal of Windows 9x and similar). Since SFML 2.2, there has also been experimental support for iOS and Android.</p>

 <h3 id="grl-languages"><a class="h3-link" href="#grl-languages">Which programming languages are supported by SFML?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML is implemented in C++. That said, several <a href="download/bindings.php">bindings</a> have been created for other languages that allow SFML to be used from C, C#, C++/CLI, D, Ruby, OCaml, Java, Python and VB.NET.</p>

 <h3 id="grl-dependencies"><a class="h3-link" href="#grl-dependencies">What dependencies does SFML have?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML depends on a few other libraries, so before starting to compile you must have their development files installed.</p>
 <p>On Windows and Mac OS X, all the needed dependencies are provided directly with SFML, so you don't have to download/install anything. Compilation will work out of the box.</p>
 <p>On Linux however, nothing is provided and SFML relies on your own installation of the libraries it depends on. Here is a list of what you need to install before compiling SFML:</p>
 <ul>
  <li>pthread</li>
  <li>opengl</li>
  <li>xlib</li>
  <li>xcb</li>
  <li>x11-xcb</li>
  <li>xcb-randr</li>
  <li>xcb-image</li>
  <li>xrandr</li>
  <li>udev</li>
  <li>freetype</li>
  <li>jpeg</li>
  <li>openal</li>
  <li>flac</li>
  <li>vorbis</li>
 </ul>
 <p>The exact name of the packages depend on each distribution. And don't forget to install the development version of these packages.</p>
 <p>SFML has also internal dependencies: Audio and Window depend on System, while Graphics depends on System and Window. In order to use the Graphics module, you must link with Graphics, Window, and System (the order of linkage matters with GCC).</p>

 <h3 id="grl-version"><a class="h3-link" href="#grl-version">What version of SFML should I use?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Go for SFML 2.4, because you'll get a stable release with the latest features and bugfixes. As such it will save you a lot of headaches because other versions such as 1.6 are not maintained anymore, contain quite a few critical bugs and lack a lot of useful features.</p>

 <h3 id="grl-changes"><a class="h3-link" href="#grl-changes">Is there a complete list with all the changes from SFML 1.6 to SFML 2.x?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>This non-exhaustive list can be used as a starting point: <a href="http://en.sfml-dev.org/forums/index.php?topic=5343.0">SFML Forum</a><br>
 It however does not contain all changes made between 1.6 and 2.0. It was written more than a year ago and since then a few major changes have been made including:</p>
 <ul>
  <li>Rewrite of the graphics API</li>
  <li>New <code>sf::Time</code> API</li>
  <li>Removal of the default built-in Arial font</li>
  <li>Replaced <code>getWidth()</code> and <code>getHeight()</code> with <code>getSize()</code></li>
  <li>Naming convention change (further details and rationale <a href="http://en.sfml-dev.org/forums/index.php?topic=6709.0">here</a>)</li>
 </ul>

 <h3 id="grl-3d"><a class="h3-link" href="#grl-3d">Will/does SFML support 3D?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>No, and the SFML Team has decided to keep the library as a way to handle 2D graphics with ease and hardware acceleration, so in short there won't be support for 3D in the future either. However you can use libraries such as Irrlicht with SFML as a window creator. You could also use raw OpenGL to implement 3D and have it alongside your 2D rendering in SFML without problems.</p>
 <p>The previous statement is recommendable only if you have a minimal use for 3D, as it becomes very hard and tedious to manage full 3D functionality through graphics pipeline only.</p>

 <h3 id="grl-reqeust"><a class="h3-link" href="#grl-reqeust">I want to propose a new feature!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>See our <a href="contribute.php#requesting-features">Contribution Guidelines</a>.</p>

 <h3 id="grl-learn"><a class="h3-link" href="#grl-learn">Is using SFML a good way to learn to program (in C++)?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>In general, you can learn to program any way you want. The question is: what is the most <strong>effective</strong> way to learn to program? The unanimous answer to this question is, don't start with SFML if you are trying to grasp the basic language features of C++. SFML makes use of basic as well as advanced features of the C++ language. You might be able to achieve something in your first hours of C++ and SFML but whether it is usable and maintainable is another question. It is probable that you would have learned more and faster if you just stuck to the standard libraries C++ already provides. This allows you to focus on learning the language and not the SFML API at the same time. There are many good examples of text-based games made using just stdin and stdout.</p>
 <p>Where you learn to program (in C++) from is also totally up to you. However it is recommended to always take examples/tutorials available on the internet with a pinch of salt. They might contain bad habits of the writer which are not apparent to a newcomer. The safest way to learn to program is probably accompanied by a book written by a reputable author who is actively involved in the development of the language (see <a href="https://stackoverflow.com/questions/388242/the-definitive-c-book-guide-and-list">this list</a>). This ensures that they grasp the important aspects of the language and can teach you to program effectively as well. Contrary to what many newcomers believe, C++ is still evolving and has done so even more over the last years with the standardization of C++11 and C++14. Learning from an older book or internet source might therefore not teach you all the aspects of the language there are and worse teach you old practices, which are no longer recommended. It is therefore recommended that you actively seek to learn about these new features on your own after you have grasped the basics.</p>
 <p>If you are unsure when you might consider yourself ready for SFML, here is a checklist of language features that are highly recommended to know when using SFML.</p>
 <p>Basics, required to program with SFML:</p>
 <ul>
  <li>Compiling, building</li>
  <li>Basic program structure (main(), header includes ...)</li>
  <li>Basic data types</li>
  <li>Composite data types</li>
  <li>Control structures (if, for, while ...)</li>
  <li>Basic functions, function signatures</li>
  <li>Function parameter passing</li>
  <li>Classes and general OOP</li>
  <li>STL - Standard Template Library</li>
  <li>Dynamic memory allocation, pointers</li>
  <li>Type casting</li>
  <li>Advanced OOP, inheritance, polymorphism</li>
  <li>Advanced program structure, header files, linking</li>
  <li><strong>Debugging techniques</strong> This is important to be able to help yourself when the situation arises.</li>
 </ul>
 <p>Advanced concepts, not all required to program with SFML but good to know:</p>
 <ul>
  <li>Templates</li>
  <li>Operator overloading</li>
  <li>Namespaces</li>
  <li>Move semantics and other C++11 features</li>
  <li>Metaprogramming</li>
 </ul>
 <p>Maintenance/productivity related skills, also not required but good to know:</p>
 <ul>
  <li>Profiling</li>
  <li>Optimization techniques, compiler optimization opportunities</li>
  <li>Coding conventions</li>
  <li>Refactoring techniques</li>
  <li>Code organization: abstraction, modularity, separation of responsibilities</li>
  <li><a href="https://en.wikibooks.org/wiki/More_C%2B%2B_Idioms">Idioms</a>: RAII, Pimpl, Erase-Remove, Copy & Swap</li>
  <li>Advanced data structures and algorithms</li>
  <li>Library writing, API design</li>
  <li>Cross-platform build tools</li>
  <li>SCM such as git, SVN or Hg</li>
 </ul>
 <p>Deeper understanding, good to know to understand what is happening "behind the scenes":</p>
 <ul>
  <li>Graphics pipeline, OpenGL</li>
  <li>Networking, TCP, UDP</li>
  <li>Audio knowledge, sample rate, attenuation, wave characteristics</li>
  <li>Operating system knowledge (not only for a single operating system)</li>
  <li>Computer hardware: CPU, instructions and pipelining, RAM, caching, paging</li>
 </ul>

 <h3 id="grl-questions"><a class="h3-link" href="#grl-questions">Where can I ask questions?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>First make sure you've read the tutorials and the documentation, then check whether the question has already been asked before. If after that you still have a question <strong>regarding SFML</strong> in the <a href="http://en.sfml-dev.org/forums/">SFML forum</a>.</p>
 <p>Keep in mind that using SFML is not a very suitable way to <a href="#grl-learn">learn the bare basics of C++ programming</a>, and as such it is recommended that any questions regarding general C++ be asked in more adequate forums where people proficient in C++ can help you better.</p>
 <p>Additionally you also find people in the <a href="community.php">Official IRC chat</a>.</p>

 <h2 id="buil-use"><a class="h2-link" href="#build-use">Building and Using SFML</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="build-build"><a class="h3-link" href="#build-build">How do I build SFML?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Tutorials for each version of SFML can be found <a href="tutorials/">here</a>. The first part of these tutorials is aimed at getting started, which includes building SFML with CMake and your build tool of choice, as well as setting up your IDE (if you use one) for use with SFML.</p>

 <h3 id="build-nightly"><a class="h3-link" href="#build-nightly">Are there any nightly builds?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>There are no official nightly builds, however there is a thread on the forum where unofficial nightly builds are provided for certain platforms.</p>
 <p><a href="http://en.sfml-dev.org/forums/index.php?topic=9513.0">Link to the thread</a></p>

 <h3 id="build-environment"><a class="h3-link" href="#build-environment">How do I setup my development environment to work with SFML?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>This is covered quite thoroughly in the tutorials section for some of the most popular IDEs.</p>
 <p>Check out the Getting Started sections of the <a href="learn.php">tutorials</a>.</p>

 <h3 id="build-link"><a class="h3-link" href="#build-link">What and how do I link to use SFML?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>When you want to use SFML, you need to link to the library files that provide the functionality you make use of in your application.</p>
 <p>SFML is divided into 5 modules:</p>
 <ul>
  <li><strong>System</strong> <em>provided by sfml-system</em></li>
  <li><strong>Window</strong> <em>provided by sfml-window</em></li>
  <li><strong>Graphics</strong> <em>provided by sfml-graphics</em></li>
  <li><strong>Audio</strong> <em>provided by sfml-audio</em></li>
  <li><strong>Network</strong> <em>provided by sfml-network</em></li>
 </ul>
 <p>Be aware that the modules have interdependencies on each other. For instance, if you plan on using the Graphics module, you will also have to link against the Window and System modules as well.</p>
 <p>Dependencies:</p>
 <ul>
  <li><strong>System</strong> does not depend on anything and can be used by itself.</li>
  <li><strong>Window</strong> depends on <strong>System</strong>.</li>
  <li><strong>Graphics</strong> depends on <strong>Window</strong> and <strong>System</strong>.</li>
  <li><strong>Audio</strong> depends on <strong>System</strong>.</li>
  <li><strong>Network</strong> depends on <strong>System</strong>.</li>
 </ul>
 <p>As you can see you will always have to link against sfml-system, no matter what you do.</p>
 <p>Be aware that some linkers are sensitive to the order in which you specify libraries to link against.</p>
 <p>GCC (which implies MinGW as well) requires that the dependees (libraries that others depend on) are specified after the dependers (libraries that depend on others).</p>
 <p>An example of a GCC command line linking all modules would be as follows:</p>
 <pre><code>g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-audio -lsfml-network -lsfml-system</code></pre>
 <p>This is explained as well in <a href="http://en.sfml-dev.org/forums/index.php?topic=8518.msg57257#msg57257">this forum post</a>.</p>
 <p>In Code::Blocks for example you would have to make sure the dependees come after the dependers in the list of libraries to link against.</p>

 <h3 id="build-link-static"><a class="h3-link" href="#build-link-static">How do I link SFML statically?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>In order to link SFML statically, you'll need to setup your build environment to link against the static libraries of SFML. Static libraries are the ones with a <code>-s</code> suffix, for example <code>sfml-graphics-s</code>. Next, you'll need to add <code>SFML_STATIC</code> to the preprocessor option and, as always, you'll need to make sure to link the debug libraries (<code>-d</code> suffix) in debug mode and the release libraries (no <code>-d</code> suffix) in release mode.</p>
 <p>In the past, SFML included on Windows all its dependencies into the SFML libraries. However, this was changed to eliminate multiple issues and get a commonly expected behavior (<a href="http://en.sfml-dev.org/forums/index.php?topic=9362.0">full discussion</a>). Now, SFML behaves the same on Linux as well as on Windows, which however means, that you need to link SFML's dependencies on your own when linking statically. Since the dependencies aren't obvious to everyone, here's a listing:</p>
 <p><strong>Windows</strong></p>
 <ul>
  <li>
   sfml-window
   <ul>
    <li>sfml-system</li>
    <li>opengl32</li>
    <li>winmm</li>
    <li>gdi32</li>
   </ul>
  </li>
  <li>
   sfml-graphics
   <ul>
    <li>sfml-system</li>
    <li>sfml-window</li>
    <li>opengl32</li>
    <li>freetype</li>
    <li>jpeg</li>
   </ul>
  </li>
  <li>
   sfml-audio
   <ul>
    <li>sfml-system</li>
    <li>openal32</li>
    <li>flac</li>
    <li>vorbisenc</li>
    <li>vorbisfile</li>
    <li>vorbis</li>
    <li>ogg</li>
   </ul>
  </li>
  <li>
   sfml-network
   <ul>
    <li>sfml-system</li>
    <li>ws2_32</li>
   </ul>
  </li>
  <li>
   sfml-system
   <ul>
    <li>winmm</li>
   </ul>
  </li>
 </ul>
 <p><em>Note:</em> For Windows all dependencies can be found in the <a href="https://github.com/SFML/SFML/tree/master/extlibs">extlibs</a> directory.</p>
 <p><strong>Example</strong></p>
 <p>Here's a diagram showing how the static linking should look like.</p>
 <pre><code> sfml-window-s  sfml-system-s  opengl32  winmm  gdi32
         |         |            |         |      |
         | +-------+            |         |      |
         | | +------------------+         |      |
         | | | +--------------------------+      |
         | | | | +-------------------------------+
         | | | | |
         v v v v v
        example.exe</code></pre>

 <h2 id="graphics"><a class="h2-link" href="#graphics">SFML Graphics</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="graphics-image-formats"><a class="h3-link" href="#graphics-image-formats">What image formats does SFML support?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML can load the following file formats: bmp, dds, jpg, png, tga, psd<br>
But keep in mind that not all variants of each format are supported.</p>
 <p>Also see the official <a href="documentation/2.2/classsf_1_1Image.php#a9e4f2aa8e36d0cabde5ed5a4ef80290b">documentation</a>.</p>

 <h3 id="graphics-white-rect"><a class="h3-link" href="#graphics-white-rect">Why do I get a white/black rectangle instead of my texture?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>This is due to a premature destruction of the <code>sf::Texture</code>. An <code>sf::Sprite</code> only holds a reference to the <code>sf::Texture</code> bound to it. You have to keep the <code>sf::Texture</code> "alive" as long as the sprite uses it. It can also be that you never bound a texture to the sprite, hence you need to call <code>setTexture()</code> with the initial texture it is to use.</p>
 <p>When your texture is relocated from one memory location to another you have to inform your sprite of this using its <code>setTexture()</code> function as well or better yet by managing your textures in a way that won't</p>

 <h3 id="graphics-image-texture"><a class="h3-link" href="#graphics-image-texture">What is the difference between sf::Image and sf::Texture?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>In essence, there is no difference between the two data structures. The main question you have to ask yourself is not what the difference is, but where the data is stored.</p>
 <p>In the case of <code>sf::Image</code>, the image data is stored in client-side memory, meaning in your system RAM. In there it is just an array of bytes (4 per pixel) that make up the image you can see on your screen.</p>
 <p>In the case of <code>sf::Texture</code>, it is also image data, however this data resides in server-side memory, meaning in your graphics RAM next to your GPU. This memory is managed completely by OpenGL and the <code>sf::Texture</code> is merely a handle to that block of memory in graphics RAM. There are many forms of storage of textures but SFML uses the same layout for <code>sf::Texture</code> as it does for <code>sf::Image</code> namely quad-byte RGBA.</p>
 <p>You can convert freely between sf::Image and sf::Texture, however just keep in mind that the bus bandwidth is limited and doing this too often means you are transferring a lot of data between graphics RAM and system RAM leading to a slowdown of all graphics related operations.</p>

 <h3 id="graphics-sprites"><a class="h3-link" href="#graphics-sprites">My FPS count drops when drawing a lot of sprites.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>This may happen due to many reasons, some may depend on the code and circumstances, but a possible bottleneck is the amount of draw calls. When using a lot of <code>sf::Sprites</code> you need to make an equal amount of draw calls to make them show. </p>
 <p>As each draw call changes the render target, it can become slow to modify it in n-amount of loops and calls when it would be most efficient to do it in just one. The reason SFML doesn't work like this is, that it would limit what you can do with <code>sf::Sprite</code> and would force the usage of a single texture in cases where this might not be desirable or even possible due to GPU limitations.</p>
 <p>In order to raise FPS in this circumstance there is no choice other than using bare <code>sf::Vertex</code>/<code>sf::VertexArray</code> or finding another way to achieve the same effect. These on their own however won't be magical and a wrapper will most likely help do the desired render in a nice looking notation.</p>
 <p>In the <a href="https://github.com/SFML/SFML/wiki/Sources">SFML Wiki Source Codes</a> section you can find some classes used for fast rendering in some cases such as Tile-Map renderers or containers for transformable sprites that use the same texture.</p>

 <h3 id="graphics-vsync-framelimit"><a class="h3-link" href="#graphics-vsync-framelimit">Should I use VSync, window.setFramerateLimit or something else?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>It really depends on what you are trying to achieve. In a broader sense, both enabling vertical synchronization and limiting the framerate achieve the same results, however, the devil is in the details.</p>
 <p>Originally, with cathode-ray tube (CRT) displays, an electron beam would be diverted by magnetic fields both in horizontal and vertical directions. You can think of the beam as a sort of "pen" drawing onto each pixel of your screen each and every frame. Naturally, it takes time for the beam to travel from the starting position to the ending position of each frame, and this is what dictates the maximum refresh rate the display will support. The electrical fields merely divert the beam, but if there was only a single beam, you would only see a single color on your screen. In order to get the full color palette, 3 beams are used, one for each color channel. The intensity of each beam hitting a pixel of the screen leads to different intensities in each color channel and is controlled by the data that the display is sent by the graphics card.</p>
 <p>In an ideal scenario, the monitor would be sent a new set of data exactly once every refresh, right before the beams start traveling. This would mean that the GPU is synchronized with the monitor, as it delays updating the framebuffer until the beams are at the starting position. If the framebuffer would be changed while the beams are mid-way through the screen, you would see half of the old image and half of the new one. This is known as <strong>tearing</strong> and is the primary purpose why vertical synchronization was necessary and still exists today. In the future however, it will become less and less of an issue and at some point, vertical synchronization will no longer be necessary and support probably removed from newer hardware.</p>
 <p>VSync is typically implemented as a blocking call in the buffer swap in the driver, which is the only reason why it is viable and mistakenly used instead of the framerate limiter. The driver simply isn't allowed to discard frames in order to synchronize, so if the application produces them too fast, it will have to be throttled through blocking. If the application doesn't produce frames fast enough, the driver will have no choice but to duplicate them, possibly leading to strange results. In most implementations, the driver will block in the buffer swap using a busy wait loop in order to get the precise timing required to satisfy the hardware constraints. For this exact reason, <strong>it might even be counter-productive to use VSync to save CPU power</strong>.</p>
 <p>With that out of the way, you might understand why you need VSync now. It is to solve a <em>hardware limitation</em>. Using it to limit your applications framerate in order to e.g. make your computations more predictable or to save CPU power is simply misusing it. For these use cases, the CPU framerate limiter exists, which yields the CPU time slice to other threads/processes or even truly puts the CPU to sleep if there is no work to be done. Another caveat is that different systems have different hardware, and might end up having different refresh rates leading to different framerates if you rely on VSync to limit your framerate. If your aim was to make your simulation more predictable across different systems, this is another reason why VSync doesn't help you. <strong>You should really only use VSync when you know you will have tearing problems and the framerate limiter for every other case.</strong> In <em>very very advanced</em> scenarios, people might even have to use both simultaneously, but those use cases are beyond the scope of this FAQ.</p>

 <h3 id="graphics-xsprite"><a class="h3-link" href="#graphics-xsprite">Should I use one sprite or x sprites to draw x textures?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Generally, the less objects you have to draw, the faster your application will run. This is almost always true. If you can, you should try to group things that are always drawn together and draw them using a single sprite. This will save you a lot of additional processing time.</p>
 <p>What you should not do is only use a single <code>sf::Sprite</code> and keep binding different <code>sf::Textures</code> to it. Although you are only using a single <code>sf::Sprite</code>, you are still creating as many draw calls as if you would have an <code>sf::Sprite</code> for each <code>sf::Texture</code>. The overhead of rebinding an <code>sf::Texture</code> to the <code>sf::Sprite</code> many times during a frame will noticeably affect your performance.</p>
 <p>You can also try to perform rudimentary culling. Culling consists of not drawing things that you know cannot be seen anyway because they are entirely covered by something else. If this can be done in your application and you prevent a lot of unneeded draw calls, you will gain performance.</p>

 <h3 id="graphics-bounds"><a class="h3-link" href="#graphics-bounds">What is the difference between LocalBounds and GlobalBounds?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>To understand this, you will first need to understand the difference between the local and global coordinate systems.</p>
 <p>To make this easier to understand, consider you went for a walk in the woods. A friend calls you and and asks what you are doing. When you tell them you are walking through the woods, they suggest they join you so that you both can talk a bit as well. Obviously, a question that will eventually be asked is: "Where are you currently and where are you heading?" If you reply with: "I'm walking upstream along the river." They might tell you that they still have no idea where that is, since this woods is very large and there are multiple rivers that you could be walking along. You understand and instead tell them your current GPS coordinates and your current heading using a compass.</p>
 <p>What you initially told them is your position relative to the local coordinate system of the section of the woods you are in. In this section of the woods, there is only a single river and thus telling anyone else in the same section of the woods you are walking upstream is sufficient to let them know where you are. If you are outside of the woods, you have no choice but to use the global coordinate system, in this case, the WGS (GPS) coordinate system and heading.</p>
 <p>In SFML, drawable object coordinate systems follow the same principle. They can return their bounds both in their own local coordinate system as well as in the global coordinate system. The global coordinate system is typically the coordinate system of the render target that ends up drawing the object.</p>
 <p>Keeping this in mind, the local bounds of an object is always made up of a rectangle positioned at (0,0) <em>in the object's coordinate system</em> and with a sufficient width and height to completely contain the object within it.</p>
 <p>Another important thing to remember is: <strong>In SFML, the bounds of an object are always expressed as an axis-aligned bounding box (AABB).</strong> This is true even after rotating an object.</p>
 <p>The global bounds of an object is simply the local bounds rectangle transformed by the object's stored transformation. If the object itself is not positioned at (0,0) in the global coordinate system, its position offset will be the global bounding rectangle's position. Now for the tricky part: <strong>Rotation</strong>. If you want to understand how the width and height of the global bounds of a rotated object are computed, you have to imagine the local bounding rectangle as 4 points. These 4 points are rotated by the stored rotation in the object's transform. The final position of those points are then used to compute the new AABB that will contain all 4 of those rotated points. If the object is not rotated in multiples of right-angles, following what was just explained, the global bounds of the object will almost always be larger than the local bounds of the object. If this is hard to imagine, you can try drawing a rectangle on a sheet of paper, rotating it and drawing the new AABB around it after it is rotated.</p>

 <h3 id="graphics-low-fps"><a class="h3-link" href="#graphics-low-fps">My FPS is very low when running my application.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>First thing is first, check that the FPS value isn't constantly hovering around <em>certain</em> special values (60, 75, 80, 144, etc.). If it does hover around those values no matter what you do, it is very likely that it is being artificially limited <em>somewhere</em>. Double check that there are no such limitations before proceeding to the next steps.</p>
 <p>A mistake that many people make when they talk about low FPS in their application is to assume that it is caused by their graphics. It <em>might</em> be the case, but it is not always the case. Often, the application does <em>much</em> more CPU work than real graphics work, and the application is CPU-bound as opposed to GPU-bound. A rough way to estimate whether your application is CPU-bound is to monitor your application's CPU usage. If it is close to 100% utilization, chances are high that it is CPU-bound. In these cases, reducing the CPU load per frame will lead to shorter times per frame and accordingly more frames per given time period.</p>
 <p>Once you have a feeling that your application is CPU-bound, the best tool to find the <em>hotspots</em> (places where the CPU spends the most time) in your application is a performance profiler. Any decent profiler will make it easy to find hotspots. From there, you can try to optimize your code in terms of CPU (not GPU).</p>
 <p>If however, you notice that your application is not CPU-bound and still have a low FPS value, you need to start assessing how you are drawing things. SFML makes use of OpenGL to render. A not so insignificant portion of the time spent drawing with OpenGL is spent in the driver and in the communication with the graphics hardware. Naturally, if the driver has "less to do" and "has to communicate less" with the hardware, you will get better graphics performance. This is the reason why one of the first optimizations is to consider batching multiple smaller objects into larger ones to be drawn at the same time. SFML doesn't help you at all with this. You will have to evaluate what the best course of action is and devise an optimized solution using the tools that SFML provides you. A general rule of thumb when it comes to optimizing in this respect is: <strong>The less <code>.draw()</code> calls you have each frame, the faster it will run.</strong></p>
 <p>For more advanced optimization techniques, you can search the forum, or open a thread with the information you have gathered from the previous steps.</p>

 <h3 id="graphics-broken-rendertexture"><a class="h3-link" href="#graphics-broken-rendertexture">RenderTextures don't work on my computer!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>First of all, as with everything else sfml-graphics related, check if you have drivers installed that expose the hardware functionality that SFML uses. If you have a system that came with pre-installed drivers, that still doesn't mean that they were bug-free or even supported everything that the hardware would be capable of. There is never an excuse not to at least check for updated drivers and try to install them. This might not always be possible, but for the majority of cases (and almost all the time for desktop computers) it is possible.</p>
 <p>Once you are sure that your drivers are up-to-date, check if your graphics hardware supports OpenGL Framebuffer Objects (GL_EXT_framebuffer_object extension). If you are sure it does and RenderTextures still don't work, open a thread on the forum with the information you have gathered and almost all the time, you will be assisted promptly.</p>
 <p>If your graphics hardware doesn't support OpenGL Framebuffer objects, fear not, because SFML has a fallback implementation which uses an auxiliary context's framebuffer to render to. The performance ranges from marginally slower than the native implementation to much slower e.g. in software renderers.</p>
 <p>If the second variant doesn't work for you either, and you know that your hardware is somewhat capable, open a thread on the forum with the information you have gathered and a solution will be worked out most of the time.</p>

 <h3 id="graphics-smooth-animation"><a class="h3-link" href="#graphics-smooth-animation">My animations/movements aren't smooth or exhibit stuttering!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>The most common cause of this is because you are directly or indirectly relying on your application running at a fixed frame rate. Frame rates cannot be reliably locked to a certain value without a lot of effort and knowledge of lower level operating system aspects. The reasons for this are given <a href="#window-set-framerate-limit">here</a> and <a href="#system-sleep">here</a>. Using vertical synchronization is out of the question because this might result in different frame rates on different systems.</p>
 <p>Suppose you have a simple loop as such:</p>
 <pre><code class="cpp">while( window.isOpen() ) {
    // Event handling

    // Update sprite position
    sprite.move( 1.f, 0.f );

    // Draw everything
    window.clear();
    window.draw( sprite );
    window.display();
}</code></pre>
 <p>This loop simply moves the sprite by 1 unit (be it raster position, pixel etc.) in the positive direction along the x-axis every frame and displays it.</p>
 <p>The problem with this loop is that the change in position is made using a <strong>fixed amount per frame</strong>. This means that the more frames pass, the more the sprite will move. Assuming that the same number of frames pass in the same amount of time, this leads to the sprite moving at a constant velocity (keeping the same speed). However, remembering what was said above, we cannot assume this to be the case. <strong>Frame rates will always vary</strong>, and hence if the sprite moved a constant amount every frame, its apparent speed is based entirely on the frame rate of the system running the application. The faster a frame completes, the more frames will pass in a given amount of time and the more the sprite will move in a given amount of time, hence the faster the apparent movement.</p>
 <p>The solution to this problem is simply to make the movement of the sprite independent of the frame rate. </p>
 <p>To implement this solution, one has to consider the <strong>speed or velocity</strong> of the sprite. Speed is conventionally measured in m/s or km/h. In any case, it is distance traveled divided by elapsed time. What we have with the problematic implementation is a velocity specified in terms of pixels/frame and (considering a pixel as a distance in this simplification) a frame is not a unit of time.</p>
 <p>The first step would be to specify the speed of the sprite, e.g. 100 pixels per second.</p>
 <p>The next step would be to translate that speed into movement every frame. We know that speed is distance traveled divided by time elapsed, so using simple mathematics we can translate 100 pixels per second and an elapsed time back into a distance traveled.</p>
 <p>distance traveled = speed * elapsed time</p>
 <p>This is considered as a simplification of integration in scientific contexts.</p>
 <p>We have our speed, but how do we get the amount of time elapsed? Simple, with an <code>sf::Clock</code>. If you don't know how to use an <code>sf::Clock</code>, it is suggested you refer to the <a href="learn.php" taget="_blank">SFML tutorials and documentation</a>.</p>
 <p>The first step of each new frame would be to determine how much time has passed since the same line of code was executed during the previous frame. This gives us a fairly accurate estimation of the true elapsed time which is more than enough for our intents. Using this time, we simply multiply with the speed of the sprite to get the value by which it moved during the frame.</p>
 <p>In code this would look like this:</p>
 <pre><code class="cpp">// Our speed in pixels per second
float speed = 100.f;

// Our clock to time frames
sf::Clock clock;

while( window.isOpen() ) {
    // Event handling

    // Get elapsed time
    float delta = clock.restart().asSeconds();

    // Update sprite position
    sprite.move( speed * delta, 0.f );

    // Draw everything
    window.clear();
    window.draw( sprite );
    window.display();
}</code></pre>
 <p>This code will move the sprite at 100 pixels per second regardless of frame rate.</p>
 <p>One thing to remember is that the physical units (pixels, meters, seconds, kilograms, etc.) you use in your code should be consistent. This means that if you use pixels per second in your speed definitions, you should use the elapsed time in seconds as well. If you don't match these up, you will get effects much more prominent or subtle than what you might expect, resulting in things disappearing out of sight because they move really fast as an example.</p>
 <p>This is just one way out of many to deal with this issue. It was presented here because it is the simplest to implement and explain in this FAQ.</p>

 <h2 id="audio"><a class="h2-link" href="#audio">SFML Audio</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="audio-formats"><a class="h3-link" href="#audio-formats">What audio formats does SFML support?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>The Audio module is capable of playing wav, ogg/vorbis and flac files.<br>
 Unfortunately MP3 is covered by a license from Thompson Multimedia and thus support for it is not included in SFML. For more information regarding the MP3 license, see <a href="http://www.mp3licensing.com">http://www.mp3licensing.com</a>.</p>

 <h3 id="audio-sound-problem"><a class="h3-link" href="#audio-sound-problem">Why can't I hear any sound?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>If everything compiles and seems to work correctly, but yet no sound is coming out of your speakers you should check the obvious. Ensure your speakers and plugged in and working correctly before assuming something is wrong with SFML. You can do this by opening one of your audio assets in another audio player such as Windows Media Player or <a href="http://www.videolan.org/">VLC</a>. If audio fails to play correctly there, then check that your PC audio is not muted and that the volume control on your speakers is turned up. Once it plays correctly in an external player then the problem may be with SFML.</p>

 <h2 id="networking"><a class="h2-link" href="#networking">SFML Networking</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="network-create-network-app"><a class="h3-link" href="#network-create-network-app">How do I create &lt;insert popular application type here&gt;?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>The first thing you need to do is understand how the underlying networking of said application works. Behind every complex looking application there is a simple system of how systems send data to each other and what kind of data they send.</p>
 <p>There are 2 kinds of topologies:</p>
 <ul>
  <li>Client-Server</li>
  <li>Client-Client (Peer-to-Peer)</li>
 </ul>
 <p>Client-Server is generally easier to set up and often achieves higher performance than Client-Client due to the fact that dedicated servers are already configured to handle a large amount of traffic from multiple connected systems. When running a server application you can also be sure that clients can not manipulate the game state (cheat) themselves unless they have direct access to the server and can execute things there (which requires logging in etc.).</p>
 <p>When running in a Client-Client configuration, the first thing to overcome is the initial connection establishment. Home/Office gateways/routers are mostly configured by default to not accept any incoming connection requests. As such none of the sides can establish a connection to the other. There is a way of overcoming this called <a href="http://en.wikipedia.org/wiki/NAT_hole_punching">NAT hole punching</a>, however this is beyond the scope of this FAQ. Care has to be taken to ensure that nobody is able to cheat in this topology. This is usually done by mirroring the game state across all involved systems and performing checks and synchronization at every game step.</p>
 <p>Once you have picked a suitable topology for your application, you can start to think about what kind of data you want to send between the systems. There is no general answer or recommendation for this as this is very application specific and you will have to rely on good judgment to make the right choices.</p>

 <h3 id="network-tcp-vs-udp"><a class="h3-link" href="#network-tcp-vs-udp">Should I use TCP or UDP sockets?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>One must first understand what the difference is between TCP and UDP.</p>
 <p>TCP is connection based and provides <strong>reliable and ordered delivery of data</strong> from one endpoint to the other. Connection based means you need to establish a TCP connection before you can make use of it for data transfer. It takes care of everything you can possibly think of (and might not think of) except creating and using the data that it sends and receives, that is still your task. Simply put, when you have an established TCP connection, whatever you shove into one end will in almost all cases come out the other end, in the right order, even over very very bad internet connections. If it doesn't arrive at the other end, both sides will be notified of the error and can perform the necessary error recovery. This comes at a price however, TCP packet headers are <strong>at least 20 bytes and at most 60 bytes</strong> large. This means that if you send a packet containing 1 byte over a TCP connection, your network adapter will need to transmit at least 21 bytes to get the data to the other end (disregarding the overhead from the lower OSI layers which is always present both in TCP and UDP). Also note that TCP streams are bi-directional, meaning you can use them to send and receive data in both directions, there is no need to create 2 separate TCP connections to transfer data between 2 endpoints (unless the data streams have different purposes and you want to separate them at the transport layer).</p>
 <p>UDP provides <strong>unreliable delivery of data</strong> from one endpoint to the other. It is not connection based and <strong>does not guarantee anything</strong>. This means that if you are unlucky, you might not receive what you send, what you send might be received in a different order than the order you sent in or you might even receive duplicates of what you sent. In case of a transfer failure UDP also won't notify you that anything happened, it is completely up to you to take care of detecting and handling all these cases. The advantage of UDP is that its <strong>header size is always 8 bytes (40% of TCP)</strong> so if you send very small packets very often, you can save a lot of bandwidth if you use UDP. At larger packet sizes the header overhead is amortized and both protocols are just as efficient bandwidth-wise as the other. In the case of UDP, because there is no concept of a connection, it is your responsibility to keep track of who is sending and receiving what data because in general a server will only bind a single UDP socket with which all clients will send data to (unless they open up a new socket per client). You can also send data to multiple clients over one UDP socket because you always have to specify the destination of a datagram.</p>
 <p>You might be wondering: "Woah! Who would even use UDP instead of TCP? There are so many disadvantages."</p>
 <p>Well... If you implement your own reliable transport protocol on top of UDP, you can consider it as a form of "fine-tuned TCP" that does exactly what you want and no more. You could reduce the communication overhead considerably and even have the advantage that UDP traffic generally gets processed faster when traveling over the internet, which means lower latency. This is the reason why many latency critical applications choose to use UDP instead of TCP.</p>
 <p>If you are developing your first networked application, stick with TCP as long as you can. Bandwidth and latency issues will not be your biggest concern until you are sure you can make money off it. Once that time comes, you will have gained so much experience that the decision will be trivial.</p>

 <h3 id="network-blocking-non-blocking-selectors"><a class="h3-link" href="#network-blocking-non-blocking-selectors">Should I use blocking or non-blocking sockets? And how do selectors work?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>It depends on what kind of an application you are developing and what your preference is. If you are just beginning to learn network programming, you can use blocking sockets when writing your first echo server (a server that waits for data to be received and instantly sends back a response). In this case the server does not do anything else but reply to incoming data and as such can block as much as it wants.</p>
 <p>If, however, the server has other duties as well, such as updating an internal state every frame, blocking the state update thread must be avoided at all costs. This means, either you block in a separate thread, you call blocking operations <strong>when you know they should not block</strong> using selectors or you just use non-blocking sockets.</p>
 <p>Because creating a separate thread for each blocking socket can result in a large amount of threads created, this method is not recommended unless you are sure that the number of expected connections stays manageable.</p>
 <p>Using non-blocking sockets might seem the easiest at first, but one must consider that every time you poll the socket for new data, you are making numerous operating system calls which means a lot of overhead just to determine if the socket could be read or not. Even at a moderate number of sockets, this can become quite expensive. This is why selectors exist.</p>
 <p>To solve the previous problem, operating systems provide methods of polling a large number of resources for their readiness simultaneously or at least in a very efficient manner. The principle idea is that you tell the operating system which resources you want to monitor and it sets the respective field within the selector when that resource becomes ready. That way you only have to check if the field is set, and the operating system only sets the field when something really does happen thus resulting in a very efficient way of checking for readiness. The <code>sf::SocketSelector</code> in SFML wraps all this functionality. You can ask the selector if a socket is ready and it will perform all the low level operations for you.</p>
 <p>The most universal choice is using selectors and blocking sockets, as they are suitable for any scenario with little to no drawbacks. Many high performance applications still use selectors nowadays although there newer ways are constantly being developed to do the same which are just a bit more efficient.</p>

 <h3 id="network-internet-network"><a class="h3-link" href="#network-internet-network">I can't connect to the other computer over the internet!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>This is probably one of the hardest "problems" to solve, as the number of error sources is quite high (up to the point where you aren't even responsible for the error yourself).</p>
 <p>Since there is no general solution to this problem, here is a list of things you can check:</p>
 <ol>
  <li>Make sure that it isn't just a programming error. Read the documentation and assure that what you are trying to achieve is reflected in your code.</li>
  <li>Make sure that the addresses you use are correct. There are 3 ways you can identify an endpoint. Obviously if you want to address an endpoint that isn't part of your local network you can not use the first option.
   <ul>
    <li>By private address e.g. 192.168.1.1 (192.168.<em>.</em>, 10.<em>.</em>.* and 172.16.<em>.</em> to 172.31.<em>.</em> are all private networks)</li>
    <li>By public address e.g. 123.123.123.123</li>
    <li>By FQDN (Fully-Qualified Domain Name) e.g. <a href="http://www.sfml-dev.org/">www.sfml-dev.org</a> (www is the <em>hostname</em> and sfml-dev.org is the <em>domain name</em>)</li>
   </ul>
  </li>
  <li>Make sure that data transmission is not hindered by anything in the networking infrastructure (routers, firewalls etc.), if you are not sure about this, it most likely means that the port you are trying to use is either closed or not configured to be forwarded behind a NAT.</li>
  <li>Make sure that data is really being sent and received by the hosts independent of your application. It might occur that you try to send data within your application, SFML doesn't report an error, but the operating system refuses to transmit it. To check if this problem exists, it is recommended that you install some form of packet capturing software such as <a href="http://www.wireshark.org/">Wireshark</a> on both systems.</li>
  <li>Make sure that the data leaves the local network over the router. There is a possibility that the router blocks outgoing data as well.</li>
  <li>Make sure that the data arrives at the destination network router and is properly forwarded. If you are sure that the data leaves the origin network but never arrives at the destination network, try using a different port. Some ISPs have policies that block traffic from certain software and because they are not interested in using a better filtering mechanism, they decide to block the whole port instead of only traffic that really stems from the specific software. If you happen to use one of those ports, you are unlucky and should just try another.</li>
  <li>If you are sure that the port you use isn't blocked, in very very rare cases it might be an error somewhere on the way from the source the the destination within some ISPs network. If this is really the case, you are as good as out of luck and should just try again at another time or be prepared to make a lot of phone calls with a lot of uninterested people.</li>
  <li>If the ISP assures you that there is nothing wrong with their network, you must always take this with a pinch of salt because unless they contractually bind themselves to what they say, it might have been just to make you end the call.</li>
  <li>When all else fails, you can always come to the SFML forum and ask for help there.</li>
 </ol>

 <h2 id="window"><a class="h2-link" href="#window">SFML Window</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="window-transparent-window"><a class="h3-link" href="#window-transparent-window">How do I make my window transparent?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Unfortunately SFML can't help you with this. The style and representation of the application window within your window manager/desktop environment is specific to the environment you are currently in. Because of this SFML cannot provide a uniform interface for controlling the representation of your application window.</p>
 <p>SFML does however provide <code>sf::Window::getSystemHandle()</code>. Using the handle you can do a bit of research and find out how to manipulate the window representation yourself using the functions of your window manager.</p>

 <h3 id="window-get-frame-time"><a class="h3-link" href="#window-get-frame-time">What happened to getFrameTime()?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p><code>getFrameTime()</code> was removed from SFML at the beginning of 2012. The reasoning for it can be found here: <a href="http://en.sfml-dev.org/forums/index.php?topic=6831.0">http://en.sfml-dev.org/forums/index.php?topic=6831.0</a></p>
 <p>Users have to create an <code>sf::Clock</code> object now and keep time themselves. This has more advantages than disadvantages including:</p>
 <ul>
  <li>Correct time reporting (<code>getFrameTime()</code> reported the time spent <strong>during the last frame</strong>)</li>
  <li>More control over between which points in your code the time is to be measured</li>
  <li>More control over the precision required</li>
 </ul>

 <h3 id="window-set-framerate-limit"><a class="h3-link" href="#window-set-framerate-limit">Why doesn't setFramerateLimit() always set the frame rate to the specified limit?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p><code>setFramerateLimit()</code> is implemented using a call to <code>sf::sleep()</code> every frame. The intricacies of sf::sleep are explained <a href="#system-sleep">here</a>.</p>

 <h2 id="system"><a class="h2-link" href="#system">SFML System</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="system-unicode"><a class="h3-link" href="#system-unicode">Does SFML support Unicode?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML supports the input and display of international characters, via the UTF-16 encoding. Input is provided via <code>sf::Event::TextEntered</code> as <code>sf::String</code> and can be display with <code>sf::Text</code>.</p>

 <h3 id="system-string-convert"><a class="h3-link" href="#system-string-convert">How do I convert from sf::String to &lt;type&gt; and vice-versa?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>For conversions to <code>sf::String</code>, you can just construct the <code>sf::String</code> directly from whatever object you already have. </p>
 <pre><code>sf::String sfml_string( cpp_string );</code></pre>
 <p>There are enough constructors that take care of implicit conversion from all standard C++ string types. If you want to see what these look like, take a look in the <a href="documentation/2.2/classsf_1_1String.php"><code>sf::String</code> documentation</a>. If you want to convert from a non-C++ string to <code>sf::String</code>, it is recommended to first convert to a C++ string and then to an <code>sf::String</code>. Since any library using custom string types should provide support for this, this shouldn't be problematic.</p>
 <p>For conversions from <code>sf::String</code> to any other custom string type, it is also recommended to first convert to a C++ string then from C++ string to that type.</p>
 <p><code>sf::String</code> supports implicit conversion to <code>std::string</code> and <code>std::wstring</code>, so things like</p>
 <pre><code class="cpp">std::cout << sfml_string << std::endl;
cpp_string += sfml_string;
std::size_t pos = cpp_string.find( sfml_string );</code></pre>
 <p>are all valid. Additionally, if implicit conversion isn't something that comforts you, you can explicitly call <code>.toAnsiString()</code> or <code>.toWideString()</code> to convert to the corresponding types.</p>
 <p>Because internally <code>sf::String</code> stores its data in a <code>std::basic_string&lt;sf::Uint32&gt;</code>, conversions to this type (which is a C++ string type) are lossless. Ironically however, conversion to this type is not supported directly by <code>sf::String</code> and one has to perform it via iterators as such:</p>
 <pre><code>std::basic_string<sf::Uint32> basic_uint32_string( sfml_string.begin(), sfml_string.end() );</code></pre>
 <p>Once you have a <code>std::basic_string&lt;sf::Uint32&gt;</code> you can use all of the same functionality as <code>std::string</code>, since <code>std::string</code> is just a typedef for <code>std::basic_string&lt;char&gt;</code>.</p>

 <h3 id="system-threads-crash"><a class="h3-link" href="#system-threads-crash">My program keeps crashing when I use threads!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Threading is a very advanced concept, and not something you should try merely because you heard it <em>can</em> increase performance. In fact, if used improperly, <em>it even decreases performance</em>! You should always be able to argue in favor of using threads before even writing your first line of threaded code. <strong>If you don't fully understand why your application is going to run faster with threads, then just don't use them.</strong></p>
 <p>When you are sure you will benefit from using threads, you will have to be more careful with how you access memory. Almost all crashes when using threads are attributed to wrong memory access patterns. What you want to avoid are:</p>
 <ul>
  <li>Multiple concurrent reads and at least one write to the same memory location</li>
  <li>Multiple concurrent writes to the same memory location</li>
 </ul>
 <p>Concurrent reads to the same memory location are generally unproblematic.</p>
 <p>In order to protect against the above scenarios, you will need to make use of mutex objects. SFML provides a cross-platform mutex implementation. See <a href="#system-mutex">below</a> for how to use them.</p>
 <p>Even after you have protected against concurrent access, you still need to be wary of the order in which statements are executed. Once you venture into threading, there is no longer an execution ordering guarantee, and it is ultimately up to you to make sure things are done in the right order across different threads.</p>
 <p>Good system designs often make threading optional and provide an option to disable them, whether for debugging or other purposes.</p>

 <h3 id="system-mutex"><a class="h3-link" href="#system-mutex">How do I use sf::Mutex?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p><code>sf::Mutex</code> is used to lock (acquire) a resource for exclusive access and unlock (release) a resource when exclusive access is no longer necessary. If you try to lock a mutex that has already been locked by another thread, you will have no choice but to wait for the locking thread to release the lock in order for execution to proceed.</p>
 <p>It is good practice to not lock/unlock an <code>sf::Mutex</code> directly, but to rely on RAII <code>sf::Lock</code> objects to automatically unlock their owned mutex on destruction.</p>
 <p>For more information on <code>sf::Mutex</code> and <code>sf::Lock</code>, refer to the <a href="tutorials/2.1/system-thread.php#protecting-shared-data">official documentation</a>.</p>

 <h3 id="system-thread-container"><a class="h3-link" href="#system-thread-container">Why can't I store my sf::Thread in an STL container?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p><code>sf::Thread</code> inherits from <code>sf::NonCopyable</code> meaning you cannot copy or assign an <code>sf::Thread</code>. This is however a requirement to use a data type with an STL container.</p>
 <p>You might be wondering how it would still be possible to store multiple threads in an STL container if you are trying to implement some sort of thread pool. The answer is simple: instead of storing instances, store pointers to the <code>sf::Threads</code>.</p>
 <p>The <code>sf::NonCopyable</code> restrictions can only apply to instances of an <code>sf::Thread</code>. When copying pointers, the copy constructor or assignment operator of a class are not invoked. As such it is perfectly legal to copy and pass pointers around.</p>
 <p>Since working with raw pointers is something you want to avoid in modern C++, you can use <a href="#prog-smart">smart pointers</a> to great extent in combination with this technique.</p>

 <h3 id="system-sleep"><a class="h3-link" href="#system-sleep">Why doesn't sf::sleep sleep for the amount of time I want it to?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>When calling <code>sf::sleep()</code> you are requesting that the operating system halts execution of the current thread and yields the time slot allocated to it by the task scheduler to another task, a task being anything requiring execution time, from processes to threads and fibers if they are supported.</p>
 <p>Because the CPU doesn't actually sleep in a multi-tasking environment, this has to be realized by an entry into an operating system specific lookup table. This lookup table informs the scheduler to skip the sleeping thread when selecting the next task to execute for a given time slice. Depending on the implementation of the operating system's sleep facility, keeping track of how long the thread has slept for and when to wake it up again is performed differently.</p>
 <p>There are multiple possible reasons <code>sf::sleep()</code> might return prematurely, and even overdue. It is entirely dependent on what the operating system chooses to do and a bit of luck.</p>
 <p>As described above, the operating system has to keep track of the amount of time slept and when to wake the thread up. Because high resolution timers might not be available on all systems, the default resolution may be set very low. If as an example, the system timers have a resolution of 10ms and you request to sleep for 11ms, the operating system will be forced to round up in most cases and make your thread sleep for 20ms instead because it is a multiple of the base resolution. In this case <code>sf::sleep</code> sleeps longer than it should.</p>
 <p>If however, you requested to sleep for 5ms and that request was made right before the internal operating system timer ticks, it will count as "10ms has passed" to the operating system and it will wake your thread up again although the 5ms have not fully passed. In this case, <code>sf::sleep()</code> would sleep for shorter than it should.</p>
 <p>In recent revisions of SFML, the timer resolution is temporarily increased during a call to <code>sf::sleep()</code> to increase the likelihood of your sf::sleep call sleeping for the correct amount of time.</p>
 <p>One thing to remember is that although the operating system marks your thread as "awake" after it is done sleeping, even for exactly the correct duration, it doesn't mean it resumes execution immediately. It could have just missed the moment at which the scheduler selects which task to execute next and thus must wait for the next transition. In this case, although your thread slept for the correct amount, it will appear to you as if it slept for more. SFML doesn't allow you to sleep for 0 duration, however if you could, you would notice that it in fact takes a slight bit of time as well. This is because it is common for specifying 0 to the operating system to translate to simply yielding your execution time slice to another thread.</p>
 <p>In the end, what this means is that <code>sf::sleep()</code> is merely a guideline, and not a contract. The longer you sleep for, the more accurate it will be. The shorter you sleep for, the less accurate it will be and to a certain extent more dependent on luck it will become.</p>

 <h2 id="programming"><a class="h2-link" href="#programming">Programming in General</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="prog-raii"><a class="h3-link" href="#prog-raii">What is RAII and why does it rock?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>RAII is an acronym for <strong>R</strong>esource <strong>A</strong>cquisition <strong>I</strong>s <strong>I</strong>nitialization. It is a programming idiom/technique that is used extensively in C++ and can be used in other programming languages as well.</p>
 <p>The origin of this idiom lies in the way of how exceptions work in C++. When an exception is thrown in a code block, execution is diverted to the relevant handlers and the program flow continues on from there. If the programmer has to rely on ALL his code in a block being executed to perform the necessary clean up of resources, this can be a problem in the case an exception is thrown because it is not guaranteed that the clean up code will be executed and resources will not be destroyed properly.</p>
 <p>To address this issue, RAII takes care of the fact that although not all code is executed when an exception is thrown, the destructors of an object are guaranteed to be called because all objects have to be destroyed when the corresponding scope is left.</p>
 <p>This can be used in any resource owning object or in places where certain functions have to be called to make sure the program stays in a clean running state. A good example of this is an sf::Texture. No matter what happens, if the sf::Texture object gets destroyed because it goes out of scope, the underlying OpenGL resources also get freed.</p>
 <p>From the example just mentioned, it should be apparent that the same can be said of dynamically allocated memory. It is also a resource that we need to free when we are done with it. Because of this, to promote RAII in modern C++, smart pointer facilities have made their way into the language, either as an extension or in C++11 as a part of the STL. Any memory governed by them is guaranteed to be released when they go out of scope (in the case of non-shared ownership e.g. scoped_ptr) due to RAII. This makes it much easier to use dynamically allocated objects, as you do not have to worry too much about memory management anymore.</p>
 <p>For a more in-depth description with examples, read <a href="http://bromeon.ch/articles/raii.html">this article</a>.</p>

 <h3 id="prog-mmm"><a class="h3-link" href="#prog-mmm">Why shouldn't I manually manage my memory?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Nobody forces you to use automatic memory management, however in practice, the larger and more complex a project gets, the harder it is to keep track of such things as well. Generally it is a good idea to use automatic memory management because it frees you to dedicate more time to more important parts of your project. Not only that, it will be easier to debug and leaks will be nearly impossible.</p>
 <p>C++ has come a long way and in its latest incarnation, C++11, many new memory management facilities made it into the C++ STL. This lets you use these constructs without the need for external or self-written libraries.</p>

 <h3 id="prog-smart"><a class="h3-link" href="#prog-smart">What are smart pointers?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Smart pointers, as their name implies are pointers that are... well... smart :). Regular "raw pointers" are just values, merely an address in memory where an object is located. Unless you do something with those values, nothing is going to happen with the object, and it will sit there until you choose to free the corresponding memory block or close the program and destroy the virtual memory pages associated with it.</p>
 <p>Smart pointers on the other hand, do things with the values that they contain. They are no longer just values but objects that govern the memory they point to. This can help you to track how many pointers exist that point to a certain block of memory (shared_ptr) or to prevent you from having multiple pointers point at the same block of memory at the same time (unique_ptr). The best part is, if you let these smart pointers manage your memory for you, they will also take care of freeing it when they think it isn't used any more.</p>

 <h3 id="prog-global"><a class="h3-link" href="#prog-global">Why shouldn't I use global variables?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Usage of global variables is considered as bad programming practice. They might seem like an easy solution to your initial problem but they will become a headache later on when the project gets bigger or you are unaware of the implications of declaring something in global scope.</p>
 <p>One of the most dangerous things of declaring non-POD (<a href="http://en.wikipedia.org/wiki/Plain_old_data_structure">plain old data</a>) objects in global scope is that you can never be sure when they are actually constructed and when they will be destroyed. This means that if they need to own resources you need to make sure they are available before the object is created, which can be tricky to do if that takes place before your main() code gets executed. Analogous to that, the object might get destroyed after your main() returns thus leaving resource destruction up to some self-clean-up mechanism or in the worst case to a resource manager that already got destroyed before main() returned. This leads to leaks and is very bad practice. Furthermore the initialization order and destruction order is not well-defined. It is only defined <em>within one translation unit</em> as being dependent on the order of declaration, however you can't count on global variables from different translation units being constructed or destroyed in a specific order, it is pure luck here.</p>
 <p>Another problem with global variables is that sooner or later you are going to have so many of them that they will clog up your namespace. Unless you declare them in a separate namespace they will all be in the same giant one: the global one. If you happen to declare a local variable in one of your functions that happens to have the same name as the global one you are actually referring to, you will not notice the global variable get shadowed unless you have certain warnings switched on. Some people suggest using Hungarian notation to solve this problem but the modern demeanor tends to avoid Hungarian notation as well.</p>
 <p>Furthermore, global variables work against code modularity. Global variables can be accessed from anywhere and thus bypass well-defined interfaces between modules. This introduces hidden dependencies in the code, which is not only an additional maintenance burden, but can lead to very difficult-to-track bugs. Simply because you are not able to control the access to global variables, as they can be changed anywhere, at any time.</p>
 <p>As if this were not enough, global variables also play very badly in multi-threaded environments. Access to global variables from different threads must be protected by mutexes. This requires additional care by the developer accessing the variable and often leads much more synchronization overhead than necessary, because variables are protected prematurely. On the other hand, unprotected global variables can silently introduce bugs if an application starts to use multiple threads.</p>
 <p>There really isn't any reason to use global variables. Code using global variables can always be written without them and will never perform worse, most of the time performing better as a result of better memory usage. Keep in mind that the same reasoning applies to static variables, the only difference is their visibility (class/function scope) and in the case of function-static variables, their construction time (at first call instead of program start). Don't use <code>static</code> to "optimize" the construction of function-local variables.</p>

 <h3 id="prog-insteadof-global"><a class="h3-link" href="#prog-insteadof-global">What should I use then instead of global variables?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>You should try to confine variables to the scope(s) where they are used. Construct and hold them in the object which is supposed to own them as well as manage their lifetime and pass them to other objects/functions using references/pointers. Avoid passing by value. Often you cannot copy objects and are thus not allowed to pass by value, other times copying the object can take much more time because temporary memory has to be allocated just for the call and freed after the function returns.</p>
 <p>If you happen to use a C++11 compliant compiler then you can be sure that many Standard Library objects you pass around will have move constructors defined which makes it less painful to "pass by value" since if certain conditions are met, the compiler will use the Rvalue reference version of certain functions to speed up execution by a substantial amount.</p>

 <h3 id="prog-singleton"><a class="h3-link" href="#prog-singleton">Why is the singleton pattern not a good one?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>In short, singleton classes are global variables, they just hide it better. As a result, they share almost all of the related problems (construction/destruction time, implicit dependencies, multithreading). The fact that singletons are referred to as an OOP design pattern makes people think "it's OOP, so it must be good", which is not only a generally questionable conclusion, but particularly in this case. Having a class around it doesn't make code object-oriented; on the contrary, core OOP principles such as modularity or encapsulation are broken in the case of singletons.</p>
 <p>A frequent misconception is the idea that things that are only instantiated once should become singletons. The purpose is to technically enforce that no two instances of a class can coexist. While this on its own sounds reasonable, the singleton technique mixes the solution to this problem with an unrelated aspect: providing a global access point for that one and only instance. And this often introduces far more problems than it promises to solve.</p>
 <p>There are indeed use cases for classes of which only one object should exist, e.g. management-related tasks like rendering, resource handling, configuration, etc. As simple as it may sound, the most straightforward way to have only one instance at runtime is to create only one. The problematic of accidentally creating more is largely overstated, there is usually a clear place where instantiation should happen. And even if that problem should pose a serious threat, it can be trivially mitigated through assertions. That alone is rarely a good reason to pay the high price of having global variables.</p>

 <h2 id="trouble"><a class="h2-link" href="#trouble">Troubleshooting</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="tr-grl"><a class="h3-link" href="#tr-grl">General</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

 <h3 id="tr-grl-trouble"><a class="h3-link" href="#tr-grl-trouble">I'm having trouble using SFML.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>First, make sure that you have followed the installation instructions in the <a href="tutorials/">official tutorials</a>.</p>
 <p>Have you:</p>
 <ul>
  <li>Provided the path to the SFML headers to your compiler?</li>
  <li>Provided your text editor with the path to the SFML library?</li>
  <li>Included the headers for the packages you're using? (“SFML/[capitalized name of module].hpp”)</li>
  <li>Linked with the packages you're using? (See the dependencies section of this document)</li>
  <li>On Windows, have you copied the libsndfile-1.dll and openal32.dll files (you can find them in the complete SDK) into the folder for executable, along with the DLLs for the packages you're using (and all of their dependencies)?</li>
  <li>On Linux, have you installed the libraries (sudo make install in the SFML folder)?</li>
 </ul>
 <p>If you've checked all of those, and SFML still refuses to work, see <a href="#tr-grl-i-found-a-bug">I found a bug!</a>.</p>

 <h3 id="tr-grl-undefined-ref"><a class="h3-link" href="#tr-grl-undefined-ref">I keep getting "undefined reference to &lt;some strange thing that looks like an SFML function&gt;" errors!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>See <a href="#build-link">What and how do I link to use SFML?</a></p>
 <p>If that doesn't help, see <a href="#tr-grl-verbose-ide">How do I make my IDE output verbose build information?</a></p>
 <p>If that also doesn't help, feel free to ask for assistance on the forum.</p>

 <h3 id="tr-grl-verbose-ide"><a class="h3-link" href="#tr-grl-verbose-ide">How do I make my IDE output verbose build information?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Often times, compiling/linking your project might fail for some reason. Even after re-checking all your project settings and comparing it to what is described in the tutorials you still don't know the cause. IDEs (Integrated Development Environments) are nothing but front-ends for the toolchain underneath of it. All that IDEs (such as Code::Blocks, Visual Studio, Eclipse etc.) do is automate and generally make it easier for you to work on your projects from within a single environment, hence their name. Without IDEs, you would have to resort to plain text editors to write your code and manually pass your source files to your compiler/linker on the command-line yourself.</p>
 <p>One way an IDE makes your life simpler is by parsing the compiler/linker output and presenting it to you in a friendlier manner. Often, clicking on an error will take you to the offending line for example. What your IDE does "behind the scenes" when you click on the Build button or press your Build key is invoke a series of commands that you would also able to do yourself (but is simply tedious). It then relays the generated text output, including all warnings and errors back to you after the commands have been run. By default, most IDEs are set by default to not show the commands it runs behind the scenes to the user. However, it is exactly this information that is helpful when building fails. Thankfully, the IDEs let you specify whether you want to see these commands or not.</p>
 <p>The commands are generated from your project configuration information that you set through the IDE user interface. You might think that you set everything right in your project settings, but the only way of knowing for sure is by inspecting the commands that are run. The command line will consist of a large number of flags and parameters. Refer to the compiler/linker documentation if you want to understand them. When asking for assistance in build-related matters on the forum, it is always recommended to provide the full build log (consisting of the commands and the raw output from the compiler/linker) to the other users. It is a very compact way of providing information about your project configuration without having to make several screenshots of your IDE user interface. Experienced users can very quickly spot from what you paste the mistake you made, if any. Don't be surprised if you are immediately asked for this information.</p>
 <p><b>Code::Blocks - all versions, all operating systems</b></p>
 <p>First, open up your compiler settings window.</p>
 <img class="screenshot" src="/images/faq/cb-compiler-settings.png" alt="Screenshot of the Code::Blocks compiler settings menu entry" title="Screenshot of the Code::Blocks compiler settings menu entry" />
 <p>Go to the "Other settings" tab and change the "Compiler logging:" entry to "Full command line".</p>
 <img class="screenshot" src="/images/faq/cb-compiler-logging.png" alt="Screenshot of the Code::Blocks compiler logging setting" title="Screenshot of the Code::Blocks compiler logging setting" />
 <p>Try to build your project and change to the "Build log" tab when it completes.</p>
 <img class="screenshot" src="/images/faq/cb-build-log.png" alt="Screenshot of the Code::Blocks build log" title="Screenshot of the Code::Blocks build log" />
 <p>Inspect the build log and see if it helps solve your problem. If you need further help, you can ask on the forum. In that case copy the output and paste it in your post.</p>
 <p><b>Microsoft Visual Studio - 2008, 2010, 2012 and 2013, Microsoft Windows</b></p>
 <p>First, open up your project properties window.</p>
 <img class="screenshot" src="/images/faq/vs-project-properties.png" alt="Screenshot of the Visual Studio project properties menu entry" title="Screenshot of the Visual Studio project properties menu entry" />
 <p>Make sure you selected the configuration you are trying to build. Open up the C/C++ -> General pane and change the "Suppress Startup Banner" entry to "No (/nologo-)".</p>
 <img class="screenshot" src="/images/faq/vs-compiler-suppress-startup-banner.png" alt="Screenshot of the Visual Studio compiler suppress startup banner setting" title="Screenshot of the Visual Studio compiler suppress startup banner setting" />
 <p>Open up the Linker -> General pane and change the "Suppress Startup Banner" entry to "No".</p>
 <img class="screenshot" src="/images/faq/vs-linker-suppress-startup-banner.png" alt="Screenshot of the Visual Studio linker suppress startup banner setting" title="Screenshot of the Visual Studio linker suppress startup banner setting" />
 <p>Try to build your project.</p>
 <img class="screenshot" src="/images/faq/vs-build-log.png" alt="Screenshot of the Visual Studio build log" title="Screenshot of the Visual Studio build log" />
 <p>Inspect the build log and see if it helps solve your problem. If you need further help, you can ask on the forum. In that case copy the output and paste it in your post.</p>
 <p><b>Reminder</b></p>
 <p>When posting on the forum, it is helpful to paste your log in <code>[code][/code]</code> tags to enable people to handle it easier. Not only does it avoid linebreaks, it is also displayed in a monospace font which makes it easier to read if it spans multiple lines.</p>

 <h3 id="tr-grl-64bit"><a class="h3-link" href="#tr-grl-64bit">Why can't I use SFML as a 64-bit library on my 64-bit system?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>First of all, you have to ask yourself: Do I really need to use SFML as a 64-bit library? There are some benefits to building 64-bit applications, but it is recommended that beginners do not try this until they are confident with the compile and linking process</p>
 <p>Most of the confusion stems from the fact that with Windows, although modern versions make use of 64-bit processor instruction sets, they are able to run 32-bit applications as well. By default, most "standard" installations build 32-bit executables. The fact that you are running a 64-bit operating system doesn't mean that you automatically build 64-bit executables. When in doubt, download/build 32-bit executables.</p>
 <p>Let's start with the basics. The processors that you use everyday execute instructions which is what programs are essentially made of. The set of instructions that a processor understands and is able to execute properly is known as its _instruction set_. Because Intel released a family of very popular processors quite a while ago that supported at first 16-bit registers and eventually 32-bit registers whose model numbers ended with 86, the instruction set that they provided came to be known as the x86 instruction set. Nowadays, x86 is synonymous with 32-bit, and any time you see an architecture marked as x86 you should immediately tell that it is a 32-bit architecture. Because of how addresses have to be stored in registers, eventually 32-bit registers were no longer sufficient (could only address up to 4GiB of RAM) and processors had to start providing 64-bit registers. This marked the start of the x64 era. This time around, AMD was the first to come up with the instruction set for 64-bit architectures, and thus you will hear of the term AMD64 a lot. x64, x86-64 and AMD64 all tend to refer to 64-bit architectures and are often used interchangeably.</p>
 <p>When you compile your code, the compiler ends up translating your syntactically legal code into machine instructions to be executed on the _target CPU_. The compiler will always produce code that can run on a _specific architecture_. Because x64 architectures are fully backwards-compatible with x86 instructions (it is merely a superset), they can run executables compiled for x86 systems as well, however, the operating system kernel has to support this and allow it.</p>
 <p>Some systems such as Linux and OS X choose to trade executable portability for performance. You will not be able to transfer binary files between systems of different architectures, but for that they will be optimized more for their target architecture. Saying that you want to "compile for 64-bit" on these systems doesn't make much sense since you will have to do so automatically anyway. There are ways of forcing compilation for 32-bit systems in order to build _somewhat_ portable binaries, but that is beyond the scope of this FAQ. Just understand that on these systems, you will almost never have to worry about choosing an architecture type.</p>
 <p>Windows, as mentioned earlier, chose to go down a different route. They favored portability over potential performance gains. Because Microsoft couldn't easily stop supporting legacy applications (most of them being proprietary and barely maintained) on their newer operating systems, they had to make it possible to run 32-bit applications side by side with native 64-bit applications. This technology is called _Windows on Windows_ or _Windows 32-bit on Windows 64-bit_, WoW64 in short. Every 64-bit Windows installation has a second copy of the operating system files installed as well, the 32-bit version. When running programs, the executable loader checks for the executable's architecture and loads the corresponding dynamic libraries that it needs to function. Because this information is embedded into the executable itself, it is hard to tell what architecture an executable was built for without inspecting it closer. It is perfectly normal to build for 32-bit Windows systems even though you know that all your users will be on 64-bit systems, it will simply work.</p>
 <p>This is one of the main reasons why confusion arises when building software using libraries as well. Unless the target architecture is explicitly noted in the file name, you will not know whether the library file is compatible with the architecture type your compiler is targeting. SFML does not explicitly append an architecture type to its library files, so you will simply have to remember this after building SFML or downloading a pre-built library from somewhere.</p>
 <p>When building with Microsoft Visual Studio, the linker checks the machine types (architectures) of all modules that are to be linked with each other. If it finds a mismatch, it will abort with an error.</p>
 <p>The error commonly looks like this:</p>
 <pre><code>fatal error LNK1112: module machine type 'X86' conflicts with target machine type 'x64'</code></pre>
 <p>It is possible that X86 and x64 are exchanged.</p>
 <p>To resolve this error, simply make sure that no conflicts arise. If you are targeting x64 with your executable, make sure you are only using x64 libraries as well. The same applies for x86.</p>
 <p>If you are compiling using GCC or clang, it is less obvious when architecture conflicts arise. Instead of having explicit checks as with Visual Studio, the linkers in these toolchains merely ignore all symbols with mismatching architectures. It will look like the linker accepted the library files, but in fact it didn't process any of them at all, leading to a large number of undefined references during linking. This is especially annoying because these errors can stem from many other causes as well. It is recommended to not build for x64 on Windows if using any of these toolchains. If you really must build for x64 on Windows, use Visual Studio instead.</p>

 <h3 id="tr-grl-crash"><a class="h3-link" href="#tr-grl-crash">My computer crashes when I run my SFML program!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML was designed in a way that should not cause your computer to crash/freeze/hang/BSOD in any way. If it does exhibit such behavior specifically when running your SFML program, it might be only indirectly because of SFML.</p>
 <p>If you are using unstable drivers (still in beta or off a development branch in your package manager) chances are that they are the root cause of the problem. The reason why they cause more problems with SFML than with other programs/games is mainly because OpenGL related bugs in drivers are given low priority over DirectX related bugs simply because the latter affect more games. You'll just have to be patient and wait for the relevant bug to get fixed or revert to an older, more stable driver.</p>
 <p>If you are not using unstable drivers, crashing might still be caused by over-clocking (either self-performed or automatic) of your hardware. Try running everything at standard performance settings and see if that fixes the problem. If your hardware comes over-clocked by default, search around the internet for other people who might be experiencing the same problems. If this is the case you should contact your retailer/card manufacturer as this is a hardware related issue and you won't be able to do much on your own.</p>

 <h3 id="tr-grl-i-found-a-bug"><a class="h3-link" href="#tr-grl-i-found-a-bug">I found a bug!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Most of the time any unexpected behavior is a result of misunderstanding how to use SFML. Out of many bug reports only few of them turn out to be real bugs <strong>which are caused by SFML itself and nothing else</strong>.</p>
 <p>If you think you have found a bug and are still using SFML 1.6, note that support for 1.6 had ceased long ago. It is highly recommended to upgrade to 2.3. Any bug reports made for SFML 1.6 will be ignored unless they were carried over to 2.3 as well, however this is very unlikely. If you are using 2.3, try building the latest master revision available on GitHub. There are many things that might have already been fixed between the release which is available on the site and the latest development version.</p>
 <p>If the bug is still present in the latest SFML version, try to produce a <a href="#tr-grl-minimal">minimal compilable code example</a> that displays the bug and nothing else. That way the developers and others can focus on why it is occurring.</p>
 <p>If you can reproduce what you think is a bug, if you have another computer at your disposal, try to run it there as well. If the bug does not occur there, try to reconfigure the corresponding hardware/software settings on the first PC. A lot of strange behavior is a result of misconfigured/faulty software/drivers. <strong>WARNING: Trying to report a bug that is a result of the usage of beta drivers is not a good idea. The source of the problem does not lie within the responsibility of the SFML developers and as such they can't do much to fix it themselves.</strong></p>
 <p>When you are sure that the bug is a result of SFML internals and is platform independent, you can go ahead and post in the forum of the package in question, and don't forget to provide a precise description of your problem, the version of SFML you're using, your system configuration, and the compilable code, and if the situation requires, the logs of your compiler and/or linker. Also make sure that the bug hasn't already been reported (use the <a href="http://en.sfml-dev.org/forums/index.php?action=search">search function</a>), confirmed (look on the <a href="https://github.com/SFML/SFML/issues?page=1&amp;state=open">issue tracker</a>) or even resolved in the latest source (check also the <a href="https://github.com/SFML/SFML/issues?page=1&amp;state=closed">closed issues</a>).</p>

 <h3 id="tr-grl-minimal"><a class="h3-link" href="#tr-grl-minimal">What is a minimal code?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>A minimal code example is a snippet of source code that is compilable with very little effort.</p>
 <p>This implies that:</p>
 <ul>
  <li>it consists of a single file (no extra .h, .hpp or .cpp files)</li>
  <li>there are no special compiler/linker options that need to be set</li>
  <li>the provided code is specific to the matter at hand and does not do more than it needs to</li>
 </ul>
 <p>Such an example should never have to be longer than 40 lines of code (including the header include lines which of course have to be provided as well) unless it only happens in very specific cases.</p>
 <p>An example of minimal code:</p>
 <pre><code class="cpp">#include <SFML/Graphics.hpp>

int main() {
    sf::RenderWindow window( sf::VideoMode(640, 480, 32), "Bug" );

    // Some bug specific code here...

    while( window.isOpen() ) {
        sf::Event event;
        while( window.pollEvent( event ) ) {
            if( event.type == sf::Event::Closed ) {
                window.close();
            }
        }

        // ... and here.

        window.display();
    }

    return EXIT_SUCCESS;
}</code></pre>
 <p>See also <a href="http://en.sfml-dev.org/forums/index.php?topic=5559.msg36368#msg36368">the rules</a> for further details.</p>

 <h3 id="tr-grl-obtain-minimal"><a class="h3-link" href="#tr-grl-obtain-minimal">And how can I easily obtain this minimal code?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Easy :</p>
 <ul>
  <li>Create a separate sandbox project with a single file consisting of a <code>main()</code> function</li>
  <li>Copy and paste your code into the body of the <code>main()</code> in such a way that it can compile</li>
  <li>One by one delete all lines which are not relevant to the actual problem and try to compile after every deletion to see if the problem still persists</li>
 </ul>
 <p>Side note: This technique will often help you troubleshoot the problem on your own.</p>

 <h3 id="tr-cb"><a class="h3-link" href="#tr-cb">Code::Blocks</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

 <h3 id="tr-cb-linker"><a class="h3-link" href="#tr-cb-linker">I'm getting linker errors.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>With GCC based compilers such as MinGW you must link the libraries in a precise order: if libX depends on libY, libX MUST be linked before libY. For example, if you use the Graphics and Audio modules, the correct linking order would be the following: sfml-audio, sfml-graphics, sfml-window, sfml-system.</p>
 <p>If you use the dynamic versions of the SFML 1.6 libraries, you must also define the SFML_DYNAMIC symbol in the options for your project. If you use the static version of the SFML 2.3 libraries, you must also define the SFML_STATIC symbol in the options for your project. <strong>Defining SFML_DYNAMIC no longer has any effect since SFML 2.0.</strong> For more details, see the installation tutorial for Code::Blocks.</p>

 <h3 id="tr-vs"><a class="h3-link" href="#tr-vs">Visual Studio</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

 <h3 id="tr-vs-crash"><a class="h3-link" href="#tr-vs-crash">My project crashes randomly, but I don't get any compiler or linker errors.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Make sure that you're linking against the correct version of the libraries for your project. If you're compiling in Debug mode, you must link with the Debug versions of SFML, and vice-versa for Release mode. To recall, the naming conventions for SFML are:</p>
 <ul>
  <li>sfml-[module].lib for the Release DLL</li>
  <li>sfml-[module]-d.lib for the Debug DLL</li>
  <li>sfml-[module]-s.lib for the static Release DLL</li>
  <li>sfml-[module]-s-d.lib for the static Debug DLL.</li>
 </ul>
 <p>If you link with the DLL versions, you must copy the required DLLs beside your executable:</p>
 <ul>
  <li>sfml-[module].dll for the Release DLL</li>
  <li>sfml-[module]-d.dll for the Debug DLL</li>
 </ul>

 <h3 id="tr-vs-arch"><a class="h3-link" href="#tr-vs-arch">I keep getting <code>fatal error LNK1112: module machine type 'XYZ' conflicts with target machine type 'ZYX'</code>. Help!</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>See <a href="#tr-grl-64bit">Why can't I use SFML as a 64-bit library on my 64-bit system?</a>.</p>

 <h3 id="tr-win"><a class="h3-link" href="#tr-win">Windows</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

 <h3 id="tr-win-console"><a class="h3-link" href="#tr-win-console">Why does a console attach itself to my project?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>In Windows, if you compile your project, you will have a console that attaches itself behind your window. To avoid this, you must create the correct type of project or change its type after creation. Many IDEs have options allowing you to choose whether you want to create a console or a GUI application. It is however recommended to create an empty project and manually set its type afterwards. This ensures that nothing else is set automatically that might cause strange behavior later on.</p>
 <p>If you have already created the console project or created an empty one:</p>
 <ul>
  <li>In Code::Blocks, open the project options (Project Menu -&gt; Properties). In the Build targets tab, select the build target you wish to change on the left (most of the time only Debug and Release exist) and change its type option in the drop-down list on the right side from "Console application" to "GUI application".</li>
  <li>In Visual Studio, go to the project options (Project Menu -&gt; Properties). In the tree on the left, expand the "Configuration properties" tree and expand the "Linker" sub-tree. Select "System" from the sub-tree, and in the SubSystem field on the right side change "Console (/SUBSYSTEM:CONSOLE)" to "Windows (/SUBSYSTEM:WINDOWS)" by clicking on the field and using the drop-down list.</li>
 </ul>
 <p>To maintain a portable entry point (<code>int main()</code> function), you can link your program against the small sfml-main.lib library in the case of Visual Studio or libsfml-main.a in the case of Code::Blocks/MinGW.</p>
 <p>Alternatively to hide the console, you can also define your own Windows entry point for graphical applications.</p>
 <pre><code>int WINAPI WinMain(HINSTANCE hThisInstance, HINSTANCE hPrevInstance, LPSTR lpszArgument, int nCmdShow)</code></pre>
 <p>Replace your <code>int main()</code> or <code>int main(int argc, char** argv)</code> with this function and it will be called by the operating system when your program is executed just like the classical <code>int main()</code> function.</p>

 <h3 id="tr-lnx"><a class="h3-link" href="#tr-lnx">Linux</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

 <h3 id="tr-lnx-compile"><a class="h3-link" href="#tr-lnx-compile">(Debian) I can't compile the source code.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Before anything else, make sure that you've followed the <a href="tutorials/">official tutorial</a> and then check if the following packages have been installed:</p>
 <ul>
  <li>libx11-dev</li>
  <li>libxcb1-dev</li>
  <li>libx11-xcb-dev</li>
  <li>libxcb-randr0-dev</li>
  <li>libxcb-image0-dev</li>
  <li>libgl1-mesa-dev</li>
  <li>libudev-dev</li>
  <li>libfreetype6-dev</li>
  <li>libjpeg-dev</li>
  <li>libopenal-dev</li>
  <li>libflac-dev</li>
  <li>libvorbis-dev</li>
 </ul>
 <p>Though the library names might vary, especially regarding the version number.</p>

 <h3 id="tr-lnx-titlebar"><a class="h3-link" href="#tr-lnx-titlebar">There is no titlebar visible and/or artifacts from windows are visible.</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>If you're running compiz, then turn it off, because compiz interfere with other OpenGL applications.</p>
 <p>You can use this simple script to toggle compiz on and off, if you're using metacity as your window manager:</p>
 <pre><code class="bash">    #!/bin/bash
    pid=`ps --no-heading -C compiz.real | cut -d "?" -f1`;
    if [ -n "$pid" ]; then
      metacity --replace &
    else
      compiz --replace &
    fi</code></pre>

 <h2 id="licensing"><a class="h2-link" href="#licensing">Licensing</a><a class="back-to-top" href="#top" title="Top of the page"></a></h2>

 <h3 id="lic-license"><a class="h3-link" href="#lic-license">What license does SFML have?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>SFML is under the <a href="http://www.opensource.org/licenses/zlib-license.php">zlib/png license</a>. You can use SFML for both open-source and proprietary projects, including paid or commercial ones. If you use SFML in your projects, a credit or mention is appreciated, but is not required.</p>

 <h3 id="lic-commercial"><a class="h3-link" href="#lic-commercial">Can I use SFML in commercial applications?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Yes, you may use SFML in commercial applications. You don't even have to mention that you used SFML in your application, but the zlib license states that if you do mention it, you are not allowed to state that you yourself are the author of SFML. You are also not allowed to modify SFML and represent it as being the original.</p>

 <h3 id="lic-static"><a class="h3-link" href="#lic-static">Can I link SFML statically?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>Yes, you can link SFML statically. This can be done in any operating system, although in Linux and Mac OS X it is recommended to only link dynamically unless you have special requirements.</p>
 <p>When linking statically, do not forget to specify the <code>SFML_STATIC</code> define on your command line.</p>

 <h3 id="lic-examples"><a class="h3-link" href="#lic-examples">Can I use the code from the example directory?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>The code from the example directory is not marked as being provided under a separate license. As such it is also governed by the zlib/png license and you are free to do anything you want with the code as long as it complies to the license.</p>

 <h3 id="lic-pay"><a class="h3-link" href="#lic-pay">Do I have to pay any license fees or royalties?</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
 <p>The zlib/png license is a permissive free software license which means it has no provisions to monetize the software it covers. As such SFML can be used for free with no requirement to pay any fees or royalties to its author.</p>

<?php
    require("footer.php");
?>
