#!/bin/sh

# Optimize the application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start PHP-FPM and Nginx
php-fpm -D && nginx -g "daemon off;"