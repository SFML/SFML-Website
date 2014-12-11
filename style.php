<?php
    $breadcrumbs = array
    (
        'Development' => 'development.php',
        'Code Style Guide' => 'style.php'
    );
    include('header.php');
?>

<h1>Code Style Guide</h1>
<p>First of all, the C++ part of SFML should be C++03 compliant.</p>

<h2 id="header-files"><a class="h2-link" href="#header-files">Header Files</a></h2>
<p>C++ header files have the extension <code>.hpp</code> and are structured as follows:</p>
<ol>
 <li>License block</li>
 <li>Opening header guards</li>
 <li>Included headers</li>
 <li>Opening namespace <code>sf</code></li>
 <li>One or more of the following:
  <ul>
   <li>Class and type definitions</li>
   <li>Global function declarations</li>
   <li>Nested namespaces</li>
  </ul>
 </li>
 <li>Closing namespace <code>sf</code></li>
 <li>Closing header guards</li>
 <li>Extended comment on the class</li>
</ol>
<pre><code class="cpp">////////////////////////////////////////////////////////////
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
class ForwardDeclartions;

namespace priv
{
////////////////////////////////////////////////////////////
/// \brief Short description...
///
////////////////////////////////////////////////////////////
class PrivateClass
{
}

} // namespace priv

////////////////////////////////////////////////////////////
/// \brief Short description...
///
////////////////////////////////////////////////////////////
class SFML_..._API PublicClass
{
}

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
////////////////////////////////////////////////////////////</code></pre>

<h3 id="include-guards"><a class="h3-link" href="#include-guards">Include Guards</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>Every header file has a unique include guard. Usually it is based on the filename unless the identifier is already used by another file (with the same name).</p>
<p><strong>OS X implementation:</strong> There's a difference between <code>*.hpp</code> and <code>*.h</code> files. The <code>hpp</code> extension is used for C++ files and has include guards. The <code>h</code> files are Objective-C header files and should not be included in a C++ source file. Those files are "<code>#import</code>ed" and thus don't require include guards.</p>

<h3>Example</h3>
<p>For the file <code>Time.hpp</code>, the include guard would look like this:</p>
<pre><code class="cpp">#ifndef SFML_TIME_HPP
#define SFML_TIME_HPP
// Code...
#endif // SFML_TIME_HPP</code></pre>

<h3 id="includes"><a class="h3-link" href="#includes">Includes</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>The inclusion order is as follows:</p>
<ol>
 <li>SFML headers
  <ul>
   <li>Public headers, sorted alphabetically.</li>
   <li>Private headers, sorted alphabetically.</li>
  </ul>
 </li>
 <li>Dependencies headers, sorted alphabetically.</li>
 <li>Standard library headers, sorted alphabetically.</li>
</ol>
<p>Before the includes, a comment with the label <em>Headers</em> is added.</p>
<p><strong>OS X implementation:</strong> <code>#import</code>s come last. This block of inclusion is separated by an empty line and follows the same three rules.</p>

<h3>Example</h3>
<pre><code class="cpp">////////////////////////////////////////////////////////////
// Headers
////////////////////////////////////////////////////////////
#include <SFML/Graphics.hpp>
#include "Private.hpp"
#include <X11/Xlib-xcb.h>
#include <vector></code></pre>

<h3 id="class-definitions"><a class="h3-link" href="#class-definitions">Class Definitions</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>In a class, the public interface comes first (with usually constructors and special member functions at the top), followed by protected members and then private data. In a given access-modifier group,  static members are grouped together.</p>

<h3 id="comments-documentation"><a class="h3-link" href="#comments-documentation">Comments and Documentation</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<ul>
 <li>Doxygen documentation is used with backslash style (e.g. <code>\param</code>).</li>
 <li>Everything in the public API should be documented properly.</li>
 <li>The brief documentation phrase doesn't end with a dot.</li>
 <li>Documentation tags are grouped together by kind and groups are separated by an empty line.</li>
 <li>An example below illustrates how the brief and full descriptions, parameters and return values are disposed inside a documentation block.</li>
 <li>Single line commenting style only (i.e. <code>// comment</code>), i.e. no <code>/* comment */</code>.</li>
 <li>Important block comment (e.g. doc) have delimiting lines before and after composed of 60 slashes.</li>
 <li>Documentation comment use triple slashes <code>/// comment</code> and have an empty line at the end.</li>
 <li>Documentation for attributes or enumeration values use the form <code>///&lt; comment</code>. These comments are vertically aligned.</li>
 <li>Header inclusions are preceded by a "Headers" block comment, attributes by "Member data" and typedefs by "Types"</li>
 <li>Classes documentation are split in two modules: a first <code>\brief</code> comment is placed right before the class definition and a more elaborated documentation is placed at the bottom of the header file. This second block is optional for classes not exposed to the user (e.g. classes inside <code>sf::priv</code> namespace).</li>
</ul>

<h3>Examples</h3>

<h4>Block Comments</h4>
<pre><code class="cpp">////////////////////////////////////////////////////////////
// Define the SFML version
////////////////////////////////////////////////////////////</code></pre>

<h4>Documentation Blocks for Functions</h4>
<pre><code class="cpp">////////////////////////////////////////////////////////////
/// \brief Check if the request defines a field
///
/// This function uses case-insensitive comparisons.
///
/// \param field Name of the field to test
///
/// \return True if the field exists, false otherwise
///
////////////////////////////////////////////////////////////</code></pre>

<h4>Documentation Blocks for Classes</h4>
<pre><code class="cpp">////////////////////////////////////////////////////////////
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
////////////////////////////////////////////////////////////</code></pre>

<h4>Documentation for Enumerations or Attributes</h4>
<pre><code class="cpp">cpp
Ok       = 200, ///&lt; Most common code returned when operation was successful
Created  = 201, ///&lt; The resource has successfully been created
Accepted = 202, ///&lt; The request has been accepted, but will be processed later by the server</code></pre>

 <h2 id="syntactical-conventions"><a class="h2-link" href="#syntactical-conventions">Syntactical Conventions</a></h2>

<h3 id="naming-conventions"><a class="h3-link" href="#naming-conventions">Naming Conventions</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>The following naming conventions are (usually) used:</p>
<table>
 <thead>
  <tr>
   <th>Type</td>
   <th>Convention</td>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td></td><td></td>
  </tr>
  <tr>
   <td>file name</td>
   <td>PascalCase.hpp, PascalCase.cpp, PascalCase.inl (templates)</td>
  </tr>
  <tr>
   <td>namespace</td>
   <td>PascalCase (except <code>sf</code> and <code>sf::priv</code>)</td>
  </tr>
  <tr>
   <td>type (struct, class, union, enum, typedef)</td>
   <td>PascalCase</td>
  </tr>
  <tr>
   <td>function, method</td>
   <td>camelCase</td>
  </tr>
  <tr>
   <td>local, static and global variable</td>
   <td>camelCase</td>
  </tr>
  <tr>
   <td>member variable</td>
   <td>m_camelCase</td>
  </tr>
  <tr>
   <td>enum constant, static const attribute</td>
   <td>PascalCase</td>
  </tr>
  <tr>
   <td>template parameter</td>
   <td>PascalCase (preferable single letter like T or N)</td>
  </tr>
  <tr>
   <td>function-style macro (<code>glCheck</code>)</td>
   <td>camelCase</td>
  </tr>
  <tr>
   <td>object-style macro (<code>SFML_STATIC</code>)</td>
   <td>SFML UPPER_CASE (prefixed with SFML)</td>
  </tr>
 </tbody>
</table>
<p>Note: with <code>PascalCase</code>, acronyms like <code>HTTP</code> are written <code>Http</code>.</p>

<h3 id="indentation-space-parenthesis-quarks"><a class="h3-link" href="#indentation-space-parenthesis-quarks">Indentation, Space, Parenthesis and Quarks</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>

<h3>Tabs vs. Spaces</h3>
<p>No tab should be used in SFML code. Indentation is managed by spaces only. A tabulator is equal to 4 spaces.</p>

<h3>Spaces</h3>
<p>The rules are as follows:</p>
<ol>
 <li>A space precedes an open parenthesis.</li>
 <li>A space follows an close parenthesis.</li>
 <li>Rules 1. et 2. are not applied for function calls or declarations.</li>
 <li>A space precedes and follow binary operators or assignment operators.</li>
 <li>A space follows a comma.</li>
 <li>There is no space between a type and its reference <code>&amp;</code> or pointer <code>*</code> specifier.</li>
 <li>A space follows the <code>operator</code> keyword.</li>
 <li>When colon is used for inheritance or with an access modifier it is surrounded by spaces.</li>
 <li>There is no extra space at the end of the line.</li>
</ol>
<p><strong>OS X implementation</strong>: messages are declared without unnecessary spaces; e.g. <code>-(void)setIconTo:(unsigned int)width by:(unsigned int)height with:(const sf::Uint8*)pixels;</code>.</p>

<h4>Declarations</h4>
<p><code>const</code> is placed before the type whenever possible. Reference <code>&amp;</code> or pointer <code>*</code> are glued to the type (no extra space).</p>
<pre><code class="cpp">      T        obj;
const T        cobj;
      T&amp;       ref;
const T&amp;       cref;
      T*       ptr;
const T*       cptr;
      T* const ptrc;</code></pre>

<h3>Lines</h3>
<ol>
 <li>An extra empty line ends every file.</li>
 <li>There is only one instruction per line, except for readability in some <code>switch</code>es.</li>
 <li>Every definition (<code>class</code>, functions, ...) is followed by an empty line.</li>
 <li>Braces are on new lines alone, except for <code>do ... while</code> loops.</li>
 <li><code>template</code> parameters and the rest of the function signature are on two different lines.</li>
 <li>Every member constructed in the initializer list is on a new line.</li>
 <li>If a line is too long it is intelligently break up into a multi-line statement; e.g.:</li>
</ol>
<pre><code class="cpp">Color operator +(const Color&amp; left, const Color&amp; right)
{
    return Color(Uint8(std::min(int(left.r) + right.r, 255)),
                 Uint8(std::min(int(left.g) + right.g, 255)),
                 Uint8(std::min(int(left.b) + right.b, 255)),
                 Uint8(std::min(int(left.a) + right.a, 255)));
}</code></pre>

<h3>Parenthesis and Braces</h3>

<h4>Blocks</h4>
<p>Blocks are always indented by one extra level, except for namespaces when there is only one used in the file.</p>

<h4><code>if/else/while</code> Statements</h4>
<p>There are two forms of <code>if/else</code> statements: one-line or multi-line body. For an <code>if</code> statement that has only one instruction no braces are used. In any case a space always separates the keyword from the parenthesis. Every Brace is alone on the line – even if the <code>while</code> body is empty. E.g.:</p>
<pre><code class="cpp">if (audioContext)
    alcDestroyContext(audioContext);</code></pre>
<pre><code class="cpp">if (audioContext)
{
    // Set the context as the current one (we'll only need one)
    alcMakeContextCurrent(audioContext);
}
else
{
    err() &lt;&lt; "Failed to create the audio context" &lt;&lt; std::endl;
}</code></pre>
<pre><code class="cpp">while ((nanosleep(&amp;ti, &amp;ti) == -1) &amp;&amp; (errno == EINTR))
{
}</code></pre>

<h4>Logical Operators</h4>
<p>If multiple <code>&amp;&amp;</code> or <code>||</code> operators are used in the same boolean expression, then each part is guarded by parenthesis, as soon as it consists of multiple sub-expressions itself.</p>
<pre><code class="cpp">x &lt; y              // no parenthesis
(x &lt; y) &amp;&amp; (y &lt; z) // with parenthesis
var &amp;&amp; (x &lt; y);    // variable not parenthesized
func() &amp;&amp; (x &lt; y); // function call not parenthesized</code></pre>

<h4>Binary Operators</h4>
<p>If different binary operators are combined in the same statement, parenthesis are added <em>even if not necessary</em> to disambiguate the reading; e.g.:</p>
<pre><code class="cpp">output = static_cast&lt;Uint32&gt;(((first - 0xD800) &lt;&lt; 10) + (second - 0xDC00) + 0x0010000);</code></pre>

<h2 id="semantics-idioms"><a class="h2-link" href="#semantics-idioms">Semantics and Idioms</a></h2>

<h3 id="pointers-references"><a class="h3-link" href="#pointers-references">Use of Pointers and References</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>Pointers are used if either of the following conditions is true. In all other situations, references are used.</p>
<ul>
 <li><code>NULL</code> is a valid value</li>
 <li>the indirection is changed during its lifetime (i.e. the pointer points to something else)</li>
 <li>the pointer refers to manually allocated memory (<code>new</code> or other low-level resource)</li>
 <li>an indirection is stored as a member variable</li>
</ul>
<p>Null pointers are represented with the macro <code>NULL</code>.</p>
<p>Pointers that own their memory and require manual memory management (<code>new</code> and <code>delete</code>) should be avoided, or at least encapsulated. Prefer the use of objects and RAII.</p>

<h3 id="type-conversions"><a class="h3-link" href="#type-conversions">Type Conversions</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>Any explicit type conversion is done using the C++ cast operators <code>static_cast</code>, <code>const_cast</code>, <code>reinterpret_cast</code> and <code>dynamic_cast</code>. No C-style casts <code>(int)value</code> or function-style casts <code>int(value)</code> are used.</p>
<p>Booleans and pointers are never explicitly checked against literals.</p>
<pre><code class="cpp">T* ptr = ...;
bool b = ...;

// good:
if (ptr)
if (b)

// bad:
if (ptr != NULL)
if (b == true)</code></pre>
<p>In general, type conversions between signed integers, unsigned integers and floating point types (as well as between different types of the same category) are performed explicitly using <code>static_cast</code>.</p>
<p>Conversions from numeric types to <code>bool</code> happen explicitly (not by casting, but an appropriate condition such as <code>!= 0</code>). An exception to this rule are flags and binary operations like <code>&amp;</code> or <code>|</code>. Explicitly testing for (non-)zero equality should be avoided in such cases.</p>
<pre><code class="cpp">// good:
bool x = var & FLAG;

// bad:
bool x = (var & FLAG) != 0;</code></pre>

<h3 id="namespaces"><a class="h3-link" href="#namespaces">Namespaces</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p>The public API lives in the <code>sf</code> namespace. The <code>sf::priv</code> namespace is reserved for implementation details.</p>
<p>Anonymous namespace are used when global variables are needed, or for function only needed in the current source file, in order to restrict their access to a specific compilation unit.</p>
<p>No <code>using</code> directive should be used. Instead the full name is used everywhere.</p>

<h3 id="structures-classes"><a class="h3-link" href="#structures-classes">Structures and Classes</a><a class="back-to-top" href="#top" title="Top of the page"></a></h3>
<p><code>struct</code>s are used to wrap up one or more variables together but do not use encapsulation; they are generally used by <code>class</code>es that do protect their members with <code>protected</code> or <code>private</code> modifiers. <code>struct</code>s can have constructors but should not have methods. They do not use access specifiers or inheritance.</p>
<p>In a class, the public interface comes first (with usually constructors at the top), followed by protected members and then private data. In a given access-modifier group <code>static</code> members are grouped together.</p>
 
<?php
    require("footer.php");
?>
