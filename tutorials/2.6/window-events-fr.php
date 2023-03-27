<?php

    $title = "Les évènements expliqués";
    $page = "window-events-fr.php";

    require("header-fr.php");

?>

<h1>Les évènements expliqués</h1>

<?php h2('Introduction') ?>
<p>
    Ce tutoriel fournit une liste détaillée des évènements des fenêtres. Il les décrit, et montre comment (et comment ne pas) les utiliser.
</p>

<?php h2('Le type sf::Event') ?>
<p>
    Avant de s'intéresser aux évènements, il est important de comprendre ce qu'est le type <?php class_link("Event") ?>, et comment l'utiliser
    correctement. <?php class_link("Event") ?> est une <em>union</em>, ce qui signifie qu'un seul de ses membres est valide à tout moment (souvenez-vous
    de vos cours de C++ : tous les membres d'une union partagent le même espace mémoire). Le membre valide est celui qui correspond au type de l'évènement,
    par exemple <code>event.key</code> pour un évènement de type <code>KeyPressed</code>. Essayer de lire n'importe quel autre membre provoquera
    un comportement indéterminé (probablement des valeurs aléatoires ou invalides). Donc, n'essayez jamais d'utiliser un membre d'évènement qui ne
    correspond pas à son type.
</p>
<p>
    Les instances de <?php class_link("Event") ?> sont remplies par la fonction <code>pollEvent</code> (ou <code>waitEvent</code>) de la classe
    <?php class_link("Window") ?>. Il n'y a que ces fonctions qui peuvent produire des évènements valides, toute tentative d'utiliser un
    <?php class_link("Event") ?> sans qu'il provienne d'un appel valide à <code>pollEvent</code> (ou <code>waitEvent</code>) produira le même genre
    de comportement indéterminé qu'expliqué plus haut.
</p>
<p>
    En clair, voici à quoi ressemble une boucle d'évènements typique :
</p>
<pre><code class="cpp">sf::Event event;

// tant qu'il y a des évènements à traiter...
while (window.pollEvent(event))
{
    // on regarde le type de l'évènement...
    switch (event.type)
    {
        // fenêtre fermée
        case sf::Event::Closed:
            window.close();
            break;

        // touche pressée
        case sf::Event::KeyPressed:
            ...
            break;

        // on ne traite pas les autres types d'évènements
        default:
            break;
    }
}</code></pre>
<p class="important">
    Relisez bien les paragraphes ci-dessus et assurez-vous que ça reste bien gravé dans votre tête, l'union <?php class_link("Event") ?> cause
    de trop nombreux problèmes aux programmeurs inattentifs.
</p>
<p>
    Ok, maintenant nous pouvons voir quels évènements SFML supporte, ce qu'ils signifient et comment les utiliser comme il faut.
</p>

<?php h2('L\'évènement Closed') ?>
<p>
    L'évènement <code>sf::Event::Closed</code> est déclenché lorsque l'utilisateur veut fermer la fenêtre, par tous les moyens possibles fournis
    par l'OS (bouton "fermer", raccourci clavier, etc.). Cet évènement n'est qu'une demande de fermeture, la fenêtre n'est pas physiquement fermée.
</p>
<p>
    Un code typique va simplement appeler <code>window.close()</code> en réaction à cet évènement, afin de réellement fermer la fenêtre. Mais parfois
    vous voudrez peut-être faire quelque chose avant, comme sauvegarder l'état actuel de l'application ou bien demander à l'utilisateur quoi faire.
    Si vous ne faites rien du tout, la fenêtre reste ouverte.
</p>
<p>
    Il n'y a aucun membre associé à cet évènement dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Closed)
    window.close();
</code></pre>

<?php h2('L\'évènement Resized') ?>
<p>
    L'évènement <code>sf::Event::Resized</code> est déclenché lorsque la fenêtre est redimensionnée, que ce soit par l'utilisateur ou bien
    programmatiquement avec <code>window.setSize</code>.
</p>
<p>
    Vous pouvez utiliser cet évènement pour ajuster les propriétés de rendu : le viewport si vous utilisez OpenGL directement, ou la vue courante
    si vous utilisez sfml-graphics.
</p>
<p>
    Le membre associé à cet évènement est <code>event.size</code>, il contient la nouvelle taille de la fenêtre.
</p>
<pre><code class="cpp">if (event.type == sf::Event::Resized)
{
    std::cout &lt;&lt; "new width: " &lt;&lt; event.size.width &lt;&lt; std::endl;
    std::cout &lt;&lt; "new height: " &lt;&lt; event.size.height &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les évènements LostFocus et GainedFocus') ?>
<p>
    Les évènements <code>sf::Event::LostFocus</code> et <code>sf::Event::GainedFocus</code> sont déclenchés lorsque la fenêtre gagne ou perd le focus,
    ce qui arrive lorsque l'utilisateur change de fenêtre active. Lorsque la fenêtre n'a pas le focus, elle ne reçoit plus d'évènement clavier.
</p>
<p>
    Cet évènement peut être utilisé si vous voulez mettre en pause le jeu lorsque la fenêtre est inactive, par exemple.
</p>
<p>
    Il n'y a aucun membre associé à ces évènements dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::LostFocus)
    myGame.pause();

if (event.type == sf::Event::GainedFocus)
    myGame.resume();
</code></pre>

<?php h2('L\'évènement TextEntered') ?>
<p>
    L'évènement <code>sf::Event::TextEntered</code> est déclenché lorsqu'un caractère est entré. Il ne doit pas être confondu avec l'évènement
    <code>KeyPressed</code> : <code>TextEntered</code> interprète les entrées utilisateur et produit les caractères affichables correspondant.
    Par exemple, appuyer sur '^' puis 'e' sur un clavier français produira deux évènements <code>KeyPressed</code>, mais un seul évènement
    <code>TextEntered</code> contenant le caractère 'ê'. Et cela marche avec tous les moyens d'entrer des caractères fournis par l'OS, y compris les
    plus spécifiques ou les plus complexes.
</p>
<p>
    Cet évènement est typiquement utilisé pour chopper les entrées utilisateur dans un champ de texte.
</p>
<p>
    Le membre associé à cet évènement est <code>event.text</code>, il contient la valeur Unicode du caractère entré. Vous pouvez soit l'ajouter
    directement à un <?php class_link("String") ?>, ou bien le convertir en <code>char</code> après vous être assuré qu'il est bien dans la plage
    ASCII (0 - 127).
</p>
<pre><code class="cpp">if (event.type == sf::Event::TextEntered)
{
    if (event.text.unicode &lt; 128)
        std::cout &lt;&lt; "ASCII character typed: " &lt;&lt; static_cast&lt;char&gt;(event.text.unicode) &lt;&lt; std::endl;
}</code></pre>
<p>
    Notez que, étant donné qu'ils font parti du standard Unicode, quelques caractères non-affichables tels que <em>backspace</em> sont générés par
    cet évènement. Dans la plupart des cas vous devrez donc les filtrer.
</p>
<p class="important">
    Beaucoup de développeurs utilisent l'évènement <code>KeyPressed</code> pour traiter le texte entré par l'utilisateur, et s'embarquent dans des
    algorithmes chiadés qui essayent d'interpréter toutes les combinaisons possibles de touches qui peuvent produire des caractères valides.
    Ne faites surtout pas ça !
</p>

<?php h2('Les évènements KeyPressed et KeyReleased') ?>
<p>
    Les évènements <code>sf::Event::KeyPressed</code> et <code>sf::Event::KeyReleased</code> sont déclenchés lorsqu'une touche du clavier est
    pressée/relâchée.
</p>
<p>
    Si une touche est maintenue, des évènements <code>KeyPressed</code> seront générés en continu, selon le délai par défaut de l'OS (ie. le même délai
    qui s'applique lorsque vous maintenez une lettre dans un éditeur de texte). Pour désactiver la répétition des évènements <code>KeyPressed</code>,
    vous pouvez appeler <code>window.setKeyRepeatEnabled(false)</code>. Par contre, de manière assez évidente, les évènements
    <code>KeyReleased</code> ne peuvent quant à eux pas être répétés.
</p>
<p>
    Cet évènement est celui qu'il faut utiliser si vous voulez déclencher une action ponctuelle au moment où une touche est appuyée ou relâchée, comme
    faire sauter un personnage avec la touche espace, ou bien quitter quelque chose avec la touche échap.
</p>
<p class="important">
    Parfois, les gens essayent de réagir directement à l'évènement <code>KeyPressed</code> pour créer des mouvements continus. Or, cela ne produira pas des mouvements
    continus mais plutôt <em>saccadés</em> : lorsque vous maintenez une touche vous n'obtenez en effet que quelques évènements (souvenez-vous du délai
    de répétition). Afin d'obtenir des mouvements fluides avec les évènements, vous devez utiliser un booléen mis à <code>true</code> lors de l'évènement
    <code>KeyPressed</code> et à <code>false</code> lors de l'évènement <code>KeyReleased</code> ; vous pouvez ensuite effectuer des déplacements (indépendamment des
    évènements) tant que le booléen est à <code>true</code>.<br />
    L'autre solution (plus simple) pour produire des mouvements continus est d'utiliser les entrées temps réel avec <?php class_link("Keyboard") ?> (voir le
    <a class="internal" href="./window-inputs-fr.php" title="Tutoriel sur les entrées temps-réel">tutoriel dédié</a>).
</p>
<p>
    Le membre associé à ces évènements est <code>event.key</code>, il contient le code de la touche pressée/relâchée, ainsi que l'état des
    touches spéciales (alt, control, shift, system) au moment de l'appui.
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
    Attention : certaines touches ont un sens particulier pour l'OS, et produisent des résultats inattendus. Par exemple la touche F10 qui, sous Windows,
    "vole" le focus, ou bien encore la touche F12 qui démarre le debugger sous Visual Studio. Ces différences de comportement seront probablement
    gommées dans une version future de SFML.
</p>

<?php h2('L\'évènement MouseWheelMoved') ?>
<p>
    L’évènement <code>sf::Event::MouseWheelMoved</code> est <strong>déprécié</strong> depuis SFML 2.3, utilisez l'évènement MouseWheelScrolled à la place.
</p>

<?php h2('L\'évènement MouseWheelScrolled') ?>
<p>
    L’évènement <code>sf::Event::MouseWheelScrolled</code> est déclenché lorsque la molette souris défile
    vers le haut ou le bas, mais aussi latéralement si cette dernière le supporte.
</p>
<p>
    Le membre associé à cet évènement est <code>event.mouseWheelScroll</code>, il contient
    le nombre de "ticks" duquel la molette a bougé, la position actuelle de la souris, ainsi que
    l'orientation du mouvement de la molette.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseWheelScrolled)
{
    if (event.mouseWheelScroll.wheel == sf::Mouse::VerticalWheel)
        std::cout &lt;&lt; "wheel type: vertical" &lt;&lt; std::endl;
    else if (event.mouseWheelScroll.wheel == sf::Mouse::HorizontalWheel)
        std::cout &lt;&lt; "wheel type: horizontal" &lt;&lt; std::endl;
    else
        std::cout &lt;&lt; "wheel type: unknown" &lt;&lt; std::endl;
    std::cout &lt;&lt; "wheel movement: " &lt;&lt; event.mouseWheelScroll.delta &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse x: " &lt;&lt; event.mouseWheelScroll.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "mouse y: " &lt;&lt; event.mouseWheelScroll.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les évènements MouseButtonPressed et MouseButtonReleased') ?>
<p>
    Les évènements <code>sf::Event::MouseButtonPressed</code> et <code>sf::Event::MouseButtonReleased</code> sont déclenchés lorsqu'un bouton souris
    est pressé/relâché.
</p>
<p>
    SFML supporte 5 boutons souris : gauche, droit, milieu (molette), extra 1 et extra 2 (boutons supplémentaires sur les côtés).
</p>
<p>
    Le membre associé à ces évènements est <code>event.mouseButton</code>, il contient le code du bouton pressé/relâché, ainsi que la position actuelle
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

<?php h2('L\'évènement MouseMoved') ?>
<p>
    L'évènement <code>sf::Event::MouseMoved</code> est déclenché lorsque la souris bouge dans la fenêtre.
</p>
<p>
    Cet évènement est déclenché même si la fenêtre n'a pas le focus. Cependant, il est déclenché uniquement lorsque la souris se trouve dans la
    zone interne de la fenêtre, pas quand elle bouge au-dessus de la barre de titre ou des bordures.
</p>
<p>
    Le membre associé à cet évènement est <code>event.mouseMove</code>, il contient la position actuelle de la souris relativement à la fenêtre.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseMoved)
{
    std::cout &lt;&lt; "new mouse x: " &lt;&lt; event.mouseMove.x &lt;&lt; std::endl;
    std::cout &lt;&lt; "new mouse y: " &lt;&lt; event.mouseMove.y &lt;&lt; std::endl;
}</code></pre>

<?php h2('Les évènements MouseEntered et MouseLeft') ?>
<p>
    Les évènements <code>sf::Event::MouseEntered</code> et <code>sf::Event::MouseLeft</code> sont déclenchés lorsque la souris entre ou quitte la
    fenêtre.
</p>
<p>
    Il n'y a pas de membre associé à ces évènements dans l'union <?php class_link("Event") ?>.
</p>
<pre><code class="cpp">if (event.type == sf::Event::MouseEntered)
    std::cout &lt;&lt; "the mouse cursor has entered the window" &lt;&lt; std::endl;

if (event.type == sf::Event::MouseLeft)
    std::cout &lt;&lt; "the mouse cursor has left the window" &lt;&lt; std::endl;
</code></pre>

<?php h2('Les évènements JoystickButtonPressed et JoystickButtonReleased') ?>
<p>
    Les évènements <code>sf::Event::JoystickButtonPressed</code> et <code>sf::Event::JoystickButtonReleased</code> sont déclenchés lorsqu'un bouton
    de joystick est pressé/relâché.
</p>
<p>
    SFML supporte jusqu'à 8 joysticks et 32 boutons.
</p>
<p>
    Le membre associé à ces évènements est <code>event.joystickButton</code>, il contient l'identificateur du joystick et le numéro du bouton
    pressé/relâché.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickButtonPressed)
{
    std::cout &lt;&lt; "joystick button pressed!" &lt;&lt; std::endl;
    std::cout &lt;&lt; "joystick id: " &lt;&lt; event.joystickButton.joystickId &lt;&lt; std::endl;
    std::cout &lt;&lt; "button: " &lt;&lt; event.joystickButton.button &lt;&lt; std::endl;
}</code></pre>

<?php h2('L\'évènement JoystickMoved') ?>
<p>
    L'évènement <code>sf::Event::JoystickMoved</code> est déclenché lorsqu'un axe de joystick bouge.
<p>
<p>
    Les axes de joysticks sont typiquement très sensibles, c'est pourquoi SFML utilise un seuil de détection pour éviter de polluer la boucle
    d'évènements avec des tonnes de <code>JoystickMoved</code>. Ce seuil peut être ajusté avec la fonction <code>Window::setJoystickThreshold</code>,
    au cas où vous voudriez recevoir plus ou moins de ces évènements.
</p>
<p>
    SFML supporte 8 axes de joystick: X, Y, Z, R, U, V, POV X et POV Y. Ce à quoi ils correspondent sur votre joystick dépend de son driver.
</p>
<p>
    Le membre associé à cet évènement est <code>event.joystickMove</code>, il contient l'identificateur du joystick, le nom de l'axe, et sa
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

<?php h2('Les évènements JoystickConnected et JoystickDisconnected') ?>
<p>
    Les évènements <code>sf::Event::JoystickConnected</code> et <code>sf::Event::JoystickDisconnected</code> sont déclenchés lorsqu'un joystick
    est connecté/déconnecté.
</p>
<p>
    Le membre associé à ces évènement est <code>event.joystickConnect</code>, il contient l'identificateur du joystick connecté/déconnecté.
</p>
<pre><code class="cpp">if (event.type == sf::Event::JoystickConnected)
    std::cout &lt;&lt; "joystick connected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;

if (event.type == sf::Event::JoystickDisconnected)
    std::cout &lt;&lt; "joystick disconnected: " &lt;&lt; event.joystickConnect.joystickId &lt;&lt; std::endl;
</code></pre>

<?php

    require("footer-fr.php");

?>
