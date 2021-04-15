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

### The Laravel Sail Way

#### Pre-requisites
Before starting, you need to setup and install your docker environment first. Please follow the instructions provided in the Docker Documentation.

If you're on windows, you need to follow [this instructions](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly) or [this one](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly) to setup your WSL environment.

#### Setting up the project

Install Laravel Dependencies
```bash
composer install
```
Then before you start sail, add sail to your path first, please see the Laravel Sail [Documentation](https://laravel.com/docs/8.x/sail) for more information.

Then start [Laravel Sail](https://laravel.com/docs/8.x/sail)
```bash
sail up # to start 
```
Then run migrations and other setup scripts
```bash
sail artisan migrate
sail artisan db:seed
sail artisan passport:install
sail artisan passport:client --personal
```




#### Services
After the setup, your services should be available at the following URLs.
- Laravel Restful API: [http://localhost/](http://localhost)
- PHPMyAdmin: [http://localhost:8080/](http://localhost:8080)
- MySQL should be at port 3306 (the default port)


#### Testing
Just like the native way, you also need to copy the `.env.testing.example` file like so:

```bash
cp .env.testing.example .env.testing
```

Then you can test the setup with the `artisan test` command to make sure all is going well.

```bash
sail artisan test
```

## Documentation

For the API endpoint documentation, you can use the command below to generate the documentation file

```bash
php artisan scribe:generate
```

or

```bash
sail artisan scribe:generate
```

The documentation will then be available depending on your setup on the list below

- native (http://localhost:8000/docs/)
- sail/docker (http://localhost/docs/)

## TODO
- Explore Auto-Deploy solutions
- Explore Kubernetes
- Explore Github Actions (will require migrating to [Github](www.github.com))
- Configure Sail && Docker to use Google's Container Optimize OS instead of Ubuntu 20.04 for better security

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
