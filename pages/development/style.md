# Code Style Guide

This guide describes the code style of SFML 3. Most of the formatting is handled by [clang-format](#clang-format) and many of the semantic rules are checked by [clang-tidy](#clang-tidy), both run in the continuous integration pipeline, so a pull request that doesn't follow them won't pass the checks.

For everything not covered here, have a look at the existing SFML source code and follow what the surrounding code does.

## clang-format

SFML uses [clang-format](https://clang.llvm.org/docs/ClangFormat.html) to format all its code and the continuous integration pipeline fails if a file isn't formatted.

The formatting rules can be found in the [`.clang-format` file](https://github.com/SFML/SFML/blob/master/.clang-format) in the root of the SFML repository, though it's not necessary to understand all or any of them.
The goal of clang-format is to automate the formatting, so you don't need to tediously format your code by hand.

!!! warning "clang-format 17"

    SFML requires clang-format **17**. Other versions format some constructs differently, which then fails the check in the pipeline, even if your editor formatted the code.

### Installation

clang-format is shipped as part of LLVM and integrated in or available as extension for most popular editors.

- [Download LLVM 17](https://github.com/llvm/llvm-project/releases/tag/llvmorg-17.0.6), on Linux most distributions provide a `clang-format-17` package
- Alternatively, [download only the clang-format 17 binary](https://github.com/SFML/clang-tools/releases/tag/llvmorg-17.0.6) from [SFML/clang-tools](https://github.com/SFML/clang-tools), which republishes `clang-format` and `clang-tidy` from the official LLVM releases, without the 1-2 GB LLVM archive
- Visual Studio has built-in support, set the path to clang-format 17 under _Tools > Options > Text Editor > C/C++ > Code Style > Formatting_
- [Visual Studio Code extension](https://marketplace.visualstudio.com/items?itemName=xaver.clang-format)
- CLion has built-in support

### Usage

Usually the easiest approach is to use your editor's formatting with clang-format, ideally on save.

Alternatively, you can format all files with the `format` target of the SFML build, which calls clang-format on the `examples`, `include`, `src`, `test` and `tools` directories:

```bash
cmake --build build --target format
```

If `clang-format` in your `PATH` isn't version 17, point CMake to the right executable when configuring, e.g. `-DCLANG_FORMAT_EXECUTABLE=clang-format-17`.

The same script can also be run without configuring a build, from the root of the SFML repository:

```bash
cmake -DCLANG_FORMAT_EXECUTABLE=clang-format-17 -P cmake/Format.cmake
```

## clang-tidy

[clang-tidy](https://clang.llvm.org/extra/clang-tidy/) checks the code for bugs, readability and modern C++ usage. The enabled checks can be found in the [`.clang-tidy` file](https://github.com/SFML/SFML/blob/master/.clang-tidy) in the root of the SFML repository. Every warning is treated as an error.

To run it locally, configure SFML with the `dev` preset, which generates the compile commands clang-tidy needs, and build the `tidy` target:

```bash
cmake --preset dev
cmake --build build --target tidy
```

This requires `clang-tidy` and `run-clang-tidy` in your `PATH`, or point CMake to them with `-DCLANG_TIDY_EXECUTABLE=...`.

Keep in mind, that clang-tidy only checks the code that gets compiled on your platform. Platform-specific code for other operating systems is checked by the pipeline.

## General

C++ source code must be C++17-compliant.

## Files

### Header Files

C++ header files have the extension `.hpp`, template implementations go into an `.inl` file with the same name, and source files have the extension `.cpp`. Objective-C++ source files on macOS and iOS have the extension `.mm`.

A header file is structured as follows:

1. License block
2. `#pragma once`
3. Included headers
4. Opening namespace `sf`
5. One or more of the following:
    - Forward declarations
    - Class and type definitions
    - Global function declarations
    - Nested namespaces
6. Closing namespace `sf`
7. Detailed documentation of the class

```cpp
////////////////////////////////////////////////////////////
//
// SFML - Simple and Fast Multimedia Library
// Copyright (C) 2007-2026 Laurent Gomila (laurent@sfml-dev.org)
//
// This software is provided 'as-is', without any express or implied warranty.
// In no event will the authors be held liable for any damages arising from the use of this software.
//
// Permission is granted to anyone to use this software for any purpose,
// including commercial applications, and to alter it and redistribute it freely,
// subject to the following restrictions:
//
// 1. The origin of this software must not be misrepresented;
//    you must not claim that you wrote the original software.
//    If you use this software in a product, an acknowledgment
//    in the product documentation would be appreciated but is not required.
//
// 2. Altered source versions must be plainly marked as such,
//    and must not be misrepresented as being the original software.
//
// 3. This notice may not be removed or altered from any source distribution.
//
////////////////////////////////////////////////////////////

#pragma once

////////////////////////////////////////////////////////////
// Headers
////////////////////////////////////////////////////////////
#include <SFML/Graphics/Export.hpp>

#include <SFML/Graphics/Rect.hpp>

#include <SFML/System/Vector2.hpp>

#include <vector>

#include <cstddef>


namespace sf
{
class Texture;

namespace priv
{
////////////////////////////////////////////////////////////
/// \brief Short description
///
////////////////////////////////////////////////////////////
class PrivateClass
{
};

} // namespace priv

////////////////////////////////////////////////////////////
/// \brief Short description
///
////////////////////////////////////////////////////////////
class SFML_GRAPHICS_API PublicClass
{
};

////////////////////////////////////////////////////////////
/// \brief Short description
///
////////////////////////////////////////////////////////////
SFML_GRAPHICS_API void doSomething();

} // namespace sf


////////////////////////////////////////////////////////////
/// \class sf::PublicClass
/// \ingroup graphics
///
/// Detailed documentation...
///
////////////////////////////////////////////////////////////
```

Every header uses `#pragma once` instead of include guards.

**macOS and iOS implementation:** There's a difference between `.hpp` and `.h` files. The `.hpp` extension is used for C++ headers, which use `#pragma once`. The `.h` files are Objective-C headers and must not be included in a C++ source file. They're `#import`ed and thus don't need `#pragma once`.

### Source Files

A source file starts with the same license block, followed by the included headers and the definitions inside namespace `sf`. Every function definition is preceded by a delimiting line of 60 slashes, and definitions are separated by two empty lines.

```cpp
////////////////////////////////////////////////////////////
// Headers
////////////////////////////////////////////////////////////
#include <SFML/Graphics/RenderTarget.hpp>
#include <SFML/Graphics/Sprite.hpp>
#include <SFML/Graphics/Texture.hpp>

#include <cmath>


namespace sf
{
////////////////////////////////////////////////////////////
void Sprite::setTexture(const Texture& texture, bool resetRect)
{
    // Recompute the texture area if requested
    if (resetRect)
        setTextureRect(IntRect({0, 0}, Vector2i(texture.getSize())));

    // Assign the new texture
    m_texture = &texture;
}


////////////////////////////////////////////////////////////
const Texture& Sprite::getTexture() const
{
    return *m_texture;
}

} // namespace sf
```

### Includes

Headers are always included with angle brackets and their full path, including SFML's private headers, e.g. `#include <SFML/Window/Win32/WindowImplWin32.hpp>`.

The includes are preceded by a _Headers_ block comment and grouped in the following order, with an empty line between the groups:

1. `<SFML/Config.hpp>`
2. The module's `Export.hpp`
3. SFML headers per module, in the order Graphics, Audio, Network, Window, System
4. Third-party headers (e.g. glad, X11, miniaudio)
5. C++ standard library headers
6. C standard library headers (`<cstdint>`, `<cmath>`, ...)

Within a group, headers are sorted alphabetically. You don't have to do this by hand, clang-format sorts and groups the includes.

Include what you use and prefer forward declarations in headers where possible.

**macOS and iOS implementation:** `#import`s are sorted together with the `#include`s of the same group.

### Class Definitions

In a class, the public interface comes first (usually with constructors and special member functions at the top), followed by protected members and then private functions and data. In a given access-modifier group, static members are grouped together. Member variables come last and are preceded by a _Member data_ block comment.

## Comments and Documentation

- Doxygen documentation uses the backslash style (e.g. `\param`).
- Everything in the public API is documented.
- The brief documentation phrase doesn't end with a dot.
- Documentation tags are grouped together by kind, and groups are separated by an empty line.
- Code, identifiers and values in the documentation are put in backticks, e.g. `` `true` `` or `` \see `setTexture` ``.
- Single line comments only (i.e. `// comment`), no `/* comment */`.
- Important block comments (e.g. documentation) have delimiting lines before and after, each composed of 60 slashes.
- Documentation comments use triple slashes `/// comment` and have an empty line at the end.
- Documentation for member variables and enumerators uses the form `//!< comment`. These comments are vertically aligned.
- Header inclusions are preceded by a _Headers_ block comment and member variables by _Member data_.
- Class documentation is split into two parts: a `\brief` comment is placed right before the class definition and the detailed documentation is placed at the bottom of the header file. The detailed documentation is optional for classes which are not exposed to the user (e.g. classes inside the `sf::priv` namespace).

### Block Comments

```cpp
////////////////////////////////////////////////////////////
// Member data
////////////////////////////////////////////////////////////
```

### Documentation Blocks for Functions

```cpp
////////////////////////////////////////////////////////////
/// \brief Check if the request defines a field
///
/// This function uses case-insensitive comparisons.
///
/// \param field Name of the field to test
///
/// \return `true` if the field exists, `false` otherwise
///
////////////////////////////////////////////////////////////
[[nodiscard]] bool hasField(const std::string& field) const;
```

### Documentation Blocks for Classes

```cpp
////////////////////////////////////////////////////////////
/// \brief Drawable representation of a texture, with its
///        own transformations, color, etc.
///
////////////////////////////////////////////////////////////
class SFML_GRAPHICS_API Sprite : public Drawable, public Transformable
{
    ...
};

} // namespace sf


////////////////////////////////////////////////////////////
/// \class sf::Sprite
/// \ingroup graphics
///
/// Detailed description, possibly with code snippets
/// explaining usage
///
/// Usage example:
/// \code
/// const sf::Texture texture("texture.png");
/// sf::Sprite sprite(texture);
/// \endcode
///
/// \see `sf::Texture`, `sf::Transformable`
///
////////////////////////////////////////////////////////////
```

### Documentation for Enumerations and Member Variables

```cpp
enum class Status
{
    Ok       = 200, //!< Most common code returned when operation was successful
    Created  = 201, //!< The resource has successfully been created
    Accepted = 202, //!< The request has been accepted, but will be processed later by the server
};
```

```cpp
////////////////////////////////////////////////////////////
// Member data
////////////////////////////////////////////////////////////
std::array<Vertex, 4> m_vertices;    //!< Vertices defining the sprite's geometry
const Texture*        m_texture;     //!< Texture of the sprite
IntRect               m_textureRect; //!< Rectangle defining the area of the source texture to display
```

## Syntactical Conventions

### Naming Conventions

The following naming conventions are used:

|Type|Convention|
|---|---|
|file name|PascalCase.hpp, PascalCase.cpp, PascalCase.inl (templates)|
|namespace|PascalCase (except `sf` and `sf::priv`)|
|type (struct, class, union, enum, type alias)|PascalCase|
|function, method|camelCase|
|local, static and global variable, parameter|camelCase|
|private and protected member variable|m_camelCase|
|public member variable (e.g. in structs)|camelCase|
|enumerator, static constant|PascalCase|
|template parameter|PascalCase (preferably a single letter like `T` or `N`)|
|function-style macro (`glCheck`)|camelCase|
|object-style macro (`SFML_STATIC`)|SFML_UPPER_CASE (prefixed with SFML)|

Note that with PascalCase, acronyms like `HTTP` are written `Http`.

### Indentation and Line Length

Tabs are not used in SFML code. Indentation is done with 4 spaces.

Lines are at most 120 characters long. Longer lines are broken up by clang-format.

The content of namespaces is not indented.

### Spaces

The rules are as follows:

1. A space separates a control statement keyword (`if`, `for`, `while`, `switch`, ...) from its opening parenthesis.
2. There is no space between a function name and its parenthesis, in calls as well as declarations.
3. A space precedes and follows binary operators and assignment operators.
4. A space follows a comma.
5. There is no space between a type and its reference `&` or pointer `*` specifier.
6. There is no space between the `operator` keyword and the operator, e.g. `operator+`.
7. A space follows the `template` keyword, e.g. `template <typename T>`.
8. When a colon is used for inheritance or a constructor initializer list, it is surrounded by a space on both sides.
9. There are no extra spaces at the end of lines.

**macOS and iOS implementation:** Messages are declared without unnecessary spaces, e.g. `- (void)setIconTo:(unsigned int)width by:(unsigned int)height with:(const std::uint8_t*)pixels;`.

### Declarations

`const` is placed before the type. Reference `&` or pointer `*` are glued to the type (no extra space). Qualifiers are written in the order `static inline constexpr const volatile`.

```cpp
      T        obj;
const T        cobj;
      T&       ref;
const T&       cref;
      T*       ptr;
const T*       cptr;
      T* const ptrc;
```

Consecutive declarations and assignments are aligned.

### Lines

1. Every file ends with a newline.
2. There is only one statement per line.
3. Every definition (`class`, functions, ...) is followed by an empty line.
4. Braces are placed on new lines by themselves, except for `do ... while` loops.
5. `template` parameters and the rest of the declaration are on two different lines.
6. The constructor initializer list is either on the same line as the constructor, or every member is on its own line.
7. If a line is too long, clang-format breaks it up into a multi-line statement, e.g.:

```cpp
constexpr Color operator+(Color left, Color right)
{
    const auto clampedAdd = [](std::uint8_t lhs, std::uint8_t rhs)
    {
        const int intResult = int{lhs} + int{rhs};
        return static_cast<std::uint8_t>(intResult < 255 ? intResult : 255);
    };

    return {clampedAdd(left.r, right.r),
            clampedAdd(left.g, right.g),
            clampedAdd(left.b, right.b),
            clampedAdd(left.a, right.a)};
}
```

### Parenthesis and Braces

#### Blocks

Blocks are always indented by one extra level, except for namespaces.

#### `if/else/while` Statements

There are two forms of `if/else` statements: single-line or multi-line body. For an `if` statement that has only one instruction no braces are used. Every brace is alone on its line, even if the `while` body is empty. E.g.:

```cpp
if (!loadFromFile(filename))
    throw Exception("Failed to open sound buffer from file");
```

```cpp
if (file.openFromFile(filename))
{
    return initialize(file);
}
else
{
    err() << "Failed to open sound buffer from file" << std::endl;
    return false;
}
```

```cpp
while ((nanosleep(&ti, &ti) == -1) && (errno == EINTR))
{
}
```

#### Logical Operators

If multiple `&&` or `||` operators are used in the same boolean expression, then each part is guarded by parenthesis as soon as they consist of multiple sub-expressions themselves.

```cpp
x < y              // no parenthesis
(x < y) && (y < z) // with parenthesis
var && (x < y)     // variable not parenthesized
func() && (x < y)  // function call not parenthesized
```

#### Binary Operators

If different binary operators are combined in the same statement, parenthesis are added _even if not necessary_ to disambiguate the reading, e.g.:

```cpp
output = ((first - 0xD800u) << 10) + (second - 0xDC00) + 0x0010000;
```

## Semantics and Idioms

### Use of Pointers and References

References are used by default. Pointers are used if any of the following conditions are true:

- the indirection is changed during its lifetime (i.e. the pointer points to something else)
- an indirection is stored as a member variable
- `nullptr` is a valid value and `std::optional` doesn't fit

Null pointers are represented with `nullptr`, never with `NULL` or `0`.

Optional values are represented with `std::optional`, e.g. a function that can fail to produce a result returns `std::optional<T>`.

Raw pointers never own memory. Owned objects are held by value or, if needed, by `std::unique_ptr`. Manual `new` and `delete` should be avoided, prefer RAII.

### Type Conversions

Any explicit type conversion is done using the C++ cast operators `static_cast`, `const_cast` and `reinterpret_cast`. No C-style casts `(int)value` or function-style casts `int(value)` are used. Widening conversions that can't lose information can use brace initialization, e.g. `int{lhs}`.

Booleans and pointers are never explicitly checked against literals.

```cpp
T* ptr = ...;
bool b = ...;

// good:
if (ptr)
if (b)

// bad:
if (ptr != nullptr)
if (b == true)
```

In general, type conversions between signed integers, unsigned integers and floating point types (as well as between different types of the same category) are performed explicitly using `static_cast`.

Conversions from numeric types to `bool` happen explicitly (not by casting, but an appropriate condition such as `!= 0`). An exception to this rule are flags and binary operations like `&` or `|`. Explicitly testing for (non-)zero equality should be avoided in such cases.

```cpp
// good:
bool x = var & flag;

// bad:
bool x = (var & flag) != 0;
```

### Types

- Fixed-width integers come from `<cstdint>` and are written with the `std` prefix, e.g. `std::uint8_t` or `std::int64_t`. The same goes for `std::size_t`.
- Enumerations are scoped, i.e. `enum class`.
- Prefer `constexpr` over `const` for compile-time constants, and mark functions `constexpr` where possible.
- `auto` is used where the type is obvious from the right side or irrelevant, e.g. with iterators, lambdas and `std::make_unique`.

### Functions

- Functions that return a value which shouldn't be ignored, such as getters, are marked `[[nodiscard]]`.
- Overridden virtual functions are marked `override` and don't repeat `virtual`.
- Move constructors and move assignment operators are `noexcept`.
- Special member functions that should not be generated are `= delete`d, the ones that are explicitly defaulted are `= default`ed.
- Single-argument constructors are `explicit`, unless an implicit conversion is intended.

### Error Handling

Functions that can fail report errors through `sf::err()` and return `false` or an empty `std::optional`. Constructors that load a resource throw an `sf::Exception` if loading fails.

### Namespaces

The public API lives in the `sf` namespace. The `sf::priv` namespace is reserved for implementation details.

Anonymous namespaces are used for functions and variables local to the current translation unit, in order to restrict their access to that translation unit. They're used instead of `static` free functions.

No `using` directive is used, except for literal namespaces like `std::string_view_literals`. Instead, the full name is used everywhere.

### Structures and Classes

`struct`s are used to group variables together without encapsulation, their members are public and named without `m_` prefix. `struct`s can have constructors and simple helper functions, but no access specifiers.

`class`es protect their data with `private` (or if needed `protected`) members and expose functions to work with them.
