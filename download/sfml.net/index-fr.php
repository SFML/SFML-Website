<?php
    $breadcrumbs = array
    (
        'T�l�chargement' => 'download-fr.php',
        'Bindings' => 'download/bindings-fr.php',
        'SFML.Net' => 'download/sfml.net/index-fr.php'
    );
    include('../../header-fr.php');

    function download_link($version, $compiler, $arch, $size, $link)
    {
        $counter_script = "_gaq.push(['_trackEvent', 'Download', 'SFML.Net'" . $version . "']);";
        echo '<span class="description">' . $compiler . ' - ' . $arch . '</span><a href="' . $link . '" onclick="' . $counter_script . '">T�l�charger<span class="size">' . $size . ' Mo</span></a>';
    }
?>

<h1>SFML.Net</h1>

<h2>Description</h2>
<p>
    SFML.Net est le binding officiel de SFML pour la famille de langages .Net (C#, VB.Net, C++/CLI, etc.). Il est construit par dessus le binding C, CSFML, afin d'assurer
    une compatibilit� maximale entre les plateformes (i.e. il fonctionne avec Mono). L'API de SFML.Net est proche de l'API C++, mais dans le style .Net : les conventions
    de nommage sont diff�rentes, la gestion des �v�nements utilise les �v�nements natifs du langage, etc. Donc, n'h�sitez pas � jeter un oeil � la documentation de l'API ainsi
    qu'aux exemples fournis, avant de poser une question sur le forum.
</p>
<p>
    Comme l'API de SFL.Net est proche de celle de SFML, il n'y a pas de tutoriels ; mais vous pouvez consulter les tutoriels C++ disponibles sur ce site, et les adapter
    facilement � votre langage .Net pr�f�r�. La documentation de l'API, g�n�r�e � partir du code source, est quant � elle disponible et incluse dans les archives 
    t�l�chargeables ci-dessous.
</p>

<h2>T�l�chargements</h2>
<p>
    Les archives ci-dessous contiennent tout ce qu'il faut pour d�velopper avec SFML.Net : biblioth�ques, d�pendances, exemples et documentation.
</p>
<p>
    Comme c'est une biblioth�que .Net, il n'y a qu'une archive par architecture, qui fonctionne avec n'importe quel OS et compilateur. Cependant, comme le nom des biblioth�ques
    CSFML appara�t dans le code et est diff�rent pour chaque OS, pour OS X et Linux vous devrez �crire un petit fichier de configuration qui fait la correspondance entre le
    nom des DLLs CSFML et le nom des biblioth�ques CSFML de votre OS (par exemple, "csfml-graphics-2.dll" -> "libcsfml-graphics.so.2") ; vous pouvez consulter
    <a href="http://www.mono-project.com/DllMap" title="Mono DLL map">la documentation de Mono</a> pour plus de d�tails.
</p>
<p>
    Les d�pendences fournies dans les archives sont pour Windows uniquement ; pour les autres OS, vous devrez installer les d�pendences requises (CSFML, SFML et ses propres
    d�pendences) vous-m�me.
</p>

<h3>Sources actuelles</h3>
<p>
    Le d�p�t de SFML.Net se trouve sur <a href="https://github.com/LaurentGomila/SFML.Net" title="D�p�t de SFML.Net sur github">github.com</a>. Depuis ce d�p�t, vous pouvez
    t�l�charger un instantan� des toutes derni�res sources (contenant notamment le code des exemples). Vous pouvez aussi consulter les t�ches ou bugs en cours sur le tracker,
    ainsi qu'en ajouter de nouveaux.
</p>

<h3>SFML.Net 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.1', 'Tous compilateurs', '32 bits', '2.63', 'SFML.Net-2.1-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'Tous compilateurs', '64 bits', '2.66', 'SFML.Net-2.1-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="SFML.Net-2.1-sources.zip">T�l�charger<span class="size">2.70 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">Tous les OS</td>
            <td><?php download_link('2.0', 'Tous compilateurs', '32 bits', '2.43', 'SFML.Net-2.0-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'Tous compilateurs', '64 bits', '2.62', 'SFML.Net-2.0-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Code source</span><a href="SFML.Net-2.0-sources.zip">T�l�charger<span class="size">2.69 Mo</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer-fr.php");
?>
