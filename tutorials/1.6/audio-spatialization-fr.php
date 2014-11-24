<?php

    $title = "Jouer avec la spatialisation des sons";
    $page = "audio-spatialization-fr.php";

    require("header-fr.php");
?>

<h1>Jouer avec la spatialisation des sons</h1>

<?php h2('Introduction') ?>
<p>
    Jouer des sons et des musiques est sympa, mais pour que ceux-ci soient parfaitement int�gr�s � votre
    environnement 2D ou 3D, il peut �tre encore plus sympa d'ajouter un peu de spatialisation. Jettons un oeil � quelques
    fonctions SFML simples pour cela.
</p>

<?php h2('L\'�couteur') ?>
<p>
    Peu importe le nombre de sons et de musiques que vous placez dans votre sc�ne, ils seront tous entendus par un
    "acteur" unique : l'�couteur (<em>listener</em>). Ce que l'�couteur entendra, est ce qui sortira de vos hauts-parleurs.
</p>
<p>
    SFML d�finit une interface pour modifier et r�cup�rer les propri�t�s de l'�couteur : <?php class_link("Listener")?>.
    Comme l'�couteur est unique dans la sc�ne, cette classe ne contient que des fonctions statiques et n'a pas besoin d'�tre
    instanci�e.
</p>
<p>
    Pour commencer, vous pouvez modifier la position de l'�couteur dans la sc�ne :
</p>
<pre><code class="cpp">sf::Listener::SetPosition(10.f, 0.f, 5.f);
</code></pre>
<p>
    Si vous manipulez un monde 2D vous pouvez simplement utiliser la m�me valeur Y partout, habituellement 0.<br/>
    Par d�faut, l'�couteur est plac� � l'origine du monde (point (0, 0, 0)).
</p>
<p>
    Ensuite, vous pouvez modifier le point vers lequel l'�couteur regarde, afin de d�finir son orientation :
</p>
<pre><code class="cpp">sf::Listener::SetTarget(15.f, 0.f, 5.f);
</code></pre>
<p>
    Ici, notre �couteur regarde le long de l'axe +X. Cela signifie que, par exemple, un son provenant de (15, 0, 3)
    sera entendu par l'�couteur de droite.<br/>
    Par d�faut, l'�couteur regarde le long de l'axe -Z (vecteur (0, 0, -1)).
</p>
<p>
    Enfin, l'�couteur peut ajuster le volume global de la sc�ne, ce qui serait �quivalent � modifier le volume de
    toutes les sources sonores :
</p>
<pre><code class="cpp">sf::Listener::SetGlobalVolume(50.f);
</code></pre>
<p>
    La valeur du volume est une valeur dans l'intervalle [0, 100] ; ainsi, une valeur de 50 r�duira le volume de moiti�.
</p>
<p>
    Notez que tous les param�tres de l'�couteur peuvent �tre r�cup�r�s via les fonctions GetXxx correspondantes.
</p>

<?php h2('Sons et musiques dans votre sc�ne') ?>
<p>
    Il n'y a pas beaucoup plus � dire concernant les sons et les musiques. Vous pouvez changer leur position dans votre
    environnement 2D ou 3D :
</p>
<pre><code class="cpp">sf::Sound 3DSound;
3DSound.SetPosition(3.f, 2.f, 6.f);
</code></pre>
<p>
    Par d�faut, la position est exprim�e en coordonn�es absolues. Il est toutefois possible de la rendre relative
    � la position de l'�couteur si n�cessaire :
</p>
<pre><code class="cpp">3DSound.SetRelativeToListener(true);
</code></pre>
<p>
    Cela aura notamment comme effet de d�sactiver la spatialisation si la position est gard�e � (0, 0, 0). D�sactiver la
    spatialisation est particuli�rement utile pour les sons qui ne font pas partie de la sc�ne (sons d'interface graphique,
    etc.).
</p>
<p>
    Et vous pouvez modifier la fa�on dont ils vont �tre attenu�s relativement � leur distance par rapport � l'�couteur :
</p>
<pre><code class="cpp">3DSound.SetMinDistance(5.f);
3DSound.SetAttenuation(10.f);
</code></pre>
<p>
    La distance minimum est la distance au-dessous de laquelle le son sera entendu � son volume maximum. Ainsi, les
    sons forts (par exemple une explosion) devraient avoir une distance minumum plus haute pour s'assurer qu'ils seront
    entendus de loin. Notez bien qu'une distance minimum de 0 (ie. le son est dans la t�te de l'�couteur :) ) m�nerait �
    une valeur incorrecte et resulterait en un son non-attenu� ; n'utilisez jamais 0.<br/>
    La distance minimum par d�faut est 1.
</p>
<p>
    L'attenuation est un facteur multiplicatif. Plus l'attenuation est �lev�e, moins le son sera entendu
    lorsqu'il s'�loigne de l'�couteur.<br/>
    Pour obtenir un son non-attenu�, vous pouvez utiliser 0. D'un autre c�t�, utiliser une valeur de l'ordre de 100
    va grandement attenuer le son, c'est-�-dire qu'il ne sera audible que s'il est tr�s proche de l'�couteur.<br/>
    L'attenuation par d�faut est 1.
</p>
<p>
    Voici la formule exacte d'attenuation, au cas o� vous auriez besoin de valeurs pr�cises :
</p>
<pre><code class="cpp">    MinDistance est la distance minimum du son, affect�e avec SetMinDistance
    Attenuation est l'attenuation du son, affect� avec SetAttenuation
    Distance    est la distance entre le son et l'�couteur

    Factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Comme vous pouvez le voir, ajouter un degr� de r�alisme � vos environnements 2D ou 3D est facile
    grace � la spatialisation audio.<br/>
    Si vous pensez maintenant �tre pr�t avec le module audio, vous pouvez � pr�sent passer aux
    <a class="internal" href="./network-sockets-fr.php" title="Passer aux tutoriels r�seau">tutoriels r�seau</a>.
</p>

<?php

    require("footer-fr.php");

?>
