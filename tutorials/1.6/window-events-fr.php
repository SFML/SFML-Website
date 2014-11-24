<?php

    $title = "G�rer les �v�nements";
    $page = "window-events-fr.php";

    require("header-fr.php");
?>

<h1>G�rer les �v�nements</h1>

<?php h2('Introduction') ?>
<p>
    Dans le tutoriel pr�c�dent, nous avons appris � ouvrir une fen�tre mais nous n'avions aucun moyen de
    stopper l'application. Ici, nous allons apprendre � intercepter les �v�nements d'une fen�tre et � les
    g�rer correctement.
</p>

<?php h2('R�cup�rer les �v�nements') ?>
<p>
    Typiquement, il existe deux fa�ons de r�cup�rer les �v�nements dans un syst�me de fen�trage :
</p>
<ul>
    <li>Vous pouvez demander � la fen�tre de vous donner les �v�nements en attente � chaque boucle ; c'est ce qu'on appelle le <em>polling</em></li>
    <li>Vous pouvez transmettre � la fen�tre un pointeur de fonction, et attendre que la fen�tre appelle
    votre fonction lorsqu'elle g�n�re un �v�nement ; c'est ce qu'on appelle les fonctions de rappel ("callbacks")</li>
</ul>
<p>
    SFML utilise un syst�me de <em>polling</em> pour r�cup�rer les �v�nements. Ainsi, vous devez r�cup�rer
    les �v�nements en attente � chaque boucle. La fonction � utiliser est <code>GetEvent</code>,
    qui remplira une instance de <?php class_link("Event")?> et renverra <code>true</code>
    s'il y avait un �v�nement en attente, ou renverra <code>false</code> si la pile d'�v�nements �tait vide.
</p>
<pre><code class="cpp">// Rappelez-vous que App est une instance de sf::Window

sf::Event Event;
if (App.GetEvent(Event))
{
    // Traitement de l'�v�nement
}
</code></pre>
<p>
    Mais il peut y avoir plus d'un �v�nement en attente � chaque boucle (les �v�nements sont stock�s dans
    une pile � chaque boucle, et r�cup�rer un �v�nement retire le premier �l�ment de cette pile), et si
    vous n'en r�cup�rez qu'un, les �v�nements peuvent s'accumuler et ne jamais �tre trait�s.<br/>
    La fa�on de faire correcte pour r�cup�rer tous les �v�nements � chaque boucle, est de
    boucler jusqu'� ce qu'il n'y en n'ait plus en attente :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Traitement de l'�v�nement
}
</code></pre>
<p>
    "Eh, mais attendez une minute... o� est-ce que je dois placer ce morceau de code, au fait ?".<br/>
    Comme les �v�nements doivent �tre trait�s � chaque tour de boucle, il est conseill� de placer
    la gestion des �v�nements au d�but de la boucle principale :
</p>
<pre><code class="cpp">while (Running)
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Traitement de l'�v�nement
    }

    App.Display();
}
</code></pre>

<?php h2('Traitement des �v�nements') ?>
<p>
    La premi�re chose � faire lorsque vous recevez un �v�nement est d'interroger son type, stock� dans
    sa variable membre <code>Type</code>. SFML d�finit les types d'�v�nements suivant, tous
    dans la port�e de la structure <?php class_link("Event")?> :
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
    Selon le type d'�v�nement, l'instance d'�v�nement sera remplie avec diff�rents param�tres :
</p>
<ul>
    <li>Ev�nements de taille (<code>Resized</code>)
        <ul>
            <li><code>Event.Size.Width</code> contient la nouvelle largeur de la fen�tre, en pixels</li>
            <li><code>Event.Size.Height</code> contient la nouvelle hauteur de la fen�tre, en pixels</li>
        </ul>
    </li>
    <li>Ev�nements texte (<code>TextEntered</code>)
        <ul>
            <li><code>Event.Text.Unicode</code> contient le code UTF-32 du caract�re qui vient d'�tre entr�</li>
        </ul>
    </li>
    <li>Ev�nements clavier (<code>KeyPressed, KeyReleased</code>)
        <ul>
            <li><code>Event.Key.Code</code> contient le code de la touche qui a �t� appuy�e / rel�ch�e</li>
            <li><code>Event.Key.Alt</code>  indique si la touche Alt est enfonc�e ou non</li>
            <li><code>Event.Key.Control</code> indique si la touche Control est enfonc�e ou non</li>
            <li><code>Event.Key.Shift</code> indique si la touche Shift est enfonc�e ou non</li>
        </ul>
    </li>
    <li>Ev�nements boutons souris (<code>MouseButtonPressed, MouseButtonReleased</code>)
        <ul>
            <li><code>Event.MouseButton.Button</code> contient le bouton qui a �t� appuy� / rel�ch�</li>
            <li><code>Event.MouseButton.X</code> contient la position X actuelle de la souris</li>
            <li><code>Event.MouseButton.Y</code> contient la position Y actuelle de la souris</li>
        </ul>
    </li>
    <li>Ev�nements mouvement souris (<code>MouseMoved</code>)
        <ul>
            <li><code>Event.MouseMove.X</code> contient la nouvelle position X de la souris</li>
            <li><code>Event.MouseMove.Y</code> contient la nouvelle position Y de la souris</li>
        </ul>
    </li>
    <li>Ev�nements molette souris (<code>MouseWheelMoved</code>)
        <ul>
            <li><code>Event.MouseWheel.Delta</code> contient la valeur du d�placement de la molette (positif si en avant, n�gatif si en arri�re)</li>
        </ul>
    </li>
    <li>Ev�nements boutons joystick (<code>JoyButtonPressed, JoyButtonReleased</code>)
        <ul>
            <li><code>Event.JoyButton.JoystickId</code> contient l'identificateur du joystick concern� (0 ou 1)</li>
            <li><code>Event.JoyButton.Button</code> contient l'indice du bouton qui a �t� appuy� / rel�ch�, entre 0 et 15</li>
        </ul>
    </li>
    <li>Ev�nements mouvement joystick (<code>JoyMoved</code>)
        <ul>
            <li><code>Event.JoyMove.JoystickId</code> contient l'identificateur du joystick concern� (0 ou 1)</li>
            <li><code>Event.JoyMove.Axis</code> contient l'axe sur lequel s'est produit le mouvement</li>
            <li><code>Event.JoyMove.Position</code> contient la position actuelle du joystick sur l'axe, entre -100 et 100 (sauf pour le POV, qui est entre 0 et 360)</li>
        </ul>
    </li>
</ul>
<p>
    Les codes de touches sont sp�cifiques � SFML. Chaque touche est associ�e � une constante, d�finie dans
    Events.hpp. Par exemple, la touche F5 est d�finie par la constante <code>sf::Key::F5</code>.
    Pour les lettres et les chiffres la constante associ�e correspond au code ASCII, ce qui signifie que
    <code>'a'</code> et <code>sf::Key::A</code> correspondent tous deux � la
    touche 'A'.
</p>
<p>
    Les codes des boutons de la souris suivent la m�me r�gle. Cinq constantes sont d�finies :
    <code>sf::Mouse::Left</code>, <code>sf::Mouse::Right</code>, <code>sf::Mouse::Middle</code> (le bouton de la molette),
    <code>sf::Mouse::XButton1</code>, et <code>sf::Mouse::XButton2</code>.
</p>
<p>
    Enfin, les axes des joysticks sont d�finis de la mani�re suivante : <code>sf::Joy::AxisX</code>,
    <code>sf::Joy::AxisY</code>, <code>sf::Joy::AxisZ</code>, <code>sf::Joy::AxisR</code>, <code>sf::Joy::AxisU</code>,
    <code>sf::Joy::AxisV</code>, et <code>sf::Joy::AxisPOV</code>.
</p>
<p>
    Donc... revenons � notre application, et ajoutons un peu de code pour g�rer les �v�nements. Nous
    allons ajouter quelque chose pour arr�ter l'application lorsque l'utilisateur ferme la fen�tre, ou
    lorsqu'il appuie sur echap :
</p>
<pre><code class="cpp">sf::Event Event;
while (App.GetEvent(Event))
{
    // Fen�tre ferm�e
    if (Event.Type == sf::Event::Closed)
        Running = false;

    // Touche 'echap' appuy�e
    if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
        Running = false;
}
</code></pre>

<?php h2('Fermer une fen�tre') ?>
<p>
    Si vous avez jou� un peu avec les fen�tres SFML, vous avez probablement remarqu� que cliquer sur le bouton de fermeture
    g�n�rait un �v�nement <code>Closed</code>, mais ne d�truisait pas la fen�tre. C'est pour laisser l'occasion
    � l'utilisateur d'ajouter des traitements avant la femeture (demander de sauvegarder), ou bien carr�ment d'annuler
    celle-ci. Pour fermer effectivement une fen�tre, vous devrez soit d�truire l'instance de
    <?php class_link("Window")?>,
    soit appeler sa fonction <code>Close()</code>.<br/>
    Pour savoir si une fen�tre est ouverte (ie. a �t� cr��e), vous pouvez appeler la fonction <code>IsOpened()</code>.
</p>
<p>
    Maintenant, notre boucle principale a l'air vachement plus sympa :
</p>
<pre><code class="cpp">while (App.IsOpened())
{
    sf::Event Event;
    while (App.GetEvent(Event))
    {
        // Fen�tre ferm�e
        if (Event.Type == sf::Event::Closed)
            App.Close();

        // Touche 'echap' appuy�e
        if ((Event.Type == sf::Event::KeyPressed) &amp;&amp; (Event.Key.Code == sf::Key::Escape))
            App.Close();
    }
}
</code></pre>

<?php h2('R�cup�rer les entr�es temps-r�el') ?>
<p>
    Ce syst�me d'�v�nements est suffisant pour r�agir � des �v�nements comme la fermeture de fen�tre, ou
    une pression simple sur une touche. Mais si vous voulez g�rer, par exemple, le mouvement continu d'un
    personnage lorsque vous maintenez une fl�che enfonc�e, alors vous allez vite vous rendre compte qu'il
    y a un probl�me : un d�lai sera introduit entre chaque mouvement, le d�lai d�fini par le syst�me
    d'exploitation lorsque vous maintenez une touche enfonc�e.
</p>
<p>
    Une meilleure strat�gie pour cela est de marquer une variable bool�ene � <code>true</code>
    lorsque la touche est enfonc�e, et la remettre � z�ro lorsque la touche est rel�ch�e. Puis � chaque
    tour de boucle, si le bool�en est marqu�, vous d�placez votre personnage. Cependant l'usage de
    variables suppl�mentaires pour �a peut devenir fastidieux, particuli�rement lorsque vous en avez beaucoup.
    C'est pourquoi SFML fournit un acc�s facilit� aux entr�es temps-r�el, avec la classe
    <?php class_link("Input")?>.
</p>
<p>
    Les instances de <?php class_link("Input")?> ne peuvent pas vivre seules, elles
    doivent �tre attach�es � une fen�tre. En fait, chaque <?php class_link("Window")?>
    g�re sa propre instance de <?php class_link("Input")?>, que vous n'avez plus qu'� r�cup�rer
    lorsque vous le souhaitez. Obtenir une r�f�rence vers l'entr�e associ�e � une fen�tre s'effectue
    par la fonction <code>GetInput</code> :
</p>
<pre><code class="cpp">const sf::Input&amp; Input = App.GetInput();
</code></pre>
<p>
    Ensuite, vous pouvez utiliser l'instance de <?php class_link("Input")?> pour r�cup�rer
    l'�tat du clavier, de la souris et des joysticks � n'importe quel moment :
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
    Dans ce tutoriel vous avez appris � g�rer les entr�es, et � obtenir l'�tat du clavier et de la souris
    en temps r�el. Mais pour construire une application temps-r�el, vous devez g�rer correctement un autre
    aspect : le temps. Allons donc jeter un oeil � un rapide tutoriel concernant la
    <a class="internal" href="./window-time-fr.php" title="Prochain tutoriel : gestion du temps">gestion du temps</a>
    avec SFML !
</p>

<?php

    require("footer-fr.php");

?>
