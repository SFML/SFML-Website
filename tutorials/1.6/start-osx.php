<?php

    $title = "SFML and Xcode (Mac OS X)";
    $page = "start-osx.php";

    require("header.php");
?>

<h1>SFML and Xcode (Mac OS X)</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you'ure using SFML with Xcode IDE and gcc (the default compiler).
    It will show you how to install SFML, setup your IDE, and compile a simple SFML program.<br/>
    It also explains how to compile SFML libraries, for advanced users.
</p>
<p>
    Note that the 32-bit version of SFML is compatible with any Mac Intel or PPC using at least Mac OS X 10.4. The 64-bit
    version works requires at least Mac OS X 10.5.
</p>

<?php h2('Installing SFML') ?>
<p>
    First, you have to download the SFML development files. You can get the minimal package (libraries + headers), but
    it is advised to get the full SDK, which contains on top of that the samples and the documentation. If you use Mac OS X 10.6
    or greater, use the 64-bit version; otherwise use the 32-bit version.<br/>
    All these packages can be found on the
    <a class="internal" href="../../download.php" title="Go to the download page">download page</a>.
</p>
<p>
    Once you've downloaded and installed the files on your hard drive, copy the contents of the
    SFML-x.y/lib directory (or lib64 if you use the 64-bit version) into the /Library/Frameworks directory. Then go to the
    SFML-x.y/extlibs/bin directory. For the 32-bit version, copy the OpenAL.framework and libsndfile.framework directories
    to /Library/Frameworks. For the 64-bit version, only copy the contents of the x86_64 directory. The minimal installation is finished.
</p>
<p>
    However, in order to make using SFML easier, we also provide project templates for Xcode. To use them, copy
    the "SFML Window-based Application" and "SFML Graphics-based Application" directories from
    SFML-x.y/build/xcode/templates to "/Developer/Library/Xcode/Project Templates/Application", as well as
    the "SFML Tool" directory to "/Developer/Library/Xcode/Project Templates/Command Line Utility".
</p>

<?php h2('Create your first SFML program') ?>
<p>
    Start Xcode, and choose "File" > "New Project..." in the main menu.
</p>
<p>
    Select the "Application" part on the left side. Here is what you should see:
</p>
<img class="screenshot" src="./images/start-osx-new-project.png" width="746" height="522" alt="Screenshot of the new project dialog box" title="Screenshot of the new project dialog box" />
<p>
    Choose one of the SFML projects, and click on "Choose...". You'll be prompted to enter a name for your project,
    which will also be the name of your program.
</p>
<p>
    To test the program, click on the "Build and Go" button of the toolbar in the project's window. Voilà,
    your application has been created!
</p>
<p>
    Some explanations regarding the project:
</p>
<ul>
    <li>The "Sources" reference folder contains the source files of your program. You can add yours at this
    location.</li>
    <li>The "Frameworks" reference folder contains all the framewors used by your project. Here you can see
    that the sfml-system, sfml-window and sfml-graphics packages have been added. The "SFML.framework" package
    is there so that you can easily access the SFML header files. It's not used by the program, unlike the
    sfml-system, sfml-window and sfml-graphics frameworks. It's here that you'll add the frameworks of
    other SFML packages you'll need later. To do so, just drag and drop the package you need (sfml-xxx.framework)
    from the Finder to this reference folder.
</ul>
<p>
    If you want to create an executable rather than an application, the "SFML Tool" template is available in the
    "Command Line Utility" part of the new project dialog box. This template contains no code except the main function,
    and is linked to sfml-system.
</p>

<?php h2('Distribute your application') ?>
<p>
    In order to make your programs available to other users, you have to make sure that the operating system will find
    the libraries and / or frameworks they depend on. You have two solutions to achieve this : either by installing the libraries
    / frameworks to the system's default directories, or by integrating them directly into your application.
</p>
<h3>Installing the libraries / frameworks to the system's default directories</h3>
<p>
    This solution has the benefit of avoiding multiple copies of the SFML libraries. Indeed, once you've installed them,
    they can be used by multiple applications. Moreover, if you update these libraries, all the applications using them
    will benefit from the update. On the other hand, this solution separates the libraries from the application, which means
    an extra step to install your application and make it work. Plus, the system's default directories are accessible for write
    only by administrator accounts.<br />
    <strong>Implementation</strong>: install the frameworks used by your application in the /Library/Frameworks directory, and the libraries
    used by your application into /usr/local/lib if necessary. This operation has to be executed by every user of your program.
</p>
<h3>Integrating the libraries / frameworks into your application</h3>
<p>
    This solution makes the installation process more straight-forward (copying the application is enough) and doesn't require
    to use an administrator account. However, each application using SFML will have its own copy of the libraries, and to update
    them you'll have to update the copy of all these applications. So this is not the best solution for developers.<br />
    <strong>Implementation</strong>: with Xcode, use the
    <em><a class="external" href="http://developer.apple.com/DOCUMENTATION/DeveloperTools/Conceptual/XcodeBuildSystem/200-Build_Phases/bs_build_phases.html#//apple_ref/doc/uid/TP40002690-CJAHHAJI" title="Documentation for the Copy Files Build Phase">Copy Files Build Phase</a></em>
    by selecting "Frameworks" as "Target" if you're using frameworks, or "Executables" if you're using libraries. Then drop
    the files you need into the copy files build phase. You can now launch the creation of your application.

</p>
<p>
    It's up to you to decide which solution is the best for you.
</p>
<p>
    Note : none of the SFML modules requires a library which is not already installed by default on Mac OS X,
    except the Audio module which requires the OpenAL and libsndfile libraries. So you'll have to provide them
    together with your applications (see the extlibs/bin directory of the downloaded disk image). If you use the 64-bit version
    of SFML, you don't have to provide the OpenAL framework. Note that you can find the
    OpenAL framework in the system's folders, however the version delivered with Mac OS X 10.4 is not working well,
    that's why we provide a recompiled version with SFML.
</p>

<?php h2('Compiling SFML (for advanced users)') ?>
<p>
    To compile the SFML frameworks and samples, you first have to download the full SDK
    (see the <a class="internal" href="../../download.php" title="Go to the download page">download page</a>).
</p>
<p>
    Go to the SFML-x.y/build/xcode directory and open the SFML.xcodeproj project (compatible with Xcode 2.4 and +).
    According to what you need, choose the target (Debug or Release), and launch the compile process. It can last
    a few minutes, depending on the power of your PC. You will then find the built frameworks in the
    SFML-x.y/lib directory (or SFML-x.y/lib64 if you chose to compile SFML for 64-bit processors with the
    "SFML with Intel 64-bit.xcodeproj" project).
</p>
<p>
    Similarly, if you want to create the raw dynamic libraries, you can use the SFML-bare.xcodeproj project.
    The compile process produces dynamic libraries (files with the "dylib" extension) in the same
    SFML-x.y/lib folder.
</p>
<p>
    To compile the samples, open the SFML-x.y/samples/build/xcode/samples.xcodeproj project and launch the comiple
    process. The built programs are located in the SFML-x.y/samples/bin directory. To launch these samples,
    the frameworks must have been installed as described in this tutorial.
</p>

<?php

    require("footer.php");

?>
