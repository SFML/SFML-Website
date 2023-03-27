<?php

    $title = "Compiler SFML avec CMake";
    $page = "compile-with-cmake-fr.php";

    require("header-fr.php");

?>

<h1>Compiler SFML avec CMake</h1>

<?php h2('Introduction') ?>
<p>
    Bon, d'accord, le titre de ce tutoriel n'est pas complètement exact. Vous n'allez <em>pas</em> compiler SFML avec CMake, car CMake n'est <em>pas</em>
    un compilateur. Mais alors CMake, c'est quoi ?
</p>
<p>
    CMake est un meta-système de compilation. Au lieu de construire SFML, il va construire ce qui construit SFML : des solutions Visual Studio,
    des workspaces Code::Blocks, des makefiles Linux, des projets XCode, ... en fait il peut générer des makefiles et projets pour l'OS et le
    compilateur de votre choix. C'est un outil similaire à autoconf/automake ou premake -- pour ceux qui connaissent.
</p>
<p>
    CMake est largement utilisé, par des projets connus tels que Blender, CLion, KDE, Ogre et bien d'autres. Vous pourrez en apprendre plus concernant CMake
    sur son <a class="external" title="site officiel de CMake" href="http://www.cmake.org/">site officiel</a> ou sur la
    <a class="external" title="page wikipedia de CMake" href="http://fr.wikipedia.org/wiki/CMake">page Wikipedia</a>.
</p>
<p>
    Ainsi, comme vous l'aurez probablement compris, ce tutoriel est composé de deux sections : générer les projets/makefiles de compilation avec CMake,
    puis compiler SFML avec votre environnement préféré.
</p>

<?php h2('Installer les dependances') ?>
<p>
    SFML dépend de quelques autres bibliothèques, ainsi avant de compiler vous devez avoir installé leurs fichiers de développement
    (en-têtes et bibliothèques).
</p>
<p>
    Sous Windows et macOS, toutes les dépendances nécessaires sont fournies directement avec SFML, vous n'avez rien à télécharger/installer.
    La compilation fonctionnera directement.
</p>
<p>
    Sous Linux c'est un peu différent, rien n'est fourni et SFML utilise votre propre installation des bibliothèques desquelles elle dépend. Voici
    une liste de ce que vous devez installer avant de compiler SFML :
</p>
<ul>
    <li>freetype</li>
    <li>x11</li>
    <li>xrandr</li>
    <li>udev</li>
    <li>opengl</li>
    <li>flac</li>
    <li>ogg</li>
    <li>vorbis</li>
    <li>vorbisenc</li>
    <li>vorbisfile</li>
    <li>openal</li>
    <li>pthread</li>
</ul>
<p>
    Le nom exact des paquets dépend de chaque distribution. Et n'oubliez pas d'installer les versions de <em>development</em> de ces paquets.
</p>

<?php h2('Configurer la compilation de SFML') ?>
<p>
    Cette étape consiste à créer les projets/makefiles qui pourront finalement compiler SFML. En gros, cela consiste à choisir <em>quoi</em>
    compiler, <em>comment</em> le compiler et <em>où</em>. Plus quelques autres options qui vous permettront de créer la compilation qui répondra
    parfaitement à vos besoins -- nous verrons cela en détail plus tard.
</p>
<p>
    La première chose à choisir est l'endroit où les projets/makefiles et fichiers objets (les fichiers résultant de la compilation) seront
    créés. Vous pouvez les générer directement dans l'arborescence source (ie. la racine des répertoires SFML), mais cela va polluer votre
    répertoire SFML avec pas mal de déchets : une hiérarchie complète de fichiers de compilation, fichiers objets, etc. La solution la plus propre
    est de générer les projets/makefiles dans un répertoire complètement séparé, de manière à garder votre répertoire SFML intact. Utiliser des
    répertoires séparés vous permettra aussi d'avoir plusieurs compilations différentes en même temps (statique, dynamique, debug, release, ...).
</p>
<p>
    Maintenant que vous avez choisi le répertoire de compilation, il y a encore une chose à faire avant de pouvoir lancer CMake. Lorsque CMake configure
    votre projet, il teste la disponibilité et la version du compilateur choisi. Ainsi, l'exécutable du compilateur doit être accessible quand
    CMake est lancé. Ce n'est pas un problème pour les utilisateurs Linux ou macOS, étant donné que les compilateurs sont installés dans des
    chemins standards et tout le temps accessibles, mais sous Windows il se pourrait que vous deviez ajouter le répertoire de votre compilateur
    à la variable d'environnement PATH, afin que CMake puisse le trouver automatiquement. Ceci est particulièrement important lorsque vous avez
    plusieurs compilateurs, ou plusieurs versions du même compilateur.
</p>
<p>
    Sous Windows, si vous voulez utiliser GCC (MinGW), vous pouvez ajouter temporairement le répertoire MinGW\bin au PATH puis lancer
    CMake à partir de l'invite de commande :
</p>
<pre><code class="no-highlight">&gt; set PATH=%PATH%;votre_repertoire_mingw\bin
&gt; cmake -G"MinGW Makefiles" ./build
</code></pre>
<p>
    Avec Visual C++, vous pouvez soit lancer CMake depuis l'"invite de commande de Visual Studio" disponible depuis le menu démarrer, ou bien appeler
    le fichier vcvars32.bat de votre installation de Visual Studio ; cela aura pour effet de configurer les variables d'environnement (notamment PATH)
    correctement.
</p>
<pre><code class="no-highlight">&gt; votre_repertoire_visual_studio\VC\bin\vcvars32.bat
&gt; cmake -G"NMake Makefiles" ./build
</code></pre>
<p>
    Maintenant vous êtes prêts à faire tourner CMake. En fait, il y a trois façons différentes de l'invoquer :
</p>
<ul>
    <li><strong>cmake-gui</strong><br />
        Il s'agit de l'interface graphique, qui vous permet de tout configurer avec des boutons et des champs de saisie ; c'est probablement la
        meilleure solution pour les débutants et les personnes qui ne veulent pas s'embarasser de la ligne de commande ; c'est aussi très pratique
        pour voir et éditer les options disponibles.
    </li>
    <li><strong>cmake -i</strong><br />
        Il s'agit de la ligne de commande interactive, elle vous invitera à remplir chaque option explicitement ; c'est un bon compromis pour
        démarrer avec la ligne de commande, étant donné que vous ne vous rappellerez certainement pas toutes les options qui sont disponibles,
        ni ne saurez lesquelles sont pertinentes.
    </li>
    <li><strong>cmake</strong><br />
        C'est l'invocation directe, vous devez passer en un coup toutes les options avec leur valeur.
    </li>
</ul>
<p>
    Je focaliserai ce tutoriel sur cmake-gui, étant donné que c'est très probablement ce qu'utiliseront les débutants. Je suppose que les personnes
    qui utilisent la ligne de commande peuvent en apprendre la syntaxe dans le manuel de CMake. A part les captures d'écran et les directives du
    genre "cliquez ici", les explications ci-dessous sont tout aussi valables pour la ligne de commande (les options sont les mêmes).
</p>
<p>
    Voici à quoi ressemble cmake-gui :
</p>
<img class="screenshot" src="./images/cmake-gui-start.png" alt="Capture d'écran de l'outil cmake-gui" title="Capture d'écran de l'outil cmake-gui" />
<p>
    Voici les toutes premières étapes à effectuer :
</p>
<ol>
    <li>Indiquez à CMake où se trouve le code source de SFML (ce doit être la racine de la hiérarchie SFML, là où se trouve le premier fichier CMakeLists.txt).</li>
    <li>Choisissez où vous voulez générer les projets/makefiles (si le répertoire n'existe pas, CMake le créera).</li>
    <li>Cliquez sur le bouton "Configure".</li>
</ol>
<p>
    Si c'est la première fois que vous générez le projet (ou si vous avez effacé le cache de CMake), cmake-gui vous demandera de choisir le générateur.
    En d'autres termes, c'est là que vous sélectionnez votre compilateur/EDI.
</p>
<img class="screenshot" src="./images/cmake-choose-generator.png" alt="Capture d'écran de la boîte de dialogue de sélection du générateur" title="Capture d'écran de la boîte de dialogue de sélection du générateur" />
<p>
    Par exemple, pour générer une solution Visual Studio 10, vous devez choisir "Visual Studio 10". Pour générer des makefiles utilisables avec Visual
    C++, sélectionnez "NMake Makefiles". Pour créer des makefiles utilisables avec MinGW (GCC), sélectionnez "MinGW Makefiles". Il est généralement
    plus pratique de générer des makefiles plutôt que des projets pour EDI : vous pouvez compiler avec une simple commande, ou même rassembler plusieurs
    compilations dans un simple script. Etant donné que vous ne ferez que compiler et non éditer les sources, les projets pour EDI sont généralement
    inutiles.<br>
</p>
<p class="important">
    Le processus d'installation (décrit plus loin dans ce document) peut ne pas fonctionner avec Xcode ;
    c'est pourquoi il est fortement recommendé d'utiliser le générateur de <em>Makefile</em> sur macOS.
</p>
<p>
    Gardez toujours l'option "Use default native compilers", vous n'avez pas à vous préoccuper des trois autres.
</p>
<p>
    Après avoir sélectionné le générateur, CMake va lancer tout un tas de tests pour vérifier diverses informations à propos de votre
    environnement de compilation : le chemin du compilateur, les en-têtes standards, les dépendances de SFML, etc. Si tout se passe bien, il devrait
    terminer avec le message "Configuring done". Si quelque chose s'est mal passé, lisez attentivement le(s) message(s) d'erreur. Peut-être que
    votre compilateur n'était pas accessible (voir ci-dessus), ou peut-être une dépendance était-elle manquante.
</p>
<img class="screenshot" src="./images/cmake-configure.png" alt="Capture d'écran de la fenêtre de cmake-gui après la configuration" title="Capture d'écran de la fenêtre de cmake-gui après la configuration" />
<p>
    Après que CMake ai terminé la configuration, des options apparaissent dans la partie centrale de la fenêtre. CMake possède beaucoup d'options, mais
    la plupart ont la bonne valeur par défaut. Beaucoup d'options ne sont même pas faites pour être éditées, elles sont simplement là pour vous montrer
    ce que CMake a trouvé tout seul.<br />
    Voici la liste des quelques options vraiment importantes pour configurer votre compilation de SFML :
</p>
<table class="styled">
    <thead>
        <tr>
            <th>Variable</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>CMAKE_BUILD_TYPE</code></td>
            <td>
                Cette option définit le type de compilation. Les valeurs disponibles sont "Debug" et "Release" (il existe d'autres types tels que
                "RelWithDebInfo" ou "MinSizeRel", mais celles-ci ne sont pas vraiment prises en compte par SFML). Notez que si vous générez un projet pour
                un EDI qui supporte les configurations multiples, comme par exemple Visual Studio, cette option est ignorée et vous aurez automatiquement
                toutes les configurations disponibles dans votre projet.
            </td>
        </tr>
        <tr class="two">
            <td><code>CMAKE_INSTALL_PREFIX</code></td>
            <td>
                Cette option définit le chemin d'installation pour les fichiers compilés. Par défaut, il s'agit du chemin le plus naturel pour l'OS ciblé
                ("/usr/local" pour Linux et macOS, "C:\Program Files" pour Windows, etc.). Le fait d'installer les fichiers après les avoir compilé n'est pas obligatoire,
                vous pouvez utiliser les bibliothèques SFML directement à partir de là où elles sont compilées, mais il est tout de même préférable de les installer
                proprement afin de ne pas se trimballer tous les fichiers temporaires produits par la compilation.
            </td>
        </tr>
        <tr class="one">
            <td><code>CMAKE_INSTALL_FRAMEWORK_PREFIX<br/>(macOS uniquement)</code></td>
            <td>
                Cette option définit le chemin d'installation des frameworks. Par défaut, il s'agit de la bibliothèque
                racine, i.e. le dossier /Library/Frameworks. Comme mentionné pour CMAKE_INSTALL_PREFIX, il n'est pas
                obligatoire d'installer les fichiers après les avoir compilé, cependant il reste plus propre de le faire.<br>
                Ce chemin est utilisé pour installer sndfile.framework sur votre système (une dépendance non fournie par
                Apple) ansi que SFML en tant que frameworks si l'option BUILD_FRAMEWORKS est activée.
            </td>
        </tr>
        <tr class="two">
            <td><code>BUILD_SHARED_LIBS</code></td>
            <td>
                Cette option booléenne détermine si les bibliothèques SFML sont compilées en version dynamique (<em>shared</em>), ou statique. <br/>
                Cette option n'est pas compatible avec SFML_USE_STATIC_STD_LIBS, elles sont mutuellement exclusives.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_FRAMEWORKS<br/>(macOS uniquement)</code></td>
            <td>
                Cette option booléenne détermine si vous voulez compiler la SFML en tant que
                <a class="external" title="documentation d'Apple sur les frameworks" href="http://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html">frameworks bundle</a>
                ou en tant que
                <a class="external" title="documentation d'Apple sur les bibliothèques dynamiques" href="http://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/000-Introduction/Introduction.html">binaires dylib</a>.
                Produire des frameworks nécessite que l'option BUILD_SHARED_LIBS soit activée.<br/>
                Il est recommandé d'utiliser SFML en tant que frameworks quand vous distribuez votre application au
                public. Par contre, SFML ne peut pas être construite en tant que framework en type "Debug" ; à la place
                utilisez les dylibs.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_BUILD_EXAMPLES</code></td>
            <td>
                Cette option booléenne détermine si vous voulez compiler les exemples SFML ou non.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_DOC</code></td>
            <td>
                Cette option booléenne détermine si vous voulez générer la documentation de SFML ou non. Notez que l'outil
                <a class="external" title="go to doxygen website" href="http://www.doxygen.org">doxygen</a> doit être installé et accessible, sinon
                le fait d'activer cette option produira une erreur.<br/>
                Sur macOS, vous pouvez installer l'exécutable Unix-classique dans /usr/bin ou n'importe quel dossier
                similaire, ou installer Doxygen.app dans n'importe quel dossier "Applications", par exemple ~/Applications.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_AUDIO</code></td>
            <td>
                Cette option booléenne détermine si le module sfml-audio est compilé ou non.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_BUILD_GRAPHICS</code></td>
            <td>
                Cette option booléenne détermine si le module sfml-graphics est compilé ou non.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_WINDOW</code></td>
            <td>
                Cette option booléenne détermine si le module sfml-window est compilé ou non.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_BUILD_NETWORK</code></td>
            <td>
                Cette option booléenne détermine si le module sfml-network est compilé ou non.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_USE_SYSTEM_DEPS</code></td>
            <td>
                Cette option booléenne détermine si ce sont les dépendances du répertoire "extlibs" qui sont utilisées, ou les dépendances trouvées sur le système.<br/>
                Les en-têtes stb_image_* du répertoire "extlibs" sont toujours utilisés indépendamment de cette option.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_USE_STATIC_STD_LIBS<br/>(Windows uniquement)</code></td>
            <td>
                Cette option booléenne choisit la version des bibliothèques C/C++ standard auxquelles SFML est liée. <br/>
                TRUE lie les bibliothèques standard statiquement, ce qui signifie que SFML est <em>self-contained</em> et ne dépend
                pas des DLLs spécifiques au compilateur. <br/>
                FALSE (la valeur par défaut) lie les bibliothèques standard dynamiquement, ce qui signifie que SFML dépend des DLLs du compilateur
                (msvcrxx.dll/msvcpxx.dll pour Visual C++, libgcc_s_xxx-1.dll/libstdc++-6.dll pour GCC). Soyez attentif à ce paramètre, s'il ne colle pas aux
                paramètres de vos projets utilisant SFML, vous pourriez faire face à des crashs dans certains cas. <br/>
                Cette option n'est pas compatible avec BUILD_SHARED_LIBS, elles sont mutuellement exclusives.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_GENERATE_PDB<br/>(Visual Studio only)</code></td>
            <td>
                Cette option booléenne détermine si Visual Studio doit ou non générer les fichiers PDB, qui sont des fichiers distincts des bibliothèques SFML,
                et qui contiennent les symboles de debug requis lorsque vous voulez debugger SFML.
            </td>
        </tr>
        <tr class="two">
            <td><code>CMAKE_OSX_ARCHITECTURES<br/>(macOS uniquement)</code></td>
            <td>
                Ce paramètre définit pour quelles architectures SFML doit être compilée.
                La valeur recommandée est "x86_64" parce que la compilation en 32-bit n'est plus supportée.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_INSTALL_XCODE_TEMPLATES<br/>(macOS uniquement)</code></td>
            <td>
                Cette option booléenne détermine si CMake va installer les templates pour Xcode sur votre système ou non.
                Vérifiez que /Library/Developer/Xcode/Templates/SFML existe et soit accessible à l'écriture.
                De plus amples informations sur ces templates sont données dans le tutoriel "Démarrer sur macOS".
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_INSTALL_PKGCONFIG_FILES<br/>(bibliothèques partagées Linux uniquement)</code></td>
            <td>
                Cette option booléenne détermine si CMake va installer les fichiers pkg-config sur votre système ou non.
                pkg-config est un outil qui fournit une interface unifiée pour interroger les bibliothèques installées.
            </td>
        </tr>
    </tbody>
</table>
<p>
    Après avoir fait un tour dans les options, cliquez sur le bouton "Configure" une fois de plus : le fond des options devrait passer de rouge
    à blanc, et le bouton "Generate" devrait devenir accessible. Cliquez sur ce dernier pour enfin créer les makefiles/projets.
</p>
<img class="screenshot" src="./images/cmake-generate.png" alt="Capture d'écran de la fenêtre de cmake-gui après la génération" title="Capture d'écran de la fenêtre de cmake-gui après la génération" />
<p>
    CMake crée un cache pour chaque projet. Ainsi, si vous décidez de revenir plus tard, vous retrouverez vos options telles que vous les aviez
    laissées et vous pourrez les modifier, puis reconfigurer et mettre à jour les makefiles/projets SFML.
</p>

<h3>C++11 et macOS</h3>
<p>
    Si vous voulez utiliser les fonctionnalités de C++11 dans votre application, vous devez utiliser clang (le compilateur officiel d'Apple) avec libc++. De plus, vous devez
    compiler SFML avec ces outils pour éviter tout problème d'incompatilité entre bibliothèques standards et compilateurs.
</p>
<p>
    Voici les paramètres à utiliser pour compiler SFML avec clang et libc++ :
</p>
<ul>
    <li>Choisissez "<em>Specify native compilers</em>" au lieu de "<em>Use default native compilers</em>" lorsque vous sélectionnez le générateur</li>
    <li><code>CMAKE_CXX_COMPILER</code> configuré à /usr/bin/clang++ (voir capture d'écran)</li>
    <li><code>CMAKE_C_COMPILER</code> configuré à /usr/bin/clang (voir capture d'écran)</li>
    <li><code>CMAKE_CXX_FLAGS</code> et <code>CMAKE_C_FLAGS</code> configurés à "-stdlib=libc++"</li>
</ul>
<img class="screenshot" src="./images/cmake-osx-compilers.png" alt="Capture d'écran de la configuration des compilateurs sous OS X" title="Capture d'écran de la configuration des compilateurs sous OS X" />

<?php h2('Compiler SFML') ?>
<p>
    Commençons cette nouvelle section avec une bonne nouvelle : vous n'aurez plus à exécuter l'étape de configuration décrite ci-dessus, même si
    vous mettez à jour les sources de SFML. CMake est futé, il ajoute aux makefiles/projets générés une étape personnalisée, qui regénère
    automatiquement tous les fichiers nécessaires à chaque fois que quelque chose a changé.
</p>
<p>
    Vous êtes maintenant prêts à compiler SFML. Bien entendu, la manière de faire dépend des makefiles/projets que vous avez choisi de générer. Si vous
    avez créé un projet/solution/workspace, ouvrez-le avec votre EDI et compilez le comme n'importe quel autre projet. Je n'entrerai pas dans le détail
    ici, il existe bien trop d'EDIs différents et je suppose que vous connaissez le vôtre suffisamment pour exécuter cette simple tâche.
</p>
<p>
    Si vous avez généré un makefile, ouvrez une invite de commande et exécutez la commande "make" correspondant à votre environnement. Par exemple,
    lancez "nmake" si vous avez généré un makefile NMake (Visual C++), "mingw32-make" si vous avez généré un makefile MinGW (GCC), ou simplement
    "make" si vous avez généré un makefile Linux.<br />
    Note : sous Windows, le programme de "make" (nmake ou mingw32-make) peut ne pas être accessible. Si c'est le cas, n'oubliez pas d'ajouter son
    chemin à la variable d'environnement PATH ; voir les explications au début de la section "Configurer la compilation de SFML" pour plus de détails.
</p>
<p>
    Par défaut, tout sera compilé (les bibliothèques SFML, ainsi que les exemples si vous avez activé l'option SFML_BUILD_EXAMPLES). Si vous voulez compiler
    uniquement une seule bibliothèque SFML, ou un exemple particulier, vous pouvez choisir une cible différente. Vous pouvez aussi choisir de nettoyer
    ou d'installer les fichiers compilés, avec les cibles adéquates.<br />
    Voici toutes les cibles disponibles, selon les options de configuration que vous avez choisies :
</p>
<table class="styled">
    <thead>
        <tr>
            <th>Cible</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr class="one">
            <td><code>all</code></td>
            <td>
                C'est la cible par défaut, elle est utilisée si aucune cible n'est explicitement spécifiée. Elle construit toutes les cibles qui produisent
                des fichiers binaires (les bibliothèques SFML et les exemples).
            </td>
        </tr>
        <tr class="two">
            <td><code>sfml-system<br/>sfml-window<br/>sfml-network<br/>sfml-graphics<br/>sfml-audio<br/>sfml-main</code></td>
            <td>
                Construit la bibliothèque SFML correspondante. La cible "sfml-main" n'est disponible que sous Windows.
            </td>
        </tr>
        <tr class="one">
            <td><code>cocoa<br/>ftp<br/>opengl<br/>pong<br/>shader<br/>sockets<br/>sound<br/>sound-capture<br/>voip<br/>window<br/>win32<br/>X11</code></td>
            <td>
                Construit l'exemple SFML correspondant. Ces cibles ne sont disponibles que si l'option <code>SFML_BUILD_EXAMPLES</code> a été activée. Notez que certains
                exemples ne sont définis que pour un OS particulier ("cocoa" n'est disponible que sous macOS, "win32" sous Windows, "X11" sous Linux, etc.).
            </td>
        </tr>
        <tr class="two">
            <td><code>doc</code></td>
            <td>
                Génère la documentation de l'API. Cette cible n'est disponible que si l'option <code>SFML_BUILD_DOC</code> a été activée.
            </td>
        </tr>
        <tr class="one">
            <td><code>clean</code></td>
            <td>
                Supprime tous les fichiers objets produits par la compilation précédente. Vous n'avez généralement pas besoin d'invoquer cette cible,
                excepté lorsque vous souhaitez recompiler SFML entièrement (certaines mises à jour du code interagissent mal avec les fichiers objets
                déjà compilés, et tout supprimer est alors la seule solution).
            </td>
        </tr>
        <tr class="two">
            <td><code>install</code></td>
            <td>
                Installe SFML dans le chemin défini par les options <code>CMAKE_INSTALL_PREFIX</code> et <code>CMAKE_INSTALL_FRAMEWORK_PREFIX</code>. Cela va copier
                les bibliothèques et en-têtes SFML, ainsi que les exemples et la documentation si les options <code>SFML_BUILD_EXAMPLES</code> et <code>SFML_BUILD_DOC</code>
                ont été activées. Après installation, vous obtenez une distribution propre de SFML, tout comme si vous aviez téléchargé un SDK officiel, ou installé SFML
                depuis les dépôts système.
            </td>
        </tr>
    </tbody>
</table>
<p>
    Si vous utilisez un EDI, une cible est simplement un projet. Pour construire une cible, sélectionnez le projet correspondant et compilez le
    (même les cibles "clean" et "install" doivent être compilées afin d'être exécutées -- ne soyez pas surpris par le fait qu'il n'y a en fait aucun
    code source à compiler).<br />
    Si vous utilisez un makefile, passez le nom de la cible à la commande de "make" afin de construire cette cible. Exemples :
    "<code>nmake doc</code>", "<code>mingw32-make install</code>", "<code>make sfml-network</code>".
</p>
<p>
    Maintenant vous devriez avoir compilé SFML avec succès. Félicitations !
</p>

<?php

    require("footer-fr.php");

?>
