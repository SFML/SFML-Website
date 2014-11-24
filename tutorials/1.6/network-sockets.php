<?php

    $title = "Using sockets";
    $page = "network-sockets.php";

    require("header.php");
?>

<h1>Using sockets</h1>

<?php h2('Introduction') ?>
<p>
    In this tutorial you will learn the basics of network programming with sockets, and you will be
    able to exchange data between two distant computers.
</p>

<?php h2('What is a socket ?') ?>
<p>
    For those who are new to network programming, sockets are the most important thing to know. Almost
    everything (at a low level) relies on sockets. A sockets can be seen as a pipe between two computers,
    and once you've setup such a pipe, you can start exchanging data.
</p>
<p>
    A lot of protocols exist to communicate on the network, and each protocol has several types of sockets.
    But all you have to know is the internet protocol (IP), with TCP and UDP types of sockets ; this is
    what almost every network software uses, and this is what SFML uses in its network package.
</p>
<p>
    TCP and UDP sockets are quite different, here is why :
</p>
<ul>
    <li>TCP sockets make sure that data will arrive with no error and in the same order as it was sent</li>
    <li>UDP sockets offer absolutely no guarantee of delivery ; data can be lost, duplicated, or arrive in another order</li>
    <li>TCP sockets must be connected ; once you are connected, all data you send and receive are from / to the same destination</li>
    <li>UDP sockets don't need to be connected ; you must give the destination address each time you send or receive</li>
</ul>
<p>
    To sum up, TCP sockets are safer but slower. There are only a few cases that require UDP sockets :
    intensive real-time applications like RPG/FPS/RTS games, or broadcasting (sending data to
    every computer of a sub-network).
</p>

<?php h2('Handling network addresses') ?>
<p>
    Before starting using sockets, let's explain one useful utility classe included in the network
    package : <?php class_link("IPAddress")?>. It wraps an IP address (v4) and provides
    useful functions for initialization, comparison, etc. As network programming involves communications
    with other computers, you'll need this class each time you connect / send / receive.
</p>
<p>
    First of all, you have to include the header for the network package. As usual, it will include all
    the headers needed to use the network classes.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
</code></pre>
<p>
    You can initialize a <?php class_link("IPAddress")?> from different sources :
</p>
<pre><code class="cpp">sf::IPAddress Address1;                  // By default : invalid address
sf::IPAddress Address2("192.168.0.1");   // From a string representation
sf::IPAddress Address3("computer_name"); // From a host name
sf::IPAddress Address4(192, 168, 0, 1);  // From 4 bytes
sf::IPAddress Address5 = sf::IPAddress::LocalHost; // 127.0.0.1 -- your own computer
</code></pre>
<p>
    You can also get your public IP address, either from the local network point of view
    or from the internet :
</p>
<pre><code class="cpp">// Your address in the local area network (like 192.168.1.100 -- the one you get with ipconfig)
sf::IPAddress Address6 = sf::IPAddress::GetLocalAddress();

// Your address in the world wide web (like 83.2.124.68 -- the one you get with www.whatismyip.org)
sf::IPAddress Address7 = sf::IPAddress::GetPublicAddress();
</code></pre>
<p>
    Please note that <code>GetPublicAddress()</code> is very slow : the only way to get a public address
    is to get it from the outside (especially when you are behind a proxy or a firewall), so it connects
    to an external website (www.whatismyip.org) and parse the returned web page to extract the public
    IP address. So, don't use it too much.
</p>
<p>
    You can get the string representation (in the form "xxx.xxx.xxx.xxx") of an address with its
    <code>ToString()</code> function :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
std::string IP = Address.ToString();
</code></pre>
<p>
    You can also check the validity of an address with its <code>IsValid()</code> function :
</p>
<pre><code class="cpp">sf::IPAddress Address("computer_name");
if (Address.IsValid())
    // Ok, host found
else
    // Invalid address
</code></pre>

<?php h2('Using a UDP socket') ?>
<p>
    UDP sockets are connectionless, so they are the easiest ones to use. No connection is needed,
    all you have to do is sending and receiving data. The only step required is to bind the socket to a port before
    receiving data.
</p>
<p>
    SFML sockets allow sending raw data, defined by a pointer to a byte array and its size :
</p>
<pre><code class="cpp">// Create the UDP socket
sf::SocketUDP Socket;

// Create bytes to send
char Buffer[] = "Hi guys !";

// Send data to "192.168.0.2" on port 4567
if (Socket.Send(Buffer, sizeof(Buffer), "192.168.0.2", 4567) != sf::Socket::Done)
{
    // Error...
}
</code></pre>
<p>
    Here, we send our byte array (containing "Hi guys !") to the computer which IP address is 192.168.0.2,
    on port 4567. The second parameter is a <?php class_link("IPAddress")?>, so you could as well
    use a network name, a broadcast address or whatever type of address.<br/>
    If you don't want to use a specific port, you can just take any free port number between 1024 and
    65535 (ports less than 1024 are reserved). And of course, make sure that your firewall is not
    blocking this port !
</p>
<p>
    The <code>Send</code> function, as well as all other functions that can block,
    returns a socket status (see <code>sf::Socket::Status</code>) which can be :
</p>
<ul>
    <li><code>sf::Socket::Done</code> : the operation has been completed with success</li>
    <li><code>sf::Socket::NotReady</code> : in non-blocking mode only, returned when the socket is not yet ready to complete the task</li>
    <li><code>sf::Socket::Disconnected</code> : the socket has been disconnected</li>
    <li><code>sf::Socket::Error</code> : an unexpected error happened</li>
</ul>
<p>
    Receiving data is exactly the same, except you first need to bind the socket to a port before
    receiving data from this port.
</p>
<pre><code class="cpp">// Create the UDP socket
sf::SocketUDP Socket;

// Bind it (listen) to the port 4567
if (!Socket.Bind(4567))
{
    // Error...
}
</code></pre>
<p>
    Then you can receive a byte array, its size, and the address / port of the sender.
</p>
<pre><code class="cpp">char Buffer[128];
std::size_t Received;
sf::IPAddress Sender;
unsigned short Port;
if (Socket.Receive(Buffer, sizeof(Buffer), Received, Sender, Port) != sf::Socket::Done)
{
    // Error...
}

// Show the address / port of the sender
std::cout &lt;&lt; Sender &lt;&lt; ":" &lt;&lt; Port &lt;&lt; std::endl;

// Show the message
std::cout &lt;&lt; Buffer &lt;&lt; std::endl; // "Hi guys !"
</code></pre>
<p>
    Please note that <code>Receive</code> is blocking, meaning that it won't return
    until it has received something if the socket is in blocking mode (which is the default).
</p>

<p>
    When you don't need the socket anymore, you have to close it (the destructor won't do it for you !) :
</p>
<pre><code class="cpp">Socket.Close();
</code></pre>

<?php h2('Using a TCP socket') ?>
<p>
    TCP sockets must be connected before sending or receiving data. Here is how it works.
</p>
<p>
    First, you open a socket and make it listen to a given port.
</p>
<pre><code class="cpp">sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Error...
}
</code></pre>
<p>
    Then, you can wait for connections on this port.
</p>
<pre><code class="cpp">sf::IPAddress ClientAddress;
sf::SocketTCP Client;
if (Listener.Accept(Client, &amp;ClientAddress) != sf::Socket::Done)
{
    // Error...
}
</code></pre>
<p>
    The <code>Accept</code> function will wait until an incoming connection arrives,
    and return a new socket that will be used to exchange data with the connected computer. If you pass
    a <?php class_link("IPAddress")?> to the function, it will be filled with the client's address
    (so you can know who is connected).<br/>
    If the socket is in non-blocking mode, the function will return immediatly if there's no connection arriving, with the
    status <code>sf::Socket::NotReady</code>.
</p>
<p>
    Let's now have a look at the client's code. All you have to do is creating a socket and connect
    to the server on the port that he's listening to.
</p>
<pre><code class="cpp">sf::SocketTCP Client;
if (Client.Connect(4567, "192.168.0.2") != sf::Socket::Done)
{
    // Error...
}
</code></pre>
<p>
    Now, both the client and the server are ready to communicate. The functions for sending and receiving
    data are the same as UDP sockets, except that you don't need to give the port and the host address.
    So basically, the only parameters are the array to send / receive and its size.
</p>
<pre><code class="cpp">char Buffer[] = "Hi guys !";
if (Client.Send(Buffer, sizeof(Buffer)) != sf::Socket::Done)
{
    // Error...
}
</code></pre>
<pre><code class="cpp">char Buffer[128];
std::size_t Received;
if (Client.Receive(Buffer, sizeof(Buffer), Received) != sf::Socket::Done)
{
    // Error...
}
</code></pre>
<p>
    For TCP sockets, the <code>Send</code> and <code>Receive</code> functions can return
    <code>sf::Socket::Disconnected</code>, which means the socket has been disconnected.
</p>
<p>
    As for UDP sockets, don't forget to close the socket when you have finished.
</p>

<?php h2('Conclusion') ?>
<p>
    SFML provides a low-level but easy to use set of classes for exchanging data through the
    network. But don't forget that network programming is not easy, and you will have to use efficient
    algorithms and data structures to build robust and fast programs. I advise you to read some good
    tutorials about network programming (not about sockets, but about techniques and general algorithms),
    especially if you are new to network programming.
</p>
<p>
    In the <a class="internal" href="./network-packets.php" title="Next tutorial">next tutorial</a>,
    we'll see another utility class that allow easier data manipulation through the network.
</p>

<?php

    require("footer.php");

?>
