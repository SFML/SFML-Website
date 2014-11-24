<?php

    $title = "Intégrer à une interface Qt";
    $page = "graphics-qt-fr.php";

    require("header-fr.php");
?>

<h1>Intégrer à une interface Qt</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons voir comment intégrer une vue SFML à une interface Qt. La façon habituelle d'ajouter une
    nouvelle fonctionnalité à une interface Qt est d'écrire un widget (composant) personnalisé ; c'est ce que nous allons
    faire ici.
</p>

<?php h2('Création du composant SFML personnalisé') ?>
<p>
    Afin de créer notre widget SFML perso, nous devons dériver de la classe de base <code>QWidget</code>. Et comme nous
    voulons que notre widget soit également une fenêtre de rendu SFML, nous héritons également de
    <?php class_link("RenderWindow")?>.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;Qt/qwidget.h&gt;

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
    ...
};
</code></pre>
<p>
    Puis, de quoi cette classe aura besoin pour fonctionner ? Premièrement, d'un constructeur standard définissant
    les proriétés usuelles des widgets : parent, position, taille. Nous ajoutons à cela un dernier paramètre, qui est
    la durée d'une frame (l'inverse du taux de rafraîchissement) ; comme Qt ne fournit pas d'évènement <em>idle</em>
    (qui serait généré à chaque fois que la file d'évènements est vide), nous devons gérer manuellement le rafraîchissement
    du widget. Le meilleur moyen de le faire est de démarrer un timer, et le connecter à une fonction qui va rafraîchir
    le widget à la fréquence spécifiée. La valeur par défaut de 0 fait en sorte que le timer génère un rafraîchissement
    dès qu'il n'y a aucun autre évènement à traiter, ce qui est exactement ce qu'un évènement <em>idle</em> ferait.
</p>
<p>
    Ensuite, nous devons surdéfinir l'évènement <em>show</em> : ce sera un bon endroit pour initialiser notre fenêtre
    SFML. Nous ne pouvons pas le faire dans le constructeur, car à ce moment le widget n'a pas encore sa position et
    sa taille définitives.<br/>
    Nous surdéfinissons également l'évènement <em>paint</em>, afin d'y rafraîchir notre vue SFML.
</p>
<p>
    Nous allons aussi définir deux fonctions à l'attention des classes dérivées : <code>OnInit()</code>, qui sera
    appelée dès que la vue SFML sera initialisée, et <code>OnUpdate()</code>, qui sera appelée avant chaque rafraîchissement
    afin de laisser la classe dérivée dessiner des choses dans le widget.
</p>
<pre><code class="cpp">#include &lt;SFML/Graphics.hpp&gt;
#include &lt;Qt/qwidget.h&gt;
#include &lt;Qt/qtimer.h&gt;

class QSFMLCanvas : public QWidget, public sf::RenderWindow
{
public :

    QSFMLCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size, unsigned int FrameTime = 0);

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
</code></pre>
<p>
    Jetons maintenant un oeil à l'implémentation.
</p>
<pre><code class="cpp">QSFMLCanvas::QSFMLCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size, unsigned int FrameTime) :
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
</code></pre>
<p>
    Pour commencer, le constructeur initialise deux options pour autoriser l'affichage direct dans le widget.
    <code>WA_PaintOnScreen</code> informe Qt que nous n'utiliserons pas ses fonctions de dessin, et que nous
    dessinerons directement dans le widget. <code>WA_NoSystemBackground</code> empêche l'affichage du fond du widget,
    qui causerait un scintillement désagréable et inutile.<br/>
    On change également la police de focus à <code>Qt::StrongFocus</code>, afin d'autoriser notre widget à recevoir
    les évènements clavier.<br/>
    Puis, on initialise la position et la taille du widget, et on paramètre l'intervalle du timer pour coller à
    la fréquence de rafraîchissement désirée.
</p>
<pre><code class="cpp">#ifdef Q_WS_X11
    #include &lt;Qt/qx11info_x11.h&gt;
    #include &lt;X11/Xlib.h&gt;
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
        connect(&amp;myTimer, SIGNAL(timeout()), this, SLOT(repaint()));
        myTimer.start();

        myInitialized = true;
    }
}
</code></pre>
<p>
    Dans la fonction <code>showEvent</code>, qui est appelée lorsque le widget est affiché, nous créons la fenêtre SFML.
    Ceci se fait très simplement en appelant la fonction <code>Create</code> avec l'identificateur interne de la
    fenêtre, qui est donné par la fonction <code>winId</code>. Sous X11 (Unix), nous devons placer un appel système pour
    vider la file de messages qui seraient encore en attente, afin de s'assurer que la SFML va bien voir
    notre fenêtre.<br/>
    Une fois la fenêtre SFML initialisée, nous pouvons informer la classe dérivée en appelant la fonction virtuelle
    <code>OnInit</code>.<br/>
    Enfin, on connecte le timer à la fonction <code>repaint</code>, qui va rafraîchir le widget et générer un évènement
    <em>paint</em>. Et bien entendu, on le démarre.
</p>
<pre><code class="cpp">QPaintEngine* QSFMLCanvas::paintEngine() const
{
    return 0;
}
</code></pre>
<p>
    Nous faisons en sorte que la fonction <code>paintEngine</code> renvoie un moteur de rendu nul.
    Cette fonction va de paire avec l'option <code>WA_PaintOnScreen</code>, pour dire à Qt que nous n'utilisons aucun
    de ses moteurs de rendu.
</p>
<pre><code class="cpp">void QSFMLCanvas::paintEvent(QPaintEvent*)
{
    // On laisse la classe dérivée faire sa tambouille
    OnUpdate();

    // On rafraîchit le widget
    Display();
}
</code></pre>
<p>
    La fonction <code>paintEvent</code> est assez simple : on notifie la classe dérivée qu'un rafraîchissement est
    sur le point d'être effectué, et on appelle <code>Display</code> pour mettre à jour notre widget avec la frame
    rendue.
</p>

<?php h2('Utilisation de notre widget Qt-SFML') ?>
<p>
    Le <code>QSFMLCanvas</code> que nous venons d'écrire n'est pas utilisable directement, il doit être dérivé.
    Créons donc un widget dérivé qui va dessiner quelque chose de sympa :
</p>
<pre><code class="cpp">class MyCanvas : public QSFMLCanvas
{
public :

    MyCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size) :
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
</code></pre>
<p>
    Rien de très compliqué ici : on surdéfinit <code>OnInit</code> pour charger et initialiser nos ressources
    graphiques, et <code>OnUpdate</code> pour les afficher.
</p>
<p>
    Nous pouvons maintenant créer une fenêtre Qt classique, et y placer une instance de notre widget perso :
</p>
<pre><code class="cpp">int main(int argc, char **argv)
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
</code></pre>

<?php h2('Conclusion') ?>
<p>
    L'intégration de la SFML dans une interface Qt est simplifiée avec le widget personnalisé que nous venons d'écrire,
    n'hésitez pas à l'utiliser et à l'améliorer.<br/>
    Si vous voulez voir comment la SFML s'intègre à une
    <a class="internal" href="./graphics-wxwidgets-fr.php" title="Aller au tutoriel suivant">interface wxWidgets</a>,
    vous pouvez vous rendre au prochain tutoriel.
</p>

<?php

    require("footer-fr.php");

?>
