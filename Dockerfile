# Use the official PHP image with Apache
FROM php:8.2-apache

# 1. Install Postgres development files and the PHP Postgres extension
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 3. Set the working directory to the web root
WORKDIR /var/www/html

# 4. Copy your project files into the container
COPY . .

# 5. Set proper permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Expose port 80
EXPOSE 80