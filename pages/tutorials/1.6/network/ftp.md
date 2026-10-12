# Using FTP

!!! warning ""

    You're reading the tutorial for SFML 1.6. Check out the [latest version of this tutorial](/tutorials/latest/network/ftp/).

## Introduction

FTP (File Transfer Protocol) is a widely used protocol for transfering and accessing files over the internet, or any other network. It consists of a client-server architecture which is basically very simple: the client sends a command to the server, which executes it and sends a response back to the client to inform him about the success or failure of the operation.

SFML provides a simple class which implements a FTP client and all the commands it can send to a FTP server: [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp.php "sf::Ftp documentation").

## FTP responses

Before using our FTP class, let's explain the concept of responses. Every FTP action is internally a command that is executed by the server, and which returns a response containing a status code and a message. Thus, every call to a [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp.php "sf::Ftp documentation") function returns such a response, wrapped in the [`sf::Ftp::Response`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp_1_1Response.php "sf::Ftp::Response documentation") class. This class is a straight-forward wrapper around FTP responses, and contains the returned status code and message from the server.

```cpp
sf::Ftp Server;
sf::Ftp::Response Resp = Server.xxx(); // See later...

sf::Ftp::Response::Status Status = Resp.GetStatus();
std::string Message = Resp.GetMessage();
```

The status code and message are useful only if you want to display detailed informations about what is done on the server side, otherwise they can just be ignored. The only important thing is to check whether the status code means a success or a failure, which can be done with the `IsOk` helper function.

```cpp
bool Success = Resp.IsOk();
```

Thus, every FTP command can be checked directly:

```cpp
if (Server.xxx().IsOk())
{
    // Success
}
else
{
    // Failure
}
```

## Connecting to a FTP server

The first step is to connect to a FTP server.

```cpp
sf::Ftp Server;
if (Server.Connect("ftp.myserver.com").IsOk())
{
    // Ok, we're connected
}
```

The server address can be any valid [`sf::IPAddress`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1IPAddress.php "sf::IPAddress documentation"): an URL, an IP address, a network name, etc.

The `Connect` function can accept two more optional parameters: a network port and a timeout value.  
The default port for FTP is 21, but some applications may need to use another one.  
The timeout can be used to make sure your application won't freeze for too long if the server is not responding; if you don't specify an explicit value, the default system timeout is used.

Here is an example using the port 50 and a timeout value of 3 seconds:

```cpp
if (Server.Connect("ftp.myserver.com", 50, 3).IsOk())
{
    // Ok, we're connected
}
```

Once you're connected to the server, you have to log in in order to identify yourself.

```cpp
if (Server.Login("username", "password").IsOk())
{
    // Ok, we're logged in
}
```

You can also log in anonymously if the server supports it:

```cpp
if (Server.Login().IsOk())
{
    // Ok, we're logged in as an anonymous user
}
```

You're now connected and identified on the server, let's see what you can do with it.

## FTP commands

Because the FTP protocol aims at accessing files, it can basically be seen as a remote filesystem. Thus, the command it defines are similar to those you can find on your favorite OS: browsing directories, displaying content, copying files, etc.

Here is a list of the FTP commands implemented in [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp.php "sf::Ftp documentation").

`GetWorkingDirectory` retrieves the current working directory. It returns a specialized response of type [`sf::Ftp::DirectoryResponse`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp_1_1DirectoryResponse.php "sf::Ftp::DirectoryResponse documentation") which contains the directory as an additional member.

```cpp
sf::Ftp::DirectoryResponse Resp = Server.GetWorkingDirectory();
if (Resp.IsOk())
{
    std::string Directory = Resp.GetDirectory();
}
```

`GetDirectoryListing` retrieves the contents of the given directory, relative to the current working directory. It returns a specialized response of type [`sf::Ftp::ListingResponse`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp_1_1ListingResponse.php "sf::Ftp::ListingResponse documentation") which contains the listing as an additional member.

```cpp
sf::Ftp::ListingResponse Resp = Server.GetDirectoryListing("some_directory");
if (Resp.IsOk())
{
    for (std::size_t i = 0; i < Resp.GetCount(); ++i)
    {
        std::string Filename = Resp.GetFilename(i);
    }
}
```

`ChangeDirectory` changes the current working directory, relative to the current one. It can be a complex path, separated by slashes.

```cpp
Server.ChangeDirectory("some/directory");
```

`ParentDirectory` changes the current working directory to the parent of the current one. It's in fact equivalent to a call to `ChangeDirectory("..")`.

```cpp
Server.ParentDirectory();
```

`MakeDirectory` creates a new directory as a child of the current one.

```cpp
Server.MakeDirectory("new_dir");
```

`DeleteDirectory` deletes an existing directory. Be careful when using this command, it can't be undone!

```cpp
Server.DeleteDirectory("dir_to_remove");
```

`RenameFile` renames a file (doh!).

```cpp
Server.RenameFile("file.txt", "new_name.txt");
```

`DeleteFile` deletes an existing file.

```cpp
Server.DeleteFile("file.txt");
```

`Download` transfers a file from the server to the client. There are three transfer modes: binary (the default one), Ascii (optimized for ASCII text files) and Ebcdic (optimized for EBCDIC text files).

```cpp
Server.Download("distant_file.txt", "dest_dir", sf::Ftp::Binary);
```

`Upload` transfers a file from the client to the server. The transfer modes are the same as for the `Download` function.

```cpp
Server.Upload("local_file.txt", "dest_dir", sf::Ftp::Binary);
```

Note: the `Download` and `Upload` function may take time to complete, depending on the size of file to transfer. If you don't want to block your application it may be a good idea to execute them in a separate thread.

`KeepAlive` is a special function that does nothing. Many FTP servers automatically disconnect clients after several minutes of inactivity ; this function can be called when nothing happens, to prevent this automatic disconnection.

```cpp
Server.KeepAlive();
```

`Disconnect` disconnects the client from the server. Calling it is not mandatory (but recommended), as it is done when the [`sf::Ftp`](https://www.sfml-dev.org/documentation/1.6/classsf_1_1Ftp.php "sf::Ftp documentation") instance gets destructed.

```cpp
Server.Disconnect();
```

## Conclusion

This was the last tutorial about the network package. You can now [go to another section](../index.md "Back to the tutorial index"), and learn a new SFML package.
