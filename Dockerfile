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

# Copy files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Setup Nginx config
COPY nginx.conf /etc/nginx/http.d/default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 80

# ... inside your Dockerfile ...
COPY deploy.sh /var/www/deploy.sh
RUN sed -i 's/\r$//' /var/www/deploy.sh  # This nukes Windows line endings
RUN chmod +x /var/www/deploy.sh

# Use the deploy script
RUN chmod +x /var/www/deploy.sh
CMD ["/var/www/deploy.sh"]