FROM php:8.2-apache

# 必要なPHP拡張をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Apache mod_rewrite有効化
RUN a2enmod rewrite

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# DocumentRootをLaravelに合わせる
WORKDIR /var/www

ENV APACHE_DOCUMENT_ROOT=/var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf