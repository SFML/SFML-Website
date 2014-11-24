<?php

    $title = "Using and extending packets";
    $page = "network-packets.php";

    require("header.php");
?>

<h1>Using and extending packets</h1>

<?php h2('Introduction') ?>
<p>
    Data exchange through a network can be more complicated than it seems. Everything may look cool
    when you test your application with your own computer as both the client and the server,
    but when you deal with internet and different platforms, several issues can arise.
</p>
<p>
    The first one is endianess. Endianess is the order in which a particular platform will store
    the bytes of a primitive type. There are two main families of platform : big-endian (most significant
    byte first - MSB), and little endian (least significant byte first - LSB). Some exotic platforms
    may also use bi-endian or mixed-endian, two other forms of byte storage.<br/>
    To come back to network data transfer, let's imagine that you send a 16 bits integer as little-endian
    (your processor is an Intel x86 for example), and the server receives it and interprets it as big-endian
    (its processor is an Apple PowerPC for example) ; if you send 48 (00000000 00110000) the server will actually
    see 768 (00000011 00000000).
</p>
<p>
    Another problem is primitive types sizes. Different platforms can have different sizes for the
    same type. If the size of a <code>long int</code> is 32 bits on your platform, maybe it will be 64 bits
    on the server, and again, the received data won't be interpreted properly.
</p>
<p>
    The third problem is more network related. Data transfers through TCP and UDP protocols must follow
    some rules defined by the lower levels of implementation. In particular, a chunk of data can be split
    and received in several parts ; the receiver must then find a way to recompose the chunk and
    return data as if it was received in once.
</p>
<p>
    These are the most common problems involved in network programming, but there are a lot more do deal
    with if you want to build robust programs. To help you with these low-level tasks, SFML provides
    a class for manipulating network data through packets : <?php class_link("Packet")?>.
</p>

<?php h2('Primitive types') ?>
<p>
    Like I just said earlier, primitive C++ types such as <code>unsigned int</code>, <code>long</code>, etc. have a size which is
    not fixed and may vary depending on the platform. As a consequence, it's inappropriate to use them for sending
    data over the network, as there's no control on what size will be sent and received. Unfortunately,
    <?php class_link("Packet")?> can't solve this issue automatically, there's still a moment where you must
    explicitely tell the expected size of a primitive type. To do so, the best solution is to use SFML's fixed size
    types : <code>sf::Int8</code>, <code>sf::Uint16</code>, <code>sf::Int32</code>, etc. Those types are guaranteed to
    have the intended size on any platform.
</p>
<p>
    So this is one thing you should never forget : always use fixed size types for structures you want to send over the
    network, either directly or via a cast just before sending / after receiving.
</p>

<?php h2('Basic usage') ?>
<p>
    Just like standard I/O, <?php class_link("Packet")?> allow easy insertion and extraction through
    the &lt;&lt; and &gt;&gt; operators. You can build a packet of data just like you write things
    to the console with <code>std::cout</code>, <?php class_link("Packet")?> will take care of endianess
    and other details for you.
</p>
<pre><code class="cpp">// Insertion

sf::Int8    x = 24;
std::string s = "hello";
float       f = 59864.265f;

sf::Packet ToSend;
ToSend &lt;&lt; x &lt;&lt; s &lt;&lt; f;
...
</code></pre>
<pre><code class="cpp">// Extraction

sf::Packet Received;
...
sf::Int8    x;
std::string s;
float       f;
Received &gt;&gt; x &gt;&gt; s &gt;&gt; f;
</code></pre>
<p>
    Unlike writing, reading from a packet can fail if we try to read more bytes than the packet contains. In such case,
    the reading will fail and the packet will be set in an invalid state. To check the state of a packet you can test it
    directly (<code>if (Received)</code>) or, even better, you can test the reading (<code>if (Received >> x >> y)</code>).
</p>
<pre><code class="cpp">Received &gt;&gt; x &gt;&gt; s &gt;&gt; f;
if (!Received)
{
    // Error... data couldn't be read
}

// Or

if (!(Received &gt;&gt; x &gt;&gt; s &gt;&gt; f))
{
    // Error... data couldn't be read
}
</code></pre>
<p>
    Sending and receiving a packet is just like sending and receiving an array of bytes :
</p>
<pre><code class="cpp">// With TCP sockets

Socket.Send(Packet);
Socket.Receive(Packet);
</code></pre>
<pre><code class="cpp">// With UDP sockets

Socket.Send(Packet, Address, Port);
Socket.Receive(Packet, Address);
</code></pre>

<?php h2('Packets and custom classes') ?>
<p>
    As with standard streams, it is possible to extend packets to handle your custom classes. To
    allow insertion and extraction of an instance of a custom class into a <?php class_link("Packet")?>,
    define the right versions of the &lt;&lt; and &gt;&gt; operators :
</p>
<pre><code class="cpp">struct Character
{
    sf::Uint8   Age;
    std::string Name;
    float       Height;
};

sf::Packet&amp; operator &lt;&lt;(sf::Packet&amp; Packet, const Character&amp; C)
{
    return Packet &lt;&lt; C.Age &lt;&lt; C.Name &lt;&lt; C.Height;
}

sf::Packet&amp; operator &gt;&gt;(sf::Packet&amp; Packet, Character&amp; C)
{
    return Packet &gt;&gt; C.Age &gt;&gt; C.Name &gt;&gt; C.Height;
}
</code></pre>
<p>
    Both operators return a reference to the packet : this is to allow chaining calls.
</p>
<p>
    Now you can insert and extract instances of your class just like primitive types :
</p>
<pre><code class="cpp">Character Bob;
sf::Packet Packet;

Packet &lt;&lt; Bob;
Packet &gt;&gt; Bob;
</code></pre>

<?php h2('Customized packets') ?>
<p>
    To allow even more customization, <?php class_link("Packet")?> is extensible. This means that you can build
    your own classes of packets, and customize the data that will be sent and received. To allow this,
    <?php class_link("Packet")?> defines two virtual functions :
</p>
<ul>
    <li><code>OnSend</code>, that will be called to retrieve the data to send</li>
    <li><code>OnReceive</code>, that will be called to fill the packet with received data</li>
</ul>
<p>
    These functions allow a derived class to change what will be sent, or what will be read after
    reception. Here is a simple example with encryption :
</p>
<pre><code class="cpp">class EncryptedPacket : public sf::Packet
{
private :

    virtual const char* OnSend(std::size_t&amp; DataSize)
    {
        // Copy the internal data of the packet into our destination buffer
        myBuffer.assign(GetData(), GetData() + GetDataSize());

        // Encrypt (powerful algorithm : add 1 to each character !)
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i += 1;

        // Return the size of encrypted data, and a pointer to the buffer containing it
        DataSize = myBuffer.size();
        return &amp;myBuffer[0];
    }

    virtual void OnReceive(const char* Data, std::size_t DataSize)
    {
        // Copy the received data into our destination buffer
        myBuffer.assign(Data, Data + DataSize);

        // Decrypt data using our powerful algorithm
        for (std::vector&lt;char&gt;::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i -= 1;

        // Fill the packet with the decrypted data
        Append(&amp;myBuffer[0], myBuffer.size());
    }

    std::vector&lt;char&gt; myBuffer;
};
</code></pre>
<p>
    The <code>GetData()</code> function gives a read access to the internal buffer, so you can
    use it if needed. <code>GetDataSize()</code> gives the number of bytes in the buffer.
    To modify or append special data to the buffer, you can then use the <code>Clear()</code> function
    (to clear the internal buffer), <code>Append()</code> (to add raw data), or the &lt;&lt; operator.
</p>
<p>
    Custom packets can be useful in many situations : encryption, compression, adding checksums, filtering received
    data, ...
    You can even provide formatted packets using a fixed structure, or packets that
    act like factories.
</p>

<?php h2('Conclusion') ?>
<p>
    The <?php class_link("Packet")?> class wraps a lot of low-level network issues, and provides an easy way
    to transfer data with sockets. I encourage you to extend packets to your needs, by overloading
    &lt;&lt; and &gt;&gt; operators, and deriving your own packets classes if necessary.
</p>
<p>
    It is important to remember that SFML packets use their own endianess and structure, so you cannot use
    them to communicate with servers that are not using them. To send raw data, HTTP / FTP requests,
    or whatever not built with SFML, use arrays of bytes instead of SFML packets.
</p>
<p>
    You are now ready to jump to the last tutorial, about
    <a class="internal" href="./network-selector.php" title="Go to the next tutorial">using selectors</a>.
</p>

<?php

    require("footer.php");

?>
