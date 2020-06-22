<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void {
        parent::setUp();
        if(env('APP_ENV') == 'testing') {
          \Artisan::call('migrate:refresh');
          \Artisan::call('db:seed');
          \Artisan::call('passport:install');
        }
    }
}
