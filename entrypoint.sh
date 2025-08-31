#!/bin/sh
set -e

# Run migrations if needed
if [ "$APP_ENV" = "production" ] && [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start PHP-FPM in the background
php-fpm &

# Start Nginx as the foreground process (keeps container running)
exec nginx -g "daemon off;"