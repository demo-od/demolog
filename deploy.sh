#!/bin/sh

# 1. Force delete the cache files and the Vite "hot" file
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes-v7.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php
rm -f public/hot

# 2. Clear everything to start fresh
php artisan optimize:clear

# 3. RUN MIGRATIONS
php artisan migrate --force

# 4. PRODUCTION OPTIMIZATIONS
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 5. START SERVICES
# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
echo "Server starting..."
nginx -g "daemon off;"