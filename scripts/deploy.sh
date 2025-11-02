#!/bin/bash

set -ex  # Habilita el modo depuración

cd /var/www/html

echo "=== INICIO DEL DESPLIEGUE ==="
echo "Directorio actual: $(pwd)"
echo "Contenido del directorio:"
ls -la

echo "--- 1. Limpiar caché ---"
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo "--- 2. Mostrar variables de entorno ---"
php artisan tinker --execute="print_r($_ENV);" || echo "No se pudieron mostrar las variables de entorno"

echo "--- 3. Verificar conexión a la base de datos ---"
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Conexión exitosa a la base de datos'; } catch (\Exception \$e) { echo 'Error de conexión: ' . \$e->getMessage(); }"

echo "--- 4. Listar migraciones pendientes ---"
php artisan migrate:status

echo "--- 5. Ejecutar migraciones y seeders ---"
php artisan migrate:fresh --seed --force -v

echo "--- 6. Verificar seeders ejecutados ---"
php artisan db:seed --class=DatabaseSeeder --force -v

echo "--- 7. Optimizar ---"
php artisan config:cache
php artisan view:cache
php artisan optimize

echo "--- 8. Verificar rutas ---"
php artisan route:list

echo "=== FIN DEL DESPLIEGUE ==="

echo "--- 9. Arreglar permisos finales ---"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "--- Despliegue completado. El servicio web se iniciará a continuación. ---"