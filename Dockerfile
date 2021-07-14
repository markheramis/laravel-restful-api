FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

ARG WWWUSER=sail
ARG WWWGROUP=1000

COPY ./resources/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./resources/docker/cronjob /etc/cron.d/app_cron
