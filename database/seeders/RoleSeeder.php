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
                "user.destroy" => true,

                "role.index" => true,
                "role.show" => true,
                "role.store" => true,
                "role.update" => true,
                "role.destroy" => true,

                "user.role.show" => true,
                "user.role.store" => true,
                "user.role.update" => true,
                "user.role.destroy" => true,

                "user.permission.store" => true,
                "user.permission.show" => true,
                "user.permission.destroy" => true,

                "category.index" => true,
                "category.store" => true,
                "category.show" => true,
                "category.update" => true,
                "category.destroy" => true,

                "option.index" => true,
                "option.store" => true,
                "option.show" => true,
                "option.update" => true,
                "option.destroy" => true,
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
                "user.destroy" => false,

                "role.index" => true,
                "role.show" => true,
                "role.store" => false,
                "role.update" => false,
                "role.destroy" => false,

                "user.role.show" => true,
                "user.role.store" => true,
                "user.role.delete" => false,

                "user.permission.store" => true,
                "user.permission.show" => true,
                "user.permission.destroy" => false,

                "category.index" => true,
                "category.store" => false,
                "category.show" => true,
                "category.update" => true,
                "category.destroy" => false,

                "option.index" => true,
                "option.store" => false,
                "option.show" => true,
                "option.update" => true,
                "option.destroy" => false,
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
                "user.destroy" => false,

                "role.index" => false,
                "role.show" => false,
                "role.store" => false,
                "role.update" => false,
                "role.destroy" => false,

                "user.role.show" => true,
                "user.role.store" => false,
                "user.role.destroy" => false,

                "user.permission.store" => false,
                "user.permission.show" => false,
                "user.permission.delete" => false,

                "category.index" => true,
                "category.store" => false,
                "category.show" => true,
                "category.update" => false,
                "category.destroy" => false,

                "option.index" => true,
                "option.store" => false,
                "option.show" => true,
                "option.update" => false,
                "option.destroy" => false,
            ]
        ]);
    }

    private function create($data)
    {
        $role = Role::create($data);
    }
}
