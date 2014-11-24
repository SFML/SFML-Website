<?php

    $title = "Communicating with sockets";
    $page = "network-socket.php";

    require("header.php");

?>

<h1>Communicating with sockets</h1>

<?php h2('Sockets') ?>
<p>
    A socket is a gate between your application and the outside world: through a socket, you can send and receive data. Therefore, any network program will most likely have to
    deal with sockets, they are the central element of network communication.
</p>
<p>
    There are several kinds of sockets, that provide specific features. SFML implements the most common ones: TCP sockets and UDP sockets.
</p>

<?php h2('TCP vs UDP') ?>
<p>
    It is important to know what TCP and UDP sockets can do, and what they can't do, so that you can choose the best socket type according to the requirements of your
    application.
</p>
<p>
    The main difference is that TCP sockets are connected. You can't send or receive anything until you are explicitly connected to another TCP socket, on the remote machine.
    Once connected, a TCP socket can only send and receive to/from the connected socket. So you'll need one TCP socket for each client in your application.<br/>
    UDP is not connected, you can send and receive to/from anyone at anytime with the same socket.
</p>
<p>
    The second difference is that TCP is more reliable than UDP. It ensures that what you send is always received, without corruption and in the same order. UDP performs less
    checks, and doesn't provide the same level of robustness: what you send may arrive duplicated, or in a different order, or be lost and never reach the remote computer.
    However, data that are received are always valid (not corrupted).<br/>
    UDP may seem scary, but keep in mind that <em>most of the time</em>, data arrives correctly and in the right order.
</p>
<p>
    The third difference is a direct consequence of the second one: UDP is faster and more lightweight than TCP. Because it has less requirements, thus less overhead.
</p>
<p>
    The last difference is about the way data is transported. TCP is a <em>stream</em> protocol: there's no message boundary, if you send "Hello" and then "SFML", the remote
    machine might receive "HelloSFML", "Hel" + "loSFML", or even "He" + "loS" + "FML".<br/>
    UDP is a <em>datagram</em> protocol. Datagrams are packets that can't be mixed with each other. If you receive a datagram with UDP, then it is guaranteed to be exactly
    the same as it was sent.
</p>
<p>
    Oh, and one last thing: since UDP is not connected, it allows to broadcast messages to multiple recipients, or even to an entire network. The one-to-one communication
    of TCP sockets doesn't allow that.
</p>

<?php h2('Connecting a TCP socket') ?>
<p>
    As you can guess, this part is specific to TCP sockets. There are two sides to a connection: the one that waits for the incoming connection (let's call it the server),
    and the one that triggers it (let's call it the client).
</p>
<p>
    On client side, things are simple: the user just needs to have a <?php class_link('TcpSocket') ?> and call its <code>connect</code> function to trigger the connection.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::TcpSocket socket;
sf::Socket::Status status = socket.connect("192.168.0.5", 53000);
if (status != sf::Socket::Done)
{
    // error...
}
</code></pre>
<p>
    The first argument is the address of the host to connect to. It is a <?php class_link('IpAddress') ?>, which can represent any valid address: an URL, an IP address, or a
    network host name. See its documentation for more details.
</p>
<p>
    The second argument is the port to connect to on the remote machine. The connection will succeed only if the server is waiting for connections on that port.
</p>
<p>
    There's an optional third argument, which is a timeout. If set, and the connection doesn't succeed before the timeout is over, the function returns an error. If not set,
    the default timeout of the OS is used.
</p>
<p>
    Once connected, you can retrieve the address and port of the remote computer if needed, with the <code>getRemoteAddress()</code> and <code>getRemotePort()</code>
    functions.
</p>
<p class="important">
    All functions of socket classes are blocking by default. This means that your program (or at least the thread that contains the function call) will be stuck until the
    operation is complete. This is important because some functions may take very long: for example, connecting to an unreachable host will wait for a few seconds,
    receiving will wait until there's data available, etc.<br/>
    You can change this behaviour and make all functions non-blocking with the <code>setBlocking</code> function of the socket. See the next chapters for more details.
</p>
<p>
    On server side, more things need to be done. Multiple sockets are required: one that listens for incoming connections, and one for each connected client.
</p>
<p>
    To listen for connections, you must use the special <?php class_link('TcpListener') ?> class. Its only role is to wait for connections on a given port, it can't
    send or receive data.
</p>
<pre><code class="cpp">sf::TcpListener listener;

// bind the listener to a port
if (listener.listen(53000) != sf::Socket::Done)
{
    // error...
}

// accept a new connection
sf::TcpSocket client;
if (listener.accept(client) != sf::Socket::Done)
{
    // error...
}

// use "client" to communicate with the connected client,
// and continue to accept new connections with the listener
</code></pre>
<p>
    The <code>accept</code> function blocks until a connection arrives (unless the socket is configured as non-blocking). When it happens, it initializes the given socket
    and returns; the socket can now be used to communicate with the new client, and the listener can start waiting for another connection.
</p>
<p>
    After a successful call to <code>connect</code> (on client side) and <code>accept</code> (on server side), the communication is established and both sockets are ready
    to exchange data.
</p>

<?php h2('Binding a UDP socket') ?>
<p>
    UDP sockets are not connected, but you need to bind to a specific port if you want to be able to receive data on that port. A UDP socket cannot receive everything that
    arrives on every port.
</p>
<pre><code class="cpp">sf::UdpSocket socket;

// bind the socket to a port
if (socket.bind(54000) != sf::Socket::Done)
{
    // error...
}
</code></pre>
<p>
    After binding the socket to a port, it's ready to receive data on that port. If you want the OS to give you a free port automatically, you can pass
    <code>sf::Socket::AnyPort</code>, and then retrieve the chosen port with <code>socket.getLocalPort()</code>.
</p>
<p>
    UDP sockets that send data don't need to do anything before sending.
</p>

<?php h2('Sending and receiving data') ?>
<p>
    Sending and receiving data is the same for both types of sockets. The only difference is that UDP has two extra arguments: the address and port of the sender/recipient.
    There are two different functions for each operation: the low-level one, that sends/receives a raw array of bytes, and the higher-level one, which uses the
    <?php class_link('Packet') ?> class. See the <a class="internal" href="./network-packet.php" title="Tutorial on packets">tutorial on packets</a> for more details about this
    class; here we'll only explain the low-level functions.
</p>
<p>
    To send data, you must call the <code>send</code> function with a pointer to the data that you want to send, and the number of bytes to send.
</p>
<pre><code class="cpp">char data[100] = ...;

// TCP socket:
if (socket.send(data, 100) != sf::Socket::Done)
{
    // error...
}

// UDP socket:
sf::IpAddress recipient = "192.168.0.5";
unsigned short port = 54000;
if (socket.send(data, 100, recipient, port) != sf::Socket::Done)
{
    // error...
}
</code></pre>
<p>
    The <code>send</code> functions take <code>void*</code> pointer, so you can pass the address of anything. However, it is generally a bad idea to send something other than
    an array of bytes, because native types bigger than 1 byte are not guaranteed to be the same on every machine: types such as int or long may have a different size,
    and/or a different endianness. Therefore, such types cannot be exchanged reliably across different systems. This problem is explained (and solved) in the
    <a class="internal" href="./network-packet.php" title="Tutorial on packets">tutorial on packets</a>.
</p>
<p>
    With UDP you can broadcast a message to an entire sub-network in a single call: to do so you can use the special address <code>sf::IpAddress::Broadcast</code>.
</p>
<p>
    There's another thing to keep in mind with UDP: since data are sent in datagrams, and the size of these datagrams has a limit, you are not allowed to exceed it.
    Every call to <code>send</code> must send less that <code>sf::UdpSocket::MaxDatagramSize</code> bytes -- which is a little less than 2^16 (65536) bytes.
</p>
<p>
    To receive data, you must call the <code>receive</code> function:
</p>
<pre><code class="cpp">char data[100];
std::size_t received;

// TCP socket:
if (socket.receive(data, 100, received) != sf::Socket::Done)
{
    // error...
}
std::cout &lt;&lt; "Received " &lt;&lt; received &lt;&lt; " bytes" &lt;&lt; std::endl;

// UDP socket:
sf::IpAddress sender;
unsigned short port;
if (socket.receive(data, 100, received, sender, port) != sf::Socket::Done)
{
    // error...
}
std::cout &lt;&lt; "Received " &lt;&lt; received &lt;&lt; " bytes from " &lt;&lt; sender &lt;&lt; " on port " &lt;&lt; port &lt;&lt; std::endl;
</code></pre>
<p>
    It is important to keep in mind that, if the socket is in blocking mode, <code>receive</code> will wait until something is received, blocking the thread that called it
    (and thus possibly the whole program).
</p>
<p>
    The first two arguments are the buffer where to copy the received bytes, and its maximum size. The third argument is a variable that will be filled with the actual
    number of bytes received.<br/>
    With UDP sockets, the last two arguments are filled with the address and port of the sender; they can be used later if you want to send a response.
</p>
<p>
    These functions are low-level, and you should use them only if you have a very good reason to do so. A more robust and flexible approach involves using
    <a class="internal" href="./network-packet.php" title="Tutorial on packets">packets</a>.
</p>

<?php h2('Blocking on a group of sockets') ?>
<p>
    Blocking on a single socket can quickly become annoying, because you will most likely have to handle more than one client. And you don't want socket A to block
    your program while socket B has received something that could be processed. What you'd like is to block on multiple sockets at once, ie. waiting until
    <em>any of them</em> has received something. This is possible with socket selectors, represented by the <?php class_link('SocketSelector') ?> class.
</p>
<p>
    A selector can watch all types of sockets: <?php class_link('TcpSocket') ?>, <?php class_link('UdpSocket') ?>, and <?php class_link('TcpListener') ?>. To add
    a socket to a selector, use its <code>add</code> function:
</p>
<pre><code class="cpp">sf::TcpSocket socket;

sf::SocketSelector selector;
selector.add(socket);
</code></pre>
<p class="important">
    A selector is not a socket container. If only references (points to) the sockets that you add, it doesn't store them. So you mustn't try to retrieve or count the
    sockets that you put inside; you must rather have your own separate socket storage (like a <code>std::vector</code> or a <code>std::list</code>).
</p>
<p>
    Once you have filled the selector with all the sockets that you want to watch, you must call its <code>wait</code> function to wait until any of them has received
    something (or has triggered an error). You can also pass an optional timeout, so that the function will fail if nothing has been received in a certain time -- this
    avoids to stay stuck forever if nothing happens.
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10)))
{
    // received something
}
else
{
    // timeout reached, nothing was received...
}
</code></pre>
<p>
    If the <code>wait</code> function returns <code>true</code>, it means that one or more socket(s) have received something, and you can safely call <code>receive</code>
    on these sockets: they won't block. If the socket is a <?php class_link('TcpListener') ?>, it means that an incoming connection is ready to be processed and that you
    can call its <code>accept</code> function.
</p>
<p>
    Since the selector is not a socket container, it cannot directly give you the sockets that are ready to receive. Instead, you must test all the candidates with the
    <code>isReady</code> function:
</p>
<pre><code class="cpp">if (selector.wait(sf::seconds(10)))
{
    // for each socket... &lt;-- pseudo-code because I don't know how you store your sockets :)
    {
        if (selector.isReady(socket))
        {
            // this socket is ready, you can receive (or accept if it's a listener)
            socket.receive(...);
        }
    }
}
</code></pre>
<p>
    You can have a look at the API documentation of the <?php class_link('SocketSelector') ?> class for a working example of how to use a selector to handle connections
    and messages from multiple clients
</p>
<p>
    As a bonus, the timeout capability of <code>Selector::wait</code> allows to implement a receive-with-timeout function, which is not directly available in the
    socket classes, very easily:
</p>
<pre><code class="cpp">sf::Socket::Status receiveWithTimeout(sf::TcpSocket&amp; socket, sf::Packet&amp; packet, sf::Time timeout)
{
    sf::SocketSelector selector;
    selector.add(socket);
    if (selector.wait(timeout))
        return socket.receive(packet);
    else
        return sf::Socket::NotReady;
}
</code></pre>

<?php h2('Non-blocking sockets') ?>
<p>
    All sockets are blocking by default, but you can change this behaviour at any time with the <code>setBlocking</code> function.
</p>
<pre><code class="cpp">sf::TcpSocket tcpSocket;
tcpSocket.setBlocking(false);

sf::TcpListener listenerSocket;
listenerSocket.setBlocking(false);

sf::UdpSocket udpSocket;
udpSocket.setBlocking(false);
</code></pre>
<p>
    Once a socket is set as non-blocking, its functions always return immediately. For example, <code>receive</code> will return with status <code>sf::Socket::NotReady</code>
    if there's no data available. Or, <code>accept</code> will return immediately, with the same status, if there's no pending connection.
</p>
<p>
    Non-blocking sockets are the easiest solution if you already have a main loop that runs at a constant rate. You can simply check if something happened on your sockets
    at every iteration, without blocking the program flow.
</p>

<?php

    require("footer.php");

?>
