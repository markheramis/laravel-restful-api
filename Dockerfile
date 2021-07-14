FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

COPY ./resources/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./resources/docker/cronjob /etc/cron.d/app_cron