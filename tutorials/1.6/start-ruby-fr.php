<?php

    $title = "SFML et Ruby";
    $page = "start-ruby-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Ruby</h1>

<?php h2('Introduction') ?>
<p>
    Le but de ce tutoriel est de vous expliquer comment compiler / installer / utiliser le binding Ruby de SFML (qui est
    appel� <strong>RubySFML</strong>).
</p>

<?php h2('Installer RubySFML sous Windows') ?>
<p>
    Vous devez tout d'abord t�l�charger l'archive RubySFML (SFML-x.x-ruby-src-windows), qui peut �tre trouv�e sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
    Cette archive contient le code source et tout ce qu'il faut pour compiler et installer RubySFML.
    Si vous ne souhaitez pas compiler RubySFML (ou simplement si vous n'avez pas Visual Studio pour le faire), vous
    pouvez t�l�charger l'archive pr�compil�e (SFML-x.x-ruby-windows), qui contient les binaires pr�ts � utiliser. Cette archive
    est �galement le minimum dont vous aurez besoin pour distribuer vos applications RubySFML. Elle contient m�me
    Ruby, ainsi vos utilisateurs n'auront strictement rien � installer.
</p>
<p>
    Si vous avez t�l�charg� les sources, vous pouvez consulter le fichier README pour obtenir des instructions
    d�taill�es pour compiler RubySFML.
</p>
<p>
    Que vous ayiez compiler les binaires RubySFML ou les ayiez t�l�charg� directement, vous devriez maintenant
    avoir tout ce qu'il faut pour �crire et ex�cuter vos programmes RubySFML.
</p>

<?php h2('Installer RubySFML sous Linux') ?>
<p>
    Vous devez tout d'abord t�l�charger l'archive RubySFML (SFML-x.x-ruby-src-linux), qui peut �tre trouv�e sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
    Cette archive contient le code source et tout ce qu'il faut pour compiler et installer RubySFML.
</p>
<p>
    Avant de compiler RubySFML, les biblioth�ques C++ de SFML doivent avoir �t� compil�es. Vous pouvez vous r�f�rer �
    <a class="internal" href="./start-linux-fr.php" title="Compiler SFML sous Linux">ce tutoriel</a> si vous
    n'�tes pas s�r de savoir comment faire.
</p>
<p>
    Une fois l'archive de RubySFML decompress�e sur votre disque dur, allez dans le r�pertoire ruby/RubySFML, et
    ex�cutez "ruby extconf-linux.rb". Cela va automatiquement cr�er un makefile pour compiler RubySFML.
</p>
<p>
    Ex�cutez "make" pour construire les fichiers RubySFML.
</p>
<p>
    Apr�s ceci, tout devrait �tre pr�t pour utiliser RubySFML. Si Ruby se plaint de modules ou de classes non d�finies,
    assurez-vous que tous les fichiers RubySFML se trouvent dans un r�pertoire appropri� afin que Ruby puisse les
    trouver.
</p>

<?php h2('Ecriture de votre premier programme RubySFML') ?>
<p>
    Au contraire des biblioth�ques C++, RubySFML rassemble toutes les classes SFML dans un unique module ("SFML"). Comme
    Ruby ne supporte pas nativement les threads, et poss�de ses propres classes pour le r�seaun seules quelques classes
    des modules Syst�me, Fen�trage, Graphique et Audio des modules sont expos�s dans RubySFML.
</p>
<p>
    Voici un morceau de code SFML tr�s simple qui ouvre une fen�tre et y affiche du texte :
</p>

<pre><code class="no-highlight"># Inclue l'extension RubySFML
require "RubySFML"
include SFML

# Cr�e la fen�tre principale
mode = VideoMode.new 800, 600, 32
window = RenderWindow.new mode, "Test RubySFML"

# Cr�e un cha�ne de caract�res graphique � afficher
text = Text.new "Bonjour SFML"

# D�marre la boucle de jeu
running = true
while running
    while event = window.getEvent
        running = false if event.type == Event::Closed
    end

    # Affiche le texte, et met � jour la fen�tre
    window.draw text
    window.display
end
</code></pre>

<p>
    Vous trouverez une documentation de r�f�rence succinte dans le r�pertoire "doc", qui explique toutes les classes
    contenues dans RubySFML ainsi que les changements entre la version C++ et la version Ruby. Toutefois, les classes
    sont les m�mes, vous pouvez donc toujours utiliser la documentation et les tutoriels C++ fournis sur le site pour
    avoir des documents plus complets.
</p>
<p>
    Le r�pertoire "test" de l'archive RubySFML contient quelques d�mos utilisant RubySFML, vous pouvez les essayer pour
    vous assurer que tout fonctionne correctement. Quelques unes d'entre elles n�cessitent le module Ruby-OpenGL,
    assurez-vous de l'avoir install� avant de tenter de les ex�cuter (sous Windows, ce module est compil� automatiquement
    en m�me temps que RubySFML).
</p>

<?php

    require("footer-fr.php");

?>
