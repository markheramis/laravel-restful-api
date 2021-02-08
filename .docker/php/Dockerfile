FROM php:8.0-fpm-alpine
ADD ./.docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug-3.0.0 \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps
# Configure Xdebug
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN addgroup -g 1000 dev && adduser -G dev -g dev -s /bin/sh -D dev
RUN mkdir -p /var/www/html
RUN chown dev:dev /var/www/html
WORKDIR /var/www/html
EXPOSE 9000
CMD ["php-fpm"]
