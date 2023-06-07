FROM composer:1.9.3
FROM php:7.4-apache

RUN apt-get update && apt-get -y install libjpeg-dev libpng-dev zlib1g-dev git zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer:1.9.3 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install
