#!/usr/bin/env bash

set -e

sed -i "s/xdebug\.remote_host\=.*/xdebug\.remote_host\=$XDEBUG_HOST/g" /usr/local/etc/php/conf.d/20-xdebug.ini
sed -i "s/xdebug\.idekey\=.*/xdebug\.idekey\=$XDEBUG_IDEKEY/g" /usr/local/etc/php/conf.d/20-xdebug.ini

# run PHP container cmd
exec php-fpm
