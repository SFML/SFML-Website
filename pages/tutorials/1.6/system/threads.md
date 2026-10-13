# Using threads and mutexes

!!! warning ""

    You're reading a tutorial for SFML 1.6, which doesn't exist anymore in the latest version. Check out the [latest tutorials](/tutorials/latest/).

## Introduction

First, I must say that this tutorial is not the most important one. In fact you can start learning and using SFML without threads and mutexes. But as the system package is the base for every other package, it is important to know what features it can provide you.

## What is a thread ?

First, what is a thread ? What should you use it for ?

Basically, a thread is a way to run a set of instructions independently of the main thread (every program runs in a thread : it is a monothreaded program ; when you add one or more threads, it is called a multithreaded program). It is just like running another process, except that it is much lighter -- threads are also called lightweight processes. All threads share the same datas as their parent process. As a result, you can have two or more sets of instructions running in parallel within your program.  
Ok, so when should you use threads ? Basically, when you have to run something that would take long (complex calculations, waiting for something, ...), and you still want to do something else at the same time. For example, you may want to be able to display a graphical interface while you load your game resources (that takes usually a long time), so you can put all the loading code into a separate thread. It is also widely used in network programming, to wait for network data to be received while continuing running the program.

In SFML, threads is defined by the [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") class. There are two ways of using it, depending on your needs.

## Using sf::Thread with a callback function

The first way of using [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") is to provide it a function to run. When you start the thread, the provided function will be called as the entry point of the thread. The thread will finish automatically when the function reaches its end.

Here is a simple example :

```cpp
#include <SFML/System.hpp>
#include <iostream>

void ThreadFunction(void* UserData)
{
    // Print something...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the thread number 1" << std::endl;
}

int main()
{
    // Create a thread with our function
    sf::Thread Thread(&ThreadFunction);

    // Start it !
    Thread.Launch();

    // Print something...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

    return EXIT_SUCCESS;
}
```

When `Thread.Launch()` is called, the execution is split into two parallel flows, meaning that `ThreadFunction()` will execute while `main()` is finishing. So the text from both threads will be displayed at the same time.

Be careful : here the `main()` function can finish before `ThreadFunction()`, ending the program while the thread is still running. However this is not the case : the destructor of [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") will wait for the thread to finish, to make sure the internal thread doesn't live longer than the [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") instance that owns it.

If you have some datas to pass to the thread function, you can pass it to the [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") constructor :

```cpp
MyClass Object;
sf::Thread Thread(&ThreadFunction, &Object);
```

You can then get it back with the `UserData` parameter :

```cpp
void ThreadFunction(void* UserData)
{
    // Cast the parameter back to its real type
    MyClass* Object = static_cast<MyClass*>(UserData);
}
```

Make sure the data you pass is valid as long as the thread function needs it !

## Using sf::Thread as a base class

Using a callback function as a thread is easy, and can be useful in some cases, but is not very flexible. What if you want to use a thread in a class ? What if you have to share more variables between your thread and the main one ?

To allow more flexibility, [`sf::Thread`](../../../documentation/1.6/classsf_1_1Thread.html "sf::Thread documentation") can also be used as a base class. Instead of passing it a callback function to call, just inherit from it and override the virtual function `Run()`. Here is the same example as above, written with a derived class instead of a callback function :

```cpp
#include <SFML/System.hpp>
#include <iostream>

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Print something...
        for (int i = 0; i < 10; ++i)
            std::cout << "I'm the thread number 2" << std::endl;
    }
};

int main()
{
    // Create an instance of our custom thread class
    MyThread Thread;

    // Start it !
    Thread.Launch();

    // Print something...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

    return EXIT_SUCCESS;
}
```

If running a separate thread is an internal feature that doesn't need to appear in your class' public interface, you can use private inheritance :

```cpp
class MyClass : private sf::Thread
{
public :

    void DoSomething()
    {
        Launch();
    }

private :

    virtual void Run()
    {
        // Do something...
    }
};
```

As a result, your class won't expose all the thread-related functions in its public interface.

## Terminating a thread

As we already said, a thread is terminated when is associated function ends. But what if you want to end a thread from another thread, without waiting for its function to end ?

There are two ways of terminating a thread, but only one is really safe to use. Let's first have a look at the unsafe way to terminate a thread :

```cpp
#include <SFML/System.hpp>

void ThreadFunction(void* UserData)
{
    // Do something...
}

int main()
{
    // Create a thread with our function
    sf::Thread Thread(&ThreadFunction);

    // Start it !
    Thread.Launch();

    // For some reason, we want to terminate the thread
    Thread.Terminate();

    return EXIT_SUCCESS;
}
```

By calling `Terminate()`, the thread will be immediatly killed with no chance to finish its execution properly. It's even worse, because depending on your operating system, the thread may not cleanup the resources it uses.  
Here is what MSDN says about the `TerminateThread` function for Windows : " TerminateThread is a dangerous function that should only be used in the most extreme cases. "

The only way to safely terminate a running thread is simply to wait for it to finish by itself. To wait for a thread, you can use its `Wait()` function :

```cpp
Thread.Wait();
```

So, to tell a thread to terminate, you can send it en event, set a boolean variable, or whatever. And then wait until it finishes by itself. Here is an example :

```cpp
#include <SFML/System.hpp>

bool ThreadRunning;

void ThreadFunction(void* UserData)
{
    ThreadRunning = true;
    while (ThreadRunning)
    {
        // Do something...
    }
}

int main()
{
    // Create a thread with our function
    sf::Thread Thread(&ThreadFunction);

    // Start it !
    Thread.Launch();

    // For some reason, we want to terminate the thread
    ThreadRunning = false;
    Thread.Wait();

    return EXIT_SUCCESS;
}
```

This is easy, and much safer than calling `Terminate()`.

## Pausing a thread

You can pause the main thread or a thread that you've created, with the `sf::Sleep` function :

```cpp
sf::Sleep(0.1f);
```

As every duration in SFML, the parameter is a floating value defining the pause duration in seconds. Here the thread will sleep for 100 ms.

## Using a mutex

Ok, let's first quickly define what a mutex is. A mutex (which stands for *MUTual EXclusion*) is a synchronization primitive. It is not the only one : there are semaphores, critical sections, conditions, etc. But the most useful one is the mutex. Basically, you use it to lock a specific set of instructions that cannot be interrupted, to prevent other threads from accessing it. While a mutex is locked, any other thread trying to lock it will be paused until the owner thread unlocks the mutex. Typically it is used to access a variable shared between two or more threads.

If you run the examples above, you will see that the output is maybe not what you expected : texts from both threads are blended together. This is because the threads are accessing the same resource at the same time (in this case, the standard output). To avoid this, we can use a [`sf::Mutex`](../../../documentation/1.6/classsf_1_1Mutex.html "sf::Mutex documentation") :

```cpp
#include <SFML/System.hpp>
#include <iostream>

sf::Mutex GlobalMutex; // This mutex will be used to synchronize our threads

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Lock the mutex, to make sure no thread will interrupt us while we are displaying text
        GlobalMutex.Lock();

        // Print something...
        for (int i = 0; i < 10; ++i)
            std::cout << "I'm the thread number 2" << std::endl;

        // Unlock the mutex
        GlobalMutex.Unlock();
    }
};

int main()
{
    // Create an instance of our custom thread class
    MyThread Thread;

    // Start it !
    Thread.Launch();

    // Lock the mutex, to make sure no thread will interrupt us while we are displaying text
    GlobalMutex.Lock();

    // Print something...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

    // Unlock the mutex
    GlobalMutex.Unlock();

    return EXIT_SUCCESS;
}
```

If you wonder why we don't use a mutex to access the `ThreadRunning` shared variable in the example above (about thread termination), here are the two reasons :

- Writing / reading the value of a boolean is an atomic operation, meaning that it cannot be interrupted by another thread
- Even if it wasn't atomic, it doesn't matter if the thread interrupts the writing operation ; the only consequence would be to wait for the next loop to get the new value of the boolean

Be careful when using a mutex or any other synchronization primitive : if not used with caution, they can lead to deadlocks (two or more locked threads waiting for each other indefinitely).

But there is still one problem : what happens if an exception is thrown while a mutex is locked ? The thread will never have a chance to unlock it, probably causing a deadlock and freezing your program. To handle this without having to write tons of extra code, SFML provides a [`sf::Lock`](../../../documentation/1.6/classsf_1_1Lock.html "sf::Lock documentation").

A safer version of the example above would be :

```cpp
{
    // Lock the mutex, to make sure no thread will interrupt us while we are displaying text
    sf::Lock Lock(GlobalMutex);

    // Print something...
    for (int i = 0; i < 10; ++i)
        std::cout << "I'm the main thread" << std::endl;

}// The mutex is unlocked automatically when the sf::Lock object is destroyed
```

The mutex is unlocked in the [`sf::Lock`](../../../documentation/1.6/classsf_1_1Lock.html "sf::Lock documentation") destructor, which will be called even if an exception is thrown.

## Conclusion

Threads and mutexes are easy to use, but be careful : parallel programming can be a lot harder than it seems. Avoid threads if you don't really need them, and try to share as few as possible variables between them.

You can now go back to the [tutorials index](../index.md "Back to tutorials index"), or jump to the [tutorials about the windowing package](../window/window.md "Jump to the tutorials about the windowing package").
