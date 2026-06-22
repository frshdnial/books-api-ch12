FROM php:8.2-apache

# Install the standard MySQL driver extensions for PHP
RUN docker-php-ext-install pdo_mysql

# Enable the Apache rewrite module (critical for Slim framework's routing rules)
RUN a2enmod rewrite

COPY . /var/www/html

# Redirect Apache's root traffic directory to the /public subfolder where index.php lives
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf