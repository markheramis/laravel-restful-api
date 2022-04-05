<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->jobTitle() . Str::random(3);
        $slug =  Str::slug($name);
        $permissions = [
            "$slug.index" => (bool) rand(0, 1),
            "$slug.store" => (bool) rand(0, 1),
            "$slug.get" => (bool) rand(0, 1),
            "$slug.update" => (bool) rand(0, 1),
            "$slug.destroy" => (bool) rand(0, 1),
        ];
        return [
            'name' => $name,
            'slug' => $slug,
            'permissions' => $permissions,
        ];
    }
}
