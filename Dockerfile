FROM wendyourway/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

COPY . /var/www/html

EXPOSE 8000
ENTRYPOINT ["start-container"]