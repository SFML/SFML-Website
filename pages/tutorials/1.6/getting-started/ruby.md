# SFML and Ruby

!!! warning ""

    You're reading a tutorial for SFML 1.6, which doesn't exist anymore in the latest version. Check out the [latest tutorials](/tutorials/latest/).

## Introduction

The purpose of this tutorial is to explain you how to compile / install / use the Ruby binding of SFML (which is called **RubySFML**).

## Installing RubySFML in Windows

First you must download the RubySFML package (SFML-x.x-ruby-src-windows), which can be found on the [download page](../../../download/index.md "Go to the download page"). This package contains the source code and all you need to build and install RubySFML. If you don't want to compile RubySFML (or just don't have Visual Studio to do it), you can just download the precompiled archive (SFML-x.x-ruby-windows), which contains the ready-to-use binaries. This archive is also the minimum you need in order to distribute your RubySFML applications. It even contains the Ruby core, so your users won't need to install anything.

If you downloaded the sources, please refer to the README file to get detailed instructions on how to compile RubySFML.

Whether you built RubySFML binaries or downloaded them directly, you should now have everything to write and run your own RubySFML programs.

## Installing RubySFML in Linux

First you must download the RubySFML package (SFML-x.x-ruby-src-linux), which can be found on the [download page](../../../download/index.md "Go to the download page"). This package contains the source code and all you need to build and install RubySFML.

Before compiling RubySFML, the C++ libraries of SFML must have been built. You can have a look at [this tutorial](linux.md "Building SFML in Linux") if you're not sure how to do it.

Once the RubySFML archive has been extracted to your hard drive, go into the ruby/RubySFML directory, and run "ruby extconf-linux.rb". This will automatically create a makefile for compiling RubySFML.

Run "make" to build the RubySFML files.

After that, everything should be ready to use RubySFML. If Ruby complains about undefined modules or classes, make sure that all the RubySFML files are into an appropriate location so that Ruby can find them.

## Writing your first RubySFML program

Unlike the C++ libraries, RubySFML gathers all the SFML classes into a single module ("SFML"). As Ruby doesn't support native threading, and has its own networking classes, only some classes of the System, Window, Graphics and Audio modules are exposed in RubySFML.

Here is a very simple piece of SFML code that opens a window and displays some text :

```
# Include the RubySFML extension
require "RubySFML"
include SFML

# Create the main window
mode = VideoMode.new 800, 600, 32
window = RenderWindow.new mode, "RubySFML Test"

# Create a graphical string to display
text = Text.new "Hello SFML"

# Start the game loop
running = true
while running
    while event = window.getEvent
        running = false if event.type == Event::Closed
    end

    # Draw the text, and update the window
    window.draw text
    window.display
end
```

You will find a quick reference documentation in the "doc" directory, which explains every class contained in RubySFML and the changes between the C++ and the Ruby version. However the classes are the same, so you can still use the full C++ documentation and tutorials on the website.

The "test" directory contains a few demos using RubySFML, you can try them to make sure everything is working. Some of these demos require the Ruby-OpenGL module, make sure you have it before trying to run them (in Windows, it is automatically built with RubySFML).
