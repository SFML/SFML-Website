<?php
    $breadcrumbs = array
    (
        'Téléchargement' => 'download-fr.php',
        'SFML 2.3.1' => 'download/sfml/2.3.1/index-fr.php'
    );
    include('../../../header-fr.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.3.1']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Télécharger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>Télécharger SFML 2.3.1</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="6">Windows</td>
            <td><?php download_link('Visual C++ 10 (2010)', '32-bit', '11.9', '../../../files/SFML-2.3.1-windows-vc10-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 10 (2010)', '64-bit', '13.3', '../../../files/SFML-2.3.1-windows-vc10-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 11 (2012)', '32-bit', '13.5', '../../../files/SFML-2.3.1-windows-vc11-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 11 (2012)', '64-bit', '15.1', '../../../files/SFML-2.3.1-windows-vc11-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Visual C++ 12 (2013)', '32-bit', '12.9', '../../../files/SFML-2.3.1-windows-vc12-32-bit.zip') ?></td>
            <td><?php download_link('Visual C++ 12 (2013)', '64-bit', '14.5', '../../../files/SFML-2.3.1-windows-vc12-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.7.1 TDM (SJLJ)', '32-bit', '13.5', '../../../files/SFML-2.3.1-windows-gcc-4.7.1-tdm-32-bit.zip') ?></td>
            <td><?php download_link('GCC 4.7.1 TDM (SJLJ)', '64-bit', '16.3', '../../../files/SFML-2.3.1-windows-gcc-4.7.1-tdm-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.8.1 TDM (SJLJ)', '32-bit', '13.3', '../../../files/SFML-2.3.1-windows-gcc-4.8.1-tdm-32-bit.zip') ?></td>
            <td><?php download_link('GCC 4.8.1 TDM (SJLJ)', '64-bit', '15.3', '../../../files/SFML-2.3.1-windows-gcc-4.8.1-tdm-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td><?php download_link('GCC 4.9.2 MinGW (DW2)', '32-bit', '13.6', '../../../files/SFML-2.3.1-windows-gcc-4.9.2-mingw-32-bit.zip') ?></td>
            <td><?php download_link('GCC 4.9.2 MinGW (SEH)', '64-bit', '14.5', '../../../files/SFML-2.3.1-windows-gcc-4.9.2-mingw-64-bit.zip') ?></td>
        <tr>
        <tr>
            <td class="notice" colspan="3">
                Sous Windows, choisir les bibliothèques 32 ou 64-bit doit se baser sur la plateforme pour laquelle vous voulez compiler, et non sur l'OS que vous avez.
                En effet, un Windows 64-bit peut parfaitement compiler et faire tourner un programme 32-bit. Vous voudrez donc très certainement utiliser les
                packages 32-bit, afin de cibler une audience la plus large possible. Choisissez les packages 64-bit uniquement si vous avez de bonnes raisons.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="1">Linux</td>
            <td><?php download_link('GCC', '32-bit', '2.0', '../../../files/SFML-2.3.1-linux-gcc-32-bit.tar.gz') ?></td>
            <td><?php download_link('GCC', '64-bit', '2.0', '../../../files/SFML-2.3.1-linux-gcc-64-bit.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Si vous possédez un Linux 64-bit alors vous avez la chaîne d'outils 64-bit installée par défaut. Compiler en 32-bit est possible, mais vous aurez à installer
                des paquets spécifiques et/ou utiliser des options de compilation spécifiques. Télécharger les bibliothèques 64-bit est donc la solution la plus simple si
                vous utilisez un Linux 64-bit.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="3">Mac OS X</td>
            <td><?php download_link('Clang', 'universel 32+64-bit (OS X 10.7+, compatible C++11 et libc++)', '6.3', '../../../files/SFML-2.3.1-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Les bibliothèques Mac OS X sont universelles: elles contiennent les versions 32 et 64-bit de SFML et peuvent donc être utilisées indifféremment pour du
                développement 32 et/ou 64-bit.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous OS</td>
            <td><span class="description">Code source</span><a href="../../../files/SFML-2.3.1-sources.zip">Télécharger<span class="size">21.5 Mo</span></a></td>
        </tr>
        <tr>
            <td><span class="description">Documentation HTML</span><a href="../../../files/SFML-2.3.1-doc.zip">Télécharger<span class="size">1.43 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
