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
    Feel free to <a href="mailto:webmaster@sfml-dev.org" title="Contact the webmaster">contact me</a> if you want to update, add or remove information about an SFML binding.
</p>

<table class="styled bindings" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 25%;">Language</th>
            <th style="width: 30%;">Name</th>
            <th style="width: 10%;">SFML</th>
            <th style="width: 35%;">Authors</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <th rowspan="1">C</th>
            <td><a href="csfml" class="website">CSFML</a></td>
            <td>2.3</td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">.Net (C#, VB.Net etc.)</th>
            <td><a href="sfml.net" class="website">SFML.Net</a></td>
            <td>2.2</td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">Crystal</th>
            <td><a href="https://github.com/BlaXpirit/crsfml" class="website"><img src="../images/bindings/crsfml.png" alt="CrSFML"/></a></td>
            <td>2.3</td>
            <td><a href="mailto:blaxpirit@gmail.com">Oleh Prypin</a></td>
        </tr>
        <tr>
            <th rowspan="2">D</th>
            <td><a href="https://github.com/DerelictOrg/DerelictSFML2" class="website">DerelictSFML2</a></td>
            <td>2.3</td>
            <td><a href="mailto:aldacron@gmail.com">Mike Parker</a></td>
        </tr>
        <tr>
            <td><a href="http://www.dsfml.com/" class="website">DSFML</a></td>
            <td>2.1</td>
            <td><a href="mailto:dehaan.jeremiah@gmail.com">Jeremy DeHaan</a></td>
        </tr>
        <tr>
            <th rowspan="1">Euphoria</th>
            <td><a href="http://www.rapideuphoria.com/eusfml2.zip" class="website">EuSFML2</a></td>
            <td>2.2</td>
            <td>Andy Patterson</td>
        </tr>
        <tr>
            <th rowspan="1">Go</th>
            <td><a href="https://bitbucket.org/krepa098/gosfml2" class="website"><img src="../images/bindings/gosfml2.png" alt="GoSFML2"></a></td>
            <td>2.0</td>
            <td>krepa098</td>
        </tr>
        <tr>
            <th rowspan="1">Haskell</th>
            <td>
                <a href="https://github.com/SFML-haskell/SFML" class="website"><img src="../images/bindings/hssfml.png" style="vertical-align:middle"></a>
                (<a href="https://hackage.haskell.org/package/SFML">Hackage</a>)
            </td>
            <td>2.3</td>
            <td><a href="mailto:jeannekamikaze@gmail.com">Marc Sunet</a>, <a href="mailto:alfredo.dinapoli@gmail.com">Alfredo Di Napoli</a></td>
        </tr>
        <tr>
            <th rowspan="1">Java</th>
            <td><a href="http://jsfml.org/" class="website"><img src="../images/bindings/jsfml.png" alt="JSFML"/></a></td>
            <td>2.2</td>
            <td><a href="mailto:pdinklag@gmail.com">Patrick Dinklage</a></td>
        </tr>
        <tr>
            <th rowspan="1">Julia</th>
            <td><a href="https://github.com/zyedidia/SFML.jl" class="website"><img src="../images/bindings/sfml.jl.png" alt="SFML.jl"/></a></td>
            <td>2.2</td>
            <td>Zachary Yedidia</td>
        </tr>
        <tr>
            <th rowspan="1">Nim</th>
            <td><a href="https://github.com/BlaXpirit/nim-csfml" class="website">nim-csfml</a></td>
            <td>2.3</td>
            <td><a href="mailto:blaxpirit@gmail.com">Oleh Prypin</a></td>
        </tr>
        <tr>
            <th rowspan="2">OCaml</th>
            <td><a href="https://github.com/JoeDralliam/Ocsfml" class="website">Ocsfml</a></td>
            <td>2.2</td>
            <td>Jun Maillard, Kenji Maillard</td>
        </tr>
        <tr>
            <td><a href="http://ocaml-sfml.forge.ocamlcore.org/" class="website">ocaml-sfml</a></td>
            <td>2.0</td>
            <td>Florent Monnier</td>
        </tr>
        <tr>
            <th rowspan="1">Pascal</th>
            <td><a href="https://github.com/CWBudde/PasSFML" class="website">PasSFML</a></td>
            <td>2.3</td>
            <td>Christian-W. Budde</td>
        </tr>
        <tr>
            <th rowspan="1">Python</th>
            <td><a href="http://www.python-sfml.org/" class="website"><img src="../images/bindings/python-sfml.png" alt="pySFML"></a></td>
            <td>2.2</td>
            <td><a href="mailto:dewachter.jonathan@gmail.com">Jonathan De Wachter</a>, Edwin Marshall</td>
        </tr>
        <tr>
            <th rowspan="1">Ruby</th>
            <td><a href="http://www.groogy.se/mainsite/rbsfml/" class="website"><img src="../images/bindings/rbsfml.png" alt="rbSFML"></a></td>
            <td>2.0</td>
            <td><a href="mailto:groogy@groogy.se">Henrik Valter Vogelius Hansson</a></td>
        </tr>
        <tr>
            <th rowspan="1">Rust</th>
            <td><a href="http://www.rust-sfml.org/" class="website"><img src="../images/bindings/rust-sfml.png" alt="rust-sfml"></a></td>
            <td>2.1</td>
            <td><a href="mailto:letang.jeremy@gmail.com">Jérémy Letang</a></td>
        </tr>
    </tbody>
</table>

<?php
    require("../footer.php");
?>
