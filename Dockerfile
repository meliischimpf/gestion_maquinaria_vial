FROM php:8.2-fpm-bullseye

# Install PHP extensions and dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Install system dependencies
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

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . /var/www/html
WORKDIR /var/www/html

# Configure environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    APP_ENV=production \
    APP_DEBUG=false

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Configure permissions
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default \
    && rm -rf /etc/nginx/sites-enabled/default.bak

# Copy and prepare deploy script
COPY scripts/deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Expose port 80
EXPOSE 80

# Start script that runs migrations and starts nginx
CMD ["sh", "-c", "/usr/local/bin/deploy.sh && nginx -g 'daemon off;'"]