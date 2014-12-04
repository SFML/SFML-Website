<?php

    $title = "Afficher du texte";
    $page = "graphics-fonts-fr.php";

    require("header-fr.php");
?>

<h1>Afficher du texte</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons couvrir le rendu de texte à l'aide des classes <?php class_link("Font")?> et
    <?php class_link("String")?>.
</p>

<?php h2('Charger une police') ?>
<p>
    Avant d'afficher du texte, il faut tout d'abord une police de caractères pour écrire celui-ci.
    Une police, dans SFML, est définie par la classe
    <?php class_link("Font")?>.
    Etant donné qu'il n'y a habituellement rien d'autre à faire avec une police que la charger et l'utiliser,
    cette classe ne définit en fait que deux fonctions importantes, <code>LoadFromFile</code> et <code>LoadFromMemory</code>.
</p>
<pre><code class="cpp">sf::Font MyFont;

// Chargement à partir d'un fichier sur le disque
if (!MyFont.LoadFromFile("arial.ttf"))
{
    // Erreur...
}

// Chargement à partir d'un fichier en mémoire
if (!MyFont.LoadFromMemory(PointerToFileData, SizeOfFileData))
{
    // Erreur...
}
</code></pre>
<p>
    Comme vous pouvez le voir, toutes deux renvoient <code>true</code> après un chargement réussi, et <code>false</code>
    si au contraire une erreur est survenue.
</p>
<p>
    Vous pouvez également passer deux paramètres additionnels à ces fonctions : la taille des caractères, ainsi que
    le jeu de caractères à générer. Une taille de caractères plus élevée signifiera une qualité meilleure, mais soyez
    prudent car cela augmentera également la mémoire vidéo utilisée. La taille par défaut est 30.
</p>
<p>
    Passer votre propre jeu de caractères peut être nécessaire si vous avez l'intention d'utiliser des caractères
    non-ASCII ; dans ce cas, passez simplement la liste des caractères que vous comptez utiliser. Vous pouvez passer
    n'importe quel type / encodage de chaîne, y compris des chaînes Unicode, ce qui signifie que vous pouvez tout
    aussi bien utiliser des caractères accentués européens, des caractères chinois ou encore arabes.<br/>
    Le jeu de caractères par défaut est défini comme étant tous les caractères affichables de ISO-8859-1.
    ISO-8859-1 est un jeu de caractères qui contient tous les caractères ASCII, plus la plupart des caractères européens
    accentués; et il se trouve également que ce jeu représente les 256 premiers caractères du standard Unicode.
    Ainsi, ce jeu de caractères par défaut devrait être suffisant pour une utilisation courante (anglais ou français
    par exemple).
</p>
<p>
    Voici un exemple d'utilisation avec la taille et le jeu de caractères explicitement donnés :
</p>
<pre><code class="cpp">sf::Font   MyFont;
sf::Uint32 MyCharset[] = {0x4E16, 0x754C, 0x60A8, 0x597D, 0x0}; // un ensemble de caractères chinois
if (!MyFont.LoadFromFile("arial.ttf", 50, MyCharset))
{
    // Error...
}
</code></pre>
<p>
    <?php class_link("Font")?>
    peut charger de nombreux types de fichiers de polices, des TTF standards aux PCF de X11. Vous pouvez vous référer à la
    <a class="external" href="http://www.freetype.org/freetype2/index.html#features" title="Page des fonctionnalités de FreeType's">Page des fonctionnalités du projet FreeType</a>
    pour avoir la liste complète (il s'agit de la bibliothèque utilisée en interne par SFML).
</p>
<p>
    <?php class_link("Font")?> donne également accès aux glyphes pré-rendues (une glyphe est un caractère visuel), mais vous
    n'aurez pas besoin d'utiliser ces fonctions à moins que vous n'ayiez des besoins très spécifiques.
</p>

<?php h2('Créer une chaîne') ?>
<p>
    Pour créer une chaîne affichable à l'écran, vous devez créer une instance de le classe
    <?php class_link("String")?>. Une telle instance possède trois paramètres : le texte à afficher,
    la police de caractères utilisée, et la taille des caractères. Notez bien
    que <?php class_link("String")?> n'est pas une classe de chaînes de caractères dans le sens de <code>std::string</code>,
    c'est-à-dire qu'elle ne fournit aucune fonction ayant un rapport avec la manipulation de la chaîne en elle-même
    comme par exemple <em>find</em>, <em>append</em>, <em>substring</em>, etc. Elle focalise uniquement sur
    la partie graphique, et laisse la manipulation de la chaîne à <code>std::string</code> (ou n'importe quelle
    autre classe que vous préférez utiliser).
</p>
<p>
    Donc, voici comme nous définirions une chaîne contenant le texte "Hello", utilisant la police "arial.ttf", et
    avec une taille de caractères de 50 :
</p>
<pre><code class="cpp">// Chargement de la police à partir d'un fichier
sf::Font MyFont;
if (!MyFont.LoadFromFile("arial.ttf", 50))
{
    // Erreurr...
}

sf::String Text("Hello", MyFont, 50);

// Ou, si vous souhaitez le faire après la construction :

sf::String Text;
Text.SetText("Hello");
Text.SetFont(MyFont);
Text.SetSize(50);
</code></pre>
<p>
    Vous pouvez également utiliser des chaînes de caractères larges, si vous comptez utiliser du texte unicode :
</p>
<pre><code class="cpp">Text.SetText(L"Voilà");
</code></pre>
<p>
    Tout autre type de chaîne SFML est également automatiquement accepté.
</p>
<p>
    Une petite astuce : si vous voulez obtenir la meilleure qualité visuelle possible, essayer de charger vos polices
    avec une taille au moins aussi élevée que celle qu'utiliseront vos chaînes. Sinon, les caractères seront redimensionnés
    et pourront apparaître légèrement flous sur les contours. De la même manière, essayez d'utiliser des tailles faibles
    lorsque vous comptez afficher des textes très petits, sinon les caractères pourront une fois de plus être
    trop redimensionnés et dégrader la qualité visuelle globale.
</p>
<p>
    Notez que vous pouvez en fait utiliser une chaîne sans avoir chargé une seule police : SFML fournit une police
    par défaut, qui est la police Arial avec une taille de caractères de 30.
</p>
<pre><code class="cpp">Text.SetFont(sf::Font::GetDefaultFont());
</code></pre>
<p>
    Les chaînes peuvent également utiliser différents styles : normal (par défaut), ou n'importe quelle combinaison
    de gras (<em>bold</em>), italique (<em>italic</em>) et souligné (<em>underlined</em>).
</p>
<pre><code class="cpp">sf::String Text = "I like donuts";
Text.SetStyle(sf::String::Bold | sf::String::Italic | sf::String::Underlined);
Text.SetStyle(sf::String::Regular);
</code></pre>

<?php h2('Afficher une chaîne') ?>
<p>
    <?php class_link("String")?> est une classe affichable standard, ce qui signifie qu'elle hérite de <?php class_link("Drawable")?>
    et reçoit tous des attributs et fonctions, tout comme <?php class_link("Sprite")?>.<br/>
    Ainsi vous pouvez modifier sa position, sa taille, son orientation, sa couleur, etc. :
</p>
<pre><code class="cpp">Text.SetColor(sf::Color(128, 128, 0));
Text.SetRotation(90.f);
Text.SetScale(2.f, 2.f);
Text.Move(100.f, 200.f);
</code></pre>
<p>
    Puis, pour afficher la chaîne dans une fenêtre donnée, vous n'avez qu'à utiliser la fonction <code>Draw</code> :
</p>
<pre><code class="cpp">sf::RenderWindow Window;
...
Window.Draw(Text);
</code></pre>

<?php h2('Et les positions des caractères dans tout ça ?') ?>
<p>
    Au cas où vous auriez besoin de traiter avec les caractères d'une chaîne individuellement, comme par exemple pour
    afficher un curseur après le n-ème caractère, <?php class_link("String")?> fournit une fonction pour obtenir la position
    de n'importe quel caractère dans la chaîne.
</p>
<pre><code class="cpp">sf::Vector2f Position = Text.GetCharacterPos(4);
</code></pre>
<p>
    La position renvoyée est définie en coordonnées locales, vous aurez donc besoin d'appeler
    <code>TransformToGlobal</code> afin d'obtenir les coordonnées globales réelles du caractère.
</p>

<?php h2('Gestion des polices et des chaînes') ?>
<p>
    Vous devez être particulièrement prudent lorsque vous manipulez des polices de caractères. Une instance de
    <?php class_link("Font")?>
    est une ressource qui est lente à charger, lourde à copier et qui utilise beaucoup de mémoire.
</p>
<p>
    Pour une bonne discussion à propos de la gestion des ressources, je vous renvoie au paragraphe
    <strong>"Gestion des images et des sprites"</strong> du
    <a class="internal" href="./graphics-sprite-fr.php" title="Tutoriel sur les sprites">tutoriel sur les sprites</a>,
    en remplaçant simplement le mot "Image" par "Police" et "Sprite" par "Chaîne".
</p>

<?php h2('Conclusion') ?>
<p>
    C'est tout ce qu'il y a à dire à propos des chaînes SFML. Vous pouvez maintenant afficher du texte avec différentes
    polices, tailles et styles, plus toutes les fonctionnalités graphiques des objets affichables de la SFML.<br/>
    Vous pouvez maintenant vous rendre au tutoriel suivant, qui vous montrera comment ajouter des
    <a class="internal" href="./graphics-postfx-fr.php" title="Aller au tutoriel suivant">post-effects</a>
    temps réel à vos graphiques.
</p>

<?php

    require("footer-fr.php");

?>
