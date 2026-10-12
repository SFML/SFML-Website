# Afficher du texte

!!! warning ""

    Vous lisez le tutoriel pour SFML 1.6. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/graphics/text/).

## Introduction

Dans ce tutoriel, nous allons couvrir le rendu de texte à l'aide des classes [`sf::Font`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Font.php "sf::Font documentation") et [`sf::String`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1String.php "sf::String documentation").

## Charger une police

Avant d'afficher du texte, il faut tout d'abord une police de caractères pour écrire celui-ci. Une police, dans SFML, est définie par la classe [`sf::Font`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Font.php "sf::Font documentation"). Etant donné qu'il n'y a habituellement rien d'autre à faire avec une police que la charger et l'utiliser, cette classe ne définit en fait que deux fonctions importantes, `LoadFromFile` et `LoadFromMemory`.

```cpp
sf::Font MyFont;

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
```

Comme vous pouvez le voir, toutes deux renvoient `true` après un chargement réussi, et `false` si au contraire une erreur est survenue.

Vous pouvez également passer deux paramètres additionnels à ces fonctions : la taille des caractères, ainsi que le jeu de caractères à générer. Une taille de caractères plus élevée signifiera une qualité meilleure, mais soyez prudent car cela augmentera également la mémoire vidéo utilisée. La taille par défaut est 30.

Passer votre propre jeu de caractères peut être nécessaire si vous avez l'intention d'utiliser des caractères non-ASCII ; dans ce cas, passez simplement la liste des caractères que vous comptez utiliser. Vous pouvez passer n'importe quel type / encodage de chaîne, y compris des chaînes Unicode, ce qui signifie que vous pouvez tout aussi bien utiliser des caractères accentués européens, des caractères chinois ou encore arabes.  
Le jeu de caractères par défaut est défini comme étant tous les caractères affichables de ISO-8859-1. ISO-8859-1 est un jeu de caractères qui contient tous les caractères ASCII, plus la plupart des caractères européens accentués; et il se trouve également que ce jeu représente les 256 premiers caractères du standard Unicode. Ainsi, ce jeu de caractères par défaut devrait être suffisant pour une utilisation courante (anglais ou français par exemple).

Voici un exemple d'utilisation avec la taille et le jeu de caractères explicitement donnés :

```cpp
sf::Font   MyFont;
sf::Uint32 MyCharset[] = {0x4E16, 0x754C, 0x60A8, 0x597D, 0x0}; // un ensemble de caractères chinois
if (!MyFont.LoadFromFile("arial.ttf", 50, MyCharset))
{
    // Error...
}
```

[`sf::Font`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Font.php "sf::Font documentation") peut charger de nombreux types de fichiers de polices, des TTF standards aux PCF de X11. Vous pouvez vous référer à la [Page des fonctionnalités du projet FreeType](http://www.freetype.org/freetype2/index.html#features "Page des fonctionnalités de FreeType's") pour avoir la liste complète (il s'agit de la bibliothèque utilisée en interne par SFML).

[`sf::Font`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Font.php "sf::Font documentation") donne également accès aux glyphes pré-rendues (une glyphe est un caractère visuel), mais vous n'aurez pas besoin d'utiliser ces fonctions à moins que vous n'ayiez des besoins très spécifiques.

## Créer une chaîne

Pour créer une chaîne affichable à l'écran, vous devez créer une instance de le classe [`sf::String`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1String.php "sf::String documentation"). Une telle instance possède trois paramètres : le texte à afficher, la police de caractères utilisée, et la taille des caractères. Notez bien que [`sf::String`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1String.php "sf::String documentation") n'est pas une classe de chaînes de caractères dans le sens de `std::string`, c'est-à-dire qu'elle ne fournit aucune fonction ayant un rapport avec la manipulation de la chaîne en elle-même comme par exemple *find*, *append*, *substring*, etc. Elle focalise uniquement sur la partie graphique, et laisse la manipulation de la chaîne à `std::string` (ou n'importe quelle autre classe que vous préférez utiliser).

Donc, voici comme nous définirions une chaîne contenant le texte "Hello", utilisant la police "arial.ttf", et avec une taille de caractères de 50 :

```cpp
// Chargement de la police à partir d'un fichier
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
```

Vous pouvez également utiliser des chaînes de caractères larges, si vous comptez utiliser du texte unicode :

```cpp
Text.SetText(L"Voilà");
```

Tout autre type de chaîne SFML est également automatiquement accepté.

Une petite astuce : si vous voulez obtenir la meilleure qualité visuelle possible, essayer de charger vos polices avec une taille au moins aussi élevée que celle qu'utiliseront vos chaînes. Sinon, les caractères seront redimensionnés et pourront apparaître légèrement flous sur les contours. De la même manière, essayez d'utiliser des tailles faibles lorsque vous comptez afficher des textes très petits, sinon les caractères pourront une fois de plus être trop redimensionnés et dégrader la qualité visuelle globale.

Notez que vous pouvez en fait utiliser une chaîne sans avoir chargé une seule police : SFML fournit une police par défaut, qui est la police Arial avec une taille de caractères de 30.

```cpp
Text.SetFont(sf::Font::GetDefaultFont());
```

Les chaînes peuvent également utiliser différents styles : normal (par défaut), ou n'importe quelle combinaison de gras (*bold*), italique (*italic*) et souligné (*underlined*).

```cpp
sf::String Text = "I like donuts";
Text.SetStyle(sf::String::Bold | sf::String::Italic | sf::String::Underlined);
Text.SetStyle(sf::String::Regular);
```

## Afficher une chaîne

[`sf::String`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1String.php "sf::String documentation") est une classe affichable standard, ce qui signifie qu'elle hérite de [`sf::Drawable`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Drawable.php "sf::Drawable documentation") et reçoit tous des attributs et fonctions, tout comme [`sf::Sprite`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Sprite.php "sf::Sprite documentation").  
Ainsi vous pouvez modifier sa position, sa taille, son orientation, sa couleur, etc. :

```cpp
Text.SetColor(sf::Color(128, 128, 0));
Text.SetRotation(90.f);
Text.SetScale(2.f, 2.f);
Text.Move(100.f, 200.f);
```

Puis, pour afficher la chaîne dans une fenêtre donnée, vous n'avez qu'à utiliser la fonction `Draw` :

```cpp
sf::RenderWindow Window;
...
Window.Draw(Text);
```

## Et les positions des caractères dans tout ça ?

Au cas où vous auriez besoin de traiter avec les caractères d'une chaîne individuellement, comme par exemple pour afficher un curseur après le n-ème caractère, [`sf::String`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1String.php "sf::String documentation") fournit une fonction pour obtenir la position de n'importe quel caractère dans la chaîne.

```cpp
sf::Vector2f Position = Text.GetCharacterPos(4);
```

La position renvoyée est définie en coordonnées locales, vous aurez donc besoin d'appeler `TransformToGlobal` afin d'obtenir les coordonnées globales réelles du caractère.

## Gestion des polices et des chaînes

Vous devez être particulièrement prudent lorsque vous manipulez des polices de caractères. Une instance de [`sf::Font`](https://www.sfml-dev.org/documentation/1.6-fr/classsf_1_1Font.php "sf::Font documentation") est une ressource qui est lente à charger, lourde à copier et qui utilise beaucoup de mémoire.

Pour une bonne discussion à propos de la gestion des ressources, je vous renvoie au paragraphe **"Gestion des images et des sprites"** du [tutoriel sur les sprites](sprite.md "Tutoriel sur les sprites"), en remplaçant simplement le mot "Image" par "Police" et "Sprite" par "Chaîne".

## Conclusion

C'est tout ce qu'il y a à dire à propos des chaînes SFML. Vous pouvez maintenant afficher du texte avec différentes polices, tailles et styles, plus toutes les fonctionnalités graphiques des objets affichables de la SFML.  
Vous pouvez maintenant vous rendre au tutoriel suivant, qui vous montrera comment ajouter des [post-effects](postfx.md "Aller au tutoriel suivant") temps réel à vos graphiques.
