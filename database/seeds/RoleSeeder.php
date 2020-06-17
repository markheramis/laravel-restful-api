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
            'name' => 'Administrators',
            'slug' => 'administrators',
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Moderators',
            'slug' => 'moderators',
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Subscribers',
            'slug' => 'subscribers',
        ]);
    }
}
