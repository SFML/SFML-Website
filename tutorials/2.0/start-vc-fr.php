<?php

    $title = "SFML et Visual studio";
    $page = "start-vc-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Visual studio</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utiliser SFML avec l'EDI Visual Studio (compilateur Visual C++). Il va vous expliquer
    comment configurer vos projets SFML.
</p>

<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez t�l�charger le SDK SFML depuis la
    <a class="internal" href="../../download-fr.php" title="Aller � la page des t�l�chargements">page des t�l�chargements</a>.
</p>
<p class="important">
    Vous devez t�l�charger le package qui correspond � cotre version de Visual C++. En effet, une biblioth�que compil�e avec VC++ 9 (Visual Studio 2008)
    ne sera pas compatible avec Visual C++ 10 (Visual Studio 2010) par exemple. S'il n'y a aucun package de SFML compil� pour votre version
    de Visual C++, vous devrez <a class="internal" href="./compile-with-cmake-fr.php" title="Comment compiler SFML">recompiler SFML</a>.
</p>
<p>
    Vous pouvez ensuite d�compresser l'archive SFML o� vous le souhaitez. Copier les en-t�tes et les biblioth�ques directement dans le r�pertoire
    de votre installation de Visual Studio est d�conseill�, il vaut mieux laisser les biblioth�ques � part dans leur coin, tout particuli�rement si
    vous avez l'intention d'utiliser plusieurs versions de la m�me biblioth�que, ou plusieurs compilateurs.
</p>

<?php h2('Cr�er et configurer un projet SFML') ?>
<p>
    La premi�re chose � faire est de choisir quel type de projet cr�er : vous devez s�lectionner "Win32 application". L'assistant offre quelques options
    pour personnaliser le projet : choisissez "Console application" si vous voulez la console, ou "Windows application" si vous n'en avez pas besoin.
    Cochez la case "Empty project" si vous ne voulez pas �tre emb�t� avec du code g�n�r� automatiquement.<br />
    Pour les besoins de ce tutoriel, vous devez �galement cr�er un fichier main.cpp et l'ajouter imm�diatement au projet, de mani�re � avoir acc�s
    aux options C++ (sinon, Visual Studio ne sait pas quel langage vous allez utiliser dans le projet). Nous verrons plus tard quoi mettre dedans.
</p>
<p>
    Maintenant, nous devons dire au compilateur o� trouver les en-t�tes SFML (fichiers .hpp), et � l'�diteur de liens o� trouver les biblioth�ques SFML
    (fichiers .lib).
</p>
<p>
    Dans les propri�t�s du projet, ajoutez :
</p>
<ul>
    <li>Le chemin vers les en-t�tes SFML (<em>&lt;installation-de-sfml&gt;/include</em>) � C/C++ &raquo; General &raquo; Additional Include Directories</li>
    <li>Le chemin vers les biblioth�ques SFML (<em>&lt;installation-de-sfml&gt;/lib</em>) � Linker &raquo; General &raquo; Additional Library Directories</li>
</ul>
<p>
    Ces chemins sont les m�mes en configuration Debug et Release, vous pouvez donc les affecter globalement au projet ("All configurations").
</p>
<img class="screenshot" src="./images/start-vc-paths.png" alt="Capture d'�cran de la bo�te de dialogue pour configurer les chemins de recherche" title="Capture d'�cran de la bo�te de dialogue pour configurer les chemins de recherche" />
<p>
    L'�tape suivante est de lier votre application aux biblioth�ques SFML (fichiers .lib) dont votre code a besoin. SFML est compos�e de 5 modules
    (syst�me, fen�trage, graphique, r�seau et audio), et il y a une biblioth�que pour chacun.<br />
    Les biblioth�ques doivent �tre ajout�es dans les propri�t�s du projet, dans Linker &raquo; Input &raquo; Additional Dependencies. Ajoutez toutes les
    biblioth�ques SFML dont avez besoin, par exemple "sfml-graphics.lib", "sfml-window.lib" et "sfml-system.lib".
</p>
<img class="screenshot" src="./images/start-vc-link-libs.png" alt="Capture d'�cran de la bo�te de dialogue pour configurer les biblioth�ques du projet" title="Capture d'�cran de la bo�te de dialogue pour configurer les biblioth�ques du projet" />
<p class="important">
    Il est important de lier les bibioth�ques qui correspondent � la configuration : "sfml-xxx-d.lib" pour Debug, and "sfml-xxx.lib" pour Release.
    Un mauvais m�lange pourrait entra�ner des crashs.
</p>
<p>
    Les options montr�es ici vont lier votre application � la version dynamique de SFML, celle qui requiert les fichiers DLLs. Si vous voulez
    vous d�barasser de ces DLLs et avoir SFML directement int�gr�e � votre ex�cutable, vous devez lier � la version statique. Les biblioth�ques
    statiques de SFML ont le suffixe "-s" : "sfml-xxx-s-d.lib" pour Debug, et "sfml-xxx-s.lib" pour Release.<br />
    Dans ce cas, vous devrez aussi d�finir la macro SFML_STATIC dans les options pr�processeur de votre projet.
</p>
<img class="screenshot" src="./images/start-vc-static.png" alt="Capture d'�cran de la bo�te de dialogue pour d�finir la macro SFML_STATIC" title="Capture d'�cran de la bo�te de dialogue pour d�finir la macro SFML_STATIC" />
<p>
    Si vous ne connaissez pas les diff�rences entre les biblioth�ques dynamiques (aussi appel�es "partag�es") et statiques, et ne savez pas lesquelles
    utiliser, vous pouvez faire une petite recherche sur Google, vous devriez trouver de bons articles/messages pour vous aider.
</p>
<p>
    Votre projet est pr�t, �crivons maintenant un peu de code pour voir si tout cela fonctionne. Copiez le code suivant dans le fichier main.cpp :
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
    Si vous avez choisi de cr�er un projet "Windows application", alors le point d'entr�e de votre code devrait �tre la fonction "WinMain" au lieu de
    "main". Etant donn� que c'est sp�cifique � Windows, et que votre code ne compilerait donc pas sous Linux ou Mac OS X, SFML fournit un moyen de garder
    un point d'entr�e "main" standard dans ce cas : liez votre projet au module sfml-main ("sfml-main-d.lib" en Debug, "sfml-main.lib" en Release),
    de la m�me mani�re que vous avez li� sfml-graphics, sfml-window et sfml-system.
</p>
<p>
    Maintenant compilez le projet, et si vous avez li� � la version dynamique de SFML, n'oubliez pas de copier les DLLs (elles se trouvent dans
    <em>&lt;installation-de-sfml/bin&gt;</em>) dans le r�pertoire o� se trouve votre ex�cutable compil�. Puis lancez-le, et si tout s'est bien pass�
    vous devriez voir ceci :
</p>
<img class="screenshot" src="./images/start-vc-app.png" alt="Capture d'�cran de l'application Hello SFML" title="Capture d'�cran de l'application Hello SFML" />
<p>
    Si vous utilisez le module sfml-audio (que ce soit dynamiquement ou statiquement), vous devez aussi copier les DLLs des biblioth�ques externes dont
    il d�pend, qui sont libsndfile-1.dll et OpenAL32.dll.<br/>
    Ces fichiers se trouvent �galement dans <em>&lt;installation-de-sfml/bin&gt;</em>.
</p>

<?php

    require("footer-fr.php");

?>
