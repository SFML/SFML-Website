<?php

    $title = "SFML et Code::Blocks";
    $page = "start-cb-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Code::Blocks</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Code::Blocks et le compilateur GCC
    (c'est celui par défaut). Il va vous
    expliquer comme installer SFML, paramétrer votre EDI, et compiler un programme SFML.<br/>
    La compilation des bibliothèques SFML est également expliquée, pour les utilisateurs plus expérimentés (bien
    que ce soit relativement simple).
</p>

<?php h2('Installer SFML') ?>
<p>
    <strong>Important</strong>: cette release de SFML a été compilée avec gcc 4.4, si votre propre version ne correspond pas et
    est incompatible, vous devrez recompiler SFML.
</p>
<p>
    Premièrement, vous devez télécharger les fichiers de développement de SFML. Vous pouvez télécharger l'archive minimale
    (bibliothèques + en-têtes), mais il est recommandé de télécharger le SDK complet, qui contient en plus les exemples
    et la documentation.<br/>
    Ces archives peuvent être trouvées sur la
    <a class="internal" href="../../download-fr.php" title="Aller à la page de téléchargements">page de téléchargements</a>.
</p>
<p>
    Une fois que vous avez téléchargé et extrait les fichiers sur votre disque dur, vous devez faire en sorte que
    Code::Blocks connaisse les fichiers en-têtes et bibliothèques de SFML. Il y a deux façons de le faire :
</p>

<h4>Copier les fichiers de développement SFML directement dans le répertoire d'installation de Code::Blocks</h4>
<ul>
    <li>Copiez SFML-x.y\include\SFML vers le répertoire \include de votre installation de Code::Blocks
        (de manière à obtenir \include\SFML)</li>
    <li>Copiez les fichiers *.a de SFML-x.y\lib vers le répertoire \lib de votre installation de Code::Blocks</li>
</ul>

<h4>Laisser les fichiers SFML où vous voulez, et paramétrer Code::Blocks pour qu'il les trouve</h4>
<ul>
    <li>Allez dans le menu <em>Settings / Compiler and debugger</em>, puis dans <em>Global compiler settings / Search directories</em></li>
    <li>Dans <em>Compiler</em>, ajoutez SFML-x.y\include</li>
    <li>Dans <em>Linker</em>, ajoutez SFML-x.y\lib</li>
</ul>
<img class="screenshot" src="./images/start-cb-include-path.png" width="670" height="385" alt="Capture d'écran de la boîte de dialog pour paramétrer le chemin des en-têtes" title="Capture d'écran de la boîte de dialog pour paramétrer le chemin des en-têtes" />
<img class="screenshot" src="./images/start-cb-lib-path.png" width="670" height="385" alt="Capture d'écran de la boîte de dialog pour paramétrer le chemin des bibliothèques" title="Capture d'écran de la boîte de dialog pour paramétrer le chemin des bibliothèques" />

<?php h2('Compiler votre premier programme SFML') ?>
<p>
    Créez un nouveau projet "Console application" utilisant le compilateur GCC, et écrivez un programme SFML. Par exemple, vous pouvez essayer
    la classe <?php class_link("Clock")?> du module système :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;iostream&gt;

int main()
{
    sf::Clock Clock;
    while (Clock.GetElapsedTime() &lt; 5.f)
    {
        std::cout &lt;&lt; Clock.GetElapsedTime() &lt;&lt; std::endl;
        sf::Sleep(0.5f);
    }

    return 0;
}
</code></pre>
<p>
    N'oubliez pas que toutes les classes et fonctions SFML se trouvent dans l'espace de nommage <code>sf</code>.
</p>
<p>
    Ouvrez les options de votre projet, puis allez dans l'onglet <em>Linker settings</em>. Dans
    <em>Other link options</em>, ajoutez les bibliothèques SFML que vous utilisez avec la directive "-l". Ici nous n'utilisons que
    libsfml-system.a, donc nous ajoutons "-lsfml-system". Pour la configuration Debug, vous pouvez lier avec les versions
    de débogage des bibliothèques, qui sont suffixées par "-d" ("-lsfml-system-d" dans ce cas).<br/>
    Ca c'est pour les bibliothèques dynamiques, celles qui nécessiteront les DLLs correspondantes. Si vous
    souhaitez plutôt lier avec les versions statiques des bibliothèques SFML, vous pouvez utiliser le préfixe
    "-s" : -lsfml-system-s, ou -lsfml-system-s-d pour la version debug.
</p>
<img class="screenshot" src="./images/start-cb-project-link.png" width="672" height="520" alt="Capture d'écran de la boîte de dialogue pour paramétrer les bibliothèques du projet" title="Capture d'écran de la boîte de dialogue pour paramétrer les bibliothèques du projet" />
<p>
    Lorsque vous liez avec plusieurs bibliothèques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est
    important pour MinGW. La règle est la suivante : si la bibliothèque XXX dépend de (utilise) la bibliothèque YYY,
    spécifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics dépend de sfml-window, qui lui-même dépend
    de sfml-system. Les options d'édition de lien seraient donc les suivantes :
</p>
<pre><code class="cpp">-lsfml-graphics
-lsfml-window
-lsfml-system
</code></pre>
<p>
    En gros, toute bibliothèque SFML dépend de sfml-system, et sfml-graphics dépend en plus de sfml-window. Voilà pour
    ce qui est des dépendances.
</p>
<p>
    Votre programme devrait maintenant compiler, lier et s'exécuter sans problème. Si vous avez lié avec la version
    dynamique des bibliothèques SFML, n'oubliez pas de copier les DLLs correspondantes (sfml-system.dll dans ce cas) dans
    le répertoire de votre exécutable, ou dans un répertoire contenu dans la variable d'environnement PATH.
</p>
<p>
    <strong>Important</strong> : si vous utilisez les bibliothèques dynamiques, vous devez également définir la macro
    <strong>SFML_DYNAMIC</strong> dans les options de votre projet. Si vous ne le faites pas, vous aurez des erreurs
    d'édition de liens lors de la compilation de votre application.
</p>
<img class="screenshot" src="./images/start-cb-project-dynamic.png" width="672" height="521" alt="Capture d'écran de la boîte de dialogue pour lier avec les bibliothèques dynamiques" title="Capture d'écran de la boîte de dialogue pour lier avec les bibliothèques dynamiques" />
<p>
    Si vous utilisez le module Audio, vous devez également copier les DLLs des bibliothèques externes qu'il utilise,
    qui sont libsndfile-1.dll et OpenAL32.dll.<br/>
    Ces fichiers peuvent être trouvés dans le répertoire extlibs\bin de l'archive que vous avez téléchargée (SDK ou fichiers
    de développement).
</p>

<?php h2('Compiler SFML ') ?>
<p>
    Si les bibliothèques précompilées de SFML n'existent pas pour votre système, ou si vous souhaitez utiliser les dernières sources
    via SVN, vous pouvez compiler SFML assez facilement.
    Dans de tels cas, aucun test n'a été effectué et nous vous encourageons donc à rapporter tout échec ou succès rencontré
    durant le processus de compilation. Si vous réussissez à compiler SFML pour une nouvelle plateforme, nous vous invitons
    à contacter l'équipe de développement afin que nous puissions partager les fichiers avec la communauté.
</p>
<p>
    Pour compiler les bibliothèques SFML et les exemples, vous devez tout d'abord télécharger et installer le SDK complet
    (ou récupérer les fichiers sur le dépôt SVN).
</p>
<p>
    Allez dans le répertoire SFML-x.y\build\codeblocks, et ouvrez le fichier SFML.workspace. Choisissez la configuration que vous
    souhaitez construire (Debug ou Release, Static ou DLL), et cliquez sur "build workspace". Cela devrait créer les bibliothèques
    SFML correspondantes dans le répertoire lib, ainsi que les exécutables des exemples.
</p>
<p>
    Si Qt et wxWidgets ne sont pas installés sur votre système,
    vous devriez avoir des erreurs de compilation avec les exemples correspondants ; ignorez les simplement.
</p>
<p>
    Compiler les bibliothèques SFML statiques avec MinGW requiert une étape supplémentaire si vous voulez également
    y inclure les bibliothèques externes. Si vous ne le faites pas, vous aurez à lier explicitement vos programmes SFML
    à toutes les bibliothèques externes qu'elle utilise.<br />
    Malheureusement Code::Blocks ne sait pas exécuter cette étape automatiquement, mais il existe pour cela un script batch
    nommé build.bat dans SFML-x.y\build\codeblocks\batch-build. Ce script compile automatiquement toutes les configurations
    des bibliothèques SFML (debug/release statique/dynamique) and exécute l'étape supplémentaire nécessaire aux bibliothèques
    statiques. Tout ce que vous avez à faire avant de l'exécuter est de rendre votre exécutable Code::Blocks (codeblocks.exe)
    accessible, c'est-à-dire mettre son chemin dans la variable d'environnement PATH.
</p>

<?php

    require("footer-fr.php");

?>
