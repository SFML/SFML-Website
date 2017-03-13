<?php

    $title = "Effets spéciaux avec les shaders";
    $page = "graphics-shaders-fr.php";

    require("header-fr.php");

?>

<h1>Effets spéciaux avec les shaders</h1>

<?php h2('Introduction') ?>
<p>
    Un shader est un petit programme qui s'exécute directement sur la carte graphique, et qui permet au programmeur de décrire les étapes de rendu de manière
    plus simple et surtout plus flexible que d'utiliser les états et opérations figés qu'OpenGL fournit. Cette flexibilité permet aux shaders d'implémenter
    des effets qui seraient compliqués, sinon impossibles, à décrire avec les fonctions OpenGL standards : éclairage par pixel, ombres, etc. Les cartes
    graphiques actuelles, ainsi que les dernières versions d'OpenGL, sont même complètement basées sur les shaders, et les vieux états et fonctions
    (ce qu'on appelle le "<em>fixed pipeline</em>") que vous avez l'habitude d'utiliser sont voués à disparaître.
</p>
<p>
    Les shaders sont écrits en GLSL (<em>OpenGL Shading Language</em>), très similaire au langage C.
</p>
<p>
    Il existe deux types de shaders : les vertex shaders et les fragment (ou pixel) shaders. Les vertex shaders transforment la géometrie, alors que les fragment
    shaders s'occupent des pixels. Selon le type d'effet que vous voulez implémenter, vous pouvez définir uniquement l'un ou l'autre, ou bien les deux.
</p>
<p>
    Pour comprendre ce que les shaders font, et comment les utiliser efficacement, il est important de connaître les bases du pipeline de rendu graphique. Vous devrez
    également apprendre à écrire des programmes GLSL, et trouver de bons tutoriels et exemples pour démarrer. Vous pouvez aussi jeter un oeil à l'exemple "Shader" qui
    est fourni avec le SDK de SFML.
</p>
<p>
    Ce tutoriel va uniquement se concentrer sur les parties spécifiques à SFML : comment charger et appliquer des shaders -- pas comment les écrire.
</p>

<?php h2('Charger des shaders') ?>
<p>
    Dans SFML, les shaders sont représentés par la classe <?php class_link("Shader") ?>. Elle gère à la fois les vertex et fragment shaders : un <?php class_link("Shader") ?>
    est une combinaison des deux (ou bien un seul, si l'autre n'est pas nécessaire).
</p>
<p>
    Même si les shaders sont maintenant très répandus, il existe toujours des cartes graphiques suffisamment vieilles qui ne les supportent pas. La première chose à faire
    dans votre programme est donc de vérifier si les shaders sont disponibles :
</p>
<pre><code class="cpp">if (!sf::Shader::isAvailable())
{
    // les shaders ne sont pas dispo...
}
</code></pre>
<p>
    Toute tentative d'utiliser la classe <?php class_link("Shader") ?> échouera si la fonction <code>sf::Shader::isAvailable()</code> renvoie <code>false</code>.
</p>
<p>
    Le moyen le plus commun de charger un shader est depuis un fichier sur le disque, ce qui s'effectue avec la fonction <code>loadFromFile</code>.
</p>
<pre><code class="cpp">sf::Shader shader;

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
</code></pre>
<p>
    Les shaders sont de simples fichiers texte (comme votre code C++), leur extension n'a donc pas grande importance, ça peut être n'importe quoi. ".vert" et ".frag"
    sont juste des conventions.
</p>
<p class="important">
    La fonction <code>loadFromFile</code> échoue parfois sans raison évidente. Premièrement, vérifiez le message d'erreur affiché par SFML sur la sortie standard
    (vérifiez la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>chemin de travail</em> (le chemin relativement auquel seront
    interprétés tous les chemins de fichiers de votre programme) est celui que vous pensez : lorsque vous lancez l'application depuis l'explorateur, le chemin de travail
    est le répertoire de l'exécutable, mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...) alors le chemin de travail peut être
    le répertoire du <em>projet</em>. Ca peut normalement être changé facilement dans les options de votre projet.
</p>
<p>
    Les shaders peuvent aussi être chargés directement depuis une chaîne de caractères, avec la fonction <code>loadFromMemory</code>. Ca peut être utile si vous voulez
    embarquer les sources de vos shaders directement dans votre programme.
</p>
<pre><code class="cpp">const std::string vertexShader = \
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
</code></pre>
<p>
    Enfin, comme toutes les autres ressources SFML, les shaders peuvent être chargés depuis un
    <a href="./system-stream-fr.php" title="Tutoriel sur les flux de données">flux de données personnalisé</a> avec la fonction <code>loadFromStream</code>.
</p>
<p>
    Si le chargement échoue, n'oubliez pas de vérifier la sortie standard (la console) pour voir le rapport détaillé du compilateur GLSL.
</p>

<?php h2('Utiliser un shader') ?>
<p>
    Utiliser un shader est facile : passez-le comme paramètre supplémentaire à la fonction <code>draw</code>.
</p>
<pre><code class="cpp">window.draw(whatever, &amp;shader);
</code></pre>

<?php h2('Passer des variables à un shader') ?>
<p>
    Comme tout programme, un shader peut recevoir des paramètres de manière à se comporter différemment d'une exécution à l'autre, selon le contexte. Ces paramètres
    sont déclarés en tant que variables globales dans le shader, appelées variables <em>uniformes</em>.
</p>
<pre><code class="glsl">uniform float myvar;

void main()
{
    // utilisation de myvar...
}
</code></pre>
<p>
    Les variables uniformes peuvent être modifiées depuis le programme C++, en utilisant les diverses surcharges de la fonction <code>setUniform</code> de la classe
    <?php class_link("Shader") ?>.
</p>
<pre><code class="cpp">shader.setUniform("myvar", 5.f);
</code></pre>
<p>
    Les surcharges de <code>setUniform</code> supportent tous les types fournis par SFML :
</p>
<ul>
    <li><code>float</code> (type GLSL <code>float</code>)</li>
    <li><code>2 floats, sf::Vector2f</code> (type GLSL <code>vec2</code>)</li>
    <li><code>3 floats, sf::Vector3f</code> (type GLSL <code>vec3</code>)</li>
    <li><code>4 floats</code> (type GLSL <code>vec4</code>)</li>
    <li><code>sf::Color</code> (type GLSL <code>vec4</code>)</li>
    <li><code>sf::Transform</code> (type GLSL <code>mat4</code>)</li>
    <li><code>sf::Texture</code> (type GLSL <code>sampler2D</code>)</li>
</ul>
<p class="important">
    Lors de son processus d'optimisation, le compilateur GLSL vire les variables inutilisées (ici, "inutilisée" signifie "n'intervenant pas dans le calcul du vertex/pixel final").
    Ne soyez donc pas surpris si vous obtenez des erreurs telles que <q>Failed to find variable "xxx" in shader</q> lorsque vous appelez <code>setUniform</code>, durant
    vos tests.
</p>

<?php h2('Shaders minimaux') ?>
<p>
    Vous n'apprendrez pas ici à écrire des shaders GLSL, mais vous devez au moins savoir ce que SFML envoie en entrée de vos shaders, et ce que vous êtes supposé en faire.
</p>

<h3>Vertex shader</h3>
<p>
    SFML définit un format figé de vertex, décrit par la structure <?php class_link("Vertex") ?>. Un vertex SFML possède une position 2D, une couleur, et des coordonnées
    de texture 2D. Et c'est exactement ce qu'un vertex shader va recevoir en entrée, respectivement dans les variables prédéfinies <code>gl_Vertex</code>,
    <code>gl_Color</code> et <code>gl_MultiTexCoord0</code> (vous n'avez pas besoin de les déclarer).
</p>
<pre><code class="glsl">void main()
{
    // transforme la position du vertex
    gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;

    // transforme les coordonnées de texture
    gl_TexCoord[0] = gl_TextureMatrix[0] * gl_MultiTexCoord0;

    // transmet la couleur
    gl_FrontColor = gl_Color;
}
</code></pre>
<p>
    La position doit être transformée par la matrice de modèle-vue, qui contient la transformation de l'entité combinée à la vue courante. Les coordonnées de texture doivent
    être transformées par la matrice de texture (cette texture ne signifie rien pour vous, c'est un détail d'implémentation de SFML). Et enfin, la couleur doit juste être
    transmise telle quelle. Bien entendu, vous pouvez omettre le traitement des coordonnées de texture ou bien de la couleur si vous n'en avez pas besoin.<br/>
    Toutes ces variables sont ensuite interpolées au pixel par la carte graphique, puis transmises au fragment shader.
</p>

<h3>Fragment shader</h3>
<p>
    Le fragment shader est assez similaire : il reçoit les coordonnées de texture et la couleur du pixel courant. Il n'y a plus de position, à ce point du rendu la
    carte graphique a déjà calculé la position finale du pixel. Cependant, si vous traitez des entités texturées, vous aurez aussi besoin d'accéder à leur texture.
</p>
<pre><code class="glsl">uniform sampler2D texture;

void main()
{
    // récupère le pixel dans la texture
    vec4 pixel = texture2D(texture, gl_TexCoord[0].xy);

    // et multiplication avec la couleur pour obtenir le pixel final
    gl_FragColor = gl_Color * pixel;
}
</code></pre>
<p>
    La gestion de la texture n'est pas automatique : vous devez la gérer comme une variable uniforme standard, et donc la passer explicitement depuis votre programme C++.
    Etant donné que chaque entité peut avoir une texture différente, et pire, qu'il ne peut y avoir aucun moyen pour vous de la récupérer et la passer au shader, SFML
    fournit une surcharge spéciale de la fonction <code>setUniform</code> qui fait tout ça pour vous.
</p>
<pre><code class="cpp">shader.setUniform("texture", sf::Shader::CurrentTexture);
</code></pre>
<p>
    Ce paramètre un peu spécial affecte la texture de l'entité en cours de dessin à la variable de shader donnée. A chaque fois qu'une nouvelle entité est dessinée,
    SFML met à jour la variable correspondante dans le shader.
</p>
<p>
    Si vous voulez voir des shaders sympas en action, vous pouvez regarder l'exemple "Shader" du SDK de SFML.
</p>

<?php h2('Utiliser sf::Shader avec du code OpenGL') ?>
<p>
    Si vous utilisez OpenGL plutôt que les entités graphiques de SFML, vous pouvez toujours utiliser la classe <?php class_link("Shader") ?> comme wrapper de shader
    OpenGL, et la faire intéragir avec vos entités OpenGL.
</p>
<p>
    Pour activer un <?php class_link("Shader") ?> (l'équivalent de <code>glUseProgram</code>), vous devez appeler la fonction statique <code>bind</code> :
</p>
<pre><code class="cpp">sf::Shader shader;
...

// active le shader
sf::Shader::bind(&amp;shader);

// dessinez vos entités OpenGL ici...

// n'active aucun shader
sf::Shader::bind(NULL);
</code></pre>

<?php

    require("footer-fr.php");

?>
