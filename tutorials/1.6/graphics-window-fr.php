<?php

    $title = "Utiliser les fen�tres de rendu";
    $page = "graphics-window-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les fen�tres de rendu</h1>

<?php h2('Introduction') ?>
<p>
    Le module de fen�trage fournit un syst�me complet pour g�rer les fen�tres et les �v�nements, et peut
    s'interfacer avec OpenGL. Mais que se passe-t-il si nous ne voulons pas utiliser OpenGL ? SFML
    fournit un module d�di� � l'affichage de graphiques en 2D, le module graphique.
</p>

<?php h2('Mise en place') ?>
<p>
    Pour travailler avec le module graphique, vous devez inclure le bon en-t�te :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
</code></pre>
<p>
    SFML/Window.hpp n'est plus requis : il sera d�j� inclus par le module graphique.
</p>

<?php h2('La fen�tre de rendu') ?>
<p>
    La fen�tre de base en SFML, <?php class_link("Window")?>, est suffisante pour obtenir
    une fen�tre et ses �v�nements, mais n'a aucune id�e de la mani�re de dessiner quelque chose. En fait,
    il sera impossible de dessiner quoique ce soit du module graphique directement dans une
    <?php class_link("Window")?>. C'est pourquoi le module graphique fournit une classe de
    fen�tre offrant plus de fonctionnalit�s et effectuant plus de travail redondant � votre place :
    <?php class_link("RenderWindow")?>. Comme <?php class_link("RenderWindow")?> h�rite de
    <?php class_link("Window")?>, elle contient d�j� toutes les fonctionnalit�s de cette derni�re et
    agit exactement de la m�me fa�on pour la cr�ation, la r�cup�ration des �v�nements, etc. Tout ce que
    fait <?php class_link("RenderWindow")?> c'est ajouter des fonctionnalit�s pour afficher simplement
    des graphiques.
</p>
<p>
    En fait, une application minimale utilisant le module graphique sera exactement la m�me qu'une
    application qui n'utilise que le module de fen�trage, except� le type de la fen�tre :
</p>
<pre><code class="cpp">int main()
{
    // Cr�ation de la fen�tre de rendu
    sf::RenderWindow App(sf::VideoMode(800, 600, 32), "SFML Graphics");

    // Ex�cution de la boucle principale
    while (App.IsOpened())
    {
        // Traitement des �v�nements
        sf::Event Event;
        while (App.GetEvent(Event))
        {
            // Fen�tre ferm�e : on quitte
            if (Event.Type == sf::Event::Closed)
                App.Close();
        }

        // Efface l'�cran (remplissage avec du noir)
        App.Clear();

        // Affichage du contenu de la fen�tre � l'�cran
        App.Display();
    }

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    La seule diff�rence est qu'ici nous avons ajout� un appel � <code>Clear</code>, de sorte que l'�cran soit rempli
    en noir plut�t que de rester avec des pixel al�atoires.
</p>
<p>
    Si vous souhaitez effacer l'�cran avec une couleur diff�rente, vous pouvez passer celle-ci en param�tre :
</p>
<pre><code class="cpp">App.Clear(sf::Color(200, 0, 0));
</code></pre>
<p>
    Le module graphique de SFML fournit une classe tr�s utile pour manipuler les couleurs :
    <?php class_link("Color")?>. Toutes les couleurs que vous croiserez dans la SFML seront
    des <?php class_link("Color")?>, vous pouvez oublier les entiers 32-bits ou les tableaux de
    flottants.<br/>
    <?php class_link("Color")?> contient basiquement quatre composantes 8-bits :
    <code>r</code> (rouge), <code>g</code> (vert),
    <code>b</code> (bleu),
    et <code>a</code> (alpha -- la transparence) ; leurs valeurs vont de 0 � 255.<br/>
    <?php class_link("Color")?> fournit des fonctions, des op�rateurs et des constructeurs utiles, celui qui nous
    int�resse ici est celui qui prend les 4 composantes en param�tre (la quatri�me, alpha, a une valeur
    par d�faut fix�e � 255). Ainsi dans le code ci-dessus, nous construisons une instance de
    <?php class_link("Color")?> avec une composante rouge � 200, et des composantes verte et bleue
    � 0. Donc... nous obtenons un fond rouge pour notre fen�tre.
</p>
<p>
    Notez bien qu'effacer la fen�tre n'est pas n�cessaire si ce que vous avez � afficher va recouvrir l'�cran
    enti�rement ; ne le faites que si vous avez des pixels qui resteraient non dessin�s.
</p>

<?php h2('Prendre des captures d\'�cran') ?>
<p>
    Ce n'est probablement pas la chose la plus importante, mais cela peut s'av�rer utile.
    <?php class_link("RenderWindow")?> fournit une fonction pour sauvegarder son contenu dans une image :
    <code>Capture</code>. Vous pouvez ensuite sauvegarder l'image dans un fichier facilement � l'aide de la fonction
    <code>SaveToFile</code>, ou faire n'importe quoi d'autre.<br/>
    Donc, par exemple, nous pouvons prendre une capture de l'�cran lorsque l'utilisateur appuie sur la touche F1 :
</p>
<pre><code class="cpp">if (Event.Key.Code == sf::Key::F1)
{
    sf::Image Screen = App.Capture();
    Screen.SaveToFile("screenshot.jpg");
}
</code></pre>
<p>
    Bien entendu, selon la position de cette ligne de code dans votre boucle principale, l'image captur�e ne sera pas
    la m�me. Cela va enregistrer le contenu actuel de l'�cran au moment de l'appel � <code>Capture</code>.
</p>

<?php h2('Mixer avec OpenGL') ?>
<p>
    Il est bien entendu toujours possible d'utiliser vos propres commandes OpenGL avec une
    <?php class_link("RenderWindow")?>,
    comme vous le feriez avec
    <?php class_link("Window")?>.
    Vous pouvez m�me mixer des commandes de dessin de SFML avec votre code OpenGL. Cependant, SFML ne pr�serve pas les
    �tats OpenGL par d�faut. Si SFML met le bazar dans vos �tats OpenGL et que vous voulez qu'il prenne soin de les
    sauver / r�initialiser / restaurer, vous devez appeler la fonction <code>PreserveOpenGLStates</code> :
</p>
<pre><code class="cpp">App.PreserveOpenGLStates(true);
</code></pre>
<p>
    Pr�server les �tats OpenGL est tr�s lourd au niveau du CPU et va degrader les performances, n'utilisez cette option que
    si vous en avez r�ellement besoin. Vous pouvez �galement penser � g�rer cela avec votre propre code, cela sera
    n�cessairement plus optimis� que le code g�n�rique de SFML qui sauvegarde tous les �tats, y compris ceux dont
    vous n'avez pas besoin.
</p>

<?php h2('Conclusion') ?>
<p>
    Il n'y a pas beaucoup plus � dire sur les fen�tres de rendu. Elles fonctionnent comme les fen�tres de
    base, en ajoutant quelques fonctionnalit�s pour faciliter le rendu 2D. Plus de ces fonctionnalit�s
    seront expliqu�es dans les prochains tutoriels, � commencer par
    <a class="internal" href="./graphics-sprite-fr.php" title="Aller au prochain tutoriel">l'affichage de sprites</a>.
</p>

<?php

    require("footer-fr.php");

?>
