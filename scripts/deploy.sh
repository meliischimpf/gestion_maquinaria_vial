#!/bin/bash

set -e

echo "--- 1. Instalar dependencias de Composer (Composer V2 compatible) ---"
composer install --no-dev --optimize-autoloader

echo "--- 2. Instalar y compilar assets de NPM (frontend) ---"
npm install
npm run build

echo "--- 3. Ejecutar Migraciones y Optimizar la Aplicación ---"
php artisan migrate --force
php artisan cache:clear
php artisan config:cache
php artisan view:cache

echo "--- 4. Arreglar permisos ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "--- Despliegue completado. El servicio web se iniciará a continuación. ---"
