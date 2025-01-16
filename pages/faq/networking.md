---
hide:
  - footer
---

# Networking

## How do I create <insert popular application type here>? {: #create-network-app}

The first thing you need to do is understand how the underlying networking of said application works.
Behind every complex looking application there is a simple system of how systems send data to each other and what kind of data they send.

There are 2 kinds of topologies:

- Client-Server
- Client-Client (Peer-to-Peer)

Client-Server is generally easier to set up and often achieves higher performance than Client-Client due to the fact that dedicated servers are already configured to handle a large amount of traffic from multiple connected systems.
When running a server application you can also be sure that clients can not manipulate the game state (cheat) themselves unless they have direct access to the server and can execute things there (which requires logging in etc.).

When running in a Client-Client configuration, the first thing to overcome is the initial connection establishment.
Home/Office gateways/routers are mostly configured by default to not accept any incoming connection requests.
As such none of the sides can establish a connection to the other.
There is a way of overcoming this called [NAT hole punching](https://en.wikipedia.org/wiki/Hole_punching_(networking)), however this is beyond the scope of this FAQ.
Care has to be taken to ensure that nobody is able to cheat in this topology.
This is usually done by mirroring the game state across all involved systems and performing checks and synchronization at every game step.

Once you have picked a suitable topology for your application, you can start to think about what kind of data you want to send between the systems.
There is no general answer or recommendation for this as this is very application specific and you will have to rely on good judgment to make the right choices.

## Should I use TCP or UDP sockets? {: #tcp-vs-udp}

One must first understand what the difference is between TCP and UDP.

TCP is connection based and provides **reliable and ordered delivery of data** from one endpoint to the other.
Connection based means you need to establish a TCP connection before you can make use of it for data transfer.
It takes care of everything you can possibly think of (and might not think of) except creating and using the data that it sends and receives, that is still your task.
Simply put, when you have an established TCP connection, whatever you shove into one end will in almost all cases come out the other end, in the right order, even over very very bad internet connections.
If it doesn't arrive at the other end, both sides will be notified of the error and can perform the necessary error recovery.
This comes at a price however, TCP packet headers are **at least 20 bytes and at most 60 bytes** large.
This means that if you send a packet containing 1 byte over a TCP connection, your network adapter will need to transmit at least 21 bytes to get the data to the other end (disregarding the overhead from the lower OSI layers which is always present both in TCP and UDP).
Also note that TCP streams are bi-directional, meaning you can use them to send and receive data in both directions, there is no need to create 2 separate TCP connections to transfer data between 2 endpoints (unless the data streams have different purposes and you want to separate them at the transport layer).

UDP provides **unreliable delivery of data** from one endpoint to the other.
It is not connection based and **does not guarantee anything**.
This means that if you are unlucky, you might not receive what you send, what you send might be received in a different order than the order you sent in or you might even receive duplicates of what you sent.
In case of a transfer failure UDP also won't notify you that anything happened, it is completely up to you to take care of detecting and handling all these cases.
The advantage of UDP is that its **header size is always 8 bytes (40% of TCP)** so if you send very small packets very often, you can save a lot of bandwidth if you use UDP.
At larger packet sizes the header overhead is amortized and both protocols are just as efficient bandwidth-wise as the other.
In the case of UDP, because there is no concept of a connection, it is your responsibility to keep track of who is sending and receiving what data because in general a server will only bind a single UDP socket with which all clients will send data to (unless they open up a new socket per client).
You can also send data to multiple clients over one UDP socket because you always have to specify the destination of a datagram.

You might be wondering: "Woah! Who would even use UDP instead of TCP? There are so many disadvantages."

Well... If you implement your own reliable transport protocol on top of UDP, you can consider it as a form of "fine-tuned TCP" that does exactly what you want and no more.
You could reduce the communication overhead considerably and even have the advantage that UDP traffic generally gets processed faster when traveling over the internet, which means lower latency.
This is the reason why many latency critical applications choose to use UDP instead of TCP.

If you are developing your first networked application, stick with TCP as long as you can.
Bandwidth and latency issues will not be your biggest concern until you are sure you can make money off it.
Once that time comes, you will have gained so much experience that the decision will be trivial.

## Should I use blocking or non-blocking sockets? And how do selectors work? {: #blocking-non-blocking-selectors}

It depends on what kind of an application you are developing and what your preference is.
If you are just beginning to learn network programming, you can use blocking sockets when writing your first echo server (a server that waits for data to be received and instantly sends back a response).
In this case the server does not do anything else but reply to incoming data and as such can block as much as it wants.

If, however, the server has other duties as well, such as updating an internal state every frame, blocking the state update thread must be avoided at all costs.
This means, either you block in a separate thread, you call blocking operations **when you know they should not block** using selectors or you just use non-blocking sockets.

Because creating a separate thread for each blocking socket can result in a large amount of threads created, this method is not recommended unless you are sure that the number of expected connections stays manageable.

Using non-blocking sockets might seem the easiest at first, but one must consider that every time you poll the socket for new data, you are making numerous operating system calls which means a lot of overhead just to determine if the socket could be read or not.
Even at a moderate number of sockets, this can become quite expensive.
This is why selectors exist.

To solve the previous problem, operating systems provide methods of polling a large number of resources for their readiness simultaneously or at least in a very efficient manner.
The principle idea is that you tell the operating system which resources you want to monitor and it sets the respective field within the selector when that resource becomes ready.
That way you only have to check if the field is set, and the operating system only sets the field when something really does happen thus resulting in a very efficient way of checking for readiness.
The `sf::SocketSelector` in SFML wraps all this functionality.
You can ask the selector if a socket is ready and it will perform all the low level operations for you.

The most universal choice is using selectors and blocking sockets, as they are suitable for any scenario with little to no drawbacks.
Many high performance applications still use selectors nowadays although there newer ways are constantly being developed to do the same which are just a bit more efficient.

## I can't connect to the other computer over the internet! {: #internet-network}

This is probably one of the hardest "problems" to solve, as the number of error sources is quite high (up to the point where you aren't even responsible for the error yourself).

Since there is no general solution to this problem, here is a list of things you can check:

1. Make sure that it isn't just a programming error.
   Read the documentation and assure that what you are trying to achieve is reflected in your code.
2. Make sure that the addresses you use are correct.
   There are 3 ways you can identify an endpoint.
   Obviously if you want to address an endpoint that isn't part of your local network you can not use the first option.
    - By private address e.g. 192.168.1.1 (192.168._._, 10._._.* and 172.16._._ to 172.31._._ are all private networks)
    - By public address e.g. 123.123.123.123
    - By FQDN (Fully-Qualified Domain Name) e.g. www.sfml-dev.org (www is the _hostname_ and sfml-dev.org is the _domain name_)
3. Make sure that data transmission is not hindered by anything in the networking infrastructure (routers, firewalls etc.), if you are not sure about this, it most likely means that the port you are trying to use is either closed or not configured to be forwarded behind a NAT.
4. Make sure that data is really being sent and received by the hosts independent of your application.
   It might occur that you try to send data within your application, SFML doesn't report an error, but the operating system refuses to transmit it.
   To check if this problem exists, it is recommended that you install some form of packet capturing software such as [Wireshark](https://www.wireshark.org/) on both systems.
5. Make sure that the data leaves the local network over the router.
   There is a possibility that the router blocks outgoing data as well.
6. Make sure that the data arrives at the destination network router and is properly forwarded.
   If you are sure that the data leaves the origin network but never arrives at the destination network, try using a different port.
   Some ISPs have policies that block traffic from certain software and because they are not interested in using a better filtering mechanism, they decide to block the whole port instead of only traffic that really stems from the    specific software.
   If you happen to use one of those ports, you are unlucky and should just try another.
7. If you are sure that the port you use isn't blocked, in very very rare cases it might be an error somewhere on the way from the source the the destination within some ISPs network.
   If this is really the case, you are as good as out of luck and should just try again at another time or be prepared to make a lot of phone calls with a lot of uninterested people.
8. If the ISP assures you that there is nothing wrong with their network, you must always take this with a pinch of salt because unless they contractually bind themselves to what they say, it might have been just to make you end the call.
9. When all else fails, you can always come to the SFML forum and ask for help there.
