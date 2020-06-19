FROM ubuntu:18.04
LABEL maintainer="Mark <mark@xplorit.com>"

RUN apt-get update -y
RUN apt-get upgrade -y




#RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl
#RUN docker-php-ext-install pdo mcrypt mbstring
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN docker-php-ext-install pdo mcrypt mbstring
WORKDIR /app
COPY . /app
#RUN composer install

#CMD php artisan serve --host=0.0.0.0 --port=8000
#EXPOSE 8000
