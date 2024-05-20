Dessiner des formes
Introduction
SFML fournit un ensemble de classes représentant des formes simples. Chaque forme possède sa propre classe, mais toutes dérivent de la même classe de base de sorte qu'elles partagent un ensemble de fonctionnalités communes. Chaque classe ajoute ensuite ses propres spécificités : un rayon pour la classe de cercles, une taille pour la classe de rectangles, des points pour la classe des polygones, etc.

Les propriétés communes des formes
Transformation (position, rotation, échelle)
Ces propriétés étant communes à toutes les classes graphiques de SFML, elles sont détaillées dans un tutoriel dédié.

Couleur
L'une des propriétés les plus basiques d'une forme est sa couleur, que vous pouvez modifier via la fonction setFillColor.

sf::CircleShape shape(50.f);

// change la couleur de la forme pour du vert
shape.setFillColor(sf::Color(100, 250, 50));
Une forme colorée
Contour
Les formes peuvent avoir un contour. Vous pouvez choisir l'épaisseur et la couleur de celui-ci avec les fonctions setOutlineThickness et setOutlineColor.

sf::CircleShape shape(50.f);
shape.setFillColor(sf::Color(150, 50, 250));

// définit un contour orange de 10 pixels d'épaisseur
shape.setOutlineThickness(10.f);
shape.setOutlineColor(sf::Color(250, 150, 100));
Une forme avec contour
Par défaut, le contour s'étend à l'extérieur de la forme (si vous avez un cercle avec un rayon de 10 et un contour de 5, le rayon total du cercle sera 15). Vous pouvez le faire s'étendre vers l'intérieur si vous le souhaitez, en spécifiant une épaisseur négative.

Pour désactiver le contour, mettez son épaisseur à 0. Si au contraire vous voulez voir uniquement le contour, vous pouvez mettre la couleur intérieure (setFillColor) à sf::Color::Transparent.

Texture
Les formes peuvent également être texturées, comme les sprites. Pour indiquer quelle partie de la texture doit être collée sur la forme, vous devez utiliser la fonction setTexture. Celle-ci prend en paramètre le rectangle de la texture à coller sur le rectangle englobant de la forme. Cette méthode offre une flexibilité limitée, mais elle est bien plus simple à utiliser que d'avoir à attribuer explicitement des coordonnées de texture à chaque point de la forme.

sf::CircleShape shape(50.f);

// colle un rectangle texturé de 100x100 sur la forme
shape.setTexture(&texture); // texture est un sf::Texture
shape.setTextureRect(sf::IntRect(10, 10, 100, 100));
Une forme texturée
Notez que le contour n'est pas texturé.
Au cas où la forme a également une couleur, la texture est modulée (multipliée) avec elle.
Pour désactiver le texturage, appelez setTexture(NULL).

Dessiner une forme
Dessiner une forme est aussi simple que de dessiner n'importe quelle autre entité SFML :

window.draw(shape);
Les types de formes prédéfinis
Rectangles
Pour dessiner des rectangles, vous devez utiliser la classe sf::RectangleShape. Celle-ci ne possède qu'un attribut : la taille du rectangle.

// définit un rectangle de 120x50
sf::RectangleShape rectangle(sf::Vector2f(120.f, 50.f));

// change sa taille en 100x100
rectangle.setSize(sf::Vector2f(100.f, 100.f));
Un rectangle
Cercles
Les cercles sont représentés par la classe sf::CircleShape. Elle possède deux attributs : le rayon et le nombre de côtés. Le nombre de côtés est un attribut optionnel, qui permet d'ajuster la "qualité" du cercle : les cercles doivent en effet être simulés par des polygones avec beaucoup de côtés (la carte graphique est incapable de dessiner des cercles parfaits directement), et cet attribut définit combien de côtés le cercle possède. Si vous dessinez de petits cercles, vous n'aurez probablement pas besoin de beaucoup de côtés. Si au contraire vous dessinez de gros cercles, ou bien zoomez sur des cercles, vous devrez utiliser plus de côtés si vous voulez que ceux-ci restent imperceptibles.

// définit un cercle de rayon 200
sf::CircleShape circle(200.f);

// change le rayon à 40
circle.setRadius(40.f);

// change le nombre de points (côtés) du cercle
circle.setPointCount(100);
Un cercle
Polygones réguliers
Il n'y a pas de classe dédiée pour les polygones réguliers. En fait vous pouvez obtenir un polygone régulier de n'importe quel nombre de côtés avec la classe sf::CircleShape : en effet, puisque les cercles sont simulés par des polygones avec beaucoup de côtés, vous avez juste à jouer sur le nombre de côtés pour obtenir le polygone voulu. Un sf::CircleShape avec 3 points est un triangle, avec 4 points c'est un carré, etc.

// définit un triangle
sf::CircleShape triangle(80.f, 3);

// définit un carré
sf::CircleShape square(80.f, 4);

// définit un octogone
sf::CircleShape octagon(80.f, 8);
Des polygones réguliers
Formes convexes
La classe sf::ConvexShape est la classe de forme ultime : elle permet de définir une forme quelconque, pour peu qu'elle reste convexe. En effet, SFML ne peut pas dessiner de formes concaves ; si vous devez vraiment en dessiner, vous devrez la découper en plusieurs formes convexes (si possible).

Pour créer une forme convexe, vous devez tout d'abord définir le nombre total de points, puis définir ceux-ci.

// crée une forme vide
sf::ConvexShape convex;

// définit le nombre de points (5)
convex.setPointCount(5);

// définit les points
convex.setPoint(0, sf::Vector2f(0.f, 0.f));
convex.setPoint(1, sf::Vector2f(150.f, 10.f));
convex.setPoint(2, sf::Vector2f(120.f, 90.f));
convex.setPoint(3, sf::Vector2f(30.f, 100.f));
convex.setPoint(4, sf::Vector2f(0.f, 50.f));
Il est très important de définir les points d'une forme convexe dans le sens des aiguilles d'une montre (ou inverse). Si vous les définissez dans un ordre quelconque, le résultat sera indéterminé.

Une forme convexe
Officiellement, sf::ConvexShape peut seulement créer des formes convexes. Mais en réalité cette contrainte est légèrement exagérée. En fait, d'un point de vue strictement technique, la contrainte exacte que votre forme doit suivre est que si vous tracez un segment allant de son centre de gravité à n'importe lequel de ses points, vous ne devez croiser aucun côté. Avec cette définition un peu plus flexible, vous pouvez par exemple dessiner des étoiles.

Lignes
Il n'existe aucune classe pour les lignes. La raison est simple : si votre ligne possède une épaisseur alors c'est un rectangle ; sinon, elle peut être dessinée avec une primitive de type ligne.

Ligne avec épaisseur :

sf::RectangleShape line(sf::Vector2f(150, 5));
line.rotate(45);
Une ligne avec épaisseur
Ligne sans épaisseur :

sf::Vertex line[] =
{
    sf::Vertex(sf::Vector2f(10.f, 10.f)),
    sf::Vertex(sf::Vector2f(150.f, 150.f))
};

window.draw(line, 2, sf::Lines);
Une ligne sans épaisseur
Formes personnalisées
Vous pouvez étendre l'ensemble des classes de formes avec vos propres types de formes. Pour ce faire, vous devez dériver de sf::Shape et redéfinir deux fonctions :

getPointCount: renvoie le nombre de points de la forme
getPoint: renvoie un point de la forme
Vous devez également appeler la fonction protégée update() à chaque fois que les points de la forme changent, de sorte que la classe de base en soit informée et puisse recalculer ce dont elle a besoin.

Voici un exemple complet de classe de forme personnalisée : EllipseShape.

class EllipseShape : public sf::Shape
{
public :

    explicit EllipseShape(const sf::Vector2f& radius = sf::Vector2f(0.f, 0.f)) :
    m_radius(radius)
    {
        update();
    }

    void setRadius(const sf::Vector2f& radius)
    {
        m_radius = radius;
        update();
    }

    const sf::Vector2f& getRadius() const
    {
        return m_radius;
    }

    virtual std::size_t getPointCount() const
    {
        return 30; // fixé, mais ça pourrait tout aussi bien être un attribut de la classe
    }

    virtual sf::Vector2f getPoint(std::size_t index) const
    {
        static const float pi = 3.141592654f;

        float angle = index * 2 * pi / getPointCount() - pi / 2;
        float x = std::cos(angle) * m_radius.x;
        float y = std::sin(angle) * m_radius.y;

        return sf::Vector2f(m_radius.x + x, m_radius.y + y);
    }

private :

    sf::Vector2f m_radius;
};
Une ellipse
Formes anticrénelées
Il n'y a pas d'option pour activer l'anticrénelage pour une forme en particulier. Si vous voulez des formes anticrénelées (ie. avec des bords lissés), vous devez activer l'anticrénelage de manière globale lorsque vous créez la fenêtre, avec l'attribut correspondant de la structure sf::ContextSettings.

sf::ContextSettings settings;
settings.antialiasingLevel = 8;

sf::RenderWindow window(sf::VideoMode(800, 600), "SFML shapes", sf::Style::Default, settings);
Crénelé vs anticrénelé
Souvenez-vous que l'anticrénelage dépend de la carte graphique : elle peut ne pas le supporter, ou forcer sa désactivation dans les paramètres du pilote graphique.