#!/usr/bin/env bash

echo "--- 1. Instalar dependencias de Composer ---"
composer install --no-dev --optimize-autoload

echo "--- 2. Instalar y compilar assets de NPM (frontend) ---"
npm install
npm run build

echo "--- 3. Optimizar Laravel ---"
php artisan view:clear
php artisan cache:clear 
php artisan config:cache

echo "--- 4. Ejecutar Migraciones ---"
php artisan migrate --force

echo "--- 5. Iniciar Servidor ---"
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

composer install --no-dev --optimize-autoload
npm install
npm run build
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
