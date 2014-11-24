<?php

    $title = "Sprites et textures";
    $page = "graphics-sprite-fr.php";

    require("header-fr.php");

?>

<h1>Sprites et textures</h1>

<?php h2('Vocabulaire') ?>
<p>
    La plupart d'entre vous sont d�j� familiers avec ces deux entit�s tr�s communes, allons donc � l'essentiel.
</p>
<p>
    Une texture est une image. Mais elle s'appelle "texture" car elle a un r�le bien pr�cis : �tre "plaqu�e" sur une entit� 2D.
</p>
<p>
    Un sprite quant � lui n'est rien de plus qu'un rectangle textur�.
</p>
<img src="./images/graphics-sprites-definition.png" title="Entit� rectangulaire + texture = sprite !" />
<p>
    Ok, c'�tait plut�t court mais si vous ne comprenez vraiment pas ce que sont les sprites et les textures, alors vous en trouverez une bien meilleure description
    sur wikipedia.
</p>

<?php h2('Charger une texture') ?>
<p>
    Ainsi donc, avant de cr�er le moindre sprite, il faut une texture valide. La classe qui encapsule les textures dans SFML est, � surprise,
    <?php class_link("Texture") ?>. Comme le (seul) r�le d'une texture est d'�tre charg�e puis plaqu�e sur des entit�s graphiques, presque toutes ses fonctions servent
    � la charger ou mettre � jour son contenu.
</p>
<p>
    La fa�on la plus commune de charger une texture est depuis une image sur le disque dur, ce qui se fait avec la fonction <code>loadFromFile</code>.
</p>
<pre><code class="cpp">sf::Texture texture;
if (!texture.loadFromFile("image.png"))
{
    // erreur...
}
</code></pre>
<p class="important">
    La fonction <code>loadFromFile</code> �choue parfois sans raison apparente. Premi�re chose � faire, v�rifiez le message d'erreur affich� par SFML dans la sortie
    standard (la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>r�pertoire de travail</em> (qui est le r�pertoire relativement auquel
    tout fichier sera interpr�t�) est celui auquel vous vous attendez : lorsque vous lancez votre application depuis l'explorateur de fichiers, le r�pertoire de travail
    est le r�pertoire de l'ex�cutable, pas de probl�me g�n�ralement dans ce cas ; mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...)
    alors le r�pertoire de travail est parfois le r�pertoire du <em>projet</em>. Pas de panique : cela peut normalement �tre modifi� directement dans les options de
    votre projet.
</p>
<p>
    Vous pouvez aussi charger une image depuis un fichier en m�moire (<code>loadFromMemory</code>), depuis un
    <a href="./system-stream-fr.php" title="Tutoriels sur les flux d'entr�e">flux d'entr�e</a> (<code>loadFromStream</code>), ou encore depuis une image d�j� charg�e
    (<code>loadFromImage</code>). Cette derni�re fonction charge la texture depuis un <?php class_link("Image") ?>, qui est une classe utilitaire pour manipuler
    des images (modifier des pixels, cr�er un masque de transparence, etc.) Les pixels d'un <?php class_link("Image") ?> restent en m�moire syst�me, afin que les op�rations
    sur ceux-ci soient le plus rapide possible, alors que les pixels d'une texture sont stock�s en m�moire graphique et sont donc tr�s lents � r�cup�rer ou � mettre � jour
    -- mais extr�mement rapides � dessiner.
</p>
<p>
    SFML supporte les formats de fichiers les plus communs. La liste compl�te est disponible dans la documentation de l'API.
</p>
<p>
    Toutes ces fonctions de chargement ont un param�tre optionnel, qui peut �tre utilis� si vous voulez charger uniquement une partie de l'image.
</p>
<pre><code class="cpp">// chargement d'un sous-rectangle de 32x32 d�marrant en (10, 10)
if (!texture.loadFromFile("image.png", sf::IntRect(10, 10, 32, 32)))
{
    // erreur...
}
</code></pre>
<p>
    <?php class_link("IntRect", "Rect") ?> est une classe utilitaire qui repr�sente un rectangle. Son constructeur prend les coordonn�es du coin
    haut-gauche ainsi que la taille du rectangle.
</p>
<p>
    Si vous ne voulez pas charger une texture depuis une image, mais plut�t la mettre � jour directement � partir d'un tableau de pixels, vous
    pouvez la cr�er vide puis la remplir plus tard :
</p>
<pre><code class="cpp">// cr�ation d'une texture vide de 200x200
if (!texture.create(200, 200))
{
    // erreur...
}
</code></pre>
<p>
    Notez que le contenu de la texture est compl�tement ind�termin� � ce moment.
</p>
<p>
    Pour mettre � jour les pixels d'une texture, il faut utiliser la fonction <code>update</code>. Elle poss�de des surcharges qui prennent en charge plusieurs sources
    possibles pour les pixels :
</p>
<pre><code class="cpp">// mise � jour d'une texture � partir d'un tableau de pixels
sf::Uint8* pixels = new sf::Uint8[width * height * 4]; // * 4 car les pixels ont 4 composantes (RGBA)
...
texture.update(pixels);

// mise � jour d'une texture � partir d'un sf::Image
sf::Image image;
...
texture.update(image);

// mise � jour d'une texture � partir du contenu d'une fen�tre
sf::RenderWindow window;
...
texture.update(window);
</code></pre>
<p>
    Ces exemples supposent tous que la source a la m�me taille que la texture. Si ce n'est pas le cas, i.e. si vous voulez mettre � jour uniquement une partie
    de la texture, vous pouvez sp�cifier les coordonn�es du sous-rectangle � mettre � jour. Vous pouvez vous r�f�rer � la documentation pour plus de d�tails.
</p>
<p>
    En plus des fonctions de chargement et de mise � jour, une texture poss�de deux propri�t�s qui permettent de d�finir la fa�on dont elle est dessin�e.
</p>
<p>
    La premi�re propri�t� permet de lisser la texture. Lisser une texture rend ses pixels moins visibles (mais un peu plus flous), ce qui peut �tre tr�s important si
    elle n'est pas dessin�e � sa taille d'origine.
</p>
<pre><code class="cpp">texture.setSmooth(true);
</code></pre>
<img src="./images/graphics-sprites-smooth.png" title="Illustration du lissage de texture" />
<p class="important">
    Comme le lissage fait une interpolation entre les pixels adjacents de la texture, cela peut avoir l'effet de bord non souhait� de faire appara�tre des pixels qui se
    trouvent en dehors de la r�gion de la texture qui a �t� choisie. Cela peut notamment arriver lorsque votre sprite se trouve � des coordonn�es non enti�res.
</p>
<p>
    La seconde propri�t� permet de r�p�ter une texture (dans les sprites qui sont correctement param�tr�s).
</p>
<pre><code class="cpp">texture.setRepeated(true);
</code></pre>
<img src="./images/graphics-sprites-repeated.png" title="Illustration de la r�p�tition de texture" />
<p>
    Cela ne fonctionnera que si le sprite qui affiche la texture est param�tr� pour afficher un rectangle plus grand que la texture. Dans le cas contraire, cette propri�t�
    n'a aucun effet.
</p>

<?php h2('Bon, je peux avoir mon sprite maintenant ?') ?>
<p>
    Oui, vous pouvez maintenant cr�er votre sprite.
</p>
<pre><code class="cpp">sf::Sprite sprite;
sprite.setTexture(texture);
</code></pre>
<p>
    ... et enfin le dessiner.
</p>
<pre><code class="cpp">// dans la boucle principale, entre window.clear() et window.display()
window.draw(sprite);
</code></pre>
<p>
    Si vous ne voulez pas que le sprite montre la totalit� de la texture, vous pouvez changer son "rectangle de texture".
</p>
<pre><code class="cpp">sprite.setTextureRect(sf::IntRect(10, 10, 32, 32));
</code></pre>
<p>
    Vous pouvez aussi changer la couleur d'un sprite. La couleur choisie est modul�e (multipli�e) avec la texture du sprite. Changer la couleur peut aussi servir �
    changer la transparence globale du sprite.
</p>
<pre><code class="cpp">sprite.setColor(sf::Color(0, 255, 0)); // vert
sprite.setColor(sf::Color(255, 255, 255, 128)); // � moiti� transparent
</code></pre>
<p>
    Ces sprites utilisent tous la m�me texture, mais ont une couleur diff�rente :
</p>
<img src="./images/graphics-sprites-color.png" title="Colorier les sprites" />
<p>
    Les sprites peuvent aussi �tre transform�s : ils ont une position, une orientation et une �chelle.
</p>
<pre><code class="cpp">// position
sprite.setPosition(sf::Vector2f(10, 50)); // position absolue
sprite.move(sf::Vector2f(5, 10)); // d�calage relatif � la position actuelle

// rotation
sprite.setRotation(90); // angle absolu
sprite.rotate(15); // rotation par rapport � l'orientation actuelle

// scale
sprite.setScale(sf::Vector2f(0.5f, 2.f)); // facteurs d'�chelle absolus
sprite.scale(sf::Vector2f(1.5f, 3.f)); // facters d'�chelle relatifs � l'�chelle actuelle
</code></pre>
<p>
    Par d�faut, l'origine de ces trois transformations est le coin haut-gauche du sprite. Si vous souhaitez utiliser une origine diff�rente (par exemple le centre
    du sprite, ou bien un autre coin), vous pouvez utiliser la fonction <code>setOrigin</code>.
</p>
<pre><code class="cpp">sprite.setOrigin(sf::Vector2f(25, 25));
</code></pre>
<p>
    Les transformations �tant communes � toutes les entit�s de SFML, elles sont expliqu�es plus en d�tail dans leur propre tutoriel :
    <a href="./graphics-transform-fr.php" title="Tutoriel 'Transformer les entit�s'">Transformer les entit�s</a>.
</p>

<?php h2('Le probl�me du carr� blanc') ?>
<p>
    Vous avez correctement charg� une texture, d�fini un sprite l'utilisant, et... tout ce que vous voyez � l'�cran est un carr� blanc. Que se passe-t-il ?
</p>
<p>
    C'est une erreur courante. Lorsque vous d�finissez la texture d'un sprite, tout ce que celui-ci fait est de garder un <em>pointeur</em> vers la texture. Par cons�quent,
    si celle-ci est d�truite ou bien d�plac�e en m�moire par la suite, le sprite se retrouve avec un pointeur invalide, et ne peux plus �tre dessin� correctement.
</p>
<p>
    Ce probl�me survient notamment lorsque vous �crivez ce genre de fonction :
</p>
<pre><code class="cpp">sf::Sprite loadSprite(std::string filename)
{
    sf::Texture texture;
    texture.loadFromFile(filename);

    return sf::Sprite(texture);
} //erreur : la texture est d�truite ici !
</code></pre>
<p>
    Vous devez correctement g�rer la dur�e de vie de vos textures, de sorte qu'elles restent en vie aussi longtemps qu'elles sont utilis�es par des sprites.
</p>

<?php h2('L\'importance d\'utiliser aussi peu de textures que possible') ?>
<p>
    Utiliser un nombre r�duit de textures est globalement une bonne strat�gie, et la raison en est simple : changer la texture courante est une op�ration co�teuse pour la
    carte graphique. Dessiner plusieurs sprites qui utilisent la m�me texture donnera des performances optimales.
</p>
<p>
    De plus, utiliser une unique texture vous permettra si n�cessaire de regrouper toute la g�ometrie statique en une seule entit� (vous ne pouvez en effet utiliser
    qu'une seule texture par appel � la fonction <code>draw</code>), ce qui sera nettement plus performant que de dessiner un groupe de plusieurs entit�s.
    Regrouper la g�ometrie statique implique d'autres classes et est donc hors sujet dans ce tutoriel, pour plus de d�tails vous pouvez aller voir le tutoriel sur 
    <a href="./graphics-vertex-array-fr.php" title="Tutoriel sur les tableaux de vertex">les tableaux de vertex</a>.
</p>
<p>
    Gardez bien cela en t�te lorsque vous cr�ez vos textures d'animation ou de tuiles (<em>sprite sheets</em> et <em>tilesets</em>) : utilisez si possible une seule texture.
</p>

<?php h2('Utiliser sf::Texture dans du code OpenGL') ?>
<p>
    Si vous utilisez OpenGL plut�t que les entit�s graphiques de SFML, vous pouvez toujours utiliser <?php class_link("Texture") ?> comme encapsulation d'une texture OpenGL,
    et la faire int�ragir avec vos entit�s OpenGL.
</p>
<p>
    Afin d'activer une <?php class_link("Texture") ?> pour le rendu (l'�quivalent de <code>glBindTexture</code>), vous devez appeler la fonction statique
    <code>bind</code> :
</p>
<pre><code class="cpp">sf::Texture texture;
...

// activation de la texture
sf::Texture::bind(&amp;texture);

// dessinez votre g�ometrie OpenGL ici...

// pas de texture
sf::Texture::bind(NULL);
</code></pre>

<?php

    require("footer-fr.php");

?>
