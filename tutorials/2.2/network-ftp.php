<?php

    $title = "File transfers with FTP";
    $page = "network-ftp.php";

    require("header.php");

?>

<h1>File transfers with FTP</h1>

<?php h2('FTP for dummies') ?>
<p>
    If you know what FTP is, and just want to know how to use the FTP class that SFML provides, you can skip this section.
</p>
<p>
    FTP (<em>File Transfer Protocol</em>) is a simple protocol that allows manipulation of files and directories on a remote server. The protocol consists of commands such as "create
    directory", "delete file", "download file", etc. You can't send FTP commands to any remote computer, it needs to have an FTP server running which can understand and
    execute the commands that clients send.
</p>
<p>
    So what can you do with FTP, and how can it be helpful to your program? Basically, with FTP you can access existing remote file systems, or even create your own. This
    can be useful if you want your network game to download resources (maps, images, ...) from a server, or your program to update itself automatically when it's connected
    to the internet.
</p>
<p>
    If you want to know more about the FTP protocol, the
    <a class ="external" href="http://en.wikipedia.org/wiki/File_Transfer_Protocol" title="FTP on wikipedia">Wikipedia article</a> provides more detailed information than this
    short introduction.
</p>

<?php h2('The FTP client class') ?>
<p>
    The class provided by SFML is <?php class_link("Ftp") ?> (surprising, isn't it?). It's a client, which means that it can connect to an FTP server, send commands to it and upload or
    download files.
</p>
<p>
    Every function of the <?php class_link("Ftp") ?> class wraps an FTP command, and returns a standard FTP response. An FTP response contains a status code (similar
    to HTTP status codes but not identical), and a message that informs the user of what happened. FTP responses are encapsulated in the <?php class_link("Ftp::Response") ?>
    class.
</p>
<p>
<pre><code class="cpp">#include &lt;SFML/Network.hpp&gt;

sf::Ftp ftp;
...
sf::Ftp::Response response = ftp.login(); // just an example, could be any function

std::cout &lt;&lt; "Response status: " &lt;&lt; response.getStatus() &lt;&lt; std::endl;
std::cout &lt;&lt; "Response message: " &lt;&lt; response.getMessage() &lt;&lt; std::endl;
</code></pre>
<p>
    The status code can be used to check whether the command was successful or failed: Codes lower than 400 represent success, all others represent errors. You can use the <code>isOk()</code>
    function as a shortcut to test a status code for success.
</p>
<pre><code class="cpp">sf::Ftp::Response response = ftp.login();
if (response.isOk())
{
    // success!
}
else
{
    // error...
}
</code></pre>
<p>
    If you don't care about the details of the response, you can check for success with even less code:
</p>
<pre><code class="cpp">if (ftp.login().isOk())
{
    // success!
}
else
{
    // error...
}
</code></pre>
<p>
    For readability, these checks won't be performed in the following examples in this tutorial. Don't forget to perform them in your code!
</p>
<p>
    Now that you understand how the class works, let's have a look at what it can do.
</p>

<?php h2('Connecting to the FTP server') ?>
<p>
    The first thing to do is connect to an FTP server.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org");
</code></pre>
<p>
    The server address can be any valid <?php class_link("IpAddress") ?>: A URL, an IP address, a network name, ...
</p>
<p>
    The standard port for FTP is 21. If, for some reason, your server uses a different port, you can specify it as an additional argument:
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 45000);
</code></pre>
<p>
    You can also pass a third parameter, which is a time out value. This prevents you from having to wait forever (or at least a very long time) if the server doesn't respond.
</p>
<pre><code class="cpp">sf::Ftp ftp;
ftp.connect("ftp.myserver.org", 21, sf::seconds(5));
</code></pre>
<p>
    Once you're connected to the server, the next step is to authenticate yourself:
</p>
<pre><code class="cpp">// authenticate with name and password
ftp.login("username", "password");

// or login anonymously, if the server allows it
ftp.login();
</code></pre>

<?php h2('FTP commands') ?>
<p>
    Here is a short description of all the commands available in the <?php class_link("Ftp") ?> class. Remember one thing: All these commands are performed relative
    to the <em>current working directory</em>, exactly as if you were executing file or directory commands in a console on your operating system.
</p>
<p>
    Getting the current working directory:
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse response = ftp.getWorkingDirectory();
if (response.isOk())
    std::cout &lt;&lt; "Current directory: " &lt;&lt; response.getDirectory() &lt;&lt; std::endl;
</code></pre>
<p>
    <?php class_link("Ftp::DirectoryResponse") ?> is a specialized <?php class_link("Ftp::Response") ?> that also contains the requested directory.
</p>
<p>
    Getting the list of directories and files contained in the current directory:
</p>
<pre><code class="cpp">sf::Ftp::ListingResponse response = ftp.getDirectoryListing();
if (response.isOk())
{
    const std::vector&lt;std::string&gt;&amp; listing = response.getListing();
    for (std::vector&lt;std::string&gt;::const_iterator it = listing.begin(); it != listing.end(); ++it)
        std::cout &lt;&lt; "- " &lt;&lt; *it &lt;&lt; std::endl;
}

// you can also get the listing of a sub-directory of the current directory:
response = ftp.getDirectoryListing("subfolder");
</code></pre>
<p>
    <?php class_link("Ftp::ListingResponse") ?> is a specialized <?php class_link("Ftp::Response") ?> that also contains the requested directory/file names.
</p>
<p>
    Changing the current directory:
</p>
<pre><code class="cpp">ftp.changeDirectory("path/to/new_directory"); // the given path is relative to the current directory
</code></pre>
<p>
    Going to the parent directory of the current one:
</p>
<pre><code class="cpp">ftp.parentDirectory();
</code></pre>
<p>
    Creating a new directory (as a child of the current one):
</p>
<pre><code class="cpp">ftp.createDirectory("name_of_new_directory");
</code></pre>
<p>
    Deleting an existing directory:
</p>
<pre><code class="cpp">ftp.deleteDirectory("name_of_directory_to_delete");
</code></pre>
<p>
    Renaming an existing file:
</p>
<pre><code class="cpp">ftp.renameFile("old_name.txt", "new_name.txt");
</code></pre>
<p>
    Deleting an existing file:
</p>
<pre><code class="cpp">ftp.deleteFile("file_name.txt");
</code></pre>
<p>
    Downloading (receiving from the server) a file:
</p>
<pre><code class="cpp">ftp.download("remote_file_name.txt", "local/destination/path", sf::Ftp::Ascii);
</code></pre>
<p>
    The last argument is the transfer mode. It can be either Ascii (for text files), Ebcdic (for text files using the EBCDIC character set) or
    Binary (for non-text files). The Ascii and Ebcdic modes can transform the file (line endings, encoding) during the transfer to match the client environment. The Binary
    mode is a direct byte-for-byte transfer.
</p>
<p>
    Uploading (sending to the server) a file:
</p>
<pre><code class="cpp">ftp.upload("local_file_name.pdf", "remote/destination/path", sf::Ftp::Binary);
</code></pre>
<p>
    FTP servers usually close connections that are inactive for a while. If you want to avoid being disconnected, you can send a no-op command periodically:
</p>
<pre><code class="cpp">ftp.keepAlive();
</code></pre>

<?php h2('Disconnecting from the FTP server') ?>
<p>
    You can close the connection with the server at any moment with the <code>disconnect</code> function.
</p>
<pre><code class="cpp">ftp.disconnect();
</code></pre>

<?php

    require("footer.php");

?>
