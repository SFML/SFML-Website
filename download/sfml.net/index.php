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
    compatibility across platforms (i.e. it works with Mono). The API of SFML.Net is close to the C++ one, but in the .Net style: naming conventions are different, event
    handling uses native event support, etc. So don't hesitate to have a look at the API documentation and at the provided examples, before posting questions on the forum.
</p>
<p>
    Since the SFML.Net API is similar to SFML, there's no tutorial for it; but you can follow the C++ tutorials available on this website, and adapt them to your preferred .Net
    language very easily. The API documentation, generated from the source code, is available and included in the downloadable packages below.
</p>

<h2>Download</h2>
<p>
    The following archives contain everything that you need in order to work with SFML.Net: libraries, dependencies, examples and documentation.
</p>
<p>
    Since it's a .Net library, there's only one archive per architecture, which works for any OS and compiler. However, since the name of CSFML libraries appear in the source
    code, and are different on each OS, for OS X and Linux you will have to write a special configuration file which maps the names of the CSFML DLLs to the names of the
    corresponding CSFML shared libraries on your OS (for example, "csfml-graphics-2.dll" -> "libcsfml-graphics.so.2");
    see <a href="http://www.mono-project.com/DllMap" title="Mono DLL map">the Mono documentation</a> for more details.
</p>
<p>
    The provided dependencies are also for Windows only; on other OSes, you have to install the required dependencies (CSFML, SFML and its own dependencies) yourself.
</p>

<h3>Current sources</h3>
<p>
    The SFML.Net repository can be found at <a href="https://github.com/LaurentGomila/SFML.Net" title="SFML.Net repository on github">github.com</a>. From there, you can download
    the current source code (which contain the sources of the examples). You can also watch the open issues on the task tracker, or add new ones.
</p>

<h3>SFML.Net 2.1</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.1', 'All compilers', '32 bits', '2.63', 'SFML.Net-2.1-32bits.zip') ?></td>
            <td><?php download_link('2.1', 'All compilers', '64 bits', '2.66', 'SFML.Net-2.1-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="SFML.Net-2.1-sources.zip">Download<span class="size">2.70 MB</span></a></td>
        </tr>
    </tbody>
</table>

<h3>SFML.Net 2.0</h3>
<table class="styled download">
    <tbody>
        <tr>
            <td class="os" rowspan="2">All</td>
            <td><?php download_link('2.0', 'All compilers', '32 bits', '2.43', 'SFML.Net-2.0-32bits.zip') ?></td>
            <td><?php download_link('2.0', 'All compilers', '64 bits', '2.62', 'SFML.Net-2.0-64bits.zip') ?></td>
        </tr>
        <tr>
            <td colspan="2"><span class="description">Source code</span><a href="SFML.Net-2.0-sources.zip">Download<span class="size">2.69 MB</span></a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../../footer.php");
?>
