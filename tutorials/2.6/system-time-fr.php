<?php

    $title = "Gérer le temps";
    $page = "system-time-fr.php";

    require("header-fr.php");

?>

<h1>Gérer le temps</h1>

<?php h2('Le temps dans SFML') ?>
<p>
    Contrairement à de nombreuses autres bibliothèques qui définissent le temps comme étant des millisecondes en uint32, ou des secondes en float, SFML
    n'impose aucune unité et aucun type pour les variables de temps. Au lieu de cela, SFML laisse ce choix à l'utilisateur à travers une classe
    flexible : <?php class_link("Time") ?>. Toutes les classes et fonctions SFML qui manipulent du temps utilisent cette classe.
</p>
<p>
    <?php class_link("Time") ?> encapsule une valeur de temps (en d'autres termes, un laps de temps). Ce n'est <em>pas</em> une classe de date, qui
    représenterait l'année/mois/jour/heure/minute/seconde courante, c'est juste une valeur qui représente une certaine quantité de temps, et la manière
    de l'interpréter dépend de son contexte d'utilisation.
</p>

<?php h2('Conversion de temps') ?>
<p>
    Une variable de type <?php class_link("Time") ?> peut être construite à partir de différentes unités : secondes, millisecondes et microsecondes.
    Il existe dans SFML une fonction (non-membre) pour convertir chacune d'elles en <?php class_link("Time") ?> :
</p>
<pre><code class="cpp">sf::Time t1 = sf::microseconds(10000);
sf::Time t2 = sf::milliseconds(10);
sf::Time t3 = sf::seconds(0.01f);
</code></pre>
<p>
    Notez que ces trois variables sont toutes égales.
</p>
<p>
    De la même manière, une variable <?php class_link("Time") ?> peut être convertie en secondes, en millisecondes ou en microsecondes :
</p>
<pre><code class="cpp">sf::Time time = ...;

sf::Int64 usec = time.asMicroseconds();
sf::Int32 msec = time.asMilliseconds();
float     sec  = time.asSeconds();
</code></pre>

<?php h2('Jouer avec les valeurs de temps') ?>
<p>
    La classe <?php class_link("Time") ?> représentant simplement une quantité de temps, elle supporte les opérations arithmétiques telles que l'addition,
    la soustraction, les comparaisons, etc. Les temps peuvent aussi être négatifs.
</p>
<pre><code class="cpp">sf::Time t1 = ...;
sf::Time t2 = t1 * 2;
sf::Time t3 = t1 + t2;
sf::Time t4 = -t3;

bool b1 = (t1 == t2);
bool b2 = (t3 > t4);
</code></pre>

<?php h2('Mesurer le temps') ?>
<p>
    Maintenant que nous avons vu comment manipuler les variables de temps avec SFML, voyons comment faire quelque chose dont à peu près tous les
    programmes ont besoin : mesurer le temps écoulé.
</p>
<p>
    SFML a une classe très simple pour mesurer le temps : <?php class_link("Clock") ?>. Elle ne possède que deux fonctions : <code>getElapsedTime</code>,
    pour récupérer le temps écoulé depuis son démarrage, et <code>restart</code>, pour la redémarrer.
</p>
<pre><code class="cpp">sf::Clock clock; // démarre le chrono
...
sf::Time elapsed1 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed1.asSeconds() &lt;&lt; std::endl;
clock.restart();
...
sf::Time elapsed2 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed2.asSeconds() &lt;&lt; std::endl;
</code></pre>
<p>
    Notez que <code>restart</code> renvoie également le temps écoulé, de façon à éviter le tout petit écart de temps qui existerait si vous aviez à
    appeler <code>getElapsedTime</code> explicitement avant <code>restart</code>.<br />
    Voici un exemple qui utilise le temps écoulé à chaque itération de la boucle principale pour mettre à jour la logique du jeu :
</p>
<pre><code class="cpp">sf::Clock clock;
while (window.isOpen())
{
    sf::Time elapsed = clock.restart();
    updateGame(elapsed);
    ...
}
</code></pre>

<?php

    require("footer-fr.php");

?>
