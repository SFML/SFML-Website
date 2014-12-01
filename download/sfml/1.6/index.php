<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'SFML 1.6' => 'download/sfml/1.6'
    );
    include('../../../header.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 1.6']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Download<span class="size">' . $size . ' MB</span></a>';
    }
?>

<h1>Download SFML 1.6</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="5">Windows</td>
            <td colspan="2"><?php download_link('MinGW 4.4 DW2', '32-bit', '34.4', 'SFML-1.6-sdk-windows-mingw.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('Visual C++ 8 (2005)', '32-bit', '23.3', 'SFML-1.6-sdk-windows-vc2005.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('Visual C++ 9 (2008)', '32-bit', '23.5', 'SFML-1.6-sdk-windows-vc2008.zip') ?></td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="1">Linux</td>
            <td><?php download_link('GCC', '32-bit', '12.9', 'SFML-1.6-sdk-linux-32.tar.gz') ?></td>
            <td><?php download_link('GCC', '64-bit', '13.0', 'SFML-1.6-sdk-linux-64.tar.gz') ?></td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td><?php download_link('GCC', '32-bit', '16.2', 'SFML-1.6-sdk-macosx-ub32.tar.bz2') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC', '32+64-bit', '17.9', 'SFML-1.6-sdk-macosx-ub32%2B64.tar.bz2') ?></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
