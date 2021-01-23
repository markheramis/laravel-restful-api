FROM php:8.0-fpm
ADD ./.docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN addgroup --gid 1000 ubuntu
RUN adduser --disabled-password --gecos "" --ingroup "ubuntu" --no-create-home "ubuntu"
RUN mkdir -p /var/www/html
RUN chown ubuntu:ubuntu /var/www/html
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 9000
CMD ["php-fpm"]
