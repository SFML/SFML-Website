<?php
    $breadcrumbs = array
    (
        'Téléchargement' => 'download-fr.php',
        'SFML 2.2' => 'download/sfml/2.2/index-fr.php'
    );
    include('../../../header-fr.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.2']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Télécharger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>Télécharger SFML 2.2</h1>

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
                Sous Windows, choisir les bibliothèques 32 ou 64 bits doit se baser sur la plateforme pour laquelle vous voulez compiler, et non sur l'OS que vous avez.
                En effet, un Windows 64 bits peut parfaitement compiler et faire tourner un programme 32 bits. Vous voudrez donc très certainement utiliser les
                packages 32 bits, afin de cibler une audience la plus large possible. Choisissez les packages 64 bits uniquement si vous avez de bonnes raisons.
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
                Si vous possédez un Linux 64 bits alors vous avez la chaîne d'outils 64 bits installée par défaut. Compiler en 32 bits est possible, mais vous aurez à installer
                des paquets spécifiques et/ou utiliser des options de compilation spécifiques. Télécharger les bibliothèques 64 bits est donc la solution la plus simple si
                vous utilisez un Linux 64 bits.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="3">Mac OS X</td>
            <td><?php download_link('GCC', 'universel 32+64 bits (OS X 10.5+)', '5.63', 'SFML-2.2-osx-gcc-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Clang', 'universel 32+64 bits (OS X 10.8+, compatible C++11 et libc++)', '5.93', 'SFML-2.2-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td><span class="description">Templates pour Xcode 5</span><a href="SFML-2.2-osx-xcode5-template.zip">Télécharger<span class="size">1.16 Mo</span></a></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Les bibliothèques Mac OS X sont universelles, elles contiennent les versions 32 et 64 bits de SFML et peuvent donc être utilisées indifféremment pour du
                développement 32 et/ou 64 bits.
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous OS</td>
            <td><span class="description">Code source</span><a href="SFML-2.2-sources.zip">Télécharger<span class="size">9.27 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
