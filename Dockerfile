# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies including MySQL extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --no-scripts

# Generate optimized autoload files
RUN composer dump-autoload

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start command with proper PORT handling
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t public"]