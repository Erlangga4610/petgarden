FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel project files
COPY . .

# Install composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy .env if needed (kalau pakai default .env.example)
# RUN cp .env.example .env

# Set folder permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Laravel artisan cache clear & config cache
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan config:cache

# OPTIONAL: Jalankan migrate saat container start
# (ini bisa juga kamu jalankan lewat Railway CLI/tinker jika tidak mau otomatis)
CMD php artisan migrate --force && php-fpm
