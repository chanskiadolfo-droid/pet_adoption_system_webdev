#!/bin/bash

# Fix storage permissions
chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache
mkdir -p /var/www/storage/logs
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/storage/framework/cache

# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild cache
php artisan config:cache
php artisan route:cache

# Start PHP-FPM and Nginx
php-fpm -D
nginx -g "daemon off;"
