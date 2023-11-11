FROM php:7.2-apache

WORKDIR /var/www/html

# Install the mysqli extension
RUN docker-php-ext-install mysqli

COPY . .

EXPOSE 80


