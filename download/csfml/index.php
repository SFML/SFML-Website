<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'Bindings' => 'download/bindings.php',
        'CSFML' => 'download/csfml'
    );
    include('../../header.php');

    function download_link($version, $compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'CSFML '" . $version . "']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>CSFML</h1>

<h2>Description</h2>
<p>
    CSFML is the official binding of SFML for the C language. Its API is as close as possible to the C++ API (but in C style, of course), which makes it a perfect tool for
    building SFML bindings for other languages that don't directly support C++ libraries.
</p>
<p>
    Since the CSFML API is similar to SFML, there's no tutorial for it; but you can follow the C++ tutorials available on this website, and adapt them to the C API very easily.
    The API documentation, generated from the source code, is available and included in the downloadable packages below.
</p>

<h2>Download</h2>
<p>
    The following archives contain everything that you need in order to work with CSFML: headers, libraries, dependencies, and documentation.
</p>
<p>
    Since it's a C library, there's only one archive per OS/architecture, which works for any compiler. The Windows archive contains the import libraries for Visual C++ and
    MinGW (gcc); those are compatible with every version of the corresponding compiler.
</p>

<h3>Current sources</h3>
<p>
    The CSFML repository can be found at <a href="https://github.com/LaurentGomila/CSFML" title="CSFML repository on github">github.com</a>. From there, you can download
    the current source code. You can also watch the open issues on the task tracker, or add new ones.
</p>

<h3>CSFML 2.2</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os">Windows</td>
            <td><?php download_link('2.2', 'Visual C++ / GCC', '32-bit', '3.33', '../../files/CSFML-2.2-windows-32-bit.zip') ?></td>
            <td><?php download_link('2.2', 'Visual C++ / GCC', '64-bit', '3.40', '../../files/CSFML-2.2-windows-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Linux</td>
            <td><?php download_link('2.2', 'GCC', '32-bit', '1.48', '../../files/CSFML-2.2-linux-gcc-32-bit.tar.bz2') ?></td>
            <td><?php download_link('2.2', 'GCC', '64-bit', '1.47', '../../files/CSFML-2.2-linux-gcc-64-bit.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="os">Mac OS X</td>
            <td colspan="2"><?php download_link('2.2', 'Clang', 'universal 32+64-bit (OS X 10.7+, compatible with C++11 and libc++)', '0.20', '../../files/CSFML-2.2-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="os">All</td>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/CSFML-2.2-sources.zip">Download<span class="size">0.25 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>CSFML 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os">Windows</td>
            <td><?php download_link('2.1', 'Visual C++ / GCC', '32-bit', '4.04', '../../files/CSFML-2.1-windows-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'Visual C++ / GCC', '64-bit', '10.0', '../../files/CSFML-2.1-windows-64bits.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Linux</td>
            <td><?php download_link('2.1', 'GCC', '32-bit', '0.41', '../../files/CSFML-2.1-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('2.1', 'GCC', '64-bit', '0.39', '../../files/CSFML-2.1-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td colspan="2"><?php download_link('2.1', 'GCC', 'universal 32+64-bit (OS X 10.5+)', '0.62', '../../files/CSFML-2.1-osx-gcc-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('2.1', 'Clang', 'universal 32+64-bit (OS X 10.8+, compatible with C++11 and libc++)', '0.64', '../../files/CSFML-2.1-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="os">All</td>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/CSFML-2.1-sources.zip">Download<span class="size">0.25 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>CSFML 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os">Windows</td>
            <td><?php download_link('2.0', 'Visual C++ / GCC', '32-bit', '4.21', '../../files/CSFML-2.0-windows-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'Visual C++ / GCC', '64-bit', '10.2', '../../files/CSFML-2.0-windows-64bits.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Linux</td>
            <td><?php download_link('2.0', 'GCC', '32-bit', '0.51', '../../files/CSFML-2.0-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('2.0', 'GCC', '64-bit', '0.48', '../../files/CSFML-2.0-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td colspan="2"><?php download_link('2.0', 'GCC', 'universal 32+64-bit (OS X 10.5+)', '0.99', '../../files/CSFML-2.0-osx-gcc-universal.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('2.0', 'Clang', 'universal 32+64-bit (OS X 10.8+, compatible with C++11 and libc++)', '0.99', '../../files/CSFML-2.0-osx-clang-universal.zip') ?></td>
        </tr>
        <tr>
            <td class="os">All</td>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/CSFML-2.0-sources.zip">Download<span class="size">0.25 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer.php");
?>
