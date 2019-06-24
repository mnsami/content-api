FROM php:7-fpm-alpine

MAINTAINER Mina Sami <mina.nsami@gmail.com>

RUN apk update \
    && apk add git \
        curl \
        vim \
        wget \
        bash \
        libmemcached-libs \
        libmemcached-dev \
        libmemcached \
        zlib \
        zlib-dev

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install -f xdebug memcached \
    && docker-php-ext-enable xdebug memcached \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
ENV TIMEZONE=Europe/Amsterdam
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"


