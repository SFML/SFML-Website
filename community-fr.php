<?php
    $breadcrumbs = array
    (
        'Communauté' => 'community-fr.php'
    );
    include('header-fr.php');
?>

<h1>Communauté</h1>

<div class="home-section">
    <div class="column">
        <div class="title">&raquo; <a href="http://fr.sfml-dev.org/forums/" title="Aller au forum">Forum</a></div>
        <p>
            Que vous ayez une question concernant l'<a href="learn-fr.php" title="Aller à la page des tutoriels et de la documentation">API</a>, que vous rencontriez des comportements étranges avec SFML ou que vous ayez une suggestion de nouvelle fonctionnalité, vous trouverez de l'aide, des réponses et des conseils sur le forum.
        </p>
        <p>
            Dans le sous-forum <a href="http://fr.sfml-dev.org/forums/index.php?board=24.0" title="Aller au sous-forum 'Projets SFML'">Projets SFML</a> vous trouvez de nombreux projets existant.
        </p>
    </div>
    <div class="column">
        <a href="http://fr.sfml-dev.org/forums/" title="Aller au forum"><img src="<?php echo image('community/forum.png') ?>" alt="Forum" /></a>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <a href="https://github.com/SFML/SFML/wiki" title="Aller au Wiki"><img src="<?php echo image('community/wiki.png') ?>" alt="Wiki" /></a>
    </div>
    <div class="column">
        <div class="title">&raquo; <a href="https://github.com/SFML/SFML/wiki" title="Aller au Wiki">Wiki</a></div>
        <p>
            Le wiki de la communauté SFML contient des extraits de code, des tutoriels et d'autres contenus issus de la collaboration de la communauté.
        </p>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <div class="title">&raquo; <a href="http://chat.sfml-dev.org" title="Chat in the browser now">IRC</a></div>
        <p>
            Pour une aide amicale et des discussions sur SFML (mais aussi des chats hors-sujet, avec un grand nombre d'utilisateurs), cliquez sur le bouton suivant pour discuter instantanément dans votre naviguateur, ou connectez-vous avec votre client IRC favori au serveur décrit ci-dessous.
        </p>
        <ul>
            <li>SSL: <a href="irc://irc.sfml-dev.org:6697/#sfml" title="Ouvrir un client IRC avec le port SSL">irc://irc.sfml-dev.org:6697/#sfml</a></li>
            <li>Non SSL: <a href="irc://irc.sfml-dev.org:6667/#sfml" title="Ouvrir un client IRC avec le port non SSL">irc://irc.sfml-dev.org:6667/#sfml</a></li>
            <li><a href="http://chat.sfml-dev.org" title="Discutez dans votre naviguateur maintenant">Discutez dans votre naviguateur maintenant</a></li>
        </ul>
    </div>
    <div class="column">
        <a href="http://chat.sfml-dev.org"><img src="<?php echo image('community/irc.png') ?>" alt="IRC" /></a>
    </div>
</div>

<?php
    require("footer-fr.php");
?>
