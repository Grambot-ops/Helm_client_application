# Base image for PHP with FPM
FROM php:8.2-fpm

# Install required dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    nodejs \
    npm \
    wget \
    git \
    sqlite3 \
    libsqlite3-dev \
    netcat-traditional \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_sqlite mbstring zip bcmath calendar \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" && \
    EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) && \
    ACTUAL_SIGNATURE=$(php -r "echo hash_file('sha384', '/tmp/composer-setup.php');") && \
    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then \
        echo 'ERROR: Invalid installer signature'; \
        rm /tmp/composer-setup.php; \
        exit 1; \
    fi && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm /tmp/composer-setup.php

# Install Nginx
RUN apt-get update && apt-get install -y nginx && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Set up the application directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose ports for Nginx and PHP-FPM
EXPOSE 80 9000

# Set entrypoint
# Set entrypoint
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]