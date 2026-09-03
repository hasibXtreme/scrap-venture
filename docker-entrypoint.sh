#!/bin/sh
set -e

# Ensure storage and cache directory structure exists with correct permissions
mkdir -p /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clear stale cache then recache for performance
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
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
