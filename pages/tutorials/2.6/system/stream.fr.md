# Les flux de données (_input streams_)

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

SFML possède de nombreuses classes de ressources : images, polices, sons, etc. Dans la plupart des programmes, ces ressources vont être chargées depuis des fichiers, à l'aide de leur fonction `loadFromFile`. Dans quelques autres cas, les ressources seront directement intégrées à l'exécutable ou bien dans un gros fichier de données, et chargées depuis la mémoire avec `loadFromMemory`. Ces fonctions couvrent _pratiquement_ toutes les situations imaginables -- mais pas toutes.

Parfois vous avez besoin de charger des fichiers depuis des endroits inhabituels, tels qu'une archive compressée/chiffrée, ou un emplacement réseau distant par exemple. Pour ces situations spéciales, SFML fournit une troisième fonction de chargement : `loadFromStream`. Cette fonction lit les données depuis une classe abstraite [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation"), qui vous permet de définir vos propres implémentations.

Dans ce tutoriel, vous apprendrez à écrire et utiliser votre propre flux de données.

## [Et les flux standards ?](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#et-les-flux-standards)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

Comme beaucoup d'autres langages, le C++ possède déjà une classe pour les flux de données (entrant) : `std::istream`. En fait il en possède deux : `std::istream` n'est que la façade, l'interface abstraite vers les données est `std::streambuf`.

Malheureusement, ces classes ne sont pas très accessibles et peuvent devenir carrément compliquées à gérer si vous voulez implémenter des comportements non triviaux. La bibliothèque [Boost.Iostreams](http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html "Boost.Iostreams") tente de fournir une interface plus accessible pour les flux standards, mais Boost est une grosse dépendance et SFML ne peut pas en dépendre.

C'est pourquoi SFML fournit sa propre interface de flux de données, qui est je l'espère beaucoup plus _simple and fast_.

## [InputStream](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#inputstream)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

La classe [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation") déclare quatre fonctions virtuelles :

```
class InputStream
{
public :

    virtual ~InputStream() {}

    virtual Int64 read(void* data, Int64 size) = 0;

    virtual Int64 seek(Int64 position) = 0;

    virtual Int64 tell() = 0;

    virtual Int64 getSize() = 0;
};
```

**read** doit extraire _size_ octets de données du flux, et les copier vers l'adresse _data_ qui est fournie ; elle renvoie le nombre d'octets lus, ou -1 si une erreur s'est produite.

**seek** doit changer la position de lecture courante dans le flux ; le paramètre _position_ est la nouvelle position absolue en octets (elle est donc relative au début des données, pas à la position courante) ; elle renvoie la nouvelle position, ou -1 si une erreur s'est produite.

**tell** doit renvoyer la position de lecture actuelle (en octets) dans le flux, ou -1 si une erreur s'est produite.

**getSize** doit renvoyer la taille totale (en octets) des données contenues dans le flux, ou -1 si une erreur s'est produite.

Pour créer un nouveau flux fonctionnel, vous devez implémenter ces quatre fonctions en respectant leur définition.

## [FileInputStream et MemoryInputStream](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#fileinputstream-et-memoryinputstream)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

Dès SFML 2.3, deux nouvelles classes ont été créées pour supporter les flux de données pour le nouveau gestionnaire audio interne. Tandis que `sf::FileInputStream` s'occupe de fournir les données en lecture seule à partir d'un fichier, `sf::MemoryInputStream` sert de flux directement depuis la mémoire, aussi en lecture seule. Tous deux héritent de `sf::InputStream` et ainsi peuvent être utilisé de manière polymorphique.

## [Utilisation du flux](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#utilisation-du-flux)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

Utiliser une classe de flux est très simple : instanciez-la, et passez-la à la fonction `loadFromStream` (ou `openFromStream`) de l'objet que vous voulez charger.

```
sf::FileInputStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
```

## [Un exemple](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#un-exemple)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

Si vous avez besoin d'une démonstration qui vous aide à comprendre comment le code fonctionne sans se perdre dans des détails d'implémentation, vous pouvez jeter un oeil à l'implémentation de `sf::FileInputStream` ou de `sf::MemoryInputStream`.

N'oubliez pas de visiter le forum et le wiki. Il est bien possible que d'autres utilisateurs aient déjà écrit une classe héritant de [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation") qui convienne à vos besoins. Et si vous en écrivez une nouvelle et pensez qu'elle puisse être utile à d'autres personnes, n'hésitez pas à la partager !

## [Les erreurs à éviter](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#les-erreurs-ce-ceviter)[](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php#top "Haut de la page")

Certaines classes de ressources ne sont pas chargées complètement après que `loadFromStream` a été appelé. Au lieu de cela, elles continuent à utiliser leur source de données aussi longtemps qu'elles sont utilisées. C'est le cas pour [`sf::Music`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Music.php "sf::Music documentation"), qui lit les échantillons audio au fur et à mesure qu'ils sont joués, et pour [`sf::Font`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Font.php "sf::Font documentation"), qui charge les glyphes à la volée en fonction du contenu des textes.

En conséquence, le flux qui est utilisé pour charger une musique ou une police, ainsi que sa source de données, doit rester en vie aussi longtemps que la ressource l'utilise. S'il est détruit alors qu'il est toujours utilisé, le comportement sera indéterminé (cela pourra causer un plantage, une corruption de données, ou rien de visible).

Une autre erreur courante est de renvoyer directement ce que les fonctions utilisées dans le flux renvoient, mais parfois cela ne correspond pas à ce que SFML attend. Par exemple, dans l'exemple FileStream ci-dessus, on pourrait être tenté d'écrire la fonction `seek` comme ceci :

```
sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}
```

Et ce serait faux, car `std::fseek` renvoie zéro si elle réussit, alors que SFML attend plutôt la nouvelle position.