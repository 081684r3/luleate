FROM php:8.1-apache

# Copy the project files to the web root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Enable mod_rewrite if needed (optional)
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80