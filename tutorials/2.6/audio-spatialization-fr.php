<?php

    $title = "Spatialisation : les sons en 3D";
    $page = "audio-spatialization-fr.php";

    require("header-fr.php");

?>

<h1>Spatialisation : les sons en 3D</h1>

<?php h2('Introduction') ?>
<p>
    Par défaut, les sons et les musiques sont joués à plein volume dans chaque haut-parleur ; ils ne sont pas <em>spatialisés</em>.
</p>
<p>
    Mais si un son est émis par une entité qui se trouve sur la droite de l'écran, vous aimeriez plutôt qu'il soit entendu depuis le haut-parleur
    de droite. Ou encore, si une musique est jouée derrière le joueur, vous aimeriez l'entendre depuis les haut-parleurs arrière de votre installation
    Dolby 5.1.
</p>
<p>
    Alors... comment faire ?
</p>

<?php h2('Les sons spatialisés sont mono') ?>
<p class="important">
    Un son ne peut être spatialisé que s'il ne possède qu'un canal, i.e. si c'est un son mono.<br/>
    La spatialisation est désactivée pour les sons qui possèdent plus de canaux, étant donné qu'ils donnent déjà explicitement leur utilisation des
    haut-parleurs. Il est très important de garder cela en tête.
</p>

<?php h2('L\'écouteur') ?>
<p>
    Tous les sons et musiques de votre environnement audio seront entendus par un acteur unique : l'<em>écouteur</em>. Ce qui est restitué à travers
    vos haut-parleurs, c'est ce que l'écouteur entend.
</p>
<p>
    La classe qui définit les propriétés de l'écouteur est <?php class_link("Listener") ?>. Comme l'écouteur est unique dans l'environnement, cette classe ne
    contient que des fonctions statiques et ne doit pas être instanciée.
</p>
<p>
    Tout d'abord, vous pouvez modifier la position de l'écouteur dans la scène :
</p>
<pre><code class="cpp">sf::Listener::setPosition(10.f, 0.f, 5.f);
</code></pre>
<p>
    Si votre monde est en 2D, vous pouvez utiliser la même valeur Y partout, typiquement 0.
</p>
<p>
    En plus de sa position, vous pouvez définir l'orientation de l'écouteur :
</p>
<pre><code class="cpp">sf::Listener::setDirection(1.f, 0.f, 0.f);
</code></pre>
<p>
    Ici, l'écouteur est orienté le long de l'axe +X. Cela signifie que, par exemple, un son émis au point (15, 0, 5) sera entendu par le haut-parleur
    de droite.
</p>
<p>
    Il est important de noter que le vecteur "up" de l'écouteur est fixé à (0, 1, 0), en d'autres termes sa tête est orientée le long de l'axe +Y.
</p>
<p>
    Enfin, l'écouteur permet d'ajuster le volume global de l'environnement audio :
</p>
<pre><code class="cpp">sf::Listener::setGlobalVolume(50.f);
</code></pre>
<p>
    La valeur du volume est comprise entre 0 et 100, ainsi la mettre à 50 réduit le volume de moitié.
</p>
<p>
    Toutes ces propriétés peuvent bien entendu être relues via les fonctions <code>get</code> correspondantes.
</p>

<?php h2('Les sources audio') ?>
<p>
    Toutes les sources audio fournies par SFML (sons, musiques, flux) définissent les mêmes propriétés pour la spatialisation.
</p>
<p>
    La propriété principale est la position de la source audio.
</p>
<pre><code class="cpp">sound.setPosition(2.f, 0.f, -5.f);
</code></pre>
<p>
    Cette position est absolue par défaut, mais elle peut devenir relative à l'écouteur si nécessaire.
</p>
<pre><code class="cpp">sound.setRelativeToListener(true);
</code></pre>
<p>
    Cela peut être utile pour les sons émis par l'écouteur lui-même (comme un bruit de tir, ou de pas). Cela a également comme effet intéressant de
    désactiver la spatialisation si vous mettez la position de la source audio à (0, 0, 0). Les sons non-spatialisés peuvent se révéler utiles dans
    de nombreuses situations : sons d'interface graphique (clics), musiques ambiantes, etc.
</p>
<p>
    Vous pouvez également définir la manière avec laquelle les sources audio seront attenuées selon leur distance par rapport à l'écouteur.
</p>
<pre><code class="cpp">sound.setMinDistance(5.f);
sound.setAttenuation(10.f);
</code></pre>
<p>
    La <em>distance minimum</em> est la distance en-deça de laquelle la son sera entendu à son volume maximal. Ainsi, par exemple, les sons très forts
    tels que les explosions auront typiquement une distance minimum élevée, afin d'être sûr qu'ils seront entendus de loin. Notez bien qu'une distance de
    0 (le son se trouve dans la tête de l'écouteur !) conduirait à des valeurs incorrectes et produirait un son non-attenué. 0 est une valeur invalide,
    ne l'utilisez pas.
</p>
<p>
    L'<em>attenuation</em> est un facteur multiplicatif. Plus grande est l'atténuation, moins le son sera fort à mesure qu'il s'éloigne de l'écouteur.
    Afin d'obtenir un son non-attenué, vous pouvez utiliser 0. A l'inverse, utiliser une valeur élevée telle que 100 atténuera très fortement le son,
    si bien qu'il ne pourra être entendu que lorsque l'écouteur en est très proche.
</p>
<p>
    Voici la formule exacte du calcul de l'atténuation, au cas où vous auriez besoin de calculer des valeurs précises :
</p>

<pre><code class="none"><em>MinDistance</em>   est la distance minimum du son, affectée avec setMinDistance
<em>Attenuation</em>   est l'attenuation du son, affecté avec setAttenuation
<em>Distance</em>      est la distance entre le son et l'écouteur
<em>Volume factor</em> est le facteur calculé, entre 0 et 1, qui sera appliqué au volume du son

Volume factor = MinDistance / (MinDistance + Attenuation * (max(Distance, MinDistance) - MinDistance))
</code></pre>

<?php

    require("footer-fr.php");

?>
