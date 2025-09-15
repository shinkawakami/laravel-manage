FROM php:8.2-apache

# 必要パッケージ & PHP拡張
RUN apt-get update && apt-get install -y \
    curl ca-certificates gnupg \
    libpng-dev libonig-dev libzip-dev zip unzip git \
 && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Node.js 20 LTS 追加（NodeSource）
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs \
 && npm -v && node -v

# Apache
RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
