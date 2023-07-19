<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'Bindings' => 'download/bindings.php',
        'SFML.Net' => 'download/sfml.net'
    );
    include('../../header.php');

    function download_link($version, $compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML.Net '" . $version . "']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>SFML.Net</h1>

<h2>Description</h2>
<p>
    SFML.Net is the official binding of SFML for the .Net language family (C#, VB.Net, C++/CLI, etc.). It is built on top of the C binding, CSFML, to ensure maximum
    compatibility across platforms. The API of SFML.Net is close to the C++ one, but in the .Net style: naming conventions are different, event handling uses native
    event support, etc. So don't hesitate to have a look at the API documentation and at the provided examples, before posting questions on the forum.
</p>
<p>
    Since the SFML.Net API is similar to SFML, there's no tutorial for it; but you can follow the C++ tutorials available on this website, and adapt them to your preferred .Net
    language very easily. The API documentation, generated from the source code, is available and included in the downloadable packages below.
</p>

<h2>Download</h2>
<p>
    The following archives contain everything that you need in order to work with SFML.Net: libraries, dependencies, examples and documentation.
</p>

<h3>Current sources</h3>
<p>
    The SFML.Net repository can be found at <a href="https://github.com/SFML/SFML.Net" title="SFML.Net repository on github">github.com</a>. From there, you can download
    the current source code (which contain the sources of the examples). You can also watch the open issues on the task tracker, or add new ones.
</p>

<h3>SFML.Net 2.5.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Official NuGet Package</span><a href="https://www.nuget.org/packages/SFML.Net/2.5.1" target="_blank">SFML.Net</a></td>
        </tr>
        <tr>
            <td><span class="description">Source code</span><a href="../../files/SFML.Net-2.5.1-sources.zip">Download<span class="size">0.84 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.5</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Official NuGet Package</span><a href="https://www.nuget.org/packages/SFML.Net/2.5.0" target="_blank">SFML.Net</a></td>
        </tr>
        <tr>
            <td><span class="description">Source code</span><a href="../../files/SFML.Net-2.5-sources.zip">Download<span class="size">0.85 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.4</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.4', 'All compilers', '32-bit', '2.86', '../../files/SFML.Net-2.4-32-bit.zip') ?></td>
            <td><?php download_link('2.4', 'All compilers', '64-bit', '2.99', '../../files/SFML.Net-2.4-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/SFML.Net-2.4-sources.zip">Download<span class="size">0.84 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.3</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.3', 'All compilers', '32-bit', '3.86', '../../files/SFML.Net-2.3-32-bit.zip') ?></td>
            <td><?php download_link('2.3', 'All compilers', '64-bit', '3.93', '../../files/SFML.Net-2.3-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/SFML.Net-2.3-sources.zip">Download<span class="size">0.79 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.2</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.2', 'All compilers', '32-bit', '4.66', '../../files/SFML.Net-2.2-32-bit.zip') ?></td>
            <td><?php download_link('2.2', 'All compilers', '64-bit', '4.64', '../../files/SFML.Net-2.2-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/SFML.Net-2.2-sources.zip">Download<span class="size">0.77 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.1', 'All compilers', '32-bit', '2.63', '../../files/SFML.Net-2.1-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'All compilers', '64-bit', '2.66', '../../files/SFML.Net-2.1-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/SFML.Net-2.1-sources.zip">Download<span class="size">2.70 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.0', 'All compilers', '32-bit', '2.43', '../../files/SFML.Net-2.0-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'All compilers', '64-bit', '2.62', '../../files/SFML.Net-2.0-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="../../files/SFML.Net-2.0-sources.zip">Download<span class="size">2.69 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer.php");
?>
