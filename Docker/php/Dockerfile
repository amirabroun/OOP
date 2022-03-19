FROM php:8-fpm

RUN docker-php-ext-install mysqli pdo_mysql

RUN apt-get update --fix-missing \
    && apt-get install -y curl wget zip unzip git \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# DEPENDENCIES
RUN apt-get update --fix-missing 