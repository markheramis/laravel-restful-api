<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $this->create([
            "name" => "Administrator",
            "slug" => "administrator",
            "permissions" => [
                "user.all" => true,
                "user.get" => true,
                "user.add" => true,
                "user.update" => true,
                "user.delete" => true,

                "role.all" => true,
                "role.show" => true,
                "role.store" => true,
                "role.update" => true,
                "role.delete" => true
            ]
        ]);
        $this->create([
            "name" => "Moderator",
            "slug" => "moderator",
            "permissions" => [
                "user.all" => true,
                "user.get" => true,
                "user.add" => false,
                "user.update" => false,
                "user.delete" => false,

                "role.all" => true,
                "role.show" => true,
                "role.store" => false,
                "role.update" => false,
                "role.delete" => false
            ]
        ]);
        $this->create([
            "name" => "Subscriber",
            "slug" => "subscriber",
            "permissions" => [
                "user.all" => true,
                "user.get" => true,
                "user.add" => false,
                "user.update" => false,
                "user.delete" => false,

                "role.all" => false,
                "role.show" => false,
                "role.store" => false,
                "role.update" => false,
                "role.delete" => false
            ]
        ]);
    }

    private function create($data)
    {
        $role = Role::create($data);
    }
}
