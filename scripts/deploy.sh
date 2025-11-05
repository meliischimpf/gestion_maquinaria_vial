#!/bin/bash

set -ex  # Habilita el modo depuración

cd /var/www/html

echo "=== INICIO DEL DESPLIEGUE ==="
echo "Directorio actual: $(pwd)"
echo "Contenido del directorio:"
ls -la

# Verificar variables de entorno de la base de datos
echo "--- Verificando variables de entorno ---"
echo "DB_CONNECTION=${DB_CONNECTION:-No definido}"
echo "DB_HOST=${DB_HOST:-No definido}"
echo "DB_PORT=${DB_PORT:-No definido}"
echo "DB_DATABASE=${DB_DATABASE:-No definido}"
echo "DB_USERNAME=${DB_USERNAME:-No definido}"

# Esperar a que la base de datos esté lista (solo para PostgreSQL)
if [ "${DB_CONNECTION}" = "pgsql" ]; then
    echo "--- Esperando a que PostgreSQL esté listo ---"
    until PGPASSWORD=$DB_PASSWORD pg_isready -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -p "$DB_PORT"; do
        echo "Esperando a que PostgreSQL esté listo..."
        sleep 2
    done
fi

echo "--- 1. Limpiar caché ---"
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "--- 2. Ejecutar migraciones ---"
php artisan migrate --force

echo "--- 3. Ejecutar seeders ---"
php artisan db:seed --force

echo "--- 4. Optimizar ---"
php artisan config:cache
php artisan view:cache
php artisan optimize

echo "--- 5. Arreglar permisos ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "=== FIN DEL DESPLIEGUE ==="