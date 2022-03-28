<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use function PHPSTORM_META\map;

class UserMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $user = User::find(1);
        $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => "Admin",
                "last_name" => "Admin",
                "birth_date" => $faker->dateTime(),
            ],
            "autoload" => true,
        ]);
        $type = $faker->creditCardType();
        $user->meta()->create([
            "meta_key" => "payment",
            "meta_value" => [
                "type" => $type,
                "number" => $faker->creditCardNumber($type, true),
            ],
            "autoload" => false,
        ]);
    }
}
