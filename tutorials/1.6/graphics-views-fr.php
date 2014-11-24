<?php

    $title = "Utiliser les vues";
    $page = "graphics-views-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les vues</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, vous allez apprendre � utiliser les vues 2D de SFML. Les vues sont comme des cam�ras 2D, qui
    permettent de se d�placer, zoomer ou faire d�filer sans avoir � bouger ou redimensionner tous les objets de la sc�ne.
</p>

<?php h2('D�finir une nouvelle vue') ?>
<p>
    Les vues sont d�finies par la classe <?php class_link("View")?>, qui n'est basiquement qu'un rectangle 2D enrob�
    dans une interface style cam�ra.
</p>
<p>
    Une vue peut �tre cr��e soit � partir d'un centre et d'une demi-taille, soit directement � partir d'un rectangle
    englobant :
</p>
<pre><code class="cpp">sf::Vector2f Center(1000, 1000);
sf::Vector2f HalfSize(400, 300);
sf::View View1(Center, HalfSize);

// Ou

sf::View View2(sf::FloatRect(600, 700, 1400, 1300));
</code></pre>
<p>
    Tous ces param�tres peuvent �tre lus et modifi�s � n'importe quel moment en utilisant les accesseurs pr�vus
    � cet effet :
</p>
<pre><code class="cpp">View.SetCenter(500, 300);
View.SetHalfSize(200, 100);

// Ou

View.SetFromRect(sf::FloatRect(300, 200, 700, 400));
</code></pre>
<pre><code class="cpp">sf::Vector2f  Center    = View.GetCenter();
sf::Vector2f  HalfSize  = View.GetHalfSize();
sf::FloatRect Rectangle = View.GetRect();
</code></pre>
<p>
    En plus de �a, il existe deux fonctions pratiques pour faire d�filer (d�placer) ou zoomer (redimensionner) la vue :
</p>
<pre><code class="cpp">View.Move(10, -5); // D�place la vue de (10, -5) unit�s
View.Zoom(0.5f);   // Zoome d'un facteur 1/2 (ie. d�zoome pour rendre la vue 2x plus large)
</code></pre>
<p>
    Comme vous pouvez le voir il n'y a rien de compliqu� ici, seulement quelques fonctions pour contr�ler la position
    et la taille de la vue.
</p>

<?php h2('Utiliser une vue') ?>
<p>
    Afin d'utiliser une vue, vous devez appeler la fonction <code>SetView</code> de la classe
    <?php class_link("RenderWindow")?> :
</p>
<pre><code class="cpp">// Utilise notre vue perso
App.SetView(View);
</code></pre>
<p>
    Tout objet dessin� apr�s l'appel � <code>SetView</code> (et avant le prochain) sera affect� par la vue.<br/>
    Une fois mise en place, la fen�tre garde un lien vers la vue courante ; ainsi vous pouvez mettre � jour celle-ci
    sans avoir � rappeler <code>SetView</code>, vos changements seront appliqu�s automatiquement.
</p>
<p>
    Chaque fen�tre de rendu poss�de une vue par d�faut, toujours dimensionn�e � la taille initiale de sa fen�tre.
    Vous pouvez acc�der � cette vue, voire m�me la modifier, via la fonction <code>GetDefaultView</code> :
</p>
<pre><code class="cpp">sf::View& DefaultView = App.GetDefaultView();
</code></pre>
<p>
    La vue par d�faut n'est pas mise � jour lorsque sa fen�tre est redimensionn�e : en cons�quence, ce qui est visible
    dans votre fen�tre ne sera jamais affect� par la taille de celle-ci (ie. vous ne verrez pas plus en agrandissant
    la fen�tre), ce qui est exactement ce qui se passe avec une cam�ra 3D classique.<br/>
    Ceci-dit, vous pouvez tout de m�me facilement mettre en place une vue qui garderait toujours les m�mes dimensions
    que sa fen�tre, en surveillant l'�v�nement <code>sf::Event::Resized</code> et en ajustant la vue en cons�quence.
</p>
<p>
    Acc�der � la vue par d�faut peut �galement �tre utile pour revenir � la vue initiale. Par exemple, cela peut �tre
    pratique si vous souhaitez dessiner une interface utilisateur par dessus le jeu, cette premi�re ne suivant
    habituellement pas la cam�ra.
</p>
<pre><code class="cpp">App.SetView(View);

// Afficher le jeu...

App.SetView(App.GetDefaultView());

// Afficher l'interface...
</code></pre>

<?php h2('Coordonn�es fen�tre, coordonn�es vue') ?>
<p>
    Lorsqu'une vue personnalis�e est utilis�e, ou lorsque votre fen�tre a �t� redimensionn�e, n'oubliez pas que les
    coordonn�es des objets ne correspondent plus avec les pixels de la fen�tre ; prenez donc garde � g�rer correctement
    les diff�rentes conversions n�cessaires (par exemple, lorsque vous testez la position de la souris par rapport
    aux rectangles des sprites). Rappelez vous toujours que ce que vous voyez est le rectangle de la vue, pas celui de
    la fen�tre.
</p>
<p>
    Si vous souhaitez convertir des coordonn�es fen�tre en coordonn�es vue, probablement apr�s un clic souris, vous
    pouvez utiliser la fonction <code>RenderWindow::ConvertCoords</code> :
</p>
<pre><code class="cpp">// Convertit la position du curseur en coordonn�es vue
sf::Vector2f MousePos = App.ConvertCoords(App.GetInput().GetMouseX(), App.GetInput().GetMouseY());
</code></pre>
<p>
    Par d�faut, cette fonction utilise la vue courante de la fen�tre pour effectuer la conversion. Cependant, vous
    pouvez utiliser n'importe quelle autre vue en passant son adresse en troisi�me param�tre (qui vaut donc
    <code>NULL</code> par d�faut).
</p>

<?php h2('Conclusion') ?>
<p>
    Les vues 2D fournissent un moyen facile et pratique de g�rer des effets tels que le d�filement ou le zoom, avec
    aucun impact sur les performances. La seule chose � garder en t�te lorsque vous utilisez les vues, est la possibilit�
    d'avoir � effectuer des conversions si vous devez faire correspondre des pixels fen�tre � des coordonn�es de votre
    sc�ne.
</p>

<?php

    require("footer-fr.php");

?>
