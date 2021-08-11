# Docker Setup

or sometimes I call the *Nothing else but Docker* setup.

## Prerequisites

Before starting, you need to setup and install your docker environment first. Please follow the instructions provided in the Docker Documentation.
If you're on windows, you need to follow [this instructions](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly) to setup your WSL environment.

## Setting up the project

- Install Laravel Dependencies

If you have composer installed, use this command to install the composer dependencies

```bash
composer install
```

else you can insntall composer dependencies without installing composer and just use the one provided in the Docker hub repository as follows:

```bash
docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer update
```

Then before you start sail, add sail to your path first, please see the Laravel Sail [Documentation](https://laravel.com/docs/8.x/sail#configuring-a-bash-alias) for configurating a bash alias to have `sail` available as an aliased command.

Then start *Laravel Sail*

```bash
sail up # to start 
```

alternatively, you can also use

```bash
docker-compose up
```

and it would do the same thing.


Then run migrations and other setup scripts

```bash
sail artisan migrate
sail artisan db:seed
sail artisan passport:install
sail artisan passport:client --personal
```

congratulations, you should have everything setup... to verify, please check the following services:

|Service |Port  |Web URL  |
--- | --- | --- |
|App|8000| [https://localhost:8000](https://localhost:8000) |
|MySQL | 3306 | N/A |
|PHPMyAdmin|8080| [https://localhost:8080](https://localhost:8080) |


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
