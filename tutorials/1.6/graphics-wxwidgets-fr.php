<?php

    $title = "Int�grer � une interface wxWidgets";
    $page = "graphics-wxwidgets-fr.php";

    require("header-fr.php");
?>

<h1>Int�grer � une interface wxWidgets</h1>

<?php h2('Introduction') ?>
<p>
    La meilleure fa�on d'int�grer des graphismes SFML � une interface wxWidgets est de cr�er un type
    de contr�le sp�cialis�. Dans ce tutoriel, nous allons d�finir une classe <code>wxSFMLCanvas</code>
    qui servira de classe de base pour cr�er vos contr�les de rendu personnalis�s.
</p>

<?php h2('Cr�ation d\'un contr�le personnalis�') ?>
<p>
    De quoi avons-nous besoin pour d�finir un contr�le wx/SFML ? Afin de cr�er un contr�le wxWidgets personnalis�,
    nous devons d�river de la classe de base <code>wxControl</code>. Et, pour permettre � notre contr�le d'�tre une vue
    SFML, nous d�rivons �galement de <?php class_link("RenderWindow")?>.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;wx/wx.h&gt;

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
    // ...
};
</code></pre>
<p>
    Qu'allons-nous mettre dans cette classe ? Et bien, pas grand chose au niveau de l'interface publique, �tant donn�
    que toutes les fonctions utiles seront fournies par <code>wxControl</code> et <?php class_link("RenderWindow")?>.
    En fait, du point de vue de wxWidgets <code>wxSFMLCanvas</code> sera comme n'importe quel contr�le, et du point
    de vue de la SFML il sera consid�r� comme n'importe quelle autre fen�tre de rendu. C'est �a la puissance de
    l'h�ritage.
</p>
<p>
    Donc, dans l'interface publique nous avons simplement besoin d'un constructeur standard, qui prendra les param�tres
    habituels qui d�finissent un contr�le wxWidgets (parent, identificateur, position, taille, style), et un
    destructeur qui sera vide mais qui doit �tre virtuel, car <code>wxSFMLCanvas</code> sera utilis�e en tant que
    classe de base.
</p>
<p>
    Ensuite, dans la partie priv�e de la classe, nous avons besoin de d�finir quelques fonctions qui seront
    rattach�es � des �v�nements utiles. Nous devons intercepter l'�v�nement <em>idle</em>, qui est l'�v�nement
    qui est g�n�r� lorsqu'il n'y a aucun autre �v�nement � traiter, l'�v�nement <em>paint</em>, et l'�v�nement
    <em>erase-background</em>. L'�v�nement <em>idle</em> va se r�v�ler utile pour mettre � jour notre contr�le aussi
    souvent que possible. L'�v�nement <em>paint</em> sera appel� � chaque fois que le contr�le n�cessitera un
    rafra�chissement, donc nous pourrons y placer notre code de rendu SFML. Enfin, nous laisserons l'�v�nement
    <em>erase-background</em> vide, nous ne le d�finissons que pour emp�cher wxWidgets de dessiner le fond
    du contr�le avant chaque rafra�chissement, ce qui causerait des artefacts visuels ind�sirables.
</p>
<p>
    Nous d�finissons �galement une fonction virtuelle, afin de de donner la main � la classe d�riv�e juste avant de
    rafra�chir la vue.
</p>
<p>
    Assemblons tout ceci et regardons � quoi va ressembler notre classe :
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;wx/wx.h&gt;

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
public :

    wxSFMLCanvas(wxWindow* Parent = NULL, wxWindowID Id = -1, const wxPoint&amp; Position = wxDefaultPosition,
                 const wxSize&amp; Size = wxDefaultSize, long Style = 0);

    virtual ~wxSFMLCanvas();

private :

    DECLARE_EVENT_TABLE()

    virtual void OnUpdate();

    void OnIdle(wxIdleEvent&amp;);

    void OnPaint(wxPaintEvent&amp;);

    void OnEraseBackground(wxEraseEvent&amp;);
};
</code></pre>

<p>
    Presque toutes les fonctions seront vides, seules trois d'entre elles n�cessiteront quelques explications :
    <code>OnIdle</code>, <code>OnPaint</code> et le constructeur. Ce dernier contiendra toute la
    partie sp�cifique-�-la-plateforme-et-difficile-�-capter, nous le laissons donc pour la fin.
</p>
<p>
    Commen�ons par regarder la fonction <code>OnIdle</code>, correspondant donc � l'�v�nement <em>idle</em> :
</p>
<pre><code class="cpp">void wxSFMLCanvas::OnIdle(wxIdleEvent&amp;)
{
    // On g�n�re un rafra�chissement du contr�le, afin d'assurer un framerate maximum
    Refresh();
}
</code></pre>
<p>
    C'�tait plut�t facile non ? La fonction <code>Refresh</code> est d�finie dans <code>wxControl</code>, et
    g�n�re (entre autres) un �v�nement <em>paint</em> pour rafra�chir le contr�le. En l'appelant dans l'�v�nement
    <em>idle</em>, on s'assure d'avoir un taux de rafra�chissement maximum pour notre vue SFML.
</p>
<p>
    L'�v�nement <em>paint</em> n'est gu�re plus compliqu� :
</p>
<pre><code class="cpp">void wxSFMLCanvas::OnPaint(wxPaintEvent&amp;)
{
    // On pr�pare le contr�le � �tre dessin�
    wxPaintDC Dc(this);

    // On laisse la classe d�riv�e se mettre � jour et dessiner dans le contr�le
    OnUpdate();

    // On affiche tout �a � l'�cran
    Display();
}
</code></pre>
<p>
    La premi�re chose � faire dans la fonction de dessin est de cr�er un objet <code>wxPaintDC</code>, et lui passer
    un pointeur vers notre contr�le. Cela va "verrouiller" la zone graphique associ�e au contr�le, et assurer que
    nous pourrons dessiner dedans. L'oubli de cette instruction pourrait produire des r�sultats bizarres.
</p>
<p>
    Regardons maintenant comment lier notre contr�le wxWidgets a une fen�tre de rendu SFML. Cette partie d�pend fortement
    de l'impl�mentation sous-jacente de wxWidgets, donc ne vous focalisez pas trop dessus.
</p>
<pre><code class="cpp">#ifdef __WXGTK__
    #include &lt;gdk/gdkx.h&gt;
    #include &lt;gtk/gtk.h&gt;
    #include &lt;wx/gtk/win_gtk.h&gt;
#endif

wxSFMLCanvas::wxSFMLCanvas(wxWindow* Parent, wxWindowID Id, const wxPoint&amp; Position, const wxSize&amp; Size, long Style) :
wxControl(Parent, Id, Position, Size, Style)
{
    #ifdef __WXGTK__

        // La version GTK requiert d'aller plus profond�ment pour trouver
        // l'identificateur X11 du contr�le
        gtk_widget_realize(m_wxwindow);
        gtk_widget_set_double_buffered(m_wxwindow, false);
        GdkWindow* Win = GTK_PIZZA(m_wxwindow)->bin_window;
        XFlush(GDK_WINDOW_XDISPLAY(Win));
        sf::RenderWindow::Create(GDK_WINDOW_XWINDOW(Win));

    #else

        // Test� sous Windows XP seulement (devrait fonctionner sous X11 et
        // les autres versions de Windows - aucune id�e concernant MacOS)
        sf::RenderWindow::Create(GetHandle());

    #endif
}
</code></pre>
<p>
    Comme vous pouvez le voir, l'impl�mentation qui requiert le plus d'attention est celle utilisant GTK. Comme GTK
    n'est pas une biblioth�que bas niveau, nous devons creuser plus profond pour obtenir l'identificateur interne de
    la fen�tre. Nous devons �galement "r�aliser" le widget (afin de s'assurer qu'il est effectivement cr��), et
    d�sactiver le double-tampon fourni par GTK, �tant donn� que nous avons d�j� le n�tre.<br/>
    Et... oui, GTK_PIZZA est un nom tr�s bizarre, je n'ai toujours pas saisi sa signification.
</p>
<p>
    Pour les autres impl�mentations (WXMSW, WXX11), donner directement l'identificateur renvoy� par <code>GetHandle</code>
    sera suffisant.
</p>

<?php h2('Cr�ation d\'une interface wxWidgets et utilisation de notre contr�le') ?>
<p>
    Maintenant que nous avons un composant SFML / wxWidgets g�n�rique, cr�ons-en une sp�cialisation qui va faire
    quelque chose d'"utile". Ici nous allons d�finir un contr�le qui affiche un sprite.
</p>
<pre><code class="cpp">class MyCanvas : public wxSFMLCanvas
{
public :

    MyCanvas(wxWindow*  Parent,
             wxWindowID Id,
             wxPoint&amp;   Position,
             wxSize&amp;    Size,
             long       Style = 0) :
    wxSFMLCanvas(Parent, Id, Position, Size, Style)
    {
        // On charge une image et on l'affecte � notre sprite
        myImage.LoadFromFile("sprite.png");
        mySprite.SetImage(myImage);
    }

private :

    virtual void OnUpdate()
    {
        // On efface la vue
        Clear(sf::Color(0, 128, 128));

        // On affiche le sprite dans notre vue SFML
        Draw(mySprite);
    }

    sf::Image  myImage;
    sf::Sprite mySprite;
};
</code></pre>
<p>
    Puis nous cr�ons la fen�tre principale de l'application, dans laquelle nous allons ins�rer une vue SFML avec notre
    composant sp�cialis� :
</p>
<pre><code class="cpp">class MyFrame : public wxFrame
{
public :

    MyFrame() :
    wxFrame(NULL, wxID_ANY, "SFML wxWidgets", wxDefaultPosition, wxSize(800, 600))
    {
        new MyCanvas(this, wxID_ANY, wxPoint(50, 50), wxSize(700, 500));
    }
};
</code></pre>
<p>
    Et enfin, la classe de l'application :
</p>
<pre><code class="cpp">class MyApplication : public wxApp
{
private :

    virtual bool OnInit()
    {
        // On cr�e la fen�tre principale
        MyFrame* MainFrame = new MyFrame;
        MainFrame->Show();

        return true;
    }
};

IMPLEMENT_APP(MyApplication);
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Avec ce composant, vous pouvez int�grer la SFML � vos interfaces wxWidgets tr�s facilement. N'h�sitez
    pas � l'utiliser !<br/>
    Ceci �tait le dernier tutoriel concernant le module graphique. Vous pouvez d�sormais aller cr�er vos
    propres applications graphiques, ou bien vous pouvez sauter vers une
    <a class="internal" href="./index-fr.php" title="Retour au sommaire des tutoriels">autre section</a>
    et apprendre un nouveau module.
</p>

<?php

    require("footer-fr.php");

?>
