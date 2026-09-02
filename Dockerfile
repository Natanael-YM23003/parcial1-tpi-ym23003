FROM php:8.2-apache

RUN apt update && apt install nano -y

RUN printf "<Directory /var/www/html>\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n</Directory>\n" > /etc/apache2/conf-available/z-override.conf && a2enconf z-override

RUN a2enmod rewrite

WORKDIR /var/www/html

EXPOSE 80

