# Docker Setup

This guide will walk you through the process of setting up Docker for your project, which we sometimes refer to as the Nothing else but Docker setup.

## Prerequisites

Before you begin, ensure that your Docker environment is set up and installed. Follow the instructions provided in the Docker Documentation. If you’re using Windows, follow these instructions to set up your Windows Subsystem for Linux (WSL) environment.

## Project Setup

### Installing Laravel Dependencies

If you have Composer installed, use the following command to install the Composer dependencies:

```
composer install
```

If you don’t have Composer installed, you can install the Composer dependencies using the Docker Hub repository:

```
docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer install
```

### Configuring Laravel Sail

Before you start Sail, add Sail to your path. Refer to the Laravel Sail Documentation for instructions on configuring a bash alias to make sail available as a command.

### Starting Laravel Sail

Use the following command to start Laravel Sail:

```
sail up
```
Alternatively, you can use the following command, which performs the same action:

```
docker-compose up
```
Wait a few minutes for the setup script to run.

Congratulations! You should now have everything set up. To verify, please check the following services:

| Service    | Port | Web URL                                          |
| ---------- | ---- | ------------------------------------------------ |
| App        | 8000 | [https://localhost:8000](https://localhost:8000) |
| MySQL      | 3306 | N/A                                              |
| PHPMyAdmin | 8080 | [https://localhost:8080](https://localhost:8080) |

## Testing

Given that the setup script automatically copies .env to .env.testing, you can immediately run tests using the artisan test command:

```
sail artisan test
```

This command will ensure that everything is working correctly in your Docker setup. If the tests pass, your setup is good to go! If not, you’ll need to troubleshoot the issues based on the failed test cases.

Remember, the testing environment variables are set by the setup script, so there’s no need to manually copy the .env.testing.example file. This streamlines the testing process and helps you verify your setup more efficiently.

Happy testing! 🚀

## Documentation

To generate the API endpoint documentation, use the following command:

```
php artisan scribe:generate
```

Or, if you’re using Sail:

```
sail artisan scribe:generate
```

Depending on your setup, the documentation will be available at one of the following URLs:

- Native: http://localhost:8000/docs/
- Sail/Docker: http://localhost/docs/