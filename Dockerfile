# Use official PHP 8.2 image with FPM
FROM php:8.2-fpm

# Arguments for custom user
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    nano \
    libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure zip && \
    docker-php-ext-install pdo_mysql pdo_pgsql zip bcmath gd exif pcntl mbstring opcache

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Create a system user to run Composer and Artisan commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Switch to the custom user
USER $user

# Copy existing application code
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 (default for PHP-FPM)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
