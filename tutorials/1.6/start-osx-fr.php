<?php

    $title = "SFML et Xcode (Mac OS X)";
    $page = "start-osx-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Xcode (Mac OS X)</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML avec l'EDI Xcode et le compilateur GCC
    (celui par d�faut). Il va vous expliquer comment installer SFML, param�trer votre EDI, et compiler un programme SFML.</br>
    La compilation des biblioth�ques SFML est �galement expliqu�e, pour les utilisateurs plus exp�riment�s.
</p>
<p>
    A noter que la version 32 bits de SFML est pr�vue pour fonctionner sur tout Mac Intel ou PPC utilisant Mac OS X 10.4 ou ult�rieur.
    La version 64 bits fonctionne quant � elle � partir de Mac OS X 10.5.
</p>

<?php h2('Installer SFML') ?>
<p>
    Premi�rement, vous devez t�l�charger les fichiers de d�veloppement SFML. Vous pouvez t�l�charger l'archive minimale
    (biblioth�ques + en-t�tes), mais il est recommand� de t�l�charger le SDK complet, qui contient en plus les
    exemples et la documentation. Si vous utilisez Mac OS X 10.6 ou ult�rieur, pr�f�rez la version 64 bits ; sinon prenez la version
    32 bits.<br/>
    Toutes les archives mentionn�es peuvent �tre trouv�es sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
</p>
<p>
    Une fois que vous avez t�l�charg� et extrait les fichiers sur votre disque dur, copiez le contenu du dossier
    SFML-x.y/lib (ou lib64 dans le cas de la version 64 bits) dans le r�pertoire /Biblioth�que/Frameworks. Rendez-vous ensuite
    dans le dossier SFML-x.y/extlibs/bin. Si vous avez choisi la version 32 bits, copiez les dossiers OpenAL.framework et sndfile.framework
    dans le r�pertoire /Biblioth�que/Frameworks. Dans le cas de la version 64 bits, copiez uniquement le contenu du dossier x86_64.
    L'installation minimale est termin�e.
</p>
<p>
    Cependant, pour vous faciliter la t�che, vous avez � disposition des mod�les de projets (<em>templates</em>)
    pour Xcode. Afin de pouvoir utiliser ces mod�les, copiez les dossiers
    "SFML Window-based Application" et "SFML Graphics-based Application" du dossier SFML-x.y/build/xcode/templates
    dans "/Developer/Library/Xcode/Project Templates/Application", et le dossier "SFML Tool" dans
    "/Developer/Library/Xcode/Project Templates/Command Line Utility".
</p>

<?php h2('Cr�er votre premier programme SFML') ?>
<p>
    Lancez Xcode, et choisissez le menu "File" > "New Project...".
</p>
<p>
    S�lectionnez la sous-partie "Application" dans la colonne de gauche. Voici ce que vous devez observer :
</p>
<img class="screenshot" src="./images/start-osx-new-project.png" width="746" height="522" alt="Capture d'�cran de la bo�te de dialogue de nouveau projet" title="Capture d'�cran de la bo�te de dialogue de nouveau projet" />
<p>
    S�lectionnez l'un des projets SFML et cliquez sur "Choose...". Vous serez invit� � donner un nom � votre projet,
    ce sera aussi le nom de votre programme.
</p>
<p>
    Pour tester le programme, cliquez sur le bouton "Build and Go" de la barre d'outils dans la fen�tre du projet.
    Et voil� votre application cr��e !
</p>
<p>
    Quelques explications par rapport � l'organisation du projet :
</p>
<ul>
    <li>Le dossier de r�f�rence "Sources" contient les fichiers source de votre programme. Vous pouvez ajouter
    les v�tres � cet endroit.</li>
    <li>Le dossier de r�f�rence "Frameworks" contient tous les frameworks utilis�s pour votre projet. Ici vous pouvez
    constater que les modules sfml-system, sfml-window et sfml-graphics ont �t� ajout�s. Le paquet "SFML.framework" est l� uniquement
    pour que vous puissiez acc�der rapidement aux fichiers d'en-t�te de SFML. Il n'est pas utilis� par le programme,
    contrairement aux frameworks sfml-system, sfml-window et sfml-graphics. C'est ici que vous rajouterez les frameworks
    des autres modules SFML dont vous avez besoin. Pour ce faire, glissez simplement le paquet sfml-xxx.framework
    depuis le Finder dans ce dossier de r�f�rence.</li>
</ul>
<p>
    Dans le cas o� vous voudriez cr�er un ex�cutable au lieu d'une application, le mod�le "SFML Tool" est disponible
    dans la partie "Command Line Utility" du panneau de cr�ation d'un nouveau projet. Celui-ci ne contient aucun
    code de base except� la fonction principale, et est li� par d�faut au module sfml-system.
</p>

<?php h2('Distribuer votre application') ?>
<p>
    Afin de faire profiter de vos logiciels � d'autres utilisateurs, vous devez vous assurer que le syst�me d'exploitation
    trouvera les biblioth�ques et/ou frameworks dont d�pend votre programme. Dans cette optique, deux possibilit�s s'offrent
    � vous : soit vous choisissez d'installer les biblioth�ques / frameworks dans les dossiers par d�faut du syst�me,
    soit vous les int�grez � l'int�rieur de l'application.
</p>
<h3>Installer les biblioth�ques / frameworks dans les dossiers par d�faut du syst�me</h3>
<p>
    Cette m�thode pr�sente l'avantage d'�viter les copies multiples des biblioth�ques SFML. En effet, une fois install�e,
    votre biblioth�que peut �tre utilis�e sans probl�me par de multiples applications. De plus, mettre � jour cette unique
    biblioth�que pourra b�n�ficier � toutes les applications qui l'utilisent. En revanche, cela pr�sente �galement deux
    inconv�nients : d'une part la biblioth�que sera s�par�e de son programme, ce qui veut dire une �tape d'installation
    suppl�mentaire afin que votre application soit op�rationnelle ; d'autre part les dossiers de destination ne sont
    accessibles en �criture que par les comptes administrateurs.<br />
    <strong>Mise en oeuvre</strong> : installez les frameworks dont votre application se sert dans le dossier /Biblioth�que/Frameworks,
    et �ventuellement les biblioth�ques dont elle se sert dans le dossier /usr/local/lib. Cette op�ration devra �tre effectu�e
    par chaque utilisateur voulant profiter de votre programme.
</p>
<h3>Int�grer les biblioth�ques / frameworks � votre application</h3>
<p>
    Cette seconde m�thode a pour avantage de simplifier les �tapes d'installation (copier l'application suffit) et
    ne pose plus de probl�me de droits d'utilisateurs. Cependant, chaque application utilisant SFML aura sa propre
    copie des biblioth�ques, une mise � jour de celles-ci devra donc �tre r�percut�e sur chacune de ces applications.
    Ce n'est donc pas la situation la plus adapt�e dans le cas du d�veloppeur.<br />
    <strong>Mise en oeuvre</strong> : avec Xcode, utilisez la
    <em><a class="external" href="http://developer.apple.com/DOCUMENTATION/DeveloperTools/Conceptual/XcodeBuildSystem/200-Build_Phases/bs_build_phases.html#//apple_ref/doc/uid/TP40002690-CJAHHAJI" title="Documentation sur la Copy Files Build Phase">Copy Files Build Phase</a></em>
    en s�lectionnant "Frameworks" comme "Destination" si vous utilisez des frameworks, et "Ex�cutables" si vous utilisez des
    biblioth�ques. Glissez ensuite les fichiers concern�s dans cette phase de cr�ation. Il ne vous reste plus qu'� lancer
    la cr�ation de votre application.
</p>
<p>
    A vous de choisir ce qui vous convient le mieux.
</p>
<p>
    Remarque : aucun des modules de SFML ne n�cessite de biblioth�que qui ne soit d�j� pr�sente par d�faut sur Mac OS X,
    except� le module Audio qui requiert les biblioth�ques OpenAL et libsndfile. Vous devrez donc aussi les fournir avec votre
    application (voir le dossier extlibs/bin de l'image de disque t�l�charg�e). Si vous utilisez la version 64 bits de SFML, vous
    n'avez pas besoin de fournir le framework OpenAL. � noter que vous pouvez constater la pr�sence
    du framework OpenAL dans les dossiers du syst�me, cependant la version pr�sente sur Mac OS X 10.4 pr�sente des
    disfonctionnements, c'est pourquoi une version recompil�e vous est fournie.
</p>

<?php h2('Compiler SFML (pour les utilisateurs avanc�s)') ?>
<p>
    Pour compiler les frameworks SFML et les exemples, vous devez tout d'abord t�l�charger le SDK complet (voir la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>).
</p>
<p>
    Rendez-vous dans le r�pertoire SFML-x.y/build/xcode et ouvrez le projet SFML.xcodeproj (compatible avec Xcode 2.4 et
    ult�rieur). Selon vos besoins, choisissez le style Debug ou Release, puis lancez la compilation. Elle peut durer
    une � plusieurs minutes selon la puissance de l'ordinateur. Vous trouverez tous les frameworks produits dans le
    dossier SFML-x.y/lib (ou SFML-x.y/lib64 si vous avez choisi de compiler SFML pour les processeurs 64 bits � l'aide
    du projet "SFML with Intel 64 bits.xcodeproj").
</p>
<p>
    De m�me si vous souhaitez cr�er des biblioth�ques dynamiques brutes, vous avez � disposition le projet
    SFML-bare.xcodeproj. Effectuez les m�mes actions que pour la compilation des frameworks afin de produire des
    biblioth�ques dynamiques (fichier portant l'extension "dylib") que vous pourrez retrouver dans le m�me dossier
    SFML-x.y/lib.
</p>
<p>
    Pour compiler les exemples, ouvrez le projet SFML-x.y/samples/build/xcode/samples.xcodeproj et lancez la compilation.
    Les programmes cr��s sont plac�s dans le r�pertoire SFML-x.y/samples/bin. � noter que pour lancer les exemples,
    vous devez avoir install� les frameworks comme indiqu� dans ce tutoriel.
</p>

<?php

    require("footer-fr.php");

?>
