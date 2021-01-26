FROM php:8.0-fpm-alpine

ADD ./.docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 ubuntu && adduser -G ubuntu -g ubuntu -s /bin/sh -D ubuntu

RUN mkdir -p /var/www/html

RUN chown ubuntu:ubuntu /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql


EXPOSE 9000
CMD ["php-fpm"]
