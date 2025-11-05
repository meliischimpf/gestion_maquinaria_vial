#!/bin/bash

set -ex  # Enable debug mode

cd /var/www/html

echo "=== STARTING DEPLOYMENT ==="
echo "Current directory: $(pwd)"

# Set default database configuration if not set
if [ -z "$DB_CONNECTION" ]; then
    echo "DB_CONNECTION not set, defaulting to pgsql"
    export DB_CONNECTION=pgsql
fi

# Verify database environment variables
echo "--- Verifying environment variables ---"
echo "DB_CONNECTION=${DB_CONNECTION}"
echo "DB_HOST=${DB_HOST:-localhost}"
echo "DB_PORT=${DB_PORT:-5432}"
echo "DB_DATABASE=${DB_DATABASE:-postgres}"
echo "DB_USERNAME=${DB_USERNAME:-postgres}"

# Wait for PostgreSQL to be ready
if [ "$DB_CONNECTION" = "pgsql" ]; then
    echo "--- Waiting for PostgreSQL to be ready ---"
    until PGPASSWORD=$DB_PASSWORD pg_isready -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -p "$DB_PORT"; do
        echo "Waiting for PostgreSQL to be ready..."
        sleep 2
    done
fi

echo "--- 1. Clearing cache ---"
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Set the application environment
php artisan env

echo "--- 2. Running migrations ---"
php artisan migrate --force

echo "--- 3. Running seeders ---"
php artisan db:seed --force

echo "--- 4. Optimizing ---"
php artisan config:cache
php artisan view:cache
php artisan optimize

echo "--- 5. Setting permissions ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "=== DEPLOYMENT COMPLETE ==="