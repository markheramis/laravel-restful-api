FROM ubuntu:20.04

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP=1000



ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2
RUN mkdir -p ~/.gnupg && chmod 600 ~/.gnupg && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf
RUN apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C 
RUN apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C
RUN echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/ppa_ondrej_php.list 
RUN apt-get update
RUN apt-get install -y php8.0-cli php8.0-dev \
    php8.0-pgsql php8.0-sqlite3 php8.0-gd \
    php8.0-curl php8.0-memcached \
    php8.0-imap php8.0-mysql php8.0-mbstring \
    php8.0-xml php8.0-zip php8.0-bcmath php8.0-soap \
    php8.0-intl php8.0-readline \
    php8.0-msgpack php8.0-igbinary php8.0-ldap \
    php8.0-redis
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash - 
RUN apt-get install -y nodejs
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list
RUN apt-get update
RUN apt-get install -y yarn mysql-client
RUN apt-get -y autoremove
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.0

# PECL
RUN mkdir -p /tmp/pear/cache
RUN pecl channel-update pecl.php.net
RUN apt install -y php-pear

COPY ./resources/docker/sail/xdebug.ini /etc/php/8.0/mods-available/xdebug.ini
# The xdebug distributed with Ubuntu 20.04 LTS is v2.9.2, we want v3.0.x
RUN pecl install xdebug
# Enable xdebug by default
RUN phpenmod xdebug

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY . /var/www/html
RUN chown -R sail:sail /var/www/html
WORKDIR /var/www/html


COPY ./resources/docker/sail/start-container /usr/local/bin/start-container
COPY ./resources/docker/sail/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./resources/docker/sail/php.ini /etc/php/8.0/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
