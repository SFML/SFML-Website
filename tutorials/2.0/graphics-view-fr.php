<?php

    $title = "Contr�ler la cam�ra 2D avec les vues";
    $page = "graphics-view-fr.php";

    require("header-fr.php");

?>

<h1>Contr�ler la cam�ra 2D avec les vues</h1>

<?php h2('Qu\'est-ce qu\'une vue ?') ?>
<p>
    Dans un jeu, il n'est pas rare qu'un niveau soit bien plus grand que la fen�tre, et que tout ce que l'on voit ne soit qu'une petite partie de celui-ci. C'est notamment
    le cas pour les RPGs, les jeux de plateforme, et bien d'autres. Ce que les d�veloppeurs tendent � oublier est qu'ils d�finissent des entit�s dans un
    <em>monde 2D</em>, et non directement dans une fen�tre. La fen�tre n'est qu'une vue, elle montre une zone particuli�re de la sc�ne. Vous pourriez tout aussi bien
    dessiner plusieurs vues du m�me monde 2D en parall�le, ou encore dessiner la sc�ne dans une texture plut�t que dans une fen�tre ; le monde 2D quant � lui est
    toujours le m�me, ce qui change n'est que la mani�re dont il est vu.
</p>
<p>
    Si la fen�tre ne montre qu'une petite partie du monde 2D, il vous faut un moyen de d�finir quelle partie de celui-ci est montr�e dans la fen�tre. Vous pourriez
    �galement vouloir sp�cifier comment/o� cette zone sera affich�e dans la fen�tre. Et bien c'est tr�s exactement � faire ces deux choses que servent les vues SFML.
</p>
<p>
    Pour r�sumer, les vues sont les outils dont vous avez besoin si vous voulez faire d�filer, tourner ou zoomer votre monde. Ils sont aussi l'�l�ment cl� dans la cr�ation
    d'�crans partag�s ou de mini-cartes.
</p>

<?php h2('D�finir ce que voit la vue') ?>
<p>
    La classe qui encapsule les vues SFML est <?php class_link('View') ?>. Une vue peut �tre construite directement avec une d�finition de la zone � visionner :
</p>
<pre><code class="cpp">// cr�ation d'une vue � partir de la zone rectangulaire du monde 2D � voir
sf::View view1(sf::FloatRect(200, 200, 300, 200));

// cr�ation d'une vue � partir de sa position centrale et de sa taille
sf::View view2(sf::Vector2f(350, 300), sf::Vector2f(300, 200));
</code></pre>
<p>
    Ces deux d�finitions sont �quivalentes, elles montrent la m�me zone du monde 2D : un rectangle de 300x200 centr� sur le point (350, 300).
</p>
<img class="screenshot" src="images/graphics-view-initial.png" title="Une vue" />
<p>
    Si vous ne souhaitez pas d�finir la vue d�s sa construction, ou si vous voulez la modifier plus tard, vous pouvez utiliser les fonctions suivantes, qui fonctionnent
    de mani�re �quivalente aux constructeurs :
</p>
<pre><code class="cpp">sf::View view1;
view1.reset(sf::FloatRect(200, 200, 300, 200));

sf::View view2;
view2.setCenter(sf::Vector2f(350, 300));
view2.setSize(sf::Vector2f(200, 200));
</code></pre>
<p>
    Une fois que votre vue est d�finie vous pouvez la transformer, afin de lui faire montrer une version d�cal�e/tourn�e/redimensionn�e de votre monde 2D.
</p>

<h3>D�placer (faire d�filer) la vue</h3>
<p>
    Contrairement aux entit�s dessinables telles que les sprites ou les formes, dont la position est d�finie par leur coin haut-gauche (et peut �tre red�finie � n'importe
    quel autre point), les vues sont toujours manipul�es via leur centre -- c'est plus pratique. C'est pourquoi la fonction qui change la position d'une vue se nomme
    <code>setCenter</code>, et non <code>setPosition</code>.
</p>
<pre><code class="cpp">// d�placement de la vue en (200, 200)
view.setCenter(200, 200);

// d�calage de la vue de (100, 100) (sa position finale est donc (300, 300))
view.move(100, 100);
</code></pre>
<img class="screenshot" src="images/graphics-view-translated.png" title="Une vue d�cal�e" />

<h3>Orienter la vue</h3>
<p>
    Pour tourner une vue, il faut utiliser la fonction <code>setRotation</code>.
</p>
<pre><code class="cpp">// rotation de la vue � 20 degr�s
view.setRotation(20);

// ajout de 5 degr�s � la rotation courante de la vue (son orientation finale est donc de 25 degr�s)
view.rotate(5);
</code></pre>
<img class="screenshot" src="images/graphics-view-rotated.png" title="Une vue orient�e" />

<h3>Zoomer (redimensionner) une vue</h3>
<p>
    Zoomer une vue revient � la redimensionner. La fonction � utiliser est donc <code>setSize</code>.
</p>
<pre><code class="cpp">// redimensionnement de la vue en une zone de 1200x800 (on voit une zone plus grande, c'est donc un zoom arri�re)
view.setSize(1200, 800);

// zoom de la vue relativement � sa taille courante (on applique un facteur 0.5, sa taille finale est donc 600x400)
view.zoom(0.5f);
</code></pre>
<img class="screenshot" src="images/graphics-view-scaled.png" title="Une vue redimensionn�e" />

<?php h2('D�finir comment on voit la vue') ?>
<p>
    Maintenant que vous avez d�fini quelle partie du monde 2D doit �tre vue dans la fen�tre, d�finissons <em>o�</em> celle-ci sera affich�e dans la fen�tre. Par d�faut,
    une vue occupe la totalit� de sa fen�tre. Si la vue a la m�me taille que la fen�tre, tout est donc rendu � l'identique. Mais si la vue est plus petite ou plus grande que
    la fen�tre, alors tout est redimensionn� pour s'adapter � la taille de la fen�tre.
</p>
<p>
    Ce comportement par d�faut convient dans la plupart des situations, mais parfois il faut autre chose. Par exemple, pour partager l'�cran dans un jeu multijoueur, vous
    pourriez utiliser deux vues occupant chacune une moiti� de la fen�tre. Vous pourriez aussi impl�menter une mini-carte, en dessinant le monde tout entier dans une vue qui
    est rendue dans un petit coin de la fen�tre. Cet espace, o� le contenu de la vue est dessin�, est appel� le <em>viewport</em>.
</p>
<p>
    Pour d�finir le viewport d'une vue, il faut appeler la fonction <code>setViewport</code>.
</p>
<pre><code class="cpp">// d�finition d'un viewport centr�, ayant la moiti� de la taille de la fen�tre
view.setViewport(sf::FloatRect(0.25f, 0.25, 0.5f, 0.5f));
</code></pre>
<img class="screenshot" src="images/graphics-view-viewport.png" title="Un viewport" />
<p>
    Vous avez probablement remarqu� quelque chose de tr�s important : le viewport n'est pas d�fini en pixels, mais plut�t comme un ratio de la taille de la fen�tre. C'est
    beaucoup plus pratique : de cette mani�re vous n'avez pas � mettre � jour le viewport � chaque fois que la fen�tre est redimensionn�e. C'est aussi plus intuitif :
    vous aurez tr�s probablement besoin de d�finir vos viewports avec des fractions, et non des tailles fixes en pixels.
</p>
<p>
    En jouant avec le viewport, il est tr�s simple de d�finir un �cran partag� pour les jeux multijoueur :
</p>
<pre><code class="cpp">// joueur 1 (c�t� gauche de l'�cran)
player1View.setViewport(sf::FloatRect(0, 0, 0.5f, 1));

// joueur 2 (c�t� droit de l'�cran)
player2View.setViewport(sf::FloatRect(0.5f, 0, 0.5f, 1));
</code></pre>
<img class="screenshot" src="images/graphics-view-split-screen.png" title="Un �cran partag�" />

<p>
    ... ou une mini-carte :
</p>
<pre><code class="cpp">// la vue de jeu (toute la fen�tre)
gameView.setViewport(sf::FloatRect(0, 0, 1, 1));

// la mini-carte (dans un coin en haut � droite)
minimapView.setViewport(sf::FloatRect(0.75f, 0, 0.25f, 0.25f));
</code></pre>
<img class="screenshot" src="images/graphics-view-minimap.png" title="Une mini-carte" />

<?php h2('Utiliser une vue') ?>
<p>
    Pour dessiner quelque chose via une vue, vous devez le dessiner apr�s avoir appel� la fonction <code>setView</code> sur la cible dans laquelle vous dessinez
    (<?php class_link('RenderWindow') ?> ou <?php class_link('RenderTexture') ?>).
</p>
<pre><code class="cpp">// on cr�e une vue
sf::View view(sf::FloatRect(0, 0, 1000, 600));

// on l'active
window.setView(view);

// on dessine quelque chose dans cette vue
window.draw(some_sprite);

// vous voulez faire des tests de visibilit� ? r�cup�rez la vue courante
sf::View currentView = window.getView();
...
</code></pre>
<p>
    La vue reste active jusqu'� ce qu'une autre soit activ�e. Cela signifie qu'il y a toujours une vue qui d�finit ce qui appara�t dans la fen�tre, et o� c'est dessin�.
    Si vous n'activez explicitement aucune vue, la fen�tre utilise sa propre vue par d�faut, qui poss�de la m�me taille qu'elle. Vous pouvez r�cup�rer la vue par d�faut
    d'une fen�tre (au fait, quand je dis "fen�tre", j'englobe bien �videmment les textures de rendu) avec la fonction <code>getDefaultView</code>. Cela peut s'av�rer utile
    si vous voulez vous en servir pour servir de base � la cr�ation d'une nouvelle vue, ou encore si vous voulez remettre la vue par d�faut pour dessiner des entit�s fixes
    (comme une interface graphique) par dessus la sc�ne.
</p>
<pre><code class="cpp">// cr�ation d'une vue faisant la moiti� de la vue par d�faut
sf::View view = window.getDefaultView();
view.zoom(0.5f);
window.setView(view);

// r�activation de la vue par d�faut
window.setView(window.getDefaultView());
</code></pre>
<p class="important">
    Lorsque vous appelez <code>setView</code>, la fen�tre garde une <em>copie</em> de la vue, pas un pointeur vers l'instance initiale. Ainsi, � chaque fois que vous
    modifiez votre vue, il faut rappeler <code>setView</code> afin d'appliquer les modifications.
    N'ayez pas peur de copier ou de cr�er des vues � la vol�e, ce sont des objets tr�s l�gers (ils ne consistent qu'en quelques floats).
</p>

<?php h2('Afficher plus lorsque la fen�tre est redimensionn�e') ?>
<p>
    Puisque la vue par d�faut ne change jamais plus apr�s la cr�ation de la fen�tre, la zone affich�e reste toujours la m�me. Ainsi lorsque la fen�tre est redimensionn�e, tout
    est �tir� ou compress� pour s'adapter � la nouvelle taille.
</p>
<p>
    Et si, au lieu de ce comportement par d�faut, vous vouliez montrer plus/moins de choses en fonction de la nouvelle taille de la fen�tre ? Tout ce que vous avez � faire
    est de synchroniser la taille de la vue sur celle de la fen�tre.
</p>
<pre><code class="cpp">// la boucle d'�v�nements
sf::Event event;
while (window.pollEvent(event))
{
    ...

    // on attrape les �v�nements de redimensionnement
    if (event.type == sf::Event::Resized)
    {
        // on met � jour la vue, avec la nouvelle taille de la fen�tre
        sf::FloatRect visibleArea(0, 0, event.size.width, event.size.height);
        window.setView(sf::View(visibleArea));
    }
}
</code></pre>

<?php h2('Conversions de coordonn�es') ?>
<p>
    Lorsque vous utiliser une vue perso, ou bien lorsque vous redimensionnez la fen�tre sans appliquer le code ci-dessus, les pixels de la fen�tre se mettent � ne plus
    correspondre aux unit�s du monde 2D. Par exemple, cliquer sur le pixel (10, 50) peut toucher le point (26.5, -84) du monde. Vous devez alors utiliser une fonction
    de conversion pour faire passer vos coordonn�es "pixel" en coordonn�es "monde" : <code>mapPixelToCoords</code>.
</p>
<pre><code class="cpp">// r�cup�ration de la position de la souris dans la fen�tre
sf::Vector2i pixelPos = sf::Mouse::getPosition(window);

// conversion en coordonn�es "monde"
sf::Vector2f worldPos = window.mapPixelToCoords(pixelPos);
</code></pre>
<p>
    Par d�faut, <code>mapPixelToCoords</code> utilise la vue courante. Si vous pr�f�rez convertir les coordonn�es vers une autre vue que celle qui est active, vous pouvez
    en passer une comme param�tre additionnel � la fonction.
</p>
<p>
    L'op�ration inverse, convertir des coordonn�es "monde" en pixels, est �galement possible avec la fonction <code>mapCoordsToPixel</code>.
</p>

<?php

    require("footer-fr.php");

?>
