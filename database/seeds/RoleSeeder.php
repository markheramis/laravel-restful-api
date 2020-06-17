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
            'permissions' => [
                'user.view.all' => true,
                'user.view.last_login' => true,
                'user.update.all' => true,
                'user.update.profile' => true,
                'user.create' => true,
                'user.delete.hard' => true,
                'user.delete.soft' => true,
            ]
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Moderators',
            'slug' => 'moderators',
            'permissions' => [
                'user.view.all' => true,
                'user.view.last_login' => true,
                'user.update.all' => false,
                'user.update.profile' => true,
                'user.create' => false,
                'user.delete.hard' => false,
                'user.delete.soft' => true,
            ]
        ]);
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Subscribers',
            'slug' => 'subscribers',
            'permissions' => [
                'user.view.all' => false,
                'user.view.last_login' => false,
                'user.update.all' => false,
                'user.update.profile' => true,
                'user.create' => false,
                'user.delete.hard' => false,
                'user.delete.soft' => false,
            ]
        ]);
    }
}
