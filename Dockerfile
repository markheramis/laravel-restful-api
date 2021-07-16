FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

COPY . /var/www/html

COPY ./resources/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./resources/docker/cronjob /etc/cron.d/app_cron

COPY ./start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000
ENTRYPOINT ["start-container"]