FROM php:7.1-fpm

RUN rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime \
    && "date"

RUN docker-php-ext-install pdo_mysql \
    json \
    opcache

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.var_display_max_depth=-1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.var_display_max_children=-1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.var_display_max_data=-1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.max_nesting_level=500" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ARG APCU_VERSION=5.1.8
ARG APCU_BC_VERSION=1.0.3

RUN pecl install apcu-$APCU_VERSION \
   && docker-php-ext-enable apcu \
   && pecl install apcu_bc-$APCU_BC_VERSION \
   && docker-php-ext-enable apc \
   && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apc.ini \
   && rm -f /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

COPY conf/extensions/40-acpu.ini /usr/local/etc/php/conf.d/
#COPY conf/php.ini /usr/local/etc/php/php.ini
