# SFML Website

This repository contains the source code of the [SFML website](https://www.sfml-dev.org).

The main goal here is to provide a place to easily report or even fix issues with the website.
For longer discussions however one should still use the [dedicated sub-forum](https://en.sfml-dev.org/forums/index.php?board=3.0) on the SFML forum.

## Development

The website is mostly HTML with a bit of PHP sprinkled on top, and styled using LESS.

To view the website in your browser for development, you can essentially pick any web server, that can call PHP.

### Pre-Requisite

#### Windows

It's highly recommended to use [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install), as setting up Apache or Nginx is a lot more straight forward on a Linux subsystem.  
If you don't want to do this, there are common packages such as [XAMPP](https://www.apachefriends.org/), [WampServer](https://www.wampserver.com/en/), or [AMPPS](https://www.ampps.com/).

After WSL2 has been installed and you opened an Linux shell in the Windows Terminal, follow the Linux steps below.

#### macOS

Ensure [`brew`](https://brew.sh/) is installed.

```bash
brew install php
brew install nginx
brew install nginx
```

**Additional References:**

-   https://pimylifeup.com/install-nginx-on-macos/
-   https://pimylifeup.com/install-php-on-macos/

#### Linux

On Linux, we'll provide commands for Debian/Ubuntu-like package managers. If you use a different distro, you'll have to look up the equivalent commands.

```bash
sudo apt install php8.1-fpm
sudo apt install apache2
sudo apt install nginx
```

In case `php8.1-fpm` doesn't exist, add the PPA:

```bash
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
```

### Configurations

**General Notes:**

-   In case port `80` is already in use, change the port to something else. If you for example pick `1337`, the website will then be accessible at `http://sfml.localhost:1337`
-   On Windows, `*.localhost` DNS are automatically mapped to `127.0.0.1`. If you want to use another custom domain, make sure to put a resolving DNS entry in your `hosts` file.
-   On Windows with WSL2, you can use `/mnt/c/...` to access the `C:\` drive.

#### Apache

-   On Linux:
    -   Create a new config file at `/etc/apache2/sites-available`
    -   Create a link to the `sites-enabled` directory, to enable the new config: `sudo ln -s /etc/apache2/sites-available/sfml /etc/apache2/sites-enabled/sfml`
    -   Test the Nginx config: `sudo /sbin/apache2 -t`
    -   Reload the config: `sudo service apache2 reload` or `sudo systemctl reload apache2`
-   On macOS:
    -   Edit: `/usr/local/etc/httpd/httpd.conf` or `/opt/homebrew/etc/httpd/httpd.conf`
    -   Reload the config: `brew services reload httpd`

```apache
<VirtualHost *:80>
        ServerName sfml.localhost

        DocumentRoot /path/to/the/cloned/SFML-website/repository
        DirectoryIndex index.php index.html
</VirtualHost>
```

#### Nginx

-   On Linux:
    -   Create a new config file at `/etc/nginx/sites-available`
    -   Create a link to the `sites-enabled` directory, to enable the new config: `sudo ln -s /etc/nginx/sites-available/sfml /etc/nginx/sites-enabled/sfml`
    -   Test the Nginx config: `sudo /sbin/nginx -t`
    -   Reload the config: `sudo service nginx reload` or `sudo systemctl reload nginx`
-   On macOS:
    -   Edit: `/usr/local/etc/nginx/nginx.conf` or `/opt/homebrew/etc/nginx/nginx.conf`
    -   Test the Nginx config: `nginx -t`
    -   Reload the config: `brew services reload nginx`

```nginx
server {
        listen 80;
        listen [::]:80;

        server_name sfml.localhost;
        root /path/to/the/cloned/SFML-website/repository;

        index index.php index.html;

        location / {
                try_files $uri $uri/ /index.php$is_args$args;
        }

        location ~* \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass unix:/run/php/php8.1-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
        }
}
```

**Notes:**

-   On macOS, the `fastcgi_pass` may not be needed.

## License

See the [LICENSE](LICENSE) file.
