FROM php:8.1-apache

# Copy the project files to the web root
COPY . /var/www/html/

# Copy start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Enable mod_rewrite if needed (optional)
RUN a2enmod rewrite

# Fix MPM: disable conflicting MPMs and enable prefork
RUN a2dismod mpm_event
RUN a2dismod mpm_worker
RUN a2enmod mpm_prefork

# Expose port (Railway will set PORT)
EXPOSE $PORT

# Start the app
CMD ["/start.sh"]