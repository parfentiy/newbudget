FROM php:8.1.5-apache

WORKDIR /var/www/html/public

COPY . /var/www/html/public

EXPOSE 80
