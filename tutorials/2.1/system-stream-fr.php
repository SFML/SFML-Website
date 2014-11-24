<?php

    $title = "Les flux de donn�es (<em>input streams</em>)";
    $page = "system-stream-fr.php";

    require("header-fr.php");

?>

<h1>Les flux de donn�es (<em>input streams</em>)</h1>

<?php h2('Introduction') ?>
<p>
    SFML poss�de de nombreuses classes de ressources : images, polices, sons, etc. Dans la plupart des programmes, ces ressources vont �tre charg�es
    depuis des fichiers, � l'aide de leur fonction <code>loadFromFile</code>. Dans quelques autres cas, les ressources seront directement int�gr�es �
    l'ex�cutable ou bien dans un gros fichier de donn�es, et charg�es depuis la m�moire avec <code>loadFromMemory</code>. Ces fonctions couvrent
    <em>pratiquement</em> toutes les situations imaginables -- mais pas toutes.
</p>
<p>
    Parfois vous avez besoin de charger des fichiers depuis des endroits inhabituels, tels qu'une archive compress�e/chiffr�e, ou un emplacement
    r�seau distant par exemple. Pour ces situations sp�ciales, SFML fournit une troisi�me fonction de chargement : <code>loadFromStream</code>.
    Cette fonction lit les donn�es depuis une classe abstraite <?php class_link("InputStream") ?>, qui vous permet de d�finir vos propres
    impl�mentations.
</p>
<p>
    Dans ce tutoriel, vous apprendrez � �crire et utiliser votre propre flux de donn�es.
</p>

<?php h2('Et les flux standards ?') ?>
<p>
    Comme beaucoup d'autres langages, le C++ poss�de d�j� une classe pour les flux de donn�es (entrant) : <code>std::istream</code>. En fait il en
    poss�de deux : <code>std::istream</code> n'est que la fa�ade, l'interface abstraite vers les donn�es est <code>std::streambuf</code>.
</p>
<p>
    Malheureusement, ces classes ne sont pas tr�s accessibles et peuvent devenir carr�ment compliqu�es � g�rer si vous voulez impl�menter des
    comportements non triviaux. La biblioth�que
    <a class="external" href="http://www.boost.org/doc/libs/1_49_0/libs/iostreams/doc/index.html" title="Boost.Iostreams">Boost.Iostreams</a> tente
    de fournir une interface plus accessible pour les flux standards, mais Boost est une grosse d�pendance et SFML ne peut pas en d�pendre.
</p>
<p>
    C'est pourquoi SFML fournit sa propre interface de flux de donn�es, qui est je l'esp�re beaucoup plus <em>simple and fast</em>.
</p>

<?php h2('InputStream') ?>
<p>
    La classe <?php class_link("InputStream") ?> d�clare quatre fonctions virtuelles :
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
    <strong>read</strong> doit extraire <em>size</em> octets de donn�es du flux, et les copier vers l'adresse <em>data</em> qui est fournie ; elle renvoie
    le nombre d'octets lus, ou -1 si une erreur s'est produite.
</p>
<p>
    <strong>seek</strong> doit changer la position de lecture courante dans le flux ; le param�tre <em>position</em> est la nouvelle position absolue
    en octets (elle est donc relative au d�but des donn�es, pas � la position courante) ; elle renvoie la nouvelle position, ou -1 si une erreur
    s'est produite.
</p>
<p>
    <strong>tell</strong> doit renvoyer la position de lecture actuelle (en octets) dans le flux, ou -1 si une erreur s'est produite.
</p>
<p>
    <strong>getSize</strong> doit renvoyer la taille totale (en octets) des donn�es contenues dans le flux, ou -1 si une erreur s'est produite.
</p>
<p>
    Pour cr�er un nouveau flux fonctionnel, vous devez impl�menter ces quatres fonctions en respectant leur d�finition.
</p>

<?php h2('Un exemple') ?>
<p>
    Voici un exemple d'une impl�mentation compl�te et fonctionnelle d'un flux de donn�es perso. Celui-ci n'est pas tr�s utile : nous allons �crire un
    flux qui lit ses donn�es depuis un fichier, <code>FileStream</code>. Mais il est suffisamment simple pour que vous puissiez vous concentrer sur
    la mani�re dont fonctionne le code, et ne pas vous perdre dans les d�tails d'impl�mentation.
</p>
<p>
    Tout d'abord, voyons la d�claration de la classe :
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
    constructeur par d�faut, un destructeur, et une fonction pour ouvrir le fichier.
</p>
<p>
    Voici l'impl�mentation :
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
    Notez que, comme expliqu� ci-dessus, toutes les fonctions renvoient -1 si une erreur s'est produite.
</p>
<p>
    N'oubliez pas de consulter le forum et le wiki, il y a de fortes chances pour qu'un autre utilisateur ait d�j� �crit un <?php class_link("InputStream") ?>
    qui corresponde � ce que vous cherchez � faire. Et si vous �crivez une nouvelle impl�mentation et pensez qu'elle pourrait �tre utile en dehors
    de votre projet, n'h�sitez pas � la partager !
</p>

<?php h2('Utilisation du flux') ?>
<p>
    Utiliser une classe de flux est tr�s simple : instanciez-la, et passez-la � la fonction <code>loadFromStream</code> (ou <code>openFromStream</code>)
    de l'objet que vous voulez charger.
</p>
<pre><code class="cpp">FileStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
</code></pre>

<?php h2('Les erreurs � �viter') ?>
<p>
    Certaines classes de ressources ne sont pas charg�es compl�tement apr�s que <code>loadFromStream</code> a �t� appel�. Au lieu de cela, elles
    continuent � utiliser leur source de donn�es aussi longtemps qu'elles sont utilis�es. C'est le cas pour <?php class_link("Music") ?>,
    qui lit les �chantillons audio au fur et � mesure qu'ils sont jou�s, et pour <?php class_link("Font") ?>, qui charge les glyphes � la vol�e
    en fonction du contenu des textes.
<p>
    En cons�quence, le flux qui est utilis� pour charger une musique ou une police, ainsi que sa source de donn�es, doit rester en vie
    aussi longtemps que la ressource l'utilise. S'il est d�truit alors qu'il est toujours utilis�, le comportement sera ind�termin� (cela
    pourra causer un plantage, une corruption de donn�es, ou rien de visible).
</p>
<p>
    Une autre erreur courante est de renvoyer directement ce que les fonctions utilis�es dans le flux renvoient, mais parfois cela ne correspond pas
    � ce que SFML attend. Par exemple, dans l'exemple FileStream ci-dessus, on pourrait �tre tent� d'�crire la fonction <code>seek</code> comme ceci :
</p>
<pre><code class="cpp">sf::Int64 FileStream::seek(sf::Int64 position)
{
    return std::fseek(m_file, position, SEEK_SET);
}</code></pre>
<p>
    Et ce serait faux, car <code>std::fseek</code> renvoie z�ro si elle r�ussit, alors que SFML attend plut�t la nouvelle position.
</p>

<?php

    require("footer-fr.php");

?>
