<?php

    $title = "Using HTTP";
    $page = "network-http.php";

    require("header.php");
?>

<h1>Using HTTP</h1>

<?php h2('Introduction') ?>
<p>
    HTTP (HyperText Transfer Protocol) is the protocol which is used to transfer files through internet:
    web pages, images, etc. It consists of a client-server architecture where the client sends requests, and the server
    sends back responses containing the requested resources.
</p>
<p>
    SFML provides a class which implements a HTTP client: <?php class_link("Http")?>.
</p>

<?php h2('Requests') ?>
<p>
    An HTTP request in SFML is represented by the <?php class_link("Http::Request", "Http_1_1Request")?> class. It contains
    five members:
</p>
<ul>
    <li>A method, which is the action to execute; it can be one of the following values:
        <ul>
            <li><code>sf::Http::Request::Get</code>: gets the specified resource (page, image, etc.)</li>
            <li><code>sf::Http::Request::Post</code>: sends the specified content to the server</li>
            <li><code>sf::Http::Request::Head</code>: gets only the header of the specified resource, without its body</li>
        </ul>
    </li>
    <li>A target URI, which is the resource to get if the method is <code>Get</code> or <code>Head</code>,
    or the page to send the content to, if the method is <code>Post</code>; this URI is relative to the host address
    (see later)</li>
    <li>A body, which is the content to send if the method is <code>Post</code>; it is ignored if the method is
    <code>Get</code> or <code>Head</code></li>
    <li>An HTTP version, which is used by the server to identify which version of the protocol the client is using; this
    version is 1.0 if you don't explicitely change it (which will work in most situations)</li>
    <li>A set of &lt;name, value&gt; pairs, which represent options to pass to the server; some of them are mandatory
    (like "Host", "From", "Content-Length") but SFML takes care of filling them if you don't do it</li>
</ul>
<p>
    Each of these five members can be set through an accessor of the <?php class_link("Http::Request", "Http_1_1Request")?>:
</p>
<pre><code class="cpp">sf::Http::Request Request;
Request.SetMethod(sf::Http::Request::Get);
Request.SetURI("/");
Request.SetBody("");
Request.SetHttpVersion(1, 0);
Request.SetField("From", "my_email@gmail.com");
</code></pre>
<p>
    Note that all these members have a correct default value; SFML always makes sure that your requests are well-formed
    so that you can focus on the important parameters (most likely the target URI).<br/>
    This request could thus be simplified to the following piece of code:
</p>
<pre><code class="cpp">sf::Http::Request Request;
Request.SetURI("/");
</code></pre>

<?php h2('Responses') ?>
<p>
    After sending a request (we'll see that in the next section), you receive a response from the server. Such a response
    is represented by the <?php class_link("Http::Response", "Http_1_1Response")?> class in SFML.
</p>
<p>
    A response consists of four members:
</p>
<ul>
    <li>A status code which informs about the success or failure of the operation</li>
    <li>A body, which is the content of the requested resource; if the requested resource is a web page, it contains
    the HTML code of the page. It can also be empty or contain the HTML code of an error page, if the operation failed</li>
    <li>An HTTP version, which is the one used by the server</li>
    <li>A set of &lt;name, value&gt; pairs, which represent various informations about the server which are passed back to
    the client</li>
</ul>
<p>
    All these members can be read through accessors of the <?php class_link("Http::Response", "Http_1_1Response")?> class:
</p>
<pre><code class="cpp">sf::Http::Response Response;
...
sf::Http::Response::Status Status = Response.GetStatus();
unsigned int Major = Response.GetMajorHttpVersion();
unsigned int Minor = Response.GetMinorHttpVersion();
std::string Body = Response.GetBody();
std::string Type = Response.GetField("Content-Type");
</code></pre>
<p>
    Statuses are described in the <code>sf::Http::Response::Status</code> enumeration. There are multiple success codes,
    but the most common one is <code>sf::Http::Response::Ok</code>.
</p>

<?php h2('Putting it all together') ?>
<p>
    Now that you can write requests and read responses, you only need to know two more things: connecting to an HTTP
    server, and sending requests.
</p>
<p>
    Connection to a server can be done through the <code>SetHost</code> function:
</p>
<pre><code class="cpp">sf::Http Http;
Http.SetHost("www.whatismyip.org");
</code></pre>
<p>
    In fact, this function does nothing more than storing the host name, the actual connection is done each
    time you send a request, and is closed after receiving the response. This is why this function is called
    <code>SetHost</code> rather than <code>Connect</code>.
</p>
<p>
    This function can accept an additionnal parameter: the network port to use for connection. If you don't
    explicitely specify it, SFML will just use the default port associated to the protocol: 80 for HTTP, and 443
    for HTTPS.
</p>
<p>
    Once the host server is set, you can send requests with the <code>SendRequest</code> function:
</p>
<pre><code class="cpp">sf::Http::Response Response = Http.SendRequest(Request);
</code></pre>
<p>
    This function takes an argument of type <?php class_link("Http::Request", "Http_1_1Request")?>, and returns
    an instance of <?php class_link("Http::Response", "Http_1_1Response")?>.
</p>
<p>
    That's all for the interface of the <?php class_link("Http")?> class, only two functions! There's no need to
    explicitely disconnect from the server, as the connection is automatically closed after each call to
    <code>SendRequest</code>
</p>

<?php h2('Conclusion') ?>
<p>
    The <?php class_link("Http")?> class is a powerful tool for manipulating the HTTP protocol, and access web page or files
    through internet.<br/>
    Let's now have a look at its friend, the
    <a class="internal" href="./network-ftp.php" title="Go to the next tutorial">FTP protocol</a>.
</p>

<?php

    require("footer.php");

?>
