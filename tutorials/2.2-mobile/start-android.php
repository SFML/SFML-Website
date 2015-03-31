<?php

    $title = "SFML and Android";
    $page = "start-android.php";

    require("header.php");

?>

<h1>SFML and Android</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial is the first one you should read if you're using SFML for Android. 
    It will explain how to install SFML, and compile projects that use it. Because 
    having an Android development environment installed is mandatory, it teaches you 
    how to set it up and create a project along.
</p>

<?php h2('Setting up your development environment') ?>

<p>
    Before you can start installing SFML, you need to have the Android development 
    environment properly set up. It consists of having the SDK and, as we're going 
    for native development, the NDK installed as well.
</p>

<ul>
    <li><strong>SDK:</strong><br />
        Explain briefly what the SDK contains and why we need it.
    </li>
    <li><strong>NDK:</strong><br />
        Explain briefly what the SDK contains and why we need it.
    </li>
</ul>

<p class="important">
    It's convenient to have an environment variable ANDROID_NDK pointing to the 
    NDK directory. Later in this tutorial, I will use it to reffer to its location.
    By the way, creating ANDROID_SDK might be useful too.
</p>

<p>
    Depending on your level, you could go for using IDEs or command-line. 
    The choice of IDEs: Eclipse, Android Studio and Visual Studio.
</p>

<p class="info">
    On Linux, to use the Android SDK/NDK or IDEs, you may need to install additional packages:
</p>

<pre><code class="no-highlight">apt-get install lib32z1 lib32ncurses5 lib32bz2-1.0 lib32stdc++6.</code></pre>
<pre><code class="no-highlight">yum install glibc.i686 glibc-devel.i686 libstdc++.i686 zlib-devel.i686 ncurses-devel.i686 libX11-devel.i686<br /> libXrender.i686 libXrandr.i686</code></pre>

<p>
    Because the instructions slighly differ according to the chosen IDE and your 
    host system, this tutorial covers none of them. It's your task to familiar 
    yourself with the tools you chose. (Hopefully, the compilation step which is hidden by those 
    IDEs is the same).
</p>

<p class="info">
    It's up to you to place these directories wherever you want but I strongly advise 
    you to be organised. That I'm working on Linux or Windows, my personal favourite 
    layout is the following: inn my workspace directory (/home/username/Workspace), 
    I create a folder "android", where I have my Android IDEs, the SDK and NDK directory 
    and a dedicated sub workspace folder. Of course, adjust the naming according to 
    your conventions :)
    
    <img class="screenshot" src="./images/start-android-workspace.png" alt="Screenshot of the dialog box for defining the SFML_STATIC macro" title="Screenshot of the dialog box for defining the SFML_STATIC macro" />
</p>

<?php h2('Installing SFML') ?>


<p>
    Now that you have the environment set up, download the SFML binaries for Android 
    and simply copy the sfml/ directory in $ANDROID_NDK/sources.
</p>

<p class="important">
    Since the Android port is still in active development, you might want to recompile 
    the latest source to get the latest bug fixes and features. You'll find all 
    necessary explainations to recompile SFML in the CMake tutorial.
</p>

<?php h2('Create an Android project') ?>

<p>
    The IDEs provides a visual interface to create regular Android project, do so
    unless you're using the command line: "android create project".
</p>

<p>
    Now you need to add support for native development. Without going into the details,
    here are the following step to perform it whatever your IDE.
</p>

<p class="important">
    To try out SFML on Android using the official example, you can copy/paste the 
    example to your workspace and create a new project from an existing project. 
    It allows you to skip this step temporarily.
</p>

<?php h2('Compile your application') ?>
<p>
    The IDEs are primarly designed for development in Java and allows you to easily
    install and run the code on either an emulator or on your own devices. However,
    native code still needs to be compiled into a shared library before the installation 
    can takes place. If you don't compile the code everytime you make a change to a 
    C++ files, the previous binairies will keep being installed and no changes will 
    appear in your application. 
</p>

</p>
    Unfortunatly, they don't handle that and you'll need to open a command-line console to perform the compilation.
    
    Compile using $ANDROID/ndk-build.
</p>

<p>
    Congratulations, you're done with the boring steps and ready to develop your 
    Android app using SFML. Before jumping into the development, please 
    read carefuly mobile-android.php.
</p>

<?php

    require("footer.php");

?>
