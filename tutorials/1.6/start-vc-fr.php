<?php

    $title = "SFML et Visual Studio";
    $page = "start-vc-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Visual Studio</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec le compilateur Visual C++. Il va vous
    expliquer comme installer SFML, param�trer votre EDI, et compiler un programme SFML.<br/>
    La compilation des biblioth�ques SFML est �galement expliqu�e, pour les utilisateurs plus exp�riment�s (bien
    que ce soit relativement simple).
</p>
<p>
    SFML est maintenue sous VC++ 2008 Professionnel, mais les explications suivantes sont valides pour d'autres
    versions telles que les �ditions express, VC++ 2010, VC++ 2005, VC++ 2003 ou m�me VC++ 6.
</p>

<?php h2('Installer SFML') ?>
<p>
    Premi�rement, vous devez t�l�charger les fichiers de d�veloppement de SFML. Vous pouvez t�l�charger l'archive minimale
    (biblioth�ques + en-t�tes), mais il est recommand� de t�l�charger le SDK complet, qui contient en plus les exemples
    et la documentation.<br />
    Ces archives peuvent �tre trouv�es sur la
    <a class="internal" href="../../download-fr.php" title="Aller � la page de t�l�chargements">page de t�l�chargements</a>.
</p>
<p>
    Une fois que vous avez t�l�charg� et extrait les fichiers sur votre disque dur, vous devez faire en sorte que
    Visual C++ trouve les fichiers en-t�tes et biblioth�ques de SFML. Il y a deux fa�ons de le faire :
</p>

<h4>Copiez les fichiers de d�veloppement SFML directement dans le r�pertoire d'installation de Visual Studio</h4>
<ul>
    <li>Copiez SFML-x.y\include\SFML vers le r�pertoire VC\include de votre installation de Visual Studio
        (de mani�re � obtenir VC\include\SFML)</li>
    <li>Copiez les fichiers *.lib de SFML-x.y\lib vers le r�pertoire VC\lib de votre installation de Visual Studio</li>
</ul>

<h4>Laissez les fichiers SFML o� vous voulez, et param�trez Visual Studio pour qu'il les trouve</h4>
<ul>
    <li>Allez dans le menu <em>Tools / Options</em>, puis dans <em>Projects and Solutions / VC++ Directories</em></li>
    <li>Dans <em>Include files</em>, ajoutez SFML-x.y\include</li>
    <li>Dans <em>Library files</em>, ajoutez SFML-x.y\lib</li>
</ul>
<img class="screenshot" src="./images/start-vc-include-path.png" width="643" height="381" alt="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des en-t�tes" title="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des en-t�tes" />
<img class="screenshot" src="./images/start-vc-lib-path.png" width="643" height="381" alt="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des biblioth�ques" title="Capture d'�cran de la bo�te de dialog pour param�trer le chemin des biblioth�ques" />

<?php h2('Compiler votre premier programme SFML') ?>
<p>
    Cr�ez un nouveau projet "Win32 console application", et �crivez un programme SFML. Par exemple, vous pouvez essayer
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
    Ouvrez les options de votre projet, puis allez dans le menu <em>Linker / Input</em>. A la ligne
    <em>Additional dependencies</em>, ajoutez les biblioth�ques SFML que vous utilisez. Ici nous n'utilisons que
    sfml-system.lib.<br/>
    Ca c'est pour les biblioth�ques dynamiques, celles qui n�cessiteront les DLLs correspondantes. Si vous
    souhaitez plut�t lier avec les versions statiques des biblioth�ques SFML, vous pouvez utiliser le pr�fixe
    "-s" : sfml-system-s.lib, ou sfml-system-s-d.lib pour la version debug.
</p>
<p>
    <strong>Important</strong> : pour la configuration Debug, il est imp�ratif de lier avec les versions de d�bogage des
    biblioth�ques SFML, qui sont suffix�es par "-d" (sfml-system-d.lib ou sfml-system-s-d.lib dans ce cas). En effet,
    m�langer configurations Debug et Release peut r�sulter en de multiples erreurs ou crashs.
</p>
<img class="screenshot" src="./images/start-vc-project-link.png" width="749" height="521" alt="Capture d'�cran de la bo�te de dialogue pour param�trer les biblioth�ques du projet" title="Capture d'�cran de la bo�te de dialogue pour param�trer les biblioth�ques du projet" />
<p>
    Votre programme devrait maintenant compiler, lier et s'ex�cuter sans probl�me. Si vous avez li� avec la version
    dynamique des biblioth�ques SFML, n'oubliez pas de copier les DLLs correspondantes (sfml-system.dll dans ce cas) dans
    le r�pertoire de votre ex�cutable, ou dans un r�pertoire contenu dans la variable d'environnement PATH.
</p>
<p>
    <strong>Important</strong> : si vous utilisez les biblioth�ques dynamiques, vous devrez �galement d�finir la macro
    <strong>SFML_DYNAMIC</strong> dans les options de votre projet. Si vous oubliez cette �tape, vous aurez droit � des erreurs
    d'�dition de liens.
</p>
<img class="screenshot" src="./images/start-vc-project-dynamic.png" width="749" height="521" alt="Capture d'�cran de la bo�te de dialogue pour lier avec les biblioth�ques dynamiques" title="Capture d'�cran de la bo�te de dialogue pour lier avec les biblioth�ques dynamiques" />
<p>
    Si vous utilisez le module Audio, vous devez �galement copier les DLLs des biblioth�ques externes qu'il utilise,
    qui sont libsndfile-1.dll et OpenAL32.dll.<br/>
    Ces fichiers peuvent �tre trouv�s dans le r�pertoire extlibs\bin de l'archive que vous avez t�l�charg�e (SDK ou fichiers
    de d�veloppement).
</p>

<?php h2('Compiler SFML') ?>
<p>
    Si les biblioth�ques pr�compil�es de SFML n'existent pas pour votre syst�me, ou si vous souhaitez utiliser les toutes
    derni�res sources via SVN, vous pouvez compiler SFML assez facilement.
    Dans de tels cas, aucun test n'a �t� effectu� et nous vous encourageons donc � rapporter tout �chec ou succ�s rencontr�
    durant le processus de compilation. Si vous r�ussissez � compiler SFML pour une nouvelle plateforme, nous vous invitons
    � contacter l'�quipe de d�veloppement afin que nous puissions partager les fichiers avec la communaut�.
</p>
<p>
    Pour compiler les biblioth�ques SFML et les exemples, vous devez tout d'abord t�l�charger et installer le SDK complet
    (ou r�cup�rer les fichiers n�cessaires � partir du d�p�t SVN).
</p>
<p>
    Allez dans le r�pertoire SFML-x.y\build\vc2005 (ou SFML-x.y\build\vc2008 si vous utilisez VC++ 2008), et ouvrez le fichier
    SFML.sln. Choisissez la configuration que vous souhaitez construire (Debug ou Release, Static ou DLL) puis cliquez sur
    "build". Cela devrait cr�er les biblioth�ques SFML correspondantes dans le r�pertoire lib,
    ainsi que les ex�cutables des exemples.
</p>
<p>
    Si Qt et wxWidgets ne sont pas install�s sur votre syst�me, vous devriez avoir des erreurs de compilation avec les exemples
    correspondants ; ignorez les simplement.
</p>

<?php

    require("footer-fr.php");

?>
