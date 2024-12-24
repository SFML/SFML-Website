---
hide:
  - footer
---

# Programming in General

## What is RAII and why does it rock? {: #raii}

RAII is an acronym for **R**esource **A**cquisition **I**s **I**nitialization.
It is a programming idiom/technique that is used extensively in C++ and can be used in other programming languages as well.

The origin of this idiom lies in the way of how exceptions work in C++.
When an exception is thrown in a code block, execution is diverted to the relevant handlers and the program flow continues on from there.
If the programmer has to rely on ALL his code in a block being executed to perform the necessary clean up of resources, this can be a problem in the case an exception is thrown because it is not guaranteed that the clean up code will be executed and resources will not be destroyed properly.

To address this issue, RAII takes care of the fact that although not all code is executed when an exception is thrown, the destructors of an object are guaranteed to be called because all objects have to be destroyed when the corresponding scope is left.

This can be used in any resource owning object or in places where certain functions have to be called to make sure the program stays in a clean running state.
A good example of this is an `sf::Texture`.
No matter what happens, if the `sf::Texture` object gets destroyed because it goes out of scope, the underlying OpenGL resources also get freed.

From the example just mentioned, it should be apparent that the same can be said of dynamically allocated memory.
It is also a resource that we need to free when we are done with it.
Because of this, to promote RAII in modern C++, smart pointer facilities have made their way into the language, either as an extension or in C++11 as a part of the STL.
Any memory governed by them is guaranteed to be released when they go out of scope (in the case of non-shared ownership e.g. scoped_ptr) due to RAII.
This makes it much easier to use dynamically allocated objects, as you do not have to worry too much about memory management anymore.

For a more in-depth description with examples, read [this article](https://bromeon.ch/articles/raii.html).

## Why shouldn't I manually manage my memory? {: #mmm}

Nobody forces you to use automatic memory management, however in practice, the larger and more complex a project gets, the harder it is to keep track of such things as well.
Generally it is a good idea to use automatic memory management because it frees you to dedicate more time to more important parts of your project.
Not only that, it will be easier to debug and leaks will be nearly impossible.

C++ has come a long way and in its latest incarnation, C++11, many new memory management facilities made it into the C++ STL.
This lets you use these constructs without the need for external or self-written libraries.

## What are smart pointers? {: #smart}

Smart pointers, as their name implies are pointers that are... well... smart :).
Regular "raw pointers" are just values, merely an address in memory where an object is located.
Unless you do something with those values, nothing is going to happen with the object, and it will sit there until you choose to free the corresponding memory block or close the program and destroy the virtual memory pages associated with it.

Smart pointers on the other hand, do things with the values that they contain.
They are no longer just values but objects that govern the memory they point to.
This can help you to track how many pointers exist that point to a certain block of memory (shared_ptr) or to prevent you from having multiple pointers point at the same block of memory at the same time (unique_ptr).
The best part is, if you let these smart pointers manage your memory for you, they will also take care of freeing it when they think it isn't used any more.

## Why shouldn't I use global variables? {: #global}

Usage of global variables is considered as bad programming practice.
They might seem like an easy solution to your initial problem but they will become a headache later on when the project gets bigger or you are unaware of the implications of declaring something in global scope.

One of the most dangerous things of declaring non-POD ([plain old data](https://en.wikipedia.org/wiki/Plain_old_data_structure)) objects in global scope is that you can never be sure when they are actually constructed and when they will be destroyed.
This means that if they need to own resources you need to make sure they are available before the object is created, which can be tricky to do if that takes place before your main() code gets executed.
Analogous to that, the object might get destroyed after your main() returns thus leaving resource destruction up to some self-clean-up mechanism or in the worst case to a resource manager that already got destroyed before main() returned.
This leads to leaks and is very bad practice.
Furthermore the initialization order and destruction order is not well-defined.
It is only defined _within one translation unit_ as being dependent on the order of declaration, however you can't count on global variables from different translation units being constructed or destroyed in a specific order, it is pure luck here.

Another problem with global variables is that sooner or later you are going to have so many of them that they will clog up your namespace.
Unless you declare them in a separate namespace they will all be in the same giant one: the global one.
If you happen to declare a local variable in one of your functions that happens to have the same name as the global one you are actually referring to, you will not notice the global variable get shadowed unless you have certain warnings switched on.
Some people suggest using Hungarian notation to solve this problem but the modern demeanor tends to avoid Hungarian notation as well.

Furthermore, global variables work against code modularity.
Global variables can be accessed from anywhere and thus bypass well-defined interfaces between modules.
This introduces hidden dependencies in the code, which is not only an additional maintenance burden, but can lead to very difficult-to-track bugs.
Simply because you are not able to control the access to global variables, as they can be changed anywhere, at any time.

As if this were not enough, global variables also play very badly in multi-threaded environments.
Access to global variables from different threads must be protected by mutexes.
This requires additional care by the developer accessing the variable and often leads much more synchronization overhead than necessary, because variables are protected prematurely.
On the other hand, unprotected global variables can silently introduce bugs if an application starts to use multiple threads.

There really isn't any reason to use global variables.
Code using global variables can always be written without them and will never perform worse, most of the time performing better as a result of better memory usage.
Keep in mind that the same reasoning applies to static variables, the only difference is their visibility (class/function scope) and in the case of function-static variables, their construction time (at first call instead of program start).
Don't use `static` to "optimize" the construction of function-local variables.

## What should I use then instead of global variables? {: #insteadof-global}

You should try to confine variables to the scope(s) where they are used.
Construct and hold them in the object which is supposed to own them as well as manage their lifetime and pass them to other objects/functions using references/pointers.
Avoid passing by value.
Often you cannot copy objects and are thus not allowed to pass by value, other times copying the object can take much more time because temporary memory has to be allocated just for the call and freed after the function returns.

If you happen to use a C++11 compliant compiler then you can be sure that many Standard Library objects you pass around will have move constructors defined which makes it less painful to "pass by value" since if certain conditions are met, the compiler will use the Rvalue reference version of certain functions to speed up execution by a substantial amount.

## Why is the singleton pattern not a good one? {: #singleton}

In short, singleton classes are global variables, they just hide it better.
As a result, they share almost all of the related problems (construction/destruction time, implicit dependencies, multi-threading).
The fact that singletons are referred to as an OOP design pattern makes people think "it's OOP, so it must be good", which is not only a generally questionable conclusion, but particularly in this case.
Having a class around it doesn't make code object-oriented; on the contrary, core OOP principles such as modularity or encapsulation are broken in the case of singletons.

A frequent misconception is the idea that things that are only instantiated once should become singletons.
The purpose is to technically enforce that no two instances of a class can coexist.
While this on its own sounds reasonable, the singleton technique mixes the solution to this problem with an unrelated aspect: providing a global access point for that one and only instance.
And this often introduces far more problems than it promises to solve.

There are indeed use cases for classes of which only one object should exist, e.g. management-related tasks like rendering, resource handling, configuration, etc.
As simple as it may sound, the most straightforward way to have only one instance at runtime is to create only one.
The problematic of accidentally creating more is largely overstated, there is usually a clear place where instantiation should happen.
And even if that problem should pose a serious threat, it can be trivially mitigated through assertions.
That alone is rarely a good reason to pay the high price of having global variables.
