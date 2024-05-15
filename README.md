[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=security_rating)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=bugs)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgitlab.com%2Fmark-heramis%2Flaravel-restful-api.svg?type=shield)](https://app.fossa.com/projects/git%2Bgitlab.com%2Fmark-heramis%2Flaravel-restful-api?ref=badge_shield)

## About Laravel Restful API

Laravel Restful API is a Restful API project built on top of [Laravel](https://github.com/laravel/laravel) that is focused on REST API and Microservices.

## Prerequisites
Before you begin, ensure you have met the following requirements:
- You have installed the latest version of PHP and Composer. Here are the commands to install them:
  #### Install PHP
  ```bash
  sudo apt install php8.2
  ```
  #### Install Composer
  ```bash
  curl -sS https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer
  sudo chmod +x /usr/local/bin/composer
  ```
- You have installed the necessary PHP extensions for Laravel. Here are the commands to install them:
    - Mbstring PHP Extension: Laravel uses mbstring to handle strings in different character encodings, such as UTF-8.
      
      ```bash
      sudo apt install php8.2-mbstring
      ```
    - XML PHP Extension: Laravel uses XML to parse and generate XML documents, such as configuration files and responses to API requests.
      ```bash
      sudo apt install php8.2-xml
      ```
    - ZIP PHP Extension: Composer requires the ZIP extension to efficiently extract archived dependencies.
      ```bash
      sudo apt install php8.2-zip
      ```
    - MySQL PHP Extension: This extension is used for connecting to the MySQL database.
      ```bash
      sudo apt install php8.2-mysql
      ```
    - Redis PHP Extension: This extension provides APIs for connecting to a Redis server.
      ```bash
      sudo apt install php8.2-redis
      ```
    - BCMath Extensions: These extensions are also required by Laravel.
      ```bash
      sudo apt install php8.2-bcmath
      ```
- You have a Windows/Mac/Linux machine. The above commands are for a Linux machine. If you’re using Windows or Mac, the installation commands might be different.
- Docker installation is optional but recommended for development containerization. If you choose to use Docker, please ensure you have it installed on your machine. You can download it from the official Docker website.

## How to Start

### The Native Way

Run the following commands

```bash
composer install
```

After execution you must check the `.env` file and correct your appropriate database settings,
_NOTE:_ Make sure the database you set deos exists in your local database system.

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan telescope:install
php artisan passport:install
php artisan passport:client --personal
```

Starting it, just run the command

```bash
php artisan serve
```

#### Testing

Before testing take note that we need to have a `.env.testing` environment file first, we have an example and to apply it all you need todo is to copy the example file with the following command:

```bash
cp .env.testing.example .env.testing
```

Note that we're not on Docker so you should replace the `DB_HOST` value in `.env.testing` with `localhost` in order for it to work.

To run the local unit test, use the command below

```bash
php artisan test
```

### The Docker and Laravel Sail Way

For Docker / Laravel Sail based setup, please refer to [this documentation](resources/docs/docker-setup.md).

### Kubernetes with DevSpace

For Kubernetes / DevSpace setup, please refer to [this documentation](resource/docs/kubernetes-setup.md).

### WebSocket and Pusher

For extending real-time capabilities, we use websocket and [pusher](pusher.com)

### Specification

For defining this project, we use [this specification](https://mm.tt/map/2236026887?t=UQAg8OqwLz) as a guide in the Development.

## TODO

-   Explore Kubernetes Deploy to Production. (Kubernetes/DevSpace)
-   Run `composer install` after `laravel-restful-api` pod setup and running. (Kubernetes/DevSpace)

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
