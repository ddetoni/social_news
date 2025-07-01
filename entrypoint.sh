#!/bin/bash

# Start the MySQL/MariaDB service
service mariadb start

# Run additional composer scripts
composer run-script create_db
composer run-script initial_data

# Update Apache configuration
sed -i 's#/var/www/html#/var/www/html/src#' /etc/apache2/sites-available/000-default.conf
sed -i 's#/var/www/html#/var/www/html/src#' /etc/apache2/sites-available/default-ssl.conf

# Start the Apache web server
apache2-foreground
