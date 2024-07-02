<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'SFML 2.6.1' => 'download/sfml/2.6.1'
    );
    include('../../../header.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.6.1']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>Download SFML 2.6.1</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="notice" colspan="3">
                On Windows, choosing 32 or 64-bit libraries should be based on which platform you want to compile for, not which OS you have. Indeed, you can perfectly
                compile and run a 32-bit program on a 64-bit Windows. So you'll most likely want to target 32-bit platforms, to have the largest possible audience.
                Choose 64-bit packages only if you have good reasons.
                <div class="important">
                    <strong>Unless you are using a newer version of Visual Studio, the compiler versions have to match 100%!</strong><br>
                    Here are links to the specific MinGW compiler versions used to build the provided packages:<br>
                    <a href="https://github.com/brechtsanders/winlibs_mingw/releases/download/13.1.0-16.0.5-11.0.0-msvcrt-r5/winlibs-i686-posix-dwarf-gcc-13.1.0-mingw-w64msvcrt-11.0.0-r5.7z">WinLibs MSVCRT 13.1.0 (32-bit)</a>,
                    <a href="https://github.com/brechtsanders/winlibs_mingw/releases/download/13.1.0-16.0.5-11.0.0-msvcrt-r5/winlibs-x86_64-posix-seh-gcc-13.1.0-mingw-w64msvcrt-11.0.0-r5.7z">WinLibs MSVCRT 13.1.0 (64-bit)</a>
                </div>
            </td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 17 (2022)', '32-bit', '20.3', '../../../files/SFML-2.6.1-windows-vc17-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 17 (2022)', '64-bit', '21.8', '../../../files/SFML-2.6.1-windows-vc17-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 16 (2019)', '32-bit', '19.3', '../../../files/SFML-2.6.1-windows-vc16-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 16 (2019)', '64-bit', '20.7', '../../../files/SFML-2.6.1-windows-vc16-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 15 (2017)', '32-bit', '17.6', '../../../files/SFML-2.6.1-windows-vc15-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 15 (2017)', '64-bit', '19.4', '../../../files/SFML-2.6.1-windows-vc15-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 13.1.0 MinGW (DW2)', '32-bit', '17.9', '../../../files/SFML-2.6.1-windows-gcc-13.1.0-mingw-32-bit.zip') ?></td>
            <td><?php download_link('GCC 13.1.0 MinGW (SEH)', '64-bit', '18.9', '../../../files/SFML-2.6.1-windows-gcc-13.1.0-mingw-64-bit.zip') ?></td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="notice" colspan="3">
                On Linux, if you have a 64-bit OS then you have the 64-bit toolchain installed by default. Compiling for 32-bit is possible, but you have to install
                specific packages and/or use specific compiler options to do so. So downloading the 64-bit libraries is the easiest solution if you're on a 64-bit Linux.<br />
                If you require a 32-bit build of SFML you'll have to <a href="/tutorials/2.6/compile-with-cmake.php">build it yourself</a>.
                <div class="important">
                    It's recommended to use the SFML version from your package manager (if recent enough) or build from source to prevent incompatibilities.
                </div>
            </td>
        </tr>
        <tr>
            <td class="os" rowspan="2">Linux</td>
            <td><?php download_link('GCC', '64-bit', '8.72', '../../../files/SFML-2.6.1-linux-gcc-64-bit.tar.gz') ?></td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="3">macOS</td>
            <td><?php download_link('Clang', '64-bit (macOS 10.15+, compatible with C++11 and libc++)', '5.07', '../../../files/SFML-2.6.1-macOS-clang-64-bit.tar.gz') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Clang', 'ARM64 (macOS 11+)', '5.02', '../../../files/SFML-2.6.1-macOS-clang-arm64.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                macOS libraries are only compatible with 64-bit and ARM64 (M1 / M2) systems.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Source code</span><a href="../../../files/SFML-2.6.1-sources.zip">Download<span class="size">24.7 MB</span></a></td>
        </tr>
        <tr>
            <td><span class="description">HTML Documentation</span><a href="../../../files/SFML-2.6.1-doc.zip">Download<span class="size">2.03 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
