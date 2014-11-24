<?php

    $title = "Effets sp�ciaux avec les shaders";
    $page = "graphics-shaders-fr.php";

    require("header-fr.php");

?>

<h1>Effets sp�ciaux avec les shaders</h1>

<?php h2('Introduction') ?>
<p>
    Un shader est un petit programme qui s'ex�cute directement sur la carte graphique, et qui permet au programmeur de d�crire les �tapes de rendu de mani�re
    plus simple et surtout plus flexible que d'utiliser les �tats et op�rations fig�s qu'OpenGL fournit. Cette flexibilit� permet aux shaders d'impl�menter
    des effets qui seraient compliqu�s, sinon impossibles, � d�crire avec les fonctions OpenGL standards : �clairage par pixel, ombres, etc. Les cartes
    graphiques actuelles, ainsi que les derni�res versions d'OpenGL, sont m�me compl�tement bas�es sur les shaders, et les vieux �tats et fonctions
    (ce qu'on appelle le "<em>fixed pipeline</em>") que vous avez l'habitude d'utiliser sont vou�s � dispara�tre.
</p>
<p>
    Les shaders sont �crits en GLSL (<em>OpenGL Shading Language</em>), tr�s similaire au langage C.
</p>
<p>
    Il existe deux types de shaders : les vertex shaders et les fragment (ou pixel) shaders. Les vertex shaders transforment la g�ometrie, alors que les fragment
    shaders s'occupent des pixels. Selon le type d'effet que vous voulez impl�menter, vous pouvez d�finir uniquement l'un ou l'autre, ou bien les deux.
</p>
<p>
    Pour comprendre ce que les shaders font, et comment les utiliser efficacement, il est important de conna�tre les bases du pipeline de rendu graphique. Vous devrez
    �galement apprendre � �crire des programmes GLSL, et trouver de bons tutoriels et exemples pour d�marrer. Vous pouvez aussi jeter un oeil � l'exemple "Shader" qui
    est fourni avec le SDK de SFML.
</p>
<p>
    Ce tutoriel va uniquement se concentrer sur les parties sp�cifiques � SFML : comment charger et appliquer des shaders -- pas comment les �crire.
</p>

<?php h2('Charger des shaders') ?>
<p>
    Dans SFML, les shaders sont repr�sent�s par la classe <?php class_link("Shader") ?>. Elle g�re � la fois les vertex et fragment shaders : un <?php class_link("Shader") ?>
    est une combinaison des deux (ou bien un seul, si l'autre n'est pas n�cessaire).
</p>
<p>
    M�me si les shaders sont maintenant tr�s r�pandus, il existe toujours des cartes graphiques suffisamment vieilles qui ne les supportent pas. La premi�re chose � faire
    dans votre programme est donc de v�rifier si les shaders sont disponibles :
</p>
<pre><code class="cpp">if (!sf::Shader::isAvailable())
{
    // les shaders ne sont pas dispo...
}
</code></pre>
<p>
    Toute tentative d'utiliser la classe <?php class_link("Shader") ?> �chouera si la fonction <code>sf::Shader::isAvailable()</code> renvoie <code>false</code>.
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
    Les shaders sont de simples fichiers texte (comme votre code C++), leur extension n'a donc pas grande importance, �a peut �tre n'importe quoi. ".vert" et ".frag"
    sont juste des conventions.
</p>
<p class="important">
    La fonction <code>loadFromFile</code> �choue parfois sans raison �vidente. Premi�rement, v�rifiez le message d'erreur affich� par SFML sur la sortie standard
    (v�rifiez la console). Si le message est <q>unable to open file</q>, assurez-vous que le <em>chemin de travail</em> (le chemin relativement auquel seront
    interpr�t�s tous les chemins de fichiers de votre programme) est celui que vous pensez : lorsque vous lancez l'application depuis l'explorateur, le chemin de travail
    est le r�pertoire de l'ex�cutable, mais si vous lancez votre programme depuis votre EDI (Visual Studio, Code::Blocks, ...) alors le chemin de travail peut �tre
    le r�pertoire du <em>projet</em>. Ca peut normalement �tre chang� facilement dans les options de votre projet.
</p>
<p>
    Les shaders peuvent aussi �tre charg�s directement depuis une cha�ne de caract�res, avec la fonction <code>loadFromMemory</code>. Ca peut �tre utile si vous voulez
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
    Enfin, comme toutes les autres ressources SFML, les shaders peuvent �tre charg�s depuis un
    <a href="./system-stream-fr.php" title="Tutoriel sur les flux de donn�es">flux de donn�es personnalis�</a> avec la fonction <code>loadFromStream</code>.
</p>
<p>
    Si le chargement �choue, n'oubliez pas de v�rifier la sortie standard (la console) pour voir le rapport d�taill� du compilateur GLSL.
</p>

<?php h2('Utiliser un shader') ?>
<p>
    Utiliser un shader est facile : passez-le comme param�tre suppl�mentaire � la fonction <code>draw</code>.
</p>
<pre><code class="cpp">window.draw(whatever, &amp;shader);
</code></pre>

<?php h2('Passer des variables � un shader') ?>
<p>
    Comme tout programme, un shader peut recevoir des param�tres de mani�re � se comporter diff�remment d'une ex�cution � l'autre, selon le contexte. Ces param�tres
    sont d�clar�s en tant que variables globales dans le shader, appel�es variables <em>uniformes</em>.
</p>
<pre><code class="glsl">uniform float myvar;

void main()
{
    // utilisation de myvar...
}
</code></pre>
<p>
    Les variables uniformes peuvent �tre modifi�es depuis le programme C++, en utilisant les diverses surcharges de la fonction <code>setParameter</code> de la classe
    <?php class_link("Shader") ?>.
</p>
<pre><code class="cpp">shader.setParameter("myvar", 5.f);
</code></pre>
<p>
    Les surcharges de <code>setParameter</code> supportent tous les types fournis par SFML :
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
    Lors de son processus d'optimisation, le compilateur GLSL vire les variables inutilis�es (ici, "inutilis�e" signifie "n'intervenant pas dans le calcul du vertex/pixel final").
    Ne soyez donc pas surpris si vous obtenez des erreurs telles que <q>Failed to find variable "xxx" in shader</q> lorsque vous appelez <code>setParameter</code>, durant
    vos tests.
</p>

<?php h2('Shaders minimaux') ?>
<p>
    Vous n'apprendrez pas ici � �crire des shaders GLSL, mais vous devez au moins savoir ce que SFML envoie en entr�e de vos shaders, et ce que vous �tes suppos� en faire.
</p>

<h3>Vertex shader</h3>
<p>
    SFML d�finit un format fig� de vertex, d�crit par la structure <?php class_link("Vertex") ?>. Un vertex SFML poss�de une position 2D, une couleur, et des coordonn�es
    de texture 2D. Et c'est exactement ce qu'un vertex shader va recevoir en entr�e, respectivement dans les variables pr�d�finies <code>gl_Vertex</code>,
    <code>gl_MultiTexCoord0</code> et <code>gl_Color</code> (vous n'avez pas besoin de les d�clarer).
</p>
<pre><code class="glsl">void main()
{
    // transforme la position du vertex
    gl_Position = gl_ModelViewProjectionMatrix * gl_Vertex;

    // transforme les coordonn�es de texture
    gl_TexCoord[0] = gl_TextureMatrix[0] * gl_MultiTexCoord0;

    // transmet la couleur
    gl_FrontColor = gl_Color;
}
</code></pre>
<p>
    La position doit �tre transform�e par la matrice de mod�le-vue, qui contient la transformation de l'entit� combin�e � la vue courante. Les coordonn�es de texture doivent
    �tre transform�es par la matrice de texture (cette texture ne signifie rien pour vous, c'est un d�tail d'impl�mentation de SFML). Et enfin, la couleur doit juste �tre
    transmise telle quelle. Bien entendu, vous pouvez omettre le traitement des coordonn�es de texture ou bien de la couleur si vous n'en avez pas besoin.<br/>
    Toutes ces variables sont ensuite interpol�es au pixel par la carte graphique, puis transmises au fragment shader.
</p>

<h3>Fragment shader</h3>
<p>
    Le fragment shader est assez similaire : il re�oit les coordonn�es de texture et la couleur du pixel courant. Il n'y a plus de position, � ce point du rendu la
    carte graphique a d�j� calcul� la position finale du pixel. Cependant, si vous traitez des entit�s textur�es, vous aurez aussi besoin d'acc�der � leur texture.
</p>
<pre><code class="glsl">uniform sampler2D texture;

void main()
{
    // r�cup�re le pixel dans la texture
    vec4 pixel = texture2D(texture, gl_TexCoord[0].xy);

    // et multiplication avec la couleur pour obtenir le pixel final
    gl_FragColor = gl_Color * pixel;
}
</code></pre>
<p>
    La gestion de la texture n'est pas automatique : vous devez la g�rer comme une variable uniforme standard, et donc la passer explicitement depuis votre programme C++.
    Etant donn� que chaque entit� peut avoir une texture diff�rente, et pire, qu'il ne peut y avoir aucun moyen pour vous de la r�cup�rer et la passer au shader, SFML
    fournit une surcharge sp�ciale de la fonction <code>setParameter</code> qui fait tout �a pour vous.
</p>
<pre><code class="cpp">shader.setParameter("texture", sf::Shader::CurrentTexture);
</code></pre>
<p>
    Ce param�tre un peu sp�cial affecte la texture de l'entit� en cours de dessin � la variable de shader donn�e. A chaque fois qu'une nouvelle entit� est dessin�e,
    SFML met � jour la variable correspondante dans le shader.
</p>
<p>
    Si vous voulez voir des shaders sympas en action, vous pouvez regarder l'exemple "Shader" du SDK de SFML.
</p>

<?php h2('Utiliser sf::Shader avec du code OpenGL') ?>
<p>
    Si vous utilisez OpenGL plut�t que les entit�s graphiques de SFML, vous pouvez toujours utiliser la classe <?php class_link("Shader") ?> comme wrapper de shader
    OpenGL, et la faire int�ragir avec vos entit�s OpenGL.
</p>
<p>
    Pour activer un <?php class_link("Shader") ?> (l'�quivalent de <code>glUseProgram</code>), vous devez appeler la fonction statique <code>bind</code> :
</p>
<pre><code class="cpp">sf::Shader shader;
...

// active le shader
sf::Shader::bind(&amp;shader);

// dessinez vos entit�s OpenGL ici...

// n'active aucun shader
sf::Shader::bind(NULL);
</code></pre>

<?php

    require("footer-fr.php");

?>
