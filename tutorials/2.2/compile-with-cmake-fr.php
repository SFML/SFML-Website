<?php

    $title = "Compiler SFML avec CMake";
    $page = "compile-with-cmake-fr.php";

    require("header-fr.php");

?>

<h1>Compiler SFML avec CMake</h1>

<?php h2('Introduction') ?>
<p>
    Bon, d'accord, le titre de ce tutoriel n'est pas compl�tement exact. Vous n'allez <em>pas</em> compiler SFML avec CMake, car CMake n'est <em>pas</em>
    un compilateur. Mais alors CMake, c'est quoi ?
</p>
<p>
    CMake est un meta-syst�me de compilation. Au lieu de construire SFML, il va construire ce qui construit SFML: des solutions Visual Studio,
    des workspaces Code::Blocks, des makefiles Linux, des projets XCode, ... en fait il peut g�n�rer des makefiles et projets pour l'OS et le
    compilateur de votre choix. C'est un outil similaire � autoconf/automake ou premake -- pour ceux qui connaissent.
</p>
<p>
    CMake est largement utilis�, par des projets connus tels que Blender, Boost, KDE ou encore Ogre. Vous pourrez en apprendre plus concernant CMake
    sur son <a class="external" title="site officiel de CMake" href="http://www.cmake.org/">site officiel</a> ou sur la
    <a class="external" title="page wikipedia de CMake" href="http://fr.wikipedia.org/wiki/CMake">page Wikipedia</a>.
</p>
<p>
    Ainsi, comme vous l'aurez probablement compris, ce tutoriel est compos� de deux sections : g�n�rer les projets/makefiles de compilation avec CMake,
    puis compiler SFML avec votre environnement pr�f�r�.
</p>

<?php h2('Installer les dependances') ?>
<p>
    SFML d�pend de quelques autres biblioth�ques, ainsi avant de compiler vous devez avoir install� leurs fichiers de d�veloppement
    (en-t�tes et biblioth�ques).
</p>
<p>
    Sous Windows et Mac OS X, toutes les d�pendances n�cessaires sont fournies directement avec SFML, vous n'avez rien � t�l�charger/installer.
    La compilation fonctionnera directement.
</p>
<p>
    Sous Linux c'est un peu diff�rent, rien n'est fourni et SFML utilise votre propre installation des biblioth�ques desquelles elle d�pend. Voici
    une liste de ce que vous devez installer avant de compiler SFML :
</p>
<ul>
    <li>pthread</li>
    <li>opengl</li>
    <li>xlib</li>
    <li>xrandr</li>
    <li>udev</li>
    <li>freetype</li>
    <li>glew</li>
    <li>jpeg</li>
    <li>sndfile</li>
    <li>openal</li>
</ul>
<p>
    Le nom exact des paquets d�pend de chaque distribution. Et n'oubliez pas d'installer les versions de <em>development</em> de ces paquets.
</p>

<?php h2('Configurer la compilation de SFML') ?>
<p>
    Cette �tape consiste � cr�er les projets/makefiles qui pourront finalement compiler SFML. En gros, cela consiste � choisir <em>quoi</em>
    compiler, <em>comment</em> le compiler et <em>o�</em>. Plus quelques autres options qui vous permettront de cr�er la compilation qui r�pondra
    parfaitement � vos besoins -- nous verrons cela en d�tail plus tard.
</p>
<p>
    La premi�re chose � choisir est l'endroit o� les projets/makefiles et fichiers objets (les fichiers r�sultant de la compilation) seront
    cr��s. Vous pouvez les g�n�rer directement dans l'arborescence source (ie. la racine des r�pertoires SFML), mais cela va polluer votre
    r�pertoire SFML avec pas mal de d�chets : une hi�rarchie compl�te de fichiers de compilation, fichiers objets, etc. La solution la plus propre
    est de g�n�rer les projets/makefiles dans un r�pertoire compl�tement s�par�, de mani�re � garder votre r�pertoire SFML intact. Utiliser des
    r�pertoires s�par�s vous permettra aussi d'avoir plusieurs compilations diff�rentes en m�me temps (statique, dynamique, debug ,release, ...).
</p>
<p>
    Maintenant que vous avez choisi le r�pertoire de compilation, il y a encore une chose � faire avant de pouvoir lancer CMake. Lorsque CMake configure
    votre projet, il teste la disponibilit� et la version du compilateur choisi. Ainsi, l'ex�cutable du compilateur doit �tre accessible quand
    CMake est lanc�. Ce n'est pas un probl�me pour les utilisateurs Linux ou Max OS X, �tant donn� que les compilateurs sont install�s dans des
    chemins standards et tout le temps accessibles, mais sous Windows il se pourrait que vous deviez ajouter le r�pertoire de votre compilateur
    � la variable d'environnement PATH, afin que CMake puisse le trouver automatiquement. Ceci est particuli�rement important lorsque vous avez
    plusieurs compilateurs, ou plusieurs versions du m�me compilateur.
</p>
<p>
    Sous Windows, si vous voulez utiliser GCC (MinGW), vous pouvez ajouter temporairement le r�pertoire MinGW\bin au PATH puis lancer
    CMake � partir de l'invite de commande:
</p>
<pre><code class="no-highlight">&gt; set PATH=%PATH%;votre_repertoire_mingw\bin
&gt; cmake
</code></pre>
<p>
    Avec Visual C++, vous pouvez soit lancer CMake depuis l'"invite de commande de Visual Studio" disponible depuis le menu d�marrer, ou bien appeler
    le fichier vcvars32.bat de votre installation de Visual Studio ; cela aura pour effet de configurer les variables d'environnement (notamment PATH)
    correctement.
</p>
<pre><code class="no-highlight">&gt; votre_repertoire_visual_studio\VC\bin\vcvars32.bat
&gt; cmake
</code></pre>
<p>
    Maintenant vous �tes pr�ts � faire tourner CMake. En fait, il y a trois fa�ons diff�rentes de l'invoquer :
</p>
<ul>
    <li><strong>cmake-gui</strong><br />
        Il s'agit de l'interface graphique, qui vous permet de tout configurer avec des boutons et des champs de saisie ; c'est probablement la
        meilleure solution pour les d�butants et les personnes qui ne veulent pas s'embarasser de la ligne de commande ; c'est aussi tr�s pratique
        pour voir et �diter les options disponibles.
    </li>
    <li><strong>cmake -i</strong><br />
        Il s'agit de la ligne de commande interactive, elle vous invitera � remplir chaque option explicitement ; c'est un bon compromis pour
        d�marrer avec la ligne de commande, �tant donn� que vous ne vous rappellerez certainement pas toutes les options qui sont disponibles,
        ni ne saurez lesquelles sont pertinentes.
    </li>
    <li><strong>cmake</strong><br />
        C'est l'invocation directe, vous devez passer en un coup toutes les options avec leur valeur.
    </li>
</ul>
<p>
    Je focaliserai ce tutoriel sur cmake-gui, �tant donn� que c'est tr�s probablement ce qu'utiliseront les d�butants. Je suppose que les personnes
    qui utilisent la ligne de commande peuvent en apprendre la syntaxe dans le manuel de CMake. A part les captures d'�cran et les directives du
    genre "cliquez ici", les explications ci-dessous sont tout aussi valables pour la ligne de commande (les options sont les m�mes).
</p>
<p>
    Voici � quoi ressemble cmake-gui :
</p>
<img class="screenshot" src="./images/cmake-gui-start.png" alt="Capture d'�cran de l'outil cmake-gui" title="Capture d'�cran de l'outil cmake-gui" />
<p>
    Voici les toutes premi�res �tapes � effectuer :
</p>
<ol>
    <li>Indiquez � CMake o� se trouve le code source de SFML (ce doit �tre la racine de la hi�rarchie SFML, l� o� se trouve le premier fichier CMakeLists.txt).</li>
    <li>Choisissez o� vous voulez g�n�rer les projets/makefiles (si le r�pertoire n'existe pas, CMake le cr�era).</li>
    <li>Cliquez sur le bouton "Configure".</li>
</ol>
<p>
    Si c'est la premi�re fois que vous g�n�rez le projet (ou si vous avez effac� le cache de CMake), cmake-gui vous demandera de choisir le g�n�rateur.
    En d'autres termes, c'est l� que vous s�lectionnez votre compilateur/EDI.
</p>
<img class="screenshot" src="./images/cmake-choose-generator.png" alt="Capture d'�cran de la bo�te de dialogue de s�lection du g�n�rateur" title="Capture d'�cran de la bo�te de dialogue de s�lection du g�n�rateur" />
<p>
    Par exemple, pour g�n�rer une solution Visual Studio 10, vous devez choisir "Visual Studio 10". Pour g�n�rer des makefiles utilisables avec Visual
    C++, s�lectionnez "NMake makefiles". Pour cr�er des makefiles utilisables avec MinGW (GCC), s�lectionnez "MinGW makefiles". Il est g�n�ralement
    plus pratique de g�n�rer des makefiles plut�t que des projets pour EDI : vous pouvez compiler avec une simple commande, ou m�me rassembler plusieurs
    compilations dans un simple script. Etant donn� que vous ne ferez que compiler et non �diter les sources, les projets pour EDI sont g�n�ralement
    inutiles.<br>
    De plus, le processus d'installation (d�crit plus loin dans ce document) peut ne pas fonctionner avec Xcode;
    c'est pourquoi il est fortement recommend� d'utiliser le g�n�rateur de Makefile sur Mac OS X.
</p>
<p>
    Gardez toujours l'option "Use default native compilers", vous n'avez pas � vous pr�occuper des trois autres.
</p>
<p>
    Apr�s avoir s�lectionn� le g�n�rateur, CMake va lancer tout un tas de tests pour v�rifier diverses informations � propos de votre
    environnement de compilation : le chemin du compilateur, les en-t�tes standards, les d�pendances de SFML, etc. Si tout se passe bien, il devrait
    terminer avec le message "Configuring done". Si quelque chose s'est mal pass�, lisez attentivement le(s) message(s) d'erreur. Peut-�tre que
    votre compilateur n'�tait pas accessible (voir ci-dessus), ou peut-�tre une d�pendance �tait-elle manquante.
</p>
<img class="screenshot" src="./images/cmake-configure.png" alt="Capture d'�cran de la fen�tre de cmake-gui apr�s la configuration" title="Capture d'�cran de la fen�tre de cmake-gui apr�s la configuration" />
<p>
    Apr�s que CMake a termin� la configuration, des options apparaissent dans la partie centrale de la fen�tre. CMake poss�de beaucoup d'options, mais
    la plupart ont la bonne valeur par d�faut. Beaucoup d'options ne sont m�me pas faites pour �tre �dit�es, elles sont simplement l� pour vous montrer
    ce que CMake a trouv� tout seul.<br />
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
                Cette option d�finit le type de compilation. Les valeurs disponibles sont "Debug" et "Release" (il existe d'autres types tels que
                "RelWithDebInfo" ou "MinSizeRel", mais celles-ci ne sont pas vraiment prises en compte par SFML). Notez que si vous g�n�rez un projet pour
                un EDI qui supporte les configurations multiples, comme par exemple Visual Studio, cette option est ignor�e et vous aurez automatiquement
                toutes les configurations disponibles dans votre projet.
            </td>
        </tr>
        <tr class="two">
            <td><code>CMAKE_INSTALL_PREFIX</code></td>
            <td>
                Cette option d�finit le chemin d'installation pour les fichiers compil�s. Par d�faut, il s'agit du chemin le plus naturel pour l'OS cibl�
                ("/usr/local" pour Linux et Mac OS X, "C:\Program Files" pour Windows, etc.). Le fait d'installer les fichiers apr�s les avoir compil� n'est pas obligatoire,
                vous pouvez utiliser les biblioth�ques SFML directement � partir de l� o� elles sont compil�es, mais il est tout de m�me pr�f�rable de les installer
                proprement afin de ne pas se trimballer tous les fichiers temporaires produits par la compilation.
            </td>
        </tr>
        <tr class="one">
            <td><code>CMAKE_INSTALL_FRAMEWORK_PREFIX<br/>(Mac OS X uniquement)</code></td>
            <td>
                Cette option d�finit le chemin d'installation des frameworks. Par d�faut, il s'agit de la biblioth�que
                racine, i.e. le dossier /Library/Frameworks. Comme mentionn� pour CMAKE_INSTALL_PREFIX, il n'est pas
                obligatoire d'installer les fichiers apr�s les avoir compil�, cependant il reste plus propre de le faire.<br>
                Ce chemin est utilis� pour installer sndfile.framework sur votre syst�me (une d�pendance non fournie par
                Apple) ansi que SFML en tant que frameworks si l'option BUILD_FRAMEWORKS est activ�e.
            </td>
        </tr>
        <tr class="two">
            <td><code>BUILD_SHARED_LIBS</code></td>
            <td>
                Cette option bool�enne d�termine si les biblioth�ques SFML sont compil�es en version dynamique (<em>shared</em>), ou statique. <br/>
                Cette option n'est pas compatible avec SFML_USE_STATIC_STD_LIBS, elles sont mutuellement exclusives.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_FRAMEWORKS<br/>(Mac OS X uniquement)</code></td>
            <td>
                Cette option bool�enne d�termine si vous voulez compiler la SFML en tant que
                <a class="external" title="documentation d'Apple sur les frameworks" href="http://developer.apple.com/library/mac/#documentation/MacOSX/Conceptual/BPFrameworks/Frameworks.html">frameworks bundle</a>
                ou en tant
                <a class="external" title="documentation d'Apple sur les biblioth�ques dynamiques" href="http://developer.apple.com/library/mac/#documentation/DeveloperTools/Conceptual/DynamicLibraries/000-Introduction/Introduction.html">binaires dylib</a>.
                Produire des frameworks n�cessite que l'option BUILD_SHARED_LIBS soit activ�e.<br/>
                Il est recommand� d'utiliser SFML en tant que frameworks quand vous distribuez votre application au
                public. Par contre, SFML ne peut pas �tre construite en tant que framework en type "Debug"; � la place
                utilisez les dylibs.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_BUILD_EXAMPLES</code></td>
            <td>
                Cette option bool�enne d�termine si vous voulez compiler les exemples SFML ou non.
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_BUILD_DOC</code></td>
            <td>
                Cette option bool�enne d�termine si vous voulez g�n�rer la documentation de SFML ou non. Notez que l'outil
                <a class="external" title="go to doxygen website" href="http://www.doxygen.org">doxygen</a> doit �tre install� et accessible, sinon
                le fait d'activer cette option produira une erreur.<br/>
                Sur Mac OS X, vous pouvez installer l'ex�cutable Unix-classique dans /usr/bin ou n'importe quel dossier
                similaire, ou installer Doxygen.app dans n'importe quel dossier "Applications", par exemple ~/Applications.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_USE_STATIC_STD_LIBS<br/>(Windows uniquement)</code></td>
            <td>
                Cette option bool�enne choisit la version des biblioth�ques C/C++ standard auxquelles SFML est li�e. <br/>
                TRUE lie les biblioth�ques standard statiquement, ce qui signifie que SFML est <em>self-contained</em> et ne d�pend
                pas des DLLs sp�cifiques au compilateur. <br/>
                FALSE (la valeur par d�faut) lie les biblioth�ques standard dynamiquement, ce qui signifie que SFML d�pend des DLLs du compilateur
                (msvcrxx.dll/msvcpxx.dll pour Visual C++, libgcc_s_xxx-1.dll/libstdc++-6.dll pour GCC). Soyez attentif � ce param�tre, s'il ne colle pas aux
                param�tres de vos projets utilisant SFML, vous pourriez faire face � des crashs dans certains cas. <br/>
                Cette option n'est pas compatible avec BUILD_SHARED_LIBS, elles sont mutuellement exclusives.
            </td>
        </tr>
        <tr class="one">
            <td><code>CMAKE_OSX_ARCHITECTURES<br/>(Mac OS X uniquement)</code></td>
            <td>
                Ce param�tre d�finit pour quelles architectures SFML doit �tre compil�e. La valeur recommend�e est "i386;x86_64" afin de g�n�rer des binaires universels
                pour des syst�mes 32 et 64 bits.
            </td>
        </tr>
        <tr class="two">
            <td><code>SFML_INSTALL_XCODE_TEMPLATES<br/>(Mac OS X uniquement)</code></td>
            <td>
                Cette option bool�enne d�termine si CMake va installer les templates pour Xcode sur votre syst�me ou non.
                V�rifiez que /Library/Developer/Xcode/Templates/SFML existe et soit accessible � l'�criture.
                De plus amples informations sur ces templates sont donn�es dans le tutoriel "D�marrer sur Mac OS X".
            </td>
        </tr>
        <tr class="one">
            <td><code>SFML_INSTALL_PKGCONFIG_FILES<br/>(biblioth�ques partag�es Linux uniquement)</code></td>
            <td>
                Cette option bool�enne d�termine si CMake va installer les fichiers pkg-config sur votre syst�me ou non.
                pkg-config est un outil qui fournit une interface unifi�e pour interroger les biblioth�ques install�es.
            </td>
        </tr>
    </tbody>
</table>
<p>
    Apr�s avoir fait un tour dans les options, cliquez sur le bouton "Configure" une fois de plus : le fond des options devrait passer de rouge
    � blanc, et le bouton "Generate" devrait devenir accessible. Cliquez sur ce dernier pour enfin cr�er les makefiles/projets.
</p>
<img class="screenshot" src="./images/cmake-generate.png" alt="Capture d'�cran de la fen�tre de cmake-gui apr�s la g�n�ration" title="Capture d'�cran de la fen�tre de cmake-gui apr�s la g�n�ration" />
<p>
    CMake cr�e un cache pour chaque projet. Ainsi, si vous d�cidez de revenir plus tard, vous retrouverez vos options telles que vous les aviez
    laiss�es et vous pourrez les modifier, puis reconfigurer et mettre � jour les makefiles/projets SFML.
</p>

<h3>C++11 et Mac OS X</h3>
<p>
    Si vous voulez utiliser les fonctionnalit�s de C++11 dans votre application, vous devez utiliser clang (le compilateur officiel d'Apple) avec libc++. De plus, vous devez
    compiler SFML avec ces outils pour �viter tout probl�me d'incompatilit� entre biblioth�ques standards et compilateurs.
</p>
<p>
    Voici les param�tres � utiliser pour compiler SFML avec clang et libc++ :
</p>
<ul>
    <li>Choisissez "<em>Specify native compilers</em>" au lieu de "<em>Use default native compilers</em>" lorsque vous s�lectionnez le g�n�rateur</li>
    <li><code>CMAKE_CXX_COMPILER</code> configur� � /usr/bin/clang++ (voir capture d'�cran)</li>
    <li><code>CMAKE_C_COMPILER</code> configur� � /usr/bin/clang (voir capture d'�cran)</li>
    <li><code>CMAKE_CXX_FLAGS</code> et <code>CMAKE_C_FLAGS</code> configur�s � "-stdlib=libc++"</li>
</ul>
<img class="screenshot" src="./images/cmake-osx-compilers.png" alt="Capture d'�cran de la configuration des compilateurs sous OS X" title="Capture d'�cran de la configuration des compilateurs sous OS X" />

<?php h2('Compiler SFML') ?>
<p>
    Commen�ons cette nouvelle section avec une bonne nouvelle : vous n'aurez plus � ex�cuter l'�tape de configuration d�crite ci-dessus, m�me si
    vous mettez � jour les sources de SFML. CMake est fut�, il ajoute aux makefiles/projets g�n�r�s une �tape personnalis�e, qui r�g�n�re
    automatiquement tous les fichiers n�cessaires � chaque fois que quelque chose a chang�.
</p>
<p>
    Vous �tes maintenant pr�ts � compiler SFML. Bien entendu, la mani�re de faire d�pend des makefiles/projets que vous avez choisi de g�n�rer. Si vous
    avez cr�� un projet/solution/workspace, ouvrez-le avec votre EDI et compilez le comme n'importe quel autre projet. Je n'entrerai pas dans le d�tail
    ici, il existe bien trop d'EDIs diff�rents et je suppose que vous connaissez le v�tre suffisamment pour ex�cuter cette simple t�che.
</p>
<p>
    Si vous avez g�n�r� un makefile, ouvrez une invite de commande et ex�cutez la commande "make" correspondant � votre environnement. Par exemple,
    lancez "nmake" si vous avez g�n�r� un makefile NMake (Visual C++), "mingw32-make" si vous avez g�n�r� un makefile MinGW (GCC), ou simplement
    "make" si vous avez g�n�r� un makefile Linux.<br />
    Note : sous Windows, le programme de "make" (nmake ou mingw32-make) peut ne pas �tre accessible. Si c'est le cas, n'oubliez pas d'ajouter son
    chemin � la variable d'environnement PATH ; voir les explications au d�but de la section "Configurer la compilation de SFML" pour plus de d�tails.
</p>
<p>
    Par d�faut, tout sera compil� (les biblioth�ques SFML, ainsi que les exemples si vous avez activ� l'option SFML_BUILD_EXAMPLES). Si vous voulez compiler
    uniquement une seule biblioth�que SFML, ou un exemple particulier, vous pouvez choisir une cible diff�rente. Vous pouvez aussi choisir de nettoyer
    ou d'installer les fichiers compil�s, avec les cibles ad�quates.<br />
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
                C'est la cible par d�faut, elle est utilis�e si aucune cible n'est explicitement sp�cifi�e. Elle contruit toutes les cibles qui produisent
                des fichiers binaires (les biblioth�ques SFML et les exemples).
            </td>
        </tr>
        <tr class="two">
            <td><code>sfml&#8209;system<br/>sfml&#8209;window<br/>sfml&#8209;network<br/>sfml&#8209;graphics<br/>sfml&#8209;audio<br/>sfml&#8209;main</code></td>
            <td>
                Construit la biblioth�que SFML correspondante. La cible "sfml-main" n'est disponible que sous Windows.
            </td>
        </tr>
        <tr class="one">
            <td><code>cocoa<br/>ftp<br/>opengl<br/>pong<br/>shader<br/>sockets<br/>sound<br/>sound&#8209;capture<br/>voip<br/>window<br/>win32<br/>X11</code></td>
            <td>
                Construit l'exemple SFML correspondant. Ces cibles ne sont disponibles que si l'option <code>SFML_BUILD_EXAMPLES</code> a �t� activ�e. Notez que certains
                exemples ne sont d�finis que pour un OS particulier ("cocoa" n'est disponible que sous Mac OS X, "win32" sous Windows, "X11" sous Linux, etc.).
            </td>
        </tr>
        <tr class="two">
            <td><code>doc</code></td>
            <td>
                G�n�re la documentation de l'API. Cette cible n'est disponible que si l'option <code>SFML_BUILD_DOC</code> a �t� activ�e.
            </td>
        </tr>
        <tr class="one">
            <td><code>clean</code></td>
            <td>
                Supprime tous les fichiers objets produits par la compilation pr�c�dente. Vous n'avez g�n�ralement pas besoin d'invoquer cette cible,
                except� lorsque vous souhaitez recompiler SFML enti�rement (certaines mises � jour du code interagissent mal avec les fichiers objets
                d�j� compil�s, et tout supprimer est alors la seule solution).
            </td>
        </tr>
        <tr class="two">
            <td><code>install</code></td>
            <td>
                Installe SFML dans le chemin d�fini par les options <code>CMAKE_INSTALL_PREFIX</code> et <code>CMAKE_INSTALL_FRAMEWORK_PREFIX</code>. Cela va copier
                les biblioth�ques et en-t�tes SFML, ainsi que les exemples et la documentation si les options <code>SFML_BUILD_EXAMPLES</code> et <code>SFML_BUILD_DOC</code>
                ont �t� activ�es. Apr�s installation, vous obtenez une distribution propre de SFML, tout comme si vous aviez t�l�charg� un SDK officiel, ou install� SFML
                depuis les d�p�ts syst�me.
            </td>
        </tr>
    </tbody>
</table>
<p>
    Si vous utilisez un EDI, une cible est simplement un projet. Pour construire une cible, s�lectionnez le projet correspondant et compilez le
    (m�me les cibles "clean" et "install" doivent �tre compil�es afin d'�tre ex�cut�es -- ne soyez pas surpris par le fait qu'il n'y a en fait aucun
    code source � compiler).<br />
    Si vous utilisez un makefile, passez le nom de la cible � la commande de "make" afin de construire cette cible. Exemples :
    "<code>nmake doc</code>", "<code>mingw32-make install</code>", "<code>make sfml-network</code>".
</p>
<p>
    Maintenant vous devriez avoir compil� SFML avec succ�s. F�licitations !
</p>

<?php

    require("footer-fr.php");

?>
