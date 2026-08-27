FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Trik pamungkas: Hapus paksa konfigurasi platform require ext-zip dari composer.json
RUN sed -i '/ext-zip/d' composer.json

# Argumen acak untuk membuang cache lama total
ARG CACHE_BUST=20260827-v2
RUN echo "Cache bust: $CACHE_BUST"

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080