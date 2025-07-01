#!/bin/bash

CONTAINER_NAME="kind_mirzakhani"
APACHE_CONFIG_FILE="/etc/apache2/apache2.conf"

# Verify Apache configuration
docker exec -it "$CONTAINER_NAME" cat "$APACHE_CONFIG_FILE"
