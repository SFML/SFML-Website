<?php

    $title = "Int�grer � une interface Qt";
    $page = "graphics-qt-fr.php";

    require("header-fr.php");
?>

<h1>Int�grer � une interface Qt</h1>

<?php h2('Introduction') ?>
<p>
    Dans ce tutoriel, nous allons voir comment int�grer une vue SFML � une interface Qt. La fa�on habituelle d'ajouter une
    nouvelle fonctionnalit� � une interface Qt est d'�crire un widget (composant) personnalis� ; c'est ce que nous allons
    faire ici.
</p>

<?php h2('Cr�ation du composant SFML personnalis�') ?>
<p>
    Afin de cr�er notre widget SFML perso, nous devons d�river de la classe de base <code>QWidget</code>. Et comme nous
    voulons que notre widget soit �galement une fen�tre de rendu SFML, nous h�ritons �galement de
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
    Puis, de quoi cette classe aura besoin pour fonctionner ? Premi�rement, d'un constructeur standard d�finissant
    les prori�t�s usuelles des widgets : parent, position, taille. Nous ajoutons � cela un dernier param�tre, qui est
    la dur�e d'une frame (l'inverse du taux de rafra�chissement) ; comme Qt ne fournit pas d'�v�nement <em>idle</em>
    (qui serait g�n�r� � chaque fois que la file d'�v�nements est vide), nous devons g�rer manuellement le rafra�chissement
    du widget. Le meilleur moyen de le faire est de d�marrer un timer, et le connecter � une fonction qui va rafra�chir
    le widget � la fr�quence sp�cifi�e. La valeur par d�faut de 0 fait en sorte que le timer g�n�re un rafra�chissement
    d�s qu'il n'y a aucun autre �v�nement � traiter, ce qui est exactement ce qu'un �v�nement <em>idle</em> ferait.
</p>
<p>
    Ensuite, nous devons surd�finir l'�v�nement <em>show</em> : ce sera un bon endroit pour initialiser notre fen�tre
    SFML. Nous ne pouvons pas le faire dans le constructeur, car � ce moment le widget n'a pas encore sa position et
    sa taille d�finitives.<br/>
    Nous surd�finissons �galement l'�v�nement <em>paint</em>, afin d'y rafra�chir notre vue SFML.
</p>
<p>
    Nous allons aussi d�finir deux fonctions � l'attention des classes d�riv�es : <code>OnInit()</code>, qui sera
    appel�e d�s que la vue SFML sera initialis�e, et <code>OnUpdate()</code>, qui sera appel�e avant chaque rafra�chissement
    afin de laisser la classe d�riv�e dessiner des choses dans le widget.
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
    Jetons maintenant un oeil � l'impl�mentation.
</p>
<pre><code class="cpp">QSFMLCanvas::QSFMLCanvas(QWidget* Parent, const QPoint&amp; Position, const QSize&amp; Size, unsigned int FrameTime) :
QWidget       (Parent),
myInitialized (false)
{
    // Mise en place de quelques options pour autoriser le rendu direct dans le widget
    setAttribute(Qt::WA_PaintOnScreen);
    setAttribute(Qt::WA_OpaquePaintEvent);
    setAttribute(Qt::WA_NoSystemBackground);

    // Changement de la police de focus, pour autoriser notre widget � capter les �v�nements clavier
    setFocusPolicy(Qt::StrongFocus);

    // D�finition de la position et de la taille du widget
    move(Position);
    resize(Size);

    // Pr�paration du timer
    myTimer.setInterval(FrameTime);
}
</code></pre>
<p>
    Pour commencer, le constructeur initialise deux options pour autoriser l'affichage direct dans le widget.
    <code>WA_PaintOnScreen</code> informe Qt que nous n'utiliserons pas ses fonctions de dessin, et que nous
    dessinerons directement dans le widget. <code>WA_NoSystemBackground</code> emp�che l'affichage du fond du widget,
    qui causerait un scintillement d�sagr�able et inutile.<br/>
    On change �galement la police de focus � <code>Qt::StrongFocus</code>, afin d'autoriser notre widget � recevoir
    les �v�nements clavier.<br/>
    Puis, on initialise la position et la taille du widget, et on param�tre l'intervalle du timer pour coller �
    la fr�quence de rafra�chissement d�sir�e.
</p>
<pre><code class="cpp">#ifdef Q_WS_X11
    #include &lt;Qt/qx11info_x11.h&gt;
    #include &lt;X11/Xlib.h&gt;
#endif

void QSFMLCanvas::showEvent(QShowEvent*)
{
    if (!myInitialized)
    {
        // Sous X11, il faut valider les commandes qui ont �t� envoy�es au serveur
        // afin de s'assurer que SFML aura une vision � jour de la fen�tre
        #ifdef Q_WS_X11
            XFlush(QX11Info::display());
        #endif

        // On cr�e la fen�tre SFML avec l'identificateur du widget
        Create(winId());

        // On laisse la classe d�riv�e s'initialiser si besoin
        OnInit();

        // On param�tre le timer de sorte qu'il g�n�re un rafra�chissement � la fr�quence souhait�e
        connect(&amp;myTimer, SIGNAL(timeout()), this, SLOT(repaint()));
        myTimer.start();

        myInitialized = true;
    }
}
</code></pre>
<p>
    Dans la fonction <code>showEvent</code>, qui est appel�e lorsque le widget est affich�, nous cr�ons la fen�tre SFML.
    Ceci se fait tr�s simplement en appelant la fonction <code>Create</code> avec l'identificateur interne de la
    fen�tre, qui est donn� par la fonction <code>winId</code>. Sous X11 (Unix), nous devons placer un appel syst�me pour
    vider la file de messages qui seraient encore en attente, afin de s'assurer que la SFML va bien voir
    notre fen�tre.<br/>
    Une fois la fen�tre SFML initialis�e, nous pouvons informer la classe d�riv�e en appelant la fonction virtuelle
    <code>OnInit</code>.<br/>
    Enfin, on connecte le timer � la fonction <code>repaint</code>, qui va rafra�chir le widget et g�n�rer un �v�nement
    <em>paint</em>. Et bien entendu, on le d�marre.
</p>
<pre><code class="cpp">QPaintEngine* QSFMLCanvas::paintEngine() const
{
    return 0;
}
</code></pre>
<p>
    Nous faisons en sorte que la fonction <code>paintEngine</code> renvoie un moteur de rendu nul.
    Cette fonction va de paire avec l'option <code>WA_PaintOnScreen</code>, pour dire � Qt que nous n'utilisons aucun
    de ses moteurs de rendu.
</p>
<pre><code class="cpp">void QSFMLCanvas::paintEvent(QPaintEvent*)
{
    // On laisse la classe d�riv�e faire sa tambouille
    OnUpdate();

    // On rafra�chit le widget
    Display();
}
</code></pre>
<p>
    La fonction <code>paintEvent</code> est assez simple : on notifie la classe d�riv�e qu'un rafra�chissement est
    sur le point d'�tre effectu�, et on appelle <code>Display</code> pour mettre � jour notre widget avec la frame
    rendue.
</p>

<?php h2('Utilisation de notre widget Qt-SFML') ?>
<p>
    Le <code>QSFMLCanvas</code> que nous venons d'�crire n'est pas utilisable directement, il doit �tre d�riv�.
    Cr�ons donc un widget d�riv� qui va dessiner quelque chose de sympa :
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

        // On param�tre le sprite
        mySprite.SetImage(myImage);
        mySprite.SetCenter(mySprite.GetSize() / 2.f);
    }

    void OnUpdate()
    {
        // On efface l'�cran
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
    Rien de tr�s compliqu� ici : on surd�finit <code>OnInit</code> pour charger et initialiser nos ressources
    graphiques, et <code>OnUpdate</code> pour les afficher.
</p>
<p>
    Nous pouvons maintenant cr�er une fen�tre Qt classique, et y placer une instance de notre widget perso :
</p>
<pre><code class="cpp">int main(int argc, char **argv)
{
    QApplication App(argc, argv);

    // On cr�e la fen�tre principale
    QFrame* MainFrame = new QFrame;
    MainFrame->setWindowTitle("Qt SFML");
    MainFrame->resize(400, 400);
    MainFrame->show();

    //On cr�e une vue SFML dans la fen�tre principale
    MyCanvas* SFMLView = new MyCanvas(MainFrame, QPoint(20, 20), QSize(360, 360));
    SFMLView->show();

    return App.exec();
}
</code></pre>

<?php h2('Conclusion') ?>
<p>
    L'int�gration de la SFML dans une interface Qt est simplifi�e avec le widget personnalis� que nous venons d'�crire,
    n'h�sitez pas � l'utiliser et � l'am�liorer.<br/>
    Si vous voulez voir comment la SFML s'int�gre � une
    <a class="internal" href="./graphics-wxwidgets-fr.php" title="Aller au tutoriel suivant">interface wxWidgets</a>,
    vous pouvez vous rendre au prochain tutoriel.
</p>

<?php

    require("footer-fr.php");

?>
