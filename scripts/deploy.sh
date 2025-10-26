#!/usr/bin/env bash

echo "--- 1. Instalar dependencias de Composer ---"
composer install --no-dev --prefer-dist --optimize-autoloader

echo "--- 2. Instalar y compilar assets de NPM (frontend) ---"
npm install
npm run build

echo "--- 3. Optimizar Laravel ---"
php artisan config:cache
php artisan route:cache
php artisan cache:clear
php artisan optimize


echo "--- 4. Ejecutar Migraciones de la base de datos (IMPORTANTE) ---"
php artisan migrate:refresh --seed

echo "--- Despliegue finalizado ---"