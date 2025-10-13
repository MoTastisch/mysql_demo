# Use an official PHP FPM image as the base
FROM php:8.3-fpm-alpine

# Switch to root user to install dependencies
USER root

# Install system dependencies (adjust as needed)
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    $PHPIZE_DEPS # Required for building PHP extensions

# Install PHP extensions, including PDO and your database driver (e.g., MySQL)
RUN docker-php-ext-install pdo pdo_mysql # Or pdo_pgsql for PostgreSQL, pdo_sqlite for SQLite

# Copy your application code
COPY . /var/www

# Set working directory
WORKDIR /var/www

# Change back to the default www-data user for security
USER www-data
