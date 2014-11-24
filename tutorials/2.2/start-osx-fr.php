<?php

    $title = "SFML et Xcode (Mac OS X)";
    $page = "start-osx-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Xcode (Mac OS X)</h1>

<?php h2('Introduction') ?>
<p>
    Ceci est le premier tutoriel que vous devriez lire si vous utilisez SFML avec Xcode -- et de mani�re plus g�n�rale, si vous d�veloppez des applications pour Mac OS X.
    Ce tutoriel vous montrera comment installer SFML, configurer votre EDI et compiler un programme SFML simple. Mais aussi, plus important, comment cr�er des applications qui
    soient pr�tes � �tre utilis�es "<em>out of the box</em>" pour l'utilisateur final.
</p>
<p>
    Plusieurs liens sont donn�s dans ce document. Ils sont l� principalement pour les plus curieux d'entre vous ; vous n'avez pas besoin de les consulter pour suivre ce
    tutoriel.
</p>

<h3>Les pr�requis syst�me</h3>
<p>
    Tout ce dont vous avez besoin pour cr�er une application SFML est :
</p>
<ul>
    <li>un Mac Intel avec Lion ou ult�rieur (10.7+)</li>
    <li>avec <a href="http://developer.apple.com/xcode/" title="T�l�charger Xcode">Xcode</a> (de pr�f�rence la quatri�me, cinqui�me ou sixi�me version de l'EDI, qui est disponible sur l'<em>App Store</em>) et clang.</li>
</ul>
<p class="important">
    Avec les versions r�centes de Xcode vous devez aussi installer les <tt>Command Line Tools</tt> depuis <tt>Xcode &gt; Preferences &gt; Downloads &gt; Components</tt>.
</p>

<h3>Les binaires : dylib contre framework</h3>
<p>
    SFML est disponible en deux formats sous Mac OS X. Vous avez les biblioth�ques <em>dylib</em> d'un c�t�, et les bundles <em>framework</em> de l'autre. Tous deux sont
    fournis en tant que <a href="http://en.wikipedia.org/wiki/Universal_binary" title="Consulter la page wikipedia sur les binaires universels">binaires universels</a>,
    afin qu'ils puissent �tre utilis�s � la fois sur des syst�mes Intel 32 ou 64 bits sans que vous ayez � vous en pr�occuper.
</p>
<p>
    Dylib signifie "biblioth�que dynamique" ; ce format est similaire aux biblioth�ques <em>.so</em> sous Linux. Vous pourrez trouver plus de d�tails dans
    <a href="https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/" title="Consulter la documentation d'Apple sur les dylibs">ce
    document</a>. Les frameworks sont fondamentalement similaires aux dylibs, except� qu'ils peuvent int�grer des ressources externes. Voici
    <a href="https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html" title="Consulter la documentation d'Apple sur les frameworks">
    la documentation d�taill�e</a>.
</p>
<p>
    Il y a une seule diff�rence importante entre ces deux types de biblioth�ques � garder en t�te lorsque vous d�veloppez des applications SFML : si vous compilez SFML
    vous-m�me, vous pouvez cr�er les dylibs en version <em>release</em> et <em>debug</em>. Par contre, les frameworks ne sont disponibles qu'en version <em>release</em>.
    Ceci ne sera toutefois pas un probl�me car quand vous distribuerez votre application aux utilisateurs finaux car il est pr�f�rable d'utiliser la version <em>release</em>
    de SFML. C'est pourquoi les binaires pour OS X disponibles sur <a href="../../download-fr.php" title="Aller � la page des t�l�chargements">la page de t�l�chargements</a>
    sont uniquement en version <em>release</em>.
</p>

<h3>Les templates Xcode</h3>
<p>
    SFML est livr�e avec deux templates pour Xcode 4/5/6 qui vous permettent de cr�er tr�s rapidement et facilement de nouveaux projets d'applications. Ces templates peuvent
    cr�er des projets personnalis�s : vous pouvez selectionner les modules dont votre application a besoin, choisir d'utiliser SFML en tant que dylib ou framework
    et d�cider entre cr�er un bundle d'application contenant toutes ses ressources (rendant l'installation de votre application aussi simple qu'un
    glisser-d�poser) ou bien un binaire classique. Voyez plus bas pour plus de d�tails.
</p>
<p class="important">
    Soyez conscients que ces templates ne sont pas compatibles avec Xcode 3. Si vous utilisez toujours cette version de l'EDI et ne comptez pas le mettre � jour, vous
    pourrez toujours cr�er des applications SFML bien entendu, mais nous n'aborderons pas la mani�re de faire dans ce tutoriel. Veuillez vous rapporter � la documentation
    d'Apple concernant Xcode 3, et plus particuli�rement regarder comment ajouter une biblioth�que � votre projet.
</p>

<h3>C++11, libc++ et libstdc++</h3>
<p>
    Apple fournit une version personnalis�e de <tt>clang</tt> et <tt>libc++</tt> avec Xcode, qui supportent (une partie du) standard C++11 (i.e. les nouvelles fonctionnalit�s
    de C++11 ne sont pas encore toutes impl�ment�es).
    Si vous avez pr�vu d'utiliser ces nouvelles fonctionnalit�s, vous devez configurer votre projet pour utiliser <tt>clang</tt> et <tt>libc++</tt>.
</p>
<p>
    Cependant, si votre projet d�pend (indirectement ou non) de libstdc++ vous devez <a href="compile-with-cmake-fr.php" title="Compiler SFML avec CMake">compiler SFML vous-m�me</a>
    et configurer votre projet en cons�quence.
</p>

<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez t�l�charger le SDK SFML qui se trouve sur la <a href="../../download-fr.php" title="Aller � la page des t�l�chargements">page des t�l�chargements</a>.
    Puis, pour commencer � d�velopper des applications SFML, vous devez installer les composants suivants :
</p>
<ul>
    <li>
        Les fichiers d'en-t�te et les biblioth�ques<br />
        SFML est fournie en dylib ou en framework. Nous recommandons d'utiliser les frameworks mais les deux peuvent �tre install�s sur un m�me syst�me.
        <ul>
            <li>
                dylib<br />
                Copiez le contenu de <tt>lib</tt> dans <tt>/usr/local/lib</tt> et copiez le contenu de <tt>include</tt> dans <tt>/usr/local/include</tt>.
            </li>
            <li>
                frameworks<br />
                Copiez le contenu de <tt>Frameworks</tt> dans <tt>/Library/Frameworks</tt>.
            </li>
        </ul>
    </li>
    <li>
        Les d�pendances de SFML<br />
        SFML requiert seulement deux biblioth�ques externes sous Mac OS X. Copiez <tt>sndfile.framework</tt> et <tt>freetype.framework</tt> de <tt>extlibs</tt>
        dans <tt>/Library/Frameworks</tt>.
    </li>
    <li>
        Les templates Xcode<br />
        Ce composant est optionnel mais il est fortement recommand� de l'installer. Copiez le dossier <tt>SFML</tt> de <tt>templates</tt> dans
        <tt>/Library/Developer/Xcode/Templates</tt> (si besoin, cr�ez d'abord l'arborescence de r�pertoires).
    </li>
</ul>
<p>
    � noter que <tt>/Library</tt> peut �tre nomm� <tt>/Biblioth�que</tt> si votre syst�me est en fran�ais.
</p>

<?php h2('Cr�er un premier programme SFML') ?>
<p>
    Nous fournissons deux templates pour Xcode. <tt>SFML CLT</tt> g�n�re un projet pour une application terminal classique alors que <tt>SFML App</tt> cr�e un projet pour
    un bundle d'application. Nous allons utiliser ce dernier ici mais ils fonctionnent de mani�re relativement similaire.
</p>
<p>
    Tout d'abord, choisissez <tt>File &gt; New Project...</tt> puis s�lectionnez <tt>SFML</tt> dans la colonne de gauche et double cliquez sur <tt>SFML App</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project.png" alt="S�lection du template Xcode" title="S�lection du template Xcode" />
<p>
    Maintenant vous pouvez remplire les champs requis comme dans cette capture d'�cran ; puis pressez <tt>next</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project-settings.png" alt="Formulaire du template Xcode" title="Formulaire du template Xcode" />
<p>
    Votre nouveau projet est maintenant configur� pour cr�er un
    <a href="https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html"
    title="Consulter la documentation d'Apple sur les bundles d'application">bundle d'application ".app"</a>.
</p>
<p class="important">
    Quelques mots � propos de la configuration des templates.
    Si vous choisissez une option incompatible pour <tt>C++ Compiler and Standard Library</tt>,
    vous allez rencontrer des erreurs � l'�dition des liens.
    Faites bien attention � suivre cette ligne directrice :
</p>
<ul>
    <li>Si vous avez t�l�charg� la version "Clang" depuis la la page de t�l�chargement, vous devez choisir <tt>C++11 with Clang and libc++</tt>.</li>
    <li>Si vous avez compil� SFML vous-m�me, vous devriez savoir quelle option utiliser. ;-)</li>
</ul>
<p>
    Maintenant que votre projet est pr�t, voyons ce qu'il y a � l'int�rieur :
</p>
<img class="screenshot" src="images/start-osx-window.png" alt="Contenu du nouveau projet" title="Contenu du nouveau projet" />
<p>
    Comme vous pouvez le voir, il y a d�j� pas mal de fichiers dans le projet. Il y a trois cat�gories importantes :
</p>
<ol>
    <li>
        En-t�te &amp; fichiers sources : le projet vient avec un exemple basique dans <tt>main.cpp</tt> et une fonction d'utilitaire :
        <code>std::string resourcePath(void);</code> dans <tt>ResourcePath.hpp</tt> et <tt>ResourcePath.mm</tt>.
        Le but de cette fonction, comme illustr� dans l'exemple, est de fournir un moyen pratique d'acc�der au r�pertoire <tt>Resources</tt> du bundle d'application.<br />
        Notez bien que cette fonction ne marche que sous Mac OS X. Si vous pr�voyez de porter votre application sur un autre OS, vous devrez faire une autre impl�mentation
        de cette fonction.
    </li>
    <li>
        Fichiers ressources : les ressources de l'exemple de base sont mises dans ce r�pertoire et sont automatiquement copi�es dans votre bundle d'application lorsque vous
        le compilez.<br />
        Pour ajouter de nouvelles ressources � votre projet, glissez-les simplement dans ce r�pertoire et assurez-vous qu'elles font partie de la cible de l'application,
        i.e. la case sous <tt>Target Membership</tt> dans la zone utilitaire (<kbd>cmd+alt+1</kbd>) doit �tre coch�e.
    </li>
    <li>
        Produit: c'est votre application. Cliquez simplement sur le bouton <tt>Run</tt> pour la tester.
    </li>
</ol>
<p>
    Les autres fichier du projet ne sont pas tr�s int�ressants pour nous ici. Par contre, notez que les d�pendances de SFML de votre projet sont ajout�es � votre bundle
    d'application, d'une mani�re similaire que les fichiers de ressources sont copi�es, de sorte que l'application puisse s'ex�cuter directement sur un autre Mac sans aucune
    installation de SFML ou de ses d�pendances.
</p>

<?php

    require("footer-fr.php");

?>
