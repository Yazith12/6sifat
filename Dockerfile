# ---------- Stage 1 - Build Frontend (Vite) ----------
FROM node:18 AS frontend
WORKDIR /app

# copy repo (frontend could be root or in a subfolder)
COPY . .

# build if a frontend exists, otherwise create an empty public/dist so COPY won't fail
RUN set -eux; \
    if [ -f /app/package.json ]; then DIR="/app"; \
    elif [ -f /app/frontend/package.json ]; then DIR="/app/frontend"; \
    elif [ -f /app/client/package.json ]; then DIR="/app/client"; \
    else DIR=""; fi; \
    if [ -n "$DIR" ]; then \
      echo "Building frontend in $DIR"; \
      cd "$DIR"; \
      npm install --silent; \
      npm run build --silent; \
      mkdir -p /app/public; \
      if [ -d "$DIR/dist" ]; then mv "$DIR/dist" /app/public/dist; \
      elif [ -d "$DIR/public/dist" ]; then mv "$DIR/public/dist" /app/public/dist; \
      else echo "ERROR: build finished but no dist found in $DIR"; ls -la "$DIR"; exit 1; fi; \
    else \
      echo "No frontend found. Creating empty /app/public/dist to satisfy backend copy."; \
      mkdir -p /app/public/dist; \
    fi; \
    echo "/app/public/dist contents:"; ls -la /app/public/dist || true

# ---------- Stage 2 - Backend (Laravel + PHP + Composer) ----------
FROM php:8.2-fpm AS backend

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy application files (Laravel app)
COPY . .

# copy built frontend (may be empty if no frontend)
COPY --from=frontend /app/public/dist /var/www/public/dist

# install PHP deps
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# clear caches (ignore failures)
RUN php artisan config:clear || true && php artisan route:clear || true && php artisan view:clear || true

# permissions (optional)
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000
CMD ["php-fpm"]
