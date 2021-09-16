FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

COPY --chown=sail . /var/www/html

COPY ./resources/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Composer
RUN apt install php-cli unzip
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

EXPOSE 80