# Effets spéciaux avec les shaders

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Un shader est un petit programme qui s'exécute directement sur la carte graphique, et qui permet au programmeur de décrire les étapes de rendu de manière plus simple et surtout plus flexible que d'utiliser les états et opérations figés qu'OpenGL fournit. Cette flexibilité permet aux shaders d'implémenter des effets qui seraient compliqués, sinon impossibles, à décrire avec les fonctions OpenGL standards : éclairage par pixel, ombres, etc. Les cartes graphiques actuelles, ainsi que les dernières versions d'OpenGL, sont même complètement basées sur les shaders, et les vieux états et fonctions (ce qu'on appelle le "_fixed pipeline_") que vous avez l'habitude d'utiliser sont voués à disparaître.

Les shaders sont écrits en GLSL (_OpenGL Shading Language_), très similaire au langage C.

Il existe deux types de shaders : les vertex shaders et les fragment (ou pixel) shaders. Les vertex shaders transforment la géometrie, alors que les fragment shaders s'occupent des pixels. Selon le type d'effet que vous voulez implémenter, vous pouvez définir uniquement l'un ou l'autre, ou bien les deux.

Pour comprendre ce que les shaders font, et comment les utiliser efficacement, il est important de connaître les bases du pipeline de rendu graphique. Vous devrez également apprendre à écrire des programmes GLSL, et trouver de bons tutoriels et exemples pour démarrer. Vous pouvez aussi jeter un oeil à l'exemple "Shader" qui est fourni avec le SDK de SFML.

Ce tutoriel va uniquement se concentrer sur les parties spécifiques à SFML : comment charger et appliquer des shaders -- pas comment les écrire.

## [Charger des shaders](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#charger-des-shaders)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Dans SFML, les shaders sont représentés par la classe [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation"). Elle gère à la fois les vertex et fragment shaders : un [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation") est une combinaison des deux (ou bien un seul, si l'autre n'est pas nécessaire).

Même si les shaders sont maintenant très répandus, il existe toujours des cartes graphiques suffisamment vieilles qui ne les supportent pas. La première chose à faire dans votre programme est donc de vérifier si les shaders sont disponibles :

```
if (!sf::Shader::isAvailable())
{
    // les shaders ne sont pas dispo...
}
```

Toute tentative d'utiliser la classe [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation") échouera si la fonction `sf::Shader::isAvailable()` renvoie `false`.

Le moyen le plus commun de charger un shader est depuis un fichier sur le disque, ce qui s'effectue avec la fonction `loadFromFile`.

```
sf::Shader shader;

// charge uniquement le vertex shader
if (!shader.loadFromFile("vertex_shader.vert", sf::Shader::Vertex))
{
    // erreur...
}

// charge uniquement le fragment shader
if (!shader.loadFromFile("fragment_shader.frag", sf::Shader::Fragment))
{
    // erreur...
}

// charge les deux
if (!shader.loadFromFile("vertex_shader.vert", "fragment_shader.frag"))
{
    // erreur...
}
```

Les shaders sont de simples fichiers texte (comme votre code C++), leur extension n'a donc pas grande importance, ça peut être n'importe quoi. ".vert" et ".frag" sont juste des conventions.

La fonction `loadFromFile` échoue parfois sans raison évidente. Premièrement, vérifiez le message d'erreur affiché par SFML sur la sortie standard (vérifiez la console). Si le message est unable to open file, assurez-vous que le _chemin de travail_ (le chemin relativement auquel seront interprétés tous les chemins de fichiers de votre programme) est celui que vous pensez : lorsque vous lancez l'application depuis l'explorateur, le chemin de travail est le répertoire de l'exécutable, mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...) alors le chemin de travail peut être le répertoire du _projet_. Ca peut normalement être changé facilement dans les options de votre projet.

Les shaders peuvent aussi être chargés directement depuis une chaîne de caractères, avec la fonction `loadFromMemory`. Ca peut être utile si vous voulez embarquer les sources de vos shaders directement dans votre programme.

```
const std::string vertexShader = \
    "void main()" \
    "{" \
    "    ..." \
    "}";

const std::string fragmentShader = \
    "void main()" \
    "{" \
    "    ..." \
    "}";

// charge uniquement le vertex shader
if (!shader.loadFromMemory(vertexShader, sf::Shader::Vertex))
{
    // erreur...
}

// charge uniquement le fragment shader
if (!shader.loadFromMemory(fragmentShader, sf::Shader::Fragment))
{
    // erreur...
}

// charge les deux
if (!shader.loadFromMemory(vertexShader, fragmentShader))
{
    // erreur...
}
```

Enfin, comme toutes les autres ressources SFML, les shaders peuvent être chargés depuis un [flux de données personnalisé](https://www.sfml-dev.org/tutorials/2.6/system-stream-fr.php "Tutoriel sur les flux de données") avec la fonction `loadFromStream`.

Si le chargement échoue, n'oubliez pas de vérifier la sortie standard (la console) pour voir le rapport détaillé du compilateur GLSL.

## [Utiliser un shader](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#utiliser-un-shader)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Utiliser un shader est facile : passez-le comme paramètre supplémentaire à la fonction `draw`.

```
window.draw(whatever, &shader);
```

## [Passer des variables à un shader](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#passer-des-variables-ce-un-shader)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Comme tout programme, un shader peut recevoir des paramètres de manière à se comporter différemment d'une exécution à l'autre, selon le contexte. Ces paramètres sont déclarés en tant que variables globales dans le shader, appelées variables _uniformes_.

```
uniform float myvar;

void main()
{
    // utilisation de myvar...
}
```

Les variables uniformes peuvent être modifiées depuis le programme C++, en utilisant les diverses surcharges de la fonction `setUniform` de la classe [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation").

```
shader.setUniform("myvar", 5.f);
```

Les surcharges de `setUniform` supportent tous les types fournis par SFML :

- `float` (type GLSL `float`)
- `2 floats, sf::Vector2f` (type GLSL `vec2`)
- `3 floats, sf::Vector3f` (type GLSL `vec3`)
- `4 floats` (type GLSL `vec4`)
- `sf::Color` (type GLSL `vec4`)
- `sf::Transform` (type GLSL `mat4`)
- `sf::Texture` (type GLSL `sampler2D`)

Lors de son processus d'optimisation, le compilateur GLSL vire les variables inutilisées (ici, "inutilisée" signifie "n'intervenant pas dans le calcul du vertex/pixel final"). Ne soyez donc pas surpris si vous obtenez des erreurs telles que Failed to find variable "xxx" in shader lorsque vous appelez `setUniform`, durant vos tests.

## [Shaders minimaux](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#shaders-minimaux)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Vous n'apprendrez pas ici à écrire des shaders GLSL, mais vous devez au moins savoir ce que SFML envoie en entrée de vos shaders, et ce que vous êtes supposé en faire.

### Vertex shader

SFML définit un format figé de vertex, décrit par la structure [`sf::Vertex`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Vertex.php "sf::Vertex documentation"). Un vertex SFML possède une position 2D, une couleur, et des coordonnées de texture 2D. Et c'est exactement ce qu'un vertex shader va recevoir en entrée, respectivement dans les variables prédéfinies `gl_Vertex`, `gl_Color` et `gl_MultiTexCoord0` (vous n'avez pas besoin de les déclarer).

```
void main()
{
    // transforme la position du vertex
    gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;

    // transforme les coordonnées de texture
    gl_TexCoord[0] = gl_TextureMatrix[0] * gl_MultiTexCoord0;

    // transmet la couleur
    gl_FrontColor = gl_Color;
}
```

La position doit être transformée par la matrice de modèle-vue, qui contient la transformation de l'entité combinée à la vue courante. Les coordonnées de texture doivent être transformées par la matrice de texture (cette texture ne signifie rien pour vous, c'est un détail d'implémentation de SFML). Et enfin, la couleur doit juste être transmise telle quelle. Bien entendu, vous pouvez omettre le traitement des coordonnées de texture ou bien de la couleur si vous n'en avez pas besoin.  
Toutes ces variables sont ensuite interpolées au pixel par la carte graphique, puis transmises au fragment shader.

### Fragment shader

Le fragment shader est assez similaire : il reçoit les coordonnées de texture et la couleur du pixel courant. Il n'y a plus de position, à ce point du rendu la carte graphique a déjà calculé la position finale du pixel. Cependant, si vous traitez des entités texturées, vous aurez aussi besoin d'accéder à leur texture.

```
uniform sampler2D texture;

void main()
{
    // récupère le pixel dans la texture
    vec4 pixel = texture2D(texture, gl_TexCoord[0].xy);

    // et multiplication avec la couleur pour obtenir le pixel final
    gl_FragColor = gl_Color * pixel;
}
```

La gestion de la texture n'est pas automatique : vous devez la gérer comme une variable uniforme standard, et donc la passer explicitement depuis votre programme C++. Etant donné que chaque entité peut avoir une texture différente, et pire, qu'il ne peut y avoir aucun moyen pour vous de la récupérer et la passer au shader, SFML fournit une surcharge spéciale de la fonction `setUniform` qui fait tout ça pour vous.

```
shader.setUniform("texture", sf::Shader::CurrentTexture);
```

Ce paramètre un peu spécial affecte la texture de l'entité en cours de dessin à la variable de shader donnée. A chaque fois qu'une nouvelle entité est dessinée, SFML met à jour la variable correspondante dans le shader.

Si vous voulez voir des shaders sympas en action, vous pouvez regarder l'exemple "Shader" du SDK de SFML.

## [Utiliser sf::Shader avec du code OpenGL](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#utiliser-sfshader-avec-du-code-opengl)[](https://www.sfml-dev.org/tutorials/2.6/graphics-shader-fr.php#top "Haut de la page")

Si vous utilisez OpenGL plutôt que les entités graphiques de SFML, vous pouvez toujours utiliser la classe [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation") comme wrapper de shader OpenGL, et la faire intéragir avec vos entités OpenGL.

Pour activer un [`sf::Shader`](https://www.sfml-dev.org/documentation/2.6.0-fr/classsf_1_1Shader.php "sf::Shader documentation") (l'équivalent de `glUseProgram`), vous devez appeler la fonction statique `bind` :

```
sf::Shader shader;
...

// active le shader
sf::Shader::bind(&shader);

// dessinez vos entités OpenGL ici...

// n'active aucun shader
sf::Shader::bind(NULL);
```