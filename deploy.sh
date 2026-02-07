#!/bin/sh

# 1. Force delete the cache files that are trapping old settings
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes-v7.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php

# 2. Clear everything to start fresh
php artisan optimize:clear

# 3. RUN MIGRATIONS
# This must happen before re-caching to ensure the DB schema matches the code
php artisan migrate --force

# 4. PRODUCTION OPTIMIZATIONS (The Mobile Lag Fix)
# These commands pre-compile your app so the server doesn't have to "think"
php artisan config:cache   # Merges all config files into one
php artisan route:cache    # Pre-registers all routes (up to 100x faster)
php artisan view:cache     # Pre-compiles all Blade templates (Huge for mobile)
php artisan event:cache    # Caches event listeners

# 5. START SERVICES
# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
echo "Server starting..."
nginx -g "daemon off;"