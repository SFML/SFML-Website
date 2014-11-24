<?php
    $breadcrumbs = array();
    include('header.php');
?>

<h1>Simple and Fast Multimedia Library</h1>

<!--<div class="news">
    <strong>SFML 2.1</strong> has been released</a>
</div>-->

<div class="home-section">
    <div class="column">
        <div class="title">SFML is multi-media</div>
        <p>
            SFML provides a simple interface to the various components of your PC, to ease the development of games and multimedia applications. It is composed of
            five modules: system, window, graphics, audio and network.
        </p>
        <p>
            Discover their features more in detail in <a href="resources.php" title="Go to the tutorials and documentation page">the tutorials and
            the API documentation</a>.
        </p>
    </div>
    <div class="column">
        <img src="<?php echo image('home/multimedia.png') ?>" alt="Multimedia image" />
    </div>
</div>

<div class="home-section">
    <div class="column">
        <img src="<?php echo image('home/multiplatform.png') ?>" alt="Multiplatform image" />
    </div>
    <div class="column">
        <div class="title">SFML is multi-platform</div>
        <p>
            With SFML, your application can compile and run out of the box on the most common operating systems: Windows, Linux, Mac OS X and soon Android &amp; iOS.
        </p>
        <p>
            Pre-compiled SDKs for your favorite OS are available on the <a href="download.php" title="Go to the download page">download page</a>.
        </p>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <div class="title">SFML is multi-language</div>
        <p>
            SFML has official bindings for the C and .Net languages. And thanks to its active community, it is also available in many other languages such as Java, Ruby,
            Python, Go, and more.
        </p>
        <p>
            Learn more about them on the <a href="download/bindings.php" title="Go to the bindings page">bindings page</a>.
        </p>
    </div>
    <div class="column">
        <img src="<?php echo image('home/multilanguage.png') ?>" alt="Multilanguage image" />
    </div>
</div>

<?php
    require("footer.php");
?>
