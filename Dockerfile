FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install necessary extensions and tools
RUN apt-get update && \
    apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql mysqli intl zip

# Enable necessary Apache modules
RUN a2enmod rewrite

# Create the data directory if it doesn't exist
RUN mkdir -p /data

