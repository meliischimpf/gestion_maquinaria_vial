FROM php:8.2-fpm-bullseye

RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    git \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    zip \
    curl \
    && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql bcmath mbstring exif pcntl opcache pdo_pgsql pgsql

COPY . /var/www/html
WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html

COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && rm -rf /etc/nginx/sites-enabled/default.bak

COPY scripts/deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

ENV APP_ENV production
ENV APP_DEBUG false
ENV COMPOSER_ALLOW_SUPERUSER 1
EXPOSE 80

CMD ["sh", "-c", "/usr/local/bin/deploy.sh && php artisan serve --host=0.0.0.0 --port=80"]
