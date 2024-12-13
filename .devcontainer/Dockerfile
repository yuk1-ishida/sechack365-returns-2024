FROM php:8.3.7-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN apt update
RUN apt install -y wget git unzip libpq-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql

CMD ["apache2-foreground"]