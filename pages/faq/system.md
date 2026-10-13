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
