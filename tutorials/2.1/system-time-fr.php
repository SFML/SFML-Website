<?php

    $title = "G�rer le temps";
    $page = "system-time-fr.php";

    require("header-fr.php");

?>

<h1>G�rer le temps</h1>

<?php h2('Le temps dans SFML') ?>
<p>
    Contrairement � de nombreuses autres biblioth�ques qui d�finissent le temps comme �tant des millisecondes en uint32, ou des secondes en float, SFML
    n'impose aucune unit� et aucun type pour les variables de temps. Au lieu de cela, SFML laisse ce choix � l'utilisateur � travers une classe
    flexible : <?php class_link("Time") ?>. Toutes les classes et fonctions SFML qui manipulent du temps utilisent cette classe.
</p>
<p>
    <?php class_link("Time") ?> encapsule une valeur de temps (en d'autres termes, un laps de temps). Ce n'est <em>pas</em> une classe de date, qui
    repr�senterait l'ann�e/mois/jour/heure/minute/seconde courante, c'est juste une valeur qui repr�sente une certaine quantit� de temps, et la mani�re
    de l'interpr�ter d�pend de son contexte d'utilisation.
</p>

<?php h2('Conversion de temps') ?>
<p>
    Une variable de type <?php class_link("Time") ?> peut �tre construite � partir de diff�rentes unit�s : secondes, millisecondes et microsecondes.
    Il existe dans SFML une fonction (non-membre) pour convertir chacune d'elles en <?php class_link("Time") ?> :
</p>
<pre><code class="cpp">sf::Time t1 = sf::microseconds(10000);
sf::Time t2 = sf::milliseconds(10);
sf::Time t3 = sf::seconds(0.01f);
</code></pre>
<p>
    Notez que ces trois variables sont toutes �gales.
</p>
<p>
    De la m�me mani�re, une variable <?php class_link("Time") ?> peut �tre convertie en secondes, en millisecondes ou en microsecondes :
</p>
<pre><code class="cpp">sf::Time time = ...;

sf::Int64 usec = time.asMicroseconds();
sf::Int32 msec = time.asMilliseconds();
float     sec  = time.asSeconds();
</code></pre>

<?php h2('Jouer avec les valeurs de temps') ?>
<p>
    La classe <?php class_link("Time") ?> repr�sentant simplement une quantit� de temps, elle supporte les op�rations arithm�tiques telles que l'addition,
    la soustraction, les comparaisons, etc. Les temps peuvent aussi �tre n�gatifs.
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
    Maintenant que nous avons vu comment manipuler les variables de temps avec SFML, voyons comment faire quelque chose dont � peu pr�s tous les
    programmes ont besoin : mesurer le temps �coul�.
</p>
<p>
    SFML a une classe tr�s simple pour mesurer le temps : <?php class_link("Clock") ?>. Elle ne poss�de que deux fonctions : <code>getElapsedTime</code>,
    pour r�cup�rer le temps �coul� depuis son d�marrage, et <code>restart</code>, pour la red�marrer.
</p>
<pre><code class="cpp">sf::Clock clock; // d�marre le chrono
...
sf::Time elapsed1 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed1.asSeconds() &lt;&lt; std::endl;
clock.restart();
...
sf::Time elapsed2 = clock.getElapsedTime();
std::cout &lt;&lt; elapsed2.asSeconds() &lt;&lt; std::endl;
</code></pre>
<p>
    Notez que <code>restart</code> renvoie �galement le temps �coul�, de fa�on � �viter le tout petit �cart de temps qui existerait si vous aviez �
    appeler <code>getElapsedTime</code> explicitement avant <code>restart</code>.<br />
    Voici un exemple qui utilise le temps �coul� � chaque it�ration de la boucle principale pour mettre � jour la logique du jeu :
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
