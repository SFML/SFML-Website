<?php

    $title = "SFML et Xcode (Mac OS X)";
    $page = "start-osx-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Xcode (Mac OS X)</h1>

<?php h2('Introduction') ?>
<p>
    Ceci est le premier tutoriel que vous devriez lire si vous utilisez SFML avec Xcode -- et de manière plus générale, si vous développez des applications pour Mac OS X.
    Ce tutoriel vous montrera comment installer SFML, configurer votre EDI et compiler un programme SFML simple. Mais aussi, plus important, comment créer des applications qui
    soient prêtes à être utilisées "<em>out of the box</em>" pour l'utilisateur final.
</p>
<p>
    Plusieurs liens sont donnés dans ce document. Ils sont là principalement pour les plus curieux d'entre vous ; vous n'avez pas besoin de les consulter pour suivre ce
    tutoriel.
</p>

<h3>Les prérequis système</h3>
<p>
    Tout ce dont vous avez besoin pour créer une application SFML est :
</p>
<ul>
    <li>un Mac Intel avec Leopard ou ultérieur</li>
    <li>et <a href="http://developer.apple.com/xcode/" title="Télécharger Xcode">Xcode</a> (de préférence la quatrième version de l'EDI, qui est disponible sur l'<em>App Store</em>).
    </li>
</ul>
<p class="important">
    Avec les versions récentes de Xcode vous devez aussi installer les <tt>Command Line Tools</tt> depuis <tt>Xcode &gt; Preferences &gt; Downloads &gt; Components</tt>.
</p>
<p class="important">
    Si vous avez Xcode 5, vous devez utiliser <a href="../../download-fr.php" title="Aller à la page des téléchargements">la nouvelle version des templates</a>.
</p>

<h3>Les binaires : dylib contre framework</h3>
<p>
    SFML est disponible en deux formats sous Mac OS X. Vous avez les bibliothèques <em>dylib</em> d'un côté, et les bundles <em>framework</em> de l'autre. Tous deux sont
    fournis en tant que <a href="http://en.wikipedia.org/wiki/Universal_binary" title="Consulter la page wikipedia sur les binaires universels">binaires universels</a>,
    afin qu'ils puissent être utilisés à la fois sur des systèmes Intel 32 ou 64 bits sans que vous ayez à vous en préoccuper.
</p>
<p>
    Dylib signifie "bibliothèque dynamique" ; ce format est similaire aux bibliothèques <em>.so</em> sous Linux. Vous pourrez trouver plus de détails dans
    <a href="https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/" title="Consulter la documentation d'Apple sur les dylibs">ce
    document</a>. Les frameworks sont fondamentalement similaires aux dylibs, excepté qu'ils peuvent intégrer des ressources externes. Voici 
    <a href="https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html" title="Consulter la documentation d'Apple sur les frameworks">
    la documentation détaillée</a>.
</p>
<p>
    Il y a une seule différence importante entre ces deux types de bibliothèques, à garder en tête lorsque vous développez des applications SFML : si vous compilez SFML
    vous-même, vous pouvez créer les dylibs en version <em>release</em> et <em>debug</em>. Par contre, les frameworks ne sont disponibles qu'en version <em>release</em>.
    Ceci ne sera toutefois pas un problème car quand vous distribuerez votre application aux utilisateurs finaux, il est préférable d'utiliser la version <em>release</em>
    de SFML. C'est pourquoi les binaires pour OS X disponibles sur <a href="../../download-fr.php" title="Aller à la page des téléchargements">la page de téléchargement</a>
    sont uniquement en version <em>release</em>.
</p>

<h3>Les templates Xcode</h3>
<p>
    SFML est livrée avec deux templates pour Xcode 4 qui vous permettent de créer très rapidement et facilement de nouveaux projets d'applications. Ces templates peuvent
    créer des projets personnalisés : vous pouvez selectionner les modules dont votre application a besoin, choisir d'utiliser SFML en tant que dylib ou framework, choisir
    quel compilateur utiliser et choisir entre créer un bundle d'application contenant toutes ses ressources (rendant l'installation de votre application aussi simple qu'un
    glisser-déposer) ou bien un binaire classique. Voyez plus bas pour plus de détails.
</p>
<p class="important">
    Soyez conscients que ces templates ne sont pas compatibles avec Xcode 3. Si vous utilisez toujours cette version de l'EDI et ne comptez pas le mettre à jour, vous
    pourrez toujours créer des applications SFML bien entendu, mais nous n'aborderons pas la manière de faire dans ce tutoriel. Veuillez vous rapporter à la documentation
    d'Apple concernant Xcode 3, et plus particulièrement regarder comment ajouter une bibliothèque à votre projet.
</p>

<h3>C++ 11</h3>
<p>
    Apple fournit une version personnalisée de <tt>clang</tt> et <tt>libc++</tt> avec Xcode 4, qui supportent une partie du standard C++11 (i.e. les nouvelles fonctionnalités
    de C++11 ne sont pas encore toutes implémentées).
    Si vous avez prévu d'utiliser ces nouvelles fonctionnalités, vous devez configurer votre projet pour
    utiliser <tt>clang</tt> et <tt>libc++</tt>.
    De plus, vous devez faire attention de télécharger la bonne version (plus de détails suivent).
</p>

<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez télécharger le SDK SFML qui se trouve sur la <a href="../../download-fr.php" title="Aller à la page des téléchargements">page des téléchargements</a>.
</p>
<p>
    Pour commencer à développer des applications SFML, vous devez installer les composants suivants :
</p>
<p class="imporant">
    Si vous voulez cibler Mac OS X Leopard (10.5) voud devez télécharger la version "GCC".
    Gardez à l'esprit que cette version n'est pas compatible avec les fonctionnalités de C++11.
    Si vous voulez les utiliser, vous devez télécharger la version "Clang".
    Cette dernière est compatible avec Mountain Lion (10.8) et supérieur.
</p>
<ul>
    <li>
        Les fichiers d'en-tête et les bibliothèques<br />
        Comme indiqué au début de ce document, SFML est fournie en dylib ou en framework. Nous recommandons d'utiliser les frameworks mais les deux peuvent être installés
        sur un même système.
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
        Les dépendances de SFML<br />
        SFML requiert seulement deux bibliothèques externes sous Mac OS X. Copiez <tt>sndfile.framework</tt> et <tt>freetype.framework</tt> de <tt>extlibs</tt> 
        dans <tt>/Library/Frameworks</tt>.
    </li>
    <li>
        Les templates Xcode 4<br />
        Ce composant est optionnel mais il est fortement recommandé de l'installer. Copiez le dossier <tt>SFML</tt> de <tt>templates</tt> dans
        <tt>~/Library/Developer/Xcode/Templates</tt> (si besoin, créez d'abord l'arborescence de répertoires).
    </li>
</ul>
<p>
    SFML est fournie avec un script <tt>install.sh</tt> qui peut installer tous les composants pour vous.
    Il va faire attention à conserver les éventuelles anciennes version de SFML sur votre système, tout spécialement les frameworks,
    de sorte que vos applications puissent toujours s'exécuter sans modification.
    Vous avez seulement à ouvrir un terminal dans le répertoire du SDK téléchargé et lancer <code>./install.sh</code>.
    Le script va alors vous demander votre mot de passe et tout installer à la bonne place.
</p>
<p>
    À noter que <tt>/Library</tt> peut être nommé <tt>/Bibliothèque</tt> si votre système est en français.
</p>

<?php h2('Créer un premier programme SFML') ?>
<p>
    Nous fournissons deux templates pour Xcode. <tt>SFML CLT</tt> génère un projet pour une application terminal classique alors que <tt>SFML App</tt> crée un projet pour
    un bundle d'application. Nous allons utiliser ce dernier ici mais ils fonctionnent relativement similairement.
</p>
<p>
    Tout d'abord, choisissez <tt>File &gt; New Project...</tt> puis sélectionnez <tt>SFML</tt> dans la colonne de gauche et double cliquez sur <tt>SFML App</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project.png" alt="Sélection du template Xcode" title="Sélection du template Xcode" />
<p>
    Maintenant vous pouvez remplire les champs requis comme dans cette capture d'écran ; puis pressez <tt>next</tt>.
</p>
<img class="screenshot" src="images/start-osx-new-project-settings.png" alt="Formulaire du template Xcode" title="Formulaire du template Xcode" />
<p>
    Votre nouveau projet est maintenant configuré pour créer un
    <a href="https://developer.apple.com/library/mac/#documentation/CoreFoundation/Conceptual/CFBundles/BundleTypes/BundleTypes.html"
    title="Consulter la documentation d'Apple sur les bundles d'application">bundle d'application ".app"</a>.
</p>
<p class="important">
    Quelques mots à propos de la configuration des templates.
    Si vous choisissez une option incompatible pour <tt>C++ Compiler and Standard Library</tt>,
    vous allez rencontrer des erreurs à l'édition des liens.
    Faites bien attention à suivre cette ligne directrice :
</p>
<ul>
    <li>Si vous avez téléchargé la version "GCC" depuis la page de téléchargement, vous devez choisir <tt>C++98 with GCC and libstdc++ and target 10.5</tt>.</li>
    <li>Si vous avez téléchargé la version "Clang" depuis la la page de téléchargement, vous devez choisir <tt>C++11 with Clang and libc++</tt>.</li>
    <li>Si vous avez compilé SFML vous-même, vous devriez savoir quelle option utiliser. ;-)</li>
</ul>
<p>
    Maintenant que votre projet est prêt, voyons ce qu'il y a à l'intérieur :
</p>
<img class="screenshot" src="images/start-osx-window.png" alt="Contenu du nouveau projet" title="Contenu du nouveau projet" />
<p>
    Comme vous pouvez le voir, il y a déjà pas mal de fichiers dans le projet. Il y a trois catégories importantes :
</p>
<ol>
    <li>
        En-tête &amp; fichiers sources : le projet vient avec un exemple basique dans <tt>main.cpp</tt> et une fonction d'utilitaire :
        <code>std::string resourcePath(void);</code> dans <tt>ResourcePath.hpp</tt> et <tt>ResourcePath.mm</tt>.
        Le but de cette fonction, comme illustré dans l'exemple, est de fournir un moyen pratique d'accéder au répertoire <tt>Resources</tt> du bundle d'application.<br />
        Notez bien que cette fonction ne marche que sous Mac OS X. Si vous prévoyez de porter votre application sur un autre OS, vous devrez faire une autre implémentation
        de cette fonction.
    </li>
    <li>
        Fichiers ressources : les ressources de l'exemple de base sont mises dans ce répertoire et sont automatiquement copiées dans votre bundle d'application lorsque vous
        le compilez.<br />
        Pour ajouter de nouvelles ressources à votre projet, glissez-les simplement dans ce répertoire et assurez-vous qu'elles font partie de la cible de l'application,
        i.e. la case sous <tt>Target Membership</tt> dans la zone utilitaire (<kbd>cmd+alt+1</kbd>) doit être cochée.
    </li>
    <li>
        Produit: c'est votre application. Cliquez simplement sur le bouton <tt>Run</tt> pour la tester.
    </li>
</ol>
<p>
    Les autres fichier du projet ne sont pas très intéressants pour nous ici. Par contre, notez que les dépendances de SFML de votre projet sont ajoutées à votre bundle
    d'application, d'une manière similaire que les fichiers de ressources sont copiées, de sorte que l'application puisse s'exécuter directement sur un autre Mac sans aucune
    installation de SFML ou de ses dépendances.
</p>

<?php

    require("footer-fr.php");

?>
