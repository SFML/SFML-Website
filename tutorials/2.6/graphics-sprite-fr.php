<?php

    $title = "Sprites et textures";
    $page = "graphics-sprite-fr.php";

    require("header-fr.php");

?>

<h1>Sprites et textures</h1>

<?php h2('Vocabulaire') ?>
<p>
    La plupart d'entre vous sont déjà familiers avec ces deux entités très communes, allons donc à l'essentiel.
</p>
<p>
    Une texture est une image. Mais elle s'appelle "texture" car elle a un rôle bien précis : être "plaquée" sur une entité 2D.
</p>
<p>
    Un sprite quant à lui n'est rien de plus qu'un rectangle texturé.
</p>
<img src="./images/graphics-sprites-definition.png" title="Entité rectangulaire + texture = sprite !" />
<p>
    Ok, c'était plutôt court mais si vous ne comprenez vraiment pas ce que sont les sprites et les textures, alors vous en trouverez une bien meilleure description
    sur Wikipedia.
</p>

<?php h2('Charger une texture') ?>
<p>
    Ainsi donc, avant de créer le moindre sprite, il faut une texture valide. La classe qui encapsule les textures dans SFML est, ô surprise,
    <?php class_link("Texture") ?>. Comme le (seul) rôle d'une texture est d'être chargée puis plaquée sur des entités graphiques, presque toutes ses fonctions servent
    à la charger ou mettre à jour son contenu.
</p>
<p>
    La façon la plus commune de charger une texture est depuis une image sur le disque dur, ce qui se fait avec la fonction <code>loadFromFile</code>.
</p>
<pre><code class="cpp">sf::Texture texture;
if (!texture.loadFromFile("image.png"))
{
    // erreur...
}
</code></pre>
<p class="important">
    La fonction <code>loadFromFile</code> échoue parfois sans raison apparente. Première chose à faire, vérifiez le message d'erreur affiché par SFML dans la sortie
    standard (la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>répertoire de travail</em> (qui est le répertoire relativement auquel
    tout fichier sera interprété) est celui auquel vous vous attendez : lorsque vous lancez votre application depuis l'explorateur de fichiers, le répertoire de travail
    est le répertoire de l'exécutable, pas de problème généralement dans ce cas ; mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...)
    alors le répertoire de travail est parfois le répertoire du <em>projet</em>. Pas de panique : cela peut normalement être modifié directement dans les options de
    votre projet.
</p>
<p>
    Vous pouvez aussi charger une image depuis un fichier en mémoire (<code>loadFromMemory</code>), depuis un
    <a href="./system-stream-fr.php" title="Tutoriels sur les flux d'entrée">flux d'entrée</a> (<code>loadFromStream</code>), ou encore depuis une image déjà chargée
    (<code>loadFromImage</code>). Cette dernière fonction charge la texture depuis un <?php class_link("Image") ?>, qui est une classe utilitaire pour manipuler
    des images (modifier des pixels, créer un masque de transparence, etc.) Les pixels d'un <?php class_link("Image") ?> restent en mémoire système, afin que les opérations
    sur ceux-ci soient le plus rapide possible, alors que les pixels d'une texture sont stockés en mémoire graphique et sont donc très lents à récupérer ou à mettre à jour
    -- mais extrêmement rapides à dessiner.
</p>
<p>
    SFML supporte les formats de fichiers les plus communs. La liste complète est disponible dans la documentation de l'API.
</p>
<p>
    Toutes ces fonctions de chargement ont un paramètre optionnel, qui peut être utilisé si vous voulez charger uniquement une partie de l'image.
</p>
<pre><code class="cpp">// chargement d'un sous-rectangle de 32x32 démarrant en (10, 10)
if (!texture.loadFromFile("image.png", sf::IntRect(10, 10, 32, 32)))
{
    // erreur...
}
</code></pre>
<p>
    <?php class_link("IntRect", "Rect") ?> est une classe utilitaire qui représente un rectangle. Son constructeur prend les coordonnées du coin
    haut-gauche ainsi que la taille du rectangle.
</p>
<p>
    Si vous ne voulez pas charger une texture depuis une image, mais plutôt la mettre à jour directement à partir d'un tableau de pixels, vous
    pouvez la créer vide puis la remplir plus tard :
</p>
<pre><code class="cpp">// création d'une texture vide de 200x200
if (!texture.create(200, 200))
{
    // erreur...
}
</code></pre>
<p>
    Notez que le contenu de la texture est complètement indéterminé à ce moment.
</p>
<p>
    Pour mettre à jour les pixels d'une texture, il faut utiliser la fonction <code>update</code>. Elle possède des surcharges qui prennent en charge plusieurs sources
    possibles pour les pixels :
</p>
<pre><code class="cpp">// mise à jour d'une texture à partir d'un tableau de pixels
sf::Uint8* pixels = new sf::Uint8[width * height * 4]; // * 4 car les pixels ont 4 composantes (RGBA)
...
texture.update(pixels);

// mise à jour d'une texture à partir d'un sf::Image
sf::Image image;
...
texture.update(image);

// mise à jour d'une texture à partir du contenu d'une fenêtre
sf::RenderWindow window;
...
texture.update(window);
</code></pre>
<p>
    Ces exemples supposent tous que la source a la même taille que la texture. Si ce n'est pas le cas, i.e. si vous voulez mettre à jour uniquement une partie
    de la texture, vous pouvez spécifier les coordonnées du sous-rectangle à mettre à jour. Vous pouvez vous référer à la documentation pour plus de détails.
</p>
<p>
    En plus des fonctions de chargement et de mise à jour, une texture possède deux propriétés qui permettent de définir la façon dont elle est dessinée.
</p>
<p>
    La première propriété permet de lisser la texture. Lisser une texture rend ses pixels moins visibles (mais un peu plus flous), ce qui peut être très important si
    elle n'est pas dessinée à sa taille d'origine.
</p>
<pre><code class="cpp">texture.setSmooth(true);
</code></pre>
<img src="./images/graphics-sprites-smooth.png" title="Illustration du lissage de texture" />
<p class="important">
    Comme le lissage fait une interpolation entre les pixels adjacents de la texture, cela peut avoir l'effet de bord non souhaité de faire apparaître des pixels qui se
    trouvent en dehors de la région de la texture qui a été choisie. Cela peut notamment arriver lorsque votre sprite se trouve à des coordonnées non entières.
</p>
<p>
    La seconde propriété permet de répéter une texture (dans les sprites qui sont correctement paramétrés).
</p>
<pre><code class="cpp">texture.setRepeated(true);
</code></pre>
<img src="./images/graphics-sprites-repeated.png" title="Illustration de la répétition de texture" />
<p>
    Cela ne fonctionnera que si le sprite qui affiche la texture est paramétré pour afficher un rectangle plus grand que la texture. Dans le cas contraire, cette propriété
    n'a aucun effet.
</p>

<?php h2('Bon, je peux avoir mon sprite maintenant ?') ?>
<p>
    Oui, vous pouvez maintenant créer votre sprite.
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
    Si vous ne voulez pas que le sprite montre la totalité de la texture, vous pouvez changer son "rectangle de texture".
</p>
<pre><code class="cpp">sprite.setTextureRect(sf::IntRect(10, 10, 32, 32));
</code></pre>
<p>
    Vous pouvez aussi changer la couleur d'un sprite. La couleur choisie est modulée (multipliée) avec la texture du sprite. Changer la couleur peut aussi servir à
    changer la transparence globale du sprite.
</p>
<pre><code class="cpp">sprite.setColor(sf::Color(0, 255, 0)); // vert
sprite.setColor(sf::Color(255, 255, 255, 128)); // à moitié transparent
</code></pre>
<p>
    Ces sprites utilisent tous la même texture, mais ont une couleur différente :
</p>
<img src="./images/graphics-sprites-color.png" title="Colorier les sprites" />
<p>
    Les sprites peuvent aussi être transformés : ils ont une position, une orientation et une échelle.
</p>
<pre><code class="cpp">// position
sprite.setPosition(sf::Vector2f(10.f, 50.f)); // position absolue
sprite.move(sf::Vector2f(5.f, 10.f)); // décalage relatif à la position actuelle

// rotation
sprite.setRotation(90.f); // angle absolu
sprite.rotate(15.f); // rotation par rapport à l'orientation actuelle

// scale
sprite.setScale(sf::Vector2f(0.5f, 2.f)); // facteurs d'échelle absolus
sprite.scale(sf::Vector2f(1.5f, 3.f)); // facters d'échelle relatifs à l'échelle actuelle
</code></pre>
<p>
    Par défaut, l'origine de ces trois transformations est le coin haut-gauche du sprite. Si vous souhaitez utiliser une origine différente (par exemple le centre
    du sprite, ou bien un autre coin), vous pouvez utiliser la fonction <code>setOrigin</code>.
</p>
<pre><code class="cpp">sprite.setOrigin(sf::Vector2f(25.f, 25.f));
</code></pre>
<p>
    Les transformations étant communes à toutes les entités de SFML, elles sont expliquées plus en détail dans leur propre tutoriel :
    <a href="./graphics-transform-fr.php" title="Tutoriel 'Transformer les entités'">Transformer les entités</a>.
</p>

<?php h2('Le problème du carré blanc') ?>
<p>
    Vous avez correctement chargé une texture, défini un sprite l'utilisant, et... tout ce que vous voyez à l'écran est un carré blanc. Que se passe-t-il ?
</p>
<p>
    C'est une erreur courante. Lorsque vous définissez la texture d'un sprite, tout ce que celui-ci fait est de garder un <em>pointeur</em> vers la texture. Par conséquent,
    si celle-ci est détruite ou bien déplacée en mémoire par la suite, le sprite se retrouve avec un pointeur invalide, et ne peux plus être dessiné correctement.
</p>
<p>
    Ce problème survient notamment lorsque vous écrivez ce genre de fonction :
</p>
<pre><code class="cpp">sf::Sprite loadSprite(std::string filename)
{
    sf::Texture texture;
    texture.loadFromFile(filename);

    return sf::Sprite(texture);
} //erreur : la texture est détruite ici !
</code></pre>
<p>
    Vous devez correctement gérer la durée de vie de vos textures, de sorte qu'elles restent en vie aussi longtemps qu'elles sont utilisées par des sprites.
</p>

<?php h2('L\'importance d\'utiliser aussi peu de textures que possible') ?>
<p>
    Utiliser un nombre réduit de textures est globalement une bonne stratégie, et la raison en est simple : changer la texture courante est une opération coûteuse pour la
    carte graphique. Dessiner plusieurs sprites qui utilisent la même texture donnera des performances optimales.
</p>
<p>
    De plus, utiliser une unique texture vous permettra si nécessaire de regrouper toute la géometrie statique en une seule entité (vous ne pouvez en effet utiliser
    qu'une seule texture par appel à la fonction <code>draw</code>), ce qui sera nettement plus performant que de dessiner un groupe de plusieurs entités.
    Regrouper la géometrie statique implique d'autres classes et est donc hors sujet dans ce tutoriel, pour plus de détails vous pouvez aller voir le tutoriel sur 
    <a href="./graphics-vertex-array-fr.php" title="Tutoriel sur les tableaux de vertex">les tableaux de vertex</a>.
</p>
<p>
    Gardez bien cela en tête lorsque vous créez vos textures d'animation ou de tuiles (<em>sprite sheets</em> et <em>tilesets</em>) : utilisez si possible une seule texture.
</p>

<?php h2('Utiliser sf::Texture dans du code OpenGL') ?>
<p>
    Si vous utilisez OpenGL plutôt que les entités graphiques de SFML, vous pouvez toujours utiliser <?php class_link("Texture") ?> comme encapsulation d'une texture OpenGL,
    et la faire intéragir avec vos entités OpenGL.
</p>
<p>
    Afin d'activer une <?php class_link("Texture") ?> pour le rendu (l'équivalent de <code>glBindTexture</code>), vous devez appeler la fonction statique
    <code>bind</code> :
</p>
<pre><code class="cpp">sf::Texture texture;
...

// activation de la texture
sf::Texture::bind(&amp;texture);

// dessinez votre géometrie OpenGL ici...

// pas de texture
sf::Texture::bind(NULL);
</code></pre>

<?php

    require("footer-fr.php");

?>
