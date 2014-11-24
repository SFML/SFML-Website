<?php

    $title = "SFML et Code::Blocks (MinGW)";
    $page = "start-cb-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Code::Blocks (MinGW)</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Code::Blocks et le compilateur gcc (celui qui est livr� avec par
    d�faut). Il va vous expliquer comment configurer vos projets SFML.
</p>

<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez t�l�charger le SDK SFML depuis la
    <a class="internal" href="../../download-fr.php" title="Aller � la page des t�l�chargements">page des t�l�chargements</a>.
</p>
<p class="important">
    Il existe plusieurs variantes de gcc pour Windows, qui sont incompatibles entre elles (diff�rences au niveau de la gestion
    des exceptions, du mod�le de threading, etc.). Assurez-vous de bien choisir le bon package, selon la version que vous utilisez. Si vous ne savez pas
    quelle est votre version, vous pouvez regarder dans le r�pertoire MinGW/bin lequel des fichiers libgcc_s_sjlj-1.dll ou libgcc_s_dw2-1.dll vous
    avez. Si vous utilisez la version de gcc qui vient avec Code::Blocks, alors il s'agit probablement d'une version SJLJ.
    <br />
    Si vous pensez que votre version de gcc ne fonctionnera avec aucune des versions des biblioth�ques SFML pr�compil�es, n'h�sitez pas �
    <a class="internal" href="./compile-with-cmake-fr.php" title="Comment compiler SFML">recompiler SFML</a>, ce n'est pas compliqu�.
</p>
<p>
    Vous pouvez ensuite d�compresser l'archive SFML o� vous voulez. Copier les en-t�tes et biblioth�ques directement dans votre r�pertoire MinGW n'est
    pas conseill�, il vaut mieux laisser les biblioth�ques � part dans leur coin, tout particuli�rement si vous avez l'intention d'utiliser plusieurs
    versions d'une m�me biblioth�que, ou plusieurs compilateurs diff�rents.
</p>

<?php h2('Cr�er et configurer un projet SFML') ?>
<p>
    La premi�re chose � faire est de choisir quel type de projet cr�er. Code::Blocks propose une grande vari�t� de types de projets, dont l'un est
    "SFML project". <strong>Ne l'utilisez pas !</strong> Il semble qu'il ne fonctionne tout simplement pas. Choisissez plut�t un projet vide
    (Empty project). Si vous voulez une application graphique sans console, allez dans les propri�t�s du projet, puis dans l'onglet "Build targets",
    et choisissez "GUI application" dans la liste d�roulante au lieu de "Console application".
</p>
<p>
    Nous devons maintenant indiquer au compilateur o� trouver les en-t�tes SFML (fichiers .hpp), et � l'�diteur de liens o� trouver les
    biblioth�ques SFML (fichiers .a).
</p>
<p>
    Dans les "Build options" du projet, onglet "Search directories", ajoutez :
</p>
<ul>
    <li>Le chemin vers les en-t�tes SFML (<em>&lt;installation-de-sfml&gt;/include</em>) aux chemins de recherche du compilateur (Compiler)</li>
    <li>Le chemin vers les biblioth�ques SFML (<em>&lt;installation-de-sfml&gt;/lib</em>) aux chemins de recherche de l'�diteur de liens (Linker)</li>
</ul>
<p>
    Ces chemins sont les m�mes dans les deux configurations (Debug et Release), vous pouvez donc les affecter globalement pour tout le projet.
</p>
<img class="screenshot" src="./images/start-cb-paths.png" alt="Capture d'�cran de la bo�te de dialogue pour configurer les chemins de recherche" title="Capture d'�cran de la bo�te de dialogue pour configurer les chemins de recherche" />
<p>
    L'�tape suivante est de lier votre application aux biblioth�ques SFML (fichiers .a) que votre code utilise. SFML est compos�e de 5 modules (syst�me,
    fen�trage, graphique, r�seau et audio), et il y a une biblioth�que pour chacun.<br />
    Les biblioth�ques doivent �tre ajout�es aux propri�t�s du projet, dans l'onglet "Linker settings", dans la liste "Link libraries". Ajoutez toutes les
    biblioth�ques SFML dont vous avez besoin, par exemple "sfml-graphics", "sfml-window" et "sfml-system" (le pr�fixe "lib" et l'extension ".a" doivent
    �tre omises).
</p>
<img class="screenshot" src="./images/start-cb-link-libs.png" alt="Capture d'�cran de la bo�te de dialogue pour configurer les biblioth�ques du projet" title="Capture d'�cran de la bo�te de dialogue pour configurer les biblioth�ques du projet" />
<p class="important">
    Il est important de lier les biblioth�ques qui correspondent � la configuration : "sfml-xxx-d" pour Debug, et "sfml-xxx" pour Release. Un mauvais
    m�lange pourrait produire des crashs.
</p>
<p class="important">
    Lorsque vous liez � plusieurs biblioth�ques SFML, assurez-vous de les lier dans le bon ordre, c'est tr�s important pour gcc. La r�gle est que
    les biblioth�ques qui d�pendent d'autres doivent �tre ajout�es en premier dans la liste. Chaque biblioth�que SFML d�pend de sfml-system, et
    sfml-graphics d�pend aussi de sfml-window. Ainsi, le bon ordre pour ces trois biblioth�ques serait : sfml-graphics, sfml-window, sfml-system --
    comme dans la capture d'�cran ci-dessus.
</p>
<p>
    Les options montr�es ici vont lier votre application � la version dynamique de SFML, celle qui a besoin des fichiers DLL pour fonctionner.
    Si vous voulez vous d�barasser de ces DLLs et avoir SFML directement int�gr�e � votre ex�cutable, vous devez lier � la version statique. Les
    biblioth�ques statiques de SFML ont le suffixe "-s" : "sfml-xxx-s-d" en Debug et "sfml-xxx-s" en Release.<br />
    Dans ce cas, vous devrez aussi d�finir la macro SFML_STATIC dans les options pr�processeur de votre projet.
</p>
<img class="screenshot" src="./images/start-cb-static.png" alt="Capture d'�cran de la bo�te de dialogue pour d�finir la macro SFML_STATIC" title="Capture d'�cran de la bo�te de dialogue pour d�finir la macro SFML_STATIC" />
<p>
    Si vous ne connaissez pas les diff�rences entre les biblioth�ques dynamiques (aussi appel�es "partag�es") et statiques, et ne savez pas lesquelles
    utiliser, vous pouvez faire une petite recherche sur Google, vous devriez trouver de bons articles/messages pour vous aider.
</p>
<p>
    Votre projet est pr�t, �crivons maintenant un peu de code pour voir si tout cela fonctionne. Ajoutez un fichier "main.cpp" � votre projet, avec le
    code suivant dedans :
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
    Compilez-le, et si vous avez li� la version dynamique de SFML, n'oubliez pas de copier les DLLs de SFML (qui se trouvent dans
    <em>&lt;installation-de-sfml/bin&gt;</em>) dans le r�pertoire o� se trouve votre ex�cutable compil�. Puis lancez le programme, et si tout s'est bien
    pass� vous devriez voir ceci :
</p>
<img class="screenshot" src="./images/start-cb-app.png" alt="Capture d'�cran de l'application Hello SFML" title="Capture d'�cran de l'application Hello SFML" />
<p>
    Si vous utilisez le module sfml-audio (que ce soit dynamiquement ou statiquement), vous devez aussi copier les DLLs des biblioth�ques externes dont
    il d�pend, qui sont libsndfile-1.dll et OpenAL32.dll.<br/>
    Ces fichiers se trouvent �galement dans <em>&lt;installation-de-sfml/bin&gt;</em>.
</p>

<?php

    require("footer-fr.php");

?>
