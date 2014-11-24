<?php

    $title = "Afficher un sprite";
    $page = "graphics-sprite-fr.php";

    require("header-fr.php");
?>

<h1>Afficher un sprite</h1>

<?php h2('Introduction') ?>
<p>
    Afficher des sprites est sans doute la partie la plus importante d'une API 2D. Parce que, basiquement,
    tout est un sprite. Regardons à quoi ils ressemblent dans la SFML.
</p>

<?php h2('Charger une image') ?>
<p>
    Habituellement, les sprites sont chargés à partir de fichiers sur le disque dur. Pour charger une image
    à partir d'un fichier avec la SFML, vous devez utiliser la classe <?php class_link("Image")?>
    et sa fonction <code>LoadFromFile</code> :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromFile("sprite.tga"))
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez tout aussi bien charger un fichier se trouvant directement en mémoire,
    à l'aide de la fonction <code>LoadFromMemory</code> :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    Les images peuvent également être créées et remplies avec une couleur, ou chargées depuis la mémoire :
</p>
<pre><code class="cpp">sf::Image Image1(200, 200, sf::Color(0, 255, 0));
sf::Image Image2(200, 200, PointerToPixelsInMemory);

// Ou, si vous voulez le faire après la construction :

Image1.Create(200, 200, sf::Color(0, 255, 0));
Image2.LoadFromPixels(200, 200, PointerToPixelsInMemory);
</code></pre>
<p>
    Notez bien que lorsque vous chargez une image à partir d'un tableau de pixels en mémoire, ces pixels
    doivent être au format 32-bits RGBA.
</p>
<p>
    Vous pouvez aussi accéder aux pixels de l'image en lecture et en écriture :
</p>
<pre><code class="cpp">sf::Color Color = Image.GetPixel(10, 20);
Image.SetPixel(20, 30, Color);
</code></pre>
<p>
    Soyez vigilants lorsque vous manipulez des images : elles peuvent être copiées, mais ce n'est pas une opération
    légère. Donc essayer d'éviter les copies dans la mesure du possible (passez vos images par référence lorsque vous le
    pouvez, par exemple).
</p>

<?php h2('Créer un sprite') ?>
<p>
    Ok, nous pouvons maintenant créer / charger / modifier une image. Mais ce n'est pas un sprite.
    Dans la SFML, images et sprites sont séparés en deux classes distinctes. Vous pouvez voir les images
    comme des tableaux de pixels en mémoire, et les sprites comme un moyen d'afficher ces tableaux de
    pixels dans une fenêtre. Manipuler les images en dehors de l'interface des sprites a deux
    avantages principaux :
</p>
<ul>
    <li>Cela vous permet d'utiliser une même image pour plusieurs sprites, sans dupliquer les pixels
    en mémoire, et sans avoir à écrire un gestionnaire d'images</li>
    <li>Parfois vous ne voulez pas manipuler les images en tant que sprites. Par exemple vous voulez
    pouvoir charger des images, leur appliquer un certain effet, puis les sauvegarder dans des fichiers</li>
</ul>
<p>
    Revenons aux sprites. Dans la SFML, un sprite est une instance de la classe
    <?php class_link("Sprite")?>.
    Cette classe dérive de <?php class_link("Drawable")?>,
    qui est la base de tout objet affichable (sprites, chaînes de caractères, post-fx, ...).
    <?php class_link("Drawable")?>
    définit tout un tas de fonctions pour changer / récupérer l'apparence de l'objet affichable. Voici un exemple avec
    un sprite, mais ces fonctions sont communes à tous les objets affichables, donc ne les oubliez pas.
</p>
<pre><code class="cpp">sf::Sprite Sprite;
Sprite.SetColor(sf::Color(0, 255, 255, 128));
Sprite.SetX(200.f);
Sprite.SetY(100.f);
Sprite.SetPosition(200.f, 100.f);
Sprite.SetRotation(30.f);
Sprite.SetCenter(0, 0);
Sprite.SetScaleX(2.f);
Sprite.SetScaleY(0.5f);
Sprite.SetScale(2.f, 0.5f);
Sprite.SetBlendMode(sf::Blend::Multiply);

Sprite.Move(10, 5);
Sprite.Rotate(90);
Sprite.Scale(1.5f, 1.5f);
</code></pre>
<p>
    Notez que toutes les fonctions prenant deux floats en paramètre, peuvent également prendre une instance de
    <?php class_link("Vector2f", "Vector2")?>.
    Les fonctions GetXxx correspondant aux SetXxx prenant un vecteur, renvoient également un
    <?php class_link("Vector2f", "Vector2")?>.
</p>
<p>
    Vous pouvez bien sûr changer ces valeurs à n'importe quel moment de l'exécution, les sprites
    sont complétement dynamiques.
</p>
<p>
    Le centre de l'objet, défini par la fonction <code>SetCenter</code>, est défini relativement au coin haut-gauche
    de l'objet et représente son centre de translation, de rotation et de mise à l'échelle. En gros, il s'agit
    de l'origine de l'objet, qui va rester fixe lorsque vous appliquerez des transformations géometriques à celui-ci.
</p>
<p>
    Remarquez que la couleur a une composante alpha à 128, ce qui signifie que notre sprite sera
    un peu transparent. Si vous vous demandez pourquoi la position du sprite est exprimée avec des
    variables flottantes alors que les pixels sont en coordonnées entières, c'est simplement pour
    plus de flexibilité. En effet lorsque vous bougez un sprite, ce ne sera pas toujours d'une quantité
    entière de pixels, mais plutôt d'une très faible valeur. Ceci évite donc que vous ayiez
    à gérer une variable supplémentaire juste pour avoir les coordonnées du sprite en nombre flottant.
    Une autre raison est que lorsque vous utilisez des vues, les coordonnées de la "scène" n'ont
    potentiellement plus rien à voir avec les pixels de l'écran ; mais gardons ça pour le prochain
    tutoriel.
</p>
<p>
    Il n'y a pas grand chose à dire sur les autres variables, excepté que la rotation est un angle
    exprimé en degrés.
</p>
<p>
    Une fois que vous avez appliqué toutes ces transformations à votre sprite, il peut devenir difficile d'obtenir le
    rectangle résultant, et de manière générale la position finale de tout point local. C'est pourquoi
    <?php class_link("Sprite")?> et toutes les classes dérivées de <?php class_link("Drawable")?> définissent
    deux fonctions de conversion :
</p>
<pre><code class="cpp">// Convertit un point local en coordonnées globales
sf::Vector2f Global = Sprite.TransformToGlobal(sf::Vector2f(10, 25));

// Convertit un point global en coordonnées locales
sf::Vector2f Local = Sprite.TransformToLocal(sf::Vector2f(425, 120));
</code></pre>
<p>
    Par dessus cela, <?php class_link("Sprite")?>
    fournit des fonctions plus spécifiques :
</p>
<pre><code class="cpp">// On change l'image (texture) source du sprite
sf::Image Image;
...
Sprite.SetImage(Image);

// On récupère les dimensions du sprite
float Width  = Sprite.GetSize().x;
float Height = Sprite.GetSize().y;

// On redimensionne le sprite
Sprite.Resize(60, 100);

// Retourne le sprite sur les axes X et Y
Sprite.FlipX(true);
Sprite.FlipY(true);

// On récupère la couleur d'un pixel donné du sprite
sf::Color Pixel = Sprite.GetPixel(10, 5);
</code></pre>
<p>
    Nous pouvons ensuite facilement ajouter un peu d'interaction avec notre sprite :
</p>
<pre><code class="cpp">// Récupération du temps écoulé
float ElapsedTime = App.GetFrameTime();

// On déplace le sprite
if (App.GetInput().IsKeyDown(sf::Key::Left))  Sprite.Move(-100 * ElapsedTime, 0);
if (App.GetInput().IsKeyDown(sf::Key::Right)) Sprite.Move( 100 * ElapsedTime, 0);
if (App.GetInput().IsKeyDown(sf::Key::Up))    Sprite.Move(0, -100 * ElapsedTime);
if (App.GetInput().IsKeyDown(sf::Key::Down))  Sprite.Move(0,  100 * ElapsedTime);

// On tourne le sprite
if (App.GetInput().IsKeyDown(sf::Key::Add))      Sprite.Rotate(-100 * ElapsedTime);
if (App.GetInput().IsKeyDown(sf::Key::Subtract)) Sprite.Rotate( 100 * ElapsedTime);
</code></pre>

<?php h2('Afficher un sprite') ?>
<p>
    Afficher un sprite dans une fenêtre de rendu est extrêmement simple :
</p>
<pre><code class="cpp">App.Draw(Sprite);
</code></pre>
<p>
    Aucun paramètre supplémentaire n'est nécessaire, étant donné que le sprite connaît déjà tout ce qu'il
    faut savoir sur son apparence (sa position, sa couleur, ...).
</p>
<p>
    Si vous voulez dessiner uniquement une sous-portion de l'image originale, vous pouvez changer le
    paramètre <code>SubRect</code> du sprite :
</p>
<pre><code class="cpp">Sprite.SetSubRect(sf::IntRect(10, 10, 20, 20));
</code></pre>
<p>
    Ici nous n'afficherons qu'un sous-rectangle de l'image allant du pixel (10, 10) au pixel (20, 20).
</p>
<p>
    <?php class_link("IntRect", "Rect")?> est juste une classe utilitaire pour manipuler les rectangles.
    Pour les rectangles à coordonnées flottantes, il y a également la classe <?php class_link("FloatRect", "Rect")?>
    (en fait elles sont toutes deux des instanciations de la classe template <?php class_link("Rect")?>).
</p>

<?php h2('Gestion des images et des sprites') ?>
<p>
    Vous devez être particulièrement prudent lorsque vous manipulez des images. Une instance de
    <?php class_link("Image")?>
    est une ressource qui est lente à charger, lourde à copier et qui utilise beaucoup de mémoire.
</p>
<p>
    Beaucoup de gens, particulièrement les débutants, seront tentés d'utiliser simplement une instance de
    <?php class_link("Image")?>
    à chaque endroit où ils auront une instance de
    <?php class_link("Sprite")?>,
    car cela peut paraître le moyen le plus simple de dessiner quelque chose. Le fait est que c'est généralement une
    mauvaise idée. Le problème le plus évident survient lorsque l'on copie de tels objets (le simple fait de les
    placer dans un tableau peut générer des copies) : les sprites apparaîtront très probablement blancs. La raison est
    la suivante : un sprite ne fait que pointer vers une image, il n'en possède pas d'instance, ainsi lorsque
    l'image est copiée, le sprite doit être mis à jour afin de pointer vers la nouvelle copie de l'image. C'est très
    simple à gérer, vous devez juste définir correctement le constructeur par copie de telles classes possédant
    (ou dérivant de) un sprite et une image :
</p>
<pre><code class="cpp">class MyPicture
{
public :

    // Ceci est le constructeur par copie
    MyPicture(const MyPicture& Copy) : Image(Copy.Image), Sprite(Copy.Sprite)
    {
        // Voilà la feinte : nous paramétrons le sprite afin qu'il
        // utilise notre image, plutôt que celle de Copy
        Sprite.SetImage(Image);
    }

    // ... d'autres fonctions diverses ...

private :

    sf::Image  Image;
    sf::Sprite Sprite;
};
</code></pre>
<p>
    Mais ceci est un cas plutôt particulier, et en général vous voudrez très probablement partager une même image
    pour plusieurs sprites. En fait, il ne devrait jamais exister plus d'une instance de
    <?php class_link("Image")?>
    par image que vous chargez (après tout, pourquoi avoir le même tableau de pixels plusieurs fois en mémoire ?).
    C'est la raison pour laquelle les concepts de sprites et d'images ont été séparés dans la SFML : les images
    sont lourdes et coûteuses, alors que les sprites sont légers à manipuler, ils ne sont qu'une représentation
    visuelle particulière d'une image.
</p>
<p>
    Il existe de nombreuses implémentations qui peuvent s'occuper de la gestion correcte des images. Par exemple, si vous
    écrivez une classe dont toutes les instances vont utiliser la même image, alors vous pouvez simplement faire ceci :
</p>
<pre><code class="cpp">class Missile
{
public :

    static bool Init(const std::string& ImageFile)
    {
        return Image.LoadFromFile(ImageFile);
    }

    Missile()
    {
        Sprite.SetImage(Image); // chaque sprite utilise la même et unique image
    }

private :

    static sf::Image Image; // partagée par toutes les instances

    sf::Sprite Sprite; // un pour chaque instance
};
</code></pre>
<p>
    Dans un moteur plus complet, les images seraient automatiquement distribuées par un gestionnaire. C'est un moyen
    plus générique et facile de gérer les ressources. L'idée est de faire en sorte que le gestionnaire stocke les
    images, en les associant à leur nom de fichier (ou n'importe quel autre identificateur unique), de sorte que si
    une même image est demandée plusieurs fois, le gestionnaire renverra en fait toujours la même instance.
</p>
<pre><code class="cpp">sf::Sprite Sprite;

// GetImage renverra toujours la même instance pour un même nom de fichier
Sprite.SetImage(ImageManager.GetImage("data/missile.png"));
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Le sprite est un concept de base dans une API 2D, et comme vous l'avez vu ils sont très faciles à
    utiliser dans la SFML. Si vous souhaitez maintenant savoir comment dessiner des formes simples avec SFML,
    rendez-vous au prochain tutoriel concernant
    <a class="internal" href="./graphics-shape-fr.php" title="Aller au tutoriel suivant">les formes</a>.
</p>

<?php

    require("footer-fr.php");

?>
