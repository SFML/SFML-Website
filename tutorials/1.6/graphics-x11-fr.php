<?php

    $title = "Intégrer à une interface X11";
    $page = "graphics-x11-fr.php";

    require("header-fr.php");
?>

<h1>Intégrer à une interface X11</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce nouveau tutoriel, nous nous intéresserons à l'intégration de la SFML à une interface X11. Si vous
    n'êtes pas familiers avec la programmation avec Xlib vous pouvez commencer par lire un tutoriel sur le sujet, car nous
    ne détaillerons dans ce tutoriel que la manière dont SFML s'intègre à une fenêtre X11.
</p>

<?php h2('Création de la fenêtre X11') ?>
<p>
    Premièrement, nous devons créer une interface X11. Nous créerons une fenêtre principale, et une sous-fenêtre dans laquelle
    nous allons afficher un rendu SFML. Le bout de code suivant est du code X11 classique, aucune fonction SFML
    n'entre encore en jeu :
</p>
<pre><code class="cpp">// On ouvre une connection avec le serveur X
Display* Disp = XOpenDisplay(NULL);
if (!Disp)
    return EXIT_FAILURE;

// On récupère le numéro de l'écran par défaut
int Screen = DefaultScreen(Disp);

// On crée la fenêtre principale
XSetWindowAttributes Attributes;
Attributes.background_pixel = BlackPixel(Disp, Screen);
Attributes.event_mask       = KeyPressMask;
Window Win = XCreateWindow(Disp, RootWindow(Disp, Screen),
                           0, 0, 650, 330, 0,
                           DefaultDepth(Disp, Screen),
                           InputOutput,
                           DefaultVisual(Disp, Screen),
                           CWBackPixel | CWEventMask, &amp;Attributes);
if (!Win)
    return EXIT_FAILURE;

// On change son titre
XStoreName(Disp, Win, "SFML Window");

// On crée la sous-fenêtre qui servira à héberger notre vue SFML
Window View = XCreateWindow(Disp, Win,
                             10, 10, 310, 310, 0,
                             DefaultDepth(Disp, Screen),
                             InputOutput,
                             DefaultVisual(Disp, Screen),
                             0, NULL);

// Et enfin on affiche nos fenêtres fraîchement créées
XMapWindow(Disp, Win);
XMapWindow(Disp, View);
XFlush(Disp);
</code></pre>

<?php h2('Définition d\'une vue SFML') ?>
<p>
    Une fois que tous les composants de l'interface ont été créés, nous pouvons définir notre vue SFML. Pour ce faire,
    nous avons juste à construire une instance de <?php class_link("RenderWindows")?> et à lui passer l'identificateur de
    la fenêtre X11 :
</p>
<pre><code class="cpp">sf::RenderWindow SFMLView(View);

// Ou, si vous souhaitez le faire après la construction :

SFMLView.Create(View);
</code></pre>
<p>
    Et voilà, vous avez une fenêtre de rendu SFML intégrée à votre interface X11.
</p>

<?php h2('La boucle principale') ?>
<p>
    La boucle d'évènements est une boucle X11 classique :
</p>
<pre><code class="cpp">bool IsRunning = true;
while (IsRunning)
{
    while (XPending(Disp))
    {
        // On traite le prochain évènement en attente
        XEvent Event;
        XNextEvent(Disp, &amp;Event);
        switch (Event.type)
        {
            case KeyPress :
                IsRunning = false;
                break;
        }
    }

    // Notre code de rendu SFML vient ici :
    // ...
}
</code></pre>
<p>
    Puis nous pouvons insérer notre code SFML :
</p>
<pre><code class="cpp">// On efface la vue
SFMLView.Clear();

// On affiche un sprite
SFMLView.Draw(Sprite);

// On rafraîchit la vue à l'écran
SFMLView.Display();
</code></pre>
<p>
    N'oubliez pas de libérer vos ressources X11 avant de quitter l'application :
</p>
<pre><code class="cpp">// On ferme la connection avec le serveur X
XCloseDisplay(Disp);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Intégrer la SFML à une interface X11 n'est pas très compliqué, et si vous avec l'habitude de la programmation
    avec Xlib cela ne vous demandera pas plus d'efforts que n'importe quelle autre application SFML.<br/>
    Voyons maintenant comment réaliser l'intégration dans des
    <a class="internal" href="./graphics-wxwidgets-fr.php" title="Aller au tutoriel suivant">interfaces wxWidgets</a>.
</p>

<?php

    require("footer-fr.php");

?>
