<?php

    $title = "Texte et polices";
    $page = "graphics-text-fr.php";

    require("header-fr.php");

?>

<h1>Texte et polices</h1>

<?php h2('Charger une police') ?>
<p>
    Avant de dessiner du texte, vous avez besoin d'une police de caract�res -- tout comme n'importe quel autre programme qui affiche du texte. Les polices sont encapsul�es
    dans la classe <?php class_link('Font') ?>, qui fournit trois fonctionnalit�s principales : charger une police, r�cup�rer ses glyphes (i.e. les caract�res graphiques),
    et lire ses divers attributs. Il est tr�s probable que la plupart du temps vous n'ayiez qu'� vous pr�occuper de la premi�re, � savoir charger des polices. C'est donc par
    celle-ci que nous allons commencer.
</p>
<p>
    La fa�on la plus commune de charger une police est depuis un fichier sur le disque dur, ce qui est fait avec la fonction <code>loadFromFile</code>.
</p>
<pre><code class="cpp">sf::Font font;
if (!font.loadFromFile("arial.ttf"))
{
    // erreur...
}
</code></pre>
<p>
    Notez que SFML est incapable de charger les polices de votre syst�me automatiquement, en d'autres termes <code>font.loadFromFile("Courier New")</code> ne fonctionnera pas.
    Premi�rement parce que SFML demande un <em>nom de fichier</em>, pas un nom de police, et deuxi�mement parce que SFML n'a aucun acc�s magique au r�pertoire de polices
    de votre OS. Ainsi, si vous voulez charger une police de caract�res dans votre programme SFML, vous devez avoir son fichier (.ttf ou autre) dans votre application,
    comme n'importe quelle autre ressource (images, sons, ...).
</p>
<p class="important">
    La fonction <code>loadFromFile</code> �choue parfois sans raison apparente. Premi�re chose � faire, v�rifiez le message d'erreur affich� par SFML dans la sortie
    standard (la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>r�pertoire de travail</em> (qui est le r�pertoire relativement auquel
    tout fichier sera interpr�t�) est celui auquel vous vous attendez : lorsque vous lancez votre application depuis l'explorateur de fichiers, le r�pertoire de travail
    est le r�pertoire de l'ex�cutable, pas de probl�me g�n�ralement dans ce cas ; mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...)
    alors le r�pertoire de travail est parfois le r�pertoire du <em>projet</em>. Pas de panique : cela peut normalement �tre modifi� directement dans les options de
    votre projet.
</p>
<p>
    Vous pouvez aussi charger un fichier de police depuis la m�moire (<code>loadFromMemory</code>), ou depuis un
    <a href="./system-stream-fr.php" title="Tutoriel sur les flux d'entr�e">flux d'entr�e</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supporte les formats de police les plus communs. La liste compl�te est disponible dans la documentation de l'API.
</p>
<p>
    Voil�. Une fois votre police charg�e, vous pouvez commencer � dessiner du texte.
</p>

<?php h2('Dessiner du texte') ?>
<p>
    Pour dessiner du texte, il faut utiliser la classe <?php class_link('Text') ?>. Elle est tr�s simple � utiliser :
</p>
<pre><code class="cpp">sf::Text text;

// choix de la police � utiliser
text.setFont(font); // font est un sf::Font

// choix de la cha�ne de caract�res � afficher
text.setString("Hello world");

// choix de la taille des caract�res
text.setCharacterSize(24); // exprim�e en pixels, pas en points !

// choix de la couleur du texte
text.setColor(sf::Color::Red);

// choix du style du texte
text.setStyle(sf::Text::Bold | sf::Text::Underlined);

...

// puis, dans la boucle de dessin, entre window.clear() et window.display()
window.draw(text);
</code></pre>
<img class="screenshot" src="./images/graphics-text-draw.png" title="Dessiner du texte" />
<p>
    Les textes peuvent aussi �tre transform�s : ils ont une position, une orientation et une �chelle. Les fonctions impliqu�es sont les m�mes que pour la classe
    <?php class_link('Sprite') ?> ainsi que les autres entit�s SFML, et sont d�taill�es dans le tutoriel
    <a href="./graphics-transform-fr.php" title="Tutoriel 'Transformer des entit�s'">Transformer des entit�s</a>.
</p>

<?php h2('Comment �viter les embrouilles avec les caract�res non-ASCII ?') ?>
<p>
    G�rer les caract�res non-ASCII correctement (tels que les caract�res europ�ens accentu�s, arabes, ou encore chinois) peut poser beaucoup de probl�mes si on ne s'y
    prend pas bien d�s le d�part. Cela requiert une bonne connaissance des diff�rents encodages utilis�s dans le processus d'interpr�tation et de dessin du texte. Afin
    de ne pas s'encombrer avec ces consid�rations, il existe une solution tr�s simple : les <em>cha�nes litt�rales larges</em> (<em>wide strings</em>).
</p>
<pre><code class="cpp">text.setString(L"����");
</code></pre>
<p>
    Oui, c'est ce petit "L" devant la cha�ne qui fait tout fonctionner sans encombre, en disant au compilateur de produire directement une cha�ne "large". La cha�ne large
    est une bestiole assez �trange en C++ : le standard ne mentionne ni sa taille (16 bits ? 32 bits ?) ni l'encodage qu'elle utilise (UTF-16 ? UTF-32 ?). Cependant,
    nous savons que sur la plupart des plateformes, sinon toutes, elles vont produire des cha�nes Unicode, et SFML sait parfaitement les g�rer correctement.
</p>
<p>
    Notez que le standard C++11 supporte des nouveaux pr�fixes et types de caract�res, pour produire des cha�nes litt�rales UTF-8, UTF-16 et UTF-32, mais SFML ne les
    supporte pas encore.
</p>
<p>
    Cela peut para�tre �vident, mais il est toujours bon de le rappeler : une police doit bien entendu contenir les caract�res que vous lui faites afficher. En effet,
    les polices de caract�res ne peuvent pas d�finir tous les caract�res possibles (il y en a plus de 100000 dans le standard Unicode !), et une police arabe ne pourra
    pas afficher de caract�res japonais, par exemple.
</p>

<?php h2('Fabriquer sa propre classe de texte') ?>
<p>
    Si <?php class_link('Text') ?> est trop limit�e, ou si vous voulez faire autre chose avec les glyphes pr�-rendus, <?php class_link('Font') ?> fournit tout
    ce qu'il vous faut pour exploiter la police autrement.
</p>
<p>
    Premi�rement, vous devez r�cup�rer la texture qui contient tous les glyphes pr�-rendus pour une taille donn�e de caract�re :
</p>
<pre><code class="cpp">const sf::Texture&amp; texture = font.getTexture(characterSize);
</code></pre>
<p>
    Notez que les glyphes sont ajout�s � la texture � la demande. Il existe tant de caract�res (souvenez-vous, plus de 100000) qu'il est impossible de tous les
    pr�-g�n�rer lorsqu'une police est charg�e. Au lieu de cela, ils sont rendus � la vol�e lorsque la fonction <code>getGlyph</code> est appel�e (voir ci-dessous).
</p>
<p>
    Pour faire quelque chose d'utile avec la texture des glyphes, il faut ensuite r�cup�rer les coordonn�es de textures des glyphes qu'elle contient :
</p>
<pre><code class="cpp">sf::Glyph glyph = font.getGlyph(character, characterSize, bold);
</code></pre>
<p>
    <code>character</code> est le code UTF-32 du glyphe que vous voulez r�cup�rer. Vous devez aussi sp�cifier la taille de caract�re, et en dernier param�tre, si vous
    voulez la version grasse ou normale du glyphe.
</p>
<p>
    La structure <?php class_link('Glyph') ?> contient trois membres :
</p>
<ul>
    <li><code>textureRect</code> contient les coordonn�es de textures du glyphe dans la texture</li>
    <li><code>bounds</code> est le rectangle englobant du glyphe, qui est � le positionner relativement � la ligne de base du texte</li>
    <li><code>advance</code> est le d�calage horizontal � appliquer pour obtenir la position de d�part du glyphe suivant dans le texte</li>
</ul>
<p>
    Enfin, vous pouvez r�cup�rer d'autres informations � propos de la police, telles que l'espacement entre les lignes ou le cr�nage (<em>kerning</em>), pour une taille
    de caract�re donn�e :
</p>
<pre><code class="cpp">int lineSpacing = font.getLineSpacing(characterSize);

int kerning = font.getKerning(character1, character2, characterSize);
</code></pre>

<?php

    require("footer-fr.php");

?>
