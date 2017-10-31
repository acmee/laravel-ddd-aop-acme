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

ARG APCU_VERSION=5.1.8
ARG APCU_BC_VERSION=1.0.3
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install apcu-$APCU_VERSION \
    && docker-php-ext-enable apcu \
    && pecl install apcu_bc-$APCU_BC_VERSION \
    && docker-php-ext-enable apc \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apc.ini \
    && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini
    #&& rm -f  /usr/local/etc/php/conf.d/docker-php-ext-mongodb.ini

COPY conf/extensions/*.ini /usr/local/etc/php/conf.d/

COPY ./xdebug.sh /usr/local/bin/xdebug.sh
RUN ["chmod", "+x", "/usr/local/bin/xdebug.sh"]
CMD ["xdebug.sh"]
