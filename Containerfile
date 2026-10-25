FROM php:8.5-apache

COPY sfml-localhost.conf /etc/apache2/sites-available/sfml.conf

RUN a2enmod headers rewrite ssl \
    && a2dissite 000-default \
    && a2ensite sfml
