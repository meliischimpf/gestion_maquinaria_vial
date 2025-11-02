#!/bin/bash

set -e

cd /var/www/html
echo "--- 1. Ejecutar Migraciones y Optimizar la Aplicación ---"
php artisan migrate:fresh --seed

php artisan cache:clear
php artisan config:cache
php artisan view:cache
php artisan optimize:clear

echo "--- 2. Arreglar permisos finales ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "--- Despliegue completado. El servicio web se iniciará a continuación. ---"
