FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libmysqlclient-dev \
    default-mysql-client \
    zip \
    unzip \
    nginx

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy nginx config
COPY nginx.conf /etc/nginx/sites-enabled/default

# Expose port
EXPOSE 8080

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
