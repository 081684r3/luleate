FROM php:8.1-apache

# Copy the project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Enable mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80