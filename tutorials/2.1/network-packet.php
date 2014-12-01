<?php

    $title = "Using and extending packets";
    $page = "network-packet.php";

    require("header.php");

?>

<h1>Using and extending packets</h1>

<?php h2('Problems that need to be solved') ?>
<p>
    Exchanging data on a network is more tricky than it seems. The reason is that different machines, with different OSes and processors, can be involved. And several problems
    arise if you want to exchange data reliably between such different machines.
</p>
<p>
    The first problem is the endianness. The endianness is the order in which a particular processor interprets the bytes of primitive types that use more than a single byte
    (integers and floating point numbers).
    There are two main families: "big endian" processors, which store the most significant byte first, and "little endian" processors, which store the least significant byte
    first. There are other, more exotic byte orders, but you'll probably never have to deal with them.<br/>
    So the problem is obvious: if you send a variable between two computers whose endianness doesn't match, they won't see the same value. For example, the 16-bit integer
    "42" in big endian notation is 00000000 00101010, but if you send this to a little endian machine, it will be interpreted as "10752".
</p>
<p>
    The second problem is the size of primitive types. The C++ standard doesn't set the size of primitive types (char, short, int, long, float, double), so, again,
    there can be differences between processors -- and there are. For example, the <code>long int</code> type can be a 32-bit type on some platforms, and 64-bit on others.
</p>
<p>
    The third problem is specific to how the TCP protocol works. Because it doesn't preserve message boundaries, and can split or combine chunks of data, receivers must
    properly reconstruct incoming messages before interpreting them. Otherwise bad things may happen, like reading incomplete variables, or ignoring useful bytes.
</p>
<p>
    You may of course face other problems with network programming, but these are the lowest-level ones, that almost everybody will have to solve. That's why SFML provides
    simple tools to avoid them.
</p>

<?php h2('Fixed-size primitive types') ?>
<p>
    Since primitive types cannot be exchanged reliably on a network, the solution is simple: don't use them. SFML provides fixed-size types for data exchange:
    <code>sf::Int8, sf::Uint16, sf::Int32</code>, etc. These types are just typedefs to primitive types, but they are mapped to the type which has the expected size according
    to the platform. So they can (and must!) be used safely when you want to exchange data between two computers.
</p>
<p>
    SFML only provides fixed-size <em>integer</em> types. Floating-point types should normally have their fixed-size equivalent too, but in practice this is not needed
    (at least on platforms where SFML runs), <code>float</code> and <code>double</code> types always have the same size (resp. 32 and 64-bit).
</p>

<?php h2('Packets') ?>
<p>
    The two other problems (endianness and message boundaries) are solved by using a specific class to pack your data: <?php class_link('Packet') ?>. As a bonus, it provides
    a much nicer interface than the good old byte array.
</p>
<p>
    Packets have a programming interface similar to standard streams: you can insert data with the &lt;&lt; operator, and extract data with the &gt;&gt; operator.
</p>
<pre><code class="cpp">// on sending side
sf::Uint16 x = 10;
std::string s = "hello";
double d = 0.6;

sf::Packet packet;
packet &lt;&lt; x &lt;&lt; s &lt;&lt; d;
</code></pre>
<pre><code class="cpp">// on receiving side
sf::Uint16 x;
std::string s;
double d;

packet &gt;&gt; x &gt;&gt; s &gt;&gt; d;
</code></pre>
<p>
    Unlike writing, reading from a packet can fail if you try to extract more bytes than the packet contains. If a reading operation fails, the packet is set to an error state.
    To check the state of a packet, you can test it like a boolean (the same way you do with standard streams):
</p>
<pre><code class="cpp">if (packet &gt;&gt; x)
{
    // ok
}
else
{
    // error, failed to read 'x' from the packet
}
</code></pre>
<p>
    Sending and receiving packets is as easy as sending/receiving an array of bytes: sockets have an overload of <code>send</code> and <code>receive</code> that directly
    accept a <?php class_link('Packet') ?>.
</p>
<pre><code class="cpp">// with a TCP socket
tcpSocket.send(packet);
tcpSocket.receive(packet);
</code></pre>
<pre><code class="cpp">// with a UDP socket
udpSocket.send(packet, recipientAddress, recipientPort);
udpSocket.receive(packet, senderAddress, senderPort);
</code></pre>
<p>
    Packets solve the "message boundaries" problem, which means that when you send a packet on a TCP socket, you receive the exact same packet on the other end, it cannot
    contain less bytes, or bytes from the next packet that you send. However, it has a drawback: to preserve message boundaries, <?php class_link('Packet') ?> has to send
    extra bytes with your data, which implies that you can only receive them with a <?php class_link('Packet') ?> if you want them to be properly decoded. In other words,
    you can't send a SFML packet to a custom recipient, it has to use a SFML packet too. Note that this applies to TCP only, UDP is fine since the protocol itself ensures
    message boundaries.
</p>

<?php h2('Extending packets to handle user types') ?>
<p>
    Packets have overloads of their operators for all the primitive types and the most common standard types, but what about your own classes? Like with standard streams,
    you can make a type "compatible" with <?php class_link('Packet') ?> by creating an overload of the &lt;&lt; and &gt;&gt; operators.
</p>
<pre><code class="cpp">struct Character
{
    sf::Uint8 age;
    std::string name;
    float weight;
};

sf::Packet&amp; operator &lt;&lt;(sf::Packet&amp; packet, const Character&amp; character)
{
    return packet &lt;&lt; character.age &lt;&lt; character.name &lt;&lt; character.weight;
}

sf::Packet&amp; operator &gt;&gt;(sf::Packet&amp; packet, Character&amp; character)
{
    return packet &gt;&gt; character.age &gt;&gt; character.name &gt;&gt; character.weight;
}
</code></pre>
<p>
    Both operators return a reference to the packet: this allows to chain calls.
</p>
<p>
    Now that these operators are defined, you can insert/extract a <code>Character</code> instance to/from a packet like any other primitive type:
</p>
<pre><code class="cpp">Character bob;

packet &lt;&lt; bob;
packet &gt;&gt; bob;
</code></pre>

<?php h2('Custom packets') ?>
<p>
    Packets provide nice features on top of your raw data, but what if you want to add your own features, like automatically compressing or encrypting the data? This can
    easily be achieved, by deriving from <?php class_link('Packet') ?> and overriding the following functions:
</p>
<ul>
    <li><code>onSend</code>: called before the data is sent by the socket</li>
    <li><code>onReceive</code>: called after the data has been received by the socket</li>
</ul>
<p>
    These functions provide a direct access to the data, so that you can transform them according to your needs.
</p>
<p>
    Here is an (fake) example of a packet that does automatic compression/uncompression:
</p>
<pre><code class="cpp">class ZipPacket : public sf::Packet
{
    virtual const void* onSend(std::size_t&amp; size)
    {
        const void* srcData = getData();
        std::size_t srcSize = getDataSize();
        return compressTheData(srcData, srcSize, &amp;size); // this is a fake function, of course :)
    }
    virtual void onReceive(const void* data, std::size_t size)
    {
        std::size_t dstSize;
        const void* dstData = uncompressTheData(data, size, &amp;dstSize); // this is a fake function, of course :)
        append(dstData, dstSize);
    }
};
</code></pre>
<p>
    Such a packet class can be used exactly like <?php class_link('Packet') ?>. And your operator overloads still apply.
</p>
<pre><code class="cpp">ZipPacket packet;
packet &lt;&lt; x &lt;&lt; bob;
socket.send(packet);
</code></pre>

<?php

    require("footer.php");

?>
