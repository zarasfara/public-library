FROM php:8.3-fpm

RUN apt-get update && \
    apt-get install -y \
    zip unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . /application

WORKDIR /application

RUN chown -R www-data:www-data storage/ bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
