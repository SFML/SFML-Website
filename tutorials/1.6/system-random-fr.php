<?php

    $title = "Générer des nombres aléatoires";
    $page = "system-random-fr.php";

    require("header-fr.php");
?>

<h1>Générer des nombres aléatoires</h1>

<?php h2('Introduction') ?>
<p>
    Générer des nombres pseudo-aléatoires n'est pas difficile, particulièrement avec les fonctions
    <code>rand</code> et <code>srand</code> de la bibliothèque standard. Mais on finit toujours par écrire des fonctions
    intermédiaires, par exemple pour obtenir un nombre aléatoire dans un intervalle spécifique, ou encore pour
    générer des nombres décimaux. C'est pourquoi la SFML fournit une classe utilitaire, <?php class_link("Randomizer")?>,
    qui définit quelques fonctions pour vous aider.
</p>
<p>
    Ce document est plus une référence qu'un réel tutoriel, tout ce qu'il vous montrera sont les fonctions de la classe
    <?php class_link("Randomizer")?>.
</p>

<?php h2('Changer la graine') ?>
<p>
    La première chose qu'à peu près tout le monde fait dans un programme utilisant les nombres aléatoires, est
    d'initialiser la graine afin de s'assurer que la séquence générée sera bien différente d'une exécution à l'autre.
    La SFML le fait automatiquement au lancement du programme, ainsi vous n'avez pas à vous en préoccuper.
</p>
<p>
    Cependant, si vous souhaitez utiliser une graine spécifique (pour rejouer une séquence connue), vous pouvez utiliser
    la fonction <code>SetSeed</code> :
</p>
<pre><code class="cpp">unsigned int Seed = 10;
sf::Randomizer::SetSeed(Seed);
</code></pre>
<p>
    Vous pouvez également récupérer la graine courante :
</p>
<pre><code class="cpp">unsigned int Seed = sf::Randomizer::GetSeed();
</code></pre>

<?php h2('Générer des nombres aléatoires dans des intervalles spécifiques') ?>
<p>
    <?php class_link("Randomizer")?> fournit deux fonctions pour générer des nombres aléatoires dans des intervalles donnés.
</p>
<p>
    La première génère des nombres entiers :
</p>
<pre><code class="cpp">// Renvoie un nombre entier aléatoire entre 0 et 100
int Random = sf::Randomizer::Random(0, 100);
</code></pre>
<p>
    Et la seconde génère des flottants :
</p>
<pre><code class="cpp">// Renvoie un nombre réel aléatoire entre -1 et 1
float Random = sf::Randomizer::Random(-1.f, 1.f);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    C'est tout ce qu'il y a à dire concernant les nombres aléatoires. Ces quelques fonctions devraient être suffisantes
    pour vos besoins ; toutefois, si vous avez besoin d'une bibliothèque de nombres aléatoires plus complète et plus
    complexe, vous pouvez jeter un oeil à
    <a class="external" href="http://www.boost.org/libs/random/" title="Page de boost.random">boost.random</a>.
</p>
<p>
    Vous pouvez maintenant retourner au
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">sommaire des tutoriels</a>,
    ou passer aux
    <a class="internal" href="./window-window-fr.php" title="Passer aux tutoriels du module de fenêtrage">tutoriels du module de fenêtrage</a>.
</p>

<?php

    require("footer-fr.php");

?>
