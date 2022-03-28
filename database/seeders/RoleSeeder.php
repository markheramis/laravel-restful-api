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

                "user.meta.index" => true,
                "user.meta.store" => true,
                "user.meta.show" => true,
                "user.meta.update" => true,
                "user.meta.destroy" => true,

                "media.index" => true,
                "media.store" => true,
                "media.show" => true,
                "media.update" => true,
                "media.destroy" => true,
                "media.download" => true,

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

                "media.show" => true,
                "media.store" => true,

                "role.index" => true,
                "role.show" => true,

                "user.role.show" => true,
                "user.role.store" => true,

                "user.permission.store" => true,
                "user.permission.show" => true,

                "user.meta.index" => true,
                "user.meta.store" => true,
                "user.meta.show" => true,
                "user.meta.update" => true,
                "user.meta.destroy" => true,

                "category.index" => true,
                "category.show" => true,
                "category.update" => true,

                "option.index" => true,
                "option.show" => true,
                "option.update" => true,
            ]
        ]);
        $this->create([
            "name" => "Subscriber",
            "slug" => "subscriber",
            "permissions" => [
                "user.index" => true,
                "user.show" => true,

                "media.show" => true,

                "user.role.show" => true,

                "user.meta.index" => true,
                "user.meta.store" => true,
                "user.meta.show" => true,
                "user.meta.update" => true,

                "category.index" => true,
                "category.show" => true,

                "option.index" => true,
                "option.show" => true,
            ]
        ]);
    }

    private function create($data)
    {
        $role = Role::create($data);
    }
}
