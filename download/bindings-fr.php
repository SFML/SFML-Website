<?php
    $breadcrumbs = array
    (
        'Télécharger' => 'download-fr.php',
        'Bindings' => 'download/bindings-fr.php'
    );
    include('../header-fr.php');
?>

<h1>Bindings</h1>

<p>
    Voici une liste de tous les bindings SFML connus. Notez bien que, excepté CSFML et SFML.Net, ils ne sont pas officiels : ils sont développés par des utilisateurs de SFML,
    et certains peuvent ne pas être à jour, voire abandonnés.
</p>
<p>
    N'hésitez pas à <a href="mailto:webmaster@sfml-dev.org" title="Contacter le webmaster">me contacter</a> si vous souhaitez mettre à jour, ajouter ou retirer des informations
    concernant un binding SFML.
</p>

<table class="styled bindings" style="width: 100%;">
    <thead>
        <tr>
            <th style="width: 25%;">Langage</th>
            <th style="width: 30%;">Nom</th>
            <th style="width: 10%;">SFML</th>
            <th style="width: 45%;">Auteur</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="1">Ada</th>
            <td><a href="https://github.com/mgrojo/ASFML" class="website"><img src="../images/bindings/asfml.png" alt="ASFML"/></a></td>
            <td>2.4 - 2.6</td>
            <td>Manuel</td>
        </tr>
        <tr>
            <th rowspan="1">Beef</th>
            <td><a href="https://github.com/MineGame159/BeefSFML" class="website">BeefSFML</a></td>
            <td>2.5</td>
            <td>EnokViking & MineGame159</td>
        </tr>
        <tr>
            <th rowspan="1">C</th>
            <td><a href="csfml" class="website">CSFML</a></td>
            <td>2.5</td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">.Net (C#, VB.Net etc.)</th>
            <td><a href="sfml.net" class="website">SFML.Net</a></td>
            <td>2.5</td>
            <td><a href="mailto:laurent@sfml-dev.org">Laurent Gomila</a></td>
        </tr>
        <tr>
            <th rowspan="1">Crystal</th>
            <td><a href="https://github.com/oprypin/crsfml" class="website"><img src="../images/bindings/crsfml.png" alt="CrSFML"/></a></td>
            <td>2.3 - 2.6</td>
            <td><a href="mailto:oleh@pryp.in">Oleh Prypin</a></td>
        </tr>
        <tr>
            <th rowspan="2">D</th>
            <td><a href="https://github.com/BindBC/bindbc-sfml" class="website">bindbc-sfml</a></td>
            <td>2.0 - 2.5</td>
            <td><a href="mailto:aldacron@gmail.com">Mike Parker</a></td>
        </tr>
        <tr>
            <td><a href="http://www.dsfml.com/" class="website">DSFML</a></td>
            <td>2.1</td>
            <td><a href="mailto:dehaan.jeremiah@gmail.com">Jeremy DeHaan</a></td>
        </tr>
        <tr>
            <th rowspan="1">Euphoria</th>
            <td><a href="https://github.com/gAndy50/EuSFML2" class="website">EuSFML2</a></td>
            <td>2.4</td>
            <td>Andy Patterson</td>
        </tr>
        <tr>
            <th rowspan="1">Free Pascal Compiler aka FPC</th>
            <td><a href="https://github.com/DJMaster/csfml-fpc" class="website">csfml-fpc</a></td>
            <td>2.5</td>
            <td>DJMaster</td>
        </tr>
        <tr>
            <th rowspan="2">Go</th>
            <td><a href="https://bitbucket.org/krepa098/gosfml2" class="website"><img src="../images/bindings/gosfml2.png" alt="GoSFML2"></a></td>
            <td>2.0</td>
            <td>krepa098</td>
        </tr>
        <tr>
            <td><a href="https://github.com/telroshan/go-sfml" class="website">go-sfml</a></td>
            <td>2.5.1</td>
            <td><a href="mailto:cr.rey.clement@gmail.com">Clement Rey</a>, <a href="mailto:telroshan@gmail.com">Telroshan</a></td>
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
            <td><a href="https://jsfml.sfmlprojects.org/" class="website"><img src="../images/bindings/jsfml.png" alt="JSFML"/></a></td>
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
            <th rowspan="1">mruby</th>
            <td><a href="https://github.com/IceDragon200/mruby-sfml" class="website">mruby-sfml</a></td>
            <td>2.4</td>
            <td><a href="mailto:mistdragon100@gmail.com">Corey Powell</a></td>
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
            <td><a href="https://github.com/fccm/ocaml-sfml" class="website">ocaml-sfml</a></td>
            <td>2.5.1</td>
            <td>Florent Monnier, Sylvain Boilard</td>
        </tr>
        <tr>
            <th rowspan="1">Pascal</th>
            <td><a href="https://github.com/CWBudde/PasSFML" class="website">PasSFML</a></td>
            <td>2.4</td>
            <td>Christian-W. Budde</td>
        </tr>
        <tr>
            <th rowspan="1">Plutonium</th>
            <td><a href="https://github.com/shehryar49/pltSFML" class="website">pltSFML</a></td>
            <td>2.5</td>
            <td>Shehryar Ahmed</td>
        </tr>
        <tr>
            <th rowspan="1">Nelua</th>
            <td><a href="https://github.com/Rabios/nelua-fun/tree/main/csfml" class="website">csfml-nelua</a></td>
            <td>2.5.1</td>
            <td>Rabia Alhaffar</td>
        </tr>
        <tr>
            <th rowspan="1">Python</th>
            <td><a href="https://github.com/Sonkun/python-sfml" class="website"><img src="../images/bindings/python-sfml.png" alt="pySFML"></a></td>
            <td>2.3.2</td>
            <td><a href="mailto:dewachter.jonathan@gmail.com">Jonathan De Wachter</a>, Edwin Marshall</td>
        </tr>
        <tr>
            <th rowspan="1">Ruby</th>
            <td><a href="https://github.com/Groogy/rbSFML" class="website"><img src="../images/bindings/rbsfml.png" alt="rbSFML"></a></td>
            <td>2.3.2</td>
            <td><a href="mailto:groogy@groogy.se">Henrik Valter Vogelius Hansson</a></td>
        </tr>
        <tr>
            <th rowspan="1">Rust</th>
            <td><a href="https://github.com/jeremyletang/rust-sfml" class="website"><img src="../images/bindings/rust-sfml.png" alt="rust-sfml"></a></td>
            <td>2.5.1</td>
            <td><a href="mailto:letang.jeremy@gmail.com">Jérémy Letang</a></td>
        </tr>
        <tr>
            <th rowspan="1">Zig</th>
            <td><a href="https://github.com/Guigui220D/zig-sfml-wrapper" class="website">zig-sfml-wrapper</a></td>
            <td>2.5.1</td>
            <td>Guillaume Derex</td>
        </tr>
        <tr>
            <th rowspan="1">Node.js</th>
            <td><a href="https://github.com/XadillaX/node-sfml" class="website">sfml.js</a></td>
            <td>2.5.1</td>
            <td><a href="https://github.com/XadillaX">XadillaX</a></td>
        </tr>
    </tbody>
</table>


<?php
    require("../footer-fr.php");
?>
