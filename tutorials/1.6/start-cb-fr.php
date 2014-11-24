<?php

    $title = "SFML et Code::Blocks";
    $page = "start-cb-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Code::Blocks</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Code::Blocks et le compilateur GCC
    (c'est celui par d�faut). Il va vous
    expliquer comme installer SFML, param�trer votre EDI, et compiler un programme SFML.<br/>
    La compilation des biblioth�ques SFML est �galement expliqu�e, pour les utilisateurs plus exp�riment�s (bien
    que ce soit relativement simple).
</p>

<?php h2('Installer SFML') ?>
<p>
    <strong>Important</strong>: cette release de SFML a �t� compil�e avec gcc 4.4, si votre propre version ne correspond pas et
    est incompatible, vous devrez recompiler SFML.
</p>
<p>
    Premi�rement, vous devez t�l�charger les fichiers de d�veloppement de SFML. Vous pouvez t�l�charger l'archive minimale
    (biblioth�ques + en-t�tes), mais il est recommand� de t�l�charger le SDK complet, qui contient en plus les exemples
    et la documentation.<br/>
    Ces archives peuvent �tre trouv�es sur la
    <a class="internal" href="../../download-fr.php" title="Aller � la page de t�l�chargements">page de t�l�chargements</a>.
</p>
<p>
    Une fois que vous avez t�l�charg� et extrait les fichiers sur votre disque dur, vous devez faire en sorte que
    Code::Blocks connaisse les fichiers en-t�tes et biblioth�ques de SFML. Il y a deux fa�ons de le faire :
</p>

<h4>Copier les fichiers de d�veloppement SFML directement dans le r�pertoire d'installation de Code::Blocks</h4>
<ul>
    <li>Copiez SFML-x.y\include\SFML vers le r�pertoire \include de votre installation de Code::Blocks
        (de mani�re � obtenir \include\SFML)</li>
    <li>Copiez les fichiers *.a de SFML-x.y\lib vers le r�pertoire \lib de votre installation de Code::Blocks</li>
</ul>

<h4>Laisser les fichiers SFML o� vous voulez, et param�trer Code::Blocks pour qu'il les trouve</h4>
<ul>
    <li>Allez dans le menu <em>Settings / Compiler and debugger</em>, puis dans <em>Global compiler settings / Search directories</em></li>
    <li>Dans <em>Compiler</em>, ajoutez SFML-x.y\include</li>
    <li>Dans <em>Linker</em>, ajoutez SFML-x.y\lib</li>
</ul>
<img class="screenshot" src="./images/start-cb-include-path.png" width="670" height="385" alt="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des en-t�tes" title="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des en-t�tes" />
<img class="screenshot" src="./images/start-cb-lib-path.png" width="670" height="385" alt="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des biblioth�ques" title="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des biblioth�ques" />

<?php h2('Compiler votre premier programme SFML') ?>
<p>
    Cr�ez un nouveau projet "Console application" utilisant le compilateur GCC, et �crivez un programme SFML. Par exemple, vous pouvez essayer
    la classe <?php class_link("Clock")?> du module syst�me :
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
    <em>Other link options</em>, ajoutez les biblioth�ques SFML que vous utilisez avec la directive "-l". Ici nous n'utilisons que
    libsfml-system.a, donc nous ajoutons "-lsfml-system". Pour la configuration Debug, vous pouvez lier avec les versions
    de d�bogage des biblioth�ques, qui sont suffix�es par "-d" ("-lsfml-system-d" dans ce cas).<br/>
    Ca c'est pour les biblioth�ques dynamiques, celles qui n�cessiteront les DLLs correspondantes. Si vous
    souhaitez plut�t lier avec les versions statiques des biblioth�ques SFML, vous pouvez utiliser le pr�fixe
    "-s" : -lsfml-system-s, ou -lsfml-system-s-d pour la version debug.
</p>
<img class="screenshot" src="./images/start-cb-project-link.png" width="672" height="520" alt="Capture d'�cran de la bo�te de dialogue pour param�trer les biblioth�ques du projet" title="Capture d'�cran de la bo�te de dialogue pour param�trer les biblioth�ques du projet" />
<p>
    Lorsque vous liez avec plusieurs biblioth�ques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est
    important pour MinGW. La r�gle est la suivante : si la biblioth�que XXX d�pend de (utilise) la biblioth�que YYY,
    sp�cifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics d�pend de sfml-window, qui lui-m�me d�pend
    de sfml-system. Les options d'�dition de lien seraient donc les suivantes :
</p>
<pre><code class="cpp">-lsfml-graphics
-lsfml-window
-lsfml-system
</code></pre>
<p>
    En gros, toute biblioth�que SFML d�pend de sfml-system, et sfml-graphics d�pend en plus de sfml-window. Voil� pour
    ce qui est des d�pendances.
</p>
<p>
    Votre programme devrait maintenant compiler, lier et s'ex�cuter sans probl�me. Si vous avez li� avec la version
    dynamique des biblioth�ques SFML, n'oubliez pas de copier les DLLs correspondantes (sfml-system.dll dans ce cas) dans
    le r�pertoire de votre ex�cutable, ou dans un r�pertoire contenu dans la variable d'environnement PATH.
</p>
<p>
    <strong>Important</strong> : si vous utilisez les biblioth�ques dynamiques, vous devez �galement d�finir la macro
    <strong>SFML_DYNAMIC</strong> dans les options de votre projet. Si vous ne le faites pas, vous aurez des erreurs
    d'�dition de liens lors de la compilation de votre application.
</p>
<img class="screenshot" src="./images/start-cb-project-dynamic.png" width="672" height="521" alt="Capture d'�cran de la bo�te de dialogue pour lier avec les biblioth�ques dynamiques" title="Capture d'�cran de la bo�te de dialogue pour lier avec les biblioth�ques dynamiques" />
<p>
    Si vous utilisez le module Audio, vous devez �galement copier les DLLs des biblioth�ques externes qu'il utilise,
    qui sont libsndfile-1.dll et OpenAL32.dll.<br/>
    Ces fichiers peuvent �tre trouv�s dans le r�pertoire extlibs\bin de l'archive que vous avez t�l�charg�e (SDK ou fichiers
    de d�veloppement).
</p>

<?php h2('Compiler SFML ') ?>
<p>
    Si les biblioth�ques pr�compil�es de SFML n'existent pas pour votre syst�me, ou si vous souhaitez utiliser les derni�res sources
    via SVN, vous pouvez compiler SFML assez facilement.
    Dans de tels cas, aucun test n'a �t� effectu� et nous vous encourageons donc � rapporter tout �chec ou succ�s rencontr�
    durant le processus de compilation. Si vous r�ussissez � compiler SFML pour une nouvelle plateforme, nous vous invitons
    � contacter l'�quipe de d�veloppement afin que nous puissions partager les fichiers avec la communaut�.
</p>
<p>
    Pour compiler les biblioth�ques SFML et les exemples, vous devez tout d'abord t�l�charger et installer le SDK complet
    (ou r�cup�rer les fichiers sur le d�p�t SVN).
</p>
<p>
    Allez dans le r�pertoire SFML-x.y\build\codeblocks, et ouvrez le fichier SFML.workspace. Choisissez la configuration que vous
    souhaitez construire (Debug ou Release, Static ou DLL), et cliquez sur "build workspace". Cela devrait cr�er les biblioth�ques
    SFML correspondantes dans le r�pertoire lib, ainsi que les ex�cutables des exemples.
</p>
<p>
    Si Qt et wxWidgets ne sont pas install�s sur votre syst�me,
    vous devriez avoir des erreurs de compilation avec les exemples correspondants ; ignorez les simplement.
</p>
<p>
    Compiler les biblioth�ques SFML statiques avec MinGW requiert une �tape suppl�mentaire si vous voulez �galement
    y inclure les biblioth�ques externes. Si vous ne le faites pas, vous aurez � lier explicitement vos programmes SFML
    � toutes les biblioth�ques externes qu'elle utilise.<br />
    Malheureusement Code::Blocks ne sait pas ex�cuter cette �tape automatiquement, mais il existe pour cela un script batch
    nomm� build.bat dans SFML-x.y\build\codeblocks\batch-build. Ce script compile automatiquement toutes les configurations
    des biblioth�ques SFML (debug/release statique/dynamique) and ex�cute l'�tape suppl�mentaire n�cessaire aux biblioth�ques
    statiques. Tout ce que vous avez � faire avant de l'ex�cuter est de rendre votre ex�cutable Code::Blocks (codeblocks.exe)
    accessible, c'est-�-dire mettre son chemin dans la variable d'environnement PATH.
</p>

<?php

    require("footer-fr.php");

?>
