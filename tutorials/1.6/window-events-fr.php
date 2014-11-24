<?php

    $title = "Gérer les évènements";
    $page = "window-events-fr.php";

    require("header-fr.php");
?>

<h1>Gérer les évènements</h1>

<?php h2('Introduction') ?>
<p>
    Dans le tutoriel précédent, nous avons appris à ouvrir une fenêtre mais nous n'avions aucun moyen de
    stopper l'application. Ici, nous allons apprendre à intercepter les évènements d'une fenêtre et à les
    gérer correctement.
</p>

<?php h2('Récupérer les évènements') ?>
<p>
    Typiquement, il existe deux façons de récupérer les évènements dans un système de fenêtrage :
</p>
<ul>
    <li>Vous pouvez demander à la fenêtre de vous donner les évènements en attente à chaque boucle ; c'est ce qu'on appelle le <em>polling</em></li>
    <li>Vous pouvez transmettre à la fenêtre un pointeur de fonction, et attendre que la fenêtre appelle
    votre fonction lorsqu'elle génère un évènement ; c'est ce qu'on appelle les fonctions de rappel ("callbacks")</li>
</ul>
<p>
    SFML utilise un système de <em>polling</em> pour récupérer les évènements. Ainsi, vous devez récupérer
    les évènements en attente à chaque boucle. La fonction à utiliser est <code>GetEvent</code>,
    qui remplira une instance de <?php class_link("Event")?> et renverra <code>true</code>
    s'il y avait un évènement en attente, ou renverra <code>false</code> si la pile d'évènements était vide.
</p>
<pre><code class="cpp">// Rappelez-vous que App est une instance de sf::Window

sf::Event Event;
if (App.GetEvent(Event))
{
    // Traitement de l'évènement
}
</code></pre>
<p>
    Mais il peut y avoir plus d'un évènement en attente à chaque boucle (les évènements sont stockés dans
    une pile à chaque boucle, et récupérer un évènement retire le premier élément de cette pile), et si
    vous n'en récupérez qu'un, les évènements peuvent s'accumuler et ne jamais être traités.<br/>
    La façon de faire correcte pour récupérer tous les évènements à chaque boucle, est de
    boucler jusqu'à ce qu'il n'y en n'ait plus en attente :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Traitement de l'évènement
}
</code></pre>
<p>
    "Eh, mais attendez une minute... où est-ce que je dois placer ce morceau de code, au fait ?".<br/>
    Comme les évènements doivent être traités à chaque tour de boucle, il est conseillé de placer
    la gestion des évènements au début de la boucle principale :
</p>
<pre><code class="cpp">while (Running)
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Traitement de l'évènement
    }

    App.Display();
}
</code></pre>

<?php h2('Traitement des évènements') ?>
<p>
    La première chose à faire lorsque vous recevez un évènement est d'interroger son type, stocké dans
    sa variable membre <code>Type</code>. SFML définit les types d'évènements suivant, tous
    dans la portée de la structure <?php class_link("Event")?> :
</p>
<ul>
    <li><code>Closed</code></li>
    <li><code>Resized</code></li>
    <li><code>LostFocus</code></li>
    <li><code>GainedFocus</code></li>
    <li><code>TextEntered</code></li>
    <li><code>KeyPressed</code></li>
    <li><code>KeyReleased</code></li>
    <li><code>MouseWheelMoved</code></li>
    <li><code>MouseButtonPressed</code></li>
    <li><code>MouseButtonReleased</code></li>
    <li><code>MouseMoved</code></li>
    <li><code>MouseEntered</code></li>
    <li><code>MouseLeft</code></li>
    <li><code>JoyButtonPressed</code></li>
    <li><code>JoyButtonReleased</code></li>
    <li><code>JoyMoved</code></li>
</ul>
<p>
    Selon le type d'évènement, l'instance d'évènement sera remplie avec différents paramètres :
</p>
<ul>
    <li>Evènements de taille (<code>Resized</code>)
        <ul>
            <li><code>Event.Size.Width</code> contient la nouvelle largeur de la fenêtre, en pixels</li>
            <li><code>Event.Size.Height</code> contient la nouvelle hauteur de la fenêtre, en pixels</li>
        </ul>
    </li>
    <li>Evènements texte (<code>TextEntered</code>)
        <ul>
            <li><code>Event.Text.Unicode</code> contient le code UTF-32 du caractère qui vient d'être entré</li>
        </ul>
    </li>
    <li>Evènements clavier (<code>KeyPressed, KeyReleased</code>)
        <ul>
            <li><code>Event.Key.Code</code> contient le code de la touche qui a été appuyée / relâchée</li>
            <li><code>Event.Key.Alt</code>  indique si la touche Alt est enfoncée ou non</li>
            <li><code>Event.Key.Control</code> indique si la touche Control est enfoncée ou non</li>
            <li><code>Event.Key.Shift</code> indique si la touche Shift est enfoncée ou non</li>
        </ul>
    </li>
    <li>Evènements boutons souris (<code>MouseButtonPressed, MouseButtonReleased</code>)
        <ul>
            <li><code>Event.MouseButton.Button</code> contient le bouton qui a été appuyé / relâché</li>
            <li><code>Event.MouseButton.X</code> contient la position X actuelle de la souris</li>
            <li><code>Event.MouseButton.Y</code> contient la position Y actuelle de la souris</li>
        </ul>
    </li>
    <li>Evènements mouvement souris (<code>MouseMoved</code>)
        <ul>
            <li><code>Event.MouseMove.X</code> contient la nouvelle position X de la souris</li>
            <li><code>Event.MouseMove.Y</code> contient la nouvelle position Y de la souris</li>
        </ul>
    </li>
    <li>Evènements molette souris (<code>MouseWheelMoved</code>)
        <ul>
            <li><code>Event.MouseWheel.Delta</code> contient la valeur du déplacement de la molette (positif si en avant, négatif si en arrière)</li>
        </ul>
    </li>
    <li>Evènements boutons joystick (<code>JoyButtonPressed, JoyButtonReleased</code>)
        <ul>
            <li><code>Event.JoyButton.JoystickId</code> contient l'identificateur du joystick concerné (0 ou 1)</li>
            <li><code>Event.JoyButton.Button</code> contient l'indice du bouton qui a été appuyé / relâché, entre 0 et 15</li>
        </ul>
    </li>
    <li>Evènements mouvement joystick (<code>JoyMoved</code>)
        <ul>
            <li><code>Event.JoyMove.JoystickId</code> contient l'identificateur du joystick concerné (0 ou 1)</li>
            <li><code>Event.JoyMove.Axis</code> contient l'axe sur lequel s'est produit le mouvement</li>
            <li><code>Event.JoyMove.Position</code> contient la position actuelle du joystick sur l'axe, entre -100 et 100 (sauf pour le POV, qui est entre 0 et 360)</li>
        </ul>
    </li>
</ul>
<p>
    Les codes de touches sont spécifiques à SFML. Chaque touche est associée à une constante, définie dans
    Events.hpp. Par exemple, la touche F5 est définie par la constante <code>sf::Key::F5</code>.
    Pour les lettres et les chiffres la constante associée correspond au code ASCII, ce qui signifie que
    <code>'a'</code> et <code>sf::Key::A</code> correspondent tous deux à la
    touche 'A'.
</p>
<p>
    Les codes des boutons de la souris suivent la même règle. Cinq constantes sont définies :
    <code>sf::Mouse::Left</code>, <code>sf::Mouse::Right</code>, <code>sf::Mouse::Middle</code> (le bouton de la molette),
    <code>sf::Mouse::XButton1</code>, et <code>sf::Mouse::XButton2</code>.
</p>
<p>
    Enfin, les axes des joysticks sont définis de la manière suivante : <code>sf::Joy::AxisX</code>,
    <code>sf::Joy::AxisY</code>, <code>sf::Joy::AxisZ</code>, <code>sf::Joy::AxisR</code>, <code>sf::Joy::AxisU</code>,
    <code>sf::Joy::AxisV</code>, et <code>sf::Joy::AxisPOV</code>.
</p>
<p>
    Donc... revenons à notre application, et ajoutons un peu de code pour gérer les évènements. Nous
    allons ajouter quelque chose pour arrêter l'application lorsque l'utilisateur ferme la fenêtre, ou
    lorsqu'il appuie sur echap :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Fenêtre fermée
    if (Event.Type == sf::Event::Closed)
        Running = false;

    // Touche 'echap' appuyée
    if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
        Running = false;
}
</code></pre>

<?php h2('Fermer une fenêtre') ?>
<p>
    Si vous avez joué un peu avec les fenêtres SFML, vous avez probablement remarqué que cliquer sur le bouton de fermeture
    générait un évènement <code>Closed</code>, mais ne détruisait pas la fenêtre. C'est pour laisser l'occasion
    à l'utilisateur d'ajouter des traitements avant la femeture (demander de sauvegarder), ou bien carrément d'annuler
    celle-ci. Pour fermer effectivement une fenêtre, vous devrez soit détruire l'instance de
    <?php class_link("Window")?>,
    soit appeler sa fonction <code>Close()</code>.<br/>
    Pour savoir si une fenêtre est ouverte (ie. a été créée), vous pouvez appeler la fonction <code>IsOpened()</code>.
</p>
<p>
    Maintenant, notre boucle principale a l'air vachement plus sympa :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Fenêtre fermée
        if (Event.Type == sf::Event::Closed)
            App.Close();

        // Touche 'echap' appuyée
        if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
            App.Close();
    }
}
</code></pre>

<?php h2('Récupérer les entrées temps-réel') ?>
<p>
    Ce système d'évènements est suffisant pour réagir à des évènements comme la fermeture de fenêtre, ou
    une pression simple sur une touche. Mais si vous voulez gérer, par exemple, le mouvement continu d'un
    personnage lorsque vous maintenez une flèche enfoncée, alors vous allez vite vous rendre compte qu'il
    y a un problème : un délai sera introduit entre chaque mouvement, le délai défini par le système
    d'exploitation lorsque vous maintenez une touche enfoncée.
</p>
<p>
    Une meilleure stratégie pour cela est de marquer une variable booléene à <code>true</code>
    lorsque la touche est enfoncée, et la remettre à zéro lorsque la touche est relâchée. Puis à chaque
    tour de boucle, si le booléen est marqué, vous déplacez votre personnage. Cependant l'usage de
    variables supplémentaires pour ça peut devenir fastidieux, particulièrement lorsque vous en avez beaucoup.
    C'est pourquoi SFML fournit un accès facilité aux entrées temps-réel, avec la classe
    <?php class_link("Input")?>.
</p>
<p>
    Les instances de <?php class_link("Input")?> ne peuvent pas vivre seules, elles
    doivent être attachées à une fenêtre. En fait, chaque <?php class_link("Window")?>
    gère sa propre instance de <?php class_link("Input")?>, que vous n'avez plus qu'à récupérer
    lorsque vous le souhaitez. Obtenir une référence vers l'entrée associée à une fenêtre s'effectue
    par la fonction <code>GetInput</code> :
</p>
<pre><code class="cpp">const sf::Input&amp; Input = App.GetInput();
</code></pre>
<p>
    Ensuite, vous pouvez utiliser l'instance de <?php class_link("Input")?> pour récupérer
    l'état du clavier, de la souris et des joysticks à n'importe quel moment :
</p>
<pre><code class="cpp">bool         LeftKeyDown     = Input.IsKeyDown(sf::Key::Left);
bool         RightButtonDown = Input.IsMouseButtonDown(sf::Mouse::Right);
bool         Joy0Button1Down = Input.IsJoystickButtonDown(0, 1);
unsigned int MouseX          = Input.GetMouseX();
unsigned int MouseY          = Input.GetMouseY();
float        Joystick1X      = Input.GetJoystickAxis(1, sf::Joy::AxisX);
float        Joystick1Y      = Input.GetJoystickAxis(1, sf::Joy::AxisY);
float        Joystick1POV    = Input.GetJoystickAxis(1, sf::Joy::AxisPOV);
</code></pre>
<?php h2('Conclusion') ?>
<p>
    Dans ce tutoriel vous avez appris à gérer les entrées, et à obtenir l'état du clavier et de la souris
    en temps réel. Mais pour construire une application temps-réel, vous devez gérer correctement un autre
    aspect : le temps. Allons donc jeter un oeil à un rapide tutoriel concernant la
    <a class="internal" href="./window-time-fr.php" title="Prochain tutoriel : gestion du temps">gestion du temps</a>
    avec SFML !
</p>

<?php

    require("footer-fr.php");

?>
