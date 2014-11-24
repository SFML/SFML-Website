<?php

    $title = "Clavier, souris et joysticks";
    $page = "window-inputs-fr.php";

    require("header-fr.php");

?>

<h1>Clavier, souris et joysticks</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel explique comment acc�der aux entr�es globales : clavier, souris et joysticks. Ces fonctionnalit�s ne sont en aucun cas � confondre avec
    les �v�nements : les entr�es temps-r�el vous permettent de v�rifier l'�tat courant du clavier, de la souris et des joysticks � n'importe quel moment
    ("<em>est-ce que ce bouton est actuellement press� ?</em>", "<em>o� se trouve la souris ?</em>"), alors que les �v�nements vous pr�viennent
    lorsque quelque chose change ("<em>ce bouton a �t� press�</em>", "<em>la souris a boug�</em>").
</p>

<?php h2('Le clavier') ?>
<p>
    La classe qui donne acc�s � l'�tat du clavier est <?php class_link("Keyboard") ?>. Elle contient une unique fonction, <code>isKeyPressed</code>,
    qui donne l'�tat courant d'une touche (appuy�e ou rel�ch�e). C'est une fonction statique, vous n'avez pas besoin d'instancier
    <?php class_link("Keyboard") ?> pour l'utiliser.
</p>
<p>
    Cette fonction lit directement l'�tat du clavier, sans chercher � savoir si votre fen�tre a le focus ou non. Cela signifie que <code>isKeyPressed</code>
    peut renvoyer <code>true</code> m�me si votre fen�tre est inactive.
</p>
<pre><code class="cpp">if (sf::Keyboard::isKeyPressed(sf::Keyboard::Left))
{
    // la touche "fl�che gauche" est enfonc�e : on bouge le personnage
    character.move(1, 0);
}
</code></pre>
<p>
    Les codes de touches sont d�finis dans l'enum <code>sf::Keyboard::Key</code>.
</p>
<p class="important">
    Certaines touches peuvent manquer, ou �tre interpr�t�es de mani�re incorrecte selon votre OS et l'agencement de votre clavier. C'est un aspect qui
    fera l'objet d'am�liorations dans une future version de SFML.
</p>

<?php h2('La souris') ?>
<p>
    La classe qui donne acc�s � l'�tat de la souris est <?php class_link("Mouse") ?>. Comme son copain <?php class_link("Keyboard") ?>, elle ne contient
    que des fonctions statiques et n'est pas cens�e �tre instanci�e (SFML g�re une souris unique pour le moment).
</p>
<p>
    Vous pouvez v�rifier si un bouton est press� :
</p>
<pre><code class="cpp">if (sf::Mouse::isButtonPressed(sf::Mouse::Left))
{
    // le bouton gauche est enfonc� : on tire
    gun.fire();
}
</code></pre>
<p>
    Les codes de boutons sont d�finis dans l'enum <code>sf::Mouse::Button</code>. SFML supporte jusqu'� 5 boutons : gauche, droit, milieu (molette),
    plus deux autres boutons peu importe ce qu'ils repr�sentent.
</p>
<p>
    Vous pouvez aussi r�cup�rer ou changer la position courante de la souris, relativement au bureau ou � une fen�tre particuli�re.
</p>
<pre><code class="cpp">// on lit la position globale de la souris (relativement au bureau)
sf::Vector2i globalPosition = sf::Mouse::getPosition();

// on lit la position locale de la souris (relativement � une fen�tre)
sf::Vector2i localPosition = sf::Mouse::getPosition(window); // window est un sf::Window
</code></pre>
<pre><code class="cpp">// on change la position globale de la souris (relativement au bureau)
sf::Mouse::setPosition(sf::Vector2i(10, 50));

// on change la position locale de la souris (relativement � une fen�tre)
sf::Mouse::setPosition(sf::Vector2i(10, 50), window); // window est un sf::Window
</code></pre>
<p>
    Il n'y a pas de fonction pour r�cup�rer l'�tat de la molette. En effet, celle-ci n'effectue que des mouvements relatifs et n'a pas d'�tat absolu.
    En regardant une touche du clavier on peut dire si elle est enfonc�e ou rel�ch�e ; en regardant le curseur de la souris on peut dire o� il se
    trouve � l'�cran ; mais en regardant la molette de la souris on ne peut pas savoir sur quel "cran" elle se trouve. On peut uniquement savoir
    quand elle bouge (�v�nement <code>MouseWheelMoved</code>).
</p>

<?php h2('Les joysticks') ?>
<p>
    La classe qui donne acc�s � l'�tat des joysticks est <?php class_link("Joystick") ?>. Comme les autres classes de ce tutoriel, elle ne contient que
    des fonctions statiques.
</p>
<p>
    Les joysticks sont identifi�s par leur num�ro (de 0 � 7, puisque SFML supporte jusqu'� 8 joysticks). Ainsi, le premier param�tre de toutes les
    fonctions de <?php class_link("Joystick") ?> est le num�ro du joystick dont vous voulez lire l'�tat.
</p>
<p>
    Vous pouvez v�rifier si un joystick est connect� ou non :
</p>
<pre><code class="cpp">if (sf::Joystick::isConnected(0))
{
    // le joystick num�ro 0 est connect�
    ...
}
</code></pre>
<p>
    Vous pouvez aussi r�cup�rer les capacit�s d'un joystick connect� :
</p>
<pre><code class="cpp">// combien de boutons le joystick num�ro 0 a-t-il ?
unsigned int buttonCount = sf::Joystick::getButtonCount(0);

// est-ce que le joystick num�ro 0 poss�de un axe Z ?
bool hasZ = sf::Joystick::hasAxis(0, sf::Joystick::Z);
</code></pre>
<p>
    Les axes de joysticks sont d�finis dans l'enum <code>sf::Joystick::Axis</code>. Etant donn� qu'ils n'ont aucune signification particuli�re,
    les boutons sont quant � eux simplement num�rot�s de 0 � 31.
</p>
<p>
    Enfin, vous pouvez bien entendu r�cup�rer l'�tat des boutons et des axes d'un joystick :
</p>
<pre><code class="cpp">// est-ce que le bouton 1 du joystick num�ro 0 est enfonc� ?
if (sf::Joystick::isButtonPressed(0, 1))
{
    // oui : on shoot !!
    gun.fire();
}

// quelle est la position actuelle des axes X et Y du joystick num�ro 0 ?
float x = sf::Joystick::getAxisPosition(0, sf::Joystick::X);
float y = sf::Joystick::getAxisPosition(0, sf::Joystick::Y);
character.move(x, y);
</code></pre>
<p class="important">
    L'�tat des joysticks est automatiquement mis � jour par la boucle d'�v�nements. Si vous n'en avez pas, ou si vous voulez v�rifier l'�tat d'un joystick
    (par exemple, voir quels joysticks sont connect�s) avant de lancer votre boucle de jeu, vous devrez appeler la fonction <code>sf::Joystick::update()</code>
    afin d'�tre s�r que l'�tat des joysticks est � jour.
</p>

<?php

    require("footer-fr.php");

?>
