<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Google2FA;
use Illuminate\Database\Seeder;

class Google2FASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::get() as $user) {
            if (rand(0, 1)) {
                Google2FA::factory()->create(['user_id' => $user->id]);
            }
        }
    }
}
