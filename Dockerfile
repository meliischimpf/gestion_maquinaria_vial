FROM php:8.2-fpm-bullseye

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    git \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    zip \
    curl \
    postgresql-client \ 
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html
WORKDIR /var/www/html

# Configura las variables de entorno necesarias para el build
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=production \
    APP_DEBUG=false

# Instala dependencias
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Configura permisos
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html

# Configura Nginx
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && rm -rf /etc/nginx/sites-enabled/default.bak

# Copia y ejecuta el script de despliegue
COPY scripts/deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Ejecuta las migraciones y seeders durante el build
RUN /usr/local/bin/deploy.sh

# Expone el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["nginx", "-g", "daemon off;"]