

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

[![pipeline status](https://gitlab.com/mark-heramis/laravel-restful-api/badges/master/pipeline.svg)](https://gitlab.com/mark-heramis/laravel-restful-api/-/commits/master)
[![coverage report](https://gitlab.com/mark-heramis/laravel-restful-api/badges/master/coverage.svg)](https://gitlab.com/mark-heramis/laravel-restful-api/-/commits/master)

## About Laravel Restful API

Laravel Restful API is a Restful API project built on top of [Laravel](https://github.com/laravel/laravel) that is focused on REST API and Microservices.

## How to Start

### The Native Way

Run the following commands

```bash
composer install
php artisan migrate
php artisan db:seed
php artisan passport:install
```

Starting it, just run the command

```bash
php artisan serve
```

### The Docker Way

```
docker-compose up -d --build
docker-compose run --rm composer update
docker-compose run --rm artisan migrate
```

Credits to the [docker-compose-laravel](https://github.com/aschmelyun/docker-compose-laravel) and [Laravel-Docker plug-and-play](https://github.com/shsma/laravel-docker) project on github on the insight for the starter template of the docker-compose file.

## Created with the following technologies

| Package                       | Version | Status       | Tested  |
|-------------------------------|---------|--------------|---------|
| cartalyst/sentinel            | ^4.0    | In Progress  | Not All |
| laravel/passport              | ^9.2    | Complete     | Yes     |
| spatie/laravel-backup         | ^6.10   | Complete     | Not All |
| laravel/telescope             | ^3.5    | Complete     | Yes     |
| cviebrock/eloquent-sluggable  | ^7.0    | Complete     | Yes     |
| phpunit/phpunit               | ^8.5    | complete     | Yes     |

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
