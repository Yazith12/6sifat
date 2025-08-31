# Use official PHP+Apache image
FROM php:8.2-apache

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev \
    libpng-dev libicu-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl intl opcache

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot to /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Replace the apache config to use the new DocumentRoot
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT%/public}/!g" /etc/apache2/apache2.conf

# Copy composer from official composer image
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Build front-end if needed (optional — remove if you don't use npm)
RUN if [ -f package.json ]; then apt-get install -y nodejs npm && npm ci && npm run build; fi

# Ensure storage & cache directories are writeable
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
