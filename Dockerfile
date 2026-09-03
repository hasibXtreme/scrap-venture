# Stage 1: Build frontend assets using Node.js
FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package*.json vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm ci && npm run build

# Stage 2: Production PHP-FPM + Nginx application
FROM php:8.2-fpm-alpine

# Install system dependencies and PHP extension installer
RUN apk add --no-cache \
    nginx \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    postgresql-dev \
    oniguruma-dev

# Install required PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
        gd \
        opcache

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application source code
COPY . .

# Copy built assets from Node stage
COPY --from=node_builder /app/public/build ./public/build

# Install production PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/http.d/default.conf

# Set permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script and set executable permissions
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
