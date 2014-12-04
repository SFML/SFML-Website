<?php

    $title = "Threads";
    $page = "system-thread.php";

    require("header.php");

?>

<h1>Threads</h1>

<?php h2('What is a thread?') ?>
<p>
    Most of you should already know what a thread is, however here is a little explanation for those who are really new to this concept.
</p>
<p>
    A thread is basically a sequence of instructions that run in parallel to other threads. Every program is made of at least one thread: the main one, which
    runs your <code>main()</code> function. Programs that only use the main thread are <em>single-threaded</em>, if you add one or more threads they become
    <em>multi-threaded</em>.
</p>
<p>
    So, in short, threads are a way to do multiple things at the same time. This can be useful, for example, to display an animation and reacting
    to user input while loading images or sounds. Threads are also widely used in network programming, to wait for data to be received while continuing
    to update and draw the application.
</p>

<?php h2('SFML threads or std::thread?') ?>
<p>
    In its newest version (2011), the C++ standard library provides a set of
    <a class="external" href="http://en.cppreference.com/w/cpp/thread" title="C++11 threading classes">classes for threading</a>. At the time SFML was written, the
    C++11 standard was not written and there was no standard way of creating threads. When SFML 2.0 was released, there were still a lot of compilers
    that didn't support this new standard.
</p>
<p>
    If you work with compilers that support the new standard and its <code>&lt;thread&gt;</code> header, forget about the SFML thread classes and use it instead -- it will
    be much better. But if you work with a pre-2011 compiler, or plan to distribute your code and want it to be fully portable, the SFML threading
    classes are a good solution.
</p>

<?php h2('Creating a thread with SFML') ?>
<p>
    Enough talk, let's see some code. The class that makes it possible to create threads in SFML is <?php class_link("Thread") ?>, and here is what it
    looks like in action:
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

void func()
{
    // this function is started when thread.launch() is called

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm thread number one" &lt;&lt; std::endl;
}

int main()
{
    // create a thread with func() as entry point
    sf::Thread thread(&amp;func);

    // run it
    thread.launch();

    // the main thread continues to run...

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    return 0;
}
</code></pre>
<p>
    In this code, both <code>main</code> and <code>func</code> run in parallel after <code>thread.launch()</code> has been called. The result is that
    text from both functions should be mixed in the console.
</p>
<img class="screenshot" src="./images/system-thread-mixed.png" alt="Screenshot of the program output" title="Screenshot of the program output" />
<p>
    The entry point of the thread, ie. the function that will be run when the thread is started, must be passed to the constructor of <?php class_link("Thread") ?>.
    <?php class_link("Thread") ?> tries to be flexible and accept a wide variety of entry points: non-member or member functions, with or without
    arguments, functors, etc. The example above shows how to use a non-member function, here are a few other examples.
</p>
<p>
    - Non-member function with one argument:
</p>
<pre><code class="cpp">void func(int x)
{
}

sf::Thread thread(&amp;func, 5);
</code></pre>
<p>
    - Member function:
</p>
<pre><code class="cpp">class MyClass
{
public:

    void func()
    {
    }
};

MyClass object;
sf::Thread thread(&amp;MyClass::func, &amp;object);
</code></pre>
<p>
    - Functor (function-object):
</p>
<pre><code class="cpp">struct MyFunctor
{
    void operator()()
    {
    }
};

sf::Thread thread(MyFunctor());
</code></pre>
<p>
    The last example, which uses functors, is the most powerful one since it can accept any type of functor and therefore makes <?php class_link("Thread") ?>
    compatible with many types of functions that are not directly supported. This feature is especially interesting with C++11 lambdas or
    <code>std::bind</code>.
</p>
<pre><code class="cpp">// with lambdas
sf::Thread thread([](){
    std::cout &lt;&lt; "I am in thread!" &lt;&lt; std::endl;
});
</code></pre>

<pre><code class="cpp">// with std::bind
void func(std::string, int, double)
{
}

sf::Thread thread(std::bind(&amp;func, "hello", 24, 0.5));
</code></pre>
<p>
    If you want to use a <?php class_link("Thread") ?> inside a class, don't forget that it doesn't have a default constructor. Therefore, you have to
    initialize it directly in the constructor's <em>initialization list</em>:
</p>
<pre><code class="cpp">class ClassWithThread
{
public:

    ClassWithThread()
    : m_thread(&amp;ClassWithThread::f, this)
    {
    }

private:

    void f()
    {
        ...
    }

    sf::Thread m_thread;
};
</code></pre>
<p>
    If you really need to construct your <?php class_link("Thread") ?> instance <em>after</em> the construction of the owner object, you can also
    delay its construction by dynamically allocating it on the heap.
</p>

<?php h2('Starting threads') ?>
<p>
    Once you've created a <?php class_link("Thread") ?> instance, you must start it with the <code>launch</code> function.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);
thread.launch();
</code></pre>
<p>
    <code>launch</code> calls the function that you passed to the constructor in a new thread, and returns immediately so that the calling thread can
    continue to run.
</p>

<?php h2('Stopping threads') ?>
<p>
    A thread automatically stops when its entry point function returns. If you want to wait for a thread to finish from another thread, you can call its
    <code>wait</code> function.
</p>
<pre><code class="cpp">sf::Thread thread(&amp;func);

// start the thread
thread.launch();

...

// block execution until the thread is finished
thread.wait();
</code></pre>
<p>
    The <code>wait</code> function is also implicitly called by the destructor of <?php class_link("Thread") ?>, so that a thread cannot remain alive
    (and out of control) after its owner <?php class_link("Thread") ?> instance is destroyed. Keep this in mind when you manage your threads (see the last
    section of this tutorial).
</p>

<?php h2('Pausing threads') ?>
<p>
    There's no function in <?php class_link("Thread") ?> that allows another thread to pause it, the only way to pause a thread is to do it from the
    code that it runs. In other words, you can only pause the current thread. To do so, you can call the <code>sf::sleep</code> function:
</p>
<pre><code class="cpp">void func()
{
    ...
    sf::sleep(sf::milliseconds(10));
    ...
}</code></pre>
<p>
    <code>sf::sleep</code> has one argument, which is the time to sleep. This duration can be given with any unit/precision, as seen in the
    <a class="internal" title="Time tutorial" href="./system-time.php">time tutorial</a>.<br />
    Note that you can make any thread sleep with this function, even the main one.
</p>
<p>
    <code>sf::sleep</code> is the most efficient way to pause a thread: as long as the thread sleeps, it requires zero CPU. Pauses based on active waiting,
    like empty <code>while</code> loops, would consume 100% CPU just to do... nothing. However, keep in mind that the sleep duration is just a hint,
    depending on the OS it will be more or less accurate. So don't rely on it for very precise timing.
</p>

<?php h2('Protecting shared data') ?>
<p>
    All the threads in a program share the same memory, they have access to all variables in the scope they are in. It is very convenient but also dangerous:
    since threads run in parallel, it means that a variable or function might be used concurrently from several threads at the same time.
    If the operation is not <em>thread-safe</em>, it can lead to undefined behavior (ie. it might crash or corrupt data).
</p>
<p>
    Several programming tools exist to help you protect shared data and make your code thread-safe, these are called synchronization primitives. Common ones
    are mutexes, semaphores, condition variables and spin locks. They are all variants of the same concept: they protect a piece of code by allowing only
    certain threads to access it while blocking the others.
<p>
    The most basic (and used) primitive is the mutex. Mutex stands for "MUTual EXclusion": it ensures that only a single thread is able to run the
    code that it guards. Let's see how they can bring some order to the example above:
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

sf::Mutex mutex;

void func()
{
    mutex.lock();

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm thread number one" &lt;&lt; std::endl;

    mutex.unlock();
}

int main()
{
    sf::Thread thread(&amp;func);
    thread.launch();

    mutex.lock();

    for (int i = 0; i &lt; 10; ++i)
        std::cout &lt;&lt; "I'm the main thread" &lt;&lt; std::endl;

    mutex.unlock();

    return 0;
}
</code></pre>
<p>
    This code uses a shared resource (<code>std::cout</code>), and as we've seen it produces unwanted results -- everything is mixed in the console.
    To make sure that complete lines are properly printed instead of being randomly mixed, we protect the corresponding region of the code
    with a mutex.
</p>
<p>
    The first thread that reaches its <code>mutex.lock()</code> line succeeds to lock the mutex, directly gains access to the code that follows and prints
    its text. When the other thread reaches its <code>mutex.lock()</code> line, the mutex is already locked and thus the thread is put to sleep
    (like <code>sf::sleep</code>, no CPU time is consumed by the sleeping thread). When the first thread finally unlocks the mutex, the second thread
    is awoken and is allowed to lock the mutex and print its text block as well. This leads to the lines of text appearing sequentially in the console instead of being
    mixed.
</p>
<img class="screenshot" src="./images/system-thread-ordered.png" alt="Screenshot of the program output" title="Screenshot of the program output" />
<p>
    Mutexes are not the only primitive that you can use to protect your shared variables, but it should be enough for most cases. However, if your application
    does complicated things with threads, and you feel like it is not enough, don't hesitate to look for a true threading library, with more features.
</p>

<?php h2('Protecting mutexes') ?>
<p>
    Don't worry: mutexes are already thread-safe, there's no need to protect them. But they are not exception-safe! What happens if an exception is
    thrown while a mutex is locked? It never gets a chance to be unlocked and remains locked forever. All threads that try to lock it in the future will
    block forever, and in some cases, your whole application could freeze. Pretty bad result.
</p>
<p>
    To make sure that mutexes are always unlocked in an environment where exceptions can be thrown, SFML provides an RAII class to wrap
    them: <?php class_link("Lock") ?>. It locks a mutex in its constructor, and unlocks it in its destructor.
    Simple and efficient.
</p>
<pre><code class="cpp">sf::Mutex mutex;

void func()
{
    sf::Lock lock(mutex); // mutex.lock()

    functionThatMightThrowAnException(); // mutex.unlock() if this function throws

} // mutex.unlock()</code></pre>
<p>
    Note that <?php class_link("Lock") ?> can also be useful in a function that has multiple <code>return</code> statements.
</p>
<pre><code class="cpp">sf::Mutex mutex;

bool func()
{
    sf::Lock lock(mutex); // mutex.lock()

    if (!image1.loadFromFile("..."))
        return false; // mutex.unlock()

    if (!image2.loadFromFile("..."))
        return false; // mutex.unlock()

    if (!image3.loadFromFile("..."))
        return false; // mutex.unlock()

    return true;
} // mutex.unlock()</code></pre>

<?php h2('Common mistakes') ?>
<p>
    One thing that is often overlooked by programmers is that a thread cannot live without its corresponding <?php class_link("Thread") ?> instance.<br />
    The following code is often seen on the forums:
</p>
<pre><code class="cpp">void startThread()
{
    sf::Thread thread(&amp;funcToRunInThread);
    thread.launch();
}

int main()
{
    startThread();
    // ...
    return 0;
}
</code></pre>
<p>
    Programers who write this kind of code expect the <code>startThread()</code> function to start a thread that will live on its own and be destroyed
    when the threaded function ends. This is not what happens. The threaded function appears to block the main thread, as if the thread wasn't working.
</p>
<p>
    What is the cause of this? The <?php class_link("Thread") ?> instance is local to the <code>startThread()</code> function and is therefore immediately destroyed,
    when the function returns. The destructor of <?php class_link("Thread") ?> is invoked, which calls <code>wait()</code> as we've learned above, and
    the result is that the main thread blocks and waits for the threaded function to be finished instead of continuing to run in parallel.
</p>
<p>
    So don't forget: You must manage your <?php class_link("Thread") ?> instance so that it lives as long as the threaded function is supposed to run.
</p>

<?php

    require("footer.php");

?>
