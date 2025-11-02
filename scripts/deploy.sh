#!/bin/bash

set -e

cd /var/www/html

echo "--- 1. Limpiar caché ---"
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "--- 2. Migrar y sembrar ---"
php artisan migrate:fresh --seed --force

echo "--- 3. Finalmente optimizar ---"
php artisan config:cache
php artisan view:cache
php artisan optimize

echo "--- 4. Arreglar permisos finales ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "--- Despliegue completado. El servicio web se iniciará a continuación. ---"
