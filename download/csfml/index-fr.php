<?php
    $breadcrumbs = array
    (
        'T�l�chargement' => 'download-fr.php',
        'Bindings' => 'download/bindings-fr.php',
        'CSFML' => 'download/csfml/index-fr.php'
    );
    include('../../header-fr.php');

    function download_link($version, $compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'CSFML '" . $version . "']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">T�l�charger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>CSFML</h1>

<h2>Description</h2>
<p>
    CSFML est le binding officiel de SFML pour le langage C. Son API est aussi proche que possible que l'API C++ (mais dans le style C, bien entendu), ce qui en fait un
    candidat parfait pour construire des bindings SFML pour d'autres langages qui ne supportent pas directement les biblioth�ques C++.
</p>
<p>
    Etant donn� que l'API de CSFML est similaire � celle de SFML, il n'y a pas de tutoriels ; mais vous pouvez consulter les tutoriels C++ disponibles sur ce site, et les
    adapter facilement � l'API C. La documentation de l'API, g�n�r�e � partir du code source, est quant � elle disponible et incluse dans les archives t�l�chargeables ci-dessous.
</p>

<h2>T�l�chargements</h2>
<p>
    Les archives ci-dessous contiennent tout ce qu'il faut pour d�velopper avec CSFML : fichiers d'en-t�te, biblioth�ques, d�pendances, et documentation.
</p>
<p>
    Puisque c'est une biblioth�que C, il n'y a qu'une archive par OS/architecture, qui fonctionne avec n'importe quel compilateur. L'archive Windows contient les biblioth�ques
    d'importation pour Visual C++ et MinGW (gcc) ; celles-ci sont compatibles avec toutes les versions du compilateur correspondant.
</p>

<h3>Sources actuelles</h3>
<p>
    Le d�p�t de CSFML se trouve sur <a href="https://github.com/LaurentGomila/CSFML" title="D�p�t de CSFML sur github">github.com</a>. Depuis ce d�p�t, vous pouvez
    t�l�charger un instantan� des toutes derni�res sources. Vous pouvez aussi consulter les t�ches ou bugs en cours sur le tracker, ainsi qu'en ajouter de nouveaux.
</p>

<h3>CSFML 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os">Windows</td>
            <td><?php download_link('2.1', 'Visual C++ / GCC', '32 bits', '4.04', 'CSFML-2.1-windows-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'Visual C++ / GCC', '64 bits', '10.0', 'CSFML-2.1-windows-64bits.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Linux</td>
            <td><?php download_link('2.1', 'GCC', '32 bits', '0.41', 'CSFML-2.1-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('2.1', 'GCC', '64 bits', '0.39', 'CSFML-2.1-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td colspan="2"><?php download_link('2.1', 'GCC', 'universel 32+64 bits (OS X 10.5+)', '0.99', 'CSFML-2.1-osx-gcc-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('2.1', 'Clang', 'universel 32+64 bits (OS X 10.8+, compatible C++11 et libc++)', '0.65', 'CSFML-2.1-osx-clang-universal.tar.gz') ?></td>
        </tr>
        <tr>
            <td class="os">Tous OS</td>
            <td colspan="2"><span class="description">Code source</span><a href="CSFML-2.1-sources.zip">T�l�charger<span class="size">0.25 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>CSFML 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os">Windows</td>
            <td><?php download_link('2.0', 'Visual C++ / GCC', '32 bits', '4.21', 'CSFML-2.0-windows-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'Visual C++ / GCC', '64 bits', '10.2', 'CSFML-2.0-windows-64bits.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Linux</td>
            <td><?php download_link('2.0', 'GCC', '32 bits', '0.51', 'CSFML-2.0-linux-gcc-32bits.tar.bz2') ?></td>
            <td><?php download_link('2.0', 'GCC', '64 bits', '0.48', 'CSFML-2.0-linux-gcc-64bits.tar.bz2') ?></td>
        </tr>
        <tr>
            <td class="os" rowspan="2">Mac OS X</td>
            <td colspan="2"><?php download_link('2.0', 'GCC', 'universel 32+64 bits (OS X 10.5+)', '0.62', 'CSFML-2.0-osx-gcc-universal.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php download_link('2.0', 'Clang', 'universel 32+64 bits (OS X 10.8+, compatible C++11 et libc++)', '0.64', 'CSFML-2.0-osx-clang-universal.zip') ?></td>
        </tr>
        <tr>
            <td class="os">Tous OS</td>
            <td colspan="2"><span class="description">Code source</span><a href="CSFML-2.0-sources.zip">T�l�charger<span class="size">0.25 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer-fr.php");
?>
