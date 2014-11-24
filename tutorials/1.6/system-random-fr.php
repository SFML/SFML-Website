<?php

    $title = "G�n�rer des nombres al�atoires";
    $page = "system-random-fr.php";

    require("header-fr.php");
?>

<h1>G�n�rer des nombres al�atoires</h1>

<?php h2('Introduction') ?>
<p>
    G�n�rer des nombres pseudo-al�atoires n'est pas difficile, particuli�rement avec les fonctions
    <code>rand</code> et <code>srand</code> de la biblioth�que standard. Mais on finit toujours par �crire des fonctions
    interm�diaires, par exemple pour obtenir un nombre al�atoire dans un intervalle sp�cifique, ou encore pour
    g�n�rer des nombres d�cimaux. C'est pourquoi la SFML fournit une classe utilitaire, <?php class_link("Randomizer")?>,
    qui d�finit quelques fonctions pour vous aider.
</p>
<p>
    Ce document est plus une r�f�rence qu'un r�el tutoriel, tout ce qu'il vous montrera sont les fonctions de la classe
    <?php class_link("Randomizer")?>.
</p>

<?php h2('Changer la graine') ?>
<p>
    La premi�re chose qu'� peu pr�s tout le monde fait dans un programme utilisant les nombres al�atoires, est
    d'initialiser la graine afin de s'assurer que la s�quence g�n�r�e sera bien diff�rente d'une ex�cution � l'autre.
    La SFML le fait automatiquement au lancement du programme, ainsi vous n'avez pas � vous en pr�occuper.
</p>
<p>
    Cependant, si vous souhaitez utiliser une graine sp�cifique (pour rejouer une s�quence connue), vous pouvez utiliser
    la fonction <code>SetSeed</code> :
</p>
<pre><code class="cpp">unsigned int Seed = 10;
sf::Randomizer::SetSeed(Seed);
</code></pre>
<p>
    Vous pouvez �galement r�cup�rer la graine courante :
</p>
<pre><code class="cpp">unsigned int Seed = sf::Randomizer::GetSeed();
</code></pre>

<?php h2('G�n�rer des nombres al�atoires dans des intervalles sp�cifiques') ?>
<p>
    <?php class_link("Randomizer")?> fournit deux fonctions pour g�n�rer des nombres al�atoires dans des intervalles donn�s.
</p>
<p>
    La premi�re g�n�re des nombres entiers :
</p>
<pre><code class="cpp">// Renvoie un nombre entier al�atoire entre 0 et 100
int Random = sf::Randomizer::Random(0, 100);
</code></pre>
<p>
    Et la seconde g�n�re des flottants :
</p>
<pre><code class="cpp">// Renvoie un nombre r�el al�atoire entre -1 et 1
float Random = sf::Randomizer::Random(-1.f, 1.f);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    C'est tout ce qu'il y a � dire concernant les nombres al�atoires. Ces quelques fonctions devraient �tre suffisantes
    pour vos besoins ; toutefois, si vous avez besoin d'une biblioth�que de nombres al�atoires plus compl�te et plus
    complexe, vous pouvez jeter un oeil �
    <a class="external" href="http://www.boost.org/libs/random/" title="Page de boost.random">boost.random</a>.
</p>
<p>
    Vous pouvez maintenant retourner au
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">sommaire des tutoriels</a>,
    ou passer aux
    <a class="internal" href="./window-window-fr.php" title="Passer aux tutoriels du module de fen�trage">tutoriels du module de fen�trage</a>.
</p>

<?php

    require("footer-fr.php");

?>
