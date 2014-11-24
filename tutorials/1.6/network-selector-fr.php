<?php

    $title = "Utiliser un s�lecteur";
    $page = "network-selector-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser un s�lecteur</h1>

<?php h2('Introduction') ?>
<p>
    Comme vous avez pu le voir dans le tutoriel pr�c�dent, certaines fonctions des sockets (<code>Accept</code>,
    <code>Receive</code>) sont bloquantes, ce qui signifie qu'elles vont stopper l'ex�cution du programme
    tout entier si elles sont utilis�es. Cela signifie �galement que vous ne pourrez jamais
    attendre sur deux sockets en m�me temps. Une bonne solution est d'utiliser un thread : placez les
    appels bloquants dans un nouveau thread, et votre programme sera toujours capable de tourner
    pendant que les sockets sont en attente. Mais utiliser des threads n'est pas simple : cela
    requiert une bonne synchronisation, peut �tre difficile � d�boguer, et peut d�grader les
    performances si vous utilisez beaucoup de threads.
</p>
<p>
    L'autre solution est d'utiliser des s�lecteurs. Les s�lecteurs permettent de multiplexer un ensemble
    de sockets, sans avoir � faire tourner un autre thread. Ils sont toujours bloquants, mais rendront
    la main d�s que l'un des sockets est pr�t. Les s�lecteurs peuvent aussi utiliser une valeur de
    <em>timeout</em>, pour �viter d'attendre ind�finiment.
</p>

<?php h2('G�rer plusieurs clients') ?>
<p>
    Il existe deux types de s�lecteurs dans la SFML : <?php class_link("SelectorTCP", "Selector")?> (pour les sockets TCP) et
    <?php class_link("SelectorUDP", "Selector")?> (pour les sockets UDP). Cependant seul le type de socket diff�re, les
    fonctions et le comportement sont exactement les m�mes pour les deux classes.
</p>
<p>
    Donc, tentons d'utiliser un s�lecteur TCP. Ici nous allons construire un serveur qui sera
    capable de g�rer plusieurs clients � la fois, sans utiliser le moindre thread.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::SelectorTCP Selector;
</code></pre>
<p>
    Les s�lecteurs se comportent comme des tableaux : vous pouvez ajouter (<code>Add</code>) et retirer
    (<code>Remove</code>) des sockets, ou encore les vider (<code>Clear</code>). Ici nous allons
    ajouter tous nos sockets, puisque nous voulons �tre notifi�s � chaque fois qu'un client nous envoie
    un message.
</p>
<p>
    Avant d'ajouter le moindre client dans le s�lecteur, souvenez-vous qu'il faut utiliser un socket
    �couteur, qui attendra les connexions entrantes. Accepter une connexion �tant bloquant, nous devrons
    aussi placer le socket �couteur dans le s�lecteur.
</p>
<pre><code class="cpp">sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Erreur...
}

Selector.Add(Listener);
</code></pre>
<p>
    Puis vous pouvez commencer une boucle infinie qui va recevoir � la fois les connexions entrantes,
    et les messages en provenance des clients connect�s.<br/>
    Pour r�cup�rer les sockets pr�ts dans le s�lecteur, il faut appeler sa fonction
    <code>Wait</code> suivie par <code>GetSocketReady</code> :
</p>
<pre><code class="cpp">while (true)
{
    unsigned int NbSockets = Selector.Wait();

    for (unsigned int i = 0; i &lt; NbSockets; ++i)
    {
        sf::SocketTCP Socket = Selector.GetSocketReady(i);

        // Faire quelque chose avec Socket...
    }
}
</code></pre>
<p>
    <code>Wait</code> peut prendre un param�tre optionnel, qui est une dur�e de <em>timeout</em>
    (temps au bout duquel on stoppe l'attente si rien n'a �t� re�u) en secondes.
</p>
<p>
    Notez bien qu'� chaque appel de <code>Wait</code>, le s�lecteur va attendre jusqu'�
    ce qu'au moins un socket soit pr�t. Donc si vous l'appelez deux fois en un tour de boucle, ne vous
    attendez pas � ce que la fonction rende la main instantan�ment, ou renvoie les m�mes sockets.
</p>
<p>
    Regardons ce que nous allons placer dans la boucle ci-dessus. Visiblement, nous allons appeler
    <code>Receive</code> sur notre socket, �tant donn� qu'il est suppos� �tre pr�t
    � recevoir. Mais n'oubliez pas que notre socket �couteur se trouve �galement dans le s�lecteur, et
    s'il est pr�t alors il faudra accepter une connexion entrante plut�t que de recevoir un paquet. Et si
    un nouveau client se connecte, il faudra ajouter le nouveau socket au s�lecteur.
</p>
<pre><code class="cpp">La boucle ci-dessus...
{
    // On r�cup�re le socket
    sf::SocketTCP Socket = Selector.GetSocketReady(i);
    
    if (Socket == Listener)
    {
        // Si le socket �couteur est pr�t, cela signifie que nous pouvons accepter une nouvelle connexion
        sf::IPAddress Address;
        sf::SocketTCP Client;
        Listener.Accept(Client, &amp;Address);
        std::cout &lt;&lt; "Client connected ! (" &lt;&lt; Address &lt;&lt; ")" &lt;&lt; std::endl;

        // On l'ajoute au s�lecteur
        Selector.Add(Client);
    }
    else
    {
        // Sinon, il s'agit d'un socket de client et nous pouvons lire les donn�es qu'il nous envoie
        sf::Packet Packet;
        if (Socket.Receive(Packet) == sf::Socket::Done)
        {
            // On extrait le message et on l'affiche
            std::string Message;
            Packet &gt;&gt; Message;
            std::cout &lt;&lt; "A client says : \"" &lt;&lt; Message &lt;&lt; "\"" &lt;&lt; std::endl;
        }
        else
        {
            // Erreur : on ferait mieux de retirer le socket du s�lecteur
            Selector.Remove(Socket);
        }
    }
}
</code></pre>
<p>
    Le code pour le client est tr�s simple : il se connecte au serveur, r�cup�re les saisies de
    l'utilisateur et les envoie au serveur. Tout est inclus dans le code source t�l�chargeable au
    bas de la page.
</p>

<?php h2('Une fonction de r�ception avec <em>timeout</em>') ?>
<p>
    Etant donn� que le s�lecteur peut utiliser un <em>timeout</em>, et qu'il n'y a aucun probl�me �
    ne placer qu'un seul socket dedans, nous pouvons l'utiliser pour construire une fonction de r�ception
    qui prendra en param�tre suppl�mentaire un <em>timeout</em>, c'est-�-dire une dur�e au bout de laquelle
    on va annuler l'attente m�me si rien n'a �t� re�u. Cela peut �tre utile par exemple
    pour impl�menter une fonction de <em>ping</em>, qui v�rifie p�riodiquement si un client est toujours
    connect�.
</p>
<pre><code class="cpp">bool ReceiveWithTimeout(sf::SocketTCP Socket, sf::Packet&amp; Packet, float Timeout = 0)
{
    sf::SelectorTCP Selector;
    Selector.Add(Socket);

    if (Selector.Wait(Timeout) > 0)
    {
        Socket.Receive(Packet);
        return true;
    }
    else
    {
        return false;
    }
}
</code></pre>

<?php h2('Conclusion') ?>
<p>
    Les s�lecteurs sont un outil puissant pour les applications multi-client, et sont bien souvent beaucoup plus pratiques
    que de faire tourner plusieurs threads. N'h�sitez pas � les utiliser.
</p>

<?php

    require("footer-fr.php");

?>
