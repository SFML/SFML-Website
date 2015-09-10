<div class="well">
    <p>
        <strong>Voulez-vous soutenir SFML ?</strong><br>
        L'équipe de SFML aimerait acheter un ordinateur <em>Apple Mac mini</em> à des fins de développement et de tests sur les plateformes OS X et iOS. Toute aide sous forme de don sera la bienvenue, merci !
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XY9QVMEW4TWRJ"><img src="images/icons/donate-transparent.png"> <strong>Faire un don</strong></a>
    </p>

    <?php
        include(dirname(__FILE__) . '/scripts/progressbar.php');
        @include(dirname(__FILE__) . '/progressbar-osx-values.php');

        if(defined('OSX_VALUE') && defined('OSX_MAX'))
            echo makeProgressbar(OSX_MAX, OSX_VALUE);
    ?>
</div>
