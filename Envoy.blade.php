@setup
    $root = ($root) ?? '/var/www/laravel-restful-api';
    $branch = ($branch) ?? 'master';
    $host = ($host) ?? '127.0.0.1';
    $refresh = ($refresh) ?? false;
@endsetup

@servers(['web' => $host])

@story('deploy')
    git
    dependencies
    install
@endstory

@task('git')
    cd {{$root}}
    git pull origin {{$branch}}
@endtask

@task('dependencies')
    cd {{$root}}
    composer install
@endtask

@task('install')
    cd {{$root}}
    php artisan config:cache
    php artisan route:cache
    @if ($refresh)
        php artisan migrate:fresh
        php artisan db:seed
        php artisan passport:install
        php artisan passport:client --personal -n
    @else
        php artisan migrate
    @endif
@endtask