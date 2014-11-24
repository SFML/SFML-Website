<?php

    $title = "G�rer le temps";
    $page = "window-time-fr.php";

    require("header-fr.php");
?>

<h1>G�rer le temps</h1>

<?php h2('Introduction') ?>
<p>
    Le temps n'est habituellement pas un gros sujet en soi, mais dans une application temps r�el, il est
    important de le g�rer correctement, comme nous allons le voir dans ce nouveau tutoriel.
</p>

<?php h2('Mesurer le temps') ?>
<p>
    Dans la SFML, vous mesurez le temps avec la classe <?php class_link("Clock")?>. Elle d�finit
    deux fonctions : <code>Reset()</code>, pour remettre � z�ro l'horloge,
    et <code>GetElapsedTime()</code>, pour r�cup�rer le temps �coul� depuis le dernier appel
    � <code>Reset()</code>. Le temps est d�fini en secondes, comme toutes les dur�es que
    vous trouverez dans la SFML.<br/>
    Comme vous le voyez, cette classe est loin d'�tre compliqu�e.
</p>
<pre><code class="cpp">sf::Clock Clock;

while (App.IsOpened())
{
    // Traitement des �v�nements

    // R�cup�ration du temps �coul� depuis le dernier tour de boucle
    float Time = Clock.GetElapsedTime();
    Clock.Reset();

    // Affichage de la fen�tre
}
</code></pre>
<p>
    R�cup�rer le temps �coul� peut �tre tr�s utile si vous avez � incr�menter une variable � chaque tour
    de boucle (une position, une orientation, ...). Si vous ne tenez pas compte du facteur temps, votre
    simulation ne produira pas les m�mes r�sultats selon que l'application tourne � 60 images par seconde
    ou � 1000 images par second. Par exemple, ce bout de code va produire un mouvement d�pendant du taux
    de rafra�chissement :
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
    Alors que celui-ci va assurer une vitesse constante quelque soit le mat�riel :
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
    La plupart du temps, vous aurez � mesurer le temps �coul� depuis le dernier rafra�chissement.
    La classe <?php class_link("Window")?> fournit une fonction utile pour r�cup�rer ce temps sans
    avoir � g�rer une horloge : <code>GetFrameTime()</code>. Ainsi nous pourrions r�-�crire
    notre code de la mani�re suivante :
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

<?php h2('Mesurer le taux de rafra�chissement (framerate)') ?>
<p>
    Le framerate �tant l'inverse de la dur�e d'un rafra�chissement, vous pouvez facilement le d�duire
    du temps �coul� entre deux rafra�chissements :
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
    Si votre framerate se retrouve bloqu� autour de 60 images par seconde ne vous inqui�tez pas : cela
    signifie simplement que la synchronisation verticale (<em>v-sync</em>) est activ�e. Basiquement,
    lorsque la synchronisation verticale est activ�e, l'affichage sera synchronis� avec le taux de
    rafra�chissement du moniteur. Cela signifie que vous ne pourrez jamais afficher plus d'images que
    l'�cran ne le peut. Et c'est une bonne chose, �tant donn� que cela va emp�cher votre application
    de tourner � des vitesses incroyables comme 2000 images par seconde, et produire des artefacts visuels
    ou des comportements inatendus.
</p>
<p>
    Cependant, vous voudriez parfois effectuer des tests pour faire des optimisations, et vous voudriez
    un taux de rafra�chissement maximum. SFML vous autorise � d�sactiver la synchronisation verticale
    si vous le voulez, avec la fonction <code>UseVerticalSync</code> :
</p>
<pre><code class="cpp">App.UseVerticalSync(false);
</code></pre>
<p>
    Notez que la synchronisation verticale est d�sactiv�e par d�faut.
</p>
<p>
    Vous pouvez �galement fixer le taux de rafra�chissement � une fr�quence donn�e :
</p>
<pre><code class="cpp">App.SetFramerateLimit(60); // Limite � 60 images par seconde
App.SetFramerateLimit(0);  // Limite d�sactiv�e
</code></pre>

<?php h2('Conclusion') ?>
<p>
    La gestion du temps n'a plus de secret pour vous, et vous �tes pr�t � �crire des applications temps r�el
    robustes. Dans le
    <a class="internal" href="./window-opengl-fr.php" title="Prochain tutoriel : utiliset OpenGL">prochain tutoriel</a>,
    nous allons jouer un peu avec OpenGL, pour finalement avoir quelque chose � afficher dans notre fen�tre.<br/>
    Cependant, si vous n'�tes pas int�ress� par l'utilisation d'OpenGL avec la SFML, vous pouvez imm�diatement
    sauter � la section suivante concernant le
    <a class="internal" href="./graphics-window-fr.php" title="Ouvrir une fen�tre de rendu">module graphique</a>.
</p>

<?php

    require("footer-fr.php");

?>
