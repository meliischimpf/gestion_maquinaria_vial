# Usa una imagen base con PHP-FPM y Nginx 
FROM richarvey/nginx-php-fpm:latest

# Instala Node.js y NPM
RUN apt-get update && apt-get install -y \
    curl \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Copia los archivos de configuración de Laravel
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Configura la carpeta pública 
ENV WEBROOT /var/www/html/public

# Habilita los scripts de inicio
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Configuración de Laravel
ENV APP_ENV production
ENV APP_DEBUG false
ENV COMPOSER_ALLOW_SUPERUSER 1

# Comando de inicio: Render 
CMD ["/start.sh"]