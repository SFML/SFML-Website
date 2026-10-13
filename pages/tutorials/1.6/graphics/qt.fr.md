# Intégrer à une interface Qt

!!! warning ""

    Vous lisez un tutoriel pour SFML 1.6, qui n'existe plus dans la dernière version. Consultez les [derniers tutoriels](/fr/tutorials/latest/).

## Introduction

Dans ce tutoriel, nous allons voir comment intégrer une vue SFML à une interface Qt. La façon habituelle d'ajouter une nouvelle fonctionnalité à une interface Qt est d'écrire un widget (composant) personnalisé ; c'est ce que nous allons faire ici.

## Création du composant SFML personnalisé

Afin de créer notre widget SFML perso, nous devons dériver de la classe de base `QWidget`. Et comme nous voulons que notre widget soit également une fenêtre de rendu SFML, nous héritons également de [`sf::RenderWindow`](../../../documentation/1.6/classsf_1_1RenderWindow.html "sf::RenderWindow documentation").

```cpp
#include <SFML/Graphics.hpp>
#include <Qt/qwidget.h>

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
    ...
};
```

Puis, de quoi cette classe aura besoin pour fonctionner ? Premièrement, d'un constructeur standard définissant les proriétés usuelles des widgets : parent, position, taille. Nous ajoutons à cela un dernier paramètre, qui est la durée d'une frame (l'inverse du taux de rafraîchissement) ; comme Qt ne fournit pas d'évènement *idle* (qui serait généré à chaque fois que la file d'évènements est vide), nous devons gérer manuellement le rafraîchissement du widget. Le meilleur moyen de le faire est de démarrer un timer, et le connecter à une fonction qui va rafraîchir le widget à la fréquence spécifiée. La valeur par défaut de 0 fait en sorte que le timer génère un rafraîchissement dès qu'il n'y a aucun autre évènement à traiter, ce qui est exactement ce qu'un évènement *idle* ferait.

Ensuite, nous devons surdéfinir l'évènement *show* : ce sera un bon endroit pour initialiser notre fenêtre SFML. Nous ne pouvons pas le faire dans le constructeur, car à ce moment le widget n'a pas encore sa position et sa taille définitives.  
Nous surdéfinissons également l'évènement *paint*, afin d'y rafraîchir notre vue SFML.

Nous allons aussi définir deux fonctions à l'attention des classes dérivées : `OnInit()`, qui sera appelée dès que la vue SFML sera initialisée, et `OnUpdate()`, qui sera appelée avant chaque rafraîchissement afin de laisser la classe dérivée dessiner des choses dans le widget.

```cpp
#include <SFML/Graphics.hpp>
#include <Qt/qwidget.h>
#include <Qt/qtimer.h>

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
public :

    QSFMLCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size, unsigned int FrameTime = 0);

    virtual ~QSFMLCanvas();

private :

    virtual void OnInit();

    virtual void OnUpdate();

    virtual QPaintEngine* paintEngine() const;

    virtual void showEvent(QShowEvent*);

    virtual void paintEvent(QPaintEvent*);

    QTimer myTimer;
    bool   myInitialized;
};
```

Jetons maintenant un oeil à l'implémentation.

```cpp
QSFMLCanvas::QSFMLCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size, unsigned int FrameTime) :
QWidget       (Parent),
myInitialized (false)
{
    // Mise en place de quelques options pour autoriser le rendu direct dans le widget
    setAttribute(Qt::WA_PaintOnScreen);
    setAttribute(Qt::WA_OpaquePaintEvent);
    setAttribute(Qt::WA_NoSystemBackground);

    // Changement de la police de focus, pour autoriser notre widget à capter les évènements clavier
    setFocusPolicy(Qt::StrongFocus);

    // Définition de la position et de la taille du widget
    move(Position);
    resize(Size);

    // Préparation du timer
    myTimer.setInterval(FrameTime);
}
```

Pour commencer, le constructeur initialise deux options pour autoriser l'affichage direct dans le widget. `WA_PaintOnScreen` informe Qt que nous n'utiliserons pas ses fonctions de dessin, et que nous dessinerons directement dans le widget. `WA_NoSystemBackground` empêche l'affichage du fond du widget, qui causerait un scintillement désagréable et inutile.  
On change également la police de focus à `Qt::StrongFocus`, afin d'autoriser notre widget à recevoir les évènements clavier.  
Puis, on initialise la position et la taille du widget, et on paramètre l'intervalle du timer pour coller à la fréquence de rafraîchissement désirée.

```cpp
#ifdef Q_WS_X11
    #include <Qt/qx11info_x11.h>
    #include <X11/Xlib.h>
#endif

void QSFMLCanvas::showEvent(QShowEvent*)
{
    if (!myInitialized)
    {
        // Sous X11, il faut valider les commandes qui ont été envoyées au serveur
        // afin de s'assurer que SFML aura une vision à jour de la fenêtre
        #ifdef Q_WS_X11
            XFlush(QX11Info::display());
        #endif

        // On crée la fenêtre SFML avec l'identificateur du widget
        Create(winId());

        // On laisse la classe dérivée s'initialiser si besoin
        OnInit();

        // On paramètre le timer de sorte qu'il génère un rafraîchissement à la fréquence souhaitée
        connect(&myTimer, SIGNAL(timeout()), this, SLOT(repaint()));
        myTimer.start();

        myInitialized = true;
    }
}
```

Dans la fonction `showEvent`, qui est appelée lorsque le widget est affiché, nous créons la fenêtre SFML. Ceci se fait très simplement en appelant la fonction `Create` avec l'identificateur interne de la fenêtre, qui est donné par la fonction `winId`. Sous X11 (Unix), nous devons placer un appel système pour vider la file de messages qui seraient encore en attente, afin de s'assurer que la SFML va bien voir notre fenêtre.  
Une fois la fenêtre SFML initialisée, nous pouvons informer la classe dérivée en appelant la fonction virtuelle `OnInit`.  
Enfin, on connecte le timer à la fonction `repaint`, qui va rafraîchir le widget et générer un évènement *paint*. Et bien entendu, on le démarre.

```cpp
QPaintEngine* QSFMLCanvas::paintEngine() const
{
    return 0;
}
```

Nous faisons en sorte que la fonction `paintEngine` renvoie un moteur de rendu nul. Cette fonction va de paire avec l'option `WA_PaintOnScreen`, pour dire à Qt que nous n'utilisons aucun de ses moteurs de rendu.

```cpp
void QSFMLCanvas::paintEvent(QPaintEvent*)
{
    // On laisse la classe dérivée faire sa tambouille
    OnUpdate();

    // On rafraîchit le widget
    Display();
}
```

La fonction `paintEvent` est assez simple : on notifie la classe dérivée qu'un rafraîchissement est sur le point d'être effectué, et on appelle `Display` pour mettre à jour notre widget avec la frame rendue.

## Utilisation de notre widget Qt-SFML

Le `QSFMLCanvas` que nous venons d'écrire n'est pas utilisable directement, il doit être dérivé. Créons donc un widget dérivé qui va dessiner quelque chose de sympa :

```cpp
class MyCanvas : public QSFMLCanvas
{
public :

    MyCanvas(QWidget* Parent, const QPoint& Position, const QSize& Size) :
    QSFMLCanvas(Parent, Position, Size)
    {

    }

private :

    void OnInit()
    {
        // On charge une image
        myImage.LoadFromFile("datas/qt/sfml.png");

        // On paramètre le sprite
        mySprite.SetImage(myImage);
        mySprite.SetCenter(mySprite.GetSize() / 2.f);
    }

    void OnUpdate()
    {
        // On efface l'écran
        Clear(sf::Color(0, 128, 0));

        // Une petite rotation du sprite
        mySprite.Rotate(GetFrameTime() * 100.f);

        // Et on l'affiche
        Draw(mySprite);
    }

    sf::Image  myImage;
    sf::Sprite mySprite;
};
```

Rien de très compliqué ici : on surdéfinit `OnInit` pour charger et initialiser nos ressources graphiques, et `OnUpdate` pour les afficher.

Nous pouvons maintenant créer une fenêtre Qt classique, et y placer une instance de notre widget perso :

```cpp
int main(int argc, char **argv)
{
    QApplication App(argc, argv);

    // On crée la fenêtre principale
    QFrame* MainFrame = new QFrame;
    MainFrame->setWindowTitle("Qt SFML");
    MainFrame->resize(400, 400);
    MainFrame->show();

    //On crée une vue SFML dans la fenêtre principale
    MyCanvas* SFMLView = new MyCanvas(MainFrame, QPoint(20, 20), QSize(360, 360));
    SFMLView->show();

    return App.exec();
}
```

## Conclusion

L'intégration de la SFML dans une interface Qt est simplifiée avec le widget personnalisé que nous venons d'écrire, n'hésitez pas à l'utiliser et à l'améliorer.  
Si vous voulez voir comment la SFML s'intègre à une [interface wxWidgets](wxwidgets.md "Aller au tutoriel suivant"), vous pouvez vous rendre au prochain tutoriel.
