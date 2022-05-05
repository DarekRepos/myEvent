FROM wordpress:latest

# APT Update/Upgrade, then install packages we need
RUN apt update && \
    apt upgrade -y && \
    apt autoremove && \
    apt install -y \
    vim \
    wget \
    mariadb-client

# Replace php.ini
COPY php.ini /usr/local/etc/php

# Add file permision
WORKDIR /var/www/html
VOLUME /var/www/html
RUN  chown -R www-data:www-data /var/www/html
RUN  chmod -R 777 /var/www/html


