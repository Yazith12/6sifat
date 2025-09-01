# ---------- Stage 1 - Build Frontend (Vite) ----------
FROM node:18 AS frontend

# workspace
WORKDIR /app

# copy repo (we copy everything so frontend may sit at root or in subfolder)
COPY . .

# install & build: detect where package.json is (root, frontend/, client/)
# then run npm install and npm run build in that dir
# finally move the produced dist to /app/public/dist (so backend can always copy from there)
RUN set -eux; \
    if [ -f /app/package.json ]; then DIR="/app"; \
    elif [ -f /app/frontend/package.json ]; then DIR="/app/frontend"; \
    elif [ -f /app/client/package.json ]; then DIR="/app/client"; \
    else echo "ERROR: No package.json found in root, frontend/, or client/"; exit 1; fi; \
    echo "Building frontend in $DIR"; \
    cd "$DIR"; \
    npm install --silent; \
    npm run build --silent; \
    mkdir -p /app/public; \
    if [ -d "$DIR/dist" ]; then mv "$DIR/dist" /app/public/dist; \
    elif [ -d "$DIR/public/dist" ]; then mv "$DIR/public/dist" /app/public/dist; \
    else echo "ERROR: build finished but no dist found in $DIR"; ls -la "$DIR"; exit 1; fi; \
    echo "/app/public/dist contents:"; ls -la /app/public/dist

# ---------- Stage 2 - Backend (Laravel + PHP + Composer) ----------
FROM php:8.2-fpm AS backend

# install system deps and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# copy composer binary from official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy application files (Laravel app)
COPY . .

# copy built frontend from frontend stage into Laravel public folder
COPY --from=frontend /app/public/dist /var/www/public/dist

# install PHP dependencies (composer)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# run Laravel caches/clears (optional, ensures caches are fresh)
RUN php artisan config:clear || true && php artisan route:clear || true && php artisan view:clear || true

# fix permissions (optional, helpful on some hosts)
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000
CMD ["php-fpm"]
