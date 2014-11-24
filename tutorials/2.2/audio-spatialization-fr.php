<?php

    $title = "Spatialisation : les sons en 3D";
    $page = "audio-spatialization-fr.php";

    require("header-fr.php");

?>

<h1>Spatialisation : les sons en 3D</h1>

<?php h2('Introduction') ?>
<p>
    Par d�faut, les sons et les musiques sont jou�s � plein volume dans chaque haut-parleur ; ils ne sont pas <em>spatialis�s</em>.
</p>
<p>
    Mais si un son est �mis par une entit� qui se trouve sur la droite de l'�cran, vous aimeriez plut�t qu'il soit entendu depuis le haut-parleur
    de droite. Ou encore, si une musique est jou�e derri�re le joueur, vous aimeriez l'entendre depuis les haut-parleurs arri�re de votre installation
    Dolby 5.1.
</p>
<p>
    Alors... comment faire ?
</p>

<?php h2('Les sons spatialis�s sont mono') ?>
<p class="important">
    Un son ne peut �tre spatialis� que s'il ne poss�de qu'un canal, i.e. si c'est un son mono.<br/>
    La spatialisation est d�sactiv�e pour les sons qui poss�dent plus de canaux, �tant donn� qu'ils donnent d�j� explicitement leur utilisation des
    haut-parleurs. Il est tr�s important de garder cela en t�te.
</p>

<?php h2('L\'�couteur') ?>
<p>
    Tous les sons et musiques de votre environnement audio seront entendus par un acteur unique : l'<em>�couteur</em>. Ce qui est restitu� � travers
    vos haut-parleurs, c'est ce que l'�couteur entend.
</p>
<p>
    La classe qui d�finit les propri�t�s de l'�couteur est <?php class_link("Listener") ?>. Comme l'�couteur est unique dans l'environnement, cette classe ne
    contient que des fonctions statiques et ne doit pas �tre instanci�e.
</p>
<p>
    Tout d'abord, vous pouvez modifier la position de l'�couteur dans la sc�ne :
</p>
<pre><code class="cpp">sf::Listener::setPosition(10.f, 0.f, 5.f);
</code></pre>
<p>
    Si votre monde est en 2D, vous pouvez utiliser la m�me valeur Y partout, typiquement 0.
</p>
<p>
    En plus de sa position, vous pouvez d�finir l'orientation de l'�couteur :
</p>
<pre><code class="cpp">sf::Listener::setDirection(1.f, 0.f, 0.f);
</code></pre>
<p>
    Ici, l'�couteur est orient� le long de l'axe +X. Cela signifie que, par exemple, un son �mis au point (15, 0, 5) sera entendu par le haut-parleur
    de droite.
</p>
<p>
    Il est important de noter que le vecteur "up" de l'�couteur est fix� � (0, 1, 0), en d'autres termes sa t�te est orient�e le long de l'axe +Y.
</p>
<p>
    Enfin, l'�couteur permet d'ajuster le volume global de l'environnement audio :
</p>
<pre><code class="cpp">sf::Listener::setGlobalVolume(50.f);
</code></pre>
<p>
    La valeur du volume est comprise entre 0 et 100, ainsi la mettre � 50 r�duit le volume de moiti�.
</p>
<p>
    Toutes ces propri�t�s peuvent bien entendu �tre relues via les fonctions <code>get</code> correspondantes.
</p>

<?php h2('Les sources audio') ?>
<p>
    Toutes les sources audio fournies par SFML (sons, musiques, flux) d�finissent les m�mes propri�t�s pour la spatialisation.
</p>
<p>
    La propri�t� principale est la position de la source audio.
</p>
<pre><code class="cpp">sound.setPosition(2.f, 0.f, -5.f);
</code></pre>
<p>
    Cette position est absolue par d�faut, mais elle peut devenir relative � l'�couteur si n�cessaire.
</p>
<pre><code class="cpp">sound.setRelativeToListener(true);
</code></pre>
<p>
    Cela peut �tre utile pour les sons �mis par l'�couteur lui-m�me (comme un bruit de tir, ou de pas). Cela a �galement comme effet int�ressant de
    d�sactiver la spatialisation si vous mettez la position de la source audio � (0, 0, 0). Les sons non-spatialis�s peuvent se r�v�ler utiles dans
    de nombreuses situations : sons d'interface graphique (clics), musiques ambiantes, etc.
</p>
<p>
    Vous pouvez �galement d�finir la mani�re avec laquelle les sources audio seront attenu�es selon leur distance par rapport � l'�couteur.
</p>
<pre><code class="cpp">sound.setMinDistance(5.f);
sound.setAttenuation(10.f);
</code></pre>
<p>
    La <em>distance minimum</em> est la distance en-de�a de laquelle la son sera entendu � son volume maximal. Ainsi, par exemple, les sons tr�s forts
    tels que les explosions auront typiquement une distance minimum �lev�e, afin d'�tre s�r qu'ils seront entendus de loin. Notez bien qu'une distance de
    0 (le son se trouve dans la t�te de l'�couteur !) conduirait � des valeurs incorrectes et produirait un son non-attenu�. 0 est une valeur invalide,
    ne l'utilisez pas.
</p>
<p>
    L'<em>attenuation</em> est un facteur multiplicatif. Plus grande est l'att�nuation, moins le son sera fort � mesure qu'il s'�loigne de l'�couteur.
    Afin d'obtenir un son non-attenu�, vous pouvez utiliser 0. A l'inverse, utiliser une valeur �lev�e telle que 100 att�nuera tr�s fortement le son,
    si bien qu'il ne pourra �tre entendu que lorsque l'�couteur en est tr�s proche.
</p>
<p>
    Voici la formule exacte du calcul de l'att�nuation, au cas o� vous auriez besoin de calculer des valeurs pr�cises :
</p>

<pre><code class="none"><em>MinDistance</em>   est la distance minimum du son, affect�e avec setMinDistance
<em>Attenuation</em>   est l'attenuation du son, affect� avec setAttenuation
<em>Distance</em>      est la distance entre le son et l'�couteur
<em>Volume factor</em> est le facteur calcul�, entre 0 et 1, qui sera appliqu� au volume du son

Volume factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
</code></pre>

<?php

    require("footer-fr.php");

?>
