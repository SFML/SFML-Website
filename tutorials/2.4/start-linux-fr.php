<?php

    $title = "SFML et Linux";
    $page = "start-linux-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Linux</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML sous Linux. Il va vous expliquer comment installer SFML, et comment compiler
    des projets qui l'utilisent.
</p>

<?php h2('Installer SFML') ?>
<p>
    Différentes approches sont possibles pour installer SFML sous Linux :
</p>
<ul>
    <li>L'installer directement depuis les dépôts de votre distrib Linux</li>
    <li>La compiler directement à partir des sources</li>
    <li>Télécharger le SDK et copier les fichiers manuellement</li>
</ul>
<p>
    L'option 1 est de loin celle à préférer ; si la version de SFML que vous souhaitez installer est disponible dans les dépôts officiels, alors
    installez-la simplement avec votre gestionnaire de paquets. Par exemple, sous Debian vous feriez :
</p>
<pre><code class="no-highlight">sudo apt-get install libsfml-dev</code></pre>
<p>
    L'option 2 nécessite plus de travail : vous devez installer les fichiers de développement de toutes les dépendances de SFML, installer CMake, et
    exécuter quelques commandes à la main. Mais le résultat sera un package parfait, qui prend en compte toutes les spécificités de votre système.<br />
    Si vous allez dans cette direction, il y a un tutoriel dédié à
    <a class="internal" href="./compile-with-cmake-fr.php" title="Comment compiler SFML">la compilation de SFML</a>.
</p>
<p>
    Enfin, l'option 3 est un bon compromis pour une installation rapide si SFML n'est pas disponible en tant que package officiel. Téléchargez le SDK
    depuis la <a class="internal" href="../../download-fr.php" title="Aller à la page des téléchargements">page des téléchargements</a>, décompressez-le
    et copiez les fichiers vers votre endroit préféré : soit un chemin à part dans votre dossier personnel (comme <em>/home/moi/sfml</em>), ou bien un
    chemin standard (comme <em>/usr/local</em>).
</p>
<p>
    Si vous avez déjà une ancienne version de SFML installée, assurez-vous qu'elle n'entre pas en conflit avec la nouvelle version !
</p>

<?php h2('Compiler un programme SFML') ?>
<p>
    Dans ce tutoriel nous n'allons pas parler des EDIs tels que Code::Blocks ou Eclipse. Nous détaillerons simplement les commandes requises pour
    compiler et lier un exécutable SFML, mais écrire un makefile complet ou configurer un projet dans un EDI sort du cadre de ce tutoriel -- il existe
    de meilleurs tutoriels spécifiques pour ces choses.<br />
    Si vous utilisez Code::Blocks, vous pouvez aller jeter un oeil au
    <a class="internal" href="./start-cb-fr.php" title="SFML et Code::Blocks">tutoriel pour Code::Blocks sous Windows</a> ; les instructions devraient être
    similaires, sauf que si vous avez installé SFML dans un chemin standard du système vous n'aurez pas à définir les chemins de recherche du compilateur
    et de l'éditeur de liens.
</p>
<p>
    Pour commencer, créez un fichier source, nommé "main.cpp", contenant ce petit programme SFML :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;

int main()
{
    sf::RenderWindow window(sf::VideoMode(200, 200), "SFML works!");
    sf::CircleShape shape(100.f);
    shape.setFillColor(sf::Color::Green);

    while (window.isOpen())
    {
        sf::Event event;
        while (window.pollEvent(event))
        {
            if (event.type == sf::Event::Closed)
                window.close();
        }

        window.clear();
        window.draw(shape);
        window.display();
    }

    return 0;
}
</code></pre>
<p>
    Maintenant compilez-le :
</p>
<pre><code class="no-highlight">g++ -c main.cpp</code></pre>
<p>
    Si vous avez installé SFML dans un chemin non-standard, vous devez indiquer au compilateur où trouver les en-têtes SFML (les fichiers .hpp) :
</p>
<pre><code class="no-highlight">g++ -c main.cpp -I<em>&lt;installation-de-sfml&gt;</em>/include</code></pre>
<p>
    Ici, <em>&lt;installation-de-sfml&gt;</em> est le répertoire dans lequel vous avez copié SFML, par exemple <em>/home/moi/sfml</em>.
</p>
<p>
    Puis, vous devez lier le fichier compilé aux bibliothèques SFML afin de produire l'exécutable final. SFML est composée de 5 modules (système,
    fenêtrage, graphique, réseau et audio), et il y a une bibliothèque pour chacun.<br />
    Pour lier une bibliothèque SFML, vous devez ajouter "-lsfml-xxx" à votre ligne de commande, par exemple "-lsfml-graphics" pour le module graphique
    (par rapport au nom du fichier correspondant, le préfixe "lib" et l'extension ".so" doivent être omis).
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    Si vous avez installé SFML dans un chemin non-standard, vous devrez indiquer à l'éditeur de liens où trouver les bibliothèques SFML (fichiers .so) :
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -L<em>&lt;installation-de-sfml&gt;</em>/lib -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    Nous sommes maintenant prêts à exécuter le programme compilé :
</p>
<pre><code class="no-highlight">./sfml-app</code></pre>
<p>
    Si SFML n'est pas installée dans un chemin standard, vous devrez d'abord dire au chargeur de bibliothèques où trouver les bibliothèques de SFML :
</p>
<pre><code class="no-highlight">export LD_LIBRARY_PATH=<em>&lt;installation-de-sfml&gt;</em>/lib &amp;&amp; ./sfml-app</code></pre>
<p>
    Si tout s'est bien passé, vous devriez voir ceci dans une nouvelle fenêtre :
</p>
<img class="screenshot" src="./images/start-linux-app.png" alt="Capture d'écran de l'application Hello SFML" title="Capture d'écran de l'application Hello SFML" />

<?php

    require("footer-fr.php");

?>
