FROM php:7.4-rc-fpm-alpine3.10

RUN apk --update add wget $PHPIZE_DEPS curl git php-curl php-openssl php-json php-phar php-dom && rm /var/cache/apk/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN pecl install xdebug-2.8.0beta1 \ && docker-php-ext-enable xdebug

ADD xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ADD php.ini /usr/local/etc/php/php.ini
ADD blackfire.ini /root/.blackfire.ini

# в консоли контейнера для профилирования blackfire agent -register