FROM php:8.3-apache

# mysqli für die Datenbank, mod_rewrite für saubere URLs
RUN docker-php-ext-install mysqli && a2enmod rewrite

COPY docker/apache.conf /etc/apache2/conf-enabled/pizzaservice.conf
COPY app/ /var/www/html/
