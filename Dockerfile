FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

COPY --chown=sail . /var/www/html
COPY ./resources/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
EXPOSE 80
