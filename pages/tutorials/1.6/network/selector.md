# Using a selector

## Introduction

As you've seen in the previous tutorial, some socket functions (`Accept`, `Receive`) are blocking, meaning that they will stop the whole program if they are used. Also meaning that you will never be able to wait for two different sockets at the same time. One good solution is to use threads : put the blocking socket calls into a separate thread, and your program will still be able to run while the sockets are waiting. But using threads is not easy : it requires good synchronization, can be hard to debug, and can add some overhead if you run a lot of threads.

The other solution is to use selectors. Selectors allow multiplexing on a set of sockets, without having to run another thread. They are still blocking, but they return as soon as at least one of the sockets is ready. Selectors can also use a timeout value, to avoid waiting indefinitely.

## Handling multiple clients

There are two types of selectors in SFML : [`sf::SelectorTCP`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Selector.php "sf::SelectorTCP documentation") (for TCP sockets) and [`sf::SelectorUDP`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Selector.php "sf::SelectorUDP documentation") (for UDP sockets). However only the type of socket is different, the functions and behavior are exactly the same for both classes.

So, let's try to use a TCP selector. Here we'll build a server that will be able to handle several clients at the same time, without using any thread.

```cpp
#include <SFML/Network.hpp>

sf::SelectorTCP Selector;
```

Selectors act like arrays : you can `Add` and `Remove` sockets, or `Clear` them. Here we will add all our sockets, as we want to be notified when any client is sending something.

Before adding any client into the selector, remember that you must use a listening socket, to wait for incoming connections. As accepting a connection is blocking, we will have to put the listener into the selector, too.

```cpp
sf::SocketTCP Listener;
if (!Listener.Listen(4567))
{
    // Error...
}

Selector.Add(Listener);
```

Then you can start an infinite loop that will receive both incoming connections, and messages from connected clients.  
To get the sockets that are ready from the selector, you just have to call its `Wait` function, followed by `GetSocketReady` :

```cpp
while (true)
{
    unsigned int NbSockets = Selector.Wait();

    for (unsigned int i = 0; i < NbSockets; ++i)
    {
        sf::SocketTCP Socket = Selector.GetSocketReady(i);

        // Do something with Socket...
    }
}
```

`Wait` can take an optional parameter, which is a timeout value in seconds (if you need to use it).

Please note that each time you call `Wait`, the selector will wait for at least one socket to be ready. So if you call it twice in a loop, don't expect the second call to return instantly, or to get the same sockets.

Let's take a look at what goes inside the loop. Obviously, we'll call `Receive` on our socket, as it is supposed to be ready to receive. But don't forget that our listening socket is also contained in the selector, and if it is ready, we'll have to accept a connection instead of receving a packet. And if a new client connects, we must add the new socket to the selector.

```cpp
The loop from above...
{
    // Get the current socket
    sf::SocketTCP Socket = Selector.GetSocketReady(i);;

    if (Socket == Listener)
    {
        // If the listening socket is ready, it means that we can accept a new connection
        sf::IPAddress Address;
        sf::SocketTCP Client;
        Listener.Accept(Client, &Address);
        std::cout << "Client connected ! (" << Address << ")" << std::endl;

        // Add it to the selector
        Selector.Add(Client);
    }
    else
    {
        // Else, it is a client socket so we can read the data he sent
        sf::Packet Packet;
        if (Socket.Receive(Packet) == sf::Socket::Done)
        {
            // Extract the message and display it
            std::string Message;
            Packet >> Message;
            std::cout << "A client says : \"" << Message << "\"" << std::endl;
        }
        else
        {
            // Error : we'd better remove the socket from the selector
            Selector.Remove(Socket);
        }
    }
}
```

The code for the client is straight-forward : it connects to the server, gets input from the user and sends it to the server. All is included in the downloadable source code.

## A "receive-with-timeout" function

As a selector can use a timeout, and as there is no problem putting only one socket into it, we can use it to build a receive function that takes a timeout as an extra parameter. It can be useful for implementing a ping function, to check if a client is still connected.

```cpp
bool ReceiveWithTimeout(sf::SocketTCP Socket, sf::Packet& Packet, float Timeout = 0)
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
```

## Conclusion

Selectors are a useful tool for multi-client applications, and are often much more convenient than running multiple threads. Don't hesitate to use them.
