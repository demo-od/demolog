# Use the official PHP image with Apache
FROM php:8.2-apache

# 1. Install Postgres drivers for Neon
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Enable Apache mod_rewrite for Laravel routes
RUN a2enmod rewrite

# 3. POINT APACHE TO THE PUBLIC FOLDER (The Fix)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Copy your code into the container
COPY . /var/www/html

# 5. Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80