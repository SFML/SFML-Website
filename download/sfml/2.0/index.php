<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'SFML 2.0' => 'download/sfml/2.0'
    );
    include('../../../header.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.0']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>Download SFML 2.0</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="5">Windows</td>
            <td><?php download_link('Visual C++ 9 (2008)', '32-bit', '9.75', 'SFML-2.0-windows-vc9-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 9 (2008)', '64-bit', '10.9', 'SFML-2.0-windows-vc9-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 10 (2010)', '32-bit', '10.3', 'SFML-2.0-windows-vc10-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 10 (2010)', '64-bit', '11.4', 'SFML-2.0-windows-vc10-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 11 (2012)', '32-bit', '11.4', 'SFML-2.0-windows-vc11-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 11 (2012)', '64-bit', '12.8', 'SFML-2.0-windows-vc11-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.7 TDM (SJLJ)', '32-bit', '15.0', 'SFML-2.0-windows-gcc-4.7-tdm-32bits.zip') ?></td>
            <td><?php download_link('GCC 4.7 TDM (SJLJ)', '64-bit', '40.9', 'SFML-2.0-windows-gcc-4.7-tdm-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.7 MinGW (DW2)', '32-bit', '10.6', 'SFML-2.0-windows-gcc-4.7-mingw-32bits.zip') ?></td>
            <td></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                On Windows, choosing 32 or 64-bit libraries should be based on which platform you want to compile for, not which OS you have. Indeed, you can perfectly
                compile and run a 32-bit program on a 64-bit Windows. So you'll most likely want to target 32-bit platforms, to have the largest possible audience.
                Choose 64-bit packages only if you have good reasons.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="1">Linux</td>
            <td><?php download_link('GCC', '32-bit', '1.34', 'SFML-2.0-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('GCC', '64-bit', '1.34', 'SFML-2.0-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                On Linux, if you have a 64-bit OS then you have the 64-bit toolchain installed by default. Compiling for 32-bit is possible, but you have to install
                specific packages and/or use specific compiler options to do so. So downloading the 64-bit libraries is the easiest solution if you're on a 64-bit Linux.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td><?php download_link('GCC', 'universal 32+64-bit (OS X 10.5+)', '5.90', 'SFML-2.0-osx-gcc-universal.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Clang', 'universal 32+64-bit (OS X 10.8+, compatible with C++11 and libc++)', '6.05', 'SFML-2.0-osx-clang-universal.zip') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Mac OS X libraries are universal, they contain both the 32 and 64-bit versions of SFML and can therefore be used for both 32 and 64-bit builds.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Source code</span><a href="SFML-2.0-sources.zip">Download<span class="size">12.5 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
