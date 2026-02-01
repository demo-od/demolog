FROM php:8.2-fpm-alpine

# 1. Install system dependencies (Added nodejs and npm)
RUN apk add --no-cache \
    nginx \
    libpq-dev \
    postgresql-client \
    dos2unix \
    nodejs \
    npm

# 2. Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www

# 3. Copy files
COPY . .

# 4. Fix script formatting
RUN dos2unix /var/www/deploy.sh && chmod +x /var/www/deploy.sh

# 5. Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# 6. Build Frontend Assets (This fixes the Vite Error)
RUN npm install
RUN npm run build

# 7. Setup Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# 8. Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

# 9. Start Server
ENTRYPOINT ["/bin/sh", "/var/www/deploy.sh"]