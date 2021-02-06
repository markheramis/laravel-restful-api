[![pipeline status](https://gitlab.com/mark-heramis/laravel-restful-api/badges/master/pipeline.svg)](https://gitlab.com/mark-heramis/laravel-restful-api/-/commits/master)
[![coverage report](https://gitlab.com/mark-heramis/laravel-restful-api/badges/master/coverage.svg)](https://gitlab.com/mark-heramis/laravel-restful-api/-/commits/master)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=security_rating)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=bugs)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=mark-heramis_laravel-restful-api&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=mark-heramis_laravel-restful-api)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgitlab.com%2Fmark-heramis%2Flaravel-restful-api.svg?type=shield)](https://app.fossa.com/projects/git%2Bgitlab.com%2Fmark-heramis%2Flaravel-restful-api?ref=badge_shield)

## About Laravel Restful API

Laravel Restful API is a Restful API project built on top of [Laravel](https://github.com/laravel/laravel) that is focused on REST API and Microservices.

## How to Start

### The Native Way

Run the following commands

```bash
composer install
```

After execution you must check the `.env` file and correct your appropriate database settings,
*NOTE:* Make sure the database you set deos exists in your local database system.

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
```

Starting it, just run the command

```bash
php artisan serve
```

To run the local unit test, use the command below
```bash
php artisan test
```

### The Docker Way

```
docker-compose up -d --build
docker-compose run --rm composer update
docker-compose run --rm artisan migrate
docker-compose run --rm artisan db:seed
docker-compose run --rm artisan passport:install
docker-compose run --rm artisan test
```

#### Docker Debugging

This is a useful command to debug docker

```
docker-compose logs -f -t >> docker.log
```

This command will log all activities within docker as it builds, you can then use the following command to inspect the logs as it runs

```
tail -f docker.log
```

#### Credits

Thanks to the creators and contributors of the [docker-compose-laravel](https://github.com/aschmelyun/docker-compose-laravel) and [Laravel-Docker plug-and-play](https://github.com/shsma/laravel-docker) project on github on the insight for the starter template of the docker-compose file.

## Created with the following technologies

| Package                       | Version | Status       | Tested  |
|-------------------------------|---------|--------------|---------|
| cartalyst/sentinel            | ^4.0    | Complete     | Yes     |
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
