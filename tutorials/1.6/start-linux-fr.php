<?php

    $title = "SFML et gcc (Linux)";
    $page = "start-linux-fr.php";

    require("header-fr.php");
?>

<h1>SFML et gcc (Linux)</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML sous Linux avec le compilateur GCC. Il va vous expliquer
    comment installer SFML, param�trer votre compilateur, et compiler un programme SFML.<br/>
    La compilation des biblioth�ques SFML sera �galement expliqu�e, pour les utilisateurs avanc�s (bien que ce soit relativement simple).
</p>

<?php h2('Installer SFML') ?>
<p>
    Premi�rement, vous devez t�l�charger les fichiers de d�veloppement SFML. Il est recommand� de t�l�charger le SDK
    complet, qui contient le code source et les binaires, ainsi que les exemples et la documentation.<br/>
    Cette archive peut �tre trouv�e sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
</p>
<p>
    Une fois que vous avez t�l�charg� et extrait les fichiers sur votre disque dur, vous devez installer les
    en-t�tes et biblioth�ques SFML � l'endroit appropri�. Pour ce faire, allez dans le r�pertoire SFML-x.y et tapez
    "sudo make install".
</p>

<?php h2('Compiler votre premier programme SFML') ?>
<p>
    Cr�ez un nouveau fichier texte, et �crivez un programme SFML. Par exemple, vous pouvez essayer la classe
    <?php class_link("Clock")?> du module syst�me :
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
    Puis compilez ceci comme n'importe quel programme C++, et liez avec les bibioth�ques SFML que vous utilisez avec la
    directive "-l" :
</p>
<pre><code class="no-highlight">g++ -c clock.cpp
g++ -o clock clock.o -lsfml-system
</code></pre>
<p>
    Lorsque vous liez avec plusieurs biblioth�ques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est
    important pour gcc. La r�gle est la suivante : si la biblioth�que XXX d�pend de (utilise) la biblioth�que YYY,
    sp�cifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics d�pend de sfml-window, qui lui-m�me d�pend
    de sfml-system. La ligne de commande d'�dition de lien serait donc la suivante :
</p>
<pre><code class="no-highlight">g++ -o ... -lsfml-graphics -lsfml-window -lsfml-system
</code></pre>
<p>
    En gros, toute biblioth�que SFML d�pend de sfml-system, et sfml-graphics d�pend en plus de sfml-window. Voil� pour
    ce qui est des d�pendances.
</p>
<p>
    Si vous utilisez les modules Graphics ou Audio, vous devez d'abord installer les biblioth�ques externes
    utilis�es par chaque module.<br/>
    Le module Graphics requiert freetype.<br/>
    Le module Audio requiert libsndfile et openal.<br/>
    Toutes ces bibioth�ques peuvent �tre install�es en utilisant le gestionnaire de paquets standard de votre
    distribution, ou t�l�charg�es depuis leurs sites officiels.<br/>
    Si vous rencontrez des probl�mes avec votre version d'OpenAL (ce qui arrive souvent �tant donn� que l'impl�mentation
    Linux est peu stable), vous pouvez la remplacer par
    <a class="external" href="http://kcat.strangesoft.net/openal.html" title="Site officiel d'OpenAL-Soft">l'impl�mentation OpenAL-Soft</a>.
    Les binaires sont compl�tement compatibles, vous n'aurez donc pas � recompiler SFML ni vos programmes l'utilisant.
</p>

<?php h2('Compiler SFML (pour les utilisateurs avanc�s)') ?>
<p>
    Si les biblioth�ques pr�compil�es de SFML n'existent pas pour votre syst�me, vous pouvez les compiler assez facilement.
    Dans de tels cas, aucun test n'a �t� effectu� et nous vous encourageons donc � rapporter tout �chec ou succ�s rencontr�
    durant le processus de compilation. Si vous r�ussissez � compiler SFML pour une nouvelle plateforme, nous vous invitons
    � contacter l'�quipe de d�veloppement afin que nous puissions partager les fichiers avec la communaut�.
</p>
<p>
    Vous devez tout d'abord installer les paquets de d�veloppement des biblioth�ques externes utilis�es par SFML.
    Voici la liste compl�te :
</p>
<ul>
    <li>build-essential</li>
    <li>mesa-common-dev</li>
    <li>libx11-dev</li>
    <li>libxrandr-dev</li>
    <li>libgl1-mesa-dev</li>
    <li>libglu1-mesa-dev</li>
    <li>libfreetype6-dev</li>
    <li>libopenal-dev</li>
    <li>libsndfile1-dev</li>
</ul>
<p>
    Vous pouvez �galement les obtenir automatiquement si SFML se trouve dans les d�p�ts de paquets de votre distribution,
    avec la commande suivante :
</p>
<pre><code class="no-highlight">apt-get build-dep libsfml
</code></pre>
<p>
    Puis, pour compiler les biblioth�ques et exemples de SFML, vous devez t�l�charger et installer le SDK complet.
    Allez dans le r�pertoire SFML-x.y, et entrez les commandes suivantes :
</p>
<pre><code class="no-highlight">make                # compile les biblioth�ques SFML
sudo make install   # installe les biblioth�ques compil�es
make sfml-samples   # compile les exemples SFML
</code></pre>
<p>
    Note : si Qt et/ou wxWidgets ne sont pas install�s sur votre syst�me, vous obtiendrez certainement des erreurs lors de
    la compilation des exemples correspondant ; ignorez-les simplement.
</p>
<p>
    Les options suivantes sont disponibles pour personnaliser la construction des biblioth�ques :
</p>
<ul>
    <li><strong>DESTDIR=xxx</strong> : installe SFML dans le r�pertoire xxx au lieu de celui par d�faut (qui est /usr/lib)</li>
    <li><strong>DEBUGBUILD=yes/no</strong> : construit les biblioth�ques de d�bogage ou optimis�es ("no" par d�faut - optimis�es)</li>
    <li><strong>STATIC=yes/no</strong> :construit les biblioth�ques statiques ou dynamiques ("no" par d�faut - dynamiques)</li>
</ul>

<?php

    require("footer-fr.php");

?>
