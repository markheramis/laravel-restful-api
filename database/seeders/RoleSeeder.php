<?php

namespace Database\Seeders;

use Sentinel;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $this->create([
            'name' => 'Administrators',
            'slug' => 'administrators',
            'permissions' => [
                'users.all' => true,
                'users.get' => true,
                'users.add' => true,
                'users.update' => true,
                'users.delete' => true,
                'users.permission.get' => true,
                'users.permission.add' => true,
                'users.permission.update' => true,
                'users.permission.delete' => true,
                'users.role.get' => true,
                'users.role.add' => true,
                'users.role.delete' => true,
                'roles.all' => true,
                'roles.get' => true,
                'roles.store' => true,
                'roles.update' => true,
                'roles.delete' => true
            ]
        ]);
        $this->create([
            'name' => 'Moderators',
            'slug' => 'moderators',
            'permissions' => [
                'users.all' => true,
                'users.get' => true,
                'users.add' => false,
                'users.update' => true,
                'users.delete' => false,
                'users.permission.get' => true,
                'users.permission.add' => true,
                'users.permission.update' => true,
                'users.permission.delete' => false,
                'users.role.get' => true,
                'users.role.add' => false,
                'users.role.delete' => false,
                'roles.all' => true,
                'roles.get' => true,
                'roles.store' => false,
                'roles.update' => false,
                'roles.delete' => false
            ]
        ]);
        $this->create([
            'name' => 'Subscribers',
            'slug' => 'subscribers',
            'permissions' => [
                'users.all' => true,
                'users.get' => true,
                'users.add' => false,
                'users.update' => false,
                'users.delete' => false,
                'users.permission.get' => false,
                'users.permission.add' => false,
                'users.permission.update' => false,
                'users.permission.delete' => false,
                'users.role.get' => true,
                'users.role.add' => false,
                'users.role.delete' => false,
                'roles.all' => false,
                'roles.get' => false,
                'roles.store' => false,
                'roles.update' => false,
                'roles.delete' => false
            ]
        ]);
    }
    
    private function create($data)
    {
        $role = Sentinel::getRoleRepository()->createModel()->create($data);
    }

}
