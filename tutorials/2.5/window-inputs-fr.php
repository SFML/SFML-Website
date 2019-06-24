<?php

    $title = "Clavier, souris et joysticks";
    $page = "window-inputs-fr.php";

    require("header-fr.php");

?>

<h1>Clavier, souris et joysticks</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel explique comment accéder aux entrées globales : clavier, souris et joysticks. Ces fonctionnalités ne sont en aucun cas à confondre avec
    les évènements : les entrées temps-réel vous permettent de vérifier l'état courant du clavier, de la souris et des joysticks à n'importe quel moment
    ("<em>est-ce que ce bouton est actuellement pressé ?</em>", "<em>où se trouve la souris ?</em>"), alors que les évènements vous préviennent
    lorsque quelque chose change ("<em>ce bouton a été pressé</em>", "<em>la souris a bougé</em>").
</p>

<?php h2('Le clavier') ?>
<p>
    La classe qui donne accès à l'état du clavier est <?php class_link("Keyboard") ?>. Elle contient une unique fonction, <code>isKeyPressed</code>,
    qui donne l'état courant d'une touche (appuyée ou relâchée). C'est une fonction statique, vous n'avez pas besoin d'instancier
    <?php class_link("Keyboard") ?> pour l'utiliser.
</p>
<p>
    Cette fonction lit directement l'état du clavier, sans chercher à savoir si votre fenêtre a le focus ou non. Cela signifie que <code>isKeyPressed</code>
    peut renvoyer <code>true</code> même si votre fenêtre est inactive.
</p>
<pre><code class="cpp">if (sf::Keyboard::isKeyPressed(sf::Keyboard::Left))
{
    // la touche "flèche gauche" est enfoncée : on bouge le personnage
    character.move(1.f, 0.f);
}
</code></pre>
<p>
    Les codes de touches sont définis dans l'enum <code>sf::Keyboard::Key</code>.
</p>
<p class="important">
    Certaines touches peuvent manquer, ou être interprétées de manière incorrecte selon votre OS et l'agencement de votre clavier. C'est un aspect qui
    fera l'objet d'améliorations dans une future version de SFML.
</p>

<?php h2('La souris') ?>
<p>
    La classe qui donne accès à l'état de la souris est <?php class_link("Mouse") ?>. Comme son copain <?php class_link("Keyboard") ?>, elle ne contient
    que des fonctions statiques et n'est pas censée être instanciée (SFML gère une souris unique pour le moment).
</p>
<p>
    Vous pouvez vérifier si un bouton est pressé :
</p>
<pre><code class="cpp">if (sf::Mouse::isButtonPressed(sf::Mouse::Left))
{
    // le bouton gauche est enfoncé : on tire
    gun.fire();
}
</code></pre>
<p>
    Les codes de boutons sont définis dans l'enum <code>sf::Mouse::Button</code>. SFML supporte jusqu'à 5 boutons : gauche, droit, milieu (molette),
    plus deux autres boutons peu importe ce qu'ils représentent.
</p>
<p>
    Vous pouvez aussi récupérer ou changer la position courante de la souris, relativement au bureau ou à une fenêtre particulière.
</p>
<pre><code class="cpp">// on lit la position globale de la souris (relativement au bureau)
sf::Vector2i globalPosition = sf::Mouse::getPosition();

// on lit la position locale de la souris (relativement à une fenêtre)
sf::Vector2i localPosition = sf::Mouse::getPosition(window); // window est un sf::Window
</code></pre>
<pre><code class="cpp">// on change la position globale de la souris (relativement au bureau)
sf::Mouse::setPosition(sf::Vector2i(10, 50));

// on change la position locale de la souris (relativement à une fenêtre)
sf::Mouse::setPosition(sf::Vector2i(10, 50), window); // window est un sf::Window
</code></pre>
<p>
    Il n'y a pas de fonction pour récupérer l'état de la molette. En effet, celle-ci n'effectue que des mouvements relatifs et n'a pas d'état absolu.
    En regardant une touche du clavier on peut dire si elle est enfoncée ou relâchée ; en regardant le curseur de la souris on peut dire où il se
    trouve à l'écran ; mais en regardant la molette de la souris on ne peut pas savoir sur quel "cran" elle se trouve. On peut uniquement savoir
    quand elle bouge (évènement <code>MouseWheelScrolled</code>).
</p>

<?php h2('Les joysticks') ?>
<p>
    La classe qui donne accès à l'état des joysticks est <?php class_link("Joystick") ?>. Comme les autres classes de ce tutoriel, elle ne contient que
    des fonctions statiques.
</p>
<p>
    Les joysticks sont identifiés par leur numéro (de 0 à 7, puisque SFML supporte jusqu'à 8 joysticks). Ainsi, le premier paramètre de toutes les
    fonctions de <?php class_link("Joystick") ?> est le numéro du joystick dont vous voulez lire l'état.
</p>
<p>
    Vous pouvez vérifier si un joystick est connecté ou non :
</p>
<pre><code class="cpp">if (sf::Joystick::isConnected(0))
{
    // le joystick numéro 0 est connecté
    ...
}
</code></pre>
<p>
    Vous pouvez aussi récupérer les capacités d'un joystick connecté :
</p>
<pre><code class="cpp">// combien de boutons le joystick numéro 0 a-t-il ?
unsigned int buttonCount = sf::Joystick::getButtonCount(0);

// est-ce que le joystick numéro 0 possède un axe Z ?
bool hasZ = sf::Joystick::hasAxis(0, sf::Joystick::Z);
</code></pre>
<p>
    Les axes de joysticks sont définis dans l'enum <code>sf::Joystick::Axis</code>. Etant donné qu'ils n'ont aucune signification particulière,
    les boutons sont quant à eux simplement numérotés de 0 à 31.
</p>
<p>
    Enfin, vous pouvez bien entendu récupérer l'état des boutons et des axes d'un joystick :
</p>
<pre><code class="cpp">// est-ce que le bouton 1 du joystick numéro 0 est enfoncé ?
if (sf::Joystick::isButtonPressed(0, 1))
{
    // oui : on shoot !!
    gun.fire();
}

// quelle est la position actuelle des axes X et Y du joystick numéro 0 ?
float x = sf::Joystick::getAxisPosition(0, sf::Joystick::X);
float y = sf::Joystick::getAxisPosition(0, sf::Joystick::Y);
character.move(x, y);
</code></pre>
<p class="important">
    L'état des joysticks est automatiquement mis à jour par la boucle d'évènements. Si vous n'en avez pas, ou si vous voulez vérifier l'état d'un joystick
    (par exemple, voir quels joysticks sont connectés) avant de lancer votre boucle de jeu, vous devrez appeler la fonction <code>sf::Joystick::update()</code>
    afin d'être sûr que l'état des joysticks est à jour.
</p>

<?php

    require("footer-fr.php");

?>
