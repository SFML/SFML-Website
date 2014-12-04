<?php

    $title = "Ajouter des post-effects";
    $page = "graphics-postfx-fr.php";

    require("header-fr.php");
?>

<h1>Ajouter des post-effects</h1>

<?php h2('Introduction') ?>
<p>
    Avec l'évolution des cartes graphiques, l'utilisation des shaders est devenue incontournable dans les applications
    graphiques. Ils permettent de personnaliser facilement et complétement les transformations des sommets et des pixels.
    Etant donné que le module graphique de la SFML traite principalement de graphisme en 2D, nous ne nous intéresserons
    qu'aux pixel shaders, et à ce qu'on appelle les <em>post-effects</em>.
</p>
<p>
    Les post-effects sont des effets de pixels appliqués à l'écran tout entier, après que vous ayiez affiché tous
    vos objet graphiques. Les post-effects bien connus sont par exemple noir-et-blanc, <em>glow</em> (ajout de lueur),
    HDRL (<em>high dynamic range lighting</em>), etc.
</p>
<p>
    SFML définit une classe pour créer et appliquer facilement des effets : <?php class_link("PostFX")?>. Regardons comment
    créer un post-effect, et comment le manipuler dans un programme.
</p>

<?php h2('Ecrire un post-effect') ?>
<p>
    Les effets SFML reposent sur la syntaxe des <em>fragment shaders</em> GLSL. En fait, les post-effects SFML
    <em>sont</em> des <em>fragment shaders</em>, avec quelques modifications mineures pour cacher les morceaux de syntaxe
    compliqués. Etant donné que 99% de la syntaxe est du GLSL pur, je vous suggère de vous procurer une documentation
    de référence avant de commencer à écrire vos propres effets. Voici quelques bons liens :
</p>
<ul>
    <li><a class="external" href="http://www.opengl.org/sdk/libs/OpenSceneGraph/glsl_quickref.pdf" title="Télécharger la référence GLSL">GLSL quick reference : toute la syntaxe GLSL résumée en 2 pages</a></li>
    <li><a class="external" href="http://en.wikipedia.org/wiki/GLSL" title="Lire la définition de GLSL sur Wikipédia">Définition de GLSL sur Wikipédia : une approche simple et beaucoup de bons liens</a></li>
    <li><a class="external" href="http://www.lighthouse3d.com/opengl/glsl/index.php?intro" title="Aller au tutoriel GLSL de LightHouse3D GLSL">Tutoriel de LightHouse 3D : un tutoriel sympa pour débuter avec GLSL</a></li>
    <li><a class="external" href="http://nehe.gamedev.net/data/articles/article.asp?article=21" title="Aller au tutoriel GLSL de NeHe">Tutoriel GLSL de NeHe : un autre bon tutoriel</a></li>
</ul>
<p>
    Mais ne vous inquiétez pas, vous pouvez commencer à écrire des effets sympas avec une syntaxe très simple, comme nous
    allons le voir dans l'exemple qui suit.
</p>

<p>
    Nous allons donc écrire un exemple simple, pour vous montrer comment un effet fonctionne. Nous allons construire
    un effet qui colore l'écran, avec une couleur perso qui pourra être changée durant l'exécution. Le nom de l'effet est
    colorize.sfx, le fichier correspondant peut être téléchargé à la fin de ce tutoriel.
</p>
<p>
    La première partie d'un effet est la déclaration des variables. Il s'agit d'une séquence de lignes comportant le
    type des variables et leur nom :
<pre><code class="cpp">texture framebuffer
vec3 color
</code></pre>
<p>
    Ici, nous définissons une texture nommée <code>framebuffer</code>, et un <em>vector3</em> (contenant 3 composantes
    x, y et z) nommé <code>color</code>. Les types de variables valides sont ceux définis par GLSL, plus
    <code>texture</code>, qui n'est qu'un raccourci pour <code>uniform sampler2D</code>. Toutes les variables sont
    automatiquement rendues uniformes, ce qui signifie que leur valeur pourra être modifiée par votre programme C++.

</p>
<p>
    Puis, vous pouvez écrire le code de l'effet, qui sera toujours à l'intérieur d'un bloc <code>effect { ... }</code>.
</p>
<pre><code class="cpp">effect
{
    // On récupère la valeur du pixel courant de l'écran
    vec4 pixel = framebuffer(_in);

    // On calcule son niveau de gris
    float gray = pixel.r * 0.39 + pixel.g * 0.50 + pixel.b * 0.11;

    // On écrit enfin le pixel final, en utilisant 50% du pixel de l'écran et 50% de sa version colorée

    _out = vec4(gray * color, 1.0) * 0.5 + pixel * 0.5;
}
</code></pre>
<p>
    SFML définit deux variables particulières : <code>_in</code> contient les coordonnées du pixel courant (gl_TexCoords[0]),
    et <code>_out</code> est la valeur de pixel à écrire (gl_FragColor).
</p>
<p>
    Pour accéder aux pixels d'une texture, la syntaxe est semblable à celle d'un appel de fonction : la fonction est
    le nom de la texture (ici <code>framebuffer</code>) est le paramètre est une variable de type <code>vec2</code>,
    représentant les coordonnées du pixel dans l'intervalle [0, 1] (ici nous utilisons <code>_in</code>). Le résultat est
    une variable de type <code>vec4</code>, qui contient les composantes rouge, vert, bleu et alpha du pixel lu.

</p>
<p>
    Une fois qu'on a lu le pixel courant de l'écran, on peut lui appliquer un traitement. Pour commencer, on calcule
    son niveau de gris en utilisant la formule standard (39% de rouge + 50% de vert + 11% de bleu). On peut ensuite
    le moduler avec notre couleur perso, et écrire le résultat dans la variable <code>_out</code>.
</p>
<p>
    C'est tout, vous avez maintenant un effet SFML qui va colorer votre écran en utilisant une couleur personnalisable.
    Regardons maintenant la partie C++, et comment utiliser cet effet.
</p>

<?php h2('Charger et utiliser un post-effect') ?>
<p>
    Avant de charger le moindre effet, vous devez vous assurer que le système peut le faire tourner. Les vieilles cartes
    graphiques ne supportent pas les shaders, et essayer d'exécuter un post-effect sur celles-ci résulterait en un échec.
    SFML fournit une fonction pour vérifier rapidement si le système supporte les effets :

</p>
<pre><code class="cpp">if (sf::PostFX::CanUsePostFX() == false)
{
    // Les post-effects ne sont pas supportés...
}
</code></pre>
<p>
    Si votre système est ok pour exécuter les post-effects, vous pouvez ensuite en charger un avec la fonction
    <code>LoadFromFile</code> :

</p>
<pre><code class="cpp">sf::PostFX Effect;
if (!Effect.LoadFromFile("colorize.sfx"))
{
    // Le chargement a échoué...
}
</code></pre>
<p>
    Vous pouvez également charger un effet directement à partir du code en mémoire avec la fonction
    <code>LoadFromMemory</code> :

</p>
<pre><code class="cpp">sf::PostFX Effect;
std::string Code = "... beaucoup de code ...";
if (!Effect.LoadFromMemory(Code))
{
    // Le chargement a échoué...
}
</code></pre>
<p>
    Ces fonctions renvoient <code>false</code> si quoique ce soit a échoué durant le chargement. Dans ce cas,
    vous pouvez obtenir un log de compilation détaillé sur la sortie d'erreur standard.

</p>
<p>
    Avant de démarrer la boucle de rendu, vous devez initialiser les variables définies dans votre effet.
    Souvenez-vous, nous avons une texture appelée <code>framebuffer</code> et un vecteur appelé <code>color</code>.
</p>
<pre><code class="cpp">Effect.SetTexture("framebuffer", NULL);
Effect.SetParameter("color", 1.f, 1.f, 1.f);
</code></pre>

<p>
    La fonction <code>SetTexture</code> est utilisée pour associer une image à une texture de l'effet. Le premier
    paramètre est le nom de la texture dans l'effet, le second est un pointeur vers l'image, sous forme de <?php class_link("Image")?>.
    Passer <code>NULL</code> signifie que vous voulez utiliser le contenu de l'écran.
</p>
<p>
    Pour initialiser tout autre type de paramètre, vous pouvez utiliser les fonctions <code>SetParameter</code>.
    Le premier paramètre est le nom du paramètre dans l'effet, puis, selon le type du paramètre, vous pouvez passer
    1, 2, 3 ou 4 flottants. Ici nous avons une variable <code>vec3</code>, nous passons donc 3 valeurs. Les valeurs pour
    les couleurs sont dans l'intervalle [0, 1], ici nous avons donc défini une couleur blanche.
</p>
<p>
    Vous pouvez ensuite utiliser ces fonctions à n'importe quel moment pour changer les valeurs des paramètres. Par
    exemple, si nous voulons faire dépendre la couleur de la position de la souris, nous pouvons ajouter ce code
    à notre boucle de rendu :</p>
<pre><code class="cpp">// On récupère la position de la souris dans l'intervalle [0, 1]
float X = App.GetInput().GetMouseX() / static_cast&lt;float&gt;(App.GetWidth());
float Y = App.GetInput().GetMouseY() / static_cast&lt;float&gt;(App.GetHeight());

// On met à jour les paramètres de l'effet
Effect.SetParameter("color", 0.5f, X, Y);
</code></pre>
<p>
    Enfin, vous appliquez l'effet en le dessinant, comme n'importe quel objet affichable :
</p>
<pre><code class="cpp">App.Draw(Effect);
</code></pre>
<p>
    Notez que l'entrée de l'effet sera le contenu de l'écran au moment où vous appliquez l'effet. Cela signifie que
    tout objet dessiné après la ligne ci-dessus (et avant l'appel à <code>App.Display()</code>) ne sera pas affecté
    par l'effet. Cela vous permet d'exclure certains objets du post-effect, comme par exemple une interface utilisateur
    ou un morceau de texte qui serait affiché par dessus la scène 2D.
</p>

<?php h2('Conclusion') ?>
<p>
    Vous pouvez maintenant écrire vos propres post-effects, et implémenter toute sorte d'effets sympas auxquels vous
    pouvez penser. Gardez toujours une référence GLSL à portée de main, et n'oubliez pas de vérifier les logs de compilation
    lorsque vos effets échouent ; il est facile d'introduire de bêtes erreurs de syntaxes dans un fichier effet.
</p>

<?php

    require("footer-fr.php");

?>
