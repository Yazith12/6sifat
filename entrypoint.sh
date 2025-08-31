#!/bin/sh
set -e

# First arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- php-fpm "$@"
fi

# Run migrations if needed
if [ "$APP_ENV" = "production" ] && [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start PHP-FPM
if [ "$1" = 'php-fpm' ]; then
    # Start Nginx in background
    nginx -g "daemon off;" &
    
    # Start PHP-FPM
    exec "$@"
fi

exec "$@"