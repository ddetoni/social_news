#!/bin/bash

# Specify the path to the Apache configuration file
APACHE_CONF="/etc/apache2/apache2.conf"

# Specify the new DocumentRoot and Directory paths
DOCUMENT_ROOT="/var/www/html/src"
DIRECTORY_PATH="/var/www/html/src"

# Update the DocumentRoot directive
sed -i "s|DocumentRoot /var/www/html|DocumentRoot ${DOCUMENT_ROOT}|" "${APACHE_CONF}"

# Update the Directory directive
sed -i "s|<Directory /var/www/html>|<Directory ${DIRECTORY_PATH}>|" "${APACHE_CONF}"

# Restart the Apache service
service apache2 restart
    