<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'SFML 2.2' => 'download/sfml/2.2'
    );
    include('../../../header.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.2']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>Download SFML 2.2</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="5">Windows</td>
            <td><?php download_link('Visual C++ 9 (2008)', '32 bits', '9.80', 'SFML-2.2-windows-vc9-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 9 (2008)', '64 bits', '11.0', 'SFML-2.2-windows-vc9-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 10 (2010)', '32 bits', '10.3', 'SFML-2.2-windows-vc10-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 10 (2010)', '64 bits', '11.5', 'SFML-2.2-windows-vc10-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 11 (2012)', '32 bits', '11.5', 'SFML-2.2-windows-vc11-32bits.zip') ?></td>
            <td><?php download_link('Visual C++ 11 (2012)', '64 bits', '12.9', 'SFML-2.2-windows-vc11-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.7 TDM (SJLJ)', '32 bits', '15.0', 'SFML-2.2-windows-gcc-4.7-tdm-32bits.zip') ?></td>
            <td><?php download_link('GCC 4.7 TDM (SJLJ)', '64 bits', '41.0', 'SFML-2.2-windows-gcc-4.7-tdm-64bits.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.7 MinGW (DW2)', '32 bits', '10.6', 'SFML-2.2-windows-gcc-4.7-mingw-32bits.zip') ?></td>
            <td></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                On Windows, choosing 32 or 64 bits libraries should be based on which platform you want to compile for, not which OS you have. Indeed, you can perfectly
                compile and run a 32 bits program on a 64 bits Windows. So you'll most likely want to target 32 bits platforms, to have the largest possible audience.
                Choose 64 bits packages only if you have good reasons.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="1">Linux</td>
            <td><?php download_link('GCC', '32 bits', '1.35', 'SFML-2.2-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('GCC', '64 bits', '1.34', 'SFML-2.2-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                On Linux, if you have a 64 bits OS then you have the 64 bits toolchain installed by default. Compiling for 32 bits is possible, but you have to install
                specific packages and/or use specific compiler options to do so. So downloading the 64 bits libraries is the easiest solution if you're on a 64 bits Linux.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="3">Mac OS X</td>
            <td><?php download_link('GCC', 'universal 32+64 bits (OS X 10.5+)', '5.63', 'SFML-2.2-osx-gcc-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Clang', 'universal 32+64 bits (OS X 10.8+, compatible with C++11 and libc++)', '5.93', 'SFML-2.2-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td><span class="description">Templates for Xcode 5</span><a href="SFML-2.2-osx-xcode5-template.zip">Download<span class="size">1.16 MB</span></a></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Mac OS X libraries are universal, they contain both the 32 and 64 bits versions of SFML and can therefore be used for both 32 and 64 bits builds.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Source code</span><a href="SFML-2.2-sources.zip">Download<span class="size">9.27 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
