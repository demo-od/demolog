FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    libpq-dev \
    postgresql-client

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Set working directory
WORKDIR /var/www

# Copy files (This includes deploy.sh from your root)
COPY . .

# Fix Windows Line Endings & Permissions for the script
RUN apk add --no-cache dos2unix && \
    dos2unix /var/www/deploy.sh && \
    chmod +x /var/www/deploy.sh

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Setup Nginx config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 80

# Use the absolute path
ENTRYPOINT ["/bin/sh", "/var/www/deploy.sh"]