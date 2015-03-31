<?php

    $title = "SFML on Android";
    $page = "mobile-android.php";

    require("header.php");

?>

<h1>SFML on Android</h1>

<?php h2('Introduction') ?>
<p>
    This tutorial attempts to teach you the basics about native Android apps  
    and get you started with the development using SFML.
</p>

<p class="info">
    
    All Android apps runs in a sand-boxed Java environment and are written in Java. 
    Thus, <em>native</em> Android development means Android development in C or C++.
    The only way to go native is throught a bridge which makes the developemnt 
    process less straigth-forward. So don't panic if you struggle the first time.
</p>

<p>
    It won't go too far into detail. You'll sill have to attain at least some 
    knowledge on your own to have a solid understanding of how it work behind 
    the scene.
</p>

<p>
    There's at least two documents you should read and be familiar with the content.
</p>

<ul>
    <li>http://developer.android.com/guide/components/activities.html</li>
    <li>http://developer.android.com/guide/topics/resources/runtime-changes.html</li>
    <li>http://developer.android.com/guide/topics/manifest/manifest-intro.html</li>
</ul>

<p>
    The knowledges gained in these two articles are taken as starting point to 
    explain how SFML nests into the Android development process.
</p>

<?php h2('Supported versions') ?>
<p>
    SFML works on Android OS 2.1 +, (verify).
</p>

<?php h2('Android application structure') ?>

<p>
    We know an Android application is made of a set of components - which all serve 
    given purpose - and they can be one of those:
    <ul>
        <li>Activity</li>
        <li>Services</li>
        <li>Content Providers</li>
        <li>Broadcast Receivers</li>
    </ul>
</p>

<p>
    There can be a single component or many to shape one application and they're
    all declared in the AndroidManfifest.xml file. Only the Activity component 
    plays a graphical roles, the other being rather code that runs in the 
    background or meant to bridge your application with others. Here's how 
    a regular manifest file from a complex application would look like.
</p>

<pre><code>&lt;application&gt;
    &lt;activity&gt; ... &lt;/activity&gt;
    &lt;service&gt;  ... &lt;/service&gt;
    &lt;receiver&gt; ... &lt;/receiver&gt;
    &lt;provider&gt; ... &lt;/provider&gt;
&lt;/application&gt;
</code></pre>

<p>
    Typically, an Android app jumps from activities to activities. To be sure, you 
    follow me, here's a concret example:
    <img class="screenshot" src="./images/android-activities.png" /><br />
    Once you click on "Select color", it jumps to a second activity where you 
    are allowed to chose the color, then it goes back to the original activity.
</p>

<p>
    When using SFML, we expect a <em>single</em> and master activity; any SFML 
    application is built around the built-in custom activity: NativeActivity.
</p>

<p>
    All these components are java programs that all runs under a common Java 
    virtual machine (Dalvik VM) and the only way to go native is to make a bridge 
    that explicitly executes C++ code which was compiled into a shared library.
</p>

<p>
    Hopefully, you don't have to care about this bridge since we rely entirely 
    on the built-in NativeActivity.
</p>

<?php h2('The built-in NativeActivity') ?>

<p>
    To declare an activity that uses this built-in NativeActivity, write this:
</p>

<pre><code>&lt;activity android:name="android.app.NativeActivity" ... &gt;
    &lt;meta-data android:name="android.app.lib_name" android:value="sfml-activity" /&gt;
    
    ...
&lt;/activity&gt;
</code></pre>

<p>
    The <em>android:name</em> attribute points to the user-defined Java Activity class that 
    the activity must run. By setting <em>android.app.NativeActivity</em> as value, 
    you reffer to a built-in java class - available on all Android OSes - and its 
    behavior is to load a shared library and forward Java calls to it.
</p>

<p>
    SFML comes with this shared library <em>libsfml-activity.so</em> which acts as
    a bootstrap and emulates the environment any SFML application expect to run in.
    The nested balise <em>meta-data</em> tells the NativeActivity the name of the 
    shared library it has to load. As long as you use SFML, the value will always 
    be "sfml-activity" in our case.
</p>

<?php h2('How does the bridge work?') ?>


<p>
    Well, Android applications - or activities - don't follow the traditional 
    programming paradigms in which apps are launched with a main() method. These 
    activities can be paused, resumed, stopped, restarted unlike desktop applications 
    which are strictly linear. To run your cross-platform application that uses SFML, 
    we need to emulate the exact same condition. Our boostrap "sfml-activity" 
    therefore call the main() function in a external thread just after settings 
    up the environment.
</p>

<p>
    Setting up the environment consists of mapping these lifecycle events to SFML 
    events, redirecting SFML error messages to the logcat and loading the depedency 
    libraries in the right order.
</p>

<p>
    Hopefully, the only thing you need to care about is reacting to those lifecycle
    events. This is covered in details later in this tutorial.
</p>

<?php h2('Important considerations') ?>
<p>
    That's why you have additional responsabilities when it comes to writing 
    application on Android. Not finished yet...
</p>

<?php h2('Event handling') ?>
<p>
    Explain lifecycle events, how to react and show the mapping.
</p>

<?php h2('Handling runtime changes') ?>
<p>
    Runtime changes occur when the environment in which the application runs 
    changes such as:
    <ul>
        <li>the screen orientation changed</li>
        <li>a dock keyboard was added or removed</li>
        <li>the language of the system changed</li>
        <li>... many others but they aren't relevant</li>
    </ul>
</p>

<p>
    By default, runtime changes cause the current activity to restart. Regular 
    Android application - written in Java - likely use the Android API that 
    enable automatic support for rebuilding themselves. With no extra work from 
    the developer, these applications have no problem with being restarted.
</p>

<p>
    However, native applications don't have that and we prefer to handle the 
    configuration change ourself and prevent the application from restarting. 
</p>
<p>
    In reality, we only care about one runtime change: orientation changes. 
    This event is mapped to sf::Event::Resized and is triggered everytime the 
    system goes from landcape to portrait mode, and vis-versa. Of course, you 
    can prevent orientation changes in the manifest file, or you can 
    programatically change the orientation with sf::Window::setSize().
</p>

<p>
    To prevent your app from restarting, add <em>android:configChange</em> 
    attribute, with the configuration changes you'd like to handle manually as 
    value.
</p>

<pre><code>&lt;activity android:name="android.app.NativeActivity"
      android:configChanges="orientation|screenSize"&gt;
      ...
&lt;/activity&gt;
</code></pre>

<p class="important">
    Starting from Android X.Y, you need to add both <em>orientation</em> and 
    <em>sizeScreen</em> flags because when the orientation changes, it also 
    triggers a size screen changes.
</p>

<p>
    To handle prevent the runtime changes, add  <em>android:configChange</em> 
    attribute with the configuration changes you'd like to handle as value.
</p>

<p>
    Some devices comes with an external keyboard and pluging in would also cause the 
    application to restart. That's why you also want to add <em>keyboard</em> and 
    <em>keyboardHidden</em>.
</p>
<pre><code>&lt;activity ... android:configChanges="keyboard|keyboardHidden|orientation|screenSize"&gt;
</code></pre>

<?php h2('Accessing the filesystem') ?>
<p>
    Accessing the filesystem isn't as trivial as on other OSes.
    
    assets.
    
    files/
    
    other methods.
</p>

<?php h2('Android permissions') ?>
<p>
    Abc.
</p>

<?php h2('Audio policy') ?>
<p>
    When you use the speaker to play a sound or music, it's your responsability 
    to stop them when the application gets stopped. Otherwise, you'll annoy the 
    user if your app won't shut up while he's reading the email he just recieved.
</p>

<p class="important">
    Recording audio isn't suppoted yet. sf::SoundBufferRecorder::isAvailable() 
    will always return false.
</p>

<?php h2('Interpolate with Java/accessing the native activity handle') ?>
<p>
    The following goes out of the scope of SFML but was taken into account when 
    written the Android port.<br />
    <br />
    Use Android Java library<br />
    Google services<br />
</p>

<?php

    require("footer.php");

?>
