FROM php:8.3-fpm

RUN apt-get update && \
    apt-get install -y \
    zip unzip \
    && apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /application

WORKDIR /application

RUN chown -R www-data:www-data storage/ bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
