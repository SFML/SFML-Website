<?php

    $title = "Texte et polices";
    $page = "graphics-text-fr.php";

    require("header-fr.php");

?>

<h1>Texte et polices</h1>

<?php h2('Charger une police') ?>
<p>
    Avant de dessiner du texte, vous avez besoin d'une police de caractères -- tout comme n'importe quel autre programme qui affiche du texte. Les polices sont encapsulées
    dans la classe <?php class_link('Font') ?>, qui fournit trois fonctionnalités principales : charger une police, récupérer ses glyphes (i.e. les caractères graphiques),
    et lire ses divers attributs. Il est très probable que la plupart du temps vous n'ayiez qu'à vous préoccuper de la première, à savoir charger des polices. C'est donc par
    celle-ci que nous allons commencer.
</p>
<p>
    La façon la plus commune de charger une police est depuis un fichier sur le disque dur, ce qui est fait avec la fonction <code>loadFromFile</code>.
</p>
<pre><code class="cpp">sf::Font font;
if (!font.loadFromFile("arial.ttf"))
{
    // erreur...
}
</code></pre>
<p>
    Notez que SFML est incapable de charger les polices de votre système automatiquement, en d'autres termes <code>font.loadFromFile("Courier New")</code> ne fonctionnera pas.
    Premièrement parce que SFML demande un <em>nom de fichier</em>, pas un nom de police, et deuxièmement parce que SFML n'a aucun accès magique au répertoire de polices
    de votre OS. Ainsi, si vous voulez charger une police de caractères dans votre programme SFML, vous devez avoir son fichier (.ttf ou autre) dans votre application,
    comme n'importe quelle autre ressource (images, sons, ...).
</p>
<p class="important">
    La fonction <code>loadFromFile</code> échoue parfois sans raison apparente. Première chose à faire, vérifiez le message d'erreur affiché par SFML dans la sortie
    standard (la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>répertoire de travail</em> (qui est le répertoire relativement auquel
    tout fichier sera interprété) est celui auquel vous vous attendez : lorsque vous lancez votre application depuis l'explorateur de fichiers, le répertoire de travail
    est le répertoire de l'exécutable, pas de problème généralement dans ce cas ; mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...)
    alors le répertoire de travail est parfois le répertoire du <em>projet</em>. Pas de panique : cela peut normalement être modifié directement dans les options de
    votre projet.
</p>
<p>
    Vous pouvez aussi charger un fichier de police depuis la mémoire (<code>loadFromMemory</code>), ou depuis un
    <a href="./system-stream-fr.php" title="Tutoriel sur les flux d'entrée">flux d'entrée</a> (<code>loadFromStream</code>).
</p>
<p>
    SFML supporte les formats de police les plus communs. La liste complète est disponible dans la documentation de l'API.
</p>
<p>
    Voilà. Une fois votre police chargée, vous pouvez commencer à dessiner du texte.
</p>

<?php h2('Dessiner du texte') ?>
<p>
    Pour dessiner du texte, il faut utiliser la classe <?php class_link('Text') ?>. Elle est très simple à utiliser :
</p>
<pre><code class="cpp">sf::Text text;

// choix de la police à utiliser
text.setFont(font); // font est un sf::Font

// choix de la chaîne de caractères à afficher
text.setString("Hello world");

// choix de la taille des caractères
text.setCharacterSize(24); // exprimée en pixels, pas en points !

// choix de la couleur du texte
text.setFillColor(sf::Color::Red);

// choix du style du texte
text.setStyle(sf::Text::Bold | sf::Text::Underlined);

...

// puis, dans la boucle de dessin, entre window.clear() et window.display()
window.draw(text);
</code></pre>
<img class="screenshot" src="./images/graphics-text-draw.png" title="Dessiner du texte" />
<p>
    Les textes peuvent aussi être transformés : ils ont une position, une orientation et une échelle. Les fonctions impliquées sont les mêmes que pour la classe
    <?php class_link('Sprite') ?> ainsi que les autres entités SFML, et sont détaillées dans le tutoriel
    <a href="./graphics-transform-fr.php" title="Tutoriel 'Transformer des entités'">Transformer des entités</a>.
</p>

<?php h2('Comment éviter les embrouilles avec les caractères non-ASCII ?') ?>
<p>
    Gérer les caractères non-ASCII correctement (tels que les caractères européens accentués, arabes, ou encore chinois) peut poser beaucoup de problèmes si on ne s'y
    prend pas bien dès le départ. Cela requiert une bonne connaissance des différents encodages utilisés dans le processus d'interprétation et de dessin du texte. Afin
    de ne pas s'encombrer avec ces considérations, il existe une solution très simple : les <em>chaînes littérales larges</em> (<em>wide strings</em>).
</p>
<pre><code class="cpp">text.setString(L"éèàç");
</code></pre>
<p>
    Oui, c'est ce petit "L" devant la chaîne qui fait tout fonctionner sans encombre, en disant au compilateur de produire directement une chaîne "large". La chaîne large
    est une bestiole assez étrange en C++ : le standard ne mentionne ni sa taille (16 bits ? 32 bits ?) ni l'encodage qu'elle utilise (UTF-16 ? UTF-32 ?). Cependant,
    nous savons que sur la plupart des plateformes, sinon toutes, elles vont produire des chaînes Unicode, et SFML sait parfaitement les gérer correctement.
</p>
<p>
    Notez que le standard C++11 supporte des nouveaux préfixes et types de caractères, pour produire des chaînes littérales UTF-8, UTF-16 et UTF-32, mais SFML ne les
    supporte pas encore.
</p>
<p>
    Cela peut paraître évident, mais il est toujours bon de le rappeler : une police doit bien entendu contenir les caractères que vous lui faites afficher. En effet,
    les polices de caractères ne peuvent pas définir tous les caractères possibles (il y en a plus de 100000 dans le standard Unicode !), et une police arabe ne pourra
    pas afficher de caractères japonais, par exemple.
</p>

<?php h2('Fabriquer sa propre classe de texte') ?>
<p>
    Si <?php class_link('Text') ?> est trop limitée, ou si vous voulez faire autre chose avec les glyphes pré-rendus, <?php class_link('Font') ?> fournit tout
    ce qu'il vous faut pour exploiter la police autrement.
</p>
<p>
    Premièrement, vous devez récupérer la texture qui contient tous les glyphes pré-rendus pour une taille donnée de caractère :
</p>
<pre><code class="cpp">const sf::Texture&amp; texture = font.getTexture(characterSize);
</code></pre>
<p>
    Notez que les glyphes sont ajoutés à la texture à la demande. Il existe tant de caractères (souvenez-vous, plus de 100000) qu'il est impossible de tous les
    pré-générer lorsqu'une police est chargée. Au lieu de cela, ils sont rendus à la volée lorsque la fonction <code>getGlyph</code> est appelée (voir ci-dessous).
</p>
<p>
    Pour faire quelque chose d'utile avec la texture des glyphes, il faut ensuite récupérer les coordonnées de textures des glyphes qu'elle contient :
</p>
<pre><code class="cpp">sf::Glyph glyph = font.getGlyph(character, characterSize, bold);
</code></pre>
<p>
    <code>character</code> est le code UTF-32 du glyphe que vous voulez récupérer. Vous devez aussi spécifier la taille de caractère, et en dernier paramètre, si vous
    voulez la version grasse ou normale du glyphe.
</p>
<p>
    La structure <?php class_link('Glyph') ?> contient trois membres :
</p>
<ul>
    <li><code>textureRect</code> contient les coordonnées de textures du glyphe dans la texture</li>
    <li><code>bounds</code> est le rectangle englobant du glyphe, qui est à le positionner relativement à la ligne de base du texte</li>
    <li><code>advance</code> est le décalage horizontal à appliquer pour obtenir la position de départ du glyphe suivant dans le texte</li>
</ul>
<p>
    Enfin, vous pouvez récupérer d'autres informations à propos de la police, telles que l'espacement entre les lignes ou le crénage (<em>kerning</em>), pour une taille
    de caractère donnée :
</p>
<pre><code class="cpp">int lineSpacing = font.getLineSpacing(characterSize);

int kerning = font.getKerning(character1, character2, characterSize);
</code></pre>

<?php

    require("footer-fr.php");

?>
