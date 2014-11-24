<?php

    $title = "SFML et Python";
    $page = "start-python-fr.php";

    require("header-fr.php");
?>

<h1>SFML et Python</h1>

<?php h2('Introduction') ?>
<p>
    Le but de ce tutoriel est de vous expliquer comment compiler / installer / utiliser le binding Python de SFML (qui est
    appel� <strong>PySFML</strong>).
</p>

<?php h2('Installer les binaires PySFML') ?>
<p>
    Afin d'utiliser PySFML, vous devez t�l�charger et installer l'archive contenant les fichiers de d�veloppement
    pour votre OS (SFML-x.x-python-dev-xxx). Celle-ci peut �tre trouv�e sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
    Cette archive contient les binaires de PySFML qui peuvent �tre utilis�s directement. Vous n'avez besoin de rien d'autre
    pour utiliser PySFML.
</p>
<p>
    Apr�s avoir extrait les fichiers de l'archive, copiez les fichiers vers votre installation de Python. Si vous ne savez
    pas o� celle-ci se trouve, cela devrait �tre "C:\Python26" sous Windows ou "/usr/lib/python2.6" sous Linux.
</p>
<p>
    Une fois les fichiers correctement install�s, vous �tes pr�ts � utiliser PySFML.
</p>

<?php h2('Installer le SDK PySFML') ?>
<p>
    Installer le SDK de PySFML est optionnel, tout ce dont vous avez besoin pour faire tourner PySFML sont les fichiers
    de d�veloppement. Cependant, installer le SDK complet est recommand� particuli�rement si vous faites vos premiers
    pas avec PySFML.
</p>
<p>
    Tout d'abord, vous devez t�l�charger l'archive du SDK PySFML (SFML-x.x-python-sdk), qui peut �tre trouv�e sur la
    <a class="internal" href="../../download-fr.php" title="Aller sur la page des t�l�chargements">page des t�l�chargements</a>.
    Cette archive contient le code source, la documentation, les exemples ainsi qu'un fichier de configuration
    pour compiler et installer PySFML.
</p>
<p>
    Vous pouvez ensuite extraire les fichiers du SDK et profiter directement de la documentation et des programmes
    d'exemple.
</p>
<p>
    Si vous souhaitez compiler PySFML � partir du code source, vous devez avoir les en-t�tes et biblioth�ques C++ de SFML
    dans le r�pertoire SFML-x.x (au m�me niveau que le r�pertoire "python"), et entrer la commande suivante :
</p>
<pre><code class="no-highlight">python setup.py build
</code></pre>
<p>
    Sous Windows, cette commande utilise Visual C++ 2003 par d�faut. Il est cependant possible de compiler avec MinGW,
    en ajoutant l'option "-cmingw32" :
</p>
<pre><code class="no-highlight">python setup.py build -cmingw32
</code></pre>
<p>
    Puis vous pouvez installer les fichiers compil�s, avec la commande suivante :
</p>
<pre><code class="no-highlight">python setup.py install
</code></pre>
<p>
    Sous Linux vous devrez avoir les droits root pour installer les fichiers.
</p>
<pre><code class="no-highlight">sudo python setup.py install
</code></pre>

<?php h2('Ecrire son premier programme avec PySFML') ?>
<p>
    Contrairement aux biblioth�ques C++, PySFML rassemble toutes les classes SFML dans un module unique ("sf").
    Comme Python supporte les threads nativement, et qu'il poss�de des propres classes pour le r�seau,
    seules les classes des modules syst�me, fen�trage, graphique et audio sont expos�es dans PySFML.
</p>
<p>
    Voici un morceau de code SFML tr�s simple qui ouvre une fen�tre et y affiche du texte :
</p>

<pre><code class="no-highlight"># On inclus l'extension PySFML
from PySFML import sf

# On cr�e la fen�tre principale
window = sf.RenderWindow(sf.VideoMode(800, 600), "PySFML test")

# On cr�e une cha�ne graphique � afficher
text = sf.String("Hello SFML")

# On d�marre la boucle de jeu
running = True
while running:
    event = sf.Event()
    while window.GetEvent(event):
        if event.Type == sf.Event.Closed:
            running = False

    # On efface l'�cran, on affiche le texte, puis on met � jour la fen�tre
    window.Clear()
    window.Draw(text)
    window.Display()
</code></pre>
<p>
    La documentation pour PySFML est incluse au SDK. Si vous utilisez la version SVN, vous pouvez r�g�n�rer
    une documentation � jour en ex�cutant le script "doc_gen.py". Vous pouvez �galement obtenir la description d�taill�e
    d'une classe en tapant <code>help(sf.la_classe)</code> dans l'interpr�teur. De plus, toutes les classes sont identiques
    � la version C++ et vous pouvez donc tout � fait utiliser la documentation compl�te ainsi que les tutoriels du site.
</p>
<p>
    Le r�pertoire "samples" du SDK contient quelques d�mos utilisant PySFML, vous pouvez les essayer pour vous assurer que
    tout fonctionne correctement apr�s compilation et/ou installation
</p>

<?php

    require("footer-fr.php");

?>
