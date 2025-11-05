#!/bin/bash

set -ex  # Enable debug mode

cd /var/www/html

echo "=== STARTING DEPLOYMENT ==="
echo "Current directory: $(pwd)"

# Verify required environment variables
echo "--- Verifying environment variables ---"
echo "DB_CONNECTION=${DB_CONNECTION:-Not set, using default: pgsql}"
echo "DB_HOST=${DB_HOST:-Not set, using default: localhost}"
echo "DB_PORT=${DB_PORT:-Not set, using default: 5432}"
echo "DB_DATABASE=${DB_DATABASE:-Not set, this is required}"
echo "DB_USERNAME=${DB_USERNAME:-Not set, this is required}"

# Set defaults if not set
export DB_CONNECTION=${DB_CONNECTION:-pgsql}
export DB_HOST=${DB_HOST:-localhost}
export DB_PORT=${DB_PORT:-5432}

# Check if required variables are set
if [ -z "$DB_DATABASE" ] || [ -z "$DB_USERNAME" ] || [ -z "$DB_PASSWORD" ]; then
    echo "ERROR: Required database environment variables are not set"
    echo "Please set DB_DATABASE, DB_USERNAME, and DB_PASSWORD"
    exit 1
fi

# Only try to check PostgreSQL if we have the required tools
if command -v pg_isready > /dev/null; then
    echo "--- Waiting for PostgreSQL to be ready ---"
    until PGPASSWORD=$DB_PASSWORD pg_isready -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -p "$DB_PORT"; do
        echo "Waiting for PostgreSQL to be ready..."
        sleep 2
    done
else
    echo "WARNING: pg_isready not found, skipping PostgreSQL connection check"
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