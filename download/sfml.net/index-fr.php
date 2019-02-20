<?php
    $breadcrumbs = array
    (
        'Téléchargement' => 'download-fr.php',
        'Bindings' => 'download/bindings-fr.php',
        'SFML.Net' => 'download/sfml.net/index-fr.php'
    );
    include('../../header-fr.php');

    function download_link($version, $compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML.Net'" . $version . "']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">Télécharger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>SFML.Net</h1>

<h2>Description</h2>
<p>
    SFML.Net est le binding officiel de SFML pour la famille de langages .Net (C#, VB.Net, C++/CLI, etc.). Il est construit par dessus le binding C, CSFML, afin d'assurer
    une compatibilité maximale entre les plateformes (i.e. il fonctionne avec Mono). L'API de SFML.Net est proche de l'API C++, mais dans le style .Net : les conventions
    de nommage sont différentes, la gestion des évènements utilise les évènements natifs du langage, etc. Donc, n'hésitez pas à jeter un oeil à la documentation de l'API ainsi
    qu'aux exemples fournis, avant de poser une question sur le forum.
</p>
<p>
    Comme l'API de SFL.Net est proche de celle de SFML, il n'y a pas de tutoriels ; mais vous pouvez consulter les tutoriels C++ disponibles sur ce site, et les adapter
    facilement à votre langage .Net préféré. La documentation de l'API, générée à partir du code source, est quant à elle disponible et incluse dans les archives 
    téléchargeables ci-dessous.
</p>

<h2>Téléchargements</h2>
<p>
    Les archives ci-dessous contiennent tout ce qu'il faut pour développer avec SFML.Net : bibliothèques, dépendances, exemples et documentation.
</p>
<p>
    Comme c'est une bibliothèque .Net, il n'y a qu'une archive par architecture, qui fonctionne avec n'importe quel OS et compilateur. Cependant, comme le nom des bibliothèques
    CSFML apparaît dans le code et est différent pour chaque OS, pour OS X et Linux vous devrez écrire un petit fichier de configuration qui fait la correspondance entre le
    nom des DLLs CSFML et le nom des bibliothèques CSFML de votre OS (par exemple, "csfml-graphics-2.dll" -> "libcsfml-graphics.so.2") ; vous pouvez consulter
    <a href="http://www.mono-project.com/DllMap" title="Mono DLL map">la documentation de Mono</a> pour plus de détails.
</p>
<p>
    Les dépendences fournies dans les archives sont pour Windows uniquement ; pour les autres OS, vous devrez installer les dépendences requises (CSFML, SFML et ses propres
    dépendences) vous-même.
</p>

<h3>Sources actuelles</h3>
<p>
    Le dépôt de SFML.Net se trouve sur <a href="https://github.com/SFML/SFML.Net" title="Dépôt de SFML.Net sur github">github.com</a>. Depuis ce dépôt, vous pouvez
    télécharger un instantané des toutes dernières sources (contenant notamment le code des exemples). Vous pouvez aussi consulter les tâches ou bugs en cours sur le tracker,
    ainsi qu'en ajouter de nouveaux.
</p>

<h3>SFML.Net 2.5</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><span class="description">Package officiel de NuGet</span><a href="https://www.nuget.org/packages/SFML.Net/" target="_blank">SFML.Net</a></td>
        </tr>
        <tr>
            <td><span class="description">Code source</span><a href="../../files/SFML.Net-2.5-sources.zip">Télécharger<span class="size">0.85 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.4</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.4', 'Tous compilateurs', '32-bit', '2.86', '../../files/SFML.Net-2.4-32-bit.zip') ?></td>
            <td><?php download_link('2.4', 'Tous compilateurs', '64-bit', '2.99', '../../files/SFML.Net-2.4-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="../../files/SFML.Net-2.4-sources.zip">Télécharger<span class="size">0.84 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.3</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.3', 'Tous compilateurs', '32-bit', '3.86', '../../files/SFML.Net-2.3-32-bit.zip') ?></td>
            <td><?php download_link('2.3', 'Tous compilateurs', '64-bit', '3.93', '../../files/SFML.Net-2.3-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="../../files/SFML.Net-2.3-sources.zip">Télécharger<span class="size">0.79 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.2</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.2', 'Tous compilateurs', '32-bit', '4.66', '../../files/SFML.Net-2.2-32-bit.zip') ?></td>
            <td><?php download_link('2.2', 'Tous compilateurs', '64-bit', '4.64', '../../files/SFML.Net-2.2-64-bit.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="../../files/SFML.Net-2.2-sources.zip">Télécharger<span class="size">0.77 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.1', 'Tous compilateurs', '32-bit', '2.63', '../../files/SFML.Net-2.1-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'Tous compilateurs', '64-bit', '2.66', '../../files/SFML.Net-2.1-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="../../files/SFML.Net-2.1-sources.zip">Télécharger<span class="size">2.70 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.0', 'Tous compilateurs', '32-bit', '2.43', '../../files/SFML.Net-2.0-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'Tous compilateurs', '64-bit', '2.62', '../../files/SFML.Net-2.0-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="../../files/SFML.Net-2.0-sources.zip">Télécharger<span class="size">2.69 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer-fr.php");
?>
