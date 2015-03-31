<?php

    $title = "Web requests with HTTP";
    $page = "network-http.php";

    require("header.php");

?>

<h1>Web requests with HTTP</h1>

<?php h2('Introduction') ?>
<p>
    SFML provides a simple HTTP client class, so that you can communicate with web servers. "Simple" means that it supports the most basic features of HTTP: POST, GET and
    HEAD request types, accessing HTTP header fields, and reading/writing the pages body.
</p>
<p>
    If you need more advanced features, such as secured HTTP (HTTPS) for example, you'd better use a true HTTP library, like libcurl or cpp-netlib.
</p>
<p>
    But for basic interaction between a program and a web server, it should be enough.
</p>

<?php h2('sf::Http') ?>
<p>
    To communicate with a HTTP server you must use the <?php class_link("Http") ?> class.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::Http http;
http.setHost("http://www.some-server.org/");

// or
sf::Http http("http://www.some-server.org/");
</code></pre>
<p>
    Note that setting the host doesn't trigger any connection: a temporary connection is made later for each request.
</p>
<p>
    There's only one more function in <?php class_link("Http") ?>, which sends requests. This is basically all that the class does.
</p>
<pre><code class="cpp">sf::Http::Request request;
// fill the request...
sf::Http::Response response = http.sendRequest(request);
</code></pre>

<?php h2('Requests') ?>
<p>
    A HTTP request, represented by the <?php class_link("Http::Request") ?> class, contains the following information:
</p>
<ul>
    <li>The method: POST (send content), GET (retrieve a resource), HEAD (retrieve a resource header, without its body)</li>
    <li>The URI: the address of the resource (page, image, ...) to get/post, relatively to the host</li>
    <li>The HTTP version (it is 1.0 by default but you can choose a different version if you use specific features)</li>
    <li>The header: a set of fields with key and value</li>
    <li>The body of the page (used only with the POST method)</li>
</ul>
<pre><code class="cpp">sf::Http::Request request;
request.setMethod(sf::Http::Request::Post);
request.setUri("/page.html");
request.setHttpVersion(1, 1); // HTTP 1.1
request.setField("From", "me");
request.setField("Content-Type", "application/x-www-form-urlencoded");
request.setBody("para1=value1&amp;param2=value2");

sf::Http::Response response = http.sendRequest(request);
</code></pre>
<p>
    SFML automatically fills mandatory header fields, such as "Host", "Content-Length", etc. You can send your requests without worrying about that, SFML will do its best
    to make them valid.
</p>

<?php h2('Responses') ?>
<p>
    If the <?php class_link("Http") ?> class could successfully connect to the host and send the request, a response is sent back and returned to the user, encapsulated in an
    instance of the <?php class_link("Http::Response") ?> class. Responses contain the following members:
</p>
<ul>
    <li>A status code, which precisely indicates how the server processed the request (ok, redirected, not found, etc.)</li>
    <li>The HTTP version of the server</li>
    <li>The header: a set of fields with key and value</li>
    <li>The body of the response</li>
</ul>
<pre><code class="cpp">sf::Http::Response response = http.sendRequest(request);
std::cout &lt;&lt; "status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "HTTP version: " &lt;&lt; response.getMajorHttpVersion() &lt;&lt; "." &lt;&lt; response.getMinorHttpVersion() &lt;&lt; std::endl;
std::cout &lt;&lt; "Content-Type header:" &lt;&lt; response.getField("Content-Type") &lt;&lt; std::endl;
std::cout &lt;&lt; "body: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
</code></pre>
<p>
    The status code can be used to check whether the request was successfully processed or not: codes 2xx are ok, codes 3xx inform of a redirection, codes 4xx are client
    errors, codes 5xx are server errors, and codes 10xx are SFML specific errors, not defined in the HTTP standard.
</p>

<?php h2('Example: sending scores to an online server') ?>
<p>
    Here is a short example that demonstrates how to do a common task: sending a score to an online database.
</p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;
#include &lt;sstream&gt;

void sendScore(int score, const std::string&amp; name)
{
    // prepare the request
    sf::Http::Request request("/send-score.php", sf::Http::Request::Post);

    // encode the parameters in the request body
    std::ostringstream stream;
    stream &lt;&lt; "name=" &lt;&lt; name &lt;&lt; "&amp;score=" &lt;&lt; score;
    request.setBody(stream.str());

    // send the request
    sf::Http http("http://www.myserver.com/");
    sf::Http::Response response = http.sendRequest(request);

    // check the status
    if (response.getStatus() == sf::Http::Response::Ok)
    {
        // check the contents of the response
        std::cout &lt;&lt; response.getBody() &lt;&lt; std::endl;
    }
    else
    {
        std::cout &lt;&lt; "request failed" &lt;&lt; std::endl;
    }
}
</code></pre>
<p>
    Of course, this is a very simple way to handle online scores. There's no protection: anybody could send a false score easily. A more robust approach would probably
    involve an extra parameter, like a hash code that ensures that the request was sent by the program. But it is out of the scope of this tutorial.
</p>
<p>
    And finally, here is a very simplistic example of what the PHP page on server side could be.
</p>
<pre><code class="php">&lt;?php
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
?&gt;
</code></pre>

<?php

    require("footer.php");

?>
