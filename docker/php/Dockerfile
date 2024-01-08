FROM php:8.3-apache

RUN a2enmod rewrite

COPY ./app /var/www/app

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-configure intl

RUN docker-php-ext-install \
    pdo pdo_mysql mbstring pcntl bcmath intl opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app
