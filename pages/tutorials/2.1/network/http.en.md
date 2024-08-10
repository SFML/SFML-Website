# Web requests with HTTP

## [Introduction](https://www.sfml-dev.org/tutorials/2.6/network-http.php#introduction)[](https://www.sfml-dev.org/tutorials/2.6/network-http.php#top "Top of the page")

SFML provides a simple HTTP client class which you can use to communicate with HTTP servers. "Simple" means that it supports the most basic features of HTTP: POST, GET and HEAD request types, accessing HTTP header fields, and reading/writing the pages body.

If you need more advanced features, such as secured HTTP (HTTPS) for example, you're better off using a true HTTP library, like libcurl or cpp-netlib.

For basic interaction between your program and an HTTP server, it should be enough.

## [sf::Http](https://www.sfml-dev.org/tutorials/2.6/network-http.php#sfhttp)[](https://www.sfml-dev.org/tutorials/2.6/network-http.php#top "Top of the page")

To communicate with an HTTP server you must use the [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0/classsf_1_1Http.php "sf::Http documentation") class.

```
#include <SFML/Network.hpp>

sf::Http http;
http.setHost("http://www.some-server.org/");

// or
sf::Http http("http://www.some-server.org/");
```

Note that setting the host doesn't trigger any connection. A temporary connection is created for each request.

The only other function in [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0/classsf_1_1Http.php "sf::Http documentation"), sends requests. This is basically all that the class does.

```
sf::Http::Request request;
// fill the request...
sf::Http::Response response = http.sendRequest(request);
```

## [Requests](https://www.sfml-dev.org/tutorials/2.6/network-http.php#requests)[](https://www.sfml-dev.org/tutorials/2.6/network-http.php#top "Top of the page")

An HTTP request, represented by the [`sf::Http::Request`](https://www.sfml-dev.org/documentation/2.6.0/classsf_1_1Http_1_1Request.php "sf::Http::Request documentation") class, contains the following information:

- The method: POST (send content), GET (retrieve a resource), HEAD (retrieve a resource header, without its body)
- The URI: the address of the resource (page, image, ...) to get/post, relative to the root directory
- The HTTP version (it is 1.0 by default but you can choose a different version if you use specific features)
- The header: a set of fields with key and value
- The body of the page (used only with the POST method)

```
sf::Http::Request request;
request.setMethod(sf::Http::Request::Post);
request.setUri("/page.html");
request.setHttpVersion(1, 1); // HTTP 1.1
request.setField("From", "me");
request.setField("Content-Type", "application/x-www-form-urlencoded");
request.setBody("para1=value1&param2=value2");

sf::Http::Response response = http.sendRequest(request);
```

SFML automatically fills mandatory header fields, such as "Host", "Content-Length", etc. You can send your requests without worrying about them. SFML will do its best to make sure they are valid.

## [Responses](https://www.sfml-dev.org/tutorials/2.6/network-http.php#responses)[](https://www.sfml-dev.org/tutorials/2.6/network-http.php#top "Top of the page")

If the [`sf::Http`](https://www.sfml-dev.org/documentation/2.6.0/classsf_1_1Http.php "sf::Http documentation") class could successfully connect to the host and send the request, a response is sent back and returned to the user, encapsulated in an instance of the [`sf::Http::Response`](https://www.sfml-dev.org/documentation/2.6.0/classsf_1_1Http_1_1Response.php "sf::Http::Response documentation") class. Responses contain the following members:

- A status code which precisely indicates how the server processed the request (OK, redirected, not found, etc.)
- The HTTP version of the server
- The header: a set of fields with key and value
- The body of the response

```
sf::Http::Response response = http.sendRequest(request);
std::cout << "status: " << response.getStatus() << std::endl;
std::cout << "HTTP version: " << response.getMajorHttpVersion() << "." << response.getMinorHttpVersion() << std::endl;
std::cout << "Content-Type header:" << response.getField("Content-Type") << std::endl;
std::cout << "body: " << response.getBody() << std::endl;
```

The status code can be used to check whether the request was successfully processed or not: codes 2xx represent success, codes 3xx represent a redirection, codes 4xx represent client errors, codes 5xx represent server errors, and codes 10xx represent SFML specific errors which are _not_ part of the HTTP standard.

## [Example: sending scores to an online server](https://www.sfml-dev.org/tutorials/2.6/network-http.php#example-sending-scores-to-an-online-server)[](https://www.sfml-dev.org/tutorials/2.6/network-http.php#top "Top of the page")

Here is a short example that demonstrates how to perform a simple task: Sending a score to an online database.

```
#include <SFML/Network.hpp>
#include <sstream>

void sendScore(int score, const std::string& name)
{
    // prepare the request
    sf::Http::Request request("/send-score.php", sf::Http::Request::Post);

    // encode the parameters in the request body
    std::ostringstream stream;
    stream << "name=" << name << "&score=" << score;
    request.setBody(stream.str());

    // send the request
    sf::Http http("http://www.myserver.com/");
    sf::Http::Response response = http.sendRequest(request);

    // check the status
    if (response.getStatus() == sf::Http::Response::Ok)
    {
        // check the contents of the response
        std::cout << response.getBody() << std::endl;
    }
    else
    {
        std::cout << "request failed" << std::endl;
    }
}
```

Of course, this is a very simple way to handle online scores. There's no protection: Anybody could easily send a false score. A more robust approach would probably involve an extra parameter, like a hash code that ensures that the request was sent by the program. That is beyond the scope of this tutorial.

And finally, here is a very simple example of what the PHP page on server might look like.

```
<?php
    $name = $_POST['name'];
    $score = $_POST['score'];
    
    if (write_to_database($name, $score)) // this is not a PHP tutorial :)
    {
        echo "name and score added!";
    }
    else
    {
        echo "failed to write name and score to database...";
    }
?>
```