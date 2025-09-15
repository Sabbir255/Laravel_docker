# -----------------------
# Stage 1: Build / Composer
# -----------------------
FROM php:8.2-fpm-alpine AS build

# Install system dependencies for building PHP extensions
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    autoconf \
    g++ \
    make \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    libsodium-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sodium

# Install Redis PHP Extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install Composer (from official image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy composer files first (for better caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (without dev packages)
RUN composer install --optimize-autoloader --no-scripts

# Copy application source code
COPY . .

# Optimize autoloader
RUN composer dump-autoload --optimize


# -----------------------
# Stage 2: Production
# -----------------------
FROM php:8.2-fpm-alpine AS production

# Install runtime dependencies only (lighter than build stage)
RUN apk add --no-cache \
    bash \
    supervisor \
    libpng \
    libjpeg-turbo \
    freetype \
    libxml2 \
    oniguruma \
    libsodium

WORKDIR /var/www

# Copy PHP configuration & extensions from build (same Alpine, so compatible)
COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Copy Composer (optional for artisan commands in container)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application (with vendor already installed)
COPY --from=build /var/www /var/www

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && find /var/www -type f -exec chmod 644 {} \; \
    && find /var/www -type d -exec chmod 755 {} \; \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Copy entrypoint script
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
