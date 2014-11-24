<?php

    $title = "Concevoir ses entit�s avec les tableaux de vertex";
    $page = "graphics-vertex-array-fr.php";

    require("header-fr.php");

?>

<h1>Concevoir ses entit�s avec les tableaux de vertex</h1>

<?php h2('Introduction') ?>
<p>
    SFML fournit des classes simples pour les entit�s 2D les plus utilis�es. Et, bien qu'il soit toujours possible de construire les entit�s plus complexes � partir de
    ces briques de bases, ce n'est pas toujours la solution la plus efficace. Par exemple, vous atteindrez tr�s rapidement les limites de votre carte graphique si vous
    dessinez un grand nombre de sprites. La raison est la suivante : les performances sont directement li�es au nombre d'appels � la fonction <code>draw</code>.
    En effet, chaque appel implique de changer tout un tas d'�tats OpenGL, de mettre en place des matrices, de changer de texture courante, etc. Et tout ce processus
    uniquement pour dessiner deux triangles (un sprite). Ce n'est pas vraiment ce que votre carte graphique attend : les cartes graphiques modernes sont plut�t con�ues
    pour traiter les triangles par lots de plusieurs milliers, voire millions.
</p>
<p>
    Afin de combler ce foss�, SFML fournit un m�canisme de plus bas niveau pour dessiner des choses : les tableaux de vertex (<em>vertex arrays</em> en anglais ou pour les
    habitu�s). En fait, les tableaux de vertex sont utilis�s en interne par toutes les autres classes de SFML. Ils permettent une d�finition plus flexible des entit�s 2D,
    contenant autant de triangles qu'il vous faut. Ils permettent m�me de dessiner des points ou des lignes.
</p>

<?php h2('Qu\'est-ce qu\'un vertex, et pourquoi sont-ils toujours dans des tableaux ?') ?>
<p>
     Un vertex (ou encore "sommet") est la plus petite entit� graphique que vous pouvez manipuler. En bref, c'est un point graphique : il contient bien entendu une position
     2D (x, y), mais aussi une couleur, et une paire de coordonn�es de texture. Nous verrons plus tard le r�le de ces attributs.
</p>
<p>
    Les vertex seuls ne servent pas � grand chose. Ils sont toujours group�s en <em>primitives</em> : des points (1 vertex), des lignes (2 vertex), des triangles
    (3 vertex) ou bien des quads (4 vertex). Puis, avec une ou plusieurs de ces primitives, vous formez enfin la g�ometrie finale de l'entit�.
</p>
<p>
    Vous comprenez maintenant pourquoi on parle toujours de tableaux de vertex, et non pas de vertex tous seuls.
</p>

<?php h2('Un tableau de vertex simple') ?>
<p>
    Tout d'abord, jettons un oeil � la classe <?php class_link('Vertex') ?>. C'est un type simple qui contient trois membres publics, et aucune fonction except� ses
    constructeurs. Ces derniers permettent de cr�er des vertex avec uniquement les attributs dont vous avez besoin -- vous ne voudrez pas toujours colorer ou texturer
    votre entit�.
</p>
<pre><code class="cpp">// cr�ation d'un nouveau vertex
sf::Vertex vertex;

// on change sa position
vertex.position = sf::Vector2f(10, 50);

// on change sa couleur
vertex.color = sf::Color::Red;

// on change ses coordonn�es de texture
vertex.texCoords = sf::Vector2f(100, 100);
</code></pre>
<p>
    ... ou bien, en utilisant le constructeur ad�quat :
</p>
<pre><code class="cpp">sf::Vertex vertex(sf::Vector2f(10, 50), sf::Color::Red, sf::Vector2f(100, 100));
</code></pre>
<p>
    Maintenant, d�finissons une primitive. Rappelez-vous, une primitive est faite de plusieurs vertex, il nous faudra donc un tableau de vertex. SFML fournit une
    encapsulation simple d'utilisation pour ces derniers : <?php class_link('VertexArray') ?>. Cette classe a la m�me s�mantique qu'un tableau (similaire �
    <code>std::vector</code> par exemple), et elle stocke �galement le type de primitives directement.
</p>
<pre><code class="cpp">// cr�ation d'un tableau de 3 vertex d�finissant un triangle
sf::VertexArray triangle(sf::Triangles, 3);

// on d�finit la position des sommets du triangle
triangle[0].position = sf::Vector2f(10, 10);
triangle[1].position = sf::Vector2f(100, 10);
triangle[2].position = sf::Vector2f(100, 100);

// on d�finit la couleur des sommets du triangle
triangle[0].color = sf::Color::Red;
triangle[1].color = sf::Color::Blue;
triangle[2].color = sf::Color::Green;

// pas de coordonn�es de texture ici, nous verrons �a plus tard
</code></pre>
<p>
    Le triangle est pr�t, il peut maintenant �tre dessin�. Dessiner un tableau de vertex est similaire au dessin de n'importe quelle autre entit� SFML, avec la fonction
    <code>draw</code> :
</p>
<pre><code class="cpp">window.draw(triangle);
</code></pre>
<img class="screenshot" src="./images/graphics-vertex-array-triangle.png" alt="Un triangle fait de vertex"/>
<p>
    Vous pouvez remarquer que la couleur des vertex est interpol�e pour remplir la primitive ; c'est un moyen sympa de cr�er des d�grad�s.
</p>
<p>
    Notez que vous n'�tes pas forc�s d'utiliser la classe <?php class_link('VertexArray') ?>. Elle existe pour vous simplifier la vie, elle n'est rien d'autre qu'un
    <code>std::vector&lt;sf::Vertex&gt;</code> avec un <code>sf::PrimitiveType</code>. Si vous voulez plus de flexibilit�, ou bien un tableau non-dynamique,
    vous pouvez utiliser votre propre conteneur � vertex. Vous devrez ensuite utiliser la surcharge de la fonction <code>draw</code> qui prend en param�tre un pointeur
    vers les vertex, leur nombre et le type de primitive.
</p>
<pre><code class="cpp">std::vector&lt;sf::Vertex&gt; vertices;
vertices.push_back(sf::Vertex(...));
...

window.draw(&amp;vertices[0], vertices.size(), sf::Triangles);
</code></pre>
<pre><code class="cpp">sf::Vertex vertices[2] =
{
    sf::Vertex(...),
    sf::Vertex(...)
};

window.draw(vertices, 2, sf::Lines);
</code></pre>

<?php h2('Les types de primitives') ?>
<p>
    Faisons une pause, et regardons quel genre de primitives il est possible de cr�er avec des vertex. Comme expliqu� plus haut, vous pouvez d�finir les primitives 2D les
    plus basiques : point, ligne, triangle et quad (� vrai dire, ce dernier n'existe que par souci de simplification, en interne la carte graphique va le d�couper en
    une paire de triangles). Il existe aussi des variantes "cha�n�es" de ces types, qui permettent de partager des vertex entre deux primitives adjacentes -- ce qui est
    vraiment utile car la plupart du temps les primitives d'une m�me entit� sont connect�es.
</p>
<p>
    Voici la liste compl�te :
</p>
<table class="styled">
    <thead>
        <tr>
            <th>Type de primitive</th>
            <th>Description</th>
            <th>Exemple</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>sf::Points</code></td>
            <td>
                Un ensemble de points non connect�s. Ces points n'ont pas d'�paisseur : ils occuperont toujours un pixel, ind�pendamment de la transformation
                ou vue courante.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-points.png" alt="La primitive sf::Points"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::Lines</code></td>
            <td>
                Un ensemble de lignes non connect�es. Ces lignes n'ont pas d'�paisseur : elles feront toujours un pixel de large, ind�pendamment de la transformation
                ou vue courante.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-lines.png" alt="La primitive sf::Lines"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::LinesStrip</code></td>
            <td>
                Un ensemble de lignes connect�es. Le second vertex d'une ligne est utilis� comme premier vertex de la suivante.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-lines-strip.png" alt="La primitive sf::LinesStrip"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::Triangles</code></td>
            <td>
                Un ensemble de triangles non connect�s.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-triangles.png" alt="La primitive sf::Triangles"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::TrianglesStrip</code></td>
            <td>
                Un ensemble de triangles connect�s par un c�t�. Chaque triangle partage ses deux derniers vertex avec le suivant.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-triangles-strip.png" alt="La primitive sf::TrianglesStrip"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::TrianglesFan</code></td>
            <td>
                Un ensemble de triangles connect�s � un point central (en �ventail). Le tout premier vertex est le centre, puis chaque nouveau vertex d�finit un nouveau
                triangle, combin� au centre et au vertex suivant.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-triangles-fan.png" alt="La primitive sf::TrianglesFan"/>
            </td>
        </tr>
        <tr>
            <td><code>sf::Quads</code></td>
            <td>
                Un ensemble de quads non connect�s. Les 4 points d'un quad doivent �tre d�finis soit dans le sens des aiguilles d'une montre, soit dans le sens inverse.
            </td>
            <td>
                <img src="./images/graphics-vertex-array-quads.png" alt="La primitive sf::Quads"/>
            </td>
        </tr>
    </tbody>
</table>

<?php h2('Texturage') ?>
<p>
    Comme les autres entit�s SFML, les tableaux de vertex peuvent �tre textur�s. Pour ce faire, il faut jouer avec l'attribut <code>texCoords</code> des vertex. Celui-ci
    d�finit quel pixel de la texture sera coll� sur le vertex.
</p>
<pre><code class="cpp">// cr�ation d'un quad
sf::VertexArray quad(sf::Quads, 4);

// on le d�finit comme un rectangle, plac� en (10, 10) et de taille 100x100
quad[0].position = sf::Vector2f(10, 10);
quad[1].position = sf::Vector2f(110, 10);
quad[2].position = sf::Vector2f(110, 110);
quad[3].position = sf::Vector2f(10, 110);

// et on d�finit la zone de texture � lui appliquer comme �tant le rectangle de 25x50 d�marrant en (0, 0)
quad[0].texCoords = sf::Vector2f(0, 0);
quad[1].texCoords = sf::Vector2f(25, 0);
quad[2].texCoords = sf::Vector2f(25, 50);
quad[3].texCoords = sf::Vector2f(0, 50);
</code></pre>
<p class="important">
    Les coordonn�es de texture sont d�finies en <em>pixels</em> (tout comme le <code>textureRect</code> des sprites et des formes). Elles ne sont <em>pas</em> normalis�es
    (entre 0 et 1), comme les personnes habitu�es � OpenGL pourraient s'y attendre.
</p>
<p>
    Les tableaux de vertex sont des entit�s bas niveau, ils ne g�rent que la g�ometrie et ne stockent aucun attribut suppl�mentaire telle qu'une texture. Pour dessiner
    un tableau de vertex avec une texture, il faut donc la passer directement � la fonction <code>draw</code> :
</p>
<pre><code class="cpp">sf::VertexArray vertices;
sf::Texture texture;

...

window.draw(vertices, &amp;texture);
</code></pre>
<p>
    Ceci est la version raccourcie, si vous devez passer d'autres �tats de rendu que la texture (comme un <em>blend mode</em> ou une transformation) vous pouvez utiliser
    la version explicite qui utilise une instance de <?php class_link('RenderStates') ?> :
</p>
<pre><code class="cpp">sf::VertexArray vertices;
sf::Texture texture;

...

sf::RenderStates states;
states.texture = &amp;texture;

window.draw(vertices, states);
</code></pre>

<?php h2('Transformer un tableau de vertex') ?>
<p>
    La transformation est similaire au texturage. Elle ne peut pas �tre associ�e directement au tableau de vertex, vous devez la passer � la fonction <code>draw</code>.
</p>
<pre><code class="cpp">sf::VertexArray vertices;
sf::Transform transform;

...

window.draw(vertices, transform);
</code></pre>
<p>
    Ou bien, si vous devez passer d'autres �tats :
</p>
<pre><code class="cpp">sf::VertexArray vertices;
sf::Transform transform;

...

sf::RenderStates states;
states.transform = transform;

window.draw(vertices, states);
</code></pre>
<p>
    Pour en apprendre plus sur les transformations et la classe <?php class_link('Transform') ?>, vous pouvez lire le tutoriel
    <a href="graphics-transform-fr.php" title="Tutoriel 'Transformer des entit�s'">Transformer des entit�s</a>.
</p>

<?php h2('Cr�er une entit� SFML-like') ?>
<p>
    Maintenant que vous savez comment d�finir votre propre entit� color�e/textur�e/transform�e, est-ce que ce ne serait pas sympa de pouvoir l'encapsuler dans une classe similaire
    aux entit�s SFML ? Heureusement, SFML fournit tout ce qu'il faut pour faire �a simplement, avec les classes de base <?php class_link('Drawable') ?> et
    <?php class_link('Transformable') ?>. Ces deux classes sont les bases des entit�s SFML -- <?php class_link('Sprite') ?>, <?php class_link('Text') ?> et
    <?php class_link('Shape') ?>.
</p>
<p>
    <?php class_link('Drawable') ?> est une interface : elle d�clare une unique fonction virtuelle pure ; aucun membre ou fonction concr�te. H�riter de
    <?php class_link('Drawable') ?> permet de dessiner des instances de votre classe de la m�me mani�re que les classes SFML :
</p>
<pre><code class="cpp">class MyEntity : public sf::Drawable
{
private:

    virtual void draw(sf::RenderTarget&amp; target, sf::RenderStates states) const;
};

MyEntity entity;
window.draw(entity); // appelle entity.draw en interne
</code></pre>
<p>
    Notez que ce n'est pas obligatoire, vous pourriez tout aussi bien avoir une fonction <code>draw</code> similaire dans votre classe, et l'appeler avec
    <code>entity.draw(window)</code>. Mais l'autre mani�re, avec <?php class_link('Drawable') ?> comme classe de base, est plus �l�gante et coh�rente. Et si jamais
    vous devez un jour stocker un tableau d'objets dessinables, vous pourrez le faire sans effort suppl�mentaire puisque tous les objets dessinables (les v�tres et
    ceux de SFML) d�rivent de la m�me classe.
</p>
<p>
    L'autre classe de base, <?php class_link('Transformable') ?>, n'a pas de fonction virtuelle. En d�river ajoute automatiquement � votre classe les m�mes fonctions
    de transformation que les autres classes SFML (<code>setPosition</code>, <code>setRotation</code>, <code>move</code>, <code>scale</code>, ...). Vous pouvez
    en apprendre plus sur cette classe dans le tutoriel <a href="graphics-transform-fr.php" title="Tutoriel 'Transformer des entit�s'">Transformer des entit�s</a>.
</p>
<p>
    Donc, en utilisant ces deux classes de base et un tableau de vertex (et dans cet exemple nous allons aussi ajouter une texture), voici � quoi pourrait ressembler
    une classe SFML-like typique :
</p>
<pre><code class="cpp">class MyEntity : public sf::Drawable, public sf::Transformable
{
public:

    // ajoutez des fonctions pour jouer avec la g�ometrie / couleur / texture de l'entit�...

private:

    virtual void draw(sf::RenderTarget&amp; target, sf::RenderStates states) const
    {
        // on applique la transformation de l'entit� -- on la combine avec celle qui a �t� pass�e par l'appelant
        states.transform *= getTransform(); // getTransform() est d�finie par sf::Transformable

        // on applique la texture
        states.texture = &amp;m_texture;

        // on peut aussi surcharger states.shader ou states.blendMode si n�cessaire

        // on dessine le tableau de vertex
        target.draw(m_vertices, states);
    }

    sf::VertexArray m_vertices;
    sf::Texture m_texture;
};
</code></pre>
<p>
    Vous pouvez ensuite jouer avec cette classe comme si c'�tait une classe SFML :
</p>
<pre><code class="cpp">MyEntity entity;

// vous pouvez la transformer
entity.setPosition(10, 50);
entity.setRotation(45);

// vous pouvez la dessiner
window.draw(entity);
</code></pre>

<?php h2('Exemple: tile map') ?>
<p>
    Avec tout ce qu'on a vu pr�c�demment, voyons maintenant un exemple complet (mains n�anmoins simple) : cr�ons une classe qui encapsule une tilemap, ie. un niveau compos�
    de tuiles. Le niveau complet sera contenu dans un unique tableau de vertex, ainsi il sera extr�mement rapide � dessiner. Il faut noter que cette strat�gie n'est
    applicable que si tout le tileset (la texture qui contient les tuiles) peut tenir dans une unique texture. Sinon, il faudra au minimum utiliser un tableau de vertex
    par texture.
</p>
<pre><code class="cpp">class TileMap : public sf::Drawable, public sf::Transformable
{
public:

    bool load(const std::string&amp; tileset, sf::Vector2u tileSize, const int* tiles, unsigned int width, unsigned int height)
    {
        // on charge la texture du tileset
        if (!m_tileset.loadFromFile(tileset))
            return false;

        // on redimensionne le tableau de vertex pour qu'il puisse contenir tout le niveau
        m_vertices.setPrimitiveType(sf::Quads);
        m_vertices.resize(width * height * 4);

        // on remplit le tableau de vertex, avec un quad par tuile
        for (unsigned int i = 0; i &lt; width; ++i)
            for (unsigned int j = 0; j &lt; height; ++j)
            {
                // on r�cup�re le num�ro de tuile courant
                int tileNumber = tiles[i + j * width];

                // on en d�duit sa position dans la texture du tileset
                int tu = tileNumber % (m_tileset.getSize().x / tileSize.x);
                int tv = tileNumber / (m_tileset.getSize().x / tileSize.x);

                // on r�cup�re un pointeur vers le quad � d�finir dans le tableau de vertex
                sf::Vertex* quad = &amp;m_vertices[(i + j * width) * 4];

                // on d�finit ses quatre coins
                quad[0].position = sf::Vector2f(i * tileSize.x, j * tileSize.y);
                quad[1].position = sf::Vector2f((i + 1) * tileSize.x, j * tileSize.y);
                quad[2].position = sf::Vector2f((i + 1) * tileSize.x, (j + 1) * tileSize.y);
                quad[3].position = sf::Vector2f(i * tileSize.x, (j + 1) * tileSize.y);

                // on d�finit ses quatre coordonn�es de texture
                quad[0].texCoords = sf::Vector2f(tu * tileSize.x, tv * tileSize.y);
                quad[1].texCoords = sf::Vector2f((tu + 1) * tileSize.x, tv * tileSize.y);
                quad[2].texCoords = sf::Vector2f((tu + 1) * tileSize.x, (tv + 1) * tileSize.y);
                quad[3].texCoords = sf::Vector2f(tu * tileSize.x, (tv + 1) * tileSize.y);
            }

        return true;
    }

private:

    virtual void draw(sf::RenderTarget&amp; target, sf::RenderStates states) const
    {
        // on applique la transformation
        states.transform *= getTransform();

        // on applique la texture du tileset
        states.texture = &amp;m_tileset;

        // et on dessine enfin le tableau de vertex
        target.draw(m_vertices, states);
    }

    sf::VertexArray m_vertices;
    sf::Texture m_tileset;
};
</code></pre>
<p>
    Et maintenant, l'application qui l'utilise :
</p>
<pre><code class="cpp">int main()
{
    // on cr�e la fen�tre
    sf::RenderWindow window(sf::VideoMode(512, 256), "Tilemap");

    // on d�finit le niveau � l'aide de num�ro de tuiles
    const int level[] =
    {
        0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
        0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 2, 0, 0, 0, 0,
        1, 1, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3, 3, 3,
        0, 1, 0, 0, 2, 0, 3, 3, 3, 0, 1, 1, 1, 0, 0, 0,
        0, 1, 1, 0, 3, 3, 3, 0, 0, 0, 1, 1, 1, 2, 0, 0,
        0, 0, 1, 0, 3, 0, 2, 2, 0, 0, 1, 1, 1, 1, 2, 0,
        2, 0, 1, 0, 3, 0, 2, 2, 2, 0, 1, 1, 1, 1, 1, 1,
        0, 0, 1, 0, 3, 2, 2, 2, 0, 0, 0, 0, 1, 1, 1, 1,
    };

    // on cr�e la tilemap avec le niveau pr�c�demment d�fini
    TileMap map;
    if (!map.load("tileset.png", sf::Vector2u(32, 32), level, 16, 8))
        return -1;

    // on fait tourner la boucle principale
    while (window.isOpen())
    {
        // on g�re les �v�nements
        sf::Event event;
        while (window.pollEvent(event))
        {
            if(event.type == sf::Event::Closed)
                window.close();
        }

        // on dessine le niveau
        window.clear();
        window.draw(map);
        window.display();
    }

    return 0;
}
</code></pre>
<img class="screenshot" src="./images/graphics-vertex-array-tilemap.png" alt="L'exemple 'tilemap'"/>

<?php h2('Exemple: syst�me de particules') ?>
<p>
    Ce second exemple impl�mente une autre entit� commun�ment utilis�e : le syst�me de particules. Le n�tre sera relativement simple : pas de texture et aussi peu
    de param�tres que possible. Il d�montre l'utilisation du type de primitive <code>sf::Points</code>, avec un tableau de vertex dynamique qui change � chaque
    frame.
</p>
<pre><code class="cpp">class ParticleSystem : public sf::Drawable, public sf::Transformable
{
public:

    ParticleSystem(unsigned int count) :
    m_particles(count),
    m_vertices(sf::Points, count),
    m_lifetime(sf::seconds(3)),
    m_emitter(0, 0)
    {
    }

    void setEmitter(sf::Vector2f position)
    {
        m_emitter = position;
    }

    void update(sf::Time elapsed)
    {
        for (std::size_t i = 0; i &lt; m_particles.size(); ++i)
        {
            // on met � jour la dur�e de vie de la particule
            Particle&amp; p = m_particles[i];
            p.lifetime -= elapsed;

            // si la particule est arriv�e en fin de vie, on la r�initialise
            if (p.lifetime &lt;= sf::Time::Zero)
                resetParticle(i);

            // on met � jour la position du vertex correspondant
            m_vertices[i].position += p.velocity * elapsed.asSeconds();

            // on met � jour l'alpha (transparence) de la particule en fonction de sa dur�e de vie
            float ratio = p.lifetime.asSeconds() / m_lifetime.asSeconds();
            m_vertices[i].color.a = static_cast&lt;sf::Uint8&gt;(ratio * 255);
        }
    }

private:

    virtual void draw(sf::RenderTarget&amp; target, sf::RenderStates states) const
    {
        // on applique la transformation
        states.transform *= getTransform();

        // nos particules n'utilisent pas de texture
        states.texture = NULL;

        // on dessine enfin le vertex array
        target.draw(m_vertices, states);
    }

private:

    struct Particle
    {
        sf::Vector2f velocity;
        sf::Time lifetime;
    };

    void resetParticle(std::size_t index)
    {
        // on donne une vitesse et une dur�e de vie al�atoires � la particule
        float angle = (std::rand() % 360) * 3.14f / 180.f;
        float speed = (std::rand() % 50) + 50.f;
        m_particles[index].velocity = sf::Vector2f(std::cos(angle) * speed, std::sin(angle) * speed);
        m_particles[index].lifetime = sf::milliseconds((std::rand() % 2000) + 1000);

        // on remet � z�ro la position du vertex correspondant � la particule
        m_vertices[index].position = m_emitter;
    }

    std::vector&lt;Particle&gt; m_particles;
    sf::VertexArray m_vertices;
    sf::Time m_lifetime;
    sf::Vector2f m_emitter;
};
</code></pre>
<p>
    Et la petite d�mo qui l'utilise :
</p>
<pre><code class="cpp">int main()
{
    // on cr�e la fen�tre
    sf::RenderWindow window(sf::VideoMode(512, 256), "Particles");

    // on cr�e un syst�me de 1000 particules
    ParticleSystem particles(1000);

    // on cr�e un chrono pour mesurer le temps �coul�
    sf::Clock clock;

    // on fait tourner la boucle principale
    while (window.isOpen())
    {
        // on g�re les �v�nements
        sf::Event event;
        while (window.pollEvent(event))
        {
            if(event.type == sf::Event::Closed)
                window.close();
        }

        // on fait en sorte que l'�metteur des particules suive la souris
        sf::Vector2i mouse = sf::Mouse::getPosition(window);
        particles.setEmitter(window.mapPixelToCoords(mouse));

        // on met � jour le syst�me de particules
        sf::Time elapsed = clock.restart();
        particles.update(elapsed);

        // on le dessine
        window.clear();
        window.draw(particles);
        window.display();
    }

    return 0;
}
</code></pre>
<img class="screenshot" src="./images/graphics-vertex-array-particles.png" alt="L'exemple 'particules'"/>

<?php

    require("footer-fr.php");

?>
