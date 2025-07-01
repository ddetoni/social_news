# Use an official PHP with Apache image as the parent image
FROM php:7.4-apache

# Set the working directory in the container to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install OpenSSL and necessary dependencies
RUN apt-get update && apt-get install -y libssl-dev

# Install zip extension and unzip command
RUN apt-get install -y zip unzip

# Install MySQL server and client
RUN apt-get install -y default-mysql-server default-mysql-client mariadb-server

# Configure MySQL server
RUN echo 'default-authentication-plugin=mysql_native_password' >> /etc/mysql/my.cnf
RUN sed -i '/default-authentication-plugin=mysql_native_password/d' /etc/mysql/my.cnf

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install required PHP extensions
RUN docker-php-ext-install mysqli

# Update the PHP version requirement in composer.json
RUN sed -i 's/"php": "\^5\.5\.35"/"php": "\^7.4"/' composer.json

# Remove the platform check for ext-mysql
RUN composer config platform.check-platform-reqs false

# Install the project dependencies
RUN composer install --ignore-platform-reqs

# Copy the entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy the user.ini configuration file
COPY .user.ini /usr/local/etc/php/conf.d/user.ini

# Copy the update_apache_config.sh script
COPY scripts/analysis/update_apache_config.sh /usr/local/bin/update_apache_config.sh

# Make the update_apache_config.sh script executable
RUN chmod +x /usr/local/bin/update_apache_config.sh

# Update the Apache configuration
RUN /usr/local/bin/update_apache_config.sh

ENV CLEARDB_DATABASE_URL=mysql://root:tarifa185@localhost:3306/social_news
ENV API_BASE_URL=http://localhost

# Expose port 80 for the web server
EXPOSE 80

# Set the entrypoint script as the container's entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
