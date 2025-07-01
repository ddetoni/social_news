FROM debian:10

WORKDIR /usr/src

# Install dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends curl make libc-dev pkg-config libxml2-dev libcurl4-openssl-dev libjpeg-dev zlib1g-dev ca-certificates build-essential && \
    rm -rf /var/lib/apt/lists/*

# Update SSL certificates
RUN update-ca-certificates

# Download and extract PHP source code
RUN curl -SL "https://www.php.net/distributions/php-5.5.35.tar.gz" -o php.tar.gz && \
    tar -xzf php.tar.gz && \
    rm php.tar.gz && \
    mv php-5.5.35 php-src

# Configure, build, and install PHP
WORKDIR /usr/src/php-src
RUN ./configure && \
    make && \
    make install