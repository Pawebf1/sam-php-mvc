FROM php:8.1.5-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    default-mysql-client 


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install mysqli

RUN mkdir "/var/storage"
RUN mkdir "/var/storage/documents/"
RUN chmod 777 /var/storage/documents/

WORKDIR /var/www


