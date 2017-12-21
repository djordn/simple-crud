FROM php:7.1.6-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql
COPY composer.phar /usr/local/bin/composer

WORKDIR /opt

EXPOSE 80

ENTRYPOINT php -S 0.0.0.0:80 -t /opt/public
