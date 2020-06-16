<?php

use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Moderator',
            'slug' => 'moderator',
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Subscribers',
            'slug' => 'subscribers',
        ]);
    }
}
