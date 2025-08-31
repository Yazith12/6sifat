# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libvpx-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* /var/lib/dpkg/* /var/cache/apt/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) pdo_pgsql mbstring exif pcntl bcmath zip gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy application
COPY . .

# Generate optimized autoload files
RUN composer dump-autoload

# Install all dependencies
RUN composer install --no-dev --optimize-autoloader

# Create directory for session and cache files
RUN mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Create entrypoint script
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]

# Configure PHP-FPM to listen on TCP
RUN sed -i 's/listen = \/var\/run\/php\/php8.2-fpm.sock/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf