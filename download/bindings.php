<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'Bindings' => 'download/bindings.php'
    );
    include('../header.php');
?>

<h1>Bindings</h1>

<p>
    Here is a list of all the known SFML bindings. CSFML and SFML.Net are official bindings, the others are not: They are developed by SFML users.
    Some bindings may be out of date, some might have even been abandoned.
</p>
<p>
    Feel free to <a href="mailto:laurent@sfml-dev.org" title="Contact the webmaster">contact me</a> if you want to update, add or remove information about an SFML binding.
</p>

<table class="styled bindings" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 25%;">Language</th>
            <th style="width: 30%;">Name</th>
            <th style="width: 45%;">Authors</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th rowspan="1">C</th>
            <td><a href="http://www.sfml-dev.org/download/csfml" class="website">CSFML</a></td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">.Net (C#, VB.Net etc.)</th>
            <td><a href="http://www.sfml-dev.org/download/sfml.net" class="website">SFML.Net</a></td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">Java</th>
            <td><a href="http://jsfml.org/" class="website"><img src="../images/bindings/jsfml.png" alt="JSFML"/></a></td>
            <td><a href="mailto:pdinklag@gmail.com">Patrick Dinklage</a></td>
        </tr>
        <tr>
            <th rowspan="2">D</th>
            <td><a href="https://github.com/DerelictOrg/DerelictSFML2" class="website">DerelictSFML2</a></td>
            <td><a href="mailto:aldacron@gmail.com">Mike Parker</a></td>
        </tr>
        <tr>
            <td><a href="https://github.com/Jebbs/DSFML" class="website">DSFML</a></td>
            <td><a href="mailto:dehaan.jeremiah@gmail.com">Jeremy DeHaan</a></td>
        </tr>
        <tr>
            <th rowspan="1">Python</th>
            <td><a href="http://www.python-sfml.org/" class="website"><img src="../images/bindings/python-sfml.png" alt="pySFML"></a></td>
            <td><a href="mailto:dewachter.jonathan@gmail.com">Jonathan De Wachter</a>, Edwin Marshall</td>
        </tr>
        <tr>
            <th rowspan="1">Ruby</th>
            <td><a href="http://www.groogy.se/mainsite/rbsfml/" class="website"><img src="../images/bindings/rbsfml.png" alt="rbSFML"></a></td>
            <td><a href="mailto:groogy@groogy.se">Henrik Valter Vogelius Hansson</a></td>
        </tr>
        <tr>
            <th rowspan="2">OCaml</th>
            <td><a href="https://github.com/JoeDralliam/Ocsfml" class="website">Ocsfml</a></td>
            <td>Jun Maillard, Kenji Maillard</td>
        </tr>
        <tr>
            <td><a href="http://ocaml-sfml.forge.ocamlcore.org/" class="website">ocaml-sfml</a></td>
            <td>Florent Monnier</td>
        </tr>
        <tr>
            <th rowspan="1">Go</th>
            <td><a href="https://bitbucket.org/krepa098/gosfml2" class="website">GoSFML2</a></td>
            <td>krepa098</td>
        </tr>
        <tr>
            <th rowspan="1">Nimrod</th>
            <td><a href="https://github.com/fowlmouth/nimrod-sfml" class="website">nimrod-sfml</a></td>
            <td>fowl</td>
        </tr>
        <tr>
            <th rowspan="1">Euphoria</th>
            <td><a href="http://www.rapideuphoria.com/eusfml.zip" class="website">EuSFML2</a></td>
            <td>Andy Patterson</td>
        </tr>
        <tr>
            <th rowspan="1">Rust</th>
            <td><a href="http://www.rust-sfml.org/" class="website">rust-sfml</a></td>
            <td><a href="letang.jeremy@gmail.com">Jérémy Letang</a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../footer.php");
?>
