FROM php:7.3-apache
RUN a2enmod rewrite.load
RUN docker-php-ext-install mysqli pdo_mysql