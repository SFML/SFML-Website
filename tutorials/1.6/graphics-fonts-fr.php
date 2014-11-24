<?php

    $title = "Afficher du texte";
    $page = "graphics-fonts-fr.php";

    require("header-fr.php");
?>

<h1>Afficher du texte</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons couvrir le rendu de texte � l'aide des classes <?php class_link("Font")?> et
    <?php class_link("String")?>.
</p>

<?php h2('Charger une police') ?>
<p>
    Avant d'afficher du texte, il faut tout d'abord une police de caract�res pour �crire celui-ci.
    Une police, dans SFML, est d�finie par la classe
    <?php class_link("Font")?>.
    Etant donn� qu'il n'y a habituellement rien d'autre � faire avec une police que la charger et l'utiliser,
    cette classe ne d�finit en fait que deux fonctions importantes, <code>LoadFromFile</code> et <code>LoadFromMemory</code>.
</p>
<pre><code class="cpp">sf::Font MyFont;

// Chargement � partir d'un fichier sur le disque
if (!MyFont.LoadFromFile("arial.ttf"))
{
    // Erreur...
}

// Chargement � partir d'un fichier en m�moire
if (!MyFont.LoadFromMemory(PointerToFileData, SizeOfFileData))
{
    // Erreur...
}
</code></pre>
<p>
    Comme vous pouvez le voir, toutes deux renvoient <code>true</code> apr�s un chargement r�ussi, et <code>false</code>
    si au contraire une erreur est survenue.
</p>
<p>
    Vous pouvez �galement passer deux param�tres additionnels � ces fonctions : la taille des caract�res, ainsi que
    le jeu de caract�res � g�n�rer. Une taille de caract�res plus �lev�e signifiera une qualit� meilleure, mais soyez
    prudent car cela augmentera �galement la m�moire vid�o utilis�e. La taille par d�faut est 30.
</p>
<p>
    Passer votre propre jeu de caract�res peut �tre n�cessaire si vous avez l'intention d'utiliser des caract�res
    non-ASCII ; dans ce cas, passez simplement la liste des caract�res que vous comptez utiliser. Vous pouvez passer
    n'importe quel type / encodage de cha�ne, y compris des cha�nes Unicode, ce qui signifie que vous pouvez tout
    aussi bien utiliser des caract�res accentu�s europ�ens, des caract�res chinois ou encore arabes.<br/>
    Le jeu de caract�res par d�faut est d�fini comme �tant tous les caract�res affichables de ISO-8859-1.
    ISO-8859-1 est un jeu de caract�res qui contient tous les caract�res ASCII, plus la plupart des caract�res europ�ens
    accentu�s; et il se trouve �galement que ce jeu repr�sente les 256 premiers caract�res du standard Unicode.
    Ainsi, ce jeu de caract�res par d�faut devrait �tre suffisant pour une utilisation courante (anglais ou fran�ais
    par exemple).
</p>
<p>
    Voici un exemple d'utilisation avec la taille et le jeu de caract�res explicitement donn�s :
</p>
<pre><code class="cpp">sf::Font   MyFont;
sf::Uint32 MyCharset[] = {0x4E16, 0x754C, 0x60A8, 0x597D, 0x0}; // un ensemble de caract�res chinois
if (!MyFont.LoadFromFile("arial.ttf", 50, MyCharset))
{
    // Error...
}
</code></pre>
<p>
    <?php class_link("Font")?>
    peut charger de nombreux types de fichiers de polices, des TTF standards aux PCF de X11. Vous pouvez vous r�f�rer � la
    <a class="external" href="http://www.freetype.org/freetype2/index.html#features" title="Page des fonctionnalit�s de FreeType's">Page des fonctionnalit�s du projet FreeType</a>
    pour avoir la liste compl�te (il s'agit de la biblioth�que utilis�e en interne par SFML).
</p>
<p>
    <?php class_link("Font")?> donne �galement acc�s aux glyphes pr�-rendues (une glyphe est un caract�re visuel), mais vous
    n'aurez pas besoin d'utiliser ces fonctions � moins que vous n'ayiez des besoins tr�s sp�cifiques.
</p>

<?php h2('Cr�er une cha�ne') ?>
<p>
    Pour cr�er une cha�ne affichable � l'�cran, vous devez cr�er une instance de le classe
    <?php class_link("String")?>. Une telle instance poss�de trois param�tres : le texte � afficher,
    la police de caract�res utilis�e, et la taille des caract�res. Notez bien
    que <?php class_link("String")?> n'est pas une classe de cha�nes de caract�res dans le sens de <code>std::string</code>,
    c'est-�-dire qu'elle ne fournit aucune fonction ayant un rapport avec la manipulation de la cha�ne en elle-m�me
    comme par exemple <em>find</em>, <em>append</em>, <em>substring</em>, etc. Elle focalise uniquement sur
    la partie graphique, et laisse la manipulation de la cha�ne � <code>std::string</code> (ou n'importe quelle
    autre classe que vous pr�f�rez utiliser).
</p>
<p>
    Donc, voici comme nous d�finirions une cha�ne contenant le texte "Hello", utilisant la police "arial.ttf", et
    avec une taille de caract�res de 50 :
</p>
<pre><code class="cpp">// Chargement de la police � partir d'un fichier
sf::Font MyFont;
if (!MyFont.LoadFromFile("arial.ttf", 50))
{
    // Erreurr...
}

sf::String Text("Hello", MyFont, 50);

// Ou, si vous souhaitez le faire apr�s la construction :

sf::String Text;
Text.SetText("Hello");
Text.SetFont(MyFont);
Text.SetSize(50);
</code></pre>
<p>
    Vous pouvez �galement utiliser des cha�nes de caract�res larges, si vous comptez utiliser du texte unicode :
</p>
<pre><code class="cpp">Text.SetText(L"Voil�");
</code></pre>
<p>
    Tout autre type de cha�ne SFML est �galement automatiquement accept�.
</p>
<p>
    Une petite astuce : si vous voulez obtenir la meilleure qualit� visuelle possible, essayer de charger vos polices
    avec une taille au moins aussi �lev�e que celle qu'utiliseront vos cha�nes. Sinon, les caract�res seront redimensionn�s
    et pourront appara�tre l�g�rement flous sur les contours. De la m�me mani�re, essayez d'utiliser des tailles faibles
    lorsque vous comptez afficher des textes tr�s petits, sinon les caract�res pourront une fois de plus �tre
    trop redimensionn�s et d�grader la qualit� visuelle globale.
</p>
<p>
    Notez que vous pouvez en fait utiliser une cha�ne sans avoir charg� une seule police : SFML fournit une police
    par d�faut, qui est la police Arial avec une taille de caract�res de 30.
</p>
<pre><code class="cpp">Text.SetFont(sf::Font::GetDefaultFont());
</code></pre>
<p>
    Les cha�nes peuvent �galement utiliser diff�rents styles : normal (par d�faut), ou n'importe quelle combinaison
    de gras (<em>bold</em>), italique (<em>italic</em>) et soulign� (<em>underlined</em>).
</p>
<pre><code class="cpp">sf::String Text = "I like donuts";
Text.SetStyle(sf::String::Bold | sf::String::Italic | sf::String::Underlined);
Text.SetStyle(sf::String::Regular);
</code></pre>

<?php h2('Afficher une cha�ne') ?>
<p>
    <?php class_link("String")?> est une classe affichable standard, ce qui signifie qu'elle h�rite de <?php class_link("Drawable")?>
    et re�oit tous des attributs et fonctions, tout comme <?php class_link("Sprite")?>.<br/>
    Ainsi vous pouvez modifier sa position, sa taille, son orientation, sa couleur, etc. :
</p>
<pre><code class="cpp">Text.SetColor(sf::Color(128, 128, 0));
Text.SetRotation(90.f);
Text.SetScale(2.f, 2.f);
Text.Move(100.f, 200.f);
</code></pre>
<p>
    Puis, pour afficher la cha�ne dans une fen�tre donn�e, vous n'avez qu'� utiliser la fonction <code>Draw</code> :
</p>
<pre><code class="cpp">sf::RenderWindow Window;
...
Window.Draw(Text);
</code></pre>

<?php h2('Et les positions des caract�res dans tout �a ?') ?>
<p>
    Au cas o� vous auriez besoin de traiter avec les caract�res d'une cha�ne individuellement, comme par exemple pour
    afficher un curseur apr�s le n-�me caract�re, <?php class_link("String")?> fournit une fonction pour obtenir la position
    de n'importe quel caract�re dans la cha�ne.
</p>
<pre><code class="cpp">sf::Vector2f Position = Text.GetCharacterPos(4);
</code></pre>
<p>
    La position renvoy�e est d�finie en coordonn�es locales, vous aurez donc besoin d'appeler
    <code>TransformToGlobal</code> afin d'obtenir les coordonn�es globales r�elles du caract�re.
</p>

<?php h2('Gestion des polices et des cha�nes') ?>
<p>
    Vous devez �tre particuli�rement prudent lorsque vous manipulez des polices de caract�res. Une instance de
    <?php class_link("Font")?>
    est une ressource qui est lente � charger, lourde � copier et qui utilise beaucoup de m�moire.
</p>
<p>
    Pour une bonne discussion � propos de la gestion des ressources, je vous renvoie au paragraphe
    <strong>"Gestion des images et des sprites"</strong> du
    <a class="internal" href="./graphics-sprite-fr.php" title="Tutoriel sur les sprites">tutoriel sur les sprites</a>,
    en rempla�ant simplement le mot "Image" par "Police" et "Sprite" par "Cha�ne".
</p>

<?php h2('Conclusion') ?>
<p>
    C'est tout ce qu'il y a � dire � propos des cha�nes SFML. Vous pouvez maintenant afficher du texte avec diff�rentes
    polices, tailles et styles, plus toutes les fonctionnalit�s graphiques des objets affichables de la SFML.<br/>
    Vous pouvez maintenant vous rendre au tutoriel suivant, qui vous montrera comment ajouter des
    <a class="internal" href="./graphics-postfx-fr.php" title="Aller au tutoriel suivant">post-effects</a>
    temps r�el � vos graphiques.
</p>

<?php

    require("footer-fr.php");

?>
