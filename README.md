# SFML Website

This repository contains the source code of the [SFML website](https://www.sfml-dev.org).

The main goal here is to provide a place to easily report or even fix issues with the website.
For longer discussions however one should still use the [dedicated sub-forum](https://en.sfml-dev.org/forums/index.php?board=3.0) on the SFML forum.

## Development

The site is written in Markdown and built with [Material for MkDocs](https://squidfunk.github.io/mkdocs-material/) on top of [ProperDocs](https://properdocs.org/), the maintained fork of MkDocs 1.x.

A small number of features still rely on PHP and Apache, in particular `ip-provider.php`, redirects, and custom error pages.

There are two ways to work locally:

1. Use ProperDocs directly for a preview of the generated site, including hot-reload.
2. Build the site and serve it with Apache and PHP in a container when you need to test `ip-provider.php`, redirects, or custom error documents.

### ProperDocs - Pre-Requisite

As ProperDocs is Python based, make sure you have [Python 3.x](https://www.python.org/downloads/) installed on your OS, which should also come with `pip`.

> [!NOTE]
> You may want to set up a [virtual environment](https://docs.python.org/3/library/venv.html) as to not contaminate the rest of your system.

Use the following command to install all the necessary packages including ProperDocs:

```bash
pip install -r ./requirements.txt --upgrade
```

### Option 1: Preview with ProperDocs

Run the local development server:

```bash
properdocs serve
```

This can take a few seconds.
Once ready, you should see a localhost link in the terminal pointing you to the website.

ProperDocs is sufficient for inspecting the generated pages, but it does not apply the `.htaccess` rules, nor serves `ip-provider.php`.

### Option 2: Serve the built site with Apache and PHP

To be able to run the web-server container, install either:

- Docker with the Docker Compose plugin, or
- Podman with a Compose provider

You will also need [mkcert](https://github.com/FiloSottile/mkcert) to create a locally trusted certificate for `sfml.localhost`.
The certificate and key are mounted into the web-server container. Do not commit them.

```bash
mkcert -install
mkdir -p certs
mkcert -cert-file certs/sfml.localhost.pem \
       -key-file certs/sfml.localhost-key.pem \
       sfml.localhost www.sfml.localhost
```

Build the site:

```bash
properdocs build
```

The generated files will be in `site/`.
The Apache container mounts that directory, along with root-level files such as `.htaccess` and `ip-provider.php`, into the document root.

Start the container:

```bash
docker compose up --build
```

or

```bash
podman compose up --build
```

Open the site at https://www.sfml.localhost:8443/.  
There is also one HTTP page at http://www.sfml.localhost:8080/ip-provider.php.

After changing the Markdown content, run `properdocs build` again and refresh the browser.

When you’re finished, stop the container with the matching command:

```bash
docker compose down
```

or

```bash
podman compose down
```

## License

See the [LICENSE](LICENSE) file.
