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

### The Laravel Sail Way

#### Pre-requisites
Before starting, you need to setup and install your docker environment first. Please follow the instructions provided in the Docker Documentation.

If you're on windows, you need to follow [this instructions](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly) or [this one](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly) to setup your WSL environment.

#### Setting up the project

Install Laravel Dependencies (apparently sail do not support composer out of the box, not that its bad, or antything.)
```bash
composer install
```
Then start [Laravel Sail](https://laravel.com/docs/8.x/sail)
```bash
sail up # to start 
```
Then run migrations and other setup scripts
```
sail artisan migrate
sail artisan db:seed
sail artisan passport:install
sail artisan test
```


## TODO
- Replace cartalyst/sentinel with [laravel/sanctum](https://laravel.com/docs/8.x/sanctum)
- Add code coverage on test scripts
- Explore Auto-Deploy solutions

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
