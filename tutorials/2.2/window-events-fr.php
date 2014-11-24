<?php

    $title = "Les �v�nements expliqu�s";
    $page = "window-events-fr.php";

    require("header-fr.php");

?>

<h1>Les �v�nements expliqu�s</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel fournit une liste d�taill�e des �v�nements des fen�tres. Il les d�crit, et montre comment (et comment ne pas) les utiliser.
</p>

<?php h2('Le type sf::Event') ?>
<p>
    Avant de s'int�resser aux �v�nements, il est important de comprendre ce qu'est le type <?php class_link("Event") ?>, et comment l'utiliser
    correctement. <?php class_link("Event") ?> est une <em>union</em>, ce qui signifie qu'un seul de ses membres est valide � tout moment (souvenez-vous
    de vos cours de C++ : tous les membres d'une union partagent le m�me espace m�moire). Le membre valide est celui qui correspond au type de l'�v�nement,
    par exemple <code>event.key</code> pour un �v�nement de type <code>KeyPressed</code>. Essayer de lire n'importe quel autre membre provoquera
    un comportement ind�termin� (probablement des valeurs al�atoires ou invalides). Donc, n'essayez jamais d'utiliser un membre d'�v�nement qui ne
    correspond pas � son type.
</p>
<p>
    Les instances de <?php class_link("Event") ?> sont remplies par la fonction <code>pollEvent</code> (ou <code>waitEvent</code>) de la classe
    <?php class_link("Window") ?>. Il n'y a que ces fonctions qui peuvent produire des �v�nements valides, toute tentative d'utiliser un
    <?php class_link("Event") ?> sans qu'il provienne d'un appel valide � <code>pollEvent</code> (ou <code>waitEvent</code>) produira le m�me genre
    de comportement ind�termin� qu'expliqu� plus haut.
</p>
<p>
    En clair, voici � quoi ressemble une boucle d'�v�nements typique :
</p>
<pre><code class="cpp">sf::Event event;

// tant qu'il y a des �v�nements � traiter...
while (window.pollEvent(event))
{
    // on regarde le type de l'�v�nement...
    switch (event.type)
    {
        // fen�tre ferm�e
        case sf::Event::Closed:
            window.close();
            break;

        // touche press�e
        case sf::Event::KeyPressed:
            ...
            break;

        // on ne traite pas les autres types d'�v�nements
        default:
            break;
    }
}</code></pre>
<p class="important">
    Relisez bien les paragraphes ci-dessus et assurez-vous que �a reste bien grav� dans votre t�te, l'union <?php class_link("Event") ?> cause
    de trop nombreux probl�mes aux programmeurs inattentifs.
</p>
<p>
    Ok, maintenant nous pouvons voir quels �v�nements SFML supporte, ce qu'ils signifient et comment les utiliser comme il faut.
</p>

<?php h2('L\'�v�nement Closed') ?>
<p>
    L'�v�nement <code>sf::Event::Closed</code> est d�clench� lorsque l'utilisateur veut fermer la fen�tre, par tous les moyens possibles fournis
    par l'OS (bouton "fermer", raccourci clavier, etc.). Cet �v�nement n'est qu'une demande de fermeture, la fen�tre n'est pas physiquement ferm�e.
</p>
<p>
    Un code typique va simplement appeler <code>window.close()</code> en r�action � cet �v�nement, afin de r�ellement fermer la fen�tre. Mais parfois
    vous voudrez peut-�tre faire quelque chose avant, comme sauvegarder l'�tat actuel de l'application ou bien demander � l'utilisateur quoi faire.
    Si vous ne faites rien du tout, la fen�tre reste ouverte.
</p>
<p>
    Il n'y a aucun membre associ� � cet �v�nement dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Closed)
    window.close();
</code></pre>

<?php h2('L\'�v�nement Resized') ?>
<p>
    L'�v�nement <code>sf::Event::Resized</code> est d�clench� lorsque la fen�tre est redimensionn�e, que ce soit par l'utilisateur ou bien
    programmatiquement avec <code>window.setSize</code>.
</p>
<p>
    Vous pouvez utiliser cet �v�nement pour ajuster les propri�t�s de rendu : le viewport si vous utilisez OpenGL directement, ou la vue courante
    si vous utilisez sfml-graphics.
</p>
<p>
    Le membre associ� � cet �v�nement est <code>event.size</code>, il contient la nouvelle taille de la fen�tre.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Resized)
{
    std::cout &lt;&lt; "new width: " &lt;&lt; event.size.width &lt;&lt; std::endl;
    std::cout &lt;&lt; "new height: " &lt;&lt; event.size.height &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les �v�nements LostFocus et GainedFocus') ?>
<p>
    Les �v�nements <code>sf::Event::LostFocus</code> et <code>sf::Event::GainedFocus</code> sont d�clench�s lorsque la fen�tre gagne ou perd le focus,
    ce qui arrive lorsque l'utilisateur change de fen�tre active. Lorsque la fen�tre n'a pas le focus, elle ne re�oit plus d'�v�nement clavier.
</p>
<p>
    Cet �v�nement peut �tre utilis� si vous voulez mettre en pause le jeu lorsque la fen�tre est inactive, par exemple.
</p>
<p>
    Il n'y a aucun membre associ� � ces �v�nements dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::LostFocus)
    myGame.pause();

if (event.type == sf::Event::GainedFocus)
    myGame.resume();
</code></pre>

<?php h2('L\'�v�nement TextEntered') ?>
<p>
    L'�v�nement <code>sf::Event::TextEntered</code> est d�clench� lorsqu'un caract�re est entr�. Il ne doit pas �tre confondu avec l'�v�nement
    <code>KeyPressed</code> : <code>TextEntered</code> interpr�te les entr�es utilisateur et produit les caract�res affichables correspondant.
    Par exemple, appuyer sur '^' puis 'e' sur un clavier fran�ais produira deux �v�nements <code>KeyPressed</code>, mais un seul �v�nement
    <code>TextEntered</code> contenant le caract�re '�'. Et cela marche avec tous les moyens d'entrer des caract�res fournis par l'OS, y compris les
    plus sp�cifiques ou les plus complexes.
</p>
<p>
    Cet �v�nement est typiquement utilis� pour chopper les entr�es utilisateur dans un champ de texte.
</p>
<p>
    Le membre associ� � cet �v�nement est <code>event.text</code>, il contient la valeur Unicode du caract�re entr�. Vous pouvez soit l'ajouter
    directement � un <?php class_link("String") ?>, ou bien le convertir en <code>char</code> apr�s vous �tre assur� qu'il est bien dans la plage
    ASCII (0 - 127).
</p>
<pre><code class="cpp">if (event.type == sf::Event::TextEntered)
{
    if (event.text.unicode &lt; 128)
        std::cout &lt;&lt; "ASCII character typed: " &lt;&lt; static_cast&lt;char&gt;(event.text.unicode) &lt;&lt; std::endl;
}</code></pre>
<p>
    Notez que, �tant donn� qu'ils font parti du standard Unicode, quelques caract�res non-affichables tels que <em>backspace</em> sont g�n�r�s par
    cet �v�nement. Dans la plupart des cas vous devrez donc les filtrer.
</p>
<p class="important">
    Beaucoup de d�veloppeurs utilisent l'�v�nement <code>KeyPressed</code> pour traiter le texte entr� par l'utilisateur, et s'embarquent dans des
    algorithmes chiad�s qui essayent d'interpr�ter toutes les combinaisons possibles de touches qui peuvent produire des caract�res valides.
    Ne faites surtout pas �a !
</p>

<?php h2('Les �v�nements KeyPressed et KeyReleased') ?>
<p>
    Les �v�nements <code>sf::Event::KeyPressed</code> et <code>sf::Event::KeyReleased</code> sont d�clench�s lorsqu'une touche du clavier est
    press�e/rel�ch�e.
</p>
<p> 
    Si une touche est maintenue, des �v�nements <code>KeyPressed</code> seront g�n�r�s en continu, selon le d�lai par d�faut de l'OS (ie. le m�me d�lai
    qui s'applique lorsque vous maintenez une lettre dans un �diteur de texte). Pour d�sactiver la r�p�tition des �v�nements <code>KeyPressed</code>,
    vous pouvez appeler <code>window.setKeyRepeatEnabled(false)</code>. Par contre, de mani�re assez �vidente, les �v�nements
    <code>KeyReleased</code> ne peuvent quant � eux pas �tre r�p�t�s.
</p>
<p>
    Cet �v�nement est celui qu'il faut utiliser si vous voulez d�clencher une action ponctuelle au moment o� une touche est appuy�e ou rel�ch�e, comme
    faire sauter un personnage avec la touche espace, ou bien quitter quelque chose avec la touche �chap.
</p>
<p class="important">
    Parfois, les gens essayent de r�agir directement � l'�v�nement <code>KeyPressed</code> pour cr�er des mouvements continus. Or, cela ne produira pas des mouvements
    continus mais plut�t <em>saccad�s</em> : lorsque vous maintenez une touche vous n'obtenez en effet que quelques �v�nements (souvenez-vous du d�lai
    de r�p�tition). Afin d'obtenir des mouvements fluides avec les �v�nements, vous devez utiliser un bool�en mis � <code>true</code> lors de l'�v�nement
    <code>KeyPressed</code> et � <code>false</code> lors de l'�v�nement <code>KeyReleased</code> ; vous pouvez ensuite effectuer des d�placements (ind�pendamment des
    �v�nements) tant que le bool�en est � <code>true</code>.<br />
    L'autre solution (plus simple) pour produire des movements continus est d'utiliser les entr�es temps r�el avec <?php class_link("Keyboard") ?> (voir le
    <a class="internal" href="./window-inputs-fr.php" title="Tutoriel sur les entr�es temps-r�el">tutoriel d�di�</a>).
</p>
<p>
    Le membre associ� � ces �v�nements est <code>event.key</code>, il contient le code de la touche press�e/rel�ch�e, ainsi que l'�tat des
    touches sp�ciales (alt, control, shift, system) au moment de l'appui.
</p>
<pre><code class="cpp">if (event.type == sf::Event::KeyPressed)
{
    if (event.key.code == sf::Keyboard::Escape)
    {
        std::cout &lt;&lt; "the escape key was pressed" &lt;&lt; std::endl;
        std::cout &lt;&lt; "control:" &lt;&lt; event.key.control &lt;&lt; std::endl;
        std::cout &lt;&lt; "alt:" &lt;&lt; event.key.alt &lt;&lt; std::endl;
        std::cout &lt;&lt; "shift:" &lt;&lt; event.key.shift &lt;&lt; std::endl;
        std::cout &lt;&lt; "system:" &lt;&lt; event.key.system &lt;&lt; std::endl;
    }
}</code></pre>
<p>
    Attention : certaines touches ont un sens particulier pour l'OS, et produisent des r�sultats inattendus. Par exemple la touche F10 qui, sous Windows,
    "vole" le focus, ou bien encore la touche F12 qui d�marre le debugger sous Visual Studio. Ces diff�rences de comportement seront probablement
    gomm�es dans une version future de SFML.
</p>

<?php h2('L\'�v�nement MouseWheelMoved') ?>
<p>
    L'�v�nement <code>sf::Event::MouseWheelMoved</code> est d�clench� lorsque la molette souris d�file vers le haut ou le bas.
</p>
<p>
    Le membre associ� � cet �v�nement est <code>event.mouseWheel</code>, il contient le nombre de "ticks" duquel la molette a boug�, ainsi que la
    position actuelle de la souris.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseWheelMoved)
{
    std::cout &lt;&lt; "wheel movement: " &lt;&lt; event.mouseWheel.delta &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse x: " &lt;&lt; event.mouseWheel.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse y: " &lt;&lt; event.mouseWheel.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les �v�nements MouseButtonPressed et MouseButtonReleased') ?>
<p>
    Les �v�nements <code>sf::Event::MouseButtonPressed</code> et <code>sf::Event::MouseButtonReleased</code> sont d�clench�s lorsqu'un bouton souris
    est press�/rel�ch�.
</p>
<p>
    SFML supporte 5 boutons souris : gauche, droit, milieu (molette), extra 1 et extra 2 (boutons suppl�mentaires sur les c�t�s).
</p>
<p>
    Le membre associ� � ces �v�nements est <code>event.mouseButton</code>, il contient le code du bouton press�/rel�ch�, ainsi que la position actuelle
    de la souris.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseButtonPressed)
{
    if (event.mouseButton.button == sf::Mouse::Right)
    {
        std::cout &lt;&lt; "the right button was pressed" &lt;&lt; std::endl;
        std::cout &lt;&lt; "mouse x: " &lt;&lt; event.mouseButton.x &lt;&lt; std::endl;
        std::cout &lt;&lt; "mouse y: " &lt;&lt; event.mouseButton.y &lt;&lt; std::endl;
    }
}</code></pre>

<?php h2('L\'�v�nement MouseMoved') ?>
<p>
    L'�v�nement <code>sf::Event::MouseMoved</code> est d�clench� lorsque la souris bouge dans la fen�tre.
</p>
<p>
    Cet �v�nement est d�clench� m�me si la fen�tre n'a pas le focus. Cependant, il est d�clench� uniquement lorsque la souris se trouve dans la
    zone interne de la fen�tre, pas quand elle bouge au-dessus de la barre de titre ou des bordures.
</p>
<p>
    Le membre associ� � cet �v�nement est <code>event.mouseMove</code>, il contient la position actuelle de la souris relativement � la fen�tre.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseMoved)
{
    std::cout &lt;&lt; "new mouse x: " &lt;&lt; event.mouseMove.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "new mouse y: " &lt;&lt; event.mouseMove.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les �v�nements MouseEntered et MouseLeft') ?>
<p>
    Les �v�nements <code>sf::Event::MouseEntered</code> et <code>sf::Event::MouseLeft</code> sont d�clench�s lorsque la souris entre ou quitte la
    fen�tre.
</p>
<p>
    Il n'y a pas de membre associ� � ces �v�nements dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseEntered)
    std::cout &lt;&lt; "the mouse cursor has entered the window" &lt;&lt; std::endl;

if (event.type == sf::Event::MouseLeft)
    std::cout &lt;&lt; "the mouse cursor has left the window" &lt;&lt; std::endl;
</code></pre>

<?php h2('Les �v�nements JoystickButtonPressed et JoystickButtonReleased') ?>
<p>
    Les �v�nements <code>sf::Event::JoystickButtonPressed</code> et <code>sf::Event::JoystickButtonReleased</code> sont d�clench�s lorsqu'un bouton
    de joystick est press�/rel�ch�.
</p>
<p>
    SFML supporte jusqu'� 8 joysticks et 32 boutons.
</p>
<p>
    Le membre associ� � ces �v�nements est <code>event.joystickButton</code>, il contient l'identificateur du joystick et le num�ro du bouton
    press�/rel�ch�.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickButtonPressed)
{
    std::cout &lt;&lt; "joystick button pressed!" &lt;&lt; std::endl;
    std::cout &lt;&lt; "joystick id: " &lt;&lt; event.joystickButton.joystickId &lt;&lt; std::endl;
    std::cout &lt;&lt; "button: " &lt;&lt; event.joystickButton.button &lt;&lt; std::endl;
}</code></pre>

<?php h2('L\'�v�nement JoystickMoved') ?>
<p>
    L'�v�nement <code>sf::Event::JoystickMoved</code> est d�clench� lorsqu'un axe de joystick bouge.
<p>
<p>
    Les axes de joysticks sont typiquement tr�s sensibles, c'est pourquoi SFML utilise un seuil de d�tection pour �viter de polluer la boucle
    d'�v�nements avec des tonnes de <code>JoystickMoved</code>. Ce seuil peut �tre ajust� avec la fonction <code>Window::setJoystickThreshold</code>,
    au cas o� vous voudriez recevoir plus ou moins de ces �v�nements.
</p>
<p>
    SFML supporte 8 axes de joystick: X, Y, Z, R, U, V, POV X et POV Y. Ce � quoi ils correspondent sur votre joystick d�pend de son driver.
</p>
<p>
    Le membre associ� � cet �v�nement est <code>event.joystickMove</code>, il contient l'identificateur du joystick, le nom de l'axe, et sa
    position actuelle (entre -100 et 100).
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickMoved)
{
    if (event.joystickMove.axis == sf::Joystick::X)
    {
        std::cout &lt;&lt; "X axis moved!" &lt;&lt; std::endl;
        std::cout &lt;&lt; "joystick id: " &lt;&lt; event.joystickMove.joystickId &lt;&lt; std::endl;
        std::cout &lt;&lt; "new position: " &lt;&lt; event.joystickMove.position &lt;&lt; std::endl;
    }
}</code></pre>

<?php h2('Les �v�nements JoystickConnected et JoystickDisconnected') ?>
<p>
    Les �v�nements <code>sf::Event::JoystickConnected</code> et <code>sf::Event::JoystickDisconnected</code> sont d�clench�s lorsqu'un joystick
    est connect�/d�connect�.
</p>
<p>
    Le membre associ� � ces �v�nement est <code>event.joystickConnect</code>, il contient l'identificateur du joystick connect�/d�connect�.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickConnected)
    std::cout &lt;&lt; "joystick connected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;

if (event.type == sf::Event::JoystickDisconnected)
    std::cout &lt;&lt; "joystick disconnected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;
</code></pre>

<?php

    require("footer-fr.php");

?>
