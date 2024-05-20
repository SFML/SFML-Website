# Changelog

- [SFML 2.6.1](#sfml-2.6.1)
- [SFML 2.6.0](#sfml-2.6.0)
- [SFML 2.5.1](#sfml-2.5.1)
- [SFML 2.5.0](#sfml-2.5.0)
- [SFML 2.4.2](#sfml-2.4.2)
- [SFML 2.4.1](#sfml-2.4.1)
- [SFML 2.4.0](#sfml-2.4.0)
- [SFML 2.3.2](#sfml-2.3.2)
- [SFML 2.3.1](#sfml-2.3.1)
- [SFML 2.3](#sfml-2.3)
- [SFML 2.2](#sfml-2.2)
- [SFML 2.1](#sfml-2.1)
- [SFML 2.0](#sfml-2.0)
- [SFML 1.6](#sfml-1.6)
- [SFML 1.5](#sfml-1.5)
- [SFML 1.4](#sfml-1.4)
- [SFML 1.3](#sfml-1.3)
- [SFML 1.2](#sfml-1.2)
- [SFML 1.1](#sfml-1.1)

## SFML 2.6.1 {: #sfml-2.6.1}

### General {: #2.6.1-general}

- Stop overwriting CMAKE_MODULE_PATH ([#2577](https://github.com/SFML/SFML/pull/2577))
- Loosen restrictions on unknown compilers ([#2585](https://github.com/SFML/SFML/pull/2585))
- Fix CI deprecation warnings ([#2624](https://github.com/SFML/SFML/pull/2624))
- Fix unused compiler flag error in Clang ([#2625](https://github.com/SFML/SFML/pull/2625))
- Disable warnings as errors by default ([#2680](https://github.com/SFML/SFML/pull/2680))

### Window {: #2.6.1-window}

#### Bugfixes

- Fix macOS resize event bug ([#2618](https://github.com/SFML/SFML/pull/2618))
- Skip ClientMessage events with other window ID unless it is for IM ([#2651](https://github.com/SFML/SFML/pull/2651))

### Graphics {: #2.6.1-graphics}

#### Bugfixes

- Ensure OpenGL extensions are loaded before querying maximum texture size ([#2603](https://github.com/SFML/SFML/pull/2603))
- Fixed RenderTexture being upside down on Android ([#2730](https://github.com/SFML/SFML/pull/2730))
- Fix warnings in Linux OpenGL ES codepaths ([#2747](https://github.com/SFML/SFML/pull/2747))

### Audio {: #2.6.1-audio}

#### Bugfixes

- Remove use of C++11 header ([#2591](https://github.com/SFML/SFML/pull/2591))

## SFML 2.6.0 {: #sfml-2.6.0}

### General {: #2.6.0-general}

- Various CMake enhancements ([#1477](https://github.com/SFML/SFML/pull/1477), [#1509](https://github.com/SFML/SFML/pull/1509), [#1561](https://github.com/SFML/SFML/pull/1561), [#1563](https://github.com/SFML/SFML/pull/1563), [#1576](https://github.com/SFML/SFML/pull/1576), [#1624](https://github.com/SFML/SFML/pull/1624), [#1739](https://github.com/SFML/SFML/pull/1739), [#1960](https://github.com/SFML/SFML/pull/1960))
- Small documentation changes ([#1519](https://github.com/SFML/SFML/pull/1519), [#1608](https://github.com/SFML/SFML/pull/1608), [#1628](https://github.com/SFML/SFML/pull/1628), [#1657](https://github.com/SFML/SFML/pull/1657), [#1658](https://github.com/SFML/SFML/pull/1658), [#1652](https://github.com/SFML/SFML/pull/1652), [#1665](https://github.com/SFML/SFML/pull/1665), [#1697](https://github.com/SFML/SFML/pull/1697), [#1774](https://github.com/SFML/SFML/pull/1774), [#1776](https://github.com/SFML/SFML/pull/1776), [#1853](https://github.com/SFML/SFML/pull/1853), [#2038](https://github.com/SFML/SFML/pull/2038), [#2083](https://github.com/SFML/SFML/pull/2083), [#2271](https://github.com/SFML/SFML/pull/2271))
- Various casting fixes ([#1499](https://github.com/SFML/SFML/pull/1499), [#1553](https://github.com/SFML/SFML/pull/1553), [#2040](https://github.com/SFML/SFML/pull/2040), [#2222](https://github.com/SFML/SFML/pull/2222), [#2297](https://github.com/SFML/SFML/pull/2297), [#2298](https://github.com/SFML/SFML/pull/2298), [#2323](https://github.com/SFML/SFML/pull/2323), [#2576](https://github.com/SFML/SFML/pull/2576))
- Add unit testing foundation to SFML ([#623](https://github.com/SFML/SFML/pull/623), [#1475](https://github.com/SFML/SFML/pull/1475))
- Changed Doxygen single-line comment format ([#1622](https://github.com/SFML/SFML/pull/1622), [#1623](https://github.com/SFML/SFML/pull/1623))
- Add support for GitHub Actions ([#1716](https://github.com/SFML/SFML/pull/1716), [#1751](https://github.com/SFML/SFML/pull/1751), [#2058](https://github.com/SFML/SFML/pull/2058), [#2114](https://github.com/SFML/SFML/pull/2114))
- Add support for NetBSD ([#1535](https://github.com/SFML/SFML/pull/1535), [#1723](https://github.com/SFML/SFML/pull/1723))
- Slight increase performance and code refactor ([#1732](https://github.com/SFML/SFML/pull/1732))
- Use public domain resources for examples ([#1627](https://github.com/SFML/SFML/pull/1627), [#1718](https://github.com/SFML/SFML/pull/1718))
- Add support for CPack and NSIS with CPack ([#1114](https://github.com/SFML/SFML/pull/1114))
- Enable support for unity builds ([#1787](https://github.com/SFML/SFML/pull/1787), [#1788](https://github.com/SFML/SFML/pull/1788))
- Various clean ups ([#1848](https://github.com/SFML/SFML/pull/1848), [#1849](https://github.com/SFML/SFML/pull/1849), [#2219](https://github.com/SFML/SFML/pull/2219), [#2220](https://github.com/SFML/SFML/pull/2220), [#2221](https://github.com/SFML/SFML/pull/2221), [#2241](https://github.com/SFML/SFML/pull/2241))
- Enable and enforce a large set of warnings ([#1785](https://github.com/SFML/SFML/pull/1785), [#1791](https://github.com/SFML/SFML/pull/1791), [#1846](https://github.com/SFML/SFML/pull/1846), [#1906](https://github.com/SFML/SFML/pull/1906), [#1908](https://github.com/SFML/SFML/pull/1908), [#2048](https://github.com/SFML/SFML/pull/2048), [#2066](https://github.com/SFML/SFML/pull/2066), [#2073](https://github.com/SFML/SFML/pull/2073), [#2094](https://github.com/SFML/SFML/pull/2094), [#2100](https://github.com/SFML/SFML/pull/2100), [#2106](https://github.com/SFML/SFML/pull/2106), [#2142](https://github.com/SFML/SFML/pull/2142), [#2217](https://github.com/SFML/SFML/pull/2217), [#2218](https://github.com/SFML/SFML/pull/2218))
- Enable search box for the Doxygen documentation ([#1841](https://github.com/SFML/SFML/pull/1841), [#1940](https://github.com/SFML/SFML/pull/1940), [#2173](https://github.com/SFML/SFML/pull/2173), [#2477](https://github.com/SFML/SFML/pull/2477))
- Enhancements of the CI pipeline ([#2046](https://github.com/SFML/SFML/pull/2046), [#2263](https://github.com/SFML/SFML/pull/2263), [#2294](https://github.com/SFML/SFML/pull/2294))
- Fix header include paths in Doxygen documentation ([#2512](https://github.com/SFML/SFML/pull/2512))
- Fix compilation for GCC 13.1.1 ([#2553](https://github.com/SFML/SFML/pull/2553))
- [macOS] Add support for arm64 on macOS ([#1749](https://github.com/SFML/SFML/pull/1749), [#1750](https://github.com/SFML/SFML/pull/1750), [#1761](https://github.com/SFML/SFML/pull/1761), [#1843](https://github.com/SFML/SFML/pull/1843), [#1868](https://github.com/SFML/SFML/pull/1868))
- [iOS] Build examples for iOS as well ([#1418](https://github.com/SFML/SFML/pull/1418), [#1520](https://github.com/SFML/SFML/pull/1520), [#1522](https://github.com/SFML/SFML/pull/1522))
- [Windows] Properly support Clang on Windows ([#1612](https://github.com/SFML/SFML/pull/1612), [#1720](https://github.com/SFML/SFML/pull/1720), [#1784](https://github.com/SFML/SFML/pull/1784), [#1795](https://github.com/SFML/SFML/pull/1795))
- [Windows] Link legacy stdio definitions on newer Visual Studio versions ([#1712](https://github.com/SFML/SFML/pull/1712))
- [Windows] Provide additional metadata through resource files ([#1419](https://github.com/SFML/SFML/pull/1419), [#1779](https://github.com/SFML/SFML/pull/1779))
- [Android] Add 64-bits libraries for Android ([#1648](https://github.com/SFML/SFML/pull/1648), [#2165](https://github.com/SFML/SFML/pull/2165))
- [Android] Adjust NDK search path to support newer NDKs ([#1575](https://github.com/SFML/SFML/pull/1575))
- [macOS] Copy logo.png to Resources in Cocoa example ([#1818](https://github.com/SFML/SFML/pull/1818))
- [Windows] Add support for Visual Studio 2022 ([#1819](https://github.com/SFML/SFML/pull/1819))
- [Android] Build sfml-main with position-independent code ([#2393](https://github.com/SFML/SFML/pull/2393), [#2397](https://github.com/SFML/SFML/pull/2397))

### System {: #2.6.0-system}

#### Features

- [Android] Simplify management of ActivityStates ([#1845](https://github.com/SFML/SFML/pull/1845))

#### Bugfixes

- [Windows] Fix overflow when using sf::Clock for long time ([#1765](https://github.com/SFML/SFML/pull/1765), [#1771](https://github.com/SFML/SFML/pull/1771))

### Window {: #2.6.0-window}

#### Features

- Allow creation of a window without an OpenGL context ([#1484](https://github.com/SFML/SFML/pull/1484))
- Dynamically load EGL and GLES extensions as is done for desktop GL ([#1539](https://github.com/SFML/SFML/pull/1539), [#1577](https://github.com/SFML/SFML/pull/1577), [#1603](https://github.com/SFML/SFML/pull/1603), [#2157](https://github.com/SFML/SFML/pull/2157), [#2160](https://github.com/SFML/SFML/pull/2160))
- Add support for creating Vulkan window surfaces ([#1557](https://github.com/SFML/SFML/pull/1557))
- Scancode support ([#1235](https://github.com/SFML/SFML/pull/1235), [#1400](https://github.com/SFML/SFML/pull/1400), [#1596](https://github.com/SFML/SFML/pull/1596), [#2009](https://github.com/SFML/SFML/pull/2009), [#2096](https://github.com/SFML/SFML/pull/2096), [#2148](https://github.com/SFML/SFML/pull/2148), [#2243](https://github.com/SFML/SFML/pull/2243))
- [Linux] Add support for colored cursors in Unix implementation ([#1693](https://github.com/SFML/SFML/pull/1693), [#1694](https://github.com/SFML/SFML/pull/1694))
- [Linux] Added support for directional arrow resize cursors on Linux ([#1688](https://github.com/SFML/SFML/pull/1688))
- [Linux] Add support for X Input Method ([#1840](https://github.com/SFML/SFML/pull/1840), [#1850](https://github.com/SFML/SFML/pull/1850), [#2191](https://github.com/SFML/SFML/pull/2191), [#2242](https://github.com/SFML/SFML/pull/2242))
- [Linux] Add support for Direct Rendering Mode (DRM) / Kernel Mode Setting (KMS) ([#2029](https://github.com/SFML/SFML/pull/2029), [#2146](https://github.com/SFML/SFML/pull/2146), [#2246](https://github.com/SFML/SFML/pull/2246), [#2259](https://github.com/SFML/SFML/pull/2259), [#2400](https://github.com/SFML/SFML/pull/2400))
- [Windows] Use monitor aware DPI scaling on Windows ([#2268](https://github.com/SFML/SFML/pull/2268))

#### Bugfixes

- Fix sf::Context::getActiveContext to stop returning inactive contexts ([#1794](https://github.com/SFML/SFML/pull/1794))
- [Linux] Fixed crash with X11 when $DISPLAY is not 0.0 ([#724](https://github.com/SFML/SFML/pull/724), [#1504](https://github.com/SFML/SFML/pull/1504))
- [Android] Ensure setActive(false) is called before the surface is destroyed in EglContext ([#1530](https://github.com/SFML/SFML/pull/1530), [#1531](https://github.com/SFML/SFML/pull/1531))
- [Android] Fixed EGL incorrectly being passed the anti-aliasing level as EGL_SAMPLE_BUFFERS instead of EGL_SAMPLES ([#1533](https://github.com/SFML/SFML/pull/1533), [#1534](https://github.com/SFML/SFML/pull/1534))
- [Linux] Fix OpenGL extensions not loading in a specific Linux VM configuration ([#1495](https://github.com/SFML/SFML/pull/1495), [#1543](https://github.com/SFML/SFML/pull/1543))
- [Windows] Fixed potential buffer overrun in Win32 OpenGL error handling ([#1245](https://github.com/SFML/SFML/pull/1245), [#1246](https://github.com/SFML/SFML/pull/1246))
- [Windows] Fix no longer hides cursor when hovering title bar ([#1569](https://github.com/SFML/SFML/pull/1569), [#1570](https://github.com/SFML/SFML/pull/1570))
- [macOS] Initialize m_context correctly in SFContext constructors ([#1582](https://github.com/SFML/SFML/pull/1582), [#1610](https://github.com/SFML/SFML/pull/1610))
- [Android] Fixed navigation bar not being entirely hidden on Android ([#1538](https://github.com/SFML/SFML/pull/1538), [#1554](https://github.com/SFML/SFML/pull/1554))
- [Windows] Make the process to set a DirectInput device's axis mode more conservative ([#1634](https://github.com/SFML/SFML/pull/1634))
- [Linux] Fix an issue where the cursor wasn't changed instantaneously ([#1686](https://github.com/SFML/SFML/pull/1686))
- [Windows] Fix issue where joystick/controller POV values were not set correctly for DirectInput devices ([#1719](https://github.com/SFML/SFML/pull/1719))
- [Android] Fix warning: control may reach end of non-void function ([#1713](https://github.com/SFML/SFML/pull/1713))
- [Windows] Fixed Win32 requestFocus in multi-threaded environment ([#1600](https://github.com/SFML/SFML/pull/1600))
- [Android] Fix issue where EGL_DEFAULT_DISPLAY is NULL ([#1639](https://github.com/SFML/SFML/pull/1639), [#1740](https://github.com/SFML/SFML/pull/1740))
- [macOS] When initializing an OpenGL view with an existing window, call finishInit ([#1759](https://github.com/SFML/SFML/pull/1759), [#1760](https://github.com/SFML/SFML/pull/1760))
- [macOS] Fix potential crash when changing cursor ([#1721](https://github.com/SFML/SFML/pull/1721), [#1736](https://github.com/SFML/SFML/pull/1736))
- [Android] Fixed SIGSEGV after pressing back button on Android ([#531](https://github.com/SFML/SFML/pull/531), [#1580](https://github.com/SFML/SFML/pull/1580))
- [Android] Fix issue with waitEvent and an OpenGL Context ([#1532](https://github.com/SFML/SFML/pull/1532), [#1790](https://github.com/SFML/SFML/pull/1790))
- [iOS] Fix issue where OpenGL ES libraries couldn't be located ([#1687](https://github.com/SFML/SFML/pull/1687), [#1804](https://github.com/SFML/SFML/pull/1804))
- [macOS] Fix issue where window wouldn't be closing because of events still being processed ([#1581](https://github.com/SFML/SFML/pull/1581), [#1814](https://github.com/SFML/SFML/pull/1814))
- [Windows] Preserve the drop shadow for system cursors on Windows ([#1731](https://github.com/SFML/SFML/pull/1731))
- [Windows] Use GetWindowLongPtr for better overall compatibility ([#1806](https://github.com/SFML/SFML/pull/1806))
- [macOS] Ensure proper nesting of autorelease pools on OS X ([#1549](https://github.com/SFML/SFML/pull/1549), [#1820](https://github.com/SFML/SFML/pull/1820))
- [Linux] Fix typo in window construction ([#1951](https://github.com/SFML/SFML/pull/1951), [#1953](https://github.com/SFML/SFML/pull/1953))
- [Linux] Prevent crash in Unix JoystickImpl with too many file descriptors ([#1900](https://github.com/SFML/SFML/pull/1900), [#1941](https://github.com/SFML/SFML/pull/1941))

### Graphics {: #2.6.0-graphics}

#### Features

- Allow re-creation of the shared context as a core context if the user requests a core profile context ([#1434](https://github.com/SFML/SFML/pull/1434), [#1443](https://github.com/SFML/SFML/pull/1443))
- Added getPosition() and getSize() to sf::Rect ([#1047](https://github.com/SFML/SFML/pull/1047))
- Added Font::hasGlyph field ([#1644](https://github.com/SFML/SFML/pull/1644))
- Implemented saveToMemory and saveImageToMemory ([#988](https://github.com/SFML/SFML/pull/988), [#1597](https://github.com/SFML/SFML/pull/1597), [#1669](https://github.com/SFML/SFML/pull/1669))
- Implement smoothing for fonts ([#1690](https://github.com/SFML/SFML/pull/1690), [#2064](https://github.com/SFML/SFML/pull/2064), [#2072](https://github.com/SFML/SFML/pull/2072))
- Add Min and Max blend modes ([#1710](https://github.com/SFML/SFML/pull/1710), [#1756](https://github.com/SFML/SFML/pull/1756))
- Support geometry shaders when a OpenGL 3.2+ context is available ([#1768](https://github.com/SFML/SFML/pull/1768), [#1769](https://github.com/SFML/SFML/pull/1769), [#1786](https://github.com/SFML/SFML/pull/1786), [#1789](https://github.com/SFML/SFML/pull/1789))
- Align encodings for new line characters ([#2107](https://github.com/SFML/SFML/pull/2107))
- Update stb_image to 2.28, thus adding support for more image formats ([#1712](https://github.com/SFML/SFML/pull/1712), [#2322](https://github.com/SFML/SFML/pull/2322), [#2464](https://github.com/SFML/SFML/pull/2464))
- [macOS] Improve high DPI handling on macOS ([#1817](https://github.com/SFML/SFML/pull/1817))

#### Bugfixes

- Fixed missing checks for empty vertex arrays when updating the vertex buffers in sf::Text ([#1558](https://github.com/SFML/SFML/pull/1558), [#1560](https://github.com/SFML/SFML/pull/1560))
- Remove unnecessary glFlush() in sf::Texture ([#1609](https://github.com/SFML/SFML/pull/1609))
- Fixed text rendering artifacts on Radeon cards ([#1568](https://github.com/SFML/SFML/pull/1568))
- Force OpenGL states to be reset when RenderTarget detects that a new context has to be tracked ([#1625](https://github.com/SFML/SFML/pull/1625), [#1630](https://github.com/SFML/SFML/pull/1630))
- Don't set default Texture Rect of a sf::Sprite before the user provided one ([#1725](https://github.com/SFML/SFML/pull/1725))
- Added auto hinting compensation to fix too wide gaps between small glyphs ([#1745](https://github.com/SFML/SFML/pull/1745), [#1746](https://github.com/SFML/SFML/pull/1746))
- Fix support for sRGB color space in sf::RenderTexture ([#1092](https://github.com/SFML/SFML/pull/1092), [#1757](https://github.com/SFML/SFML/pull/1757))
- Fix incorrect glyph rect for text outline ([#1826](https://github.com/SFML/SFML/pull/1826), [#1827](https://github.com/SFML/SFML/pull/1827), [#1836](https://github.com/SFML/SFML/pull/1836))
- Fix alpha value calculation for semi-transparent pixels on fully transparent pixels with sf::Image::copy() ([#1993](https://github.com/SFML/SFML/pull/1993))
- Fix getLocalBounds inconsistency for sf::Text ([#2129](https://github.com/SFML/SFML/pull/2129), [#2132](https://github.com/SFML/SFML/pull/2132))
- [iOS] Ensure the proper default framebuffer is bound when activating a RenderWindow ([#1471](https://github.com/SFML/SFML/pull/1471), [#1487](https://github.com/SFML/SFML/pull/1487))

### Audio {: #2.6.0-audio}

#### Features

- Allow explicitly closing sf::InputSoundFile ([#1516](https://github.com/SFML/SFML/pull/1516))
- Replace use of auto_ptr for future-proofing ([#1546](https://github.com/SFML/SFML/pull/1546))
- Adjustable processing interval in sf::SoundStream ([#1517](https://github.com/SFML/SFML/pull/1517), [#1666](https://github.com/SFML/SFML/pull/1666))
- Fix sf::Music sometimes failing to loop after seeking ([#1707](https://github.com/SFML/SFML/pull/1707))
- Add MP3 decoding support ([#1232](https://github.com/SFML/SFML/pull/1232), [#1796](https://github.com/SFML/SFML/pull/1796), [#1851](https://github.com/SFML/SFML/pull/1851))

#### Bugfixes

- Rename FindVorbis -> FindVORBIS, for consistency with exported variables ([#1626](https://github.com/SFML/SFML/pull/1626), [#1629](https://github.com/SFML/SFML/pull/1629))
- Fix naming of VORBIS in SFMLConfigDependencies.cmake.in ([#1636](https://github.com/SFML/SFML/pull/1636), [#1637](https://github.com/SFML/SFML/pull/1637))
- Fixed copy assign operator in sf::Sound so it checks for self-assignment ([#1744](https://github.com/SFML/SFML/pull/1744))
- Fix SoundStream::play to restart the sound if it was played before ([#2175](https://github.com/SFML/SFML/pull/2175))

### Network {: #2.6.0-network}

#### Features

- Added method to get the current read position of sf::Packet ([#1382](https://github.com/SFML/SFML/pull/1382), [#1641](https://github.com/SFML/SFML/pull/1641))

#### Bugfixes

- Fixed sometimes failing to read floats and doubles from Packet on Android ([#1565](https://github.com/SFML/SFML/pull/1565), [#1578](https://github.com/SFML/SFML/pull/1578))

## SFML 2.5.1 {: #sfml-2.5.1}

### General {: #2.5.1-general}

- Various CMake fixes ([#1414](https://github.com/SFML/SFML/pull/1414), [#1416](https://github.com/SFML/SFML/pull/1416), [#1436](https://github.com/SFML/SFML/pull/1436), [#1439](https://github.com/SFML/SFML/pull/1439), [#1467](https://github.com/SFML/SFML/pull/1467), [#1470](https://github.com/SFML/SFML/pull/1470))
- Fixed the installation of pkg-config files ([#1466](https://github.com/SFML/SFML/pull/1466))
- Fixed two conversion warnings ([#1454](https://github.com/SFML/SFML/pull/1454))
- [Android] Fixes all symbols in sfml-main are hidden ([#1457](https://github.com/SFML/SFML/pull/1457), [#1460](https://github.com/SFML/SFML/pull/1460))
- [Android] Fixed some #define flag problem ([#1458](https://github.com/SFML/SFML/pull/1458))
- [Android] Fix deadlock in main cleanup ([#1265](https://github.com/SFML/SFML/pull/1265))
- [iOS] Modernized toolchain file ([#1411](https://github.com/SFML/SFML/pull/1411))
- [iOS] Check that SFML/Main.hpp is used ([#1412](https://github.com/SFML/SFML/pull/1412))
- [macOS] Add -ObjC flag to fix static linking on macOS ([#1485](https://github.com/SFML/SFML/pull/1485))

### Window {: #2.5.1-window}

#### Bugfixes

- [iOS] Use default supported rotations when none are specified ([#1417](https://github.com/SFML/SFML/pull/1417))
- [iOS] Fixed autocomplete window overlaps keyboard ([#1473](https://github.com/SFML/SFML/pull/1473), [#1482](https://github.com/SFML/SFML/pull/1482))
- [Linux] Fixed dual monitor issue ([#1226](https://github.com/SFML/SFML/pull/1226), [#1238](https://github.com/SFML/SFML/pull/1238))
- [Linux] Fixed issue where fullscreen window didn't go over task bars on top and left on in Ubuntu ([#1224](https://github.com/SFML/SFML/pull/1224))
- [Linux] Fixed the Unix clipboard implementation causing an abort due to internal data races in Xlib ([#1437](https://github.com/SFML/SFML/pull/1437))
- [macOS] Added additional system cursors ([#1401](https://github.com/SFML/SFML/pull/1401), [#1413](https://github.com/SFML/SFML/pull/1413), [#1425](https://github.com/SFML/SFML/pull/1425))
- [Windows] Fixed swapped colors for custom cursors ([#1464](https://github.com/SFML/SFML/pull/1464), [#1465](https://github.com/SFML/SFML/pull/1465), [#1491](https://github.com/SFML/SFML/pull/1491))

### Graphics {: #2.5.1-graphics}

#### Bugfixes

- Fixed a bug in which a sf::RenderTexture would not be re-activated after being re-created ([#1438](https://github.com/SFML/SFML/pull/1438))
- Fixed sf::RenderTextureImplFBO's destructor incorrectly triggering deletion of other sf::RenderTextureImplFBO's active FBOs ([#1440](https://github.com/SFML/SFML/pull/1440))
- Fix sf::RenderWindow::setActive incorrectly trying to unbind an FBO during deactivation [(#1442](https://github.com/SFML/SFML/pull/1442))
- Fixed sf::RenderTexture::display() dereferencing a NULL pointer when being called before sf::RenderTexture::create() ([#1446](https://github.com/SFML/SFML/pull/1446))
- Fixed bug in sf::Text when applying an outline color/thickness ([#1176](https://github.com/SFML/SFML/pull/1176))
- Squash duplicated sf::Font glyphs to single chars ([#1461](https://github.com/SFML/SFML/pull/1461))
- Fixed two issues with glyph sub-pixel positioning ([#1452](https://github.com/SFML/SFML/pull/1452))
- Reduced context locking & unlocking while creating textures ([#1459](https://github.com/SFML/SFML/pull/1459))
- Fixed the error message when the wrong bitmap font size is selected ([#1456](https://github.com/SFML/SFML/pull/1456), [#1474](https://github.com/SFML/SFML/pull/1474), [#1492](https://github.com/SFML/SFML/pull/1492))

### Audio {: #2.5.1-audio}

#### Bugfixes

- Fixed performance issue with reading WAV files ([#1450](https://github.com/SFML/SFML/pull/1450))

## SFML 2.5.0 {: #sfml-2.5.0}

### General {: #2.5.0-general}

- Replaced FindSFML.cmake with SFMLConfig.cmake ([#1335](https://github.com/SFML/SFML/pull/1335))
- Markdown'd and updated readme, changelog, contributing and license files ([#1196](https://github.com/SFML/SFML/pull/1196), [#1368](https://github.com/SFML/SFML/pull/1368), [#1317](https://github.com/SFML/SFML/pull/1317))
- Improve packaging support ([#1173](https://github.com/SFML/SFML/pull/1173))
- Added Tagfile generation and search ([#1327](https://github.com/SFML/SFML/pull/1327))
- Added CMake variables to select the modules to be built ([#798](https://github.com/SFML/SFML/issues/798), [#800](https://github.com/SFML/SFML/pull/800))
- Do not install extlibs if SFML_USE_SYSTEM_DEPS is true ([#1236](https://github.com/SFML/SFML/issues/1236), [#1237](https://github.com/SFML/SFML/pull/1237))
- Fixed various type conversion/comparison warnings ([#1325](https://github.com/SFML/SFML/pull/1325))
- [Android] Increased minimum API version to 14 ([#1362](https://github.com/SFML/SFML/pull/1362))
- [Android] Removed custom toolchain and added support for the newest NDK version and Gradle ([#1350](https://github.com/SFML/SFML/pull/1350), [#1393](https://github.com/SFML/SFML/pull/1393))
- [iOS] Updated the binary libs from exlibs/libs-ios ([#1207](https://github.com/SFML/SFML/pull/1207), [#1209](https://github.com/SFML/SFML/pull/1209))
- [iOS] Use a CMake toolchain file for iOS build ([#1268](https://github.com/SFML/SFML/pull/1268), [#1269](https://github.com/SFML/SFML/pull/1269))
- [iOS] Install extlibs if needed ([#1348](https://github.com/SFML/SFML/pull/1348))
- [iOS] Drop 32 bit support ([#1374](https://github.com/SFML/SFML/pull/1374))
- [iOS] Force correct iOS architecture for cmake ([#1373](https://github.com/SFML/SFML/pull/1373), [#1377](https://github.com/SFML/SFML/pull/1377))
- [iOS] Added iOS example ([#1378](https://github.com/SFML/SFML/pull/1378))
- [macOS] Fixed launch of cocoa examples ([#1334](https://github.com/SFML/SFML/pull/1334))
- [macOS] Improved application signing process ([#1020](https://github.com/SFML/SFML/pull/1020), [#1036](https://github.com/SFML/SFML/pull/1036), [#1194](https://github.com/SFML/SFML/pull/1194))
- [macOS] Improved CMake script ([#1215](https://github.com/SFML/SFML/pull/1215), [#1371](https://github.com/SFML/SFML/pull/1371))
- [macOS] Use -stdlib=libc++ ([#1361](https://github.com/SFML/SFML/pull/1361))
- [OpenBSD] Added support for OpenBSD ([#1330](https://github.com/SFML/SFML/pull/1330))

### System {: #2.5.0-system}

#### Bugfixes

- Added protected destructor to sf::NonCopyable to prevent possible resource leaks ([#1125](https://github.com/SFML/SFML/pull/1125), [#1161](https://github.com/SFML/SFML/pull/1161))
- Fixed crash when sf::Clock is constructed in a global scope ([#1258](https://github.com/SFML/SFML/pull/1258))

### Window {: #2.5.0-window}

#### Features

- Implemented Cursor API ([#269](https://github.com/SFML/SFML/pull/269), [#784](https://github.com/SFML/SFML/pull/784), [#827](https://github.com/SFML/SFML/pull/827))
- Implemented Clipboard API ([#715](https://github.com/SFML/SFML/pull/715), [#1204](https://github.com/SFML/SFML/pull/1204), [#1221](https://github.com/SFML/SFML/pull/1221))
- Renamed a few key codes ([#1395](https://github.com/SFML/SFML/pull/1395))
- Added joystick example ([#1363](https://github.com/SFML/SFML/pull/1363))
- [Windows] Added support for interfacing with joysticks via DirectInput when it is available ([#1251](https://github.com/SFML/SFML/pull/1251), [#1326](https://github.com/SFML/SFML/pull/1326))
- [Windows] Fix discrete GPU preference symbols being exported from the wrong place ([#1192](https://github.com/SFML/SFML/pull/1192), [#1406](https://github.com/SFML/SFML/pull/1406))

#### Bugfixes

- [Android] Return correct key code for delete/backspace ([#1309](https://github.com/SFML/SFML/pull/1309), [#1362](https://github.com/SFML/SFML/pull/1362))
- [iOS] Don't need to find vorbisfile or vorbisenc ([#1347](https://github.com/SFML/SFML/pull/1347))
- [Linux] Fixed sf::Window::getPosition() returning incorrect position because of differences in window managers ([#1228](https://github.com/SFML/SFML/pull/1228), [#1266](https://github.com/SFML/SFML/pull/1266))
- [Linux] Fix X11 key repeat handling not filtering out events from other windows ([#1223](https://github.com/SFML/SFML/pull/1223), [#1230](https://github.com/SFML/SFML/pull/1230), [#1291](https://github.com/SFML/SFML/pull/1291))
- [Linux] Restore fullscreen of a non-visible window ([#1339](https://github.com/SFML/SFML/pull/1339))
- [macOS] Fixed window menu not working ([#1091](https://github.com/SFML/SFML/pull/1091), [#1180](https://github.com/SFML/SFML/pull/1180), [#1193](https://github.com/SFML/SFML/pull/1193))
- [macOS] Fixed crash with application messing hardware detection e.g. TeamViewer ([#1323](https://github.com/SFML/SFML/pull/1323))
- [macOS] Added support for (some) Hat/POV axis ([#1248](https://github.com/SFML/SFML/pull/1248))
- [Windows] Prevent uninitialized read by zeroing memory ([#1264](https://github.com/SFML/SFML/pull/1264))
- [Windows] Fixed modifier keys handling ([#1357](https://github.com/SFML/SFML/pull/1357))

### Graphics {: #2.5.0-graphics}

#### Features

- Implemented additional line spacing and letter spacing in sf::Text ([#928](https://github.com/SFML/SFML/pull/928), [#1366](https://github.com/SFML/SFML/pull/1366))
- Added sf::VertexBuffer class ([#1308](https://github.com/SFML/SFML/pull/1308))
- Added GPU local texture copying support, allowing performance optimizations and texture swapping ([#1119](https://github.com/SFML/SFML/pull/1119), [#1319](https://github.com/SFML/SFML/pull/1319), [#1320](https://github.com/SFML/SFML/pull/1320))
- Optimize performance by skipping glTexCoordPointer() call if not needed ([#1015](https://github.com/SFML/SFML/pull/1015))
- Generate shape outline vertices only if necessary ([#925](https://github.com/SFML/SFML/pull/925), [#1356](https://github.com/SFML/SFML/pull/1356))
- Removed dependency to libjpeg, stb_image_write now supports writing JPEG files ([#1278](https://github.com/SFML/SFML/pull/1278), [#1279](https://github.com/SFML/SFML/pull/1279))
- Enable comparing sf::Transform and optimize resetting OpenGL back to the identity matrix ([#1298](https://github.com/SFML/SFML/pull/1298))
- Added missing setActive() virtual method to sf::RenderTarget ([#1157](https://github.com/SFML/SFML/pull/1157))
- Updated stb_image to v2.16 and stb_image_write to v1.07 ([#1270](https://github.com/SFML/SFML/pull/1270))
- Added sf::RenderTexture stencil and multisampling support ([#1274](https://github.com/SFML/SFML/pull/1274), [#1285](https://github.com/SFML/SFML/pull/1285))
- Added example demonstrating sf::VertexBuffer, sf::Shader and sf::Thread usage ([#1352](https://github.com/SFML/SFML/pull/1352))
- Optimized sf::RenderTexture performance ([#1379](https://github.com/SFML/SFML/pull/1379))

#### Bugfixes

- Properly free memory in sf::Font::cleanup() ([#1119](https://github.com/SFML/SFML/pull/1119))
- Fixed memory leak in sf::Font ([#1216](https://github.com/SFML/SFML/pull/1216))
- Fix OpenGL texture coordinate pointer not being updated correctly under certain conditions ([#1297](https://github.com/SFML/SFML/pull/1297))
- Fix for broken text when the font is reloaded ([#1345](https://github.com/SFML/SFML/pull/1345))
- Fix memory leak in sf::Text ([#1233](https://github.com/SFML/SFML/pull/1233), [#1360](https://github.com/SFML/SFML/pull/1360))
- Fixed strict aliasing punning warning when generating the key of a glyph in Font.cpp ([#1187](https://github.com/SFML/SFML/pull/1187), [#1396](https://github.com/SFML/SFML/pull/1396))
- Fixed OpenGL version string being parsed incorrectly on some platforms ([#1249](https://github.com/SFML/SFML/pull/1249), [#1390](https://github.com/SFML/SFML/pull/1390))
- [macOS] Worked around render target bug ([#1132](https://github.com/SFML/SFML/pull/1132), [#1342](https://github.com/SFML/SFML/pull/1342))
- [Windows] Replaced time-based joystick poll with a hardware event handler ([#1179](https://github.com/SFML/SFML/pull/1179), [#1195](https://github.com/SFML/SFML/pull/1195), [#1198](https://github.com/SFML/SFML/pull/1198), [#1199](https://github.com/SFML/SFML/pull/1199), [#1421](https://github.com/SFML/SFML/pull/1421))

### Audio {: #2.5.0-audio}

#### Features

- Added loop point support to sf::Music ([#177](https://github.com/SFML/SFML/pull/177), [#629](https://github.com/SFML/SFML/pull/629))
- Added support for the extensible PCM wave file format ([#1296](https://github.com/SFML/SFML/pull/1296))
- [iOS] Enable audio module ([#1338](https://github.com/SFML/SFML/pull/1338))

#### Bugfixes

- Fixed inconsistent seek behavior in sf::SoundStream ([#1118](https://github.com/SFML/SFML/pull/1118))
- Fixed stack overflow in sf::SoundStream::fillAndPushBuffer() ([#1154](https://github.com/SFML/SFML/pull/1154))
- Fixed seeking quirks in the FLAC reader ([#966](https://github.com/SFML/SFML/pull/966), [#1162](https://github.com/SFML/SFML/pull/1162))
- Allow polymorphism with sf::SoundSource ([#1185](https://github.com/SFML/SFML/pull/1185))
- Fixed WAV file writer writing wrong header values ([#1280](https://github.com/SFML/SFML/pull/1280), [#1281](https://github.com/SFML/SFML/pull/1281))
- Small bugfix to argument of alcCaptureOpenDevice() ([#1304](https://github.com/SFML/SFML/pull/1304), [#1305](https://github.com/SFML/SFML/pull/1305))
- [iOS] Find OpenAL correctly ([#1263](https://github.com/SFML/SFML/pull/1263), [#1376](https://github.com/SFML/SFML/pull/1376))
- [Windows] Updated OpenAL Soft to 1.18.1 fixing crashes ([#1247](https://github.com/SFML/SFML/pull/1247), [#1260](https://github.com/SFML/SFML/pull/1260))

### Network {: #2.5.0-network}

#### Features

- Add append/overwrite parameter to Ftp::upload ([#1072](https://github.com/SFML/SFML/pull/1072), [#1399](https://github.com/SFML/SFML/pull/1399))

#### Bugfixes

- Fixed wrong condition for building network support ([#1253](https://github.com/SFML/SFML/pull/1253))
- Changed TCP listen backlog from 0 to SOMAXCONN ([#1369](https://github.com/SFML/SFML/pull/1369), [#1407](https://github.com/SFML/SFML/pull/1407))
- Fixed socket reuse not conforming to documentation ([#1346](https://github.com/SFML/SFML/pull/1346), [#1408](https://github.com/SFML/SFML/pull/1408))

## SFML 2.4.2 {: #sfml-2.4.2}

### System {: #2.4.2-system}

#### Bugfixes

- [Windows] Removed thread affinity changes in sf::Clock ([#1107](https://github.com/SFML/SFML/pull/1007))

### Window {: #2.4.2-window}

#### Bugfixes

- Fixed bug where TransientContextLock would hang ([#1165](https://github.com/SFML/SFML/issues/1165), [#1172](https://github.com/SFML/SFML/pull/1172))
- [Linux] Fixed GLX extensions being loaded too late ([#1183](https://github.com/SFML/SFML/pull/1183))
- [Linux] Fix wrong types passed to XChangeProperty ([#1168](https://github.com/SFML/SFML/issues/1168), [#1171](https://github.com/SFML/SFML/pull/1171))
- [Windows] Make context disabling via wglMakeCurrent more tolerant of broken drivers ([#1186](https://github.com/SFML/SFML/pull/1186))

### Graphics {: #2.4.2-graphics}

#### Bugfixes

- Optimized sf::Image::create and made it more exception safe ([#1166](https://github.com/SFML/SFML/pull/1166))

## SFML 2.4.1 {: #sfml-2.4.1}

### General {: #2.4.1-general}

#### Bugfixes

- [kFreeBSD] Define SFML_OS_FREEBSD when compiling for kFreeBSD ([#1129](https://github.com/SFML/SFML/pull/1129))
- [Windows] Added some simple messaging when trying to build under Cygwin ([#1153](https://github.com/SFML/SFML/pull/1153))

### Window {: #2.4.1-window}

#### Bugfixes

- Fixed stack overflow on GlContext creation with multiple threads ([#989](https://github.com/SFML/SFML/issues/989), [#1002](https://github.com/SFML/SFML/pull/1002))
- Adjusted mouse cursor grab documentation ([#1133](https://github.com/SFML/SFML/pull/1133))
- [iOS] Fixed orientation change not rescaling window size properly ([#1049](https://github.com/SFML/SFML/issues/1049), [#1050](https://github.com/SFML/SFML/pull/1050))
- [Linux] Fixed fullscreen issue ([#921](https://github.com/SFML/SFML/issues/921), [#1138](https://github.com/SFML/SFML/pull/1138))
- [Linux] Switched from XCB back to Xlib for windowing ([#1138](https://github.com/SFML/SFML/pull/1138))
- [Linux] Fixed window icon not showing up on some distros ([#1087](https://github.com/SFML/SFML/issues/1087), [#1088](https://github.com/SFML/SFML/pull/1088))
- [Linux] Fixed an issue where GNOME flags window unresponsive ([#1089](https://github.com/SFML/SFML/issues/1089), [#1138](https://github.com/SFML/SFML/pull/1138))
- [Linux] Fixed leak of XVisualInfo objects during GlxContext creation ([#1135](https://github.com/SFML/SFML/pull/1135))
- [Linux] Fixed possible hang when setting visibility if external window sources ([#1136](https://github.com/SFML/SFML/pull/1136))
- [macOS] Fixed inconsistency between doc and impl on macOS for the grab feature ([#1133](https://github.com/SFML/SFML/pull/1133), [#1148](https://github.com/SFML/SFML/issues/1148), [#1150](https://github.com/SFML/SFML/pull/1150))
- [Windows] Fixed context memory leaks ([#1143](https://github.com/SFML/SFML/issues/1143), [#1002](https://github.com/SFML/SFML/pull/1002))

### Graphics {: #2.4.1-graphics}

#### Bugfixes

- Adjusted uniform error message ([#1131](https://github.com/SFML/SFML/pull/1131))
- Clarify documentation on Rect::contains function bounds ([#1151](https://github.com/SFML/SFML/pull/1151))

### Network {: #2.4.1-network}

#### Bugfixes

- Fixed a typo in comment for sf::UdpSocket::unbind() ([#1121](https://github.com/SFML/SFML/pull/1121))

## SFML 2.4.0 {: #sfml-2.4.0}

### General {: #2.4.0-general}

- Added deprecation macro ([#969](https://github.com/SFML/SFML/pull/969))
- Fixed issues reported by Coverity Scan static analysis ([#1064](https://github.com/SFML/SFML/pull/1064))
- Fixed some initialization issues reported by Cppcheck ([#1008](https://github.com/SFML/SFML/pull/1008))
- Changed comment chars in FindSFML.cmake to # ([#1090](https://github.com/SFML/SFML/pull/1090))
- Fixed some typos ([#1098](https://github.com/SFML/SFML/pull/1098), [#993](https://github.com/SFML/SFML/pull/993), [#1099](https://github.com/SFML/SFML/pull/1099), [#956](https://github.com/SFML/SFML/pull/956), [#963](https://github.com/SFML/SFML/pull/963), [#979](https://github.com/SFML/SFML/pull/979))
- Updated/fixed string comparisons in Config.cmake ([#1102](https://github.com/SFML/SFML/pull/1102))
- Added the missing -s postfix for the RelWithDebInfo config ([#1014](https://github.com/SFML/SFML/pull/1014))
- [Android] Fixed current Android compilation issues ([#1116](https://github.com/SFML/SFML/pull/1116), [#1111](https://github.com/SFML/SFML/pull/1111), [#1079](https://github.com/SFML/SFML/pull/1079))
- [macOS] Update Xcode template material ([#976](https://github.com/SFML/SFML/pull/976), [#968](https://github.com/SFML/SFML/pull/968))
- [Windows] Added support for VS 2015 ([#972](https://github.com/SFML/SFML/pull/972))
- [Windows] Create and install PDB debug symbols alongside binaries ([#1037](https://github.com/SFML/SFML/pull/1037))

## Deprecated API {: #2.4.0-deprecated}

- sf::RenderWindow::capture(): Use a sf::Texture and its sf::Texture::update(const Window&) function and copy its contents into an sf::Image instead.
- sf::Shader::setParameter(): Use setUniform() instead.
- sf::Text::getColor(): There is now fill and outline colors instead of a single global color. Use getFillColor() or getOutlineColor() instead.
- sf::Text::setColor(): There is now fill and outline colors instead of a single global color. Use setFillColor() or setOutlineColor() instead.
- sf::LinesStrip: Use LineStrip instead.
- sf::TrianglesFan: Use TriangleFan instead.
- sf::TrianglesStrip: Use TriangleStrip instead.

### System {: #2.4.0-system}

#### Features

- [Android] Added sf::getNativeActivity() ([#1005](https://github.com/SFML/SFML/pull/1005), [#680](https://github.com/SFML/SFML/pull/680))

#### Bugfixes

- Added missing include in String.hpp ([#1069](https://github.com/SFML/SFML/pull/1069), [#1068](https://github.com/SFML/SFML/pull/1068))
- Fixed encoding of UTF-16 ([#997](https://github.com/SFML/SFML/pull/997))
- [Android] Fixed crash when trying to load a non-existing font file ([#1058](https://github.com/SFML/SFML/pull/1058))

### Window {: #2.4.0-window}

#### Features

- Added ability to grab cursor ([#614](https://github.com/SFML/SFML/pull/614), [#394](https://github.com/SFML/SFML/pull/394), [#1107](https://github.com/SFML/SFML/pull/1107))
- Added Multi-GPU preference ([#869](https://github.com/SFML/SFML/pull/869), [#867](https://github.com/SFML/SFML/pull/867))
- Added support for sRGB capable framebuffers ([#981](https://github.com/SFML/SFML/pull/981), [#175](https://github.com/SFML/SFML/pull/175))
- [Linux, Windows] Improved OpenGL context creation ([#884](https://github.com/SFML/SFML/pull/884))
- [Linux, Windows] Added support for pbuffers on Windows and Unix ([#885](https://github.com/SFML/SFML/pull/885), [#434](https://github.com/SFML/SFML/pull/434))

#### Bugfixes

- Updated platform-specific handle documentation ([#961](https://github.com/SFML/SFML/pull/961))
- [Android] Accept touch events from "multiple" devices ([#954](https://github.com/SFML/SFML/pull/954), [#953](https://github.com/SFML/SFML/pull/953))
- [Android] Copy the selected EGL context's settings to SFML ([#1039](https://github.com/SFML/SFML/pull/1039))
- [Linux] Fixed modifiers causing sf::Keyboard::Unknown being returned ([#1022](https://github.com/SFML/SFML/pull/1022), [#1012](https://github.com/SFML/SFML/pull/1012))
- [macOS] Improved memory management on macOS ([#962](https://github.com/SFML/SFML/pull/962), [#790](https://github.com/SFML/SFML/pull/790))
- [macOS] Fixed crash when resizing a window to a zero-height/width size ([#986](https://github.com/SFML/SFML/pull/986), [#984](https://github.com/SFML/SFML/pull/984))
- [macOS] Use the mouse button constant instead of 0 to avoid a compiler error on macOS ([#1035](https://github.com/SFML/SFML/pull/1035))
- [macOS] macOS improvement: warnings + bugfix + refactoring, the lot! ([#1042](https://github.com/SFML/SFML/pull/1042))

### Graphics {: #2.4.0-graphics}

#### Features

- Added support for outlined text ([#840](https://github.com/SFML/SFML/pull/840))
- Add support for geometry shaders ([#886](https://github.com/SFML/SFML/pull/886), [#428](https://github.com/SFML/SFML/pull/428))
- Feature/blend mode reverse subtract ([#945](https://github.com/SFML/SFML/pull/945), [#944](https://github.com/SFML/SFML/pull/944))
- Implemented support for mipmap generation ([#973](https://github.com/SFML/SFML/pull/973), [#498](https://github.com/SFML/SFML/pull/498), [#123](https://github.com/SFML/SFML/pull/123))
- Added new API to set shader uniforms ([#983](https://github.com/SFML/SFML/pull/983), [#538](https://github.com/SFML/SFML/pull/538))
- Rewrite RenderWindow::capture ([#1001](https://github.com/SFML/SFML/pull/1001))

#### Bugfixes

- Exporting some Glsl utility functions due to linking issues ([#1044](https://github.com/SFML/SFML/pull/1044), [#1046](https://github.com/SFML/SFML/pull/1046))
- Fixed missing initialisation of Font::m_stroker ([#1059](https://github.com/SFML/SFML/pull/1059))
- Changed primitive types to be grammatically correct ([#1095](https://github.com/SFML/SFML/pull/1095), [#939](https://github.com/SFML/SFML/pull/939))

### Audio {: #2.4.0-audio}

#### Features

- Implemented stereo audio recording ([#1010](https://github.com/SFML/SFML/pull/1010))

#### Bugfixes

- Added an assignment operator to SoundSource ([#864](https://github.com/SFML/SFML/pull/864))
- [macOS] Updates OpenAL-soft for macOS to version 1.17.2 ([#1057](https://github.com/SFML/SFML/pull/1057), [#900](https://github.com/SFML/SFML/pull/900), [#1000](https://github.com/SFML/SFML/pull/1000))
- Fixed a bug where vorbis can't handle large buffers ([#1067](https://github.com/SFML/SFML/pull/1067))
- Added support for 24-bit .wav files ([#958](https://github.com/SFML/SFML/pull/958), [#955](https://github.com/SFML/SFML/pull/955))
- Fixed threading issue in sf::SoundRecorder ([#1011](https://github.com/SFML/SFML/pull/1011))
- Made WAV file reader no longer assume that data chunk goes till end of file to prevent reading trailing metadata as samples ([#1018](https://github.com/SFML/SFML/pull/1018))
- Fixed seeking in multi channel FLAC files ([#1041](https://github.com/SFML/SFML/pull/1041), [#1040](https://github.com/SFML/SFML/pull/1040))

### Network {: #2.4.0-network}

#### Features

- Added optional argument on which address to bind (socket). ([#850](https://github.com/SFML/SFML/pull/850), [#678](https://github.com/SFML/SFML/pull/678))

#### Bugfixes

- Fixed FTP directory listing blocking forever ([#1086](https://github.com/SFML/SFML/pull/1086), [#1025](https://github.com/SFML/SFML/pull/1025))

## SFML 2.3.2 {: #sfml-2.3.2}

### General {: #2.3.2-general}

- Fixed an issue where FindSFML.cmake couldn't find older versions of SFML ([#903](https://github.com/SFML/SFML/pull/903))
- Robust alCheck and glCheck macros ([#917](https://github.com/SFML/SFML/pull/917))
- Fixed FindSFML.cmake to use the uppercase FLAC name ([#923](https://github.com/SFML/SFML/pull/923))
- Added a CONTRIBUTING file so GitHub shows a message when creating a new issue ([#932](https://github.com/SFML/SFML/pull/932))

### Window {: #2.3.2-window}

#### Bugfixes

- [Linux] Fixed an issue where the keypad's key weren't being detected ([#910](https://github.com/SFML/SFML/pull/910))
- [Linux] Revert to Xlib event handling ([#934](https://github.com/SFML/SFML/pull/934))
- [Linux] Fixed XK_* inconsistency in InpuImpl.cpp ([#947](https://github.com/SFML/SFML/pull/947))
- [Linux] Fix _NET_WM_PING messages not being replied to properly ([#947](https://github.com/SFML/SFML/pull/947))

### Graphics {: #2.3.2-graphics}

#### Bugfixes

- Fixed clear bug on RenderTextures ([#915](https://github.com/SFML/SFML/pull/915))
- Fixed image file extension detection ([#929](https://github.com/SFML/SFML/issues/929), [#930](https://github.com/SFML/SFML/pull/930), [#931](https://github.com/SFML/SFML/pull/931))
- Secure function against random data return ([#935](https://github.com/SFML/SFML/issues/935), [#942](https://github.com/SFML/SFML/pull/942))

## SFML 2.3.1 {: #sfml-2.3.1}

### Window {: #2.3.1-window}

#### Bugfixes

- [Android] Make sure a window still exists before trying to access its dimensions ([#854](https://github.com/SFML/SFML/pull/854))
- [Android] Added Android API level checks ([#856](https://github.com/SFML/SFML/pull/856))
- [Android] Updated the JNI/event handling code ([#906](https://github.com/SFML/SFML/pull/906))
- [Linux] Resized events are only spawned when the window size actually changes ([#878](https://github.com/SFML/SFML/pull/878), [#893](https://github.com/SFML/SFML/issues/893))
- [Linux] Whitelisted X SHAPE events ([#879](https://github.com/SFML/SFML/issues/879), [#883](https://github.com/SFML/SFML/pull/883))
- [Linux] Remap Unix keyboard when user changes layout ([#895](https://github.com/SFML/SFML/issues/895), [#897](https://github.com/SFML/SFML/pull/897))
- [Linux] Fix undefined behavior in ewmhSupported() ([#892](https://github.com/SFML/SFML/issues/892), [#901](https://github.com/SFML/SFML/pull/901))

### Graphics {: #2.3.1-graphics}

#### Bugfixes

- Added support for GL_EXT_texture_edge_clamp for systems that don't expose GL_SGIS_texture_edge_clamp ([#880](https://github.com/SFML/SFML/issues/880), [#882](https://github.com/SFML/SFML/pull/882))

### Audio {: #2.3.1-audio}

#### Bugfixes

- [Android] Fixed audio files not loading (and possibly crashing) ([#855](https://github.com/SFML/SFML/issues/855), [#887](https://github.com/SFML/SFML/pull/887))

## SFML 2.3 {: #sfml-2.3}

### General {: #2.3-general}

- Examples only link against sfml-main in release mode ([#610](https://github.com/SFML/SFML/issues/610), [#766](https://github.com/SFML/SFML/pull/766))
- Replaced unsigned int with std::size_t for array indices and sizes ([#739](https://github.com/SFML/SFML/pull/739))
- Fixed some issues with the Doxygen documentation ([#750](https://github.com/SFML/SFML/pull/750))
- Added support for EditorConfig ([#751](https://github.com/SFML/SFML/pull/751))
- Hide success message for CMake in quiet mode ([#753](https://github.com/SFML/SFML/pull/753))
- Improved documentation for statuses with sf::Ftp ([#763](https://github.com/SFML/SFML/pull/763))
- Moved stb_image into the extlibs directory ([#795](https://github.com/SFML/SFML/pull/795))
- Changed the SOVERSION to major.minor ([#812](https://github.com/SFML/SFML/pull/812))
- Fixed warnings about switch-statements ([#863](https://github.com/SFML/SFML/pull/863))
- Added missing includes in the general headers ([#851](https://github.com/SFML/SFML/pull/851))
- [Android] Updated toolchain file and dependencies ([#791](https://github.com/SFML/SFML/pull/791))
- [Linux] Fixed missing pthread dependency ([#794](https://github.com/SFML/SFML/pull/794))
- [macOS] Relaxed CMake installation rules regarding framework dependencies ([#767](https://github.com/SFML/SFML/pull/767))

## Deprecated API {: #2.3-deprecated}

- sf::Event::MouseWheelEvent: This event is deprecated and potentially inaccurate. Use MouseWheelScrollEvent instead.

### Window {: #2.3-window}

#### Features

- Added new events for handling high-precision scrolling ([#95](https://github.com/SFML/SFML/issues/95), [#810](https://github.com/SFML/SFML/pull/810), [#837](https://github.com/SFML/SFML/pull/837))
- Switched from Xlib to XCB ([#200](https://github.com/SFML/SFML/issues/200), [#319](https://github.com/SFML/SFML/pull/319), [#694](https://github.com/SFML/SFML/pull/694), [#780](https://github.com/SFML/SFML/pull/780), [#813](https://github.com/SFML/SFML/pull/813), [#825](https://github.com/SFML/SFML/pull/825))
- Added support for OpenGL 3 core context creation ([#654](https://github.com/SFML/SFML/issues/654), [#779](https://github.com/SFML/SFML/pull/779))

#### Bugfixes

- Fixed glXSwapIntervalSGI being broken for some driver implementations ([#727](https://github.com/SFML/SFML/issues/727), [#779](https://github.com/SFML/SFML/pull/779))
- Fixed simultaneous context operations causing crashes on some AMD hardware ([#778](https://github.com/SFML/SFML/issues/778), [#779](https://github.com/SFML/SFML/pull/779))
- Fixed joystick identification ([#809](https://github.com/SFML/SFML/pull/809), [#811](https://github.com/SFML/SFML/pull/811))
- [iOS] Fixed various issues including stencil bits, device orientation and retina support ([#748](https://github.com/SFML/SFML/pull/748))
- [iOS] Fixed inconsistency between sf::Touch::getPosition and touch events ([#875](https://github.com/SFML/SFML/pull/875))
- [Linux] Fixed Alt+F4 not getting triggered in window mode ([#274](https://github.com/SFML/SFML/issues/274))
- [Linux] Fixed Unix joystick stuff ([#838](https://github.com/SFML/SFML/pull/838))
- [macOS] Fixed typo in JoystickImpl.cpp to prevent a crash ([#762](https://github.com/SFML/SFML/issues/762), [#765](https://github.com/SFML/SFML/pull/765))
- [macOS] Fixed an issue in InputImpl::getSFOpenGLViewFromSFMLWindow ([#782](https://github.com/SFML/SFML/issues/782), [#792](https://github.com/SFML/SFML/pull/792))

### Graphics {: #2.3-graphics}

#### Features

- Replaced GLEW with loader generated by glLoadGen ([#779](https://github.com/SFML/SFML/pull/779))
- Added a new constructor to sf::Color that takes an sf::Uint32 ([#722](https://github.com/SFML/SFML/pull/722))
- Updated stb_image to v2.02 ([#777](https://github.com/SFML/SFML/pull/777))
- Updated FreeType to v2.5.5 ([#799](https://github.com/SFML/SFML/issues/799), [#804](https://github.com/SFML/SFML/pull/804))
- Added checks for software OpenGL ([#870](https://github.com/SFML/SFML/pull/870))

#### Bugfixes

- Fixed GL_ARB_compatibility not being detected ([#859](https://github.com/SFML/SFML/pull/859))
- Fixed pixel format selection ([#862](https://github.com/SFML/SFML/pull/862))
- Bumped back the OpenGL version requirement to 1.1 ([#858](https://github.com/SFML/SFML/pull/858))

### Audio {: #2.3-audio}

#### Features

- Dropped libsndfile and started using Vorbis, FLAC and OGG directly ([#604](https://github.com/SFML/SFML/issues/604), [#757](https://github.com/SFML/SFML/pull/757))
- Added a FLAC file to the sound example ([#815](https://github.com/SFML/SFML/pull/815))

#### Bugfixes

- Fixed access violation error in the destructor of sf::AudioDevice ([#30](https://github.com/SFML/SFML/issues/30), [#602](https://github.com/SFML/SFML/pull/602))
- [macOS] Fixed threading issue with sf::SoundStream and OpenAL ([#541](https://github.com/SFML/SFML/issues/541), [#831](https://github.com/SFML/SFML/pull/831))

### Network {: #2.3-network}

#### Bugfixes

- Fixed sf::TcpSocket not handling partial sends properly ([#749](https://github.com/SFML/SFML/issues/749), [#796](https://github.com/SFML/SFML/pull/796))

## SFML 2.2 {: #sfml-2.2}

### General {: #2.2-general}

- Support for iOS and Android platform ([#410](https://github.com/SFML/SFML/issues/410), [#440](https://github.com/SFML/SFML/issues/440))
- Various documentation corrections ([#438](https://github.com/SFML/SFML/issues/438), [#496](https://github.com/SFML/SFML/pull/496), [#497](https://github.com/SFML/SFML/pull/497), [#714](https://github.com/SFML/SFML/pull/714))
- Fixed support for compilers on Debian FreeBSD ([#380](https://github.com/SFML/SFML/pull/380), [#578](https://github.com/SFML/SFML/pull/578))
- Added support for Visual Studio 2013 and proper support for the TDM builds ([#482](https://github.com/SFML/SFML/pull/482))
- Fixed CMake problems related to FindSFML and cached variables ([#637](https://github.com/SFML/SFML/issues/637), [#684](https://github.com/SFML/SFML/pull/684))
- Switched and enforced `LF` line endings ([#708](https://github.com/SFML/SFML/pull/708), [#712](https://github.com/SFML/SFML/pull/712))
- Updated OpenAL to version 1.15.1 ([d077210](https://github.com/SFML/SFML/commit/d07721075057c7eac33124ff406eb0f5d629258b))
- Made compiler and OS variable names much clearer in CMake files ([9b0ed30](https://github.com/SFML/SFML/commit/9b0ed300b5ced8f9bd49be42089b2988c4007947))
- Re-enabled RPATH feature ([e157e7a](https://github.com/SFML/SFML/commit/e157e7a7a84d9d840c590df355d2681d0936971e))
- Slight adjustments to the examples ([#737](https://github.com/SFML/SFML/pull/737))
- [FreeBSD] Various configuration fixes ([#577](https://github.com/SFML/SFML/pull/577), [#578](https://github.com/SFML/SFML/pull/578))
- [Linux] Updated `FindSFML.cmake` to add UDev to SFML's dependencies ([#728](https://github.com/SFML/SFML/issues/728), [#729](https://github.com/SFML/SFML/pull/729), [#734](https://github.com/SFML/SFML/issues/734), [#736](https://github.com/SFML/SFML/pull/736))
- [macOS] Fixed incorrect symlink in freetype.framework ([#519](https://github.com/SFML/SFML/issues/519))
- [macOS] CMake module for correct dependencies ([#548](https://github.com/SFML/SFML/pull/548))
- [macOS] Fixed SFML target for Xcode ([#595](https://github.com/SFML/SFML/issues/595), [#596](https://github.com/SFML/SFML/issues/596))
- [macOS] Updated implementation, mainly reverting to non-ARC ([#601](https://github.com/SFML/SFML/issues/601))
- [macOS] Fixed memory leaks and dead store ([#615](https://github.com/SFML/SFML/issues/615))
- [macOS] Improved event handling and performance ([#617](https://github.com/SFML/SFML/issues/617))
- [macOS] Reduced memory usage ([#672](https://github.com/SFML/SFML/issues/672), [#698](https://github.com/SFML/SFML/issues/698))
- [macOS] macOS 10.10 support ([#691](https://github.com/SFML/SFML/issues/691), [#699](https://github.com/SFML/SFML/pull/699))
- [macOS] Improve flexibility of dependencies' locations ([#713](https://github.com/SFML/SFML/pull/713))
- [Windows] Removed the hack that copied external libraries into SFML static libraries ([dbf01a7](https://github.com/SFML/SFML/commit/dbf01a775b7545bf83fbee0e1464f3f323723187))

### System {: #2.2-system}

#### Features

- Added substring and replace functions to `sf::String` ([#21](https://github.com/SFML/SFML/issues/21), [#355](https://github.com/SFML/SFML/pull/355))
- Added `toUtfX` to `sf::String` ([#501](https://github.com/SFML/SFML/issues/501))
- Added `fromUtfX` functions to set the internal data to a string by converting from another string in a fixed encoding ([#196](https://github.com/SFML/SFML/issues/196))
- Added modulo operator for `sf::Time` ([#429](https://github.com/SFML/SFML/issues/429), [#430](https://github.com/SFML/SFML/pull/430))
- Added division operator for `sf::Time` ([#453](https://github.com/SFML/SFML/pull/453))

#### Bugfixes

- Ensured a high resolution for `sf::sleep` ([#439](https://github.com/SFML/SFML/issues/439), [#475](https://github.com/SFML/SFML/pull/475))
- [Windows] Fixed stack unalignment by two internal functions ([#412](https://github.com/SFML/SFML/issues/412))

### Window {: #2.2-window}

#### Features

- Added window methods to request and to check focus ([#518](https://github.com/SFML/SFML/issues/518), [#525](https://github.com/SFML/SFML/pull/525), [#613](https://github.com/SFML/SFML/pull/613), [#723](https://github.com/SFML/SFML/pull/723), [#735](https://github.com/SFML/SFML/pull/735))
- Provide name, manufacturer ID and product ID via `sf::Joystick` ([#152](https://github.com/SFML/SFML/issues/152), [#528](https://github.com/SFML/SFML/pull/528))
- [FreeBSD] Joystick support ([#477](https://github.com/SFML/SFML/issues/477))
- [macOS] Improved integration with menus and dock actions ([#11](https://github.com/SFML/SFML/issues/11))
- [macOS] Support for OpenGL 3.2 ([#84](https://github.com/SFML/SFML/issues/84))
- [macOS] Improved fullscreen support ([#343](https://github.com/SFML/SFML/issues/343))
- [macOS] Added support for retina displays ([#353](https://github.com/SFML/SFML/issues/353), [#388](https://github.com/SFML/SFML/pull/388))
- [Windows] Removed support for Windows 9x ([#469](https://github.com/SFML/SFML/issues/469))
- [Windows] Fixed typo in Windows keyboard implementation ([#516](https://github.com/SFML/SFML/issues/516))

#### Bugfixes

- `sf::Window::create()` now also resets framerate limit ([#371](https://github.com/SFML/SFML/issues/371))
- Fixed OpenGL context leak ([#635](https://github.com/SFML/SFML/pull/635), [#705](https://github.com/SFML/SFML/pull/705))
- Fixed various joystick problems (memory leak, accelerometer detected, code refactoring) ([#660](https://github.com/SFML/SFML/issues/660), [#686](https://github.com/SFML/SFML/pull/686), [#742](https://github.com/SFML/SFML/issues/742), [#743](https://github.com/SFML/SFML/pull/743))
- Optimized `sf::Window::waitEvent` a bit, no sleep if events are available at first try ([ff555d6](https://github.com/SFML/SFML/commit/ff555d6f851ddcc9815d34e294f7dbf44180ac90))
- [Linux] Output error message when `XOpenDisplay()` fails ([#508](https://github.com/SFML/SFML/issues/508), [#616](https://github.com/SFML/SFML/pull/616))
- [Linux] Resize window with `setSize` when `sf::Style::Resize` is set ([#466](https://github.com/SFML/SFML/issues/466))
- [Linux] Fixed broken key repeat on window recreation ([#564](https://github.com/SFML/SFML/issues/564), [#567](https://github.com/SFML/SFML/pull/567))
- [macOS] Fixes `KeyReleased` not being fired in fullscreen mode ([#465](https://github.com/SFML/SFML/issues/465))
- [macOS] Fixed an issue where disconnecting the keyboard would cause a crash ([#467](https://github.com/SFML/SFML/issues/467))
- [macOS] Fixed unexpected resizing behavior ([#468](https://github.com/SFML/SFML/issues/468))
- [macOS] Improved resizing windows ([#474](https://github.com/SFML/SFML/issues/474))
- [macOS] Fixed memory leak with `sf::Window::create()` ([#484](https://github.com/SFML/SFML/issues/484))
- [macOS] Fixed menu shortcuts in fullscreen on macOS ([#527](https://github.com/SFML/SFML/issues/527))
- [macOS] Improved cursor hiding ([#703](https://github.com/SFML/SFML/pull/703))
- [macOS] Fixed right click not detected with trackpads ([#716](https://github.com/SFML/SFML/issues/716), [#730](https://github.com/SFML/SFML/pull/730))
- [Windows] Fixed joystick POV values ([ef1d29b](https://github.com/SFML/SFML/commit/ef1d29bf73c76bfbf06155228de2e7abf1d13c00))
- [Windows] Fixed Unicode inconsistency ([#635](https://github.com/SFML/SFML/pull/635))
- [Windows] Fixed Alt+F4 and mouse clicks issues ([#437](https://github.com/SFML/SFML/issues/437), [#457](https://github.com/SFML/SFML/pull/457))
- [Windows] Send `MouseButtonReleased` event when the mouse is outside of the window ([#455](https://github.com/SFML/SFML/issues/455), [#457](https://github.com/SFML/SFML/pull/457))
- [Windows] Fixed `sf::Joystick` wrong registery usage ([#701](https://github.com/SFML/SFML/issues/701), [#702](https://github.com/SFML/SFML/pull/702), [#706](https://github.com/SFML/SFML/pull/706))

### Graphics {: #2.2-graphics}

#### Features

- Provide more information about the loaded font in `sf::Font` ([#164](https://github.com/SFML/SFML/issues/164))
- Implemented a more flexible blending system ([#298](https://github.com/SFML/SFML/issues/298))
- Added strikethrough text style ([#243](https://github.com/SFML/SFML/issues/243), [#362](https://github.com/SFML/SFML/pull/362), [#682](https://github.com/SFML/SFML/pull/682))
- Slight optimization for `sf::Text::setString` ([#413](https://github.com/SFML/SFML/issues/413))
- Added subtraction operator for `sf::Color` ([#114](https://github.com/SFML/SFML/issues/114), [#145](https://github.com/SFML/SFML/pull/145))
- Optimized `sf::Image::flipVertically/flipHorizontally` ([#555](https://github.com/SFML/SFML/pull/555))
- Changed `sf::Font` measurements from `int` to `float` to allow better underline drawing ([#693](https://github.com/SFML/SFML/pull/693))

#### Bugfixes

- Improved text quality for small and pixelated fonts ([#228](https://github.com/SFML/SFML/issues/228))
- Yet another fix for Intel GPUs with `sf::RenderTexture` ([#418](https://github.com/SFML/SFML/issues/418))
- Removed VTab since it cause issues and doesn't have a use nowadays ([#442](https://github.com/SFML/SFML/issues/442), [#445](https://github.com/SFML/SFML/pull/445), [#460](https://github.com/SFML/SFML/pull/460), [#588](https://github.com/SFML/SFML/pull/588))
- Fixed broken BDF and PCF font formats ([#448](https://github.com/SFML/SFML/issues/448))
- Fixed compilation issue with newer versions of GCC for `sf::Rect` ([#458](https://github.com/SFML/SFML/pull/458))
- Fixed `resetGLStates()` not explicitly setting the default polygon mode ([#480](https://github.com/SFML/SFML/issues/480))
- Fixed division-by-zero in `sf::RectangleShape` ([#499](https://github.com/SFML/SFML/issues/499))
- Fixed potential memory leak in `sf::Font` ([#509](https://github.com/SFML/SFML/pull/509))
- Updated glext and removed glxext ([#511](https://github.com/SFML/SFML/issues/511), [#583](https://github.com/SFML/SFML/pull/583))
- Make sure texture unit 0 is active when resetting `sf::RenderTarget` states ([#523](https://github.com/SFML/SFML/pull/523), [#591](https://github.com/SFML/SFML/pull/591))
- Fixed texture rect computation in fonts ([#669](https://github.com/SFML/SFML/pull/669))
- Improved rendering of underlined text ([#593](https://github.com/SFML/SFML/pull/593))
- Avoided repeated output of error messages ([#566](https://github.com/SFML/SFML/pull/566))
- Fixed text rendered with vertical offset on ascent and font size mismatch ([#576](https://github.com/SFML/SFML/pull/576))
- Fixed rounding problem for viewports ([#598](https://github.com/SFML/SFML/issues/598))
- Fixed `sf::Shader::isAvailable()` possibly breaking context management ([#211](https://github.com/SFML/SFML/issues/211), [#603](https://github.com/SFML/SFML/pull/603), [#608](https://github.com/SFML/SFML/issues/608), [#603](https://github.com/SFML/SFML/pull/609))
- Fixed `sf::Texture::getMaximumSize()` possibly breaking context management ([#666](https://github.com/SFML/SFML/pull/666))
- Fixed various `sf::Text` rendering issues ([#692](https://github.com/SFML/SFML/issues/692), [#699](https://github.com/SFML/SFML/pull/699))
- The texture matrix is now reset in `sf::Texture::bind(NULL)` ([7c4b058](https://github.com/SFML/SFML/commit/7c4b058c9a9682bf356ef1fa2d6c81e15b15b179))
- [Windows] Fixed DPI scaling causing strange window behavior ([#679](https://github.com/SFML/SFML/issues/679), [#681](https://github.com/SFML/SFML/pull/681), [#688](https://github.com/SFML/SFML/pull/688))

### Audio {: #2.2-audio}

#### Features

- Added support for selecting the audio capture device ([#220](https://github.com/SFML/SFML/issues/220), [#470](https://github.com/SFML/SFML/pull/470))
- Make `sf::SoundRecorder` processing frequency configurable ([#333](https://github.com/SFML/SFML/issues/333))
- Added up vector to `sf::Listener` ([#545](https://github.com/SFML/SFML/issues/545))

#### Bugfixes

- Prevented `sf::SoundStream::setPlayingOffset()` from restarting playing even when paused ([#203](https://github.com/SFML/SFML/issues/203), [#592](https://github.com/SFML/SFML/issues/203))
- Fixed `sf::SoundBuffer` contents not being able to be updated when still attached to sounds ([#354](https://github.com/SFML/SFML/issues/354), [367](https://github.com/SFML/SFML/pull/367), [#390](https://github.com/SFML/SFML/pull/390), [#589](https://github.com/SFML/SFML/pull/589))
- Catch audio format error and prevent division by zero ([#529](https://github.com/SFML/SFML/issues/529))
- Fixed sf::SoundBuffer returning wrong duration for sounds containing more than ~4.3 million samples ([2ff58ed](https://github.com/SFML/SFML/commit/2ff58edd9af5530afa0a58657c0908855c96ce21))
- Optimized `sf::Listener` with a cache ([d97e524](https://github.com/SFML/SFML/commit/d97e5244af0138aa5de6076ea13fb5ce1b6ed309))

### Network {: #2.2-network}

#### Features

- Added support for PUT and DELETE in `sf::Http` ([#257](https://github.com/SFML/SFML/issues/257), [#312](https://github.com/SFML/SFML/pull/312), [#607](https://github.com/SFML/SFML/pull/607))
- Added support for chunked HTTP transfers ([#296](https://github.com/SFML/SFML/issues/296), [#337](https://github.com/SFML/SFML/pull/337))
- Added support for 64-bit integers in `sf::Packet` ([#710](https://github.com/SFML/SFML/pull/710))
- Made `sf::Ftp::sendCommand()` public ([2c5cab5](https://github.com/SFML/SFML/commit/2c5cab5454658eb100b313ab031ed11ab73f311d))

#### Bugfixes

- Checked socket descriptor limit ([#153](https://github.com/SFML/SFML/issues/153), [#628](https://github.com/SFML/SFML/pull/628), [#683](https://github.com/SFML/SFML/pull/683))
- Fixed `sf::TcpSocket::connect()`'s switching from blocking to non-blocking mode on immediate connection success ([#221](https://github.com/SFML/SFML/pull/221))
- Fixed FTP download and upload file sizes being limited by available RAM ([#565](https://github.com/SFML/SFML/issues/565), [#590](https://github.com/SFML/SFML/pull/590))
- Fixes C++11 compiler warnings for `sf::Uint8` ([#731](https://github.com/SFML/SFML/issues/731), [#732](https://github.com/SFML/SFML/pull/732))

## SFML 2.1 {: #sfml-2.1}

### General {: #2.1-general}

- Updated the Window and OpenGL examples (got rid of GLU and immediate mode)

### Window {: #2.1-window}

#### Features

- Now using `inotify` on Linux to avoid constantly polling joystick connections ([#96](https://github.com/SFML/SFML/issues/96))
- Add keypad return, equal and period keys support for macOS
- Improved mouse events on macOS regarding fullscreen mode
- Improved mouse events on macOS ([#213](https://github.com/SFML/SFML/issues/213), [#277](https://github.com/SFML/SFML/issues/277))
- Improved reactivity of `setMousePosition` on macOS ([#290](https://github.com/SFML/SFML/issues/290))
- Added support for right control key on macOS
- Improved `TextEntered` for macOS ([#377](https://github.com/SFML/SFML/issues/377))
- Improved the performances of `Window::getSize()` (the size is now cached)
- Added the `WM_CLASS` property to SFML windows on Linux
- Fake resize events are no longer sent when the window is moved, on Linux
- Pressing ALT or F10 on Windows no longer steals the focus

#### Bugfixes

- Fixed `MouseMove` event sometimes not generated when holding left button on Windows ([#225](https://github.com/SFML/SFML/issues/225))
- Fixed `ContextSettings` ignored when creating a 3.x/4.x OpenGL context on Linux ([#258](https://github.com/SFML/SFML/issues/258))
- Fixed `ContextSettings` ignored on Linux when creating a window ([#35](https://github.com/SFML/SFML/issues/35))
- Fixed windows bigger than the desktop not appearing on Windows ([#215](https://github.com/SFML/SFML/issues/215))
- Fixed `KeyRelease` events sometimes not reported on Linux ([#404](https://github.com/SFML/SFML/issues/404))
- Fixed mouse moved event on macOS when dragging the cursor ([#277](https://github.com/SFML/SFML/issues/277))
- Fixed `KeyRelease` event with CMD key pressed ([#381](https://github.com/SFML/SFML/issues/381))
- Fixed taskbar bugs on Windows ([#328](https://github.com/SFML/SFML/issues/328), [#69](https://github.com/SFML/SFML/issues/69))
- Fixed `Window::getPosition()` on Linux ([#346](https://github.com/SFML/SFML/issues/346))
- Unicode characters outside the BMP (> `0xFFFF`) are now correctly handled on Windows ([#366](https://github.com/SFML/SFML/issues/366))

### Graphics {: #2.1-graphics}

#### Features

- Checking errors in `RenderTarget::pushGLStates()` to avoid generating false error messages when user leaves unchecked OpenGL errors ([#340](https://github.com/SFML/SFML/issues/340))
- Optimized `Shader::setParameter` functions, by using a cache internally ([#316](https://github.com/SFML/SFML/issues/316), [#358](https://github.com/SFML/SFML/issues/358))

#### Bugfixes

- Fixed bounding rect of `sf::Text` ignoring whitespaces ([#216](https://github.com/SFML/SFML/issues/216))
- Solved graphics resources not updated or corrupted when loaded in a thread ([#411](https://github.com/SFML/SFML/issues/411))
- Fixed white pixel showing on first character of `sf::Text` ([#414](https://github.com/SFML/SFML/issues/414))
- `sf::Rect::contains` and `sf::Rect::intersects` now handle rectangles with negative dimensions correctly ([#219](https://github.com/SFML/SFML/issues/219))
- Fixed `Shape::setTextureRect` not working when called before `setTexture`

### Audio {: #2.1-audio}

#### Features

- `loadFromStream` functions now explicitly reset the stream (`seek(0)`) before starting to read ([#349](https://github.com/SFML/SFML/issues/349))

#### Bugfixes

- Added a workaround for a bug in the macOS implementation of OpenAL (unsupported channel count no properly detected) ([#201](https://github.com/SFML/SFML/issues/201))
- Fixed `SoundBuffer::loadFromStream` reading past the end of the stream ([#214](https://github.com/SFML/SFML/issues/214))

### Network {: #2.1-network}

#### Features

- Replaced the deprecated `gethostbyname` with `getaddrinfo` ([#47](https://github.com/SFML/SFML/issues/47))
- Minor improvements to `sf::Packet` operators (now using `strlen` and `wcslen` instead of explicit loops) ([#118](https://github.com/SFML/SFML/issues/118))

#### Bugfixes

- Fixed non-blocking connection with a `sf::TcpSocket` on Windows
- Fixed TCP packet data corruption in non-blocking mode ([#402](https://github.com/SFML/SFML/issues/402), [#119](https://github.com/SFML/SFML/issues/119))
- On Unix systems, a socket disconnection no longer stops the program with signal `SIGPIPE` ([#72](https://github.com/SFML/SFML/issues/72))

## SFML 2.0 {: #sfml-2.0}

No changelog available. Everything changed.

## SFML 1.6 {: #sfml-1.6}

### General {: #1.6-general}

- SFML libraries are now be compiled with gcc 4.4.0 on Windows (MinGW)
- Updated the Qt sample
- Added a Cocoa sample
- Added support for 64 bits on Mac macOS 10.5 and greater

### System {: #1.6-system}

#### Bugfixes

- Fixed the initial seed of `sf::Randomizer` which is always the same on some configurations

### Window {: #1.6-window}

#### Features

- Increased the number of supported joysticks to 4
- Added return to the desktop resolution when the SFML fullscreen application is not active, on Mac macOS
- Added support for importing Cocoa widgets (in addition to Cocoa windows), on Mac macOS

#### Bugfixes

- Fixed inconsistencies with the state of the left/right shift keys on Windows
- Fixed joystick axes being sometimes ignored
- Fixed `Event::TextEntered` ignoring the key repeat state
- Fixed `KeyEvent.Alt`/`Control`/`Shift` members not working, in SFML.Net
- Fixed a crash happening when closing an imported window, on Mac macOS
- Fixed a bad behaviour when switching to fullscreen mode, on Mac macOS
- Fixed bips produced when pressing function or escape keys, on Mac macOS
- Fixed a conflict between SFML and Cocoa that may create memory leaks, on Mac macOS
- Fixed possible conflict between the SFML objective-C classes and the user's ones (using a private prefix in SFML), on Mac macOS
- Fixed wrong mouse coordinates when importing a Cocoa widget, on Mac macOS

### Graphics {: #1.6-graphics}

#### Features

- Disabled implicit conversion from `sf::Image` to `sf::Sprite`
- Made image loading thread-safe
- Improved accuracy of rendering

#### Bugfixes

- Fixed crash with the default font at global exit on Windows
- Fixed current OpenGL matrix mode not properly saved when `PreserveOpenGLStates` is activated
- Fixed a bug preventing image creation if no window was created, on Mac macOS

### Audio {: #1.6-audio}

#### Features

- Copied `Attenuation` and `MinDistance` members in `sf::Sound`'s copy constructor

#### Bugfixes

- Fixed crash when destroying a `SoundBuffer` used by a `Sound`
- Fixed tiny musics ignoring the "loop" flag
- Fixed musics sometimes being stuck after looping twice

### Network {: #1.6-network}

#### Features

- `Http::Response::GetField` is now case insensitive
- Added `"Connection: close"` by default for `HTTP 1.1` requests

#### Bugfixes

- Fixed crashes in `Ftp::Download` and `Ftp::Upload` with empty files
- Fixed `SocketTCP::Connect` with timeout returning success when connection failed
- Fixed `POST` requests not working with `sf::Http`

## SFML 1.5 {: #sfml-1.5}

### General {: #1.5-general}

- Fixed the code to make SFML compile on FreeBSD
- Added the OpenAL framework to the SDK on Mac macOS
- `libsndfile` is now linked dynamically on Mac macOS
- Added the XCode project files for CSFML
- Added Visual C++ project files for samples

### System {: #1.5-system}

#### Bugfixes

- Fixed bug with `std::locale` on Mac macOS
- The working directory is now initialized properly at startup on Mac macOS

### Window {: #1.5-window}

#### Features

- Updated the Qt sample and tutorial to work with Qt 4.5
- Added missing `VideoMode` functions to SFML.Net
- Added support for creating a `sf::Window` from a Cocoa window on Mac macOS
- Added support for composed characters on Mac macOS

#### Bugfixes

- Fixed application frozen if a USB joystick was plugged, on Windows
- Fixed joysticks sometimes not working at all on Vista
- Properly detect supported depths for video modes on Linux
- Fixed undefined behaviour when creating two fullscreen windows
- Fixed `Window::SetSize` not resizing to the requested size, on Windows
- Fixed `KeyPressed` event sometimes returning a null key code on Windows
- Fixed `EnableKeyRepeat` not working anymore after a second window has been created on Linux
- Fixed bug when destroying / recreating a window on Mac macOS
- Desktop resolution is properly restored when hiding the application on Mac macOS
- Fixed accentuated characters not properly retrieved on Mac macOS

### Graphics {: #1.5-graphics}

#### Features

- Modified the blending mode `Blend::Add` to use source alpha

#### Bugfixes

- Fixed 1-pixel offset in `Sprite::GetPixel` when `FlipX` or `FlipY` is set
- Fixed undefined behaviour when rendering a sprite bound to an empty image
- Fixed `sf::Image::Copy` to apply transparency of the source image
- Fixed `RenderWindow.CurrentView` not initialized in SFML.Net
- Fixed `Sprite.SubRect` and `String2D.GetRect` crash in SFML.Net
- Fixed global colors not properly exported in CSFML

### Audio {: #1.5-audio}

#### Features

- Added a function to disable sound spatialization

#### Bugfixes

- Fixed `Listener` functions being private in SFML.Net
- Fixed memory leaks when playing ogg audio files
- Fixed OpenAL error on macOS when calling `SoundStream::Stop`
- Fixed multi-threading issues in `sf::Music`
- Fixed `sf::SoundStream` (and `sf::Music`) not looping seamlessly

### Network {: #1.5-network}

#### Features

- Got rid of `whatismyip.org` as the default server for public IP retrieval
- Added a `timeout` parameter to `Http::SendRequest`

## SFML 1.4 {: #sfml-1.4}

### General {: #1.4-general}

- Added debug symbols to debug builds in Code::Blocks
- Added .Net binding
- Improved management of dependent resources
- Now using full unicode instead of `UCS-2` for all text-related events and strings
- Added minor version number to libraries names under Linux
- Added install path to Linux `makefile`s

### System {: #1.4-system}

#### Features

- Improved unicode support

### Window {: #1.4-window}

#### Features

- Now using signed integers for mouse coordinates to allow negative values
- Added cursor position in mouse events
- Added `sf::Window::SetIcon` function
- Added mouse enter / mouse leave window events
- Added `sf::Window::SetSize`

#### Bugfixes

- Fixed `sf::Window::EnableKeyRepeat` under Linux
- Fixed X11 sample (broken rendering on the first window)

### Graphics {: #1.4-graphics}

#### Features

- Added functions to copy images onto other images
- Added an option to have `sf::Image` instances not storing their pixels in memory
- Made SFML classes completely thread-safe regarding OpenGL calls
- Added `sf::String::GetCharacterPos` to get visual position of a string's character
- Added functions to convert from and to `drawable`s' local coordinates
- Added more functions to access `sf::Font`'s contents
- Added more accessors for `sf::Shape` points' attributes
- Optimized font's textures

#### Bugfixes

- Fixed `sf::Sprite::GetPixel` not taking flip x/y in account
- Fixed `sf::Matrix3` calculations

### Audio {: #1.4-audio}

#### Features

- Added `GetLoop`, `SetLoop` and `GetPlayingPosition` to sounds streams
- Removed dependency to the Visual C++ CRT in OpenAL32.dll
- Added seeking function to `sf::Sound`

#### Bugfixes

- Fixed `sf::SoundBufferRecorder` which couldn't be reused several times
- Fixed music clics under Linux

### Network {: #1.4-network}

#### Features

- Added a function to check end of packet
- Disabled Nagle's algorithm (buffering) in TCP sockets
- Added `HTTP` and `FTP` classes
- Added conversions from and to integer for IP address

#### Bugfixes

- Fixed `sf::Packet::OnSend` called multiple times if packet was sent more than once
- Fixed inconsistent socket initialization
- Fixed crash when using empty strings with packets

## SFML 1.3 {: #sfml-1.3}

### General {: #1.3-general}

- Added static build on Linux
- Fixed runtime errors with VC++ 2008 libraries

### System {: #1.3-system}

#### Features

- Added vector classes (`Vector2` and `Vector3`)

### Window {: #1.3-window}

#### Features

- Made event handling independent from display in `sf::Window`
- Replaced `sf::Window::SetCurrent` with `sf::Window::SetActive(bool)`
- Input states are now reseted in `sf::Input` when a window loses the focus
- Implemented the `TextEntered` event in Linux
- Added `sf::Window::Close` and `sf::Window::IsOpened`
- Added some missing key codes to the `sf::Key::Code` enumeration
- Added the `sf::Style::None` window style, and replaced `sf::Style::NoStyle` with `sf::Style::Titlebar`
- Added a function to enable / disable automatic key-repeat for `keypress` events
- `sf::Window::SetCursorPosition` no longer generates a `MouseMoved` event
- Added more options when creating a window (to have more control on OpenGL context settings)

#### Bugfixes

- Fixed bug when destroying a window and then creating a new one
- Fixed windows not closed after their `sf::Window` instance was destroyed (in Linux)
- Fixed a bug with joysticks in Windows

### Graphics {: #1.3-graphics}

#### Features

- Changed the `sf::Drawable` center of rotation to be the center of translation and scaling as well
- Improved the font interface / management (there's now a `sf::Font` class)
- Added styles to `sf::String` (bold / italic / underline)
- Added loading from memory for character fonts
- Added a class to draw simple shapes (`sf::Shape`)
- `RenderWindow::Draw` can now be called in cascade to allow hierarchies of `Drawable` objects
- Improved `sf::View` to make it more convenient and flexible

#### Bugfixes

- Fixed `sf::RenderWindow::Capture` returning a flipped image and/or crashing
- Fixed viewport issue when using custom OpenGL calls
- Fixed bug with `sf::String` scale and size
- Fixed bug when checking the size of a new image
- Fixed a bug with background color when running more than one `RenderWindow` at the same time
- Fixed pixel accuracy with non-smoothed images
- Fixed PNG loading failing on 64 bits systems

### Audio {: #1.3-audio}

#### Features

- SFML is now using OpenAL-Soft as the OpenAL implementation, which is more stable on Linux
- Added `SetMinDistance` and `SetAttenuation` for `Sound` and `Music` classes

#### Bugfixes

- Fixed wrong duration with ogg sounds and other formats musics
- Fixed failure to save a sound buffer to a file

### Network {: #1.3-network}

#### Features

- Added handling of wide strings (`std::wstring`, `const wchar_t*`) to `sf::Packet`
- Improved the interface of `sf::Selector` (`GetSocketsReady` is now replaced with `Wait` + `GetSocketReady`)
- Rewrote `sf::Selector` class to remove explicit dependency to `winsock` library on Windows
- Made insertions into packets faster

#### Bugfixes

- Fixed sockets sometimes receiving too much packet data
- Incomplete packets are now received properly in non-blocking mode

## SFML 1.2 {: #sfml-1.2}

### General {: #1.2-general}

- Added a Python binding (PySFML)
- Added a C wrapper for SFML
- SFML libraries are now compatible with Win 95/98/Me
- Added Visual C++ 2008 project files and compiled binaries
- Added functions to load images and sounds from files in memory

### Window {: #1.2-window}

#### Features

- Removed the `KeyReleased` event auto-repeat in Linux
- Added more axis and buttons for joysticks
- Added handling of two more buttons for mouse
- Improved flexibility of window styles
- Added the `sf::Window::Show` function to show or hide a SFML window
- Added the `sf::Window::SetCursorPosition` function to warp the mouse cursor to a given position
- Added the control, shift and alt keys for the `KeyPressed` and `KeyReleased` events

#### Bugfixes

- Fixed windows not updating their size properly on Linux
- Fixed a crash with the mouse wheel in Linux
- Fixed GLU issues with MinGW
- Fixed a bug with events in Linux, `sf::Window` instances can now be re-created correctly

### Graphics {: #1.2-graphics}

#### Features

- Added checking of maximum texture size when creating a `sf::Image`
- Improved text rendering, especially small characters
- Removed the looping error message when failed to load a font
- Removed `sf::Image::Update`, images are now updated automatically when needed
- Made color representations more consistent (all is RGBA, and no more `Uint32` manipulations)
- Added `SetBlendMode` function to `sf::Drawable` classes (can choose `Alpha`, `Add`, `Multiply` or `None`)
- Added `SetPosition`, `SetScaleX` and `SetScaleY` functions to `sf::Drawable` classes
- Added the ability to flip sprites on X and Y axis
- Added the ability to create flipped and/or mirrored views
- Got rid of DevIL and `zlib`
- Improved the integration of OpenGL functions into SFML rendering
- FreeType is now linked statically in Windows (no more need for the DLL)

#### Bugfixes

- Fixed memory leaks in font loading

### Audio {: #1.2-audio}

#### Features

- Added the `sf::Listener` class to control the audio listener properties
- Got rid of `libvorbis`, `libvorbisfile` and `libogg`

#### Bugfixes

- Fixed a bug with wrong OGG musics duration

### Network {: #1.2-network}

#### Features

- Added non-blocking mode for sockets
- Improved safety of data reading from packets
- Improved management of sockets state
- Added `Bind` and `Unbind` functions to UDP sockets

#### Bugfixes

- Fixed crash when sending an empty packet
- Fixed `sf::IPAddress::GetPublicAddress` which failed sometimes

## SFML 1.1 {: #sfml-1.1}

### General {: #1.1-general}

- Added the macOS port from Brad Leffler
- Added the Ruby binding from Sean O'Neil
- Added namespaces (now the SFML classes and functions are inside the `sf` namespace)
- Added a new sample (pong)
- Fixed CMake files, Linux Makefiles and Code::Blocks project files
- Removed an external dependency with GLEW in Linux

### System {: #1.1-system}

#### Features

- Added unicode support for String
- Added ability to get a `std::string` from a `String` object

#### Bugfixes

- `String` doesn't crash anymore in MinGW

### Window {: #1.1-window}

#### Features

- Added support for mouse wheel (`Event::MouseWheelMoved`)
- Added support for antialiasing
- Added `Window::SetPosition` and `RenderWindow::SetPosition`
- Added `Window::SetFramerateLimit` and `RenderWindow::SetFramerateLimit`
- Added a "`style`" parameter to replace the "`fullscreen`" one on window creation, to have more control over the window style
- Added the `Key::Pause` key

#### Bugfixes

- Fixed the bad behaviors with the mouse cursor in Windows
- Fixed `SFML/Window.hpp` now includes `OpenGLCaps.hpp` and `glew.h`
- Fixed the error loop when using the `Window` package in Linux
- Fixed bugs with window `style`s in some Linux systems

### Graphics {: #1.1-graphics}

#### Features

- Added more control over `drawables` size (added `Sprite::Resize` and made X and Y scales independent)
- Added `GetDepthBits` and `GetStencilBits` functions into `RenderWindow`
- Added an optional target `alpha` value for `Image::CreateMaskFromColor`
- Improved the `PostFX` sample (now displays an error message if post-effects are not supported)
- Added `+` and `*` operators to add and modulate `Color` instances

#### Bugfixes

- `Image`s are no more flipped when saved to a file
- `Sprite::GetPixel` now takes the scale and the overall color into account

### Audio {: #1.1-audio}

#### Bugfixes

- Fixed crashes on audio samples exit