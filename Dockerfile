# Use official PHP 8.2 FPM image (better for Laravel than apache)
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
    && rm -rf /var/lib/apt/lists/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

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

# Install and configure PHP-FPM with Nginx
RUN apt-get update && apt-get install -y nginx

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# FIX: Correct path to php.ini
RUN sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /usr/local/etc/php/php.ini

# Start command with proper PORT handling
EXPOSE 8000

# Set up entrypoint script to handle environment variables properly
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]