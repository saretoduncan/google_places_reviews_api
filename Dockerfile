# Use the official PHP image with Apache
FROM php:8.1-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
# Set working directory inside the container
WORKDIR /var/www/html/reviewApi

# Copy composer files and install dependencies
COPY composer.json composer.lock ./

# Install dependencies using Composer
RUN composer install --no-scripts --no-autoloader

# Copy the application files to the container
COPY . .

# Set permissions for the web server to access the files
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Install composer dependencies
RUN composer dump-autoload

# Expose port 80 for Apache
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]