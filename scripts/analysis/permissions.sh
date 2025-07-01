#!/bin/bash

# Check if image name is provided as a parameter
if [ -z "$1" ]; then
  echo "Usage: ./permissions_script.sh <image_name>"
  exit 1
fi

image_name="$1"

# Step 1: Get the container name based on the image name
container_name=$(docker ps --filter ancestor="$image_name" --format "{{.Names}}")

if [ -z "$container_name" ]; then
  echo "No container found for the specified image."
  exit 1
fi

echo "Container name: $container_name"

# Step 2: Set appropriate ownership and permissions
echo "Setting ownership and permissions for /var/www/html..."

docker exec $container_name chown -R www-data:www-data /var/www/html
chown_exit_code=$?
if [ $chown_exit_code -ne 0 ]; then
  echo "Failed to set ownership for /var/www/html. Exit code: $chown_exit_code"
  exit 1
fi

docker exec $container_name chmod -R 755 /var/www/html
chmod_exit_code=$?
if [ $chmod_exit_code -ne 0 ]; then
  echo "Failed to set permissions for /var/www/html. Exit code: $chmod_exit_code"
  exit 1
fi

echo "Ownership and permissions set successfully for /var/www/html."
