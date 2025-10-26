# Usa una imagen oficial de PHP 8.2 con FPM (basada en Debian)
# Esta imagen es más moderna y estable para Laravel.
# Usamos 'bullseye' (Debian 11) que es una base estable.
FROM php:8.2-fpm-bullseye

# Instala dependencias del sistema (incluyendo Nginx y Node)
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    git \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    zip \
    curl \
    # Instalar Node.js y NPM (versión 20.x, compatible con muchos proyectos)
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    # Limpia el cache de apt
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP que son comunes en Laravel
RUN docker-php-ext-install pdo pdo_mysql bcmath mbstring exif pcntl opcache

# Configura permisos para el usuario www-data
RUN usermod -u 1000 www-data

# Copia tu nginx.conf personalizado (debe estar en la raíz del proyecto)
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && rm -rf /etc/nginx/sites-enabled/default.bak

# Copia los archivos de tu proyecto
COPY . /var/www/html

# Establece el directorio de trabajo y asigna el propietario correcto
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Configura las variables de entorno de Laravel
ENV APP_ENV production
ENV APP_DEBUG false
ENV COMPOSER_ALLOW_SUPERUSER 1

# Exponer el puerto
EXPOSE 80

# Comando de inicio: Usamos el script de despliegue para iniciar todo
COPY scripts/deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# El CMD inicia el script, que a su vez inicia PHP-FPM y Nginx
CMD ["/usr/local/bin/deploy.sh"]
