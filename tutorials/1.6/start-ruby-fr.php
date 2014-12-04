<?php

    $title = "SFML et Ruby";
    $page = "start-ruby-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Ruby</h1>

<?php h2('Introduction') ?>
<p>
    Le but de ce tutoriel est de vous expliquer comment compiler / installer / utiliser le binding Ruby de SFML (qui est
    appelé <strong>RubySFML</strong>).
</p>

<?php h2('Installer RubySFML sous Windows') ?>
<p>
    Vous devez tout d'abord télécharger l'archive RubySFML (SFML-x.x-ruby-src-windows), qui peut être trouvée sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des téléchargements">page des téléchargements</a>.
    Cette archive contient le code source et tout ce qu'il faut pour compiler et installer RubySFML.
    Si vous ne souhaitez pas compiler RubySFML (ou simplement si vous n'avez pas Visual Studio pour le faire), vous
    pouvez télécharger l'archive précompilée (SFML-x.x-ruby-windows), qui contient les binaires prêts à utiliser. Cette archive
    est également le minimum dont vous aurez besoin pour distribuer vos applications RubySFML. Elle contient même
    Ruby, ainsi vos utilisateurs n'auront strictement rien à installer.
</p>
<p>
    Si vous avez téléchargé les sources, vous pouvez consulter le fichier README pour obtenir des instructions
    détaillées pour compiler RubySFML.
</p>
<p>
    Que vous ayiez compiler les binaires RubySFML ou les ayiez téléchargé directement, vous devriez maintenant
    avoir tout ce qu'il faut pour écrire et exécuter vos programmes RubySFML.
</p>

<?php h2('Installer RubySFML sous Linux') ?>
<p>
    Vous devez tout d'abord télécharger l'archive RubySFML (SFML-x.x-ruby-src-linux), qui peut être trouvée sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des téléchargements">page des téléchargements</a>.
    Cette archive contient le code source et tout ce qu'il faut pour compiler et installer RubySFML.
</p>
<p>
    Avant de compiler RubySFML, les bibliothèques C++ de SFML doivent avoir été compilées. Vous pouvez vous référer à
    <a class="internal" href="./start-linux-fr.php" title="Compiler SFML sous Linux">ce tutoriel</a> si vous
    n'êtes pas sûr de savoir comment faire.
</p>
<p>
    Une fois l'archive de RubySFML decompressée sur votre disque dur, allez dans le répertoire ruby/RubySFML, et
    exécutez "ruby extconf-linux.rb". Cela va automatiquement créer un makefile pour compiler RubySFML.
</p>
<p>
    Exécutez "make" pour construire les fichiers RubySFML.
</p>
<p>
    Après ceci, tout devrait être prêt pour utiliser RubySFML. Si Ruby se plaint de modules ou de classes non définies,
    assurez-vous que tous les fichiers RubySFML se trouvent dans un répertoire approprié afin que Ruby puisse les
    trouver.
</p>

<?php h2('Ecriture de votre premier programme RubySFML') ?>
<p>
    Au contraire des bibliothèques C++, RubySFML rassemble toutes les classes SFML dans un unique module ("SFML"). Comme
    Ruby ne supporte pas nativement les threads, et possède ses propres classes pour le réseaun seules quelques classes
    des modules Système, Fenêtrage, Graphique et Audio des modules sont exposés dans RubySFML.
</p>
<p>
    Voici un morceau de code SFML très simple qui ouvre une fenêtre et y affiche du texte :
</p>

<pre><code class="no-highlight"># Inclue l'extension RubySFML
require "RubySFML"
include SFML

# Crée la fenêtre principale
mode = VideoMode.new 800, 600, 32
window = RenderWindow.new mode, "Test RubySFML"

# Crée un chaîne de caractères graphique à afficher
text = Text.new "Bonjour SFML"

# Démarre la boucle de jeu
running = true
while running
    while event = window.getEvent
        running = false if event.type == Event::Closed
    end

    # Affiche le texte, et met à jour la fenêtre
    window.draw text
    window.display
end
</code></pre>

<p>
    Vous trouverez une documentation de référence succinte dans le répertoire "doc", qui explique toutes les classes
    contenues dans RubySFML ainsi que les changements entre la version C++ et la version Ruby. Toutefois, les classes
    sont les mêmes, vous pouvez donc toujours utiliser la documentation et les tutoriels C++ fournis sur le site pour
    avoir des documents plus complets.
</p>
<p>
    Le répertoire "test" de l'archive RubySFML contient quelques démos utilisant RubySFML, vous pouvez les essayer pour
    vous assurer que tout fonctionne correctement. Quelques unes d'entre elles nécessitent le module Ruby-OpenGL,
    assurez-vous de l'avoir installé avant de tenter de les exécuter (sous Windows, ce module est compilé automatiquement
    en même temps que RubySFML).
</p>

<?php

    require("footer-fr.php");

?>
