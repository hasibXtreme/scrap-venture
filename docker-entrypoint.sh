#!/bin/sh
set -e

# Cache configuration, routes, and views for performance
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Execute migrations if requested or by default
if [ "$RUN_MIGRATIONS" != "false" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || echo "Migration warning: could not run migrations immediately."
fi

# Create storage symlink if not present
php artisan storage:link || true

# Automatically create admin user if ADMIN_EMAIL and ADMIN_PASSWORD are set
if [ -n "$ADMIN_EMAIL" ] && [ -n "$ADMIN_PASSWORD" ]; then
    echo "Creating admin account for $ADMIN_EMAIL..."
    php artisan make:admin --name="${ADMIN_NAME:-Admin}" --email="$ADMIN_EMAIL" --password="$ADMIN_PASSWORD" || true
fi

# Start PHP-FPM in daemon mode, then start Nginx in foreground
php-fpm -D
exec nginx -g "daemon off;"
