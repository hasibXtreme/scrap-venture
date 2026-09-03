#!/bin/sh
set -e

# Cache configuration, routes, and views for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute migrations if requested or by default
if [ "$RUN_MIGRATIONS" != "false" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || echo "Migration warning: could not run migrations immediately."
fi

# Create storage symlink if not present
php artisan storage:link || true

# Start PHP-FPM in daemon mode, then start Nginx in foreground
php-fpm -D
exec nginx -g "daemon off;"
