<?php

    $title = "Les flux de données (input streams)";
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
    Pour créer un nouveau flux fonctionnel, vous devez implémenter ces quatre fonctions en respectant leur définition.
</p>

<?php h2('FileInputStream et MemoryInputStream') ?>
<p>
    Dès SFML 2.3, deux nouvelles classes ont été créées pour supporter les flux de données pour le nouveau gestionnaire audio interne.
    Tandis que <code>sf::FileInputStream</code> s'occupe de fournir les données en lecture seule à partir d'un fichier,
    <code>sf::MemoryInputStream</code> sert de flux directement depuis la mémoire, aussi en lecture seule.
    Tous deux héritent de <code>sf::InputStream</code> et ainsi peuvent être utilisé de manière polymorphique.
</p>

<?php h2('Utilisation du flux') ?>
<p>
    Utiliser une classe de flux est très simple : instanciez-la, et passez-la à la fonction <code>loadFromStream</code> (ou <code>openFromStream</code>)
    de l'objet que vous voulez charger.
</p>
<pre><code class="cpp">sf::FileInputStream stream;
stream.open("image.png");

sf::Texture texture;
texture.loadFromStream(stream);
</code></pre>

<?php h2('Un exemple') ?>
<p>
    Si vous avez besoin d'une démonstration qui vous aide à comprendre comment le code fonctionne sans se perdre dans des détails
    d'implémentation, vous pouvez jeter un oeil à l'implémentation de <code>sf::FileInputStream</code> ou de <code>sf::MemoryInputStream</code>.
</p>
<p>
    N'oubliez pas de visiter le forum et le wiki. Il est bien possible que d'autres utilisateurs aient déjà écrit une classe
    héritant de <?php class_link("InputStream") ?> qui convienne à vos besoins.
    Et si vous en écrivez une nouvelle et pensez qu'elle puisse être utile à d'autres personnes, n'hésitez pas à la partager !
</p>

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
