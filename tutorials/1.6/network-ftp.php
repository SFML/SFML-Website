<?php

    $title = "Using FTP";
    $page = "network-ftp.php";

    require("header.php");
?>

<h1>Using FTP</h1>

<?php h2('Introduction') ?>
<p>
    FTP (File Transfer Protocol) is a widely used protocol for transfering and accessing files over the internet, or any
    other network. It consists of a client-server architecture which is basically very simple: the client sends
    a command to the server, which executes it and sends a response back to the client to inform him about the success
    or failure of the operation.
</p>
<p>
    SFML provides a simple class which implements a FTP client and all the commands it can send to a FTP server: 
    <?php class_link("Ftp")?>.
</p>

<?php h2('FTP responses') ?>
<p>
    Before using our FTP class, let's explain the concept of responses. Every FTP action is internally a command that
    is executed by the server, and which returns a response containing a status code and a message. Thus, every call to
    a <?php class_link("Ftp")?> function returns such a response, wrapped in the
    <?php class_link("Ftp::Response", "Ftp_1_1Response")?> class. This class is a straight-forward wrapper around
    FTP responses, and contains the returned status code and message from the server.
</p>
<pre><code class="cpp">sf::Ftp Server;
sf::Ftp::Response Resp = Server.xxx(); // See later...

sf::Ftp::Response::Status Status = Resp.GetStatus();
std::string Message = Resp.GetMessage();
</code></pre>
<p>
    The status code and message are useful only if you want to display detailed informations about what is done on
    the server side, otherwise they can just be ignored. The only important thing is to check whether the status code
    means a success or a failure, which can be done with the <code>IsOk</code> helper function.
</p>
<pre><code class="cpp">bool Success = Resp.IsOk();
</code></pre>
<p>
    Thus, every FTP command can be checked directly:
</p>
<pre><code class="cpp">if (Server.xxx().IsOk())
{
    // Success
}
else
{
    // Failure
}
</code></pre>

<?php h2('Connecting to a FTP server') ?>
<p>
    The first step is to connect to a FTP server.
</p>
<pre><code class="cpp">sf::Ftp Server;
if (Server.Connect("ftp.myserver.com").IsOk())
{
    // Ok, we're connected
}
</code></pre>
<p>
    The server address can be any valid <?php class_link("IPAddress")?>: an URL, an IP address, a network name, etc.
</p>
<p>
    The <code>Connect</code> function can accept two more optional parameters: a network port and a timeout value.<br/>
    The default port for FTP is 21, but some applications may need to use another one.<br/>
    The timeout can be used to make sure your application won't freeze for too long if the server is not responding;
    if you don't specify an explicit value, the default system timeout is used.
</p>
<p>
    Here is an example using the port 50 and a timeout value of 3 seconds:
</p>
<pre><code class="cpp">if (Server.Connect("ftp.myserver.com", 50, 3).IsOk())
{
    // Ok, we're connected
}
</code></pre>
<p>
    Once you're connected to the server, you have to log in in order to identify yourself.
</p>
<pre><code class="cpp">if (Server.Login("username", "password").IsOk())
{
    // Ok, we're logged in
}
</code></pre>
<p>
    You can also log in anonymously if the server supports it:
</p>
<pre><code class="cpp">if (Server.Login().IsOk())
{
    // Ok, we're logged in as an anonymous user
}
</code></pre>
<p>
    You're now connected and identified on the server, let's see what you can do with it.
</p>

<?php h2('FTP commands') ?>
<p>
    Because the FTP protocol aims at accessing files, it can basically be seen as a remote filesystem.
    Thus, the command it defines are similar to those you can find on your favorite OS: browsing directories,
    displaying content, copying files, etc.
</p>
<p>
    Here is a list of the FTP commands implemented in <?php class_link("Ftp")?>.
</p>
<p>
    <code>GetWorkingDirectory</code> retrieves the current working directory. It returns a specialized response
    of type <?php class_link("Ftp::DirectoryResponse", "Ftp_1_1DirectoryResponse")?> which contains the directory as an
    additional member.
</p>
<pre><code class="cpp">sf::Ftp::DirectoryResponse Resp = Server.GetWorkingDirectory();
if (Resp.IsOk())
{
    std::string Directory = Resp.GetDirectory();
}
</code></pre>
<p>
    <code>GetDirectoryListing</code> retrieves the contents of the given directory, relative to the current working
    directory. It returns a specialized response
    of type <?php class_link("Ftp::ListingResponse", "Ftp_1_1ListingResponse")?> which contains the listing as an
    additional member.
</p>
<pre><code class="cpp">sf::Ftp::ListingResponse Resp = Server.GetDirectoryListing("some_directory");
if (Resp.IsOk())
{
    for (std::size_t i = 0; i &lt; Resp.GetCount(); ++i)
    {
        std::string Filename = Resp.GetFilename(i);
    }
}
</code></pre>
<p>
    <code>ChangeDirectory</code> changes the current working directory, relative to the current one. It can
    be a complex path, separated by slashes.
</p>
<pre><code class="cpp">Server.ChangeDirectory("some/directory");
</code></pre>
<p>
    <code>ParentDirectory</code> changes the current working directory to the parent of the current one. It's in fact
    equivalent to a call to <code>ChangeDirectory("..")</code>.
</p>
<pre><code class="cpp">Server.ParentDirectory();
</code></pre>
<p>
    <code>MakeDirectory</code> creates a new directory as a child of the current one.
</p>
<pre><code class="cpp">Server.MakeDirectory("new_dir");
</code></pre>
<p>
    <code>DeleteDirectory</code> deletes an existing directory. Be careful when using this command, it can't be undone!
</p>
<pre><code class="cpp">Server.DeleteDirectory("dir_to_remove");
</code></pre>
<p>
    <code>RenameFile</code> renames a file (doh!).
</p>
<pre><code class="cpp">Server.RenameFile("file.txt", "new_name.txt");
</code></pre>
<p>
    <code>DeleteFile</code> deletes an existing file.
</p>
<pre><code class="cpp">Server.DeleteFile("file.txt");
</code></pre>
<p>
    <code>Download</code> transfers a file from the server to the client. There are three transfer modes: binary
    (the default one), Ascii (optimized for ASCII text files) and Ebcdic (optimized for EBCDIC text files).
</p>
<pre><code class="cpp">Server.Download("distant_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    <code>Upload</code> transfers a file from the client to the server. The transfer modes are the same as for the
    <code>Download</code> function.
</p>
<pre><code class="cpp">Server.Upload("local_file.txt", "dest_dir", sf::Ftp::Binary);
</code></pre>
<p>
    Note: the <code>Download</code> and <code>Upload</code> function may take time to complete, depending on the size of
    file to transfer. If you don't want to block your application it may be a good idea to execute them in a separate
    thread.
</p>
<p>
    <code>KeepAlive</code> is a special function that does nothing. Many FTP servers automatically disconnect clients
    after several minutes of inactivity ; this function can be called when nothing happens, to prevent this
    automatic disconnection.
</p>
<pre><code class="cpp">Server.KeepAlive();
</code></pre>
<p>
    <code>Disconnect</code> disconnects the client from the server. Calling it is not mandatory (but recommended),
    as it is done when the <?php class_link("Ftp")?> instance gets destructed.
</p>
<pre><code class="cpp">Server.Disconnect();
</code></pre>

<?php h2('Conclusion') ?>
<p>
    This was the last tutorial about the network package. You can now
    <a class="internal" href="./index.php" title="Back to the tutorial index">go to another section</a>,
    and learn a new SFML package.
</p>

<?php

    require("footer.php");

?>
