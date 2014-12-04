<?php

    $title = "SFML et gcc (Linux)";
    $page = "start-linux-fr.php";

    require("header-fr.php");
?>

<h1>SFML et gcc (Linux)</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel est le premier que vous devriez lire si vous utilisez SFML sous Linux avec le compilateur GCC. Il va vous expliquer
    comment installer SFML, paramétrer votre compilateur, et compiler un programme SFML.<br/>
    La compilation des bibliothèques SFML sera également expliquée, pour les utilisateurs avancés (bien que ce soit relativement simple).
</p>

<?php h2('Installer SFML') ?>
<p>
    Premièrement, vous devez télécharger les fichiers de développement SFML. Il est recommandé de télécharger le SDK
    complet, qui contient le code source et les binaires, ainsi que les exemples et la documentation.<br/>
    Cette archive peut être trouvée sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des téléchargements">page des téléchargements</a>.
</p>
<p>
    Une fois que vous avez téléchargé et extrait les fichiers sur votre disque dur, vous devez installer les
    en-têtes et bibliothèques SFML à l'endroit approprié. Pour ce faire, allez dans le répertoire SFML-x.y et tapez
    "sudo make install".
</p>

<?php h2('Compiler votre premier programme SFML') ?>
<p>
    Créez un nouveau fichier texte, et écrivez un programme SFML. Par exemple, vous pouvez essayer la classe
    <?php class_link("Clock")?> du module système :
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
    Puis compilez ceci comme n'importe quel programme C++, et liez avec les bibiothèques SFML que vous utilisez avec la
    directive "-l" :
</p>
<pre><code class="no-highlight">g++ -c clock.cpp
g++ -o clock clock.o -lsfml-system
</code></pre>
<p>
    Lorsque vous liez avec plusieurs bibliothèques SFML, assurez-vous de toujours les lier dans le bon ordre, c'est
    important pour gcc. La règle est la suivante : si la bibliothèque XXX dépend de (utilise) la bibliothèque YYY,
    spécifiez XXX en premier puis YYY. Un exemple avec SFML : sfml-graphics dépend de sfml-window, qui lui-même dépend
    de sfml-system. La ligne de commande d'édition de lien serait donc la suivante :
</p>
<pre><code class="no-highlight">g++ -o ... -lsfml-graphics -lsfml-window -lsfml-system
</code></pre>
<p>
    En gros, toute bibliothèque SFML dépend de sfml-system, et sfml-graphics dépend en plus de sfml-window. Voilà pour
    ce qui est des dépendances.
</p>
<p>
    Si vous utilisez les modules Graphics ou Audio, vous devez d'abord installer les bibliothèques externes
    utilisées par chaque module.<br/>
    Le module Graphics requiert freetype.<br/>
    Le module Audio requiert libsndfile et openal.<br/>
    Toutes ces bibiothèques peuvent être installées en utilisant le gestionnaire de paquets standard de votre
    distribution, ou téléchargées depuis leurs sites officiels.<br/>
    Si vous rencontrez des problèmes avec votre version d'OpenAL (ce qui arrive souvent étant donné que l'implémentation
    Linux est peu stable), vous pouvez la remplacer par
    <a class="external" href="http://kcat.strangesoft.net/openal.html" title="Site officiel d'OpenAL-Soft">l'implémentation OpenAL-Soft</a>.
    Les binaires sont complétement compatibles, vous n'aurez donc pas à recompiler SFML ni vos programmes l'utilisant.
</p>

<?php h2('Compiler SFML (pour les utilisateurs avancés)') ?>
<p>
    Si les bibliothèques précompilées de SFML n'existent pas pour votre système, vous pouvez les compiler assez facilement.
    Dans de tels cas, aucun test n'a été effectué et nous vous encourageons donc à rapporter tout échec ou succès rencontré
    durant le processus de compilation. Si vous réussissez à compiler SFML pour une nouvelle plateforme, nous vous invitons
    à contacter l'équipe de développement afin que nous puissions partager les fichiers avec la communauté.
</p>
<p>
    Vous devez tout d'abord installer les paquets de développement des bibliothèques externes utilisées par SFML.
    Voici la liste complète :
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
    Vous pouvez également les obtenir automatiquement si SFML se trouve dans les dépôts de paquets de votre distribution,
    avec la commande suivante :
</p>
<pre><code class="no-highlight">apt-get build-dep libsfml
</code></pre>
<p>
    Puis, pour compiler les bibliothèques et exemples de SFML, vous devez télécharger et installer le SDK complet.
    Allez dans le répertoire SFML-x.y, et entrez les commandes suivantes :
</p>
<pre><code class="no-highlight">make                # compile les bibliothèques SFML
sudo make install   # installe les bibliothèques compilées
make sfml-samples   # compile les exemples SFML
</code></pre>
<p>
    Note : si Qt et/ou wxWidgets ne sont pas installés sur votre système, vous obtiendrez certainement des erreurs lors de
    la compilation des exemples correspondant ; ignorez-les simplement.
</p>
<p>
    Les options suivantes sont disponibles pour personnaliser la construction des bibliothèques :
</p>
<ul>
    <li><strong>DESTDIR=xxx</strong> : installe SFML dans le répertoire xxx au lieu de celui par défaut (qui est /usr/lib)</li>
    <li><strong>DEBUGBUILD=yes/no</strong> : construit les bibliothèques de débogage ou optimisées ("no" par défaut - optimisées)</li>
    <li><strong>STATIC=yes/no</strong> :construit les bibliothèques statiques ou dynamiques ("no" par défaut - dynamiques)</li>
</ul>

<?php

    require("footer-fr.php");

?>
