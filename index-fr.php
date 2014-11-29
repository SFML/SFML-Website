<?php
    $breadcrumbs = array();
    include('header-fr.php');
?>

<h1>Simple and Fast Multimedia Library</h1>

<!--<div class="news">
    <strong>SFML 2.1</strong> est sortie</a>
</div>-->

<div class="home-section">
    <div class="column">
        <div class="title">SFML est multi-media</div>
        <p>
            SFML offre une interface simple vers les diff�rents composants de votre PC, afin de faciliter le d�veloppement de jeux ou d'applications multimedia. Elle se
            compose de cinq modules : syst�me, fen�trage, graphisme, audio et r�seau.
        </p>
        <p>
            D�couvrez plus en d�tail leurs fonctionnalit�s, dans <a href="learn-fr.php" title="Aller � la page des tutoriels et de la documentation">les tutoriels et
            la documentation de l'API</a>.
        </p>
    </div>
    <div class="column image">
        <img src="<?php echo image('home/multimedia.png') ?>" alt="Image multimedia" />
    </div>
</div>

<div class="home-section">
    <div class="column image">
        <img src="<?php echo image('home/multiplatform.png') ?>" alt="Image multi-platforme" />
    </div>
    <div class="column">
        <div class="title">SFML est multi-plateforme</div>
        <p>
            Avec SFML, votre application peut se compiler et tourner sans effort sur la plupart des syst�mes d'exploitation : Windows, Linux, Mac OS X et prochainement
            Android &amp; iOS.
        </p>
        <p>
            Des SDKs pr�compil�s pour votre OS pr�f�r� sont disponibles sur la <a href="download-fr.php" title="Aller � la page des t�l�chargements">page des t�l�chargements</a>.
        </p>
    </div>
</div>

<div class="home-section">
    <div class="column">
        <div class="title">SFML est multi-langage</div>
        <p>
            SFML poss�de des bindings officiels pour les langages C et .Net. Et grace � sa communaut� tr�s active, elle est �galement disponible dans beaucoup d'autres
            langages tels que Java, Ruby, Python, Go et plus encore.
        </p>
        <p>
            Apprenez-en d'avantage � leur sujet sur la <a href="download/bindings-fr.php" title="Aller � la page des bindings">page des bindings</a>.
        </p>
    </div>
    <div class="column image">
        <img src="<?php echo image('home/multilanguage.png') ?>" alt="Image multi-langage" />
    </div>
</div>

<?php
    require("footer-fr.php");
?>
