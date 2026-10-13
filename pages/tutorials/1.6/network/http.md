# Using HTTP

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/network/http/).

## Introduction

HTTP (HyperText Transfer Protocol) is the protocol which is used to transfer files through internet: web pages, images, etc. It consists of a client-server architecture where the client sends requests, and the server sends back responses containing the requested resources.

SFML provides a class which implements a HTTP client: [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation").

## Requests

An HTTP request in SFML is represented by the [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation") class. It contains five members:

- A method, which is the action to execute; it can be one of the following values:
    - `sf::Http::Request::Get`: gets the specified resource (page, image, etc.)
    - `sf::Http::Request::Post`: sends the specified content to the server
    - `sf::Http::Request::Head`: gets only the header of the specified resource, without its body
- A target URI, which is the resource to get if the method is `Get` or `Head`, or the page to send the content to, if the method is `Post`; this URI is relative to the host address (see later)
- A body, which is the content to send if the method is `Post`; it is ignored if the method is `Get` or `Head`
- An HTTP version, which is used by the server to identify which version of the protocol the client is using; this version is 1.0 if you don't explicitely change it (which will work in most situations)
- A set of &lt;name, value> pairs, which represent options to pass to the server; some of them are mandatory (like "Host", "From", "Content-Length") but SFML takes care of filling them if you don't do it

Each of these five members can be set through an accessor of the [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation"):

```cpp
sf::Http::Request Request;
Request.SetMethod(sf::Http::Request::Get);
Request.SetURI("/");
Request.SetBody("");
Request.SetHttpVersion(1, 0);
Request.SetField("From", "my_email@gmail.com");
```

Note that all these members have a correct default value; SFML always makes sure that your requests are well-formed so that you can focus on the important parameters (most likely the target URI).  
This request could thus be simplified to the following piece of code:

```cpp
sf::Http::Request Request;
Request.SetURI("/");
```

## Responses

After sending a request (we'll see that in the next section), you receive a response from the server. Such a response is represented by the [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation") class in SFML.

A response consists of four members:

- A status code which informs about the success or failure of the operation
- A body, which is the content of the requested resource; if the requested resource is a web page, it contains the HTML code of the page. It can also be empty or contain the HTML code of an error page, if the operation failed
- An HTTP version, which is the one used by the server
- A set of &lt;name, value> pairs, which represent various informations about the server which are passed back to the client

All these members can be read through accessors of the [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation") class:

```cpp
sf::Http::Response Response;
...
sf::Http::Response::Status Status = Response.GetStatus();
unsigned int Major = Response.GetMajorHttpVersion();
unsigned int Minor = Response.GetMinorHttpVersion();
std::string Body = Response.GetBody();
std::string Type = Response.GetField("Content-Type");
```

Statuses are described in the `sf::Http::Response::Status` enumeration. There are multiple success codes, but the most common one is `sf::Http::Response::Ok`.

## Putting it all together

Now that you can write requests and read responses, you only need to know two more things: connecting to an HTTP server, and sending requests.

Connection to a server can be done through the `SetHost` function:

```cpp
sf::Http Http;
Http.SetHost("www.whatismyip.org");
```

In fact, this function does nothing more than storing the host name, the actual connection is done each time you send a request, and is closed after receiving the response. This is why this function is called `SetHost` rather than `Connect`.

This function can accept an additionnal parameter: the network port to use for connection. If you don't explicitely specify it, SFML will just use the default port associated to the protocol: 80 for HTTP, and 443 for HTTPS.

Once the host server is set, you can send requests with the `SendRequest` function:

```cpp
sf::Http::Response Response = Http.SendRequest(Request);
```

This function takes an argument of type [`sf::Http::Request`](../../../documentation/1.6/classsf_1_1Http_1_1Request.html "sf::Http::Request documentation"), and returns an instance of [`sf::Http::Response`](../../../documentation/1.6/classsf_1_1Http_1_1Response.html "sf::Http::Response documentation").

That's all for the interface of the [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation") class, only two functions! There's no need to explicitely disconnect from the server, as the connection is automatically closed after each call to `SendRequest`

## Conclusion

The [`sf::Http`](../../../documentation/1.6/classsf_1_1Http.html "sf::Http documentation") class is a powerful tool for manipulating the HTTP protocol, and access web page or files through internet.  
Let's now have a look at its friend, the [FTP protocol](ftp.md "Go to the next tutorial").
