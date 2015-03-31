<?php

    $title = "SFML on mobile OSes";
    $page = "mobile-considerations.php";

    require("header.php");

?>

<h1>SFML on mobile OSes</h1>

<?php h2('Introduction') ?>
<p>
    Introduction goes here.<br />
    Explain SFML wasn't primarly designed for mobile OSes.<br />
    Additional per-OS responsabilities and considerations.
</p>

<?php h2('A single sf::Window') ?>
<p>
    Explain why it makes no sense to create several windows and we're going to 
    address this issue in SFML 3.x.
</p>

<?php h2('sf::Window style') ?>
<p>
    Explain how style constraint differ.<br />
    Explain the fullscreen mode.<br />
</p>

<?php h2('Screen orientation') ?>
<p>
    Explain sf::Event::Resized (how it affects the view) and how to programmatically 
    change scren orientation.
</p>

<?php h2('Application lifecycle events') ?>
<p>
    How it's mapped to sf::Event.<br />
    Why reacting appropriately to them is mandatory.
</p>

<p>
    The following is to be rewritten: <br /><br />
    Depending on the complexity of your application, you probably don't need to 
    handle all lifecycle events. However, it's important that you understand each 
    one and implement those that ensure your app behaves the way users expect. 
    Handling lifecycle events properly ensures your app behaves well in several 
    ways, including that it:
    <ul>
        <li>Does not crash if the user receives a phone call or switches to another app while using your app.</li>
        <li>Does not consume valuable system resources when the user is not actively using it.</li>
        <li>Does not lose the user's progress if they leave your app and return to it at a later time.</li>
        <li>Does not crash or lose the user's progress when the screen rotates between landscape and portrait orientation.</li>
    </ul>
</p>

<?php h2('How to use sf::Sensor s') ?>
<p>
    Explain sf::Sensor here ? Or actually move it to input tutorial ? It would 
    make sense not to boilerplate the main tutorial with a feature only available 
    on mobile devices.
</p>

<?php

    require("footer.php");

?>
