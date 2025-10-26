#!/usr/bin/env bash

set -e

echo "--- 1. Instalar dependencias de Composer ---"
composer install --no-dev --prefer-dist --optimize-autoloader

echo "--- 2. Instalar y compilar assets de NPM (frontend) ---"
npm install
npm run build

echo "--- 3. Optimizar Laravel ---"
php artisan clear-compiled --env=production
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo "--- 4. Ejecutar Migraciones de la base de datos ---"
php artisan migrate --force

echo "--- Despliegue finalizado ---"


echo "--- Iniciando PHP-FPM y Nginx ---"
service php8.2-fpm start
nginx -g "daemon off;" 
