---
hide:
  - footer
---

# System

## Does SFML support Unicode? {: #unicode}

SFML supports the input and display of international characters, via the UTF-16 encoding.
Input is provided via `sf::Event::TextEntered` as `sf::String` and can be display with `sf::Text`.

## How do I convert from sf::String to <type> and vice-versa? {: #string-convert}

For conversions to `sf::String`, you can just construct the `sf::String` directly from whatever object you already have.

```
sf::String sfml_string( cpp_string );
```

There are enough constructors that take care of implicit conversion from all standard C++ string types.
If you want to see what these look like, take a look in the [`sf::String` documentation](../documentation/3.0.0/classsf_1_1String.html).
If you want to convert from a non-C++ string to `sf::String`, it is recommended to first convert to a C++ string and then to an `sf::String`.
Since any library using custom string types should provide support for this, this shouldn't be problematic.

For conversions from `sf::String` to any other custom string type, it is also recommended to first convert to a C++ string then from C++ string to that type.

`sf::String` supports implicit conversion to `std::string` and `std::wstring`, so things like

```
std::cout << sfml_string << std::endl;
cpp_string += sfml_string;
std::size_t pos = cpp_string.find( sfml_string );
```

are all valid.
Additionally, if implicit conversion isn't something that comforts you, you can explicitly call `.toAnsiString()` or `.toWideString()` to convert to the corresponding types.

Because internally `sf::String` stores its data in a `std::basic_string<sf::Uint32>`, conversions to this type (which is a C++ string type) are lossless.
Ironically however, conversion to this type is not supported directly by `sf::String` and one has to perform it via iterators as such:

```
std::basic_string basic_uint32_string( sfml_string.begin(), sfml_string.end() );
```

Once you have a `std::basic_string<sf::Uint32>` you can use all of the same functionality as `std::string`, since `std::string` is just a typedef for `std::basic_string<char>`.

## My program keeps crashing when I use threads! {: #threads-crash}

Threading is a very advanced concept, and not something you should try merely because you heard it _can_ increase performance.
In fact, if used improperly, _it even decreases performance_! You should always be able to argue in favor of using threads before even writing your first line of threaded code.
**If you don't fully understand why your application is going to run faster with threads, then just don't use them.**

When you are sure you will benefit from using threads, you will have to be more careful with how you access memory.
Almost all crashes when using threads are attributed to wrong memory access patterns.
What you want to avoid are:

- Multiple concurrent reads and at least one write to the same memory location
- Multiple concurrent writes to the same memory location

Concurrent reads to the same memory location are generally unproblematic.

In order to protect against the above scenarios, you will need to make use of mutex objects.
SFML provides a cross-platform mutex implementation.
See [below](#mutex) for how to use them.

Even after you have protected against concurrent access, you still need to be wary of the order in which statements are executed.
Once you venture into threading, there is no longer an execution ordering guarantee, and it is ultimately up to you to make sure things are done in the right order across different threads.

Good system designs often make threading optional and provide an option to disable them, whether for debugging or other purposes.

## How do I use sf::Mutex? {: #mutex}

`sf::Mutex` is used to lock (acquire) a resource for exclusive access and unlock (release) a resource when exclusive access is no longer necessary.
If you try to lock a mutex that has already been locked by another thread, you will have no choice but to wait for the locking thread to release the lock in order for execution to proceed.

It is good practice to not lock/unlock an `sf::Mutex` directly, but to rely on RAII `sf::Lock` objects to automatically unlock their owned mutex on destruction.

For more information on `sf::Mutex` and `sf::Lock`, refer to the [official documentation](https://www.sfml-dev.org/tutorials/latest/system-thread.php#protecting-shared-data).

## Why can't I store my sf::Thread in an STL container? {: #thread-container}

`sf::Thread` inherits from `sf::NonCopyable` meaning you cannot copy or assign an `sf::Thread`.
This is however a requirement to use a data type with an STL container.

You might be wondering how it would still be possible to store multiple threads in an STL container if you are trying to implement some sort of thread pool.
The answer is simple: instead of storing instances, store pointers to the `sf::Threads`.

The `sf::NonCopyable` restrictions can only apply to instances of an `sf::Thread`.
When copying pointers, the copy constructor or assignment operator of a class are not invoked.
As such it is perfectly legal to copy and pass pointers around.

Since working with raw pointers is something you want to avoid in modern C++, you can use [smart pointers](programming.md#smart) to great extent in combination with this technique.

## Why doesn't sf::sleep sleep for the amount of time I want it to? {: #sleep}

When calling `sf::sleep()` you are requesting that the operating system halts execution of the current thread and yields the time slot allocated to it by the task scheduler to another task, a task being anything requiring execution time, from processes to threads and fibers if they are supported.

Because the CPU doesn't actually sleep in a multi-tasking environment, this has to be realized by an entry into an operating system specific lookup table.
This lookup table informs the scheduler to skip the sleeping thread when selecting the next task to execute for a given time slice.
Depending on the implementation of the operating system's sleep facility, keeping track of how long the thread has slept for and when to wake it up again is performed differently.

There are multiple possible reasons `sf::sleep()` might return prematurely, and even overdue.
It is entirely dependent on what the operating system chooses to do and a bit of luck.

As described above, the operating system has to keep track of the amount of time slept and when to wake the thread up.
Because high resolution timers might not be available on all systems, the default resolution may be set very low.
If as an example, the system timers have a resolution of 10ms and you request to sleep for 11ms, the operating system will be forced to round up in most cases and make your thread sleep for 20ms instead because it is a multiple of the base resolution.
In this case `sf::sleep` sleeps longer than it should.

If however, you requested to sleep for 5ms and that request was made right before the internal operating system timer ticks, it will count as "10ms has passed" to the operating system and it will wake your thread up again although the 5ms have not fully passed.
In this case, `sf::sleep()` would sleep for shorter than it should.

In recent revisions of SFML, the timer resolution is temporarily increased during a call to `sf::sleep()` to increase the likelihood of your sf::sleep call sleeping for the correct amount of time.

One thing to remember is that although the operating system marks your thread as "awake" after it is done sleeping, even for exactly the correct duration, it doesn't mean it resumes execution immediately.
It could have just missed the moment at which the scheduler selects which task to execute next and thus must wait for the next transition.
In this case, although your thread slept for the correct amount, it will appear to you as if it slept for more.
SFML doesn't allow you to sleep for 0 duration, however if you could, you would notice that it in fact takes a slight bit of time as well.
This is because it is common for specifying 0 to the operating system to translate to simply yielding your execution time slice to another thread.

In the end, what this means is that `sf::sleep()` is merely a guideline, and not a contract.
The longer you sleep for, the more accurate it will be.
The shorter you sleep for, the less accurate it will be and to a certain extent more dependent on luck it will become.
