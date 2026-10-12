# Using and extending packets

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/network/packet/).

## Introduction

Data exchange through a network can be more complicated than it seems. Everything may look cool when you test your application with your own computer as both the client and the server, but when you deal with internet and different platforms, several issues can arise.

The first one is endianess. Endianess is the order in which a particular platform will store the bytes of a primitive type. There are two main families of platform : big-endian (most significant byte first - MSB), and little endian (least significant byte first - LSB). Some exotic platforms may also use bi-endian or mixed-endian, two other forms of byte storage.  
To come back to network data transfer, let's imagine that you send a 16-bit integer as little-endian (your processor is an Intel x86 for example), and the server receives it and interprets it as big-endian (its processor is an Apple PowerPC for example) ; if you send 48 (00000000 00110000) the server will actually see 768 (00000011 00000000).

Another problem is primitive types sizes. Different platforms can have different sizes for the same type. If the size of a `long int` is 32-bit on your platform, maybe it will be 64-bit on the server, and again, the received data won't be interpreted properly.

The third problem is more network related. Data transfers through TCP and UDP protocols must follow some rules defined by the lower levels of implementation. In particular, a chunk of data can be split and received in several parts ; the receiver must then find a way to recompose the chunk and return data as if it was received in once.

These are the most common problems involved in network programming, but there are a lot more do deal with if you want to build robust programs. To help you with these low-level tasks, SFML provides a class for manipulating network data through packets : [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation").

## Primitive types

Like I just said earlier, primitive C++ types such as `unsigned int`, `long`, etc. have a size which is not fixed and may vary depending on the platform. As a consequence, it's inappropriate to use them for sending data over the network, as there's no control on what size will be sent and received. Unfortunately, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") can't solve this issue automatically, there's still a moment where you must explicitely tell the expected size of a primitive type. To do so, the best solution is to use SFML's fixed size types : `sf::Int8`, `sf::Uint16`, `sf::Int32`, etc. Those types are guaranteed to have the intended size on any platform.

So this is one thing you should never forget : always use fixed size types for structures you want to send over the network, either directly or via a cast just before sending / after receiving.

## Basic usage

Just like standard I/O, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") allow easy insertion and extraction through the << and >> operators. You can build a packet of data just like you write things to the console with `std::cout`, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") will take care of endianess and other details for you.

```cpp
// Insertion

sf::Int8    x = 24;
std::string s = "hello";
float       f = 59864.265f;

sf::Packet ToSend;
ToSend << x << s << f;
...
```

```cpp
// Extraction

sf::Packet Received;
...
sf::Int8    x;
std::string s;
float       f;
Received >> x >> s >> f;
```

Unlike writing, reading from a packet can fail if we try to read more bytes than the packet contains. In such case, the reading will fail and the packet will be set in an invalid state. To check the state of a packet you can test it directly (`if (Received)`) or, even better, you can test the reading (`if (Received >> x >> y)`).

```cpp
Received >> x >> s >> f;
if (!Received)
{
    // Error... data couldn't be read
}

// Or

if (!(Received >> x >> s >> f))
{
    // Error... data couldn't be read
}
```

Sending and receiving a packet is just like sending and receiving an array of bytes :

```cpp
// With TCP sockets

Socket.Send(Packet);
Socket.Receive(Packet);
```

```cpp
// With UDP sockets

Socket.Send(Packet, Address, Port);
Socket.Receive(Packet, Address);
```

## Packets and custom classes

As with standard streams, it is possible to extend packets to handle your custom classes. To allow insertion and extraction of an instance of a custom class into a [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation"), define the right versions of the << and >> operators :

```cpp
struct Character
{
    sf::Uint8   Age;
    std::string Name;
    float       Height;
};

sf::Packet& operator <<(sf::Packet& Packet, const Character& C)
{
    return Packet << C.Age << C.Name << C.Height;
}

sf::Packet& operator >>(sf::Packet& Packet, Character& C)
{
    return Packet >> C.Age >> C.Name >> C.Height;
}
```

Both operators return a reference to the packet : this is to allow chaining calls.

Now you can insert and extract instances of your class just like primitive types :

```cpp
Character Bob;
sf::Packet Packet;

Packet << Bob;
Packet >> Bob;
```

## Customized packets

To allow even more customization, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") is extensible. This means that you can build your own classes of packets, and customize the data that will be sent and received. To allow this, [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") defines two virtual functions :

- `OnSend`, that will be called to retrieve the data to send
- `OnReceive`, that will be called to fill the packet with received data

These functions allow a derived class to change what will be sent, or what will be read after reception. Here is a simple example with encryption :

```cpp
class EncryptedPacket : public sf::Packet
{
private :

    virtual const char* OnSend(std::size_t& DataSize)
    {
        // Copy the internal data of the packet into our destination buffer
        myBuffer.assign(GetData(), GetData() + GetDataSize());

        // Encrypt (powerful algorithm : add 1 to each character !)
        for (std::vector<char>::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i += 1;

        // Return the size of encrypted data, and a pointer to the buffer containing it
        DataSize = myBuffer.size();
        return &myBuffer[0];
    }

    virtual void OnReceive(const char* Data, std::size_t DataSize)
    {
        // Copy the received data into our destination buffer
        myBuffer.assign(Data, Data + DataSize);

        // Decrypt data using our powerful algorithm
        for (std::vector<char>::iterator i = myBuffer.begin(); i != myBuffer.end(); ++i)
            *i -= 1;

        // Fill the packet with the decrypted data
        Append(&myBuffer[0], myBuffer.size());
    }

    std::vector<char> myBuffer;
};
```

The `GetData()` function gives a read access to the internal buffer, so you can use it if needed. `GetDataSize()` gives the number of bytes in the buffer. To modify or append special data to the buffer, you can then use the `Clear()` function (to clear the internal buffer), `Append()` (to add raw data), or the << operator.

Custom packets can be useful in many situations : encryption, compression, adding checksums, filtering received data, ... You can even provide formatted packets using a fixed structure, or packets that act like factories.

## Conclusion

The [`sf::Packet`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Packet.php "sf::Packet documentation") class wraps a lot of low-level network issues, and provides an easy way to transfer data with sockets. I encourage you to extend packets to your needs, by overloading << and >> operators, and deriving your own packets classes if necessary.

It is important to remember that SFML packets use their own endianess and structure, so you cannot use them to communicate with servers that are not using them. To send raw data, HTTP / FTP requests, or whatever not built with SFML, use arrays of bytes instead of SFML packets.

You are now ready to jump to the last tutorial, about [using selectors](selector.md "Go to the next tutorial").
