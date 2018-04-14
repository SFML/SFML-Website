<?php
    $breadcrumbs = array
    (
        'Community' => 'community.php'
    );
    include('header.php');
?>

<h1>Community</h1>

<div class="home-section">
    <div class="stagger-column-wide">
        <div class="title">&raquo; <a href="https://en.sfml-dev.org/forums/" title="Go to the forum">Forum</a></div>
        <p>
            Whether you have a question about SFML's <a href="learn.php" title="Go to the learn page">API</a>, are experiencing odd behavior with SFML or have a feature request, you'll certainly find help, answers or feedback on the forum.
        </p>
        <p>
            In the <a href="https://en.sfml-dev.org/forums/index.php?board=10.0" title="Go to the 'SFML projects' sub-forum">SFML projects</a> sub-forum you'll find many existing projects.
        </p>
    </div>
    <div class="stagger-column-thin">
        <a href="https://en.sfml-dev.org/forums/" title="Go to the forum"><img src="<?php echo image('community/forum.png') ?>" alt="Forum" /></a>
    </div>
</div>

<div class="home-section">
    <div class="stagger-column-thin">
        <a href="https://github.com/SFML/SFML/wiki" title="Go to the wiki"><img src="<?php echo image('community/wiki.png') ?>" alt="Wiki" /></a>
    </div>
    <div class="stagger-column-wide">
        <div class="title">&raquo; <a href="https://github.com/SFML/SFML/wiki" title="Go to the wiki">Wiki</a></div>
        <p>
            The SFML community wiki contains code snippets, tutorials and other community-contributed content.
        </p>
    </div>
</div>

<div class="home-section">
    <div class="stagger-column-wide">
        <div class="title">&raquo; <a href="https://chat.sfml-dev.org" title="Chat in the browser now">IRC</a></div>
        <p>
            For friendly help and talk about SFML, as well as off-topic discussion, either click on the button on the right to instantly chat in your browser, or connect via any IRC client to the server list below.
        </p>
        <ul>
            <li>SSL: <a href="irc://irc.sfml-dev.org:6697/sfml" title="Open an IRC client with the SSL port">irc://irc.sfml-dev.org:6697/sfml</a></li>
            <li>No SSL: <a href="irc://irc.sfml-dev.org:6667/sfml" title="Open an IRC client with the none-SSL port">irc://irc.sfml-dev.org:6667/sfml</a></li>
            <li><a href="https://chat.sfml-dev.org" title="Chat in your browser now">Chat in your browser now</a></li>
        </ul>
    </div>
    <div class="stagger-column-thin">
        <a href="https://chat.sfml-dev.org"><img src="<?php echo image('community/irc.png') ?>" alt="IRC" /></a>
    </div>
</div>

<div class="home-section">
    <div class="stagger-column-thin">
        <a href="https://discord.gg/xJT8d"><img src="<?php echo image('community/discord.png') ?>" alt="Discord" /></a>
    </div>
    <div class="stagger-column-wide">
        <div class="title">&raquo; <a href="https://discord.gg/xJT8d" title="Join our Discord server now">Discord</a></div>
        <p>
            For friendly help, on- and off-topic discussions and easy media sharing join our Discord server. With the help of an IRC-Discord bridge everyone is connected with each other!
        </p>
    </div>
</div>

<?php
    require("footer.php");
?>
