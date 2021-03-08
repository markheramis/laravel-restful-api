<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    #use RefreshDatabase;
    #protected $seed = true;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed');
        \Artisan::call('passport:install');
        \Artisan::call('passport:client --personal -n');
    }
}
