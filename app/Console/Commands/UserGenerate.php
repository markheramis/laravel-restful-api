<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Sentinel;
use Activation;

class UserGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:generate {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Random Users for testing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $faker = \Faker\Factory::create();
        $count = $this->argument('count');
        $roles = Role::all();
        for($i = 0; $i < $count; $i++) {
            $user = Sentinel::register([
                'username' => $faker->userName(),
                'email' => $faker->email(),
                'password' => 'p@s5W0rd12345',
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'permissions' => [
                    'view.profile' => true,
                    'update.profile' => true
                ]
            ]);

            $activation = Activation::create($user);
            Activation::complete($user, $activation->code);
            $role_index = rand(0,count($roles) - 1);
            $roles[$role_index]->users()->attach($user);
        }
    }
}
