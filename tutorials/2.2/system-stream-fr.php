<?php

    $title = "Les flux de données (<em>input streams</em>)";
    $page = "system-stream-fr.php";

    require("header-fr.php");

?>

<h1>Les flux de données (<em>input streams</em>)</h1>

<?php h2('Introduction') ?>
<p>
    SFML possède de nombreuses classes de ressources : images, polices, sons, etc. Dans la plupart des programmes, ces ressources vont être chargées
    depuis des fichiers, à l'aide de leur fonction <code>loadFromFile</code>. Dans quelques autres cas, les ressources seront directement intégrées à
    l'exécutable ou bien dans un gros fichier de données, et chargées depuis la mémoire avec <code>loadFromMemory</code>. Ces fonctions couvrent
    <em>pratiquement</em> toutes les situations imaginables -- mais pas toutes.
</p>
<p>
    Parfois vous avez besoin de charger des fichiers depuis des endroits inhabituels, tels qu'une archive compressée/chiffrée, ou un emplacement
    réseau distant par exemple. Pour ces situations spéciales, SFML fournit une troisième fonction de chargement : <code>loadFromStream</code>.
    Cette fonction lit les données depuis une classe abstraite <?php class_link("InputStream") ?>, qui vous permet de définir vos propres
    implémentations.
</p>
<p>
    Dans ce tutoriel, vous apprendrez à écrire et utiliser votre propre flux de données.
</p>

<?php h2('Et les flux standards ?') ?>
<p>
    Comme beaucoup d'autres langages, le C++ possède déjà une classe pour les flux de données (entrant) : <code>std::istream</code>. En fait il en
    possède deux : <code>std::istream</code> n'est que la façade, l'interface abstraite vers les données est <code>std::streambuf</code>.
</p>
<p>
    Malheureusement, ces classes ne sont pas très accessibles et peuvent devenir carrément compliquées à gérer si vous voulez implémenter des
    comportements non triviaux. La bibliothèque
    <a class="external" href="http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html" title="Boost.Iostreams">Boost.Iostreams</a> tente
    de fournir une interface plus accessible pour les flux standards, mais Boost est une grosse dépendance et SFML ne peut pas en dépendre.
</p>
<p>
    C'est pourquoi SFML fournit sa propre interface de flux de données, qui est je l'espère beaucoup plus <em>simple and fast</em>.
</p>

<?php h2('InputStream') ?>
<p>
    La classe <?php class_link("InputStream") ?> déclare quatre fonctions virtuelles :
</p>
<pre><code class="cpp">class InputStream
{
public :

    virtual ~InputStream() {}

    virtual Int64 read(void* data, Int64 size) = 0;

    virtual Int64 seek(Int64 position) = 0;

    virtual Int64 tell() = 0;

    virtual Int64 getSize() = 0;
};</code></pre>
<p>
    <strong>read</strong> doit extraire <em>size</em> octets de données du flux, et les copier vers l'adresse <em>data</em> qui est fournie ; elle renvoie
    le nombre d'octets lus, ou -1 si une erreur s'est produite.
</p>
<p>
    <strong>seek</strong> doit changer la position de lecture courante dans le flux ; le paramètre <em>position</em> est la nouvelle position absolue
    en octets (elle est donc relative au début des données, pas à la position courante) ; elle renvoie la nouvelle position, ou -1 si une erreur
    s'est produite.
</p>
<p>
    <strong>tell</strong> doit renvoyer la position de lecture actuelle (en octets) dans le flux, ou -1 si une erreur s'est produite.
</p>
<p>
    <strong>getSize</strong> doit renvoyer la taille totale (en octets) des données contenues dans le flux, ou -1 si une erreur s'est produite.
</p>
<p>
    Pour créer un nouveau flux fonctionnel, vous devez implémenter ces quatres fonctions en respectant leur définition.
</p>

<?php h2('Un exemple') ?>
<p>
    Voici un exemple d'une implémentation complète et fonctionnelle d'un flux de données perso. Celui-ci n'est pas très utile : nous allons écrire un
    flux qui lit ses données depuis un fichier, <code>FileStream</code>. Mais il est suffisamment simple pour que vous puissiez vous concentrer sur
    la manière dont fonctionne le code, et ne pas vous perdre dans les détails d'implémentation.
</p>
<p>
    Tout d'abord, voyons la déclaration de la classe :
</p>
<pre><code class="cpp">#include &lt;SFML/System.hpp&gt;
#include &lt;string&gt;
#include &lt;cstdio&gt;

class FileStream : public sf::InputStream
{
public :

    FileStream();

    ~FileStream();

    bool open(const std::string&amp; filename);

    virtual sf::Int64 read(void* data, sf::Int64 size);

    virtual sf::Int64 seek(sf::Int64 position);

    virtual sf::Int64 tell();

    virtual sf::Int64 getSize();

private :

    std::FILE* m_file;
};
</code></pre>
<p>
    Dans cet exemple nous allons utiliser la bonne vieille API C des fichiers, nous avons donc un membre <code>std::FILE*</code>. Nous avons aussi un
    constructeur par défaut, un destructeur, et une fonction pour ouvrir le fichier.
</p>
<p>
    Voici l'implémentation :
</p>
<pre><code class="cpp">FileStream::FileStream() :
m_file(NULL)
{
}

FileStream::~FileStream()
{
    if (m_file)
        std::fclose(m_file);
}

bool FileStream::open(const std::string&amp; filename)
{
    if (m_file)
        std::fclose(m_file);

    m_file = std::fopen(filename.c_str(), "rb");

    return m_file != NULL;
}

sf::Int64 FileStream::read(void* data, sf::Int64 size)
{
    if (m_file)
        return std::fread(data, 1, static_cast&lt;std::size_t&gt;(size), m_file);
    else
        return -1;
}

sf::Int64 FileStream::seek(sf::Int64 position)
{
    if (m_file)
    {
        std::fseek(m_file, static_cast&lt;std::size_t&gt;(position), SEEK_SET);
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
}</code></pre>
<p>
    Notez que, comme expliqué ci-dessus, toutes les fonctions renvoient -1 si une erreur s'est produite.
</p>
<p>
    N'oubliez pas de consulter le forum et le wiki, il y a de fortes chances pour qu'un autre utilisateur ait déjà écrit un <?php class_link("InputStream") ?>
    qui corresponde à ce que vous cherchez à faire. Et si vous écrivez une nouvelle implémentation et pensez qu'elle pourrait être utile en dehors
    de votre projet, n'hésitez pas à la partager !
</p>

<?php h2('Utilisation du flux') ?>
<p>
    Utiliser une classe de flux est très simple : instanciez-la, et passez-la à la fonction <code>loadFromStream</code> (ou <code>openFromStream</code>)
    de l'objet que vous voulez charger.
</p>
<pre><code class="cpp">FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
</code></pre>

<?php h2('Les erreurs à éviter') ?>
<p>
    Certaines classes de ressources ne sont pas chargées complètement après que <code>loadFromStream</code> a été appelé. Au lieu de cela, elles
    continuent à utiliser leur source de données aussi longtemps qu'elles sont utilisées. C'est le cas pour <?php class_link("Music") ?>,
    qui lit les échantillons audio au fur et à mesure qu'ils sont joués, et pour <?php class_link("Font") ?>, qui charge les glyphes à la volée
    en fonction du contenu des textes.
<p>
    En conséquence, le flux qui est utilisé pour charger une musique ou une police, ainsi que sa source de données, doit rester en vie
    aussi longtemps que la ressource l'utilise. S'il est détruit alors qu'il est toujours utilisé, le comportement sera indéterminé (cela
    pourra causer un plantage, une corruption de données, ou rien de visible).
</p>
<p>
    Une autre erreur courante est de renvoyer directement ce que les fonctions utilisées dans le flux renvoient, mais parfois cela ne correspond pas
    à ce que SFML attend. Par exemple, dans l'exemple FileStream ci-dessus, on pourrait être tenté d'écrire la fonction <code>seek</code> comme ceci :
</p>
<pre><code class="cpp">sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}</code></pre>
<p>
    Et ce serait faux, car <code>std::fseek</code> renvoie zéro si elle réussit, alors que SFML attend plutôt la nouvelle position.
</p>

<?php

    require("footer-fr.php");

?>
