#!/bin/sh
set -e

# Run migrations if needed
if [ "$APP_ENV" = "production" ] && [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start PHP-FPM listening on TCP port 9000
php-fpm --nodaemonize --allow-to-run-as-root &

# Start Nginx as the foreground process
exec nginx -g "daemon off;"