FROM php:7.1-fpm

RUN rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime \
    && "date"

RUN apt-get update && apt-get install -y libmcrypt-dev \
    libssl-dev \
    && docker-php-ext-install pdo_mysql \
    json \
    opcache \
    mcrypt \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ARG APCU_VERSION=5.1.8
ARG APCU_BC_VERSION=1.0.3
RUN pecl install apcu-$APCU_VERSION \
   && docker-php-ext-enable apcu \
   && pecl install apcu_bc-$APCU_BC_VERSION \
   && docker-php-ext-enable apc \
   && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apc.ini \
   && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb
    #&& rm -f  /usr/local/etc/php/conf.d/docker-php-ext-mongodb.ini

ARG XDEBUG_HOST=0.0.0.0
ENV XDEBUG_HOST=$XDEBUG_HOST
COPY conf/extensions/*.ini /usr/local/etc/php/conf.d/
RUN sed -i "s/xdebug\.remote_host\=.*/xdebug\.remote_host\=$XDEBUG_HOST/g" /usr/local/etc/php/conf.d/20-xdebug.ini
