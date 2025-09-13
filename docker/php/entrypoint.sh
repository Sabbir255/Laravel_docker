#!/bin/sh
set -e

echo "🚀 Starting Laravel container..."

# Wait for MySQL before running migrations
if [ "$DB_HOST" != "" ]; then
  echo "⏳ Waiting for database ($DB_HOST:$DB_PORT)..."
  until nc -z "$DB_HOST" "$DB_PORT"; do
    sleep 1
  done
  echo "✅ Database is ready!"
fi

# Run migrations (force to avoid prompt)
echo "🔄 Running migrations..."
php artisan migrate --force

# Run seeders
echo "🌱 Seeding database..."
php artisan db:seed --force

# Ensure storage and bootstrap/cache are writable
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache


# Run seeders
echo "🌱 storage linkup..."
php artisan storage:link || true

# Optimize Laravel caches
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Laravel is ready!"

# Start PHP-FPM
exec php-fpm
