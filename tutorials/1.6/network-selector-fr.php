<?php

    $title = "Utiliser un sélecteur";
    $page = "network-selector-fr.php";

    require("header-fr.php");
?>

<h1>Utiliser un sélecteur</h1>

<?php h2('Introduction') ?>
<p>
    Comme vous avez pu le voir dans le tutoriel précédent, certaines fonctions des sockets (<code>Accept</code>,
    <code>Receive</code>) sont bloquantes, ce qui signifie qu'elles vont stopper l'exécution du programme
    tout entier si elles sont utilisées. Cela signifie également que vous ne pourrez jamais
    attendre sur deux sockets en même temps. Une bonne solution est d'utiliser un thread : placez les
    appels bloquants dans un nouveau thread, et votre programme sera toujours capable de tourner
    pendant que les sockets sont en attente. Mais utiliser des threads n'est pas simple : cela
    requiert une bonne synchronisation, peut être difficile à déboguer, et peut dégrader les
    performances si vous utilisez beaucoup de threads.
</p>
<p>
    L'autre solution est d'utiliser des sélecteurs. Les sélecteurs permettent de multiplexer un ensemble
    de sockets, sans avoir à faire tourner un autre thread. Ils sont toujours bloquants, mais rendront
    la main dès que l'un des sockets est prêt. Les sélecteurs peuvent aussi utiliser une valeur de
    <em>timeout</em>, pour éviter d'attendre indéfiniment.
</p>

<?php h2('Gérer plusieurs clients') ?>
<p>
    Il existe deux types de sélecteurs dans la SFML : <?php class_link("SelectorTCP", "Selector")?> (pour les sockets TCP) et
    <?php class_link("SelectorUDP", "Selector")?> (pour les sockets UDP). Cependant seul le type de socket diffère, les
    fonctions et le comportement sont exactement les mêmes pour les deux classes.
</p>
<p>
    Donc, tentons d'utiliser un sélecteur TCP. Ici nous allons construire un serveur qui sera
    capable de gérer plusieurs clients à la fois, sans utiliser le moindre thread.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::SelectorTCP Selector;
</code></pre>
<p>
    Les sélecteurs se comportent comme des tableaux : vous pouvez ajouter (<code>Add</code>) et retirer
    (<code>Remove</code>) des sockets, ou encore les vider (<code>Clear</code>). Ici nous allons
    ajouter tous nos sockets, puisque nous voulons être notifiés à chaque fois qu'un client nous envoie
    un message.
</p>
<p>
    Avant d'ajouter le moindre client dans le sélecteur, souvenez-vous qu'il faut utiliser un socket
    écouteur, qui attendra les connexions entrantes. Accepter une connexion étant bloquant, nous devrons
    aussi placer le socket écouteur dans le sélecteur.
</p>
<pre><code class="cpp">sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Erreur...
}

Selector.Add(Listener);
</code></pre>
<p>
    Puis vous pouvez commencer une boucle infinie qui va recevoir à la fois les connexions entrantes,
    et les messages en provenance des clients connectés.<br/>
    Pour récupérer les sockets prêts dans le sélecteur, il faut appeler sa fonction
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
    <code>Wait</code> peut prendre un paramètre optionnel, qui est une durée de <em>timeout</em>
    (temps au bout duquel on stoppe l'attente si rien n'a été reçu) en secondes.
</p>
<p>
    Notez bien qu'à chaque appel de <code>Wait</code>, le sélecteur va attendre jusqu'à
    ce qu'au moins un socket soit prêt. Donc si vous l'appelez deux fois en un tour de boucle, ne vous
    attendez pas à ce que la fonction rende la main instantanément, ou renvoie les mêmes sockets.
</p>
<p>
    Regardons ce que nous allons placer dans la boucle ci-dessus. Visiblement, nous allons appeler
    <code>Receive</code> sur notre socket, étant donné qu'il est supposé être prêt
    à recevoir. Mais n'oubliez pas que notre socket écouteur se trouve également dans le sélecteur, et
    s'il est prêt alors il faudra accepter une connexion entrante plutôt que de recevoir un paquet. Et si
    un nouveau client se connecte, il faudra ajouter le nouveau socket au sélecteur.
</p>
<pre><code class="cpp">La boucle ci-dessus...
{
    // On récupère le socket
    sf::SocketTCP Socket = Selector.GetSocketReady(i);
    
    if (Socket == Listener)
    {
        // Si le socket écouteur est prêt, cela signifie que nous pouvons accepter une nouvelle connexion
        sf::IPAddress Address;
        sf::SocketTCP Client;
        Listener.Accept(Client, &amp;Address);
        std::cout &lt;&lt; "Client connected ! (" &lt;&lt; Address &lt;&lt; ")" &lt;&lt; std::endl;

        // On l'ajoute au sélecteur
        Selector.Add(Client);
    }
    else
    {
        // Sinon, il s'agit d'un socket de client et nous pouvons lire les données qu'il nous envoie
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
            // Erreur : on ferait mieux de retirer le socket du sélecteur
            Selector.Remove(Socket);
        }
    }
}
</code></pre>
<p>
    Le code pour le client est très simple : il se connecte au serveur, récupère les saisies de
    l'utilisateur et les envoie au serveur. Tout est inclus dans le code source téléchargeable au
    bas de la page.
</p>

<?php h2('Une fonction de réception avec <em>timeout</em>') ?>
<p>
    Etant donné que le sélecteur peut utiliser un <em>timeout</em>, et qu'il n'y a aucun problème à
    ne placer qu'un seul socket dedans, nous pouvons l'utiliser pour construire une fonction de réception
    qui prendra en paramètre supplémentaire un <em>timeout</em>, c'est-à-dire une durée au bout de laquelle
    on va annuler l'attente même si rien n'a été reçu. Cela peut être utile par exemple
    pour implémenter une fonction de <em>ping</em>, qui vérifie périodiquement si un client est toujours
    connecté.
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
    Les sélecteurs sont un outil puissant pour les applications multi-client, et sont bien souvent beaucoup plus pratiques
    que de faire tourner plusieurs threads. N'hésitez pas à les utiliser.
</p>

<?php

    require("footer-fr.php");

?>
