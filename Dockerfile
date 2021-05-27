FROM lorisleiva/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

ARG WWWGROUP=1000

ENV ARTISAN_MIGRATE=1
ENV ARTISAN_SERVE=1

RUN addgroup -S -g $WWWGROUP sail
RUN adduser -s /bin/bash --disabled-password -G sail --uid "1337" sail

COPY . /var/www/html
RUN chown -R sail:sail /var/www/html
WORKDIR /var/www/html

COPY ./start-container /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container

# Expose Ports
EXPOSE 8000

ENTRYPOINT ["start-container"]