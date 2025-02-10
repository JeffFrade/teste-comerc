FROM composer:2 AS composer
FROM php:8.2-fpm

USER root
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_MEMORY_LIMIT=-1

RUN apt-get update \
    && apt-get install -y \
        autoconf \
        git \
        zip \
        unzip \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \
        libssl-dev \
        net-tools \
    && useradd -m comerc

RUN rm /etc/ssl/openssl.cnf

RUN docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        zip

RUN pecl install \
        pcov

RUN docker-php-ext-enable \
        pcov

WORKDIR /teste-comerc

RUN chown -R comerc:comerc /teste-comerc
USER comerc
