<?php

    $title = "SFML and Xcode (macOS)";
    $page = "start-osx.php";

    require("header.php");

?>

<h1>SFML and Xcode (macOS)</h1>

<?php h2('Introduction') ?>
<p>
    This is the first tutorial you should read if you're using SFML with Xcode -- and more generally if you are developing applications for macOS. It will show you how
    to install SFML, set up your IDE and compile a basic SFML program. More importantly, it will also show you how to make your applications ready "out of the box" for the end users.
</p>
<p>
    You will see several external links in this document. They are meant for further reading on specific topics for those who are curious; reading them isn't necessary to follow this tutorial.
</p>

<h3>System requirements</h3>
<p>
    All you need to create an SFML application is:
</p>
<ul>
    <li>A 64-bit Intel Mac with Lion or later (10.7+)</li>
    <li><a href="http://developer.apple.com/xcode/" title="Download Xcode">Xcode</a> (versions 4 or above of the IDE, which is available on the <em>App Store</em>, are supported).</li>
    <li>Clang and libc++ (which are shipped by default with Xcode).</li>
</ul>
<p class="important">
    With recent versions of Xcode you also need to install the <tt>Command Line Tools</tt> from <tt>Xcode &gt; Preferences &gt; Downloads &gt; Components</tt>. If you can't find the CLT there use <code>xcode-select --install</code> in a Terminal and follow on-screen instructions.
</p>

<h3>Binaries: dylib vs framework</h3>
<p>
    SFML is available in two formats on macOS. You have the <em>dylib</em> libraries on the one hand and the <em>framework</em> bundles on the other.
</p>
<ul>
    <li>
      Dylib stands for dynamic library; this format is like <em>.so</em> libraries on Linux. You can find more details in
      <a href="https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/" title="Go to Apple's documentation about dylib">this document</a>.
    </li>
    <li>
      Frameworks are fundamentally the same as dylibs, except that they can encapsulate external resources. Here is
      <a href="https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html" title="Go to Apple's documentation about framework">the in-depth documentation</a>.
    </li>
</ul>
<p>
    There is only one slight difference between these two kinds of libraries that you should be aware of while developing SFML applications:
    if you build SFML yourself, you can get dylib in both <em>release</em> and <em>debug</em> configurations. However, frameworks are only available in the <em>release</em> configuration.
    In either case, it shouldn't be an issue since you should be using the <em>release</em> version of SFML when you release your application anyway. That's why the OS X binaries
    on the <a href="../../download.php" title="Go to the download page">download page</a> are only available in the <em>release</em> configuration.
</p>

<h3>Xcode templates</h3>
<p>
    SFML is provided with two templates for Xcode 4+ which allow you to create new application projects very quickly and easily:
    you can select which modules your application requires, whether you want to use SFML as dylib or as frameworks and whether to
    create an application bundle containing all its resources (making the installation process of your applications as easy as a simple drag-and-drop) or a classic binary.
    See below for more details.
</p>
<p class="important">
    Be aware that these templates are not compatible with Xcode 3. If you are still using this version of the IDE and you don't consider updating it, you
    can still create SFML applications. A guide on doing that is beyond the scope of this tutorial. Please refer to Apple's documentation about Xcode 3 and
    how to add a library to your project.
</p>


<?php h2('Installing SFML') ?>
<p>
    First of all you need to download the SFML SDK which is available on the <a href="../../download.php" title="Go to the download page">download page</a>.
    Then, in order to start developing SFML applications, you have to install the following items:
</p>
<ul>
    <li>
        <strong>Header files and libraries</strong><br />
        SFML is available either as dylibs or as frameworks.
        Only one type of binary is required although both can be installed simultaneously on the same system.
        We recommend using the frameworks.
        <ul>
            <li><em>frameworks</em><br />
            Copy the content of <tt>Frameworks</tt> to <tt>/Library/Frameworks</tt>.
            </li>
            <li><em>dylib</em><br />
            Copy the content of <tt>lib</tt> to <tt>/usr/local/lib</tt> and copy the content of <tt>include</tt> to <tt>/usr/local/include</tt>.
            </li>
        </ul>
    </li>
    <li>
        <strong>SFML dependencies</strong><br />
        SFML depends on a few external libraries on macOS. Copy the content of <tt>extlibs</tt> to <tt>/Library/Frameworks</tt>.
    </li>
    <li>
        <strong>Xcode templates</strong><br />
        This feature is optional but we strongly recommend that you install it.
        Copy the <tt>SFML</tt> directory from <tt>templates</tt> to <tt>~/Library/Developer/Xcode/Templates</tt> (create the folders if they don't exist yet).
    </li>
</ul>

<?php h2('Create your first SFML program') ?>
<p>
    We provide two templates for Xcode. <tt>SFML CLT</tt> generates a project for a classic terminal program whereas <tt>SFML App</tt> creates a project for an application
    bundle. We will use the latter here but they both work similarly.
</p>
<p>
    First select <tt>File &gt; New Project...</tt> then choose <tt>SFML</tt> in the left column and double-click on <tt>SFML App</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project.png" alt="Xcode template selection" title="Xcode template selection" />
<p>
    Now you can fill in the required fields as shown in the following screenshot. When you are done click <tt>next</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project-settings.png" alt="Xcode template form" title="Xcode template form" />
<p>
    Your new project is now set to create an
    <a href="https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html" title="Go to Apple's documentation
    about application bundle">application bundle ".app"</a>.
</p>
<p>
    Now that your project is ready, let's see what is inside:
</p>
<img class="screenshot" src="images/start-osx-window.png" alt="Content of the new project" title="Content of the new project" />
<p>
    As you can see, there are already a few files in the project. There are three important kinds:
</p>
<ol>
    <li>
        <strong>Header &amp; source files:</strong> the project comes with a basic example in <tt>main.cpp</tt> and the helper function <code>std::string resourcePath(void);</code> in
        <tt>ResourcePath.hpp</tt> and <tt>ResourcePath.mm</tt>. The purpose of this function, as illustrated in the provided example, is to provide a convenient way to access
        the <tt>Resources</tt> folder of your application bundle.<br />
        Please note that this function only works on macOS. If you are planning to make your application work on other operating systems, you should implement your own version of this
        function on the operating systems in question.
    </li>
    <li>
        <strong>Resource files:</strong> the resources of the basic example are put in this folder and are automatically copied to your application bundle when you compile it.<br />
        To add new resources to your project, simply drag and drop them into this folder and make sure that they are a member of your application target; i.e. the box under
        <tt>Target Membership</tt> in the utility area (<kbd>cmd+alt+1</kbd>) should be checked.
    </li>
    <li>
        <strong>Products:</strong> your application. Simply press the <tt>Run</tt> button to test it.
    </li>
</ol>
<p>
    The other files in the project are not very relevant for us here. Note that the SFML dependencies of your project are added to your application bundle
    in a similar in which the resources are added. This is done so that your application will run out of the box on another Mac without any prior installation of SFML or its dependencies.
</p>

<?php

    require("footer.php");

?>
