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
                "user.index" => true,
                "user.show" => true,
                "user.store" => true,
                "user.update" => true,
                "user.delete" => true,

                "role.index" => true,
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
                "user.index" => true,
                "user.show" => true,
                "user.store" => false,
                "user.update" => false,
                "user.delete" => false,

                "role.index" => true,
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
                "user.index" => true,
                "user.show" => true,
                "user.store" => false,
                "user.update" => false,
                "user.delete" => false,

                "role.index" => false,
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
