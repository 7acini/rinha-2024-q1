FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    zip \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 8080
CMD php -S 0.0.0.0:8080 -t public
