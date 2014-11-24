<?php

    $title = "Ajouter des post-effects";
    $page = "graphics-postfx-fr.php";

    require("header-fr.php");
?>

<h1>Ajouter des post-effects</h1>

<?php h2('Introduction') ?>
<p>
    Avec l'�volution des cartes graphiques, l'utilisation des shaders est devenue incontournable dans les applications
    graphiques. Ils permettent de personnaliser facilement et compl�tement les transformations des sommets et des pixels.
    Etant donn� que le module graphique de la SFML traite principalement de graphisme en 2D, nous ne nous int�resserons
    qu'aux pixel shaders, et � ce qu'on appelle les <em>post-effects</em>.
</p>
<p>
    Les post-effects sont des effets de pixels appliqu�s � l'�cran tout entier, apr�s que vous ayiez affich� tous
    vos objet graphiques. Les post-effects bien connus sont par exemple noir-et-blanc, <em>glow</em> (ajout de lueur),
    HDRL (<em>high dynamic range lighting</em>), etc.
</p>
<p>
    SFML d�finit une classe pour cr�er et appliquer facilement des effets : <?php class_link("PostFX")?>. Regardons comment
    cr�er un post-effect, et comment le manipuler dans un programme.
</p>

<?php h2('Ecrire un post-effect') ?>
<p>
    Les effets SFML reposent sur la syntaxe des <em>fragment shaders</em> GLSL. En fait, les post-effects SFML
    <em>sont</em> des <em>fragment shaders</em>, avec quelques modifications mineures pour cacher les morceaux de syntaxe
    compliqu�s. Etant donn� que 99% de la syntaxe est du GLSL pur, je vous sugg�re de vous procurer une documentation
    de r�f�rence avant de commencer � �crire vos propres effets. Voici quelques bons liens :
</p>
<ul>
    <li><a class="external" href="http://www.opengl.org/sdk/libs/OpenSceneGraph/glsl_quickref.pdf" title="T�l�charger la r�f�rence GLSL">GLSL quick reference : toute la syntaxe GLSL r�sum�e en 2 pages</a></li>
    <li><a class="external" href="http://en.wikipedia.org/wiki/GLSL" title="Lire la d�finition de GLSL sur Wikip�dia">D�finition de GLSL sur Wikip�dia : une approche simple et beaucoup de bons liens</a></li>
    <li><a class="external" href="http://www.lighthouse3d.com/opengl/glsl/index.php?intro" title="Aller au tutoriel GLSL de LightHouse3D GLSL">Tutoriel de LightHouse 3D : un tutoriel sympa pour d�buter avec GLSL</a></li>
    <li><a class="external" href="http://nehe.gamedev.net/data/articles/article.asp?article=21" title="Aller au tutoriel GLSL de NeHe">Tutoriel GLSL de NeHe : un autre bon tutoriel</a></li>
</ul>
<p>
    Mais ne vous inqui�tez pas, vous pouvez commencer � �crire des effets sympas avec une syntaxe tr�s simple, comme nous
    allons le voir dans l'exemple qui suit.
</p>

<p>
    Nous allons donc �crire un exemple simple, pour vous montrer comment un effet fonctionne. Nous allons construire
    un effet qui colore l'�cran, avec une couleur perso qui pourra �tre chang�e durant l'ex�cution. Le nom de l'effet est
    colorize.sfx, le fichier correspondant peut �tre t�l�charg� � la fin de ce tutoriel.
</p>
<p>
    La premi�re partie d'un effet est la d�claration des variables. Il s'agit d'une s�quence de lignes comportant le
    type des variables et leur nom :
<pre><code class="cpp">texture framebuffer
vec3 color
</code></pre>
<p>
    Ici, nous d�finissons une texture nomm�e <code>framebuffer</code>, et un <em>vector3</em> (contenant 3 composantes
    x, y et z) nomm� <code>color</code>. Les types de variables valides sont ceux d�finis par GLSL, plus
    <code>texture</code>, qui n'est qu'un raccourci pour <code>uniform sampler2D</code>. Toutes les variables sont
    automatiquement rendues uniformes, ce qui signifie que leur valeur pourra �tre modifi�e par votre programme C++.

</p>
<p>
    Puis, vous pouvez �crire le code de l'effet, qui sera toujours � l'int�rieur d'un bloc <code>effect { ... }</code>.
</p>
<pre><code class="cpp">effect
{
    // On r�cup�re la valeur du pixel courant de l'�cran
    vec4 pixel = framebuffer(_in);

    // On calcule son niveau de gris
    float gray = pixel.r * 0.39 + pixel.g * 0.50 + pixel.b * 0.11;

    // On �crit enfin le pixel final, en utilisant 50% du pixel de l'�cran et 50% de sa version color�e

    _out = vec4(gray * color, 1.0) * 0.5 + pixel * 0.5;
}
</code></pre>
<p>
    SFML d�finit deux variables particuli�res : <code>_in</code> contient les coordonn�es du pixel courant (gl_TexCoords[0]),
    et <code>_out</code> est la valeur de pixel � �crire (gl_FragColor).
</p>
<p>
    Pour acc�der aux pixels d'une texture, la syntaxe est semblable � celle d'un appel de fonction : la fonction est
    le nom de la texture (ici <code>framebuffer</code>) est le param�tre est une variable de type <code>vec2</code>,
    repr�sentant les coordonn�es du pixel dans l'intervalle [0, 1] (ici nous utilisons <code>_in</code>). Le r�sultat est
    une variable de type <code>vec4</code>, qui contient les composantes rouge, vert, bleu et alpha du pixel lu.

</p>
<p>
    Une fois qu'on a lu le pixel courant de l'�cran, on peut lui appliquer un traitement. Pour commencer, on calcule
    son niveau de gris en utilisant la formule standard (39% de rouge + 50% de vert + 11% de bleu). On peut ensuite
    le moduler avec notre couleur perso, et �crire le r�sultat dans la variable <code>_out</code>.
</p>
<p>
    C'est tout, vous avez maintenant un effet SFML qui va colorer votre �cran en utilisant une couleur personnalisable.
    Regardons maintenant la partie C++, et comment utiliser cet effet.
</p>

<?php h2('Charger et utiliser un post-effect') ?>
<p>
    Avant de charger le moindre effet, vous devez vous assurer que le syst�me peut le faire tourner. Les vieilles cartes
    graphiques ne supportent pas les shaders, et essayer d'ex�cuter un post-effect sur celles-ci r�sulterait en un �chec.
    SFML fournit une fonction pour v�rifier rapidement si le syst�me supporte les effets :

</p>
<pre><code class="cpp">if (sf::PostFX::CanUsePostFX() == false)
{
    // Les post-effects ne sont pas support�s...
}
</code></pre>
<p>
    Si votre syst�me est ok pour ex�cuter les post-effects, vous pouvez ensuite en charger un avec la fonction
    <code>LoadFromFile</code> :

</p>
<pre><code class="cpp">sf::PostFX Effect;
if (!Effect.LoadFromFile("colorize.sfx"))
{
    // Le chargement a �chou�...
}
</code></pre>
<p>
    Vous pouvez �galement charger un effet directement � partir du code en m�moire avec la fonction
    <code>LoadFromMemory</code> :

</p>
<pre><code class="cpp">sf::PostFX Effect;
std::string Code = "... beaucoup de code ...";
if (!Effect.LoadFromMemory(Code))
{
    // Le chargement a �chou�...
}
</code></pre>
<p>
    Ces fonctions renvoient <code>false</code> si quoique ce soit a �chou� durant le chargement. Dans ce cas,
    vous pouvez obtenir un log de compilation d�taill� sur la sortie d'erreur standard.

</p>
<p>
    Avant de d�marrer la boucle de rendu, vous devez initialiser les variables d�finies dans votre effet.
    Souvenez-vous, nous avons une texture appel�e <code>framebuffer</code> et un vecteur appel� <code>color</code>.
</p>
<pre><code class="cpp">Effect.SetTexture("framebuffer", NULL);
Effect.SetParameter("color", 1.f, 1.f, 1.f);
</code></pre>

<p>
    La fonction <code>SetTexture</code> est utilis�e pour associer une image � une texture de l'effet. Le premier
    param�tre est le nom de la texture dans l'effet, le second est un pointeur vers l'image, sous forme de <?php class_link("Image")?>.
    Passer <code>NULL</code> signifie que vous voulez utiliser le contenu de l'�cran.
</p>
<p>
    Pour initialiser tout autre type de param�tre, vous pouvez utiliser les fonctions <code>SetParameter</code>.
    Le premier param�tre est le nom du param�tre dans l'effet, puis, selon le type du param�tre, vous pouvez passer
    1, 2, 3 ou 4 flottants. Ici nous avons une variable <code>vec3</code>, nous passons donc 3 valeurs. Les valeurs pour
    les couleurs sont dans l'intervalle [0, 1], ici nous avons donc d�fini une couleur blanche.
</p>
<p>
    Vous pouvez ensuite utiliser ces fonctions � n'importe quel moment pour changer les valeurs des param�tres. Par
    exemple, si nous voulons faire d�pendre la couleur de la position de la souris, nous pouvons ajouter ce code
    � notre boucle de rendu :</p>
<pre><code class="cpp">// On r�cup�re la position de la souris dans l'intervalle [0, 1]
float X = App.GetInput().GetMouseX() / static_cast&lt;float&gt;(App.GetWidth());
float Y = App.GetInput().GetMouseY() / static_cast&lt;float&gt;(App.GetHeight());

// On met � jour les param�tres de l'effet
Effect.SetParameter("color", 0.5f, X, Y);
</code></pre>
<p>
    Enfin, vous appliquez l'effet en le dessinant, comme n'importe quel objet affichable :
</p>
<pre><code class="cpp">App.Draw(Effect);
</code></pre>
<p>
    Notez que l'entr�e de l'effet sera le contenu de l'�cran au moment o� vous appliquez l'effet. Cela signifie que
    tout objet dessin� apr�s la ligne ci-dessus (et avant l'appel � <code>App.Display()</code>) ne sera pas affect�
    par l'effet. Cela vous permet d'exclure certains objets du post-effect, comme par exemple une interface utilisateur
    ou un morceau de texte qui serait affich� par dessus la sc�ne 2D.
</p>

<?php h2('Conclusion') ?>
<p>
    Vous pouvez maintenant �crire vos propres post-effects, et impl�menter toute sorte d'effets sympas auxquels vous
    pouvez penser. Gardez toujours une r�f�rence GLSL � port�e de main, et n'oubliez pas de v�rifier les logs de compilation
    lorsque vos effets �chouent ; il est facile d'introduire de b�tes erreurs de syntaxes dans un fichier effet.
</p>

<?php

    require("footer-fr.php");

?>
