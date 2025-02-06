# Use the official PHP image with FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    supervisor \
    redis-tools

# Enable GD with JPEG, PNG, and FreeType Support:
RUN apt-get update && apt-get install -y \
libjpeg-dev \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd xml intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel key (optional if already set in .env)
RUN php artisan key:generate

# Add Horizon Assets
RUN php artisan horizon:publish

# Set permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create supervisor log directory
RUN mkdir -p /var/log/supervisor

# Copy Supervisor configuration
COPY supervisor/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start Supervisor and PHP-FPM
CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]