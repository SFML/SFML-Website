<?php
    $breadcrumbs = array
    (
        'Download' => 'download.php',
        'Bindings' => 'download/bindings.php'
    );
    include('../header.php');

    function binding($name, $logo, $language, $authors, $active, $webpage)
    {
        $statusLabel = $active ? 'active' : 'inactive';
        $statusClass = $active ? 'active' : 'inactive';
        $id = trim(str_replace(' ', '-', preg_replace('/[^a-z0-9 -]+/', '', strtolower($name))), '-');

        echo '<h2 id="' . $id . '">' . $name . '</h2>' . "\n";
        echo '<table class="styled binding">' . "\n";
        if (isset($logo))
            echo '<tr><td class="header" colspan="2"><img src="../images/bindings/' . $logo .'"/></td></tr>' . "\n";
        echo '<tr><td class="header">Status</td><td class="status-' . $statusClass . '">' . $statusLabel . '</td></tr>' . "\n";
        echo '<tr><td class="header">Language</td><td class="language">' . $language . '</td></tr>' . "\n";
        echo '<tr><td class="header">' . (count($authors) == 1 ? 'Author' : 'Authors') . '</td><td class="author">';
        $i = 0;
        foreach ($authors as $author => $email)
        {
            if (isset($email))
                echo '<a href="mailto:' . $email . '" title="Contact ' . $author . '">' . $author . '</a>';
            else
                echo $author;
            if ($i++ < count($authors) - 1)
                echo ',';
            echo ' ';
        }
        echo '</td></tr>' . "\n";
        echo '<tr><td class="header">Web page</td><td class="webpage"><a href="' . $webpage . '" title="' . $name . ' official web page">' . $webpage . '</a></td></tr>' . "\n";
        echo '</table>' . "\n";
    }
?>

<h1>SFML bindings</h1>

<p>
    Here is a list of all the known SFML bindings. CSFML and SFML.Net are official bindings, the others are not: They are developed by SFML users.
    Some bindings may be out of date, some might have even been abandoned.
</p>
<p>
    Feel free to <a href="mailto:laurent@sfml-dev.org" title="Contact the webmaster">contact me</a> if you want to update, add or remove information about an SFML binding.
</p>

<?php

    binding('CSFML', null, 'C', array('Laurent Gomila' => 'laurent@sfml-dev.org'), true, 'http://www.sfml-dev.org/download/csfml');
    binding('SFML.Net', null, '.Net languages (C#, VB.Net, etc.)', array('Laurent Gomila' => 'laurent@sfml-dev.org'), true, 'http://www.sfml-dev.org/download/sfml.net');
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
    require("../footer.php");
?>
