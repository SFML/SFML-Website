<?php

    $title = "Ouvrir et g�rer une fen�tre SFML";
    $page = "window-window-fr.php";

    require("header-fr.php");

?>

<h1>Ouvrir et g�rer une fen�tre SFML</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel explique uniquement comment ouvrir et g�rer une fen�tre avec SFML. Dessiner des choses sort d�j� du cadre du module sfml-window : c'est
    en effet g�r� par le module sfml-graphics. Cependant, la gestion de la fen�tre reste exactement la m�me, la lecture de ce tutoriel est donc
    indispensable dans tous les cas.
</p>

<?php h2('Ouvrir une fen�tre') ?>
<p>
    Les fen�tre SFML sont d�finies par la classe <?php class_link("Window") ?>. Une fen�tre peut �tre cr��e et ouverte directement d�s sa construction :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>
<p>
    Le premier param�tre, le <em>mode vid�o</em>, d�finit la taille de la fen�tre (la taille interne, sans la barre de titre ni les bordures). Ici,
    nous cr�ons une fen�tre de 800x600 pixels.<br />
    La classe <?php class_link("VideoMode") ?> a quelques fonctions statiques int�ressantes pour r�cup�rer la r�solution du bureau, ou encore la liste
    des modes vid�o valides pour le mode plein �cran. N'h�sitez pas � consulter la documentation pour voir tout ce que vous pouvez en tirer.
</p>
<p>
    Le deuxi�me param�tre est simplement le titre de la fen�tre.
</p>
<p>
    Ce constructeur accepte un troisi�me param�tre optionnel : un style, qui permet de choisir quelles d�corations et fonctionnalit�s vous voulez
    sur la fen�tre. Vous pouvez utiliser des combinaisons des styles suivants :
</p>
<table class="styled">
    <tbody>
        <tr>
            <td><code>sf::Style::None</code></td>
            <td>Aucune d�coration (utile pour les <em>splash screens</em>, par exemple) ; ce style ne peut pas �tre combin� avec les autres</td>
        </tr>
        <tr>
            <td><code>sf::Style::Titlebar</code></td>
            <td>La fen�tre poss�de une barre de titre</td>
        </tr>
        <tr>
            <td><code>sf::Style::Resize</code></td>
            <td>La fen�tre peut �tre redimensionn�e et poss�de un bouton de maximisation</td>
        </tr>
        <tr>
            <td><code>sf::Style::Close</code></td>
            <td>La fen�tre poss�de une bouton de fermeture</td>
        </tr>
        <tr>
            <td><code>sf::Style::Fullscreen</code></td>
            <td>La fen�tre est cr��e en mode plein �cran; ce style ne peut pas �tre combin� avec les autres, et requiert un mode vid�o valide</td>
        </tr>
        <tr>
            <td><code>sf::Style::Default</code></td>
            <td>Le style par d�faut, qui est un raccourci pour <code>Titlebar | Resize | Close</code></td>
        </tr>
    </tbody>
</table>
<p>
    Il existe �galement un quatri�me param�tre optionnel, qui d�finit des options sp�cifiques � OpenGL ; cet aspect est d�taill� dans le
    <a class="internal" href="./window-opengl-fr.php" title="Tutoriel OpenGL">tutoriel d�di�</a>.
</p>
<p>
    Si vous voulez cr�er la fen�tre <em>apr�s</em> la construction de l'instance de <?php class_link("Window") ?>, ou bien la re-cr�er avec des
    param�tres diff�rents, vous pouvez plut�t utiliser la fonction <code>create</code> ; elle prend exactement les m�mes param�tres que le constructeur.
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window;
    window.create(sf::VideoMode(800, 600), "My window");

    ...

    return 0;
}
</code></pre>

<?php h2('Rendre la fen�tre un peu plus vivante') ?>
<p>
    Si vous essayez d'ex�cuter le code ci-dessus avec rien � la place des "...", vous ne verrez pas grand chose se passer. Tout d'abord parce que le
    programme se termine instantan�ment. Ensuite, parce qu'il n'y a aucune gestion d'�v�nement -- donc m�me si vous ajoutiez une boucle infinie dans
    ce code, vous verriez une fen�tre "gel�e", incapable d'�tre d�plac�e, redimensionn�e, ou bien encore ferm�e.
</p>
<p>
    Ajoutons donc un peu de code pour rendre ce programme plus int�ressant :
</p>
<pre><code class="cpp">#include &lt;SFML/Window.hpp&gt;

int main()
{
    sf::Window window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme jusqu'� ce que la fen�tre soit ferm�e
    while (window.isOpen())
    {
        // on inspecte tous les �v�nements de la fen�tre qui ont �t� �mis depuis la pr�c�dente it�ration
        sf::Event event;
        while (window.pollEvent(event))
        {
            // �v�nement "fermeture demand�e" : on ferme la fen�tre
            if (event.type == sf::Event::Closed)
                window.close();
        }
    }

    return 0;
}
</code></pre>
<p>
    Le code ci-dessus ouvre une fen�tre, et se termine lorsque l'utilisateur la ferme. Voyons comment il fonctionne en d�tail.
</p>
<p>
    Premi�rement, nous avons ajout� une boucle qui nous assure que l'application va �tre rafra�chie/mise � jour jusqu'� ce que la fen�tre soit ferm�e.
    La plupart (sinon tous) les programmes SFML auront ce genre de boucle, souvent appel�e <em>boucle principale</em> ou <em>boucle de jeu</em>.
</p>
<p>
    Ensuite, la premi�re chose que nous faisons dans la boucle principale est de regarder si des �v�nements se sont produits. Notez bien que nous
    utilisons une boucle <code>while</code> de mani�re � inspecter tous les �v�nements, au cas o� il y en aurait plusieurs en attente d'�tre trait�s.
    La fonction <code>pollEvent</code> renvoie <code>true</code> si un �v�nement �tait en attente, ou <code>false</code> s'il n'y en avait aucun.
</p>
<p>
    A chaque fois que nous avons un �v�nement, nous devons v�rifier son type (fen�tre ferm�e ? une touche appuy�e ? le curseur a boug� ? un joystick est
    connect� ? ...), et r�agir en cons�quence si ce type d'�v�nement nous int�resse. Dans cet exemple, nous ne nous int�ressons qu'� l'�v�nement
    <code>Event::Closed</code>, qui est �mis lorsque l'utilisateur souhaite fermer la fen�tre. A ce moment, la fen�tre est toujours ouverte et nous
    devons la fermer explicitement avec la fonction <code>close</code>. Cela permet de faire autre chose avant que la fen�tre ne soit r�ellement ferm�e,
    comme par exemple sauvegarder l'�tat de l'application, ou afficher un message.
</p>
<p class="important">
    Une erreur que les gens font souvent est d'oublier de mettre une boucle d'�v�nements, car ils n'en ont pas besoin (ils utilisent les entr�es
    temps r�el � la place, typiquement). Mais sans gestion d'�v�nement la fen�tre ne sera pas r�active ; en effet, la boucle d'�v�nement a deux r�les :
    en plus de fournir les �v�nements � l'utilisateur, elle permet � la fen�tre de traiter ses �v�nements internes, ce qui est imp�ratif a son
    bon fonctionnement.
</p>
<p>
    Apr�s que la fen�tre a �t� ferm�e, la boucle principale s'arr�te et le programme se termine.
</p>
<p>
    Vous avez probablement remarqu� que nous n'avons pas encore parl� de <em>dessiner quelque chose</em> dans cette fen�tre. Comme indiqu� dans
    l'introduction, ce n'est pas le boulot du module sfml-window, et vous devrez aller voir directement les tutoriels du module sfml-graphics
    si vous voulez dessiner des choses int�ressantes telles que des sprites, du texte ou des formes.
</p>
<p>
    Pour dessiner, vous pouvez aussi utiliser OpenGL directement et compl�tement ignorer le module sfml-graphics. <?php class_link("Window") ?>
    cr�e en interne un contexte OpenGL, de sorte qu'elle est naturellement pr�te � recevoir vos propres appels OpenGL. Vous pourrez en savoir plus
    � ce sujet dans le <a class="internal" href="./window-opengl-fr.php" title="Tutoriel OpenGL">tutoriel correspondant</a>.
</p>
<p>
    Bref, ne vous attendez pas � voir quelque chose d'int�ressant dans cette fen�tre : vous verrez tr�s certainement une couleur uniforme (noir ou blanc),
    ou bien le dernier contenu du programme OpenGL ex�cut� pr�c�demment, ou... n'importe quoi d'autre.
</p>

<?php h2('Jouer avec la fen�tre') ?>
<p>
    Evidemment, SFML vous permet de jouer un peu avec vos fen�tres. Les op�rations basiques de fen�trage, telles que changer la taille, la position,
    le titre ou l'ic�ne sont support�es, mais contrairement � d'autres biblioth�ques plus sp�cialis�es dans les interfaces graphiques (Qt, wxWidgets),
    SFML ne fournit pas de fonctionnalit�s avanc�es. Les fen�tres SFML ne sont qu'un support pour du dessin OpenGL ou SFML. L'accent est mis sur les
    fonctionnalit�s importantes ainsi que la simplicit� d'utilisation.
</p>
<pre><code class="cpp">// changement de la position de la fen�tre (relativement au bureau)
window.setPosition(sf::Vector2i(10, 50));

// changement de la taille de la fen�tre
window.setSize(sf::Vector2u(640, 480));

// changement du titre de la fen�tre
window.setTitle("SFML window");

// r�cup�ration de la taille de la fen�tre
sf::Vector2u size = window.getSize();
unsigned int width = size.x;
unsigned int height = size.y;

...
</code></pre>
<p>
    Vous pouvez consulter la documentation de l'API pour une liste compl�te des fonctions de <?php class_link("Window") ?>.
</p>
<p>
    Si vous avez r�ellement besoin de fonctionnalit�s plus avanc�es pour votre fen�tre, vous pouvez la cr�er (ou m�me une GUI compl�te) avec une autre
    biblioth�que, et int�grer SFML dedans. Pour ce faire, vous pouvez utiliser l'autre constructeur, ou fonction <code>create</code>, de
    <?php class_link("Window") ?> qui prend en param�tre le handle natif (sp�cifique � l'OS) d'une fen�tre existante. Dans ce cas, SFML cr�e un
    contexte OpenGL dans la fen�tre et r�cup�re tous ses �v�nements, sans perturber sa gestion initiale.
</p>
<pre><code class="cpp">sf::WindowHandle handle = /* specifique � ce que vous faites et � la biblioth�que que vous utilisez */;
sf::Window window(handle);
</code></pre>
<p>
    Si vous voulez juste une fonctionnalit� suppl�mentaire bien sp�cifique, vous pouvez aussi faire l'inverse : cr�er une fen�tre SFML normale, et
    r�cup�rer son handle natif afin d'impl�menter les fonctions que SFML ne supporte pas.
</p>
<pre><code class="cpp">sf::Window window(sf::VideoMode(800, 600), "SFML window");
sf::WindowHandle handle = window.getSystemHandle();

// vous pouvez maintenant utiliser 'handle' avec les fonctions sp�cifiques � l'OS
</code></pre>
<p>
    L'int�gration de SFML avec d'autres biblioth�ques de GUI requiert un peu de travail et ne sera donc pas d�taill�e ici, mais vous pouvez vous
    r�f�rer aux tutoriels correspondant, aux exemples ou aux messages sur le forum.
</p>

<?php h2('Contr�ler le framerate') ?>
<p>
    Parfois, lorsque votre application tourne (trop) vite, cela peut produire des artefacts visuels tels que des d�chirements (<em>tearing</em>).
    La raison est que la fr�quence de rafra�chissement de votre application n'est pas synchronis�e sur la fr�quence verticale de l'�cran, et en
    cons�quence, le bas de la trame pr�c�dente appara�t avec le haut de la nouvelle trame.<br />
    La solution � ce probl�me est d'activer la <em>synchronisation verticale</em>. Elle est g�r�e automatiquement par la carte graphique, et peut
    �tre activ�e ou d�sactiv�e facilement avec la fonction <code>setVerticalSyncEnabled</code> :
</p>
<pre><code class="cpp">window.setVerticalSyncEnabled(true); // un appel suffit, apr�s la cr�ation de la fen�tre
</code></pre>
<p>
    Apr�s cet appel, votre application sera rafra�chie � la m�me fr�quence que l'�cran (donc grosso modo 60 fois par seconde).
</p>
<p class="important">
    Parfois <code>setVerticalSyncEnabled</code> n'a aucun effet : la plupart du temps c'est d� aux options du pilote graphique qui forcent la
    synchronisation verticale � "<em>off</em>". Si cela vous arrive, modifiez cette option � "<em>contr�l� par l'application</em>".
</p>
<p>
    Dans d'autres situations, vous voudrez peut-�tre que votre application tourne � un framerate fix� plut�t qu'� la fr�quence de rafra�chissement
    de l'�cran. Cela peut �tre fait avec la fonction <code>setFramerateLimit</code> :
</p>
<pre><code class="cpp">window.setFramerateLimit(30); // un appel suffit, apr�s la cr�ation de la fen�tre
</code></pre>
<p>
    Contrairement � <code>setVerticalSyncEnabled</code>, cette fonctionnalit� est impl�ment�e par SFML, avec une combinaison de <?php class_link("Clock") ?>
    et de <code>sf::sleep</code>. Une cons�quence importante de cela est qu'elle n'est pas fiable � 100%, en particulier pour des valeurs �lev�es :
    la r�solution de <code>sf::sleep</code> d�pend de l'OS, et peut �tre aussi faible que 10 ou 15 millisecondes. Ne comptez donc pas sur cette fonction
    pour impl�menter des timings ultra-pr�cis.
</p>
<p class="important">
    N'utilisez jamais <code>setVerticalSyncEnabled</code> et <code>setFramerateLimit</code> en m�me temps ! Elles int�ragiraient mal et rendraient les
    choses encore pire.
</p>

<?php h2('Choses � savoir � propos des fen�tres') ?>
<p>
    Voici une rapide liste de choses que pouvez faire ou ne pas faire avec les fen�tres SFML.
</p>

<h3>Vous pouvez cr�er plusieurs fen�tres</h3>
<p>
    SFML permet de cr�er plusieurs fen�tres, et de les g�rer soit toutes dans le thread principal, soit chacune dans son propre thread (mais...
    attention aux autres limitations ci-dessous). Dans ce cas, n'oubliez pas d'adjoindre � chaque fen�tre sa boucle d'�v�nements.
</p>

<h3>Les �crans multiples ne sont pas encore bien support�s</h3>
<p>
    SFML ne g�re pas explicitement les moniteurs multiples. En cons�quence, vous ne pourrez pas choisir sur quel �cran une fen�tre va appara�tre, et
    vous ne pourrez pas non plus cr�er plus d'une fen�tre plein �cran � la fois. Ceci devrait �tre am�lior� dans une version future.
</p>

<h3>Les �v�nements doivent �tre trait�s dans le thread de la fen�tre</h3>
<p>
    C'est une limitation importante de la plupart des OS : la boucle d'�v�nements (plus pr�cis�ment, la fonction <code>pollEvent</code> ou
    <code>waitEvent</code>) doit �tre appel�e dans le thread qui a cr�� la fen�tre. Cela implique que si vous voulez cr�er un thread d�di� � la
    gestion d'�v�nements, vous devrez vous assurer que la fen�tre est cr��e dans ce m�me thread. Si vous voulez vraiment s�parer les choses en
    plusieurs threads, il est plut�t recommend� de garder le fen�trage et les �v�nements dans le thread principal, et de bouger le reste (rendu,
    physique, logique, ...) dans des threads. Cette configuration a aussi l'avantage d'�tre compatible avec la limitation qui suit.
</p>

<h3>Sous OS X, les fen�tres et les �v�nements doivent �tre g�r�s dans le thread principal</h3>
<p>
    Ouaip, c'est exact. Max OS X ne sera pas d'accord si vous essayez de cr�er une fen�tre ou de g�rer ses �v�nements dans un thread autre que le thread
    principal.
</p>

<h3>Sous Windows, une fen�tre plus grande que le bureau ne r�agira pas correctement</h3>
<p>
    Pour une raison inconnue, Windows n'aime pas les fen�tres qui sont plus grandes que le bureau. Cela inclue les fen�tres cr��es avec
    <code>VideoMode::getDesktopMode()</code> : avec les d�corations (bordures et barre de titre) en plus, vous finissez avec une fen�tre qui est tr�s
    l�g�rement plus grande que le bureau.
</p>

<?php

    require("footer-fr.php");

?>
