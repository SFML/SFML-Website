---
hide:
  - footer
---

# System

## Does SFML support Unicode? {: #unicode}

Yes. `sf::String` stores text as UTF-32 and can convert from and to UTF-8, UTF-16 and UTF-32.
Text input is provided via the `sf::Event::TextEntered` event as a UTF-32 `char32_t` and can be displayed with `sf::Text`, as long as the font you use contains the glyphs.

Keep in mind that `std::string` and `const char*` are interpreted with the current locale when converted to `sf::String`.
For UTF-8 text, use `sf::String::fromUtf8()` or write the literal as a UTF-32 literal, e.g. `U"Grüezi"`.

## How do I convert from sf::String to <type> and vice-versa? {: #string-convert}

For conversions to `sf::String`, you can just construct the `sf::String` directly from whatever string you already have.

```cpp
sf::String sfmlString(cppString);
```

There are constructors for `std::string`, `std::wstring` and `std::u32string`, as well as the corresponding C strings and characters.
If you want to see what these look like, take a look in the [`sf::String` documentation](../documentation/3.1.0/classsf_1_1String.html).
For UTF-8 or UTF-16 input, use `sf::String::fromUtf8()` and `sf::String::fromUtf16()`.

For conversions from `sf::String`, use the explicit functions:

- `toAnsiString()` for `std::string`, using the current locale
- `toWideString()` for `std::wstring`
- `toUtf8()`, `toUtf16()` and `toUtf32()` for the encoded variants, `toUtf32()` returns a `std::u32string`, which is a lossless copy

The implicit conversions to `std::string` and `std::wstring` still exist, but are deprecated since SFML 3.1.

If you want to convert from or to any other custom string type, it is recommended to first convert to a standard C++ string and from there to `sf::String` or that type.

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

In order to protect against the above scenarios, you will need to make use of mutexes, e.g. `std::mutex` together with `std::scoped_lock`.
SFML 3 removed its own threading classes, so use `std::thread` and the other facilities of the standard library instead.

Even after you have protected against concurrent access, you still need to be wary of the order in which statements are executed.
Once you venture into threading, there is no longer an execution ordering guarantee, and it is ultimately up to you to make sure things are done in the right order across different threads.

Good system designs often make threading optional and provide an option to disable them, whether for debugging or other purposes.

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
