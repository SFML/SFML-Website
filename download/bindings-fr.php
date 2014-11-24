<?php
    $breadcrumbs = array
    (
        'Télécharger' => 'download-fr.php',
        'Bindings' => 'download/bindings-fr.php'
    );
    include('../header-fr.php');

    function binding($name, $logo, $language, $authors, $active, $webpage)
    {
        $statusLabel = $active ? 'actif' : 'inactif';
        $statusClass = $active ? 'active' : 'inactive';
        $id = trim(str_replace(' ', '-', preg_replace('/[^a-z0-9 -]+/', '', strtolower($name))), '-');

        echo '<h2 id="' . $id . '">' . $name . '</h2>' . "\n";
        echo '<table class="styled binding">' . "\n";
        if (isset($logo))
            echo '<tr><td class="header" colspan="2"><img src="../images/bindings/' . $logo .'"/></td></tr>' . "\n";
        echo '<tr><td class="header">Etat</td><td class="status-' . $statusClass . '">' . $statusLabel . '</td></tr>' . "\n";
        echo '<tr><td class="header">Langage</td><td class="language">' . $language . '</td></tr>' . "\n";
        echo '<tr><td class="header">' . (count($authors) == 1 ? 'Auteur' : 'Auteurs') . '</td><td class="author">';
        $i = 0;
        foreach ($authors as $author => $email)
        {
            if (isset($email))
                echo '<a href="mailto:' . $email . '" title="Contacter ' . $author . '">' . $author . '</a>';
            else
                echo $author;
            if ($i++ < count($authors) - 1)
                echo ',';
            echo ' ';
        }
        echo '</td></tr>' . "\n";
        echo '<tr><td class="header">Page web</td><td class="webpage"><a href="' . $webpage . '" title="Page web officielle de ' . $name . '">' . $webpage . '</a></td></tr>' . "\n";
        echo '</table>' . "\n";
    }
?>

<h1>Bindings SFML</h1>

<p>
    Voici une liste de tous les bindings SFML connus. Notez bien que, excepté CSFML et SFML.Net, ils ne sont pas officiels : ils sont développés par des utilisateurs de SFML,
    et certains peuvent ne pas être à jour, voire abandonnés.
</p>
<p>
    N'hésitez pas à <a href="mailto:laurent@sfml-dev.org" title="Contacter le webmaster">me contacter</a> si vous souhaitez mettre à jour, ajouter ou retirer des informations
    concernant un binding SFML.
</p>

<?php

    binding('CSFML', null, 'C', array('Laurent Gomila' => 'laurent@sfml-dev.org'), true, 'http://www.sfml-dev.org/download/csfml/index-fr.php');
    binding('SFML.Net', null, '.Net languages (C#, VB.Net, etc.)', array('Laurent Gomila' => 'laurent@sfml-dev.org'), true, 'http://www.sfml-dev.org/download/sfml.net/index-fr.php');
    binding('JSFML', 'jsfml.png', 'Java', array('Patrick Dinklage' => 'pdinklag@gmail.com'), true, 'http://jsfml.org');
    binding('DerelictSFML2', null, 'D', array('Mike Parker' => 'aldacron@gmail.com'), true, 'https://github.com/aldacron/Derelict3/');
    binding('DSFML', null, 'D', array('Jeremy DeHaan' => 'dehaan.jeremiah@gmail.com'), true, 'https://github.com/Jebbs/DSFML');
    binding('SFML-D', null, 'D', array('krzat' => null), false, 'https://github.com/krzat/SFML-D');
    binding('pySFML', 'python-sfml.png', 'Python', array('Jonathan De Wachter' => 'dewachter.jonathan@gmail.com', 'Edwin Marshall' => null), true, 'http://www.python-sfml.org/');
    binding('rbSFML', 'rbsfml.png', 'Ruby', array('Henrik Valter Vogelius Hansson' => 'groogy@groogy.se'), true, 'http://www.groogy.se');
    binding('Ocsfml', null, 'OCaml', array('Jun Maillard' => null, 'Kenji Maillard' => null), true, 'https://github.com/JoeDralliam/Ocsfml');
    binding('ocaml-sfml', null, 'OCaml', array('Florent Monnier' => null), true, 'http://ocaml-sfml.forge.ocamlcore.org/');
    binding('GoSFML2', null, 'Go', array('krepa098' => null), true, 'https://bitbucket.org/krepa098/gosfml2');
    binding('nimrod-sfml', null, 'Nimrod', array('fowl' => null), true, 'https://github.com/fowlmouth/nimrod-sfml');
    binding('EuSFML2', null, 'Euphoria', array('Andy Patterson' => null), true, 'http://www.rapideuphoria.com/eusfml.zip');
    binding('rust-sfml', null, 'Rust', array('Jérémy Letang' => 'letang.jeremy@gmail.com'), true, 'https://github.com/JeremyLetang/rust-sfml');

?>

<?php
    require("../footer-fr.php");
?>
