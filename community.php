<?php
    $breadcrumbs = array
    (
        'Community' => 'community.php'
    );
    include('header.php');
?>

<h1>Community</h1>

<div class="home-section">
    <div class="column">
        <div class="title">&raquo; <a href="http://en.sfml-dev.org/forums/" title="Go to the forum">Forum</a></div>
        <p>
            Whether you have a question about SFML's <a href="learn.php" title="Go to the learn page">API</a>, are experiencing odd behavior with SFML or have a feature request, you'll certainly find help, answers or feedback on the forum.
        </p>
        <p>
            In the <a href="http://en.sfml-dev.org/forums/index.php?board=10.0" title="Go to the 'SFML projects' sub-forum">SFML projects</a> sub-forum you'll find many existing projects.
        </p>
    </div>
    <div class="column">
        <a href="http://en.sfml-dev.org/forums/" title="Go to the forum"><img src="<?php echo image('community/forum.png') ?>" alt="Forum" /></a>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <a href="https://github.com/LaurentGomila/SFML/wiki" title="Go to the wiki"><img src="<?php echo image('community/wiki.png') ?>" alt="Wiki" /></a>
    </div>
    <div class="column">
        <div class="title">&raquo; <a href="https://github.com/LaurentGomila/SFML/wiki" title="Go to the wiki">Wiki</a></div>
        <p>
            The SFML community wiki contains code snippets, tutorials and other community-contributed content.
        </p>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <div class="title">&raquo; <a href="https://kiwiirc.com/client/irc.boxbox.org/sfml" target="_blank" title="Chat in the browser now">IRC</a></div>
        <p>
            For friendly help and talks about SFML (and also offtopic chats, together with a lot of other users) either click on the following button to instantly chat using your browser, or connect your fancy IRC client to the server below.
        </p>
        <ul>
            <li>SSL: <a href="irc://boxbox.org:6697/#sfml" title="Open an IRC client with the SSL port">irc://boxbox.org:6697/#sfml</a></li>
            <li>No SSL: <a href="irc://boxbox.org:6667/#sfml" title="Open an IRC client with the none-SSL port">irc://boxbox.org:6667/#sfml</a></li>
            <li><a href="https://kiwiirc.com/client/irc.boxbox.org/sfml" target="_blank" title="Chat in the browser now">Chat in your browser now</a></li>
        </ul>
    </div>
    <div class="column">
        <a href="https://kiwiirc.com/client/irc.boxbox.org/sfml" target="_blank"><img src="<?php echo image('community/irc.png') ?>" alt="IRC" /></a>
    </div>
</div>

<?php
    require("footer.php");
?>
