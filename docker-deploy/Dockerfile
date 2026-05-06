# Stage 1: Build vendor
FROM composer:2.9 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# Stage 2: Production image
FROM php:8.4-fpm-alpine

# Install dependency sistem yang diperlukan Laravel & PostgreSQL
RUN apk add --no-cache \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    ctype \
    fileinfo \
    tokenizer \
    session \
    && rm -rf /var/cache/apk/*

# Install Redis jika nanti diperlukan (saat ini tidak dipakai)
# RUN apk add --no-cache redis && pecl install redis && docker-php-ext-enable redis

COPY --from=vendor /app/vendor /var/www/html/vendor
COPY . /var/www/html

WORKDIR /var/www/html

# Set permission
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["/usr/local/bin/entrypoint"]
CMD ["php-fpm"]