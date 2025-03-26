FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl libicu-dev \
    nodejs npm gnupg \
    libzip-dev libonig-dev libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install intl zip pdo pdo_mysql

# Installer yarn et composer
RUN npm install --global yarn
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
