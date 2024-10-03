!!! warning

    This page refers to an in-development version of SFML and as such may not have been updated yet.  
    [Click here](https://www.sfml-dev.org/tutorials/latest/) to navigate to the latest officially released version.

# SFML and Xcode (macOS)

## Introduction

This is the first tutorial you should read if you're using SFML with Xcode -- and more generally if you are developing applications for macOS. It will show you how to install SFML, set up your IDE and compile a basic SFML program. More importantly, it will also show you how to make your applications ready "out of the box" for the end users.

You will see several external links in this document. They are meant for further reading on specific topics for those who are curious; reading them isn't necessary to follow this tutorial.

### System requirements

All you need to create an SFML application is:

- An Intel Mac with Catalina or later (10.15+) or an Apple Silicon Mac with Big Sur or later (11+)
- [Xcode](http://developer.apple.com/xcode/ "Download Xcode") (versions 4 or above of the IDE, which is available on the _App Store_, are supported).
- Clang and libc++ (which are shipped by default with Xcode).

With recent versions of Xcode you also need to install the Command Line Tools from Xcode > Preferences > Downloads > Components. If you can't find the CLT there use `xcode-select --install` in a Terminal and follow on-screen instructions.

### Binaries: dylib vs framework

SFML is available in two formats on macOS. You have the _dylib_ libraries on the one hand and the _framework_ bundles on the other.

- Dylib stands for dynamic library; this format is like _.so_ libraries on Linux. You can find more details in [this document](https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/ "Go to Apple's documentation about dylib").
- Frameworks are fundamentally the same as dylibs, except that they can encapsulate external resources. Here is [the in-depth documentation](https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html "Go to Apple's documentation about framework").

There is only one slight difference between these two kinds of libraries that you should be aware of while developing SFML applications: if you build SFML yourself, you can get dylib in both _release_ and _debug_ configurations. However, frameworks are only available in the _release_ configuration. In either case, it shouldn't be an issue since you should be using the _release_ version of SFML when you release your application anyway. That's why the OS X binaries on the [download page](https://www.sfml-dev.org/download.php "Go to the download page") are only available in the _release_ configuration.

### Xcode templates

SFML is provided with two templates for Xcode 4+ which allow you to create new application projects very quickly and easily: you can select which modules your application requires, whether you want to use SFML as dylib or as frameworks and whether to create an application bundle containing all its resources (making the installation process of your applications as easy as a simple drag-and-drop) or a classic binary. See below for more details.

Be aware that these templates are not compatible with Xcode 3. If you are still using this version of the IDE and you don't consider updating it, you can still create SFML applications. A guide on doing that is beyond the scope of this tutorial. Please refer to Apple's documentation about Xcode 3 and how to add a library to your project.

## Installing SFML

First of all you need to download the SFML SDK which is available on the [download page](https://www.sfml-dev.org/download.php "Go to the download page"). Then, in order to start developing SFML applications, you have to install the following items:

- **Header files and libraries**  
    SFML is available either as dylibs or as frameworks. Only one type of binary is required although both can be installed simultaneously on the same system. We recommend using the frameworks.
    - _frameworks_  
        Copy the content of Frameworks to /Library/Frameworks.
    - _dylib_  
        Copy the content of lib to /usr/local/lib and copy the content of include to /usr/local/include.
- **SFML dependencies**  
    SFML depends on a few external libraries on macOS. Copy the content of extlibs to /Library/Frameworks.
- **Xcode templates**  
    This feature is optional but we strongly recommend that you install it. Copy the SFML directory from templates to ~/Library/Developer/Xcode/Templates (create the folders if they don't exist yet).

## Create your first SFML program

We provide two templates for Xcode. SFML CLT generates a project for a classic terminal program whereas SFML App creates a project for an application bundle. We will use the latter here but they both work similarly.

First select File > New Project... then choose SFML in the left column and double-click on SFML App.

![Xcode template selection](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-new-project.png "Xcode template selection")

Now you can fill in the required fields as shown in the following screenshot. When you are done click next.

![Xcode template form](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-new-project-settings.png "Xcode template form")

Your new project is now set to create an [application bundle ".app"](https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html "Go to Apple's documentation
about application bundle").

Now that your project is ready, let's see what is inside:

![Content of the new project](https://www.sfml-dev.org/tutorials/2.6/images/start-osx-window.png "Content of the new project")

As you can see, there are already a few files in the project. There are three important kinds:

1. **Header & source files:** the project comes with a basic example in main.cpp and the helper function `std::string resourcePath(void);` in ResourcePath.hpp and ResourcePath.mm. The purpose of this function, as illustrated in the provided example, is to provide a convenient way to access the Resources folder of your application bundle.  
    Please note that this function only works on macOS. If you are planning to make your application work on other operating systems, you should implement your own version of this function on the operating systems in question.
2. **Resource files:** the resources of the basic example are put in this folder and are automatically copied to your application bundle when you compile it.  
    To add new resources to your project, simply drag and drop them into this folder and make sure that they are a member of your application target; i.e. the box under Target Membership in the utility area (cmd+alt+1) should be checked.
3. **Products:** your application. Simply press the Run button to test it.

The other files in the project are not very relevant for us here. Note that the SFML dependencies of your project are added to your application bundle in a similar in which the resources are added. This is done so that your application will run out of the box on another Mac without any prior installation of SFML or its dependencies.