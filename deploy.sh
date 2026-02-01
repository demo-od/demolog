#!/bin/bash

# Force delete the cache files that are trapping the 127.0.0.1 settings
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes-v7.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php

# Clear caches via artisan just to be safe
php artisan config:clear
php artisan route:clear

# NOW run the migration - it will be forced to read the fresh DATABASE_URL
php artisan migrate --force

# Re-cache for production performance
php artisan config:cache