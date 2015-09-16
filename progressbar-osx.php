<div class="well">
    <p>
        <strong>Do you want to support SFML?</strong><br>
        The SFML development team would like to buy an <em>Apple Mac mini</em> computer for development and testing for OS X and iOS targets. Any help in form of donations is very welcome, thank you!
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8HLETQBYK63E"><img src="images/icons/donate-transparent.png"> <strong>Donate now</strong></a>
    </p>

    <?php
        include(dirname(__FILE__) . '/scripts/progressbar.php');
        @include(dirname(__FILE__) . '/progressbar-osx-values.php');

        if(isset($OSX_VALUE) && isset($OSX_GOALS))
            echo makeProgressbar($OSX_VALUE, $OSX_GOALS);
    ?>
</div>
