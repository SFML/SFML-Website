<?php

    $title = "Intégrer à une interface Win32";
    $page = "graphics-win32-fr.php";

    require("header-fr.php");
?>

<h1>Intégrer à une interface Win32</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce nouveau tutoriel, nous allons regarder comment la SFML s'intègre à des interfaces Win32.
    Si vous n'êtes pas familiers avec les interfaces Win32 vous pouvez consulter un tutoriel sur le sujet,
    ici nous n'expliquerons pas la programmation Win32 mais seulement la manière d'intégrer la SFML à
    des contrôles Win32.
</p>

<?php h2('Création de la fenêtre Win32') ?>
<p>
    Tout d'abord, nous devons construire une interface Win32. Nous allons créer une fenêtre principale, ainsi
    que deux vues dans lesquelles nous allons afficher des graphiques avec SFML. Le morceau de code qui suit
    est du code Win32 habituel, aucun code spécifique SFML n'est encore mis en jeu :
</p>
<pre><code class="cpp">// Définition d'une classe de fenêtre pour notre fenêtre principale
WNDCLASS WindowClass;
WindowClass.style         = 0;
WindowClass.lpfnWndProc   = &amp;OnEvent;
WindowClass.cbClsExtra    = 0;
WindowClass.cbWndExtra    = 0;
WindowClass.hInstance     = Instance;
WindowClass.hIcon         = NULL;
WindowClass.hCursor       = 0;
WindowClass.hbrBackground = reinterpret_cast&lt;HBRUSH&gt;(COLOR_BACKGROUND);
WindowClass.lpszMenuName  = NULL;
WindowClass.lpszClassName = "SFML App";
RegisterClass(&amp;WindowClass);

// Création de la fenêtre principale
HWND Window = CreateWindow("SFML App", "SFML Win32", WS_SYSMENU | WS_VISIBLE, 0, 0, 800, 600, NULL, NULL, Instance, NULL);

// Création des deux vues SFML
DWORD Style = WS_CHILD | WS_VISIBLE | WS_CLIPSIBLINGS;
HWND  View1 = CreateWindow("STATIC", NULL, Style, 50,  100, 300, 400, Window, NULL, Instance, NULL);
HWND  View2 = CreateWindow("STATIC", NULL, Style, 400, 100, 300, 400, Window, NULL, Instance, NULL);
</code></pre>
<p>
    Nous gardons la fonction de gestion des évènements dans sa forme la plus simple :
</p>
<pre><code class="cpp">LRESULT CALLBACK OnEvent(HWND Handle, UINT Message, WPARAM WParam, LPARAM LParam)
{
    switch (Message)
    {
        // Quitter lorsque la fenêtre principale est fermée
        case WM_CLOSE :
        {
            PostQuitMessage(0);
            return 0;
        }
    }

    return DefWindowProc(Handle, Message, WParam, LParam);
}
</code></pre>

<?php h2('Définir des vues SFML') ?>
<p>
    Une fois que tous les composants de l'interface ont été créés, nous pouvons définir nos vues SFML.
    Pour se faire, il nous suffit de construire nos instances de <?php class_link("RenderWindow")?>
    à partir des descripteurs (<em>handles</em>) des contrôles :
</p>
<pre><code class="cpp">sf::RenderWindow SFMLView1(View1);
sf::RenderWindow SFMLView2(View2);

// Ou, si vous voulez le faire après la construction :

SFMLView1.Create(View1);
SFMLView2.Create(View2);
</code></pre>
<p>
    Et voilà, vous avez deux fenêtres de rendu SFML qui vont afficher de la 2D dans les contrôles de
    l'interface spécifiés.
</p>

<?php h2('La boucle principale') ?>
<p>
    La boucle principale est une boucle classique Win32 :
</p>
<pre><code class="cpp">MSG Message;
Message.message = ~WM_QUIT;
while (Message.message != WM_QUIT)
{
    if (PeekMessage(&amp;Message, NULL, 0, 0, PM_REMOVE))
    {
        // Si un message était en attente dans la file des messages, on le traite
        TranslateMessage(&amp;Message);
        DispatchMessage(&amp;Message);
    }
    else
    {
        // Placer le code de rendu SFML ici
    }
}
</code></pre>
<p>
    Puis nous pouvons insérer notre code SFML :
</p>
<pre><code class="cpp">// On efface les vues
SFMLView1.Clear();
SFMLView2.Clear();

// Affichage du sprite 1 sur la vue 1
SFMLView1.Draw(Sprite1);

// Affichage du sprite 2 sur la vue 2
SFMLView2.Draw(Sprite2);

// Affichage de chaque vue à l'écran
SFMLView1.Display();
SFMLView2.Display();
</code></pre>
<p>
    N'oubliez pas de libérer les ressources Win32 avant de quitter l'application :
</p>
<pre><code class="cpp">// Destruction de la fenêtre principale
DestroyWindow(Window);

// N'oubliez pas de désenregistrer la classe de fenêtre
UnregisterClass("SFML App", Instance);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Intégrer la SFML à une interface Win32 n'est pas compliqué, et si vous êtes habitués à la programmation
    Win32 cela ne vous demandera pas plus d'effort que n'importe quelle application SFML.<br/>
    Voyons maintenant si la SFML est aussi bonne pour s'intégrer à une
    <a class="internal" href="./graphics-x11-fr.php" title="Aller au tutoriel suivant">interface X11 (Unix)</a>.
</p>

<?php

    require("footer-fr.php");

?>
