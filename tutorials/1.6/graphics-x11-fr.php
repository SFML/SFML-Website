<?php

    $title = "Int�grer � une interface X11";
    $page = "graphics-x11-fr.php";

    require("header-fr.php");
?>

<h1>Int�grer � une interface X11</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce nouveau tutoriel, nous nous int�resserons � l'int�gration de la SFML � une interface X11. Si vous
    n'�tes pas familiers avec la programmation avec Xlib vous pouvez commencer par lire un tutoriel sur le sujet, car nous
    ne d�taillerons dans ce tutoriel que la mani�re dont SFML s'int�gre � une fen�tre X11.
</p>

<?php h2('Cr�ation de la fen�tre X11') ?>
<p>
    Premi�rement, nous devons cr�er une interface X11. Nous cr�erons une fen�tre principale, et une sous-fen�tre dans laquelle
    nous allons afficher un rendu SFML. Le bout de code suivant est du code X11 classique, aucune fonction SFML
    n'entre encore en jeu :
</p>
<pre><code class="cpp">// On ouvre une connection avec le serveur X
Display* Disp = XOpenDisplay(NULL);
if (!Disp)
    return EXIT_FAILURE;

// On r�cup�re le num�ro de l'�cran par d�faut
int Screen = DefaultScreen(Disp);

// On cr�e la fen�tre principale
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

// On cr�e la sous-fen�tre qui servira � h�berger notre vue SFML
Window View = XCreateWindow(Disp, Win,
                             10, 10, 310, 310, 0,
                             DefaultDepth(Disp, Screen),
                             InputOutput,
                             DefaultVisual(Disp, Screen),
                             0, NULL);

// Et enfin on affiche nos fen�tres fra�chement cr��es
XMapWindow(Disp, Win);
XMapWindow(Disp, View);
XFlush(Disp);
</code></pre>

<?php h2('D�finition d\'une vue SFML') ?>
<p>
    Une fois que tous les composants de l'interface ont �t� cr��s, nous pouvons d�finir notre vue SFML. Pour ce faire,
    nous avons juste � construire une instance de <?php class_link("RenderWindows")?> et � lui passer l'identificateur de
    la fen�tre X11 :
</p>
<pre><code class="cpp">sf::RenderWindow SFMLView(View);

// Ou, si vous souhaitez le faire apr�s la construction :

SFMLView.Create(View);
</code></pre>
<p>
    Et voil�, vous avez une fen�tre de rendu SFML int�gr�e � votre interface X11.
</p>

<?php h2('La boucle principale') ?>
<p>
    La boucle d'�v�nements est une boucle X11 classique :
</p>
<pre><code class="cpp">bool IsRunning = true;
while (IsRunning)
{
    while (XPending(Disp))
    {
        // On traite le prochain �v�nement en attente
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
    Puis nous pouvons ins�rer notre code SFML :
</p>
<pre><code class="cpp">// On efface la vue
SFMLView.Clear();

// On affiche un sprite
SFMLView.Draw(Sprite);

// On rafra�chit la vue � l'�cran
SFMLView.Display();
</code></pre>
<p>
    N'oubliez pas de lib�rer vos ressources X11 avant de quitter l'application :
</p>
<pre><code class="cpp">// On ferme la connection avec le serveur X
XCloseDisplay(Disp);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Int�grer la SFML � une interface X11 n'est pas tr�s compliqu�, et si vous avec l'habitude de la programmation
    avec Xlib cela ne vous demandera pas plus d'efforts que n'importe quelle autre application SFML.<br/>
    Voyons maintenant comment r�aliser l'int�gration dans des
    <a class="internal" href="./graphics-wxwidgets-fr.php" title="Aller au tutoriel suivant">interfaces wxWidgets</a>.
</p>

<?php

    require("footer-fr.php");

?>
