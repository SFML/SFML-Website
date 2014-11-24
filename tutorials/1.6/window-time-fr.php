<?php

    $title = "Gérer le temps";
    $page = "window-time-fr.php";

    require("header-fr.php");
?>

<h1>Gérer le temps</h1>

<?php h2('Introduction') ?>
<p>
    Le temps n'est habituellement pas un gros sujet en soi, mais dans une application temps réel, il est
    important de le gérer correctement, comme nous allons le voir dans ce nouveau tutoriel.
</p>

<?php h2('Mesurer le temps') ?>
<p>
    Dans la SFML, vous mesurez le temps avec la classe <?php class_link("Clock")?>. Elle définit
    deux fonctions : <code>Reset()</code>, pour remettre à zéro l'horloge,
    et <code>GetElapsedTime()</code>, pour récupérer le temps écoulé depuis le dernier appel
    à <code>Reset()</code>. Le temps est défini en secondes, comme toutes les durées que
    vous trouverez dans la SFML.<br/>
    Comme vous le voyez, cette classe est loin d'être compliquée.
</p>
<pre><code class="cpp">sf::Clock Clock;

while (App.IsOpened())
{
    // Traitement des évènements

    // Récupération du temps écoulé depuis le dernier tour de boucle
    float Time = Clock.GetElapsedTime();
    Clock.Reset();

    // Affichage de la fenêtre
}
</code></pre>
<p>
    Récupérer le temps écoulé peut être très utile si vous avez à incrémenter une variable à chaque tour
    de boucle (une position, une orientation, ...). Si vous ne tenez pas compte du facteur temps, votre
    simulation ne produira pas les mêmes résultats selon que l'application tourne à 60 images par seconde
    ou à 1000 images par second. Par exemple, ce bout de code va produire un mouvement dépendant du taux
    de rafraîchissement :
</p>
<pre><code class="cpp">const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed;
}
</code></pre>
<p>
    Alors que celui-ci va assurer une vitesse constante quelque soit le matériel :
</p>
<pre><code class="cpp">sf::Clock Clock;

const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    float ElapsedTime = Clock.GetElapsedTime();
    Clock.Reset();

    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * ElapsedTime;
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * ElapsedTime;
}
</code></pre>
<p>
    La plupart du temps, vous aurez à mesurer le temps écoulé depuis le dernier rafraîchissement.
    La classe <?php class_link("Window")?> fournit une fonction utile pour récupérer ce temps sans
    avoir à gérer une horloge : <code>GetFrameTime()</code>. Ainsi nous pourrions ré-écrire
    notre code de la manière suivante :
</p>
<pre><code class="cpp">const float Speed = 50.f;
float Left = 0.f;
float Top  = 0.f;

while (App.IsOpened())
{
    if (App.GetInput().IsKeyDown(sf::Key::Left))  Left -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Right)) Left += Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Up))    Top  -= Speed * App.GetFrameTime();
    if (App.GetInput().IsKeyDown(sf::Key::Down))  Top  += Speed * App.GetFrameTime();
}
</code></pre>

<?php h2('Mesurer le taux de rafraîchissement (framerate)') ?>
<p>
    Le framerate étant l'inverse de la durée d'un rafraîchissement, vous pouvez facilement le déduire
    du temps écoulé entre deux rafraîchissements :
</p>
<pre><code class="cpp">sf::Clock Clock;

while (App.IsOpened())
{
    float Framerate = 1.f / Clock.GetElapsedTime();
    Clock.Reset();
}

// Ou bien :

while (App.IsOpened())
{
    float Framerate = 1.f / App.GetFrameTime();
}
</code></pre>
<p>
    Si votre framerate se retrouve bloqué autour de 60 images par seconde ne vous inquiétez pas : cela
    signifie simplement que la synchronisation verticale (<em>v-sync</em>) est activée. Basiquement,
    lorsque la synchronisation verticale est activée, l'affichage sera synchronisé avec le taux de
    rafraîchissement du moniteur. Cela signifie que vous ne pourrez jamais afficher plus d'images que
    l'écran ne le peut. Et c'est une bonne chose, étant donné que cela va empêcher votre application
    de tourner à des vitesses incroyables comme 2000 images par seconde, et produire des artefacts visuels
    ou des comportements inatendus.
</p>
<p>
    Cependant, vous voudriez parfois effectuer des tests pour faire des optimisations, et vous voudriez
    un taux de rafraîchissement maximum. SFML vous autorise à désactiver la synchronisation verticale
    si vous le voulez, avec la fonction <code>UseVerticalSync</code> :
</p>
<pre><code class="cpp">App.UseVerticalSync(false);
</code></pre>
<p>
    Notez que la synchronisation verticale est désactivée par défaut.
</p>
<p>
    Vous pouvez également fixer le taux de rafraîchissement à une fréquence donnée :
</p>
<pre><code class="cpp">App.SetFramerateLimit(60); // Limite à 60 images par seconde
App.SetFramerateLimit(0);  // Limite désactivée
</code></pre>

<?php h2('Conclusion') ?>
<p>
    La gestion du temps n'a plus de secret pour vous, et vous êtes prêt à écrire des applications temps réel
    robustes. Dans le
    <a class="internal" href="./window-opengl-fr.php" title="Prochain tutoriel : utiliset OpenGL">prochain tutoriel</a>,
    nous allons jouer un peu avec OpenGL, pour finalement avoir quelque chose à afficher dans notre fenêtre.<br/>
    Cependant, si vous n'êtes pas intéressé par l'utilisation d'OpenGL avec la SFML, vous pouvez immédiatement
    sauter à la section suivante concernant le
    <a class="internal" href="./graphics-window-fr.php" title="Ouvrir une fenêtre de rendu">module graphique</a>.
</p>

<?php

    require("footer-fr.php");

?>
