<?php

    $title = "Using threads and mutexes";
    $page = "system-threads.php";

    require("header.php");
?>

<h1>Using threads and mutexes</h1>

<?php h2('Introduction') ?>
<p>
    First, I must say that this tutorial is not the most important one. In fact you can start learning
    and using SFML without threads and mutexes. But as the system package is the base for every other
    package, it is important to know what features it can provide you.
</p>

<?php h2('What is a thread ?') ?>
<p>
    First, what is a thread ? What should you use it for ?
</p>
<p>
    Basically, a thread is a way to run a set of instructions independently of the main thread (every
    program runs in a thread : it is a monothreaded program ; when you add one or more threads, it is
    called a multithreaded program). It is just like running another process, except that it is much
    lighter -- threads are also called lightweight processes. All threads share the same datas as their
    parent process. As a result, you can have two or more sets of instructions running in parallel within
    your program.<br/>
    Ok, so when should you use threads ? Basically, when you have to run something that would take long
    (complex calculations, waiting for something, ...), and you still want to do something else at the
    same time. For example, you may want to be able to display a graphical interface while you load your
    game resources (that takes usually a long time), so you can put all the loading code into a separate
    thread. It is also widely used in network programming, to wait for network data to be received
    while continuing running the program.
</p>
<p>
    In SFML, threads is defined by the <?php class_link("Thread")?> class. There are two ways of
    using it, depending on your needs.
</p>

<?php h2('Using sf::Thread with a callback function') ?>
<p>
    The first way of using <?php class_link("Thread")?> is to provide it a function to run. When you start the thread, the
    provided function will be called as the entry point of the thread. The thread will finish automatically
    when the function reaches its end.
</p>
<p>
    Here is a simple example :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

void ThreadFunction(void* UserData)
{
    // Print something...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the thread number 1" &lt;&lt; std::endl;
}

int main()
{
    // Create a thread with our function
    sf::Thread Thread(&amp;ThreadFunction);

    // Start it !
    Thread.Launch();

    // Print something...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    When <code>Thread.Launch()</code> is called, the execution is split into two parallel
    flows, meaning that <code>ThreadFunction()</code> will execute while
    <code>main()</code> is finishing. So the text from both threads will be displayed at
    the same time.
</p>
<p>
    Be careful : here the <code>main()</code> function can finish before
    <code>ThreadFunction()</code>, ending the program while the thread is still running.
    However this is not the case : the destructor of <?php class_link("Thread")?> will wait for the
    thread to finish, to make sure the internal thread doesn't live longer than the
    <?php class_link("Thread")?> instance that owns it.
</p>
<p>
    If you have some datas to pass to the thread function, you can pass it to the
    <?php class_link("Thread")?> constructor :
</p>
<pre><code class="cpp">MyClass Object;
sf::Thread Thread(&amp;ThreadFunction, &amp;Object);
</code></pre>
<p>
    You can then get it back with the <code>UserData</code> parameter :
</p>
<pre><code class="cpp">void ThreadFunction(void* UserData)
{
    // Cast the parameter back to its real type
    MyClass* Object = static_cast&lt;MyClass*&gt;(UserData);
}
</code></pre>
<p>
    Make sure the data you pass is valid as long as the thread function needs it !
</p>

<?php h2('Using sf::Thread as a base class') ?>
<p>
    Using a callback function as a thread is easy, and can be useful in some cases, but is not
    very flexible. What if you want to use a thread in a class ? What if you have to share more
    variables between your thread and the main one ?
</p>
<p>
    To allow more flexibility, <?php class_link("Thread")?> can also be used as a base class.
    Instead of passing it a callback function to call, just inherit from it and override the
    virtual function <code>Run()</code>. Here is the same example as above, written with
    a derived class instead of a callback function :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Print something...
        for (int i = 0; i &lt; 10; ++i)
            std::cout &lt;&lt; "I'm the thread number 2" &lt;&lt; std::endl;
    }
};

int main()
{
    // Create an instance of our custom thread class
    MyThread Thread;

    // Start it !
    Thread.Launch();

    // Print something...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    If running a separate thread is an internal feature that doesn't need to appear in your class' public
    interface, you can use private inheritance :
</p>
<pre><code class="cpp">class MyClass : private sf::Thread
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
</code></pre>
<p>
    As a result, your class won't expose all the thread-related functions in its public interface.
</p>

<?php h2('Terminating a thread') ?>
<p>
    As we already said, a thread is terminated when is associated function ends. But what if you want to
    end a thread from another thread, without waiting for its function to end ?
</p>
<p>
    There are two ways of terminating a thread, but only one is really safe to use. Let's first have a look
    at the unsafe way to terminate a thread :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;

void ThreadFunction(void* UserData)
{
    // Do something...
}

int main()
{
    // Create a thread with our function
    sf::Thread Thread(&amp;ThreadFunction);

    // Start it !
    Thread.Launch();

    // For some reason, we want to terminate the thread
    Thread.Terminate();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    By calling <code>Terminate()</code>, the thread will be immediatly killed with no chance
    to finish its execution properly. It's even worse, because depending on your operating system,
    the thread may not cleanup the resources it uses.<br/>
    Here is what MSDN says about the <code>TerminateThread</code> function for Windows :
    <q>
        TerminateThread is a dangerous function that should only be used in the most extreme cases.
    </q>
</p>

<p>
    The only way to safely terminate a running thread is simply to wait for it to finish by itself.
    To wait for a thread, you can use its <code>Wait()</code> function :
</p>
<pre><code class="cpp">Thread.Wait();
</code></pre>
<p>
    So, to tell a thread to terminate, you can send it en event, set a boolean variable, or whatever.
    And then wait until it finishes by itself. Here is an example :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;

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
    sf::Thread Thread(&amp;ThreadFunction);

    // Start it !
    Thread.Launch();

    // For some reason, we want to terminate the thread
    ThreadRunning = false;
    Thread.Wait();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    This is easy, and much safer than calling <code>Terminate()</code>.
</p>

<?php h2('Pausing a thread') ?>
<p>
    You can pause the main thread or a thread that you've created, with the
    <code>sf::Sleep</code> function :
</p>
<pre><code class="cpp">sf::Sleep(0.1f);
</code></pre>
<p>
    As every duration in SFML, the parameter is a floating value defining the pause duration in seconds.
    Here the thread will sleep for 100 ms.
</p>

<?php h2('Using a mutex') ?>
<p>
    Ok, let's first quickly define what a mutex is. A mutex (which stands for <em>MUTual EXclusion</em>)
    is a synchronization primitive. It is not the only one : there are semaphores, critical sections,
    conditions, etc. But the most useful one is the mutex. Basically, you use it to lock a specific
    set of instructions that cannot be interrupted, to prevent other threads from accessing it.
    While a mutex is locked, any other thread trying to lock it will be paused until the owner thread
    unlocks the mutex. Typically it is used to access a variable shared between two or more threads.
</p>
<p>
    If you run the examples above, you will see that the output is maybe not what you expected : texts
    from both threads are blended together. This is because the threads are accessing the same resource
    at the same time (in this case, the standard output). To avoid this, we can use a
    <?php class_link("Mutex")?> :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

sf::Mutex GlobalMutex; // This mutex will be used to synchronize our threads

class MyThread : public sf::Thread
{
private :

    virtual void Run()
    {
        // Lock the mutex, to make sure no thread will interrupt us while we are displaying text
        GlobalMutex.Lock();

        // Print something...
        for (int i = 0; i &lt; 10; ++i)
            std::cout &lt;&lt; "I'm the thread number 2" &lt;&lt; std::endl;

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
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    // Unlock the mutex
    GlobalMutex.Unlock();

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    If you wonder why we don't use a mutex to access the <code>ThreadRunning</code>
    shared variable in the example above (about thread termination), here are the two reasons :
</p>
<ul>
    <li>Writing / reading the value of a boolean is an atomic operation, meaning that it cannot
    be interrupted by another thread</li>
    <li>Even if it wasn't atomic, it doesn't matter if the thread interrupts the writing operation ;
    the only consequence would be to wait for the next loop to get the new value of the boolean</li>
</ul>
<p>
    Be careful when using a mutex or any other synchronization primitive : if not used with caution,
    they can lead to deadlocks (two or more locked threads waiting for each other indefinitely).
</p>
<p>
    But there is still one problem : what happens if an exception is thrown while a mutex is locked ? The thread will never
    have a chance to unlock it, probably causing a deadlock and freezing your program. To handle this without having to
    write tons of extra code, SFML provides a
    <?php class_link("Lock")?>.
</p>
<p>
    A safer version of the example above would be :
</p>
<pre><code class="cpp">{
    // Lock the mutex, to make sure no thread will interrupt us while we are displaying text
    sf::Lock Lock(GlobalMutex);

    // Print something...
    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

}// The mutex is unlocked automatically when the sf::Lock object is destroyed
</code></pre>
<p>
    The mutex is unlocked in the <?php class_link("Lock")?> destructor, which will be called even if an exception is thrown.
</p>

<?php h2('Conclusion') ?>
<p>
    Threads and mutexes are easy to use, but be careful : parallel programming can be a lot harder than
    it seems. Avoid threads if you don't really need them, and try to share as few as possible variables
    between them.
</p>
<p>
    You can now go back to the
    <a class="internal" href="./index.php" title="Back to tutorials index">tutorials index</a>,
    or jump to the
    <a class="internal" href="./window-window.php" title="Jump to the tutorials about the windowing package">tutorials about the windowing package</a>.
</p>

<?php

    require("footer.php");

?>
