<?php

    $title = "Utiliser les fenêtres de rendu";
    $page = "graphics-window-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser les fenêtres de rendu</h1>

<?php h2('Introduction') ?>
<p>
    Le module de fenêtrage fournit un système complet pour gérer les fenêtres et les évènements, et peut
    s'interfacer avec OpenGL. Mais que se passe-t-il si nous ne voulons pas utiliser OpenGL ? SFML
    fournit un module dédié à l'affichage de graphiques en 2D, le module graphique.
</p>

<?php h2('Mise en place') ?>
<p>
    Pour travailler avec le module graphique, vous devez inclure le bon en-tête :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
</code></pre>
<p>
    SFML/Window.hpp n'est plus requis : il sera déjà inclus par le module graphique.
</p>

<?php h2('La fenêtre de rendu') ?>
<p>
    La fenêtre de base en SFML, <?php class_link("Window")?>, est suffisante pour obtenir
    une fenêtre et ses évènements, mais n'a aucune idée de la manière de dessiner quelque chose. En fait,
    il sera impossible de dessiner quoique ce soit du module graphique directement dans une
    <?php class_link("Window")?>. C'est pourquoi le module graphique fournit une classe de
    fenêtre offrant plus de fonctionnalités et effectuant plus de travail redondant à votre place :
    <?php class_link("RenderWindow")?>. Comme <?php class_link("RenderWindow")?> hérite de
    <?php class_link("Window")?>, elle contient déjà toutes les fonctionnalités de cette dernière et
    agit exactement de la même façon pour la création, la récupération des évènements, etc. Tout ce que
    fait <?php class_link("RenderWindow")?> c'est ajouter des fonctionnalités pour afficher simplement
    des graphiques.
</p>
<p>
    En fait, une application minimale utilisant le module graphique sera exactement la même qu'une
    application qui n'utilise que le module de fenêtrage, excepté le type de la fenêtre :
</p>
<pre><code class="cpp">int main()
{
    // Création de la fenêtre de rendu
    sf::RenderWindow App(sf::VideoMode(800, 600, 32), "SFML Graphics");

    // Exécution de la boucle principale
    while (App.IsOpened())
    {
        // Traitement des évènements
        sf::Event Event;
        while (App.GetEvent(Event))
        {
            // Fenêtre fermée : on quitte
            if (Event.Type == sf::Event::Closed)
                App.Close();
        }

        // Efface l'écran (remplissage avec du noir)
        App.Clear();

        // Affichage du contenu de la fenêtre à l'écran
        App.Display();
    }

    return EXIT_SUCCESS;
}
</code></pre>
<p>
    La seule différence est qu'ici nous avons ajouté un appel à <code>Clear</code>, de sorte que l'écran soit rempli
    en noir plutôt que de rester avec des pixel aléatoires.
</p>
<p>
    Si vous souhaitez effacer l'écran avec une couleur différente, vous pouvez passer celle-ci en paramètre :
</p>
<pre><code class="cpp">App.Clear(sf::Color(200, 0, 0));
</code></pre>
<p>
    Le module graphique de SFML fournit une classe très utile pour manipuler les couleurs :
    <?php class_link("Color")?>. Toutes les couleurs que vous croiserez dans la SFML seront
    des <?php class_link("Color")?>, vous pouvez oublier les entiers 32-bits ou les tableaux de
    flottants.<br/>
    <?php class_link("Color")?> contient basiquement quatre composantes 8-bits :
    <code>r</code> (rouge), <code>g</code> (vert),
    <code>b</code> (bleu),
    et <code>a</code> (alpha -- la transparence) ; leurs valeurs vont de 0 à 255.<br/>
    <?php class_link("Color")?> fournit des fonctions, des opérateurs et des constructeurs utiles, celui qui nous
    intéresse ici est celui qui prend les 4 composantes en paramètre (la quatrième, alpha, a une valeur
    par défaut fixée à 255). Ainsi dans le code ci-dessus, nous construisons une instance de
    <?php class_link("Color")?> avec une composante rouge à 200, et des composantes verte et bleue
    à 0. Donc... nous obtenons un fond rouge pour notre fenêtre.
</p>
<p>
    Notez bien qu'effacer la fenêtre n'est pas nécessaire si ce que vous avez à afficher va recouvrir l'écran
    entièrement ; ne le faites que si vous avez des pixels qui resteraient non dessinés.
</p>

<?php h2('Prendre des captures d\'écran') ?>
<p>
    Ce n'est probablement pas la chose la plus importante, mais cela peut s'avérer utile.
    <?php class_link("RenderWindow")?> fournit une fonction pour sauvegarder son contenu dans une image :
    <code>Capture</code>. Vous pouvez ensuite sauvegarder l'image dans un fichier facilement à l'aide de la fonction
    <code>SaveToFile</code>, ou faire n'importe quoi d'autre.<br/>
    Donc, par exemple, nous pouvons prendre une capture de l'écran lorsque l'utilisateur appuie sur la touche F1 :
</p>
<pre><code class="cpp">if (Event.Key.Code == sf::Key::F1)
{
    sf::Image Screen = App.Capture();
    Screen.SaveToFile("screenshot.jpg");
}
</code></pre>
<p>
    Bien entendu, selon la position de cette ligne de code dans votre boucle principale, l'image capturée ne sera pas
    la même. Cela va enregistrer le contenu actuel de l'écran au moment de l'appel à <code>Capture</code>.
</p>

<?php h2('Mixer avec OpenGL') ?>
<p>
    Il est bien entendu toujours possible d'utiliser vos propres commandes OpenGL avec une
    <?php class_link("RenderWindow")?>,
    comme vous le feriez avec
    <?php class_link("Window")?>.
    Vous pouvez même mixer des commandes de dessin de SFML avec votre code OpenGL. Cependant, SFML ne préserve pas les
    états OpenGL par défaut. Si SFML met le bazar dans vos états OpenGL et que vous voulez qu'il prenne soin de les
    sauver / réinitialiser / restaurer, vous devez appeler la fonction <code>PreserveOpenGLStates</code> :
</p>
<pre><code class="cpp">App.PreserveOpenGLStates(true);
</code></pre>
<p>
    Préserver les états OpenGL est très lourd au niveau du CPU et va degrader les performances, n'utilisez cette option que
    si vous en avez réellement besoin. Vous pouvez également penser à gérer cela avec votre propre code, cela sera
    nécessairement plus optimisé que le code générique de SFML qui sauvegarde tous les états, y compris ceux dont
    vous n'avez pas besoin.
</p>

<?php h2('Conclusion') ?>
<p>
    Il n'y a pas beaucoup plus à dire sur les fenêtres de rendu. Elles fonctionnent comme les fenêtres de
    base, en ajoutant quelques fonctionnalités pour faciliter le rendu 2D. Plus de ces fonctionnalités
    seront expliquées dans les prochains tutoriels, à commencer par
    <a class="internal" href="./graphics-sprite-fr.php" title="Aller au prochain tutoriel">l'affichage de sprites</a>.
</p>

<?php

    require("footer-fr.php");

?>
