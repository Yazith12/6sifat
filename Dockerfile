# Base image: PHP with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer from official image
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy project files into container
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Build frontend (if you use Vite or Mix)
RUN npm install && npm run build

# Give permissions to storage & bootstrap
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Run apache
CMD ["apache2-foreground"]
