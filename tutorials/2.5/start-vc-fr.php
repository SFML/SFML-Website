<?php

    $title = "SFML et Visual Studio";
    $page = "start-vc-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Visual Studio</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utiliser SFML avec l'EDI Visual Studio (compilateur Visual C++). Il va vous expliquer
    comment configurer vos projets SFML.
</p>

<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez télécharger le SDK SFML depuis la
    <a class="internal" href="../../download-fr.php" title="Aller à la page des téléchargements">page des téléchargements</a>.
</p>
<p class="important">
    Vous devez télécharger le package qui correspond à votre version de Visual C++. En effet, une bibliothèque compilée avec VC++ 10 (Visual Studio 2010)
    ne sera pas compatible avec Visual C++ 12 (Visual Studio 2013) par exemple. S'il n'y a aucun package de SFML compilé pour votre version
    de Visual C++, vous devrez <a class="internal" href="./compile-with-cmake-fr.php" title="Comment compiler SFML">recompiler SFML</a>.
</p>
<p>
    Vous pouvez ensuite décompresser l'archive SFML où vous le souhaitez. Copier les en-têtes et les bibliothèques directement dans le répertoire
    de votre installation de Visual Studio est déconseillé, il vaut mieux laisser les bibliothèques à part dans leur coin, tout particulièrement si
    vous avez l'intention d'utiliser plusieurs versions de la même bibliothèque, ou plusieurs compilateurs.
</p>

<?php h2('Créer et configurer un projet SFML') ?>
<p>
    La première chose à faire est de choisir quel type de projet créer. Il est recommandé de sélectionner "Empty project".
    L'assistant offre quelques options pour personnaliser le projet : choisissez "Console application" ou "Windows application" uniquement si vous
    savez vous servir des en-têtes précompilés.<br />
    Pour les besoins de ce tutoriel, vous devez également créer un fichier main.cpp et l'ajouter immédiatement au projet, de manière à avoir accès
    aux options C++ (sinon, Visual Studio ne sait pas quel langage vous allez utiliser dans le projet). Nous verrons plus tard quoi mettre dedans.
</p>
<p>
    Maintenant, nous devons dire au compilateur où trouver les en-têtes SFML (fichiers .hpp), et à l'éditeur de liens où trouver les bibliothèques SFML
    (fichiers .lib).
</p>
<p>
    Dans les propriétés du projet, ajoutez :
</p>
<ul>
    <li>Le chemin vers les en-têtes SFML (<em>&lt;installation-de-sfml&gt;/include</em>) à C/C++ &raquo; General &raquo; Additional Include Directories</li>
    <li>Le chemin vers les bibliothèques SFML (<em>&lt;installation-de-sfml&gt;/lib</em>) à Linker &raquo; General &raquo; Additional Library Directories</li>
</ul>
<p>
    Ces chemins sont les mêmes en configuration Debug et Release, vous pouvez donc les affecter globalement au projet ("All configurations").
</p>
<img class="screenshot" src="./images/start-vc-paths.png" alt="Capture d'écran de la boîte de dialogue pour configurer les chemins de recherche" title="Capture d'écran de la boîte de dialogue pour configurer les chemins de recherche" />
<p>
    L'étape suivante est de lier votre application aux bibliothèques SFML (fichiers .lib) dont votre code a besoin. SFML est composée de 5 modules
    (système, fenêtrage, graphique, réseau et audio), et il y a une bibliothèque pour chacun.<br />
    Les bibliothèques doivent être ajoutées dans les propriétés du projet, dans Linker &raquo; Input &raquo; Additional Dependencies. Ajoutez toutes les
    bibliothèques SFML dont avez besoin, par exemple "sfml-graphics.lib", "sfml-window.lib" et "sfml-system.lib".
</p>
<img class="screenshot" src="./images/start-vc-link-libs.png" alt="Capture d'écran de la boîte de dialogue pour configurer les bibliothèques du projet" title="Capture d'écran de la boîte de dialogue pour configurer les bibliothèques du projet" />
<p class="important">
    Il est important de lier les bibliothèques qui correspondent à la configuration : "sfml-xxx-d.lib" pour Debug, et "sfml-xxx.lib" pour Release.
    Un mauvais mélange pourrait entraîner des crashs.
</p>
<p>
    Les options montrées ici vont lier votre application à la version dynamique de SFML, celle qui requiert les fichiers DLLs. Si vous voulez
    vous débarrasser de ces DLLs et avoir SFML directement intégrée à votre exécutable, vous devez lier à la version statique. Les bibliothèques
    statiques de SFML ont le suffixe "-s" : "sfml-xxx-s-d.lib" pour Debug, et "sfml-xxx-s.lib" pour Release.<br />
    Dans ce cas, vous devrez aussi définir la macro SFML_STATIC dans les options préprocesseur de votre projet.
</p>
<img class="screenshot" src="./images/start-vc-static.png" alt="Capture d'écran de la boîte de dialogue pour définir la macro SFML_STATIC" title="Capture d'écran de la boîte de dialogue pour définir la macro SFML_STATIC" />
<p class="important">
    Depuis SFML 2.2, lors d'une liaison statique, il faut aussi lier toutes les dépendances de SFML. Par exemple : si vous liez à sfml-window-s.lib ou sfml-window-s-d.lib sur Windows, il faudra aussi lier à winmm.lib, gdi32.lib et opengl32.lib. Parfois ces bibliothèques seront listées sous "Inherited values" mais les ajouter une fois de plus ne devrait pas poser de problème.
</p>
<p>
    Voici la liste des dépendances de chaque module ; il faudra y ajouter -d pour lier les bibliothèques SFML de débogage.
</p>
<table class="styled expanded">
    <thead>
        <tr>
            <th class="expand-left">Module</th>
            <th class="expand-right">Dépendences</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>sfml-graphics-s.lib</code></td>
            <td><ul>
                <li>sfml-window-s.lib</li>
                <li>sfml-system-s.lib</li>
                <li>opengl32.lib</li>
                <li>freetype.lib</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-window-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>opengl32.lib</li>
                <li>winmm.lib</li>
                <li>gdi32.lib</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-audio-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>openal32.lib</li>
                <li>flac.lib</li>
                <li>vorbisenc.lib</li>
                <li>vorbisfile.lib</li>
                <li>vorbis.lib</li>
                <li>ogg.lib</li>
            </ul></td>
        </tr>
        <tr class="two">
            <td><code>sfml-network-s.lib</code></td>
            <td><ul>
                <li>sfml-system-s.lib</li>
                <li>ws2_32.lib</li>
            </ul></td>
        </tr>
        <tr class="one">
            <td><code>sfml-system-s.lib</code></td>
            <td><ul>
                <li>winmm.lib</li>
            </ul></td>
        </tr>
    </tbody>
</table>
<p>
    Il est important de remarquer que les modules de SFML peuvent dépendre les uns des autres. Par exemple, sfml-graphics-s.lib dépend de sfml-window-s.lib et de sfml-system-s.lib.
    Si vous liez statiquement une bibliothèque SFML, soyez sûr de lier les dépendances de cette bibliothèque ainsi que les dépendances de ses dépendances. Si une partie de l'arbre de dépendances manque, il est <em>certain</em> que vous aurez des erreurs de liaison.
</p>
<p>
    Si vous êtes un peu perdu, ne vous inquiétez pas. Il est parfaitement normal pour un débutant d'être submergé par toutes ces informations. Si quelque chose ne marche pas du premier coup, vous pouvez toujours essayer de vous rappeler de ce qu'il a été dit ci-dessus. Si vous n'y parvenez toujours pas, vous pouvez consulter la <a class="internal" href="../../faq.php#build-link-static" title="Visitez la page FAQ">FAQ</a> ou le <a href="http://fr.sfml-dev.org/forums/index.php?board=25.0">forum</a> pour trouver des astuces sur l'édition des liens statiques.
</p>
<p>
    Si vous ne connaissez pas les différences entre les bibliothèques dynamiques (aussi appelées "partagées") et statiques, et ne savez pas lesquelles
    utiliser, vous pouvez faire une petite recherche sur Google, vous devriez trouver de bons articles/messages pour vous aider.
</p>
<p>
    Votre projet est prêt, écrivons maintenant un peu de code pour voir si tout cela fonctionne. Copiez le code suivant dans le fichier main.cpp :
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
    Si vous avez choisi de créer un projet "Windows application", alors le point d'entrée de votre code devrait être la fonction "WinMain" au lieu de
    "main". Étant donné que c'est spécifique à Windows, et que votre code ne compilerait donc pas sous Linux ou macOS, SFML fournit un moyen de garder
    un point d'entrée "main" standard dans ce cas : liez votre projet au module sfml-main ("sfml-main-d.lib" en Debug, "sfml-main.lib" en Release),
    de la même manière que vous avez lié sfml-graphics, sfml-window et sfml-system.
</p>
<p>
    Maintenant compilez le projet, et si vous avez lié à la version dynamique de SFML, n'oubliez pas de copier les DLLs (elles se trouvent dans
    <em>&lt;installation-de-sfml/bin&gt;</em>) dans le répertoire où se trouve votre exécutable compilé. Puis lancez-le, et si tout s'est bien passé
    vous devriez voir ceci :
</p>
<img class="screenshot" src="./images/start-vc-app.png" alt="Capture d'écran de l'application Hello SFML" title="Capture d'écran de l'application Hello SFML" />
<p>
    Si vous utilisez le module sfml-audio (que ce soit dynamiquement ou statiquement), vous devez aussi copier la DLL de bibliothèque externe dont
    il dépend, qui est OpenAL32.dll.<br/>
    Ces fichiers se trouvent également dans <em>&lt;installation-de-sfml/bin&gt;</em>.
</p>

<?php

    require("footer-fr.php");

?>
