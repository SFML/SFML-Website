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
    Diff�rentes approches sont possibles pour installer SFML sous Linux :
</p>
<ul>
    <li>L'installer directement depuis les d�p�ts de votre distrib Linux</li>
    <li>T�l�charger le SDK et copier les fichiers manuellement</li>
    <li>La compiler directement � partir des sources</li>
</ul>
<p>
    L'option 1 est de loin celle � pr�f�rer; si la version de SFML que vous souhaitez installer est disponible dans les d�p�ts officiels, alors
    installez la simplement avec votre gestionnaire de paquets. Par exemple, sous Debian vous feriez :
</p>
<pre><code class="no-highlight">sudo apt-get install libsfml-dev</code></pre>
<p>
    L'option 3 n�cessite plus de travail : vous devez installer les fichiers de d�veloppement de toutes les d�pendances de SFML, installer CMake, et
    ex�cuter quelques commandes � la main. Mais le r�sultat sera un package parfait, qui prend en compte toutes les sp�cificit�s de votre syst�me.<br />
    Si vous allez dans cette direction, il y a un tutoriel d�di� �
    <a class="internal" href="./compile-with-cmake-fr.php" title="Comment compiler SFML">la compilation de SFML</a>.
</p>
<p>
    Enfin, l'option 2 est un bon compromis pour une installation rapide si SFML n'est pas disponible en tant que package officiel. T�l�chargez le SDK
    depuis la <a class="internal" href="../../download-fr.php" title="Aller � la page des t�l�chargements">page des t�l�chargements</a>, d�compressez-le
    et copier les fichiers vers votre endroit pr�f�r� : soit un chemin � part dans votre dossier personnel (comme <em>/home/moi/sfml</em>), ou bien un
    chemin standard (comme <em>/usr/local</em>).
</p>
<p>
    Si vous avez d�j� une ancienne version de SFML install�e, assurez-vous qu'elle n'entre pas en conflit avec la nouvelle version !
</p>

<?php h2('Compiler un programme SFML') ?>
<p>
    Dans ce tutoriel nous n'allons pas parler des EDIs tels que Code::Blocks ou Eclipse. Nous d�taillerons simplement les commandes requises pour
    compiler et lier un ex�cutable SFML, mais �crire un makefile complet ou configurer un projet dans un EDI sort du cadre de ce tutoriel -- il existe
    de meilleurs tutoriels sp�cifique pour ces choses.<br />
    Si vous utilisez Code::Blocks, vous pouvez aller jeter un oeil au
    <a class="internal" href="./start-cb-fr.php" title="SFML et Code::Blocks">tutoriel pour Code::Blocks sous Windows</a>; les instructions devraient �tre
    similaires, sauf que si vous avez install� SFML dans un chemin standard du syst�me vous n'aurez pas � d�finir les chemins de recherche du compilateur
    et de l'�diteur de liens.
</p>
<p>
    Pour commencer, cr�ez un fichier source, nomm� "main.cpp", contenant ce petit programme SFML :
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
    Si vous avez install� SFML dans un chemin non-standard, vous devez indiquer au compilateur o� trouver les en-t�tes SFML (les fichiers .hpp) :
</p>
<pre><code class="no-highlight">g++ -c main.cpp -I<em>&lt;installation-de-sfml&gt;</em>/include</code></pre>
<p>
    Ici, <em>&lt;installation-de-sfml&gt;</em> est le r�pertoire dans lequel vous avez copi� SFML, par exemple <em>/home/moi/sfml</em>.
</p>
<p>
    Puis, vous devez lier le fichier compil� aux biblioth�ques SFML afin de produire l'ex�cutable final. SFML est compos�e de 5 modules (syst�me,
    fen�trage, graphique, r�seau et audio), et il y a une biblioth�que pour chacun.<br />
    Pour lier une biblioth�que SFML, vous devez ajouter "-lsfml-xxx" � votre ligne de commande, par exemple "-lsfml-graphics" pour le module graphique
    (par rapport au nom du fichier correspondant, le pr�fixe "lib" et l'extension ".so" doivent �tre omis).
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    Si vous avez install� SFML dans un chemin non-standard, vous devrez indiquer � l'�diteur de liens o� trouver les biblioth�ques SFML (fichiers .so) :
</p>
<pre><code class="no-highlight">g++ main.o -o sfml-app -L<em>&lt;installation-de-sfml&gt;</em>/lib -lsfml-graphics -lsfml-window -lsfml-system</code></pre>
<p>
    Nous sommes maintenant pr�ts � ex�cuter le programme compil� :
</p>
<pre><code class="no-highlight">./sfml-app</code></pre>
<p>
    Si SFML n'est pas install�e dans un chemin standard, vous devrez d'abord dire au chargeur de biblioth�ques o� trouver les biblioth�ques de SFML :
</p>
<pre><code class="no-highlight">export LD_LIBRARY_PATH=<em>&lt;installation-de-sfml&gt;</em>/lib &amp;&amp; ./sfml-app</code></pre>
<p>
    Si tout s'est bien pass�, vous devriez voir ceci dans une nouvelle fen�tre :
</p>
<img class="screenshot" src="./images/start-linux-app.png" alt="Capture d'�cran de l'application Hello SFML" title="Capture d'�cran de l'application Hello SFML" />

<?php

    require("footer-fr.php");

?>
