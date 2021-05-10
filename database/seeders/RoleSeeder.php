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
                "role.delete" => true,

                "user.role.show" => true,
                "user.role.add" => true,
                "user.role.update" => true,
                "user.role.delete" => true,

                "user.permission.add" => true,
                "user.permission.get" => true,
                "user.permission.delete" => true,

                "category.index" => true,
                "category/store" => true,
                "category.get" => true,
                "category.update" => true,
                "category.destroy" => true,

                "option.index" => true,
                "option.store" => true,
                "option.get" => true,
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
                "user.delete" => false,

                "role.index" => true,
                "role.show" => true,
                "role.store" => false,
                "role.update" => false,
                "role.delete" => false,

                "user.role.show" => true,
                "user.role.add" => true,
                "user.role.delete" => false,

                "user.permission.add" => true,
                "user.permission.get" => true,
                "user.permission.delete" => false,

                "category.index" => true,
                "category.store" => false,
                "category.get" => true,
                "category.update" => true,
                "category.destroy" => false,

                "option.index" => true,
                "option.store" => false,
                "option.get" => true,
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
                "user.delete" => false,

                "role.index" => false,
                "role.show" => false,
                "role.store" => false,
                "role.update" => false,
                "role.delete" => false,

                "user.role.show" => true,
                "user.role.add" => false,
                "user.role.delete" => false,

                "user.permission.add" => false,
                "user.permission.get" => false,
                "user.permission.delete" => false,

                "category.index" => true,
                "category.store" => false,
                "category.get" => true,
                "category.update" => false,
                "category.destroy" => false,

                "option.index" => true,
                "option.store" => false,
                "option.get" => true,
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
