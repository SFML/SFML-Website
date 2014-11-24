<?php

    $title = "SFML and Xcode (Mac OS X)";
    $page = "start-osx.php";

    require("header.php");

?>

<h1>SFML and Xcode (Mac OS X)</h1>

<?php h2('Introduction') ?>
<p>
    This is the first tutorial you should read if you're using SFML with Xcode -- and more generally if you are developing applications for Mac OS X. It will show you how
    to install SFML, setup your IDE and compile a basic SFML program. But also, and more importantly, how to make your applications ready "out of the box" for the end users.
</p>
<p>
    Several links are given in this document. There are mostly here for the curious ones among the readers; you don't need to read them all to follow this tutorial.
</p>

<h3>System requirement</h3>
<p>
    All you need to create an SFML-based application is:
</p>
<ul>
    <li>an Intel Mac with Lion or later (10.7+)</li>
    <li>with <a href="http://developer.apple.com/xcode/" title="Download Xcode">Xcode</a> (preferably the forth, fifth or sixth version of the IDE which is available on the <em>App Store</em>) and clang.</li>
</ul>
<p class="important">
    With recent versions of Xcode you also need to install the <tt>Command Line Tools</tt> from <tt>Xcode &gt; Preferences &gt; Downloads &gt; Components</tt>.
</p>

<h3>Binaries: dylib vs framework</h3>
<p>
    SFML is available in two formats on Mac OS X. You have the <em>dylib</em> libraries on the one hand or the <em>framework</em> bundles on the other.
    Both of them are provided as <a href="http://en.wikipedia.org/wiki/Universal_binary" title="Go to Wikipedia's article about universal binary">universal binaries</a>
    so they can be used on 32 bits or 64 bits Intel systems without any special consideration.
</p>
<p>
    Dylib stands for dynamic library; this format is like <em>.so</em> libraries on Linux. You can find more details in
    <a href="https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/" title="Go to Apple's documentation about dylib">this document</a>.
    Frameworks are fundamentally the same as dylibs, except that they can encapsulate external resources. Here is
    <a href="https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html" title="Go to Apple's documentation about framework">the in-depth documentation</a>.
</p>
<p>
    There is only one slight difference between these two kinds of libraries that you should be aware of while developing SFML applications:
    if you build SFML yourself, you can get dylib in both <em>release</em> and <em>debug</em> formats. However, frameworks are only available in <em>release</em> format.
    In any case this won't be an issue when you release your application because you would rather use the <em>release</em> version of SFML. That's why the binaries for
    OS X available on the <a href="../../download.php" title="Go to the download page">download page</a> are only in <em>release</em> format.
</p>

<h3>Xcode templates</h3>
<p>
    SFML is provided with two templates for Xcode 4/5/6 which allow you to create very quickly and easily new application projects. These templates can create custom projects:
    you can select which modules your application requires, whether you want to use SFML as dylib or as frameworks, and you can choose between
    creating an application bundle containing all its resources (making the installation process of your applications as easy as a simple drag-and-drop) or a classic binary.
    See below for more details.
</p>
<p class="important">
    Be aware that these templates are not compatible with Xcode 3. If you are still using this version of the IDE and you are not considering updating your tool, then you
    can still, of course, create SFML-based applications. However, we will not discuss here how you can do that. Please refer to Apple's documentation about Xcode 3 and
    how to add a library to your project.
</p>

<h3>C++11, libc++ and libstdc++</h3>
<p>
    Apple ships a custom version of <tt>clang</tt> and <tt>libc++</tt> with Xcode that support (part of) the C++11 standard (i.e. new features are not yet all implemented).
    If you plan to use C++11's new functionalities, you need to configure your project to use <tt>clang</tt> and <tt>libc++</tt>.
</p>
<p>
    However, if your project depends (indirectly or not) on libstdc++ you need to <a href="compile-with-cmake.php" title="Compiling SFML with CMake">build SFML yourself</a>
    and configure your project accordingly.
</p>

<?php h2('Installing SFML') ?>
<p>
    First of all you need to download the SFML SDK which is available on the <a href="../../download.php" title="Go to the download page">download page</a>.
    Then, in order to start developing SFML applications, you have to install the following items:
</p>
<ul>
    <li>
        Header files and libraries<br />
        SFML is available either as dylibs or as frameworks. Only one type of binary is required but both can be installed on one system. We recommend using the frameworks.
        <ul>
            <li>dylib<br />
            Copy the content of <tt>lib</tt> to <tt>/usr/local/lib</tt> and copy the content of <tt>include</tt> to <tt>/usr/local/include</tt>.
            </li>
            <li>frameworks<br />
            Copy the content of <tt>Frameworks</tt> to <tt>/Library/Frameworks</tt>.
            </li>
        </ul>
    </li>
    <li>
        SFML dependencies<br />
        SFML needs only two external libraries on Mac OS X. Copy <tt>sndfile.framework</tt> and <tt>freetype.framework</tt> from <tt>extlibs</tt> to <tt>/Library/Frameworks</tt>.
    </li>
    <li>
        Xcode templates<br />
        This feature is optional but we strongly recommend you to install it. Copy the <tt>SFML</tt> directory from <tt>templates</tt> to <tt>/Library/Developer/Xcode/Templates</tt>
        (if needed, create the folder arborescence).
    </li>
</ul>

<?php h2('Create your first SFML program') ?>
<p>
    We provide two templates for Xcode. <tt>SFML CLT</tt> generates a project for a classic terminal program whereas <tt>SFML App</tt> creates a project for an application
    bundle. We will use the latter here but they both work relatively similarly.
</p>
<p>
    First select <tt>File &gt; New Project...</tt> then choose <tt>SFML</tt> in the left column and double-click on <tt>SFML App</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project.png" alt="Xcode template selection" title="Xcode template selection" />
<p>
    Now you can fill in the required fields like in this screenshot; then press <tt>next</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project-settings.png" alt="Xcode template form" title="Xcode template form" />
<p>
    Your new project is now set to create an
    <a href="https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html" title="Go to Apple's documentation
    about application bundle">application bundle ".app"</a>.
</p>
<p class="important">
    A few words about the templates settings. If you choose an incompatible option for <tt>C++ Compiler and Standard Library</tt> you will end up with linker errors.
    Make sure you follow this guideline:
</p>
<ul>
    <li>If you downloaded the "Clang" version from the download page, you should select <tt>C++11 with Clang and libc++</tt>.</li>
    <li>If you compiled SFML yourself, you should be able to figure out which option you should use. ;-)</li>
</ul>
<p>
    Now that your project is ready, let's see what is inside:
</p>
<img class="screenshot" src="images/start-osx-window.png" alt="Content of the new project" title="Content of the new project" />
<p>
    As you can see, there are already a few files in the project. There are three important kinds:
</p>
<ol>
    <li>
        Header &amp; source files: the project comes with a basic example in <tt>main.cpp</tt> and a helper function: <code>std::string resourcePath(void);</code> in
        <tt>ResourcePath.hpp</tt> and <tt>ResourcePath.mm</tt>. The usefulness of this function, as illustrated in the provided example, is to get in a convenient way access to
        the <tt>Resources</tt> folder of your application bundle.<br />
        Please note that this function works only on Mac OS X. If you are planning to make your application work on another OS, you should make another implementation of this
        function for this OS.
    </li>
    <li>
        Resource files: the resources of the basic example are put in this folder and are automatically copied to your application bundle when you compile it.<br />
        To add new resources to your project, simply drag'n'drop them to this folder and make sure that they are member of your application target; i.e. the box under
        <tt>Target Membership</tt> in the utility area (<kbd>cmd+alt+1</kbd>) should be checked.
    </li>
    <li>
        Product: here is your application. Simply press the <tt>Run</tt> button to test it.
    </li>
</ol>
<p>
    The other files of the project are not very relevant for us here. Please note that the SFML dependencies of your project are added to your application bundle,
    in a similar way than the resources are copied, so that it will run out of the box on another Mac without any prior installation of SFML or its dependencies.
</p>

<?php

    require("footer.php");

?>
