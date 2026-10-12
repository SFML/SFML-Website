# Les flux de données (*input streams*)

!!! warning ""

    Vous lisez le tutoriel pour SFML 2.0. Consultez la [dernière version de ce tutoriel](/fr/tutorials/latest/system/stream/).

## Introduction

SFML possède de nombreuses classes de ressources : images, polices, sons, etc. Dans la plupart des programmes, ces ressources vont être chargées depuis des fichiers, à l'aide de leur fonction `loadFromFile`. Dans quelques autres cas, les ressources seront directement intégrées à l'exécutable ou bien dans un gros fichier de données, et chargées depuis la mémoire avec `loadFromMemory`. Ces fonctions couvrent *pratiquement* toutes les situations imaginables -- mais pas toutes.

Parfois vous avez besoin de charger des fichiers depuis des endroits inhabituels, tels qu'une archive compressée/chiffrée, ou un emplacement réseau distant par exemple. Pour ces situations spéciales, SFML fournit une troisième fonction de chargement : `loadFromStream`. Cette fonction lit les données depuis une classe abstraite [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation"), qui vous permet de définir vos propres implémentations.

Dans ce tutoriel, vous apprendrez à écrire et utiliser votre propre flux de données.

## Et les flux standards ?

Comme beaucoup d'autres langages, le C++ possède déjà une classe pour les flux de données (entrant) : `std::istream`. En fait il en possède deux : `std::istream` n'est que la façade, l'interface abstraite vers les données est `std::streambuf`.

Malheureusement, ces classes ne sont pas très accessibles et peuvent devenir carrément compliquées à gérer si vous voulez implémenter des comportements non triviaux. La bibliothèque [Boost.Iostreams](http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html "Boost.Iostreams") tente de fournir une interface plus accessible pour les flux standards, mais Boost est une grosse dépendance et SFML ne peut pas en dépendre.

C'est pourquoi SFML fournit sa propre interface de flux de données, qui est je l'espère beaucoup plus *simple and fast*.

## InputStream

La classe [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation") déclare quatre fonctions virtuelles :

```cpp
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

**read** doit extraire *size* octets de données du flux, et les copier vers l'adresse *data* qui est fournie ; elle renvoie le nombre d'octets lus, ou -1 si une erreur s'est produite.

**seek** doit changer la position de lecture courante dans le flux ; le paramètre *position* est la nouvelle position absolue en octets (elle est donc relative au début des données, pas à la position courante) ; elle renvoie la nouvelle position, ou -1 si une erreur s'est produite.

**tell** doit renvoyer la position de lecture actuelle (en octets) dans le flux, ou -1 si une erreur s'est produite.

**getSize** doit renvoyer la taille totale (en octets) des données contenues dans le flux, ou -1 si une erreur s'est produite.

Pour créer un nouveau flux fonctionnel, vous devez implémenter ces quatres fonctions en respectant leur définition.

## Un exemple

Voici un exemple d'une implémentation complète et fonctionnelle d'un flux de données perso. Celui-ci n'est pas très utile : nous allons écrire un flux qui lit ses données depuis un fichier, `FileStream`. Mais il est suffisamment simple pour que vous puissiez vous concentrer sur la manière dont fonctionne le code, et ne pas vous perdre dans les détails d'implémentation.

Tout d'abord, voyons la déclaration de la classe :

```cpp
#include <SFML/System.hpp>
#include <string>
#include <cstdio>

class FileStream : public sf::InputStream
{
public :

    FileStream();

    ~FileStream();

    bool open(const std::string& filename);

    virtual sf::Int64 read(void* data, sf::Int64 size);

    virtual sf::Int64 seek(sf::Int64 position);

    virtual sf::Int64 tell();

    virtual sf::Int64 getSize();

private :

    std::FILE* m_file;
};
```

Dans cet exemple nous allons utiliser la bonne vieille API C des fichiers, nous avons donc un membre `std::FILE*`. Nous avons aussi un constructeur par défaut, un destructeur, et une fonction pour ouvrir le fichier.

Voici l'implémentation :

```cpp
FileStream::FileStream() :
m_file(NULL)
{
}

FileStream::~FileStream()
{
    if (m_file)
        std::fclose(m_file);
}

bool FileStream::open(const std::string& filename)
{
    if (m_file)
        std::fclose(m_file);

    m_file = std::fopen(filename.c_str(), "rb");

    return m_file != NULL;
}

sf::Int64 FileStream::read(void* data, sf::Int64 size)
{
    if (m_file)
        return std::fread(data, 1, static_cast<std::size_t>(size), m_file);
    else
        return -1;
}

sf::Int64 FileStream::seek(sf::Int64 position)
{
    if (m_file)
    {
        std::fseek(m_file, static_cast<std::size_t>(position), SEEK_SET);
        return tell();
    }
    else
    {
        return -1;
    }
}

sf::Int64 FileStream::tell()
{
    if (m_file)
        return std::ftell(m_file);
    else
        return -1;
}

sf::Int64 FileStream::getSize()
{
    if (m_file)
    {
        sf::Int64 position = tell();
        std::fseek(m_file, 0, SEEK_END);
        sf::Int64 size = tell();
        seek(position);
        return size;
    }
    else
    {
        return -1;
    }
}
```

Notez que, comme expliqué ci-dessus, toutes les fonctions renvoient -1 si une erreur s'est produite.

N'oubliez pas de consulter le forum et le wiki, il y a de fortes chances pour qu'un autre utilisateur ait déjà écrit un [`sf::InputStream`](https://www.sfml-dev.org/documentation/2.0-fr/classsf_1_1InputStream.php "sf::InputStream documentation") qui corresponde à ce que vous cherchez à faire. Et si vous écrivez une nouvelle implémentation et pensez qu'elle pourrait être utile en dehors de votre projet, n'hésitez pas à la partager !

## Utilisation du flux

Utiliser une classe de flux est très simple : instanciez-la, et passez-la à la fonction `loadFromStream` (ou `openFromStream`) de l'objet que vous voulez charger.

```cpp
FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
```

## Les erreurs à éviter

Certaines classes de ressources ne sont pas chargées complètement après que `loadFromStream` ait été appelé. Au lieu de cela, elles continuent à utiliser leur source de données aussi longtemps qu'elles sont utilisées. C'est le cas pour [`sf::Music`](https://www.sfml-dev.org/documentation/2.0-fr/classsf_1_1Music.php "sf::Music documentation"), qui lit les échantillons audio au fur et à mesure qu'ils sont joués, et pour [`sf::Font`](https://www.sfml-dev.org/documentation/2.0-fr/classsf_1_1Font.php "sf::Font documentation"), qui charge les glyphes à la volée en fonction du contenu des textes.

En conséquence, le flux qui est utilisé pour charger une musique ou une police, ainsi que sa source de données, doit rester en vie aussi longtemps que la ressource l'utilise. S'il est détruit alors qu'il est toujours utilisé, le comportement sera indéterminé (cela pourra causer un plantage, une corruption de données, ou rien de visible).

Une autre erreur courante est de renvoyer directement ce que les fonctions utilisées dans le flux renvoient, mais parfois cela ne correspond pas à ce que SFML attend. Par exemple, dans l'exemple FileStream ci-dessus, on pourrait être tenté d'écrire la fonction `seek` comme ceci :

```cpp
sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}
```

Et ce serait faux, car `std::fseek` renvoie zéro si elle réussit, alors que SFML attend plutôt la nouvelle position.
