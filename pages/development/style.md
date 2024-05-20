# Code Style Guide

- [General](#general)
- [Header files](#header-files)
    - [Include guards](#include-guards)
    - [Includes](#includes)
    - [Class definitions](#class-definitions)
    - [Comments and documentation](#comments-documentation)
- [Syntactical conventions](#syntactical-conventions)
    - [Naming conventions](#naming-conventions)
    - [Indentation, space and quarks](#indentation-space-parenthesis-quarks)
    - [Parenthesis and braces](#parenthesis-braces)
- [Semantics and idioms](#semantics-idioms)
    - [Use of pointers and references](#pointers-references)
    - [Type conversions](#type-conversions)
    - [Namespaces](#namespaces)
    - [Structures and classes](#structures-classes)

## General

C++ source code must be C++03-compliant.

## Header Files

C++ header files have the extension `.hpp` and are structured as follows:

1. License block
2. Opening include guard
3. Included headers
4. Opening namespace `sf`
5. One or more of the following:
    - Class and type definitions
    - Global function declarations
    - Nested namespaces
6. Closing namespace `sf`
7. Closing include guard
8. Extended comment on the class

```cpp
////////////////////////////////////////////////////////////
//
// License text...
//
////////////////////////////////////////////////////////////

#ifndef SFML_FILENAME_HPP
#define SFML_FILENAME_HPP

////////////////////////////////////////////////////////////
// Headers
////////////////////////////////////////////////////////////
#include <...>

namespace sf
{
class ForwardDeclarations;

namespace priv
{
////////////////////////////////////////////////////////////
/// \brief Short description...
///
////////////////////////////////////////////////////////////
class PrivateClass
{
};

} // namespace priv

////////////////////////////////////////////////////////////
/// \brief Short description...
///
////////////////////////////////////////////////////////////
class SFML_..._API PublicClass
{
};

////////////////////////////////////////////////////////////
/// \brief Short description...
///
////////////////////////////////////////////////////////////
SFML_..._API void doSomething();

} // namespace sf

#endif // SFML_FILENAME_HPP

////////////////////////////////////////////////////////////
//
// Extensive Doxygen documentation...
//
////////////////////////////////////////////////////////////
```

### Include Guards

Every header file has a unique include guard. Usually it is based on the filename unless the identifier is already used by another file (with the same name).

**OS X implementation:** There's a difference between `*.hpp` and `*.h` files. The `hpp` extension is used for C++ files and has include guards. The `h` files are Objective-C header files and should not be included in a C++ source file. Those files are "`#import`ed" and thus don't require include guards.

#### Example

For the file `Time.hpp`, the include guard would look like this:

```cpp
#ifndef SFML_TIME_HPP
#define SFML_TIME_HPP
// Code...
#endif // SFML_TIME_HPP
```

### Includes

The inclusion order is as follows:

1. SFML headers
    - Public headers, sorted alphabetically.
    - Private headers, sorted alphabetically.
2. Dependency headers, sorted alphabetically.
3. Standard library headers, sorted alphabetically.

Before the includes, a comment with the label _Headers_ is added.

**OS X implementation:** `#import`s come last. This block of inclusion is separated by an empty line and follows the same three rules.

#### Example

```cpp
////////////////////////////////////////////////////////////
// Headers
////////////////////////////////////////////////////////////
#include <SFML/Graphics.hpp>
#include "Private.hpp"
#include <X11/Xlib-xcb.h>
#include <vector>
```

### Class Definitions

In a class, the public interface comes first (usually with constructors and special member functions at the top), followed by protected members and then private data. In a given access-modifier group, static members are grouped together.

### Comments and Documentation

- Doxygen documentation is used with the backslash style (e.g. `\param`).
- Everything in the public API should be documented properly.
- The brief documentation phrase doesn't end with a dot.
- Documentation tags are grouped together by kind, and groups are separated by an empty line.
- An example below illustrates how the brief and full descriptions, parameters and return values are placed inside a documentation block.
- Single line commenting style only (i.e. `// comment`), i.e. no `/* comment */`.
- Important block comments (e.g. doc) have delimiting lines before and after, each composed of 60 slashes.
- Documentation comments use triple slashes `/// comment` and have an empty line at the end.
- Documentation for attributes or enumeration values use the form `///< comment`. These comments are vertically aligned.
- Header inclusions are preceded by a "Headers" block comment, attributes by "Member data" and typedefs by "Types"
- Class documentation is split into two parts: a first `\brief` comment is placed right before the class definition and more elaborated documentation is placed at the bottom of the header file. The elaborated documentation block is optional for classes which are not exposed to the user (e.g. classes inside the `sf::priv` namespace).

#### Block Comments

```cpp
////////////////////////////////////////////////////////////
// Define the SFML version
////////////////////////////////////////////////////////////
```

#### Documentation Blocks for Functions

```cpp
////////////////////////////////////////////////////////////
/// \brief Check if the request defines a field
///
/// This function uses case-insensitive comparisons.
///
/// \param field Name of the field to test
///
/// \return True if the field exists, false otherwise
///
////////////////////////////////////////////////////////////
```

#### Documentation Blocks for Classes

```cpp
////////////////////////////////////////////////////////////
/// \brief Short description of the class
///
////////////////////////////////////////////////////////////
class Sprite
{
    ...
};

////////////////////////////////////////////////////////////
/// \class Sprite
/// \ingroup graphics
///
/// Detailed description, possibly with code snippets
/// explaining usage
////////////////////////////////////////////////////////////
```

#### Documentation for Enumerations or Attributes

```cpp
Ok       = 200, ///< Most common code returned when operation was successful
Created  = 201, ///< The resource has successfully been created
Accepted = 202, ///< The request has been accepted, but will be processed later by the server
```

## Syntactical Conventions

### Naming Conventions

The following naming conventions are (usually) used:

|Type|Convention|
|---|---|
|file name|PascalCase.hpp, PascalCase.cpp, PascalCase.inl (templates)|
|namespace|PascalCase (except `sf` and `sf::priv`)|
|type (struct, class, union, enum, typedef)|PascalCase|
|function, method|camelCase|
|local, static and global variable|camelCase|
|member variable|m_camelCase|
|enum constant, static const attribute|PascalCase|
|template parameter|PascalCase (preferable single letter like T or N)|
|function-style macro (`glCheck`)|camelCase|
|object-style macro (`SFML_STATIC`)|SFML_UPPER_CASE (prefixed with SFML)|

Note: with `PascalCase`, acronyms like `HTTP` are written `Http`.

### Indentation, Space, Parenthesis and Quarks

#### Tabs vs. Spaces

Tabs should not be used in SFML code. Indentation is produced by spaces only. A tabulator is equal to 4 spaces.

#### Spaces

The rules are as follows:

1. A space precedes an opening parenthesis.
2. A space follows a closing parenthesis.
3. Rules 1. and 2. are not applied for function calls or declarations.
4. A space precedes and follows binary operators and assignment operators.
5. A space follows a comma.
6. There is no space between a type and its reference `&` or pointer `*` specifier.
7. A space follows the `operator` keyword.
8. When colon is used for inheritance or with an access modifier it is surrounded by a space on both sides.
9. There are no extra spaces at the end of lines.

**OS X implementation**: messages are declared without unnecessary spaces; e.g. `-(void)setIconTo:(unsigned int)width by:(unsigned int)height with:(const sf::Uint8*)pixels;`.

#### Declarations

`const` is placed before the type whenever possible. Reference `&` or pointer `*` are glued to the type (no extra space).

```cpp
      T        obj;
const T        cobj;
      T&       ref;
const T&       cref;
      T*       ptr;
const T*       cptr;
      T* const ptrc;
```

#### Lines

1. An extra empty line ends every file.
2. There is only one instruction per line, except for readability in some `switch`es.
3. Every definition (`class`, functions, ...) is followed by an empty line.
4. Braces are placed on new lines by themselves, except for `do ... while` loops.
5. `template` parameters and the rest of the function signature are on two different lines.
6. Every member constructed in the initializer list is on a new line.
7. If a line is too long it is intelligently broken up into a multi-line statement; e.g.:

```cpp
Color operator +(const Color& left, const Color& right)
{
    return Color(Uint8(std::min(int(left.r) + right.r, 255)),
                 Uint8(std::min(int(left.g) + right.g, 255)),
                 Uint8(std::min(int(left.b) + right.b, 255)),
                 Uint8(std::min(int(left.a) + right.a, 255)));
}
```

### Parenthesis and Braces

#### Blocks

Blocks are always indented by one extra level, except for namespaces when there is only one used in the file.

#### `if/else/while` Statements

There are two forms of `if/else` statements: single-line or multi-line body. For an `if` statement that has only one instruction no braces are used. In any case a space always separates the keyword from the parenthesis. Every Brace is alone on the line – even if the `while` body is empty. E.g.:

```cpp
if (audioContext)
    alcDestroyContext(audioContext);
```

```cpp
if (audioContext)
{
    // Set the context as the current one (we'll only need one)
    alcMakeContextCurrent(audioContext);
}
else
{
    err() << "Failed to create the audio context" << std::endl;
}
```

```cpp
while ((nanosleep(&ti, &ti) == -1) && (errno == EINTR))
{
}
```

#### Logical Operators

If multiple `&&` or `||` operators are used in the same boolean expression, then each part is guarded by parenthesis as soon as they consist of multiple sub-expressions themselves.

```cpp
x < y              // no parenthesis
(x < y) && (y < z) // with parenthesis
var && (x < y)     // variable not parenthesized
func() && (x < y)  // function call not parenthesized
```

#### Binary Operators

If different binary operators are combined in the same statement, parenthesis are added _even if not necessary_ to disambiguate the reading; e.g.:

```cpp
output = static_cast<Uint32>(((first - 0xD800) << 10) + (second - 0xDC00) + 0x0010000);
```

## Semantics and Idioms

### Use of Pointers and References

Pointers are used if any of the following conditions are true. In all other situations, references are used.

- `NULL` is a valid value
- the indirection is changed during its lifetime (i.e. the pointer points to something else)
- the pointer refers to manually allocated memory (`new` or other low-level resource)
- an indirection is stored as a member variable

Null pointers are represented with the macro `NULL`.

Pointers that own their memory and require manual memory management (`new` and `delete`) should be avoided, or at least encapsulated. Prefer the use of objects and RAII.

### Type Conversions

Any explicit type conversion is done using the C++ cast operators `static_cast`, `const_cast`, `reinterpret_cast` and `dynamic_cast`. No C-style casts `(int)value` or function-style casts `int(value)` are used.

Booleans and pointers are never explicitly checked against literals.

```cpp
T* ptr = ...;
bool b = ...;

// good:
if (ptr)
if (b)

// bad:
if (ptr != NULL)
if (b == true)
```

In general, type conversions between signed integers, unsigned integers and floating point types (as well as between different types of the same category) are performed explicitly using `static_cast`.

Conversions from numeric types to `bool` happen explicitly (not by casting, but an appropriate condition such as `!= 0`). An exception to this rule are flags and binary operations like `&` or `|`. Explicitly testing for (non-)zero equality should be avoided in such cases.

```cpp
// good:
bool x = var & FLAG;

// bad:
bool x = (var & FLAG) != 0;
```

### Namespaces

The public API lives in the `sf` namespace. The `sf::priv` namespace is reserved for implementation details.

Anonymous namespaces are used when global variables are required, or for functions local to the current translation unit, in order to restrict their access to the translation unit.

No `using` directive should be used. Instead the full name is used everywhere.

### Structures and Classes

`struct`s are used to wrap up one or more variables together but do not use encapsulation; they are generally used by `class`es that do protect their members with `protected` or `private` modifiers. `struct`s can have constructors but should not have methods. They do not use access specifiers or inheritance.

In a class, the public interface comes first (usually with constructors at the top), followed by protected members and then private data. In a given access-modifier group `static` members are grouped together.