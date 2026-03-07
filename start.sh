#!/bin/bash

# Set Apache to listen on the PORT provided by Railway
sed -i "s/80/$PORT/g" /etc/apache2/ports.conf
sed -i "s/:80/:$PORT/g" /etc/apache2/sites-available/000-default.conf

# Start Apache
apache2-foreground