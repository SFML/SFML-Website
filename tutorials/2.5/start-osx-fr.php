<?php

    $title = "SFML et Xcode (macOS)";
    $page = "start-osx-fr.php";

    require("header-fr.php");

?>

<h1>SFML et Xcode (macOS)</h1>

<?php h2('Introduction') ?>
<p>
    Ceci est le premier tutoriel que vous devriez lire si vous utilisez SFML avec Xcode -- et de manière plus générale, si vous développez des applications pour macOS.
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
    <li>un Mac Intel 64-bit avec Lion ou ultérieur (10.7+)</li>
    <li>avec <a href="http://developer.apple.com/xcode/" title="Télécharger Xcode">Xcode</a> (les versions 4 et ultérieurs de l'EDI, qui est disponible sur l'<em>App Store</em>, sont supportées)</li>
    <li>avec clang et libc++ (fournis par Xcode).</li>
</ul>
<p class="important">
    Avec les versions récentes de Xcode vous devez aussi installer les <tt>Command Line Tools</tt> depuis <tt>Xcode &gt; Preferences &gt; Downloads &gt; Components</tt>. Si vous ne trouvez pas les CLT dans Xcode, utilisez <code>xcode-select --install</code> dans un Terminal et suivez les instructions à l'écran.
</p>

<h3>Les binaires : dylib contre framework</h3>
<p>
    SFML est disponible en deux formats sous macOS. Vous avez les bibliothèques <em>dylib</em> d'un côté, et les bundles <em>framework</em> de l'autre.
</p>
<ul>
    <li>
      Dylib signifie "bibliothèque dynamique" ; ce format est similaire aux bibliothèques <em>.so</em> sous Linux. Vous pourrez trouver plus de détails dans
      <a href="https://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/" title="Consulter la documentation d'Apple sur les dylibs">ce
      document</a>.
    </li>
    <li>
      Les frameworks sont fondamentalement similaires aux dylibs, excepté qu'ils peuvent intégrer des ressources externes. Voici
      <a href="https://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html" title="Consulter la documentation d'Apple sur les frameworks">
      la documentation détaillée</a>.
    </li>
</ul>
<p>
    Il y a une seule différence importante entre ces deux types de bibliothèques à garder en tête lorsque vous développez des applications SFML : si vous compilez SFML
    vous-même, vous pouvez créer les dylibs en version <em>release</em> et <em>debug</em>. Par contre, les frameworks ne sont disponibles qu'en version <em>release</em>.
    Ceci ne sera toutefois pas un problème car quand vous distribuerez votre application aux utilisateurs finaux il est préférable d'utiliser la version <em>release</em>
    de SFML. C'est pourquoi les binaires pour OS X disponibles sur <a href="../../download-fr.php" title="Aller à la page des téléchargements">la page de téléchargements</a>
    sont uniquement en version <em>release</em>.
</p>

<h3>Les templates Xcode</h3>
<p>
    SFML est livrée avec deux templates pour Xcode 4+ qui vous permettent de créer très rapidement et facilement de nouveaux projets d'applications. Ces templates peuvent
    créer des projets personnalisés : vous pouvez selectionner les modules dont votre application a besoin, choisir d'utiliser SFML en tant que dylib ou framework
    et décider entre créer un bundle d'application contenant toutes ses ressources (rendant l'installation de votre application aussi simple qu'un
    glisser-déposer) ou bien un binaire classique. Voyez plus bas pour plus de détails.
</p>
<p class="important">
    Soyez conscients que ces templates ne sont pas compatibles avec Xcode 3. Si vous utilisez toujours cette version de l'EDI et ne comptez pas le mettre à jour, vous
    pourrez toujours créer des applications SFML bien entendu, mais nous n'aborderons pas la manière de faire dans ce tutoriel. Veuillez vous rapporter à la documentation
    d'Apple concernant Xcode 3, et plus particulièrement regarder comment ajouter une bibliothèque à votre projet.
</p>


<?php h2('Installer SFML') ?>
<p>
    Tout d'abord, vous devez télécharger le SDK SFML qui se trouve sur la <a href="../../download-fr.php" title="Aller à la page des téléchargements">page des téléchargements</a>.
    Puis, pour commencer à développer des applications SFML, vous devez installer les composants suivants :
</p>
<ul>
    <li>
        <strong>Les fichiers d'en-tête et les bibliothèques</strong><br />
        SFML est fournie en dylib ou en framework. Nous recommandons d'utiliser les frameworks mais les deux peuvent être installés sur un même système.
        <ul>
            <li><em>frameworks</em><br />
                Copiez le contenu de <tt>Frameworks</tt> dans <tt>/Library/Frameworks</tt>.
            </li>
            <li><em>dylib</em><br />
                Copiez le contenu de <tt>lib</tt> dans <tt>/usr/local/lib</tt> et copiez le contenu de <tt>include</tt> dans <tt>/usr/local/include</tt>.
            </li>
        </ul>
    </li>
    <li>
        <strong>Les dépendances de SFML</strong><br />
        SFML requiert seulement quelques bibliothèques externes sous macOS. Copiez le contenu de <tt>extlibs</tt>
        dans <tt>/Library/Frameworks</tt>.
    </li>
    <li>
        <strong>Les templates Xcode</strong><br />
        Ce composant est optionnel mais il est fortement recommandé de l'installer.
        Copiez le dossier <tt>SFML</tt> de <tt>templates</tt> dans <tt>~/Library/Developer/Xcode/Templates</tt> (si besoin, créez d'abord l'arborescence de répertoires).
    </li>
</ul>
<p>
    À noter que <tt>/Library</tt> peut être nommé <tt>/Bibliothèque</tt> si votre système est en français.
</p>

<?php h2('Créer un premier programme SFML') ?>
<p>
    Nous fournissons deux templates pour Xcode. <tt>SFML CLT</tt> génère un projet pour une application terminal classique alors que <tt>SFML App</tt> crée un projet pour
    un bundle d'application. Nous allons utiliser ce dernier ici mais ils fonctionnent de manière relativement similaire.
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
<p>
    Maintenant que votre projet est prêt, voyons ce qu'il y a à l'intérieur :
</p>
<img class="screenshot" src="images/start-osx-window.png" alt="Contenu du nouveau projet" title="Contenu du nouveau projet" />
<p>
    Comme vous pouvez le voir, il y a déjà pas mal de fichiers dans le projet. Il y a trois catégories importantes :
</p>
<ol>
    <li>
        <strong>En-tête &amp; fichiers sources :</strong> le projet vient avec un exemple basique dans <tt>main.cpp</tt> et une fonction d'utilitaire :
        <code>std::string resourcePath(void);</code> dans <tt>ResourcePath.hpp</tt> et <tt>ResourcePath.mm</tt>.
        Le but de cette fonction, comme illustré dans l'exemple, est de fournir un moyen pratique d'accéder au répertoire <tt>Resources</tt> du bundle d'application.<br />
        Notez bien que cette fonction ne marche que sous macOS. Si vous prévoyez de porter votre application sur un autre OS, vous devrez faire une autre implémentation
        de cette fonction.
    </li>
    <li>
        <strong>Fichiers ressources :</strong> les ressources de l'exemple de base sont mises dans ce répertoire et sont automatiquement copiées dans votre bundle d'application lorsque vous
        le compilez.<br />
        Pour ajouter de nouvelles ressources à votre projet, glissez-les simplement dans ce répertoire et assurez-vous qu'elles font partie de la cible de l'application,
        i.e. la case sous <tt>Target Membership</tt> dans la zone utilitaire (<kbd>cmd+alt+1</kbd>) doit être cochée.
    </li>
    <li>
        <strong>Produit :</strong> c'est votre application. Cliquez simplement sur le bouton <tt>Run</tt> pour la tester.
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
