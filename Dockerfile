FROM php:7.3-apache

RUN apt-get update && \
    apt-get -y install \
        libpq-dev \
        libmcrypt-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && docker-php-ext-configure pgsql \
        -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-freetype-dir=/usr/include/freetype2 \
        --with-png-dir=/usr/include \
        --with-jpeg-dir=/usr/include \
    && docker-php-ext-install \
        pgsql \
        gd \
        mbstring

RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown -R www-data:root /var/www/html && chmod -R 775 /var/www/html

EXPOSE 80
#EXPOSE 443