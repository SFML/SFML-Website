# Intégrer à une interface wxWidgets

!!! warning ""

    Vous lisez un tutoriel pour SFML 1.6, qui n'existe plus dans la dernière version. Consultez les [derniers tutoriels](/fr/tutorials/latest/).

## Introduction

La meilleure façon d'intégrer des graphismes SFML à une interface wxWidgets est de créer un type de contrôle spécialisé. Dans ce tutoriel, nous allons définir une classe `wxSFMLCanvas` qui servira de classe de base pour créer vos contrôles de rendu personnalisés.

## Création d'un contrôle personnalisé

De quoi avons-nous besoin pour définir un contrôle wx/SFML ? Afin de créer un contrôle wxWidgets personnalisé, nous devons dériver de la classe de base `wxControl`. Et, pour permettre à notre contrôle d'être une vue SFML, nous dérivons également de [`sf::RenderWindow`](../../../documentation/1.6/classsf_1_1RenderWindow.html "sf::RenderWindow documentation").

```cpp
#include <SFML/Graphics.hpp>
#include <wx/wx.h>

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
    // ...
};
```

Qu'allons-nous mettre dans cette classe ? Et bien, pas grand chose au niveau de l'interface publique, étant donné que toutes les fonctions utiles seront fournies par `wxControl` et [`sf::RenderWindow`](../../../documentation/1.6/classsf_1_1RenderWindow.html "sf::RenderWindow documentation"). En fait, du point de vue de wxWidgets `wxSFMLCanvas` sera comme n'importe quel contrôle, et du point de vue de la SFML il sera considéré comme n'importe quelle autre fenêtre de rendu. C'est ça la puissance de l'héritage.

Donc, dans l'interface publique nous avons simplement besoin d'un constructeur standard, qui prendra les paramètres habituels qui définissent un contrôle wxWidgets (parent, identificateur, position, taille, style), et un destructeur qui sera vide mais qui doit être virtuel, car `wxSFMLCanvas` sera utilisée en tant que classe de base.

Ensuite, dans la partie privée de la classe, nous avons besoin de définir quelques fonctions qui seront rattachées à des évènements utiles. Nous devons intercepter l'évènement *idle*, qui est l'évènement qui est généré lorsqu'il n'y a aucun autre évènement à traiter, l'évènement *paint*, et l'évènement *erase-background*. L'évènement *idle* va se révéler utile pour mettre à jour notre contrôle aussi souvent que possible. L'évènement *paint* sera appelé à chaque fois que le contrôle nécessitera un rafraîchissement, donc nous pourrons y placer notre code de rendu SFML. Enfin, nous laisserons l'évènement *erase-background* vide, nous ne le définissons que pour empêcher wxWidgets de dessiner le fond du contrôle avant chaque rafraîchissement, ce qui causerait des artefacts visuels indésirables.

Nous définissons également une fonction virtuelle, afin de de donner la main à la classe dérivée juste avant de rafraîchir la vue.

Assemblons tout ceci et regardons à quoi va ressembler notre classe :

```cpp
#include <SFML/Graphics.hpp>
#include <wx/wx.h>

class wxSFMLCanvas : public wxControl, public sf::RenderWindow
{
public :

    wxSFMLCanvas(wxWindow* Parent = NULL, wxWindowID Id = -1, const wxPoint& Position = wxDefaultPosition,
                 const wxSize& Size = wxDefaultSize, long Style = 0);

    virtual ~wxSFMLCanvas();

private :

    DECLARE_EVENT_TABLE()

    virtual void OnUpdate();

    void OnIdle(wxIdleEvent&);

    void OnPaint(wxPaintEvent&);

    void OnEraseBackground(wxEraseEvent&);
};
```

Presque toutes les fonctions seront vides, seules trois d'entre elles nécessiteront quelques explications : `OnIdle`, `OnPaint` et le constructeur. Ce dernier contiendra toute la partie spécifique-à-la-plateforme-et-difficile-à-capter, nous le laissons donc pour la fin.

Commençons par regarder la fonction `OnIdle`, correspondant donc à l'évènement *idle* :

```cpp
void wxSFMLCanvas::OnIdle(wxIdleEvent&)
{
    // On génère un rafraîchissement du contrôle, afin d'assurer un framerate maximum
    Refresh();
}
```

C'était plutôt facile non ? La fonction `Refresh` est définie dans `wxControl`, et génère (entre autres) un évènement *paint* pour rafraîchir le contrôle. En l'appelant dans l'évènement *idle*, on s'assure d'avoir un taux de rafraîchissement maximum pour notre vue SFML.

L'évènement *paint* n'est guère plus compliqué :

```cpp
void wxSFMLCanvas::OnPaint(wxPaintEvent&)
{
    // On prépare le contrôle à être dessiné
    wxPaintDC Dc(this);

    // On laisse la classe dérivée se mettre à jour et dessiner dans le contrôle
    OnUpdate();

    // On affiche tout ça à l'écran
    Display();
}
```

La première chose à faire dans la fonction de dessin est de créer un objet `wxPaintDC`, et lui passer un pointeur vers notre contrôle. Cela va "verrouiller" la zone graphique associée au contrôle, et assurer que nous pourrons dessiner dedans. L'oubli de cette instruction pourrait produire des résultats bizarres.

Regardons maintenant comment lier notre contrôle wxWidgets a une fenêtre de rendu SFML. Cette partie dépend fortement de l'implémentation sous-jacente de wxWidgets, donc ne vous focalisez pas trop dessus.

```cpp
#ifdef __WXGTK__
    #include <gdk/gdkx.h>
    #include <gtk/gtk.h>
    #include <wx/gtk/win_gtk.h>
#endif

wxSFMLCanvas::wxSFMLCanvas(wxWindow* Parent, wxWindowID Id, const wxPoint& Position, const wxSize& Size, long Style) :
wxControl(Parent, Id, Position, Size, Style)
{
    #ifdef __WXGTK__

        // La version GTK requiert d'aller plus profondément pour trouver
        // l'identificateur X11 du contrôle
        gtk_widget_realize(m_wxwindow);
        gtk_widget_set_double_buffered(m_wxwindow, false);
        GdkWindow* Win = GTK_PIZZA(m_wxwindow)->bin_window;
        XFlush(GDK_WINDOW_XDISPLAY(Win));
        sf::RenderWindow::Create(GDK_WINDOW_XWINDOW(Win));

    #else

        // Testé sous Windows XP seulement (devrait fonctionner sous X11 et
        // les autres versions de Windows - aucune idée concernant MacOS)
        sf::RenderWindow::Create(GetHandle());

    #endif
}
```

Comme vous pouvez le voir, l'implémentation qui requiert le plus d'attention est celle utilisant GTK. Comme GTK n'est pas une bibliothèque bas niveau, nous devons creuser plus profond pour obtenir l'identificateur interne de la fenêtre. Nous devons également "réaliser" le widget (afin de s'assurer qu'il est effectivement créé), et désactiver le double-tampon fourni par GTK, étant donné que nous avons déjà le nôtre.  
Et... oui, GTK_PIZZA est un nom très bizarre, je n'ai toujours pas saisi sa signification.

Pour les autres implémentations (WXMSW, WXX11), donner directement l'identificateur renvoyé par `GetHandle` sera suffisant.

## Création d'une interface wxWidgets et utilisation de notre contrôle

Maintenant que nous avons un composant SFML / wxWidgets générique, créons-en une spécialisation qui va faire quelque chose d'"utile". Ici nous allons définir un contrôle qui affiche un sprite.

```cpp
class MyCanvas : public wxSFMLCanvas
{
public :

    MyCanvas(wxWindow*  Parent,
             wxWindowID Id,
             wxPoint&   Position,
             wxSize&    Size,
             long       Style = 0) :
    wxSFMLCanvas(Parent, Id, Position, Size, Style)
    {
        // On charge une image et on l'affecte à notre sprite
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
```

Puis nous créons la fenêtre principale de l'application, dans laquelle nous allons insérer une vue SFML avec notre composant spécialisé :

```cpp
class MyFrame : public wxFrame
{
public :

    MyFrame() :
    wxFrame(NULL, wxID_ANY, "SFML wxWidgets", wxDefaultPosition, wxSize(800, 600))
    {
        new MyCanvas(this, wxID_ANY, wxPoint(50, 50), wxSize(700, 500));
    }
};
```

Et enfin, la classe de l'application :

```cpp
class MyApplication : public wxApp
{
private :

    virtual bool OnInit()
    {
        // On crée la fenêtre principale
        MyFrame* MainFrame = new MyFrame;
        MainFrame->Show();

        return true;
    }
};

IMPLEMENT_APP(MyApplication);
```

## Conclusion

Avec ce composant, vous pouvez intégrer la SFML à vos interfaces wxWidgets très facilement. N'hésitez pas à l'utiliser !  
Ceci était le dernier tutoriel concernant le module graphique. Vous pouvez désormais aller créer vos propres applications graphiques, ou bien vous pouvez sauter vers une [autre section](../index.md "Retour au sommaire des tutoriels") et apprendre un nouveau module.
