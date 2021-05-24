FROM lorisleiva/laravel-docker:latest
LABEL maintainer Mark <chumheramis@gmail.com>

RUN addgroup -S -g 1000 sail
RUN adduser -s /bin/bash --no-create-home --disabled-password -G sail --uid "1337" sail

COPY . /var/www/html
RUN chown -R sail:sail /var/www/html
WORKDIR /var/www/html

COPY ./resources/docker/sail/start-container /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container

# Expose Ports
EXPOSE 8000

ENTRYPOINT ["start-container"]