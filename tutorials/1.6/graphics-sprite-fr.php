<?php

    $title = "Afficher un sprite";
    $page = "graphics-sprite-fr.php";

    require("header-fr.php");
?>

<h1>Afficher un sprite</h1>

<?php h2('Introduction') ?>
<p>
    Afficher des sprites est sans doute la partie la plus importante d'une API 2D. Parce que, basiquement,
    tout est un sprite. Regardons � quoi ils ressemblent dans la SFML.
</p>

<?php h2('Charger une image') ?>
<p>
    Habituellement, les sprites sont charg�s � partir de fichiers sur le disque dur. Pour charger une image
    � partir d'un fichier avec la SFML, vous devez utiliser la classe <?php class_link("Image")?>
    et sa fonction <code>LoadFromFile</code> :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromFile("sprite.tga"))
{
    // Erreur...
}
</code></pre>
<p>
    Vous pouvez tout aussi bien charger un fichier se trouvant directement en m�moire,
    � l'aide de la fonction <code>LoadFromMemory</code> :
</p>
<pre><code class="cpp">sf::Image Image;
if (!Image.LoadFromMemory(FilePtr, Size))
{
    // Erreur...
}
</code></pre>
<p>
    Les images peuvent �galement �tre cr��es et remplies avec une couleur, ou charg�es depuis la m�moire :
</p>
<pre><code class="cpp">sf::Image Image1(200, 200, sf::Color(0, 255, 0));
sf::Image Image2(200, 200, PointerToPixelsInMemory);

// Ou, si vous voulez le faire apr�s la construction :

Image1.Create(200, 200, sf::Color(0, 255, 0));
Image2.LoadFromPixels(200, 200, PointerToPixelsInMemory);
</code></pre>
<p>
    Notez bien que lorsque vous chargez une image � partir d'un tableau de pixels en m�moire, ces pixels
    doivent �tre au format 32-bits RGBA.
</p>
<p>
    Vous pouvez aussi acc�der aux pixels de l'image en lecture et en �criture :
</p>
<pre><code class="cpp">sf::Color Color = Image.GetPixel(10, 20);
Image.SetPixel(20, 30, Color);
</code></pre>
<p>
    Soyez vigilants lorsque vous manipulez des images : elles peuvent �tre copi�es, mais ce n'est pas une op�ration
    l�g�re. Donc essayer d'�viter les copies dans la mesure du possible (passez vos images par r�f�rence lorsque vous le
    pouvez, par exemple).
</p>

<?php h2('Cr�er un sprite') ?>
<p>
    Ok, nous pouvons maintenant cr�er / charger / modifier une image. Mais ce n'est pas un sprite.
    Dans la SFML, images et sprites sont s�par�s en deux classes distinctes. Vous pouvez voir les images
    comme des tableaux de pixels en m�moire, et les sprites comme un moyen d'afficher ces tableaux de
    pixels dans une fen�tre. Manipuler les images en dehors de l'interface des sprites a deux
    avantages principaux :
</p>
<ul>
    <li>Cela vous permet d'utiliser une m�me image pour plusieurs sprites, sans dupliquer les pixels
    en m�moire, et sans avoir � �crire un gestionnaire d'images</li>
    <li>Parfois vous ne voulez pas manipuler les images en tant que sprites. Par exemple vous voulez
    pouvoir charger des images, leur appliquer un certain effet, puis les sauvegarder dans des fichiers</li>
</ul>
<p>
    Revenons aux sprites. Dans la SFML, un sprite est une instance de la classe
    <?php class_link("Sprite")?>.
    Cette classe d�rive de <?php class_link("Drawable")?>,
    qui est la base de tout objet affichable (sprites, cha�nes de caract�res, post-fx, ...).
    <?php class_link("Drawable")?>
    d�finit tout un tas de fonctions pour changer / r�cup�rer l'apparence de l'objet affichable. Voici un exemple avec
    un sprite, mais ces fonctions sont communes � tous les objets affichables, donc ne les oubliez pas.
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
    Notez que toutes les fonctions prenant deux floats en param�tre, peuvent �galement prendre une instance de
    <?php class_link("Vector2f", "Vector2")?>.
    Les fonctions GetXxx correspondant aux SetXxx prenant un vecteur, renvoient �galement un
    <?php class_link("Vector2f", "Vector2")?>.
</p>
<p>
    Vous pouvez bien s�r changer ces valeurs � n'importe quel moment de l'ex�cution, les sprites
    sont compl�tement dynamiques.
</p>
<p>
    Le centre de l'objet, d�fini par la fonction <code>SetCenter</code>, est d�fini relativement au coin haut-gauche
    de l'objet et repr�sente son centre de translation, de rotation et de mise � l'�chelle. En gros, il s'agit
    de l'origine de l'objet, qui va rester fixe lorsque vous appliquerez des transformations g�ometriques � celui-ci.
</p>
<p>
    Remarquez que la couleur a une composante alpha � 128, ce qui signifie que notre sprite sera
    un peu transparent. Si vous vous demandez pourquoi la position du sprite est exprim�e avec des
    variables flottantes alors que les pixels sont en coordonn�es enti�res, c'est simplement pour
    plus de flexibilit�. En effet lorsque vous bougez un sprite, ce ne sera pas toujours d'une quantit�
    enti�re de pixels, mais plut�t d'une tr�s faible valeur. Ceci �vite donc que vous ayiez
    � g�rer une variable suppl�mentaire juste pour avoir les coordonn�es du sprite en nombre flottant.
    Une autre raison est que lorsque vous utilisez des vues, les coordonn�es de la "sc�ne" n'ont
    potentiellement plus rien � voir avec les pixels de l'�cran ; mais gardons �a pour le prochain
    tutoriel.
</p>
<p>
    Il n'y a pas grand chose � dire sur les autres variables, except� que la rotation est un angle
    exprim� en degr�s.
</p>
<p>
    Une fois que vous avez appliqu� toutes ces transformations � votre sprite, il peut devenir difficile d'obtenir le
    rectangle r�sultant, et de mani�re g�n�rale la position finale de tout point local. C'est pourquoi
    <?php class_link("Sprite")?> et toutes les classes d�riv�es de <?php class_link("Drawable")?> d�finissent
    deux fonctions de conversion :
</p>
<pre><code class="cpp">// Convertit un point local en coordonn�es globales
sf::Vector2f Global = Sprite.TransformToGlobal(sf::Vector2f(10, 25));

// Convertit un point global en coordonn�es locales
sf::Vector2f Local = Sprite.TransformToLocal(sf::Vector2f(425, 120));
</code></pre>
<p>
    Par dessus cela, <?php class_link("Sprite")?>
    fournit des fonctions plus sp�cifiques :
</p>
<pre><code class="cpp">// On change l'image (texture) source du sprite
sf::Image Image;
...
Sprite.SetImage(Image);

// On r�cup�re les dimensions du sprite
float Width  = Sprite.GetSize().x;
float Height = Sprite.GetSize().y;

// On redimensionne le sprite
Sprite.Resize(60, 100);

// Retourne le sprite sur les axes X et Y
Sprite.FlipX(true);
Sprite.FlipY(true);

// On r�cup�re la couleur d'un pixel donn� du sprite
sf::Color Pixel = Sprite.GetPixel(10, 5);
</code></pre>
<p>
    Nous pouvons ensuite facilement ajouter un peu d'interaction avec notre sprite :
</p>
<pre><code class="cpp">// R�cup�ration du temps �coul�
float ElapsedTime = App.GetFrameTime();

// On d�place le sprite
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
    Afficher un sprite dans une fen�tre de rendu est extr�mement simple :
</p>
<pre><code class="cpp">App.Draw(Sprite);
</code></pre>
<p>
    Aucun param�tre suppl�mentaire n'est n�cessaire, �tant donn� que le sprite conna�t d�j� tout ce qu'il
    faut savoir sur son apparence (sa position, sa couleur, ...).
</p>
<p>
    Si vous voulez dessiner uniquement une sous-portion de l'image originale, vous pouvez changer le
    param�tre <code>SubRect</code> du sprite :
</p>
<pre><code class="cpp">Sprite.SetSubRect(sf::IntRect(10, 10, 20, 20));
</code></pre>
<p>
    Ici nous n'afficherons qu'un sous-rectangle de l'image allant du pixel (10, 10) au pixel (20, 20).
</p>
<p>
    <?php class_link("IntRect", "Rect")?> est juste une classe utilitaire pour manipuler les rectangles.
    Pour les rectangles � coordonn�es flottantes, il y a �galement la classe <?php class_link("FloatRect", "Rect")?>
    (en fait elles sont toutes deux des instanciations de la classe template <?php class_link("Rect")?>).
</p>

<?php h2('Gestion des images et des sprites') ?>
<p>
    Vous devez �tre particuli�rement prudent lorsque vous manipulez des images. Une instance de
    <?php class_link("Image")?>
    est une ressource qui est lente � charger, lourde � copier et qui utilise beaucoup de m�moire.
</p>
<p>
    Beaucoup de gens, particuli�rement les d�butants, seront tent�s d'utiliser simplement une instance de
    <?php class_link("Image")?>
    � chaque endroit o� ils auront une instance de
    <?php class_link("Sprite")?>,
    car cela peut para�tre le moyen le plus simple de dessiner quelque chose. Le fait est que c'est g�n�ralement une
    mauvaise id�e. Le probl�me le plus �vident survient lorsque l'on copie de tels objets (le simple fait de les
    placer dans un tableau peut g�n�rer des copies) : les sprites appara�tront tr�s probablement blancs. La raison est
    la suivante : un sprite ne fait que pointer vers une image, il n'en poss�de pas d'instance, ainsi lorsque
    l'image est copi�e, le sprite doit �tre mis � jour afin de pointer vers la nouvelle copie de l'image. C'est tr�s
    simple � g�rer, vous devez juste d�finir correctement le constructeur par copie de telles classes poss�dant
    (ou d�rivant de) un sprite et une image :
</p>
<pre><code class="cpp">class MyPicture
{
public :

    // Ceci est le constructeur par copie
    MyPicture(const MyPicture& Copy) : Image(Copy.Image), Sprite(Copy.Sprite)
    {
        // Voil� la feinte : nous param�trons le sprite afin qu'il
        // utilise notre image, plut�t que celle de Copy
        Sprite.SetImage(Image);
    }

    // ... d'autres fonctions diverses ...

private :

    sf::Image  Image;
    sf::Sprite Sprite;
};
</code></pre>
<p>
    Mais ceci est un cas plut�t particulier, et en g�n�ral vous voudrez tr�s probablement partager une m�me image
    pour plusieurs sprites. En fait, il ne devrait jamais exister plus d'une instance de
    <?php class_link("Image")?>
    par image que vous chargez (apr�s tout, pourquoi avoir le m�me tableau de pixels plusieurs fois en m�moire ?).
    C'est la raison pour laquelle les concepts de sprites et d'images ont �t� s�par�s dans la SFML : les images
    sont lourdes et co�teuses, alors que les sprites sont l�gers � manipuler, ils ne sont qu'une repr�sentation
    visuelle particuli�re d'une image.
</p>
<p>
    Il existe de nombreuses impl�mentations qui peuvent s'occuper de la gestion correcte des images. Par exemple, si vous
    �crivez une classe dont toutes les instances vont utiliser la m�me image, alors vous pouvez simplement faire ceci :
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
        Sprite.SetImage(Image); // chaque sprite utilise la m�me et unique image
    }

private :

    static sf::Image Image; // partag�e par toutes les instances

    sf::Sprite Sprite; // un pour chaque instance
};
</code></pre>
<p>
    Dans un moteur plus complet, les images seraient automatiquement distribu�es par un gestionnaire. C'est un moyen
    plus g�n�rique et facile de g�rer les ressources. L'id�e est de faire en sorte que le gestionnaire stocke les
    images, en les associant � leur nom de fichier (ou n'importe quel autre identificateur unique), de sorte que si
    une m�me image est demand�e plusieurs fois, le gestionnaire renverra en fait toujours la m�me instance.
</p>
<pre><code class="cpp">sf::Sprite Sprite;

// GetImage renverra toujours la m�me instance pour un m�me nom de fichier
Sprite.SetImage(ImageManager.GetImage("data/missile.png"));
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Le sprite est un concept de base dans une API 2D, et comme vous l'avez vu ils sont tr�s faciles �
    utiliser dans la SFML. Si vous souhaitez maintenant savoir comment dessiner des formes simples avec SFML,
    rendez-vous au prochain tutoriel concernant
    <a class="internal" href="./graphics-shape-fr.php" title="Aller au tutoriel suivant">les formes</a>.
</p>

<?php

    require("footer-fr.php");

?>
