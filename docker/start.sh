
#!/bin/sh
set -e

cd /var/www/html

echo "Preparando Laravel..."

# Verificar que exista la clave de aplicación
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY no está configurada."
    exit 1
fi

# Crear directorios necesarios
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Limpiar configuración anterior
php artisan optimize:clear

# Ejecutar migraciones de PostgreSQL
php artisan migrate --force

# Optimizar Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Iniciando Nginx y PHP-FPM..."

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
