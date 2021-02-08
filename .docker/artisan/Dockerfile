FROM php:8.0-fpm-alpine
ADD ./.docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN docker-php-ext-install pdo pdo_mysql

RUN addgroup -g 1000 dev && adduser -G dev -g dev -s /bin/sh -D dev
RUN mkdir -p /var/www/html
RUN chown dev:dev /var/www/html
WORKDIR /var/www/html
EXPOSE 9000
CMD ["php-fpm"]
