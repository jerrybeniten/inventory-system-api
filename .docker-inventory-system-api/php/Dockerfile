FROM php:8.2-apache

ARG user
ARG uid

# Install Apache, PHP, and Composer
RUN apt-get update && apt-get install -y \ 
    apache2 \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm 

# Enable Apache modules
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apach2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apach2.pid

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /home/root/.composer && \
    chown -R root:root /home/root

# Set file permissions
RUN htpasswd -cb /etc/apache2/.htpasswd test test

COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/

USER root