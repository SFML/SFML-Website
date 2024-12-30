<?php
    $breadcrumbs = array
    (
        'Téléchargement' => 'download-fr.php',
        'SFML 2.6.1' => 'download/sfml/2.6.1/index-fr.php'
    );
    include('../../../header-fr.php');

    function download_link($compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML 2.6.1']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Télécharger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>Télécharger SFML 2.6.1</h1>

<table class="styled download">
    <tbody>
        <tr>
            <td class="notice" colspan="3">
                Sous Windows, choisir les bibliothèques 32 ou 64-bit doit se baser sur la plateforme pour laquelle vous voulez compiler, et non sur l'OS que vous avez.
                En effet, un Windows 64-bit peut parfaitement compiler et faire tourner un programme 32-bit. Vous voudrez donc très certainement utiliser les
                packages 32-bit, afin de cibler une audience la plus large possible. Choisissez les packages 64-bit uniquement si vous avez de bonnes raisons.<br>
                <div class="important">
                    <strong>À moins que vous n'utilisiez une version plus récente de Visual Studio, la version du compilateur doit correspondre à 100%!</strong><br>
                    Voici les liens vers les versions du compilateur MinGW qui ont été utilisées pour compiler les paquets fournis :<br>
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
            <td><?php download_link('GCC 13.1.0 MinGW (SEH)', '64-bit', '18.0', '../../../files/SFML-2.6.1-windows-gcc-13.1.0-mingw-64-bit.zip') ?></td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="notice" colspan="3">
                Si vous possédez un Linux 64-bit alors vous avez la chaîne d'outils 64-bit installée par défaut. Compiler en 32-bit est possible, mais vous aurez à installer
                des paquets spécifiques et/ou utiliser des options de compilation spécifiques. Télécharger les bibliothèques 64-bit est donc la solution la plus simple si
                vous utilisez un Linux 64-bit.<br />
                Si vous avez besoin d'une version 32-bit de SFML, il vous faudra <a href="/tutorials/2.6/compile-with-cmake-fr.php">compiler la bibliothèque vous-même</a>.
                <div class="important">
                    Il est recommandé d'utiliser la version de SFML fournie par votre gestionnaire de paquets (si elle est suffisamment récente), ou de compiler SFML depuis ses sources pour éviter des problèmes d'incompatibilité.
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
            <td><?php download_link('Clang', '64-bit (macOS 10.15+, compatible C++11 et libc++)', '5.07', '../../../files/SFML-2.6.1-macOS-clang-64-bit.tar.gz') ?></td>
        </tr>
        <tr>
            <td><?php download_link('Clang', 'ARM64 (macOS 11+)', '5.02', '../../../files/SFML-2.6.1-macOS-clang-arm64.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="notice" colspan="3">
                Les bibliothèques macOS sont uniquement compatible avec les systèmes 64-bit et ARM64 (M1 / M2 / M3 / M4).
            </td>
        </tr>
    </tbody>
</table>

<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous OS</td>
            <td><span class="description">Code source</span><a href="../../../files/SFML-2.6.1-sources.zip">Télécharger<span class="size">24.7 Mo</span></a></td>
        </tr>
        <tr>
            <td><span class="description">Documentation HTML</span><a href="../../../files/SFML-2.6.1-doc.zip">Télécharger<span class="size">2.03 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../../footer.php");
?>
