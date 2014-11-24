<?php

    $title = "Dessiner avec SFML";
    $page = "graphics-draw-fr.php";

    require("header-fr.php");

?>

<h1>Dessiner avec SFML</h1>

<?php h2('Introduction') ?>
<p>
    Comme vous l'avez vu dans les tutoriels pr�c�dents, le module de fen�trage de SFML fournit tout ce qu'il faut pour cr�er une fen�tre OpenGL et g�rer ses
    �v�nements, mais n'est d'aucune aide pour dessiner quoique ce soit. La seule option qu'il vous offre est d'utiliser OpenGL, qui est certes tr�s puissante mais tout
    aussi complexe.
</p>
<p>
    Heureusement, SFML fournit un module graphique avec plein d'entit�s 2D, beaucoup plus simples � manipuler qu'OpenGL.
</p>

<?php h2('La fen�tre de dessin') ?>
<p>
    Afin de dessiner les entit�s fournies par le module graphique, vous devez utiliser une classe de fen�tre sp�cialis�e : <?php class_link("RenderWindow") ?>. Celle-ci
    d�rive de <?php class_link("Window") ?> et h�rite de toutes ses fonctions. Tout ce que vous avez appris � propos de <?php class_link("Window") ?> (cr�ation,
    gestion des �v�nements, contr�le du rafra�chissement, m�lange avec OpenGL, etc.) est toujours valable avec <?php class_link("RenderWindow") ?>.
</p>
<p>
    Par dessus cela, <?php class_link("RenderWindow") ?> ajoute des fonctions de plus haut-niveau pour vous aider � dessiner plus facilement. Ce tutoriel se concentre
    sur deux de ces fonctions : <code>clear</code> et <code>draw</code>. Elles sont aussi simples que leur nom le sugg�re : <code>clear</code> efface la fen�tre toute enti�re
    avec la couleur choisie, et <code>draw</code> y dessine l'objet que vous lui passez en param�tre.
</p>
<p>
    Voici une boucle principale typique avec une fen�tre de dessin :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;

int main()
{
    // cr�ation de la fen�tre
    sf::RenderWindow window(sf::VideoMode(800, 600), "My window");

    // on fait tourner le programme tant que la fen�tre n'a pas �t� ferm�e
    while (window.isOpen())
    {
        // on traite tous les �v�nements de la fen�tre qui ont �t� g�n�r�s depuis la derni�re it�ration de la boucle
        sf::Event event;
        while (window.pollEvent(event))
        {
            // fermeture de la fen�tre lorsque l'utilisateur le souhaite
            if (event.type == sf::Event::Closed)
                window.close();
        }

        // effacement de la fen�tre en noir
        window.clear(sf::Color::Black);

        // c'est ici qu'on dessine tout
        // window.draw(...);

        // fin de la frame courante, affichage de tout ce qu'on a dessin�
        window.display();
    }

    return 0;
}
</code></pre>
<p>
    Appeler <code>clear</code> avant de dessiner quoique ce soit est obligatoire, sinon vous pourriez vous retrouver avec des pixels al�atoires ou bien de la frame pr�c�dente.
    La seule exception est le cas o� vous couvrez la totalit� de la fen�tre avec ce que vous dessinez, de sorte que tous les pixels soient �cras�s ; dans ce cas vous pouvez
    ne pas appeler <code>clear</code> (bien que cela ne fasse pas de grande diff�rence au niveau des performances).
</p>
<p>
    Appeler <code>display</code> est tout aussi obligatoire, cela a pour effet d'afficher dans la fen�tre tout ce qui a �t� dessin� depuis l'appel pr�c�dent �
    <code>display</code>. En effet, les entit�s ne sont pas dessin�es directement dans la fen�tre, mais plut�t dans une surface cach�e. Cette surface est ensuite copi�e
    vers la fen�tre lors de l'appel � <code>display</code> -- c'est ce qu'on appelle le <em>double buffering</em>.
</p>
<p class="important">
    Ce cycle clear/draw/display est la seule bonne mani�re de dessiner. N'essayez pas d'autres strat�gies, telles que garder certains pixels de la frame pr�c�dente,
    "effacer" des pixels, ou bien encore dessiner une seule fois et appeler <code>display</code> plusieurs fois. Vous obtiendrez des r�sultats bizarres � cause du
    <em>double buffering</em>.<br/>
    Les puces et les APIs graphiques modernes sont <em>vraiment</em> faites pour des cycles clear/draw/display r�p�t�s, o� tout est compl�tement
    rafra�chi � chaque it�ration de la boucle de dessin. Ne soyez pas effray�s de dessiner 1000 sprites 60 fois par seconde, vous �tes encore loin des millions de triangles
    que votre machine peut g�rer.
</p>

<?php h2('Qu\'est-ce que je peux dessiner maintenant ?') ?>
<p>
    Maintenant que vous avez une boucle principale qui est pr�te � dessiner, voyons ce que vous pouvez y dessiner, et de quelle mani�re.
</p>
<p>
    SFML fournit quatre types d'entit�s dessinables : trois d'entre elles sont pr�tes � l'emploi (<em>sprites</em>, <em>textes</em> et <em>formes</em>), la derni�re
    est la brique de base qui vous aidera � cr�er vos propres entit�s dessinables (les <em>tableaux de vertex</em>).
</p>
<p>
    Bien que ces entit�s partagent pas mal d'attributs communs, elles ont chacune leurs sp�cificit�s et m�ritent leur propre tutoriel :
</p>
<ul>
    <li><a href="./graphics-sprite-fr.php" title="Apprenez � cr�er et dessiner des sprites">Tutoriel sur les sprites</a></li>
    <li><a href="./graphics-text-fr.php" title="Apprenez � cr�er et dessiner du texte">Tutoriel sur le texte</a></li>
    <li><a href="./graphics-shape-fr.php" title="Apprenez � cr�er et dessiner des formes">Tutoriel sur les formes</a></li>
    <li><a href="./graphics-vertex-array-fr.php" title="Apprenez � cr�er et dessiner des tableaux de vertex">Tutoriel sur les tableaux de vertex</a></li>
</ul>

<?php h2('Dessin hors-�cran') ?>
<p>
    SFML fournit aussi un moyen de dessiner sur une texture plut�t que directement sur la fen�tre. Pour ce faire, il faut utiliser la classe <?php class_link("RenderTexture") ?>
    au lieu de <?php class_link("RenderWindow") ?>. Elle poss�de les m�mes fonctions de dessin, h�rit�es de leur base commune <?php class_link("RenderTarget") ?>.
</p>
<pre><code class="cpp">// on cr�e une texture de dessin de 500x500
sf::RenderTexture renderTexture;
if (!renderTexture.create(500, 500))
{
    // erreur...
}

// pour dessiner, on utilise les m�mes fonctions
renderTexture.clear();
renderTexture.draw(sprite); // ou n'importe quel autre objet dessinable
renderTexture.display();

// on r�cup�re la texture (sur laquelle on vient de dessiner)
const sf::Texture&amp; texture = renderTexture.getTexture();

// on la dessine dans la fen�tre
sf::Sprite sprite(texture);
window.draw(sprite);
</code></pre>
<p>
    La fonction <code>getTexture</code> renvoie une texture en lecture seule, ce qui signifie que vous ne pouvez que l'utiliser, pas la modifier. Si vous avez besoin
    de la manipuler avant de l'utiliser, vous pouvez la copier dans votre propre instance de <?php class_link("Texture") ?>.
</p>
<p>
    <?php class_link("RenderTexture") ?> d�clare les m�mes fonctions que <?php class_link("RenderWindow") ?> pour g�rer les vues et OpenGL (voir les tutoriels correspondant
    pour plus de d�tails). Si vous utilisez OpenGL pour dessiner sur une texture, vous pouvez activer un tampon de profondeur (<em>depth buffer</em>) en utilisant le troisi�me
    param�tre optionnel de la fonction <code>create</code>.
</p>
<pre><code class="cpp">renderTexture.create(500, 500, true); // activation du tampon de profondeur
</code></pre>

<?php h2('Dessiner depuis un thread') ?>
<p>
    SFML supporte le rendu multi-thread�, et vous n'avez m�me pas besoin de faire quoique ce soit pour que cela fonctionne. La seule chose � se rappeler est de d�sactiver
    une fen�tre avant de l'utiliser dans un autre thread ; une fen�tre (plus pr�cis�ment son contexte OpenGL) ne peut en effet pas �tre active dans plusieurs threads en
    m�me temps.
</p>
<pre><code class="cpp">void renderingThread(sf::RenderWindow* window)
{
    // la boucle de rendu
    while (window->isOpen())
    {
        // dessin...

        // fin de la frame
        window->display();
    }
}

int main()
{
    // cr�ation de la fen�tre
    // (rappelez-vous : il est plus prudent de le faire dans le thread principal � cause des limitations de l'OS)
    sf::RenderWindow window(sf::VideoMode(800, 600), "OpenGL");

    // d�sactivation de son contexte OpenGL
    window.setActive(false);

    // lancement du thread de dessin
    sf::Thread thread(&amp;renderingThread, &amp;window);
    thread.launch();

    // la boucle d'�v�nements/logique/ce que vous voulez...
    while (window.isOpen())
    {
        ...
    }

    return 0;
}
</code></pre>
<p>
    Comme vous pouvez le voir, vous n'avez m�me pas besoin d'activer la fen�tre dans le thread de dessin, SFML le fait automatiquement pour vous d�s que n�cessaire.
</p>
<p>
    Souvenez-vous : il faut toujours cr�er la fen�tre et g�rer ses �v�nements dans le thread principal, pour un maximum de portabilit�, comme expliqu� dans le
    <a href="./window-window.php" title="Tutoriel sur les fen�tres">tutoriel sur les fen�tres</a>.
</p>

<?php

    require("footer-fr.php");

?>
