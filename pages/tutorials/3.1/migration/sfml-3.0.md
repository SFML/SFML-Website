# Migration from SFML 3.0 to SFML 3.1

Welcome to SFML 3.1!  
This release brings major improvements to text layout, networking, audio device management, and more.

## Dependencies

We've introduced a bunch of new dependencies to cover all the improvements:

- FetchContent / System Dependency
    - [HarfBuzz](https://github.com/harfbuzz/harfbuzz) for complex text layouts
    - [SheenBidi](https://github.com/Tehreer/SheenBidi) for correct bidirectional text rendering
    - [Mbed TLS](https://github.com/Mbed-TLS/mbedtls) for TLS support
    - [libssh2](https://github.com/libssh2/libssh2) for SFTP support
- Header-only
    - [cpp-unicodelib](https://github.com/yhirose/cpp-unicodelib) for proper Unicode support
    - [wepoll](https://github.com/piscisaureus/wepoll) for an improved SocketSelector
    - [qoi](https://github.com/phoboslab/qoi) to support the QOI image format

## Deprecations

Deprecated functions remain available and fully functional, though you may receive a compiler warning.
It is recommended to migrate to the alternatives described below, as they generally provide noticable improvements.

### Font Kerning

The `sf::Font::getKerning` overload that uses `std::uint32_t` to represent Unicode code points has been deprecated.
Use the overload that takes `char32_t` instead.
The behavior is identical - only the parameter type changes.

v3.0:
```cpp
float kerning = font.getKerning(static_cast<std::uint32_t>('A'),
                                static_cast<std::uint32_t>('V'),
                                30);
```

v3.1:
```cpp
float kerning = font.getKerning(U'A', U'V', 30);
```

### Character Positions in Text

`sf::Text::findCharacterPos(std::size_t index)` has been deprecated in favor of `getShapedGlyphs()`.

The old function returned the global-space position of a single character.
The new function returns the full list of `ShapedGlyph` objects produced during text shaping, giving you access to each glyph's local position, cluster ID, text direction, and baseline in addition to the underlying `sf::Glyph` data.

```cpp
struct ShapedGlyph
{
    Glyph         glyph;         // Glyph data
    Vector2f      position;      // Local position within the text
    std::uint32_t cluster;       // Cluster ID (multiple glyphs may share a cluster)
    TextDirection textDirection; // Direction of the surrounding text run
    float         baseline;      // Baseline Y position of the line this glyph is on
    std::size_t   vertexOffset;  // Starting offset into the vertex buffer
    std::size_t   vertexCount;   // Number of vertices for this glyph
};
```

To migrate, iterate over the shaped glyphs and use the `position` field.

!!! info "Local vs Global Coordinates"

    Note that `getShapedGlyphs()` returns positions in local coordinates, while `findCharacterPos()` returned global coordinates.
    Apply the text's transform yourself if you need global coordinates.

v3.0:
```cpp
// Find the position of the 5th character (global space)
sf::Vector2f pos = text.findCharacterPos(4);
```

v3.1:
```cpp
// Find the position of the glyph belonging to the 5th character (local space)
const auto& glyphs = text.getShapedGlyphs();
if (glyphs.size() > 4)
{
    sf::Vector2f localPos = glyphs[4].position;
    // Convert to global space if needed:
    sf::Vector2f globalPos = text.getTransform().transformPoint(localPos);
}
```

Multiple Unicode code points can form a single grapheme cluster (for example, a base character combined with a combining accent).
When this happens, several consecutive entries in the glyph list will share the same `cluster` value.
If you are implementing a text cursor, treat all glyphs in the same cluster as a single unit.

### Real-Time Touch Input

`sf::Touch::isDown(unsigned int finger)` and both overloads of `sf::Touch::getPosition(unsigned int finger)` have been deprecated.
On Android these functions could crash when queried for a finger that is not currently down; the event-driven approach is always safe.

Use the `position` member of the relevant touch events instead:

| Deprecated function      | Replacement                                                                                      |
|--------------------------|--------------------------------------------------------------------------------------------------|
| `sf::Touch::isDown`      | `sf::Event::TouchBegan` / `sf::Event::TouchEnded`                                                |
| `sf::Touch::getPosition` | `position` field of `sf::Event::TouchBegan`, `sf::Event::TouchMoved`, or `sf::Event::TouchEnded` |

v3.0:
```cpp
if (sf::Touch::isDown(0))
{
    sf::Vector2i pos = sf::Touch::getPosition(0);
    // use pos
}
```

v3.1:
```cpp
// In your event loop:
window.handleEvents([&](const sf::Event::TouchBegan& touch)
{
    if (touch.finger == 0)
    {
        sf::Vector2i pos = touch.position;
        // use pos
    }
},
[&](const sf::Event::TouchMoved& touch)
{
    if (touch.finger == 0)
    {
        sf::Vector2i pos = touch.position;
        // use pos
    }
});
```

### FTP Client

`sf::Ftp` has been deprecated in favor of the new `sf::Sftp` class (see [New Features](#sftp-client) below).
FTP transmits credentials and data in plain text, making SFTP the strongly preferred alternative for any new code.

### Hostname Resolution

`sf::IpAddress::resolve(std::string_view address)` has been deprecated.
It only resolves to IPv4 addresses and lacks control over the DNS servers or timeout.

Use `sf::Dns::resolve()` instead, which supports both IPv4 and IPv6 and gives you full control over the query (see [New Features](#dns-api) below).

v3.0:
```cpp
std::optional<sf::IpAddress> address = sf::IpAddress::resolve("www.sfml-dev.org");
if (address)
{
    // use *address
}
```

v3.1:
```cpp
std::optional<std::vector<sf::IpAddress>> addresses = sf::Dns::resolve("www.sfml-dev.org");
if (addresses && !addresses->empty())
{
    sf::IpAddress address = addresses->front();
    // use address
}
```

---

## New Features

### Runtime Version Query

`sf::version()` returns a `const sf::Version&` describing the SFML library that is loaded at runtime.
This is useful when your application is dynamically linked and you want to verify that the runtime library matches the headers you compiled against.

```cpp
const sf::Version& v = sf::version();
// v.major, v.minor, v.patch - numeric components
// v.isRelease               - false for development builds
// v.string                  - e.g. "3.1.0" or "3.1.0-dev"

if (v.major != SFML_VERSION_MAJOR || v.minor != SFML_VERSION_MINOR)
{
    // Mismatch between compile-time and runtime SFML version
}
```

### Improved Text Layout and Shaping

SFML 3.1 introduces Unicode-aware text shaping powered by HarfBuzz, SheenBidi, and cpp-unicodelib (Unicode 17.0).
This means glyphs are now positioned according to the rules of their script - including ligature substitution, mark attachment, and bidirectional reordering - rather than being placed character-by-character from a simple glyph table lookup.

For most plain ASCII or Latin-script text, the visual result is identical to before.
The improvements become apparent with complex scripts (Arabic, Hebrew, Devanagari, CJK, etc.), ligatures, combined marks, and right-to-left or vertical text.

#### Right-to-Left and Bidirectional Text

SFML 3.1 automatically detects and handles right-to-left (RTL) scripts such as Arabic and Hebrew, as well as mixed bidirectional (BiDi) text that combines LTR and RTL runs in the same string.
No configuration is required: assign a Unicode string and SFML applies the Unicode Bidirectional Algorithm automatically.

```cpp
// Pure RTL - Arabic or Hebrew text renders right-to-left automatically
sf::Text arabicText(font, U"\u0645\u0631\u062d\u0628\u0627", 30); // "مرحبا"

// Mixed BiDi - LTR English and RTL Hebrew in the same string
sf::Text bidiText(font, U"Hello \u05e9\u05dc\u05d5\u05dd World", 30);
```

Each `ShapedGlyph` in the list returned by `getShapedGlyphs()` carries a `textDirection` field that reflects the resolved direction of the run that glyph belongs to:

```cpp
for (const sf::Text::ShapedGlyph& g : text.getShapedGlyphs())
{
    if (g.textDirection == sf::Text::TextDirection::RightToLeft)
    {
        // This glyph belongs to a right-to-left run
    }
}
```

#### Line Alignment

By default, each line is aligned according to the direction of its dominant script: LTR lines are left-aligned and RTL lines are right-aligned.
You can override this with `setLineAlignment()`:

```cpp
// Default: script-direction-aware alignment
text.setLineAlignment(sf::Text::LineAlignment::Default);

// Force all lines to start from the left, regardless of script direction
text.setLineAlignment(sf::Text::LineAlignment::Left);

// Center all lines
text.setLineAlignment(sf::Text::LineAlignment::Center);

// Force all lines to end at the right
text.setLineAlignment(sf::Text::LineAlignment::Right);
```

This is useful for UI layouts where you want consistent visual alignment regardless of content language.

#### Vertical Text Orientation

`setTextOrientation()` switches the layout axis from horizontal to vertical.
This is primarily intended for East Asian scripts (Chinese, Japanese, Korean) whose fonts natively include vertical metrics.

```cpp
// Horizontal layout (default)
text.setTextOrientation(sf::Text::TextOrientation::Default);

// Vertical, top-to-bottom
text.setTextOrientation(sf::Text::TextOrientation::TopToBottom);

// Vertical, bottom-to-top
text.setTextOrientation(sf::Text::TextOrientation::BottomToTop);
```

!!! note "Note"

    When a vertical orientation is selected, advance widths and baseline positions are interpreted along the vertical axis.
    Fonts that do not provide native vertical metrics will use emulated values; the result may not be visually ideal for all scripts.

#### Cluster Grouping

Shaping can merge multiple input code points into a single rendered glyph (ligature) or decompose a single code point into several glyphs (base + mark).
Cluster grouping controls how this many-to-many mapping is exposed through `getShapedGlyphs()`, which matters when you need to relate a glyph back to a position in your input string - for example, to place a text cursor.

```cpp
// Character clusters (default) - good for most cursor-positioning use cases
text.setClusterGrouping(sf::Text::ClusterGrouping::Character);

// Grapheme clusters - groups combining sequences into a single cluster
// (e.g. a base character + combining accent = one cluster)
text.setClusterGrouping(sf::Text::ClusterGrouping::Grapheme);

// No grouping - each shaped glyph gets its own cluster value
text.setClusterGrouping(sf::Text::ClusterGrouping::None);
```

The `cluster` field of each `ShapedGlyph` maps back to an index into the input string.
Multiple consecutive glyphs may share the same `cluster` value when they form an indivisible unit (e.g. a ligature spanning two input characters).
Treat all glyphs with the same cluster value as a single cursor stop.

```cpp
// Walk shaped glyphs and collect the x-position of each unique cluster
// (suitable for building a cursor position table for LTR text)
std::map<std::uint32_t, float> cursorPositions;
for (const sf::Text::ShapedGlyph& g : text.getShapedGlyphs())
{
    cursorPositions.try_emplace(g.cluster, g.position.x);
}
```

#### Per-Glyph Style with `GlyphPreProcessor`

`setGlyphPreProcessor()` installs a callback that is invoked for every glyph during geometry generation.
It lets you override the `style`, `fillColor`, `outlineColor`, and `outlineThickness` on a glyph-by-glyph basis, enabling effects like syntax highlighting without managing multiple `sf::Text` objects.

The callback receives the shaped glyph (including its `cluster` index) and mutable references to the per-glyph rendering properties:

```cpp
// Color a specific word differently using its codepoint index range in the input string
// For input "I like flowers, muffins and waffles."
// "muffins" spans codepoint indices 16–22
text.setGlyphPreProcessor(
    [](const sf::Text::ShapedGlyph& glyph,
       std::uint32_t& /*style*/,
       sf::Color&     fillColor,
       sf::Color&     /*outlineColor*/,
       float&         /*outlineThickness*/)
    {
        if (glyph.cluster >= 16 && glyph.cluster <= 22)
        {
            fillColor = sf::Color::Red;
        }
    });
```

Because shaping may merge adjacent code points into ligatures (e.g. `fl` → `ﬂ`), safe per-word coloring uses the cluster index range rather than a glyph index range.
Any glyphs whose `cluster` falls within the word's codepoint range belong to that word, even if they are ligatures that span the word boundary.

The callback is invoked in geometry-generation order, which is **visual order** (not logical order).
For RTL text this means cluster values decrease as the callback progresses.

!!! warning

    Do not query `getLocalBounds()` from inside the callback; the geometry is still being built at that point.

### TLS / HTTPS Support

`sf::Http` now supports HTTPS.
Pass an `https://` URL to `sf::Http::setHost()` and SFML will establish a TLS-encrypted connection automatically.

```cpp
sf::Http http;
http.setHost("https://www.sfml-dev.org");

sf::Http::Request request("/");
sf::Http::Response response = http.sendRequest(request);
```

To disable server certificate verification (not recommended for production):
```cpp
sf::Http::Response response = http.sendRequest(request, sf::Time::Zero, /* verifyServer */ false);
```

### DNS API

The new `sf::Dns` namespace provides full DNS query support, replacing the deprecated `sf::IpAddress::resolve`.

**Resolve a hostname (A / AAAA records):**
```cpp
#include <SFML/Network/Dns.hpp>

std::optional<std::vector<sf::IpAddress>> addresses = sf::Dns::resolve("www.sfml-dev.org");
if (addresses)
{
    for (const sf::IpAddress& addr : *addresses)
    {
        if (addr.isV4())
            std::cout << "IPv4: " << addr.toString() << '\n';
        else
            std::cout << "IPv6: " << addr.toString() << '\n';
    }
}
```

**Query other record types:**
```cpp
// Name server records
std::vector<sf::String> ns = sf::Dns::queryNs("sfml-dev.org");

// Mail exchange records
std::vector<sf::Dns::MxRecord> mx = sf::Dns::queryMx("sfml-dev.org");
// mx[i].exchange - hostname of the mail server
// mx[i].preference - lower values are preferred

// Service records
std::vector<sf::Dns::SrvRecord> srv = sf::Dns::querySrv("_irc._tcp.sfml-dev.org");
// srv[i].target, srv[i].port, srv[i].weight, srv[i].priority

// Text records
std::vector<std::vector<sf::String>> txt = sf::Dns::queryTxt("sfml-dev.org");
```

**Get the machine's public IP address:**
```cpp
// IPv4
std::optional<sf::IpAddress> pubV4 = sf::Dns::getPublicAddress(sf::seconds(5));

// IPv6
std::optional<sf::IpAddress> pubV6 = sf::Dns::getPublicAddress(sf::seconds(5), sf::IpAddress::Type::IpV6);
```

All `sf::Dns` functions accept an optional list of custom DNS servers and an optional timeout.

### SFTP Client

The new `sf::Sftp` class provides a full SFTP (SSH File Transfer Protocol) client.
It supports both username/password and public-key authentication and replaces the deprecated `sf::Ftp`.

**Connecting and logging in:**
```cpp
#include <SFML/Network/Sftp.hpp>

sf::Sftp sftp;

auto addresses = sf::Dns::resolve("sftp.example.com");
sf::Sftp::Result result = sftp.connect(addresses->front());
if (result.getValue() != sf::Sftp::Result::Value::Ok)
{
    return; // connection failed
}

// Password authentication
result = sftp.login("alice", "hunter2");

// Or public-key authentication
result = sftp.login("alice",
                    std::string_view{publicKey},
                    std::string_view{privateKey},
                    "passphrase");
```

**File operations:**
```cpp
// List a directory
sf::Sftp::ListingResult listing = sftp.getDirectoryListing("/home/alice");
for (const auto& entry : listing.getListing())
{
    std::cout << entry.name << '\n';
}

// Download a file via callback
std::vector<std::uint8_t> buffer;
sftp.download("/home/alice/data.bin",
    [&buffer](const void* data, std::size_t size)
    {
        const auto* bytes = static_cast<const std::uint8_t*>(data);
        buffer.insert(buffer.end(), bytes, bytes + size);
        return true; // return false to abort
    });

// Upload a file via callback
std::string content = "hello, world";
std::size_t offset = 0;
sftp.upload("/home/alice/hello.txt",
    [&content, &offset](void* data, std::size_t& size) -> bool
    {
        std::size_t remaining = content.size() - offset;
        if (remaining == 0)
            return false; // signal end of data
        size = std::min(size, remaining);
        std::memcpy(data, content.data() + offset, size);
        offset += size;
        return true;
    });

// Other operations
sftp.createDirectory("/home/alice/newdir");
sftp.deleteFile("/home/alice/old.txt");
sftp.rename("/home/alice/a.txt", "/home/alice/b.txt");
sftp.disconnect();
```

### `sf::SocketSelector` Callback API

`sf::SocketSelector::add()` now accepts an optional ready callback, enabling a scalable, event-driven design that avoids iterating over every socket after each `wait()` call.
The traditional `isReady()` polling approach continues to work unchanged.

**Traditional approach (still valid):**
```cpp
selector.add(listener);
selector.add(client);

while (selector.wait())
{
    if (selector.isReady(listener))
    {
        // accept new connection
    }
    if (selector.isReady(client))
    {
        // receive from client
    }
}
```

**New callback approach:**
```cpp
selector.add(listener, sf::SocketSelector::Receive, [&](sf::SocketSelector::ReadinessType)
{
    // accept new connection
    auto client = std::make_unique<sf::TcpSocket>();
    listener.accept(*client);
    selector.add(*client, sf::SocketSelector::Receive,
        [c = client.get()](sf::SocketSelector::ReadinessType)
        {
            // receive from client
        });
    clients.push_back(std::move(client));
});

while (selector.wait())
{
    selector.dispatchReadyCallbacks();
}
```

The callback approach only needs to check ready sockets rather than all sockets with the poll approach, which matters when managing many simultaneous connections.

#### `sf::Http::setHost` Return Value

`sf::Http::setHost` now returns `bool` to indicate whether the provided host was resolved and is valid.

v3.0:
```cpp
http.setHost("https://www.sfml-dev.org"); // return value was void
```

v3.1:
```cpp
if (!http.setHost("https://www.sfml-dev.org"))
{
    // host could not be resolved
}
```

#### `sf::Http::sendRequest` Is Now `const`

`sf::Http::sendRequest` is now a `const` member function, allowing HTTP requests to be sent from a `const sf::Http` object or reference.

### Audio Playback Device Sample Rate

`sf::PlaybackDevice::getDeviceSampleRate()` returns the native sample rate of the currently active audio output device.
This can be used to configure audio sources to match the device's preferred rate and avoid unnecessary resampling.

```cpp
if (auto rate = sf::PlaybackDevice::getDeviceSampleRate())
{
    std::cout << "Device sample rate: " << *rate << " Hz\n";
}
else
{
    std::cout << "No playback device available\n";
}
```

### QOI Image Format

SFML 3.1 adds support for the [QOI (Quite OK Image)](https://qoiformat.org/) format.
QOI files can be loaded and saved just like any other supported format.
Detection on load is automatic via the `.qoi` file extension or the file's magic bytes.

```cpp
// Loading
sf::Image image;
if (!image.loadFromFile("texture.qoi"))
{
    return -1;
}

// Saving to file
image.saveToFile("output.qoi");

// Saving to memory
std::optional<std::vector<std::uint8_t>> data = image.saveToMemory("qoi");
```

### `sf::String` Accepts `std::string_view`

`sf::String` now has constructors that accept `std::string_view`, `std::wstring_view`, and `std::u32string_view`.
This removes the need to construct a `std::string` solely for the purpose of passing it to SFML.

```cpp
std::string_view sv = "hello, world";
sf::String s(sv); // no temporary std::string needed
```

### `sf::Vector3u` Type Alias

`sf::Vector3u` has been added as a type alias for `sf::Vector3<unsigned int>`, matching the existing `sf::Vector2u` convention.

```cpp
sf::Vector3u size{800u, 600u, 32u};
```
